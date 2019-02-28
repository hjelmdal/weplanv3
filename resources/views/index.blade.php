<?php
/**
 * Created by PhpStorm.
 * User: hjelmdal
 * Date: 16/02/2019
 * Time: 01.45
 */
?>
@extends("layouts.theme.index")
@section("scripts")
    <script src="{{ config("app.keen_assets") }}/app/custom/general/custom/profile/profile.js" type="text/javascript"></script>
@endsection
@section("styles")
    <link href="{{ config("app.keen_assets") }}/app/custom/user/profile-v1.demo5.css" rel="stylesheet" type="text/css" />
@endsection
@section("content")

    <h1>Welcome</h1>
    @endsection