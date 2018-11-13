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
        $student = new Student();
        $student->name = $request->s_name;
        $student->father_name = $request->f_name;
        $student->mother_name = $request->m_name;
        $student->present_address = $request->pres_name;
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

        $lastStudent = Student::where('class',$request->class)->orderBy('created_at','desc')->first();
        $id=null;
        if($lastStudent) {
            $lastId = $lastStudent->id;
            $idSerial = (int)substr($lastId, 6)+1;
            if($idSerial<10) {
                if($request->class <10) {
                    $id = date('Y').'0'.$request->class.'0'.$idSerial;
                }else {
                    $id = date('Y').$request->class.'0'.$idSerial;
                }
            }else {
                if($request->class <10) {
                    $id = date('Y').'0'.$request->class.$idSerial;
                }else {
                    $id = date('Y').$request->class.$idSerial;
                }
            }
        }else {
            $idSerial = 1;
            if($idSerial<10) {
                if($request->class <10) {
                    $id = date('Y').'0'.$request->class.'0'.$idSerial;
                }else {
                    $id = date('Y').$request->class.'0'.$idSerial;
                }
            }else {
                if($request->class <10) {
                    $id = date('Y').'0'.$request->class.$idSerial;
                }else {
                    $id = date('Y').$request->class.$idSerial;
                }
            }
        }

        $student->id = $id;

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
    }

    public function showFees(Student $student) {
        $students = Student::all();
        return view('fees',['students'=>$students]);
    }
}
