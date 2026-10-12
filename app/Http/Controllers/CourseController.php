<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Department;
use App\Models\Payment;
use App\Models\Stucourse;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CourseController extends Controller
{

public function index(Request $request)
{
    $departments = Department::all();
    $subjects = Subject::all();
    $teachers = Teacher::all();


    $stucourse = DB::table('stucourse')
        ->select('course_id', DB::raw('MIN(page_number) as page_number'))
        ->groupBy('course_id');


    $query = Course::leftJoinSub($stucourse, 'stucourse', function ($join) {
        $join->on('courses.id', '=', 'stucourse.course_id');
    })
    ->select('courses.*', 'stucourse.page_number');

    // Filter by course number (from courses table)
    if ($request->filled('course_number')) {
        $query->where('courses.coursenumber', 'like', '%' . $request->course_number . '%');
    }

    // Filter by subject name (join subjects table)
    if ($request->filled('course_name')) {
        $query->join('subjects', 'courses.subject_id', '=', 'subjects.id')
              ->where('subjects.name', 'like', '%' . $request->course_name . '%');

    }


    $courses = $query->orderBy('courses.created_at', 'desc')->paginate(25);

    // For AJAX requests, return JSON with rendered partials
    if ($request->ajax()) {
        return response()->json([
            'table_body' => view('course.partials.table_body', compact('courses', 'departments', 'subjects', 'teachers'))->render(),
            'pagination' => view('course.partials.pagination', compact('courses'))->render(),
        ]);
    }

    return view('course.show_courses', compact('courses', 'departments', 'subjects', 'teachers'));
}


    public function create(){
        $departments = Department::get();
        $subjects = Subject::get();
         $teachers = Teacher::all();
        return view('course.create_course', ['subjects' => $subjects, 'departments' => $departments,'teachers' => $teachers]);}


        public function store(Request $request){

            $request->validate([
                'startdate' => ['required'],
                'enddate' => ['required'],
                'starthour' => ['required'],
                'endhour' => ['required'],
                'price' => ['required'],
                'coursedays' => ['required'],
                'numsession' => ['nullable'],
                'subjectcourse' => ['required'],
                'department_id' => ['nullable'], // السماح بإرسال department_id للمسؤول فقط
                'coursenumber' => ['nullable'],
                'note' => ['nullable'],
                'teacher_id' => ['nullable', 'exists:teachers,id'],
            ]);

            $user = Auth::user();

            // ✅ تحديد القسم بناءً على دور المستخدم
            $dep_id = $user->department_id ?? $request->department_id;

            if (!$dep_id) {
                return redirect()->back()->with('error', 'يجب تحديد القسم');
            }

            // ✅ استرجاع المادة للتحقق من صحتها
            $subject = Subject::find($request->subjectcourse);

            if (!$subject) {
                return redirect()->back()->with('error', 'المادة غير موجودة');
            }
          $exists=Course::where('coursenumber',$request->coursenumber)
          ->where('subject_id',$subject->id)->exists();
          if($exists){
            return redirect()->back()->with('error', 'رقم الدورة موجود مسبقاً لنفس المادة');
          }


            // ✅ إنشاء الدورة مع إزالة تاريخ البداية والنهاية وربط القسم بالمادة فقط
            Course::create([
                'dep_id' => $dep_id,
                'subject_id' => $subject->id,
                'start_date' =>  $request->startdate,
                'end_date' =>  $request->enddate,
              'teacher_id'   => $request->teacher_id,
              'teacher_name' => $request->teacher_id ? Teacher::find($request->teacher_id)->name : null,
                'subject_name' => $subject->name,
                'price' => $request->price,
                'start_hour' => $request->starthour,
                'end_hour' => $request->endhour,
                'num_of_session' => $request->numsession,
                'coursenumber' => $request->coursenumber,
                'days_of_course' => implode(",", $request->coursedays),
                'department_id' => $dep_id,
                'note' => $request->note,

            ]);

            return redirect()->route('showcourses')->with('success', 'تم إضافة الدورة بنجاح');
        }

 public function gradesReport(Request $request)
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

    $course = $courseQuery->first();

    if ($course !== null) {
        $students = Student::whereHas('courses', function ($query) use ($course) {
            $query->where('course_id', $course->id);
        })->get();
    }


    abort_if(!$course, 404, 'لم يتم العثور على الدورة');

    return view('report.course_grade', compact('course'));
}


