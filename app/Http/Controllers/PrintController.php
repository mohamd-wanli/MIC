<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Student;
use App\Models\Course;


class PrintController extends Controller
{
public function printInvoices(Request $request)
    {
        $query = Invoice::with('student');
    
        if (!empty($request->department_id)) {
            $query->where('department_id', $request->department_id);
        }
    
        if (!empty($request->course_id)) {
            $query->where('course_id', $request->course_id);
        }
    
        if (!empty($request->start_at) && !empty($request->end_at)) {
            $query->whereBetween('payment_date', [$request->start_at, $request->end_at]);
        }
    
        if (!empty($request->type)) {
            $query->where('payment_type', $request->type);
        }
    
        $invoices = $query->get();
    
        return view('print.invoices', compact('invoices'));
    }

public function printStudentsByCourse(Request $request)
{
    $students = [];
    $course = Course::where('coursenumber', $request->course_number)
        ->where('subject_name', 'like', '%' . $request->teacher_name . '%')
        ->first();

    if ($course) {
        $students = Student::whereHas('courses', function ($query) use ($course) {
            $query->where('course_id', $course->id);
        })->get();
    }

    return view('print.course_students', compact('students', 'course'));
}
   public function printIcdl()
{
    $students = Student::all(); // جلب جميع الطلاب من قاعدة البيانات
    return view('print.printicdl', compact('students'));
}

}
