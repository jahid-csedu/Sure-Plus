<?php

namespace SurePlus\Http\Controllers;

use SurePlus\Payment;
use SurePlus\Student;
use SurePlus\Account;
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
                return redirect()->route('payments.index')->with('success', 'Payment information added successfully');
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
     * @param  \SurePlus\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SurePlus\Payment  $payment
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
     * @param  \SurePlus\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SurePlus\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
        if($payment->delete()) {
            return redirect()->route('payments.index')->with('success','The payment record was deleted successfully');
        }

        return back()->withInput()->with('errors','Problem with deleting the payment record');
    }

    public function searchPayment(Request $request) {
        $searchType = $request->searchType;
        if($searchType==="Search By Student ID") {
            $studentId = $request->student_id;
            $student = Student::find($studentId);
            if($student) {
                $payments = Payment::where('student_id', $studentId)->orderBy('date')->get();
                return view('payments.index', ['payments'=>$payments]);
            }else {
                return redirect()->route('payments.index')->with('errors','No Student found with this ID');
            }
        }else if($searchType==="Search By Date") {
            $fromDate = $request->from_date;
            $toDate = $request->to_date;

            $hasPayment = Payment::whereBetween('date', array($fromDate, $toDate))->first();
            if($hasPayment) {
                $payments = Payment::whereBetween('date', array($fromDate, $toDate))->orderBy('date')->get();
                return view('payments.index',['payments'=>$payments]);
            }else {
                return redirect()->route('payments.index')->with('errors','No Payment Record Found');
            }
        }
    }
}
