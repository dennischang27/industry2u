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

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/srtdash/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/srtdash/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/srtdash/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/srtdash/css/metisMenu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/srtdash/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/srtdash/css/slicknav.min.css') }}">
    <!-- others css -->
    <link rel="stylesheet" href="{{ asset('assets/srtdash/css/typography.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/srtdash/css/default-css.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/srtdash/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/srtdash/css/responsive.css') }}">

    <!-- modernizr css -->

    <script src="{{ asset('assets/srtdash/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/seller.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
</head>
<body>
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
<!-- jquery latest version -->
<script src="{{ asset('assets/srtdash/js/vendor/jquery-2.2.4.min.js') }}"></script>
<!-- bootstrap 4 js -->
<script src="{{ asset('assets/srtdash/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/srtdash/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/srtdash/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/srtdash/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets/srtdash/js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('assets/srtdash/js/jquery.slicknav.min.js') }}"></script>

<!-- others plugins -->
<script src="{{ asset('assets/srtdash/js/plugins.js') }}"></script>
<script src="{{ asset('assets/srtdash/js/scripts.js') }}"></script>

@yield('script')

</body>
</html>
