"use strict";
var KLayout = function() {
    var body;

    var aside;
    var asideMenu;
    var asideMenuOffcanvas;

    var scrollTop;

    var pageStickyPortlet;

    // Aside
    var initAside = function() {
        aside = KUtil.get('k_aside');
        
        // Init offcanvas layout for mobile
        asideMenuOffcanvas = new KOffcanvas('k_aside', {
            baseClass: 'k-aside',
            overlay: true,
            closeBy: 'k_aside_close_btn',
            toggleBy: {
                target: 'k_aside_mobile_toggler',
                state: 'k-header-mobile__toolbar-toggler--active'
            }
        });

        // Init aside menu
        var menu = KUtil.get('k_aside_menu');
        var menu = KUtil.getByID('k_aside_menu');
        var menuDesktopMode = (KUtil.attr(menu, 'data-kmenu-dropdown') === '1' ? 'dropdown' : 'accordion');

        // Init scrollable menu container
        var scroll;
        if (KUtil.attr(menu, 'data-kmenu-scroll') === '1') {
            scroll = {
                height: function() {
                    // calculated height
                    var height;

                    // window height
                    var windowHeight = parseInt(KUtil.getViewPort().height);
                    
                    // secondary
                    var secondary = KUtil.find(aside, '.k-aside__secondary');
                    var secondaryPaddingTop = parseInt(KUtil.css(secondary, 'padding-top'));
                    var secondaryPaddingBottom = parseInt(KUtil.css(secondary, 'padding-bottom'));

                    // top height
                    var top = KUtil.find(aside, '.k-aside__secondary-top');
                    var topHeight = parseInt(KUtil.height(top));

                    // bottom
                    var bottom = KUtil.find(aside, '.k-aside__secondary-bottom');
                    var bottomPaddingTop = parseInt(KUtil.css(bottom, 'padding-top'));
                    var bottomPaddingBotton = parseInt(KUtil.css(bottom, 'padding-bottom'));

                    // calculate height
                    height = windowHeight - topHeight - bottomPaddingTop - bottomPaddingBotton - secondaryPaddingTop - secondaryPaddingBottom;
                    
                    return height;
                }
            };
        }

        // Init aside menu
        asideMenu = new KMenu('k_aside_menu', {
            // vertical scroll
            scroll: scroll,

            // submenu setup
            submenu: {
                desktop: {
                    // by default the menu mode set to accordion in desktop mode
                    default: menuDesktopMode,
                    // whenever body has this class switch the menu mode to dropdown
                    state: {
                        body: 'k-aside--minimize',
                        mode: 'dropdown'
                    }
                },
                tablet: 'accordion', // menu set to accordion in tablet mode
                mobile: 'accordion' // menu set to accordion in mobile mode
            },

            //accordion setup
            accordion: {
                expandAll: false // allow having multiple expanded accordions in the menu
            }
        });
    }

    // Scrolltop
    var initScrolltop = function() {
        var scrolltop = new KScrolltop('k_scrolltop', {
            offset: 300,
            speed: 600
        });
    }

    // Init page sticky portlet
    var initPageStickyPortlet = function() {
        var asidePrimaryWidth = 70;
        var asideSecondaryWidth = 250;

        return new KPortlet('k_page_portlet', {
            sticky: {
                offset: 80,
                zIndex: 90,
                position: {
                    top: function() {
                        var h = 0;

                        if (KUtil.isInResponsiveRange('desktop')) {
                            if (KUtil.hasClass(body, 'k-subheader--fixed')) {
                                h = h + parseInt(KUtil.css( KUtil.get('k_subheader'), 'height') );
                            }
                        } else {
                            if (KUtil.hasClass(body, 'k-header-mobile--fixed')) {
                                h = h + parseInt(KUtil.css( KUtil.get('k_header_mobile'), 'height') );
                            }
                        }    
                        
                        return h;                        
                    },
                    left: function() {
                        var left = 0;

                        if (KUtil.isInResponsiveRange('desktop')) {
                            if (KUtil.hasClass(body, 'k-aside--secondary-enabled')) {
                                left += asidePrimaryWidth + asideSecondaryWidth;
                            } else {
                                left += asidePrimaryWidth;
                            }
                        }

                        left += parseInt(KUtil.css(KUtil.getByClass('k-content'), 'paddingLeft'));
                        left += parseInt(KUtil.css(body, 'paddingRight'));

                        return left; 
                    },
                    right: function() {
                        var right = 0;

                        if (KUtil.isInResponsiveRange('desktop')) {
                            return parseInt(KUtil.css(body, 'paddingRight'));
                        } else {
                            return parseInt(KUtil.css(KUtil.getByClass('k-content'), 'paddingRight'));
                        }

                        return right;
                    }
                }
            }
        });
    }

    return {
        init: function() {
            body = KUtil.getByTag('body');

            this.initAside();
            this.initScrolltop();
            this.initPageStickyPortlet();

            // Non functional links notice(can be removed in production)
            $('#k_aside_menu').on('click', '.k-menu__link[href="#"]', function(e) {
                swal("", "You have clicked on a non-functional dummy link!");

                e.preventDefault();
            });
        },

        initAside: function() { 
            initAside();
        },

        initScrolltop: function() { 
            initScrolltop();
        },

        initPageStickyPortlet: function() {
            if (!KUtil.get('k_page_portlet')) {
                return;
            }
            
            pageStickyPortlet = initPageStickyPortlet();
            pageStickyPortlet.initSticky();
            
            KUtil.addResizeHandler(function(){
                pageStickyPortlet.updateSticky();
            });

            initPageStickyPortlet();
        },

        getAsideMenu: function() {
            return asideMenu;
        },

        closeMobileAsideMenuOffcanvas: function() {
            if (KUtil.isMobileDevice()) {
                asideMenuOffcanvas.hide();
            }
        },

        closeMobileHeaderMenuOffcanvas: function() {
            if (KUtil.isMobileDevice()) {
                headerMenuOffcanvas.hide();
            }
        }
    };
}();

// Init on page load completed
KUtil.ready(function() {
    KLayout.init();
});