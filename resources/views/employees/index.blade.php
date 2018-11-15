@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-sm-auto py-3">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-primary btn-sm" href="employees/create">Add New</a>
                    </div>
                    <div class="d-flex justify-content-center">
                        <span class="text-uppercase font-weight-bold">All Employees</span>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Sl No.</th>
                          <th scope="col">ID</th>
                          <th scope="col">Name</th>
                          <th scope="col">Designation</th>
                          <th scope="col">Phone Number</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($employees as $serial=>$employee)
                            <tr data-href=>
                              <th scope="row">{{ $serial+1 }}</th>
                              <td>{{ $employee->id }}</td>
                              <td>{{ $employee->name }}</td>
                              <td>{{ $employee->designation }}</td>
                              <td>{{ $employee->phone }}</td>
                              <td><a class="btn btn-info btn-sm" href="/employees/{{ $employee->id }}">Show Details</a></td>
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
