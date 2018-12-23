<?php

namespace SurePlus\Http\Controllers;

use SurePlus\Expense;
use SurePlus\Account;
use SurePlus\Employee;
use SurePlus\Transaction;
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
        $transactionDetail = null;

        $trx = Transaction::select('id')->orderBy('created_at', 'desc')->first();
        if($trx) {
          $trxId = $trx->id+1;
        }else {
          $trxId = 1;
        }

        $expense = new Expense();
        $expense->trx_id = $trxId;
        $expense->type = $request->type;
        if($request->type === 'Salary') {
            $employee = Employee::where('id', $employeeId)->first();
            if($employee){
              $expense->employee_id = $employeeId;
              $expense->month = $month;
              $expense->year = $year;
              $transactionDetail = "Salary given to ".$employee->name."(".$employee->designation.") of the month ".$month."-".$year;
            }else{
              return redirect()->back()->withInput()->with('errors', 'Please enter a valid employee ID');
            }
        }else if($request->type === 'House Rent') {
            $expense->month = $month;
            $expense->year = $year;
            $transactionDetail = "House Rent paid of the month ".$month."-".$year;
        }else if($request->type === 'Bill'){
            $expense->month = $month;
            $expense->year = $year;
            $transactionDetail = "Commodity Bill paid of the month ".$month."-".$year;
        }else{
            if($request->description == null){
              return redirect()->back()->withInput()->with('errors', 'Please enter a proper description');
            }
            $transactionDetail = $description;
        }
        $expense->description = $transactionDetail;
        $expense->amount = $request->amount;
        $expense->date = $request->date;
        if($expense->save()) {
          //Add a record in transaction table
            $transaction = new Transaction();
            $transaction->id = $trxId;
            $transaction->date = $date;
            $transaction->description = $transactionDetail;
            $transaction->debit = $amount;
            $transaction->save();

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
