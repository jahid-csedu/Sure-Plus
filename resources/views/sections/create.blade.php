@extends('layouts.template')

@section('content')
<div class="container py-3">
    <h2 class="text-center">
        Add A New Section
    </h2>
    <hr>
    <form method="post" action="{{ route('sections.store') }}">
        @csrf
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="name">Section Name<span class="required text-danger">*</span></label>
           <input placeholder="Enter Name"
                id="name"
                required
                name="name"
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
            <label class="col-sm-2 col-sm-label text-right" for="class">Shift<span class="required text-danger">*</span></label>
            <select id="shift" name="shift"class="form-control col-sm-9" required>
                <option>Morning</option>
                <option>Afternoon</option>
                <option>Evening</option>
            </select>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="class">Description</label>
            <input placeholder="Enter Description"
                id="description"
                name="description"
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
