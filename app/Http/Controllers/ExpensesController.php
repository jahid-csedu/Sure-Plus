<?php

namespace SurePlus\Http\Controllers;

use SurePlus\Expense;
use SurePlus\Account;
use SurePlus\Employee;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $expenses = Expense::orderBy('date', 'desc')->get();
        return view('expenses.index', ['expenses'=>$expenses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('expenses.create');
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
            'type' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'amount' => 'required|integer',
            'date' => 'required|date',
        ]);

        $employeeId = $request->employee_id;
        $month = $request->month;
        $year = $request->year;
        $description = $request->description;
        $amount = $request->amount;
        $date = $request->date;

        $expense = new Expense();
        $expense->type = $request->type;
        if($request->type === 'Salary') {
            $employee = Employee::where('id', $employeeId)->first();
            if($employee){
              $expense->employee_id = $employeeId;
              $expense->month = $month;
              $expense->year = $year;
              $expense->description = "Salary given to ".$employee->name."(".$employee->designation.") of the month ".$month."-".$year;
            }else{
              return redirect()->back()->withInput()->with('errors', 'Please enter a valid employee ID');
            }
        }else if($request->type === 'House Rent') {
            $expense->month = $month;
            $expense->year = $year;
            $expense->description = "House Rent paid of the month ".$month."-".$year;
        }else if($request->type === 'Bill'){
            $expense->month = $month;
            $expense->year = $year;
            $expense->description = "Commodity Bill paid of the month ".$month."-".$year;
        }else{
            if($request->description == null){
              return redirect()->back()->withInput()->with('errors', 'Please enter a proper description');
            }
            $expense->description = $request->description;
        }
        $expense->amount = $request->amount;
        $expense->date = $request->date;
        if($expense->save()) {
            return redirect()->route('expenses.index')->with('success', 'The Expense information added successfully');
        }else {
            return redirect()->back()->withInput()->with('errors', 'Problem with adding the Expense information, Please try again');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \SurePlus\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SurePlus\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
        return view('expenses.edit', ['expense'=>$expense]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \SurePlus\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        //
        $request->validate([
            'type' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'amount' => 'required|integer',
            'date' => 'required|date',
        ]);

        $employeeId = $request->employee_id;
        $month = $request->month;
        $year = $request->year;
        $description = $request->description;
        $amount = $request->amount;
        $date = $request->date;

        $expense = Expense::find($expense->id);
        $expense->type = $request->type;
        if($request->type === 'Salary') {
            $employee = Teacher::where('id', $employeeId)->first();
            if($employee){
              $expense->employee_id = $employeeId;
              $expense->month = $month;
              $expense->year = $year;
              $expense->description = "Salary given to ".$employee->name."(".$employee->designation.") of the month ".$month."-".$year;
            }else{
              return redirect()->back()->withInput()->with('errors', 'Please enter a valid employee ID');
            }
        }else if($request->type === 'House Rent') {
            $expense->month = $month;
            $expense->year = $year;
            $expense->description = "House Rent paid of the month ".$month."-".$year;
        }else if($request->type === 'Bill'){
            $expense->month = $month;
            $expense->year = $year;
            $expense->description = "Commodity Bill paid of the month ".$month."-".$year;
        }else{
            if($request->description == null){
              return redirect()->back()->withInput()->with('errors', 'Please enter a proper description');
            }
            $expense->description = $request->description;
        }
        $expense->amount = $request->amount;
        $expense->date = $request->date;
        if($expense->save()) {
            return redirect()->route('expenses.index')->with('success', 'The Expense information updated successfully');
        }else {
            return redirect()->back()->withInput()->with('errors', 'Problem with updating the Expense information, Please try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SurePlus\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        //
        if($expense->delete()) {
            return redirect()->route('expenses.index')->with('success','The expense record was deleted successfully');
        }

        return back()->withInput()->with('errors','Problem with deleting the expense record');
    }

    public function searchExpense(Request $request) {
        $fromDate = $request->from_date;
        $toDate = $request->to_date;

        $hasExpense = Expense::whereBetween('date', array($fromDate, $toDate))->first();
        if($hasExpense) {
            $expenses = Expense::whereBetween('date', array($fromDate, $toDate))->orderBy('date')->get();
            return view('expenses.index',['expenses'=>$expenses]);
        }else {
            return redirect()->route('expenses.index')->with('errors','No Expense Record Found');
        }
    }
}
