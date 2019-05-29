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
                            <button id="teamReload" class="btn btn-brand btn-icon kt-margin-r-10"><i class="la la-refresh"></i></button>
                            <a data-target="#modal-std" data-toggle="modal" href="{{ route("teams.add",["id" => $team->id]) }}" class="btn btn-success"><i class="la la-users"></i> <span>Tilføj spillere</span></a>



                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--begin::Section-->
        <table class="table table-striped table-hover table-checkable" id="playersTable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Navn</th>
                <th>Køn</th>
                <th>F&oslash;dseldag</th>

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
        var table;
        table = $('#playersTable').DataTable({
            language: {
                emptyTable: "Ingen spillere fundet på denne trup"
            },

            responsive: true,
            searchDelay: 500,
            serverSide: false,
            pageLength: 25,
            processing: false, // replaced by blockUI below

            ajax: {
                url: '{{ route("api.v1.teams.players", ["id" => $team->id]) }}',
                type: "GET",
                headers: { Authorization: document.querySelector('meta[name="api-token"]').getAttribute('content') },
            },
            rowId: function(a) {
                return 'id' + a.id;
            },

            columns: [
                {data: 'id',
                    defaultContent: ""},
                {data: 'name'},
                {data: 'gender'},
                {data: 'birthday'},
            ],
            columnDefs: [
                {
                    targets:3,
                    title: "Fødselsdag",
                    render: function(a,t,e,n) {
                        return moment(a).format("YYYY-MMM-DD");
                    }
                },
                {
                    targets: 1,
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
            table.destroy();
            $("#reload").trigger( "click" );

        });

        $("#teamReload").click(function() {
            table.ajax.reload();
            console.log("Reloaded data!");
        });


            table.on('processing.dt', function (e, settings, processing) {
                console.log("Reloading");
                $('#processingIndicator').css('display', 'none');

                if (processing) {
                    KTApp.block("#playersTable",{
                        overlayColor: "#000000",
                        type: "v2",
                        state: "primary",
                        message: "Processing..."
                    });
                } else {
                    KTApp.unblock("#playersTable");
                }
            });



            var container = document.querySelector('#modal-scroll');

        var ps = new PerfectScrollbar(container, {
            suppressScrollX: true,
        });
    </script>
@endsection
