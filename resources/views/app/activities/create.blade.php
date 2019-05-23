<?php
/**
 * Created by PhpStorm.
 * User: impact
 * Date: 2019-04-08
 * Time: 22:53
 */
?>
@extends("layouts.theme.modal")

@section('meta','')

@section('meta.title','Activities')


@section('title','Ny Aktivitet')

@section("form-action", route("activities.store"))
@section("callback",route("activities.index"))


@section('styles')
    <style>
        /* Always set the map height explicitly to define the size of the div
 * element that contains the map. */
        #map {
            height: 200px;
        }



        #infowindow-content .title {
            font-weight: bold;
        }

        #infowindow-content {
            display: none;
        }

        #map #infowindow-content {
            display: inline;
        }

        .pac-card {
            margin: 10px 10px 0 0;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            background-color: #fff;
            font-family: Roboto;
        }

        #pac-container {
            padding-bottom: 12px;
            margin-right: 12px;
        }

        .pac-controls {
            display: inline-block;
            padding: 5px 11px;
        }







        #target {
            width: 345px;
        }

        .pac-container {
            background-color: #fff;
            position: absolute!important;
            z-index: 1999 !important;
            border-radius: 2px;
            border-top: 1px solid #d9d9d9;
            font-family: Arial,sans-serif;
            box-shadow: 0 2px 6px rgba(0,0,0,0.3);
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            overflow: hidden;
        }
    </style>
@endsection
@section('scripts')
    <script>


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
        t = KTUtil.isRTL() ? {
            leftArrow: '<i class="la la-angle-right"></i>',
            rightArrow: '<i class="la la-angle-left"></i>'
        } : {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        };
        $("#kt_datepicker_1, #kt_datepicker_1_validate").datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: !0,
            orientation: "bottom left",
            autoclose: true,
            templates: t
        });
        //Bootstrap select

        $(".kt_selectpicker").selectpicker();


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


            validateAllDates(input);
            // $('#startT').datetimepicker('setStartDate',dateString);
            // $('#respD').datetimepicker('setEndDate', dateString);
            // $('#endD').datetimepicker('setStartDate', dateString);
            // $('#recurD').datetimepicker('setStartDate', recurEnd);
            // //validateEndDate();
            // validateRecurringDate();
            //
            // //console.log("Changed to: "+ recurEnd);
            //
            //
            // validateResponseDate();



        });

        function validateAllDates(date) {
            var input = date;
            var dateString = printDate(input,"date");
            var recurEnd = printDate(input+604800000,"date");
            var startD = $('#startD').val();
            var startT = $('#startT').val();
            var endD = $('#endD').val();
            var endT = $('#endT').val();
            var respD = $('#respD').val();
            var respT = $('#respT').val();
            var recurD = $('#recurD').val();
            if(startD) {
                $('#startT').datetimepicker('setStartDate',dateString);
                $('#respD').datetimepicker('setEndDate', dateString);
                $('#endD').datetimepicker('setStartDate', dateString);
                $('#recurD').datetimepicker('setStartDate', recurEnd);
                if(endD) {
                    if(endD < startD) {
                        $('#endD').val(dateString);
                        $('#endD').datetimepicker('update');
                        $('#endD').datetimepicker({ initialDate: dateString});
                        $('#endT').val("");
                        $('#endT').datetimepicker('update');
                        $('#endD').datetimepicker('show');
                    }
                } else {
                    $("#endD").val(startD);
                }
            }
            $("#myform").validate();

        }

        $("#startD").datetimepicker().on('changeDate', function(ev){
            if(!$('#startT').val()) {
                $('#startT').datetimepicker('show');
            } else if(!$('#endD').val()) {
                $('#endD').datetimepicker('show');

            } else if(!$('#endT').val()) {
                $('#endT').datetimepicker('show');

            }

        });

        $("#startT").datetimepicker().on('changeDate', function(ev){
            if(!$('#startD').val()) {
                $('#startD').datetimepicker('show');
            } else {
                $('#endD').datetimepicker('show');
            }
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




        function initAutocomplete() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 56.177857, lng: 10.209540},
                zoom: 13,
                mapTypeId: 'roadmap',
                gestureHandling: 'cooperative',
                streetViewControl: false,
                mapTypeControl: false,
            });

            // Create the search box and link it to the UI element.
            var input = document.getElementById('pac-input');
            var searchBox = new google.maps.places.SearchBox(input);
            //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            // Bias the SearchBox results towards current map's viewport.
            map.addListener('bounds_changed', function() {
                searchBox.setBounds(map.getBounds());
            });

            var markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener('places_changed', function() {
                var places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                // Clear out the old markers.
                markers.forEach(function(marker) {
                    marker.setMap(null);
                });
                markers = [];

                // For each place, get the icon, name and location.
                var bounds = new google.maps.LatLngBounds();
                places.forEach(function(place) {
                    if (!place.geometry) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    var icon = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25)
                    };

                    // Create a marker for each place.
                    markers.push(new google.maps.Marker({
                        map: map,
                        icon: icon,
                        title: place.name,
                        position: place.geometry.location
                    }));

                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });


        }
        $("#myform").validate();
        $('#myform').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });

        var container = document.querySelector('#modal-scroll');

        var ps = new PerfectScrollbar(container, {
            suppressScrollX: true,
        });
        console.log("Scroll activated!");

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env("GOOGLE_MAPS_API","AIzaSyDB1bTnXXhAUuNGyP-M0oHhaYTZfPrChek") }}&callback=initAutocomplete&libraries=places" async defer></script>
@endsection
@section("content")

    <?php

    $opt_type = old("type");
    ?>






