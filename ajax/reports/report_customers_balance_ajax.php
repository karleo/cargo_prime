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

$customer_id = intval($_REQUEST['customer_id']);


$sWhere = "";


if ($customer_id > 0) {

	$sWhere .= " and b.sender_id = '" . $customer_id . "'";
}
if (!empty($range)) {

	$fecha =  explode(" - ", $range);
	$fecha = str_replace('/', '-', $fecha);

	$fecha_inicio = date('Y-m-d', strtotime($fecha[0]));
	$fecha_fin = date('Y-m-d', strtotime($fecha[1]));


	$sWhere .= " and  b.order_date between '" . $fecha_inicio . "'  and '" . $fecha_fin . "'";
}

$sql = "SELECT a.id, b.order_id, a.lname,a.fname, b.order_prefix, b.order_no FROM cdb_users as a
			INNER JOIN cdb_add_order as b on a.id =b.sender_id
			where b.order_payment_method!=1
			$sWhere
			group by a.id

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
					<th class="text-left"><b>Customer</b></th>
					<th class="text-left"><b>Balance</b></th>
					<th></th>
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



					$order_pagado = 0;
					$order_total = 0;
					$sumador_balance = 0;

					foreach ($data as $row) {

						$db->cdp_query('SELECT  total_order, order_id FROM cdb_add_order WHERE sender_id=:id and  order_payment_method!=1 ');

						$db->bind(':id', $row->id);

						$db->cdp_execute();

						$a = $db->cdp_registros();

						foreach ($a as $key) {

							$db->cdp_query('SELECT  IFNULL(sum(total), 0)  as total  FROM cdb_charges_order WHERE order_id=:order_id');

							$db->bind(':order_id', $key->order_id);

							$db->cdp_execute();

							$sum_payment = $db->cdp_registro();

							$order_pagado += $sum_payment->total;

							$order_total += $key->total_order;


							$total_balance = $order_total - $order_pagado;
						}
						$sumador_balance += $total_balance;



					?>


						<tr class="card-hover">

							<td class="text-left">
								<?php echo $row->fname . ' ' . $row->lname; ?>
							</td>

							<td class="text-left">
								<?php echo cdb_money_format($total_balance); ?>
							</td>

							<td class="text-right">
								<a href="report_customers_balance_detail.php?customer=<?php echo $row->id; ?>&fecha_inicio=<?php echo $fecha_inicio; ?>&fecha_fin=<?php echo $fecha_fin; ?>" class="btn btn-info btn-xs"><i class="fa fa-search"></i></a>
							</td>



						</tr>
					<?php $count++;

						$order_pagado = 0;
						$order_total = 0;
					} ?>

				<?php } ?>
			</tbody>
			<tfoot>

				<tr class="card-hover">
					<td class="text-left"><b>TOTAL</b></td>




					<td class="text-left">
						<b><?php echo cdb_money_format($sumador_balance); ?> </b>
					</td>

				</tr>
			</tfoot>

		</table>




	</div>
<?php } ?>