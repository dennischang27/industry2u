@extends('layouts.app')

@section('breadcrumbs')
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
					<b class="h5">Sales Centre</b>
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
                        <li class="breadcrumb-item active">Sales Management</li>
                        <li class="breadcrumb-item active">Payment Terms</li>
                        <li class="breadcrumb-item active">Add New</li>
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
                    @include('layouts.salesidebar')
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard_content">
                        <div class="card">
                            <div class="card-header">
                                <h3>Add New Payment Term</h3>
                            </div>
                            <div class="card-body">
                                <form id="term_form" action="{{ route('user.term.store') }}" class="form" method="post">
                                    @csrf
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-3 col-form-label"><strong>Code:</strong><small class="text-danger">*</small></label>
                                            <div class="col-sm-9">
                                                <input type="text" required  value="{{old('code')}}" class="form-control @error('code') is-invalid @enderror" id="code" name="code"
                                                       placeholder="Eg: 30 Days"
                                                       title="Please Enter Payment Code. Eg: 30 Days">

                                            </div>
                                            <div class="errorTxt"></div>
                                            @error('code')
                                            <span class="invalid-feedback text-danger" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-3 col-form-label"><strong>Description:</strong><small class="text-danger">*</small></label>
                                            <div class="col-sm-9">
                                                <input type="text" required  value="{{old('description')}}" class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                                       placeholder="Eg: Net 30 Days"
                                                       title="Please Enter Payment description. Eg: Net 30 Days">

                                            </div>
                                            <div class="errorTxt"></div>
                                            @error('description')
                                            <span class="invalid-feedback text-danger" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-3 col-form-label"><strong>Days:</strong><small class="text-danger">*</small></label>
                                            <div class="col-sm-9">
                                                <input type="number" required  value="{{old('days')}}" class="form-control @error('days') is-invalid @enderror" id="days" name="days"
                                                       placeholder="Eg:30"
                                                       title="Please Enter Days. Eg:30">

                                            </div>
                                            <div class="errorTxt"></div>
                                            @error('days')
                                            <span class="invalid-feedback text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary">Save</button>
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



