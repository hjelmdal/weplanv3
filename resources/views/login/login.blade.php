<?php
/**
 * Created by PhpStorm.
 * User: hjelmdal
 * Date: 21/02/2019
 * Time: 18.34
 */
?>
@section("styles")
    <link href="{{ config("app.keen_assets") }}/custom/user/login-v1.css?v={{ Helpers::gitVersion()->getVersion() }}" rel="stylesheet" type="text/css" />
@endsection
@section("scripts")
    <script src="{{ config("app.keen_assets") }}/demo/default/custom/custom/login/login.js?v={{ Helpers::gitVersion()->getVersion() }}" type="text/javascript"></script>
@endsection
    <!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<head>
    @include("layouts.theme._head")
</head>
<!-- end::Head -->
<!-- begin::Body -->
<body style="background-image: url(/img/weplan_2880x1800.jpg)" class="kt-login-v1--enabled kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading kt-bg-brand" >
<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid kt-grid--hor kt-login-v1" id="kt_login_v1">
        <!--begin::Item-->
        <div class="kt-grid__item kt-grid--hor">
            <!--begin::Heade-->
            <div class="kt-login-v1__head">
                <div class="kt-login-v1__head-logo">
                    <a href="{{ route("index") }}">
                        <img src="/img/weplan_486x135_black.png" alt="" height="40" />
                    </a>
                </div>
                <div class="kt-login-v1__head-signup">
                    <h4>
                        Don't have an account?
                    </h4>
                    <a id="kt_signup" href="#" class="kt-link">Sign Up</a>
                </div>
            </div>
            <!--begin::Head-->
        </div>
        <!--end::Item-->
        <!--begin::Item-->
        <div class="kt-grid__item kt-grid kt-grid--ver kt-grid__item--fluid ">
            <!--begin::Body-->
            <div class="kt-login-v1__body">
                <!--begin::Section-->
                <div class="kt-login-v1__body-section">
                    <div class="kt-login-v1__body-section-info">
                        <h3>
                            Velkommen til WePlan.dk
                        </h3>
                        <p>Log ind for at fortsætte</p>
                    </div>
                </div>
                <!--begin::Section-->
                <!--begin::Separator-->
                <div class="kt-login-v1__body-seaprator"></div>
                <!--end::Separator-->
                <!--begin::Wrapper-->
                <div id="kt_login_form" class="kt-login-v1__body-wrapper">
                    <div class="kt-login-v1__body-container">
                        <h3 class="kt-login-v1__body-title">
                            {{ __("Please Sign in") }}
                        </h3>
                        <!--begin::Form-->
                        <form class="kt-login-v1__body-form kt-form" autocomplete="new-password" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" placeholder="{{ __('E-Mail Address') }}" name="email" autocomplete="new-password">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback kt-padding-l-30" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} transparent" type="password" placeholder="{{ __('Password') }}" name="password" autocomplete="new-password">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback kt-padding-l-30" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <!--begin::Action-->
                            <div class="kt-login-v1__body-action">
                                <a href="#" class="kt-link" id="kt_forgot"> <span>{{ __('Forgot Your Password?') }}</span> </a>
                                <button id="kt_login_submit" type="submit" class="btn btn-pill btn-elevate">Sign In</button>
                            </div>
                            <!--end::Action-->
                        </form>
                        <!--end::Form-->
                        <!--begin::Divider-->
                        <div class="kt-login-v1__body-divider">
                            <div class="kt-divider"> <span></span> <span>OR</span> <span></span> </div>
                        </div>
                        <!--end::Divider-->
                        <!--begin::Options-->
                        <div class="kt-login-v1__body-options">
                            <a href="#" class="btn"> <i class="fab fa-facebook-f"></i> Fcebook </a>
                            <a href="#" class="btn"> <i class="fab fa-twitter"></i> Twitter </a>
                            <a href="#" class="btn"> <i class="fab fa-google"></i> Google </a>
                        </div>
                        <!--end::Options-->
                    </div>
                </div>
                <!--end::Wrapper-->

                <!--begin::Wrapper-->
                <div style="display:none" id="kt_signup_form" class="kt-login-v1__body-wrapper">
                    <div class="kt-login-v1__body-container">
                        <h3 class="kt-login-v1__body-title">
                            {{ __("Sign up here") }}
                        </h3>
                        <!--begin::Form-->
                        <form class="kt-login-v1__body-form kt-form" method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
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
                                <div class="col kt-align-center">
                                    <label id="register_agree" class="kt-checkbox kt-checkbox--brand kt-checkbox--bold">
                                        <input type="checkbox" name="agree" c> I Agree the <a href="#" class="kt-link kt-link--danger">terms and conditions</a>.
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col kt-align-center">
                                <button type="submit" id="kt_signup_submit" class="btn btn-success btn-elevate btn-pill btn-lg"><em class="fa fa-check"></em> {{ __('Register') }}</button>
                                <button id="kt_signup_cancel" class="btn btn-outline-brand btn-elevate btn-pill btn-lg kt_login_cancel"><em class="fa fa-undo"></em> {{ __("Cancel") }}</button>
                            </div>
                        </form>
                        <!--end::Form-->
                        <!--begin::Divider-->
                        <div class="kt-login-v1__body-divider">
                            <div class="kt-divider"> <span></span> <span>OR</span> <span></span> </div>
                        </div>
                        <!--end::Divider-->
                        <!--begin::Options-->
                        <div class="kt-login-v1__body-options kt-margin-l-25 kt-margin-r-25">
                            <a href="#" class="btn kt-margin-5"> <i class="fab fa-facebook-f"></i> Facebook </a>
                            <a href="#" class="btn kt-margin-5"> <i class="fab fa-google"></i> Google </a>
                        </div>
                        <!--end::Options-->
                    </div>
                </div>
                <!--end::Wrapper-->

                <!--begin::Wrapper-->
                <div style="display:none" id="kt_forgot_form" class="kt-login-v1__body-wrapper">
                    <div class="kt-login-v1__body-container">
                        <h3 class="kt-login-v1__body-title">
                            {{ __("Forgot your password?") }}
                        </h3>
                        <!--begin::Form-->
                        <form class="kt-login-v1__body-form kt-form" method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                            @csrf
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="{{ __('E-Mail Address') }}" name="email" id="forgot_email" autocomplete="new-password" value="{{ $email ?? old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col kt-align-center">
                                <button type="submit" id="kt_forgot_submit" class="btn btn-success btn-elevate btn-pill btn-lg"><em class="fa fa-check"></em> {{ __('Reset password') }}</button>
                                <button id="kt_forgot_cancel" class="btn btn-outline-brand btn-elevate btn-pill btn-lg kt_login_cancel"><em class="fa fa-undo"></em> {{ __("Cancel") }}</button>
                            </div>
                        </form>
                        <!--end::Form-->
                        <!--begin::Divider-->
                        <div class="kt-login-v1__body-divider">
                            <div class="kt-divider"> <span></span> <span>OR</span> <span></span> </div>
                        </div>
                        <!--end::Divider-->
                        <!--begin::Options-->
                        <div class="kt-login-v1__body-options kt-margin-l-25 kt-margin-r-25">
                            <a href="#" class="btn kt-margin-5"> <i class="fab fa-facebook-f"></i> Facebook </a>
                            <a href="#" class="btn kt-margin-5"> <i class="fab fa-google"></i> Google </a>
                        </div>
                        <!--end::Options-->
                    </div>
                </div>
                <!--end::Wrapper-->
            </div>
            <!--begin::Body-->
        </div>
        <!--end::Item-->
        <!--begin::Item-->
        <div class="kt-grid__item">
            <div class="kt-login-v1__footer">
                <div class="kt-login-v1__footer-link"> <a href="#" class="kt-link">Privacy</a> <a href="#" class="kt-link">Legal</a> <a href="#" class="kt-link">Contact</a> </div>
                <div class="kt-login-v1__footer-info"> <a href="https://pixel8.dk" class="kt-link">&copy; {{ date("Y") }} Pixel8</a> </div>
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
