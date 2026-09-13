<?php

namespace App\Http\Controllers;

use App\Models\Examday;
use App\Models\Session;
use App\Models\Student;
use App\Models\Meter;
use App\Models\Student_mark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SessionNumberController extends Controller
{

public function index() {
    }


public function create()
    {
        $exam = Examday::with('sessions')->get();
        return view('session_number.add_session_number', compact('exam'));
    }

   
public function store(Request $request)
    {
        $request->validate([
            'exam_day_id' => 'required|exists:exam_days,id',
            'session_name' => 'required|string|max:255',
        ]);

        Session::create($request->all());

        return redirect()->back()->with('success', 'تمت إضافة الجلسة بنجاح');
    }

  
public function show(string $id)
    {
        $session = Session::where('exam_day_id', $id)->get();
        return view('sessionnumber.sessionnumber', compact('session'));
    }

  
public function edit(string $id)
    {
        //
    }

   
public function update(Request $request, string $id)
    {
        //
    }

    
public function destroy(string $id)
    {
        //
    }
public function addStudentToSession(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
        ]);
        $sessionId = $request->input('session_id');
        // $meter = $request->input('meter');
        $session = Session::find($sessionId);
        $meter = $request->input('meter');

        if (!$session) {
            return response()->json('error', 'الجلسة غير موجودة');
        }

        if ($session->students()->count() >= 17) {
            return response()->json(['success' => false, 'message' => 'لا يمكن إضافة أكثر من 17 طالب في الجلسة']);
        }

        $studentId = $request->input('student_id');
        $student = Student::find($studentId);

        if ($session->students()->count()  == 14) {
            $session->students()->attach($studentId);
            return response()->json(['success' => true, 'message' => 'تمت إضافة الطالب بنجاح. ملاحظة: العدد الحالي للجلسة هو 15 طالب.']);
        }


        if ($session->students()->where('student_id', $studentId)->exists()) {
            return response()->json(['success' => false, 'message' => 'الطالب موجود بالفعل في هذه الجلسة.']);
        } else
            $session->students()->attach($student, ['meter' => $meter]);

        return response()->json(['success' => true, 'message' => 'تمت إضافة الطالب إلى الجلسة بنجاح']);

    }

public function showSessionStudents($sessionId)
    {
        $students = Student::all();
        $session = Session::with('students')->find($sessionId);

        if (!$session) {
            return redirect()->back()->with('error', 'الجلسة غير موجودة');
        }
        $studentCount = $session->students()->count();


        // print_r( $studentCount);exit;

        return view('add_student', compact('session', 'students', 'studentCount'));
    }

public function getSessions($examDayId)
    {
        $sessions = Session::where('exam_day_id', $examDayId)->get();

        return response()->json($sessions);
    }

public function saveGrades(Request $request, $sessionId)
    {
        $session = Session::findOrFail($sessionId);

        $students = $session->students()->get();

        if ($request->has('grades')) {
            foreach ($students as $student) {
                $studentId = $student->id;
                $grade = $request->grades[$studentId] ?? null;

                if ($grade !== null) {

                    $result = $grade >= 75 ? 'ناجح' : 'راسب';

                    DB::table('session_student')
                        ->where('session_id', $session->id)
                        ->where('student_id', $studentId)
                        ->update([
                            'grade' => $grade,
                            'result' => $result,
                        ]);
                }
            }
        }
        return redirect()->back()->with('success', 'تم اضافة العلامة بنجاح.');
    }

public function deleteStudent($studentId)
    {
        $deleted = DB::table('session_student')->where('student_id', $studentId)->delete();

        if ($deleted) {
            return response()->json(['success' => true, 'message' => 'تم حذف الطالب بنجاح']);
        }

        return response()->json(['success' => false, 'message' => 'فشل في حذف الطالب'], 500);
    }

public function updateStudent(Request $request, $studentId)
    {
        $request->validate([
            'meter' => 'required|string|max:255',
            'grade' => 'nullable|numeric|min:0|max:100',
        ]);

        try {
            $student = DB::table('session_student')->where('student_id', $studentId)->first();

            if (!$student) {
                return response()->json(['success' => false, 'message' => 'الطالب غير موجود']);
            }

            DB::table('session_student')
                ->where('student_id', $studentId)
                ->update([
                    'meter' => $request->meter,
                    'grade' => $request->grade,
                ]);

            return response()->json(['success' => true, 'message' => 'تم تعديل بيانات الطالب بنجاح']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'خطأ: ' . $e->getMessage()]);
        }
    }
}
