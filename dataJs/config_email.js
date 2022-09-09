"use strict";

$("#save_config").on('submit', function (event) {

    var parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "ajax/tools/config_smtp_ajax.php",
        data: parametros,
        beforeSend: function (objeto) {
            $("#resultados_ajax").html("Wait a moment...");
        },
        success: function (datos) {
            $("#resultados_ajax").html(datos);

            $("html, body").animate({
                scrollTop: 0
            }, 600);

        }
    });
    event.preventDefault();

});

$(function () {
    var res2 = $('#mailer').val();
    (res2 == "SMTP") ? $('.showsmtp').show() : $('.showsmtp').hide();
    $('#mailer').change(function () {
        var res = $("#mailer option:selected").val();
        (res == "SMTP") ? $('.showsmtp').show() : $('.showsmtp').hide();
    });

});