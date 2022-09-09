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
});

$(function () {
    $('#date_prealert').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
    });
});


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



//Registro de datos

$("#form_prealert").submit(function (event) {

    $('#create_prealert').attr("disabled", true);

    var filesMultiple = document.getElementById("filesMultiple");
    var date_prealert = $('#date_prealert').val();
    var tracking_prealert = $('#tracking_prealert').val();
    var provider_prealert = $('#provider_prealert').val();
    var description_prealert = $('#description_prealert').val();
    var price_prealert = $('#price_prealert').val();
    var courier_prealert = $('#courier_prealert').val();


    var file = filesMultiple.files[0];
    var data = new FormData();

    data.append('file_invoice', file);
    data.append('date_prealert', date_prealert);
    data.append('tracking_prealert', tracking_prealert);
    data.append('provider_prealert', provider_prealert);
    data.append('description_prealert', description_prealert);
    data.append('price_prealert', price_prealert);
    data.append('courier_prealert', courier_prealert);




    $.ajax({
        type: "POST",
        url: "ajax/pre_alerts/prealert_add_ajax.php",
        data: data,
        contentType: false,
        cache: false,
        processData: false,

        beforeSend: function (objeto) {
            $("#resultados_ajax").html("<img src='assets/images/loader.gif'/><br/>Wait a moment please...");
        },

        success: function (datos) {

            $("#resultados_ajax").html(datos);
            $('#create_prealert').attr("disabled", false);

            $('html, body').animate({
                scrollTop: 0
            }, 600);


        }
    });

    event.preventDefault();

})

function cdp_soloNumeros(e) {
    var key = e.charCode;
    return key >= 44 && key <= 57;
}