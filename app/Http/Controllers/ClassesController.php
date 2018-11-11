<?php

namespace App\Http\Controllers;

use App\Classes;
use Auth;
use DB;
use Illuminate\Http\Request;

class ClassesController extends Controller
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
            $classes = Classes::All();
            return view('classes.index',['classes' => $classes]);
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
            return view('classes.create');
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
            $classes = new Classes();
            $classes->name = $request->input('name');
            $classes->class = $request->input('class');
            $classes->description = $request->input('description');

            if($classes->save()) {
                $allClasses = Classes::all();
                return redirect()
                    ->route('classes.index',['classes' => $allClasses])
                    ->with('success','Class added successfully');
            }

            return back()
                ->withInput()
                ->with('errors','Problem with adding a new class');
        }

        return view('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function show(Classes $classes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function edit(Classes $classes)
    {
        //
        if(Auth::check()) {
            $classes = Classes::where('class',$classes->class);
            return view('classes.edit',['class'=>$classes]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classes $classes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classes $classes)
    {
        //
    }
}
