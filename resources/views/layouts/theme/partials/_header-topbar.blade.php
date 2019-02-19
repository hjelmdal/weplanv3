<!-- begin:: Header Topbar -->
<div class="k-header__topbar k-grid__item k-grid__item--fluid">
    <!--begin: Search -->
    <div class="k-header__topbar-item k-header__topbar-item--search dropdown">
        <div class="k-header__topbar-wrapper" id="k_offcanvas_toolbar_search_toggler_btn">
            <span class="k-header__topbar-icon"><i class="flaticon2-search"></i></span>
        </div>
    </div>
    <!--end: Search -->
    <!--begin: Notifications -->
    <div class="k-header__topbar-item">
        <div class="k-header__topbar-wrapper" id="k_offcanvas_toolbar_notifications_toggler_btn">
            <span class="k-header__topbar-icon"><i class="flaticon2-notification"></i></span>
            <span class="k-badge k-badge--brand"></span>
        </div>
    </div>
    <!--end: Notifications -->
    <!--begin: Quick actions -->
    <div class="k-header__topbar-item">
        <div class="k-header__topbar-wrapper" id="k_offcanvas_toolbar_quick_actions_toggler_btn">
            <span class="k-header__topbar-icon"><i class="flaticon2-settings"></i></span>
        </div>
    </div>
    <!--end: Quick actions -->
    <!--begin: Quick panel toggler -->
    <div class="k-header__topbar-item" data-toggle="k-tooltip" title="Quick panel" data-placement="top">
        <div class="k-header__topbar-wrapper">
            <span class="k-header__topbar-icon" id="k_quick_panel_toggler_btn"><i class="flaticon2-menu"></i></span>
        </div>
    </div>
    <!--end: Quick panel toggler -->
    <!--begin: Language bar -->
    <div class="k-header__topbar-item k-header__topbar-item--langs">
        <div class="k-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px 0">
            <span class="k-header__topbar-icon">
                <img class="" src="{{ config("app.keen_assets") }}/media/flags/020-flag.svg" alt="" />
            </span>
        </div>
        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround">
            @include("layouts.theme.partials._dropdown-languages")
        </div>
    </div>
    <!--end: Language bar -->
    <!--begin: User bar -->
    <div class="k-header__topbar-item k-header__topbar-item--user" id="k_offcanvas_toolbar_profile_toggler_btn">
        <div class="k-header__topbar-welcome">Hi,</div>
        <div class="k-header__topbar-username">{{ $user->firstname }}</div>
        <div class="k-header__topbar-wrapper" >
            <img alt="Pic" src="{{ config("app.keen_assets") }}/media/users/default.jpg"/>
        </div>
    </div>
    <!--end: User bar -->
</div>
<!-- end:: Header Topbar -->