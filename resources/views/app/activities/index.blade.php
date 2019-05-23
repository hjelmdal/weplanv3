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

    <template v-if="days.length == 0">
        <div class="col-12 card1  kt-margin-b-20">
            <div class="flex-left"></div>
            <div class="flex-center">
                <div class="div-row">Der blev ikke fundet nogle aktiviteter i denne uge!</div>
            </div>
        </div>
    </template>

    <template v-for="day in days">
        <div class="col-12 card1  kt-margin-b-20 overlay-container">
            <div class="overlay">
                <div class="overlay-text">
                    <div class="kt-iconbox kt-iconbox--success kt-iconbox-xs">
                        <div class="kt-iconbox__icon">
                            <div class="kt-iconbox__icon-bg"></div>

                            <svg class="svg-overlay-icon-x3" viewBox="1 -50 511.99975 511" xmlns="http://www.w3.org/2000/svg"><path d="m405.8125 10.5-198.125 198.125-101.5-101.5-96.1875 96.1875 197.6875 197.6875 294.3125-294.3125zm0 0" fill="#1dc9b7"/><path d="m207.6875 411c-2.652344 0-5.195312-1.054688-7.070312-2.929688l-197.6875-197.6875c-1.875-1.875-2.929688-4.417968-2.929688-7.070312 0-2.65625 1.054688-5.195312 2.929688-7.074219l96.1875-96.183593c3.90625-3.90625 10.238281-3.90625 14.140624 0l94.429688 94.429687 191.054688-191.054687c1.875-1.875 4.417968-2.929688 7.070312-2.929688s5.195312 1.054688 7.070312 2.929688l96.1875 96.1875c3.90625 3.90625 3.90625 10.238281 0 14.144531l-128.136718 128.136719c-3.90625 3.902343-10.238282 3.902343-14.144532 0-3.90625-3.90625-3.90625-10.238282 0-14.144532l121.066407-121.066406-82.042969-82.046875-191.054688 191.054687c-1.875 1.875-4.417968 2.929688-7.070312 2.929688s-5.195312-1.054688-7.070312-2.929688l-94.429688-94.429687-82.042969 82.046875 183.542969 183.542969 102.535156-102.53125c3.902344-3.90625 10.234375-3.90625 14.140625 0s3.90625 10.238281 0 14.144531l-109.605469 109.601562c-1.875 1.875-4.417968 2.929688-7.070312 2.929688zm0 0"/><path d="m345.660156 273.1875c-2.640625 0-5.210937-1.066406-7.070312-2.929688-1.871094-1.859374-2.929688-4.4375-2.929688-7.070312 0-2.628906 1.058594-5.207031 2.929688-7.066406 1.859375-1.859375 4.429687-2.933594 7.070312-2.933594 2.628906 0 5.210938 1.070312 7.070313 2.933594 1.859375 1.859375 2.929687 4.4375 2.929687 7.066406 0 2.632812-1.070312 5.210938-2.929687 7.070312-1.859375 1.863282-4.441407 2.929688-7.070313 2.929688zm0 0"/></svg>
                        </div>
                        <div class="kt-iconbox__title kt-font-dark">
                            Ja!
                        </div>
                    </div>
                    <div class="kt-iconbox kt-iconbox--danger kt-iconbox-xs">
                        <div class="kt-iconbox__icon">
                            <div class="kt-iconbox__icon-bg"></div>

                            <svg class="svg-overlay-icon-x25" viewBox="1 1 511.9995 511" xmlns="http://www.w3.org/2000/svg"><path d="m502 106.65625-96.160156-96.160156-149.839844 149.84375-149.84375-149.84375-96.15625 96.160156 149.839844 149.84375-149.839844 149.839844 96.15625 96.160156 149.84375-149.84375 149.839844 149.84375 96.160156-96.160156-149.84375-149.839844zm0 0" fill="#fd397a"/><path d="m405.839844 512.496094c-2.558594 0-5.117188-.976563-7.070313-2.925782l-56.613281-56.617187c-3.90625-3.902344-3.90625-10.234375 0-14.140625s10.234375-3.90625 14.140625 0l49.546875 49.542969 82.015625-82.015625-142.773437-142.769532c-3.902344-3.90625-3.902344-10.238281 0-14.144531l142.773437-142.769531-82.019531-82.015625-142.769532 142.769531c-3.90625 3.902344-10.234374 3.902344-14.140624 0l-142.773438-142.769531-82.015625 82.015625 142.769531 142.769531c3.90625 3.90625 3.90625 10.238281 0 14.144531l-142.769531 142.769532 82.015625 82.015625 142.773438-142.769531c1.875-1.875 4.417968-2.929688 7.070312-2.929688s5.195312 1.054688 7.070312 2.929688l36.539063 36.539062c3.90625 3.90625 3.90625 10.238281 0 14.144531-3.90625 3.902344-10.234375 3.902344-14.140625 0l-29.472656-29.472656-142.769532 142.773437c-3.902343 3.902344-10.234374 3.902344-14.140624 0l-96.15625-96.160156c-3.90625-3.902344-3.90625-10.234375 0-14.140625l142.769531-142.773437-142.769531-142.769532c-3.90625-3.90625-3.90625-10.234374 0-14.140624l96.15625-96.160157c3.90625-3.902343 10.234374-3.902343 14.140624 0l142.773438 142.773438 142.769531-142.773438c3.910157-3.902343 10.238281-3.902343 14.144531 0l96.15625 96.160157c3.90625 3.90625 3.90625 10.234374 0 14.140624l-142.773437 142.773438 142.773437 142.769531c3.90625 3.90625 3.90625 10.238281 0 14.140625l-96.160156 96.160156c-1.949218 1.949219-4.507812 2.925782-7.070312 2.925782zm0 0"/><path d="m320.953125 427.582031c-2.640625 0-5.207031-1.066406-7.066406-2.929687-1.871094-1.859375-2.929688-4.4375-2.929688-7.066406 0-2.632813 1.058594-5.210938 2.929688-7.070313 1.859375-1.859375 4.4375-2.929687 7.066406-2.929687 2.621094 0 5.199219 1.070312 7.070313 2.929687 1.859374 1.859375 2.929687 4.4375 2.929687 7.070313 0 2.628906-1.070313 5.207031-2.929687 7.066406-1.871094 1.863281-4.4375 2.929687-7.070313 2.929687zm0 0"/></svg>
                        </div>
                        <div class="kt-iconbox__title kt-font-dark">
                            Nej!
                        </div>
                    </div>
                    <div class="kt-iconbox kt-iconbox--danger kt-iconbox-xs">
                        <div class="kt-iconbox__icon">
                            <div class="kt-iconbox__icon-bg"></div>
                            <svg  class="svg-overlay-icon-x25" fill="#5578eb" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 76 76" style="enable-background:new 0 0 76 76;" xml:space="preserve"><g id="_x37_7_Essential_Icons_38_"><path id="More_Details__x28_3_x29_" d="M38,0C17,0,0,17,0,38s17,38,38,38s38-17,38-38S59,0,38,0z M38,72C19.2,72,4,56.8,4,38S19.2,4,38,4s34,15.2,34,34S56.8,72,38,72z M38,31c-3.9,0-7,3.1-7,7s3.1,7,7,7s7-3.1,7-7S41.9,31,38,31z M38,41c-1.7,0-3-1.4-3-3c0-1.7,1.3-3,3-3s3,1.3,3,3C41,39.6,39.7,41,38,41z M58,31c-3.9,0-7,3.1-7,7s3.1,7,7,7s7-3.1,7-7S61.9,31,58,31z M58,41c-1.7,0-3-1.4-3-3c0-1.7,1.3-3,3-3s3,1.3,3,3C61,39.6,59.7,41,58,41z M18,31c-3.9,0-7,3.1-7,7s3.1,7,7,7s7-3.1,7-7S21.9,31,18,31z M18,41c-1.7,0-3-1.4-3-3c0-1.7,1.3-3,3-3s3,1.3,3,3C21,39.6,19.7,41,18,41z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                        </div>
                        <div class="kt-iconbox__title kt-font-dark">
                            Info!
                        </div>
                    </div>
                </div>
            </div>
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
                        <button type="button" class="btn btn-success btn-icon"><i class="fa fa-calendar-alt"></i></button>
                    </div>
                </div>
            </div>



        </div>

        <div class="clearfix"></div>
    </template>




        <!--button id="btnPrev" :disabled="from == 1" class="btn btn-warning" type="button" v-on:click="activitiesLoad('prev')">Prev</button>
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
                                <a data-toggle="modal" data-target="#modal1" :href="'{{ route("activities.index") }}/'+activity.id" class="kt-widget-5__item-title truncate-ellipsis">
                                    <span>@{{ activity.title }}</span>
                                </a>
                                <div class="kt-widget-5__item-datetime">
                                    @{{ activity.start | formatTime("HH:mm") }} - @{{ activity.end | formatTime("HH:mm") }}
                                </div>
                                </div>
                                <div class="float-left">
                                    <a data-toggle="modal" data-target="#modal1" :href="'{{ route("activities.index") }}/'+activity.id" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">
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
    </template-->


@endsection
@section("modal")
    @include("layouts.theme.blocks.modal1")
@endsection

