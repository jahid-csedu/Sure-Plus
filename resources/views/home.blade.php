@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-sm-auto py-3">

            <div class="col-md-3" style="float:left">
              <div class="card-counter primary">
                <i class="fa fa-users"></i>
                <span class="count-numbers">{{ $student }}</span>
                <span class="count-name">Students</span>
              </div>
            </div>

            <div class="col-md-3" style="float:left">
              <div class="card-counter danger">
                <i class="fa fa-user-tie"></i>
                <span class="count-numbers">{{ $employee }}</span>
                <span class="count-name">Staffs</span>
              </div>
            </div>

            <div class="col-md-3" style="float:left">
              <div class="card-counter success">
                <i class="fa fa-bell"></i>
                <span class="count-numbers">{{ $class }}</span>
                <span class="count-name">Classes</span>
              </div>
            </div>

            <div class="col-md-3" style="float:left">
              <div class="card-counter info">
                <i class="fa fa-book"></i>
                <span class="count-numbers">{{ $section }}</span>
                <span class="count-name">Batches</span>
              </div>
            </div>

        </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-lg-12 col-sm-auto py-3">
        <div class="card">
          <div class="card-header">
            <center>
              <h2>Payments Received in {{ Date('F')."- ".Date('Y') }}</h2>
            </center>
          </div>
          <div class="card-body">
            <table class="table table-striped table-bordered table-hover" id="payments">
              <thead>
                <tr>
                  <th scope="col">Student ID</th>
                  <th scope="col">Student Name</th>
                  <th scope="col">Class</th>
                  <th scope="col">Section</th>
                  <th scope="col">Date</th>
                  <th scope="col">Amount</th>
                </tr>
              </thead>
              <tbody>
                @foreach($payments as $serial=>$payment)
                    <tr>
                      <td>{{ $payment->student_id }}</td>
                      <td>{{ $payment->student->name }}</td>
                      <td>{{ $payment->student->class }}</td>
                      <td>{{ $payment->student->section }}</td>
                      <td>{{ $payment->date }}</td>
                      <td>{{ $payment->amount }}</td>
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
@section('scripts')
  <script type="text/javascript">
    $(document).ready(function() {
      $.noConflict();
      $('#payments').DataTable();
    });
  </script>
@endsection
