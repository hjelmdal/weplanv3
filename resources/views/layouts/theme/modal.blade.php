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
<div class="modal-loading">
    @hasSection('form-action')
        <form data-action="@yield("form-action")" data-callback="@yield("callback",$_SERVER['PHP_SELF'])" role="form" id="modalForm" @hasSection("refresh") data-refresh="@yield("refresh")" @endif @hasSection("modal-id") data-modal="@yield("modal-id")" @endif class="m-form" enctype="application/json" method="POST">
            @endif
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">@yield("title")</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>


            <div class="modal-body">
                <div id="scrollbox" class="m-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-height="200">
                    @yield("content")
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">@yield("close","Luk")</button>
                @hasSection('form-action')
                    <button id="modalSubmit" type="submit" class="btn @hasSection("submit-color") btn-@yield("submit-color")@else btn-primary @endif btn-submit">@yield("submit","OK")
                    </button>
                @endif
            </div>
        </form>
</div>
@yield("scripts")
@hasSection("form-action")
    <script>
        $(function() {
            function submitLoader(e) {
                if(e == "on") {
                    $("#modalForm #modalSubmit").prop("disabled", true).addClass("m-loader m-loader--right m-loader--light");
                } else if(e == "off") {
                    $("#modalForm #modalSubmit").prop("disabled", false).removeClass("m-loader m-loader--right m-loader--light");
                }
            }
            $('#modalForm').submit(function (e) {
                e.preventDefault();
                var modal = "#modal";
                if($(this).attr("data-modal")) {
                    modal = $(this).attr("data-modal");
                }
                data = $(this).serialize();
                console.log("data:" + data);
                var callback = $(this).attr("data-callback");
                var refresh = $("#modalForm").data("refresh");
                console.log("refresh method from modal: " + refresh);
                submitLoader("on");
                mApp.block(modal +' .modal-loading', {
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
                        swal({
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
                        mApp.unblock(modal +' .modal-loading');
                        submitLoader("off");




                    },
                    success: function (data, status, xhr) {
                        console.log(data);
                        if (data && data.message) {
                            var successMsg = data.message;
                        } else {
                            var successMsg = "Done";
                        }
                        mApp.unblock(modal + ' .modal-content');
                        swal({
                            position: 'top',
                            type: 'success',
                            title: successMsg,
                            showConfirmButton: false,
                            timer: 1000
                        });
                        $('#modal_confirm').modal('hide');
                        $(modal).modal('hide');
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
                    }
                });
            });
        });
        if($(".m_selectpicker").length) {
            $(".m_selectpicker").selectpicker();
        }


    </script>
@endif
