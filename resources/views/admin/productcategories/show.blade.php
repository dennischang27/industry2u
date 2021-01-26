@extends('admin.layouts.app')
@section('pagetitle')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Show Product Category - {{ $productcategory->name }}</h1>
    <!-- End Page Heading -->
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('admin.productcategories.index') }}"> Back</a>
            </div>
        </div>
        <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ $productcategory->name }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Parent Category:</strong>
                        @if ($productcategory->parentCategory)
                            {{ $productcategory->parentCategory->name }}
                        @else
                            None
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Image:</strong>
                        @if(isset($productcategory->logo))

                            <img src="{{ asset('storage/categories/'.$productcategory->image) }}" width="60" height="60">
                        @else
                            <img src=" {{ asset('images/noimage.jpg') }}" width="60" height="60">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
