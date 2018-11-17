@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-sm-auto py-3">
            <div class="card">
                <div class="card-header">
                  <form method="GET" action="/showResult">
                    <div class="input-group mb-3">
                      <input type="text" name="exam_id" class="form-control" placeholder="Enter Exam Code" aria-label="Enter Exam Code" aria-describedby="basic-addon2" required>
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Show Results</button>
                      </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
