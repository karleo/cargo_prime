<?php
// *************************************************************************
// *                                                                       *
// * DEPRIXA PRO -  Integrated Web Shipping System                         *
// * Copyright (c) JAOMWEB. All Rights Reserved                            *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: support@jaom.info                                              *
// * Website: http://www.jaom.info                                         *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * This software is furnished under a license and may be used and copied *
// * only  in  accordance  with  the  terms  of such  license and with the *
// * inclusion of the above copyright notice.                              *
// * If you Purchased from Codecanyon, Please read the full License from   *
// * here- http://codecanyon.net/licenses/standard                         *
// *                                                                       *
// *************************************************************************



require_once("../../loader.php");

$db = new Conexion;
$user = new User;
$core = new Core;
$userData = $user->cdp_getUserData();

$search = cdp_sanitize($_REQUEST['search']);
$status_courier = intval($_REQUEST['status_courier']);

$sWhere = "";


if ($search != null) {

	$sWhere .= " and  CONCAT(a.order_prefix,a.order_no) LIKE '%" . $search . "%'";
}
if ($status_courier > 0) {

	$sWhere .= " and  a.status_courier = '" . $status_courier . "'";
}


// // pagination variables
$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
$per_page = 5; //how much records you want to show
$adjacents  = 4; //gap between pages after number of adjacents
$offset = ($page - 1) * $per_page;


$sql = "SELECT a.volumetric_percentage, a.is_pickup,  a.total_order, a.order_id, a.order_prefix, a.order_no, a.order_date, a.sender_id, a.receiver_id, a.order_courier, a.order_pay_mode, a.status_courier, a.driver_id, a.order_service_options,  b.mod_style, b.color FROM
			 cdb_add_order as a
			 INNER JOIN cdb_styles as b ON a.status_courier = b.id
			 $sWhere
			  and a.status_courier!=14  and a.status_courier!=8 and a.status_courier!=21 and a.is_consolidate=0
			 order by order_id desc
			 ";


$query_count = $db->cdp_query($sql);
$db->cdp_execute();
$numrows = $db->cdp_rowCount();


$db->cdp_query($sql . " limit $offset, $per_page");
$data = $db->cdp_registros();

$total_pages = ceil($numrows / $per_page);


