document.addEventListener("DOMContentLoaded", function () {

    $('#k_login_submit').click(function (e) {
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

        btn.addClass('k-spinner k-spinner--right k-spinner--md k-spinner--light').attr('disabled', true);

        form.submit();

    });

    $('#k_signup_submit').click(function (e) {
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

        btn.addClass('k-spinner k-spinner--right k-spinner--md k-spinner--light').attr('disabled', true);
        form.submit();
    });

    $('#k_forgot_submit').click(function (e) {
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

        btn.addClass('k-spinner k-spinner--right k-spinner--md k-spinner--light').attr('disabled', true);
        form.submit();
    });

    $('#k_signup').click(function (e) {
        e.preventDefault();
        $('#k_forgot_form').css("display","none");
        $('#k_login_form').css("display","none");
        $('#k_signup_form').css("display","block");
        $('#k_signup_form').addClass('flipInX animated');
    });

    $('#k_forgot').click(function (e) {
        e.preventDefault();
        $('#k_login_form').css("display","none");
        $('#k_signup_form').css("display","none");
        $('#k_forgot_form').css("display","block");
        $('#k_forgot_form').addClass('flipInX animated');
    });

    $('.k_login_cancel').click(function (e) {
        e.preventDefault();
        $('#k_forgot_form').css("display","none");
        $('#k_signup_form').css("display","none");
        $('#k_login_form').css("display","block");
        $('#k_login_form').addClass('flipInX animated');
    });

    // V2

    $('#k_signup2').click(function (e) {
        e.preventDefault();
        $('#k_forgot_form2').css("display","none");
        $('#k_login_form2').css("display","none");
        $('#k_signup_form2').css("display","flex");
        $('#k_signup_form2').addClass('flipInX animated');
    });

    $('#k_forgot2').click(function (e) {
        e.preventDefault();
        $('#k_login_form2').css("display","none");
        $('#k_signup_form2').css("display","none");
        $('#k_forgot_form2').css("display","flex");
        $('#k_forgot_form2').addClass('flipInX animated');
    });

    $('.k_login_cancel2').click(function (e) {
        e.preventDefault();
        $('#k_forgot_form2').css("display","none");
        $('#k_signup_form2').css("display","none");
        $('#k_login_form2').css("display","flex");
        $('#k_login_form2').addClass('flipInX animated');
    });


});

document.addEventListener("DOMContentLoaded", function(event) {
    //Tabs loading
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
        var url = $(this).attr("href"); // the remote url for content
        var target = $(this).data("target"); // the target pane
        var tab = $(this); // this tab

        // ajax load from data-url
        $(target).load(url,function(result){
            tab.tab('show');
            KApp.unblock('#portlet .m-portlet__body');
        });
        KApp.block('#portlet .m-portlet__body', {
            overlayColor: '#000000',
            type: 'loader',
            state: 'primary',
            message: 'Processing...',
            opacity:'0.3',
        });
    });
    // Modals
    $('body').on('click', '[data-toggle="modal"]', function (e) {
        var ref = $(this).data("target");
        console.log("target: " + ref);
        var hrefLink = $(this).attr("href");
        console.log("href:" + hrefLink);
        console.log($(this).attr("data-action"));
        $("#modalUser").val($(this).data("user"));
        $("#modalForm").attr("data-action",$(this).data("action"));
        if (hrefLink && hrefLink.charAt(0) != "#") {
            setTimeout(function () {
                KApp.block(ref + ' .modal-content', {
                    overlayColor: '#fff',
                    type: 'loader',
                    state: 'primary',
                    message: 'Processing...',
                    opacity:'0.9',

                });

            },200);
            $(ref + ' .modal-content').load(hrefLink, function () {
                console.log("Content loaded...");
                KApp.unblock(ref);
            });
            console.log("href2: " + hrefLink);
            setTimeout(function () {
                KApp.unblock(ref);
                console.log("Modal ready...");
            },2000);
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
        $("#modalForm #modalSubmit").prop( "disabled", true ).addClass("m-loader m-loader--right m-loader--light");
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
            error: function (data, status) {
                if(data.responseJSON.message) {
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
            success: function (data, status, xhr) {
                console.log(data);
                if(data.message) {
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

                if(refresh) {
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
        $('[data-toggle="tooltip"]').tooltip()
    });
});