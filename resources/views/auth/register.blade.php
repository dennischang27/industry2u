@extends('layouts.app')

@section('title')
    <title>{{ config('app.name', 'Industry2u') .  __('- Register') }}</title>
@endsection
@section('content')
<!-- START REGISTER SECTION -->
<div class="login_register_wrap section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-md-10">
                <div class="login_wrap">
                    <div class="padding_eight_all bg-white">
                        <div class="heading_s1">
                            <h3>{{ __('Register') }}</h3>
                        </div>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <input class="form-control" name="first_name" id="txt-first-name" type="text" value="{{ old('first_name') }}" placeholder="{{ __('Your first Name') }}">
                                @if ($errors->has('first_name'))
                                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="last_name" id="txt-last-name" type="text" value="{{ old('last_name') }}" placeholder="{{ __('Your Last Name') }}">
                                @if ($errors->has('last_name'))
                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="email" id="txt-email" type="email" value="{{ old('email') }}" placeholder="{{ __('Your Email') }}">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="password" id="txt-password" placeholder="{{ __('Password') }}">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="password_confirmation" id="txt-password-confirmation" placeholder="{{ __('Retype Password') }}">
                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>
                            <div class="login_footer form-group  {{ $errors->has('terms') ? ' has-error' : '' }}">
                                <div class="chek-form">
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="terms" id="terms-policy" value="1">
                                        <label class="form-check-label" for="terms-policy"><span>I agree to <a target="_blank" href="{{ route("privacy") }}">Privacy Policy</a> and <a target="_blank" href="{{ route("terms") }}">Terms of Use</a></span></label>

                                    </div>
                                    @if ($errors->has('terms'))
                                        <span class="text-danger">{{ $errors->first('terms') }}</span>
                                    @endif
                                </div>
                            </div>
                            @if (app('request')->input('code'))
                                <input type="hidden" id="code" name="code" value="{{app('request')->input('code')}}">
                            @endif
                            
                            @if (app('request')->input('type') == 'customer')
                                <input type="hidden" id="type" name="type" value="{{app('request')->input('type')}}">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-fill-out btn-block">Add Company Information</button>
                                </div>
                            @else
                                <div class="form-group">
                                    <button type="submit" class="btn btn-fill-out btn-block">{{ __('Register') }}</button>
                                </div>
                            @endif
                        </form>

                        <div class="form-note text-center">{{ __('Already have an account?') }} <a href="{{ route('login') }}">{{ __('Log in') }}</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END LOGIN SECTION -->
@endsection
