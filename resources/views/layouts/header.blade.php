<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    @yield('meta')

    @section('title')
        <title>{{ config('app.name', 'Industry2u') }}</title>
    @show
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/themes/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/themes/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/themes/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/themes/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/themes/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/themes/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/themes/css/simple-line-icons.css') }}">
    @yield('plugin_style')
    <!-- others css -->
    <link rel="stylesheet" href="{{ asset('assets/themes/plugins/owlcarousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/themes/plugins/owlcarousel/css/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/themes/plugins/owlcarousel/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/themes/plugins/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/themes/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/themes/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web.css') }}">

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <style>
        :root {
            --color-1st: #32a1e5;
            --color-2nd: #1D2224;
            --primary-font: Poppins, sans-serif;
        }
    </style>

    @yield('style')
    <!-- modernizr css -->

    <script src="{{ asset('assets/themes/js/jquery-3.5.1.min.js') }}"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-3JGXB0BPYF"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-3JGXB0BPYF');
    </script>
</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please upgrade your browser to improve your experience.</p>
<![endif]-->
<!--- LOADER -->
<!--div class="preloader">
    <div class="lds-ellipsis">
        <span></span>
        <span></span>
        <span></span>
    </div>
</div-->
<!-- END LOADER -->

<div id="alert-container"></div>

@include('layouts.head')

<div id="app">
@yield('body')
    <a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a>
</div>
<!-- offset area end -->

@include('layouts.footer')
<!-- jquery latest version -->
<script src="{{ asset('assets/themes/plugins/slick/slick.min.js') }}"></script>

@yield('plugin_script')

<!-- bootstrap 4 js -->
<script src="{{ asset('assets/themes/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/themes/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/themes/js/magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/themes/js/waypoints.min.js?v=4.0.1') }}"></script>
<script src="{{ asset('assets/themes/plugins/owlcarousel/js/owl.carousel.min.js') }}"></script>

<!-- others plugins -->
<script src="{{ asset('assets/themes/js/jquery.elevatezoom.js') }}"></script>
<script src="{{ asset('assets/themes/js/scripts.js') }}"></script>

@yield('script')

@include('cookieConsent::index')
</body>
</html>
