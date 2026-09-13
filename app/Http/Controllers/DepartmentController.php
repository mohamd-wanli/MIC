<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Department;


class DepartmentController extends Controller
{

public function index()
    {  
         $departments = Department::all();

        return view('department.show_departments',['departments'=>$departments]);
    }

  
public function create()
    {
        $departments = Department::all();
                return view('department.create_department',['departments'=>$departments]);
    }


public function store(Request $request)
    {
          $request->validate([
            'name' => ['required', 'unique:departments,name'],
        ]);
        $fields=[
            'name'=> $request->name,
        ];
        Department::create($fields);
        return redirect()->route('showdepartment')->with('success', 'تم إضافة القسم بنجاح');
    }

public function show(Request $request)
    {
        $department = Department::where('id',$request->id)->get();
        return view('department.show_department',['department'=>$department]);
    }

public function show_api(Request $request)
    {
        $department = Department::where('id',$request->id)->get();
        return $department;
    }

public function showname_api(Request $request)
   {
        $department = Department::where('name',$request->id)->get();
        return $department;
    }

public function edit($id)
    {
       $department =Department::FindOrFail($id);
        return view('department.edit_dep',['department'=>$department]);
    }

 
public function update(Request $request)
    {
        $fields=$request->validate([
            'name' => ['required', 'unique:departments,name'],
        ]);
        Department::where('id',$request->id)
        ->update(['name' => $request->input('name')]);
        Course::where('subject_id',$request->id)
        ->update(['subject_name' => $request->input('name')]);
        return redirect()->route('showdepartment')->with('success', 'تم تعديل القسم بنجاح');
    }

   
public function destroy($id)
    {
        try{
            Department::findOrFail($id)->delete();
            return redirect()->route('showdepartment')->with('delete', 'تم حذف القسم بنجاح');
        }catch(\Exception $e){
            return redirect()->route('showdepartment')->with('error', 'لا يمكن حذف القسم بسبب وجود دورة مرتبطة بها');
        } 
    }

}
