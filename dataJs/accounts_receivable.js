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

	cdp_select2_init();

	var start = moment().startOf('month');
	var end = moment().endOf('month');

	$('#daterange').daterangepicker({
		startDate: start,
		endDate: end,
		locale: {
			'format': 'Y/M/D',

		},

		ranges: {
			'Today': [moment(), moment()],
			'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			'Last 7 Days': [moment().subtract(6, 'days'), moment()],
			'Last 30 Days': [moment().subtract(29, 'days'), moment()],
			'This Month': [moment().startOf('month'), moment().endOf('month')],
			'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],

		}
	}).on('change', function (e) {
		cdp_load(1);
	});

	cdp_load(1);

});




//Cargar datos AJAX
function cdp_load(page) {
	var search = $("#search").val();
	var agency_courier = $("#agency_courier").val();
	var customer_id = $("#customer_id").val();
	var daterange = $("#daterange").val();
	var parametros = { "page": page, 'search': search, 'agency_courier': agency_courier, 'customer_id': customer_id, 'range': daterange };
	$("#loader").fadeIn('slow');
	$.ajax({
		url: './ajax/accounts_receivable/accounts_receivable_ajax.php',
		data: parametros,
		beforeSend: function (objeto) {
		},
		success: function (data) {
			$(".outer_div").html(data).fadeIn('slow');
		}
	})
}


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




function cdp_select2_init() {

	$(".select2").select2({
		ajax: {
			url: "ajax/customers_select2.php",
			dataType: 'json',

			delay: 250,
			data: function (params) {
				return {
					q: params.term // search term
				};
			},
			processResults: function (data) {
				// parse the results into the format expected by Select2.
				// since we are using custom formatting functions we do not need to
				// alter the remote JSON data
				console.log(data)
				return {
					results: data
				};
			},
			cache: true
		},
		minimumInputLength: 2,
		placeholder: "Select Customer",
		allowClear: true
	}).on('change', function (e) {
		cdp_load(1);
	});
}

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
			$(".resultados_ajax").html("Please wait...");
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
			$(".resultados_ajax_charges_add_results").html("Please wait...");
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