<?php
/**
 * Created with PhpStorm
 * User: Hjelmdal
 * Date: 2019-05-24
 * Time: 00:57
 */


?>
@extends("layouts.theme.modal")

@section("meta.title","")
@section("meta","")
@section("title","Edit ". $team->name)
@section("form-action", route("api.v1.teams.update", ["id" => $team->id]))
@section("refresh", "#reload")
@section("callback",route("teams.index"))

@section("styles","")
@section("scripts","")

@section("content")

    @method('PUT')
        <!--begin::Section-->
        <div class="kt-section kt-form__section--first">

            <!-- begin::form rows -->
            <div class="form-group kt-form__group row">
                <label class="col-form-label col-lg-3 col-sm-12">Navn</label>

                <div class="col-lg-6 col-md-9 col-sm-12">
                    <input name="id" type="hidden" value="{{ $team->id }}" />
                    <input name="name" class="form-control kt-input" id="name" autocomplete="new-password" type="text" placeholder="Trup navn" value="{{ $team->name }}">
                    <span class="kt-form__help">Skriv et sigende navn for den trup du opretter</span>

                </div>

            </div>

            <div class="form-group kt-form__group row">


                <label class="col-form-label col-lg-3 col-sm-12">Max antal spillere</label>

                <div class="col-lg-6 col-md-9 col-sm-12">
                    <input name="max_players" class="form-control kt-input" id="max_players" type="number" placeholder="20" value="{{ $team->max_players }}">
                    <span class="kt-form__help">Hvor mange ønsker du max på denne trup?</span>

                </div>

            </div>
            <div class="form-group kt-form__group row">


                <label class="col-lg-3 col-sm-12">Aktiv?</label>

                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <label class="kt-checkbox kt-checkbox--bold kt-checkbox--success">
                            <input name="active"  type="checkbox" @if($team->active == 1) checked="checked" @endif> Er truppen aktiv?
                            <span></span>
                        </label>



                    </div>

            </div>
        </div>
        <!--end::Section-->

@endsection

@section("modal")
    @include("layouts.theme.blocks.modal1")
@endsection

