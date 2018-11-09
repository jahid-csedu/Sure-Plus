@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-sm-auto py-3">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-primary btn-sm" href="feestype/create">Add New</a>
                    </div>
                    <div class="d-flex justify-content-center">
                        <span class="text-uppercase font-weight-bold">All Fees Types</span>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Sl No.</th>
                          <th scope="col">Name</th>
                          <th scope="col">Description</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($feesTypes as $serial=>$feesType)
                            <tr>
                              <th scope="row">{{ $serial+1 }}</th>
                              <td>{{ $feesType->name }}</td>
                              <td>{{ $feesType->description }}</td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
