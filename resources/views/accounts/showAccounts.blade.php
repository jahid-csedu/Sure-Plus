@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-sm-auto py-3">
            <div class="card">
                <center class="card-header justify-content-center">
                    <h1>Date Wise Account Query Information</h1>
                </center>

                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Sl No.</th>
                          <th scope="col">Date</th>
                          <th scope="col">Description</th>
                          <th scope="col">Debit</th>
                          <th scope="col">Credit</th>
                      </thead>
                      <tbody>
                        @foreach($accounts as $serial=>$account)
                            <tr>
                              <th scope="row">{{ $serial+1 }}</th>
                              <td>{{ $account->date }}</td>
                              <td>{{ $account->description }}</td>
                              <td>{{ $account->debit }}</td>
                              <td>{{ $account->credit }}</td>
                            </tr>
                        @endforeach
                        <tr class="font-weight-bold bg-warning">
                            <th scope="row"></th>
                            <td></td>
                            <td>Total</td>
                            <td>{{ $totalDebit }}</td>
                            <td>{{ $totalCredit }}</td>
                        </tr>
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
