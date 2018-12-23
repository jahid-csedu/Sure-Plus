<?php

namespace SurePlus\Http\Controllers;

use SurePlus\Payment;
use SurePlus\Student;
use SurePlus\Transaction;
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
        $request->validate([
            'student_id' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'amount' => 'required|integer',
            'date' => 'required|date'
        ]);

        $studentId = $request->student_id;
        $student = Student::find($studentId);
        if($student) {
            $transactionDetail = null;

            $trx = Transaction::select('id')->orderBy('created_at', 'desc')->first();
            if($trx) {
              $trxId = $trx->id+1;
            }else {
              $trxId = 1;
            }

            $payment = new Payment();
            $payment->trx_id = $trxId;
            $payment->student_id = $studentId;
            $payment->type = $request->type;
            if($request->type === 'Monthly Fee') {
                $payment->month = $request->month;
                $payment->year = $request->year;
                $transactionDetail = "Payment Collected from ".$student->name."(Class: ".$student->class.", ID: ".$student->id.") of the month ".$request->month."-".$request->year;
            }else if($request->type === 'Admission Fee') {
                $transactionDetail = "Admission Fee Collected from ".$student->name."(Class: ".$student->class.", ID: ".$student->id.")";
            }else if($request->type === 'Model Test Fee') {
                $transactionDetail = "Model Test Fee Collected from ".$student->name."(Class: ".$student->class.", ID: ".$student->id.")";
            }
            else {
                $transactionDetail = $request->description;
            }
            $payment->description = $transactionDetail;
            $payment->amount = $request->amount;
            $payment->date = $request->date;

            if($payment->save()) {
              //Add a record in transaction table
                $transaction = new Transaction();
                $transaction->id = $trxId;
                $transaction->date = $request->date;
                $transaction->description = $transactionDetail;
                $transaction->debit = $request->amount;
                $transaction->save();
                return redirect()->route('payments.index')->with('success', 'Payment information added successfully');
            }else {
                return redirect()->back()->withInput()->with('errors','Could not add payment information. Please try again');
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
        return view('payments.edit', ['payment'=>$payment]);
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
        $request->validate([
            'student_id' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'amount' => 'required|integer',
            'date' => 'required|date'
        ]);

        $studentId = $request->student_id;
        $student = Student::find($studentId);
        if($student) {
            $payment = Payment::find($payment->id);
            $payment->student_id = $studentId;
            $payment->type = $request->type;
            $description = null;
            if($request->type === 'Monthly Fee') {
                $payment->month = $request->month;
                $payment->year = $request->year;
                $description = "Payment Collected from ".$student->name."(Class: ".$student->class.", ID: ".$student->id.") of the month ".$request->month."-".$request->year;
            }else if($request->type === 'Admission Fee') {
                $description = "Admission Fee Collected from ".$student->name."(Class: ".$student->class.", ID: ".$student->id.")";
                if($request->description !== "") {
                    $description .= "---".$request->description;
                }
            }else if($request->type === 'Model Test Fee') {
                $description = "Model Test Fee Collected from ".$student->name."(Class: ".$student->class.", ID: ".$student->id.")";
                if($request->description !== "") {
                    $description .= "---".$request->description;
                }
            }
            else {
                $description = $request->description;
            }
            $payment->description = $description;
            $payment->amount = $request->amount;
            $payment->date = $request->date;

            if($payment->save()) {
                return redirect()->route('payments.index')->with('success', 'Payment information updated successfully');
            }else {
                return redirect()->back()->withInput()->with('errors','Could not update payment information. Please try again');
            }
        }else {
            return redirect()->back()->withInput()->with('errors', 'The student ID does not exist. Please enter a valid student ID');
        }
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
