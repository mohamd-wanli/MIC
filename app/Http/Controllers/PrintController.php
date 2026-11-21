<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Student;
use App\Models\Course;
use App\Models\Payment;

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
    $courseQuery = Course::query();

    if ($request->filled('course_number')) {
        $courseQuery->where('coursenumber', $request->input('course_number'));
    }

    if ($request->filled('course_name')) {
        $courseQuery->whereHas('subject', function ($subjectQuery) use ($request) {
            $subjectQuery->where('subjects.name', $request->input('course_name'));
        });
    }

    $course = $courseQuery->with(['students' => function ($query) {
        $query->orderBy('students.fullname', 'asc');
    }])->first();

    if ($course !== null) {
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
// In PaymentController.php



}
