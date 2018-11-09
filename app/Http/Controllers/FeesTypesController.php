<?php

namespace App\Http\Controllers;

use App\FeesType;
use Auth;
use Illuminate\Http\Request;

class FeesTypesController extends Controller
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
            $feesTypes = FeesType::all();
            return view('feestype.index',['feesTypes'=>$feesTypes]);
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
            return view ('feestype.create');
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
            $feesType = new FeesType;
            $feesType->name = $request->name;
            $feesType->description = $request->description;

            if($feesType->save()) {
                $allFeesTypes = FeesType::all();
                return redirect()
                    ->route('feestype.index',['feesTypes' => $allFeesTypes])
                    ->with('success','Fees Type added successfully');
            }

            return back()
                ->withInput()
                ->with('errors','Problem with adding a new Fees Type');
        }

        return view('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FeesType  $feesType
     * @return \Illuminate\Http\Response
     */
    public function show(FeesType $feesType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FeesType  $feesType
     * @return \Illuminate\Http\Response
     */
    public function edit(FeesType $feesType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FeesType  $feesType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FeesType $feesType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FeesType  $feesType
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeesType $feesType)
    {
        //
    }
}
