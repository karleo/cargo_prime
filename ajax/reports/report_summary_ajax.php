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

$range = cdp_sanitize($_REQUEST['range']);
$agency_courier = intval($_REQUEST['agency_courier']);
$pay_mode = intval($_REQUEST['pay_mode']);
$customer_id = intval($_REQUEST['customer_id']);

$sWhere = "";


if ($agency_courier > 0) {

	$sWhere .= " and agency = '" . $agency_courier . "'";
}


if ($customer_id > 0) {

	$sWhere .= " and sender_id = '" . $customer_id . "'";
}

if ($pay_mode > 0) {

	$sWhere .= " and order_payment_method = '" . $pay_mode . "'";
}
if (!empty($range)) {

	$fecha =  explode(" - ", $range);
	$fecha = str_replace('/', '-', $fecha);

	$fecha_inicio = date('Y-m-d', strtotime($fecha[0]));
	$fecha_fin = date('Y-m-d', strtotime($fecha[1]));


	$sWhere .= " and  order_date between '" . $fecha_inicio . "'  and '" . $fecha_fin . "'";
}

$db->cdp_query("UPDATE cdb_add_order SET  status_invoice =3  WHERE due_date<now() and status_invoice !=1 and order_payment_method >1");


$db->cdp_execute();


$sql = "SELECT * FROM cdb_add_order where order_payment_method >1  
			
			$sWhere
			
			 order by order_id desc 
			 ";


$query_count = $db->cdp_query($sql);
$db->cdp_execute();
$numrows = $db->cdp_rowCount();


$db->cdp_query($sql);
$data = $db->cdp_registros();



if ($numrows > 0) { ?>
	<div class="table-responsive">


		<table id="zero_config" class="table table-condensed table-hover table-striped custom-table-checkbox">
			<thead>
				<tr>

					<th><b><?php echo $lang['ltracking'] ?></b></th>
					<th class="text-center"><b>Sender</b></th>
					<th class="text-center"><b><?php echo $lang['ddate'] ?></b></th>
					<th class="text-center"><b>Due date</b></th>
					<th class="text-center"><b><?php echo $lang['lstatusinvoice'] ?></b></th>
					<th class="text-center"><b>Total amount</b></th>
					<th class="text-center"><b>Total paid</b></th>
					<th class="text-center"><b>balance</b></th>
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
					$sumador_pendiente = 0;
					$sumador_total = 0;
					$sumador_pagado = 0;

					foreach ($data as $row) {

						$db->cdp_query("SELECT * FROM cdb_users where id= '" . $row->sender_id . "'");
						$sender_data = $db->cdp_registro();

						$db->cdp_query("SELECT * FROM cdb_users where id= '" . $row->receiver_id . "'");
						$receiver_data = $db->cdp_registro();

						$db->cdp_query("SELECT * FROM cdb_users where id= '" . $row->driver_id . "'");
						$driver_data = $db->cdp_registro();


						$db->cdp_query('SELECT  IFNULL(sum(total), 0)  as total  FROM cdb_charges_order WHERE order_id=:order_id');

						$db->bind(':order_id', $row->order_id);

						$db->cdp_execute();

						$sum_payment = $db->cdp_registro();
						// var_dump($sum_payment->total);

						$pendiente = $row->total_order - $sum_payment->total;

						if ($row->status_invoice == 1) {
							$text_status = $lang['invoice_paid'];
							$label_class = "label-success";
						} else if ($row->status_invoice == 2) {
							$text_status = $lang['invoice_pending'];
							$label_class = "label-warning";
						} else if ($row->status_invoice == 3) {
							$text_status = $lang['invoice_due'];
							$label_class = "label-danger";
						}

						$sumador_pendiente += $pendiente;
						$sumador_total += $row->total_order;
						$sumador_pagado += $sum_payment->total;


					?>
						<tr class="card-hovera">

							<td><b><a data-toggle="modal" data-target="#charges_list" data-id="<?php echo $row->order_id; ?>"><?php echo $row->order_prefix . $row->order_no; ?></a></b></td>

							<td class="text-center">
								<?php echo $sender_data->fname; ?> <?php echo $sender_data->lname; ?>
							</td>

							<td class="text-center">
								<?php echo $row->order_date; ?>
							</td>


							<td class="text-center">
								<?php echo $row->due_date; ?>
							</td>

							<td class="text-center">
								<span class="label label-large <?php echo $label_class; ?>"><?php echo $text_status; ?></span>

							</td>

							<td class="text-center">
								<b><?php echo $core->currency; ?></b> <?php echo cdb_money_format($row->total_order); ?>
							</td>

							<td class="text-center">
								<b><?php echo $core->currency; ?></b> <?php echo cdb_money_format($sum_payment->total); ?>
							</td>

							<td class="text-center">
								<b><?php echo $core->currency; ?></b> <?php echo cdb_money_format($pendiente); ?>
							</td>



						</tr>
					<?php $count++;
					} ?>

				<?php } ?>
			</tbody>
			<tfoot>
				<tr class="card-hover">
					<td class="text-left"><b>TOTAL</b></td>

					<td colspan="4"></td>
					<td class="text-center  ">
						<b><?php echo cdb_money_format($sumador_total); ?> </b>
					</td>

					<td class="text-center  ">
						<b><?php echo cdb_money_format($sumador_pagado); ?> </b>
					</td>

					<td class="text-center  ">
						<b><?php echo cdb_money_format($sumador_pendiente); ?> </b>
					</td>

				</tr>

			</tfoot>

		</table>



	</div>
<?php } ?>