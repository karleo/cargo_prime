"use strict";


$(function () {
	cdp_load(1);

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




//Cargar datos AJAX
function cdp_load(page) {
	var search = $("#search").val();
	var status_courier = $("#status_courier").val();
	var parametros = { "page": page, 'search': search, 'status_courier': status_courier };
	$("#loader").fadeIn('slow');
	$.ajax({
		url: './ajax/consolidate/consolidate_list_ajax.php',
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
		title: 'Delete conslidated',
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
					url: './ajax/consolidate/consolidate_delete_ajax.php',
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
		url: "ajax/tools/category/category_add_ajax.php",
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
		url: "ajax/tools/category/category_edit_ajax.php",
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






$("#driver_update").on('submit', function (event) {
	var parametros = $(this).serialize();

	$.ajax({
		type: "POST",
		url: "ajax/consolidate/consolidate_update_driver_ajax.php",
		data: parametros,
		beforeSend: function (objeto) {
			$("#resultados_ajax").html("Load...");
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
			$(".resultados_ajax_mail").html("Mensaje: Cargando...");
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

			cdp_load(1);

		}
	});
	event.preventDefault();

})