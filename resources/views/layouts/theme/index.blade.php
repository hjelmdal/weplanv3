<?php
$user = Auth::user();
if($user) {
$names = explode(" ",$user->name);
$firstname = $names[0];
} else {
    $firstname = "Gæst";
}
?>
<!DOCTYPE html>
<html lang="en" >
    <!-- begin::Head -->
    <head>
    @include("layouts.theme._head")
    </head>
    <!-- end::Head -->
    <!-- begin::Body -->
    <body class="kt-header--fixed kt-header-mobile--fixed kt-aside--enabled kt-aside--fixed kt-aside--offcanvas-default kt-page--loading">
    <span id="kt_body">

        @include("layouts.theme.partials._layout-page-loader")
        @include("layouts.theme._layout")
        @yield("modal")
    </span>
        @include("layouts.theme._foot")

    </body>
    <!-- end::Body -->
</html>
