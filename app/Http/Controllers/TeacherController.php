<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Course;
use App\Models\Department;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all();
        return view('teacher.show_teachers', ['teachers' => $teachers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::all();
        $departments = Department::all();

        //print_r($subjects);exit;
        return view('teacher.create_teacher', ['subjects' => $subjects , 'departments' => $departments]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate

        $subjects = $request->get('subject');
        //print_r($subjects);exit;
        for ($i = 0; $i < count($subjects); $i++) {
            $subject1 = $subjects[$i];
            $subject_name[] = $subject1;
            // $subject_name[]=json_decode($subject1, true);
        }
        for ($i = 0; $i < count($subject_name); $i++) {
            $subject_id[] = Subject::where('name', $subject_name[$i])->value('id');
        }

        // print_r( $subject_id);exit;
        $teacher = new Teacher();
        $teacher->name = $request->name;
        $teacher->lastname = $request->lastname;
        $teacher->phone_num = $request->phone_num;
        $teacher->salary = $request->salary;
        $teacher->salarytype = $request->salarytype;
        $teacher->department_id = $request->department_id;

        $teacher->save();

        $teacher->subjects()->attach($subject_id);

        return redirect()->route('showteachers')->with('success', 'تم إضافة المدرس بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $courses = [];
        // $subject_name=[];
        $id = $request->id;
        $teacher = Teacher::where('id', $request->id)->get();
        $teachers = Teacher::findOrFail($id);
        $subjects = Subject::all();
        foreach ($teachers->subjects as $c) {
            $subject_id[] = $c->pivot->subject_id;
        }
        for ($i = 0; $i < count($subject_id); $i++) {
            $subject = Subject::where('id', $subject_id[$i])->get();
            $subject_n[] = json_decode($subject, true);
        }
        for ($i = 0; $i < count($subject_n); $i++) {
            $subject1 = $subject_n[$i];
            $subject2 = $subject1[0];
            $subject_name[] = $subject2['name'];
        }
        $teacher_course = json_decode(Course::where('teacher_id', $id)->get('subject_name'));
        for ($j = 0; $j < count($teacher_course); $j++) {
            $courses[] = $teacher_course[$j]->subject_name;
        }
        return view('teacher.show_teacher', ['teacher' => $teacher, 'subject' => $subject_name, 'courses' => $courses]);
    }


    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        $subjects = Subject::all();
        foreach ($teacher->subjects as $c) {
            $subject_id[] = $c->pivot->subject_id;
        }
        return view('teacher.editteacher', ['teacher' => $teacher, 'subjects' => $subjects, 'subject_id' => $subject_id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //validate

        $subjects = $request->get('subject');

        for ($i = 0; $i < count($subjects); $i++) {
            $subject_id[] = Subject::where('name', $subjects[$i])->value('id');
        }

        $teacher = Teacher::findOrFail($request->id);
        $teacher->name = $request->name;
        $teacher->lastname = $request->lastname;
        $teacher->phone_num = $request->phone_num;
        $teacher->salary = $request->salary;
        $teacher->salarytype = $request->salarytype;
        $teacher->save();

        $teacher->subjects()->sync($subject_id);
        $id = $teacher->id;
        return redirect()->route('showteachers', ['id' => $id])->with('success', 'تم تعديل المدرس بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            Teacher::findOrFail($id)->delete();
            return redirect()->route('showteachers')->with('delete', 'تم حذف المدرس بنجاح');
        } catch (\Exception $e) {
            return redirect()->route('showteachers')->with('error', 'لا يمكن حذف الاستاذ بسبب وجود دورة مرتبطة به');
        }
    }
}
