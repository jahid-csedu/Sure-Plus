@extends('layouts.template')

@section('content')
<div class="container py-3">
    <h2 class="text-center">
        Updating Expenditure Information
    </h2>
    <hr>
    <form method="post" action="{{ route('expenses.update', $expense) }}">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="type">Expense Type<span class="required text-danger">*</span></label>
            <select id="type" name="type" class="form-control col-sm-9" required>
              @switch($expense->type)
                @case('Salary')
                  <option selected>Salary</option>
                  <option>House Rent</option>
                  <option>Bill</option>
                  <option>Others</option>
                @break
                @case('House Rent')
                  <option>Salary</option>
                  <option selected>House Rent</option>
                  <option>Bill</option>
                  <option>Others</option>
                @break
                @case('Bill')
                  <option>Salary</option>
                  <option>House Rent</option>
                  <option selected>Bill</option>
                  <option>Others</option>
                @break
                @default
                  <option>Salary</option>
                  <option>House Rent</option>
                  <option>Bill</option>
                  <option selected>Others</option>
              @endswitch
            </select>
        </div>
        <div class="form-group row teacherId">
            <label class="col-sm-2 col-sm-label text-right" for="employee_id">Employee ID<span class="required text-danger">*</span></label>
            <input placeholder="Enter ID"
                value="{{ $expense->employee_id }}"
                id="employee_id"
                name="employee_id"
                spellcheck="false"
                class="form-control col-sm-9"
                />
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
                @if($expense->month === $month)
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
                <option>{{ $expense->year }}</option>
                <option>{{ (int)$expense->year-1 }}</option>
                <option>{{ (int)$expense->year+1 }}</option>
            </select>
        </div>
        <div class="form-group row description">
            <label class="col-sm-2 col-sm-label text-right" for="description">Description<span class="required text-danger">*</span></label>
            <textarea placeholder="Enter Description"
                value="{{ $expense->description }}"
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
                value="{{ $expense->amount }}"
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
                value="{{ $expense->date }}"
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

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
          var type = $('#type').val();
          console.log(type);
          switch(type) {
              case "Salary":
                  $('.monthly').slideDown(300);
                  $('.teacherId').slideDown(300);
                  $('.description').slideUp(300);
                  break;
              case "House Rent":
                  $('.monthly').slideDown(300);
                  $('.teacherId').slideUp(300);
                  $('.description').slideUp(300);
                  break;
              case "Bill":
                  $('.monthly').slideDown(300);
                  $('.teacherId').slideUp(300);
                  $('.description').slideUp(300);
                  break;
              default:
                  $('.monthly').slideUp(300);
                  $('.teacherId').slideUp(300);
                  $('.description').slideDown(300);
                  break;
          }
          $('#type').change(function() {
              switch(this.value) {
                  case "Salary":
                      $('.monthly').slideDown(300);
                      $('.teacherId').slideDown(300);
                      $('.description').slideUp(300);
                      break;
                  case "House Rent":
                      $('.monthly').slideDown(300);
                      $('.teacherId').slideUp(300);
                      $('.description').slideUp(300);
                      break;
                  case "Bill":
                      $('.monthly').slideDown(300);
                      $('.teacherId').slideUp(300);
                      $('.description').slideUp(300);
                      break;
                  default:
                      $('.monthly').slideUp(300);
                      $('.teacherId').slideUp(300);
                      $('.description').slideDown(300);
                      break;
              }
          });
        });
    </script>
@endsection
