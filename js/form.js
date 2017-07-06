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
    $('#form').submit(function (e) {
        e.preventDefault();
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