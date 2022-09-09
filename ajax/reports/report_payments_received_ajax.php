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

$customer_id = intval($_REQUEST['customer_id']);
$pay_mode = intval($_REQUEST['pay_mode']);
$range = cdp_sanitize($_REQUEST['range']);


$sWhere = "";


if ($customer_id > 0) {

	$sWhere .= " and b.sender_id = '" . $customer_id . "'";
}


if ($pay_mode > 0) {

	$sWhere .= " and a.payment_type = '" . $pay_mode . "'";
}


if (!empty($range)) {

	$fecha =  explode(" - ", $range);
	$fecha = str_replace('/', '-', $fecha);

	$fecha_inicio = date('Y-m-d', strtotime($fecha[0]));
	$fecha_fin = date('Y-m-d', strtotime($fecha[1]));


	$sWhere .= " and  a.charge_date between '" . $fecha_inicio . "'  and '" . $fecha_fin . "'";
}
$sql = "SELECT c.lname, c.fname, a.id_charge, b.order_prefix, b.order_no, a.payment_type, a.charge_date, a.total FROM cdb_charges_order as a 
				INNER JOIN cdb_add_order as b ON a.order_id = b.order_id
				INNER JOIN cdb_users as c ON c.id = b.sender_id
				$sWhere
				order by a.id_charge
			 ";


$query_count = $db->cdp_query($sql);
$db->cdp_execute();
$numrows = $db->cdp_rowCount();


$db->cdp_query($sql);
$data = $db->cdp_registros();


if ($numrows > 0) { ?>
	<div class="table-responsive">


		<table id="zero_config" class="table-sm table table-condensed table-hover table-striped custom-table-checkbox">
			<thead>
				<tr style="background-color: #3e5569; color: white">
					<th class="text-center"><b>Payment number</b></th>
					<th class="text-center"><b><?php echo $lang['ddate'] ?></b></th>
					<th class="text-center"><b>Customer</b></th>
					<th class="text-center"><b>Pay mode</b></th>
					<th class="text-center"><b><?php echo $lang['ltracking'] ?></b></th>
					<th class="text-center"><b>Amount</b></th>

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
					$sumador_total = 0;

					foreach ($data as $row) {

						// var_dump($row->id);
						$db->cdp_query('SELECT  * FROM cdb_met_payment WHERE id=:id');

						$db->bind(':id', $row->payment_type);

						$db->cdp_execute();

						$met_payment = $db->cdp_registro();


						$sumador_total += $row->total;

					?>


						<tr class="card-hover">

							<td class="text-center">
								<?php echo $row->id_charge; ?>
							</td>

							<td class="text-center">
								<?php echo $row->charge_date; ?>
							</td>


							<td class="text-center">
								<?php echo $row->fname . ' ' . $row->lname; ?>
							</td>
							<td class="text-center">
								<?php echo $met_payment->name_pay; ?>
							</td>

							<td class="text-center">
								<?php echo $row->order_prefix . $row->order_no; ?>
							</td>

							<td class="text-center">
								<?php echo cdb_money_format($row->total); ?>
							</td>
						</tr>
					<?php $count++;
					} ?>

				<?php } ?>
			</tbody>
			<tfoot>

				<tr class="card-hover">
					<td class="text-center"><b>TOTAL</b></td>
					<td colspan="4"></td>
					<td class="text-center">
						<b><?php echo cdb_money_format($sumador_total); ?> </b>
					</td>

				</tr>
			</tfoot>

		</table>
	</div>
<?php } ?>