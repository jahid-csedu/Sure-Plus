<?php

namespace SurePlus\Http\Controllers;

use SurePlus\Employee;
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
        $request->validate([
            'name' => 'required|string|max:255',
            'present_address' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
            'phone' => 'required|regex:/(01)[0-9]{9}/',
            'designation' => 'required|string|max:255',
            'blood_group' => ['nullable', 'regex:/(A|B|AB|O)[+-]/'],
            'dob' => 'nullable|date'
        ]);
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
            $idNumber = (int)substr($lastEmployee->id,3)+1;
            if($idNumber<10) {
                $id = '2'.Date('y').'0'.$idNumber;
            }else {
                $id = '2'.Date('y').$idNumber;
            }
        }else {
            $idNumber=1;
            $id = '2'.Date('y').'0'.$idNumber;
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
     * @param  \SurePlus\Employee  $employee
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
     * @param  \SurePlus\Employee  $employee
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
     * @param  \SurePlus\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'present_address' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
            'phone' => 'required|regex:/(01)[0-9]{9}/',
            'designation' => 'required|string|max:255',
            'blood_group' => ['nullable', 'regex:/(A|B|AB|O)[+-]/'],
            'dob' => 'nullable|date'
        ]);
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
            $request->file('photo')->storeAs('public/photos',$employee->id);
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
     * @param  \SurePlus\Employee  $employee
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

    public function searchEmployee(Request $request) {
        $employeeId = $request->employee_id;
        $employee = Employee::find($employeeId);
        if($employee) {
            return redirect()->route('employees.show', $employee);
        }else {
            return redirect()->route('employees.index')->with('errors','No Employee found with this ID');
        }
    }
}
