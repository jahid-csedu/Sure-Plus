@extends('layouts.template')

@section('content')
<div class="container py-3">
    <h2 class="text-center">
        Update Student Information
    </h2>
    <hr>
    <form method="post" action="/students/{{ $student->id }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="put">
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="s_name">Student's Name<span class="required text-danger">*</span></label>
           <input placeholder="Enter Student's Name"
                value="{{ $student->name }}" 
                id="s_name"
                required
                name="s_name"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="f_name">Father's Name<span class="required text-danger">*</span></label>
           <input placeholder="Enter Father's Name"
                value="{{ $student->father_name }}" 
                id="f_name"
                required
                name="f_name"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="m_name">Mother's Name<span class="required text-danger">*</span></label>
           <input placeholder="Enter Mother's Name"
                value="{{ $student->mother_name }}" 
                id="m_name"
                required
                name="m_name"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="pres_address">Present Address</label>
           <textarea placeholder="Enter Present Address"
                value="{{ $student->present_address }}" 
                id="pres_address"
                name="pres_address"
                rows="4"
                style="resize: vertical;" 
                spellcheck="false"
                class="form-control col-sm-9"
                ></textarea>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="perm_address">Permanent Address</label>
           <textarea placeholder="Enter Permanent Address"
                value="{{ $student->permanent_address }}" 
                id="perm_address"
                name="perm_address"
                rows="4"
                style="resize: vertical;" 
                spellcheck="false"
                class="form-control col-sm-9"
                ></textarea>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="s_phone">Student's Phone Number</label>
           <input placeholder="Enter Phone Number"
                value="{{ $student->personal_phone }}" 
                type="phone" 
                id="s_phone"
                name="s_phone"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="f_phone">Father's Phone Number</label>
           <input placeholder="Enter Phone Number"
                value="{{ $student->father_phone }}" 
                type="phone" 
                id="f_phone"
                name="f_phone"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="m_phone">Mother's Phone Number</label>
           <input placeholder="Enter Phone Number"
                value="{{ $student->mother_phone }}" 
                type="phone" 
                id="m_phone"
                name="m_phone"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="class">Class<span class="required text-danger">*</span></label>
            <select id="class" name="class" class="form-control col-sm-9" required>
                @foreach($classes as $class)
                    @if($class->class === $student->class)
                        <option selected>{{$class->class}}</option>
                    @else
                        <option>{{$class->class}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="class">Section</label>
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
                        <option>N/A</option>
                        <option selected>Science</option>
                        <option>Business Studies</option>
                        <option>Humanities</option>
                    @break
                    @case("Business Studies")
                        <option>N/A</option>
                        <option>Science</option>
                        <option selected>Business Studies</option>
                        <option>Humanities</option>
                    @break
                    @case("Humanities")
                        <option>N/A</option>
                        <option>Science</option>
                        <option>Business Studies</option>
                        <option selected>Humanities</option>
                    @break
                    @default
                        <option>N/A</option>
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
                        <option>N/A</option>
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
                        <option>N/A</option>
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
                        <option>N/A</option>
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
                        <option>N/A</option>
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
                        <option>N/A</option>
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
                        <option>N/A</option>
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
                        <option>N/A</option>
                        <option>A+</option>
                        <option>A-</option>
                        <option>B+</option>
                        <option>B-</option>
                        <option>AB+</option>
                        <option>AB-</option>
                        <option selected>O+</option>
                        <option>O-</option>
                    @break
                    @case("A+")
                        <option>N/A</option>
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
                        <option>N/A</option>
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
            <label class="col-sm-2 col-sm-label text-right" for="fee">Monthly Fee<span class="required text-danger">*</span></label>
            <input type="number" 
                placeholder="Enter Amount" 
                value="{{ $student->monthly_fee }}"
                required 
                id="fee"
                name="fee"
                spellcheck="false"
                class="form-control col-sm-9"
                />
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
        <div class="form-group text-center">
            <input type="reset" class="btn btn-danger mx-4" value="Cancel"/>
            <input type="submit" class="btn btn-primary mx-4" value="Submit"/>
        </div>
    </form>
</div>
@endsection
