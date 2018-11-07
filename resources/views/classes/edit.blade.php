@extends('layouts.template')

@section('content')
<div class="container py-3">
    <h2 class="text-center">
        Add a new class
    </h2>
    <hr>
    <form method="post" action="{{ route('classes.update',[$class]) }}">
        @csrf
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="name">Class Name<span class="required">*</span></label>
           <input placeholder="Enter Name"
                id="name"
                value="{{ $class->name }}" 
                required
                name="name"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="class">Class<span class="required">*</span></label>
            <input placeholder="Enter Class"
                id="class"
                value="{{ $class->class }}" 
                required
                name="class"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="class">Description (Optional)</label>
            <input placeholder="Enter Description"
                id="description"
                value="{{ $classes->description }}" 
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
