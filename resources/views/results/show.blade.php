@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-sm-auto py-3">
            <div class="card">
                <div class="card-header">
                  <form method="GET" action="/showResult">
                    <div class="input-group mb-3">
                      <input type="text" 
                        value="{{ $exam->id }}" 
                        name="exam_id" 
                        class="form-control"
                        placeholder="Enter Exam Code" 
                        aria-label="Enter Exam Code" 
                        aria-describedby="basic-addon2" 
                        required>
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Show Results</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-12 px-2">                    
                      <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                          <th scope="col">Sl No.</th>
                          <th scope="col">Student ID</th>
                          <th scope="col">Student Name</th>
                          <th scope="col">Obtained Marks</th>
                          <th scope="col">Percentile Marks</th>
                          <th scope="col">Highest Marks</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($results as $serial=>$result)
                            <tr>
                              <th scope="row">{{ $serial+1 }}</th>
                              <td>{{ $result->student_id }}</td>
                              <td>{{ $result->student->name }}</td>
                              <td>{{ $result->marks }}</td>
                              <td>{{ number_format(($result->marks/$exam->total_marks)*100, 2)."%" }}</td>
                              <td>{{ $highest }}</td>
                            </tr>
                        @endforeach
                      </tbody>
                      </table>
                    </div>                         
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
