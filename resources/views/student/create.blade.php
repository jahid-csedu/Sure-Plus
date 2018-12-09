@extends('layouts.template')

@section('content')
<div class="container py-3">
    <h1 class="text-center">
        Add A New Student
    </h1>
    <hr>
    <form method="post" action="{{ route('students.store') }}" enctype="multipart/form-data">
        @csrf
        <center><h2 class="text-primary">Personal Information</h2></center>
        <hr>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="name">Student's Name<span class="required text-danger">*</span></label>
           <input placeholder="Enter Student's Name"
                id="name"
                required
                name="name"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="father_name">Father's Name<span class="required text-danger">*</span></label>
           <input placeholder="Enter Father's Name"
                id="father_name"
                required
                name="father_name"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="mother_name">Mother's Name<span class="required text-danger">*</span></label>
           <input placeholder="Enter Mother's Name"
                id="mother_name"
                required
                name="mother_name"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="present_address">Present Address</label>
           <textarea placeholder="Enter Present Address"
                id="present_address"
                name="present_address"
                rows="4"
                style="resize: vertical;" 
                spellcheck="false"
                class="form-control col-sm-9"
                ></textarea>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="permanent_address">Permanent Address</label>
           <textarea placeholder="Enter Permanent Address"
                id="permanent_address"
                name="permanent_address"
                rows="4"
                style="resize: vertical;" 
                spellcheck="false"
                class="form-control col-sm-9"
                ></textarea>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="dob">Date of Birth</label>
            <input placeholder="mm/dd/yyyy"
                type="date" 
                id="dob"
                name="dob"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="blood_group">Blood Group</label>
            <select id="blood_group" name="blood_group" class="form-control col-sm-9">
                <option value="">N/A</option>
                <option>A+</option>
                <option>A-</option>
                <option>B+</option>
                <option>B-</option>
                <option>AB+</option>
                <option>AB-</option>
                <option>O+</option>
                <option>O-</option>
            </select>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="photo">Photo</label>
            <input type="file" 
                accept=".jpg, .jpeg, .png" 
                id="photo"
                name="photo"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <center><h2 class="text-primary">Contact Information</h2></center>
        <hr>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="student_phone">Student's Phone Number</label>
           <input placeholder="Enter Phone Number"
                type="phone" 
                id="student_phone"
                name="student_phone"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="father_phone">Father's Phone Number</label>
           <input placeholder="Enter Phone Number"
                type="phone" 
                id="father_phone"
                name="father_phone"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="mother_phone">Mother's Phone Number</label>
           <input placeholder="Enter Phone Number"
                type="phone" 
                id="mother_phone"
                name="mother_phone"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <center><h2 class="text-primary">Academic Information</h2></center>
        <hr>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="academic_year">Academic Year</label>
           <input type="number" 
                value="{{ Date('Y') }}" 
                id="academic_year"
                name="academic_year"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="class">Class<span class="required text-danger">*</span></label>
            <select id="class" name="class" class="form-control col-sm-9" required>
                @foreach($classes as $class)
                    <option>{{$class->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="section">Section</label>
            <select id="section" name="section" class="form-control col-sm-9" required>
               <option value="">Section</option> 
            </select>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="group">Group</label>
            <select id="group" name="group" class="form-control col-sm-9">
                <option value="">N/A</option>
                <option>Science</option>
                <option>Business Studies</option>
                <option>Humanities</option>
            </select>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="institute">Institute<span class="required text-danger">*</span></label>
           <input placeholder="Enter Institute Name"
                id="institute"
                required
                name="institute"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="monthly_fee">Monthly Fee<span class="required text-danger">*</span></label>
            <input type="number" 
                placeholder="Enter Amount" 
                value="0"
                required 
                id="monthly_fee"
                name="monthly_fee"
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
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
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
                  var options="";
                  for(var i=0; i<sections.length; i++) {
                    options += "<option>"+sections[i].name+"</option>";
                  }
                  document.getElementById('section').innerHTML=options;
                  document.getElementById('section').selectedIndex=-1;
               }
            });
            $('#class').change(function() {
                $.ajax({
                   type:'GET',
                   url:'/getSections',
                   data:{class:this.value},
                   success:function(sections){
                      var options="";
                      for(var i=0; i<sections.length; i++) {
                        options += "<option>"+sections[i].name+"</option>";
                      }
                      document.getElementById('section').innerHTML=options;
                      document.getElementById('section').selectedIndex=-1;
                   }
                });
            });
        });
    </script>
@endsection
