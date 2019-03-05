<?php
/**
 * Created by PhpStorm.
 * User: hjelmdal
 * Date: 16/02/2019
 * Time: 01.45
 */
?>
@extends("layouts.theme.index")
@section("scripts")
    <script src="{{ config("app.keen_assets") }}/app/custom/general/custom/profile/profile.js" type="text/javascript"></script>
@endsection
@section("styles")
    <link href="{{ config("app.keen_assets") }}/app/custom/user/profile-v1.demo5.css" rel="stylesheet" type="text/css" />
@endsection
@section("content")

    <!-- begin:: Content -->
    <div class="k-content k-grid__item k-grid__item--fluid" id="k_content">
        <!--begin::Row-->
        <div class="row">
            <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
                <!--begin::Portlet-->
                <div class="k-portlet k-portlet--height-fluid k-widget-12">
                    <div class="k-portlet__body">
                        <div class="k-widget-12__body">
                            <div class="k-widget-12__head">
                                <div class="k-widget-12__date k-widget-12__date--success"> <span class="k-widget-12__day">08</span> <span class="k-widget-12__month">Dec</span> </div>
                                <div class="k-widget-12__label">
                                    <h3 class="k-widget-12__title">
                                        AirGreat Presentation
                                    </h3>
                                    <span class="k-widget-12__desc">Oxfort Street</span>
                                </div>
                            </div>
                            <div class="k-widget-12__info"> To start a blog, think of a topic about and first brainstorm ways to write details </div>
                        </div>
                    </div>
                    <div class="k-portlet__foot k-portlet__foot--md">
                        <div class="k-portlet__foot-wrapper">
                            <div class="k-portlet__foot-info">
                                <div class="k-widget-12__members">
                                    <a href="#" class="k-widget-12__member" data-toggle="k-tooltip" data-skin="brand" data-placement="top" title="John Myer">
                                        <img src="{{ config("app.keen_assets") }}/media/users/100_1.jpg" alt="image"/>
                                    </a>
                                    <a href="#" class="k-widget-12__member" data-toggle="k-tooltip" data-skin="brand" data-placement="top" title="Alison Brandy">
                                        <img src="{{ config("app.keen_assets") }}/media/users/100_10.jpg" alt="image"/>
                                    </a>
                                    <a href="#" class="k-widget-12__member" data-toggle="k-tooltip" data-skin="brand" data-placement="top" title="Selina Cranson">
                                        <img src="{{ config("app.keen_assets") }}/media/users/100_11.jpg" alt="image"/>
                                    </a>
                                    <a href="#" class="k-widget-12__member" data-toggle="k-tooltip" data-skin="brand" data-placement="top" title="Luke Walls">
                                        <img src="{{ config("app.keen_assets") }}/media/users/100_2.jpg" alt="image"/>
                                    </a>
                                    <a href="#" class="k-widget-12__member" data-toggle="k-tooltip" data-skin="brand" data-placement="top" title="Micheal York">
                                        <img src="{{ config("app.keen_assets") }}/media/users/100_3.jpg" alt="image"/>
                                    </a>
                                    <a href="#" class="k-widget-12__member k-widget-12__member--last"> +3 </a>
                                </div>
                            </div>
                            <div class="k-portlet__foot-toolbar"> <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">Join</a> </div>
                        </div>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
            <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
                <!--begin::Portlet-->
                <div class="k-portlet k-portlet--height-fluid k-widget-12">
                    <div class="k-portlet__body">
                        <div class="k-widget-12__body">
                            <div class="k-widget-12__head">
                                <div class="k-widget-12__date k-widget-12__date--warning"> <span class="k-widget-12__day">23</span> <span class="k-widget-12__month">Dec</span> </div>
                                <div class="k-widget-12__label">
                                    <h3 class="k-widget-12__title">
                                        Christmas Party
                                    </h3>
                                    <span class="k-widget-12__desc">Bolton House</span>
                                </div>
                            </div>
                            <div class="k-widget-12__info"> To start a blog, think of a topic about and first brainstorm party is ways to write details </div>
                        </div>
                    </div>
                    <div class="k-portlet__foot k-portlet__foot--md">
                        <div class="k-portlet__foot-wrapper">
                            <div class="k-portlet__foot-info">
                                <div class="k-widget-12__members">
                                    <a href="#" class="k-widget-12__member" data-toggle="k-tooltip" data-skin="brand" data-placement="top" title="John Myer">
                                        <img src="{{ config("app.keen_assets") }}/media/users/100_1.jpg" alt="image"/>
                                    </a>
                                    <a href="#" class="k-widget-12__member" data-toggle="k-tooltip" data-skin="brand" data-placement="top" title="Alison Brandy">
                                        <img src="{{ config("app.keen_assets") }}/media/users/100_10.jpg" alt="image"/>
                                    </a>
                                    <a href="#" class="k-widget-12__member" data-toggle="k-tooltip" data-skin="brand" data-placement="top" title="Selina Cranson">
                                        <img src="{{ config("app.keen_assets") }}/media/users/100_11.jpg" alt="image"/>
                                    </a>
                                    <a href="#" class="k-widget-12__member" data-toggle="k-tooltip" data-skin="brand" data-placement="top" title="Luke Walls">
                                        <img src="{{ config("app.keen_assets") }}/media/users/100_2.jpg" alt="image"/>
                                    </a>
                                    <a href="#" class="k-widget-12__member" data-toggle="k-tooltip" data-skin="brand" data-placement="top" title="Micheal York">
                                        <img src="{{ config("app.keen_assets") }}/media/users/100_3.jpg" alt="image"/>
                                    </a>
                                    <a href="#" class="k-widget-12__member k-widget-12__member--last"> +10 </a>
                                </div>
                            </div>
                            <div class="k-portlet__foot-toolbar"> <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">Join</a> </div>
                        </div>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
            <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
                <!--begin::Portlet-->
                <div class="k-portlet k-portlet--height-fluid k-widget-12">
                    <div class="k-portlet__body">
                        <div class="k-widget-12__body">
                            <div class="k-widget-12__head">
                                <div class="k-widget-12__date k-widget-12__date--focus"> <span class="k-widget-12__day">05</span> <span class="k-widget-12__month">Jan</span> </div>
                                <div class="k-widget-12__label">
                                    <h3 class="k-widget-12__title">
                                        Outdoor Activity Day
                                    </h3>
                                    <span class="k-widget-12__desc">South Suton</span>
                                </div>
                            </div>
                            <div class="k-widget-12__info"> To start a blog, think of a topic about and first brainstorm party is ways to write details </div>
                        </div>
                    </div>
                    <div class="k-portlet__foot k-portlet__foot--md">
                        <div class="k-portlet__foot-wrapper">
                            <div class="k-portlet__foot-info">
                                <div class="k-widget-12__members">
                                    <a href="#" class="k-widget-12__member" data-toggle="k-tooltip" data-skin="brand" data-placement="top" title="John Myer">
                                        <img src="{{ config("app.keen_assets") }}/media/users/100_1.jpg" alt="image"/>
                                    </a>
                                    <a href="#" class="k-widget-12__member" data-toggle="k-tooltip" data-skin="brand" data-placement="top" title="Alison Brandy">
                                        <img src="{{ config("app.keen_assets") }}/media/users/100_10.jpg" alt="image"/>
                                    </a>
                                    <a href="#" class="k-widget-12__member" data-toggle="k-tooltip" data-skin="brand" data-placement="top" title="Selina Cranson">
                                        <img src="{{ config("app.keen_assets") }}/media/users/100_11.jpg" alt="image"/>
                                    </a>
                                    <a href="#" class="k-widget-12__member" data-toggle="k-tooltip" data-skin="brand" data-placement="top" title="Luke Walls">
                                        <img src="{{ config("app.keen_assets") }}/media/users/100_2.jpg" alt="image"/>
                                    </a>
                                    <a href="#" class="k-widget-12__member" data-toggle="k-tooltip" data-skin="brand" data-placement="top" title="Micheal York">
                                        <img src="{{ config("app.keen_assets") }}/media/users/100_3.jpg" alt="image"/>
                                    </a>
                                    <a href="#" class="k-widget-12__member k-widget-12__member--last"> +7 </a>
                                </div>
                            </div>
                            <div class="k-portlet__foot-toolbar"> <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">Join</a> </div>
                        </div>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
            <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
                <!--begin::Portlet-->
                <div class="k-portlet k-portlet--height-fluid k-widget ">
                    <div class="k-portlet__body">
                        <div id="k-widget-slider-13-1" class="k-slider carousel slide" data-ride="carousel" data-interval="8000">
                            <div class="k-slider__head">
                                <div class="k-slider__label">Announcements</div>
                                <div class="k-slider__nav">
                                    <a class="k-slider__nav-prev carousel-control-prev" href="#k-widget-slider-13-1" role="button" data-slide="prev"> <i class="fa fa-angle-left"></i> </a>
                                    <a class="k-slider__nav-next carousel-control-next" href="#k-widget-slider-13-1" role="button" data-slide="next"> <i class="fa fa-angle-right"></i> </a>
                                </div>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active k-slider__body">
                                    <div class="k-widget-13">
                                        <div class="k-widget-13__body">
                                            <a class="k-widget-13__title" href="#">Keen Admin Launch Day</a>
                                            <div class="k-widget-13__desc"> To start a blog, think of a topic about and first brainstorm party is ways to write details </div>
                                        </div>
                                        <div class="k-widget-13__foot">
                                            <div class="k-widget-13__label">
                                                <div class="btn btn-sm btn-label btn-bold"> 07 OCT, 2018 </div>
                                            </div>
                                            <div class="k-widget-13__toolbar"> <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">View</a> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item k-slider__body">
                                    <div class="k-widget-13">
                                        <div class="k-widget-13__body">
                                            <a class="k-widget-13__title" href="#">Incredibly Positive Reviews</a>
                                            <div class="k-widget-13__desc"> To start a blog, think of a topic about and first brainstorm party is ways to write details </div>
                                        </div>
                                        <div class="k-widget-13__foot">
                                            <div class="k-widget-13__title">
                                                <div class="btn btn-sm btn-label btn-bold"> 17 NOV, 2018 </div>
                                            </div>
                                            <div class="k-widget-13__toolbar"> <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">View</a> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item k-slider__body">
                                    <div class="k-widget-13">
                                        <div class="k-widget-13__body">
                                            <a class="k-widget-13__title" href="#">Award Winning Theme</a>
                                            <div class="k-widget-13__desc"> To start a blog, think of a topic about and first brainstorm party is ways to write details </div>
                                        </div>
                                        <div class="k-widget-13__foot">
                                            <div class="k-widget-13__label">
                                                <div class="btn btn-sm btn-label btn-bold"> 03 SEP, 2018 </div>
                                            </div>
                                            <div class="k-widget-13__toolbar"> <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">View</a> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
            <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
                <!--begin::Portlet-->
                <div class="k-portlet k-portlet--height-fluid k-widget-13">
                    <div class="k-portlet__body">
                        <div id="k-widget-slider-13-2" class="k-slider carousel slide" data-ride="carousel" data-interval="4000">
                            <div class="k-slider__head">
                                <div class="k-slider__label">Projects</div>
                                <div class="k-slider__nav">
                                    <a class="k-slider__nav-prev carousel-control-prev" href="#k-widget-slider-13-2" role="button" data-slide="prev"> <i class="fa fa-angle-left"></i> </a>
                                    <a class="k-slider__nav-next carousel-control-next" href="#k-widget-slider-13-2" role="button" data-slide="next"> <i class="fa fa-angle-right"></i> </a>
                                </div>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active k-slider__body">
                                    <div class="k-widget-13">
                                        <div class="k-widget-13__body">
                                            <a class="k-widget-13__title" href="#">Keen Admin Launch Day</a>
                                            <div class="k-widget-13__desc"> To start a blog, think of a topic about and first brainstorm party is ways to write details </div>
                                        </div>
                                        <div class="k-widget-13__foot">
                                            <div class="k-widget-13__progress">
                                                <div class="k-widget-13__progress-info">
                                                    <div class="k-widget-13__progress-status"> Progress </div>
                                                    <div class="k-widget-13__progress-value">78%</div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar k-bg-brand" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item k-slider__body">
                                    <div class="k-widget-13">
                                        <div class="k-widget-13__body">
                                            <a class="k-widget-13__title" href="#">First Milestone Achivement</a>
                                            <div class="k-widget-13__desc"> To start a blog, think of a topic about and first brainstorm party is ways to write details </div>
                                        </div>
                                        <div class="k-widget-13__foot">
                                            <div class="k-widget-13__progress">
                                                <div class="k-widget-13__progress-info">
                                                    <div class="k-widget-13__progress-status"> Progress </div>
                                                    <div class="k-widget-13__progress-value">55%</div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar k-bg-brand" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item k-slider__body">
                                    <div class="k-widget-13">
                                        <div class="k-widget-13__body">
                                            <a class="k-widget-13__title" href="#">Reached 50,000 sales</a>
                                            <div class="k-widget-13__desc"> To start a blog, think of a topic about and first brainstorm party is ways to write details </div>
                                        </div>
                                        <div class="k-widget-13__foot">
                                            <div class="k-widget-13__progress">
                                                <div class="k-widget-13__progress-info">
                                                    <div class="k-widget-13__progress-status"> Progress </div>
                                                    <div class="k-widget-13__progress-value">24%</div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar k-bg-brand" role="progressbar" style="width: 24%" aria-valuenow="24" aria-valuemin="0" aria-valuemax="100"></div>
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
            <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
                <!--begin::Portlet-->
                <div class="k-portlet k-portlet--height-fluid k-widget-13">
                    <div class="k-portlet__body">
                        <div id="k-widget-slider-13-3" class="k-slider carousel slide" data-ride="carousel" data-interval="12000">
                            <div class="k-slider__head">
                                <div class="k-slider__label">Today's Schedule</div>
                                <div class="k-slider__nav">
                                    <a class="k-slider__nav-prev carousel-control-prev" href="#k-widget-slider-13-3" role="button" data-slide="prev"> <i class="fa fa-angle-left"></i> </a>
                                    <a class="k-slider__nav-next carousel-control-next" href="#k-widget-slider-13-3" role="button" data-slide="next"> <i class="fa fa-angle-right"></i> </a>
                                </div>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active k-slider__body">
                                    <div class="k-widget-13">
                                        <div class="k-widget-13__body">
                                            <a class="k-widget-13__title" href="#">Octa Pre-Launch Meeting</a>
                                            <div class="k-widget-13__desc k-widget-13__desc--xl k-font-brand"> 9:20AM - 10:00AM </div>
                                        </div>
                                        <div class="k-widget-13__foot">
                                            <div class="k-widget-13__label"> <i class="fa fa-map-marker-alt k-label-font-color-2"></i> <span class="k-label-font-color-2">490 E Main St. Norwich...</span> </div>
                                            <div class="k-widget-13__toolbar"> <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">View Map</a> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item k-slider__body">
                                    <div class="k-widget-13">
                                        <div class="k-widget-13__body">
                                            <a class="k-widget-13__title" href="#">UI/UX Design Updates</a>
                                            <div class="k-widget-13__desc k-widget-13__desc--xl k-font-brand"> 11:15AM - 12:30PM </div>
                                        </div>
                                        <div class="k-widget-13__foot">
                                            <div class="k-widget-13__label"> <i class="fa fa-map-marker-alt k-label-font-color-2"></i> <span class="k-label-font-color-2">246 R St. Manhattan NY...</span> </div>
                                            <div class="k-widget-13__toolbar"> <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">View Map</a> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item k-slider__body">
                                    <div class="k-widget-13">
                                        <div class="k-widget-13__body">
                                            <a class="k-widget-13__title" href="#">Sales Report Summary Meet-up</a>
                                            <div class="k-widget-13__desc k-widget-13__desc--xl k-font-brand"> 4:30PM - 5:30PM </div>
                                        </div>
                                        <div class="k-widget-13__foot">
                                            <div class="k-widget-13__label"> <i class="fa fa-map-marker-alt k-label-font-color-2"></i> <span class="k-label-font-color-2">492 F Sub St. Norwich CT...</span> </div>
                                            <div class="k-widget-13__toolbar"> <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">View Map</a> </div>
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
        <!--begin::Row-->
        <div class="row">
            <div class="col-lg-4 col-xl-4 order-lg-1 order-xl-1">
                <!--begin::Portlet-->
                <div class="k-portlet k-portlet--fit k-portlet--height-fluid">
                    <div class="k-portlet__body k-portlet__body--fluid">
                        <div class="k-widget-3 k-widget-3--brand">
                            <div class="k-widget-3__content">
                                <div class="k-widget-3__content-info">
                                    <div class="k-widget-3__content-section">
                                        <div class="k-widget-3__content-title">Annual Profit</div>
                                        <div class="k-widget-3__content-desc">SAAS TOTAL PORIFT</div>
                                    </div>
                                    <div class="k-widget-3__content-section">
                                        <span class="k-widget-3__content-bedge">$</span>
                                        <span class="k-widget-3__content-number">17<span>M</span></span>
                                    </div>
                                </div>
                                <div class="k-widget-3__content-stats">
                                    <div class="k-widget-3__content-progress">
                                        <div class="progress">
                                            <!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
                                            <div class="progress-bar bg-light" style="width: 72%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="k-widget-3__content-action">
                                        <div class="k-widget-3__content-text">CHANGE</div>
                                        <div class="k-widget-3__content-value">+72%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
            <div class="col-lg-4 col-xl-4 order-lg-1 order-xl-1">
                <!--begin::Portlet-->
                <div class="k-portlet k-portlet--fit k-portlet--height-fluid">
                    <div class="k-portlet__body k-portlet__body--fluid">
                        <div class="k-widget-3 k-widget-3--danger">
                            <div class="k-widget-3__content">
                                <div class="k-widget-3__content-info">
                                    <div class="k-widget-3__content-section">
                                        <div class="k-widget-3__content-title">Annual Sales</div>
                                        <div class="k-widget-3__content-desc">TOTAL SALES AMOUNT</div>
                                    </div>
                                    <div class="k-widget-3__content-section">
                                        <span class="k-widget-3__content-number">920<span>K</span></span>
                                    </div>
                                </div>
                                <div class="k-widget-3__content-stats">
                                    <div class="k-widget-3__content-progress">
                                        <div class="progress">
                                            <!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
                                            <div class="progress-bar bg-light" style="width: 85%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="k-widget-3__content-action">
                                        <div class="k-widget-3__content-text">CHANGE</div>
                                        <div class="k-widget-3__content-value">+85%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
            <div class="col-lg-4 col-xl-4 order-lg-1 order-xl-1">
                <!--begin::Portlet-->
                <div class="k-portlet k-portlet--fit k-portlet--height-fluid">
                    <div class="k-portlet__body k-portlet__body--fluid">
                        <div class="k-widget-3 k-widget-3--success">
                            <div class="k-widget-3__content">
                                <div class="k-widget-3__content-info">
                                    <div class="k-widget-3__content-section">
                                        <div class="k-widget-3__content-title">Response Rate</div>
                                        <div class="k-widget-3__content-desc">Support Quality</div>
                                    </div>
                                    <div class="k-widget-3__content-section">
                                        <span class="k-widget-3__content-number">89<span>%</span></span>
                                    </div>
                                </div>
                                <div class="k-widget-3__content-stats">
                                    <div class="k-widget-3__content-progress">
                                        <div class="progress">
                                            <!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
                                            <div class="progress-bar bg-light" style="width: 45%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="k-widget-3__content-action">
                                        <div class="k-widget-3__content-text">CHANGE</div>
                                        <div class="k-widget-3__content-value">+45%</div>
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
        <!--begin::Row-->
        <div class="row">
            <div class="col-lg-12 col-xl-8 order-lg-1 order-xl-1">
                <!--begin::Portlet-->
                <div class="k-portlet k-portlet--height-fluid-half k-widget-14">
                    <div class="k-portlet__body">
                        <!-- Doc: The bootstrap carousel is a slideshow for cycling through a series of content, see https://getbootstrap.com/docs/4.1/components/carousel/ -->
                        <div id="k-widget-slider-14-1" class="k-slider carousel slide" data-ride="carousel" data-interval="8000">
                            <div class="k-slider__head">
                                <div class="k-slider__label">New Products</div>
                                <div class="k-slider__nav">
                                    <a class="k-slider__nav-prev carousel-control-prev" href="#k-widget-slider-14-1" role="button" data-slide="prev"> <i class="fa fa-angle-left"></i> </a>
                                    <a class="k-slider__nav-next carousel-control-next" href="#k-widget-slider-14-1" role="button" data-slide="next"> <i class="fa fa-angle-right"></i> </a>
                                </div>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="k-widget-14__body">
                                        <div class="k-widget-14__product">
                                            <div class="k-widget-14__thumb">
                                                <a href="#">
                                                    <img src="{{ config("app.keen_assets") }}/media/blog/1.jpg" class="k-widget-14__image--landscape" alt="" title="" />
                                                </a>
                                            </div>
                                            <div class="k-widget-14__content">
                                                <a href="#">
                                                    <h3 class="k-widget-14__title">
                                                        Active Smartwatch
                                                    </h3>
                                                </a>
                                                <div class="k-widget-14__desc"> Beautifully designed watch that helps you track your fitness and diet – while keeping you motivated! </div>
                                            </div>
                                        </div>
                                        <div class="k-widget-14__data">
                                            <div class="k-widget-14__info">
                                                <div class="k-widget-14__info-title k-font-brand">246</div>
                                                <div class="k-widget-14__desc">Purchases</div>
                                            </div>
                                            <div class="k-widget-14__info">
                                                <div class="k-widget-14__info-title">37</div>
                                                <div class="k-widget-14__desc">Reviews</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="k-widget-14__foot">
                                        <div class="k-widget-14__foot-info">
                                            <div class="k-widget-14__foot-label btn btn-sm btn-label-brand btn-bold"> 24 Nov, 2018 </div>
                                            <div class="k-widget-14__foot-desc">Date of Release</div>
                                        </div>
                                        <div class="k-widget-14__foot-toolbar"> <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">Preview</a> <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">Details</a> </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="k-widget-14__body">
                                        <div class="k-widget-14__product">
                                            <div class="k-widget-14__thumb">
                                                <a href="#">
                                                    <img src="{{ config("app.keen_assets") }}/media/blog/2.jpg" class="k-widget-14__image--landscape" alt="" title="" />
                                                </a>
                                            </div>
                                            <div class="k-widget-14__content">
                                                <a href="#">
                                                    <h3 class="k-widget-14__title">
                                                        DSLR Lens
                                                    </h3>
                                                </a>
                                                <div class="k-widget-14__desc"> Wide-angle, Quick Focus. Emphasis is on modern lenses for 35 mm film SLRs and for DSLRs with sensor sizes less than or equal to 35 mm. </div>
                                            </div>
                                        </div>
                                        <div class="k-widget-14__data">
                                            <div class="k-widget-14__info">
                                                <div class="k-widget-14__info-title k-font-brand">142</div>
                                                <div class="k-widget-14__desc">Purchases</div>
                                            </div>
                                            <div class="k-widget-14__info">
                                                <div class="k-widget-14__info-title">25</div>
                                                <div class="k-widget-14__desc">Reviews</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="k-widget-14__foot">
                                        <div class="k-widget-14__foot-info">
                                            <div class="k-widget-14__foot-label btn btn-sm btn-label-brand btn-bold"> 24 Nov, 2018 </div>
                                            <div class="k-widget-14__foot-desc">Date of Release</div>
                                        </div>
                                        <div class="k-widget-14__foot-toolbar"> <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">Preview</a> <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">Details</a> </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="k-widget-14__body">
                                        <div class="k-widget-14__product">
                                            <div class="k-widget-14__thumb">
                                                <a href="#">
                                                    <img src="{{ config("app.keen_assets") }}/media/blog/4.jpg" class="k-widget-14__image--landscape" alt="" title="" />
                                                </a>
                                            </div>
                                            <div class="k-widget-14__content">
                                                <a href="#">
                                                    <h3 class="k-widget-14__title">
                                                        Polaroid Camera
                                                    </h3>
                                                </a>
                                                <div class="k-widget-14__desc"> Instant is back! Make photos fun again with the new range of Polaroid Instant Cameras with Vintage Effects and Built in Flash </div>
                                            </div>
                                        </div>
                                        <div class="k-widget-14__data">
                                            <div class="k-widget-14__info">
                                                <div class="k-widget-14__info-title k-font-brand">3578</div>
                                                <div class="k-widget-14__desc">Purchases</div>
                                            </div>
                                            <div class="k-widget-14__info">
                                                <div class="k-widget-14__info-title">457</div>
                                                <div class="k-widget-14__desc">Reviews</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="k-widget-14__foot">
                                        <div class="k-widget-14__foot-info">
                                            <div class="k-widget-14__foot-label btn btn-sm btn-label-brand btn-bold"> 24 Nov, 2018 </div>
                                            <div class="k-widget-14__foot-desc">Date of Release</div>
                                        </div>
                                        <div class="k-widget-14__foot-toolbar"> <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">Preview</a> <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">Details</a> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Portlet-->
                <!--begin::Portlet-->
                <div class="k-portlet k-portlet--height-fluid-half k-widget-15">
                    <div class="k-portlet__body">
                        <!-- Doc: The bootstrap carousel is a slideshow for cycling through a series of content, see https://getbootstrap.com/docs/4.1/components/carousel/ -->
                        <div id="k-widget-slider-14-2" class="k-slider carousel slide" data-ride="carousel" data-interval="8000">
                            <div class="k-slider__head">
                                <div class="k-slider__label">New Authors</div>
                                <div class="k-slider__nav">
                                    <a class="k-slider__nav-prev carousel-control-prev" href="#k-widget-slider-14-2" role="button" data-slide="prev"> <i class="fa fa-angle-left"></i> </a>
                                    <a class="k-slider__nav-next carousel-control-next" href="#k-widget-slider-14-2" role="button" data-slide="next"> <i class="fa fa-angle-right"></i> </a>
                                </div>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="k-widget-15__body">
                                        <div class="k-widget-15__author">
                                            <div class="k-widget-15__photo">
                                                <a href="#">
                                                    <img src="{{ config("app.keen_assets") }}/media/users/100_14.jpg" alt="" title="" />
                                                </a>
                                            </div>
                                            <div class="k-widget-15__detail">
                                                <a href="#" class="k-widget-15__name">Andy John</a>
                                                <div class="k-widget-15__desc"> AngularJS Expert </div>
                                            </div>
                                        </div>
                                        <div class="k-widget-15__wrapper">
                                            <div class="k-widget-15__info">
                                                <a href="#" class="btn btn-icon btn-sm btn-circle btn-success"><i class="fa fa-envelope"></i></a>
                                                <a href="#" class="k-widget-15__info--item">sale@boatline.com</a>
                                            </div>
                                            <div class="k-widget-15__info">
                                                <a href="#" class="btn btn-icon btn-sm btn-circle btn-brand"><i class="fa fa-phone"></i></a>
                                                <a href="#" class="k-widget-15__info--item">(+44) 345 345 4705</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="k-widget-15__foot">
                                        <div class="k-widget-15__foot-info">
                                            <div class="k-widget-15__foot-label btn btn-sm btn-label-brand btn-bold"> 01 Sep, 2018 </div>
                                            <div class="k-widget-15__foot-desc">Joined Date</div>
                                        </div>
                                        <div class="k-widget-15__foot-toolbar"> <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">Message</a> <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">Profile</a> </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="k-widget-15__body">
                                        <div class="k-widget-15__author">
                                            <div class="k-widget-15__photo">
                                                <a href="#">
                                                    <img src="{{ config("app.keen_assets") }}/media/users/100_3.jpg" alt="" title="" />
                                                </a>
                                            </div>
                                            <div class="k-widget-15__detail">
                                                <a href="#" class="k-widget-15__name">Patrick Smith</a>
                                                <div class="k-widget-15__desc"> ReactJS Expert </div>
                                            </div>
                                        </div>
                                        <div class="k-widget-15__wrapper">
                                            <div class="k-widget-15__info">
                                                <a href="#" class="btn btn-icon btn-sm btn-circle btn-success"><i class="fa fa-envelope"></i></a>
                                                <a href="#" class="k-widget-15__info--item">patrick@boatline.com</a>
                                            </div>
                                            <div class="k-widget-15__info">
                                                <a href="#" class="btn btn-icon btn-sm btn-circle btn-brand"><i class="fa fa-phone"></i></a>
                                                <a href="#" class="k-widget-15__info--item">(+44) 345 345 5574</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="k-widget-15__foot">
                                        <div class="k-widget-15__foot-info">
                                            <div class="k-widget-15__foot-label btn btn-sm btn-label-brand btn-bold"> 01 Sep, 2018 </div>
                                            <div class="k-widget-15__foot-desc">Joined Date</div>
                                        </div>
                                        <div class="k-widget-15__foot-toolbar"> <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">Message</a> <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">Profile</a> </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="k-widget-15__body">
                                        <div class="k-widget-15__author">
                                            <div class="k-widget-15__photo">
                                                <a href="#">
                                                    <img src="{{ config("app.keen_assets") }}/media/users/100_7.jpg" alt="" title="" />
                                                </a>
                                            </div>
                                            <div class="k-widget-15__detail">
                                                <a href="#" class="k-widget-15__name">Amanda Collin</a>
                                                <div class="k-widget-15__desc"> Project Manager </div>
                                            </div>
                                        </div>
                                        <div class="k-widget-15__wrapper">
                                            <div class="k-widget-15__info">
                                                <a href="#" class="btn btn-icon btn-sm btn-circle btn-success"><i class="fa fa-envelope"></i></a>
                                                <a href="#" class="k-widget-15__info--item">amanda@boatline.com</a>
                                            </div>
                                            <div class="k-widget-15__info">
                                                <a href="#" class="btn btn-icon btn-sm btn-circle btn-brand"><i class="fa fa-phone"></i></a>
                                                <a href="#" class="k-widget-15__info--item">(+44) 345 345 1247</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="k-widget-15__foot">
                                        <div class="k-widget-15__foot-info">
                                            <div class="k-widget-15__foot-label btn btn-sm btn-label-brand btn-bold"> 01 Sep, 2018 </div>
                                            <div class="k-widget-15__foot-desc">Joined Date</div>
                                        </div>
                                        <div class="k-widget-15__foot-toolbar"> <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">Message</a> <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">Profile</a> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
            <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
                <!--begin::Portlet-->
                <div class="k-portlet k-portlet--height-fluid">
                    <div class="k-portlet__head">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">
                                Recent Works
                            </h3>
                        </div>
                        <div class="k-portlet__head-toolbar">
                            <div class="k-portlet__head-toolbar-wrapper">
                                <div class="dropdown dropdown-inline">
                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="k-nav">
                                            <li class="k-nav__section k-nav__section--first"> <span class="k-nav__section-text">Export Tools</span> </li>
                                            <li class="k-nav__item">
                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-print"></i> <span class="k-nav__link-text">Print</span> </a>
                                            </li>
                                            <li class="k-nav__item">
                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-copy"></i> <span class="k-nav__link-text">Copy</span> </a>
                                            </li>
                                            <li class="k-nav__item">
                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-file-excel-o"></i> <span class="k-nav__link-text">Excel</span> </a>
                                            </li>
                                            <li class="k-nav__item">
                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-file-text-o"></i> <span class="k-nav__link-text">CSV</span> </a>
                                            </li>
                                            <li class="k-nav__item">
                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-file-pdf-o"></i> <span class="k-nav__link-text">PDF</span> </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="k-portlet__body">
                        <div class="k-widget-6">
                            <!-- begin::Tab Content -->
                            <div class="k-widget6__tab tab-content">
                                <div id="k_personal_income_quater_15c6c6ac9276a6" class="tab-pane fade active show">
                                    <div class="k-widget-6__items">
                                        <div class="k-widget-6__item">
                                            <div class="k-widget-6__item-pic">
                                                <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-7.jpg" alt="" />
                                            </div>
                                            <div class="k-widget-6__item-info">
                                                <div class="k-widget-6__item-title"> Quickly direct you useful content or people </div>
                                                <div class="k-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                            </div>
                                            <div class="k-widget-6__item-icon k-widget-6__item-icon--brand">
                                                <div class="dropdown dropdown-inline">
                                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="k-nav">
                                                            <li class="k-nav__section k-nav__section--first"> <span class="k-nav__section-text">EXPORT TOOLS</span> </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-eye"></i> <span class="k-nav__link-text">View</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-comment-o"></i> <span class="k-nav__link-text">Coments</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-copy"></i> <span class="k-nav__link-text">Copy</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-file-excel-o"></i> <span class="k-nav__link-text">Excel</span> </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="k-widget-6__item">
                                            <div class="k-widget-6__item-pic">
                                                <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-6.jpg" alt="" />
                                            </div>
                                            <div class="k-widget-6__item-info">
                                                <div class="k-widget-6__item-title"> Get the point across </div>
                                                <div class="k-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                            </div>
                                            <div class="k-widget-6__item-icon k-widget-6__item-icon--brand">
                                                <div class="dropdown dropdown-inline">
                                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="k-nav">
                                                            <li class="k-nav__section k-nav__section--first"> <span class="k-nav__section-text">EXPORT TOOLS</span> </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-eye"></i> <span class="k-nav__link-text">View</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-comment-o"></i> <span class="k-nav__link-text">Coments</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-copy"></i> <span class="k-nav__link-text">Copy</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-file-excel-o"></i> <span class="k-nav__link-text">Excel</span> </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="k-widget-6__item">
                                            <div class="k-widget-6__item-pic">
                                                <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-5.jpg" alt="" />
                                            </div>
                                            <div class="k-widget-6__item-info">
                                                <div class="k-widget-6__item-title"> Contain amazing email sign up form </div>
                                                <div class="k-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                            </div>
                                            <div class="k-widget-6__item-icon k-widget-6__item-icon--brand">
                                                <div class="dropdown dropdown-inline">
                                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="k-nav">
                                                            <li class="k-nav__section k-nav__section--first"> <span class="k-nav__section-text">EXPORT TOOLS</span> </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-eye"></i> <span class="k-nav__link-text">View</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-comment-o"></i> <span class="k-nav__link-text">Coments</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-copy"></i> <span class="k-nav__link-text">Copy</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-file-excel-o"></i> <span class="k-nav__link-text">Excel</span> </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="k-widget-6__item">
                                            <div class="k-widget-6__item-pic">
                                                <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-2.jpg" alt="" />
                                            </div>
                                            <div class="k-widget-6__item-info">
                                                <div class="k-widget-6__item-title"> Tips on How to Write an About me page </div>
                                                <div class="k-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                            </div>
                                            <div class="k-widget-6__item-icon k-widget-6__item-icon--brand">
                                                <div class="dropdown dropdown-inline">
                                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="k-nav">
                                                            <li class="k-nav__section k-nav__section--first"> <span class="k-nav__section-text">EXPORT TOOLS</span> </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-eye"></i> <span class="k-nav__link-text">View</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-comment-o"></i> <span class="k-nav__link-text">Coments</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-copy"></i> <span class="k-nav__link-text">Copy</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-file-excel-o"></i> <span class="k-nav__link-text">Excel</span> </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="k_personal_income_quater_25c6c6ac9276a6" class="tab-pane fade">
                                    <div class="k-widget-6__items">
                                        <div class="k-widget-6__item">
                                            <div class="k-widget-6__item-pic">
                                                <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-6.jpg" alt="" />
                                            </div>
                                            <div class="k-widget-6__item-info">
                                                <div class="k-widget-6__item-title"> Get the point across </div>
                                                <div class="k-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                            </div>
                                            <div class="k-widget-6__item-icon k-widget-6__item-icon--brand">
                                                <div class="dropdown dropdown-inline">
                                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="k-nav">
                                                            <li class="k-nav__section k-nav__section--first"> <span class="k-nav__section-text">EXPORT TOOLS</span> </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-eye"></i> <span class="k-nav__link-text">View</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-comment-o"></i> <span class="k-nav__link-text">Coments</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-copy"></i> <span class="k-nav__link-text">Copy</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-file-excel-o"></i> <span class="k-nav__link-text">Excel</span> </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="k-widget-6__item">
                                            <div class="k-widget-6__item-pic">
                                                <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-2.jpg" alt="" />
                                            </div>
                                            <div class="k-widget-6__item-info">
                                                <div class="k-widget-6__item-title"> Tips on How to Write an About me page </div>
                                                <div class="k-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                            </div>
                                            <div class="k-widget-6__item-icon k-widget-6__item-icon--brand">
                                                <div class="dropdown dropdown-inline">
                                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="k-nav">
                                                            <li class="k-nav__section k-nav__section--first"> <span class="k-nav__section-text">EXPORT TOOLS</span> </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-eye"></i> <span class="k-nav__link-text">View</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-comment-o"></i> <span class="k-nav__link-text">Coments</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-copy"></i> <span class="k-nav__link-text">Copy</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-file-excel-o"></i> <span class="k-nav__link-text">Excel</span> </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="k-widget-6__item">
                                            <div class="k-widget-6__item-pic">
                                                <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-7.jpg" alt="" />
                                            </div>
                                            <div class="k-widget-6__item-info">
                                                <div class="k-widget-6__item-title"> Quickly direct you useful content or people </div>
                                                <div class="k-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                            </div>
                                            <div class="k-widget-6__item-icon k-widget-6__item-icon--brand">
                                                <div class="dropdown dropdown-inline">
                                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="k-nav">
                                                            <li class="k-nav__section k-nav__section--first"> <span class="k-nav__section-text">EXPORT TOOLS</span> </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-eye"></i> <span class="k-nav__link-text">View</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-comment-o"></i> <span class="k-nav__link-text">Coments</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-copy"></i> <span class="k-nav__link-text">Copy</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-file-excel-o"></i> <span class="k-nav__link-text">Excel</span> </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="k-widget-6__item">
                                            <div class="k-widget-6__item-pic">
                                                <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-5.jpg" alt="" />
                                            </div>
                                            <div class="k-widget-6__item-info">
                                                <div class="k-widget-6__item-title"> Contain amazing email sign up form </div>
                                                <div class="k-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                            </div>
                                            <div class="k-widget-6__item-icon k-widget-6__item-icon--brand">
                                                <div class="dropdown dropdown-inline">
                                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="k-nav">
                                                            <li class="k-nav__section k-nav__section--first"> <span class="k-nav__section-text">EXPORT TOOLS</span> </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-eye"></i> <span class="k-nav__link-text">View</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-comment-o"></i> <span class="k-nav__link-text">Coments</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-copy"></i> <span class="k-nav__link-text">Copy</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-file-excel-o"></i> <span class="k-nav__link-text">Excel</span> </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="k_personal_income_quater_35c6c6ac9276a6" class="tab-pane fade">
                                    <div class="k-widget-6__items">
                                        <div class="k-widget-6__item">
                                            <div class="k-widget-6__item-pic">
                                                <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-5.jpg" alt="" />
                                            </div>
                                            <div class="k-widget-6__item-info">
                                                <div class="k-widget-6__item-title"> Contain amazing email sign up form </div>
                                                <div class="k-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                            </div>
                                            <div class="k-widget-6__item-icon k-widget-6__item-icon--brand">
                                                <div class="dropdown dropdown-inline">
                                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="k-nav">
                                                            <li class="k-nav__section k-nav__section--first"> <span class="k-nav__section-text">EXPORT TOOLS</span> </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-eye"></i> <span class="k-nav__link-text">View</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-comment-o"></i> <span class="k-nav__link-text">Coments</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-copy"></i> <span class="k-nav__link-text">Copy</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-file-excel-o"></i> <span class="k-nav__link-text">Excel</span> </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="k-widget-6__item">
                                            <div class="k-widget-6__item-pic">
                                                <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-4.jpg" alt="" />
                                            </div>
                                            <div class="k-widget-6__item-info">
                                                <div class="k-widget-6__item-title"> Tips on How to Write an About me page </div>
                                                <div class="k-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                            </div>
                                            <div class="k-widget-6__item-icon k-widget-6__item-icon--brand">
                                                <div class="dropdown dropdown-inline">
                                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="k-nav">
                                                            <li class="k-nav__section k-nav__section--first"> <span class="k-nav__section-text">EXPORT TOOLS</span> </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-eye"></i> <span class="k-nav__link-text">View</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-comment-o"></i> <span class="k-nav__link-text">Coments</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-copy"></i> <span class="k-nav__link-text">Copy</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-file-excel-o"></i> <span class="k-nav__link-text">Excel</span> </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="k-widget-6__item">
                                            <div class="k-widget-6__item-pic">
                                                <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-6.jpg" alt="" />
                                            </div>
                                            <div class="k-widget-6__item-info">
                                                <div class="k-widget-6__item-title"> Get the point across </div>
                                                <div class="k-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                            </div>
                                            <div class="k-widget-6__item-icon k-widget-6__item-icon--brand">
                                                <div class="dropdown dropdown-inline">
                                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="k-nav">
                                                            <li class="k-nav__section k-nav__section--first"> <span class="k-nav__section-text">EXPORT TOOLS</span> </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-eye"></i> <span class="k-nav__link-text">View</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-comment-o"></i> <span class="k-nav__link-text">Coments</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-copy"></i> <span class="k-nav__link-text">Copy</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-file-excel-o"></i> <span class="k-nav__link-text">Excel</span> </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="k-widget-6__item">
                                            <div class="k-widget-6__item-pic">
                                                <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-2.jpg" alt="" />
                                            </div>
                                            <div class="k-widget-6__item-info">
                                                <div class="k-widget-6__item-title"> Tips on How to Write an About me page </div>
                                                <div class="k-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                            </div>
                                            <div class="k-widget-6__item-icon k-widget-6__item-icon--brand">
                                                <div class="dropdown dropdown-inline">
                                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="k-nav">
                                                            <li class="k-nav__section k-nav__section--first"> <span class="k-nav__section-text">EXPORT TOOLS</span> </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-eye"></i> <span class="k-nav__link-text">View</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-comment-o"></i> <span class="k-nav__link-text">Coments</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-copy"></i> <span class="k-nav__link-text">Copy</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-file-excel-o"></i> <span class="k-nav__link-text">Excel</span> </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="k_personal_income_quater_45c6c6ac9276a6" class="tab-pane fade">
                                    <div class="k-widget-6__items">
                                        <div class="k-widget-6__item">
                                            <div class="k-widget-6__item-pic">
                                                <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-6.jpg" alt="" />
                                            </div>
                                            <div class="k-widget-6__item-info">
                                                <div class="k-widget-6__item-title"> Get the point across </div>
                                                <div class="k-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                            </div>
                                            <div class="k-widget-6__item-icon k-widget-6__item-icon--brand">
                                                <div class="dropdown dropdown-inline">
                                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="k-nav">
                                                            <li class="k-nav__section k-nav__section--first"> <span class="k-nav__section-text">EXPORT TOOLS</span> </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-eye"></i> <span class="k-nav__link-text">View</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-comment-o"></i> <span class="k-nav__link-text">Coments</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-copy"></i> <span class="k-nav__link-text">Copy</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-file-excel-o"></i> <span class="k-nav__link-text">Excel</span> </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="k-widget-6__item">
                                            <div class="k-widget-6__item-pic">
                                                <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-5.jpg" alt="" />
                                            </div>
                                            <div class="k-widget-6__item-info">
                                                <div class="k-widget-6__item-title"> Contain amazing email sign up form </div>
                                                <div class="k-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                            </div>
                                            <div class="k-widget-6__item-icon k-widget-6__item-icon--brand">
                                                <div class="dropdown dropdown-inline">
                                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="k-nav">
                                                            <li class="k-nav__section k-nav__section--first"> <span class="k-nav__section-text">EXPORT TOOLS</span> </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-eye"></i> <span class="k-nav__link-text">View</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-comment-o"></i> <span class="k-nav__link-text">Coments</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-copy"></i> <span class="k-nav__link-text">Copy</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-file-excel-o"></i> <span class="k-nav__link-text">Excel</span> </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="k-widget-6__item">
                                            <div class="k-widget-6__item-pic">
                                                <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-3.jpg" alt="" />
                                            </div>
                                            <div class="k-widget-6__item-info">
                                                <div class="k-widget-6__item-title"> Get the point across </div>
                                                <div class="k-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                            </div>
                                            <div class="k-widget-6__item-icon k-widget-6__item-icon--brand">
                                                <div class="dropdown dropdown-inline">
                                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="k-nav">
                                                            <li class="k-nav__section k-nav__section--first"> <span class="k-nav__section-text">EXPORT TOOLS</span> </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-eye"></i> <span class="k-nav__link-text">View</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-comment-o"></i> <span class="k-nav__link-text">Coments</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-copy"></i> <span class="k-nav__link-text">Copy</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-file-excel-o"></i> <span class="k-nav__link-text">Excel</span> </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="k-widget-6__item">
                                            <div class="k-widget-6__item-pic">
                                                <img class="" src="{{ config("app.keen_assets") }}/media/blog/blog-2.jpg" alt="" />
                                            </div>
                                            <div class="k-widget-6__item-info">
                                                <div class="k-widget-6__item-title"> Tips on How to Write an About me page </div>
                                                <div class="k-widget-6__item-desc"> HTML, CSS, JavaScripts </div>
                                            </div>
                                            <div class="k-widget-6__item-icon k-widget-6__item-icon--brand">
                                                <div class="dropdown dropdown-inline">
                                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="k-nav">
                                                            <li class="k-nav__section k-nav__section--first"> <span class="k-nav__section-text">EXPORT TOOLS</span> </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-eye"></i> <span class="k-nav__link-text">View</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-comment-o"></i> <span class="k-nav__link-text">Coments</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-copy"></i> <span class="k-nav__link-text">Copy</span> </a>
                                                            </li>
                                                            <li class="k-nav__item">
                                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-file-excel-o"></i> <span class="k-nav__link-text">Excel</span> </a>
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
                            <ul class="k-widget-6__nav-items nav nav-pills nav-fill" role="tablist">
                                <li class="k-widget-6__nav-item nav-item"> <a class="nav-link active show" data-toggle="pill" href="#k_personal_income_quater_15c6c6ac9276a6">1</a> </li>
                                <li class="k-widget-6__nav-item nav-item"> <a class="nav-link" data-toggle="pill" href="#k_personal_income_quater_25c6c6ac9276a6">2</a> </li>
                                <li class="k-widget-6__nav-item nav-item"> <a class="nav-link" data-toggle="pill" href="#">3</a> </li>
                                <li class="k-widget-6__nav-item nav-item"> <a class="nav-link" data-toggle="pill" href="#">4</a> </li>
                            </ul>
                            <!-- end::Nav pills -->
                        </div>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
            <div class="col-lg-12 col-xl-8 order-lg-1 order-xl-1">
                <!--begin::Portlet-->
                <div class="k-portlet k-portlet--height-fluid k-widget-17">
                    <div class="k-portlet__head">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">
                                Latest Orders
                            </h3>
                        </div>
                        <div class="k-portlet__head-toolbar">
                            <div class="k-portlet__head-toolbar-wrapper">
                                <div class="dropdown dropdown-inline">
                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="k-nav">
                                            <li class="k-nav__section k-nav__section--first"> <span class="k-nav__section-text">Export Tools</span> </li>
                                            <li class="k-nav__item">
                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-print"></i> <span class="k-nav__link-text">Print</span> </a>
                                            </li>
                                            <li class="k-nav__item">
                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-copy"></i> <span class="k-nav__link-text">Copy</span> </a>
                                            </li>
                                            <li class="k-nav__item">
                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-file-excel-o"></i> <span class="k-nav__link-text">Excel</span> </a>
                                            </li>
                                            <li class="k-nav__item">
                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-file-text-o"></i> <span class="k-nav__link-text">CSV</span> </a>
                                            </li>
                                            <li class="k-nav__item">
                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-file-pdf-o"></i> <span class="k-nav__link-text">PDF</span> </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="k-portlet__body">
                        <div class="k-widget-17">
                            <div class="k-widget-17__item">
                                <div class="k-widget-17__product">
                                    <div class="k-widget-17__thumb">
                                        <a href="#">
                                            <img src="{{ config("app.keen_assets") }}/media/blog/7.jpg" class="k-widget-17__image" alt="" title="" />
                                        </a>
                                    </div>
                                    <div class="k-widget-17__product-desc">
                                        <a href="#">
                                            <div class="k-widget-17__title"> Dark Blue Shoes - Limited Collection </div>
                                        </a>
                                        <div class="k-widget-17__sku"> SKU: 08451345264 </div>
                                    </div>
                                </div>
                                <div class="k-widget-17__prices">
                                    <div class="k-widget-17__unit"> $38.00 <span>x</span> 2 </div>
                                    <div class="k-widget-17__total"> $76.00 </div>
                                </div>
                            </div>
                            <div class="k-widget-17__item">
                                <div class="k-widget-17__product">
                                    <div class="k-widget-17__thumb">
                                        <a href="#">
                                            <img src="{{ config("app.keen_assets") }}/media/blog/8.jpg" class="k-widget-17__image" alt="" title="" />
                                        </a>
                                    </div>
                                    <div class="k-widget-17__product-desc">
                                        <a href="#">
                                            <div class="k-widget-17__title"> Converse Sneakers - Red, Green & White </div>
                                        </a>
                                        <div class="k-widget-17__sku"> SKU: 08451345244 </div>
                                    </div>
                                </div>
                                <div class="k-widget-17__prices">
                                    <div class="k-widget-17__unit"> $92.00 <span>x</span> 1 </div>
                                    <div class="k-widget-17__total"> $92.00 </div>
                                </div>
                            </div>
                            <div class="k-widget-17__item">
                                <div class="k-widget-17__product">
                                    <div class="k-widget-17__thumb">
                                        <a href="#">
                                            <img src="{{ config("app.keen_assets") }}/media/blog/12.jpg" class="k-widget-17__image" alt="" title="" />
                                        </a>
                                    </div>
                                    <div class="k-widget-17__product-desc">
                                        <a href="#">
                                            <div class="k-widget-17__title"> Merrell - Best Hiking Shoes </div>
                                        </a>
                                        <div class="k-widget-17__sku"> SKU: 08451345285 </div>
                                    </div>
                                </div>
                                <div class="k-widget-17__prices">
                                    <div class="k-widget-17__unit"> $224.00 <span>x</span> 1 </div>
                                    <div class="k-widget-17__total"> $224.00 </div>
                                </div>
                            </div>
                            <div class="k-widget-17__item">
                                <div class="k-widget-17__product">
                                    <div class="k-widget-17__thumb">
                                        <a href="#">
                                            <img src="{{ config("app.keen_assets") }}/media/blog/11.jpg" class="k-widget-17__image" alt="" title="" />
                                        </a>
                                    </div>
                                    <div class="k-widget-17__product-desc">
                                        <a href="#">
                                            <div class="k-widget-17__title"> Ray Ban - Green Sunglasses </div>
                                        </a>
                                        <div class="k-widget-17__sku"> SKU: 08451345239 </div>
                                    </div>
                                </div>
                                <div class="k-widget-17__prices">
                                    <div class="k-widget-17__unit"> $109.00 <span>x</span> 3 </div>
                                    <div class="k-widget-17__total"> $327.00 </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="k-portlet__foot k-portlet__foot--md">
                        <div class="k-widget-17__foot">
                            <div class="k-widget-17__foot-info"></div>
                            <div class="k-widget-17__foot-toolbar"> <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">Preview</a> <a href="#" class="btn btn-brand btn-sm btn-upper btn-bold">Approve</a> </div>
                        </div>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
            <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
                <!--begin::Portlet-->
                <div class="k-portlet k-portlet--height-fluid k-portlet--tabs">
                    <div class="k-portlet__head">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">
                                Latest Tasks
                            </h3>
                        </div>
                        <div class="k-portlet__head-toolbar">
                            <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-brand nav-tabs-bold" role="tablist">
                                <li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#k_portlet_tabs_1_1_content" role="tab" aria-selected="false"> Today </a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#k_portlet_tabs_1_2_content" role="tab" aria-selected="false"> Week </a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#k_portlet_tabs_1_3_content" role="tab" aria-selected="true"> Month </a> </li>
                            </ul>
                        </div>
                    </div>
                    <div class="k-portlet__body">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="k_portlet_tabs_1_1_content" role="tabpanel">
                                <div class="k-widget-5">
                                    <div class="k-widget-5__item k-widget-5__item--info">
                                        <div class="k-widget-5__item-info">
                                            <a href="#" class="k-widget-5__item-title"> Management meeting </a>
                                            <div class="k-widget-5__item-datetime"> 09:30 AM </div>
                                        </div>
                                        <div class="k-widget-5__item-check">
                                            <label class="k-radio">
                                                <input type="radio" checked="checked" name="radio1">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="k-widget-5__item k-widget-5__item--danger">
                                        <div class="k-widget-5__item-info">
                                            <a href="#" class="k-widget-5__item-title"> Replace datatables rows color </a>
                                            <div class="k-widget-5__item-datetime"> 12:00 AM </div>
                                        </div>
                                        <div class="k-widget-5__item-check">
                                            <label class="k-radio">
                                                <input type="radio" checked="checked" name="radio1">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="k-widget-5__item k-widget-5__item--brand">
                                        <div class="k-widget-5__item-info">
                                            <a href="#" class="k-widget-5__item-title"> Export Navitare booking table </a>
                                            <div class="k-widget-5__item-datetime"> 01:20 PM </div>
                                        </div>
                                        <div class="k-widget-5__item-check">
                                            <label class="k-radio">
                                                <input type="radio" checked="checked" name="radio1">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="k-widget-5__item k-widget-5__item--success">
                                        <div class="k-widget-5__item-info">
                                            <a href="#" class="k-widget-5__item-title"> NYCS internal discussion </a>
                                            <div class="k-widget-5__item-datetime"> 03: 00 PM </div>
                                        </div>
                                        <div class="k-widget-5__item-check">
                                            <label class="k-radio">
                                                <input type="radio" checked="checked" name="radio1">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="k-widget-5__item k-widget-5__item--danger">
                                        <div class="k-widget-5__item-info">
                                            <a href="#" class="k-widget-5__item-title"> Project Launch </a>
                                            <div class="k-widget-5__item-datetime"> 11: 00 AM </div>
                                        </div>
                                        <div class="k-widget-5__item-check">
                                            <label class="k-radio">
                                                <input type="radio" checked="checked" name="radio1">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="k-widget-5__item k-widget-5__item--success">
                                        <div class="k-widget-5__item-info">
                                            <a href="#" class="k-widget-5__item-title"> Server maintenance </a>
                                            <div class="k-widget-5__item-datetime"> 4: 30 PM </div>
                                        </div>
                                        <div class="k-widget-5__item-check">
                                            <label class="k-radio">
                                                <input type="radio" checked="checked" name="radio1">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="k_portlet_tabs_1_2_content" role="tabpanel">
                                <div class="k-widget-5">
                                    <div class="k-widget-5__item k-widget-5__item--brand">
                                        <div class="k-widget-5__item-info">
                                            <a href="#" class="k-widget-5__item-title"> Export Navitare booking table </a>
                                            <div class="k-widget-5__item-datetime"> 01:20 PM </div>
                                        </div>
                                        <div class="k-widget-5__item-check">
                                            <label class="k-radio">
                                                <input type="radio" checked="checked" name="radio1">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="k-widget-5__item k-widget-5__item--danger">
                                        <div class="k-widget-5__item-info">
                                            <a href="#" class="k-widget-5__item-title"> Replace datatables rows color </a>
                                            <div class="k-widget-5__item-datetime"> 12:00 AM </div>
                                        </div>
                                        <div class="k-widget-5__item-check">
                                            <label class="k-radio">
                                                <input type="radio" checked="checked" name="radio1">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="k-widget-5__item k-widget-5__item--brand">
                                        <div class="k-widget-5__item-info">
                                            <a href="#" class="k-widget-5__item-title"> Export Navitare booking table </a>
                                            <div class="k-widget-5__item-datetime"> 01:20 PM </div>
                                        </div>
                                        <div class="k-widget-5__item-check">
                                            <label class="k-radio">
                                                <input type="radio" checked="checked" name="radio1">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="k-widget-5__item k-widget-5__item--danger">
                                        <div class="k-widget-5__item-info">
                                            <a href="#" class="k-widget-5__item-title"> Replace datatables rows color </a>
                                            <div class="k-widget-5__item-datetime"> 12:00 AM </div>
                                        </div>
                                        <div class="k-widget-5__item-check">
                                            <label class="k-radio">
                                                <input type="radio" checked="checked" name="radio1">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="k-widget-5__item k-widget-5__item--success">
                                        <div class="k-widget-5__item-info">
                                            <a href="#" class="k-widget-5__item-title"> NYCS internal discussion </a>
                                            <div class="k-widget-5__item-datetime "> 03: 00 PM </div>
                                        </div>
                                        <div class="k-widget-5__item-check ">
                                            <label class="k-radio">
                                                <input type="radio" checked="checked" name="radio1">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="k-widget-5__item k-widget-5__item--info ">
                                        <div class="k-widget-5__item-info ">
                                            <a href="#" class="k-widget-5__item-title"> Management meeting </a>
                                            <div class="k-widget-5__item-datetime "> 09:30 AM </div>
                                        </div>
                                        <div class="k-widget-5__item-check ">
                                            <label class="k-radio">
                                                <input type="radio" checked="checked" name="radio1">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade " id="k_portlet_tabs_1_3_content" role="tabpanel">
                                <div class="k-widget-5 ">
                                    <div class="k-widget-5__item k-widget-5__item--success">
                                        <div class="k-widget-5__item-info ">
                                            <a href="#" class="k-widget-5__item-title"> NYCS internal discussion </a>
                                            <div class="k-widget-5__item-datetime"> 03: 00 PM </div>
                                        </div>
                                        <div class="k-widget-5__item-check">
                                            <label class="k-radio">
                                                <input type="radio" checked="checked" name="radio1">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="k-widget-5__item k-widget-5__item--danger">
                                        <div class="k-widget-5__item-info ">
                                            <a href="#" class="k-widget-5__item-title"> Replace datatables rows color </a>
                                            <div class="k-widget-5__item-datetime"> 12:00 AM </div>
                                        </div>
                                        <div class="k-widget-5__item-check">
                                            <label class="k-radio">
                                                <input type="radio" checked="checked" name="radio1">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="k-widget-5__item k-widget-5__item--danger">
                                        <div class="k-widget-5__item-info">
                                            <a href="#" class="k-widget-5__item-title"> Replace datatables rows color </a>
                                            <div class="k-widget-5__item-datetime"> 12:00 AM </div>
                                        </div>
                                        <div class="k-widget-5__item-check">
                                            <label class="k-radio">
                                                <input type="radio" checked="checked" name="radio1">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="k-widget-5__item k-widget-5__item--brand">
                                        <div class="k-widget-5__item-info">
                                            <a href="#" class="k-widget-5__item-title"> Export Navitare booking table </a>
                                            <div class="k-widget-5__item-datetime"> 01:20 PM </div>
                                        </div>
                                        <div class="k-widget-5__item-check">
                                            <label class="k-radio">
                                                <input type="radio" checked="checked" name="radio1">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="k-widget-5__item k-widget-5__item--brand">
                                        <div class="k-widget-5__item-info ">
                                            <a href="#" class="k-widget-5__item-title"> Export Navitare booking table </a>
                                            <div class="k-widget-5__item-datetime "> 01:20 PM </div>
                                        </div>
                                        <div class="k-widget-5__item-check">
                                            <label class="k-radio">
                                                <input type="radio" checked="checked" name="radio1">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="k-widget-5__item k-widget-5__item--info">
                                        <div class="k-widget-5__item-info ">
                                            <a href="#" class="k-widget-5__item-title"> Management meeting </a>
                                            <div class="k-widget-5__item-datetime"> 09:30 AM </div>
                                        </div>
                                        <div class="k-widget-5__item-check">
                                            <label class="k-radio">
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
            <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
                <!--begin::Portlet-->
                <div class="k-portlet k-portlet--height-fluid">
                    <div class="k-portlet__head">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">
                                Order Statistics
                            </h3>
                        </div>
                        <div class="k-portlet__head-toolbar">
                            <div class="k-portlet__head-toolbar-wrapper">
                                <div class="dropdown dropdown-inline">
                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="k-nav">
                                            <li class="k-nav__section k-nav__section--first"> <span class="k-nav__section-text">Export Tools</span> </li>
                                            <li class="k-nav__item">
                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-print"></i> <span class="k-nav__link-text">Print</span> </a>
                                            </li>
                                            <li class="k-nav__item">
                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-copy"></i> <span class="k-nav__link-text">Copy</span> </a>
                                            </li>
                                            <li class="k-nav__item">
                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-file-excel-o"></i> <span class="k-nav__link-text">Excel</span> </a>
                                            </li>
                                            <li class="k-nav__item">
                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-file-text-o"></i> <span class="k-nav__link-text">CSV</span> </a>
                                            </li>
                                            <li class="k-nav__item">
                                                <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-file-pdf-o"></i> <span class="k-nav__link-text">PDF</span> </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="k-portlet__body">
                        <div class="k-widget-18">
                            <div class="k-widget-18__summary">
                                <div class="k-widget-18__total">7,300</div>
                                <div class="k-widget-18__label">Total Orders</div>
                            </div>
                            <div class="k-widget-18__progress">
                                <div class="progress">
                                    <!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
                                    <div class="progress-bar bg-brand" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                    <div class="progress-bar bg-dark" role="progressbar" style="width: 5%" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="k-widget-18__item">
                                <div class="k-widget-18__legend k-bg-brand"></div>
                                <div class="k-widget-18__desc">
                                    <a href="">
                                        <div class="k-widget-18__title"> Mobile Games </div>
                                    </a>
                                    <div class="k-widget-18__desc"> Swift, Python, Java SDK </div>
                                </div>
                                <div class="k-widget-18__orders"> <span>3,244</span> Orders </div>
                            </div>
                            <div class="k-widget-18__item">
                                <div class="k-widget-18__legend k-bg-success"></div>
                                <div class="k-widget-18__desc">
                                    <a href="">
                                        <div class="k-widget-18__title"> B2B2C Solutions </div>
                                    </a>
                                    <div class="k-widget-18__desc"> ASP.NET, Ruby, Python </div>
                                </div>
                                <div class="k-widget-18__orders"> <span>962</span> Orders </div>
                            </div>
                            <div class="k-widget-18__item">
                                <div class="k-widget-18__legend k-bg-danger"></div>
                                <div class="k-widget-18__desc">
                                    <a href="">
                                        <div class="k-widget-18__title"> HTML Templates </div>
                                    </a>
                                    <div class="k-widget-18__desc"> HTML, CSS, JS </div>
                                </div>
                                <div class="k-widget-18__orders"> <span>2,750</span> Orders </div>
                            </div>
                            <div class="k-widget-18__item">
                                <div class="k-widget-18__legend k-bg-info"></div>
                                <div class="k-widget-18__desc">
                                    <a href="">
                                        <div class="k-widget-18__title"> Back-end Plugins </div>
                                    </a>
                                    <div class="k-widget-18__desc"> PHP, Ruby, C#, ASP.NET </div>
                                </div>
                                <div class="k-widget-18__orders"> <span>890</span> Orders </div>
                            </div>
                            <div class="k-widget-18__item">
                                <div class="k-widget-18__legend k-bg-dark"></div>
                                <div class="k-widget-18__desc">
                                    <a href="">
                                        <div class="k-widget-18__title"> Admin Software </div>
                                    </a>
                                    <div class="k-widget-18__desc"> Bootsrap, CSS, SCSS, AngularJS </div>
                                </div>
                                <div class="k-widget-18__orders"> <span>1,644</span> Orders </div>
                            </div>
                            <!--