if ($numrows > 0) { ?>
	<div class="table-responsive">


		<table id="zero_config" class="table table-condensed table-hover table-striped custom-table-checkbox">
			<thead>
				<tr>

					<th><b><?php echo $lang['ltracking'] ?></b></th>
					<th class="text-center"><b>Weights</b></th>
					<th class="text-center"><b>Weight Vol.</b></th>
					<th class="text-center"><b><?php echo $lang['lstatusshipment'] ?></b></th>
					<th class="text-center"><b><?php echo $lang['ship-all5'] ?></b></th>
					<th class="text-center"></th>
				</tr>
			</thead>
			<tbody id="projects-tbl">


				<?php if (!$data) { ?>
					<tr>
						<td colspan="6">
							<?php echo "
				<i align='center' class='display-3 text-warning d-block'><img src='assets/images/alert/ohh_shipment.png' width='150' /></i>								
				", false; ?>
						</td>
					</tr>
				<?php } else { ?>

					<?php

					$count = 0;
					foreach ($data as $row) {


						$db->cdp_query("SELECT IFNULL(sum(order_item_weight), 0) as weight FROM cdb_add_order_item where order_id= '" . $row->order_id . "'");
						$order_weight = $db->cdp_registro();

						$weight = $order_weight->weight;


						$db->cdp_query("SELECT IFNULL(sum(order_item_length), 0) as length from  cdb_add_order_item where order_id= '" . $row->order_id . "'");
						$order_length = $db->cdp_registro();

						$db->cdp_query("SELECT IFNULL(sum(order_item_height), 0) as height from cdb_add_order_item where order_id= '" . $row->order_id . "'");
						$order_height = $db->cdp_registro();

						$db->cdp_query("SELECT IFNULL(sum(order_item_width), 0) as width from cdb_add_order_item where order_id= '" . $row->order_id . "'");
						$order_width = $db->cdp_registro();


						$length = $order_length->length;
						$width = $order_width->width;
						$height = $order_height->height;

						$total_metric = $length * $width * $height / $row->volumetric_percentage;

						$db->cdp_query("SELECT * FROM cdb_styles where id= '14'");
						$status_style_pickup = $db->cdp_registro();

						$tracking = $row->order_prefix . $row->order_no;

					?>
						<tr class="card-hover">

							<td><b><?php echo $row->order_prefix . $row->order_no; ?></b></td>

							<td class="text-center">
								<?php echo $weight; ?>
							</td>

							<td class="text-center">
								<?php echo $total_metric; ?>
							</td>


							<input type="hidden" id="total_ship_<?php echo $row->order_id; ?>" value="<?php echo cdb_money_format($row->total_order); ?>">

							<td class="text-center">

								<span style="background: <?php echo $row->color; ?>;" class="label label-large"><?php echo $row->mod_style; ?></span>
								<br>

								<?php
								if ($row->is_pickup == true) { ?>

									<span style="background: <?php echo $status_style_pickup->color; ?>;" class="label label-large"><?php echo $status_style_pickup->mod_style; ?></span>
								<?php
								}
								?>
							</td>

							<td class="text-center">
								<b><?php echo $core->currency; ?></b> <?php echo cdb_money_format($row->total_order); ?>
							</td>

							<td class="text-right">
								<button type="button" name="add_row" id="add_row" onclick="cdp_add_item('<?php echo $row->order_id; ?>','<?php echo $total_metric; ?>', '<?php echo $weight; ?>', '<?php echo $length; ?>', '<?php echo $width; ?>', '<?php echo $height; ?>', '<?php echo $tracking; ?>', '<?php echo $row->order_no; ?>',' <?php echo $row->order_prefix; ?>');
							 " class="btn btn-success btn-sm add_row"><i class="fa fa-plus"></i></button>
							</td>

						</tr>
					<?php $count++;
					} ?>

				<?php } ?>
			</tbody>

		</table>


		<div class="pull-right">
			<?php echo cdp_paginate($page, $total_pages, $adjacents);	?>
		</div>

		<script>
			var count = 0;

			$(".sl-all").on('click', function() {

				$('.custom-table-checkbox input:checkbox').not(this).prop('checked', this.checked);

				if ($('.custom-table-checkbox input:checkbox').is(':checked')) {

					$('.custom-table-checkbox').find('tr > td:first-child').find('input[type=checkbox]').parents('tr').css('background', '#fff8e1');

				} else {

					$('.custom-table-checkbox input:checkbox').parents('tr').css('background', '');

				}

				var $checkboxes = $('.custom-table-checkbox').find('tr > td:first-child').find('input[type=checkbox]');

				count = $checkboxes.filter(':checked').length;

				if (count > 0) {

					$('#div-actions-checked').removeClass('hide');
					$('#countChecked').removeClass('hide');

				} else {

					$('#div-actions-checked').addClass('hide');
					$('#countChecked').addClass('hide');
				}

				$('#countChecked').html("Selected: " + count);


			});



			$('.custom-table-checkbox').find('tr > td:first-child').find('input[type=checkbox]').on('change', function() {

				if ($(this).is(':checked')) {

					$(this).parents('tr').css('background', '#fff8e1');

				} else {

					$(this).parents('tr').css('background', '');
				}


			});




			$(document).ready(function() {

				var $checkboxes = $('.custom-table-checkbox').find('tr > td:first-child').find('input[type=checkbox]');

				$checkboxes.change(function() {

					count = $checkboxes.filter(':checked').length;

					if (count > 0) {

						$('#div-actions-checked').removeClass('hide');
						$('#countChecked').removeClass('hide');

					} else {

						$('#div-actions-checked').addClass('hide');
						$('#countChecked').addClass('hide');
					}


					$('#countChecked').html("Selected: " + count);

				});

			});
		</script>



		<script>
			$("#send_checkbox_status").submit(function(event) {

				$('#guardar_datos').attr("disabled", true);

				var parametros = $(this).serialize();
				var checked_data = new Array();
				$('.custom-table-checkbox').find('tr > td:first-child').find('input[type=checkbox]:checked').each(function() {
					checked_data.push($(this).val());
				});

				var status = $('#status_courier_modal').val();

				$.ajax({
					type: "GET",
					url: './ajax/courier/courier_update_multiple_ajax.php?status=' + status,

					data: {
						'checked_data': JSON.stringify(checked_data)
					},
					beforeSend: function(objeto) {
						$(".resultados_ajax").html("Mensaje: Cargando...");
					},
					success: function(datos) {
						$("#resultados_ajax").html(datos);
						$('#guardar_datos').attr("disabled", false);
						$('#modalCheckboxStatus').modal('hide');


						cdp_load(1);

						$('#div-actions-checked').addClass('hide');
						$('#countChecked').addClass('hide');
						$('html, body').animate({
							scrollTop: 0
						}, 600);


					}
				});
				event.preventDefault();

			})
		</script>

		<script>
			//cdp_eliminar
			function cdp_printMultipleLabel() {

				var checked_data = new Array();
				$('.custom-table-checkbox').find('tr > td:first-child').find('input[type=checkbox]:checked').each(function() {
					checked_data.push($(this).val());
				});

				var name = $(this).attr('data-rel');
				new Messi('<b></i>Are you sure to print ' + count + ' selected records ?</b>', {
					title: 'Print Shipments Label',
					titleClass: '',
					modal: true,
					closeButton: true,
					buttons: [{
						id: 0,
						label: 'Print',
						class: '',
						val: 'Y'
					}],
					callback: function(val) {

						if (val === 'Y') {

							window.open('print_label_ship_multiple.php?data=' + JSON.stringify(checked_data), "_blank");

						}
					}

				});
			}
		</script>

	</div>
<?php } ?>