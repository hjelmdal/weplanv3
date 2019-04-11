<?php
/**
 * Created by PhpStorm.
 * User: impact
 * Date: 2019-03-30
 * Time: 16:50
 */

?>
@extends("layouts.theme.index")
@section("scripts")
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.js"></script>
    <script src="{{ route("index") }}/vuejs/index.js"></script>

@endsection
@section("styles")
    <style>
    table td {
        vertical-align: middle !important;
    }
    table td:first-letter {
        text-transform: uppercase;
    }

    .p8-left {
        float:left;
        width: 100px;
        display: inline;
    }
    .p8-right {
        float: left;
        display: inline;
        margin: 1rem;
    }
    .p8-date {
        margin: 1rem;
        width: 80px;
        display: block;
        border-right: 1px solid #ccc;
    }

    .p8-date .p8-date-num {
        width: 100%;
        font-weight: 600;
        margin: 0 auto -18px auto;
        text-align: center;

        font-size: 3.4rem;
    }
    .p8-date .p8-date-day {
        width: 100%;
        text-transform: uppercase;
        font-size: 0.9rem;
        font-weight: 600;
        margin:0 auto;
        text-align: center;
        
    }
    </style>
@endsection
@section("content")
<div id="app">
    <div class="card kt-margin-b-20">
        <div>
        <div class="p8-left">
            <div class="p8-date">
                <div class="p8-date-num">@{{start_date | formatDate("DD")}}</div>
                <div class="p8-date-day">UGE @{{start_date | formatDate("ww")}}</div>
            </div>
        </div>
        <div class="p8-right">
            <div class="kt-widget-5 kt-margin-0">
                <div class="kt-widget-5__item  kt-widget-5__item--info kt-margin-0">
                    <div class="kt-widget-5__item-info">
                        <a href="#" class="kt-widget-5__item-title">
                            Management meeting
                        </a>
                        <div class="kt-widget-5__item-datetime">
                            09:30 AM
                        </div>
                    </div>
                </div>
                <div class="kt-widget-5__item kt-widget-5__item--danger kt-margin-0">
                    <div class="kt-widget-5__item-info">
                        <a href="#" class="kt-widget-5__item-title">
                            Replace datatables rows color
                        </a>
                        <div class="kt-widget-5__item-datetime">
                            12:00 AM
                        </div>
                    </div>

                </div>
                <div class="kt-widget-5__item kt-widget-5__item--brand kt-margin-0">
                    <div class="kt-widget-5__item-info">
                        <a href="#" class="kt-widget-5__item-title">
                            Export Navitare booking table
                        </a>
                        <div class="kt-widget-5__item-datetime">
                            01:20 PM
                        </div>
                    </div>

                </div>
                <div class="kt-widget-5__item kt-widget-5__item--success kt-margin-0">
                    <div class="kt-widget-5__item-info">
                        <a href="#" class="kt-widget-5__item-title">
                            NYCS internal discussion
                        </a>
                        <div class="kt-widget-5__item-datetime">
                            03: 00 PM
                        </div>
                    </div>

                </div>
                <div class="kt-widget-5__item kt-widget-5__item--danger kt-margin-0">
                    <div class="kt-widget-5__item-info">
                        <a href="#" class="kt-widget-5__item-title">
                            Project Launch
                        </a>
                        <div class="kt-widget-5__item-datetime">
                            11: 00 AM
                        </div>
                    </div>

                </div>
                <div class="kt-widget-5__item kt-widget-5__item--success kt-margin-0">
                    <div class="kt-widget-5__item-info">
                        <a href="#" class="kt-widget-5__item-title">
                            Server maintenance
                        </a>
                        <div class="kt-widget-5__item-datetime">
                            4: 30 PM
                        </div>
                    </div>

                </div>
            </div></div>

    </div>
    </div>
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">Striped Rows</h3>
            </div>
        </div>
        <div class="kt-portlet__body">

            <!--begin::Section-->
            <div class="kt-section">
                <div class="kt-section__content">


                        <button id="btnPrev" :disabled="from == 1" class="btn btn-warning" type="button" v-on:click="activitiesLoad('prev')">Prev</button>
                        <button id="btnNext" :disabled="to == total" class="btn btn-success" type="button" v-on:click="activitiesLoad('next')">Next</button>

                        <table class="table table-striped m-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Start Date</th>
                                <th>Title</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Dummy</th>
                            </tr>
                            </thead>
                            <tbody v-if="activities.length">
                            <template v-for="day in days">
                                <tr><td colspan="6" style="font-weight: 500">@{{day.date | formatDate("dddd")}} d. @{{day.date | formatDate("D.MMM")}}</td></tr>

                                <tr v-for="activity in day.events">



                                <td v-text="activity.id"></td>
                                <td v-text="activity.start_date"></td>
                                <td v-text="activity.title"></td>
                                <td>@{{activity.start | formatTime("HH:mm")}}</td>
                                <td>@{{activity.end | formatTime("HH:mm")}}</td>
                                <td>
                                    <div class="dropdown" style="float:left;">
                                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">
                                            <i class="la la-cog"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">
                                                <i class="la la-edit"></i>
                                                Edit Details
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="la la-leaf"></i>
                                                Update Status
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="la la-print"></i>
                                                Generate Report
                                            </a>
                                        </div>
                                    </div>
                                    <a data-toggle="modal" data-target="#modal1" :href="'{{ route("activities") }}/'+activity.id" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">
                                        <i class="la la-edit"></i>
                                    </a>
                                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete">
                                        <i class="la la-trash"></i>
                                    </a>
                                </td>
                                </tr>

                            </template>

                            </tbody>
                            <tbody v-else>
                            <tr><td colspan="6" style="text-align: center; font-size: 1.5rem;">Ingen aktiviteter blev fundet i denne uge</td> </tr>
                            </tbody>
                        </table>

                    </div>

            </div>
            <!--end::Section-->
        </div>
        <!--end::Form-->
    </div>
</div>
@endsection
@section("modal")
    @include("layouts.theme.blocks.modal1")
@endsection

