@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-sm-auto py-3">
            <div class="card">
                <center class="card-header justify-content-center">
                    <a class="btn btn-success mx-2 pull-left col-md-5" href="exams/create">Add A New Exam</a>
                    <a class="btn btn-primary mx-2 pull-right col-md-5" href="#" data-toggle="modal" data-target="#searchModal">Search Existing Exams</a>
                </center>

                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Sl No.</th>
                          <th scope="col">ID</th>
                          <th scope="col">Name</th>
                          <th scope="col">Class</th>
                          <th scope="col">Section</th>
                          <th scope="col">Subject</th>
                          <th scope="col">Date</th>
                          <th scope="col">Total Marks</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($exams as $serial=>$exam)
                            <tr>
                              <th scope="row">{{ $serial+1 }}</th>
                              <td>{{ $exam->id }}</td>
                              <td>{{ $exam->name }}</td>
                              <td>{{ $exam->class }}</td>
                              <td>{{ $exam->section }}</td>
                              <td>{{ $exam->subject }}</td>
                              <td>{{ $exam->date }}</td>
                              <td>{{ $exam->total_marks }}</td>
                              <td>
                                <form method="POST" action="{{ route('exams.destroy', $exam->id) }}">
                                  @csrf
                                  @method('DELETE')
                                  <a class="btn btn-info btn-sm" href="{{ route('exams.edit', $exam->id) }}">Edit</a>
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

        <!-- Modal -->
        <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Search Exams</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="post" action="/searchExams">
                  @csrf
                  <div class="form-check form-check-inline">
                    <input class="form-check-input searchType" type="radio" name="searchType" id="searchByClass" value="Search By Class" checked>
                    <label class="form-check-label" for="searchByClass">
                      Search By Class
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
                  <div class="form-group row my-4 searchByClassDiv">
                      <label class="col-sm-2 col-sm-label text-right" for="class">Class</label>
                      <select id="class" name="class" class="form-control col-sm-9" required>
                          @foreach($classes as $class)
                              <option>{{$class->class}}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="form-group row searchByClassDiv">
                      <label class="col-sm-2 col-sm-label text-right" for="section">Section</label>
                      <select id="section" name="section" class="form-control col-sm-9" required>
                        <option>All</option>
                          @foreach($sections as $section)
                              <option>{{$section->name}}</option>
                          @endforeach
                      </select>
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
        if(document.getElementById('searchByDate').checked) {
          $('.searchByDateDiv').show();
          $('.searchByClassDiv').hide();
        }else if(document.getElementById('searchByClass').checked){
          $('.searchByDateDiv').hide();
          $('.searchByClassDiv').show();
        }
        $('.searchType').change(function(){
            if(document.getElementById('searchByDate').checked) {
              $('.searchByDateDiv').slideDown();
              $('.searchByClassDiv').slideUp();
            }else if(document.getElementById('searchByClass').checked){
              $('.searchByDateDiv').slideUp();
              $('.searchByClassDiv').slideDown();
            }
        });
      });
  </script>
@endsection
