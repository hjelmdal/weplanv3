<?php
/**
 * Created with PhpStorm
 * User: Hjelmdal
 * Date: 2019-08-13
 * Time: 09:29
 */
?>
@extends("layouts.theme.index")
@section("meta.title","")
@section("meta","")
@section("styles","")
@section("scripts")
    <script src="{{ route("index") }}/vuejs/users/admin.js?v={{ Helpers::gitVersion()->getVersion() }}"></script>
@endsection

@section("content")
    <!-- begin:: Content -->
    <div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
        <!--begin::Row-->
        <div class="row">
            <users-admin></users-admin>
        </div>
    </div>
    <!-- end:: Content -->
@endsection

@section("modal")
    @include("layouts.theme.blocks.modal1",["id" => "modal1"])

    @include("layouts.theme.blocks.modal1",["id" => "modal2"])
@endsection