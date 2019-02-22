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
<script src="{{ config("app.keen_assets") }}/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="{{ config("app.keen_assets") }}/demo/demo5/base/scripts.bundle.js" type="text/javascript"></script>
<!--end::Global Theme Bundle -->
<!--begin::Page Vendors(used by this page) -->
<script src="{{ config("app.keen_assets") }}/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
<!--end::Page Vendors -->
<!--begin::Page Scripts(used by this page) -->
<script src="{{ config("app.keen_assets") }}/app/scripts/custom/dashboard.js" type="text/javascript"></script>
<!--end::Page Scripts -->
<!--begin::Global App Bundle(used by all pages) -->
<script src="{{ config("app.keen_assets") }}/app/scripts/bundle/app.bundle.js" type="text/javascript"></script>
<!--end::Global App Bundle -->
<!--begin::Custom Scripts(by Pixel8) -->
@yield("scripts")
<script src="/js/custom.js" type="text/javascript"></script>

<!--end::Custom Scripts(by Pixel8) -->