public function getSubjects(int $departmentId){
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if ($user->department_id == null) {
            $subjects = Subject::where('department_id', $departmentId)->get();
        } else {
            $subjects = Subject::where('department_id', $user->department_id)->get();
        }

        return response()->json(['subjects' => $subjects]);}


public function getTeachers($subjectId){
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $teachers = Teacher::whereHas('subjects', function ($query) use ($subjectId) {
            $query->where('subject_id', $subjectId);
        })->get();

        return response()->json(['teachers' => $teachers]);}

public function show(Request $request)
{
    $course = Course::with(['students' => function ($query) {
        $query->withPivot('coursegrade', 'page_number', 'serial_number', 'year_number', 'printed_at');
    }])->find($request->id);

    // If you want to handle 404 if not found:
    // abort_if(!$course, 404);

    $subjects = Subject::all();
    $teachers = Teacher::all();

    return view('course.show_course', compact('course', 'subjects', 'teachers'));
}
public function saveAllCourseGrades(Request $request)
    {
    $request->validate([
        'grades' => 'required|array',
        'course_id' => 'required|exists:courses,id'
    ]);

    foreach ($request->grades as $studentId => $grade) {
        DB::table('stucourse')
            ->where('student_id', $studentId)
            ->where('course_id', $request->course_id)
            ->update(['coursegrade' => $grade]);
    }

    return response()->json(['success' => true]);
    }

    public function assignPageNumbers(Request $request)
{
    $request->validate([
        'course_id'   => 'required|exists:courses,id',
        'page_number' => 'required|integer',
    ]);

     $course = Course::findOrFail($request->course_id);
       $newPage = $request->page_number;
     $students=$course->students;
    // Check if any student in this course already has a page number
    $hasPageNumber = DB::table('stucourse')
                        ->where('course_id', $course->id)
                        ->whereNotNull('page_number')
                        ->exists();


    $pageExists=DB::table('stucourse')->where('page_number',$newPage)
    ->where('course_id','!=',$course->id)->exists();

       if($pageExists){
        return redirect()->back()->with('error', 'رقم الصفحة موجود مسبقاً لدورة أخرى');
       }


    foreach($students as $student){
        Stucourse::updateOrCreate(
            [
                'student_id' => $student->id,
                'course_id' => $course->id,
            ],
            ['page_number'=>$newPage]
        );
    }

    // // Get all students of this course
    // $students = $course->students()->orderBy('student_id')->get();

    // // If no page number was assigned before, we need to generate general numbers
    // if (!$hasPageNumber) {
    //     // Get the last general number for this year
    //     $courseYear = Carbon::parse($course->end_date)->year;
    //     $lastGlobalGeneralNumber = DB::table('stucourse')
    //         ->join('courses', 'stucourse.course_id', '=', 'courses.id')
    //         ->whereYear('courses.end_date', $courseYear)
    //         ->max('stucourse.general_number') ?? 0;
    // }

    // foreach ($students as $student) {
    //     $data = [
    //         'page_number' => $newPageNumber,
    //     ];

        // // Only assign general_number if it's the first time (no page number existed before)
        // if (!$hasPageNumber) {
        //     $lastGlobalGeneralNumber++;
        //     $data['general_number'] = $lastGlobalGeneralNumber;
        // }

    //     DB::table('stucourse')
    //         ->where('course_id', $course->id)
    //         ->where('student_id', $student->id)
    //         ->update($data);
    // }

    // Remove course from session (as before)
    $selectedCourses = session('selected_courses', []);
    if (($key = array_search($course->id, $selectedCourses)) !== false) {
        unset($selectedCourses[$key]);
        session(['selected_courses' => array_values($selectedCourses)]);
    }

    return redirect()->back()
        ->with('success', 'تم إدخال رقم الصفحة' . ($hasPageNumber ? ' وتحديثه' : '') . ' وحذف الدورة من قائمة قيد العمل.');
}

