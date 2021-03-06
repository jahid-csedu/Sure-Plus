@extends('layouts.template')

@section('content')
<div class="container py-3">
    <h2 class="text-center">
        Account Query Information
    </h2>
    <hr>
    <form method="get" action="/showAccount">
        @csrf
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="from_date">From Date<span class="required text-danger">*</span></label>
           <input placeholder="MM/DD/YYYY"
                type="date" 
                id="from_date"
                required
                name="from_date"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="to_date">To Date<span class="required text-danger">*</span></label>
           <input placeholder="MM/DD/YYYY"
                type="date" 
                id="to_date"
                required
                name="to_date"
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
