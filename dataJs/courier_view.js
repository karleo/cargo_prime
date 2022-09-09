"use strict";


$("#driver_update").on('submit', function (event) {
    var parametros = $(this).serialize();

    $.ajax({
        type: "POST",
        url: "ajax/courier/courier_update_driver_ajax.php",
        data: parametros,
        beforeSend: function (objeto) {
            $("#resultados_ajax").html("<img src='assets/images/loader.gif'/><br/>Wait a moment please...");
        },
        success: function (datos) {
            $("#resultados_ajax").html(datos);

            $('html, body').animate({
                scrollTop: 0
            }, 600);

            $('#modalDriver').modal('hide');

            cdp_load(1);


        }
    });
    event.preventDefault();

})


$('#modalDriver').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id_shipment = button.data('id_shipment') // Extract info from data-* attributes
    var id_sender = button.data('id_sender') // Extract info from data-* attributes
    var modal = $(this)
    $('#id_shipment').val(id_shipment)
    $('#id_senderclient_driver_update').val(id_sender)
})



$("#send_email").on('submit', function (event) {

    $('#guardar_datos').attr("disabled", true);

    var parametros = $(this).serialize();

    $.ajax({
        type: "GET",
        url: "send_email_pdf.php",
        data: parametros,
        beforeSend: function (objeto) {
            $(".resultados_ajax_mail").html("<img src='assets/images/loader.gif'/><br/>Wait a moment please...");

        },
        success: function (datos) {
            $(".resultados_ajax_mail").html(datos);
            $('#guardar_datos').attr("disabled", false);

        }
    });
    event.preventDefault();

})


$('#myModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var order = button.data('order') // Extract info from data-* attributes
    var id = button.data('id') // Extract info from data-* attributes
    var email = button.data('email') // Extract info from data-* attributes
    var modal = $(this)
    $('#subject').val("Invoice # " + order)
    $('#id').val(id)
    $('#sendto').val(email)
})





$('#charges_list').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id') // Extract info from data-* attributes
    $('#order_id').val(id);

    $(".resultados_ajax_charges_add_results").html('');

    cdp_load_charges(order_id);//Cargas los pagos 

})

function cdp_load_charges() {

    var id = $('#order_id').val();
    var parametros = { "id": id };
    $.ajax({

        url: 'ajax/accounts_receivable/charges_list_ajax.php',
        data: parametros,
        success: function (data) {
            $(".resultados_ajax_charges_list").html(data).fadeIn('slow');
        }
    });
}


$('#charges_add').on('show.bs.modal', function (event) {

    var id = $('#order_id').val();
    var parametros = { "id": id };

    $.ajax({
        url: 'ajax/accounts_receivable/modal_add_charges.php',
        data: parametros,
        success: function (data) {
            $(".resultados_ajax_add_modal").html(data).fadeIn('slow');
        }
    });
})





$("#add_charges").on('submit', function (event) {
    var parametros = $(this).serialize();

    $.ajax({
        type: "POST",
        url: "ajax/accounts_receivable/add_charges_ajax.php",
        data: parametros,
        beforeSend: function (objeto) {
            $(".resultados_ajax").html("<img src='assets/images/loader.gif'/><br/>Wait a moment please...");
        },
        success: function (datos) {
            $(".resultados_ajax_charges_add_results").html(datos);

            $('#charges_add').modal('hide');
            cdp_load_charges();
            cdp_load(1);


        }
    });
    event.preventDefault();

})



$('#charges_edit').on('show.bs.modal', function (event) {

    var id = $('#order_id').val();

    var button = $(event.relatedTarget) // Button that triggered the modal
    var id_charge = button.data('id_charge')

    var parametros = { "id": id, 'id_charge': id_charge };

    $.ajax({
        url: 'ajax/accounts_receivable/modal_edit_charges.php',
        data: parametros,
        success: function (data) {
            $(".resultados_ajax_add_modal_edit").html(data).fadeIn('slow');
        }
    });
})


$("#edit_charges").on('submit', function (event) {
    var parametros = $(this).serialize();

    $.ajax({
        type: "POST",
        url: "ajax/accounts_receivable/update_charges_ajax.php",
        data: parametros,
        beforeSend: function (objeto) {
            $(".resultados_ajax_charges_add_results").html("<img src='assets/images/loader.gif'/><br/>Wait a moment please...");
        },
        success: function (datos) {
            $(".resultados_ajax_charges_add_results").html(datos);

            $('#charges_edit').modal('hide');
            cdp_load_charges();
            cdp_load(1);


        }
    });
    event.preventDefault();

})



