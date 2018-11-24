@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-sm-auto py-3">

            <div class="col-md-3" style="float:left">
              <div class="card-counter primary">
                <i class="fa fa-users"></i>
                <span class="count-numbers">{{ $student }}</span>
                <span class="count-name">Students</span>
              </div>
            </div>

            <div class="col-md-3" style="float:left">
              <div class="card-counter danger">
                <i class="fa fa-user-tie"></i>
                <span class="count-numbers">{{ $employee }}</span>
                <span class="count-name">Staffs</span>
              </div>
            </div>

            <div class="col-md-3" style="float:left">
              <div class="card-counter success">
                <i class="fa fa-bell"></i>
                <span class="count-numbers">{{ $class }}</span>
                <span class="count-name">Classes</span>
              </div>
            </div>

            <div class="col-md-3" style="float:left">
              <div class="card-counter info">
                <i class="fa fa-book"></i>
                <span class="count-numbers">{{ $section }}</span>
                <span class="count-name">Batches</span>
              </div>
            </div>

        </div>
    </div>
</div>
@endsection
