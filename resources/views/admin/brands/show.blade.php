@extends('admin.layouts.app')

@section('pagetitle')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Show Brand -  {{ $brand->name }}</h1>
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('admin.brands.index') }}"> Back</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ $brand->name }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Description:</strong>
                        {{ $brand->description }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Logo:</strong>
                        @if($image = @file_get_contents(asset('storage/brands/'.$brand->logo)))
                            <img src="{{ asset('storage/brands/'.$brand->logo) }}" width="60" height="60">
                        @else
                            <img src=" {{ asset('images/noimage.jpg') }}" width="60" height="60">
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
