"use strict";


$(function () {
    cdp_load(1);

});


//Cargar datos AJAX
function cdp_load(page) {

    $.ajax({
        url: './ajax/notifications_list_ajax.php',
        beforeSend: function (objeto) {
        },
        success: function (data) {
            $(".outer_div").html(data).fadeIn('slow');
        }
    })
}


function cdp_updateNotificationsRead() {

    var name = $(this).attr('data-rel');
    new Messi('<p class="messi-info"><i class="icon-warning-sign icon-3x pull-left"></i>Are you sure to mark all notifications as readed?</p>', {
        title: 'Update Notifications',
        titleClass: '',
        modal: true,
        closeButton: true,
        buttons: [{
            id: 0,
            label: 'Update',
            class: '',
            val: 'Y'
        }],
        callback: function (val) {
            if (val === 'Y') {
                $.ajax({
                    type: 'post',
                    url: './ajax/notifications_update_read_ajax.php',

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





