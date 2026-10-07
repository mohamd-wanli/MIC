<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Session;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class student_Report extends Controller
{
public function index(){
        $sessions = Session::whereHas('examday', function ($query) {
            $query->where('Value_Status', 2);
        })->get();
        return view('report.student_report' ,compact('sessions'));

       }

public function Search_students(Request $request){
            $sessionId = $request->input('session');
            $startAt = $request->input('start_at');
            $endAt = $request->input('end_at');

            $session = Session::with('students')->find($sessionId);
            if (!$session) {

                return redirect()->back()->withErrors('الجلسة غير موجودة');
            }
            $students = $session->students();

            if ($startAt) {
                $students->wherePivot('created_at', '>=', $startAt);
            }

            if ($endAt) {
                $students->wherePivot('created_at', '<=', $endAt);
            }

            $students = $session->students->map(function ($student) {
                return [
                    'Nscn' => $student->Nscn,
                    'Lscn' => $student->Lscn,
                    'fullname' => $student->fullname,
                    'english_firstname' => $student->english_firstname,
                    'english_fathername' => $student->english_fathername,
                    'english_grandfathername' => $student->english_grandfathername,
                    'english_lastname' => $student->english_lastname,
                    'meter' => $student->pivot->meter,
                ];
            });

            $sessions = Session::whereHas('examday', function ($query) {
                $query->where('Value_Status', 2);
            })->get();


            return view('report.student_report', compact('students', 'sessions'));
        }

//  public function searchStudentsByCourse(Request $request)
// {
//     // Get distinct course names for the dropdown
//     $courseNames = Course::join('subjects', 'courses.subject_id','=','subjects.id')
//     ->select('subjects.name as subject_name')->distinct()->get();

//     $students = collect();

//     if ($request->filled('course_number') ) {
//         $students = Student::whereHas('courses', function ($query) use ($request) {
//             if ($request->filled('course_number')) {
//                 $query->where('courses.coursenumber', $request->course_number);
//             }

//         })->get();
//     }

//     return view('report.student_by_course', compact('students', 'courseNames'));
// }
public function searchStudentsByCourse(Request $request)
{
    $courseNames = Course::join('subjects', 'courses.subject_id', '=', 'subjects.id')
        ->select('subjects.name as subject_name')
        ->distinct()
        ->get();

    $students = null;

    if ($request->filled('course_number') || $request->filled('course_name')) {
        $query = Student::query()->whereHas('courses', function ($courseQuery) use ($request) {
            if ($request->filled('course_number')) {
                $courseQuery->where('courses.coursenumber', $request->input('course_number'));
            }

            if ($request->filled('course_name')) {
                $courseQuery->whereHas('subject', function ($subjectQuery) use ($request) {
                    $subjectQuery->where('subjects.name', $request->input('course_name'));
                });
            }
        });

        $students = $query->get();
    }

    return view('report.student_by_course', compact('students', 'courseNames'));
}

}
