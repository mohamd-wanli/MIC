<?php

namespace App\Http\Controllers;

use App\Models\Examday;
use App\Models\Student;
use App\Models\Meter;
use Illuminate\Http\Request;

class SearchController extends Controller
{

public function index()
    {     
        return view('student.index');
    }

public function create()
    {
        //
    }

 public function store(Request $request)
    {

    }

 public function show(string $id)
    {
        //
    
    }

   
public function edit(string $id)
    {
        //
    }

   
public function update(Request $request, string $id)
    {
        //
    }

   
public function destroy(string $id)
    {
        //
    }

public function ajax_search(Request $request){
    
        if ($request->ajax()) {
          $query = Student::query(); 
          if ($request->filled('searchbyfirstname') && $request->filled('searchbyfathername') && $request->filled('searchbylastname')) {
            $query->where('firstname', 'like', '%' . $request->searchbyfirstname . '%')
                  ->where('fathername', 'like', '%' . $request->searchbyfathername . '%')
                  ->where('lastname', 'like', '%' . $request->searchbylastname . '%');
        } else {
          if ($request->filled('searchbyfirstname')) {
              $query->where('firstname', 'like', '%' . $request->searchbyfirstname . '%');
          }
          if ($request->filled('searchbyfathername')) {
              $query->where('fathername', 'like', '%' . $request->searchbyfathername . '%');
          }
          if ($request->filled('searchbylastname')) {
              $query->where('lastname', 'like', '%' . $request->searchbylastname . '%');
          }
          if ($request->filled('searchbyfullname')) {
              $query->where('fullname', 'like', '%' . $request->searchbyfullname . '%');
          }
          if ($request->filled('searchbynational_number')) {
              $query->where('national_number', 'like', '%' . $request->searchbynational_number . '%');
          }
          if ($request->filled('searchbySkillcard')) {
            $query->where('Nscn', 'like', '%' . $request->searchbySkillcard . '%')
                  ->orwhere('Lscn', 'like', '%' . $request->searchbySkillcard . '%');
        }
        }
  
          $data = $query->orderby("id", "ASC")->paginate(1000);
          $exam = Examday::with('sessions')->where('Value_Status', 2)->get();
          $meters = Meter::all();
          
          return view('student.ajax_search', compact('data', 'exam' , 'meters'));
      }
  
      }

      public function adv_search(Request $request){
        $data=Student::orderby("id" , "ASC")->paginate(1000);
        if($data){
          return view('student.advanceSearch' , ['data'=>$data]);}
          
        }  
}
