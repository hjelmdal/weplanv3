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