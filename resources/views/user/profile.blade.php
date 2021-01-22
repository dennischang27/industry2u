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
                        <li class="breadcrumb-item active">Account Details</li>
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
                                <h3>Account Details</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route("user.updateprofile", $user) }}" accept-charset="UTF-8">
                                    @csrf
                                    @if ($message = Session::get('success'))
                                        <div class="alert alert-success">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="first_name">First Name:<small class="text-danger">*</small></label>
                                        <input id="first_name" type="text" class="form-control" name="first_name" value="{{ $user->first_name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name">Last Name:<small class="text-danger">*</small></label>
                                        <input id="last_name" type="text" class="form-control" name="last_name" value="{{ $user->last_name }}">
                                    </div>
                                    <div class="form-group ">
                                        <label for="email">Email:</label>
                                        <input id="email" type="text" class="form-control" disabled="disabled" value="{{ $user->email }}" name="email">
                                    </div>
                                    <div class="form-group ">
                                        <label for="mobile">Phone</label>
                                        <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Phone" value="{{ $user->mobile }}">
                                    </div>
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-fill-out btn-sm">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
