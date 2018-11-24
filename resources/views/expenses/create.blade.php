@extends('layouts.template')

@section('content')
<div class="container py-3">
    <h2 class="text-center">
        Add A New Expenditure Information
    </h2>
    <hr>
    <form method="post" action="{{ route('expenses.store') }}">
        @csrf
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="description">Description<span class="required text-danger">*</span></label>
            <textarea placeholder="Enter Description"
                value="{{ old('description') }}"
                required
                id="description"
                name="description"
                rows="3"
                style="resize: vertical;" 
                spellcheck="false"
                class="form-control col-sm-9"
                ></textarea>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="amount">Amount<span class="required text-danger">*</span></label>
            <input placeholder="Enter Amount"
                value="{{ old('amount') }}" 
                id="amount"
                type="number" 
                required
                name="amount"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="date">Date</label>
            <input placeholder="Enter Date"
                type="date" 
                value="{{ Date('Y-m-d') }}" 
                required 
                id="date"
                name="date"
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
