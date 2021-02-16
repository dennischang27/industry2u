@extends('admin.layouts.app')
@section('pagetitle')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Show Company - {{ $company->name }}</h1>
    <!-- End Page Heading -->
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('admin.companies.index') }}"> Back</a>
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
                            <strong>First Name:</strong>
                            {{ $company->name }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Last Name:</strong>
                            {{ $company->reg_no }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Admin User:</strong>
                            {{ $company->adminUser->first_name  }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Is Buyer:</strong>
                            {{ ($company->is_buyer? 'yes' : 'no')  }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Is Seller:</strong>
                            {{ ($company->is_seller? 'yes' : 'no')  }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Phone Number:</strong>
                            {{ $company->phone   }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Address:</strong>
                            {{ $company->street }}, {{ $company->postal_code }},
                            {{ $company->city }}, {{ $company->state->name }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>SST No:</strong>
                            {{ $company->sst_no }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Bank Information:</strong>
                            {{ $company->bank->name }} (  {{ $company->bank_account  }})
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Registered at:</strong>
                            {{ date('d-m-Y H:i:s', strtotime($company->created_at))}}
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
