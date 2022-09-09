"use strict";

$("#save_data").on('submit', function (event) {
	var parametros = $(this).serialize();

	$.ajax({
		type: "POST",
		url: "ajax/tools/twilio_sms_config_ajax.php",
		data: parametros,
		beforeSend: function (objeto) {
			$("#resultados_ajax").html("Wait a moment...");
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


$(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
var radioswitch = function () {
	var bt = function () {
		$(".radio-switch").on("switch-change", function () {
			$(".radio-switch").bootstrapSwitch("toggleRadioState")
		}), $(".radio-switch").on("switch-change", function () {
			$(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
		}), $(".radio-switch").on("switch-change", function () {
			$(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
		})
	};
	return {
		init: function () {
			bt()
		}
	}
}();
$(document).ready(function () {
	radioswitch.init()
});