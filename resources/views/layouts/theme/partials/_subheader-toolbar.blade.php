<!-- begin:: Sub-header toolbar -->
<div class="kt-subheader__toolbar">
    <label class="col-form-label">Kun mine?&nbsp;</label>
    <span class="kt-switch kt-switch--sm kt-switch--icon" style="display: flex;align-self: flex-end;">
									<label>
									<input type="checkbox" v-model="filters[0]" @change="activitiesLoad('reload')">
									<span></span>
									</label>
									</span>
    <!--div class="kt-subheader__toolbar-wrapper">
        <a id="btnPrev" href="#" class="btn btn-default btn-sm btn-bold btn-upper">Prev</a>
        <a id="btnNext" href="#" class="btn btn-default btn-sm btn-bold btn-upper">Next</a>
        <a href="#" class="btn btn-default btn-sm btn-bold btn-upper">Settings</a>
        <div class="dropdown dropdown-inline" data-toggle="kt-tooltip" title="Quick actions" data-placement="top">
            <a href="#" class="btn btn-icon btn btn-label btn-label-brand btn-bold" data-toggle="dropdown" data-offset="0 5px" aria-haspopup="true" aria-expanded="false"> <i class="flaticon2-add-1"></i> </a>
            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right dropdown-menu-anim">
                <ul class="kt-nav kt-nav--active-bg" id="m_nav_1" role="tablist">
                    <li class="kt-nav__item">
                        <a href="" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-psd"></i> <span class="kt-nav__link-text">Document</span> </a>
                    </li>
                    <li class="kt-nav__item">
                        <a class="kt-nav__link" role="tab" id="m_nav_link_1" > <i class="kt-nav__link-icon flaticon2-supermarket"></i> <span class="kt-nav__link-text">Message</span> </a>
                    </li>
                    <li class="kt-nav__item">
                        <a href="" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-shopping-cart"></i> <span class="kt-nav__link-text">Product</span> </a>
                    </li>
                    <li class="kt-nav__item">
                        <a class="kt-nav__link" role="tab" id="m_nav_link_2" >
                            <i class="kt-nav__link-icon flaticon2-chart2"></i> <span class="kt-nav__link-text">Report</span>
                            <span class="kt-nav__link-badge"> <span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--rounded">pdf</span> </span>
                        </a>
                    </li>
                    <li class="kt-nav__item">
                        <a href="" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-sms"></i> <span class="kt-nav__link-text">Post</span> </a>
                    </li>
                    <li class="kt-nav__item">
                        <a href="" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-avatar"></i> <span class="kt-nav__link-text">Customer</span> </a>
                    </li>
                </ul>
            </div>
        </div>
    </div-->
</div>
<!-- end:: Sub-header toolbar -->
