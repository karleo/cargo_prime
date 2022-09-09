
"use strict";



var errorMsg = document.querySelector("#error-msg");
var validMsg = document.querySelector("#valid-msg");

// here, the index maps to the error code returned from getValidationError - see readme
var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];


var input = document.querySelector("#phone_custom");
var iti = window.intlTelInput(input, {

    geoIpLookup: function (callback) {
        $.get("http://ipinfo.io", function () { }, "jsonp").always(function (resp) {
            var countryCode = (resp && resp.country) ? resp.country : "";
            callback(countryCode);
        });
    },
    // hiddenInput: "full_number",
    initialCountry: "auto",
    nationalMode: true,

    separateDialCode: true,
    utilsScript: "assets/js/input-js/utils.js",
});




var reset = function () {
    input.classList.remove("error");
    errorMsg.innerHTML = "";
    errorMsg.classList.add("hide");
    validMsg.classList.add("hide");
};

// on blur: validate
input.addEventListener('blur', function () {
    reset();
    if (input.value.trim()) {

        if (iti.isValidNumber()) {

            $('#phone').val(iti.getNumber());

            validMsg.classList.remove("hide");

        } else {

            input.classList.add("error");
            var errorCode = iti.getValidationError();
            errorMsg.innerHTML = errorMap[errorCode];
            errorMsg.classList.remove("hide");

        }
    }
});

// on keyup / change flag: reset
input.addEventListener('change', reset);
input.addEventListener('keyup', reset);


//Registro de datos

$("#edit_user").on('submit', function (event) {

    if (iti.isValidNumber()) {

        $('#save_data').attr("disabled", true);
        var parametros = $(this).serialize();
        var vehiclecode = $('#vehiclecode').val();
        var enrollment = $('#enrollment').val();
        var inputFileImage = document.getElementById("avatar");
        var username = $('#username').val();
        var email = $('#email').val();
        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var notes = $('#notes').val();
        var phone = $('#phone').val();
        var gender = $('#gender').val();
        var locker = $('#locker').val();
        var password = $('#password').val();
        var notify = $('#notify:checked').val();
        var active = $('input:radio[name=active]:checked').val();
        var newsletter = $('input:radio[name=newsletter]:checked').val();
        var id = $('#id').val();


        var file = inputFileImage.files[0];
        var data = new FormData();

        data.append('enrollment', enrollment);
        data.append('vehiclecode', vehiclecode);
        data.append('avatar', file);
        data.append('locker', locker);
        data.append('username', username);
        data.append('password', password);
        data.append('fname', fname);
        data.append('lname', lname);
        data.append('email', email);
        data.append('phone', phone);
        data.append('gender', gender);
        data.append('active', active);
        data.append('newsletter', newsletter);
        data.append('notes', notes);
        data.append('notify', notify);
        data.append('id', id);

        $.ajax({

            type: "POST",
            url: "ajax/drivers/drivers_edit_ajax.php",
            data: data,
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData: false,
            beforeSend: function (objeto) {
                $("#resultados_ajax").html("Send...");
            },
            success: function (datos) {
                $("#resultados_ajax").html(datos);
                $('#save_data').attr("disabled", false);

                $('html, body').animate({
                    scrollTop: 0
                }, 600);

            }
        });

    } else {

        input.classList.add("error");
        var errorCode = iti.getValidationError();
        errorMsg.innerHTML = errorMap[errorCode];
        errorMsg.classList.remove("hide");

    }



    event.preventDefault();

})

