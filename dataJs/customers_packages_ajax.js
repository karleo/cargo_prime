"use strict";

var count = 0;

$(".sl-all").on('click', function () {

    $('.custom-table-checkbox input:checkbox').not(this).prop('checked', this.checked);

    if ($('.custom-table-checkbox input:checkbox').is(':checked')) {

        $('.custom-table-checkbox').find('tr > td:first-child').find('input[type=checkbox]').parents('tr').css('background', '#fff8e1');

    } else {

        $('.custom-table-checkbox input:checkbox').parents('tr').css('background', '');

    }

    var $checkboxes = $('.custom-table-checkbox').find('tr > td:first-child').find('input[type=checkbox]');

    count = $checkboxes.filter(':checked').length;

    if (count > 0) {

        $('#div-actions-checked').removeClass('hide');
        $('#countChecked').removeClass('hide');

    } else {

        $('#div-actions-checked').addClass('hide');
        $('#countChecked').addClass('hide');
    }

    $('#countChecked').html("Selected: " + count);


});



$('.custom-table-checkbox').find('tr > td:first-child').find('input[type=checkbox]').on('change', function () {

    if ($(this).is(':checked')) {

        $(this).parents('tr').css('background', '#fff8e1');

    } else {

        $(this).parents('tr').css('background', '');
    }


});




$(function () {

    var $checkboxes = $('.custom-table-checkbox').find('tr > td:first-child').find('input[type=checkbox]');

    $checkboxes.on('change', function () {

        count = $checkboxes.filter(':checked').length;

        if (count > 0) {

            $('#div-actions-checked').removeClass('hide');
            $('#countChecked').removeClass('hide');

        } else {

            $('#div-actions-checked').addClass('hide');
            $('#countChecked').addClass('hide');
        }


        $('#countChecked').html("Selected: " + count);

    });

});




$("#send_checkbox_status").on('submit', function (event) {

    $('#guardar_datos').attr("disabled", true);

    var parametros = $(this).serialize();
    var checked_data = new Array();
    $('.custom-table-checkbox').find('tr > td:first-child').find('input[type=checkbox]:checked').each(function () {
        checked_data.push($(this).val());
    });

    var status = $('#status_courier_modal').val();

    $.ajax({
        type: "GET",
        url: './ajax/customers_packages/customers_packages_update_multiple_ajax.php?status=' + status,

        data: { 'checked_data': JSON.stringify(checked_data) },
        beforeSend: function (objeto) {
            $(".resultados_ajax").html("Mensaje: Cargando...");
        },
        success: function (datos) {
            $("#resultados_ajax").html(datos);
            $('#guardar_datos').attr("disabled", false);
            $('#modalCheckboxStatus').modal('hide');


            cdp_load(1);

            $('#div-actions-checked').addClass('hide');
            $('#countChecked').addClass('hide');
            $('html, body').animate({
                scrollTop: 0
            }, 600);


        }
    });
    event.preventDefault();

})
//cdp_eliminar
function cdp_printMultipleLabel() {

    var checked_data = new Array();
    $('.custom-table-checkbox').find('tr > td:first-child').find('input[type=checkbox]:checked').each(function () {
        checked_data.push($(this).val());
    });

    var name = $(this).attr('data-rel');
    new Messi('<b></i>Are you sure to print ' + count + ' selected records ?</b>', {
        title: 'Print packages Label',
        titleClass: '',
        modal: true,
        closeButton: true,
        buttons: [{
            id: 0,
            label: 'Print',
            class: '',
            val: 'Y'
        }],
        callback: function (val) {

            if (val === 'Y') {

                window.open('print_label_package_multiple.php?data=' + JSON.stringify(checked_data), "_blank");

            }
        }

    });
}




$("#driver_update_multiple").on('submit', function (event) {

    $('#update_driver2').attr("disabled", true);

    var parametros = $(this).serialize();
    var checked_data = new Array();
    $('.custom-table-checkbox').find('tr > td:first-child').find('input[type=checkbox]:checked').each(function () {
        checked_data.push($(this).val());
    });

    var driver = $('#driver_id_multiple').val();

    $.ajax({
        type: "GET",
        url: './ajax/customers_packages/customers_packages_update_driver_multiple_ajax.php?driver=' + driver,

        data: { 'checked_data': JSON.stringify(checked_data) },
        beforeSend: function (objeto) {
            $(".resultados_ajax").html("Mensaje: send...");
        },
        success: function (datos) {
            $("#resultados_ajax").html(datos);
            $('#update_driver2').attr("disabled", false);
            $('#modalDriverCheckbox').modal('hide');


            cdp_load(1);

            $('#div-actions-checked').addClass('hide');
            $('#countChecked').addClass('hide');
            $('html, body').animate({
                scrollTop: 0
            }, 600);


        }
    });
    event.preventDefault();

})