<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Department;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class invoices_ReportController extends Controller
{
public function index()
    {
        $user = Auth::user(); // جلب المستخدم الحالي
        
        if ($user->department_id === null) {
            // إذا كان Admin جلب كل الأقسام والدورات
            $departments = Department::all();
            $courses = Course::all();
        } else {
            // إذا كان مستخدم عادي جلب فقط القسم والدورات الخاصة به
            $departments = Department::where('id', $user->department_id)->get();
            $courses = Course::where('department_id', $user->department_id)->get();
        }
    
        return view('report.invoices_report', compact('departments', 'courses'));
    }
    
public function Search_invoices(Request $request)
    {
        $user = Auth::user();
    
        // جلب الأقسام بناءً على حالة المستخدم
        if ($user->department_id === null) {
            $departments = Department::all();
            $courses = Course::all(); // المسؤول يرى جميع الأقسام
        } else {
            $departments = Department::where('id', $user->department_id)->get();
            $courses = Course::where('department_id', $user->department_id)->get(); // المستخدم العادي يرى قسمه فقط
        }

          // ✅ التحقق من إدخال أي معيار بحث
    if (empty($request->department_id) && empty($request->course_id) && empty($request->start_at) && empty($request->end_at) && empty($request->type)) {
        return view('report.invoices_report', compact('departments', 'courses'))->with('message', 'يرجى إدخال معايير البحث لعرض النتائج.');
    }
    
        // إنشاء الاستعلام الأساسي
        if ($user->department_id === null) {
            $query = Invoice::query();
        } else {
            $query = Invoice::where('department_id', $user->department_id);
        }
    
        // فلترة حسب التاريخ
        if (!empty($request->start_at) && !empty($request->end_at)) {
            $start_at = date($request->start_at);
            $end_at = date($request->end_at);
            $query->whereBetween('payment_date', [$start_at, $end_at]);
        }
    
        // فلترة حسب القسم (للمسؤول فقط)
        if ($user->department_id === null && !empty($request->department_id)) {
            $query->where('department_id', $request->department_id);
        }

        if (!empty($request->course_id)) {
            $query->where('course_id', $request->course_id);
        }
    
        // جلب الفواتير
        $invoices = $query->get();
    
        return view('report.invoices_report', compact('invoices', 'departments' , 'courses'));
    }
}
