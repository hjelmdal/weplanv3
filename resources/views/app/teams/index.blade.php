<?php
/**
 * Created with PhpStorm
 * User: impact
 * Date: 2019-05-23
 * Time: 10:46
 */

$img_url = "https://keenthemes.com/keen/preview/assets/media/users/100_";
?>
@extends("layouts.theme.index")
@section("meta.title","")
@section("meta","")
@section("styles","")
@section("scripts")
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.js" xmlns="http://www.w3.org/1999/html"></script>
    <script src="{{ route("index") }}/vuejs/teams/index.js?v={{ Helpers::gitVersion()->getVersion() }}"></script>
@endsection

@section("content")
<div class="row">
    <div class="col-12   kt-margin-b-20">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Trupper
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <a data-target="#modal1" data-toggle="modal" href="{{ route("teams.create") }}" class="btn btn-success"><i class="flaticon2-plus-1"></i> <span>Opret trup</span></a>


                </div>
            </div>
        </div>
    </div>
    <template v-if="teams.length == 0">
        <div class="col-12 card1  kt-margin-b-20">
            <div class="flex-left"></div>
            <div class="flex-center">
                <div class="div-row">Der blev ikke fundet nogen trupper!</div>
            </div>
        </div>
    </template>
    <template v-for="team in teams">
    <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--height-fluid kt-widget-12">
            <div class="kt-portlet__body">
                <div class="kt-widget-12__body">
                    <div class="kt-widget-12__head">
                        <div class="kt-widget-12__label">
                            <h3 class="kt-widget-12__title" v-text="team.name"></h3>
                            <span class="kt-widget-12__desc">@{{ team.players | formatNumber() }} / 20 spillere</span>
                        </div>
                    </div>
                    <div class="kt-widget-12__info">
                        <div class="kt-widget-18">
                            <div class="kt-widget-18__item">
                                <div class="kt-widget-18__legend kt-bg-brand"></div>

                                <div class="kt-widget-18__orders kt-margin-0">
                                    <span>1</span> Herre
                                </div>
                                <div style="margin: 0 0 0 auto">
                                <div class="kt-widget-18__orders" style="display: inline;">
                                    <span>0</span> Damer

                                </div>
                                <div class="kt-widget-18__legend kt-bg-danger" style="display: inline-block; margin: 0 0 0 10px; position: relative;top: 2px;"></div>

                                </div>
                            </div>
                            <div class="kt-widget-18__progress">
                                <div class="progress">
                                    <!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
                                    <div class="progress-bar bg-brand" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    <div class="progress-bar bg-transparent" role="progressbar" style="width: 45%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="kt-portlet__foot kt-portlet__foot--md">
                <div class="kt-portlet__foot-wrapper">
                    <div class="kt-portlet__foot-info">
                        <div class="kt-widget-12__members">
                            <template v-for="player in team.players">
                            <a href="#" class="kt-widget-12__member" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" v-bind:title="player.name">
                                <img v-if="player.user.avatar" v-bind:src="'{{asset('storage/')}}/' +  player.user.avatar " v-bind:alt="player.name" />
                                <img v-else src="{{ $img_url }}1.jpg" alt="player.name"/>
                            </a>
                            </template>

                            <a href="#" class="kt-widget-12__member" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="Alison Brandy">
                                <img src="{{ $img_url }}10.jpg" alt="image"/>
                            </a>
                            <a href="#" class="kt-widget-12__member" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="Selina Cranson">
                                <img src="{{ $img_url }}11.jpg" alt="image"/>
                            </a>
                            <a href="#" class="kt-widget-12__member" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="Luke Walls">
                                <img src="{{ $img_url }}2.jpg" alt="image"/>
                            </a>
                            <a href="#" class="kt-widget-12__member" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="Micheal York">
                                <img src="{{ $img_url }}3.jpg" alt="image"/>
                            </a>
                            <a href="#" class="kt-widget-12__member kt-widget-12__member--last">
                                +3
                            </a>
                        </div>
                    </div>
                    <div class="kt-portlet__foot-toolbar">
                        <a href="#" class="btn btn-default btn-sm btn-bold btn-upper"><i class="la la-pencil-square-o"></i> Redigér</a>
                    </div>
                </div>
            </div>
        </div>

        <!--end::Portlet-->

    </div>
    </template>
</div>
@endsection

@section("modal")
    @include("layouts.theme.blocks.modal1")
@endsection
