<?php

namespace App\Http\Controllers;

use App\Models\Examday;
use App\Models\Session;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExamDayController extends Controller
{

public function index()
    {
        $exam = Examday::with('sessions')->orderBy('created_at', 'desc')->paginate(10);
        return view('Examday.Examday',compact('exam'));
    }

 
public function create()
    {
        return view('Examday.add_Examday');
    }
 
public function store(Request $request)
    {
        $examdate = $request->session_scheduled_date;
        $carbonDate = Carbon::parse($examdate);
        $dayName = $carbonDate->locale('ar')->dayName;
      $datatoinsert['day_of_session']= $dayName;
      $datatoinsert['session_scheduled_date']=$request->session_scheduled_date;
      $datatoinsert['number_of_sessions']=$request->number_of_sessions;
      $datatoinsert['session_time']=$request->session_time;
      $datatoinsert['status']= "نشط";
      $datatoinsert['Value_Status']= 2;
      $datatoinsert['session_time']=$request->session_time;
      $datatoinsert['created_at']=date("Y-m-d H:i:s");
      $datatoinsert['updated_at']=date("Y-m-d H:i:s");
      Examday::insert($datatoinsert);
        
        $student =  Student::latest()->first()->id;
        $number_of_session = $request->number_of_sessions;
        $startTime = Carbon::parse($request->session_time); 
      for($i=1 ; $i<=$number_of_session ; $i++){
       $session = new Session();
       $session -> student_id = $student;
    //    $session -> start_of_test = $request->session_time +$i -1;
    //    $session -> end_of_test = $request->session_time + $i;
       $startOfTest = $startTime->copy()->addHours($i - 1); 
       $endOfTest = $startOfTest->copy()->addHour();
       $session->start_of_test = $startOfTest->format('H:i');
       $session->end_of_test = $endOfTest->format('H:i');
       $session -> note = "لايوجد";
       $session -> session_name = "احمد";
       $examday = Examday::where('session_scheduled_date' , $request->session_scheduled_date)->first()->id;
       $session -> exam_day_id =$examday;
       $session -> save();
    }     
            return back();
    }

public function show($id)
    {
        $exam = Examday::where('id', $id)->first();
        return view('Examday.status_update', compact('exam'));
    }

public function edit(string $id)
    {
       //
    }

 
 public function update(Request $request, string $id)
    {
        //
    }


public function destroy($id)
    {
       $examday = Examday::find($id)->delete();
        return redirect('/Examday')->with('success', 'تم حذف اليوم الامتحاني بنجاح');   
    }

public function update_Examday(Request $request)
    {
        $examSession = Examday::findOrFail($request->id);
        
        $examdate = $request->session_scheduled_date;
        $carbonDate = Carbon::parse($examdate);
        $dayName = $carbonDate->locale('ar')->dayName;
        $examSession->day_of_session = $dayName;
        $examSession->session_scheduled_date = $request->session_scheduled_date;
        $examSession->number_of_sessions = $request->number_of_sessions;
        $examSession->session_time = $request->session_time;
        $examSession->save();
    
        $student = Student::latest()->first()->id;
        $number_of_sessions = $request->number_of_sessions;
    
        $existingSessions = Session::where('exam_day_id', $examSession->id)->get();
        $existingSessionCount = $existingSessions->count();
    
        
        if ($number_of_sessions < $existingSessionCount) {
            $sessionsToDelete = $existingSessionCount - $number_of_sessions;
            Session::where('exam_day_id', $examSession->id)
                ->orderBy('id', 'desc')   
                ->take($sessionsToDelete)
                ->delete();
        } 
        elseif ($number_of_sessions > $existingSessionCount) {
            $sessionsToAdd = $number_of_sessions - $existingSessionCount;
            $startTime = Carbon::parse($request->session_time);

            
    
            for ($i = 1; $i <= $sessionsToAdd; $i++) {
                $session = new Session();
                $session->student_id = $student;
    
                $startOfTest = $startTime->copy()->addHours($existingSessionCount + $i - 1);   
                $endOfTest = $startOfTest->copy()->addHour(); 
    
                $session->start_of_test = $startOfTest->format('H:i');
                $session->end_of_test = $endOfTest->format('H:i');
                $session->note = "لايوجد";
                $session->session_name = "احمد";
                $session->exam_day_id = $examSession->id;
    
                $session->save();
            }
        }

        if ($existingSessionCount > 0) {
            $startTime = Carbon::parse($request->session_time);
            foreach ($existingSessions as $index => $session) {
                $startOfTest = $startTime->copy()->addHours($index);
                $endOfTest = $startOfTest->copy()->addHour();
    
                $session->start_of_test = $startOfTest->format('H:i');
                $session->end_of_test = $endOfTest->format('H:i');
                $session->save();
            }
        }
    }

public function Status_Update($id, Request $request)
           {
               $exam = Examday::findOrFail($id);
       
               if ($request->Status === 'ملغى') {
       
                   $exam->update([
                       'Value_Status' => 1,
                       'Status' => $request->Status,
                    
                   ]);      
               }
               else {
                   $exam->update([
                       'Value_Status' => 3,
                       'Status' => $request->Status,
                   ]);
               }
               session()->flash('Status_Update');
               return redirect('/Examday');
       
           }

           public function Examday_active()
           {
               $exam = Examday::where('Value_Status', 2)->get();
               return view('Examday.active',compact('exam'));
           }
       
           public function Examday_cancele()
           {
               $exam = Examday::where('Value_Status',1)->get();
               return view('Examday.canceled',compact('exam'));
           }
       
           public function Examday_complete()
           {
               $exam = Examday::where('Value_Status',3)->get();
               return view('Examday.completed',compact('exam'));
           }
} 
       

