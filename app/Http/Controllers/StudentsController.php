<?php

namespace App\Http\Controllers;

use App\Student;
use App\Classes;
use App\Section;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $students = Student::orderBy('class','desc')->get();
        return view('student.index',['students'=>$students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $classes = Classes::all();
        $sections = Section::all();
        return view('student.create',['classes'=>$classes, 'sections'=>$sections]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'photo'=>'image|nullable|max:2048'
        ]);

        $student = new Student();
        $student->name = $request->s_name;
        $student->father_name = $request->f_name;
        $student->mother_name = $request->m_name;
        $student->present_address = $request->pres_address;
        $student->permanent_address = $request->perm_address;
        $student->personal_phone = $request->s_phone;
        $student->father_phone = $request->f_phone;
        $student->mother_phone = $request->m_phone;
        $student->class = $request->class;
        $student->section = $request->section;
        $student->group = $request->group;
        $student->institute = $request->institute;
        $student->dob = $request->dob;
        $student->blood_group = $request->blood_group;
        $student->monthly_fee = $request->fee;

        //generating the Student ID
        $lastStudent = Student::where('class',$request->class)->orderBy('created_at','desc')->first();
        $id=null;
        if($lastStudent) {//if previous student exists of this class
            $lastId = $lastStudent->id;
            $idSerial = (int)substr($lastId, 7)+1;
            if($idSerial<10) {
                if($request->class <10) {
                    $id = 'S'.date('Y').'0'.$request->class.'0'.$idSerial;
                }else {
                    $id = 'S'.date('Y').$request->class.'0'.$idSerial;
                }
            }else {
                if($request->class <10) {
                    $id = 'S'.date('Y').'0'.$request->class.$idSerial;
                }else {
                    $id = 'S'.date('Y').$request->class.$idSerial;
                }
            }
        }else {//if no previous student exists of this class
            $idSerial = 1;
            if($request->class <10) {
                $id = 'S'.date('Y').'0'.$request->class.'0'.$idSerial;
            }else {
                $id = 'S'.date('Y').$request->class.'0'.$idSerial;
            }
        }

        $student->id = $id;

        //file Upload
        if($request->hasFile('photo')) {
            $request->file('photo')->storeAs('public/photos',$id);
            $student->photo = $id;
        }


        if($student->save()) {
            return redirect()->route('students.index',['students'=>Student::all()])
                ->with('success','The student was added successfully with ID "'.$id.'"');
        }

        return back()->withInput()->with('errors','Problem with adding a new student');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
        $student = Student::find($student->id);
        return view('student.show',['student'=>$student]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
        $classes = Classes::all();
        $sections = Section::all();
        return view('student.edit',['student'=>$student, 'classes'=>$classes, 'sections'=>$sections]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //

        $request->validate([
            'photo'=>'image|nullable|max:2048'
        ]);

        $student = Student::find($student->id);
        $student->name = $request->s_name;
        $student->father_name = $request->f_name;
        $student->mother_name = $request->m_name;
        $student->present_address = $request->pres_address;
        $student->permanent_address = $request->perm_address;
        $student->personal_phone = $request->s_phone;
        $student->father_phone = $request->f_phone;
        $student->mother_phone = $request->m_phone;
        $student->class = $request->class;
        $student->section = $request->section;
        $student->group = $request->group;
        $student->institute = $request->institute;
        $student->dob = $request->dob;
        $student->blood_group = $request->blood_group;
        $student->monthly_fee = $request->fee;

        //file Upload
        if($request->hasFile('photo')) {
            $request->file('photo')->storeAs('public/photos',$student->id);
            $student->photo = $student->id;
        }


        if($student->save()) {
            return redirect()->route('students.show',['student'=>$student])
                ->with('success','The student was updated successfully');
        }

        return back()->withInput()->with('errors','Problem with updating the student, Please Try again');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
        //$student = Student::find($student->id);
        if($student->delete()) {
            return redirect()->route('students.index')->with('success','The student was deleted successfully');
        }

        return back()->withInput()->with('errors','Problem with deleting the student');
    }

    public function showFees(Student $student) {
        $students = Student::orderBy('class','desc')->get();
        return view('fees',['students'=>$students]);
    }
}
