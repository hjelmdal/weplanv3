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
@section("form-action", route("api.v1.teams.store"))
@section("callback",route("teams.index"))

@section("styles","")
@section("scripts","")

@section("content")
    <div id="modal-scroll" class="kt-scroll" style="height: calc(100vh - 230px); overflow-x:hidden;">

        <!--begin::Section-->
        <div class="kt-section kt-form__section--first">
            <div class="kt-form__heading">
                <h3 class="kt-form__heading-title">Form input</h3>
            </div>
            <!-- begin::form rows -->
            <div class="form-group kt-form__group row">
                <label class="col-form-label col-lg-3 col-sm-12">Navn</label>

                <div class="col-lg-6 col-md-9 col-sm-12">
                    <input name="name" class="form-control kt-input" id="name" autocomplete="new-password" type="text"
                           placeholder="Trup navn">
                    <span class="kt-form__help">Skriv et sigende navn for den trup du opretter</span>

                </div>

            </div>

            <div class="form-group kt-form__group row">


                <label class="col-form-label col-lg-3 col-sm-12">Max antal spillere</label>

                <div class="col-lg-6 col-md-9 col-sm-12">
                    <input name="max_players" class="form-control kt-input" id="max_players" type="number" placeholder="20">
                    <span class="kt-form__help">Hvor mange ønsker du max på denne trup?</span>

                </div>

            </div>
            <div class="form-group kt-form__group row">


                <label class="col-form-label col-lg-3 col-sm-12">Aktiv?</label>

                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input name="active" class="form-control kt-input kt-checkbox--brand" id="active" type="checkbox" checked="checked">


                    </div>

            </div>
        </div>
        <!--end::Section-->
    </div>
@endsection

@section("modal")
    @include("layouts.theme.blocks.modal1")
@endsection

