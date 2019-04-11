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
    <script src="{{ route("index") }}/vuejs/index.js?v={{ Helpers::gitVersion()->getVersion() }}"></script>

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
        width: 80px;
        display: inline;
    }
    .p8-right {
        float: left;
        display: inline;
        margin: 1rem;
    }
    .p8-date {
        position: relative;
        margin: 1rem 0rem 1rem 0rem;
        width: 80px;
        display: block;
        border-right: 1px solid #ccc;
    }

    .p8-date .p8-date-num {
        width: 100%;
        font-weight: 600;
        margin: -18px auto -18px auto;
        text-align: center;
        text-transform: uppercase;
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
    .p8-date .p8-date-mon {
        width: 100%;
        text-transform: uppercase;
        font-size: 0.9rem;
        font-weight: 600;
        margin:0 auto;
        text-align: center;
    }


    .truncate-ellipsis {
        display: table;
        table-layout: fixed;
        width: 150px;
        white-space: nowrap;
    }
    .week-title {
        font-size: 3.4rem;
    }
    @media (max-width: 575px) {
        .week-title {
            font-size: 2.5rem;
        }
    }

    @media (min-width: 576px) {
        .truncate-ellipsis {
            width: 350px;
        }
        .week-title {
            font-size:3.4rem;
        }
    }


    @media (min-width: 768px) {
        .truncate-ellipsis {
            width: 540px;
        }
    }


    @media (min-width: 992px) {
        .truncate-ellipsis {
            width: 765px;
        }
    }


    @media (min-width: 1200px) {
        .truncate-ellipsis {
            width: 940px;
        }
    }

    .truncate-ellipsis > * {
        display: table-cell;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .item:nth-child(even)  {
        background-color: #eee;
    }
    </style>
@endsection
@section("content")
<div id="app">
    <button id="btnPrev" :disabled="from == 1" class="btn btn-warning" type="button" v-on:click="activitiesLoad('prev')">Prev</button>
    <button id="btnNext" :disabled="to == total" class="btn btn-success" type="button" v-on:click="activitiesLoad('next')">Next</button>
    <div class="card kt-margin-b-20">
        <div class="col-12 kt-margin-0 kt-padding-0">
            <div class="p8-left">
                <div class="p8-date">
                    <div class="p8-date-mon">&nbsp;</div>
                    <div class="p8-date-num" style="font-size: 2.2rem; line-height: 4.4rem;">@{{start_date | formatDate("MMM")}}</div>
                    <div class="p8-date-day">UGE @{{start_date | formatDate("ww")}}</div>
                </div>
            </div>
            <div class="p8-right">
                <span class="week-title" style="font-weight: 600; text-transform: uppercase">@{{start_date | formatDate("DD")}}. @{{start_date | formatDate("MMM")}} - @{{end_date | formatDate("DD")}}. @{{end_date | formatDate("MMM")}}</span>

            </div>
        </div>
    </div>
    <template v-for="day in days">
        <div class="card kt-margin-b-20">
            <div class="col-12 kt-margin-0 kt-padding-0">
                <div class="p8-left">
                    <div class="p8-date">
                        <div class="p8-date-mon">@{{day.date | formatDate("MMM")}}</div>
                        <div class="p8-date-num">@{{day.date | formatDate("DD")}}</div>
                        <div class="p8-date-day">@{{day.date | formatDate("ddd")}}</div>

                    </div>
                </div>
                <div class="p8-right">
                    <div class="kt-widget-5 kt-margin-0">
                        <template v-for="activity in day.events">
                            <div class="item">
                        <div class="kt-widget-5__item  kt-margin-0" v-bind:class="{'kt-widget-5__item--success':(activity.type_id == 0), 'kt-widget-5__item--warning':(activity.type_id == 1), 'kt-widget-5__item--danger':(activity.type_id == 2), 'kt-widget-5__item--info':(activity.type_id == 3), 'kt-widget-5__item--dark':(activity.type_id == 4)}">
                            <div class="kt-widget-5__item-info">
                                <div class="float-left">
                                <a data-toggle="modal" data-target="#modal1" :href="'{{ route("activities") }}/'+activity.id" class="kt-widget-5__item-title truncate-ellipsis">
                                    <span>@{{ activity.title }}</span>
                                </a>
                                <div class="kt-widget-5__item-datetime">
                                    @{{ activity.start | formatTime("HH:mm") }} - @{{ activity.end | formatTime("HH:mm") }}
                                </div>
                                </div>
                                <div class="float-left">
                                    <a data-toggle="modal" data-target="#modal1" :href="'{{ route("activities") }}/'+activity.id" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">
                                        <i class="la la-edit"></i>
                                    </a>
                                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete">
                                        <i class="la la-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                            </div>
                        </template>

                    </div>
                </div>

            </div>
        </div>
    </template>

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

