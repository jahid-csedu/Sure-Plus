@extends('layouts.template')

@section('content')
<div class="container py-3">
    <h2 class="text-center">
        Update An Existing Fees Type
    </h2>
    <hr>
    <form method="post" action="#">
        @csrf
        <input type="hidden" name="_method" value="put">
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="name" value={{ $feesType->name }}>Type Name<span class="required text-danger">*</span></label>
           <input placeholder="Enter Name"
                id="name"
                required
                name="name"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="class" value="{{ $feesType->description }}">Description</label>
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
