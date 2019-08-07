<?php
/**
 * Created by PhpStorm.
 * User: hjelmdal
 * Date: 25/02/2019
 * Time: 15.29
 */
?>
@extends("layouts.theme.index")
@section("meta")
    <script>
        const getUserUrl = '{{ route("api.v1.my-user") }}';
    </script>
@endsection
@section("scripts")
    <script src="{{ config("app.keen_assets") }}/app/custom/general/custom/profile/profile.js" type="text/javascript"></script>
    <script src="{{ route("index") }}/vuejs/profile/index.js?v={{ Helpers::gitVersion()->getVersion() }}"></script>
    @if(Session::has('resent'))
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function (event) {
            toastr.options.closeButton = true;
            toastr.options.positionClass = "toast-top-center";
            toastr.options.showMethod = "fadeIn";
            toastr.options.showDuration = 1000;
            toastr.options.extendedTimeOut = 100000;
            toastr.{{ Session::get('message-type','info') }}(' {{ __('A fresh verification link has been sent to your email address.') }}', '{{ Session::get('message-title',Session::get('title')) }}');
        });


    </script>

  @endif
@endsection
@section("styles")
    <link href="{{ config("app.keen_assets") }}/app/custom/user/profile-v1.demo5.css" rel="stylesheet" type="text/css" />
