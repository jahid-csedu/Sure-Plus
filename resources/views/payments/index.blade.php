@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-sm-auto py-3">
            <div class="card">
                <center class="card-header justify-content-center">
                    <a class="btn btn-success mx-2 pull-left col-md-5" href="payments/create">Add A New Payment Information</a>
                    <a class="btn btn-primary mx-2 pull-right col-md-5" href="#">Search Previous Payments</a>
                </center>

                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Sl No.</th>
                          <th scope="col">Date</th>
                          <th scope="col">Student ID</th>
                          <th scope="col">Student Name</th>
                          <th scope="col">Payment Type</th>
                          <th scope="col">Amount</th>
                          <th scope="col">Actions</th>
                      </thead>
                      <tbody>
                        @foreach($payments as $serial=>$payment)
                            <tr>
                              <th scope="row">{{ $serial+1 }}</th>
                              <td>{{ $payment->date }}</td>
                              <td>{{ $payment->student_id }}</td>
                              <td>{{ $payment->student->name }}</td>
                              <td>{{ $payment->type }}</td>
                              <td>{{ $payment->amount }}</td>
                              <td>
                                <form method="POST" action="{{ route('payments.destroy', $payment->id) }}">
                                  @csrf
                                  @method('DELETE')
                                  <a class="btn btn-info" href="{{ route('payments.edit', $payment->id) }}">Edit</a>
                                  <button type="submit" class="btn btn-danger mx-3">Delete</button>
                                </form>
                              </td>

                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
