@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-sm-auto py-3">
            <div class="card">
                <center class="card-header justify-content-center">
                    <a class="btn btn-success mx-2 pull-right col-md-5" href="/sections/create">Add New Section</a>
                </center>

                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Sl No.</th>
                          <th scope="col">Name</th>
                          <th scope="col">Class</th>
                          <th scope="col">Shift</th>
                          <th scope="col">Description</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($sections as $serial=>$section)
                            <tr>
                              <th scope="row">{{ $serial+1 }}</th>
                              <td>{{ $section->name }}</td>
                              <td>{{ $section->class }}</td>
                              <td>{{ $section->shift }}</td>
                              <td>{{ $section->description }}</td>
                              <td>
                                <form method="POST" action="{{ route('sections.destroy', $section->id) }}">
                                  @csrf
                                  @method('DELETE')
                                  <a class="btn btn-info btn-sm" href="{{ route('sections.edit', $section) }}">Edit</a>
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
