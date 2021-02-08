<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    @yield('meta')
    @section('title')
        <title>{{ config('app.name', 'Industry2u') }}</title>
    @show

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/sb-admin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    @yield('plugin_style')
    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/sb-admin2/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/sb-admin2/css/custom.css') }}" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    @yield('style')
</head>
<body id="page-top">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please upgrade your browser to improve your experience.</p>
<![endif]-->
<!-- preloader area start -->
<!--div id="preloader">
    <div class="loader"></div>
</div-->
<!-- preloader area end -->

@yield('body')
<!-- offset area end -->

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('assets/sb-admin2/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/sb-admin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Core plugin JavaScript-->
<script src="{{ asset('assets/sb-admin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

@yield('plugin_script')
<!-- Custom scripts for all pages-->
<script src="{{ asset('assets/sb-admin2/js/sb-admin-2.min.js') }}"></script>

@yield('script')

</body>

</html>
