<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CertificationExport;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
 use Carbon\Carbon;
  use Mpdf\Mpdf;



class ReportController extends Controller
{
    public function printStudents(Request $request)
    {
        $course = null;

        if ($request->filled('course_number')) {
            $course = Course::find($request->course_number);
        }

       $students = [];

    $course = Course::where('coursenumber', $request->course_number)
        ->where('subject_name', 'like', '%' . $request->teacher_name . '%')
        ->first();

    if ($course) {
        $students = Student::whereHas('courses', function ($query) use ($course) {
            $query->where('course_id', $course->id);
        })->get();
    }

        return view('report.print_students', compact('students','course'));
    }


public function financialReport(Request $request)
{
    // 1. Get students matching search criteria
    $studentIds = Student::whereHas('courses', function ($query) use ($request) {
        if ($request->filled('course_number')) {
            $query->where('courses.coursenumber', $request->course_number);
        }
        if ($request->filled('teacher_name')) {
            $query->where('subject_name', 'like', '%' . $request->teacher_name . '%');
        }
    })->pluck('id');

    // 2. Fetch payments for those students, with relations
    $payments = Payment::with(['student', 'course'])
        ->whereIn('student_id', $studentIds)
        ->whereHas('course', function ($query) use ($request) {
            if ($request->filled('course_number')) {
                $query->where('coursenumber', $request->course_number);
            }
            if ($request->filled('teacher_name')) {
                $query->where('subject_name', 'like', '%' . $request->teacher_name . '%');
            }
        })
        ->orderBy('student_id')
        ->orderBy('created_at')
        ->get();

    // 3. Group by student
    $groupedPayments = $payments->groupBy('student_id');

    // 4. Get course info from first payment
    $courseInfo = $payments->first()?->course;

    // 5. Build per-student summaries
    $studentSummaries = [];
    $totalExpected = 0;
    $totalPaidOverall = 0;

    foreach ($groupedPayments as $studentId => $paymentsForStudent) {
        $student = $paymentsForStudent->first()->student;
        $course = $paymentsForStudent->first()->course;
        $totalPaid = $paymentsForStudent->sum('payment_value');
        $coursePrice = $course->price ?? 0;
        $discount = $course->discount ?? 0;
        $netPrice = $coursePrice - $discount;
        $remaining = $netPrice - $totalPaid;

        $totalExpected += $netPrice;
        $totalPaidOverall += $totalPaid;

        $studentSummaries[] = (object) [
            'student' => $student,
            'course' => $course,
            'totalPaid' => $totalPaid,
            'remaining' => $remaining,
            'payments' => $paymentsForStudent,
        ];
    }

    $totalRemaining = $totalExpected - $totalPaidOverall;

    return view('report.financial_report', compact(
        'studentSummaries',
        'courseInfo',
        'totalExpected',
        'totalPaidOverall',
        'totalRemaining'
    ));
}
    public function exportExcelPage(Request $request)
    {
        $startAt     = $request->start_at;
        $endAt       = $request->end_at;
        $teacherName = $request->teacher_name;
        $pageNumber  = $request->page_number;

        $students = DB::table('students')
            ->join('stucourse', 'students.id', '=', 'stucourse.student_id')
            ->join('extra_student', 'extra_student.student_id', '=', 'students.id')
            ->join('courses', 'stucourse.course_id', '=', 'courses.id')
            ->select(
                 'students.firstname',
    'students.lastname',
                  DB::raw("(SELECT TRIM(CONCAT(students.firstname, ' ' , students.lastname)) AS fullname)"),
                'students.fathername',
                'students.national_number',
                'extra_student.mothername',
                'extra_student.date_of_birth',
                'extra_student.nationality',
                 'extra_student.birth_date',
                'stucourse.page_number',
                'stucourse.general_number',
                'courses.subject_name as course_name',
                'courses.start_date',
                'courses.end_date',
                'courses.teacher_name',
                'courses.days_of_course'
            )

            // هنا الفرق فقط
            ->when($pageNumber, function ($query) use ($pageNumber) {
                $query->where('stucourse.page_number', $pageNumber);
            })

            ->when($startAt, function ($query) use ($startAt) {
                $query->where('courses.start_date', '>=', $startAt);
            })
            ->when($endAt, function ($query) use ($endAt) {
                $query->where('courses.end_date', '<=', $endAt);
            })
            ->when($teacherName, function ($query) use ($teacherName) {
                $query->where('courses.teacher_name', 'like', "%{$teacherName}%");
            })
            ->orderBy('students.fullname')
            ->get();

        $courseInfo = [
            'course_name'    => optional($students->first())->course_name,
            'days_of_course' => optional($students->first())->days_of_course,
        ];

        return Excel::download(
            new CertificationExport($students, $courseInfo),
            'certification_page_'.$pageNumber.'.xlsx'
        );
    }


