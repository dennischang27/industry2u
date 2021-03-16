@extends('layouts.app')
@section('title')
    <title>{{ config('app.name', 'Industry2u') .  __('- Page no found.') }}</title>
@endsection

@section('style')
    <style>
        #notfound .notfound {
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%,-50%);
            -ms-transform: translate(-50%,-50%);
            transform: translate(-50%,-50%);
        }
        .notfound {
            max-width: 767px;
            width: 100%;
            line-height: 1.4;
            padding: 0 15px;
        }
        .notfound .notfound-404 h1 {
            font-family: titillium web,sans-serif;
            font-size: 186px;
            font-weight: 900;
            margin: 0;
            text-transform: uppercase;
            background: rgb(37,182,241);
            background: linear-gradient(90deg, rgba(37,182,241,1) 0%, rgba(159,159,159,1) 23%, rgba(241,153,37,1) 48%);
            background-position-x: 0%;
            background-position-y: 0%;
            background-size: auto;
            background-clip: border-box;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-size: cover;
            background-position: center;
        }
    </style>
@section('breadcrumbs')
    <!-- breadcrumbs start here-->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-title">

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
                        <li class="breadcrumb-item active">Page not found</li>
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
                <div class="col-lg-12">
                    <div class="notfound">
                        <div class="notfound-404">
                            <h1>404</h1>
                        </div>
                        <h2>Oops! This Page Could Not Be Found</h2>
                        <p>Sorry but the page you are looking for does not exist, have been removed. name changed or is temporarily unavailable</p>
                        <p>
                            <strong>
                                Refer to the following tips and try again:
                            </strong>
                        </p>
                        <ul>
                            <li>
                                Try different (more general) keywords, or try removing or adding words from your search.
                            </li>
                            <li>
                                Browse products by <a href="{{route('public.products')}}">category</a>.
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection

