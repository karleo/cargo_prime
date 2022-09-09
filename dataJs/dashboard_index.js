
"use strict";

$(function () {

    cdp_load(1);


});


//Cargar datos AJAX
function cdp_load(page) {


    var search = $('#search_shipment').val();
    var parametros = { "page": page, "search": search };
    $("#loader").fadeIn('slow');
    $.ajax({
        url: './ajax/dashboard/shipments/load_shipments_ajax.php',
        data: parametros,
        beforeSend: function (objeto) {
        },
        success: function (data) {
            $(".results_shipments").html(data).fadeIn('slow');
        }
    })
}
 