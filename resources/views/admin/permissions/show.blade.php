@extends('admin.layouts.app')
@section('pagetitle')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Show Permission - {{ $permission->name }}</h1>
    <!-- End Page Heading -->
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('admin.users.permissions.index') }}"> Back</a>
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
                            {{ $permission->name }}
                        </div>
                    </div>

                </div>
        </div>
    </div>
@endsection