public function edit($id)
    {
    $course = Course::findOrFail($id);
    $user = Auth::user();

    // جلب الأقسام فقط للمشرف
    $departments = $user->department_id === null ? Department::all() : null;

    // جلب المواد حسب القسم
    $subjects = Subject::where('department_id', $course->department_id)->get();

    // جلب المدرسين المرتبطين بالمادة الحالية
    $teachers = Teacher::whereHas('subjects', function ($query) use ($course) {
        $query->where('name', $course->subject_name);
    })->get();
       $teachers    = Teacher::all();
 $subjects    = Subject::orderBy('name')->get();

    return view('course.editcourse', compact('course', 'departments', 'subjects', 'teachers'));
   }
 public function update(Request $request, int $id)

     {


    $user = Auth::user();
    $course = Course::findOrFail($id);

    // Department: Admin can change it, others keep their own
    $departmentId = $user->department_id === null ? $request->department_id : $course->department_id;

    $request->validate([
        'startdate'     => ['required'],
        'enddate'       => ['required'],
        'starthour'     => ['required'],
        'endhour'       => ['required'],
        'price'         => ['required'],
        'coursedays'    => ['required'],
        'numsession'    => ['required'],
        'subjectcourse' => ['required', 'exists:subjects,id'],
        'teacher_id'    => ['nullable', 'exists:teachers,id'],
        'coursenumber'  => ['nullable'],
        'note'          => ['nullable'],
    ]);

    $subject = Subject::find($request->subjectcourse);

    $exists = Course::where('coursenumber', $request->coursenumber)
        ->where('subject_id', $subject->id)
        ->where('id', '!=', $course->id)
        ->exists();

    if ($exists) {
        return redirect()->back()->with('error', 'رقم الدورة موجود مسبقاً لنفس المادة');
    }


    $teacherName = null;
    if ($request->filled('teacher_id')) {
        $teacher = \App\Models\Teacher::find($request->teacher_id);
        if ($teacher) {
            $teacherName = trim($teacher->name . ' ' . $teacher->lastname);
        }
    }

    $course->update([
        'department_id'   => $departmentId,
        'subject_id'      => $request->subjectcourse,
        'price'           => $request->price,
        'start_date'      => $request->startdate,
        'end_date'        => $request->enddate,
        'start_hour'      => $request->starthour,
        'end_hour'        => $request->endhour,
        'num_of_session'  => $request->numsession,
        'coursenumber'    => $request->coursenumber,
        'note'            => $request->note,
        'days_of_course'  => is_array($request->coursedays) ? implode(",", $request->coursedays) : $request->coursedays,
        'teacher_id'      => $request->teacher_id,
        'teacher_name'    => $teacherName,
    ]);

    return redirect()->route('showcourses')->with('success', 'تم تعديل الدورة بنجاح');
}



public function Course_active(Request $request)
{
    $selectedCourses = $request->input('course_ids'); // استلام قائمة الدورات المختارة

    if ($selectedCourses) {
        // حفظ الدورات المختارة في الجلسة
        session(['selected_courses' => $selectedCourses]);
    } else {
        // إذا لم يتم إرسال بيانات جديدة، استخدم القيم المخزنة في الجلسة
        $selectedCourses = session('selected_courses', []);
    }

    // جلب فقط الدورات التي تم اختيارها
    $courses = Course::with(['students'])->whereIn('id', $selectedCourses)->get();
    // $courseses = DB::select('from * stucourse where course_id = ' . $courses->id);
    // return $courseses;
    $subjects = Subject::all();
    $teachers = Teacher::all();

    return view('course.active', compact('courses', 'subjects', 'teachers'));
}

