@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-sm-auto py-3">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="d-flex justify-content-center">
                        <span class="text-uppercase font-weight-bold" style="font-size: 20px;">{{ $employee->name }}</span>
                    </div>
                </div>

                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-9 pull-left px-2">                    
                      <table class="table table-striped table-hover">
                        <tbody style="font-size: 18px; font-weight: bold">
                            <tr>
                              <td>Employee ID</td>
                              <td>{{ $employee->id }}</td>
                            </tr>
                            <tr>
                              <td>Present Address</td>
                              <td>{{ $employee->present_address }}</td>
                            </tr>
                            <tr>
                              <td>Permanent Address</td>
                              <td>{{ $employee->permanent_address }}</td>
                            </tr>
                            <tr>
                              <td>Phone Number</td>
                              <td>{{ $employee->phone }}</td>
                            </tr>
                            <tr>
                              <td>Designation</td>
                              <td>{{ $employee->designation }}</td>
                            </tr>
                            <tr>
                              <td>Date of Birth</td>
                              <td>{{ $employee->dob }}</td>
                            </tr>
                            <tr>
                              <td>Blood Group</td>
                              <td>{{ $employee->blood_group }}</td>
                            </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3 pull-right">
                      @if($employee->photo)
                        <img class="img-rounded img-fluid img-thumbnail" src="/storage/photos/{{ $employee->id }}" alt="{{ $employee->name }}" style="max-width: 100%; height: auto">
                      @else
                        <img class="img-rounded img-fluid img-thumbnail" src="/storage/photos/employee.jpg" alt="{{ $employee->name }}" style="max-width: 100%; height: auto">
                      @endif

                      <a class="btn btn-info my-3" href="{{ route('employees.edit', $employee) }}" style="width: 100%; height: 40px"><span style="color:white; font-size: 18px">Edit</span></a>
                      <a class="btn btn-danger my-2" href="#" style="width: 100%; height: 40px"><span style="color:white; font-size: 18px" data-toggle="modal" data-target="#deleteConfirmationModal">Delete</span></a>

                      <!-- Modal -->
                      <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="deleteConfirmationModalLongTitle">Delete Confirmation</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <h3>Are you sure you want to delete this employee?</h3>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <!-- Delete Form -->
                              <form method="POST" action="{{ route('employees.destroy', $employee->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
