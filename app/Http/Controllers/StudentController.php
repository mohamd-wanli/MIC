<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Course;
use App\Models\Extrastudent;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Invoice;
use App\Models\Studenticdl;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{


public function index(Request $request)
{
    $query = Student::query();


    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('firstname', 'like', "%{$search}%")
              ->orWhere('fathername', 'like', "%{$search}%")
              ->orWhere('lastname', 'like', "%{$search}%")
              ->orWhere('fullname', 'like', "%{$search}%")
              ->orWhere('national_number', 'like', "%{$search}%");
        });
    }

    $students = $query->orderBy('created_at', 'desc')->paginate(25);

    return view('student.student', compact('students'));
}


    // public function search(Request $request)
    // {
    //     $query = Student::query();

    //     if ($request->has('search') && $request->search != '') {
    //         $search = $request->search;
    //         $query->where(function($q) use ($search) {
    //             $q->where('firstname', 'like', "%{$search}%")
    //                 ->orWhere('fathername', 'like', "%{$search}%")
    //                 ->orWhere('lastname', 'like', "%{$search}%")
    //                 ->orWhere('fullname', 'like', "%{$search}%")
    //                 ->orWhere('national_number', 'like', "%{$search}%");
    //         });
    //     }

    //     $students = $query->orderBy('created_at', 'desc')->get();

    //     $i = 0;
    //     $output = '';
    //     if ($students->count() > 0) {
    //         foreach ($students as $student) {
    //             $i++;
    //             $output .= "<tr>
    //             <td>{$i}</td>
    //             <td>{$student->firstname}</td>
    //             <td>{$student->fathername}</td>
    //             <td>{$student->lastname}</td>
    //             <td>{$student->fullname}</td>
    //             <td>{$student->national_number}</td>
    //             <td><a href='" . route('student.show', $student->id) . "' class='btn btn-primary'>تفاصيل</a></td>
    //         </tr>";
    //         }
    //     } else {
    //         $output = "<tr><td colspan='7'>لا توجد نتائج مطابقة للبحث.</td></tr>";
    //     }

    //     return $output;
    // }

