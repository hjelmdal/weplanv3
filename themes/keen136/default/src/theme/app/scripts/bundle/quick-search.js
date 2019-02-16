"use strict";

var KQuickSearch = function() {
    var target;
    var form;
    var input;
    var closeIcon;
    var resultWrapper;
    var resultDropdown;
    var resultDropdownToggle;
    var inputGroup;
    var query = '';

    var hasResult = false; 
    var timeout = false; 
    var isProcessing = false;
    var requestTimeout = 200; // ajax request fire timeout in milliseconds 
    var spinnerClass = 'k-spinner k-spinner--input k-spinner--sm k-spinner--brand k-spinner--right';
    var resultClass = 'k-quick-search--has-result';
    var minLength = 2;

    var showProgress = function() {
        isProcessing = true;
        KUtil.addClass(inputGroup, spinnerClass); 

        if (closeIcon) {
            KUtil.hide(closeIcon);
        }       
    }

    var hideProgress = function() {
        isProcessing = false;
        KUtil.removeClass(inputGroup, spinnerClass);

        if (closeIcon) {
            if (input.value.length < minLength) {
                KUtil.hide(closeIcon);
            } else {
                KUtil.show(closeIcon, 'flex');
            }            
        }
    }

    var showDropdown = function() {
        if (resultDropdownToggle && !KUtil.hasClass(resultDropdown, 'show')) {
            $(resultDropdownToggle).dropdown('toggle');
            $(resultDropdownToggle).dropdown('update'); 
        }
    }

    var hideDropdown = function() {
        if (resultDropdownToggle && KUtil.hasClass(resultDropdown, 'show')) {
            $(resultDropdownToggle).dropdown('toggle');
        }
    }

    var processSearch = function() {
        if (hasResult && query === input.value) {  
            hideProgress();
            KUtil.addClass(target, resultClass);
            showDropdown();
            KUtil.scrollUpdate(resultWrapper);

            return;
        }

        query = input.value;

        KUtil.removeClass(target, resultClass);
        showProgress();
        hideDropdown();
        
        setTimeout(function() {
            $.ajax({
                url: 'inc/api/quick_search.php',
                data: {
                    query: query
                },
                dataType: 'html',
                success: function(res) {
                    hasResult = true;
                    hideProgress();
                    KUtil.addClass(target, resultClass);
                    KUtil.setHTML(resultWrapper, res);
                    showDropdown();
                    KUtil.scrollUpdate(resultWrapper);
                },
                error: function(res) {
                    hasResult = false;
                    hideProgress();
                    KUtil.addClass(target, resultClass);
                    KUtil.setHTML(resultWrapper, '<span class="k-quick-search__message">Connection error. Pleae try again later.</div>');
                    showDropdown();
                    KUtil.scrollUpdate(resultWrapper);
                }
            });
        }, 1000);       
    }

    var handleCancel = function(e) {
        input.value = '';
        query = '';
        hasResult = false;
        KUtil.hide(closeIcon);
        KUtil.removeClass(target, resultClass);
        hideDropdown();
    }

    var handleSearch = function() {
        if (input.value.length < minLength) {
            hideProgress();
            hideDropdown();

            return;
        }

        if (isProcessing == true) {
            return;
        }

        if (timeout) {
            clearTimeout(timeout);
        }

        timeout = setTimeout(function() {
            processSearch();
        }, requestTimeout);     
    }

    return {     
        init: function(element) { 
            // Init
            target = element;
            form = KUtil.find(target, '.k-quick-search__form');
            input = KUtil.find(target, '.k-quick-search__input');
            closeIcon = KUtil.find(target, '.k-quick-search__close');
            resultWrapper = KUtil.find(target, '.k-quick-search__wrapper');
            resultDropdown = KUtil.find(target, '.dropdown-menu'); 
            resultDropdownToggle = KUtil.find(target, '[data-toggle="dropdown"]');
            inputGroup = KUtil.find(target, '.input-group');           

            // Attach input keyup handler
            KUtil.addEvent(input, 'keyup', handleSearch);
            KUtil.addEvent(input, 'focus', handleSearch);

            // Prevent enter click
            form.onkeypress = function(e) {
                var key = e.charCode || e.keyCode || 0;     
                if (key == 13) {
                    e.preventDefault();
                }
            }
           
            KUtil.addEvent(closeIcon, 'click', handleCancel);     
        }
    };
};

var KQuickSearchMobile = KQuickSearch;

$(document).ready(function() {
    if (KUtil.get('k_quick_search_dropdown')) {
        KQuickSearch().init(KUtil.get('k_quick_search_dropdown'));
    }

    if (KUtil.get('k_quick_search_inline')) {
        KQuickSearchMobile().init(KUtil.get('k_quick_search_inline'));
    }

    if (KUtil.get('k_quick_search_offcanvas')) {
        KQuickSearchMobile().init(KUtil.get('k_quick_search_offcanvas'));
    }
});