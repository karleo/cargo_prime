//Registro de datos

"use strict";
$("#save_user").on('submit', function (event) {
    $('#save_data').attr("disabled", true);
    var logo = document.getElementById("logo");
    var favicon = document.getElementById("favicon");

    var site_name = $('#site_name').val();
    var site_url = $('#site_url').val();
    var site_email = $('#site_email').val();
    var c_nit = $('#c_nit').val();
    var c_phone = $('#c_phone').val();
    var cell_phone = $('#cell_phone').val();
    var c_address = $('#c_address').val();
    var locker_address = $('#locker_address').val();
    var c_country = $('#c_country').val();
    var c_city = $('#c_city').val();
    var c_postal = $('#c_postal').val();
    var thumb_w = $('#thumb_w').val();
    var thumb_h = $('#thumb_h').val();

    var reg_verify = $('input:radio[name=reg_verify]:checked').val();
    var auto_verify = $('input:radio[name=auto_verify]:checked').val();
    var reg_allowed = $('input:radio[name=reg_allowed]:checked').val();
    var notify_admin = $('input:radio[name=notify_admin]:checked').val();


    var file_logo = logo.files[0];
    var file_favicon = favicon.files[0];

    var data = new FormData();

    data.append('logo', file_logo);
    data.append('favicon', file_favicon);
    data.append('site_name', site_name);
    data.append('site_url', site_url);
    data.append('site_email', site_email);
    data.append('c_nit', c_nit);
    data.append('c_phone', c_phone);
    data.append('cell_phone', cell_phone);
    data.append('c_address', c_address);
    data.append('locker_address', locker_address);
    data.append('c_city', c_city);
    data.append('c_country', c_country);
    data.append('c_postal', c_postal);
    data.append('thumb_w', thumb_w);
    data.append('thumb_h', thumb_h);
    data.append('reg_verify', reg_verify);
    data.append('auto_verify', auto_verify);
    data.append('reg_allowed', reg_allowed);
    data.append('notify_admin', notify_admin);	//19
    $.ajax({
        type: "POST",
        url: "ajax/tools/config_system_ajax.php",
        data: data,
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData: false,
        beforeSend: function (objeto) {
            $("#resultados_ajax").html("Enviando...");
        },
        success: function (datos) {
            $("#resultados_ajax").html(datos);
            $('#save_data').attr("disabled", false);

            $('html, body').animate({
                scrollTop: 0
            }, 600);

        }
    });
    event.preventDefault();

})