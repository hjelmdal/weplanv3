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
    <script src="{{ route("index") }}/vuejs/activities/index2.js?v={{ Helpers::gitVersion()->getVersion() }}"></script>

@endsection
@section("styles")
    <style>




    </style>
@endsection
@section("meta")
    <meta name="start-date" content="{{ $date }}">
@endsection

@section("content")


            <user-activities></user-activities>



@endsection
@section("modal")

@endsection

