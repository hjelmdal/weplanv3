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
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.js" xmlns="http://www.w3.org/1999/html"></script>
    <script src="{{ route("index") }}/vuejs/activities/index.js?v={{ Helpers::gitVersion()->getVersion() }}"></script>

@endsection
@section("styles")
    <style>




    </style>
@endsection
@section("meta")
    <meta name="start-date" content="{{ $date }}">
@endsection
@section("content")

    <div class="row">
        <div class="col-12">
            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <div class="kt-section__content kt-section__content--border">
                        <div class="row">
                    <div class="col-3">
                    <a href="{{ route("activities.create") }}" data-target="#modal1" data-toggle="modal" class="btn btn-success kt-btn--icon">
                        <span class="d-inline d-sm-none">&nbsp;&nbsp;</span><span><i class="fa fa-plus"></i><span class="d-none d-sm-inline">Tilføj</span>
                        </span>
                    </a>
                    </div>
                        <div class="col-5 kt-align-center">
                            <h3><span class="d-none d-sm-inline">Aktiviteter i </span>Uge @{{start_date | formatDate("ww")}}</h3>
                        </div>
                        <div class="col-4">
                        <div class="float-right">
                            <button id="btnPrev" type="button" class="btn btn-primary" v-on:click="activitiesLoad('prev')">&nbsp;<i class="fa fa-arrow-left"></i><span class="d-none d-sm-inline">Uge @{{prev_week | formatDate("ww")}}</span></button>
                            <button id="btnNext" type="button" class="btn btn-primary" v-on:click="activitiesLoad('next')">&nbsp;<span class="d-none d-sm-inline">Uge @{{next_week | formatDate("ww")}} </span><i class="fa fa-arrow-right"></i></button>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- begin: Filters -->
    <div class="row">
        <div class="col-12">
            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <div class="kt-section__content kt-section__content--border">
                        <div class="row">
                            <div class="col-12 kt-padding-0 text-center">
                                <template v-for="type in types">
                                    <label class="kt-checkbox kt-checkbox--solid kt-padding-r-5" style="padding-left: 19px;" v-bind:class="{'kt-checkbox--success':(type.id == 1), 'kt-checkbox--warning':(type.id == 5), 'kt-checkbox--danger':(type.id == 2), 'kt-checkbox--primary':(type.id == 3), 'kt-checkbox--warning':(type.id == 4)}">
                                        <input v-model="filters[type.id]" type="checkbox" @change="activitiesLoad('reload')"> @{{ type.name }}
                                        <span></span>
                                    </label>

                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end: Filters -->

    <template v-if="days.length == 0">
        <div class="col-12 card1  kt-margin-b-20">
            <div class="flex-left"></div>
            <div class="flex-center">
                <div class="div-row">Der blev ikke fundet nogle aktiviteter i denne uge!</div>
            </div>
        </div>
    </template>

    <template v-for="day in days">
        <div class="col-12 card1  kt-margin-b-20">
        <div class="flex-left">
            <div class="div-date">
                <div class="p8-date">
                    <div class="p8-date-mon">@{{day.date | formatDate("MMM")}}</div>
                    <div class="p8-date-num">@{{day.date | formatDate("DD")}}</div>
                    <div class="p8-date-day">@{{day.date | formatDate("ddd")}}</div>

                </div>
            </div>
        </div>
        <div class="flex-center">
            <template v-for="activity in day.events">
            <div class="div-row">
                <div class="row-column" v-bind:class="{'bef-success':(activity.type_id == 1), 'bef-warning':(activity.type_id == 5), 'bef-danger':(activity.type_id == 2), 'bef-info':(activity.type_id == 3), 'bef-dark':(activity.type_id == 4)}">
                    <a data-toggle="modal" data-target="#modal1" :href="'{{ route("activities.index") }}/'+activity.id+'/edit'" class="div-text">@{{ activity.title }}</a>
                    <div class="div-time"><span data-toggle="kt-tooltip" :title="activity.type.name" v-tooltip:top="''" class="badge kt-font-white btn-xs" v-bind:class="{'badge-success':(activity.type_id == 1), 'badge-danger':(activity.type_id == 2), 'badge-primary':(activity.type_id == 3), 'badge-warning':(activity.type_id == 4)}">@{{ activity.type.name.substr(0,1) }}</span>@{{ activity.start | formatTime("HH:mm") }} - @{{ activity.end | formatTime("HH:mm") }}</div>
                </div>
                <div class="div-right"><a data-toggle="modal" data-target="#modal1" :href="'{{ route("activities.index") }}/'+activity.id+'/edit'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">
                        <i class="la la-edit"></i>
                    </a>
                    <a href="#" v-on:click="loadOffCanvas(true)" class="btn btn-sm btn-clean btn-icon btn-icon-md kt_offcanvas_01" title="Delete">
                        <i class="la la-trash"></i>
                    </a></div>
            </div>


            </template>
        </div>
            <div class="flex-right">
                <div class="p8-vertical-container">
                    <div class="p8-vertical-center">
                        <a :href="'{{ route("activities.plan") }}/'+day.date" class="btn btn-success btn-icon"><i class="fa fa-calendar-alt"></i></a>
                    </div>
                </div>
            </div>



        </div>

        <div class="clearfix"></div>
    </template>




@endsection
@section("modal")
    @include("layouts.theme.blocks.modal1")
@endsection

