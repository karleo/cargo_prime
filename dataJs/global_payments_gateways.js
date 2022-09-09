
"use strict";
$(function () {
    cdp_load(1);
});




//Cargar datos AJAX
function cdp_load(page) {
    var search = $("#search").val();
    var gateway = $("#gateway").val();
    var parametros = {
        "page": page,
        'search': search,
        'gateway': gateway
    };
    $("#loader").fadeIn('slow');
    $.ajax({
        url: './ajax/global_payments_gateways_ajax.php',
        data: parametros,
        beforeSend: function (objeto) { },
        success: function (data) {
            $(".outer_div").html(data).fadeIn('slow');
        }
    })
}