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
$gateway = $_REQUEST['gateway'];


$sWhere = "";

if ($userData->userlevel == 1) {

	$sWhere .= " and  order_track_customer_id = '" . $_SESSION['userid'] . "'";
} else {
	$sWhere .= "";
}

if ($gateway != '0') {

	$sWhere .= " and  gateway = '" . $gateway . "'";
}


// // pagination variables
$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
$per_page = 10; //how much records you want to show
$adjacents  = 4; //gap between pages after number of adjacents
$offset = ($page - 1) * $per_page;



$sql = "SELECT * FROM cdb_payments_gateway  where type_transaccition_courier= 'Shipments' and payment_transaction LIKE '%" . $search . "%' $sWhere  order by id desc 
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
					<th class="text-center"><b><?php echo $lang['ddate'] ?></b></th>
					<th class="text-center"><b>Gateway</b></th>
					<th class="text-center"><b># Transaction</b></th>
					<th class="text-center"><b>Currency</b></th>
					<th class="text-center"><b>Amount</b></th>
					<th class="text-center"><b><?php echo $lang['lstatusshipment'] ?></b></th>
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

						if ($row->status === 'COMPLETED' || $row->status === 'succeeded' || $row->status === 'success') {
							$text_status = 'Completed';
							$label_class = "label-success";
						} else {

							$text_status = $row->status;
							$label_class = "label-warning";
						}


						$db->cdp_query("SELECT * FROM cdb_add_order  where CONCAT(order_prefix, order_no)= '" . $row->order_track . "'");
						$order_ = $db->cdp_registro();


					?>
						<tr class="card-hovera">

							<td><b><a href="courier_view.php?id=<?php echo $order_->order_id; ?>"><?php echo $row->order_track; ?></a></b></td>
							<td class="text-center">
								<?php echo date('Y-m-d h:i A', strtotime($row->date_payment)); ?>
							</td>

							<td class="text-center">
								<?php echo $row->gateway; ?>
							</td>

							<td class="text-center">
								<?php echo $row->payment_transaction; ?>
							</td>


							<td class="text-center">
								<?php echo $row->currency; ?>
							</td>

							<td class="text-center">
								<?php echo cdb_money_format($row->amount); ?>
							</td>

							<td>
								<span class="label label-large <?php echo $label_class; ?>"><?php echo $text_status; ?></span>

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

	</div>
<?php } ?>