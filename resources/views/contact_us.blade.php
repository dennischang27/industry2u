@extends('layouts.app')
@section('title')
    <title>{{ config('app.name', 'Industry2u') .  __(' CONTACT US') }}</title>
@endsection
@section('breadcrumbs')
    <!-- breadcrumbs start here-->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-title">
                        <h1>CONTACT US</h1>
                    </div>
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
                        <li class="breadcrumb-item active">CONTACT US</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
<div class="section">
    <div class="container">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                </div>
            @endif 
            @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
            @endif
            <form action="{{route('contact_us.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row" style="min-height: 50vh;">
            <div class="col-12" style="margin: auto;">
                <!-- <form action="/contact-us/#wpcf7-f224-p85-o1" method="post" class="wpcf7-form init" novalidate="novalidate" data-status="init"> -->
                <div style="display: none;">
                    <input type="hidden" name="" value="">
                    <input type="hidden" name="" value="">
                    <input type="hidden" name="" value="">
                    <input type="hidden" name="" value="">
                    <input type="hidden" name="" value="">
                    <input type="hidden" name="" value="">
                    <input type="hidden" name="" value="">
                    <input type="hidden" name="" value="">
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group ">
                            <label for="name">Name<span class="required"></span></label>
                            <input id="name" type="text" class="form-control" value="{{ old('name') }}" name="name">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group ">
                            <label for="email">Email<span class="required"></span></label>
                            <input id="email" type="text" class="form-control" value="{{ old('email') }}" name="email">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group ">
                            <label for="company_name">Company Name<span class="required"></span></label>
                            <input id="company_name" type="text" class="form-control" value="{{ old('company_name') }}" name="company_name">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group ">
                            <label for="designation">Designation<span class="required"></span></label>
                            <input id="designation" type="text" class="form-control" value="{{ old('designation') }}" name="designation">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group ">
                            <label for="address">Address<span class="required"></span></label>
                            <input id="address" type="text" class="form-control" value="{{ old('address') }}" name="address">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group ">
                            <label for="phone">Phone<span class="required"></span></label>
                            <input id="phone" type="text" class="form-control" value="{{ old('phone') }}" name="phone">
                        </div>
                    </div>
                </div>
                        <div class="form-group ">
                            <label for="subject">Subject<span class="required"></span></label>
                            <input id="subject" type="text" class="form-control" value="{{ old('subject') }}" name="subject">
                        </div>
                        <div class="form-group ">
                            <label for="message">Your Message<span class="required"></span>
                            <span class="Message">
                            <textarea name="message" label for="message" cols="160" rows="5" class="form-control" >{{ old('message')  }}</textarea></span> </p>
                    <p><input type="submit" value="Send Message" class="btn btn-primary"><span></span></p></div>
            </form>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection