<?php
/**
 * Created by PhpStorm.
 * User: impact
 * Date: 2019-03-30
 * Time: 16:50
 */

$user = Auth::user();
?>
@extends("layouts.theme.index")
@section("scripts")
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.js" xmlns="http://www.w3.org/1999/html"></script>
    <script src="{{ route("index") }}/vuejs/activities/plan.js?v={{ Helpers::gitVersion()->getVersion() }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            KTApp.initTooltips();


        });

    </script>
@endsection
@section("styles")
    <style>
        .weplayer-team {
            font-size: 1.3rem;
            font-weight: 500;
            color: #343d3e;
            color:#000;
        }
        .weplayer-row {
            background-color: #f0f0f0;
            border-bottom:1px solid #fff;
        }

        .weplayer-cell {
            border-bottom: 1px solid #e6e6e6;
        }



    </style>
@endsection
@section("meta")
    <meta name="start-date" content="{{ $date }}">
    <meta name="enroll-url" content="{{ route("api.v1.activities.enroll") }}">
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
                        <button id="reload" class="d-none d-sm-inline btn btn-brand btn-icon kt-margin-l-10" v-on:click="activitiesLoad('reload')"><i class="la la-refresh"></i></button>
                    </div>
                        <div class="col-5 kt-align-center">
                            <h3 style="text-transform: capitalize "><span class="d-none d-sm-inline"></span> @{{today | formatDate("ddd DD. MMM")}}</h3>
                        </div>
                        <div class="col-4">
                        <div class="float-right">

                            <button id="btnPrev" type="button" class="btn btn-primary" v-on:click="activitiesLoad('prev')">&nbsp;<i class="fa fa-arrow-left"></i><span class="d-none d-sm-inline">@{{yesterday | formatDate("DD. MMM")}}</span></button>
                            <button id="btnNext" type="button" class="btn btn-primary" v-on:click="activitiesLoad('next')">&nbsp;<span class="d-none d-sm-inline">@{{tomorrow | formatDate("DD. MMM")}} </span><i class="fa fa-arrow-right"></i></button>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <template v-if="days.length == 0">
        <div class="col-12 card1  kt-margin-b-20">
            <div class="flex-left"></div>
            <div class="flex-center">
                <div class="div-row">Der blev ikke fundet nogle aktiviteter i dag!</div>
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
                    <a data-toggle="modal" data-target="#modal1" :href="'{{ route("activities.index") }}/'+activity.id" class="div-text">@{{ activity.title }}</a>
                    <div class="div-time">@{{ activity.start | formatTime("HH:mm") }} - @{{ activity.end | formatTime("HH:mm") }}</div>
                </div>
                <div class="div-right"><a data-toggle="modal" data-target="#modal1" :href="'{{ route("activities.index") }}/'+activity.id" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">
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

    <div class="col-12 kt-portlet kt-padding-20">
        <div class="row kt-padding-10 kt-margin-b-10" style="background-color: #f7f8fa">
            <div class="col-4"><span class="kt-font-boldest">Spillere</span></div>
        <template v-for="activity in activities">
            <div :class="[activities.length < 5 ? 'col-2' : 'col-1' ]" class="col-md-1 text-center">
                @{{activity.start | formatTime("HH:mm")}} - @{{activity.end | formatTime("HH:mm")}}
            </div>
        </template>
        </div>


        <template v-for="(player,index) in players">
            <!-- begin::team row -->
            <div v-if="index == 0 || players[index-1].team_id != player.team_id" class="row kt-padding-5">
                <div class="col-12 text-truncate">
                    <span v-if="player.team" class="weplayer-team" v-text="player.team.name || 'None'"></span>
                    <span v-else class="weplayer-team">Ikke på en trup</span>
                </div>
            </div>
            <!-- end::team row -->
            <!-- begin::player row -->
            <div class="row weplayer-row" v-bind:style="[index % 2 == 0 ? {'background-color':'#f7f8fa'} : {}]">
                <!-- begin::player name -->
                <div class="col-4 kt-padding-5 text-truncate weplayer-cell">
                    <div class="kt-user-card-v2" v-if="player.user">
                        <div class="kt-user-card-v2__pic">
                            <img v-if="player.user.avatar" :src="player.user.avatar" class="kt-img-rounded kt-marginless" alt="photo">
                        </div>
                        <div class="kt-user-card-v2__details text-truncate">
                            <span class="kt-user-card-v2__name text-truncate" v-text="player.name"></span>
                            <a href="#" class="kt-user-card-v2__email kt-link" v-text="player.dbf_id"></a>
                        </div>
                    </div>

                    <div v-else class="kt-user-card-v2">
                        <div class="kt-user-card-v2__pic">
                            <div class="kt-badge kt-badge--xl" v-bind:class="{'kt-badge--danger': player.gender == 'K', 'kt-badge--brand': player.gender == 'M'}">
                                <span data-toggle="kt-tooltip" data-placement="top" v-bind:title="player.name" v-tooltip:top="''" v-text="player.name.substring(0, 1)"></span>
                            </div>
                        </div>
                        <div class="kt-user-card-v2__details text-truncate">
                            <span class="kt-user-card-v2__name text-truncate" v-text="player.name"></span>
                            <a href="#" class="kt-user-card-v2__email kt-link" v-text="player.dbf_id"></a>
                        </div>
                    </div>
                </div>
                <!-- begin::activity cells -->
                <div v-for="activity in activities" :class="[activities.length < 5 ? 'col-2' : 'col-1' ]" class="col-md-1 text-center kt-padding-5 text-truncate weplayer-cell">
                    <template v-if="activity.type && activity.type.decline == 1">
                        <!-- planning relevant -->
                        <template v-if="player.declines.length > 0" v-for="decline in player.declines">
                            <!-- player declined? -->
                            <template v-if="decline.type_id < 1">
                                <button v-if="decline.start_date == activity.start_date" data-toggle="kt-tooltip" data-placement="top" data-html="true" title="<strong>Gone surfing!!!</strong><br><i class='la la-plane'></i> 2019-09" v-tooltip:top="''" type="button" class="btn btn-outline-warning btn-elevate btn-icon btn-md cursor-disabled"><i class="la la-plane"></i></button>

                                <button v-else-if="decline.start_date <= activity.start_date && decline.end_date >= activity.start_date || decline.start_date <= activity.start_date && decline.end_date >= activity.start_date" data-toggle="kt-tooltip" data-placement="top" title="Gammelmandsskade!!!" v-tooltip:top="''" type="button" class="btn btn-outline-warning btn-elevate btn-icon btn-md cursor-disabled"><i class="la la-plane"></i></button>
                            </template>
                            <template v-else-if="decline.type_id == 1">
                                <button v-if="decline.start_date == activity.start_date" data-toggle="kt-tooltip" data-placement="top" title="Gone surfing!!!" v-tooltip:top="''" type="button" class="btn btn-outline-danger btn-elevate btn-icon btn-md cursor-disabled"><i class="la la-ambulance"></i></button>

                                <button v-else-if="decline.start_date <= activity.start_date && decline.end_date >= activity.start_date || decline.start_date <= activity.start_date && decline.end_date >= activity.start_date" data-toggle="kt-tooltip" data-placement="top" title="Injured!!!" v-tooltip:top="''" type="button" class="btn btn-outline-danger btn-elevate btn-icon btn-md cursor-disabled"><i class="la la-ambulance"></i></button>
                            </template>


                        </template>

                        <button v-if="isEnrolled(player.activities,activity.id) && player.declines.length == 0" v-on:click="setActivityStatus($event, player, activity)" type="button" class="btn btn-outline-brand btn-elevate btn-icon btn-md"><i class="la la-check"></i></button>
                        <button v-else-if="player.declines.length == 0" v-on:click="setActivityStatus($event, player, activity)" type="button" class="btn btn-outline-success btn-elevate btn-icon btn-md"><i class="la la-plus"></i></button>
                    </template>
                    <template v-else>
                        <button type="button" class="btn btn-secondary btn-elevate btn-icon"><span style="color:#ccc">N/A</span></button>
                    </template>
                </div>
                <div class="weplayer-cell" v-bind:class="'col-md-'+(12 - activities.length - 4) +' col-'+(12 - activities.length * 2  - 4)"></div>
                <!-- end::activity cells -->
            </div>
            <!-- end::player row -->
        </template>
    </div>



@endsection
@section("modal")
    @include("layouts.theme.blocks.modal1")
@endsection

