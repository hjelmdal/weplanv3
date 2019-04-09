/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/custom.js":
/*!***************************************!*\
  !*** ./resources/assets/js/custom.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

document.addEventListener("DOMContentLoaded", function () {
  $('#link_facebook').click(function () {
    var btn = $(this);
    btn.addClass('kt-spinner kt-spinner--right kt-spinner--md kt-spinner--light');
  });
  $('#link_google').click(function () {
    var btn = $(this);
    btn.addClass('kt-spinner kt-spinner--right kt-spinner--md kt-spinner--light');
  });
  $('#kt_login_submit').click(function (e) {
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    form.validate({
      rules: {
        email: {
          required: true,
          email: true
        },
        password: {
          required: true
        }
      }
    });

    if (!form.valid()) {
      return;
    }

    btn.addClass('kt-spinner kt-spinner--right kt-spinner--md kt-spinner--light').attr('disabled', true);
    form.submit();
  });
  $('#kt_signup_submit').click(function (e) {
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    form.validate({
      rules: {
        fullname: {
          required: true
        },
        email: {
          required: true,
          email: true
        },
        password: {
          required: true
        },
        rpassword: {
          required: true
        },
        agree: {
          required: true
        }
      }
    });

    if (!form.valid()) {
      return;
    }

    btn.addClass('kt-spinner kt-spinner--right kt-spinner--md kt-spinner--light').attr('disabled', true);
    form.submit();
  });
  $('#kt_forgot_submit').click(function (e) {
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    form.validate({
      rules: {
        email: {
          required: true,
          email: true
        }
      }
    });

    if (!form.valid()) {
      return;
    }

    btn.addClass('kt-spinner kt-spinner--right kt-spinner--md kt-spinner--light').attr('disabled', true);
    form.submit();
  });
  $('#kt_signup').click(function (e) {
    e.preventDefault();
    $('#kt_forgot_form').css("display", "none");
    $('#kt_login_form').css("display", "none");
    $('#kt_signup_form').css("display", "block");
    $('#kt_signup_form').addClass('flipInX animated');
  });
  $('#kt_forgot').click(function (e) {
    e.preventDefault();
    $('#kt_login_form').css("display", "none");
    $('#kt_signup_form').css("display", "none");
    $('#kt_forgot_form').css("display", "block");
    $('#kt_forgot_form').addClass('flipInX animated');
  });
  $('.kt_login_cancel').click(function (e) {
    e.preventDefault();
    $('#kt_forgot_form').css("display", "none");
    $('#kt_signup_form').css("display", "none");
    $('#kt_login_form').css("display", "block");
    $('#kt_login_form').addClass('flipInX animated');
  }); // V2

  $('#kt_signup2').click(function (e) {
    e.preventDefault();
    $('#kt_forgot_form2').css("display", "none");
    $('#kt_login_form2').css("display", "none");
    $('#kt_signup_form2').css("display", "flex");
    $('#kt_signup_form2').addClass('flipInX animated');
  });
  $('#kt_forgot2').click(function (e) {
    e.preventDefault();
    $('#kt_login_form2').css("display", "none");
    $('#kt_signup_form2').css("display", "none");
    $('#kt_forgot_form2').css("display", "flex");
    $('#kt_forgot_form2').addClass('flipInX animated');
  });
  $('.kt_login_cancel2').click(function (e) {
    e.preventDefault();
    $('#kt_forgot_form2').css("display", "none");
    $('#kt_signup_form2').css("display", "none");
    $('#kt_login_form2').css("display", "flex");
    $('#kt_login_form2').addClass('flipInX animated');
  });
  $("#toggle_aside_mobile").on("click", function () {
    $("#kt_aside_toggler").trigger("click");
  });
});
document.addEventListener("DOMContentLoaded", function (event) {
  //Tabs loading
  $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
    var url = $(this).attr("href"); // the remote url for content

    var target = $(this).data("target"); // the target pane

    var tab = $(this); // this tab
    // ajax load from data-url

    $(target).load(url, function (result) {
      tab.tab('show');
      KTApp.unblock('#portlet .m-portlet__body');
    });
    KTApp.block('#portlet .m-portlet__body', {
      overlayColor: '#000000',
      type: 'loader',
      state: 'primary',
      message: 'Processing...',
      opacity: '0.3'
    });
  }); // Modals

  $('body').on('click', '[data-toggle="modal"]', function (e) {
    e.preventDefault();
    var ref = $(this).data("target");
    console.log("target: " + ref);
    var hrefLink = $(this).attr("href");
    console.log("href:" + hrefLink);
    console.log($(this).attr("data-action"));
    $("#modalUser").val($(this).data("user"));
    $("#modalForm").attr("data-action", $(this).data("action"));

    if (hrefLink && hrefLink.charAt(0) != "#") {
      setTimeout(function () {
        KTApp.block(ref + ' .modal-content', {
          overlayColor: '#fff',
          type: 'loader',
          state: 'primary',
          message: 'Processing...',
          opacity: '0.9'
        });
      }, 200);
      $(ref + ' .modal-content').load(hrefLink, function (response, status, xhr) {
        //console.log(xhr);
        //console.log("response " + response);
        //console.log("status " + status);
        if (response.startsWith("<!DOCTYPE html")) {
          $(ref + ' .modal-content').empty();
          swal({
            position: 'top',
            type: 'warning',
            title: "Session expired - reloading page",
            showConfirmButton: false,
            timer: 1000
          });
          window.location.reload();
        } else if (status == "success") {
          console.log("Content loaded...");
          setTimeout(function () {
            KTApp.unblock(ref + ' .modal-content');
          }, 200);
        }
      });
      console.log("href2: " + hrefLink);
      setTimeout(function () {
        KTApp.unblock(ref + ' .modal-content');
        console.log("Modal ready...");
      }, 1000);
    }
  });
  $('body').on('click', '[data-toggle="same"]', function (e) {
    e.preventDefault();
    var hrefLink = $(this).attr("href");
    $($(this).data("target") + ' .modal-content').load(hrefLink);
  });
  $('#modalForm').submit(function (e) {
    e.preventDefault();
    data = $(this).serialize();
    console.log("data:" + data);
    var callback = $(this).attr("data-callback");
    console.log("callback url:" + callback);
    $("#modalForm #modalSubmit").prop("disabled", true).addClass("m-loader m-loader--right m-loader--light");
    var refresh = $("#modalForm").data("refresh");
    console.log("refresh method: " + refresh);
    $.ajax({
      url: $(this).attr("data-action"),
      type: "POST",
      dataType: "json",
      data: data,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        "Authorization": $('meta[name="api-token"]').attr('content')
      },
      error: function error(data, status) {
        if (data.responseJSON.message) {
          var errorMsg = data.responseJSON.message;
        } else {
          var errorMsg = "No message";
        }

        if (typeof errorMsg == 'string') {
          errorMsg = errorMsg;
        } else {
          errorMsg = "An error occured";
        }

        swal({
          position: 'center',
          type: 'error',
          title: errorMsg,
          showConfirmButton: false,
          timer: 1000
        });
        console.log("Error: ", data + ". Status: " + status);
        console.log($('meta[name="csrf-token"]').attr('content'));
      },
      success: function success(data, status, xhr) {
        console.log(data);

        if (data.message) {
          var successMsg = data.message;
        } else {
          var successMsg = "No message";
        }

        swal({
          position: 'center',
          type: 'success',
          title: successMsg,
          showConfirmButton: false,
          timer: 1000
        });
        setTimeout(function () {
          $('#modal_confirm').modal('hide');
          $('#modal').modal('hide');
        }, 800);

        if (refresh) {
          refresh;
          console.log("Refresh method fired...");
        } else {
          $("body").addClass('m-page--loading');
          window.location.href = callback;
          console.log("success data:", data, "StatusCode:", xhr.status, "callback:", callback);
        }
      }
    });
  });
  $(function () {
    $('[data-toggle="tooltip"]').tooltip();
  });
});

/***/ }),

/***/ "./resources/assets/sass/custom.scss":
/*!*******************************************!*\
  !*** ./resources/assets/sass/custom.scss ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*********************************************************************************!*\
  !*** multi ./resources/assets/js/custom.js ./resources/assets/sass/custom.scss ***!
  \*********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/impact/.web/WePlanV3/resources/assets/js/custom.js */"./resources/assets/js/custom.js");
module.exports = __webpack_require__(/*! /Users/impact/.web/WePlanV3/resources/assets/sass/custom.scss */"./resources/assets/sass/custom.scss");


/***/ })

/******/ });