public function Course_cancele()
    {
        $students = DB::table('certificatestudent')
            ->join('students', 'certificatestudent.student_id', '=', 'students.id')
            ->join('extra_student', 'extra_student.student_id', '=', 'students.id')
            ->join('stucourse', 'stucourse.student_id', '=', 'students.id')
            ->select(
                'students.id',
                'certificatestudent.group_number',
                'students.fullname',
                'students.fathername',
                'extra_student.mothername',
                'extra_student.date_of_birth',
                'extra_student.nationality',
                'stucourse.general_number'
            )
            ->get();
        return view('course.ended', compact('students'));
    }

// public function Course_complete()
//     {
//         $page = DB::table('courses')
//         ->leftJoin('stucourse', 'courses.id', '=', 'stucourse.course_id')
//         ->select('stucourse.page_number')
//         ->distinct() // جلب رقم الصفحة
//         ->get();
//         $course = Course::all();
//         $subjects = Subject::all();
//         $teachers = Teacher::all();

//         return view('course.completed', ['courses' => $course, 'subjects' => $subjects, 'teachers' => $teachers , 'pages' => $page]);
//     }

public function Course_complete(Request $request)
{
    // Start with courses that have at least one student with a page_number
    $query = Course::whereHas('students', function ($q) {
        $q->whereNotNull('stucourse.page_number');
    });

    // Filter by course number
    if ($request->filled('course_number')) {
        $query->where('coursenumber', 'like', '%' . $request->course_number . '%');
    }

    // Filter by subject name (join subjects table)
    if ($request->filled('course_name')) {
        $query->join('subjects', 'courses.subject_id', '=', 'subjects.id')
              ->where('subjects.name', 'like', '%' . $request->course_name . '%')
              ->select('courses.*'); // avoid duplicate columns from join
    }

    // Optional: get distinct page numbers for a dropdown (if you want)
    $pages = DB::table('stucourse')
        ->select('page_number')
        ->distinct()
        ->whereNotNull('page_number')
        ->get();

    // Paginate and preserve query parameters
    $courses = $query->paginate(15)->appends($request->all());

    $subjects = Subject::all();
    $teachers = Teacher::all();

    return view('course.completed', compact('courses', 'subjects', 'teachers', 'pages'));
}

public function searchStudents(Request $request)
    {
        $pageNumber = $request->input('page_number');
        $year = $request->input('year'); // إضافة البحث بالسنة

        $students = DB::table('stucourse')
            ->join('students', 'stucourse.student_id', '=', 'students.id')
            ->leftJoin('extra_student', 'extra_student.student_id', '=', 'students.id')
            ->leftJoin('courses', 'stucourse.course_id', '=', 'courses.id')
            ->leftJoin('certificatestudent', 'certificatestudent.student_id', '=', 'students.id')
            ->leftJoin('subjects', 'courses.subject_id', '=', 'subjects.id')
            ->leftJoin('certificate_requests', function ($join) {
                $join->on('stucourse.student_id', '=', 'certificate_requests.student_id')
                     ->on('stucourse.course_id', '=', 'certificate_requests.course_id');
            }) // التحقق من وجود الطالب في طلبات الشهادة
            ->where('stucourse.page_number', $pageNumber);

        // إضافة فلترة حسب السنة إذا تم تحديدها
        if ($year) {
            $students->whereYear('courses.end_date', $year);
        }

        $students = $students->select(
            'students.id',
            'students.fullname',
            'students.fathername',
            'extra_student.mothername',
            'extra_student.date_of_birth',
            'extra_student.nationality',
            'stucourse.page_number',
            'stucourse.general_number',
            'stucourse.certificate_number',
            'stucourse.input_date',
            'certificatestudent.group_number',
           'subjects.name as course_name',
            'courses.start_date as course_start_date',
            'courses.end_date as course_end_date',
            DB::raw('CASE WHEN certificate_requests.id IS NOT NULL THEN "✅" ELSE "❌" END as request_status')
        )->get();

        // جلب السنوات المتاحة لعرضها في القائمة المنسدلة
        $availableYears = DB::table('courses')
            ->selectRaw('YEAR(end_date) as year')
            ->distinct()
            ->pluck('year');

        return view('course.students', compact('students', 'pageNumber', 'availableYears', 'year'));
    }

