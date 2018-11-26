<?php

namespace SurePlus\Http\Controllers;

use SurePlus\Result;
use SurePlus\Exam;
use SurePlus\Student;
use Illuminate\Http\Request;

class ResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('results.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Exam $exam)
    {
        //
        if($exam->section === "All"){
            $students = Student::where('class', $exam->class)->get();
        }else {
            $students = Student::where(['class'=> $exam->class, 'section'=>$exam->section])->get();
        }
        return view('results.create', ['exam'=>$exam, 'students'=>$students])->with('errors','Please Enter the results of the Students');
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
        $examId = $request->exam_id;

        $exam = Exam::find($examId);
        if($exam->section === "All"){
            $students = Student::where('class', $exam->class)->get();
        }else {
            $students = Student::where(['class'=> $exam->class, 'section'=>$exam->section])->get();
        }

        $status=null;
        foreach($students as $student) {
            $hasResult = Result::select('id')->where(['student_id'=>$student->id, 'exam_id'=>$examId])->get()->first();
            if($hasResult){
                $result = Result::find('$hasResult');
                $studentId = $student->id;
                $result->student_id = $studentId;
                $result->exam_id = $examId;
                $result->marks = $request->$studentId;

                if($result->save()) {
                    $status="ok";
                }else {
                    $status="error";
                }
            }else {
                $result = new Result();
                $studentId = $student->id;
                $result->student_id = $studentId;
                $result->exam_id = $examId;
                $result->marks = $request->$studentId;

                if($result->save()) {
                    $status="ok";
                }else {
                    $status="error";
                }
            }
        }

        if($status==="ok") {
            return redirect()->route('results.show', $examId)->with('success','The records updated successfully');
        }

        return back()->withInput()->with('errors','Problem with adding the results. Please try again');

    }

    /**
     * Display the specified resource.
     *
     * @param  \SurePlus\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function show($examId)
    {
        //
        $exam = Exam::find($examId);
        $results = Result::where('exam_id', $examId)->get();
        $highest = Result::where('exam_id', $examId)->max('marks');
        return view('results.show', ['results'=>$results, 'exam'=>$exam, 'highest'=>$highest]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SurePlus\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function edit(Result $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \SurePlus\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Result $result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SurePlus\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function destroy(Result $result)
    {
        //
    }

    public function showResult(Request $request) {
        $examId = $request->exam_id;

        $exam = Exam::find($examId);
        if($exam){

            $hasResult = Result::where('exam_id', $examId)->get()->first();

            if($hasResult){
                return redirect()->route('results.show', $examId);
            }else {
                return $this->create($exam);
            }
        }else {
            return back()->withInput()->with('errors',"The exam Code doesn't exist. Please Enter Exam code correctly");
        }
    }
}