 public function payments(Request $request)
{
    $from = $request->input('from');
    $to = $request->input('to');

    $query = Payment::with(['student', 'course']);

    if ($from) {
        $query->whereDate('created_at', '>=', $from);
    }
    if ($to) {
        $query->whereDate('created_at', '<=', $to);
    }

    $payments = $query->orderBy('created_at', 'desc')->get();

    $groupedPayments = $payments->groupBy(function ($payment) {
        return $payment->student_id . '_' . $payment->course_id;
    });

    $reportData = [];
    $totalSum = 0;
    $totalPaymentCount = 0; // ← NEW

    foreach ($groupedPayments as $key => $group) {
        $first = $group->first();
        $student = $first->student;
        $course = $first->course;

        $totalPaid = $group->sum('payment_value');
        $remaining = $course ? ($course->price - $totalPaid) : 0;

        $reportData[] = (object) [
            'student_name' => $student->fullname ?? '—',
            'course_number' => $course->coursenumber ?? '—',
            'course_name' => $course->subject_name ?? '—',
            'course_price' => $course->price ?? 0,
            'total_paid' => $totalPaid,
            'remaining' => max(0, $remaining),
            'payment_count' => $group->count(),
            'first_payment' => $group->first()->created_at,
            'last_payment' => $group->last()->created_at,
            'payments' => $group,
        ];

        $totalSum += $totalPaid;
        $totalPaymentCount += $group->count(); // ← ADD THIS
    }

    return view('report.payments', compact('reportData', 'totalSum', 'totalPaymentCount', 'from', 'to'));
}


public function paymentsPdf(Request $request)
{
    $from = $request->input('from');
    $to = $request->input('to');

    $query = Payment::with(['student', 'course']);

    if ($from) {
        $query->whereDate('created_at', '>=', $from);
    }
    if ($to) {
        $query->whereDate('created_at', '<=', $to);
    }

    $payments = $query->orderBy('created_at', 'desc')->get();

    $groupedPayments = $payments->groupBy(function ($payment) {
        return $payment->student_id . '_' . $payment->course_id;
    });

    $reportData = [];
    $totalSum = 0;
    $totalPaymentCount = 0;

    foreach ($groupedPayments as $key => $group) {
        $first = $group->first();
        $student = $first->student;
        $course = $first->course;

        $totalPaid = $group->sum('payment_value');
        $remaining = $course ? ($course->price - $totalPaid) : 0;

        $reportData[] = (object) [
            'student_name' => $student->fullname ?? '—',
            'course_number' => $course->coursenumber ?? '—',
            'course_name' => $course->subject_name ?? '—',
            'course_price' => $course->price ?? 0,
            'total_paid' => $totalPaid,
            'remaining' => max(0, $remaining),
            'payment_count' => $group->count(),
            'first_payment' => $group->first()->created_at,
            'last_payment' => $group->last()->created_at,
            'payments' => $group,   // <-- each payment includes payment_type and note
        ];

        $totalSum += $totalPaid;
        $totalPaymentCount += $group->count();
    }

    $html = view('report.payments_pdf', compact('reportData', 'totalSum', 'totalPaymentCount', 'from', 'to'))->render();

    $mpdf = new Mpdf([
        'mode' => 'UTF-8',
        'format' => 'A4-L',       // landscape
        'default_font' => 'DejaVuSans',
        'directionality' => 'rtl',
    ]);

    $mpdf->WriteHTML($html);

    // Return inline (open in browser) instead of download
    return response($mpdf->Output('', 'S'), 200, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="تقرير_المدفوعات_المفصل.pdf"',
    ]);
}
}
