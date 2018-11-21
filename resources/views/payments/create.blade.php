@extends('layouts.template')

@section('content')
<div class="container py-3">
    <h2 class="text-center">
        Add A New Payment
    </h2>
    <hr>
    <form method="post" action="{{ route('payments.store') }}">
        @csrf
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="student_id">Student ID<span class="required text-danger">*</span></label>
           <input placeholder="Enter ID"
                value="{{ old('student_id') }}"
                id="student_id"
                required
                name="student_id"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="type">Payment Type<span class="required text-danger">*</span></label>
            <select id="type" name="type" class="form-control col-sm-9" required>
                <option value="Monthly Fee">Monthly Fee</option>
                <option value="Admission Fee">Admission Fee</option>
                <option value="Model Test Fee">Model Test Fee</option>
                <option value="Others">Others</option>
            </select>
        </div>
        <div class="form-group row monthly">
            <label class="col-sm-2 col-sm-label text-right" for="month">Month</label>
            <select id="month" name="month" class="form-control col-sm-9">
                <option>January</option>
                <option>February</option>
                <option>March</option>
                <option>April</option>
                <option>May</option>
                <option>June</option>
                <option>July</option>
                <option>August</option>
                <option>September</option>
                <option>October</option>
                <option>November</option>
                <option>December</option>
            </select>
        </div>
        <div class="form-group row monthly">
            <label class="col-sm-2 col-sm-label text-right" for="year">Year</label>
            <select id="year" name="year" class="form-control col-sm-9">
                <option>{{ Date('Y') }}</option>
                <option>{{ Date('Y')-1 }}</option>
                <option>{{ Date('Y')+1 }}</option>
            </select>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="description">Description</label>
            <textarea placeholder="Enter Description"
                value="{{ old('description') }}"
                id="description"
                name="description"
                rows="3"
                style="resize: vertical;" 
                spellcheck="false"
                class="form-control col-sm-9"
                ></textarea>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="amount">Payment Amount<span class="required text-danger">*</span></label>
            <input placeholder="Enter Amount"
                value="{{ old('amount') }}"
                id="amount"
                name="amount"
                spellcheck="false"
                required
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="date">Payment Date<span class="required text-danger">*</span></label>
            <input placeholder="Enter Date"
                value="{{ Date('Y-m-d') }}" 
                type="date" 
                id="date"
                name="date"
                spellcheck="false"
                required
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
            $('#type').change(function() {
                if(this.value === "Monthly Fee") {
                    $('.monthly').slideDown(300);
                }else {
                    $('.monthly').slideUp(300);
                }
            });
        });
    </script>
@endsection
