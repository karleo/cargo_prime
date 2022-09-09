"use strict";


$(function () {
	cdp_load(1);
	cdp_load_countries("origin");
	cdp_load_countries("destiny");
});


//Cargar datos AJAX
function cdp_load(page) {
	var origin = $("#country_origin").val();
	var destiny = $("#country_destiny").val();
	var search = $("#search").val();
	var parametros = { "page": page, 'search': search, 'origin': origin, 'destiny': destiny };
	$("#loader").fadeIn('slow');
	$.ajax({
		url: './ajax/tools/ship_tariffs/ship_tariffs_list_ajax.php',
		data: parametros,
		beforeSend: function (objeto) { 
		},
		success: function (data) {
			$(".outer_div").html(data).fadeIn('slow');
		}
	})
}

function cdp_load_countries(from) {
	$("#country_" + from).select2({
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
		placeholder: "Search " + from,
		allowClear: true
	});
}

function cdp_eliminar(id) {

	var parent = $('#item_' + id).parent().parent();
	var name = $(this).attr('data-rel');
	new Messi('<p class="messi-warning"><i class="icon-warning-sign icon-3x pull-left"></i>Are you sure you want to delete this record?<br /><strong>This action cannot be undone!!!</strong></p>', {
		title: 'Delete User',
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
					url: './ajax/tools/ship_tariffs/ship_tariffs_delete_ajax.php',
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
