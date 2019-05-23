@extends("layouts.theme.index")
@section("content")
    <div class="row">
        <div class="col-12">
            <!--begin::Portlet-->
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Spillere
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <a href="{{ route("players.import") }}" class="btn btn-brand"><i class="flaticon2-plus-1"></i> <span>Importér spillere</span></a>


                    </div>
                </div>
                <div class="kt-portlet__body">
                    <!--begin: Datatable -->
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
                    <!--end: Datatable -->
                </div>
            </div>
            <!--end::Portlet-->
        </div>
    </div>
@endsection
@section("scripts")
    <script src="/base/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>

    <script>
        // begin first table
        let table = $('#playersTable').DataTable({
            responsive: true,
            searchDelay: 500,
            serverSide: false,
            pageLength: 25,
            processing: false, // replaced by blockUI below
            ajax: {
                url: '{{ route("api.v1.players.index") }}',
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
    </script>
@endsection
@section("styles")
    <link href="/base/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <style>




    </style>
@endsection