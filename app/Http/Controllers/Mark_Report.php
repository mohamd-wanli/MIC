<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class Mark_Report extends Controller
{
public function index(){
       
        return view('report.mark_report');
   
       }

public function Search_mark(Request $request)
       {
           $startAt = $request->input('start_at');  
           $endAt = $request->input('end_at');        
       
           if ($startAt || $endAt) {
               $students = Student::with(['sessions' => function($query) use ($startAt, $endAt) {
                   $query->where('session_student.created_at', '>=', $startAt)
                         ->where('session_student.created_at', '<=', $endAt);
               }])
               ->whereHas('sessions', function($query) use ($startAt, $endAt) {
                   $query->where('session_student.created_at', '>=', $startAt)
                         ->where('session_student.created_at', '<=', $endAt);
               })
               ->select('students.fullname', 'students.id')
               ->get()
               ->map(function ($student) {
                   return $student->sessions->map(function ($session) use ($student) {
                       return [
                           'fullname' => $student->fullname,
                           'mark' => $session->pivot->grade ?? 'غير متوفر',
                           'meter' => $session->pivot->meter ?? 'غير متوفر'
                       ];
                   });
               })
               ->flatten(1);
           } else {
               $students = collect();
           }
       
           return view('report.mark_report', compact('students'));
       } 
}
