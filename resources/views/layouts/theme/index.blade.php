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
    <body class="k-header--fixed k-header-mobile--fixed k-aside--enabled k-aside--fixed k-aside--offcanvas-default k-page--loading" >
        @include("layouts.theme.partials._layout-page-loader")
        @include("layouts.theme._layout")
        @include("layouts.theme._foot")
    </body>
    <!-- end::Body -->
</html>