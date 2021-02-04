<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name', 'Industry2u') }} | {{ __('Admin') }} - {{ __('Login') }}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" crossorigin="anonymous">
    <!-- Fontawesome icons -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <!-- Theme Header Color -->
    <meta name="theme-color" content="#157ED2">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
        .authenticate-bg {
            background: url('{{ asset('images/authentication-bg.svg') }}');
            background-position-x: 0%;
            background-position-y: 0%;
            background-size: auto;
            background-size: contain;
            background-position: center;
            min-height: 100vh;
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/floating-labels.min.css') }}" rel="stylesheet">
</head>
<body class="authenticate-bg">
<form class="form-signin" action="{{ route('admin.login') }}" method="post">
    @csrf
    <div class="text-center mb-4">
         <img class="mb-4" src="{{url('images/icons/icon96x96.png')}}" alt="Icon" />
        <h1 class="h3 mb-3 font-weight-normal">{{ __('Admin Login') }}</h1>
    </div>

    <div class="form-label-group">
        <input type="email" value="{{ old('email') }}" id="inputEmail"
               class="@error('email') is-invalid @enderror form-control" placeholder="Email address" required autofocus
               name="email">
        <label for="inputEmail">{{ __('Email') }}</label>
        @error('email')
        <span class="invalid-feedback text-danger" role="alert">
        <strong>{{ $message }}</strong>
      </span>
        @enderror
    </div>

    <div class="form-label-group">
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password">
        <label for="inputPassword">{{ __('Password') }}</label>
    </div>

    <div class="checkbox mb-3">
        <label>
            <input name="remember" {{ old('remember') ? 'checked' : '' }} type="checkbox">
            {{ __('Remember me') }}
        </label>
    </div>
    <button type="submit" class="signin btn btn-lg btn-primary btn-block" type="submit">{{ __('Signin') }}</button>
    <p class="mt-5 mb-3 text-muted text-center">&copy; {{ "2019 - ".date('Y')}} All Rights Reserved by Digital Blueocean Bhd.
    </p>
</form>
</body>
<!-- jQuery 3.5.4 -->
<script src="{{asset('assets/sb-admin2/js/jquery.min.js')}}"></script>
<!-- Bootstrap JS -->
<script src="{{asset('assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script> <!-- bootstrap  js -->
<script>
    $("form").on('submit', function () {

        $('.signin').html('<i class="fa fa-circle-o-notch fa-spin fa-fw"></i> {{ __('Signin') }}');

    });
</script>
</html>
