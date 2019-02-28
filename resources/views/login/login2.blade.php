<?php
/**
 * Created by PhpStorm.
 * User: hjelmdal
 * Date: 21/02/2019
 * Time: 18.34
 */
?>
@section("styles")
    <link href="{{ config("app.keen_assets") }}/app/custom/user/login-v2.demo5.css?v={{ Helpers::gitVersion()->getVersion() }}" rel="stylesheet" type="text/css" />
@endsection
@section("scripts")
    <script src="{{ config("app.keen_assets") }}/app/custom/general/custom/login/login.js?v={{ Helpers::gitVersion()->getVersion() }}" type="text/javascript"></script>
    <script src="/js/fullscreen.js?v={{ Helpers::gitVersion()->getVersion() }}" type="text/javascript"></script>
@endsection
    <!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<head>
    @include("layouts.theme._head")
</head>
<!-- end::Head -->
<body class="k-login-v2--enabled k-header--fixed k-header-mobile--fixed k-subheader--enabled k-subheader--transparent k-aside--enabled k-aside--fixed k-page--loading" >
@include("layouts.theme.partials._layout-page-loader")
<!-- begin:: Page -->
<div class="k-grid k-grid--ver k-grid--root">
    <div class="k-grid__item k-grid__item--fluid k-grid k-grid k-grid--hor k-login-v2" id="k_login_v2">
        <!--begin::Item-->
        <div class="k-grid__item k-grid--hor">
            <!--begin::Heade-->
            <div class="k-login-v2__head">
                <div class="k-login-v2__head-logo">
                    <a href="{{ route("index") }}">
                        <img src="/img/weplan_486x135_black.png" alt="" height="40" />
                    </a>
                </div>
                <div class="k-login-v2__head-signup"> <span>Don't have an account?</span> <a id="k_signup2" href="#" class="k-link k-font-brand">Sign Up</a> </div>
            </div>
            <!--begin::Head-->
        </div>
        <!--end::Item-->
        <!--begin::Item-->
        <div class="k-grid__item k-grid k-grid--ver k-grid__item--fluid ">
            <!--begin::Body-->
            <div class="k-login-v2__body">
                <!--begin::Wrapper-->
                <div id="k_login_form2" class="k-login-v2__body-wrapper">
                    <div class="k-login-v2__body-container">
                        <div class="k-login-v2__body-title">
                            <h3>
                                Sign to Account
                            </h3>
                        </div>
                        <!--begin::Form-->
                        <form class="k-login-v2__body-form k-form k-login-v2__body-form--border" method="POST" action="{{ route('login') }}" autocomplete="new-password" >
                            @csrf
                            <div class="form-group">
                                <input id="login_email" class="form-control form-login2 {{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" placeholder="{{ __('E-Mail Address') }}" name="email" autocomplete="new-password">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback k-padding-l-30" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input class="form-control form-login2 {{ $errors->has('password') ? ' is-invalid' : '' }} transparent" type="password" placeholder="{{ __('Password') }}" name="password" autocomplete="new-password">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback k-padding-l-30" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="remember" class="k-checkbox k-checkbox--bold k-checkbox--brand">
                                    {{ __('Remember Me') }}? <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span></span>
                                </label>
                            </div>

                        <!--begin::Action-->
                        <div class="k-login-v2__body-action k-login-v2__body-action--brand" style="padding:20px 0 0 0">
                            <a href="#" id="k_forgot2" class="k-link k-link--brand"> {{ __('Forgot Your Password?') }} </a>
                            <button id="k_login_submit" type="submit" class="btn btn-pill btn-brand btn-elevate">Sign In</button>
                        </div>
                        </form>
                        <!--end::Form-->
                        <!--end::Action-->
                        <!--begin::Separator-->
                        <div class="k-login-v2__body-separator">
                            <div class="k-separator k-separator--space-lg k-separator--border-solid"></div>
                        </div>
                        <!--end::Separator-->
                        <h3 class="k-login-v2__body-subtitle">
                            Or sign with social account
                        </h3>
                        <!--begin::Options-->
                        <div class="k-login-v2__body-options">
                            <a data-fullscreen="true" href="{{route('facebook-redirect-create')}}" class="btn k-font-white k-login-v2__body-option--facebook"> <i class="fab fa-facebook-f k-font-white"></i> Facebook </a>
                            <!--a href="#" class="btn k-font-info k-login-v2__body-option--info"> <i class="fab fa-twitter k-font-info"></i> Twitter </a-->
                            <a data-fullscreen="true" href="{{route('google-redirect-create')}}" class="btn k-font-white k-login-v2__body-option--google"> <i class="fab fa-google k-font-white"></i> Google </a>
                        </div>
                        <!--end::Options-->
                    </div>
                </div>
                <!--end::Wrapper-->
                <!--begin::Wrapper-->
                <div style="display:none" id="k_signup_form2" class="k-login-v2__body-wrapper">
                    <div class="k-login-v2__body-container">
                        <div class="k-login-v2__body-title">
                            <h3>
                                {{ __("Sign up here") }}
                            </h3>
                        </div>
                        <!--begin::Form-->
                        <form class="k-login-v2__body-form k-form k-login-v2__body-form--border" method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}" style="">
                            @csrf
                            <div class="form-group">
                                <input id="register_name" class="form-control" type="text" placeholder="{{ __('Name') }}" name="name" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback k-padding-l-30" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input id="register_email" class="form-control" type="text" placeholder="{{ __('E-Mail Address') }}" name="email" autocomplete="new-password" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback k-padding-l-30" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input id="register_password" class="form-control" type="password" placeholder="{{ __('Password') }}" name="password">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback k-padding-l-30" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input id="register_rpassword" class="form-control " type="password" placeholder="{{ __('Confirm Password') }}" name="password_confirmation" id="password-confirm">
                            </div>
                            <div class="row form-group">
                                <div class="col k-align-left">
                                    <label id="register_agree" class="k-checkbox k-checkbox--brand k-checkbox--bold">
                                        <input type="checkbox" name="agree"> I Agree the <a href="#" class="k-link k-link--danger">terms and conditions</a>.
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                            <div class="k-login-v2__body-action k-login-v2__body-action--brand" style="padding:20px 0 0 0">
                                <button id="k_signup_cancel" class="btn btn-outline-metal btn-elevate btn-pill k_login_cancel2"><em class="fa fa-undo"></em> {{ __("Cancel") }}</button>
                                <button type="submit" id="k_signup_submit" class="btn btn-pill btn-brand btn-elevate"><em class="fa fa-check"></em> {{ __('Register') }}</button>
                            </div>
                        </form>
                        <!--end::Form-->
                        <!--end::Action-->
                        <!--begin::Separator-->
                        <div class="k-login-v2__body-separator">
                            <div class="k-separator k-separator--space-lg k-separator--border-solid"></div>
                        </div>
                        <!--end::Separator-->
                        <h3 class="k-login-v2__body-subtitle">
                            Or sign up with social account
                        </h3>
                        <!--begin::Options-->
                        <div class="k-login-v2__body-options">
                            <a href="#" class="btn k-font-white k-login-v2__body-option--facebook"> <i class="fab fa-facebook-f k-font-white"></i> Facebook </a>
                            <!--a href="#" class="btn k-font-info k-login-v2__body-option--info"> <i class="fab fa-twitter k-font-info"></i> Twitter </a-->
                            <a href="#" class="btn k-font-white k-login-v2__body-option--google"> <i class="fab fa-google k-font-white"></i> Google </a>
                        </div>
                        <!--end::Options-->
                    </div>
                </div>
                <!--end::Wrapper-->
                <!--begin::Wrapper-->
                <div style="display:none" id="k_forgot_form2" class="k-login-v2__body-wrapper">
                    <div class="k-login-v2__body-container">
                        <div class="k-login-v2__body-title">
                            <h3>
                                {{ __('Forgot Your Password?') }}
                            </h3>
                        </div>
                        <!--begin::Form-->
                        <form class="k-login-v2__body-form k-form k-login-v2__body-form--border" method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}" style="">
                            @csrf
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="{{ __('E-Mail Address') }}" name="email" id="forgot_email" autocomplete="new-password" value="{{ $email ?? old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="k-login-v2__body-action k-login-v2__body-action--brand" style="padding:3rem 0 3rem 0">
                                <button id="k_forgot_cancel" class="btn btn-outline-metal btn-elevate btn-pill k_login_cancel2"><em class="fa fa-undo"></em> {{ __("Cancel") }}</button>
                                <button type="submit" id="k_forgot_submit" class="btn btn-success btn-elevate btn-pill btn-lg"><em class="fa fa-check"></em> {{ __('Reset password') }}</button>
                            </div>
                        </form>
                        <!--end::Form-->
                        <!--end::Action-->

                    </div>
                </div>
                <!--end::Wrapper-->
                <!--begin::Pic-->
                <div class="k-login-v2__body-pic">
                    <img src="/img/weplan_bg_icon.gif" alt="">
                </div>
                <!--begin::Pic-->
            </div>
            <!--begin::Body-->
        </div>
        <!--end::Item-->
        <!--begin::Item-->
        <div class="k-grid__item">
            <div class="k-login-v2__footer">
                <div class="k-login-v2__footer-link"> <a href="#" class="k-link k-font-brand">Privacy</a> <a href="#" class="k-link k-font-brand">Legal</a> <a href="#" class="k-link k-font-brand">Contact</a> </div>
                <div class="k-login-v2__footer-info"> <a href="https://pixel8.dk" class="k-link">&copy; {{ date("Y") }} Pixel8</a> </div>
            </div>
        </div>
        <!--end::Item-->
    </div>
</div>
<!-- end:: Page -->
@include("layouts.theme._foot")
</body>
<!-- end::Body -->
</html>