<?php

namespace SurePlus\Http\Controllers;

use SurePlus\Student;
use SurePlus\Classes;
use SurePlus\Section;
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
        $classes = Classes::all();
        $sections = Section::all();
        return view('student.index',['students'=>$students, 'classes'=>$classes, 'sections'=>$sections]);
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
        return view('student.create',['classes'=>$classes]);
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
            's_name' => 'required|string|max:255',
            'f_name' => 'required|string|max:255',
            'm_name' => 'required|string|max:255',
            'pres_address' => 'nullable|string|max:255',
            'perm_address' => 'nullable|string|max:255',
            'personal_phone' => 'nullable|string|max:11',
            'father_phone' => 'nullable|string|max:11',
            'mother_phone' => 'nullable|string|max:11',
            'class' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'institute' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'fee' => 'required|integer'
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
        $classObject = Classes::where('name',$request->class)->first();
        $class = $classObject->class;
        $lastStudent = Student::where('class',$request->class)->orderBy('created_at','desc')->first();
        $id=null;
        if($lastStudent) {//if previous student exists of this class
            $lastId = $lastStudent->id;
            $idSerial = (int)substr($lastId, 8)+1;
            if($idSerial<10) {
                if($class <10) {
                    $id = '10'.date('Y').'0'.$class.'0'.$idSerial;
                }else {
                    $id = '10'.date('Y').$class.'0'.$idSerial;
                }
            }else {
                if($class <10) {
                    $id = '10'.date('Y').'0'.$class.$idSerial;
                }else {
                    $id = '10'.date('Y').$class.$idSerial;
                }
            }
        }else {//if no previous student exists of this class
            $idSerial = 1;
            if($class <10) {
                $id = '10'.date('Y').'0'.$class.'0'.$idSerial;
            }else {
                $id = '10'.date('Y').$class.'0'.$idSerial;
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
     * @param  \SurePlus\Student  $student
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
     * @param  \SurePlus\Student  $student
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
     * @param  \SurePlus\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
        $request->validate([
            's_name' => 'required|string|max:255',
            'f_name' => 'required|string|max:255',
            'm_name' => 'required|string|max:255',
            'pres_address' => 'nullable|string|max:255',
            'perm_address' => 'nullable|string|max:255',
            'personal_phone' => 'nullable|string|max:11',
            'father_phone' => 'nullable|string|max:11',
            'mother_phone' => 'nullable|string|max:11',
            'class' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'institute' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'fee' => 'required|integer'
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
     * @param  \SurePlus\Student  $student
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

    public function showFees() {
        $students = Student::orderBy('class','desc')->get();
        $classes = Classes::all();
        $sections = Section::all();
        return view('fees.multiple_student_fees',['students'=>$students, 'classes'=>$classes, 'sections'=>$sections]);
    }

    public function searchFees(Request $request) {
        $searchType = $request->searchType;
        if($searchType==="Search By Student ID") {
            $studentId = $request->student_id;
            $student = Student::find($studentId);
            if($student) {
                $classes = Classes::all();
                $sections = Section::all();
                return view('fees.single_student_fees',['student'=>$student, 'classes'=>$classes, 'sections'=>$sections]);
            }else {
                $students = Student::orderBy('class','desc')->get();
                $classes = Classes::all();
                $sections = Section::all();
                return view('fees.multiple_student_fees',['students'=>$students, 'classes'=>$classes, 'sections'=>$sections]);
            }
        }else if($searchType==="Search By Class") {
            $class = $request->class;
            $section = $request->section;
            if($section==="All") {
                $hasStudent = Student::where('class', $class)->get()->first();
                if($hasStudent) {
                    $students = Student::where('class', $class)->get();
                    $classes = Classes::all();
                    $sections = Section::all();
                    return view('fees.multiple_student_fees',['students'=>$students, 'classes'=>$classes, 'sections'=>$sections]);
                }else {
                    $students = Student::orderBy('class','desc')->get();
                    $classes = Classes::all();
                    $sections = Section::all();
                    return view('fees.multiple_student_fees',['students'=>$students, 'classes'=>$classes, 'sections'=>$sections]);
                }
            }else {
                $hasStudent = Student::where(['class'=>$class, 'section'=>$section])->get()->first();
                if($hasStudent) {
                    $students = Student::where(['class'=>$class, 'section'=>$section])->get();
                    $classes = Classes::all();
                    $sections = Section::all();
                    return view('fees.multiple_student_fees',['students'=>$students, 'classes'=>$classes, 'sections'=>$sections]);
                }else {
                    $students = Student::orderBy('class','desc')->get();
                    $classes = Classes::all();
                    $sections = Section::all();
                    return view('fees.multiple_student_fees',['students'=>$students, 'classes'=>$classes, 'sections'=>$sections]);
                }
            }
        }
    }

    public function searchStudents(Request $request) {
        $searchType = $request->searchType;
        if($searchType==="Search By Student ID") {
            $studentId = $request->student_id;
            $student = Student::find($studentId);
            if($student) {
                return redirect()->route('students.show', $student);
            }else {
                return redirect()->route('students.index')->with('errors','No Student found with this ID');
            }
        }else if($searchType==="Search By Class") {
            $class = $request->class;
            $section = $request->section;
            if($section==="All"){
                $hasStudent = Student::where('class', $class)->get()->first();
                if($hasStudent) {
                    $students = Student::where('class', $class)->get();
                    $classes = Classes::all();
                    $sections = Section::all();
                    return view('student.index',['students'=>$students, 'classes'=>$classes, 'sections'=>$sections]);
                }else {
                    return redirect()->route('students.index')->with('errors','No Student found');
                }
            }else {
                $hasStudent = Student::where(['class'=>$class, 'section'=>$section])->get()->first();
                if($hasStudent) {
                    $students = Student::where(['class'=>$class, 'section'=>$section])->get();
                    $classes = Classes::all();
                    $sections = Section::all();
                    return view('student.index',['students'=>$students, 'classes'=>$classes, 'sections'=>$sections]);
                }else {
                    return redirect()->route('students.index')->with('errors','No Student found');
                }
            }
        }
    }

}
