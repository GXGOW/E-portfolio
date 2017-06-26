window.$.validate = window.jQuery.validate = require('jquery-validation');
var requiredmessage = "Gelieve dit veld in te vullen";

if($('#form').length) {
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
                    required: requiredmessage,
                    minlength: "Gelieve een geldige naam in te vullen"
                },
                voornaam: {
                    required: requiredmessage,
                    minlength: "Gelieve een geldige voornaam in te vullen"
                },
                email: "Gelieve een geldig e-mailadres in te vullen",
                onderwerp: requiredmessage,
                bericht: requiredmessage
            }
        })
    })
};