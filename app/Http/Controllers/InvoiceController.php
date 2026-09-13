<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;
use App\Models\Invoice;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
//     public function index()
//     {
//         //
//     }

//     /**
//      * Show the form for creating a new resource.
//      */
//   public function create($stuid, $coid)
//     {
//         $student = Student::findOrFail($stuid);
//         $course  = Course::findOrFail($coid);

//         $sale = 0;

//         foreach ($student->courses as $c) {
//             if ($c->id == $coid) {
//                 $sale = $c->pivot->sale;
//             }
//         }

//         return view('invoice.createinv', [
//             'student' => $student,
//             'course' => $course,
//             'sale' => $sale,
//             'departments' => Department::all()
//         ]);
//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//    public function store(Request $request)
// {
//     $request->validate([
//         'student_id'     => ['required', 'exists:students,id'],
//         'course_id'      => ['required', 'exists:courses,id'],
//         'paymenttype'    => ['required'],
//         'paymentamount'  => ['required', 'numeric', 'min:0'],
//         'paymentdate'    => ['required', 'date'],
//         'invoicenum'     => ['required', 'max:10'],
//         'department_id'  => ['nullable', 'exists:departments,id'],
//     ]);

//     $student = Student::findOrFail($request->student_id);
//     $course = Course::findOrFail($request->course_id);
//     $departmentId = $request->department_id ?? Auth::user()?->department_id;

//     try {
//         Invoice::create([
//             'department_id'  => $departmentId,
//             'course_id'      => $course->id,
//             'Student_id'     => $student->id,
//             'course_name'    => $course->subject_name,
//             'student_name'   => trim($student->firstname . ' ' . ($student->fathername ?? '') . ' ' . ($student->lastname ?? '')),
//             'payment_amount' => (float) $request->paymentamount,
//             'payment_date'   => $request->paymentdate,
//             'invoice_num'    => (int) $request->invoicenum,
//             'payment_type'   => $request->paymenttype,
//             'session_id'     => $request->session_id ?? null,
//             'session_name'   => $request->session_name ?? null,
//             'note'           => $request->note ?? null,
//         ]);

//         return redirect()
//             ->route('showstudent', ['id' => $student->id])
//             ->with('success', 'تم إضافة الفاتورة بنجاح');
//     } catch (\Throwable $e) {
//         Log::error('Invoice creation failed', [
//             'message' => $e->getMessage(),
//             'request' => $request->all(),
//         ]);

//         return back()->with('error', 'فشل إضافة الفاتورة. تأكد من وجود عمود department_id في جدول invoices.')->withInput();
//     }
// }



//     /**
//      * Display the specified resource.
//      */
//     public function show(Request $request)
//     {
//         $studentId = (int) ($request->route('stuid') ?? $request->stuid);
//         $courseId = (int) ($request->route('coid') ?? $request->coid);

//         $invoices = Invoice::where('Student_id', $studentId)
//             ->where('course_id', $courseId)
//             ->get();

//         $course = Course::findOrFail($courseId);
//         $coursePrice = (float) $course->price;

//         $totalPayment = Invoice::where('Student_id', $studentId)
//             ->where('course_id', $courseId)
//             ->sum('payment_amount');

//         $remainingAmount = $coursePrice - $totalPayment;

//         $student = Student::findOrFail($studentId);
//         $sale = 0;

//         foreach ($student->courses as $courseRecord) {
//             if ((int) $courseRecord->pivot->course_id == $courseId) {
//                 $sale = $courseRecord->pivot->sale ?? 0;
//                 break;
//             }
//         }

//         return view('invoice.show_invoice', [
//             'course_name' => $course->subject_name,
//             'student_id' => $studentId,
//             'invoices' => $invoices,
//             'course_price' => $coursePrice,
//             'totalpayment' => $totalPayment,
//             'remain_amount' => $remainingAmount,
//             'sale' => $sale,
//         ]);
//     }

