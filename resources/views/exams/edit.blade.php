@extends('layouts.template')

@section('content')
<div class="container py-3">
    <h2 class="text-center">
        Update Exam
    </h2>
    <hr>
    <form method="post" action="{{ route('exams.update', $exam) }}">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="name">Exam Name<span class="required text-danger">*</span></label>
           <input placeholder="Enter Name"
                value="{{ $exam->name }}" 
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
                    @if($exam->class === $class->name)
                    <option selected>{{$class->name}}</option>
                @else
                    <option>{{$class->name}}</option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="section">Section</label>
            <select id="section" name="section" class="form-control col-sm-9" required>
                @foreach($sections as $section)
                    @if($section->name === $exam->section)
                        <option selected>{{$section->name}}</option>
                    @else
                        <option>{{$section->name}}</option>
                    @endif
                @endforeach
                <option>All</option>
            </select>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="class">Subject<span class="required text-danger">*</span></label>
            <input placeholder="Enter Subject"
                value="{{ $exam->subject }}" 
                id="subject"
                required
                name="subject"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="class">Date</label>
            <input placeholder="Enter Date"
                value="{{ $exam->date }}" 
                type="date" 
                id="date"
                name="date"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="class">Total Marks</label>
            <input placeholder="Enter Marks"
                value="{{ $exam->total_marks }}" 
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
            $('#class').change(function() {
                $.ajax({
                   type:'GET',
                   url:'/getSections',
                   data:{class:this.value},
                   success:function(sections){
                      var options="<option>All</option>";
                      for(var i=0; i<sections.length; i++) {
                        options += "<option>"+sections[i].name+"</option>";
                      }
                      document.getElementById('section').selectedIndex=-1;
                   }
                });
            });
        });
    </script>
@endsection