<div class="k-widget-18__item">
<div class="k-widget-18__legend k-bg-success"></div>
<div class="k-widget-18__desc">
<a href=""><div class="k-widget-18__title">
    Dashboard System
</div></a>
<div class="k-widget-18__desc">
    Angular, Oracle, Java
</div>
</div>
<div class="k-widget-18__orders">
<span>560</span> Orders
</div>
</div>
-->
                        </div>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
            <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
                <div class="k-portlet k-portlet--tabs k-portlet--height-fluid">
                    <div class="k-portlet__head">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">
                                Notifications
                            </h3>
                        </div>
                        <div class="k-portlet__head-toolbar">
                            <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-brand nav-tabs-bold" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#k_portlet_tabs_1_1_1_content" role="tab"> Today </a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#k_portlet_tabs_1_1_2_content" role="tab"> Week </a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#k_portlet_tabs_1_1_3_content" role="tab"> Month </a> </li>
                            </ul>
                        </div>
                    </div>
                    <div class="k-portlet__body">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="k_portlet_tabs_1_1_1_content" role="tabpanel">
                                <div class="k-scroll" data-scroll="true" style="height: 420px;" data-mobile-height="350">
                                    <!--Begin::Timeline -->
                                    <div class="k-timeline">
                                        <!--Begin::Item -->
                                        <div class="k-timeline__item k-timeline__item--success">
                                            <div class="k-timeline__item-section">
                                                <div class="k-timeline__item-section-border">
                                                    <div class="k-timeline__item-section-icon"> <i class="flaticon-feed k-font-success"></i> </div>
                                                </div>
                                                <span class="k-timeline__item-datetime">02:30 PM</span>
                                            </div>
                                            <a href="" class="k-timeline__item-text"> KeenThemes created new layout whith tens of new options for Keen Admin panel </a>
                                            <div class="k-timeline__item-info"> HTML,CSS,VueJS </div>
                                        </div>
                                        <!--End::Item -->
                                        <!--Begin::Item -->
                                        <div class="k-timeline__item k-timeline__item--danger">
                                            <div class="k-timeline__item-section">
                                                <div class="k-timeline__item-section-border">
                                                    <div class="k-timeline__item-section-icon" > <i class="flaticon-safe-shield-protection k-font-danger"></i> </div>
                                                </div>
                                                <span class="k-timeline__item-datetime">01:20 AM</span>
                                            </div>
                                            <a href="" class="k-timeline__item-text"> New secyrity alert by Firewall & order to take aktion on User Preferences </a>
                                            <div class="k-timeline__item-info"> Security, Fieewall </div>
                                        </div>
                                        <!--End::Item -->
                                        <!--Begin::Item -->
                                        <div class="k-timeline__item k-timeline__item--brand">
                                            <div class="k-timeline__item-section">
                                                <div class="k-timeline__item-section-border">
                                                    <div class="k-timeline__item-section-icon"> <i class="flaticon2-box k-font-brand"></i> </div>
                                                </div>
                                                <span class="k-timeline__item-datetime">Yestardey</span>
                                            </div>
                                            <a href="" class="k-timeline__item-text"> FlyMore design mock-ups been uploadet by designers Bob, Naomi, Richard </a>
                                            <div class="k-timeline__item-info"> PSD, Sketch, AJ </div>
                                        </div>
                                        <!--End::Item -->
                                        <!--Begin::Item -->
                                        <div class="k-timeline__item k-timeline__item--warning">
                                            <div class="k-timeline__item-section">
                                                <div class="k-timeline__item-section-border">
                                                    <div class="k-timeline__item-section-icon"> <i class="flaticon-pie-chart-1 k-font-warning"></i> </div>
                                                </div>
                                                <span class="k-timeline__item-datetime">Aug 13,2018</span>
                                            </div>
                                            <a href="" class="k-timeline__item-text">
                                                Meeting with Ken Digital Corp ot Unit14, 3 Edigor Buildings, George Street, Loondon
                                                <br>
                                                England, BA12FJ
                                            </a>
                                            <div class="k-timeline__item-info"> Meeting, Customer </div>
                                        </div>
                                        <!--End::Item -->
                                        <!--Begin::Item -->
                                        <div class="k-timeline__item k-timeline__item--info">
                                            <div class="k-timeline__item-section">
                                                <div class="k-timeline__item-section-border">
                                                    <div class="k-timeline__item-section-icon"> <i class="flaticon-notepad k-font-info"></i> </div>
                                                </div>
                                                <span class="k-timeline__item-datetime">May 09, 2018</span>
                                            </div>
                                            <a href="" class="k-timeline__item-text"> KeenThemes created new layout whith tens of new options for Keen Admin panel </a>
                                            <div class="k-timeline__item-info"> HTML,CSS,VueJS </div>
                                        </div>
                                        <!--End::Item -->
                                        <!--Begin::Item -->
                                        <div class="k-timeline__item k-timeline__item--accent">
                                            <div class="k-timeline__item-section">
                                                <div class="k-timeline__item-section-border">
                                                    <div class="k-timeline__item-section-icon" > <i class="flaticon-bell k-font-accent"></i> </div>
                                                </div>
                                                <span class="k-timeline__item-datetime">01:20 AM</span>
                                            </div>
                                            <a href="" class="k-timeline__item-text"> New secyrity alert by Firewall & order to take aktion on User Preferences </a>
                                            <div class="k-timeline__item-info"> Security, Fieewall </div>
                                        </div>
                                        <!--End::Item -->
                                    </div>
                                    <!--End::Timeline 1 -->
                                </div>
                            </div>
                            <div class="tab-pane fade" id="k_portlet_tabs_1_1_2_content" role="tabpanel">
                                <div class="k-scroll" data-scroll="true" style="height: 420px;" data-mobile-height="350">
                                    <!--Begin::Timeline -->
                                    <div class="k-timeline">
                                        <!--Begin::Item -->
                                        <div class="k-timeline__item k-timeline__item--info">
                                            <div class="k-timeline__item-section">
                                                <div class="k-timeline__item-section-border">
                                                    <div class="k-timeline__item-section-icon"> <i class="flaticon-psd k-font-info"></i> </div>
                                                </div>
                                                <span class="k-timeline__item-datetime">01:20 AM</span>
                                            </div>
                                            <a href="" class="k-timeline__item-text">
                                                New secyrity alert by Firewall &amp; order to take
                                                <br>
                                                aktion on User Preferences
                                            </a>
                                            <div class="k-timeline__item-info"> Security, Fieewall </div>
                                        </div>
                                        <!--End::Item -->
                                        <!--Begin::Item -->
                                        <div class="k-timeline__item k-timeline__item--success">
                                            <div class="k-timeline__item-section">
                                                <div class="k-timeline__item-section-border">
                                                    <div class="k-timeline__item-section-icon"> <i class="flaticon-pie-chart-1 k-font-success"></i> </div>
                                                </div>
                                                <span class="k-timeline__item-datetime">02:30 PM</span>
                                            </div>
                                            <a href="" class="k-timeline__item-text">
                                                KeenThemes created new layout whith tens of
                                                <br>
                                                new options for Keen Admin panel
                                            </a>
                                            <div class="k-timeline__item-info"> HTML,CSS,VueJS </div>
                                        </div>
                                        <!--End::Item -->
                                        <!--Begin::Item -->
                                        <div class="k-timeline__item k-timeline__item--accent">
                                            <div class="k-timeline__item-section">
                                                <div class="k-timeline__item-section-border">
                                                    <div class="k-timeline__item-section-icon"> <i class="flaticon-shopping-basket k-font-accent"></i> </div>
                                                </div>
                                                <span class="k-timeline__item-datetime">01:20 AM</span>
                                            </div>
                                            <a href="" class="k-timeline__item-text">
                                                New secyrity alert by Firewall &amp; order to take
                                                <br>
                                                aktion on User references
                                            </a>
                                            <div class="k-timeline__item-info"> Security, Fieewall </div>
                                        </div>
                                        <!--End::Item -->
                                        <!--Begin::Item -->
                                        <div class="k-timeline__item k-timeline__item--warning">
                                            <div class="k-timeline__item-section">
                                                <div class="k-timeline__item-section-border">
                                                    <div class="k-timeline__item-section-icon"> <i class="flaticon-rotate k-font-warning"></i> </div>
                                                </div>
                                                <span class="k-timeline__item-datetime">May 09, 2018</span>
                                            </div>
                                            <a href="" class="k-timeline__item-text">
                                                KeenThemes created new layout whith tens of
                                                <br>
                                                new options for Keen Admin panel
                                            </a>
                                            <div class="k-timeline__item-info"> HTML,CSS,VueJS </div>
                                        </div>
                                        <!--End::Item -->
                                        <!--Begin::Item -->
                                        <div class="k-timeline__item k-timeline__item--brand">
                                            <div class="k-timeline__item-section">
                                                <div class="k-timeline__item-section-border">
                                                    <div class="k-timeline__item-section-icon"> <i class="flaticon-paper-plane-1 k-font-brand"></i> </div>
                                                </div>
                                                <span class="k-timeline__item-datetime">Aug 13,2018</span>
                                            </div>
                                            <a href="" class="k-timeline__item-text">
                                                Meeting with Ken Digital Corp ot Unit14, 3
                                                <br>
                                                Edigor Buildings, George Street, Loondon
                                                <br>
                                                England, BA12FJ
                                            </a>
                                            <div class="k-timeline__item-info"> Meeting, Customer </div>
                                        </div>
                                        <!--End::Item -->
                                        <!--Begin::Item -->
                                        <div class="k-timeline__item k-timeline__item--danger">
                                            <div class="k-timeline__item-section">
                                                <div class="k-timeline__item-section-border">
                                                    <div class="k-timeline__item-section-icon"> <i class="flaticon-pie-chart-1 k-font-danger"></i> </div>
                                                </div>
                                                <span class="k-timeline__item-datetime">Yestardey</span>
                                            </div>
                                            <a href="" class="k-timeline__item-text">
                                                FlyMore design mock-ups been uploadet by
                                                <br>
                                                designers Bob, Naomi, Richard
                                            </a>
                                            <div class="k-timeline__item-info"> PSD, Sketch, AJ </div>
                                        </div>
                                        <!--End::Item -->
                                        <!--Begin::Item -->
                                        <div class="k-timeline__item k-timeline__item--warning">
                                            <div class="k-timeline__item-section">
                                                <div class="k-timeline__item-section-border">
                                                    <div class="k-timeline__item-section-icon"> <i class="flaticon-security k-font-warning"></i> </div>
                                                </div>
                                                <span class="k-timeline__item-datetime">Yestardey</span>
                                            </div>
                                            <a href="" class="k-timeline__item-text">
                                                FlyMore design mock-ups been uploadet by
                                                <br>
                                                designers Bob, Naomi, Richard
                                            </a>
                                            <div class="k-timeline__item-info"> HTML,CSS,VueJS </div>
                                        </div>
                                        <!--End::Item -->
                                        <!--Begin::Item -->
                                        <div class="k-timeline__item k-timeline__item--brand">
                                            <div class="k-timeline__item-section">
                                                <div class="k-timeline__item-section-border">
                                                    <div class="k-timeline__item-section-icon"> <i class="flaticon-price-tag k-font-brand"></i> </div>
                                                </div>
                                                <span class="k-timeline__item-datetime">02:30 PM</span>
                                            </div>
                                            <a href="" class="k-timeline__item-text">
                                                KeenThemes created new layout whith tens of
                                                <br>
                                                new options for Keen Admin panel
                                            </a>
                                            <div class="k-timeline__item-info"> HTML,CSS,VueJS </div>
                                        </div>
                                        <!--End::Item -->
                                    </div>
                                    <!--End::Timeline 1 -->
                                </div>
                            </div>
                            <div class="tab-pane fade" id="k_portlet_tabs_1_1_3_content" role="tabpanel">
                                <div class="k-scroll" data-scroll="true" style="height: 420px;" data-mobile-height="350">
                                    <!--Begin::Timeline -->
                                    <div class="k-timeline">
                                        <!--Begin::Item -->
                                        <div class="k-timeline__item k-timeline__item--brand">
                                            <div class="k-timeline__item-section">
                                                <div class="k-timeline__item-section-border">
                                                    <div class="k-timeline__item-section-icon"> <i class="flaticon-medal k-font-brand"></i> </div>
                                                </div>
                                                <span class="k-timeline__item-datetime">Aug 13,2018</span>
                                            </div>
                                            <a href="" class="k-timeline__item-text">
                                                Meeting with Ken Digital Corp ot Unit14, 3
                                                <br>
                                                Edigor Buildings, George Street, Loondon
                                                <br>
                                                England, BA12FJ
                                            </a>
                                            <div class="k-timeline__item-info"> Meeting, Customer </div>
                                        </div>
                                        <!--End::Item -->
                                        <!--Begin::Item -->
                                        <div class="k-timeline__item k-timeline__item--danger">
                                            <div class="k-timeline__item-section">
                                                <div class="k-timeline__item-section-border">
                                                    <div class="k-timeline__item-section-icon"> <i class="flaticon-safe-shield-protection k-font-danger"></i> </div>
                                                </div>
                                                <span class="k-timeline__item-datetime">Yestardey</span>
                                            </div>
                                            <a href="" class="k-timeline__item-text">
                                                FlyMore design mock-ups been uploadet by
                                                <br>
                                                designers Bob, Naomi, Richard
                                            </a>
                                            <div class="k-timeline__item-info"> PSD, Sketch, AJ </div>
                                        </div>
                                        <!--End::Item -->
                                        <!--Begin::Item -->
                                        <div class="k-timeline__item k-timeline__item--info">
                                            <div class="k-timeline__item-section">
                                                <div class="k-timeline__item-section-border">
                                                    <div class="k-timeline__item-section-icon"> <i class="flaticon2-box k-font-info"></i> </div>
                                                </div>
                                                <span class="k-timeline__item-datetime">01:20 AM</span>
                                            </div>
                                            <a href="" class="k-timeline__item-text">
                                                New secyrity alert by Firewall &amp; order to take
                                                <br>
                                                aktion on User Preferences
                                            </a>
                                            <div class="k-timeline__item-info"> Security, Fieewall </div>
                                        </div>
                                        <!--End::Item -->
                                        <!--Begin::Item -->
                                        <div class="k-timeline__item k-timeline__item--success">
                                            <div class="k-timeline__item-section">
                                                <div class="k-timeline__item-section-border">
                                                    <div class="k-timeline__item-section-icon"> <i class="flaticon-pie-chart-1 k-font-success"></i> </div>
                                                </div>
                                                <span class="k-timeline__item-datetime">02:30 PM</span>
                                            </div>
                                            <a href="" class="k-timeline__item-text">
                                                KeenThemes created new layout whith tens of
                                                <br>
                                                new options for Keen Admin panel
                                            </a>
                                            <div class="k-timeline__item-info"> HTML,CSS,VueJS </div>
                                        </div>
                                        <!--End::Item -->
                                        <!--Begin::Item -->
                                        <div class="k-timeline__item k-timeline__item--accent">
                                            <div class="k-timeline__item-section">
                                                <div class="k-timeline__item-section-border">
                                                    <div class="k-timeline__item-section-icon"> <i class="flaticon-envelope k-font-accent"></i> </div>
                                                </div>
                                                <span class="k-timeline__item-datetime">01:20 AM</span>
                                            </div>
                                            <a href="" class="k-timeline__item-text">
                                                New secyrity alert by Firewall &amp; order to take
                                                <br>
                                                aktion on User references
                                            </a>
                                            <div class="k-timeline__item-info"> Security, Fieewall </div>
                                        </div>
                                        <!--End::Item -->
                                        <!--Begin::Item -->
                                        <div class="k-timeline__item k-timeline__item--warning">
                                            <div class="k-timeline__item-section">
                                                <div class="k-timeline__item-section-border">
                                                    <div class="k-timeline__item-section-icon"> <i class="flaticon-rotate k-font-warning"></i> </div>
                                                </div>
                                                <span class="k-timeline__item-datetime">May 09, 2018</span>
                                            </div>
                                            <a href="" class="k-timeline__item-text">
                                                KeenThemes created new layout whith tens of
                                                <br>
                                                new options for Keen Admin panel
                                            </a>
                                            <div class="k-timeline__item-info"> HTML,CSS,VueJS </div>
                                        </div>
                                        <!--End::Item -->
                                        <!--Begin::Item -->
                                        <div class="k-timeline__item k-timeline__item--info">
                                            <div class="k-timeline__item-section">
                                                <div class="k-timeline__item-section-border">
                                                    <div class="k-timeline__item-section-icon"> <i class="flaticon-feed k-font-info"></i> </div>
                                                </div>
                                                <span class="k-timeline__item-datetime">Yestardey</span>
                                            </div>
                                            <a href="" class="k-timeline__item-text">
                                                FlyMore design mock-ups been uploadet by
                                                <br>
                                                designers Bob, Naomi, Richard
                                            </a>
                                            <div class="k-timeline__item-info"> HTML,CSS,VueJS </div>
                                        </div>
                                        <!--End::Item -->
                                        <!--Begin::Item -->
                                        <div class="k-timeline__item k-timeline__item--brand">
                                            <div class="k-timeline__item-section">
                                                <div class="k-timeline__item-section-border">
                                                    <div class="k-timeline__item-section-icon"> <i class="flaticon-download-1 k-font-brand"></i> </div>
                                                </div>
                                                <span class="k-timeline__item-datetime">02:30 PM</span>
                                            </div>
                                            <a href="" class="k-timeline__item-text">
                                                KeenThemes created new layout whith tens of
                                                <br>
                                                new options for Keen Admin panel
                                            </a>
                                            <div class="k-timeline__item-info"> HTML,CSS,VueJS </div>
                                        </div>
                                        <!--End::Item -->
                                    </div>
                                    <!--End::Timeline 1 -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
                <!--begin::Portlet-->
                <div class="k-portlet k-portlet--height-fluid">
                    <div class="k-portlet__head">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">
                                Latest Uploads
                            </h3>
                        </div>
                        <div class="k-portlet__head-toolbar">
                            <div class="k-portlet__head-actions"> <a href="#" class="btn btn-default btn-upper btn-sm btn-bold">All FILES</a> </div>
                        </div>
                    </div>
                    <div class="k-portlet__body k-portlet__body--fit k-portlet__body--fluid">
                        <div class="k-widget-7">
                            <div class="k-widget-7__items">
                                <div class="k-widget-7__item">
                                    <div class="k-widget-7__item-pic">
                                        <img src="{{ config("app.keen_assets") }}/media/files/doc.svg" alt="" />
                                    </div>
                                    <div class="k-widget-7__item-info">
                                        <a href="#" class="k-widget-7__item-title"> Keeg Design Reqs </a>
                                        <div class="k-widget-7__item-desc"> 95 MB </div>
                                    </div>
                                    <div class="k-widget-7__item-toolbar">
                                        <div class="dropdown dropdown-inline">
                                            <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="k-nav">
                                                    <li class="k-nav__section k-nav__section--first"> <span class="k-nav__section-text">EXPORT TOOLS</span> </li>
                                                    <li class="k-nav__item">
                                                        <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-eye"></i> <span class="k-nav__link-text">View</span> </a>
                                                    </li>
                                                    <li class="k-nav__item">
                                                        <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-comment-o"></i> <span class="k-nav__link-text">Coments</span> </a>
                                                    </li>
                                                    <li class="k-nav__item">
                                                        <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-copy"></i> <span class="k-nav__link-text">Copy</span> </a>
                                                    </li>
                                                    <li class="k-nav__item">
                                                        <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-file-excel-o"></i> <span class="k-nav__link-text">Excel</span> </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="k-widget-7__item">
                                    <div class="k-widget-7__item-pic">
                                        <img src="{{ config("app.keen_assets") }}/media/files/pdf.svg" alt="" />
                                    </div>
                                    <div class="k-widget-7__item-info">
                                        <a href="#" class="k-widget-7__item-title"> S.E.R Agreement </a>
                                        <div class="k-widget-7__item-desc"> 805 MB </div>
                                    </div>
                                    <div class="k-widget-7__item-toolbar">
                                        <div class="dropdown dropdown-inline">
                                            <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="k-nav">
                                                    <li class="k-nav__section k-nav__section--first"> <span class="k-nav__section-text">EXPORT TOOLS</span> </li>
                                                    <li class="k-nav__item">
                                                        <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-eye"></i> <span class="k-nav__link-text">View</span> </a>
                                                    </li>
                                                    <li class="k-nav__item">
                                                        <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-comment-o"></i> <span class="k-nav__link-text">Coments</span> </a>
                                                    </li>
                                                    <li class="k-nav__item">
                                                        <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-copy"></i> <span class="k-nav__link-text">Copy</span> </a>
                                                    </li>
                                                    <li class="k-nav__item">
                                                        <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-file-excel-o"></i> <span class="k-nav__link-text">Excel</span> </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="k-widget-7__item">
                                    <div class="k-widget-7__item-pic">
                                        <img src="{{ config("app.keen_assets") }}/media/files/jpg.svg" alt="" />
                                    </div>
                                    <div class="k-widget-7__item-info">
                                        <a href="#" class="k-widget-7__item-title"> FlyMore Screenshot </a>
                                        <div class="k-widget-7__item-desc"> 4 MB </div>
                                    </div>
                                    <div class="k-widget-7__item-toolbar">
                                        <div class="dropdown dropdown-inline">
                                            <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="k-nav">
                                                    <li class="k-nav__section k-nav__section--first"> <span class="k-nav__section-text">EXPORT TOOLS</span> </li>
                                                    <li class="k-nav__item">
                                                        <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-eye"></i> <span class="k-nav__link-text">View</span> </a>
                                                    </li>
                                                    <li class="k-nav__item">
                                                        <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-comment-o"></i> <span class="k-nav__link-text">Coments</span> </a>
                                                    </li>
                                                    <li class="k-nav__item">
                                                        <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-copy"></i> <span class="k-nav__link-text">Copy</span> </a>
                                                    </li>
                                                    <li class="k-nav__item">
                                                        <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-file-excel-o"></i> <span class="k-nav__link-text">Excel</span> </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="k-widget-7__item">
                                    <div class="k-widget-7__item-pic">
                                        <img src="{{ config("app.keen_assets") }}/media/files/zip.svg" alt="" />
                                    </div>
                                    <div class="k-widget-7__item-info">
                                        <a href="#" class="k-widget-7__item-title"> ST.11 Dacuments </a>
                                        <div class="k-widget-7__item-desc"> Unknown </div>
                                    </div>
                                    <div class="k-widget-7__item-toolbar">
                                        <div class="dropdown dropdown-inline">
                                            <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="k-nav">
                                                    <li class="k-nav__section k-nav__section--first"> <span class="k-nav__section-text">EXPORT TOOLS</span> </li>
                                                    <li class="k-nav__item">
                                                        <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-eye"></i> <span class="k-nav__link-text">View</span> </a>
                                                    </li>
                                                    <li class="k-nav__item">
                                                        <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-comment-o"></i> <span class="k-nav__link-text">Coments</span> </a>
                                                    </li>
                                                    <li class="k-nav__item">
                                                        <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-copy"></i> <span class="k-nav__link-text">Copy</span> </a>
                                                    </li>
                                                    <li class="k-nav__item">
                                                        <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-file-excel-o"></i> <span class="k-nav__link-text">Excel</span> </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="k-widget-7__item">
                                    <div class="k-widget-7__item-pic">
                                        <img src="{{ config("app.keen_assets") }}/media/files/xml.svg" alt="" />
                                    </div>
                                    <div class="k-widget-7__item-info">
                                        <a href="#" class="k-widget-7__item-title"> XML AOL Data Fetchin </a>
                                        <div class="k-widget-7__item-desc"> 4 MB </div>
                                    </div>
                                    <div class="k-widget-7__item-toolbar">
                                        <div class="dropdown dropdown-inline">
                                            <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flaticon-more-1"></i> </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="k-nav">
                                                    <li class="k-nav__section k-nav__section--first"> <span class="k-nav__section-text">EXPORT TOOLS</span> </li>
                                                    <li class="k-nav__item">
                                                        <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-eye"></i> <span class="k-nav__link-text">View</span> </a>
                                                    </li>
                                                    <li class="k-nav__item">
                                                        <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-comment-o"></i> <span class="k-nav__link-text">Coments</span> </a>
                                                    </li>
                                                    <li class="k-nav__item">
                                                        <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-copy"></i> <span class="k-nav__link-text">Copy</span> </a>
                                                    </li>
                                                    <li class="k-nav__item">
                                                        <a href="#" class="k-nav__link"> <i class="k-nav__link-icon la la-file-excel-o"></i> <span class="k-nav__link-text">Excel</span> </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="k-widget-7__foot">
                                <img src="{{ config("app.keen_assets") }}/media/misc/clouds.png" alt="" />
                                <div class="k-widget-7__upload">
                                    <a href="#"><i class="flaticon-upload"></i></a>
                                    <span>Drag files here</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
            <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
                <!--begin::Portlet-->
                <div class="k-portlet k-portlet--tabs k-portlet--height-fluid">
                    <div class="k-portlet__head">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">
                                Work Progress
                            </h3>
                        </div>
                        <div class="k-portlet__head-toolbar">
                            <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-brand nav-tabs-bold" role="tablist">
                                <li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#k_portlet_tabs_1111_1_content" role="tab" aria-selected="false"> Emails </a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#k_portlet_tabs_1111_2_content" role="tab" aria-selected="false"> Tickets </a> </li>
                            </ul>
                        </div>
                    </div>
                    <div class="k-portlet__body">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="k_portlet_tabs_1111_1_content" role="tabpanel">
                                <div class="k-widget-11">
                                    <div class="k-widget-11__item">
                                        <div class="k-widget-11__wrapper">
                                            <div class="k-widget-11__title"> Pendings Tasks </div>
                                            <div class="k-widget-11__value"> 78% </div>
                                        </div>
                                        <div class="k-widget-11__progress">
                                            <div class="progress">
                                                <!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="k-widget-11__item">
                                        <div class="k-widget-11__wrapper">
                                            <div class="k-widget-11__title"> Completed Tasks </div>
                                            <div class="k-widget-11__value"> 320&nbsp;/&nbsp;<span class="k-opacity-5">780</span> </div>
                                        </div>
                                        <div class="k-widget-11__progress">
                                            <div class="progress">
                                                <!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="k-widget-11__item">
                                        <div class="k-widget-11__wrapper">
                                            <div class="k-widget-11__title"> Tasks In Progress </div>
                                            <div class="k-widget-11__value"> 45% </div>
                                        </div>
                                        <div class="k-widget-11__progress">
                                            <div class="progress">
                                                <!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="k-widget-11__item">
                                        <div class="k-widget-11__wrapper">
                                            <div class="k-widget-11__title"> All Tasks </div>
                                            <div class="k-widget-11__value"> 1200 </div>
                                        </div>
                                        <div class="k-widget-11__progress">
                                            <div class="progress">
                                                <!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="k-widget-11__item">
                                        <div class="k-widget-11__wrapper">
                                            <div class="k-widget-11__title"> Reports </div>
                                            <div class="k-widget-11__value"> 40 </div>
                                        </div>
                                        <div class="k-widget-11__progress">
                                            <div class="progress">
                                                <!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="k-margin-t-30 k-align-center"> <a href="#" class="btn btn-brand btn-upper btn-bold k-align-center">Full Report</a> </div>
                            </div>
                            <div class="tab-pane fade" id="k_portlet_tabs_1111_2_content" role="tabpanel">
                                <div class="k-widget-11">
                                    <div class="k-widget-11__item">
                                        <div class="k-widget-11__wrapper">
                                            <div class="k-widget-11__title"> Pendings Tasks </div>
                                            <div class="k-widget-11__value"> 78% </div>
                                        </div>
                                        <div class="k-widget-11__progress">
                                            <div class="progress">
                                                <!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
                                                <div class="progress-bar bg-info" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="k-widget-11__item">
                                        <div class="k-widget-11__wrapper">
                                            <div class="k-widget-11__title"> Completed Tasks </div>
                                            <div class="k-widget-11__value"> 320&nbsp;/&nbsp;<span class="k-opacity-5">780</span> </div>
                                        </div>
                                        <div class="k-widget-11__progress">
                                            <div class="progress">
                                                <!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 58%" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="k-widget-11__item">
                                        <div class="k-widget-11__wrapper">
                                            <div class="k-widget-11__title"> Tasks In Progress </div>
                                            <div class="k-widget-11__value"> 45% </div>
                                        </div>
                                        <div class="k-widget-11__progress">
                                            <div class="progress">
                                                <!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="k-widget-11__item">
                                        <div class="k-widget-11__wrapper">
                                            <div class="k-widget-11__title"> All Tasks </div>
                                            <div class="k-widget-11__value"> 1200 </div>
                                        </div>
                                        <div class="k-widget-11__progress">
                                            <div class="progress">
                                                <!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="k-widget-11__item">
                                        <div class="k-widget-11__wrapper">
                                            <div class="k-widget-11__title"> Reports </div>
                                            <div class="k-widget-11__value"> 40 </div>
                                        </div>
                                        <div class="k-widget-11__progress">
                                            <div class="progress">
                                                <!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="k-margin-t-30 k-align-center"> <a href="#" class="btn btn-brand btn-upper btn-bold k-align-center">Full Report</a> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
            <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
                <!--begin::Portlet-->
                <div class="k-portlet k-portlet--height-fluid">
                    <div class="k-portlet__head">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">
                                Daily Salles
                            </h3>
                        </div>
                        <div class="k-portlet__head-toolbar">
                            <div class="k-portlet__head-actions"> <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">CSV</a> </div>
                        </div>
                    </div>
                    <div class="k-portlet__body">
                        <div class="k-widget-4">
                            <div class="k-widget-4__item">
                                <div class="k-widget-4__item-content">
                                    <div class="k-widget-4__item-section">
                                        <div class="k-widget-4__item-pic">
                                            <img class="" src="{{ config("app.keen_assets") }}/media/users/100_3.jpg" alt="" />
                                        </div>
                                        <div class="k-widget-4__item-info">
                                            <a href="#" class="k-widget-4__item-username">Chris Bent</a>
                                            <div class="k-widget-4__item-desc">SUV Themes Carp</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="k-widget-4__item-content">
                                    <div class="k-widget-4__item-price"> <span class="k-widget-4__item-badge">$</span> <span class="k-widget-4__item-number">830</span> </div>
                                </div>
                            </div>
                            <div class="k-widget-4__item">
                                <div class="k-widget-4__item-content">
                                    <div class="k-widget-4__item-section">
                                        <div class="k-widget-4__item-pic">
                                            <img class="" src="{{ config("app.keen_assets") }}/media/users/100_4.jpg" alt="" />
                                        </div>
                                        <div class="k-widget-4__item-info">
                                            <a href="#" class="k-widget-4__item-username">Ashley Stock</a>
                                            <div class="k-widget-4__item-desc">Merscedes Benz AMGww</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="k-widget-4__item-content">
                                    <div class="k-widget-4__item-price"> <span class="k-widget-4__item-badge">$</span> <span class="k-widget-4__item-number">675</span> </div>
                                </div>
                            </div>
                            <div class="k-widget-4__item">
                                <div class="k-widget-4__item-content">
                                    <div class="k-widget-4__item-section">
                                        <div class="k-widget-4__item-pic">
                                            <img class="" src="{{ config("app.keen_assets") }}/media/users/100_5.jpg" alt="" />
                                        </div>
                                        <div class="k-widget-4__item-info">
                                            <a href="#" class="k-widget-4__item-username">Jimmy Yesuku</a>
                                            <div class="k-widget-4__item-desc">All Nippon United Airlines</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="k-widget-4__item-content">
                                    <div class="k-widget-4__item-price"> <span class="k-widget-4__item-badge">$</span> <span class="k-widget-4__item-number">194</span> </div>
                                </div>
                            </div>
                            <div class="k-widget-4__item">
                                <div class="k-widget-4__item-content">
                                    <div class="k-widget-4__item-section">
                                        <div class="k-widget-4__item-pic">
                                            <img class="" src="{{ config("app.keen_assets") }}/media/users/100_2.jpg" alt="" />
                                        </div>
                                        <div class="k-widget-4__item-info">
                                            <a href="#" class="k-widget-4__item-username">Amanda West</a>
                                            <div class="k-widget-4__item-desc">Comboy Westem Limited</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="k-widget-4__item-content">
                                    <div class="k-widget-4__item-price"> <span class="k-widget-4__item-badge">$</span> <span class="k-widget-4__item-number">65</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
            <div class="col-lg-12 col-xl-8 order-lg-1 order-xl-1"></div>
        </div>
        <!--end::Row-->
    </div>
    <!-- end:: Content -->
    @endsection