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
                    <form method="post" action="{{ route('results.store') }}">
                        @csrf
                            <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                            @foreach($students as $student)
                                <div class="form-group row">
                                    <tr>
                                        <td>
                                            <label class="col-sm-3 col-sm-label font-weight-bold" for="{{$student->id}}">
                                                {{ $student->name . '('.$student->id.')' }}
                                            </label>
                                        </td>
                                        <input type="number" 
                                            value="0" 
                                            id="{{$student->id}}"
                                            required
                                            name="{{$student->id}}"
                                            spellcheck="false"
                                            class="form-control col-sm-9"
                                            />
                                    </tr>
                                </div>
                            @endforeach
                            <div class="form-group text-center">
                                <input type="reset" class="btn btn-danger mx-4" value="Cancel"/>
                                <input type="submit" class="btn btn-primary mx-4" value="Submit"/>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
