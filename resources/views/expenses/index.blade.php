@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-sm-auto py-3">
            <div class="card">
                <center class="card-header justify-content-center">
                    <a class="btn btn-success mx-2 pull-left col-md-5" href="expenses/create">Add A New Expense Information</a>
                    <a class="btn btn-primary mx-2 pull-right col-md-5" href="#" data-toggle="modal" data-target="#searchModal">Search Previous Expenses</a>
                </center>

                <div class="card-body">
                    <table id="expenses" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Date</th>
                          <th scope="col">Description</th>
                          <th scope="col">Amount</th>
                          <th scope="col">Actions</th>
                      </thead>
                      <tbody>
                        @foreach($expenses as $serial=>$expense)
                            <tr>
                              <td>{{ $expense->date }}</td>
                              <td>{{ $expense->description }}</td>
                              <td>{{ $expense->amount }}</td>
                              <td>
                                <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-info btn-sm mx-3">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm mx-3" data-toggle="modal" data-target="#deleteConfirmationModal{{ $expense->id }}">Delete</a>

                                  <!-- Delete Confirmation Modal -->
                                  <div class="modal fade" id="deleteConfirmationModal{{ $expense->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="deleteConfirmationModalLongTitle">Delete Confirmation</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <h3>Are you sure you want to delete this Expense?</h3>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <!-- Delete Form -->
                                          <form method="POST" action="{{ route('expenses.destroy', $expense->id) }}">
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
                <h5 class="modal-title">Search Expenses</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="post" action="/searchExpenses">
                  @csrf
                  <div class="form-group row my-4">
                      <label class="col-sm-2 col-sm-label text-right" for="from_date">From Date</label>
                      <input placeholder="MM\DD\YYYY"
                          type="date" 
                          id="from_date"
                          name="from_date"
                          spellcheck="false"
                          class="form-control col-sm-9"
                          />
                  </div>
                  <div class="form-group row my-4">
                      <label class="col-sm-2 col-sm-label text-right" for="to_date">Upto Date</label>
                      <input placeholder="MM\DD\YYYY"
                          type="date" 
                          id="to_date"
                          name="to_date"
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
      $('#expenses').DataTable();
    });
</script>
@endsection
