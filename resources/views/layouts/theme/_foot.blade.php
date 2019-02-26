<?php
/**
 * Created by PhpStorm.
 * User: hjelmdal
 * Date: 21/02/2019
 * Time: 18.33
 */
?>
<!-- begin::Global Config(global config for global JS sciprts) -->
<script>var KAppOptions = {
        "colors": {
            "state": {
                "brand": "#385aeb",
                "metal": "#c4c5d6",
                "light": "#ffffff",
                "accent": "#00c5dc",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995",
                "focus": "#9816f4"
            },
            "base": {
                "label": [
                    "#c5cbe3",
                    "#a1a8c3",
                    "#3d4465",
                    "#3e4466"
                ],
                "shape": [
                    "#f0f3ff",
                    "#d9dffa",
                    "#afb4d4",
                    "#646c9a"
                ]
            }
        }
    };</script>
<!-- end::Global Config -->
<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{ config("app.keen_assets") }}/vendors/base/vendors.bundle.js?v={{ Helpers::gitVersion()->getVersion() }}" type="text/javascript"></script>
<script src="{{ config("app.keen_assets") }}/demo/demo5/base/scripts.bundle.js?v={{ Helpers::gitVersion()->getVersion() }}" type="text/javascript"></script>
<!--end::Global Theme Bundle -->
<!--begin::Page Vendors(used by this page) -->
<script src="{{ config("app.keen_assets") }}/vendors/custom/fullcalendar/fullcalendar.bundle.js?v={{ Helpers::gitVersion()->getVersion() }}" type="text/javascript"></script>
<!--end::Page Vendors -->
<!--begin::Page Scripts(used by this page) -->
<script src="{{ config("app.keen_assets") }}/app/scripts/custom/dashboard.js?v={{ Helpers::gitVersion()->getVersion() }}" type="text/javascript"></script>
<!--end::Page Scripts -->
<!--begin::Global App Bundle(used by all pages) -->
<script src="{{ config("app.keen_assets") }}/app/scripts/bundle/app.bundle.js?v={{ Helpers::gitVersion()->getVersion() }}" type="text/javascript"></script>
<!--end::Global App Bundle -->
<!--begin::Custom Scripts(by Pixel8) -->
@yield("scripts")
<script src="/js/custom.js?v={{ Helpers::gitVersion()->getVersion() }}" type="text/javascript"></script>
@if ($errors->any())
    <script>

        document.addEventListener("DOMContentLoaded", function(event) {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-center",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "10000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
        });
        toastr.options.positionClass = "toast-top-center";
        toastr.error("<ul> @foreach ($errors->all() as $error) \n" +
            "                <li>{{ $error }}</li>\n" +
            "            @endforeach </ul>", "Der opstod en fejl!");

        $("#clickme").click(function (e) {
            toastr.success("<ul><li>This is bad!</li><li>Not as bad as this!</li></ul>", "Shooot!");
        });
    </script>

@endif

@if(Session::has('message') || session('status'))
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function (event) {
            toastr.options.closeButton = true;
            toastr.options.positionClass = "toast-top-center";
            toastr.options.showMethod = "fadeIn";
            toastr.options.showDuration = 1000;
            toastr.options.extendedTimeOut = 100000;
            toastr.{{ Session::get('message-type','info') }}('{{ Session::get('message') . session('status') }}', '{{ Session::get('message-title',Session::get('title')) }}');
        });
    </script>
@endif

<!--end::Custom Scripts(by Pixel8) -->
