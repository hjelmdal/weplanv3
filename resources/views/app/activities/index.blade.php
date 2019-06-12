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
    <!-- begin: header tools -->
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
                                <h3><span id="headline" class="d-none d-sm-inline">Aktiviteter i </span>Uge @{{start_date | formatDate("ww")}}</h3>
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
    <!-- end: header tools -->
    <!-- begin: Filters -->
    <div class="row">
        <div class="col-12">
            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <div class="kt-section__content kt-section__content--border">
                        <div class="row">
                            <div class="col-12">
                                <template v-for="type in types">
                                    <span class="badge" v-bind:class="{'badge-success':(type.id == 1), 'badge-warning':(type.id == 5), 'badge-danger':(type.id == 2), 'badge-primary':(type.id == 3), 'badge-light':(type.id == 4)}">&nbsp;</span> @{{ type.name }}
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end: Filters -->
    <!-- begin: Activity table -->
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
            <div class="flex-center" style="width: calc(100% - 90px);">
                <template v-for="activity in day.events">
                    <div v-bind:id="'elem-' + activity.id" class="div-row" @mouseover="hover = activity.id" v-bind:class="{'activities-confirmed-bg overlay1-container':(activity.my_status == 2), 'activities-declined-bg overlay1-container':(activity.my_status == 0), 'activities-subscribed-bg overlay1-container':(activity.my_status == 1), 'active':(hover == activity.id && activity.my_activity)}">
                        <div v-if="activity.my_activity" class="overlay1">
                            <button v-on:click="confirmActivity($event,activity)" type="button" class="btn btn-success btn-sm kt-margin-r-10 kt-margin-l-10"><i class="fa fa-user-check"></i> Tilmeld</button>
                            <button  v-on:click="showDeclineModal($event,activity)" data-toggle="modal" data-target="#modal1" type="button" class="btn btn-danger btn-sm kt-margin-r-10 kt-margin-l-10"><i class="fa fa-user-slash"></i> Afbud</button>
                            <span v-if="activity.my_status == 0 || activity.my_status == 2" title="RSVP" class="btn btn-sm btn-outline-metal btn-icon btn-icon-md float-right"><i class="la la-chevron-right"></i></span>
                        </div>
                        <div class="row-column" v-bind:class="{'bef-success':(activity.type_id == 1), 'bef-warning':(activity.type_id == 5), 'bef-danger':(activity.type_id == 2), 'bef-brand':(activity.type_id == 3), 'bef-metal':(activity.type_id == 4)}">
                            <span class="div-text" style="font-size: 1.5rem;">@{{ activity.title }}</span>
                            <div class="div-time"><i class="la la-clock-o"></i> @{{ activity.start | formatTime("HH:mm") }} - @{{ activity.end | formatTime("HH:mm") }} <span class="btn btn-outline-metal btn-xs"><i class="la la-users"></i><span class="kt-font-brand">@{{ activity.enrolled }}</span> <span class="kt-font-success">@{{ activity.confirmed }}</span> <span class="kt-font-danger">@{{ activity.declined }}</span></span> </div>
                        </div>
                        <div class="div-right" style="align-self: center; width: 40px; text-align: right;">
                            <span v-if="activity.my_activity === true"  class="btn btn-sm btn-outline-success btn-icon btn-icon-md" title="RSVP">
                                <i class="la la-calendar-o"></i>
                            </span>
                            <span v-else  class="btn btn-sm btn-outline-metal btn-icon btn-icon-md" title="RSVP">
                                <i class="la la-chevron-right"></i>
                            </span>

                        </div>
                    </div>


                </template>
            </div>
        </div>
        <div class="clearfix"></div>
    </template>
    <!-- end: Activity table -->
    <!-- Small Modal -->
    <div id="modal1" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Email address</label>
                        <input v-model="decline_activity" type="text" class="form-control" placeholder="Enter email">
                        <input v-model="decline_start_date" type="text" class="form-control" placeholder="Enter email">
                        <input v-model="decline_activity" type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
                        <span class="form-text text-muted">We'll never share your email with anyone else.</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button v-on:click="hideDeclineModal(decline_activity)" type="button" class="btn btn-outline-brand" data-dismiss="modal">Fortryd</button>
                    <button type="button" class="btn btn-danger">Meld afbud</button>
                </div>
            </div>
        </div>
    </div>


@endsection
@section("modal")

@endsection

