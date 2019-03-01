<?php
/**
 * Created by PhpStorm.
 * User: hjelmdal
 * Date: 21/02/2019
 * Time: 18.31
 */
?>
<!--link rel="manifest" href="/manifest.json"-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1 shrink-to-fit=no">
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
<link href="{{ config("app.keen_assets") }}/vendors/custom/fullcalendar/fullcalendar.bundle.css?v={{ Helpers::gitVersion()->getVersion() }}" rel="stylesheet" type="text/css" />
<!--end::Page Vendors Styles -->
<!--begin::Global Theme Styles(used by all pages) -->
<link href="{{ config("app.keen_assets") }}/vendors/base/vendors.bundle.css?v={{ Helpers::gitVersion()->getVersion() }}" rel="stylesheet" type="text/css" />
<link href="{{ config("app.keen_assets") }}/demo/demo5/base/style.bundle.css?v={{ Helpers::gitVersion()->getVersion() }}" rel="stylesheet" type="text/css" />
<!--end::Global Theme Styles -->
<!--begin::Layout Skins(used by all pages) -->
<link href="{{ config("app.keen_assets") }}/demo/demo5/skins/header/navy.css?v={{ Helpers::gitVersion()->getVersion() }}" rel="stylesheet" type="text/css" />
<!--end::Layout Skins -->

<!--begin::Custom styling(by Pixel8) -->
@yield("styles")
<link href="/css/custom.css?v={{ Helpers::gitVersion()->getVersion() }}" rel="stylesheet" type="text/css" />
<!--end::Custom styling(by Pixel8) -->

<!-- Hotjar Tracking Code for keenthemes.com >
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
