@extends('layouts.template')

@section('content')
<div class="container py-3">
    <h2 class="text-center">
        Add A New Exam
    </h2>
    <hr>
    <form method="post" action="{{ route('exams.store') }}">
        @csrf
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="name">Exam Name<span class="required text-danger">*</span></label>
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
            <label class="col-sm-2 col-sm-label text-right" for="section">Section<span class="required text-danger">*</span></label>
            <select id="section" name="section" class="form-control col-sm-9" required>
                @foreach($sections as $section)
                    <option>{{$section->name}}</option>
                @endforeach
                <option>All</option>
            </select>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="subject">Subject<span class="required text-danger">*</span></label>
            <input placeholder="Enter Subject"
                id="subject"
                required
                name="subject"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="date">Date</label>
            <input placeholder="Enter Date"
                type="date" 
                id="date"
                name="date"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="total_marks">Total Marks</label>
            <input placeholder="Enter Marks"
                type="number" 
                id="total_marks"
                name="total_marks"
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
            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $.ajax({
               type:'GET',
               url:'/getSections',
               data:{class:$('#class').val()},
               success:function(data){
                  document.getElementById('section').innerHTML=data;
               }
            });
            $('#class').change(function() {
                $.ajax({
                   type:'GET',
                   url:'/getSections',
                   data:{class:this.value},
                   success:function(data){
                      document.getElementById('section').innerHTML=data;
                   }
                });
            });
        });
    </script>
@endsection
