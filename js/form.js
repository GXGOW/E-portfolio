try {
    window.$.validate = window.jQuery.validate = require('jquery-validation');
} catch (e) {
}
var errors;

function getMessages() {
    $.ajax({
        url: "php/validationMsg.php",
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            errors = data;
            initForm();
        }
    });
}

function initForm() {
    $('#form').ajaxForm();
    $('#form').submit(function (e) {
        e.preventDefault();
        $(this).ajaxSubmit({
            url: '../php/form.php',
            type: 'post',
            success: function (data) {
                if (data !== 'success') {
                    var err;
                    switch (data) {
                        case 'err_captcha':
                            err = errors['captcha'];
                            break;
                        case 'err_email':
                            err = errors['email'];
                            break;
                        case 'err_null':
                            err = errors['required'];
                            break;
                    }
                    $('#err').append('<p class="error">' + err + '</p>');
                }
                $('#err').fadeOut(500);
                $('#form').fadeOut(500, function () {
                    $('#content').empty();
                    $('#content').append('<p class="success">Het formulier werd met succes ingediend!</p>');
                    $('.success').fadeIn(500);
                });
            }
        });
    });
    $(function () {
        $("#form").validate({
            rules: {
                naam: {
                    required: true,
                    minLength: 2
                },
                voornaam: {
                    required: true,
                    minLength: 2
                },
                email: {
                    required: true,
                    email: true
                },
                onderwerp: {
                    required: true,
                    minlength: 3
                },
                bericht: {
                    required: true,
                    minlength: 20
                }
            },
            messages: {
                naam: {
                    required: errors['required'],
                    minlength: errors['minlengthLN']
                },
                voornaam: {
                    required: errors['required'],
                    minlength: errors['minlengthFN']
                },
                email: errors['email'],
                onderwerp: errors['required'],
                bericht: errors['required']
            }
        })
    })
};