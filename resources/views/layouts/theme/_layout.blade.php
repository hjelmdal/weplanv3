<!-- begin:: Page -->
@include("layouts.theme.partials._header-base-mobile")
<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
            @include("layouts.theme.partials._header-base")
            @include("layouts.theme.partials._subheader-base")
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-grid--stretch">
                <div class="kt-body kt-body--fixed kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver">
                    @include("layouts.theme.partials._content-base")
                </div>
            </div>
            @include("layouts.theme.partials._footer-base")
        </div>
    </div>
</div>
<!-- end:: Page -->
@include("layouts.theme.partials._aside-base")
<!-- begin:: Topbar Offcanvas Panels -->
@include("layouts.theme.partials._offcanvas-search")
@include("layouts.theme.partials._offcanvas-notifications")
@include("layouts.theme.partials._offcanvas-quick-actions")
@include("layouts.theme.partials._offcanvas-user")
<!-- end:: Topbar Offcanvas Panels -->
@include("layouts.theme.partials._layout-quick-panel")
@include("layouts.theme.custom.offcanvas01")
@include("layouts.theme.partials._layout-scrolltop")
{{--@include("layouts.theme.partials._layout-toolbar")--}}
{{--@include("layouts.theme.partials._layout-demo-panel")--}}
