@extends("layouts.theme.index")

@section("scripts")
    <script src="/base/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
<script>


    // begin first table
    let table = $('#playersTable').DataTable({
        //dom:' "search"f',
        responsive: true,
        searchDelay: 500,
        serverSide: false,
        select: {
            style: "multi",
            selector: "td:first-child .kt-checkable"
        },
        pageLength: 25,
        processing: false, // replaced by blockUI below
        ajax: {
            url: '{{ route("api.v1.badmintonpeople.players.index") }}',
            type: "GET",
            headers: { Authorization: document.querySelector('meta[name="api-token"]').getAttribute('content') },
        },
        rowId: function(a) {
            return 'id' + a.id;
        },
        columns: [
            {data: 'id',
            defaultContent: ""},
            {data: 'we_player',
            defaultContent: ""},
            {data: 'name'},
            {data: 'gender'},
            {data: 'age_group'},
            {data: 'birthday'},
            {data: 'club_id'},
        ],
        columnDefs: [
            { responsivePriority: 1, targets: 2 },
            { responsivePriority: 2, targets: -1 },
            {
                targets:5,
                title: "Fødselsdag",
                render: function(a,t,e,n) {
                    return moment(a).format("YYYY-MMM-DD");
                }
            },
            {
                targets:1,
                title: "*",
                render: function(a,t,e,n) {
                       if(e["we_player"]) {
                            return '<button type="button" class="btn btn-sm btn-success btn-icon"><i class="fa fa-check"></i></button>';
                       }

                }

            },
            {
                targets: 0,
                orderable: !1,
                render: function(t, e, a, n) {
                    if (a["we_player"]) {
                        var disabled = ' disabled="disabled"';
                    }
                    return '<label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">\n <input type="checkbox" value="" class="kt-checkable"' + disabled+'>\n <span></span>\n </label>'

                }
            },
            {
                targets: 2,
                title: "Navn",
                render: function(a, t, e, n) {
                    var s = e["we_player"];
                    var gen = false;
                    if(e['gender'] == 'M') {
                        var gen = 0;
                    } else if(e['gender'] == 'K') {
                        var gen = 1;
                    }
                    return s ? '\n                                <div class="kt-user-card-v2">\n                                    <div class="kt-user-card-v2__pic">\n                                        <img src="https://keenthemes.com/keen/preview/assets/media/users/100_' + KTUtil.getRandomInt(1, 14) + '.jpg" class="kt-img-rounded kt-marginless" alt="photo">\n                                    </div>\n                                    <div class="kt-user-card-v2__details">\n                                        <span class="kt-user-card-v2__name">' + a + '</span>\n                                        <a href="#" class="kt-user-card-v2__email kt-link">'+e['dbf_id'] + "</a>\n                                    </div>\n                                </div>" : '\n                                <div class="kt-user-card-v2"><div class="kt-user-card-v2__pic"><div class="kt-badge kt-badge--xl kt-badge--' + ["brand", "danger"][gen] + '"><span>'+a.substring(0, 1)+'</span></div></div><div class="kt-user-card-v2__details"> <span class="kt-user-card-v2__name">' + a +'</span> <a href="#" class="kt-user-card-v2__email kt-link">'+e['dbf_id'] +'</a> </div> </div>'
                }
            }
        ]

    });

    $("#reload").click(function () {
        table.ajax.reload();
    });


document.addEventListener("DOMContentLoaded", function () {

    let ids = [];

    $("#createUsers").click(function () {
        console.log(ids);
        $.ajax({
            url: "{{ route("api.v1.badmintonpeople.players.store") }}",
            type: "POST",
            dataType: "json",
            data: {data:ids},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Authorization": $('meta[name="api-token"]').attr('content')
            },
            error: function (data, status) {
                console.log(data);
                if(data.responseJSON.message) {
                    var errorMsg = data.responseJSON.message;
                } else {
                    var errorMsg = "No message";
                }
                if (typeof errorMsg == 'string') {
                    errorMsg = errorMsg;
                } else {
                    errorMsg = "An error occured";
                }
                swal.fire({
                    position: 'center',
                    type: 'error',
                    title: errorMsg,
                    showConfirmButton: false,
                    timer: 1000
                });

                console.log("Error: ", data + ". Status: " + status);
                console.log($('meta[name="csrf-token"]').attr('content'));


            },
            success: function (data, status, xhr) {
                console.log(data);
                if(data.message) {
                    var successMsg = data.message;
                } else {
                    var successMsg = "No message";
                }
                swal.fire({
                    position: 'center',
                    type: 'success',
                    title: successMsg,
                    showConfirmButton: false,
                    timer: 1000
                });
                $("#createUsers span").html("Opret");
                $("#createUsers span").prop("disabled",true);
                ids = [];
                table.ajax.reload();

            }
        });
    });



    table.on("change", ".kt-checkable", function() {
        // Get parent row (object HTMLTableRowElement)
        var parentRow = $(this).closest("tr");

        var rowData = table.row( parentRow ).data();
        var rowId = rowData.id; // or whatever it is
        var found = false;
        for (var i = 0; i < ids.length; i++) {
            console.log("Elementer" + ids[i]);
            if (ids[i] == rowId) {
                found = true;
                var delIndex = i;
                console.log("Found it!" + delIndex + "RowId: " + rowId);
                break;

            }
        }
        if($(this).prop( "checked" )) {
            console.log("Adding!");
            if(!found) {

                ids.push(rowId);
                console.log("added: " + rowId);
            }
        } else {
            console.log("Deleting!");
            if (found) {
                ids.splice(delIndex, 1);
                console.log("deleted: " + delIndex);
            }
        }

        if(ids.length > 0) {
            $("#createUsers").removeAttr("disabled");
            $("#createUsers span").html("Opret " + "(" + ids.length + ")");
        } else {
            $("#createUsers").prop("disabled", true);
            $("#createUsers span").html("Opret");
        }



        console.log(ids);
    });

    table.on('processing.dt', function (e, settings, processing) {
        $('#processingIndicator').css('display', 'none');
        if (processing) {
            KTApp.blockPage({
                overlayColor: "#000000",
                type: "v2",
                state: "primary",
                message: "Processing..."
            });
        } else {
            KTApp.unblockPage();
        }
    });
});




</script>

@endsection
@section("styles")
    <link href="/base/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <style>




    </style>
@endsection
@section("content")
    <div class="row">
        <div class="col-12">
            <!--begin::Portlet-->
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title truncate-ellipsis">
                            Importer fra BP
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <button id="createUsers" class="btn btn-brand kt-margin-r-10" disabled="disabled"><i class="flaticon2-plus-1"></i> <span>Opret</span></button>
                        <button id="reload" class="btn btn-success"><i class="flaticon2-reload"></i> Reload</button>

                    </div>
                </div>
                <div class="kt-portlet__body">
                    <!--begin: Datatable -->
                    <table class="table table-striped table-hover table-checkable" id="playersTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Navn</th>
                            <th>Køn</th>
                            <th>Række</th>
                            <th>F&oslash;dseldag</th>
                            <th>Klub</th>

                        </tr>
                        </thead>
                    </table>
                    <!--end: Datatable -->
                </div>
            </div>
            <!--end::Portlet-->
        </div>
    </div>
@endsection


@section("modal")
    @include("layouts.theme.blocks.modal1")
@endsection
