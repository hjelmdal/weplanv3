@extends("layouts.theme.index")
@section("content")
    <div class="row">
        <div class="col-12">
            <!--begin::Portlet-->
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Ajax Sourced Server-side Processing
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
