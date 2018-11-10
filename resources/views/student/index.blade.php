@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-sm-auto py-3">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-primary btn-sm" href="students/create">Add New</a>
                    </div>
                    <div class="d-flex justify-content-center">
                        <span class="text-uppercase font-weight-bold">All Students</span>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Sl No.</th>
                          <th scope="col">ID</th>
                          <th scope="col">Name</th>
                          <th scope="col">Class</th>
                          <th scope="col">Shift</th>
                          <th scope="col">Section</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($students as $serial=>$student)
                            <tr>
                              <th scope="row">{{ $serial+1 }}</th>
                              <td>{{ $student->name }}</td>
                              <td>{{ $student->class }}</td>
                              <td>{{ $student->shift }}</td>
                              <td>{{ $student->section }}</td>
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
