<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Invoice;
use App\Models\Session;
use App\Models\Student;
use Illuminate\Http\Request;

class Icdl_Report extends Controller
{
public function index(){
       
        return view('report.icdl_certification_report');
   
       }

public function Search_icdl(Request $request)
       {
           $startAt = $request->input('start_at');  
           $endAt = $request->input('end_at');        
       
           if ($startAt || $endAt) {
               $students = Student::with('extraStudent')
                   ->whereHas('extraStudent', function($query) {
                       $query->whereNotNull('print_date');
                   })
                   ->when($startAt, function ($query, $startAt) {
                       return $query->whereHas('extraStudent', function($q) use ($startAt) {
                           $q->where('print_date', '>=', $startAt); 
                       });
                   })
                   ->when($endAt, function ($query, $endAt) {
                       return $query->whereHas('extraStudent', function($q) use ($endAt) {
                           $q->where('print_date', '<=', $endAt); 
                       });
                   })
                   ->select('students.fullname', 'students.id')
                   ->take(25)
                   ->get();
           } else {
            
               $students = collect();
           }
       
           return view('report.icdl_certification_report', compact('students'));
       }
}