@endsection
@section("content")
    @if($user->UserStatus)
        <wizard></wizard>
   @endif
    <!--begin::Portlet-->
    <div class="kt-portlet kt-profile">
        <div class="kt-profile__content">
            <div class="row">
                <div class="col-md-12 col-lg-5 col-xl-4">
                    <div class="kt-profile__main">
                        <div class="kt-profile__main-pic">
                            <img src="@if(!$user->avatar)/img/profile.png @else{{$user->avatar}}@endif" alt=""/>
                            <label class="kt-profile__main-pic-upload" > <i class="flaticon-photo-camera"></i> </label>
                        </div>
                        <div class="kt-profile__main-info">
                            <div class="kt-profile__main-info-name">{{ $user->name }}</div>
                            <div class="kt-profile__main-info-position">{{ $user->email }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4 col-xl-4">
                    <div class="kt-profile__contact">
                        <a href="#" class="kt-profile__contact-item">
                            <span class="kt-profile__contact-item-icon kt-profile__contact-item-icon-whatsup"><i class="flaticon-whatsapp"></i></span>
                            <span class="kt-profile__contact-item-text">44 8475 804342</span>
                        </a>
                        <a href="#" class="kt-profile__contact-item">
                            <span class="kt-profile__contact-item-icon"><i class="flaticon-email-black-circular-button kt-font-danger"></i></span>
                            <span class="kt-profile__contact-item-text">{{$user->email}}</span>
                        </a>
                        <a href="#" class="kt-profile__contact-item">
                            <span class="kt-profile__contact-item-icon kt-profile__contact-item-icon-twitter"><i class="flaticon-twitter-logo-button"></i></span>
                            <span class="kt-profile__contact-item-text">@brianjohnson</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-12 col-lg-3 col-xl-4">
                    <div class="kt-profile__stats">
                        <div class="kt-profile__stats-item">
                            <div class="kt-profile__stats-item-label">Sales</div>
                            <div class="kt-profile__stats-item-chart">
                                <span>USP: +23%</span>
                                <canvas id="kt_profile_mini_chart_1" width="100" height="40"></canvas>
                            </div>
                        </div>
                        <div class="kt-profile__stats-item">
                            <div class="kt-profile__stats-item-label">Reports</div>
                            <div class="kt-profile__stats-item-chart">
                                <span>RNP: +30%</span>
                                <canvas id="kt_profile_mini_chart_2" width="100" height="40"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-profile__nav">
            <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#kt_tabs_1_1" role="tab">Dashboard</a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#kt_tabs_1_2" role="tab">Account & Profile</a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#kt_tabs_1_3" role="tab">Activities</a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#kt_tabs_1_4" role="tab">Tasks</a> </li>
            </ul>
        </div>
    </div>


    <!--end::Portlet-->
    @if(!$user->email_verified_at)
    <!--begin::Row-->
    <div class="row">
        <div class="col-12">
            <!--begin::Portlet-->
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Email verification
                        </h3>
                    </div>

                </div>
                <div class="kt-portlet__body">
                    <div class="kt-widget-16">
                        <div class="kt-align-center"><em class="far kt-font-brand fa-10x fa-paper-plane"></em><br><br>
                        <p style="font-size:1.5rem">{{ __('Before proceeding, please check your email for a verification link.') }}<br>
                        {{ __('If you did not receive the email') }}, <strong><a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a></strong>.
                        </p>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Portlet-->
        </div>
    </div>
    <!--end::Row-->
    @endif
    <div class="tab-content">
        <div class="tab-pane fade show active" id="kt_tabs_1_1" role="tabpanel">
        @if($user->email_verified_at)
            <!--begin::Row-->
            <div class="row">
                <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
                    <!--begin::Portlet-->
                    <div class="kt-portlet kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Top Categories
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-toolbar-wrapper">
                                    <div class="dropdown dropdown-inline">
                                        <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <ul class="kt-nav">
                                                <li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">Export Tools</span> </li>
                                                <li class="kt-nav__item">
                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-print"></i> <span class="kt-nav__link-text">Print</span> </a>
                                                </li>
                                                <li class="kt-nav__item">
                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-copy"></i> <span class="kt-nav__link-text">Copy</span> </a>
                                                </li>
                                                <li class="kt-nav__item">
                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-excel-o"></i> <span class="kt-nav__link-text">Excel</span> </a>
                                                </li>
                                                <li class="kt-nav__item">
                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-text-o"></i> <span class="kt-nav__link-text">CSV</span> </a>
                                                </li>
                                                <li class="kt-nav__item">
                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-pdf-o"></i> <span class="kt-nav__link-text">PDF</span> </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-widget-16">
                                <div class="kt-widget-16__item kt-widget-16__item--info">
                                    <div class="kt-widget-16__labels">
                                        <a href="">
                                            <div class="kt-widget-16__title">Templates</div>
                                        </a>
                                        <div class="kt-widget-16__desc">Front-end, Admin</div>
                                    </div>
                                    <div class="kt-widget-16__data">
                                        <div class="kt-widget-16__item-chart">
                                            <!--Doc: For the chart initialization refer to "latestProductsMiniCharts" function in "src\theme\app\scripts\custom\dashboard.js"
                         and "KLib.initMiniChart()" function in "themes/themes/keen/src/theme/app/scripts/bundle/lib.js" -->
                                            <canvas id="kt_widget_latest_products_chart_1" width="80" height="40"></canvas>
                                        </div>
                                        <div class="kt-widget-16__numbers">
                                            <div class="kt-widget-16__numbers-total">5.7k</div>
                                            <div class="kt-widget-16__numbers-change">+780</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-widget-16__item kt-widget-16__item--danger">
                                    <div class="kt-widget-16__labels">
                                        <a href="">
                                            <div class="kt-widget-16__title">Wordpress</div>
                                        </a>
                                        <div class="kt-widget-16__desc">eCommerce, Website</div>
                                    </div>
                                    <div class="kt-widget-16__data">
                                        <div class="kt-widget-16__item-chart">
                                            <!--Doc: For the chart initialization refer to "latestProductsMiniCharts" function in "src\theme\app\scripts\custom\dashboard.js"
                         and "KLib.initMiniChart()" function in "themes/themes/keen/src/theme/app/scripts/bundle/lib.js" -->
                                            <canvas id="kt_widget_latest_products_chart_6" width="80" height="40"></canvas>
                                        </div>
                                        <div class="kt-widget-16__numbers">
                                            <div class="kt-widget-16__numbers-total">2.8k</div>
                                            <div class="kt-widget-16__numbers-change">+350</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-widget-16__item kt-widget-16__item--warning">
                                    <div class="kt-widget-16__labels">
                                        <a href="">
                                            <div class="kt-widget-16__title">eCommerce</div>
                                        </a>
                                        <div class="kt-widget-16__desc">Fashion Websites</div>
                                    </div>
                                    <div class="kt-widget-16__data">
                                        <div class="kt-widget-16__item-chart">
                                            <!--Doc: For the chart initialization refer to "latestProductsMiniCharts" function in "src\theme\app\scripts\custom\dashboard.js"
                         and "KLib.initMiniChart()" function in "themes/themes/keen/src/theme/app/scripts/bundle/lib.js" -->
                                            <canvas id="kt_widget_latest_products_chart_3" width="80" height="40"></canvas>
                                        </div>
                                        <div class="kt-widget-16__numbers">
                                            <div class="kt-widget-16__numbers-total">9.3k</div>
                                            <div class="kt-widget-16__numbers-change">+2.1k</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-widget-16__item kt-widget-16__item--brand">
                                    <div class="kt-widget-16__labels">
                                        <a href="">
                                            <div class="kt-widget-16__title">UI/UX Design</div>
                                        </a>
                                        <div class="kt-widget-16__desc">Everything you like</div>
                                    </div>
                                    <div class="kt-widget-16__data">
                                        <div class="kt-widget-16__item-chart">
                                            <!--Doc: For the chart initialization refer to "latestProductsMiniCharts" function in "src\theme\app\scripts\custom\dashboard.js"
                         and "KLib.initMiniChart()" function in "themes/themes/keen/src/theme/app/scripts/bundle/lib.js" -->
                                            <canvas id="kt_widget_latest_products_chart_5" width="80" height="40"></canvas>
                                        </div>
                                        <div class="kt-widget-16__numbers">
                                            <div class="kt-widget-16__numbers-total">9.3k</div>
                                            <div class="kt-widget-16__numbers-change">+1.6k</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-widget-16__item kt-widget-16__item--success">
                                    <div class="kt-widget-16__labels">
                                        <a href="">
                                            <div class="kt-widget-16__title">SAAS Solution</div>
                                        </a>
                                        <div class="kt-widget-16__desc">Monthly Subscription</div>
                                    </div>
                                    <div class="kt-widget-16__data">
                                        <div class="kt-widget-16__item-chart">
                                            <!--Doc: For the chart initialization refer to "latestProductsMiniCharts" function in "src\theme\app\scripts\custom\dashboard.js"
                         and "KLib.initMiniChart()" function in "themes/themes/keen/src/theme/app/scripts/bundle/lib.js" -->
                                            <canvas id="kt_widget_latest_products_chart_4" width="80" height="40"></canvas>
                                        </div>
                                        <div class="kt-widget-16__numbers">
                                            <div class="kt-widget-16__numbers-total">5.7k</div>
                                            <div class="kt-widget-16__numbers-change">+598</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Portlet-->
                </div>
                <div class="col-lg-12 col-xl-8 order-lg-2 order-xl-1">
                    <!--begin::Portlet-->
                    <div class="kt-portlet kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    General Statistics
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-actions"> <a href="#" class="btn btn-default btn-sm btn-bold">XML</a> <a href="#" class="btn btn-default btn-sm btn-bold">CSV</a> </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body kt-portlet__body--fluid kt-portlet__body--fit">
                            <div class="kt-widget-2">
                                <div class="kt-widget-2__content kt-portlet__space-x">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-6 col-md-6 col-6">
                                            <div class="kt-widget-2__item">
                                                <div class="kt-widget-2__item-title"> Sales </div>
                                                <div class="kt-widget-2__item-stats">
                                                    <div class="kt-widget-2__item-info">
                                                        <div class="kt-widget-2__item-text"> USP: </div>
                                                        <div class="kt-widget-2__item-value"> +23% </div>
                                                    </div>
                                                    <div class="kt-widget-2__item-chart">
                                                        <!--Doc: For the chart initialization refer to "generalStatistics" function in "src\theme\app\scripts\custom\dashboard.js"
									and "KLib.initMiniChart()" function in "themes/themes/keen/src/theme/app/scripts/bundle/lib.js" -->
                                                        <canvas id="kt_widget_general_statistics_chart_1" width="80" height="40"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-md-6 col-6">
                                            <div class="kt-widget-2__item">
                                                <div class="kt-widget-2__item-title"> Products </div>
                                                <div class="kt-widget-2__item-stats">
                                                    <div class="kt-widget-2__item-info">
                                                        <div class="kt-widget-2__item-text"> MRT: </div>
                                                        <div class="kt-widget-2__item-value"> +10% </div>
                                                    </div>
                                                    <div class="kt-widget-2__item-chart">
                                                        <!--Doc: For the chart initialization refer to "generalStatistics" function in "src\theme\app\scripts\custom\dashboard.js"
									and "KLib.initMiniChart()" function in "themes/themes/keen/src/theme/app/scripts/bundle/lib.js" -->
                                                        <canvas id="kt_widget_general_statistics_chart_2" width="80" height="40"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-md-6 col-6">
                                            <div class="kt-widget-2__item">
                                                <div class="kt-widget-2__item-title"> Profit </div>
                                                <div class="kt-widget-2__item-stats">
                                                    <div class="kt-widget-2__item-info">
                                                        <div class="kt-widget-2__item-text"> FTP: </div>
                                                        <div class="kt-widget-2__item-value"> +19% </div>
                                                    </div>
                                                    <div class="kt-widget-2__item-chart">
                                                        <!--Doc: For the chart initialization refer to "generalStatistics" function in "src\theme\app\scripts\custom\dashboard.js"
									and "KLib.initMiniChart()" function in "themes/themes/keen/src/theme/app/scripts/bundle/lib.js" -->
                                                        <canvas id="kt_widget_general_statistics_chart_3" width="80" height="40"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-md-6 col-6">
                                            <div class="kt-widget-2__item">
                                                <div class="kt-widget-2__item-title"> Reports </div>
                                                <div class="kt-widget-2__item-stats">
                                                    <div class="kt-widget-2__item-info">
                                                        <div class="kt-widget-2__item-text"> RNP: </div>
                                                        <div class="kt-widget-2__item-value"> +30% </div>
                                                    </div>
                                                    <div class="kt-widget-2__item-chart">
                                                        <!--Doc: For the chart initialization refer to "generalStatistics" function in "src\theme\app\scripts\custom\dashboard.js"
									and "KLib.initMiniChart()" function in "themes/themes/keen/src/theme/app/scripts/bundle/lib.js" -->
                                                        <canvas id="kt_widget_general_statistics_chart_4" width="80" height="40"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-widget-2__stats">
                                        <div class="kt-widget-2__stats-author">
                                            <div class="kt-widget-2__stats-bullet kt-bg-brand"></div>
                                            <span class="kt-widget-2__stats-text">Author Sales</span>
                                        </div>
                                        <div class="kt-widget-2__stats-product">
                                            <div class="kt-widget-2__stats-bullet kt-bg-danger"></div>
                                            <span class="kt-widget-2__stats-text">Product Profit</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-widget-2__chart">
                                    <canvas id="kt_widget_general_statistics_chart_main" height="250"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Portlet-->
                </div>
                <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
                    <!--begin::Portlet-->
                    <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Work Progress
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-brand nav-tabs-bold" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#kt_portlet_tabs_1111_1_content" role="tab" aria-selected="false"> Emails </a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#kt_portlet_tabs_1111_2_content" role="tab" aria-selected="false"> Tickets </a> </li>
                                </ul>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="kt_portlet_tabs_1111_1_content" role="tabpanel">
                                    <div class="kt-widget-11">
                                        <div class="kt-widget-11__item">
                                            <div class="kt-widget-11__wrapper">
                                                <div class="kt-widget-11__title"> Pendings Tasks </div>
                                                <div class="kt-widget-11__value"> 78% </div>
                                            </div>
                                            <div class="kt-widget-11__progress">
                                                <div class="progress">
                                                    <!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-widget-11__item">
                                            <div class="kt-widget-11__wrapper">
                                                <div class="kt-widget-11__title"> Completed Tasks </div>
                                                <div class="kt-widget-11__value"> 320&nbsp;/&nbsp;<span class="kt-opacity-5">780</span> </div>
                                            </div>
                                            <div class="kt-widget-11__progress">
                                                <div class="progress">
                                                    <!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-widget-11__item">
                                            <div class="kt-widget-11__wrapper">
                                                <div class="kt-widget-11__title"> Tasks In Progress </div>
                                                <div class="kt-widget-11__value"> 45% </div>
                                            </div>
                                            <div class="kt-widget-11__progress">
                                                <div class="progress">
                                                    <!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
                                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-widget-11__item">
                                            <div class="kt-widget-11__wrapper">
                                                <div class="kt-widget-11__title"> All Tasks </div>
                                                <div class="kt-widget-11__value"> 1200 </div>
                                            </div>
                                            <div class="kt-widget-11__progress">
                                                <div class="progress">
                                                    <!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-widget-11__item">
                                            <div class="kt-widget-11__wrapper">
                                                <div class="kt-widget-11__title"> Reports </div>
                                                <div class="kt-widget-11__value"> 40 </div>
                                            </div>
                                            <div class="kt-widget-11__progress">
                                                <div class="progress">
                                                    <!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-margin-t-30 kt-align-center"> <a href="#" class="btn btn-brand btn-upper btn-bold kt-align-center">Full Report</a> </div>
                                </div>
                                <div class="tab-pane fade" id="kt_portlet_tabs_1111_2_content" role="tabpanel">
                                    <div class="kt-widget-11">
                                        <div class="kt-widget-11__item">
                                            <div class="kt-widget-11__wrapper">
                                                <div class="kt-widget-11__title"> Pendings Tasks </div>
                                                <div class="kt-widget-11__value"> 78% </div>
                                            </div>
                                            <div class="kt-widget-11__progress">
                                                <div class="progress">
                                                    <!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
                                                    <div class="progress-bar bg-info" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-widget-11__item">
                                            <div class="kt-widget-11__wrapper">
                                                <div class="kt-widget-11__title"> Completed Tasks </div>
                                                <div class="kt-widget-11__value"> 320&nbsp;/&nbsp;<span class="kt-opacity-5">780</span> </div>
                                            </div>
                                            <div class="kt-widget-11__progress">
                                                <div class="progress">
                                                    <!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
                                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 58%" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-widget-11__item">
                                            <div class="kt-widget-11__wrapper">
                                                <div class="kt-widget-11__title"> Tasks In Progress </div>
                                                <div class="kt-widget-11__value"> 45% </div>
                                            </div>
                                            <div class="kt-widget-11__progress">
                                                <div class="progress">
                                                    <!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-widget-11__item">
                                            <div class="kt-widget-11__wrapper">
                                                <div class="kt-widget-11__title"> All Tasks </div>
                                                <div class="kt-widget-11__value"> 1200 </div>
                                            </div>
                                            <div class="kt-widget-11__progress">
                                                <div class="progress">
                                                    <!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-widget-11__item">
                                            <div class="kt-widget-11__wrapper">
                                                <div class="kt-widget-11__title"> Reports </div>
                                                <div class="kt-widget-11__value"> 40 </div>
                                            </div>
                                            <div class="kt-widget-11__progress">
                                                <div class="progress">
                                                    <!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-margin-t-30 kt-align-center"> <a href="#" class="btn btn-brand btn-upper btn-bold kt-align-center">Full Report</a> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Portlet-->
                </div>
                <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
                    <!--begin::Portlet-->
                    <div class="kt-portlet kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Daily Salles
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-actions"> <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">CSV</a> </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-widget-4">
                                <div class="kt-widget-4__item">
                                    <div class="kt-widget-4__item-content">
                                        <div class="kt-widget-4__item-section">
                                            <div class="kt-widget-4__item-pic">
                                                <img class="" src="{{ config("app.keen_assets") }}/media/users/100_3.jpg" alt="" />
                                            </div>
                                            <div class="kt-widget-4__item-info">
                                                <a href="#" class="kt-widget-4__item-username">Chris Bent</a>
                                                <div class="kt-widget-4__item-desc">SUV Themes Carp</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-widget-4__item-content">
                                        <div class="kt-widget-4__item-price"> <span class="kt-widget-4__item-badge">$</span> <span class="kt-widget-4__item-number">830</span> </div>
                                    </div>
                                </div>
                                <div class="kt-widget-4__item">
                                    <div class="kt-widget-4__item-content">
                                        <div class="kt-widget-4__item-section">
                                            <div class="kt-widget-4__item-pic">
                                                <img class="" src="{{ config("app.keen_assets") }}/media/users/100_4.jpg" alt="" />
                                            </div>
                                            <div class="kt-widget-4__item-info">
                                                <a href="#" class="kt-widget-4__item-username">Ashley Stock</a>
                                                <div class="kt-widget-4__item-desc">Merscedes Benz AMGww</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-widget-4__item-content">
                                        <div class="kt-widget-4__item-price"> <span class="kt-widget-4__item-badge">$</span> <span class="kt-widget-4__item-number">675</span> </div>
                                    </div>
                                </div>
                                <div class="kt-widget-4__item">
                                    <div class="kt-widget-4__item-content">
                                        <div class="kt-widget-4__item-section">
                                            <div class="kt-widget-4__item-pic">
                                                <img class="" src="{{ config("app.keen_assets") }}/media/users/100_5.jpg" alt="" />
                                            </div>
                                            <div class="kt-widget-4__item-info">
                                                <a href="#" class="kt-widget-4__item-username">Jimmy Yesuku</a>
                                                <div class="kt-widget-4__item-desc">All Nippon United Airlines</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-widget-4__item-content">
                                        <div class="kt-widget-4__item-price"> <span class="kt-widget-4__item-badge">$</span> <span class="kt-widget-4__item-number">194</span> </div>
                                    </div>
                                </div>
                                <div class="kt-widget-4__item">
                                    <div class="kt-widget-4__item-content">
                                        <div class="kt-widget-4__item-section">
                                            <div class="kt-widget-4__item-pic">
                                                <img class="" src="{{ config("app.keen_assets") }}/media/users/100_2.jpg" alt="" />
                                            </div>
                                            <div class="kt-widget-4__item-info">
                                                <a href="#" class="kt-widget-4__item-username">Amanda West</a>
                                                <div class="kt-widget-4__item-desc">Comboy Westem Limited</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-widget-4__item-content">
                                        <div class="kt-widget-4__item-price"> <span class="kt-widget-4__item-badge">$</span> <span class="kt-widget-4__item-number">65</span> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Portlet-->
                </div>
                <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
                    <!--begin::Portlet-->
                    <div class="kt-portlet kt-portlet--height-fluid kt-portlet--tabs">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Latest Tasks
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-brand nav-tabs-bold" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#kt_portlet_tabs_1_1_content" role="tab" aria-selected="false"> Today </a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#kt_portlet_tabs_1_2_content" role="tab" aria-selected="false"> Week </a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#kt_portlet_tabs_1_3_content" role="tab" aria-selected="true"> Month </a> </li>
                                </ul>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="kt_portlet_tabs_1_1_content" role="tabpanel">
                                    <div class="kt-widget-5">
                                        <div class="kt-widget-5__item kt-widget-5__item--info">
                                            <div class="kt-widget-5__item-info">
                                                <a href="#" class="kt-widget-5__item-title"> Management meeting </a>
                                                <div class="kt-widget-5__item-datetime"> 09:30 AM </div>
                                            </div>
                                            <div class="kt-widget-5__item-check">
                                                <label class="kt-radio">
                                                    <input type="radio" checked="checked" name="radio1">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="kt-widget-5__item kt-widget-5__item--danger">
                                            <div class="kt-widget-5__item-info">
                                                <a href="#" class="kt-widget-5__item-title"> Replace datatables rows color </a>
                                                <div class="kt-widget-5__item-datetime"> 12:00 AM </div>
                                            </div>
                                            <div class="kt-widget-5__item-check">
                                                <label class="kt-radio">
                                                    <input type="radio" checked="checked" name="radio1">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="kt-widget-5__item kt-widget-5__item--brand">
                                            <div class="kt-widget-5__item-info">
                                                <a href="#" class="kt-widget-5__item-title"> Export Navitare booking table </a>
                                                <div class="kt-widget-5__item-datetime"> 01:20 PM </div>
                                            </div>
                                            <div class="kt-widget-5__item-check">
                                                <label class="kt-radio">
                                                    <input type="radio" checked="checked" name="radio1">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="kt-widget-5__item kt-widget-5__item--success">
                                            <div class="kt-widget-5__item-info">
                                                <a href="#" class="kt-widget-5__item-title"> NYCS internal discussion </a>
                                                <div class="kt-widget-5__item-datetime"> 03: 00 PM </div>
                                            </div>
                                            <div class="kt-widget-5__item-check">
                                                <label class="kt-radio">
                                                    <input type="radio" checked="checked" name="radio1">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="kt-widget-5__item kt-widget-5__item--danger">
                                            <div class="kt-widget-5__item-info">
                                                <a href="#" class="kt-widget-5__item-title"> Project Launch </a>
                                                <div class="kt-widget-5__item-datetime"> 11: 00 AM </div>
                                            </div>
                                            <div class="kt-widget-5__item-check">
                                                <label class="kt-radio">
                                                    <input type="radio" checked="checked" name="radio1">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="kt-widget-5__item kt-widget-5__item--success">
                                            <div class="kt-widget-5__item-info">
                                                <a href="#" class="kt-widget-5__item-title"> Server maintenance </a>
                                                <div class="kt-widget-5__item-datetime"> 4: 30 PM </div>
                                            </div>
                                            <div class="kt-widget-5__item-check">
                                                <label class="kt-radio">
                                                    <input type="radio" checked="checked" name="radio1">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="kt_portlet_tabs_1_2_content" role="tabpanel">
                                    <div class="kt-widget-5">
                                        <div class="kt-widget-5__item kt-widget-5__item--brand">
                                            <div class="kt-widget-5__item-info">
                                                <a href="#" class="kt-widget-5__item-title"> Export Navitare booking table </a>
                                                <div class="kt-widget-5__item-datetime"> 01:20 PM </div>
                                            </div>
                                            <div class="kt-widget-5__item-check">
                                                <label class="kt-radio">
                                                    <input type="radio" checked="checked" name="radio1">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="kt-widget-5__item kt-widget-5__item--danger">
                                            <div class="kt-widget-5__item-info">
                                                <a href="#" class="kt-widget-5__item-title"> Replace datatables rows color </a>
                                                <div class="kt-widget-5__item-datetime"> 12:00 AM </div>
                                            </div>
                                            <div class="kt-widget-5__item-check">
                                                <label class="kt-radio">
                                                    <input type="radio" checked="checked" name="radio1">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="kt-widget-5__item kt-widget-5__item--brand">
                                            <div class="kt-widget-5__item-info">
                                                <a href="#" class="kt-widget-5__item-title"> Export Navitare booking table </a>
                                                <div class="kt-widget-5__item-datetime"> 01:20 PM </div>
                                            </div>
                                            <div class="kt-widget-5__item-check">
                                                <label class="kt-radio">
                                                    <input type="radio" checked="checked" name="radio1">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="kt-widget-5__item kt-widget-5__item--danger">
                                            <div class="kt-widget-5__item-info">
                                                <a href="#" class="kt-widget-5__item-title"> Replace datatables rows color </a>
                                                <div class="kt-widget-5__item-datetime"> 12:00 AM </div>
                                            </div>
                                            <div class="kt-widget-5__item-check">
                                                <label class="kt-radio">
                                                    <input type="radio" checked="checked" name="radio1">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="kt-widget-5__item kt-widget-5__item--success">
                                            <div class="kt-widget-5__item-info">
                                                <a href="#" class="kt-widget-5__item-title"> NYCS internal discussion </a>
                                                <div class="kt-widget-5__item-datetime "> 03: 00 PM </div>
                                            </div>
                                            <div class="kt-widget-5__item-check ">
                                                <label class="kt-radio">
                                                    <input type="radio" checked="checked" name="radio1">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="kt-widget-5__item kt-widget-5__item--info ">
                                            <div class="kt-widget-5__item-info ">
                                                <a href="#" class="kt-widget-5__item-title"> Management meeting </a>
                                                <div class="kt-widget-5__item-datetime "> 09:30 AM </div>
                                            </div>
                                            <div class="kt-widget-5__item-check ">
                                                <label class="kt-radio">
                                                    <input type="radio" checked="checked" name="radio1">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade " id="kt_portlet_tabs_1_3_content" role="tabpanel">
                                    <div class="kt-widget-5 ">
                                        <div class="kt-widget-5__item kt-widget-5__item--success">
                                            <div class="kt-widget-5__item-info ">
                                                <a href="#" class="kt-widget-5__item-title"> NYCS internal discussion </a>
                                                <div class="kt-widget-5__item-datetime"> 03: 00 PM </div>
                                            </div>
                                            <div class="kt-widget-5__item-check">
                                                <label class="kt-radio">
                                                    <input type="radio" checked="checked" name="radio1">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="kt-widget-5__item kt-widget-5__item--danger">
                                            <div class="kt-widget-5__item-info ">
                                                <a href="#" class="kt-widget-5__item-title"> Replace datatables rows color </a>
                                                <div class="kt-widget-5__item-datetime"> 12:00 AM </div>
                                            </div>
                                            <div class="kt-widget-5__item-check">
                                                <label class="kt-radio">
                                                    <input type="radio" checked="checked" name="radio1">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="kt-widget-5__item kt-widget-5__item--danger">
                                            <div class="kt-widget-5__item-info">
                                                <a href="#" class="kt-widget-5__item-title"> Replace datatables rows color </a>
                                                <div class="kt-widget-5__item-datetime"> 12:00 AM </div>
                                            </div>
                                            <div class="kt-widget-5__item-check">
                                                <label class="kt-radio">
                                                    <input type="radio" checked="checked" name="radio1">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="kt-widget-5__item kt-widget-5__item--brand">
                                            <div class="kt-widget-5__item-info">
                                                <a href="#" class="kt-widget-5__item-title"> Export Navitare booking table </a>
                                                <div class="kt-widget-5__item-datetime"> 01:20 PM </div>
                                            </div>
                                            <div class="kt-widget-5__item-check">
                                                <label class="kt-radio">
                                                    <input type="radio" checked="checked" name="radio1">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="kt-widget-5__item kt-widget-5__item--brand">
                                            <div class="kt-widget-5__item-info ">
                                                <a href="#" class="kt-widget-5__item-title"> Export Navitare booking table </a>
                                                <div class="kt-widget-5__item-datetime "> 01:20 PM </div>
                                            </div>
                                            <div class="kt-widget-5__item-check">
                                                <label class="kt-radio">
                                                    <input type="radio" checked="checked" name="radio1">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="kt-widget-5__item kt-widget-5__item--info">
                                            <div class="kt-widget-5__item-info ">
                                                <a href="#" class="kt-widget-5__item-title"> Management meeting </a>
                                                <div class="kt-widget-5__item-datetime"> 09:30 AM </div>
                                            </div>
                                            <div class="kt-widget-5__item-check">
                                                <label class="kt-radio">
                                                    <input type="radio" checked="checked" name="radio1">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Portlet-->
                </div>
            </div>
            <!--end::Row-->
            @endif
        </div>
        <div class="tab-pane fade" id="kt_tabs_1_2" role="tabpanel">
            <!--begin::Row-->
            <div class="row">
                <div class="col-lg-4 col-xl-3">
                    <div class="kt-portlet">
                        <div class="kt-portlet__body kt-portlet__body--fit">
                            <ul class="kt-nav kt-nav--bold kt-nav--md-space kt-nav--v3 kt-margin-t-20 kt-margin-b-20 nav nav-tabs" role="tablist">
                                <li class="kt-nav__item">
                                    <a class="kt-nav__link active" data-toggle="tab" href="#kt_profile_tab_personal_information" role="tab">
                                        <span class="kt-nav__link-icon"><i class="flaticon2-user-outline-symbol"></i></span>
                                        <span class="kt-nav__link-text">Personal Information</span>
                                        <span class="kt-nav__link-badge"><span class="kt-badge kt-badge--brand kt-badge--inline">2/4 completed</span></span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a class="kt-nav__link" data-toggle="tab" href="#kt_profile_tab_account_information" role="tab">
                                        <span class="kt-nav__link-icon"><i class="flaticon2-soft-icons-1"></i></span>
                                        <span class="kt-nav__link-text">Acccount Information</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a class="kt-nav__link" data-toggle="tab" href="#kt_profile_change_password" role="tab">
                                        <span class="kt-nav__link-icon"><i class="flaticon2-lock"></i></span>
                                        <span class="kt-nav__link-text">Change Password</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a class="kt-nav__link" data-toggle="tab" href="#kt_profile_email_settings" role="tab">
                                        <span class="kt-nav__link-icon"><i class="flaticon2-mail"></i></span>
                                        <span class="kt-nav__link-text">Email Settings</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a class="kt-nav__link" href="#" role="tab" data-toggle="kt-tooltip" title="This feature is coming soon!" data-placement="right">
                                        <span class="kt-nav__link-icon"><i class="flaticon2-document"></i></span>
                                        <span class="kt-nav__link-text">Saved Credit Cards</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a class="kt-nav__link" href="#" role="tab" data-toggle="kt-tooltip" title="This feature is coming soon!" data-placement="right">
                                        <span class="kt-nav__link-icon"><i class="flaticon2-calendar-3"></i></span>
                                        <span class="kt-nav__link-text">Social Networks</span>
                                        <span class="kt-nav__link-badge"><span class="kt-badge kt-badge--danger">3</span></span>
                                    </a>
                                </li>
                                <li class="kt-nav__separator"></li>
                                <li class="kt-nav__item">
                                    <a class="kt-nav__link" href="#" role="tab" data-toggle="kt-tooltip" title="This feature is coming soon!" data-placement="right">
                                        <span class="kt-nav__link-icon"><i class="flaticon2-calendar-3"></i></span>
                                        <span class="kt-nav__link-text">Tax Information</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a class="kt-nav__link" href="#" role="tab" data-toggle="kt-tooltip" title="This feature is coming soon!" data-placement="right">
                                        <span class="kt-nav__link-icon"><i class="flaticon2-shopping-cart-1"></i></span>
                                        <span class="kt-nav__link-text">Purchases</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a class="kt-nav__link" href="#" role="tab" data-toggle="kt-tooltip" title="This feature is coming soon!" data-placement="right">
                                        <span class="kt-nav__link-icon"><i class="flaticon2-browser-2"></i></span>
                                        <span class="kt-nav__link-text">Statements</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a class="kt-nav__link" href="#" role="tab" data-toggle="kt-tooltip" title="This feature is coming soon!" data-placement="right">
                                        <span class="kt-nav__link-icon"><i class="flaticon2-cardiogram"></i></span>
                                        <span class="kt-nav__link-text">Audit Log</span>
                                        <span class="kt-nav__link-badge"><span class="kt-badge kt-badge--warning kt-badge--inline">23 new</span></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Work Progress
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-widget-11">
                                <div class="kt-widget-11__item">
                                    <div class="kt-widget-11__wrapper">
                                        <div class="kt-widget-11__title"> Pendings Tasks </div>
                                        <div class="kt-widget-11__value"> 78% </div>
                                    </div>
                                    <div class="kt-widget-11__progress">
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-widget-11__item">
                                    <div class="kt-widget-11__wrapper">
                                        <div class="kt-widget-11__title"> Completed Tasks </div>
                                        <div class="kt-widget-11__value"> 320&nbsp;/&nbsp;<span class="kt-opacity-5">780</span> </div>
                                    </div>
                                    <div class="kt-widget-11__progress">
                                        <div class="progress">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-widget-11__item">
                                    <div class="kt-widget-11__wrapper">
                                        <div class="kt-widget-11__title"> Tasks In Progress </div>
                                        <div class="kt-widget-11__value"> 45% </div>
                                    </div>
                                    <div class="kt-widget-11__progress">
                                        <div class="progress">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-widget-11__item">
                                    <div class="kt-widget-11__wrapper">
                                        <div class="kt-widget-11__title"> All Tasks </div>
                                        <div class="kt-widget-11__value"> 1200 </div>
                                    </div>
                                    <div class="kt-widget-11__progress">
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-margin-t-30 kt-align-center"> <a href="#" class="btn btn-sm btn-brand btn-upper btn-bold kt-align-center">Full Report</a> </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-xl-9">
                    <div class="tab-content">
                        <!--begin: Personal Information-->
                        <div class="tab-pane fade show active" id="kt_profile_tab_personal_information" role="tabpanel">
                            <div class="kt-portlet">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                            Personal Information <small>update your personal informaiton</small>
                                        </h3>
                                    </div>
                                    <div class="kt-portlet__head-toolbar">
                                        <div class="kt-portlet__head-wrapper">
                                            <div class="dropdown dropdown-inline">
                                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon2-gear"></i> </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul class="kt-nav">
                                                        <li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">Export Tools</span> </li>
                                                        <li class="kt-nav__item">
                                                            <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-print"></i> <span class="kt-nav__link-text">Print</span> </a>
                                                        </li>
                                                        <li class="kt-nav__item">
                                                            <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-copy"></i> <span class="kt-nav__link-text">Copy</span> </a>
                                                        </li>
                                                        <li class="kt-nav__item">
                                                            <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-excel-o"></i> <span class="kt-nav__link-text">Excel</span> </a>
                                                        </li>
                                                        <li class="kt-nav__item">
                                                            <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-text-o"></i> <span class="kt-nav__link-text">CSV</span> </a>
                                                        </li>
                                                        <li class="kt-nav__item">
                                                            <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-pdf-o"></i> <span class="kt-nav__link-text">PDF</span> </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form class="kt-form kt-form--label-right">
                                    <div class="kt-portlet__body">
                                        <div class="kt-section kt-section--first">
                                            <div class="kt-section__body">
                                                <div class="row">
                                                    <label class="col-xl-3"></label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <h3 class="kt-section__title kt-section__title-sm">
                                                            Customer Info:
                                                        </h3>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Avatar</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="kt-avatar kt-avatar--outline kt-avatar--circle" id="kt_profile_avatar">
                                                            <div class="kt-avatar__holder" style="background-image: url({{ config("app.keen_assets") }}/media/users/300_21.jpg)"></div>
                                                            <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="Change avatar">
                                                                <i class="fa fa-pen"></i>
                                                                <input type='file' name="profile_avatar" accept=".png, .jpg, .jpeg"/>
                                                            </label>
                                                            <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="Cancel avatar"> <i class="fa fa-times"></i> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">First Name</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" value="Nick">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Last Name</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" value="Watson">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Company Name</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" value="Loop Inc.">
                                                        <span class="form-text text-muted">If you want your invoices addressed to a company. Leave blank to use your full name.</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Contact Phone</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="la la-phone"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control" value="+45678967456" placeholder="Phone" aria-describedby="basic-addon1">
                                                        </div>
                                                        <span class="form-text text-muted">We'll never share your email with anyone else.</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="la la-at"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control" value="nick.watson@loop.com" placeholder="Email" aria-describedby="basic-addon1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-last row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Company Site</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" placeholder="Username" value="loop">
                                                            <div class="input-group-append"><span class="input-group-text">.com</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
                                        <div class="kt-section kt-section--first">
                                            <div class="kt-section__body">
                                                <div class="row">
                                                    <label class="col-xl-3"></label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <h3 class="kt-section__title kt-section__title-sm">
                                                            Address Details:
                                                        </h3>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Country</label>
                                                    <div class="col-lg-9 col-xl-6" >
                                                        <select class="form-control">
                                                            <option value="AF">Afghanistan</option>
                                                            <option value="AX">Åland Islands</option>
                                                            <option value="AL">Albania</option>
                                                            <option value="DZ">Algeria</option>
                                                            <option value="AS">American Samoa</option>
                                                            <option value="AD">Andorra</option>
                                                            <option value="AO">Angola</option>
                                                            <option value="AI">Anguilla</option>
                                                            <option value="AQ">Antarctica</option>
                                                            <option value="AG">Antigua and Barbuda</option>
                                                            <option value="AR">Argentina</option>
                                                            <option value="AM">Armenia</option>
                                                            <option value="AW">Aruba</option>
                                                            <option value="AU">Australia</option>
                                                            <option value="AT">Austria</option>
                                                            <option value="AZ">Azerbaijan</option>
                                                            <option value="BS">Bahamas</option>
                                                            <option value="BH">Bahrain</option>
                                                            <option value="BD">Bangladesh</option>
                                                            <option value="BB">Barbados</option>
                                                            <option value="BY">Belarus</option>
                                                            <option value="BE">Belgium</option>
                                                            <option value="BZ">Belize</option>
                                                            <option value="BJ">Benin</option>
                                                            <option value="BM">Bermuda</option>
                                                            <option value="BT">Bhutan</option>
                                                            <option value="BO">Bolivia, Plurinational State of</option>
                                                            <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                                            <option value="BA">Bosnia and Herzegovina</option>
                                                            <option value="BW">Botswana</option>
                                                            <option value="BV">Bouvet Island</option>
                                                            <option value="BR">Brazil</option>
                                                            <option value="IO">British Indian Ocean Territory</option>
                                                            <option value="BN">Brunei Darussalam</option>
                                                            <option value="BG">Bulgaria</option>
                                                            <option value="BF">Burkina Faso</option>
                                                            <option value="BI">Burundi</option>
                                                            <option value="KH">Cambodia</option>
                                                            <option value="CM">Cameroon</option>
                                                            <option value="CA">Canada</option>
                                                            <option value="CV">Cape Verde</option>
                                                            <option value="KY">Cayman Islands</option>
                                                            <option value="CF">Central African Republic</option>
                                                            <option value="TD">Chad</option>
                                                            <option value="CL">Chile</option>
                                                            <option value="CN">China</option>
                                                            <option value="CX">Christmas Island</option>
                                                            <option value="CC">Cocos (Keeling) Islands</option>
                                                            <option value="CO">Colombia</option>
                                                            <option value="KM">Comoros</option>
                                                            <option value="CG">Congo</option>
                                                            <option value="CD">Congo, the Democratic Republic of the</option>
                                                            <option value="CK">Cook Islands</option>
                                                            <option value="CR">Costa Rica</option>
                                                            <option value="CI">Côte d'Ivoire</option>
                                                            <option value="HR">Croatia</option>
                                                            <option value="CU">Cuba</option>
                                                            <option value="CW">Curaçao</option>
                                                            <option value="CY">Cyprus</option>
                                                            <option value="CZ">Czech Republic</option>
                                                            <option value="DK">Denmark</option>
                                                            <option value="DJ">Djibouti</option>
                                                            <option value="DM">Dominica</option>
                                                            <option value="DO">Dominican Republic</option>
                                                            <option value="EC">Ecuador</option>
                                                            <option value="EG">Egypt</option>
                                                            <option value="SV">El Salvador</option>
                                                            <option value="GQ">Equatorial Guinea</option>
                                                            <option value="ER">Eritrea</option>
                                                            <option value="EE">Estonia</option>
                                                            <option value="ET">Ethiopia</option>
                                                            <option value="FK">Falkland Islands (Malvinas)</option>
                                                            <option value="FO">Faroe Islands</option>
                                                            <option value="FJ">Fiji</option>
                                                            <option value="FI">Finland</option>
                                                            <option value="FR">France</option>
                                                            <option value="GF">French Guiana</option>
                                                            <option value="PF">French Polynesia</option>
                                                            <option value="TF">French Southern Territories</option>
                                                            <option value="GA">Gabon</option>
                                                            <option value="GM">Gambia</option>
                                                            <option value="GE">Georgia</option>
                                                            <option value="DE">Germany</option>
                                                            <option value="GH">Ghana</option>
                                                            <option value="GI">Gibraltar</option>
                                                            <option value="GR">Greece</option>
                                                            <option value="GL">Greenland</option>
                                                            <option value="GD">Grenada</option>
                                                            <option value="GP">Guadeloupe</option>
                                                            <option value="GU">Guam</option>
                                                            <option value="GT">Guatemala</option>
                                                            <option value="GG">Guernsey</option>
                                                            <option value="GN">Guinea</option>
                                                            <option value="GW">Guinea-Bissau</option>
                                                            <option value="GY">Guyana</option>
                                                            <option value="HT">Haiti</option>
                                                            <option value="HM">Heard Island and McDonald Islands</option>
                                                            <option value="VA">Holy See (Vatican City State)</option>
                                                            <option value="HN">Honduras</option>
                                                            <option value="HK">Hong Kong</option>
                                                            <option value="HU">Hungary</option>
                                                            <option value="IS">Iceland</option>
                                                            <option value="IN">India</option>
                                                            <option value="ID">Indonesia</option>
                                                            <option value="IR">Iran, Islamic Republic of</option>
                                                            <option value="IQ">Iraq</option>
                                                            <option value="IE">Ireland</option>
                                                            <option value="IM">Isle of Man</option>
                                                            <option value="IL">Israel</option>
                                                            <option value="IT">Italy</option>
                                                            <option value="JM">Jamaica</option>
                                                            <option value="JP">Japan</option>
                                                            <option value="JE">Jersey</option>
                                                            <option value="JO">Jordan</option>
                                                            <option value="KZ">Kazakhstan</option>
                                                            <option value="KE">Kenya</option>
                                                            <option value="KI">Kiribati</option>
                                                            <option value="KP">Korea, Democratic People's Republic of</option>
                                                            <option value="KR">Korea, Republic of</option>
                                                            <option value="KW">Kuwait</option>
                                                            <option value="KG">Kyrgyzstan</option>
                                                            <option value="LA">Lao People's Democratic Republic</option>
                                                            <option value="LV">Latvia</option>
                                                            <option value="LB">Lebanon</option>
                                                            <option value="LS">Lesotho</option>
                                                            <option value="LR">Liberia</option>
                                                            <option value="LY">Libya</option>
                                                            <option value="LI">Liechtenstein</option>
                                                            <option value="LT">Lithuania</option>
                                                            <option value="LU">Luxembourg</option>
                                                            <option value="MO">Macao</option>
                                                            <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                                                            <option value="MG">Madagascar</option>
                                                            <option value="MW">Malawi</option>
                                                            <option value="MY">Malaysia</option>
                                                            <option value="MV">Maldives</option>
                                                            <option value="ML">Mali</option>
                                                            <option value="MT">Malta</option>
                                                            <option value="MH">Marshall Islands</option>
                                                            <option value="MQ">Martinique</option>
                                                            <option value="MR">Mauritania</option>
                                                            <option value="MU">Mauritius</option>
                                                            <option value="YT">Mayotte</option>
                                                            <option value="MX">Mexico</option>
                                                            <option value="FM">Micronesia, Federated States of</option>
                                                            <option value="MD">Moldova, Republic of</option>
                                                            <option value="MC">Monaco</option>
                                                            <option value="MN">Mongolia</option>
                                                            <option value="ME">Montenegro</option>
                                                            <option value="MS">Montserrat</option>
                                                            <option value="MA">Morocco</option>
                                                            <option value="MZ">Mozambique</option>
                                                            <option value="MM">Myanmar</option>
                                                            <option value="NA">Namibia</option>
                                                            <option value="NR">Nauru</option>
                                                            <option value="NP">Nepal</option>
                                                            <option value="NL">Netherlands</option>
                                                            <option value="NC">New Caledonia</option>
                                                            <option value="NZ">New Zealand</option>
                                                            <option value="NI">Nicaragua</option>
                                                            <option value="NE">Niger</option>
                                                            <option value="NG">Nigeria</option>
                                                            <option value="NU">Niue</option>
                                                            <option value="NF">Norfolk Island</option>
                                                            <option value="MP">Northern Mariana Islands</option>
                                                            <option value="NO">Norway</option>
                                                            <option value="OM">Oman</option>
                                                            <option value="PK">Pakistan</option>
                                                            <option value="PW">Palau</option>
                                                            <option value="PS">Palestinian Territory, Occupied</option>
                                                            <option value="PA">Panama</option>
                                                            <option value="PG">Papua New Guinea</option>
                                                            <option value="PY">Paraguay</option>
                                                            <option value="PE">Peru</option>
                                                            <option value="PH">Philippines</option>
                                                            <option value="PN">Pitcairn</option>
                                                            <option value="PL">Poland</option>
                                                            <option value="PT">Portugal</option>
                                                            <option value="PR">Puerto Rico</option>
                                                            <option value="QA">Qatar</option>
                                                            <option value="RE">Réunion</option>
                                                            <option value="RO">Romania</option>
                                                            <option value="RU">Russian Federation</option>
                                                            <option value="RW">Rwanda</option>
                                                            <option value="BL">Saint Barthélemy</option>
                                                            <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                                                            <option value="KN">Saint Kitts and Nevis</option>
                                                            <option value="LC">Saint Lucia</option>
                                                            <option value="MF">Saint Martin (French part)</option>
                                                            <option value="PM">Saint Pierre and Miquelon</option>
                                                            <option value="VC">Saint Vincent and the Grenadines</option>
                                                            <option value="WS">Samoa</option>
                                                            <option value="SM">San Marino</option>
                                                            <option value="ST">Sao Tome and Principe</option>
                                                            <option value="SA">Saudi Arabia</option>
                                                            <option value="SN">Senegal</option>
                                                            <option value="RS">Serbia</option>
                                                            <option value="SC">Seychelles</option>
                                                            <option value="SL">Sierra Leone</option>
                                                            <option value="SG">Singapore</option>
                                                            <option value="SX">Sint Maarten (Dutch part)</option>
                                                            <option value="SK">Slovakia</option>
                                                            <option value="SI">Slovenia</option>
                                                            <option value="SB">Solomon Islands</option>
                                                            <option value="SO">Somalia</option>
                                                            <option value="ZA">South Africa</option>
                                                            <option value="GS">South Georgia and the South Sandwich Islands</option>
                                                            <option value="SS">South Sudan</option>
                                                            <option value="ES">Spain</option>
                                                            <option value="LK">Sri Lanka</option>
                                                            <option value="SD">Sudan</option>
                                                            <option value="SR">Suriname</option>
                                                            <option value="SJ">Svalbard and Jan Mayen</option>
                                                            <option value="SZ">Swaziland</option>
                                                            <option value="SE">Sweden</option>
                                                            <option value="CH">Switzerland</option>
                                                            <option value="SY">Syrian Arab Republic</option>
                                                            <option value="TW">Taiwan, Province of China</option>
                                                            <option value="TJ">Tajikistan</option>
                                                            <option value="TZ">Tanzania, United Republic of</option>
                                                            <option value="TH">Thailand</option>
                                                            <option value="TL">Timor-Leste</option>
                                                            <option value="TG">Togo</option>
                                                            <option value="TK">Tokelau</option>
                                                            <option value="TO">Tonga</option>
                                                            <option value="TT">Trinidad and Tobago</option>
                                                            <option value="TN">Tunisia</option>
                                                            <option value="TR">Turkey</option>
                                                            <option value="TM">Turkmenistan</option>
                                                            <option value="TC">Turks and Caicos Islands</option>
                                                            <option value="TV">Tuvalu</option>
                                                            <option value="UG">Uganda</option>
                                                            <option value="UA">Ukraine</option>
                                                            <option value="AE">United Arab Emirates</option>
                                                            <option value="GB">United Kingdom</option>
                                                            <option value="US" selected>United States</option>
                                                            <option value="UM">United States Minor Outlying Islands</option>
                                                            <option value="UY">Uruguay</option>
                                                            <option value="UZ">Uzbekistan</option>
                                                            <option value="VU">Vanuatu</option>
                                                            <option value="VE">Venezuela, Bolivarian Republic of</option>
                                                            <option value="VN">Viet Nam</option>
                                                            <option value="VG">Virgin Islands, British</option>
                                                            <option value="VI">Virgin Islands, U.S.</option>
                                                            <option value="WF">Wallis and Futuna</option>
                                                            <option value="EH">Western Sahara</option>
                                                            <option value="YE">Yemen</option>
                                                            <option value="ZM">Zambia</option>
                                                            <option value="ZW">Zimbabwe</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Address Line 1</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" value="District 6 1352 W. Olive Ave">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Address Line 2</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" value="Fresno 559-488-4020">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">City</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" value="Polo Alto">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">State / Province / Region</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" value="Los Angeles">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Zip / Postal Code</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" value="780456">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label"></label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="kt-checkbox-single">
                                                            <label class="kt-checkbox">
                                                                <input type="checkbox">
                                                                Use as shipping address. <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__foot">
                                        <div class="kt-form__actions">
                                            <div class="row">
                                                <div class="col-lg-3 col-xl-3"></div>
                                                <div class="col-lg-9 col-xl-9">
                                                    <button type="reset" class="btn btn-success">Submit</button>
                                                    &nbsp;
                                                    <button type="reset" class="btn btn-secondary">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--end: Personal Information-->
                        <!--begin: Account Information-->
                        <div class="tab-pane fade" id="kt_profile_tab_account_information" role="tabpanel">
                            <div class="kt-portlet">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                            Account Information <small>change your account settings</small>
                                        </h3>
                                    </div>
                                    <div class="kt-portlet__head-toolbar">
                                        <div class="kt-portlet__head-wrapper">
                                            <div class="dropdown dropdown-inline">
                                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="la la-sellsy"></i> </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul class="kt-nav">
                                                        <li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">Export Tools</span> </li>
                                                        <li class="kt-nav__item">
                                                            <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-print"></i> <span class="kt-nav__link-text">Print</span> </a>
                                                        </li>
                                                        <li class="kt-nav__item">
                                                            <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-copy"></i> <span class="kt-nav__link-text">Copy</span> </a>
                                                        </li>
                                                        <li class="kt-nav__item">
                                                            <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-excel-o"></i> <span class="kt-nav__link-text">Excel</span> </a>
                                                        </li>
                                                        <li class="kt-nav__item">
                                                            <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-text-o"></i> <span class="kt-nav__link-text">CSV</span> </a>
                                                        </li>
                                                        <li class="kt-nav__item">
                                                            <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-pdf-o"></i> <span class="kt-nav__link-text">PDF</span> </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form class="kt-form kt-form--label-right">
                                    <div class="kt-portlet__body">
                                        <div class="kt-section kt-section--first">
                                            <div class="kt-section__body">
                                                <div class="row">
                                                    <label class="col-xl-3"></label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <h3 class="kt-section__title kt-section__title-sm">
                                                            Account:
                                                        </h3>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Username</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="kt-spinner kt-spinner--sm kt-spinner--success kt-spinner--right kt-spinner--input">
                                                            <input class="form-control" type="text" value="nick84">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="la la-at"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control" value="nick.watson@loop.com" placeholder="Email" aria-describedby="basic-addon1">
                                                        </div>
                                                        <span class="form-text text-muted">Email will not be publicly displayed. <a href="#" class="kt-link">Learn more</a>.</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Language</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <select class="form-control">
                                                            <option>Select Language...</option>
                                                            <option value="id">Bahasa Indonesia - Indonesian</option>
                                                            <option value="msa">Bahasa Melayu - Malay</option>
                                                            <option value="ca">Català - Catalan</option>
                                                            <option value="cs">Čeština - Czech</option>
                                                            <option value="da">Dansk - Danish</option>
                                                            <option value="de">Deutsch - German</option>
                                                            <option value="en" selected="">English</option>
                                                            <option value="en-gb">English UK - British English</option>
                                                            <option value="es">Español - Spanish</option>
                                                            <option value="eu">Euskara - Basque (beta)</option>
                                                            <option value="fil">Filipino</option>
                                                            <option value="fr">Français - French</option>
                                                            <option value="ga">Gaeilge - Irish (beta)</option>
                                                            <option value="gl">Galego - Galician (beta)</option>
                                                            <option value="hr">Hrvatski - Croatian</option>
                                                            <option value="it">Italiano - Italian</option>
                                                            <option value="hu">Magyar - Hungarian</option>
                                                            <option value="nl">Nederlands - Dutch</option>
                                                            <option value="no">Norsk - Norwegian</option>
                                                            <option value="pl">Polski - Polish</option>
                                                            <option value="pt">Português - Portuguese</option>
                                                            <option value="ro">Română - Romanian</option>
                                                            <option value="sk">Slovenčina - Slovak</option>
                                                            <option value="fi">Suomi - Finnish</option>
                                                            <option value="sv">Svenska - Swedish</option>
                                                            <option value="vi">Tiếng Việt - Vietnamese</option>
                                                            <option value="tr">Türkçe - Turkish</option>
                                                            <option value="el">Ελληνικά - Greek</option>
                                                            <option value="bg">Български език - Bulgarian</option>
                                                            <option value="ru">Русский - Russian</option>
                                                            <option value="sr">Српски - Serbian</option>
                                                            <option value="uk">Українська мова - Ukrainian</option>
                                                            <option value="he">עִבְרִית - Hebrew</option>
                                                            <option value="ur">اردو - Urdu (beta)</option>
                                                            <option value="ar">العربية - Arabic</option>
                                                            <option value="fa">فارسی - Persian</option>
                                                            <option value="mr">मराठी - Marathi</option>
                                                            <option value="hi">हिन्दी - Hindi</option>
                                                            <option value="bn">বাংলা - Bangla</option>
                                                            <option value="gu">ગુજરાતી - Gujarati</option>
                                                            <option value="ta">தமிழ் - Tamil</option>
                                                            <option value="kn">ಕನ್ನಡ - Kannada</option>
                                                            <option value="th">ภาษาไทย - Thai</option>
                                                            <option value="ko">한국어 - Korean</option>
                                                            <option value="ja">日本語 - Japanese</option>
                                                            <option value="zh-cn">简体中文 - Simplified Chinese</option>
                                                            <option value="zh-tw">繁體中文 - Traditional Chinese</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Time Zone</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <select class="form-control">
                                                            <option data-offset="-39600" value="International Date Line West">(GMT-11:00) International Date Line West</option>
                                                            <option data-offset="-39600" value="Midway Island">(GMT-11:00) Midway Island</option>
                                                            <option data-offset="-39600" value="Samoa">(GMT-11:00) Samoa</option>
                                                            <option data-offset="-36000" value="Hawaii">(GMT-10:00) Hawaii</option>
                                                            <option data-offset="-28800" value="Alaska">(GMT-08:00) Alaska</option>
                                                            <option data-offset="-25200" value="Pacific Time (US &amp; Canada)">(GMT-07:00) Pacific Time (US &amp; Canada)</option>
                                                            <option data-offset="-25200" value="Tijuana">(GMT-07:00) Tijuana</option>
                                                            <option data-offset="-25200" value="Arizona">(GMT-07:00) Arizona</option>
                                                            <option data-offset="-21600" value="Mountain Time (US &amp; Canada)">(GMT-06:00) Mountain Time (US &amp; Canada)</option>
                                                            <option data-offset="-21600" value="Chihuahua">(GMT-06:00) Chihuahua</option>
                                                            <option data-offset="-21600" value="Mazatlan">(GMT-06:00) Mazatlan</option>
                                                            <option data-offset="-21600" value="Saskatchewan">(GMT-06:00) Saskatchewan</option>
                                                            <option data-offset="-21600" value="Central America">(GMT-06:00) Central America</option>
                                                            <option data-offset="-18000" value="Central Time (US &amp; Canada)">(GMT-05:00) Central Time (US &amp; Canada)</option>
                                                            <option data-offset="-18000" value="Guadalajara">(GMT-05:00) Guadalajara</option>
                                                            <option data-offset="-18000" value="Mexico City">(GMT-05:00) Mexico City</option>
                                                            <option data-offset="-18000" value="Monterrey">(GMT-05:00) Monterrey</option>
                                                            <option data-offset="-18000" value="Bogota">(GMT-05:00) Bogota</option>
                                                            <option data-offset="-18000" value="Lima">(GMT-05:00) Lima</option>
                                                            <option data-offset="-18000" value="Quito">(GMT-05:00) Quito</option>
                                                            <option data-offset="-14400" value="Eastern Time (US &amp; Canada)">(GMT-04:00) Eastern Time (US &amp; Canada)</option>
                                                            <option data-offset="-14400" value="Indiana (East)">(GMT-04:00) Indiana (East)</option>
                                                            <option data-offset="-14400" value="Caracas">(GMT-04:00) Caracas</option>
                                                            <option data-offset="-14400" value="La Paz">(GMT-04:00) La Paz</option>
                                                            <option data-offset="-14400" value="Georgetown">(GMT-04:00) Georgetown</option>
                                                            <option data-offset="-10800" value="Atlantic Time (Canada)">(GMT-03:00) Atlantic Time (Canada)</option>
                                                            <option data-offset="-10800" value="Santiago">(GMT-03:00) Santiago</option>
                                                            <option data-offset="-10800" value="Brasilia">(GMT-03:00) Brasilia</option>
                                                            <option data-offset="-10800" value="Buenos Aires">(GMT-03:00) Buenos Aires</option>
                                                            <option data-offset="-9000" value="Newfoundland">(GMT-02:30) Newfoundland</option>
                                                            <option data-offset="-7200" value="Greenland">(GMT-02:00) Greenland</option>
                                                            <option data-offset="-7200" value="Mid-Atlantic">(GMT-02:00) Mid-Atlantic</option>
                                                            <option data-offset="-3600" value="Cape Verde Is.">(GMT-01:00) Cape Verde Is.</option>
                                                            <option data-offset="0" value="Azores">(GMT) Azores</option>
                                                            <option data-offset="0" value="Monrovia">(GMT) Monrovia</option>
                                                            <option data-offset="0" value="UTC">(GMT) UTC</option>
                                                            <option data-offset="3600" value="Dublin">(GMT+01:00) Dublin</option>
                                                            <option data-offset="3600" value="Edinburgh">(GMT+01:00) Edinburgh</option>
                                                            <option data-offset="3600" value="Lisbon">(GMT+01:00) Lisbon</option>
                                                            <option data-offset="3600" value="London">(GMT+01:00) London</option>
                                                            <option data-offset="3600" value="Casablanca">(GMT+01:00) Casablanca</option>
                                                            <option data-offset="3600" value="West Central Africa">(GMT+01:00) West Central Africa</option>
                                                            <option data-offset="7200" value="Belgrade">(GMT+02:00) Belgrade</option>
                                                            <option data-offset="7200" value="Bratislava">(GMT+02:00) Bratislava</option>
                                                            <option data-offset="7200" value="Budapest">(GMT+02:00) Budapest</option>
                                                            <option data-offset="7200" value="Ljubljana">(GMT+02:00) Ljubljana</option>
                                                            <option data-offset="7200" value="Prague">(GMT+02:00) Prague</option>
                                                            <option data-offset="7200" value="Sarajevo">(GMT+02:00) Sarajevo</option>
                                                            <option data-offset="7200" value="Skopje">(GMT+02:00) Skopje</option>
                                                            <option data-offset="7200" value="Warsaw">(GMT+02:00) Warsaw</option>
                                                            <option data-offset="7200" value="Zagreb">(GMT+02:00) Zagreb</option>
                                                            <option data-offset="7200" value="Brussels">(GMT+02:00) Brussels</option>
                                                            <option data-offset="7200" value="Copenhagen">(GMT+02:00) Copenhagen</option>
                                                            <option data-offset="7200" value="Madrid">(GMT+02:00) Madrid</option>
                                                            <option data-offset="7200" value="Paris">(GMT+02:00) Paris</option>
                                                            <option data-offset="7200" value="Amsterdam">(GMT+02:00) Amsterdam</option>
                                                            <option data-offset="7200" value="Berlin">(GMT+02:00) Berlin</option>
                                                            <option data-offset="7200" value="Bern">(GMT+02:00) Bern</option>
                                                            <option data-offset="7200" value="Rome">(GMT+02:00) Rome</option>
                                                            <option data-offset="7200" value="Stockholm">(GMT+02:00) Stockholm</option>
                                                            <option data-offset="7200" value="Vienna">(GMT+02:00) Vienna</option>
                                                            <option data-offset="7200" value="Cairo">(GMT+02:00) Cairo</option>
                                                            <option data-offset="7200" value="Harare">(GMT+02:00) Harare</option>
                                                            <option data-offset="7200" value="Pretoria">(GMT+02:00) Pretoria</option>
                                                            <option data-offset="10800" value="Bucharest">(GMT+03:00) Bucharest</option>
                                                            <option data-offset="10800" value="Helsinki">(GMT+03:00) Helsinki</option>
                                                            <option data-offset="10800" value="Kiev">(GMT+03:00) Kiev</option>
                                                            <option data-offset="10800" value="Kyiv">(GMT+03:00) Kyiv</option>
                                                            <option data-offset="10800" value="Riga">(GMT+03:00) Riga</option>
                                                            <option data-offset="10800" value="Sofia">(GMT+03:00) Sofia</option>
                                                            <option data-offset="10800" value="Tallinn">(GMT+03:00) Tallinn</option>
                                                            <option data-offset="10800" value="Vilnius">(GMT+03:00) Vilnius</option>
                                                            <option data-offset="10800" value="Athens">(GMT+03:00) Athens</option>
                                                            <option data-offset="10800" value="Istanbul">(GMT+03:00) Istanbul</option>
                                                            <option data-offset="10800" value="Minsk">(GMT+03:00) Minsk</option>
                                                            <option data-offset="10800" value="Jerusalem">(GMT+03:00) Jerusalem</option>
                                                            <option data-offset="10800" value="Moscow">(GMT+03:00) Moscow</option>
                                                            <option data-offset="10800" value="St. Petersburg">(GMT+03:00) St. Petersburg</option>
                                                            <option data-offset="10800" value="Volgograd">(GMT+03:00) Volgograd</option>
                                                            <option data-offset="10800" value="Kuwait">(GMT+03:00) Kuwait</option>
                                                            <option data-offset="10800" value="Riyadh">(GMT+03:00) Riyadh</option>
                                                            <option data-offset="10800" value="Nairobi">(GMT+03:00) Nairobi</option>
                                                            <option data-offset="10800" value="Baghdad">(GMT+03:00) Baghdad</option>
                                                            <option data-offset="14400" value="Abu Dhabi">(GMT+04:00) Abu Dhabi</option>
                                                            <option data-offset="14400" value="Muscat">(GMT+04:00) Muscat</option>
                                                            <option data-offset="14400" value="Baku">(GMT+04:00) Baku</option>
                                                            <option data-offset="14400" value="Tbilisi">(GMT+04:00) Tbilisi</option>
                                                            <option data-offset="14400" value="Yerevan">(GMT+04:00) Yerevan</option>
                                                            <option data-offset="16200" value="Tehran">(GMT+04:30) Tehran</option>
                                                            <option data-offset="16200" value="Kabul">(GMT+04:30) Kabul</option>
                                                            <option data-offset="18000" value="Ekaterinburg">(GMT+05:00) Ekaterinburg</option>
                                                            <option data-offset="18000" value="Islamabad">(GMT+05:00) Islamabad</option>
                                                            <option data-offset="18000" value="Karachi">(GMT+05:00) Karachi</option>
                                                            <option data-offset="18000" value="Tashkent">(GMT+05:00) Tashkent</option>
                                                            <option data-offset="19800" value="Chennai">(GMT+05:30) Chennai</option>
                                                            <option data-offset="19800" value="Kolkata">(GMT+05:30) Kolkata</option>
                                                            <option data-offset="19800" value="Mumbai">(GMT+05:30) Mumbai</option>
                                                            <option data-offset="19800" value="New Delhi">(GMT+05:30) New Delhi</option>
                                                            <option data-offset="19800" value="Sri Jayawardenepura">(GMT+05:30) Sri Jayawardenepura</option>
                                                            <option data-offset="20700" value="Kathmandu">(GMT+05:45) Kathmandu</option>
                                                            <option data-offset="21600" value="Astana">(GMT+06:00) Astana</option>
                                                            <option data-offset="21600" value="Dhaka">(GMT+06:00) Dhaka</option>
                                                            <option data-offset="21600" value="Almaty">(GMT+06:00) Almaty</option>
                                                            <option data-offset="21600" value="Urumqi">(GMT+06:00) Urumqi</option>
                                                            <option data-offset="23400" value="Rangoon">(GMT+06:30) Rangoon</option>
                                                            <option data-offset="25200" value="Novosibirsk">(GMT+07:00) Novosibirsk</option>
                                                            <option data-offset="25200" value="Bangkok">(GMT+07:00) Bangkok</option>
                                                            <option data-offset="25200" value="Hanoi">(GMT+07:00) Hanoi</option>
                                                            <option data-offset="25200" value="Jakarta">(GMT+07:00) Jakarta</option>
                                                            <option data-offset="25200" value="Krasnoyarsk">(GMT+07:00) Krasnoyarsk</option>
                                                            <option data-offset="28800" value="Beijing">(GMT+08:00) Beijing</option>
                                                            <option data-offset="28800" value="Chongqing">(GMT+08:00) Chongqing</option>
                                                            <option data-offset="28800" value="Hong Kong">(GMT+08:00) Hong Kong</option>
                                                            <option data-offset="28800" value="Kuala Lumpur">(GMT+08:00) Kuala Lumpur</option>
                                                            <option data-offset="28800" value="Singapore">(GMT+08:00) Singapore</option>
                                                            <option data-offset="28800" value="Taipei">(GMT+08:00) Taipei</option>
                                                            <option data-offset="28800" value="Perth">(GMT+08:00) Perth</option>
                                                            <option data-offset="28800" value="Irkutsk">(GMT+08:00) Irkutsk</option>
                                                            <option data-offset="28800" value="Ulaan Bataar">(GMT+08:00) Ulaan Bataar</option>
                                                            <option data-offset="32400" value="Seoul">(GMT+09:00) Seoul</option>
                                                            <option data-offset="32400" value="Osaka">(GMT+09:00) Osaka</option>
                                                            <option data-offset="32400" value="Sapporo">(GMT+09:00) Sapporo</option>
                                                            <option data-offset="32400" value="Tokyo">(GMT+09:00) Tokyo</option>
                                                            <option data-offset="32400" value="Yakutsk">(GMT+09:00) Yakutsk</option>
                                                            <option data-offset="34200" value="Darwin">(GMT+09:30) Darwin</option>
                                                            <option data-offset="34200" value="Adelaide">(GMT+09:30) Adelaide</option>
                                                            <option data-offset="36000" value="Canberra">(GMT+10:00) Canberra</option>
                                                            <option data-offset="36000" value="Melbourne">(GMT+10:00) Melbourne</option>
                                                            <option data-offset="36000" value="Sydney">(GMT+10:00) Sydney</option>
                                                            <option data-offset="36000" value="Brisbane">(GMT+10:00) Brisbane</option>
                                                            <option data-offset="36000" value="Hobart">(GMT+10:00) Hobart</option>
                                                            <option data-offset="36000" value="Vladivostok">(GMT+10:00) Vladivostok</option>
                                                            <option data-offset="36000" value="Guam">(GMT+10:00) Guam</option>
                                                            <option data-offset="36000" value="Port Moresby">(GMT+10:00) Port Moresby</option>
                                                            <option data-offset="36000" value="Solomon Is.">(GMT+10:00) Solomon Is.</option>
                                                            <option data-offset="39600" value="Magadan">(GMT+11:00) Magadan</option>
                                                            <option data-offset="39600" value="New Caledonia">(GMT+11:00) New Caledonia</option>
                                                            <option data-offset="43200" value="Fiji">(GMT+12:00) Fiji</option>
                                                            <option data-offset="43200" value="Kamchatka">(GMT+12:00) Kamchatka</option>
                                                            <option data-offset="43200" value="Marshall Is.">(GMT+12:00) Marshall Is.</option>
                                                            <option data-offset="43200" value="Auckland">(GMT+12:00) Auckland</option>
                                                            <option data-offset="43200" value="Wellington">(GMT+12:00) Wellington</option>
                                                            <option data-offset="46800" value="Nuku'alofa">(GMT+13:00) Nuku'alofa</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-last row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Communication</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="kt-checkbox-inline">
                                                            <label class="kt-checkbox">
                                                                <input type="checkbox" checked>
                                                                Email <span></span>
                                                            </label>
                                                            <label class="kt-checkbox">
                                                                <input type="checkbox" checked>
                                                                SMS <span></span>
                                                            </label>
                                                            <label class="kt-checkbox">
                                                                <input type="checkbox">
                                                                Phone <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
                                        <div class="kt-section kt-section--first">
                                            <div class="kt-section__body">
                                                <div class="row">
                                                    <label class="col-xl-3"></label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <h3 class="kt-section__title kt-section__title-sm">
                                                            Security:
                                                        </h3>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Login verification</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <button type="button" class="btn btn-outline-primary btn-sm kt-margin-t-5 kt-margin-b-5">Setup login verification</button>
                                                        <span class="form-text text-muted"> After you log in, you will be asked for additional information to confirm your identity and protect your account from being compromised. <a href="#" class="kt-link">Learn more</a>. </span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Password reset verification</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="kt-checkbox-single">
                                                            <label class="kt-checkbox">
                                                                <input type="checkbox">
                                                                Require personal information to reset your password. <span></span>
                                                            </label>
                                                        </div>
                                                        <span class="form-text text-muted"> For extra security, this requires you to confirm your email or phone number when you reset your password. <a href="#" class="kt-link">Learn more</a>. </span>
                                                    </div>
                                                </div>
                                                <div class="form-group row kt-margin-t-10 kt-margin-b-10">
                                                    <label class="col-xl-3 col-lg-3 col-form-label"></label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <button type="button" class="btn btn-outline-danger btn-sm kt-margin-t-5 kt-margin-b-5">Deactivate your account ?</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__foot">
                                        <div class="kt-form__actions">
                                            <div class="row">
                                                <div class="col-lg-3 col-xl-3"></div>
                                                <div class="col-lg-9 col-xl-9">
                                                    <button type="reset" class="btn btn-success">Submit</button>
                                                    &nbsp;
                                                    <button type="reset" class="btn btn-secondary">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--end: Account Information-->
                        <!--begin: Change Password -->
                        <div class="tab-pane fade" id="kt_profile_change_password" role="tabpanel">
                            <div class="kt-portlet">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                            Change Password<small>change or reset your account password</small>
                                        </h3>
                                    </div>
                                    <div class="kt-portlet__head-toolbar">
                                        <div class="kt-portlet__head-toolbar">
                                            <div class="dropdown dropdown-inline">
                                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="la la-sellsy"></i> </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul class="kt-nav">
                                                        <li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">Quick Actions</span> </li>
                                                        <li class="kt-nav__item">
                                                            <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-graph-1"></i> <span class="kt-nav__link-text">Statistics</span> </a>
                                                        </li>
                                                        <li class="kt-nav__item">
                                                            <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-calendar-4"></i> <span class="kt-nav__link-text">Events</span> </a>
                                                        </li>
                                                        <li class="kt-nav__item">
                                                            <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-layers-1"></i> <span class="kt-nav__link-text">Reports</span> </a>
                                                        </li>
                                                        <li class="kt-nav__item">
                                                            <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-bell-1o"></i> <span class="kt-nav__link-text">Notifications</span> </a>
                                                        </li>
                                                        <li class="kt-nav__item">
                                                            <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-file-1"></i> <span class="kt-nav__link-text">Files</span> </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form class="kt-form kt-form--label-right">
                                    <div class="kt-portlet__body">
                                        <div class="kt-section kt-section--first">
                                            <div class="kt-section__body">
                                                <div class="alert alert-outline-danger fade show kt-margin-t-20 kt-margin-b-40" role="alert">
                                                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                                    <div class="alert-text">Configure user passwords to expire periodically. Users will need warning that their passwords are going to expire, or they might inadvertently get locked out of the system!</div>
                                                    <div class="alert-close">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true"><i class="la la-close"></i></span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-xl-3"></label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <h3 class="kt-section__title kt-section__title-sm">
                                                            Change Or Recover Your Password:
                                                        </h3>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Current Password</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="password" class="form-control" value="" placeholder="Current password">
                                                        <a href="#" class="kt-link kt-font-sm kt-font-bold kt-margin-t-5">Forgot password ?</a>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">New Password</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="password" class="form-control" value="" placeholder="New password">
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-last row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Verify Password</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="password" class="form-control" value="" placeholder="Verify password">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__foot">
                                        <div class="kt-form__actions">
                                            <div class="row">
                                                <div class="col-lg-3 col-xl-3"></div>
                                                <div class="col-lg-9 col-xl-9">
                                                    <button type="reset" class="btn btn-danger">Change Password</button>
                                                    &nbsp;
                                                    <button type="reset" class="btn btn-secondary">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--end: Change Password -->
                        <!--begin: Email Settings -->
                        <div class="tab-pane fade" id="kt_profile_email_settings" role="tabpanel">
                            <div class="kt-portlet">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                            Email Notifications <small>control when and how often Keen sends emails to you</small>
                                        </h3>
                                    </div>
                                </div>
                                <form class="kt-form kt-form--label-right">
                                    <div class="kt-portlet__body">
                                        <div class="kt-section kt-section--first">
                                            <div class="kt-section__body">
                                                <div class="row">
                                                    <label class="col-xl-3"></label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <h3 class="kt-section__title kt-section__title-sm">
                                                            Setup Email Notification:
                                                        </h3>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Email Notification</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                                                <span class="kt-switch">
                                                                                    <label>
                                                                                        <input type="checkbox" checked="checked" name="email_notification_1">
                                                                                        <span></span>
                                                                                    </label>
                                                                                </span>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-last row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Send Copy To Personal Email</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                                                <span class="kt-switch">
                                                                                    <label>
                                                                                        <input type="checkbox" name="email_notification_2">
                                                                                        <span></span>
                                                                                    </label>
                                                                                </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
                                        <div class="kt-section kt-section--first">
                                            <div class="kt-section__body">
                                                <div class="row">
                                                    <label class="col-xl-3"></label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <h3 class="kt-section__title kt-section__title-sm">
                                                            Activity Related Emails:
                                                        </h3>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">When To Email</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="kt-checkbox-list">
                                                            <label class="kt-checkbox">
                                                                <input type="checkbox">
                                                                You have new notifications. <span></span>
                                                            </label>
                                                            <label class="kt-checkbox">
                                                                <input type="checkbox">
                                                                You're sent a direct message <span></span>
                                                            </label>
                                                            <label class="kt-checkbox">
                                                                <input type="checkbox" checked="checked">
                                                                Someone adds you as a connection <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-last row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">When To Escalate Emails</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="kt-checkbox-list">
                                                            <label class="kt-checkbox kt-checkbox--brand">
                                                                <input type="checkbox">
                                                                Upon new order. <span></span>
                                                            </label>
                                                            <label class="kt-checkbox kt-checkbox--brand">
                                                                <input type="checkbox">
                                                                New membership approval <span></span>
                                                            </label>
                                                            <label class="kt-checkbox kt-checkbox--brand">
                                                                <input type="checkbox" checked="checked">
                                                                Member registration <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
                                        <div class="kt-section kt-section--first">
                                            <div class="kt-section__body">
                                                <div class="row">
                                                    <label class="col-xl-3"></label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <h3 class="kt-section__title kt-section__title-sm">
                                                            Updates From Keen:
                                                        </h3>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Email You With</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="kt-checkbox-list">
                                                            <label class="kt-checkbox">
                                                                <input type="checkbox">
                                                                News about Keen product and feature updates <span></span>
                                                            </label>
                                                            <label class="kt-checkbox">
                                                                <input type="checkbox">
                                                                Tips on getting more out of Keen <span></span>
                                                            </label>
                                                            <label class="kt-checkbox">
                                                                <input type="checkbox" checked="checked">
                                                                Things you missed since you last logged into Keen <span></span>
                                                            </label>
                                                            <label class="kt-checkbox">
                                                                <input type="checkbox" checked="checked">
                                                                News about Keen on partner products and other services <span></span>
                                                            </label>
                                                            <label class="kt-checkbox">
                                                                <input type="checkbox" checked="checked">
                                                                Tips on Keen business products <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__foot">
                                        <div class="kt-form__actions">
                                            <div class="row">
                                                <div class="col-lg-3 col-xl-3"></div>
                                                <div class="col-lg-9 col-xl-9">
                                                    <button type="reset" class="btn btn-danger">Change Password</button>
                                                    &nbsp;
                                                    <button type="reset" class="btn btn-secondary">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--end: Email Settings -->
                    </div>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <div class="tab-pane fade" id="kt_tabs_1_3" role="tabpanel">
            <!--begin::Row-->
            <div class="row">
                <div class="col-lg-6 col-xl-4">
                    <!--begin::Portlet-->
                    <div class="kt-portlet kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Recent Works
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-toolbar-wrapper">
                                    <div class="dropdown dropdown-inline">
                                        <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <ul class="kt-nav">
                                                <li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">Export Tools</span> </li>
                                                <li class="kt-nav__item">
                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-print"></i> <span class="kt-nav__link-text">Print</span> </a>
                                                </li>
                                                <li class="kt-nav__item">
                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-copy"></i> <span class="kt-nav__link-text">Copy</span> </a>
                                                </li>
                                                <li class="kt-nav__item">
                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-excel-o"></i> <span class="kt-nav__link-text">Excel</span> </a>
                                                </li>
                                                <li class="kt-nav__item">
                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-text-o"></i> <span class="kt-nav__link-text">CSV</span> </a>
                                                </li>
                                                <li class="kt-nav__item">
                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-pdf-o"></i> <span class="kt-nav__link-text">PDF</span> </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-widget-6">
                                <!-- begin::Tab Content -->
                                <div class="kt-widget6__tab tab-content">
                                    <div id="kt_personal_income_quater_15c4f43eadca7c" class="tab-pane fade active show">
                                        <div class="kt-widget-6__items">
                                            <div class="kt-widget-6__item">
                                                <div class="kt-widget-6__item-pic">
                                                    <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-7.jpg" alt="" />
                                                </div>
                                                <div class="kt-widget-6__item-info">
                                                    <div class="kt-widget-6__item-title"> Quickly direct you useful content or people </div>
                                                    <div class="kt-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                                </div>
                                                <div class="kt-widget-6__item-icon kt-widget-6__item-icon--brand">
                                                    <div class="dropdown dropdown-inline">
                                                        <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="kt-nav">
                                                                <li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">EXPORT TOOLS</span> </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-eye"></i> <span class="kt-nav__link-text">View</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-comment-o"></i> <span class="kt-nav__link-text">Coments</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-copy"></i> <span class="kt-nav__link-text">Copy</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-excel-o"></i> <span class="kt-nav__link-text">Excel</span> </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-widget-6__item">
                                                <div class="kt-widget-6__item-pic">
                                                    <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-6.jpg" alt="" />
                                                </div>
                                                <div class="kt-widget-6__item-info">
                                                    <div class="kt-widget-6__item-title"> Get the point across </div>
                                                    <div class="kt-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                                </div>
                                                <div class="kt-widget-6__item-icon kt-widget-6__item-icon--brand">
                                                    <div class="dropdown dropdown-inline">
                                                        <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="kt-nav">
                                                                <li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">EXPORT TOOLS</span> </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-eye"></i> <span class="kt-nav__link-text">View</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-comment-o"></i> <span class="kt-nav__link-text">Coments</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-copy"></i> <span class="kt-nav__link-text">Copy</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-excel-o"></i> <span class="kt-nav__link-text">Excel</span> </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-widget-6__item">
                                                <div class="kt-widget-6__item-pic">
                                                    <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-5.jpg" alt="" />
                                                </div>
                                                <div class="kt-widget-6__item-info">
                                                    <div class="kt-widget-6__item-title"> Contain amazing email sign up form </div>
                                                    <div class="kt-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                                </div>
                                                <div class="kt-widget-6__item-icon kt-widget-6__item-icon--brand">
                                                    <div class="dropdown dropdown-inline">
                                                        <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="kt-nav">
                                                                <li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">EXPORT TOOLS</span> </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-eye"></i> <span class="kt-nav__link-text">View</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-comment-o"></i> <span class="kt-nav__link-text">Coments</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-copy"></i> <span class="kt-nav__link-text">Copy</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-excel-o"></i> <span class="kt-nav__link-text">Excel</span> </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-widget-6__item">
                                                <div class="kt-widget-6__item-pic">
                                                    <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-2.jpg" alt="" />
                                                </div>
                                                <div class="kt-widget-6__item-info">
                                                    <div class="kt-widget-6__item-title"> Tips on How to Write an About me page </div>
                                                    <div class="kt-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                                </div>
                                                <div class="kt-widget-6__item-icon kt-widget-6__item-icon--brand">
                                                    <div class="dropdown dropdown-inline">
                                                        <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="kt-nav">
                                                                <li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">EXPORT TOOLS</span> </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-eye"></i> <span class="kt-nav__link-text">View</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-comment-o"></i> <span class="kt-nav__link-text">Coments</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-copy"></i> <span class="kt-nav__link-text">Copy</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-excel-o"></i> <span class="kt-nav__link-text">Excel</span> </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="kt_personal_income_quater_25c4f43eadca7c" class="tab-pane fade">
                                        <div class="kt-widget-6__items">
                                            <div class="kt-widget-6__item">
                                                <div class="kt-widget-6__item-pic">
                                                    <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-6.jpg" alt="" />
                                                </div>
                                                <div class="kt-widget-6__item-info">
                                                    <div class="kt-widget-6__item-title"> Get the point across </div>
                                                    <div class="kt-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                                </div>
                                                <div class="kt-widget-6__item-icon kt-widget-6__item-icon--brand">
                                                    <div class="dropdown dropdown-inline">
                                                        <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="kt-nav">
                                                                <li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">EXPORT TOOLS</span> </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-eye"></i> <span class="kt-nav__link-text">View</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-comment-o"></i> <span class="kt-nav__link-text">Coments</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-copy"></i> <span class="kt-nav__link-text">Copy</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-excel-o"></i> <span class="kt-nav__link-text">Excel</span> </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-widget-6__item">
                                                <div class="kt-widget-6__item-pic">
                                                    <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-2.jpg" alt="" />
                                                </div>
                                                <div class="kt-widget-6__item-info">
                                                    <div class="kt-widget-6__item-title"> Tips on How to Write an About me page </div>
                                                    <div class="kt-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                                </div>
                                                <div class="kt-widget-6__item-icon kt-widget-6__item-icon--brand">
                                                    <div class="dropdown dropdown-inline">
                                                        <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="kt-nav">
                                                                <li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">EXPORT TOOLS</span> </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-eye"></i> <span class="kt-nav__link-text">View</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-comment-o"></i> <span class="kt-nav__link-text">Coments</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-copy"></i> <span class="kt-nav__link-text">Copy</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-excel-o"></i> <span class="kt-nav__link-text">Excel</span> </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-widget-6__item">
                                                <div class="kt-widget-6__item-pic">
                                                    <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-7.jpg" alt="" />
                                                </div>
                                                <div class="kt-widget-6__item-info">
                                                    <div class="kt-widget-6__item-title"> Quickly direct you useful content or people </div>
                                                    <div class="kt-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                                </div>
                                                <div class="kt-widget-6__item-icon kt-widget-6__item-icon--brand">
                                                    <div class="dropdown dropdown-inline">
                                                        <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="kt-nav">
                                                                <li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">EXPORT TOOLS</span> </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-eye"></i> <span class="kt-nav__link-text">View</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-comment-o"></i> <span class="kt-nav__link-text">Coments</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-copy"></i> <span class="kt-nav__link-text">Copy</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-excel-o"></i> <span class="kt-nav__link-text">Excel</span> </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-widget-6__item">
                                                <div class="kt-widget-6__item-pic">
                                                    <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-5.jpg" alt="" />
                                                </div>
                                                <div class="kt-widget-6__item-info">
                                                    <div class="kt-widget-6__item-title"> Contain amazing email sign up form </div>
                                                    <div class="kt-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                                </div>
                                                <div class="kt-widget-6__item-icon kt-widget-6__item-icon--brand">
                                                    <div class="dropdown dropdown-inline">
                                                        <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="kt-nav">
                                                                <li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">EXPORT TOOLS</span> </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-eye"></i> <span class="kt-nav__link-text">View</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-comment-o"></i> <span class="kt-nav__link-text">Coments</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-copy"></i> <span class="kt-nav__link-text">Copy</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-excel-o"></i> <span class="kt-nav__link-text">Excel</span> </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="kt_personal_income_quater_35c4f43eadca7c" class="tab-pane fade">
                                        <div class="kt-widget-6__items">
                                            <div class="kt-widget-6__item">
                                                <div class="kt-widget-6__item-pic">
                                                    <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-5.jpg" alt="" />
                                                </div>
                                                <div class="kt-widget-6__item-info">
                                                    <div class="kt-widget-6__item-title"> Contain amazing email sign up form </div>
                                                    <div class="kt-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                                </div>
                                                <div class="kt-widget-6__item-icon kt-widget-6__item-icon--brand">
                                                    <div class="dropdown dropdown-inline">
                                                        <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="kt-nav">
                                                                <li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">EXPORT TOOLS</span> </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-eye"></i> <span class="kt-nav__link-text">View</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-comment-o"></i> <span class="kt-nav__link-text">Coments</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-copy"></i> <span class="kt-nav__link-text">Copy</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-excel-o"></i> <span class="kt-nav__link-text">Excel</span> </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-widget-6__item">
                                                <div class="kt-widget-6__item-pic">
                                                    <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-4.jpg" alt="" />
                                                </div>
                                                <div class="kt-widget-6__item-info">
                                                    <div class="kt-widget-6__item-title"> Tips on How to Write an About me page </div>
                                                    <div class="kt-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                                </div>
                                                <div class="kt-widget-6__item-icon kt-widget-6__item-icon--brand">
                                                    <div class="dropdown dropdown-inline">
                                                        <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="kt-nav">
                                                                <li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">EXPORT TOOLS</span> </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-eye"></i> <span class="kt-nav__link-text">View</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-comment-o"></i> <span class="kt-nav__link-text">Coments</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-copy"></i> <span class="kt-nav__link-text">Copy</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-excel-o"></i> <span class="kt-nav__link-text">Excel</span> </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-widget-6__item">
                                                <div class="kt-widget-6__item-pic">
                                                    <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-6.jpg" alt="" />
                                                </div>
                                                <div class="kt-widget-6__item-info">
                                                    <div class="kt-widget-6__item-title"> Get the point across </div>
                                                    <div class="kt-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                                </div>
                                                <div class="kt-widget-6__item-icon kt-widget-6__item-icon--brand">
                                                    <div class="dropdown dropdown-inline">
                                                        <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="kt-nav">
                                                                <li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">EXPORT TOOLS</span> </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-eye"></i> <span class="kt-nav__link-text">View</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-comment-o"></i> <span class="kt-nav__link-text">Coments</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-copy"></i> <span class="kt-nav__link-text">Copy</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-excel-o"></i> <span class="kt-nav__link-text">Excel</span> </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-widget-6__item">
                                                <div class="kt-widget-6__item-pic">
                                                    <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-2.jpg" alt="" />
                                                </div>
                                                <div class="kt-widget-6__item-info">
                                                    <div class="kt-widget-6__item-title"> Tips on How to Write an About me page </div>
                                                    <div class="kt-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                                </div>
                                                <div class="kt-widget-6__item-icon kt-widget-6__item-icon--brand">
                                                    <div class="dropdown dropdown-inline">
                                                        <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="kt-nav">
                                                                <li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">EXPORT TOOLS</span> </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-eye"></i> <span class="kt-nav__link-text">View</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-comment-o"></i> <span class="kt-nav__link-text">Coments</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-copy"></i> <span class="kt-nav__link-text">Copy</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-excel-o"></i> <span class="kt-nav__link-text">Excel</span> </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="kt_personal_income_quater_45c4f43eadca7c" class="tab-pane fade">
                                        <div class="kt-widget-6__items">
                                            <div class="kt-widget-6__item">
                                                <div class="kt-widget-6__item-pic">
                                                    <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-6.jpg" alt="" />
                                                </div>
                                                <div class="kt-widget-6__item-info">
                                                    <div class="kt-widget-6__item-title"> Get the point across </div>
                                                    <div class="kt-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                                </div>
                                                <div class="kt-widget-6__item-icon kt-widget-6__item-icon--brand">
                                                    <div class="dropdown dropdown-inline">
                                                        <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="kt-nav">
                                                                <li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">EXPORT TOOLS</span> </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-eye"></i> <span class="kt-nav__link-text">View</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-comment-o"></i> <span class="kt-nav__link-text">Coments</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-copy"></i> <span class="kt-nav__link-text">Copy</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-excel-o"></i> <span class="kt-nav__link-text">Excel</span> </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-widget-6__item">
                                                <div class="kt-widget-6__item-pic">
                                                    <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-5.jpg" alt="" />
                                                </div>
                                                <div class="kt-widget-6__item-info">
                                                    <div class="kt-widget-6__item-title"> Contain amazing email sign up form </div>
                                                    <div class="kt-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                                </div>
                                                <div class="kt-widget-6__item-icon kt-widget-6__item-icon--brand">
                                                    <div class="dropdown dropdown-inline">
                                                        <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="kt-nav">
                                                                <li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">EXPORT TOOLS</span> </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-eye"></i> <span class="kt-nav__link-text">View</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-comment-o"></i> <span class="kt-nav__link-text">Coments</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-copy"></i> <span class="kt-nav__link-text">Copy</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-excel-o"></i> <span class="kt-nav__link-text">Excel</span> </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-widget-6__item">
                                                <div class="kt-widget-6__item-pic">
                                                    <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-3.jpg" alt="" />
                                                </div>
                                                <div class="kt-widget-6__item-info">
                                                    <div class="kt-widget-6__item-title"> Get the point across </div>
                                                    <div class="kt-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                                </div>
                                                <div class="kt-widget-6__item-icon kt-widget-6__item-icon--brand">
                                                    <div class="dropdown dropdown-inline">
                                                        <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="kt-nav">
                                                                <li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">EXPORT TOOLS</span> </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-eye"></i> <span class="kt-nav__link-text">View</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-comment-o"></i> <span class="kt-nav__link-text">Coments</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-copy"></i> <span class="kt-nav__link-text">Copy</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-excel-o"></i> <span class="kt-nav__link-text">Excel</span> </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-widget-6__item">
                                                <div class="kt-widget-6__item-pic">
                                                    <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-2.jpg" alt="" />
                                                </div>
                                                <div class="kt-widget-6__item-info">
                                                    <div class="kt-widget-6__item-title"> Tips on How to Write an About me page </div>
                                                    <div class="kt-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                                </div>
                                                <div class="kt-widget-6__item-icon kt-widget-6__item-icon--brand">
                                                    <div class="dropdown dropdown-inline">
                                                        <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="kt-nav">
                                                                <li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">EXPORT TOOLS</span> </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-eye"></i> <span class="kt-nav__link-text">View</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-comment-o"></i> <span class="kt-nav__link-text">Coments</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-copy"></i> <span class="kt-nav__link-text">Copy</span> </a>
                                                                </li>
                                                                <li class="kt-nav__item">
                                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-excel-o"></i> <span class="kt-nav__link-text">Excel</span> </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end::Tab Content -->
                                <!-- begin::Nav pills -->
                                <ul class="kt-widget-6__nav-items nav nav-pills nav-fill" role="tablist">
                                    <li class="kt-widget-6__nav-item nav-item"> <a class="nav-link active show" data-toggle="pill" href="#kt_personal_income_quater_15c4f43eadca7c">1</a> </li>
                                    <li class="kt-widget-6__nav-item nav-item"> <a class="nav-link" data-toggle="pill" href="#kt_personal_income_quater_25c4f43eadca7c">2</a> </li>
                                    <li class="kt-widget-6__nav-item nav-item"> <a class="nav-link" data-toggle="pill" href="#">3</a> </li>
                                    <li class="kt-widget-6__nav-item nav-item"> <a class="nav-link" data-toggle="pill" href="#">4</a> </li>
                                </ul>
                                <!-- end::Nav pills -->
                            </div>
                        </div>
                    </div>
                    <!--end::Portlet-->
                </div>
                <div class="col-lg-12 col-xl-8">
                    <!--begin::Portlet-->
                    <div class="kt-portlet kt-portlet--height-fluid">
                        <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Recent Orders <small>32500 total</small>
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper kt-form">
                                    <div class="kt-form__group kt-form__group--inline kt-margin-r-10">
                                        <div class="kt-form__label">Sort By:</div>
                                        <div class="kt-form__control" style="width: 160px;">
                                            <select class="form-control bootstrap-select" id="kt_form_status" title="Status">
                                                <option value="1">Pending</option>
                                                <option value="2">Delivered</option>
                                                <option value="3">Canceled</option>
                                                <option value="4">Success</option>
                                                <option value="5">Info</option>
                                                <option value="6">Danger</option>
                                            </select>
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-brand btn-upper btn-bold">New Record</a>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body kt-portlet__body--fit">
                            <!--Doc: For the datatable initialization refer to "recentOrdersInit" function in "src\theme\app\scripts\custom\dashboard.js" -->
                            <div class="kt-datatable" id="kt_recent_orders"></div>
                        </div>
                    </div>
                    <!--end::Portlet-->
                </div>
            </div>
            <!--end::Row-->
        </div>
        <div class="tab-pane fade" id="kt_tabs_1_4" role="tabpanel">
            <!--begin::Row-->
            <div class="row">
                <div class="col-lg-6 col-xl-4">
                    <!--begin::Portlet-->
                    <div class="kt-portlet kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Top Products
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-toolbar-wrapper">
                                    <div class="dropdown dropdown-inline">
                                        <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <ul class="kt-nav">
                                                <li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">Export Tools</span> </li>
                                                <li class="kt-nav__item">
                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-print"></i> <span class="kt-nav__link-text">Print</span> </a>
                                                </li>
                                                <li class="kt-nav__item">
                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-copy"></i> <span class="kt-nav__link-text">Copy</span> </a>
                                                </li>
                                                <li class="kt-nav__item">
                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-excel-o"></i> <span class="kt-nav__link-text">Excel</span> </a>
                                                </li>
                                                <li class="kt-nav__item">
                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-text-o"></i> <span class="kt-nav__link-text">CSV</span> </a>
                                                </li>
                                                <li class="kt-nav__item">
                                                    <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-pdf-o"></i> <span class="kt-nav__link-text">PDF</span> </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-widget-1">
                                <ul class="nav nav-pills nav-tabs-btn nav-pills-btn-brand" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#kt_tabs_19_15c4f43eadd0d7" role="tab">
                                            <span class="nav-link-icon"><i class="flaticon2-graphic"></i></span>
                                            <span class="nav-link-title">Settings</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#kt_tabs_19_25c4f43eadd0d7" role="tab">
                                            <span class="nav-link-icon"><i class="flaticon2-position"></i></span>
                                            <span class="nav-link-title">Code</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#kt_tabs_19_35c4f43eadd0d7" role="tab">
                                            <span class="nav-link-icon"><i class="flaticon2-layers-1"></i></span>
                                            <span class="nav-link-title">Design</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="kt_tabs_19_15c4f43eadd0d7" role="tabpanel">
                                        <div class="kt-widget-1__item">
                                            <div class="kt-widget-1__item-info">
                                                <a href="#" class="kt-widget-1__item-title"> HTML 5 Templates </a>
                                                <div class="kt-widget-1__item-desc">Font-end,Admin & Email</div>
                                            </div>
                                            <div class="kt-widget-1__item-stats">
                                                <div class="kt-widget-1__item-value">+79%</div>
                                                <div class="kt-widget-1__item-progress">
                                                    <div class="progress">
                                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 79%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-widget-1__item">
                                            <div class="kt-widget-1__item-info">
                                                <a href="#" class="kt-widget-1__item-title"> Wordpress Themes </a>
                                                <div class="kt-widget-1__item-desc">eCommerce Website, Plugin</div>
                                            </div>
                                            <div class="kt-widget-1__item-stats">
                                                <div class="kt-widget-1__item-value">+21%</div>
                                                <div class="kt-widget-1__item-progress">
                                                    <div class="progress">
                                                        <div class="progress-bar bg-brand" role="progressbar" style="width: 60%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-widget-1__item">
                                            <div class="kt-widget-1__item-info">
                                                <a href="#" class="kt-widget-1__item-title">eCommerce Websites</a>
                                                <div class="kt-widget-1__item-desc">Shops, Fasion wep sites & atc</div>
                                            </div>
                                            <div class="kt-widget-1__item-stats">
                                                <div class="kt-widget-1__item-value">-16%</div>
                                                <div class="kt-widget-1__item-progress">
                                                    <div class="progress">
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: 80%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-widget-1__item">
                                            <div class="kt-widget-1__item-info">
                                                <a href="#" class="kt-widget-1__item-title">UI/UX Design</a>
                                                <div class="kt-widget-1__item-desc">Evrything you ever imagine</div>
                                            </div>
                                            <div class="kt-widget-1__item-stats">
                                                <div class="kt-widget-1__item-value">+4%</div>
                                                <div class="kt-widget-1__item-progress">
                                                    <div class="progress">
                                                        <div class="progress-bar bg-focus" role="progressbar" style="width: 90%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-widget-1__item">
                                            <div class="kt-widget-1__item-info">
                                                <a href="#" class="kt-widget-1__item-title">Freebie Themes</a>
                                                <div class="kt-widget-1__item-desc">Font-end & Admin</div>
                                            </div>
                                            <div class="kt-widget-1__item-stats">
                                                <div class="kt-widget-1__item-value">+34</div>
                                                <div class="kt-widget-1__item-progress">
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="kt_tabs_19_25c4f43eadd0d7" role="tabpanel">
                                        <div class="kt-widget-1__item">
                                            <div class="kt-widget-1__item-info">
                                                <a href="#" class="kt-widget-1__item-title">UI/UX Design</a>
                                                <div class="kt-widget-1__item-desc">Evrything you ever imagine</div>
                                            </div>
                                            <div class="kt-widget-1__item-stats">
                                                <div class="kt-widget-1__item-value">+4%</div>
                                                <div class="kt-widget-1__item-progress">
                                                    <div class="progress">
                                                        <div class="progress-bar bg-focus" role="progressbar" style="width: 90%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-widget-1__item">
                                            <div class="kt-widget-1__item-info">
                                                <a href="#" class="kt-widget-1__item-title">HTML 5 Templates</a>
                                                <div class="kt-widget-1__item-desc">Font-end,Admin & Email</div>
                                            </div>
                                            <div class="kt-widget-1__item-stats">
                                                <div class="kt-widget-1__item-value">+79%</div>
                                                <div class="kt-widget-1__item-progress">
                                                    <div class="progress">
                                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 79%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-widget-1__item">
                                            <div class="kt-widget-1__item-info">
                                                <a href="#" class="kt-widget-1__item-title">Wordpress Themes</a>
                                                <div class="kt-widget-1__item-desc">eCommerce Website, Plugin</div>
                                            </div>
                                            <div class="kt-widget-1__item-stats">
                                                <div class="kt-widget-1__item-value">+21%</div>
                                                <div class="kt-widget-1__item-progress">
                                                    <div class="progress">
                                                        <div class="progress-bar bg-brand" role="progressbar" style="width: 60%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-widget-1__item">
                                            <div class="kt-widget-1__item-info">
                                                <a href="#" class="kt-widget-1__item-title">eCommerce Websites</a>
                                                <div class="kt-widget-1__item-desc">Shops, Fasion wep sites & atc</div>
                                            </div>
                                            <div class="kt-widget-1__item-stats">
                                                <div class="kt-widget-1__item-value">-16%</div>
                                                <div class="kt-widget-1__item-progress">
                                                    <div class="progress">
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: 80%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-widget-1__item">
                                            <div class="kt-widget-1__item-info">
                                                <a href="#" class="kt-widget-1__item-title">Freebie Themes</a>
                                                <div class="kt-widget-1__item-desc">Font-end & Admin</div>
                                            </div>
                                            <div class="kt-widget-1__item-stats">
                                                <div class="kt-widget-1__item-value">+34</div>
                                                <div class="kt-widget-1__item-progress">
                                                    <div class="progress">
                                                        <div class="progress-bar bg-info" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="kt_tabs_19_35c4f43eadd0d7" role="tabpanel">
                                        <div class="kt-widget-1__item">
                                            <div class="kt-widget-1__item-info">
                                                <a href="#" class="kt-widget-1__item-title">eCommerce Websites</a>
                                                <div class="kt-widget-1__item-desc">Shops, Fasion wep sites & atc</div>
                                            </div>
                                            <div class="kt-widget-1__item-stats">
                                                <div class="kt-widget-1__item-value">-16%</div>
                                                <div class="kt-widget-1__item-progress">
                                                    <div class="progress">
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: 80%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-widget-1__item">
                                            <div class="kt-widget-1__item-info">
                                                <a href="#" class="kt-widget-1__item-title">UI/UX Design</a>
                                                <div class="kt-widget-1__item-desc">Evrything you ever imagine</div>
                                            </div>
                                            <div class="kt-widget-1__item-stats">
                                                <div class="kt-widget-1__item-value">+4%</div>
                                                <div class="kt-widget-1__item-progress">
                                                    <div class="progress">
                                                        <div class="progress-bar bg-focus" role="progressbar" style="width: 90%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-widget-1__item">
                                            <div class="kt-widget-1__item-info">
                                                <a href="#" class="kt-widget-1__item-title">Latest Trends</a>
                                                <div class="kt-widget-1__item-desc">eCommerce Website, Plugin</div>
                                            </div>
                                            <div class="kt-widget-1__item-stats">
                                                <div class="kt-widget-1__item-value">+34%</div>
                                                <div class="kt-widget-1__item-progress">
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 50%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-widget-1__item">
                                            <div class="kt-widget-1__item-info">
                                                <a href="#" class="kt-widget-1__item-title">HTML 5 Templates</a>
                                                <div class="kt-widget-1__item-desc">Font-end,Admin & Email</div>
                                            </div>
                                            <div class="kt-widget-1__item-stats">
                                                <div class="kt-widget-1__item-value">+79%</div>
                                                <div class="kt-widget-1__item-progress">
                                                    <div class="progress">
                                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 79%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-widget-1__item">
                                            <div class="kt-widget-1__item-info">
                                                <a href="#" class="kt-widget-1__item-title">Freebie Themes</a>
                                                <div class="kt-widget-1__item-desc">Font-end & Admin</div>
                                            </div>
                                            <div class="kt-widget-1__item-stats">
                                                <div class="kt-widget-1__item-value">+34</div>
                                                <div class="kt-widget-1__item-progress">
                                                    <div class="progress">
                                                        <div class="progress-bar bg-info" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Portlet-->
                </div>
                <div class="col-lg-6 col-xl-4">
                    <!--begin::Portlet-->
                    <div class="kt-portlet kt-portlet--height-fluid-half kt-widget-12">
                        <div class="kt-portlet__body">
                            <div class="kt-widget-12__body">
                                <div class="kt-widget-12__head">
                                    <div class="kt-widget-12__date kt-widget-12__date--warning"> <span class="kt-widget-12__day">23</span> <span class="kt-widget-12__month">Dec</span> </div>
                                    <div class="kt-widget-12__label">
                                        <h3 class="kt-widget-12__title">
                                            Christmas Party
                                        </h3>
                                        <span class="kt-widget-12__desc">Bolton House</span>
                                    </div>
                                </div>
                                <div class="kt-widget-12__info"> To start a blog, think of a topic about and first brainstorm party is ways to write details </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot kt-portlet__foot--md">
                            <div class="kt-portlet__foot-wrapper">
                                <div class="kt-portlet__foot-info">
                                    <div class="kt-widget-12__members">
                                        <a href="#" class="kt-widget-12__member" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="John Myer">
                                            <img src="{{ config("app.keen_assets") }}/media/users/100_1.jpg" alt="image"/>
                                        </a>
                                        <a href="#" class="kt-widget-12__member" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="Alison Brandy">
                                            <img src="{{ config("app.keen_assets") }}/media/users/100_10.jpg" alt="image"/>
                                        </a>
                                        <a href="#" class="kt-widget-12__member" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="Selina Cranson">
                                            <img src="{{ config("app.keen_assets") }}/media/users/100_11.jpg" alt="image"/>
                                        </a>
                                        <a href="#" class="kt-widget-12__member" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="Luke Walls">
                                            <img src="{{ config("app.keen_assets") }}/media/users/100_2.jpg" alt="image"/>
                                        </a>
                                        <a href="#" class="kt-widget-12__member" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="Micheal York">
                                            <img src="{{ config("app.keen_assets") }}/media/users/100_3.jpg" alt="image"/>
                                        </a>
                                        <a href="#" class="kt-widget-12__member kt-widget-12__member--last"> +10 </a>
                                    </div>
                                </div>
                                <div class="kt-portlet__foot-toolbar"> <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">Join</a> </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Portlet-->
                    <!--begin::Portlet-->
                    <div class="kt-portlet kt-portlet--height-fluid-half kt-widget-12">
                        <div class="kt-portlet__body">
                            <div class="kt-widget-12__body">
                                <div class="kt-widget-12__head">
                                    <div class="kt-widget-12__date kt-widget-12__date--focus"> <span class="kt-widget-12__day">05</span> <span class="kt-widget-12__month">Jan</span> </div>
                                    <div class="kt-widget-12__label">
                                        <h3 class="kt-widget-12__title">
                                            Outdoor Activity Day
                                        </h3>
                                        <span class="kt-widget-12__desc">South Suton</span>
                                    </div>
                                </div>
                                <div class="kt-widget-12__info"> To start a blog, think of a topic about and first brainstorm party is ways to write details </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot kt-portlet__foot--md">
                            <div class="kt-portlet__foot-wrapper">
                                <div class="kt-portlet__foot-info">
                                    <div class="kt-widget-12__members">
                                        <a href="#" class="kt-widget-12__member" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="John Myer">
                                            <img src="{{ config("app.keen_assets") }}/media/users/100_1.jpg" alt="image"/>
                                        </a>
                                        <a href="#" class="kt-widget-12__member" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="Alison Brandy">
                                            <img src="{{ config("app.keen_assets") }}/media/users/100_10.jpg" alt="image"/>
                                        </a>
                                        <a href="#" class="kt-widget-12__member" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="Selina Cranson">
                                            <img src="{{ config("app.keen_assets") }}/media/users/100_11.jpg" alt="image"/>
                                        </a>
                                        <a href="#" class="kt-widget-12__member" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="Luke Walls">
                                            <img src="{{ config("app.keen_assets") }}/media/users/100_2.jpg" alt="image"/>
                                        </a>
                                        <a href="#" class="kt-widget-12__member" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="Micheal York">
                                            <img src="{{ config("app.keen_assets") }}/media/users/100_3.jpg" alt="image"/>
                                        </a>
                                        <a href="#" class="kt-widget-12__member kt-widget-12__member--last"> +7 </a>
                                    </div>
                                </div>
                                <div class="kt-portlet__foot-toolbar"> <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">Join</a> </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Portlet-->
                </div>
                <div class="col-lg-6 col-xl-4">
                    <!--begin::Portlet-->
                    <div class="kt-portlet kt-portlet--height-fluid-half kt-widget ">
                        <div class="kt-portlet__body">
                            <div id="kt-widget-slider-13-1" class="kt-slider carousel slide" data-ride="carousel" data-interval="8000">
                                <div class="kt-slider__head">
                                    <div class="kt-slider__label">Announcements</div>
                                    <div class="kt-slider__nav">
                                        <a class="kt-slider__nav-prev carousel-control-prev" href="#kt-widget-slider-13-1" role="button" data-slide="prev"> <i class="fa fa-angle-left"></i> </a>
                                        <a class="kt-slider__nav-next carousel-control-next" href="#kt-widget-slider-13-1" role="button" data-slide="next"> <i class="fa fa-angle-right"></i> </a>
                                    </div>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active kt-slider__body">
                                        <div class="kt-widget-13">
                                            <div class="kt-widget-13__body">
                                                <a class="kt-widget-13__title" href="#">Keen Admin Launch Day</a>
                                                <div class="kt-widget-13__desc"> To start a blog, think of a topic about and first brainstorm party is ways to write details </div>
                                            </div>
                                            <div class="kt-widget-13__foot">
                                                <div class="kt-widget-13__label">
                                                    <div class="btn btn-sm btn-label btn-bold"> 07 OCT, 2018 </div>
                                                </div>
                                                <div class="kt-widget-13__toolbar"> <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">View</a> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item kt-slider__body">
                                        <div class="kt-widget-13">
                                            <div class="kt-widget-13__body">
                                                <a class="kt-widget-13__title" href="#">Incredibly Positive Reviews</a>
                                                <div class="kt-widget-13__desc"> To start a blog, think of a topic about and first brainstorm party is ways to write details </div>
                                            </div>
                                            <div class="kt-widget-13__foot">
                                                <div class="kt-widget-13__title">
                                                    <div class="btn btn-sm btn-label btn-bold"> 17 NOV, 2018 </div>
                                                </div>
                                                <div class="kt-widget-13__toolbar"> <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">View</a> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item kt-slider__body">
                                        <div class="kt-widget-13">
                                            <div class="kt-widget-13__body">
                                                <a class="kt-widget-13__title" href="#">Award Winning Theme</a>
                                                <div class="kt-widget-13__desc"> To start a blog, think of a topic about and first brainstorm party is ways to write details </div>
                                            </div>
                                            <div class="kt-widget-13__foot">
                                                <div class="kt-widget-13__label">
                                                    <div class="btn btn-sm btn-label btn-bold"> 03 SEP, 2018 </div>
                                                </div>
                                                <div class="kt-widget-13__toolbar"> <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">View</a> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Portlet-->
                    <!--begin::Portlet-->
                    <div class="kt-portlet kt-portlet--height-fluid-half kt-widget-13">
                        <div class="kt-portlet__body">
                            <div id="kt-widget-slider-13-2" class="kt-slider carousel slide" data-ride="carousel" data-interval="4000">
                                <div class="kt-slider__head">
                                    <div class="kt-slider__label">Projects</div>
                                    <div class="kt-slider__nav">
                                        <a class="kt-slider__nav-prev carousel-control-prev" href="#kt-widget-slider-13-2" role="button" data-slide="prev"> <i class="fa fa-angle-left"></i> </a>
                                        <a class="kt-slider__nav-next carousel-control-next" href="#kt-widget-slider-13-2" role="button" data-slide="next"> <i class="fa fa-angle-right"></i> </a>
                                    </div>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active kt-slider__body">
                                        <div class="kt-widget-13">
                                            <div class="kt-widget-13__body">
                                                <a class="kt-widget-13__title" href="#">Keen Admin Launch Day</a>
                                                <div class="kt-widget-13__desc"> To start a blog, think of a topic about and first brainstorm party is ways to write details </div>
                                            </div>
                                            <div class="kt-widget-13__foot">
                                                <div class="kt-widget-13__progress">
                                                    <div class="kt-widget-13__progress-info">
                                                        <div class="kt-widget-13__progress-status"> Progress </div>
                                                        <div class="kt-widget-13__progress-value">78%</div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar kt-bg-brand" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item kt-slider__body">
                                        <div class="kt-widget-13">
                                            <div class="kt-widget-13__body">
                                                <a class="kt-widget-13__title" href="#">First Milestone Achivement</a>
                                                <div class="kt-widget-13__desc"> To start a blog, think of a topic about and first brainstorm party is ways to write details </div>
                                            </div>
                                            <div class="kt-widget-13__foot">
                                                <div class="kt-widget-13__progress">
                                                    <div class="kt-widget-13__progress-info">
                                                        <div class="kt-widget-13__progress-status"> Progress </div>
                                                        <div class="kt-widget-13__progress-value">55%</div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar kt-bg-brand" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item kt-slider__body">
                                        <div class="kt-widget-13">
                                            <div class="kt-widget-13__body">
                                                <a class="kt-widget-13__title" href="#">Reached 50,000 sales</a>
                                                <div class="kt-widget-13__desc"> To start a blog, think of a topic about and first brainstorm party is ways to write details </div>
                                            </div>
                                            <div class="kt-widget-13__foot">
                                                <div class="kt-widget-13__progress">
                                                    <div class="kt-widget-13__progress-info">
                                                        <div class="kt-widget-13__progress-status"> Progress </div>
                                                        <div class="kt-widget-13__progress-value">24%</div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar kt-bg-brand" role="progressbar" style="width: 24%" aria-valuenow="24" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Portlet-->
                </div>
            </div>
            <!--end::Row-->
        </div>
    </div>
@endsection
