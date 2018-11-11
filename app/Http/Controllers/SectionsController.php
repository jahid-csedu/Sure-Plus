<?php

namespace App\Http\Controllers;

use App\Section;
use App\Classes;
use Auth;
use DB;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::check()) {
            $sections = DB::table('sections')->get();
            return view('sections.index',['sections'=>$sections]);
        }
        return view('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(Auth::check()) {
            $classes = DB::table('classes')->get();
            return view('sections.create',['classes'=>$classes]);
        }

        return view('/');
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
        if(Auth::check()) {
            $section = new Section();
            $section->name = $request->name;
            $section->class = $request->class;
            $section->shift = $request->shift;
            $section->description = $request->description;

            if($section->save()) {
                $allSections = DB::table('sections')->get();
                return redirect()
                    ->route('sections.index',['sections' => $allSections])
                    ->with('success','Section added successfully');
            }

            return back()
                ->withInput()
                ->with('errors','Problem with adding a new Section');
        }

        return view('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        //
    }
}