public function saveCertificateData(Request $request)
    {
    // مصفوفة لتتبع عدد مرات استخدام كل رقم شهادة
    $certificateCount = [];

    foreach ($request->input('certificate_number', []) as $studentId => $certificateNumber) {
        $inputDate = $request->input("input_date.$studentId");
        $groupNumber = $request->input("group_number.$studentId");

        if (!empty($certificateNumber)) {
            // تحقق من عدد الطلاب المسجلين بنفس رقم الشهادة داخل قاعدة البيانات
            $existingCount = DB::table('stucourse')
                ->where('certificate_number', $certificateNumber)
                ->count();

            // التحقق من المدخلات الجديدة في الفورم نفسه
            if (!isset($certificateCount[$certificateNumber])) {
                $certificateCount[$certificateNumber] = 1;
            } else {
                $certificateCount[$certificateNumber]++;
            }

            // إذا كان هناك أكثر من 26 طالبًا بنفس رقم الشهادة، امنع الإدخال
            if ($existingCount + $certificateCount[$certificateNumber] > 26) {
                return redirect()->back()->with('error', "رقم الشهادة ($certificateNumber) تم تسجيله مسبقًا لعدد كافٍ من الطلاب، لا يمكنك إضافته لطالب آخر!");
            }

            // ✅ حذف الطالب من جدول `certificate_requests` عند إدخال رقم شهادة
            DB::table('certificate_requests')
                ->where('student_id', $studentId)
                ->delete();
        }

        // تحديث البيانات في جدول `stucourse`
        DB::table('stucourse')
            ->where('student_id', $studentId)
            ->update([
                'certificate_number' => $certificateNumber,
                'input_date' => $inputDate,
                'course_id' => DB::table('stucourse')->where('student_id', $studentId)->value('course_id')
            ]);

        // تحديث أو إدراج بيانات الطالب في جدول `certificatestudent`
        DB::table('certificatestudent')->updateOrInsert(
            ['student_id' => $studentId],
            ['group_number' => $groupNumber]
        );
    }

    return redirect()->back()->with('success', 'تم حفظ البيانات بنجاح.');
    }

public function showAssignGroupForm()
    {
        $students = DB::table('certificatestudent')
            ->join('students', 'certificatestudent.student_id', '=', 'students.id')
            ->join('extra_student', 'extra_student.student_id', '=', 'students.id')
            ->select('students.id', 'students.fullname',  'students.fathername', 'extra_student.mothername', 'extra_student.date_of_birth', 'extra_student.nationality', 'certificatestudent.group_number')
            ->whereNull('certificatestudent.group_number')
            ->get();

        $currentGroupNumber = DB::table('certificatestudent')->max('group_number') + 1;

        return view('course.group', compact('students', 'currentGroupNumber'));
    }

public function showGroupReport(Request $request)
    {
        $groupNumber = $request->input('group_number');

        if (!$groupNumber) {
            return view('course.report')->with('error', 'يرجى إدخال رقم المجموعة.');
        }

        $students = DB::table('certificatestudent')
            ->where('group_number', $groupNumber)
            ->join('students', 'certificatestudent.student_id', '=', 'students.id')
            ->join('extra_student', 'extra_student.student_id', '=', 'students.id')
            ->join('stucourse', 'stucourse.student_id', '=', 'students.id')
            ->join('courses', 'stucourse.course_id', '=', 'courses.id')
            ->join('teachers', 'teachers.id', '=', 'courses.teacher_id')
            ->select(
                'students.id',
                'students.fullname',
                'students.fathername',
                'students.national_number',
                'extra_student.mothername',
                'extra_student.notes',
                'extra_student.date_of_birth',
                'extra_student.nationality',
                'certificatestudent.group_number',
                'courses.subject_name',
                'courses.start_date',
                'courses.end_date',
                'courses.coursenumber',
                // 'courses.teacher_name',
                DB::raw("(SELECT TRIM(CONCAT(name ,' ',lastname))
                FROM teachers WHERE teachers.id = courses.teacher_id
                ) as teacherName"),
                'stucourse.certificate_number',
                'stucourse.page_number',
            )
            ->get();

        return view('course.report', compact('students', 'groupNumber'));
    }

