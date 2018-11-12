@extends('layouts.template')

@section('content')
<div class="container py-3">
    <h2 class="text-center">
        Add A New Student
    </h2>
    <hr>
    <form method="post" action="{{ route('students.store') }}">
        @csrf
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="s_name">Student's Name<span class="required text-danger">*</span></label>
           <input placeholder="Enter Student's Name"
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
                    <option>{{$class->class}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="class">Section</label>
            <select id="section" name="section" class="form-control col-sm-9" required>
                @foreach($sections as $section)
                    <option>{{$section->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="group">Group</label>
            <select id="group" name="group" class="form-control col-sm-9">
                <option>N/A</option>
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
                <option>N/A</option>
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
            <label class="col-sm-2 col-sm-label text-right" for="dob">Monthly Fee<span class="required text-danger">*</span></label>
            <input type="number" 
                placeholder="Enter Amount" 
                value="0"
                required 
                id="fee"
                name="fee"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="dob">Photo</label>
            <input type="file" 
                accept=".jpg, .jpeg, .png" 
                id="dob"
                name="dob"
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
