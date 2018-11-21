@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-sm-auto py-3">
            <div class="card">
                <center class="card-header justify-content-center">
                    <a class="btn btn-primary mx-2 pull-right col-md-5" href="#">Search Fees</a>
                </center>

                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Sl No.</th>
                          <th scope="col">Student ID</th>
                          <th scope="col">Name</th>
                          <th scope="col">Class</th>
                          <th scope="col">Monthly Fee</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($students as $serial=>$student)
                            <tr>
                              <th scope="row">{{ $serial+1 }}</th>
                              <td>{{ $student->id }}</td>
                              <td>{{ $student->name }}</td>
                              <td>{{ $student->class }}</td>
                              <td>{{ $student->monthly_fee }}/=</td>
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
