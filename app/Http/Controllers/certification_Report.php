<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CertificateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CertificationExport;
use App\Models\Student;

class certification_Report extends Controller
{
    public function index()
    {
        $courses = Course::all();
        $students = Student::with('Extrastudent')->get();
        $courseInfo = null;




        return view('report.certification_report', compact('courses','students','courseInfo'));
    }

    public function Search_certification(Request $request)
    {
//        $courseId = $request->input('course');
        $startAt = $request->input('start_at');
        $endAt = $request->input('end_at');
        $teacherName = $request->input('teacher_name');
        $pageNumber = $request->input('page_number');
        $students = DB::table('students')
            ->join('stucourse', 'students.id', '=', 'stucourse.student_id')
            ->join('extra_student', 'extra_student.student_id', '=', 'students.id')
            ->join('courses', 'stucourse.course_id', '=', 'courses.id')

            ->select(
                'students.id as student_id',
                'students.fullname',
                'students.firstname',
                'students.lastname',
                'students.fathername',
                'students.national_number',
                'extra_student.mothername',
                'extra_student.date_of_birth',
                   'extra_student.birth_date',
                'extra_student.nationality',
                'extra_student.mobile',
                'stucourse.page_number',
                'stucourse.general_number',
                'courses.days_of_course',
                 DB::raw("(
                     SELECT TRIM(CONCAT(t.name, ' ', t.lastname))
                      FROM teachers t
                      WHERE t.id = courses.teacher_id
                       LIMIT 1
                       ) as teacherfull"),

                // معلومات الدورة
                'courses.subject_name as course_name',
                'courses.start_date',
                'courses.end_date',
                'courses.teacher_name',
                'courses.start_hour',
                'courses.end_hour',
            )


            //            ->when($courseId, function ($query, $courseId) {
//                return $query->where('courses.id', $courseId);
//            })

            ->when($pageNumber, function ($query, $pageNumber) {
                return $query->where('stucourse.page_number', $pageNumber);
            })
            ->when($startAt, function ($query, $startAt) {
                return $query->where('courses.start_date', '>=', $startAt);
            })
            ->when($endAt, function ($query, $endAt) {
                return $query->where('courses.end_date', '<=', $endAt);
            })
               ->when($teacherName, function ($query, $teacherName) {

    $query->whereExists(function ($sub) use ($teacherName) {
        $sub->select(DB::raw(1))
            ->from('teachers as t')
            ->whereColumn('t.id', 'courses.teacher_id')
            ->where(function ($q) use ($teacherName) {
                $q->where('t.name', 'like', "%{$teacherName}%")
                  ->orWhere('t.lastname', 'like', "%{$teacherName}%");
            });
    })->orWhere('courses.teacher_name', 'like', "%{$teacherName}%");

})
        ->take(25)
            ->get();

        $courseInfo = $students->first();
         $page_number = $request->page_number;
        $courses = Course::all();
        $students->map(function ($student) {
    $age = null;
    if ($student->birth_date) {
        try {
            $age = \Carbon\Carbon::parse($student->birth_date)->age;
        } catch (\Exception $e) {
            $age = null;
        }
    }
    $student->certificate_eligible = ($age !== null && $age >= 15);
    return $student;
      });

        return view('report.certification_report', compact('students', 'courses', 'courseInfo','page_number'));

    }
       public function exportExcel(Request $request)
     {
    $startAt     = $request->start_at;
    $endAt       = $request->end_at;
    $teacherName = $request->teacher_name;
    $pageNumber  = $request->page_number;

    $students = DB::table('stucourse')
        ->join('students', 'students.id', '=', 'stucourse.student_id')
        ->join('extra_student', 'extra_student.student_id', '=', 'students.id')
        ->join('courses', 'stucourse.course_id', '=', 'courses.id')



        ->select(
            'students.fullname',
            'students.fathername',
            'students.firstname',
            'students.lastname',
            'students.national_number',
            'extra_student.mothername',
            'extra_student.date_of_birth',
            'extra_student.nationality',
            'extra_student.birth_date',
            'extra_student.mobile',

            'stucourse.page_number',
            'stucourse.general_number',
             DB::raw("(
                     SELECT TRIM(CONCAT(t.name, ' ', t.lastname))
                      FROM teachers t
                      WHERE t.id = courses.teacher_id
                       LIMIT 1
                       ) as teacherfull"),
            // ✅ أهم شي: ربط مباشر وصحيح
            'stucourse.course_id',
            'courses.subject_name as course_name',
            'courses.start_date',
            'courses.end_date',
            'courses.teacher_name',
            'courses.coursenumber',
            'courses.start_hour',
            'courses.days_of_course'
        )

        // الفلاتر
        ->when($pageNumber, function ($query) use ($pageNumber) {
            $query->where('stucourse.page_number', '<=', $pageNumber);
        })
        ->when($startAt, function ($query) use ($startAt) {
            $query->where('courses.start_date', '>=', $startAt);
        })
        ->when($endAt, function ($query) use ($endAt) {
            $query->where('courses.end_date', '<=', $endAt);
        })
           ->when($teacherName, function ($query, $teacherName) {

    $query->whereExists(function ($sub) use ($teacherName) {
        $sub->select(DB::raw(1))
            ->from('teachers as t')
            ->whereColumn('t.id', 'courses.teacher_id')
            ->where(function ($q) use ($teacherName) {
                $q->where('t.name', 'like', "%{$teacherName}%")
                  ->orWhere('t.lastname', 'like', "%{$teacherName}%");
            });
    })->orWhere('courses.teacher_name', 'like', "%{$teacherName}%");
                })

        // ✅ أهم سطرين (يمنع الخربطة)
        ->orderBy('stucourse.page_number')
        ->orderBy('stucourse.course_id') // كل صفحة مع دورتها

        ->orderBy('stucourse.general_number')

        ->get();

    $courseInfo = [
        'course_name'    => optional($students->first())->course_name,
        'days_of_course' => optional($students->first())->days_of_course,
        'start_hour'     => optional($students->first())->start_hour,
        'coursenumber'   => optional($students->first())->coursenumber,
    ];

    return Excel::download(
        new CertificationExport($students, $courseInfo),
        'certification_report.xlsx'
    );
}




   public function requestCertificate(Request $request)
{

    $course = Course::where('coursenumber', $request->course_id)->first();

    if (!$course) {
        return redirect()->back()->with('error', 'الدورة غير موجودة.');
    }

  $existingRequest = CertificateRequest::where('student_id', $request->student_id)
        ->where('course_id', $course->id)
        ->first();

    if ($existingRequest) {
        return redirect()->back()->with('error', 'تم تقديم طلب لهذا الطالب مسبقًا.');
    }

    CertificateRequest::create([
        'student_id' => $request->student_id,
        'course_id'  => $course->id,
    ]);

    return redirect()->back()->with('success', 'تم تقديم طلب الشهادة بنجاح.');
}

public function certificateRequests(){
    $requests = CertificateRequest::with(['student', 'course'])->get();
    return view('report.certificate_requests', compact('requests'));}

}
