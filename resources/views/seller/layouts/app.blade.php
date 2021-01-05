@extends('seller.layouts.header')

@section('title')
    <title>{{ config('app.name', 'Industry2u') .  __(' Seller Portal') }}</title>
@endsection

@section('body')
    <!-- page container area start -->
    <div class="page-container">

        @include('seller.layouts.sidebar')
        <!-- main content area start -->
        <div class="main-content">
            @include('seller.layouts.head')
            @yield('breadcrumbs')
            <div class="main-content-inner">
                <div class="row">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Copyright 2020. All right reserved. Industry2u.</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->

@endsection
