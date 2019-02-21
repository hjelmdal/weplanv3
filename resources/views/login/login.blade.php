<?php
/**
 * Created by PhpStorm.
 * User: hjelmdal
 * Date: 21/02/2019
 * Time: 18.34
 */
?>
@section("styles")
    <link href="{{ config("app.keen_assets") }}/custom/user/login-v1.css" rel="stylesheet" type="text/css" />
@endsection
@section("scripts")
    <script src="{{ config("app.keen_assets") }}/demo/default/custom/custom/login/login.js" type="text/javascript"></script>
@endsection
    <!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<head>
    @include("layouts.theme._head")
</head>
<!-- end::Head -->
<!-- begin::Body -->
<body style="background-image: url(/img/weplan_2880x1800.jpg)" class="k-login-v1--enabled k-header--fixed k-header-mobile--fixed k-subheader--enabled k-subheader--transparent k-aside--enabled k-aside--fixed k-page--loading" >
<!-- begin:: Page -->
<div class="k-grid k-grid--ver k-grid--root">
    <div class="k-grid__item k-grid__item--fluid k-grid k-grid k-grid--hor k-login-v1" id="k_login_v1">
        <!--begin::Item-->
        <div class="k-grid__item k-grid--hor">
            <!--begin::Heade-->
            <div class="k-login-v1__head">
                <div class="k-login-v1__head-logo">
                    <a href="#">
                        <img src="/img/weplan_486x135_black.png" alt="" height="40" />
                    </a>
                </div>
                <div class="k-login-v1__head-signup">
                    <h4>
                        Don't have an account?
                    </h4>
                    <a href="#" class="k-link">Sign Up</a>
                </div>
            </div>
            <!--begin::Head-->
        </div>
        <!--end::Item-->
        <!--begin::Item-->
        <div class="k-grid__item k-grid k-grid--ver k-grid__item--fluid ">
            <!--begin::Body-->
            <div class="k-login-v1__body">
                <!--begin::Section-->
                <div class="k-login-v1__body-section">
                    <div class="k-login-v1__body-section-info">
                        <h3>
                            Whatever CTA's wave purpose important exit element
                        </h3>
                        <p>Lorem ipsum lian amet estudiat</p>
                    </div>
                </div>
                <!--begin::Section-->
                <!--begin::Separator-->
                <div class="k-login-v1__body-seaprator"></div>
                <!--end::Separator-->
                <!--begin::Wrapper-->
                <div class="k-login-v1__body-wrapper">
                    <div class="k-login-v1__body-container">
                        <h3 class="k-login-v1__body-title">
                            Sign To Account
                        </h3>
                        <!--begin::Form-->
                        <form class="k-login-v1__body-form k-form" action="#" autocomplete="new-password" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" placeholder="{{ __('E-Mail Address') }}" name="email" autocomplete="new-password">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback k-padding-l-30" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" placeholder="{{ __('Password') }}" name="password" autocomplete="new-password">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback k-padding-l-30" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <!--begin::Action-->
                            <div class="k-login-v1__body-action">
                                <a href="#" class="k-link"> <span>Forgot Password ?</span> </a>
                                <button type="submit" class="btn btn-pill btn-elevate">Sign In</button>
                            </div>
                            <!--end::Action-->
                        </form>
                        <!--end::Form-->
                        <!--begin::Divider-->
                        <div class="k-login-v1__body-divider">
                            <div class="k-divider"> <span></span> <span>OR</span> <span></span> </div>
                        </div>
                        <!--end::Divider-->
                        <!--begin::Options-->
                        <div class="k-login-v1__body-options">
                            <a href="#" class="btn"> <i class="fab fa-facebook-f"></i> Fcebook </a>
                            <a href="#" class="btn"> <i class="fab fa-twitter"></i> Twitter </a>
                            <a href="#" class="btn"> <i class="fab fa-google"></i> Google </a>
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
        <div class="k-grid__item">
            <div class="k-login-v1__footer">
                <div class="k-login-v1__footer-link"> <a href="#" class="k-link">Privacy</a> <a href="#" class="k-link">Legal</a> <a href="#" class="k-link">Contact</a> </div>
                <div class="k-login-v1__footer-info"> <a href="#" class="k-link">&copy; 2018 KeenThemes</a> </div>
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