public function updateCourseGrade(Request $request, int $studentId, int $courseId)
{
    try {
        $student = Student::findOrFail($studentId);
        $course  = $student->courses()->where('course_id', $courseId)->first();

        if ($course) {
            $course->pivot->coursegrade = $request->coursegrade;
            $course->pivot->save();

            return redirect()->back()->with('success', 'تم حفظ التقدير بنجاح!');
        }

        return redirect()->back()->with('error', 'لم يتم العثور على الدورة!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'حدث خطأ أثناء حفظ التقدير!');
    }
}

    public function create()
{
    // Create empty models for the view
    $student = new Student();
    $extra = new Extrastudent();

    // Pass them to the same profile view
    return view('student.profile', [
        'students'   => $student,
        'data'       => collect([$extra]), // to match the loop in the view
        'isCreating' => true,              // flag to indicate creation mode
    ]);
}


    public function profilePdf(int $studentId,int  $courseId)
    {
        $student = Student::with([
            'Extrastudent',
            'courses' => function ($q) use ($courseId) {
                $q->where('courses.id', $courseId);
            }
        ])->findOrFail($studentId);
            //  return $student;
        $course = $student->courses->firstOrFail();
          // Mark as printed (update the pivot)
      $print= $student->courses()->updateExistingPivot($courseId, [
        'printed_at' => now()
      ]);



        $html = view('student.profile-pdf', compact('student','course'))->render();

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'tempDir' => storage_path('app/temp'),
            'default_font' => 'dejavusans',
        ]);

        $mpdf->WriteHTML($html);

        return $mpdf->Output('student-profile.pdf', 'I');
    }
    public function store(Request $request)
{


    $request->validate([
        // Personal info (required)
        'firstname'       => 'required|string|max:255',
        'fathername'      => 'required|string|max:255',
        'lastname'        => 'required|string|max:255',
        'fullname'        => 'nullable|string|max:255',
        'national_number' => 'nullable|string|max:20',
        'Nscn'            => 'nullable|string|max:20',
        'Lscn'            => 'nullable|string|max:20',

        // Extra info (optional)
        'mothername'               => 'nullable|string|max:255',
        'date_of_birth'            => 'nullable|string',
        'nationality'              => 'nullable|string|max:255',
        'telephone'                => 'nullable|string|max:20',
        'mobile'                   => 'nullable|string|max:20',
        'cultural_level'           => 'nullable|string|max:255',
        'gender'                   => 'nullable|in:ذكر,أنثى',
        'engish_firstname'         => 'nullable|string|max:255',
        'english_lastname'         => 'nullable|string|max:255',
        'engish_fathername'        => 'nullable|string|max:255',
        'address'                  => 'nullable|string|max:500',
        'print_date'               => 'nullable|date',
        'notes'                    => 'nullable|string',
         'birth_date' => 'nullable|date',


    ]);


    // Create Student
    $student = Student::create([
        'firstname'       => $request->firstname,
        'fathername'      => $request->fathername,
        'lastname'        => $request->lastname,
        'fullname'        => $request->firstname . ' ' . $request->fathername . ' ' . $request->lastname,
        'national_number' => $request->national_number,

    ]);

    // Create Extrastudent
     Extrastudent::create([
        'student_id'               => $student->id,
        'engish_firstname'         => $request->engish_firstname,
        'engish_fathername'        => $request->engish_fathername,
        'english_lastname'         => $request->english_lastname,

        'gender'                   => $request->gender,
        'date_of_birth'            => $request->date_of_birth,
        'email'                    => $request->email,
        'telephone'                => $request->telephone,
        'mobile'                   => $request->mobile,
        'address'                  => $request->address,
        'nationality'              => $request->nationality,
        'mothername'               => $request->mothername,
        'print_date'               => $request->print_date,
        'cultural_level'           => $request->cultural_level,
        'notes'                    => $request->notes,
        'birth_date'               => $request->birth_date,
    ]);

    // return redirect()->route('student.index')->with('success', 'تم إضافة الطالب بنجاح');
    return redirect()
    ->route('student.show', $student->id)
    ->with('success', 'تم إضافة الطالب بنجاح. يمكنك الآن إضافة الدورات والمدفوعات من نفس الصفحة.');
}

    public function store2(Request $request)
    {
        $datatoinsert['arabic_firstname'] = $request->arabic_firstname;
        $datatoinsert['arabic_lastname'] = $request->arabic_lastname;
        $datatoinsert['national_number'] = $request->national_number;
        $datatoinsert['created_at'] = date("Y-m-d H:i:s");
        $datatoinsert['updated_at'] = date("Y-m-d H:i:s");
        DB::table('students')->insert($datatoinsert);
        return redirect()->route('showstudents');
    }


    public function show(string $id)
    {
        // $students = Student::where('id', $id)->first();
        $courses = Course::all();
        $students = Student::with(['courses', 'invoices'])->findOrFail($id);
        $data = Extrastudent::where('student_id', $id)->get();
        $exam = Studenticdl::where('student_id', $id)->get();

        return view('student.profile', compact('students', 'exam', 'data'));
    }

    public function show2(Request $request)
    {
        $students = Student::where('id', $request->id)->first();
        return view('student.show_student', ['students' => $students]);
    }


    public function edit(string $id) {}


    public function update(Request $request, string $id) {}


    public function destroy($id)
    {
        try {
            Student::findOrFail($id)->delete();
            return redirect('/student')->with('delete', ' تم حذف الطالب بنجاح');
        } catch (\Exception $e) {
            return redirect('/student')->with('error', 'لا يمكن حذف الطالب بسبب وجود دورة مرتبطة به');
        }
    }

    public function update_status(Request $request, string $id)
    {


        $datatoupdate['firstname'] = $request->firstname;
        $datatoupdate['fathername'] = $request->fathername;
        $datatoupdate['lastname'] = $request->lastname;
        $datatoupdate['fullname'] = $request->firstname . " " . $request->fathername . " " . $request->lastname;
        $datatoupdate['national_number'] = $request->national_number;
        $datatoupdate['Nscn'] = $request->Nscn;
        $datatoupdate['Lscn'] = $request->Lscn;
        $datatoupdate2['engish_firstname'] = $request->engish_firstname;
        $datatoupdate2['engish_fathername'] = $request->engish_fathername;
        $datatoupdate2['english_lastname'] = $request->english_lastname;
        $datatoupdate2['grandfathername'] = $request->grandfathername;
        $datatoupdate2['english_grandfathername'] = $request->english_grandfathername;
        $datatoupdate2['gender'] = $request->gender;
        $datatoupdate2['date_of_birth'] = $request->date_of_birth;
        $datatoupdate2['email'] = $request->email;
        $datatoupdate2['telephone'] = $request->telephone;
        $datatoupdate2['mobile'] = $request->mobile;
        $datatoupdate2['address'] = $request->address;
        $datatoupdate2['nationality'] = $request->nationality;
        $datatoupdate2['mothername'] = $request->mothername;
        $datatoupdate2['cultural_level'] = $request->cultural_level;
        $datatoupdate2['print_date'] = !empty($request->print_date) ? $request->print_date : null;
        $datatoupdate2['notes'] = $request->notes;
        $datatoupdate2['birth_date'] = !empty($request->birth_date) ? $request->birth_date : null;


        Student::where('id', $id)->update($datatoupdate);
        Extrastudent::where('student_id', $id)->update($datatoupdate2);
        return back();
    }

    // public function apiaddtocourse(Request $request)
    // {
    //     $courses = Course::all();
    //     return $courses;
    // }
   public function addtocourse(Request $request)
{
    $course_id = $request->course_id;
    $student_id = $request->id;
    $sale = $request->input('sale') ?? 0;

    $course = Course::find($course_id);

    if (!$course) {
        return response()->json(['error' => 'الدورة غير موجودة.'], 404);
    }

    $student = Student::findOrFail($student_id);

    // التحقق فقط من نفس الدورة
    if ($student->courses()->where('course_id', $course_id)->exists()) {
        return response()->json(['error' => 'الطالب مسجل بالفعل في هذه الدورة.'], 400);
    }


      $hasPageNumber=DB::table('stucourse')->where('course_id',$course_id)
      ->whereNotNull('page_number')->exists();

      if($hasPageNumber){
        return response()->json(['error' => 'لا يمكن تسجيل الطالب في هذه الدورة لأنها تحتوي على رقم صفحة.'], 400);}


       $serial=DB::table('stucourse')->where('course_id',$course_id)->max('serial_number') ?? 0;
       $newSerial=$serial + 1;
    $student->courses()->attach($course_id, [
        'serial_number' => $newSerial,

        'sale' => $request->input('sale', 0),
    ]);
     $course->load('students');

    return response()->json([
        'success' => 'تم تسجيل الطالب في الدورة بنجاح.',
        'course' => $course,
         'serial_number' => $newSerial,
    ]);

      }



    public function studentcourses(Request $request)
    {
        $student_id = $request->id;
        $stcourse = Student::with('courses')->find($student_id);
        return $stcourse;
        // print_r($student_id);exit;
    }

      public function deleteStudentFromCourse(Request $request, $studentId, $courseId)
    {
        try {

            $record = DB::table('stucourse')
                ->where('student_id', $studentId)
                ->where('course_id', $courseId);

            if (!$record->exists()) {
                return back()->with('error','الطالب غير مسجل في هذه الدورة');
            }

            $hasInvoices = DB::table('invoices')
                ->where('Student_id', $studentId)
                ->where('course_id', $courseId)
                ->exists();

            if ($hasInvoices) {

                $note = $request->input('note');

                if (!$note) {
                    return back()->with('error','يجب إدخال ملاحظة قبل الحذف');
                }

                DB::table('invoices')
                    ->where('course_id', $courseId)
                    ->update(['note' => $note]);
            }

            $record->delete();

            return back()->with('success','تم حذف الطالب من الدورة بنجاح');

        } catch (\Exception $e) {

            return back()->with('error','حدث خطأ أثناء الحذف');
        }
    }





    public function getInvoices($student_id, $course_id)
{
    $invoices = Invoice::where('Student_id', $student_id)
                        ->where('course_id', $course_id)
                        ->get();

    return response()->json($invoices);
}


