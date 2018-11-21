<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Classes;
use App\Section;
use Illuminate\Http\Request;

class ExamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $exams = Exam::orderBy('date','desc')->get();
        return view('exams.index', ['exams'=>$exams]);
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
        return view('exams.create', ['classes'=>$classes, 'sections'=>$sections]);
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
        $exam = new Exam();
        $exam->name = $request->name;
        $exam->class = $request->class;
        $exam->section = $request->section;
        $exam->subject = $request->subject;
        $exam->date = $request->date;
        $exam->total_marks = $request->total_marks;

        //Generating the Exam ID
        $lastExam = Exam::where('class',$request->class)->orderBy('created_at','desc')->first();
        $id=null;
        if($lastExam) {//if previous student exists of this class
            $lastId = $lastExam->id;
            $idSerial = (int)substr($lastId, 8)+1;
            if($idSerial<10) {
                if($request->class <10) {
                    $id = '20'.date('Y').'0'.$request->class.'0'.$idSerial;
                }else {
                    $id = '20'.date('Y').$request->class.'0'.$idSerial;
                }
            }else {
                if($request->class <10) {
                    $id = '20'.date('Y').'0'.$request->class.$idSerial;
                }else {
                    $id = '20'.date('Y').$request->class.$idSerial;
                }
            }
        }else {//if no previous student exists of this class
            $idSerial = 1;
            if($request->class <10) {
                $id = '20'.date('Y').'0'.$request->class.'0'.$idSerial;
            }else {
                $id = '20'.date('Y').$request->class.'0'.$idSerial;
            }
        }

        $exam->id = $id;

        if($exam->save()) {
            return redirect()->route('exams.index',['exams'=>Exam::orderBy('date')->get()])
                ->with('success','The exam was added successfully with ID "'.$id.'"');
        }

        return back()->withInput()->with('errors','Problem with adding a new exam');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        //
        $classes = Classes::all();
        $sections = Section::all();
        return view('exams.edit', ['classes'=>$classes, 'sections'=>$sections]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        //
        $exam = Exam::find($exam->id);
        $exam->name = $request->name;
        $exam->class = $request->class;
        $exam->section = $request->section;
        $exam->subject = $request->subject;
        $exam->date = $request->date;
        $exam->total_marks = $request->total_marks;

        if($exam->save()) {
            return redirect()->route('exams.index',['exams'=>Exam::orderBy('date')->get()])
                ->with('success','The exam was updated successfully');
        }

        return back()->withInput()->with('errors','Problem with updating the exam');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        //
        if($exam->delete()) {
            return redirect()->route('exams.index')->with('success','The exam was deleted successfully');
        }

        return back()->withInput()->with('errors','Problem with deleting the exam');
    }

}