//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit(Request $request)
//     {
//        $inv = Invoice::FindOrFail($request->id);
//        $studentt = Student::find($inv->Student_id);
//        foreach ($studentt->courses as $c)
//             {
//                 $sale = $c->pivot->sale;
//             }
//        return view('invoice.edit_inv',['inv'=>$inv,'sale'=>$sale]);
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, string $id)
//     {
//         $request->validate([
//             'coname' => ['required'],
//             'stuname' => ['required'],
//             'sale' => ['required'],
//             'paymenttype' => ['required'],
//             'paymentamount' => ['required'],
//             'session_name' => ['nullable'],
//             'paymentdate' => ['required'],
//             'invoicenum' => ['required', 'max_digits:10'],
//         ]);

//         $invoice = Invoice::findOrFail($id);

//         $course = Course::where('subject_name', $request->coname)->firstOrFail();
//         $student = Student::where('firstname', $request->stuname)->firstOrFail();

//         $fields = [
//             'course_id' => $course->id,
//             'Student_id' => $student->id,
//             'course_name' => $request->coname,
//             'student_name' => $request->stuname,
//             'payment_amount' => $request->paymentamount,
//             'payment_date' => $request->paymentdate,
//             'invoice_num' => $request->invoicenum,
//             'payment_type' => $request->paymenttype,
//         ];

//         $invoice->update($fields);

//         $invoices = Invoice::where('Student_id', $student->id)
//             ->where('course_id', $course->id)
//             ->get();

//         $totalPayment = Invoice::where('Student_id', $student->id)
//             ->where('course_id', $course->id)
//             ->sum('payment_amount');

//         $remainingAmount = $course->price - $totalPayment;

//         return view('invoice.show_invoice', [
//             'course_name' => $course->subject_name,
//             'student_id' => $student->id,
//             'invoices' => $invoices,
//             'course_price' => $course->price,
//             'totalpayment' => $totalPayment,
//             'remain_amount' => $remainingAmount,
//             'sale' => $request->sale,
//         ])->with('success', 'تم تعديل الفاتورة بنجاح');
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy($stuid, $coid)
//     {
//         $invoice = Invoice::where('Student_id', $stuid)
//             ->where('course_id', $coid)
//             ->first();

//         if ($invoice) {
//             $invoice->delete();

//             return redirect()->back()->with('success', 'تم حذف الفاتورة بنجاح');
//         }

//         return redirect()->back()->with('error', 'لم يتم العثور على الفاتورة');
//     }

//     public function editsale(Request $request)
//     {
//         $student = Student::find($request->stuid);
//         $course_id=$request->coid;
//         foreach ($student->courses as $c)
//             {
//                 if ($c->pivot->course_id == $course_id) {
//                     $sale = $c->pivot->sale;
//                 }

//             }
//             return view('student.edit_sale',['sale'=>$sale,'stuid'=>$request->stuid,'coid'=>$course_id]);

//     }

//     public function updatesale(Request $request)
//     {
//         $student_id=$request->stuid;
//         $course_id = $request->coid;
//         $sale = $request->input('sale');
//         $student = Student::find($request->stuid);
//         $student->courses()->detach($course_id, ['sale' => $sale]);
//         $student->courses()->attach($course_id, ['sale' => $sale]);

//         return redirect()->route('showstudent',['id'=> $student_id ])->with('success', 'تم تعديل الحسم بنجاح');;
//     }

// public function addNote(Request $request, $invoiceId)
//     {
//         // التحقق من وجود الفاتورة
//         $invoice = Invoice::findOrFail($invoiceId);

//         // إضافة الملاحظة
//         $invoice->note = $request->note;
//         $invoice->save();

//         // إعادة توجيه المستخدم مع رسالة تأكيد
//         return redirect()->back()->with('success', 'تم إضافة الملاحظة بنجاح!');
//     }

public function createInvoice(){
    
}

}
