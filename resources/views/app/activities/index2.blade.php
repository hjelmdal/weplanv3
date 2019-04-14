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
        width: 70px;
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


    .flex-left {
        position:relative;
        display:inline;
        float:left !important;
        width:80px;
    }
    .flex-right {
        position:relative;
        display:inline;
        float:left !important;
        width: calc(100% - 100px);
        margin:1rem 1rem 1rem 0.3rem;
    }

    .div-row {
        display:flex;
        flex-direction:row;

    }
    .div-row:nth-child(even)  {
        background-color: #eee;
    }
    .div-test {
        flex: 1 1 auto;
    }
    .row-column {
        position: relative;
        display:flex;
        flex-direction:column;
        text-overflow: ellipsis;
        flex: 1 1 auto;
        min-width: 0;
    }
    .div-text {
        font-weight: 500;
        font-size: 1.1rem;
        color: #3e4466;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        flex: 1 1 auto;
        min-width: 0;
        margin: 0 0 0 0.5rem;
        padding: 0 0 0 0.5rem;
    }
    .row-column::before {
        position: absolute;
        display: block;
        width: 0.25rem;
        height: 100%;
        top: 0.3rem;
        left:0rem;
        height: calc(100% - 0.8rem);
        content: "";
        border-radius: 0.2rem;
        background: #385aeb;
    }

    .bef-brand::before {
        background: #385aeb;
    }

    .bef-metal::before {
        background: #c4c5d6;
    }
    .bef-light::before {
        background: #ffffff;
    }
    .bef-accent::before {
        background: #00c5dc;
    }
    .bef-primary::before {
        background: #5867dd;
    }
    .bef-success::before {
        background: #34bfa3;
    }
    .bef-info::before {
        background: #36a3f7;
    }
    .bef-warning::before {
        background: #ffb822;
    }
    .bef-danger::before {
        background: #fd3995;
    }
    .bef-focus::before {
        background: #9816f4;
    }


    .div-time {
        font-weight: 500;
        font-size: 0.9rem;
        color: #a1a8c3;
        margin: 0 0 0 0.5rem;
        padding: 0 0 0 0.5rem;
    }

    .div-right {
        flex: 0 0 auto;
        margin-left:auto;

    }

    .div-date {
        flex: 0 0 auto;
        margin-right:auto;

    }

    .card1 {
        padding: 0px;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid #ebedf2;
        border-radius: .25rem;
        display: flex;
    }

    </style>
@endsection
@section("content")
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
        <div class="flex-right">
            <template v-for="activity in day.events">
            <div class="div-row">
                <div class="row-column" v-bind:class="{'bef-success':(activity.type_id == 0), 'bef-warning':(activity.type_id == 1), 'bef-danger':(activity.type_id == 2), 'bef-info':(activity.type_id == 3), 'bef-dark':(activity.type_id == 4)}">
                    <a data-toggle="modal" data-target="#modal1" :href="'{{ route("activities") }}/'+activity.id" class="div-text">@{{ activity.title }}</a>
                    <div class="div-time">@{{ activity.start | formatTime("HH:mm") }} - @{{ activity.end | formatTime("HH:mm") }}</div>
                </div>
                <div class="div-right"><a data-toggle="modal" data-target="#modal1" :href="'{{ route("activities") }}/'+activity.id" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">
                        <i class="la la-edit"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete">
                        <i class="la la-trash"></i>
                    </a></div>
            </div>


            </template>
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
    </template-->


@endsection
@section("modal")
    @include("layouts.theme.blocks.modal1")
@endsection

