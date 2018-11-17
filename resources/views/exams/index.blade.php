@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-sm-auto py-3">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-primary btn-sm" href="exams/create">Add New</a>
                    </div>
                    <div class="d-flex justify-content-center">
                        <span class="text-uppercase font-weight-bold">All Exams</span>
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
                          <th scope="col">Subject</th>
                          <th scope="col">Date</th>
                          <th scope="col">Total Marks</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($exams as $serial=>$exam)
                            <tr>
                              <th scope="row">{{ $serial+1 }}</th>
                              <td>{{ $exam->id }}</td>
                              <td>{{ $exam->name }}</td>
                              <td>{{ $exam->class }}</td>
                              <td>{{ $exam->subject }}</td>
                              <td>{{ $exam->date }}</td>
                              <td>{{ $exam->total_marks }}</td>
                              <td>
                                <form method="POST" action="{{ route('exams.destroy', $exam->id) }}">
                                  @csrf
                                  @method('DELETE')
                                  <a class="btn btn-info" href="{{ route('exams.edit', $exam->id) }}">Edit</a>
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
