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

$sWhere = "";

if ($search != null) {

	$sWhere .= " ";
}

if ($userData->userlevel == 1) {

	$sWhere .= " and  customer_id = '" . $_SESSION['userid'] . "'";
} else {
	$sWhere .= "";
}



// // pagination variables
$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
$per_page = 10; //how much records you want to show
$adjacents  = 4; //gap between pages after number of adjacents
$offset = ($page - 1) * $per_page;


$sql = "SELECT * FROM cdb_pre_alert  where tracking LIKE '%" . $search . "%' $sWhere order by prealert_date desc";


$query_count = $db->cdp_query($sql);
$db->cdp_execute();
$numrows = $db->cdp_rowCount();


$db->cdp_query($sql . " limit $offset, $per_page");
$data = $db->cdp_registros();

$total_pages = ceil($numrows / $per_page);


if ($numrows > 0) { ?>
	<div class="table-responsive">


		<table id="zero_config" class=" table-sm table table-condensed table-hover table-striped custom-table-checkbox">
			<thead>
				<tr>

					<th class="text-center"><b>Pre alert date</b></th>
					<th class="text-center"><b><?php echo $lang['left46'] ?></b></th>
					<?php
					if ($userData->userlevel != 1) { ?>

						<th class="text-center"><b><?php echo $lang['ncustomer'] ?></b></th>
					<?php } ?>
					<th class="text-center"><b><?php echo $lang['left47'] ?></b></th>
					<th class="text-center"><b><?php echo $lang['left48'] ?></b></th>
					<th class="text-center"><b><?php echo $lang['left49'] ?></b></th>
					<th class="text-center"><b>Estimated delivery date</b></th>
					<th class="text-center"><b><?php echo $lang['left66'] ?></b></th>
					<th class="text-center"><b>Status</b></th>
					<th class="text-center"><b></b></th>

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

						$db->cdp_query("SELECT * FROM cdb_users where id= '" . $row->customer_id . "'");
						$sender_data = $db->cdp_registro();


						$db->cdp_query("SELECT * FROM cdb_courier_com where id= '" . $row->courier_com . "'");
						$courier_com = $db->cdp_registro();


					?>
						<tr class="card-hovera">

							<td class="text-center">
								<?php echo date('Y-m-d', strtotime($row->prealert_date)); ?>
							</td>
							<td class="text-center"><b><?php echo $row->tracking; ?></b></td>

							<?php
							if ($userData->userlevel != 1) { ?>
								<td class="text-center">
									<?php echo $sender_data->fname; ?> <?php echo $sender_data->lname; ?>
								</td>
							<?php } ?>

							<td class="text-center"><?php echo $courier_com->name_com; ?></td>

							<td class="text-center">
								<?php echo $row->provider_shop; ?>
							</td>

							<td class="text-center">
								<?php echo $row->package_description; ?>
							</td>

							<td class="text-center">
								<?php echo $row->estimated_date; ?>
							</td>

							<td class="text-center">
								<b><?php echo $core->currency; ?></b> <?php echo cdb_money_format($row->purchase_price); ?>
							</td>
							<td class="text-center">
							<?php if ($row->is_package == 1) { ?>
									<span style="background: #5BE472;" class="label label-large">Approved</span>
							<?php } ?>
							<?php if ($row->is_package == 0) { ?>
									<span style="background: #FD571E;" class="label label-large">Pending</span>
							<?php } ?>
							</td>

							<td align='center'>
								<div class="btn-group">
									<button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown" data-flip="false">Actions
									</button>
									<div class="dropdown-menu scrollable-menu">
										<a class="dropdown-item" href="<?php echo $row->url_invoice; ?>" target="_blank"><i style="color:#343a40" class="fa fa-search"></i>&nbsp;Show attached invoice</a>

										<?php

										if ($user->cdp_is_Admin()) {

											if ($row->is_package == 0) {

										?>

												<a class="dropdown-item" href="customer_packages_add_from_prealert.php?id=<?php echo $row->pre_alert_id; ?>"><i style="color:#343a40" class="ti-package"></i>&nbsp;check in the package</a>

										<?php }
										}

										?>


									</div>
								</div>
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