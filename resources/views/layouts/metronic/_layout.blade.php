<!-- begin:: Page -->

@include("layouts.metronic.partials._header.base-mobile")
<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

        @include("layouts.metronic.partials._aside.base")
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

            @include("layouts.metronic.partials._header.base")
            <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                @include("layouts.metronic.partials._subheader.subheader-v3")

            <!-- Content area -->
                    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                        <!--Begin::Dashboard 1-->
                        <!--Begin::Row-->
                                @yield("content")
                                <router-view :isSpa="true"></router-view>

                    </div>
            </div>

            @include("layouts.metronic.partials._footer.base")
        </div>
    </div>
</div>

<!-- end:: Page -->

@include("layouts.metronic.partials._search-panel")

<!--[html-partial:include:{"file":"partials/_scrolltop.html"}]/-->

<!--[html-partial:include:{"file":"partials/_toolbar.html"}]/-->

<!--[html-partial:include:{"file":"partials/_demo-panel.html"}]/-->

<!--[html-partial:include:{"file":"partials/_chat.html"}]/-->

@include("layouts.metronic.partials._profile-panel")
