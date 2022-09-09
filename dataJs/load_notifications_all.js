"use strict";


$(function () {


    cdp_load_notifications();

});


const intervalMe = setInterval(cdp_load_notifications, 25000);


//Cargar datos AJAX
function cdp_load_notifications() {

    var currentScroll = $('#currentScroll').val();

    $.ajax({
        url: './ajax/load_notifications.php',
        beforeSend: function (objeto) {
        },
        success: function (data) {

            $("#ajax_response").html(data).fadeIn('slow');

            var scrollHeight = $('#messages').prop('scrollHeight');

            $('#messages').scrollTop(currentScroll);


        }
    })
}
