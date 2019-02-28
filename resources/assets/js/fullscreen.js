document.addEventListener("DOMContentLoaded", function () {

    function initLoading() {
        $(".k-grid--root").fadeOut('slow');
        $("body").addClass('k-page--loading fadeIn animated');

        console.log("added preloading");
    }
    $("body").on('click',function () {
        if($(this).attr('data-preload') === "true") {
            initLoading();
        }
    });
    ;(function($) {


        //extend the jQuery object, adding $.stayInWebApp() as a function
        $.extend({
            stayInWebApp: function(selector) {
                //detect iOS full screen mode
                if(("standalone" in window.navigator) && window.navigator.standalone) {
                    console.log("fullscreen mode active...");
                    //if the selector is empty, default to all links
                    if(!selector) {
                        selector = 'a';
                    }
                    //bind to the click event of all specified elements
                    $("body").delegate(selector,"click",function(event) {
                        console.log("element found...");
                        //TODO: execute all other events if this element has more bound events
                        /* NEEDS TESTING
                         for(i = 0; i < $(this).data('events'); i++) {
                         console.log($(this).data('events'));
                         }
                         */

                        //only stay in web app for links that are set to _self (or not set)
                        //EDIT: ignore links with data-toggle set to modal
                        if($(this).attr("data-fullscreen") === "true")  {
                            //prevent default behavior (opening safari)
                            event.preventDefault();
                            console.log("Link catched...");
                            //get the destination of the link clicked
                            var dest = $(this).attr("href");

                            //initLoading();
                            self.location = dest;


                        } else {
                            console.log("Link passed through...");
                        }
                    });
                } else { // Add Loading on not fullscreen
                    console.log("Not full screen...");
                    if(!selector) {
                        selector = 'a';
                    }
                    //bind to the click event of all specified elements
                    $("body").delegate(selector,"click",function(event) {
                        if($(this).attr("data-fullscreen") === "true")  {
                            //prevent default behavior (opening safari)
                            event.preventDefault();
                            console.log("Link catched...");
                            //get the destination of the link clicked
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
    })( jQuery );

    $(function() {
        $.stayInWebApp();
    });


});