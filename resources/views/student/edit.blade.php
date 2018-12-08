@extends('layouts.template')

@section('content')
<div class="container py-3">
    <h2 class="text-center">
        Update Student Information
    </h2>
    <hr>
    <form method="post" action="/students/{{ $student->id }}" enctype="multipart/form-data">
        @csrf
        <center><h2 class="text-primary">Personal Information</h2></center>
        <hr>
        <input type="hidden" name="_method" value="put">
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="name">Student's Name<span class="required text-danger">*</span></label>
           <input placeholder="Enter Student's Name"
                value="{{ $student->name }}" 
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
                value="{{ $student->father_name }}" 
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
                value="{{ $student->mother_name }}" 
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
                value="{{ $student->present_address }}" 
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
                value="{{ $student->permanent_address }}" 
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
                value="{{ $student->dob }}" 
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
                @switch($student->blood_group)
                    @case("A+")
                        <option value="">N/A</option>
                        <option selected>A+</option>
                        <option>A-</option>
                        <option>B+</option>
                        <option>B-</option>
                        <option>AB+</option>
                        <option>AB-</option>
                        <option>O+</option>
                        <option>O-</option>
                    @break
                    @case("A-")
                        <option value="">N/A</option>
                        <option>A+</option>
                        <option selected>A-</option>
                        <option>B+</option>
                        <option>B-</option>
                        <option>AB+</option>
                        <option>AB-</option>
                        <option>O+</option>
                        <option>O-</option>
                    @break
                    @case("B+")
                        <option value="">N/A</option>
                        <option>A+</option>
                        <option>A-</option>
                        <option selected>B+</option>
                        <option>B-</option>
                        <option>AB+</option>
                        <option>AB-</option>
                        <option>O+</option>
                        <option>O-</option>
                    @break
                    @case("B-")
                        <option value="">N/A</option>
                        <option>A+</option>
                        <option>A-</option>
                        <option>B+</option>
                        <option selected>B-</option>
                        <option>AB+</option>
                        <option>AB-</option>
                        <option>O+</option>
                        <option>O-</option>
                    @break
                    @case("AB+")
                        <option value="">N/A</option>
                        <option>A+</option>
                        <option>A-</option>
                        <option>B+</option>
                        <option>B-</option>
                        <option selected>AB+</option>
                        <option>AB-</option>
                        <option>O+</option>
                        <option>O-</option>
                    @break
                    @case("AB-")
                        <option value="">N/A</option>
                        <option>A+</option>
                        <option>A-</option>
                        <option>B+</option>
                        <option>B-</option>
                        <option>AB+</option>
                        <option selected>AB-</option>
                        <option>O+</option>
                        <option>O-</option>
                    @break
                    @case("O+")
                        <option value="">N/A</option>
                        <option>A+</option>
                        <option>A-</option>
                        <option>B+</option>
                        <option>B-</option>
                        <option>AB+</option>
                        <option>AB-</option>
                        <option selected>O+</option>
                        <option>O-</option>
                    @break
                    @case("O-")
                        <option value="">N/A</option>
                        <option>A+</option>
                        <option>A-</option>
                        <option>B+</option>
                        <option>B-</option>
                        <option>AB+</option>
                        <option>AB-</option>
                        <option>O+</option>
                        <option selected>O-</option>
                    @break
                    @default
                        <option value="">N/A</option>
                        <option>A+</option>
                        <option>A-</option>
                        <option>B+</option>
                        <option>B-</option>
                        <option>AB+</option>
                        <option>AB-</option>
                        <option>O+</option>
                        <option>O-</option>
                @endswitch
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
                value="{{ $student->student_phone }}" 
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
                value="{{ $student->father_phone }}" 
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
                value="{{ $student->mother_phone }}" 
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
                value="{{ $student->academic_year }}" 
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
                    @if($student->class === $class->name)
                        <option selected>{{$class->name}}</option>
                    @else
                        <option>{{$class->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="section">Section</label>
            <select id="section" name="section" class="form-control col-sm-9" required>
                @foreach($sections as $section)
                    @if($section->name === $student->section)
                        <option selected>{{$section->name}}</option>
                    @else
                        <option>{{$section->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="group">Group</label>
            <select id="group" name="group" class="form-control col-sm-9">
                @switch($student->group)
                    @case("Science")
                        <option value="">N/A</option>
                        <option selected>Science</option>
                        <option>Business Studies</option>
                        <option>Humanities</option>
                    @break
                    @case("Business Studies")
                        <option value="">N/A</option>
                        <option>Science</option>
                        <option selected>Business Studies</option>
                        <option>Humanities</option>
                    @break
                    @case("Humanities")
                        <option value="">N/A</option>
                        <option>Science</option>
                        <option>Business Studies</option>
                        <option selected>Humanities</option>
                    @break
                    @default
                        <option value="">N/A</option>
                        <option>Science</option>
                        <option>Business Studies</option>
                        <option>Humanities</option>
                @endswitch
            </select>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="institute">Institute<span class="required text-danger">*</span></label>
           <input placeholder="Enter Institute Name"
                value="{{ $student->institute }}" 
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
                value="{{ $student->monthly_fee }}"
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
                   }
                });
            });
        });
    </script>
@endsection
