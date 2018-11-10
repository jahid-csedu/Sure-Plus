@extends('layouts.template')

@section('content')
<div class="container py-3">
    <h2 class="text-center">
        Add A New Fee
    </h2>
    <hr>
    <form method="post" action="{{ route('fees.store') }}">
        @csrf
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="name">Student ID<span class="required text-danger">*</span></label>
           <input placeholder="Enter Student ID"
                id="s_id"
                required
                name="s_id"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        @foreach($feesTypes as $feesType)
            <div class="form-group row">
                <label class="col-sm-2 col-sm-label text-right" for="class">{{ $feesType->name }}</label>
                <input type="number" value="0" id="{{ $feesType->id }}" name="{{ $feesType->id }}" class="form-control col-sm-9"/>
            </div>
        @endforeach
        <div class="form-group text-center">
            <input type="reset" class="btn btn-danger mx-4" value="Cancel"/>
            <input type="submit" class="btn btn-primary mx-4" value="Submit"/>
        </div>
    </form>
</div>
@endsection
