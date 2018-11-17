<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employees = Employee::all();
        //dd($employees);
        return view('employees.index', ['employees'=>$employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('employees.create');
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
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->present_address = $request->present_address;
        $employee->permanent_address = $request->permanent_address;
        $employee->phone = $request->phone;
        $employee->designation = $request->designation;
        $employee->dob = $request->dob;
        $employee->blood_group = $request->blood_group;

        //Generating Employee ID
        $lastEmployee = Employee::orderBy('created_at','desc')->first();
        //dump((int)substr($lastEmployee->id,5));
        $id=null;
        if($lastEmployee) {
            $idNumber = (int)substr($lastEmployee->id,5)+1;
            if($idNumber<10) {
                $id = 'E'.Date('Y').'0'.$idNumber;
            }else {
                $id = 'E'.Date('Y').$idNumber;
            }
        }else {
            $idNumber=1;
            $id = 'E'.Date('Y').'0'.$idNumber;
        }

        $employee->id = $id;

        //Uploading Photo
        if($request->hasFile('photo')) {
            $request->file('photo')->storeAs('public/photos',$id);
            $employee->photo = $id;
        }


        if($employee->save()) {
            return redirect()->route('employees.index',['employees'=>Employee::all()])
                ->with('success','The employee was added successfully with ID "'.$id.'"');
        }

        return back()->withInput()->with('errors','Problem with adding a new employee');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
        $employee = Employee::find($employee->id);
        return view('employees.show', ['employee'=>$employee]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
        $employee = Employee::find($employee->id);
        return view('employees.edit', ['employee'=>$employee]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
        $employee = Employee::find($employee->id);
        $employee->name = $request->name;
        $employee->present_address = $request->present_address;
        $employee->permanent_address = $request->permanent_address;
        $employee->phone = $request->phone;
        $employee->designation = $request->designation;
        $employee->dob = $request->dob;
        $employee->blood_group = $request->blood_group;

        //Uploading Photo
        if($request->hasFile('photo')) {
            $request->file('photo')->storeAs('public/photos',$id);
            $employee->photo = $employee->id;
        }


        if($employee->save()) {
            return redirect()->route('employees.show',['employee'=>$employee])
                ->with('success','The employee was updated successfully');
        }

        return back()->withInput()->with('errors','Problem with updating the employee');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
        if($employee->delete()) {
            return redirect()->route('employees.index')->with('success','The employee was deleted successfully');
        }

        return back()->withInput()->with('errors','Problem with deleting the employee');
    }
}
