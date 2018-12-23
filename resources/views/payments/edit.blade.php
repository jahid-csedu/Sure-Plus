@extends('layouts.template')

@section('content')
<div class="container py-3">
    <h2 class="text-center">
        Add A New Payment
    </h2>
    <hr>
    <form method="post" action="{{ route('payments.update', $payment) }}">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="student_id">Student ID<span class="required text-danger">*</span></label>
           <input placeholder="Enter ID"
                value="{{ $payment->student_id }}"
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
                @switch($payment->type)
                    @case('Monthly Fee')
                        <option selected>Monthly Fee</option>
                        <option>Admission Fee</option>
                        <option>Model Test Fee</option>
                        <option>Others</option>
                    @break
                    @case('Admission Fee')
                        <option>Monthly Fee</option>
                        <option selected>Admission Fee</option>
                        <option>Model Test Fee</option>
                        <option>Others</option>
                    @break
                    @case('Model Test Fee')
                        <option>Monthly Fee</option>
                        <option>Admission Fee</option>
                        <option selected>Model Test Fee</option>
                        <option>Others</option>
                    @break
                    @default
                        <option>Monthly Fee</option>
                        <option>Admission Fee</option>
                        <option>Model Test Fee</option>
                        <option selected>Others</option>
                @endswitch
            </select>
        </div>
        <div class="form-group row monthly">
          <?php $months = array('January',
                                'February',
                                'March',
                                'April',
                                'May',
                                'June',
                                'July',
                                'August',
                                'September',
                                'October',
                                'November',
                                'December'
                          );?>
            <label class="col-sm-2 col-sm-label text-right" for="month">Month</label>
            <select id="month" name="month" class="form-control col-sm-9">
              @foreach($months as $month)
                @if($payment->month === $month)
                  <option selected>{{ $month }}</option>
                @else
                  <option>{{ $month }}</option>
                @endif
              @endforeach
            </select>
        </div>
        <div class="form-group row monthly">
            <label class="col-sm-2 col-sm-label text-right" for="year">Year</label>
            <select id="year" name="year" class="form-control col-sm-9">
                <option>{{ $payment->year }}</option>
                <option>{{ (int)$payment->year-1 }}</option>
                <option>{{ (int)$payment->year+1 }}</option>
            </select>
        </div>
        <div class="form-group row description">
            <label class="col-sm-2 col-sm-label text-right" for="description">Description</label>
            <textarea placeholder="Enter Description"
                value="{{ $payment->description }}"
                id="description"
                name="description"
                rows="3"
                style="resize: vertical;" 
                spellcheck="false"
                class="form-control col-sm-9"
                >{{ $payment->description }}</textarea>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="amount">Payment Amount<span class="required text-danger">*</span></label>
            <input placeholder="Enter Amount"
                value="{{ $payment->amount }}"
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
                value="{{ $payment->date }}" 
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
            console.log($('#type').val());
            switch($('#type').val()) {
                case "Monthly Fee":
                    $('.monthly').slideDown(300);
                    $('.description').slideUp(300);
                break;
                case "Admission Fee":
                    $('.monthly').slideUp(300);
                    $('.description').slideUp(300);
                break;
                case "Model Test Fee":
                    $('.monthly').slideUp(300);
                    $('.description').slideUp(300);
                break;
                default:
                    $('.monthly').slideUp(300);
                    $('.description').slideDown(300);
            }
            $('#type').change(function() {
                switch(this.value) {
                    case "Monthly Fee":
                        $('.monthly').slideDown(300);
                        $('.description').slideUp(300);
                    break;
                    case "Admission Fee":
                        $('.monthly').slideUp(300);
                        $('.description').slideUp(300);
                    break;
                    case "Model Test Fee":
                        $('.monthly').slideUp(300);
                        $('.description').slideUp(300);
                    break;
                    default:
                        $('.monthly').slideUp(300);
                        $('.description').slideDown(300);
                }
            });
        });
    </script>
@endsection
