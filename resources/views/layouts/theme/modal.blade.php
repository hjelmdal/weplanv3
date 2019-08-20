<?php
/**
 * Created by PhpStorm.
 * User: impact
 * Date: 2019-04-08
 * Time: 22:57
 */
?>
@yield("meta")
@yield("styles")

    @hasSection('form-action')
        <form data-action="@yield("form-action")" data-keep-open="@yield("keep-open")" data-callback="@yield("callback",$_SERVER['PHP_SELF'])" role="form" id="modalForm" @hasSection("refresh") data-refresh="@yield("refresh")" @endif @hasSection("modal-id") data-modal="@yield("modal-id")" @endif class="kt-form kt-form--label-right vue-form ajax-form" enctype="application/json" method="POST">
            @csrf
            @endif
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">@yield("title")</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>


            <div id="modal1-body" class="modal-body">

                    @yield("content")


            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">@yield("close","Luk")</button>
                @hasSection('form-action')
                    <button id="modalSubmit" type="submit" class="btn @hasSection("submit-color") btn-@yield("submit-color")@else btn-primary @endif btn-submit">@yield("submit","Gem")
                    </button>
                @endif
            </div>
        </form>
@yield("scripts")
@hasSection("form-action")
    <script>

        //let submit = document.querySelector('.ajax-form').querySelector("submit");

        $(function() {


            function submitLoader(e) {
                if(e == "on") {
                    $("#modalForm #modalSubmit").prop("disabled", true).addClass("kt-loader kt-loader--right kt-loader--light");
                } else if(e == "off") {
                    $("#modalForm #modalSubmit").prop("disabled", false).removeClass("kt-loader kt-loader--right kt-loader--light");
                }
            }


            $('.ajax-form').submit(function (e) {
                e.preventDefault();
                console.log("haha");
                var modal = "#" + $(this).closest("div.modal").attr("id");
                console.log("Modal: " + modal);
                if($(this).attr("data-modal")) {
                    modal = $(this).attr("data-modal");
                }
                data = $(this).serialize();
                console.log("data:" + data);
                var callback = $(this).attr("data-callback");
                var refresh = $("#modalForm").data("refresh");
                var keepOpen = $("#modalForm").data("keep-open");
                console.log("refresh method from modal: " + refresh);
                submitLoader("on");
                KTApp.block(modal +' .modal-loading', {
                    overlayColor: '#000000',
                    type: 'loader',
                    state: 'primary',
                    message: 'Processing...',
                    opacity:'0.3',
                });

                $.ajax({
                    url: $(this).attr("data-action"),
                    type: "POST",
                    dataType: "json",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        "Authorization": $('meta[name="api-token"]').attr('content')
                    },
                    error: function (data, status,xhr) {
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
                        if(data.status == 401) {
                            errorMsg = 'Login expired - reloading';
                        }
                        swal.fire({
                            position: 'top',
                            type: 'error',
                            title: errorMsg,
                            showConfirmButton: false,
                            timer: 1000
                        });
                        if(data.status == 401) {
                            window.location.reload();
                        }

                        console.log("error", errorMsg + ". Status: " + xhr.status);
                        console.log($('meta[name="csrf-token"]').attr('content'));
                        KTApp.unblock(modal +' .modal-loading');
                        submitLoader("off");




                    },
                    success: function (data, status, xhr) {
                        console.log(data);
                        if (data && data.message) {
                            var successMsg = data.message;
                        } else {
                            var successMsg = "Done";
                        }
                        KTApp.unblock(modal + ' .modal-content');
                        swal.fire({
                            position: 'top',
                            type: 'success',
                            title: successMsg,
                            showConfirmButton: false,
                            timer: 1000
                        });
                        if(refresh) {
                            $(refresh).trigger( "click" );
                            submitLoader("off");


                            console.log(refresh + " refreshed!");
                        } else {
                            setTimeout(function () {

                                window.location.href = callback;
                            }, 800);
                            $("body").addClass('m-page--loading');
                        }
                        console.log("success data:", data, "StatusCode:", xhr.status);
                        $(modal).modal('hide');

                    }
                });
            });
        });




    </script>
@endif
