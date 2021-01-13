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
    </style>

@endsection

@section('breadcrumbs')
    <!-- breadcrumbs start here-->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
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
                    @include('layouts.usersidebar')
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard_content">

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
                                    <div class="form-group text-right">
                                        <a href="{{ route('user.company.edit') }}" class="btn btn-fill-out btn-sm" >
                                            {{ __('Edit') }}</a>
                                    </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
