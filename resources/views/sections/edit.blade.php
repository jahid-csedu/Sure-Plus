@extends('layouts.template')

@section('content')
<div class="container py-3">
    <h2 class="text-center">
        Update Section
    </h2>
    <hr>
    <form method="post" action="{{ route('sections.update', $section) }}">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="name">Section Name<span class="required text-danger">*</span></label>
           <input placeholder="Enter Name"
                value="{{ $section->name }}"
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
                    @if($class->class === $section->class)
                        <option selected>{{$class->class}}</option>
                    @else
                        <option>{{$class->class}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="class">Shift<span class="required text-danger">*</span></label>
            <select id="shift" name="shift"class="form-control col-sm-9" required>
                @switch($section->shift)
                    @case("Morning")
                        <option selected>Morning</option>
                        <option>Afternoon</option>
                        <option>Evening</option>
                    @break
                    @case("Afternoon")
                        <option>Morning</option>
                        <option selected>Afternoon</option>
                        <option>Evening</option>
                    @break
                    @case("Evening")
                        <option>Morning</option>
                        <option>Afternoon</option>
                        <option selected>Evening</option>
                    @break
                    @default
                        <option>Morning</option>
                        <option>Afternoon</option>
                        <option>Evening</option>
                @endswitch
            </select>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="class">Description</label>
            <input placeholder="Enter Description"
                value="{{ $section->description }}"
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
