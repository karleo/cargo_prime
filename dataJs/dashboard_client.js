"use strict";

$(function () {
    cdp_load(1);
});


//Cargar datos AJAX
function cdp_load(page) {

    var parametros = { "page": page }; 
    $("#loader").fadeIn('slow');
    var user = $('#userid').val();
    $.ajax({
        url: './ajax/dashboard/shipments/load_shipments_ajax.php',
        data: parametros,
        beforeSend: function (objeto) {
        },
        success: function (data) {
            $(".outer_div").html(data).fadeIn('slow');
        }
    })
}


