<?php
/**
 * Created by PhpStorm.
 * User: hjelmdal
 * Date: 21/02/2019
 * Time: 18.34
 */
?>
@section("styles")
    <link href="{{ config("app.keen_assets") }}/css/demo5/pages/login/login-v2.css?v={{ Helpers::gitVersion()->getVersion() }}" rel="stylesheet" type="text/css" />
@endsection
@section("scripts")
    <script src="{{ config("app.keen_assets") }}/js/demo5/pages/custom/user/login.js?v={{ Helpers::gitVersion()->getVersion() }}" type="text/javascript"></script>

@endsection
    <!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<head>
    @include("layouts.theme._head")
</head>
<!-- end::Head -->
<body class="kt-login-v2--enabled kt-header--fixed kt-header-mobile--fixed kt-aside--enabled kt-aside--left kt-aside--fixed kt-aside--offcanvas-default kt-page--loading" >
@include("layouts.theme.partials._layout-page-loader")
<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root">
    <div class="kt-grid__item   kt-grid__item--fluid kt-grid  kt-grid kt-grid--hor kt-login-v2" id="kt_login_v2">
        <!--begin::Item-->
        <div class="kt-grid__item  kt-grid--hor">
            <!--begin::Heade-->
            <div class="kt-login-v2__head">
                <div class="kt-login-v2__logo">
                    <a href="{{ route("index") }}">
                        <img src="/img/weplan_486x135_black.png" alt="" height="40" />
                    </a>
                </div>
                <div class="kt-login-v2__signup">
                    <span>Don't have an account?</span>
                    <a id="kt_signup2" href="#" class="kt-link kt-font-brand">Sign Up</a>
                </div>
            </div>
            <!--begin::Head-->
        </div>
        <!--end::Item-->
        <!--begin::Item-->
        <div class="kt-grid__item  kt-grid  kt-grid--ver  kt-grid__item--fluid">
            <!--begin::Body-->
            <div class="kt-login-v2__body">
                <!--begin::Wrapper-->
                <div id="kt_login_form2" class="kt-login-v2__wrapper">
                    <div class="kt-login-v2__container">
                        <div class="kt-login-v2__title">
                            <h3>
                                Sign to Account
                            </h3>
                        </div>
                        <!--begin::Form-->
                        <form class="kt-login-v2__form kt-form" method="POST" action="{{ route('login') }}" autocomplete="new-password" >
                            @csrf
                            <div class="form-group">
                                <input id="login_email" class="form-control form-login2 {{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" placeholder="{{ __('E-Mail Address') }}" name="email" autocomplete="new-password">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback kt-padding-l-30" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input class="form-control form-login2 {{ $errors->has('password') ? ' is-invalid' : '' }} transparent" type="password" placeholder="{{ __('Password') }}" name="password" autocomplete="new-password">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback kt-padding-l-30" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="remember" class="kt-checkbox kt-checkbox--bold kt-checkbox--brand">
                                    {{ __('Remember Me') }}? <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span></span>
                                </label>
                            </div>

                        <!--begin::Action-->
                        <div class="kt-login-v2__actions" style="padding:20px 0 0 0">
                            <a href="#" id="kt_forgot2" class="kt-link kt-link--brand"> {{ __('Forgot Your Password?') }} </a>
                            <button id="kt_login_submit" type="submit" class="btn btn-pill btn-brand btn-elevate">Sign In</button>
                        </div>
                        </form>
                        <!--end::Form-->
                        <!--end::Action-->
                        <!--begin::Separator-->
                        <div class="kt-separator kt-separator--space-lg  kt-separator--border-solid"></div>
                        <!--end::Separator-->
                        <h3 class="kt-login-v2__desc">
                            Or sign with social account
                        </h3>
                        <!--begin::Options-->
                        <div class="kt-login-v2__options">
                            <a id="link_facebook" data-fullscreen="true" href="{{route('facebook-redirect-create')}}" class="btn kt-font-white btn-facebook btn-pill"> <i class="fab fa-facebook-f kt-font-white"></i> Facebook </a>
                            <!--a href="#" class="btn kt-font-info kt-login-v2__option--info"> <i class="fab fa-twitter kt-font-info"></i> Twitter </a-->
                            <a id="link_google" data-fullscreen="true" href="{{route('google-redirect-create')}}" class="btn kt-font-white btn-google btn-pill"> <i class="fab fa-google kt-font-white"></i> Google </a>
                        </div>
                        <!--end::Options-->
                    </div>
                </div>
                <!--end::Wrapper-->
                <!--begin::Wrapper-->
                <div style="display:none" id="kt_signup_form2" class="kt-login-v2__wrapper">
                    <div class="kt-login-v2__container">
                        <div class="kt-login-v2__title">
                            <h3>
                                {{ __("Sign up here") }}
                            </h3>
                        </div>
                        <!--begin::Form-->
                        <form class="kt-login-v2__form kt-form kt-login-v2__form--border" method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}" style="">
                            @csrf
                            <div class="form-group">
                                <input id="register_name" class="form-control" type="text" placeholder="{{ __('Name') }}" name="name" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback kt-padding-l-30" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input id="register_email" class="form-control" type="text" placeholder="{{ __('E-Mail Address') }}" name="email" autocomplete="new-password" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback kt-padding-l-30" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input id="register_password" class="form-control" type="password" placeholder="{{ __('Password') }}" name="password">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback kt-padding-l-30" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input id="register_rpassword" class="form-control " type="password" placeholder="{{ __('Confirm Password') }}" name="password_confirmation" id="password-confirm">
                            </div>
                            <div class="row form-group">
                                <div class="col kt-align-left">
                                    <label id="register_agree" class="kt-checkbox kt-checkbox--brand kt-checkbox--bold">
                                        <input type="checkbox" name="agree"> I Agree the <a href="#" class="kt-link kt-link--danger">terms and conditions</a>.
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                            <div class="kt-login-v2__actions kt-login-v2__action--brand" style="padding:20px 0 0 0">
                                <button id="kt_signup_cancel" class="btn btn-outline-metal btn-elevate btn-pill kt_login_cancel2"><em class="fa fa-undo"></em> {{ __("Cancel") }}</button>
                                <button type="submit" id="kt_signup_submit" class="btn btn-pill btn-brand btn-elevate"><em class="fa fa-check"></em> {{ __('Register') }}</button>
                            </div>
                        </form>
                        <!--end::Form-->
                        <!--end::Action-->

                    </div>
                </div>
                <!--end::Wrapper-->
                <!--begin::Wrapper-->
                <div style="display:none" id="kt_forgot_form2" class="kt-login-v2__wrapper">
                    <div class="kt-login-v2__container">
                        <div class="kt-login-v2__title">
                            <h3>
                                {{ __('Forgot Your Password?') }}
                            </h3>
                        </div>
                        <!--begin::Form-->
                        <form class="kt-login-v2__form kt-form kt-login-v2__form--border" method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}" style="">
                            @csrf
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="{{ __('E-Mail Address') }}" name="email" id="forgot_email" autocomplete="new-password" value="{{ $email ?? old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="kt-login-v2__actions kt-login-v2__action--brand" style="padding:3rem 0 3rem 0">
                                <button id="kt_forgot_cancel" class="btn btn-outline-metal btn-elevate btn-pill kt_login_cancel2"><em class="fa fa-undo"></em> {{ __("Cancel") }}</button>
                                <button type="submit" id="kt_forgot_submit" class="btn btn-success btn-elevate btn-pill btn-lg"><em class="fa fa-check"></em> {{ __('Reset password') }}</button>
                            </div>
                        </form>
                        <!--end::Form-->
                        <!--end::Action-->

                    </div>
                </div>
                <!--end::Wrapper-->
                <!--begin::Pic-->
                <div class="kt-login-v2__image">
                    <img src="/img/weplan_bg_icon.gif" alt="">
                </div>
                <!--begin::Pic-->
            </div>
            <!--begin::Body-->
        </div>
        <!--end::Item-->
        <!--begin::Item-->
        <div class="kt-grid__item">
            <div class="kt-login-v2__footer">
                <div class="kt-login-v2__footer-link"> <a href="#" class="kt-link kt-font-brand">Privacy</a> <a href="#" class="kt-link kt-font-brand">Legal</a> <a href="#" class="kt-link kt-font-brand">Contact</a> </div>
                <div class="kt-login-v2__footer-info"> <a href="https://pixel8.dk" class="kt-link">&copy; {{ date("Y") }} Pixel8</a> </div>
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
