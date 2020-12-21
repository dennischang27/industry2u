<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login - Seller Center Industry2u</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <style>
        :root {
            --color-1st: #0e90dd;
            --color-2nd: #1D2224;
            --primary-font: Poppins, sans-serif;
        }
    </style>
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
<!-- login area start -->
<div class="login-area login-bg">
    <div class="container">
        <div class="login-box ptb--100">
            <form method="POST" action="{{ route('seller.login') }}">
                <div class="login-form-head">
                    <h4>Login to Seller Centre</h4>
                </div>
                <div class="login-form-body">
                    <div class="form-gp">
                        <input name="email" id="txt-email"  type="email" value="{{ old('email') }}" placeholder="{{ __('Your Email') }}">
                        <i class="ti-email"></i>
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-gp">
                        <input type="password" name="password" id="txt-password" placeholder="{{ __('Password') }}">
                        <i class="ti-lock"></i>
                        <div class="text-danger"></div>
                    </div>
                    <div class="row mb-4 rmber-area">
                        <div class="col-6">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" name="remember" id="remember-me" value="1" class="custom-control-input">
                                <label class="custom-control-label" for="remember-me">{{ __('Remember me') }}</label>
                            </div>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route('seller.password.request') }}">{{ __('Forgot password?') }}</a>
                        </div>
                    </div>
                    <div class="submit-btn-area">
                        <button id="form_submit" type="submit">Submit <i class="ti-arrow-right"></i></button>
                    </div>
                    <div class="form-footer text-center mt-5">
                        <p class="text-muted">{{ __("Don't Have an Account?") }} <a href="{{ route('seller.register') }}">{{ __('Sign up now') }}</a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- login area end -->

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
</body>

</html>
