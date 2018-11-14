@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-sm-auto py-3">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-primary btn-sm" href="sections/create">Add New</a>
                    </div>
                    <div class="d-flex justify-content-center">
                        <span class="text-uppercase font-weight-bold">All Sections</span>
                    </div>
                </div>

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

                              <!-- Modal -->
                              <div class="modal fade" id="delete{{ $section->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Delete Confirmation</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <h3>Are you sure you want to delete this student?</h3>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <!-- Delete Form -->
                                      <form method="POST" action="{{ route('sections.destroy', $section->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>

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
