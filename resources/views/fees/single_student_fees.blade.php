@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-sm-auto py-3">
            <div class="card">
                <center class="card-header justify-content-center">
                    <a class="btn btn-primary mx-2 pull-right col-md-5" href="#" data-toggle="modal" data-target="#searchModal">Search Fees</a>
                </center>

                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Student ID</th>
                          <th scope="col">Name</th>
                          <th scope="col">Class</th>
                          <th scope="col">Monthly Fee</th>
                        </tr>
                      </thead>
                      <tbody>
                          <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->class }}</td>
                            <td>{{ $student->monthly_fee }}/=</td>
                          </tr>
                      </tbody>
                    </table>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Search Fees</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form method="post" action="/searchFees">
                      @csrf
                      <div class="form-check form-check-inline">
                        <input class="form-check-input searchType" type="radio" name="searchType" id="searchByStudent" value="Search By Student ID" checked>
                        <label class="form-check-label" for="searchByStudent">
                          Search By Student ID
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input searchType" type="radio" name="searchType" id="searchByClass" value="Search By Class">
                        <label class="form-check-label" for="searchByClass">
                          Search By Class
                        </label>
                      </div>
                      <div class="form-group row my-4 searchByStudentDiv">
                        <label class="col-sm-2 col-sm-label text-right" for="student_id">Student ID</label>
                         <input placeholder="Enter Student ID"
                              id="student_id"
                              name="student_id"
                              spellcheck="false"
                              class="form-control col-sm-9 mx-3"
                              />
                      </div>
                      <div class="form-group row my-4 searchByClassDiv">
                          <label class="col-sm-2 col-sm-label text-right" for="class">Class</label>
                          <select id="class" name="class" class="form-control col-sm-9" required>
                              @foreach($classes as $class)
                                  <option>{{$class->name}}</option>
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
</div>
@endsection
@section('scripts')
  <script type="text/javascript">
      $(document).ready(function() {
        $.noConflict();
        $('#fees').DataTable();
        if(document.getElementById('searchByStudent').checked) {
          $('.searchByStudentDiv').show();
          $('.searchByClassDiv').hide();
        }else if(document.getElementById('searchByClass').checked){
          $('.searchByStudentDiv').hide();
          $('.searchByClassDiv').show();
        }
        $('.searchType').change(function(){
            if(document.getElementById('searchByStudent').checked) {
              $('.searchByStudentDiv').slideDown();
              $('.searchByClassDiv').slideUp();
            }else if(document.getElementById('searchByClass').checked){
              $('.searchByStudentDiv').slideUp();
              $('.searchByClassDiv').slideDown();
            }
        });
        $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $.ajax({
               type:'GET',
               url:'/getSections',
               data:{class:$('#class').val()},
               success:function(sections){
                  var options="<option>All</option>";
                  for(var i=0; i<sections.length; i++) {
                    options += "<option>"+sections[i].name+"</option>";
                  }
                  document.getElementById('section').innerHTML=options;
               }
            });
            $('#class').change(function() {
                $.ajax({
                   type:'GET',
                   url:'/getSections',
                   data:{class:this.value},
                   success:function(sections){
                      var options="<option>All</option>";
                      for(var i=0; i<sections.length; i++) {
                        options += "<option>"+sections[i].name+"</option>";
                      }
                      document.getElementById('section').innerHTML=options;
                   }
                });
            });
      });
  </script>
@endsection
