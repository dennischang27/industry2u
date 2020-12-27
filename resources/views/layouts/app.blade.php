@extends('layouts.header')

@section('title')
    <title>{{ config('app.name', 'Industry2u')  }}</title>
@endsection


@section('body')

    <!-- main content area start -->
        <div class="main-content">
            @yield('breadcrumbs')
             @yield('content')
        </div>
     <!-- main content area end -->


@endsection
