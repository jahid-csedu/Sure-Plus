@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-sm-auto py-3">
            <div class="card">
                <center class="card-header justify-content-center">
                    <a class="btn btn-success mx-2 pull-left col-md-5" href="expenses/create">Add A New Expense Information</a>
                    <a class="btn btn-primary mx-2 pull-right col-md-5" href="#" data-toggle="modal" data-target="#searchModal">Search Previous Expenses</a>
                </center>

                <div class="card-body">
                    <table id="expenses" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Date</th>
                          <th scope="col">Description</th>
                          <th scope="col">Amount</th>
                      </thead>
                      <tbody>
                        @foreach($expenses as $serial=>$expense)
                            <tr>
                              <td>{{ $expense->date }}</td>
                              <td>{{ $expense->description }}</td>
                              <td>{{ $expense->amount }}</td>
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
      $('#expenses').DataTable();
    });
</script>
@endsection
