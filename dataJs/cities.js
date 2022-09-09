"use strict";

$(function () {
    cdp_load(1);
    cdp_load_countries();
    cdp_load_states();
});

function cdp_load_countries() {

    $("#country").select2({
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
        minimumInputLength: 2,
        placeholder: "Search country",
        allowClear: true
    }).on('change', function (e) {

        var country = $("#country").val();

        $("#state").attr("disabled", true);
        $("#state").val(null);

        if (country != null) {
            $("#state").attr("disabled", false);
        }

        cdp_load_states();
    });
}

function cdp_load_states() {
    var country = $("#country").val();

    $("#state").select2({
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
        minimumInputLength: 2,
        placeholder: "Search state",
        allowClear: true
    });
}



//Cargar datos AJAX
function cdp_load(page) {
    var search = $("#search").val();
    var parametros = { "page": page, 'search': search };
    $("#loader").fadeIn('slow');
    $.ajax({
        url: './ajax/locations/cities/cities_list_ajax.php',
        data: parametros,
        beforeSend: function (objeto) {
        },
        success: function (data) {
            $(".outer_div").html(data).fadeIn('slow');
        }
    })
}


//cdp_eliminar
function cdp_eliminar(id) {

    var parent = $('#item_' + id).parent().parent();
    var name = $(this).attr('data-rel');
    new Messi('<p class="messi-warning"><i class="icon-warning-sign icon-3x pull-left"></i>Are you sure you want to delete this record?<br /><strong>This action cannot be undone!!!</strong></p>', {
        title: 'Delete country',
        titleClass: '',
        modal: true,
        closeButton: true,
        buttons: [{
            id: 0,
            label: 'Delete',
            class: '',
            val: 'Y'
        }],
        callback: function (val) {
            if (val === 'Y') {
                $.ajax({
                    type: 'post',
                    url: './ajax/locations/cities/cities_delete_ajax.php',
                    data: {
                        'id': id,
                    },
                    beforeSend: function () {
                        parent.animate({
                            'backgroundColor': '#FFBFBF'
                        }, 400);
                    },
                    success: function (data) {

                        $('html, body').animate({
                            scrollTop: 0
                        }, 600);
                        $('#resultados_ajax').html(data);

                        cdp_load(1);
                    }
                });
            }
        }

    });
}
//Registro de datos

$("#save_data").on('submit', function (event) {
    var parametros = $(this).serialize();

    $.ajax({
        type: "POST",
        url: "ajax/locations/cities/cities_add_ajax.php",
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



$("#update_data").on('submit', function (event) {
    var parametros = $(this).serialize();

    $.ajax({
        type: "POST",
        url: "ajax/locations/cities/cities_edit_ajax.php",
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


