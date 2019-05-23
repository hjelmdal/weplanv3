<!-- begin:: Aside -->
<div class="kt-aside kt-aside--fixed " id="kt_aside">
    <div class="kt-aside__head">
        <h3 class="kt-aside__title">
            Dashboard
        </h3>
        <a href="#" class="kt-aside__close" id="kt_aside_close"><i class="flaticon2-delete"></i></a>
    </div>
    <div class="kt-aside__body">
        <!-- begin:: Aside Menu -->
        <div class="kt-aside-menu-wrapper" id="kt_aside_menu_wrapper">
            <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" >
                <ul class="kt-menu__nav ">
                    <li class="kt-menu__section kt-menu__section--first">
                        <h4 class="kt-menu__section-text" style="font-size: 1.2rem;">
                            {{ __("Administration") }}
                        </h4>
                        <i class="kt-menu__section-icon flaticon-more-v2"></i>
                    </li>
                    <li class="kt-menu__item kt-menu__item" >
                        <a href="{{ route("players.index") }}" class="kt-menu__link ">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 20 20" version="1.1" class="kt-svg-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon id="Shape" points="0 0 24 0 24 24 0 24"/>
                                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" id="Mask" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                    <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" id="Mask-Copy" fill="#000000" fill-rule="nonzero"/>
                                </g>
                            </svg>
                            <span class="kt-menu__link-text">Spillere</span></a>
                    </li>
                    <li class="kt-menu__item kt-menu__item" >
                        <a href="{{ route("teams.index") }}" class="kt-menu__link ">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon id="Shape" points="0 0 24 0 24 24 0 24"/>
                                    <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                    <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero"/>
                                </g>
                            </svg>
                            <span class="kt-menu__link-text">Trupper</span></a>
                    </li>
                    <li class="kt-menu__item ">
                        <a href="{{ route("activities.index") }}" class="kt-menu__link ">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect id="bound" x="0" y="0" width="24" height="24"/>
                                <path d="M10.9630156,7.5 L11.0475062,7.5 C11.3043819,7.5 11.5194647,7.69464724 11.5450248,7.95024814 L12,12.5 L15.2480695,14.3560397 C15.403857,14.4450611 15.5,14.6107328 15.5,14.7901613 L15.5,15 C15.5,15.2109164 15.3290185,15.3818979 15.1181021,15.3818979 C15.0841582,15.3818979 15.0503659,15.3773725 15.0176181,15.3684413 L10.3986612,14.1087258 C10.1672824,14.0456225 10.0132986,13.8271186 10.0316926,13.5879956 L10.4644883,7.96165175 C10.4845267,7.70115317 10.7017474,7.5 10.9630156,7.5 Z" id="Path-107" fill="#000000"/>
                                <path d="M7.38979581,2.8349582 C8.65216735,2.29743306 10.0413491,2 11.5,2 C17.2989899,2 22,6.70101013 22,12.5 C22,18.2989899 17.2989899,23 11.5,23 C5.70101013,23 1,18.2989899 1,12.5 C1,11.5151324 1.13559454,10.5619345 1.38913364,9.65805651 L3.31481075,10.1982117 C3.10672013,10.940064 3,11.7119264 3,12.5 C3,17.1944204 6.80557963,21 11.5,21 C16.1944204,21 20,17.1944204 20,12.5 C20,7.80557963 16.1944204,4 11.5,4 C10.54876,4 9.62236069,4.15592757 8.74872191,4.45446326 L9.93948308,5.87355717 C10.0088058,5.95617272 10.0495583,6.05898805 10.05566,6.16666224 C10.0712834,6.4423623 9.86044965,6.67852665 9.5847496,6.69415008 L4.71777931,6.96995273 C4.66931162,6.97269931 4.62070229,6.96837279 4.57348157,6.95710938 C4.30487471,6.89303938 4.13906482,6.62335149 4.20313482,6.35474463 L5.33163823,1.62361064 C5.35654118,1.51920756 5.41437908,1.4255891 5.49660017,1.35659741 C5.7081375,1.17909652 6.0235153,1.2066885 6.2010162,1.41822583 L7.38979581,2.8349582 Z" id="Combined-Shape" fill="#000000" opacity="0.3"/>
                            </g>
                        </svg>
                        <span class="kt-menu__link-text">Aktiviteter</span></a>
                    </li>
                    <li class="kt-menu__item kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text">Active Vendors</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                        <div class="kt-menu__submenu ">
                            <span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item kt-menu__item--parent" aria-haspopup="true" >
                                    <span class="kt-menu__link"><span class="kt-menu__link-text">Active Vendors</span></span>
                                </li>
                                <li class="kt-menu__item " aria-haspopup="true" >
                                    <a href="#" class="kt-menu__link ">
                                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        <span class="kt-menu__link-text">Vendors Dashboard</span>
                                    </a>
                                </li>
                                <li class="kt-menu__item " aria-haspopup="true" >
                                    <a href="#" class="kt-menu__link ">
                                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        <span class="kt-menu__link-text">Vendors Revenue</span>
                                    </a>
                                </li>
                                <li class="kt-menu__item " aria-haspopup="true" >
                                    <a href="#" class="kt-menu__link ">
                                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        <span class="kt-menu__link-text">Sales Reports</span>
                                    </a>
                                </li>
                                <li class="kt-menu__item " aria-haspopup="true" >
                                    <a href="#" class="kt-menu__link ">
                                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        <span class="kt-menu__link-text">Transactions</span>
                                    </a>
                                </li>
                                <li class="kt-menu__item " aria-haspopup="true" >
                                    <a href="#" class="kt-menu__link ">
                                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        <span class="kt-menu__link-text">Statements</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="kt-menu__section ">
                        <h4 class="kt-menu__section-text">
                            Vendor Reports
                        </h4>
                        <i class="kt-menu__section-icon flaticon-more-v2"></i>
                    </li>
                    <li class="kt-menu__item " aria-haspopup="true" >
                        <a href="#" class="kt-menu__link "><span class="kt-menu__link-text">Statements</span></a>
                    </li>
                    <li class="kt-menu__item " aria-haspopup="true" >
                        <a href="#" class="kt-menu__link "><span class="kt-menu__link-text">Transactions</span></a>
                    </li>
                    <li class="kt-menu__item kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text">Archive</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                        <div class="kt-menu__submenu ">
                            <span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item kt-menu__item--parent" aria-haspopup="true" >
                                    <span class="kt-menu__link"><span class="kt-menu__link-text">Archive</span></span>
                                </li>
                                <li class="kt-menu__item " aria-haspopup="true" >
                                    <a href="#" class="kt-menu__link ">
                                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        <span class="kt-menu__link-text">Base</span>
                                    </a>
                                </li>
                                <li class="kt-menu__item " aria-haspopup="true" >
                                    <a href="#" class="kt-menu__link ">
                                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        <span class="kt-menu__link-text">Draggable</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="kt-menu__item " aria-haspopup="true" >
                        <a href="javascript:;" class="kt-menu__link "><span class="kt-menu__link-text">Invoices</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- end:: Aside Menu -->
    </div>
</div>
<!-- end:: Aside -->
