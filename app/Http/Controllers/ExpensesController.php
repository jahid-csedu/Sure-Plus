<?php

namespace SurePlus\Http\Controllers;

use SurePlus\Expense;
use SurePlus\Account;
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
            'description' => 'required|string|max:255',
            'amount' => 'required|integer',
            'date' => 'required|date',
        ]);

        $expense = new Expense();
        $expense->description = $request->description;
        $expense->amount = $request->amount;
        $expense->date = $request->date;
        if($expense->save()) {
            $account = new Account();
            $account->description = $request->description;
            $account->debit = $request->amount;
            $account->credit = 0;
            $account->date = $request->date;
            $account->save();
            return redirect()->route('expenses.index')->with('success', 'The information added successfully');
        }else {
            return redirect()->back()->withInput()->with('errors', 'Problem with adding the information, Please try again');
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
