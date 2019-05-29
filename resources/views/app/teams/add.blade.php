<?php
/**
 * Created with PhpStorm
 * User: Hjelmdal
 * Date: 2019-05-28
 * Time: 21:32
 */
?>
@extends("layouts.theme.modal")

@section("meta.title","")
@section("title","Spillere på " . $team->name)

@section("meta","")
@section("form-action","")
@section("callback", "")

@section("styles")
    <link href="/base/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <style>




    </style>
@endsection

@section("content")
    <div id="modal-scroll" class="kt-scroll" style="height: calc(100vh - 230px); overflow-x:hidden;">
        <div class="row">
            <div class="col-12   kt-margin-b-20">
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">

                        </div>
                        <div class="kt-portlet__head-toolbar">

                            <a data-target="#modal-std" data-toggle="modal" href="{{ route("teams.create") }}" class="btn btn-success"><i class="la la-users"></i> <span>Tilføj spillere</span></a>



                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--begin::Section-->
        <table class="table table-striped table-hover table-checkable" id="playersTable">
            <thead>
            <tr>
                <th>Navn</th>
                <th>Køn</th>
                <th>Trup</th>
                <th>#</th>

            </tr>
            </thead>
        </table>
        <!--end::Section-->
    </div>
@endsection

@section("modal")
    @include("layouts.theme.blocks.modal1")
@endsection

@section("scripts")
    <script src="/base/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>

    <script>
        // begin first table
        var table1;
        table1 = $('#playersTable').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Danish.json",
                emptyTable: "Ingen spillere fundet på denne trup"
            },
            order: [],

            responsive: true,
            searchDelay: 500,
            serverSide: false,
            pageLength: 25,
            processing: false, // replaced by blockUI below

            ajax: {
                url: '{{ route("api.v1.players.byteam") }}',
                type: "GET",
                headers: { Authorization: document.querySelector('meta[name="api-token"]').getAttribute('content') },
            },

            rowId: function(a) {
                return 'id' + a.id;
            },

            columns: [
                {data: 'name'},
                {data: 'gender'},
                {data: 'team.name',
                    defaultContent: "None"},
                {data: 'birthday'}

            ],
            createdRow: function( row, data, dataIndex ) {
                // Set the data-status attribute, and add a class
                //$(row).find('td:eq(3)').addClass('d-none d-sm-block');
                if(data.team_id == "{{ $team->id }}") {
                    $(row).addClass('kt-bg-metal');
                }
            },

            columnDefs: [
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 2, targets: -1 },

                {
                    targets: -1,
                    title: "Actions",
                    orderable: !1,
                    render: function(t, a, e, n) {
                        if (e.team_id != "{{ $team->id }}") {
                            return '\n<button data-team="{{$team->id}}" data-player="'+e.id+'"  class="addPlayer btn btn-sm btn-clean btn-icon btn-icon-md" title="View">\n<i class="la la-plus"></i>\n </button>'
                        }
                        return ""
                    }
                },
                {
                    targets: 0,
                    title: "Navn",
                    render: function(a, t, e, n) {
                        var s = e["user"];
                        if(s) {
                            if(s.avatar) {
                                var pic = "{{asset('storage/')}}/"+s.avatar;
                            } else {
                                var pic = "/img/profile.png";
                            }
                        }
                        var gen = false;
                        if(e['gender'] == 'M') {
                            var gen = 0;
                        } else if(e['gender'] == 'K') {
                            var gen = 1;
                        }
                        return s ? '\n                                <div class="kt-user-card-v2">\n                                    <div class="kt-user-card-v2__pic">\n                                        <img src="'+pic+'" class="kt-img-rounded kt-marginless" alt="photo">\n                                    </div>\n                                    <div class="kt-user-card-v2__details">\n                                        <span class="kt-user-card-v2__name">' + a + '</span>\n                                        <a href="#" class="kt-user-card-v2__email kt-link">'+e['dbf_id'] + "</a>\n                                    </div>\n                                </div>" : '\n                                <div class="kt-user-card-v2"><div class="kt-user-card-v2__pic"><div class="kt-badge kt-badge--xl kt-badge--' + ["brand", "danger"][gen] + '"><span>'+a.substring(0, 1)+'</span></div></div><div class="kt-user-card-v2__details"> <span class="kt-user-card-v2__name">' + a +'</span> <a href="#" class="kt-user-card-v2__email kt-link">'+e['dbf_id'] +'</a> </div> </div>'
                    }
                }
            ]

        });

        $("#modal1").on('hide.bs.modal', function(){
            table1.destroy();
        });
        $.ajaxSetup({
            headers: {
                "Authorization": $('meta[name="api-token"]').attr('content')
            },
        });
        $("#playersTable").on("click", ".addPlayer", function(){
            KTApp.block("#modal-scroll",{
                overlayColor: "#000000",
                type: "v2",
                state: "primary",
                message: "Processing..."
            });
            var dataObj = new Object();
            dataObj.player_id = $(this).data("player");
            dataObj.team = $(this).data("team");
            if (dataObj) {
                $.ajax({
                    url: "{{ route("api.v1.players.index") }}/" + dataObj.player_id,
                    type: "PATCH",
                    dataType: "json",
                    data: dataObj,
                    error: function (data) {
                        console.log("error", data);
                        if(data.status == 401) {
                            //window.location.reload();
                        }

                    },
                    success: function (data, status, xhr) {
                        console.log("success data:", data, "StatusCode:", xhr.status);
                        toastr.options.closeButton = true;
                        toastr.options.positionClass = "toast-top-center";
                        toastr.options.showMethod = "fadeIn";
                        toastr.options.showDuration = 1000;
                        toastr.options.extendedTimeOut = 100000;
                        toastr.success(data, "Udført!");
                        $("#teamReload").trigger( "click" );
                        table1.ajax.reload();


                    }

                });
            } else {
                console.log("No data!");
            }

            setTimeout(function() {
            KTApp.unblock("#modal-scroll");
            },200);
        });

        var container = document.querySelector('#modal-scroll');

        var ps = new PerfectScrollbar(container, {
            suppressScrollX: true,
        });
    </script>
@endsection
