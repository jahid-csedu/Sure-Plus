@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-sm-auto py-3">
            <div class="card">
                <center class="card-header justify-content-center">
                    <a class="btn btn-success mx-2 pull-left col-md-5" href="payments/create">Add A New Payment Information</a>
                    <a class="btn btn-primary mx-2 pull-right col-md-5" href="#" data-toggle="modal" data-target="#searchModal">Search Previous Payments</a>
                </center>

                <div class="card-body">
                    <table id="payments" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Date</th>
                          <th scope="col">Student ID</th>
                          <th scope="col">Student Name</th>
                          <th scope="col">Payment Type</th>
                          <th scope="col">Month</th>
                          <th scope="col">Amount</th>
                          <th scope="col">Actions</th>
                      </thead>
                      <tbody>
                        @foreach($payments as $serial=>$payment)
                            <tr>
                              <td>{{ $payment->date }}</td>
                              <td>{{ $payment->student_id }}</td>
                              <td>{{ $payment->student->name }}</td>
                              <td>{{ $payment->type }}</td>
                              <td>{{ $payment->month."- ".$payment->year }}</td>
                              <td>{{ $payment->amount }}</td>
                              <td>
                                <a href="#" class="btn btn-danger btn-sm mx-3" data-toggle="modal" data-target="#deleteConfirmationModal{{ $payment->id }}">Delete</a>

                                  <!-- Delete Confirmation Modal -->
                                  <div class="modal fade" id="deleteConfirmationModal{{ $payment->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="deleteConfirmationModalLongTitle">Delete Confirmation</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <h3>Are you sure you want to delete this Payment?</h3>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <!-- Delete Form -->
                                          <form method="POST" action="{{ route('payments.destroy', $payment->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                              </td>

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
                <h5 class="modal-title">Search Payments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="post" action="/searchPayments">
                  @csrf
                  <div class="form-check form-check-inline">
                    <input class="form-check-input searchType" type="radio" name="searchType" id="searchByStudent" value="Search By Student ID" checked>
                    <label class="form-check-label" for="searchByClass">
                      Search By Student ID
                    </label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input searchType" type="radio" name="searchType" id="searchByDate" value="Search By Date">
                    <label class="form-check-label" for="searchByDate">
                      Search By Date
                    </label>
                  </div>
                  <div class="form-group row my-4 searchByDateDiv">
                      <label class="col-sm-2 col-sm-label text-right" for="from_date">From Date</label>
                      <input placeholder="MM\DD\YYYY"
                          type="date" 
                          id="from_date"
                          name="from_date"
                          spellcheck="false"
                          class="form-control col-sm-9"
                          />
                  </div>
                  <div class="form-group row my-4 searchByDateDiv">
                      <label class="col-sm-2 col-sm-label text-right" for="to_date">Upto Date</label>
                      <input placeholder="MM\DD\YYYY"
                          type="date" 
                          id="to_date"
                          name="to_date"
                          spellcheck="false"
                          class="form-control col-sm-9"
                          />
                  </div>
                  <div class="form-group row my-4 searchByStudentDiv">
                      <label class="col-sm-2 col-sm-label text-right" for="student_id">Student ID</label>
                      <input placeholder="Enter Student ID"
                          id="student_id"
                          name="student_id"
                          spellcheck="false"
                          class="form-control col-sm-9"
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
@section('scripts')
  <script type="text/javascript">
      $(document).ready(function() {
        $.noConflict();
        $('#payments').DataTable();
        if(document.getElementById('searchByStudent').checked) {
          $('.searchByStudentDiv').show();
          $('.searchByDateDiv').hide();
        }else if(document.getElementById('searchByDate').checked){
          $('.searchByStudentDiv').hide();
          $('.searchByDateDiv').show();
        }
        $('.searchType').change(function(){
            if(document.getElementById('searchByStudent').checked) {
              $('.searchByStudentDiv').slideDown();
              $('.searchByDateDiv').slideUp();
            }else if(document.getElementById('searchByDate').checked){
              $('.searchByStudentDiv').slideUp();
              $('.searchByDateDiv').slideDown();
            }
        });
      });
  </script>
@endsection
