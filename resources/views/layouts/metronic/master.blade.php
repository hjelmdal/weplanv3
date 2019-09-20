<?php
$dir = "/weplan";
$user = Auth::user();
?>
<!DOCTYPE html>

<html lang="en">

<!-- begin::Head -->
<head>
    <base href="">
    @if($user)
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="api-token" content="{{ $user->api_token }}">
        <script>
            const apiToken = '{{ $user->api_token }}';
        </script>
    @endif
    @yield("meta")
    <meta name="description" content="Badminton trainingssystem">
    <meta name="keywords" content="training, badminton, pixel8">
    <meta name="apple-mobile-web-app-title" content="{{ config('app.name') }}">
    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="apple-touch-icon" href="{{ route('index') }}/img/webapp/weplan-180x180.png"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ route('index') }}/img/webapp/weplan-76x76.png"/>
    <link rel="apple-touch-icon" sizes="120x120" href="{{ route('index') }}/img/webapp/weplan-120x120.png"/>
    <link rel="apple-touch-icon" sizes="152x152" href="{{ route('index') }}/img/webapp/weplan-152x152.png"/>
    <link rel="apple-touch-icon" sizes="167x167" href="{{ route('index') }}/img/webapp/weplan-167x167.png"/>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ route('index') }}/img/webapp/weplan-180x180-b.png"/>

    <link rel="apple-touch-startup-image" href="{{ route('index') }}/img/webapp/weplan-640x1136.png" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="{{ route('index') }}/img/webapp/weplan-750x1294.png" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="{{ route('index') }}/img/webapp/weplan-1242x2148.png" media="(device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="{{ route('index') }}/img/webapp/weplan-1125x2436.png" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="{{ route('index') }}/img/webapp/weplan-1536x2048.png" media="(min-device-width: 768px) and (max-device-width: 1024px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="{{ route('index') }}/img/webapp/weplan-1668x2224.png" media="(min-device-width: 834px) and (max-device-width: 834px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="{{ route('index') }}/img/webapp/weplan-2048x2732.png" media="(min-device-width: 1024px) and (max-device-width: 1024px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: portrait)">

    <link rel="icon" href="{{ route('index') }}/img/webapp/weplan-32x32.png" type="image/png" sizes="16x16"/>
    <link rel="icon" href="{{ route('index') }}/img/webapp/weplan-32x32.png" type="image/png" sizes="32x32"/>
    <link rel="icon" href="{{ route('index') }}/img/webapp/weplan-96x96.png" type="image/png" sizes="96x96"/>


    <meta property="og:site_name" content="{{ config('app.name') }}" />
    <meta property="og:url" content="{{ route('index') }}" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="WePlan.dk - Start planning today" />
    <meta property="og:description" content="Badminton planning system doing more than you ever dreamed of" />
    <meta property="og:image" content="{{ route('index') }}/assets/img/webapp/fb_share.jpg" />
    <meta property="fb:app_id" content="837790769653876" />
    <title>@hasSection('meta.title') @yield('meta.title') - @endif @hasSection("title") @yield('title') - @endif {{ config('app.name') }}</title>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, shrink-to-fit=no">

    <!--begin::Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

    <!--end::Fonts -->

    <!--begin::Page Vendors Styles(used by this page) -->
    <link href="{{ $dir }}/plugins/custom/fullcalendar/fullcalendar.bundle.css?v={{ Helpers::gitVersion()->getVersion() }}" rel="stylesheet" type="text/css" />

    <!--end::Page Vendors Styles -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="{{ $dir }}/plugins/global/plugins.bundle.css?v={{ Helpers::gitVersion()->getVersion() }}" rel="stylesheet" type="text/css" />
    <link href="{{ $dir }}/css/style.bundle.css?v={{ Helpers::gitVersion()->getVersion() }}" rel="stylesheet" type="text/css" />

    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->
    <link href="{{ $dir }}/css/skins/header/base/light.css?v={{ Helpers::gitVersion()->getVersion() }}" rel="stylesheet" type="text/css" />
    <link href="{{ $dir }}/css/skins/header/menu/light.css?v={{ Helpers::gitVersion()->getVersion() }}" rel="stylesheet" type="text/css" />
    <link href="{{ $dir }}/css/skins/brand/dark.css?v={{ Helpers::gitVersion()->getVersion() }}" rel="stylesheet" type="text/css" />
    <link href="{{ $dir }}/css/skins/aside/dark.css?v={{ Helpers::gitVersion()->getVersion() }}" rel="stylesheet" type="text/css" />

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="{{ $dir }}/media/logos/favicon.ico" />
    <!--begin::Custom styling(by Pixel8) -->
    @yield("styles")
    <link href="/css/custom.css?v={{ Helpers::gitVersion()->getVersion() }}" rel="stylesheet" type="text/css" />
    <!--end::Custom styling(by Pixel8) -->
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
<div id="vuejs" style="height: 100%;">
@include("layouts.metronic._layout")
</div>
<!-- begin::Global Config(global config for global JS sciprts) -->

<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "dark": "#282a3c",
                "light": "#ffffff",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
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
    };
</script>
<!-- end::Global Config -->
<!-- end::Global Config -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{ $dir }}/plugins/global/plugins.bundle.js?v={{ Helpers::gitVersion()->getVersion() }}" type="text/javascript"></script>
<script src="{{ $dir }}/js/scripts.bundle.js?v={{ Helpers::gitVersion()->getVersion() }}" type="text/javascript"></script>

<!--end::Global Theme Bundle -->

<!--begin::Page Vendors(used by this page) -->
<script src="{{ $dir }}/plugins/custom/fullcalendar/fullcalendar.bundle.js?v={{ Helpers::gitVersion()->getVersion() }}" type="text/javascript"></script>
<script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>
<script src="{{ $dir }}/plugins/custom/gmaps/gmaps.js?v={{ Helpers::gitVersion()->getVersion() }}" type="text/javascript"></script>

<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->
<script src="{{ $dir }}/js/pages/dashboard.js?v={{ Helpers::gitVersion()->getVersion() }}" type="text/javascript"></script>

<!--end::Page Scripts -->

<!--begin::Custom scripts(by Pixel8) -->
@yield("scripts")
<script src="/js/custom.js?v={{ Helpers::gitVersion()->getVersion() }}" type="text/javascript"></script>
<script src="/js/fullscreen.js?v={{ Helpers::gitVersion()->getVersion() }}" type="text/javascript"></script>
<!--end::Custom scripts(by Pixel8) -->
</body>

<!-- end::Body -->
</html>
