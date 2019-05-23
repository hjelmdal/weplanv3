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
@section("form-action","")
@section("callback", "")

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
                <label class="col-form-label col-lg-3 col-sm-12">Label</label>

                <div class="col-lg-6 col-md-9 col-sm-12">
                    <input name="input" class="form-control kt-input" id="pac-input" autocomplete="true" type="text"
                           placeholder="Skovbakken Badminton">
                    <span class="kt-form__help">Helptext</span>

                </div>
            </div>
        </div>
        <!--end::Section-->
    </div>
@endsection

@section("modal")
    @include("layouts.theme.blocks.modal1")
@endsection