//cdp_eliminar
function cdp_delete_charge(id) {

    var parent = $('#item_' + id).parent().parent();
    var name = $(this).attr('data-rel');
    new Messi('<p class="messi-warning"><i class="icon-warning-sign icon-3x pull-left"></i>Are you sure you want to delete this record?<br /><strong>This action cannot be undone!!!</strong></p>', {
        title: 'Delete charge',
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
                    url: './ajax/accounts_receivable/charge_delete_ajax.php',
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
                        $('.resultados_ajax_charges_add_results').html(data);
                        cdp_load_charges();

                        cdp_load(1);
                    }
                });
            }
        }

    });
}



function cdp_validateZiseFiles() {

    var inputFile = document.getElementById('filesMultiple');
    var file = inputFile.files;

    var size = 0;
    console.log(file);

    for (var i = 0; i < file.length; i++) {

        var filesSize = file[i].size;

        if (size > 5242880) {

            $('.resultados_file').html("<div class='alert alert-danger'>" +
                "<button type='button' class='close' data-dismiss='alert'>&times;</button>" +
                "<strong>Error! Sorry, but the file size is too large. Select files smaller than 5MB. </strong>" +

                "</div>"
            );
        } else {
            $('.resultados_file').html("");
        }

        size += filesSize;
    }

    if (size > 5242880) {
        $('.resultados_file').html("<div class='alert alert-danger'>" +
            "<button type='button' class='close' data-dismiss='alert'>&times;</button>" +
            "<strong>Error! Sorry, but the file size is too large. Select files smaller than 5MB. </strong>" +

            "</div>"
        );

        return true;

    } else {
        $('.resultados_file').html("");

        return false;
    }

}


$('#openMultiFile').on('click', function () {

    $("#filesMultiple").click();
});


$('#clean_file_button').on('click', function () {

    $("#filesMultiple").val('');

    $('#selectItem').html('Attach files');

    $('#clean_files').addClass('hide');


});



$('input[type=file]').change(function () {

    var inputFile = document.getElementById('filesMultiple');
    var file = inputFile.files;
    var contador = 0;
    for (var i = 0; i < file.length; i++) {

        contador++;
    }
    if (contador > 0) {

        $('#clean_files').removeClass('hide');
    } else {

        $('#clean_files').addClass('hide');

    }

    $('#selectItem').html('attached files (' + contador + ')');
});





$('#detail_payment_packages').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id') // Extract info from data-* attributes
    var customer = button.data('customer') // Extract info from data-* attributes

    $('#order_id_confirm_payment').val(id);
    $('#customer_id_confirm_payment').val(customer);

    $(".resultados_ajax_payment_data").html('');

    cdp_load_payment_detail(id);//Cargas los pagos 

})

function cdp_load_payment_detail(id) {

    var parametros = { "id": id };
    $.ajax({

        url: 'ajax/courier/courier_payment_detail_ajax.php',
        data: parametros,
        success: function (data) {
            $(".resultados_ajax_payment_data").html(data).fadeIn('slow');
        }
    });
}






$("#send_payment").on('submit', function (event) {

    $('#save_payment').attr("disabled", true);

    var parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "ajax/courier/courier_confirm_payment.php",
        data: parametros,
        beforeSend: function (objeto) {
            $("#resultados_ajax").html("load...");
        },
        success: function (datos) {

            $('#detail_payment_packages').modal('hide');

            $("#resultados_ajax").html(datos);
            $('#save_payment').attr("disabled", false);

            setTimeout('document.location.recdp_load()', 3000);


            cdp_load(1);

        }
    });
    event.preventDefault();

})


$('#myModalCancel').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal

    var id = button.data('id') // Extract info from data-* attributes

    var modal = $(this)
    $('#id_cancel').val(id)
})


$("#cancel_pickup_form").on('submit', function (event) {

    $('#guardar_datos').attr("disabled", true);

    var parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "ajax/pickup/pickup_cancel_ajax.php",
        data: parametros,
        beforeSend: function (objeto) {
            $("#resultados_ajax").html("load...");
        },
        success: function (datos) {
            $("#resultados_ajax_cancel").html(datos);

            setTimeout('document.location.recdp_load()', 5000);

            $('#guardar_datos').attr("disabled", false);

            $('#myModalCancel').modal('hide');
            cdp_load(1);

        }
    });
    event.preventDefault();

})