public function getCoursesByNumber($courseNumber)
{
    // جلب المواد المرتبطة بالدورة
    $courses = Course::where('coursenumber', $courseNumber)->get();

    // التأكد من وجود المواد
    if ($courses->isEmpty()) {
        return response()->json(['courses' => []]);
    }

    return response()->json(['courses' => $courses]);
}

// في Controller

// في Controller

public function transferStudent(Request $request, $studentId)
{
    try {
        $student = Student::findOrFail($studentId);
        $currentCourse = Course::findOrFail($request->current_course_id);

        // البحث عن الدورة الجديدة
        $newCourse = Course::where('coursenumber', $request->new_course_number)
                           ->where('subject_name', $request->new_course_name)
                           ->first();

        if (!$newCourse) {
            // لا يتم إلغاء تسجيل الطالب من الدورة الحالية إذا لم توجد الدورة الجديدة
            return response()->json(['error' => 'الدورة التي أدخلتها غير موجودة. الطالب يبقى في الدورة الحالية.'], 404);
        }

        // إلغاء تسجيل الطالب من الدورة الحالية
        $student->courses()->detach($currentCourse->id);

        // إضافة الطالب إلى الدورة الجديدة
        $student->courses()->attach($newCourse->id, ['sale' => 0]); // مثال إذا كان هناك حقل إضافي

        // نقل الفاتورة المرتبطة بالطالب إلى الدورة الجديدة إذا كانت موجودة
        $invoice = $student->invoices()->where('course_id', $currentCourse->id)->first();

        if ($invoice) {
            // تحديث الدورة في الفاتورة لتتبع الدورة الجديدة
            $invoice->update(['course_id' => $newCourse->id]);
        }

        return response()->json([
            'message' => 'تم نقل الطالب بنجاح!',
            'course' => $newCourse
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

public function updateYearAndSerial(Request $request,int $studentId, int $courseId)
{
    try {
        $student = Student::findOrFail($studentId);
        $course = $student->courses()->where('course_id', $courseId)->first();

        if ($course) {
            $course->pivot->year_number = $request->year_number;
            // $course->pivot->serial_number = $request->serial_number;
            $course->pivot->save();

            return redirect()->back()->with('success', 'تم حفظ رقم العام ورقم التسلسل بنجاح!');
        }

        return redirect()->back()->with('error', 'لم يتم العثور على الدورة!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'حدث خطأ أثناء حفظ البيانات!');
    }
}




}
