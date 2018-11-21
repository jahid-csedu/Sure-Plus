<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Student;
use App\Account;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $payments = Payment::orderBy('date', 'desc')->get();
        return view('payments.index', ['payments'=>$payments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('payments.create');
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
        $studentId = $request->student_id;
        if(Student::find($studentId)) {
            $payment = new Payment();
            $payment->student_id = $studentId;
            $payment->type = $request->type;
            if($request->type === 'Monthly Fee') {
                $payment->month = $request->month;
                $payment->year = $request->year;
            }
            $payment->description = $request->description;
            $payment->amount = $request->amount;
            $payment->date = $request->date;

            if($payment->save()) {
                $account = new Account();
                if($request->type === 'Monthly Fee') {
                    $account->description = "Payment Received of Student ".$studentId."(".$request->month."-".$request->year.")";
                }else {
                    $account->description = "Payment Received of Student ".$studentId."(".$request->type."-".$request->description.")";
                }
                $account->debit = 0;
                $account->credit = $request->amount;
                $account->date = $request->date;
                $account->save();
                return redirect()->route('payments.create')->with('success', 'Payment information added successfully');
            }else {
                return redirect()->back()->withInput()->with('errors','Could not added payment information. Please try again');
            }
        }else {
            return redirect()->back()->withInput()->with('errors', 'The student ID does not exist. Please enter a valid student ID');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