public function removeFromGroup($studentId)
    {
        $student = DB::table('certificatestudent')->where('student_id', $studentId)->first();

        if (!$student) {
            return redirect()->back()->with('error', 'الطالب غير موجود في هذه المجموعة.');
        }

        DB::table('certificatestudent')->where('student_id', $studentId)->delete();

        return redirect()->back()->with('success', 'تم حذف الطالب من المجموعة بنجاح.');
    }

public function searchPage(Request $request, $courseId)
    {
        $certificateNumber = $request->input('certificate_number');
        $results = collect();

        if ($certificateNumber) {
            $query = DB::table('stucourse')
                ->where('certificate_number', $certificateNumber)
                ->join('students', 'stucourse.student_id', '=', 'students.id')
                ->join('courses', 'stucourse.course_id', '=', 'courses.id')
                ->select(
                    'students.fullname',
                    'students.fathername',
                    'courses.subject_id',
                    'courses.start_date',
                    'courses.end_date',
                    'stucourse.certificate_number',
                    'stucourse.page_number'
                );

            if ($courseId != 0) {
                $query->where('courses.id', $courseId);
            }

            $results = $query->get();
        }

        return view('course.search_certificate', compact('results', 'certificateNumber', 'courseId'));
    }

public function searchByName(Request $request)
    {
        $studentName = $request->input('student_name');
        $results = collect(); // إنشاء مجموعة فارغة حتى لا تظهر نتائج تلقائيًا

        if ($studentName) { // البحث فقط إذا تم إدخال اسم الطالب
            $results = Student::where('fullname', 'like', '%'. $studentName . '%')
                ->orwhere('fathername', 'like', '%'. $studentName . '%')
                ->join('stucourse', 'students.id', '=', 'stucourse.student_id')
                ->join('courses', 'stucourse.course_id', '=', 'courses.id')
                ->select('students.*', 'stucourse.certificate_number', 'stucourse.page_number', 'courses.subject_id', 'courses.start_date', 'courses.end_date')
                ->get();
        }

        return view('course.searchByName', compact('results', 'studentName'));
    }

    public function checkStudentsBeforeDelete($id)
    {
        // التحقق مما إذا كان هناك طلاب مسجلين في الدورة
        $studentCount = DB::table('stucourse')->where('course_id', $id)->count();

        if ($studentCount > 0) {
            return response()->json(['status' => 'error', 'message' => 'لا يمكن حذف الدورة، يوجد طلاب مسجلون بها!']);
        }

        return response()->json(['status' => 'success']);
    }

  public function deleteCourse($id)
{
    $course = Course::find($id);
    if (!$course) {
        return response()->json(['status' => 'error', 'message' => 'الدورة غير موجودة.']);
    }


    $hasStudents = DB::table('stucourse')->where('course_id', $id)->exists();


    $hasPageNumber = DB::table('stucourse')
                        ->where('course_id', $id)
                        ->whereNotNull('page_number')
                        ->exists();

    if ($hasStudents || $hasPageNumber) {
        return response()->json([
            'status' => 'error',
            'message' => 'لا يمكن حذف الدورة: يوجد طلاب مسجلون أو تم إدخال رقم صفحة لها.'
        ]);
    }

    $course->delete();

    return response()->json([
        'status' => 'success',
        'message' => 'تم حذف الدورة بنجاح.'
    ]);
}

public function homeIndex()
{
    $totalStudents = Student::count();
    $totalCourses  = Course::count();
    $totalTeachers = Teacher::count();
    $totalSubjects = Subject::count();
    $totalPayments = Payment::sum('payment_value');

    $recentStudents = Student::orderBy('created_at', 'desc')->take(5)->get();
    $recentPayments = Payment::with('student')->orderBy('created_at', 'desc')->take(5)->get();

    return view('home', compact(
        'totalStudents',
        'totalCourses',
        'totalTeachers',
        'totalSubjects',
        'totalPayments',
        'recentStudents',
        'recentPayments'
    ));
}
}
