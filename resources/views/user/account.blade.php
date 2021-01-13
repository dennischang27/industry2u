@extends('layouts.app')

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
                    <li class="breadcrumb-item active">Account</li>
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
                                <h3>Account information</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>First Name:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p>{{auth('web')->user()->first_name }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Last Name:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p>{{auth('web')->user()->last_name }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Email:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p>{{auth('web')->user()->email }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Phone:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p>{{auth('web')->user()->phone }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
