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
    <template v-for="team in teams">
    <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--height-fluid kt-widget-12">
            <div class="kt-portlet__body">
                <div class="kt-widget-12__body">
                    <div class="kt-widget-12__head">
                        <div class="kt-widget-12__label">
                            <h3 class="kt-widget-12__title" v-text="team.name"></h3>
                            <span class="kt-widget-12__desc">@{{ team.players | formatNumber() }}</span>
                        </div>
                    </div>
                    <div class="kt-widget-12__info">
                        To start a blog, think of a topic about and first brainstorm ways to write details
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
                        <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">Join</a>
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
