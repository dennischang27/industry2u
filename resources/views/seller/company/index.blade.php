@extends('seller.layouts.app')

@section('styles')
    <style>
        .profile-img{
            text-align: center;
        }

        .profile-img .file {
            position: relative;
            overflow: hidden;
            margin-top: -20%;
            width: 70%;
            border: none;
            border-radius: 0;
            font-size: 15px;
            background: #212529b8;
        }
    </style>

@endsection

@section('breadcrumbs')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-12">
                <div class="breadcrumbs-area clearfix">
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('seller.dashboard') }}">Home</a></li>
                        <li><span>Company Profile</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- page title area end -->
@endsection

@section('content')
    <!-- Table start -->
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Company Profile</h3>
            </div>
            <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-img">
                                @if($image = @file_get_contents(asset('storage/'.$company->logo)))
                                    <img src="{{ asset('storage/'.$company->logo) }}" width="200" height="200">
                                @else
                                    <img src=" {{ asset('images/noimage.jpg') }}" width="200" height="200">
                                @endif
                            </div>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-md-4">
                        <label>Company Name:</label>
                    </div>
                    <div class="col-md-8">
                        <p>{{ $company->name }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label>Registration Number:</label>
                    </div>
                    <div class="col-md-8">
                        <p>{{ $company->reg_no }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label>Phone Number:</label>
                    </div>
                    <div class="col-md-8">
                        <p>{{ $company->phone }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label>Address:</label>
                    </div>
                    <div class="col-md-8">
                        <p>{{ $company->street }} <br>
                            {{ $company->postal_code }} {{ $company->postal_code }}<br>
                            {{ $company->state->name }}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label>Monthly Budget:</label>
                    </div>
                    <div class="col-md-8">
                        @if($company->companybudgetrange)
                            {{ $company->companybudgetrange->name }}
                        @else
                            Non
                        @endif

                    </div>
                </div>
                <hr>
                <h5 class="fs-title">SSM Documents</h5>
                <div class="form-group row">
                    @foreach($document_list as $document)
                        <div class="col-md-6">
                            <label style="font-weight: 700">{{ __($document->name) }} : </label>

                            @if(isset($myDocuments[$document->id]))
                                <a href="{{ asset('storage/'.$myDocuments[$document->id]->file_path) }}" target="_blank">My {{ $myDocuments[$document->id]->doc_type->name }}</a>
                            @endif
                        </div>
                    @endforeach
                </div>
                <hr>
                <h5 class="fs-title">Payment Information</h5>
                <div class="row">
                    <div class="col-md-4">
                        <label>Bank name:</label>
                    </div>
                    <div class="col-md-8">
                        <p>{{ $company->bank->name }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label>Bank Account Number:</label>
                    </div>
                    <div class="col-md-8">
                        <p>{{ $company->bank_account }}</p>
                    </div>
                </div>
                <hr>
                <h5 class="fs-title">SST Information</h5>
                <div class="row">
                    <div class="col-md-4">
                        <label>SST Number:</label>
                    </div>
                    <div class="col-md-8">
                        <p>{{ $company->sst_no }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    @foreach($sst_document_list as $document)
                        <div class="col-md-6">
                            <label style="font-weight: 700">{{ __($document->name) }} : </label>

                            @if(isset($mySSTDocuments[$document->id]))
                                <a href="{{ asset('storage/'.$mySSTDocuments[$document->id]->file_path) }}" target="_blank">My {{ $mySSTDocuments[$document->id]->doc_type->name }}</a>
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="form-group text-right">
                    <a href="{{ route('seller.company.profile.edit') }}" class="btn btn-primary" >
                        {{ __('Edit') }}</a>
                </div>

            </div>
        </div>
    </div>

@endsection
