"use strict";

$(function () {
    $("#main-wrapper").AdminSettings({
        Theme: false, // this can be true or false ( true means dark and false means light ),
        Layout: 'vertical',
        LogoBg: 'skin6', // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6 
        NavbarBg: 'skin1', // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6
        SidebarType: 'mini-sidebar', // You can change it full / mini-sidebar / iconbar / overlay
        SidebarColor: 'skin6', // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6
        SidebarPosition: true, // it can be true / false ( true means Fixed and false means absolute )
        HeaderPosition: true, // it can be true / false ( true means Fixed and false means absolute )
        BoxedLayout: false, // it can be true / false ( true means Boxed and false means Fluid ) 
    });

    cdp_load_countries_origin();
    cdp_load_countries_destiny();

    cdp_load_states();
    cdp_load_cities();
});

function cdp_load_countries_origin() {

    $("#country_origin").select2({
        ajax: {
            url: "ajax/select2_countries.php",
            dataType: 'json',

            delay: 250,
            data: function (params) {
                return {
                    q: params.term // search term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        },
        placeholder: "Search country",
        allowClear: true
    });
}

function cdp_load_countries_destiny() {

    $("#country_destiny").select2({
        ajax: {
            url: "ajax/select2_countries.php",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term // search term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        },
        placeholder: "Search country",
        allowClear: true
    }).on('change', function (e) {

        var country = $("#country_destiny").val();
        $("#state_destinystates").attr("disabled", true);
        $("#state_destinystates").val(null);

        $("#city_destinycities").attr("disabled", true);
        $("#city_destinycities").val(null);

        if (country !== null) {
            $("#state_destinystates").attr("disabled", false);
        }

        cdp_load_cities();
        cdp_load_states();
    });
}

function cdp_load_states() {
    var country = $("#country_destiny").val();

    $("#state_destinystates").select2({
        ajax: {
            url: "ajax/select2_states.php?id=" + country,
            dataType: 'json',

            delay: 250,
            data: function (params) {
                return {
                    q: params.term // search term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        },
        placeholder: "Search state",
        allowClear: true
    }).on('change', function (e) {

        var state = $("#state_destinystates").val();

        $("#city_destinycities").attr("disabled", true);
        $("#city_destinycities").val(null);

        if (state !== null) {
            $("#city_destinycities").attr("disabled", false);
        }

        cdp_load_cities();
    });
}

function cdp_load_cities() {
    var state = $("#state_destinystates").val();

    $("#city_destinycities").select2({
        ajax: {
            url: "ajax/select2_cities.php?id=" + state,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term // search term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        },
        placeholder: "Search city",
        allowClear: true
    });
}

$("#save_data").on('submit', function (event) {
    var parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "ajax/tools/ship_tariffs/ship_tariffs_edit_ajax.php",
        data: parametros,
        beforeSend: function (objeto) {
            $("#resultados_ajax").html("Please wait...");
        },
        success: function (datos) {
            $("#resultados_ajax").html(datos);

            $('html, body').animate({
                scrollTop: 0
            }, 600);
        }
    });
    event.preventDefault();
})

document.getElementById("initial_range").addEventListener("keypress", onlyValidNumber);

document.getElementById("final_range").addEventListener("keypress", onlyValidNumber);

document.getElementById("tariff_price").addEventListener("keypress", onlyValidNumber);

function onlyValidNumber(event) {
    if (event.charCode < 46 || event.charCode > 57) {
        event.preventDefault();
    }
}