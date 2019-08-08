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
    <script src="{{ route("index") }}/vuejs/test/app.js?v={{ Helpers::gitVersion()->getVersion() }}"></script>


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
                            <button class="btn btn success" v-on:click="test()">Tryk her</button>
                                <test :tasks="tasks"></test>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







@endsection
@section("modal")
    @include("layouts.theme.blocks.modal1")
@endsection

