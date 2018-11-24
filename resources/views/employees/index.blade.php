@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-sm-auto py-3">
            <div class="card">
                <center class="card-header justify-content-center">
                    <a class="btn btn-success mx-2 pull-left col-md-5" href="employees/create">Add A New Employee</a>
                    <a class="btn btn-primary mx-2 pull-right col-md-5" href="#" data-toggle="modal" data-target="#searchModal">Search An Existing Employee</a>
                </center>

                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Sl No.</th>
                          <th scope="col">ID</th>
                          <th scope="col">Name</th>
                          <th scope="col">Designation</th>
                          <th scope="col">Phone Number</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($employees as $serial=>$employee)
                            <tr data-href=>
                              <th scope="row">{{ $serial+1 }}</th>
                              <td>{{ $employee->id }}</td>
                              <td>{{ $employee->name }}</td>
                              <td>{{ $employee->designation }}</td>
                              <td>{{ $employee->phone }}</td>
                              <td><a class="btn btn-info btn-sm" href="/employees/{{ $employee->id }}">Show Details</a></td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Search Employees</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="post" action="/searchEmployees">
                  @csrf
                  <div class="form-group row my-4">
                      <label class="col-sm-2 col-sm-label text-right" for="employee_id">Employee ID</label>
                     <input placeholder="Enter Employee ID"
                          id="employee_id"
                          name="employee_id"
                          spellcheck="false"
                          class="form-control col-sm-9 mx-3"
                          />
                  </div>
                  <div class="form-group text-center">
                      <input type="reset" class="btn btn-danger mx-4" value="Cancel"/>
                      <input type="submit" class="btn btn-primary mx-4" value="Submit"/>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <!-- End Modal-->

    </div>
</div>
@endsection
