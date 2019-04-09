<?php
/**
 * Created by PhpStorm.
 * User: impact
 * Date: 2019-04-08
 * Time: 22:53
 */
?>
@extends("modal")

@section('meta','')

@section('meta.title','Activities')


@section('title','Teams')

@section('styles','')
@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {

            $('.showhide').click(function () {
                var id = "#" + $(this).attr("data-id");
                var input_id = "#" + $(this).attr("data-input");

                if ($(this).is(":checked")) {
                    $(id).show();
                    $(input_id).val("");

                    console.log(id + ": show goddamnit!");
                } else {
                    $(id).hide();
                    $(input_id).val("");
                    console.log(id + ": hide goddamnit!");

                }

            });

            var t;
            t = mUtil.isRTL() ? {
                leftArrow: '<i class="la la-angle-right"></i>',
                rightArrow: '<i class="la la-angle-left"></i>'
            } : {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            };
            $("#m_datepicker_1, #m_datepicker_1_validate").datepicker({
                rtl: mUtil.isRTL(),
                todayHighlight: !0,
                orientation: "bottom left",
                autoclose: true,
                templates: t
            });
            //Bootstrap select

            $(".m_selectpicker").selectpicker();


            $(".datetime").datetimepicker({
                format: "yyyy-mm-dd hh:ii",
                showMeridian: false,
                startView: 2,
                minView: 0,
                maxView:3,
                minuteStep: 15,
                autoclose: true,
                pickerPosition:"top-left",
                todayHighlight: true,
                templates: t,
                weekStart: 1,
                language:'da'
            });

            var todayDate = new Date();
            $(".dateonly").datetimepicker({
                format: "yyyy-mm-dd",
                startView: 2,
                minView: 2,
                maxView: 3,
                autoclose: true,
                pickerPosition:"top-left",
                todayHighlight: true,
                templates: t,
                language:'da',
                weekStart: 1,
                startDate: new Date()
            });

            $(".timeonly").datetimepicker({
                format: "hh:ii",
                showMeridian: false,
                startView: 1,
                minView: 0,
                maxView: 1,
                minuteStep: 15,
                autoclose: true,
                pickerPosition:"top-left",
                todayHighlight: false,
                templates: t,
                language:'da',
            });

            $("#startD").datetimepicker().on('changeDate', function(ev){

                var input = ev.date.valueOf();
                var dateString = printDate(input,"date");
                var recurEnd = printDate(input+604800000,"date");


                $('#startT').datetimepicker('setStartDate',dateString);
                $('#respD').datetimepicker('setEndDate', dateString);
                $('#endD').datetimepicker('setStartDate', dateString);
                $('#recurD').datetimepicker('setStartDate', recurEnd);
                validateEndDate();
                validateRecurringDate();

                //console.log("Changed to: "+ recurEnd);


                validateResponseDate();



            });

            $("#startT").datetimepicker().on('changeDate', function(ev){
                $('#endD').datetimepicker('show');
            });



            $("#endD").datetimepicker().on('changeDate', function(ev){
                if($('#endD').val() == $('#startD').val()) {
                    var dateString = new Date($('#startD').val() + " " + $('#startT').val());
                    dateString = dateString.valueOf();
                    $('#endT').datetimepicker('setStartDate',printDate(dateString+900000,"datetime"));
                    console.log(printDate(dateString+7200000,"datetime"));
                }
                console.log("nope!");
                $('#endT').datetimepicker('show');
            });

            $("#endT").datetimepicker().on('changeDate', function(ev){
                if(!$('#respD').val()) {
                    $('#respD').datetimepicker('show');
                }
            });

            $("#respD").datetimepicker().on('changeDate', function(ev){
                validateResponseDate();
                $('#respT').datetimepicker('show');



            });
            function validateEndDate() {
                if($('#endD').val()) {
                    var valEnd = new Date($('#endD').val()).valueOf();
                    var valStart = new Date($('#startD').val()).valueOf();
                    //If earlier start date is set after end date is set
                    if(valStart > valEnd) {
                        $('#endD').val(dateString);
                        $('#endD').datetimepicker('update');
                        $('#endD').datetimepicker({ initialDate: dateString});
                        $('#endD').datetimepicker('show');
                    }
                } else {
                    $("#endD").val($("#startD").val());
                    $('#startT').datetimepicker('show');
                }
            }
            function validateResponseDate() {
                $('#respD').datetimepicker('setEndDate', $('#startD').val());
                var responseDate = new Date($('#respD').val() + " " + $('#respT').val()).valueOf();
                var startDate = new Date($('#startD').val() + " " + $('#startT').val()).valueOf();
                if(responseDate > startDate) {
                    $('#respD').val($('#startD').val());
                    $('#respT').val($('#startT').val());
                    console.log($('#startT').val());
                } else {


                    $('#respT').val($('#respD').val());
                    $('#respT').datetimepicker('update');
                    //Forcing to validate - it's ugly, I know :-(
                    $('#respT').datetimepicker('show');
                    $('#respT').datetimepicker('hide');
                }
                var dateString = new Date($('#startD').val() + " " + $('#startT').val());
                dateString = printDate(dateString.valueOf(),"datetime");
                $('#respT').datetimepicker('setEndDate',dateString);



                return true;

            }

            function validateRecurringDate() {
                var startDate = new Date($("#startD").val());
                var dayNum = startDate.getDay();

                var day = "";
                switch (dayNum) {
                    case 0:
                        day = "1,2,3,4,5,6";
                        //$("#day0").prop('checked', true);
                        break;
                    case 1:
                        day = "0,2,3,4,5,6";
                        //$("#day1").prop('checked', true);
                        break;
                    case 2:
                        day = "0,1,3,4,5,6";
                        //$("#day2").prop('checked', true);
                        break;
                    case 3:
                        day = "0,1,2,4,5,6";
                        //$("#day3").prop('checked', true);
                        break;
                    case 4:
                        day = "0,1,2,3,5,6";
                        //$("#day4").prop('checked', true);
                        break;
                    case 5:
                        day = "0,1,2,3,4,6";
                        //$("#day5").prop('checked', true);
                        break;
                    case 6:
                        day = "0,1,2,3,4,5";
                    //$("#day6").prop('checked', true);
                }

                $('#recurD').datetimepicker('setDaysOfWeekDisabled', day);
            }

            function printDate(e,format) {
                var date = new Date(e);
                var dd = leadingZero(date.getDate());

                var mm = leadingZero(date.getMonth()+1);
                var yyyy = leadingZero(date.getFullYear());
                var hh = leadingZero(date.getHours());
                var ii = leadingZero(date.getMinutes());

                if(format == "date") {
                    var dateString = yyyy + "-" + mm + "-" + dd;
                } else if(format == "datetime") {
                    var dateString = yyyy + "-" + mm + "-" + dd + " " + hh + ":" + ii;
                }
                return dateString;
            }

            function leadingZero(e) {
                if(e<10) {
                    e = '0'+e;
                }
                return e;
            }


            $("#myform").validate();
        });
    </script>
