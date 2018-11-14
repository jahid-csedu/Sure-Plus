@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-sm-auto py-3">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="d-flex justify-content-center">
                        <span class="text-uppercase font-weight-bold">{{ $student->name }}</span>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th scope="col">ID</th>
                          <th scope="col">Name</th>
                          <th scope="col">Class</th>
                          <th scope="col">Section</th>
                        </tr>
                      </thead>
                      <tbody>
                          <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->class }}</td>
                            <td>{{ $student->section }}</td>
                          </tr>
                          @if($student->photo)
                            <tr>
                                <img src="/storage/photos/{{ $student->photo }}" style="max-width: 300px; height: auto;">
                            </tr>
                          @endif
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
