@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-sm-auto py-3">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="d-flex justify-content-center">
                        <span class="text-uppercase font-weight-bold" style="font-size: 20px;">{{ $student->name }}</span>
                    </div>
                </div>

                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-9 pull-left px-2">                    
                      <table class="table table-striped table-hover">
                        <tbody style="font-size: 18px; font-weight: bold">
                            <tr>
                              <td>Student ID</td>
                              <td>{{ $student->id }}</td>
                            </tr>
                            <tr>
                              <td>Father's Name</td>
                              <td>{{ $student->father_name }}</td>
                            </tr>
                            <tr>
                              <td>Mother's Name</td>
                              <td>{{ $student->mother_name }}</td>
                            </tr>
                            <tr>
                              <td>Present Address</td>
                              <td>{{ $student->present_address }}</td>
                            </tr>
                            <tr>
                              <td>Permanent Address</td>
                              <td>{{ $student->permanent_address }}</td>
                            </tr>
                            <tr>
                              <td>Student's Phone Number</td>
                              <td>{{ $student->student_phone }}</td>
                            </tr>
                            <tr>
                              <td>Father's Phone Number</td>
                              <td>{{ $student->father_phone }}</td>
                            </tr>
                            <tr>
                              <td>Mother's Phone Number</td>
                              <td>{{ $student->mother_phone }}</td>
                            </tr>
                            <tr>
                              <td>Academic Year</td>
                              <td>{{ $student->academic_year }}</td>
                            </tr>
                            <tr>
                              <td>Class</td>
                              <td>{{ $student->class }}</td>
                            </tr>
                            <tr>
                              <td>Section</td>
                              <td>{{ $student->section }}</td>
                            </tr>
                            <tr>
                              <td>Group</td>
                              <td>{{ $student->group }}</td>
                            </tr>
                            <tr>
                              <td>Institute</td>
                              <td>{{ $student->institute }}</td>
                            </tr>
                            <tr>
                              <td>Date of Birth</td>
                              <td>{{ $student->dob }}</td>
                            </tr>
                            <tr>
                              <td>Blood Group</td>
                              <td>{{ $student->blood_group }}</td>
                            </tr>
                            <tr>
                              <td>Monthly Fee</td>
                              <td>{{ $student->monthly_fee }}</td>
                            </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3 pull-right">
                      @if($student->photo)
                        <img class="img-rounded img-fluid img-thumbnail" src="/storage/photos/{{ $student->id }}" alt="{{ $student->name }}" style="max-width: 100%; height: auto">
                      @else
                        <img class="img-rounded img-fluid img-thumbnail" src="/storage/photos/student.png" alt="{{ $student->name }}" style="max-width: 100%; height: auto">
                      @endif

                      <a class="btn btn-info my-3" href="{{ route('students.edit', $student) }}" style="width: 100%; height: 40px"><span style="color:white; font-size: 18px">Edit</span></a>
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
                              <h3>Are you sure you want to delete this student?</h3>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <!-- Delete Form -->
                              <form method="POST" action="{{ route('students.destroy', $student->id) }}">
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
