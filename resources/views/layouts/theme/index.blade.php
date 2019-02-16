<!DOCTYPE html>
<html lang="en" >
    <!-- begin::Head -->
    <head>
        <meta charset="utf-8"/>
        <title>Keen | Dashboard</title>
        <meta name="description" content="Latest updates and statistic charts">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!--begin::Fonts -->
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
        <script>            WebFont.load({
                google: {
"families":[
"Poppins:300,400,500,600,700",
"Raleway:300,400,500,600,700"]},
                active: function() {
                    sessionStorage.fonts = true;                }            });        </script>
        <!--end::Fonts -->
        <!--begin::Page Vendors Styles(used by this page) -->
        <link href="{{ config("app.keen_assets") }}/vendors/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
        <!--end::Page Vendors Styles -->
        <!--begin::Global Theme Styles(used by all pages) -->
        <link href="{{ config("app.keen_assets") }}/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
        <link href="{{ config("app.keen_assets") }}/demo/demo5/base/style.bundle.css" rel="stylesheet" type="text/css" />
        <!--end::Global Theme Styles -->
        <!--begin::Layout Skins(used by all pages) -->
        <link href="{{ config("app.keen_assets") }}/demo/demo5/skins/header/navy.css" rel="stylesheet" type="text/css" />
        <!--end::Layout Skins -->
        <link rel="shortcut icon" href="{{ config("app.keen_assets") }}/media/logos/favicon.ico" />
        <!-- Hotjar Tracking Code for keenthemes.com -->
        <script>    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){
(h.hj.q=h.hj.q||[
]).push(arguments)};        h._hjSettings={
hjid:1070954,hjsv:6};        a=o.getElementsByTagName('head')[
0];        r=o.createElement('script');r.async=1;        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;        a.appendChild(r);    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');</script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <!--script async src="https://www.googletagmanager.com/gtag/js?id=UA-37564768-1"></script>
        <script>  window.dataLayer = window.dataLayer || [
];  function gtag(){
dataLayer.push(arguments);}  gtag('js', new Date());  gtag('config', 'UA-37564768-1');</script-->
    </head>
    <!-- end::Head -->
    <!-- begin::Body -->
    <body class="k-header--fixed k-header-mobile--fixed k-aside--enabled k-aside--fixed k-aside--offcanvas-default k-page--loading" >
        @include("layouts.theme.partials._layout-page-loader")
        @include("layouts.theme._layout")
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
    </body>
    <!-- end::Body -->
</html>