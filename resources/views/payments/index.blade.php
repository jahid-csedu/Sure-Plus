@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-sm-auto py-3">
            <div class="card">
                <center class="card-header justify-content-center">
                    <a class="btn btn-success mx-2 pull-left col-md-5" href="payments/create">Add A New Payment Information</a>
                    <a class="btn btn-primary mx-2 pull-right col-md-5" href="#" data-toggle="modal" data-target="#searchModal">Search Previous Payments</a>
                </center>

                <div class="card-body">
                    <table id="payments" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Date</th>
                          <th scope="col">Student ID</th>
                          <th scope="col">Student Name</th>
                          <th scope="col">Payment Type</th>
                          <th scope="col">Month</th>
                          <th scope="col">Amount</th>
                      </thead>
                      <tbody>
                        @foreach($payments as $serial=>$payment)
                            <tr>
                              <td>{{ $payment->date }}</td>
                              <td>{{ $payment->student_id }}</td>
                              <td>{{ $payment->student->name }}</td>
                              <td>{{ $payment->type }}</td>
                              <td>{{ $payment->month."- ".$payment->year }}</td>
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
        if(document.getElementById('searchByStudent').checked) {
          $('.searchByStudentDiv').show();
          $('.searchByDateDiv').hide();
        }else if(document.getElementById('searchByDate').checked){
          $('.searchByStudentDiv').hide();
          $('.searchByDateDiv').show();
        }
        $('.searchType').change(function(){
            if(document.getElementById('searchByStudent').checked) {
              $('.searchByStudentDiv').slideDown();
              $('.searchByDateDiv').slideUp();
            }else if(document.getElementById('searchByDate').checked){
              $('.searchByStudentDiv').slideUp();
              $('.searchByDateDiv').slideDown();
            }
        });
      });
  </script>
@endsection
