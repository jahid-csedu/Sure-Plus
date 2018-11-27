<?php

namespace SurePlus\Http\Controllers;

use SurePlus\Classes;
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
            $request->validate([
                'name' => 'required|string|max:255',
                'class' => 'required|integer',
                'description' => 'nullable'
            ]);
            $class = new Classes();
            $class->name = $request->name;
            $class->class = $request->class;
            $class->description = $request->description;

            if($class->save()) {
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
     * @param  \SurePlus\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function show(Classes $classes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SurePlus\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function edit(Classes $class)
    {
        //
        $class = Classes::find($class->id);
        return view('classes.edit',['class'=>$class]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \SurePlus\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classes $class)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|integer',
            'description' => 'nullable'
        ]);
        $class = Classes::find($class->id);
        $class->name = $request->name;
        $class->class = $request->class;
        $class->description = $request->description;

        if($class->save()) {
            $allClasses = Classes::all();
            return redirect()
                ->route('classes.index',['classes' => $allClasses])
                ->with('success','Class updated successfully');
        }

        return back()
            ->withInput()
            ->with('errors','Problem with updating the class');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SurePlus\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classes $class)
    {
        //
        if($class->delete()) {
            return redirect()->route('classes.index')->with('success','The class was deleted successfully');
        }

        return back()->with('errors','Problem with deleting the class');
    }
}
