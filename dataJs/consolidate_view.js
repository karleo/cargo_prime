"use strict";



$("#driver_update").on('submit', function (event) {
  var parametros = $(this).serialize();

  $.ajax({
    type: "POST",
    url: "ajax/consolidate/consolidate_update_driver_ajax.php",
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
    url: "send_email_pdf_consolidate.php",
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

    url: 'ajax/consolidate/consolidate_payment_detail_ajax.php',
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
    url: "ajax/consolidate/consolidate_confirm_payment.php",
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