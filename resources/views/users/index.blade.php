@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-sm-auto py-3">
            <div class="card">
                <center class="card-header justify-content-center">
                    <a class="btn btn-success mx-2 pull-right col-md-5" href="/users/create">Add New User</a>
                </center>

                <div class="card-body">
                    <table id="sections" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Name</th>
                          <th scope="col">User ID</th>
                          <th scope="col">Email</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($users as $serial=>$user)
                            <tr>
                              <td>{{ $user->name }}</td>
                              <td>{{ $user->user_id }}</td>
                              <td>{{ $user->email }}</td>
                              <td>
                                  <a href="#" class="btn btn-danger btn-sm mx-3" data-toggle="modal" data-target="#deleteConfirmationModal{{ $user->id }}">Delete</a>

                                  <!-- Delete Confirmation Modal -->
                                  <div class="modal fade" id="deleteConfirmationModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="deleteConfirmationModalLongTitle">Delete Confirmation</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <h3>Are you sure you want to delete this User?</h3>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <!-- Delete Form -->
                                          <form method="POST" action="{{ route('users.destroy', $user->id) }}">
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
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
      $.noConflict();
      $('#sections').DataTable();
    });
</script>
@endsection
