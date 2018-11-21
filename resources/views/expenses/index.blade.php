@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-sm-auto py-3">
            <div class="card">
                <center class="card-header justify-content-center">
                    <a class="btn btn-success mx-2 pull-left col-md-5" href="expenses/create">Add A New Expense Information</a>
                    <a class="btn btn-primary mx-2 pull-right col-md-5" href="#">Search Previous Expenses</a>
                </center>

                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Sl No.</th>
                          <th scope="col">Date</th>
                          <th scope="col">Description</th>
                          <th scope="col">Amount</th>
                          <th scope="col">Actions</th>
                      </thead>
                      <tbody>
                        @foreach($expenses as $serial=>$expense)
                            <tr>
                              <th scope="row">{{ $serial+1 }}</th>
                              <td>{{ $expense->date }}</td>
                              <td>{{ $expense->description }}</td>
                              <td>{{ $expense->amount }}</td>
                              <td>
                                <form method="POST" action="{{ route('expenses.destroy', $expense->id) }}">
                                  @csrf
                                  @method('DELETE')
                                  <a class="btn btn-info btn-sm" href="{{ route('expenses.edit', $expense->id) }}">Edit</a>
                                  <button type="submit" class="btn btn-danger btn-sm mx-3">Delete</button>
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
