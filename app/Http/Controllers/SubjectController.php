<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Section;
use App\Models\Course;
use App\Models\Department;
use Mockery\Matcher\Subset;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
         $subjects = Subject::all();

        return view('subject.show_subjects',['subjects'=>$subjects]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::all();
        $departments = Department::all();
                return view('subject.create_subject',['subjects'=>$subjects , 'departments' => $departments]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

          //validate
          $request->validate([
            'name'=>['required'],
            'department_id' => ['required', 'exists:departments,id'],
        ]);
        $fields=[
            'name'=> $request->name,
            'department_id' => $request->department_id,
        ];
        Subject::create($fields);
        return redirect()->route('showsubject')->with('success', 'تم إضافة المادة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $subject = Subject::where('id',$request->id)->get();
        return view('subject.show_subject',['subject'=>$subject]);
    }

    public function show_api(Request $request)
    {
        $subject = Subject::where('id',$request->id)->get();
        return $subject;
    }

    public function showname_api(Request $request)
   {
        $subject = Subject::where('name',$request->id)->get();
        return $subject;
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       $subject =Subject::FindOrFail($id);
        return view('subject.edit_sub',['subject'=>$subject]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $fields=$request->validate([
            'name'=>['required'],
        ]);
        Subject::where('id',$request->id)
        ->update(['name' => $request->input('name')]);
        Course::where('subject_id',$request->id)
        ->update(['subject_name' => $request->input('name')]);
        return redirect()->route('showsubject')->with('success', 'تم تعديل المادة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            Subject::findOrFail($id)->delete();
            return redirect()->route('showsubject')->with('delete', 'تم حذف المادة بنجاح');
        }catch(\Exception $e){
            return redirect()->route('showsubject')->with('error', 'لا يمكن حذف المادة بسبب وجود دورة مرتبطة بها');
        }     
    }
    public function sectionsub(Request $request){
        $section_id = $request->id;
        $subjects = Subject::where('section_id',$section_id)->get();
        return $subjects;
        // print_r($student_id);exit;
    }
}
