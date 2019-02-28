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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/fullscreen.js":
/*!*******************************************!*\
  !*** ./resources/assets/js/fullscreen.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

document.addEventListener("DOMContentLoaded", function () {
  function initLoading() {
    $(".k-grid--root").fadeOut('slow');
    $("body").addClass('k-page--loading fadeIn animated');
    console.log("added preloading");
  }

  $("body").on('click', function () {
    if ($(this).attr('data-preload') === "true") {
      initLoading();
    }
  });
  ;

  (function ($) {
    //extend the jQuery object, adding $.stayInWebApp() as a function
    $.extend({
      stayInWebApp: function stayInWebApp(selector) {
        //detect iOS full screen mode
        if ("standalone" in window.navigator && window.navigator.standalone) {
          console.log("fullscreen mode active..."); //if the selector is empty, default to all links

          if (!selector) {
            selector = 'a';
          } //bind to the click event of all specified elements


          $("body").delegate(selector, "click", function (event) {
            console.log("element found..."); //TODO: execute all other events if this element has more bound events

            /* NEEDS TESTING
             for(i = 0; i < $(this).data('events'); i++) {
             console.log($(this).data('events'));
             }
             */
            //only stay in web app for links that are set to _self (or not set)
            //EDIT: ignore links with data-toggle set to modal

            if ($(this).attr("data-fullscreen") === "true") {
              //prevent default behavior (opening safari)
              event.preventDefault();
              console.log("Link catched..."); //get the destination of the link clicked

              var dest = $(this).attr("href"); //initLoading();

              self.location = dest;
            } else {
              console.log("Link passed through...");
            }
          });
        } else {
          // Add Loading on not fullscreen
          console.log("Not full screen...");

          if (!selector) {
            selector = 'a';
          } //bind to the click event of all specified elements


          $("body").delegate(selector, "click", function (event) {
            if ($(this).attr("data-fullscreen") === "true") {
              //prevent default behavior (opening safari)
              event.preventDefault();
              console.log("Link catched..."); //get the destination of the link clicked

              var dest = $(this).attr("href");
              initLoading();
              self.location = dest;
            } else {
              console.log("Link passed through...");
            }
          });
        }
      } //end stayInWebApp func

    });
  })(jQuery);

  $(function () {
    $.stayInWebApp();
  });
});

/***/ }),

/***/ 1:
/*!*************************************************!*\
  !*** multi ./resources/assets/js/fullscreen.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/hjelmdal/Pixel8/Websites/WePlan/WePlanV3/resources/assets/js/fullscreen.js */"./resources/assets/js/fullscreen.js");


/***/ })

/******/ });