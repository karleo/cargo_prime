
"use strict";


$("#driver_update").on('submit', function (event) {
    var parametros = $(this).serialize();

    $.ajax({
        type: "POST",
        url: "ajax/customers_packages/customers_package_update_driver_ajax.php",
        data: parametros,
        beforeSend: function (objeto) {
            $("#resultados_ajax").html("Wait a moment...");
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
        url: "send_email_pdf_packages.php",
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







$('#add_payment').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id') // Extract info from data-* attributes
    var customer = button.data('customer') // Extract info from data-* attributes
    var total = button.data('total') // Extract info from data-* attributes
    var modal = $(this)
    $('#order_id').val(id)
    $('#total_pay').val(total)
    $('#customer_id').val(customer)
})







$("#add_charges").on('submit', function (event) {
    $('#save_form2').attr("disabled", true);

    if (cdp_validateZiseFiles() == true) {

        return false;
    }

    var inputFileImage = document.getElementById("filesMultiple");
    var notes = $('#notes').val();
    var mode_pay = $('#mode_pay').val();
    var order_id = $('#order_id').val();
    var customer_id = $('#customer_id').val();


    var file = inputFileImage.files[0];
    var data = new FormData();

    data.append('file_invoice', file);
    data.append('order_id', order_id);
    data.append('notes', notes);
    data.append('mode_pay', mode_pay);
    data.append('customer_id', customer_id);
    $.ajax({
        type: "POST",
        url: "ajax/customers_packages/customers_packages_add_ajax.php",
        data: data,
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false,
        beforeSend: function (objeto) {
            $("#resultados_ajax").html("Send...");
        },
        success: function (datos) {
            $("#resultados_ajax").html(datos);
            $('#save_form2').attr("disabled", false);

            $('html, body').animate({
                scrollTop: 0
            }, 600);

            setTimeout('document.location.recdp_load()', 3000);

            $('#add_payment').modal('hide');

            cdp_load(1);

        }
    });
    event.preventDefault();

})









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



$('input[type=file]').on('change', function () {

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

    cdp_load_payment_detail(id); //Cargas los pagos 

})

function cdp_load_payment_detail(id) {

    var parametros = {
        "id": id
    };
    $.ajax({

        url: 'ajax/customers_packages/customers_packages_payment_detail_ajax.php',
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
        url: "ajax/customers_packages/customers_packages_confirm_payment.php",
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