@endsection
@section("content")

    <?php

    $opt_type = old("type");
    ?>



    <div class="row">
        <div class="col-md-12">
            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
						<span class="m-portlet__head-icon">
							<i class="fa fa-users"></i>
						</span>
                            <h3 class="m-portlet__head-text">
                                Ny aktivitet
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="{{ route("coach.activities.create") }}" data-target="#modal" data-toggle="modal" class="btn btn-success m-btn--icon">
								<span>									<i class="fa fa-plus"></i>
									<span>Tilføj</span>
								</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <form id="myform" class="m-form m-form--label-align-right" method="POST" action="{{ route("coach.activities.store") }}">
                    @csrf
                    <div class="m-portlet__body">
                        <!--begin::Section-->
                        <div class="m-section m-form__section--first">
                            <div class="m-form__heading">
                                <h3 class="m-form__heading-title">Generel Info:</h3>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-form-label col-lg-3 col-sm-12">Aktivitetstype</label>
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    <select class="form-control m-bootstrap-select m_selectpicker" name="type_id">
                                        <option value="" <?php if (empty($opt_type)) echo 'selected'; ?>>
                                            - <?= __('Vælg en type'); ?> -
                                        </option>
                                        <?php
                                        foreach ($types as $type) { ?>
                                        <option
                                            value="<?= $type->id ?>" <?php if ($opt_type == $type->id) echo 'selected'; ?>><?= $type->name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Title -->
                            <div class="form-group m-form__group row">
                                <label class="col-lg-3 col-form-label">Titel</label>
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    <input name="title" type="text" class="form-control m-input" placeholder="Aktivitetens titel" required>
                                    <span class="m-form__help">Skriv en titel til aktiviteten</span>
                                </div>
                            </div>
                            <!-- Description -->
                            <div class="form-group m-form__group row">
                                <label class="col-lg-3 col-form-label">Beskrivelse</label>
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    <textarea name="info" class="form-control m-input" placeholder="Aktivitetens titel" rows="3"></textarea>
                                    <span class="m-form__help">Skriv en beskrivelse til aktiviteten</span>
                                </div>
                            </div>
                        </div>

                        <!-- Groups -->
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">Multiple Select</label>
                            <div class="col-lg-4 col-md-9 col-sm-12">
                                <select name="group_ids[]" class="form-control m-bootstrap-select m_selectpicker" multiple>
                                    <option value="1">Mustard</option>
                                    <option value="2">Ketchup</option>
                                    <option value="3">Relish</option>
                                </select>
                            </div>
                        </div>

                        <div class="m-form__seperator m-form__seperator--dashed"></div>

                        <!-- Date and time -->
                        <div class="form-group m-form__group row">
                            <div class="col-sm-4 col-md-3 col-lg-2 offset-lg-3 m-col" style="border-right: 1px dashed #ebedf2;">
                                <label>Startdato</label>

                                <div class="m-input-icon m-input-icon--right m--margin-bottom-10">
                                    <input name="start_date" id="startD" type="text" class="form-control m-input dateonly" placeholder="Dato" required>
                                    <span class="m-input-icon__icon m-input-icon__icon--right">
                                        <span>
                                            <i class="la la-calendar glyphicon-th"></i>
                                        </span>
                                    </span>
                                </div>

                                <div class="m-input-icon m-input-icon--right">
                                    <input name="start" id="startT" type="text" class="form-control m-input timeonly" placeholder="Tid" required>
                                    <span class="m-input-icon__icon m-input-icon__icon--right">
                                        <span>
                                            <i class="la la-clock-o glyphicon-th"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-4 col-md-3 col-lg-2" style="border-right: 1px dashed #ebedf2;">
                                <label>Slutdato</label>
                                <div class="m-input-icon m-input-icon--right m--margin-bottom-10">
                                    <input name="end_date" id="endD" type="text" class="form-control m-input dateonly" placeholder="Dato" required>
                                    <span class="m-input-icon__icon m-input-icon__icon--right">
                                        <span>
                                            <i class="la la-calendar glyphicon-th"></i>
                                        </span>
                                    </span>
                                </div>

                                <div class="m-input-icon m-input-icon--right">
                                    <input name="end" id="endT" type="text" class="form-control m-input timeonly" placeholder="Tid" required>
                                    <span class="m-input-icon__icon m-input-icon__icon--right">
                                        <span>
                                            <i class="la la-clock-o glyphicon-th"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-3 col-lg-2">
                                <label>Sidste respons</label>
                                <div class="m-input-icon m-input-icon--right m--margin-bottom-10">
                                    <input name="response_date" id="respD" type="text" class="form-control m-input dateonly" placeholder="Dato" required>
                                    <span class="m-input-icon__icon m-input-icon__icon--right">
                                        <span>
                                            <i class="la la-calendar glyphicon-th"></i>
                                        </span>
                                    </span>
                                </div>
                                <div class="m-input-icon m-input-icon--right">
                                    <input name="response_time" id="respT" type="text" class="form-control m-input timeonly" placeholder="Tid" required>
                                    <span class="m-input-icon__icon m-input-icon__icon--right">
                                        <span>
                                            <i class="la la-clock-o glyphicon-th"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="m-form__seperator m-form__seperator--dashed"></div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">Gentag aktivitet?</label>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <span class="m-switch m-switch--icon">
                                <label>
                                    <input data-id="recurring" class="showhide" type="checkbox" name="recur">
                                    <span></span>
                                </label>
                                </span>
                            </div>
                        </div>
                        <div id="recurring" style="display: none;">
                            <div class="form-group m-form__group row">
                                <div class="col-lg-3 col-6 offset-lg-3" style="border-right: 1px dashed #ebedf2;">
                                    <div class="m-checkbox-list">

                                        <label class="m-checkbox m-checkbox--state-primary">
                                            <input id="day1" name="weekdays[]" type="checkbox" value="1"> Mandage
                                            <span></span>
                                        </label>

                                        <label class="m-checkbox m-checkbox--state-primary">
                                            <input id="day2" name="weekdays[]" type="checkbox" value="2"> Tirsdage
                                            <span></span>
                                        </label>

                                        <label class="m-checkbox m-checkbox--state-primary">
                                            <input id="day3" name="weekdays[]" type="checkbox" value="3"> Onsdage
                                            <span></span>
                                        </label>

                                        <label class="m-checkbox m-checkbox--state-primary">
                                            <input id="day4" name="weekdays[]" type="checkbox" value="4"> Torsdage
                                            <span></span>
                                        </label>

                                        <label class="m-checkbox m-checkbox--state-primary">
                                            <input id="day5" name="weekdays[]" type="checkbox" value="5"> Fredage
                                            <span></span>
                                        </label>

                                        <label class="m-checkbox m-checkbox--state-primary">
                                            <input id="day6" name="weekdays[]" type="checkbox" value="6"> L&oslash;rdage
                                            <span></span>
                                        </label>

                                        <label class="m-checkbox m-checkbox--state-primary">
                                            <input id="day0" name="weekdays[]" type="checkbox" value="7"> S&oslash;ndage
                                            <span></span>
                                        </label>

                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <label>Slutdato</label>

                                    <div class="m-input-icon m-input-icon--right m--margin-bottom-10">
                                        <input name="recur_end" id="recurD" type="text" class="form-control m-input dateonly" placeholder="Dato">
                                        <span class="m-input-icon__icon m-input-icon__icon--right">
                                        <span>
                                            <i class="la la-calendar glyphicon-th"></i>
                                        </span>
                                    </span>
                                    </div>
                                    Begivenheden vil forekomme ugentligt indtil denne dato.<br>
                                    <small>NB! Enkelt aktiviteter kan efterfølgende slettes</small>
                                </div>
                            </div>


                        </div>



                        <!--end::Section-->
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions">
                            <div class="row">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <button id="clickme" type="reset" class="btn btn-secondary">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Form-->
                </form>
            </div>
        </div>
    </div>
@endsection
