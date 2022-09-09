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



require_once("../../../loader.php");

$db = new Conexion; 


$search = cdp_sanitize($_REQUEST['search']);

$tables = "cdb_met_payment";
$fields = "*";

$sWhere = "";


$sWhere .= " name_pay LIKE '%" . $search . "%'";


$sWhere .= " order by id ASC";

// // pagination variables
$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
$per_page = 10; //how much records you want to show
$adjacents  = 4; //gap between pages after number of adjacents
$offset = ($page - 1) * $per_page;

$sql = "SELECT $fields FROM  $tables where $sWhere";
$query_count = $db->cdp_query($sql);
$db->cdp_execute();
$numrows = $db->cdp_rowCount();


$db->cdp_query($sql . " limit $offset, $per_page");
$data = $db->cdp_registros();

$total_pages = ceil($numrows / $per_page);


if ($numrows > 0) { ?>


	<table id="zero_config" class="table table-condensed table-hover table-striped" data-pagination="true" data-page-size="5">
		<thead>
			<tr>
				<th data-sort-initial="true" data-toggle="true" width="120"><b>Name payment</b></th>
				<th data-sort-ignore="true" width="300"><b>Details payments</b></th>
				<th data-sort-ignore="true" class="text-center" width="130"><b>Payment mode activation</b></th>
				<th data-sort-ignore="true" class="text-center" width="100"></th>
			</tr>
		</thead>


		<?php if (!$data) { ?>
			<tr>
				<td colspan="6">
					<?php echo "
				<i align='center' class='display-3 text-warning d-block'><img src='assets/images/alert/ohh_shipment.png' width='150' /></i>								
				", false; ?>
				</td>
			</tr>
		<?php } else { ?>
			<?php foreach ($data as $row) { ?>
				<tr>
					<td width="120"><?php echo $row->name_pay; ?></td>
					<td width="300"><?php echo $row->detail_pay; ?></td>
					<td class="text-center" width="130"><?php echo cdp_paymentStatus($row->is_active, $row->id); ?></td>
					<td class="text-center" width="100">

						<?php if ($row->id == 1){ ?>
							<a href="payment_mode_edit.php?id=1" data-toggle="tooltip" data-original-title="<?php echo $lang['tools-methodpay16'] ?>"><i class="ti-pencil" aria-hidden="true"></i></a>
						
						<?php } else if ($row->id == 2){ ?>
							<a href="payment_mode_paypal_edit.php?id=2" data-toggle="tooltip" data-original-title="<?php echo $lang['tools-methodpay16'] ?>"><i class="ti-pencil" aria-hidden="true"></i></a>

						<?php } else if ($row->id == 3){ ?>
							<a href="payment_mode_stripe_edit.php?id=3" data-toggle="tooltip" data-original-title="<?php echo $lang['tools-methodpay16'] ?>"><i class="ti-pencil" aria-hidden="true"></i></a>

						<?php } else if ($row->id == 4){ ?>
							<a href="payment_mode_paystack_edit.php?id=4" data-toggle="tooltip" data-original-title="<?php echo $lang['tools-methodpay16'] ?>"><i class="ti-pencil" aria-hidden="true"></i></a>

						<?php } else if ($row->id == 5){ ?>
							<a href="payment_mode_wire_edit.php?id=5" data-toggle="tooltip" data-original-title="<?php echo $lang['tools-methodpay16'] ?>"><i class="ti-pencil" aria-hidden="true"></i></a>
						<?php } ?>
					</td>

				</tr> 
			<?php } ?>

		<?php } ?>

	</table>


	<div class="pull-right">

		<?php echo cdp_paginate($page, $total_pages, $adjacents);	?>
	</div>
	</div>
<?php } ?>