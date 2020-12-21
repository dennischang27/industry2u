@extends('seller.layouts.app')

@section('content')
<!-- START REGISTER SECTION -->
<div class="login_register_wrap section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-md-10">
                <div class="login_wrap">
                    <div class="padding_eight_all bg-white">
                        <div class="heading_s1">
                            <h3>{{ __('Login') }}</h3>
                        </div>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <input class="form-control" name="name" id="txt-name" type="text" value="{{ old('name') }}" placeholder="{{ __('Your Name') }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="email" id="txt-email" type="email" value="{{ old('email') }}" placeholder="{{ __('Your Email') }}">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="username" id="txt-email" type="email" value="{{ old('username') }}" placeholder="{{ __('Your Username') }}">
                                @if ($errors->has('username'))
                                    <span class="text-danger">{{ $errors->first('username') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="password" id="txt-password" placeholder="{{ __('Password') }}">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="password_confirmation" id="txt-password-confirmation" placeholder="{{ __('Password') }}">
                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>
                            <div class="login_footer form-group">
                                <div class="chek-form">
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="agree_terms_policy" id="terms-policy" value="1">
                                        <label class="form-check-label" for="terms-policy"><span>{{ __('I agree to terms & Policy.') }}</span></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-fill-out btn-block">{{ __('Register') }}</button>
                            </div>
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
