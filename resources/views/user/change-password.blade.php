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
                        <li class="breadcrumb-item active">Change Password</li>
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
                                <h3>Change Password</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route("user.postchangepassword", $user) }}" accept-charset="UTF-8">
                                    @csrf
                                    @if ($message = Session::get('success'))
                                        <div class="alert alert-success">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="old_password">Current password:</label>
                                        <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Current Password">
                                        @if ($errors->has('old_password'))
                                            <span class="text-danger">{{ $errors->first('old_password') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="password">New password:</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="New Password">
                                        @if ($errors->has('old_password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Password confirmation:</label>
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Password Confirmation">
                                        @if ($errors->has('old_password'))
                                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-fill-out btn-sm">Change password</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

@endsection
