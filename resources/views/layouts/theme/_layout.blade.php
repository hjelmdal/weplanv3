<!-- begin:: Page -->
@include("layouts.theme.partials._header-base-mobile")
<div class="k-grid k-grid--hor k-grid--root">
    <div class="k-grid__item k-grid__item--fluid k-grid k-grid--ver k-page">
        <div class="k-grid__item k-grid__item--fluid k-grid k-grid--hor k-wrapper" id="k_wrapper">
            @include("layouts.theme.partials._header-base")
            @include("layouts.theme.partials._subheader-base")
            <div class="k-grid__item k-grid__item--fluid k-grid k-grid--ver k-grid--stretch">
                <div class="k-body k-body--fixed k-grid__item k-grid__item--fluid k-grid k-grid--ver" id="k_body">
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
@include("layouts.theme.partials._layout-scrolltop")
{{--@include("layouts.theme.partials._layout-toolbar")--}}
{{--@include("layouts.theme.partials._layout-demo-panel")--}}