<div id="modal-scroll" class="kt-scroll" style="height: calc(100vh - 230px); overflow-x:hidden;">

    <!--begin::Section-->
        <div class="kt-section kt-form__section--first">
            <div class="kt-form__heading">
                <h3 class="kt-form__heading-title">Generel Info:</h3>
            </div>
            <div class="form-group kt-form__group row">
                <label class="col-form-label col-lg-3 col-sm-12">Aktivitetstype</label>
                <div class="col-lg-6 col-md-9 col-sm-12">
                    <select class="form-control kt-bootstrap-select kt_selectpicker" name="type_id" required>
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
            <div class="form-group kt-form__group row">
                <label class="col-lg-3 col-form-label">Titel</label>
                <div class="col-lg-6 col-md-9 col-sm-12">
                    <input name="title" type="text" class="form-control kt-input" placeholder="Aktivitetens titel" required>
                    <span class="kt-form__help">Skriv en titel til aktiviteten</span>
                </div>
            </div>
            <!-- Description -->
            <div class="form-group kt-form__group row">
                <label class="col-lg-3 col-form-label">Beskrivelse</label>
                <div class="col-lg-6 col-md-9 col-sm-12">
                    <textarea name="info" class="form-control kt-input" placeholder="Aktivitetens beskrivelse" rows="3"></textarea>
                    <span class="kt-form__help">Skriv en beskrivelse til aktiviteten</span>
                </div>
            </div>
        </div>

        <!-- Map -->
        <div class="form-group kt-form__group row">
            <label class="col-form-label col-lg-3 col-sm-12">Sted</label>

            <div class="col-lg-6 col-md-9 col-sm-12">
                <input name="address" class="form-control kt-input" id="pac-input" autocomplete="true" type="text" placeholder="Skovbakken Badminton">
                <span class="kt-form__help">Skriv adresse på eventen</span>

                </div>
        </div>
        <div class="form-group kt-form__group row">
            <div class="col-lg-6 col-md-9 col-sm-12 offset-lg-3">
                <div id="map"></div>
            </div>
        </div>
        <!-- Groups -->
        <div class="form-group kt-form__group row">
            <label class="col-form-label col-lg-3 col-sm-12">Multiple Select</label>
            <div class="col-lg-4 col-md-9 col-sm-12">
                <select name="group_ids[]" class="form-control m-bootstrap-select kt_selectpicker" multiple>
                    <option value="1">Mustard</option>
                    <option value="2">Ketchup</option>
                    <option value="3">Relish</option>
                </select>
            </div>
        </div>

        <div class="kt-form__seperator kt-form__seperator--dashed"></div>

        <!-- Date and time -->
        <div class="form-group kt-form__group row">
            <div class="col-sm-4 col-md-3 col-lg-2 offset-lg-3 m-col" style="border-right: 1px dashed #ebedf2;">
                <label>Startdato</label>

                <div class="kt-input-icon kt-input-icon--right kt--margin-bottom-10">
                    <input name="start_date" id="startD" type="text" class="form-control kt-input dateonly" autocomplete="off" placeholder="Dato" required >
                    <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                        <span>
                                            <i class="la la-calendar glyphicon-th"></i>
                                        </span>
                                    </span>
                </div>

                <div class="kt-input-icon kt-input-icon--right">
                    <input name="start" id="startT" type="text" class="form-control kt-input timeonly" autocomplete="off" placeholder="Tid" required>
                    <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                        <span>
                                            <i class="la la-clock-o glyphicon-th"></i>
                                        </span>
                                    </span>
                </div>
            </div>

            <div class="col-sm-4 col-md-3 col-lg-2" style="border-right: 1px dashed #ebedf2;">
                <label>Slutdato</label>
                <div class="kt-input-icon kt-input-icon--right kt--margin-bottom-10">
                    <input name="end_date" id="endD" type="text" class="form-control kt-input dateonly" autocomplete="off" placeholder="Dato" required>
                    <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                        <span>
                                            <i class="la la-calendar glyphicon-th"></i>
                                        </span>
                                    </span>
                </div>

                <div class="kt-input-icon kt-input-icon--right">
                    <input name="end" id="endT" type="text" class="form-control kt-input timeonly" autocomplete="off" placeholder="Tid" required>
                    <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                        <span>
                                            <i class="la la-clock-o glyphicon-th"></i>
                                        </span>
                                    </span>
                </div>
            </div>
            <div class="col-sm-4 col-md-3 col-lg-2">
                <label>Responstid</label>
                <div class="kt-input-icon kt-input-icon--right kt--margin-bottom-10">
                    <input name="response_date" id="respD" type="text" class="form-control kt-input dateonly" autocomplete="off" placeholder="Dato" required>
                    <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                        <span>
                                            <i class="la la-calendar glyphicon-th"></i>
                                        </span>
                                    </span>
                </div>
                <div class="kt-input-icon kt-input-icon--right">
                    <input name="response_time" id="respT" type="text" class="form-control kt-input timeonly" autocomplete="off" placeholder="Tid" required>
                    <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                        <span>
                                            <i class="la la-clock-o glyphicon-th"></i>
                                        </span>
                                    </span>
                </div>
            </div>
        </div>
        <div class="kt-form__seperator kt-form__seperator--dashed"></div>
        <div class="form-group kt-form__group row">
            <label class="col-form-label col-lg-3 col-sm-12">Gentag aktivitet?</label>
            <div class="col-lg-6 col-md-9 col-sm-12">
                                <span class="kt-switch kt-switch--icon">
                                <label>
                                    <input data-id="recurring" class="showhide" type="checkbox" name="recur">
                                    <span></span>
                                </label>
                                </span>
            </div>
        </div>
        <div id="recurring" style="display: none;">
            <div class="form-group kt-form__group row">
                <div class="col-lg-3 col-6 offset-lg-3" style="border-right: 1px dashed #ebedf2;">
                    <div class="kt-checkbox-list">

                        <label class="kt-checkbox kt-checkbox--state-primary">
                            <input id="day1" name="weekdays[]" type="checkbox" value="1"> Mandage
                            <span></span>
                        </label>

                        <label class="kt-checkbox kt-checkbox--state-primary">
                            <input id="day2" name="weekdays[]" type="checkbox" value="2"> Tirsdage
                            <span></span>
                        </label>

                        <label class="kt-checkbox kt-checkbox--state-primary">
                            <input id="day3" name="weekdays[]" type="checkbox" value="3"> Onsdage
                            <span></span>
                        </label>

                        <label class="kt-checkbox kt-checkbox--state-primary">
                            <input id="day4" name="weekdays[]" type="checkbox" value="4"> Torsdage
                            <span></span>
                        </label>

                        <label class="kt-checkbox kt-checkbox--state-primary">
                            <input id="day5" name="weekdays[]" type="checkbox" value="5"> Fredage
                            <span></span>
                        </label>

                        <label class="kt-checkbox kt-checkbox--state-primary">
                            <input id="day6" name="weekdays[]" type="checkbox" value="6"> L&oslash;rdage
                            <span></span>
                        </label>

                        <label class="kt-checkbox kt-checkbox--state-primary">
                            <input id="day0" name="weekdays[]" type="checkbox" value="7"> S&oslash;ndage
                            <span></span>
                        </label>

                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <label>Slutdato</label>

                    <div class="kt-input-icon kt-input-icon--right kt--margin-bottom-10">
                        <input name="recur_end" id="recurD" type="text" class="form-control kt-input dateonly" placeholder="Dato">
                        <span class="kt-input-icon__icon kt-input-icon__icon--right">
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

        <!--end::Form-->


@endsection
