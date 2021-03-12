@extends('layouts.app')

@section('style')
    <style>
        .profile-img{
            text-align: center;
        }
        .profile-img img{
            width: 30%;
            height: 30%;
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
        a {
            color: blue;
        }
    </style>

@endsection

@section('breadcrumbs')
    <!-- breadcrumbs start here-->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
					<b class="h5">Management Centre</b>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb justify-content-md-end" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                            <meta itemprop="position" content="1">
                            <a href="{{route("home")}}" itemprop="item" title="Home">
                                Home
                                <meta itemprop="name" content="Home">
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Company Profile</li>
                    </ol>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    @include('layouts.managementsidebar')
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard_content">

                        <div class="card">
                            <div class="card-header">
                                <h3>Payment Information</h3>
                            </div>
                            <div class="card-body">
								@if($company->bank_account)
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Bank Name:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p>{{$company->bank->name}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Bank Account Number:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p>{{$company->bank_account}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>SST Number:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p>{{$company->sst_no}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>SST Document:</label>
                                        </div>
                                        <div class="col-md-8">
                                            @if(isset($sst_file_path))
                                                  <a href="{{ asset('storage/'.$sst_file_path) }}" target="_blank">My {{ $sst_file_name }}</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group text-right">
                                        <a href="{{ route('user.bankinfo.edit') }}" class="btn btn-fill-out btn-sm" >
                                            {{ __('Edit') }}</a>
                                    </div>
								@else
									<div class="form-group text-left">
                                        <a href="{{ route('user.bankinfo.add') }}" class="btn btn-primary btn-sm" >
                                            {{ __('Become Supplier') }}</a>
                                    </div>
								@endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
