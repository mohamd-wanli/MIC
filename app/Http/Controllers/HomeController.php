<?php

namespace App\Http\Controllers;

use App\Exports\GroupReportExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function exportGroupReport(Request $request)
{
    $groupNumber = $request->input('group_number');

    if (!$groupNumber) {
        return redirect()
            ->back()
            ->with('error', 'يجب إدخال رقم المجموعة قبل التصدير');
    }

    // Build the same query used in showGroupReport()
    $students = DB::table('certificatestudent')
        ->where('certificatestudent.group_number', $groupNumber)
        ->join('students',         'certificatestudent.student_id', '=', 'students.id')
        ->leftJoin('extra_student','extra_student.student_id',      '=', 'students.id')
        ->join('stucourse',        'stucourse.student_id',          '=', 'students.id')
        ->join('courses',          'stucourse.course_id',           '=', 'courses.id')
        ->join('subjects',         'courses.subject_id',            '=', 'subjects.id')
        ->select(
            'students.fullname',
            'students.fathername',
            'students.national_number',
            'extra_student.mothername',
            'extra_student.date_of_birth',
            'extra_student.nationality',
            'extra_student.notes',
            'certificatestudent.group_number',
            'subjects.name as subject_name',
            'courses.start_date',
            'courses.end_date',
            'stucourse.certificate_number',
            'stucourse.page_number',
            DB::raw("(SELECT TRIM(CONCAT(t.name, ' ', t.lastname))
                      FROM teachers t
                      WHERE t.id = courses.teacher_id
                      LIMIT 1) as teacherName")
        )
        ->orderBy('students.fullname')
        ->get();

    if ($students->isEmpty()) {
        return redirect()
            ->back()
            ->with('error', "لا يوجد طلاب في المجموعة رقم {$groupNumber}");
    }

    $fileName = "group_report_{$groupNumber}_" . date('Y-m-d') . '.xlsx';

    return Excel::download(
        new GroupReportExport($students, $groupNumber),
        $fileName
    );
}
}
