@extends('admin.layouts.app')

@section('pagetitle')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Show Budget Range -  {{ $companybudget->name }}</h1>
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('admin.settings.companybudget.index') }}"> Back</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ $companybudget->name }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>From:</strong>
                        {{ $companybudget->from }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>To:</strong>
                        {{ $companybudget->to }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
