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

if ($userData->userlevel == 3) {

	$sWhere .= " and  a.driver_id = '" . $_SESSION['userid'] . "'";
} else if ($userData->userlevel == 1) {

	$sWhere .= " and  a.sender_id = '" . $_SESSION['userid'] . "'";
} else {
	$sWhere .= "";
}
if ($search != null) {

	$sWhere .= " and  CONCAT(a.order_prefix,a.order_no) LIKE '%" . $search . "%'";
}
if ($status_courier > 0) {

	$sWhere .= " and  a.status_courier = '" . $status_courier . "'";
}






// // pagination variables
$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
$per_page = 10; //how much records you want to show
$adjacents  = 4; //gap between pages after number of adjacents
$offset = ($page - 1) * $per_page;



$sql = "SELECT a.is_prealert, a.tracking_purchase, a.provider_purchase, a.price_purchase, a.status_invoice, a.total_order, a.order_id, a.order_prefix, a.order_no, a.order_date, a.sender_id, a.order_courier, a.order_pay_mode, a.status_courier, a.driver_id, a.order_service_options,  b.mod_style, b.color FROM
			 cdb_customers_packages as a
			 INNER JOIN cdb_styles as b ON a.status_courier = b.id
			 $sWhere
			  

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
					<?php
					if ($userData->userlevel == 9) { ?>

						<th>
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input sl-all" id="cstall">
								<label class="custom-control-label" for="cstall"></label>
							</div>
						</th>
					<?php
					}
					?>
					<th><b><?php echo $lang['ltracking'] ?></b></th>
					<th class="text-center"><b><?php echo $lang['ddate'] ?></b></th>
					<?php
					if ($userData->userlevel != 1) { ?>
						<th class="text-center"><b><?php echo $lang['ncustomer'] ?></b></th>
					<?php } ?>

					<th class="text-center"><b><?php echo $lang['ldestination'] ?></b></th>
					<th class="text-center"><b><?php echo $lang['left47'] ?></b></th>
					<th class="text-center"><b><?php echo $lang['left48'] ?></b></th>
					<th class="text-center"><b><?php echo $lang['left46'] ?></b></th>

					<!-- <th class="text-center"><b><?php echo $lang['lshipline'] ?></b></th> -->
					<th class="text-center"><b><?php echo $lang['lstatusshipment'] ?></b></th>
					<th><b>Driver</b></th>
					<th class=""><b><?php echo $lang['ship-all5'] ?></b></th>
					<th class="text-center"></th>
					<th class="text-center"><b>Invoice Status</b></th>

					<th class="text-center"><b><?php
												//echo $lang['aaction']
												?></b></th>
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

						$db->cdp_query("SELECT * FROM cdb_users where id= '" . $row->sender_id . "'");
						$sender_data = $db->cdp_registro();


						$db->cdp_query("SELECT * FROM cdb_users where id= '" . $row->driver_id . "'");
						$driver_data = $db->cdp_registro();

						$db->cdp_query("SELECT * FROM cdb_courier_com where id= '" . $row->order_courier . "'");
						$courier_com = $db->cdp_registro();

						$db->cdp_query("SELECT * FROM cdb_met_payment where id= '" . $row->order_pay_mode . "'");
						$met_payment = $db->cdp_registro();

						$db->cdp_query("SELECT * FROM cdb_shipping_mode where id= '" . $row->order_service_options . "'");
						$order_service_options = $db->cdp_registro();

						$db->cdp_query("SELECT * FROM cdb_pre_alert where tracking= '" . $row->tracking_purchase . "'");
						$package_prealert = $db->cdp_registro();


						if ($row->status_invoice == 1) {
							$text_status = $lang['invoice_paid'];
							$label_class = "label-success";
						} else if ($row->status_invoice == 0 || $row->status_invoice == 2) {
							$text_status = $lang['invoice_pending'];
							$label_class = "label-warning";
						} else if ($row->status_invoice == 3) {
							$text_status = $lang['verify_payment'];
							$label_class = "label-info";
						}

						$db->cdp_query("SELECT * FROM cdb_address_shipments where order_track='" . $row->order_prefix . $row->order_no . "'");
						$address_order = $db->cdp_registro();

					?>
						<tr class="card-hovera">
							<?php
							if ($userData->userlevel == 9) { ?>
								<td class="chb">
									<?php if ($row->status_courier != 8) { ?>
										<?php if ($row->status_courier != 21) { ?>

											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" value="<?php echo $row->order_no; ?>" name="checkbox[]" id="cst_<?php echo $count; ?>">
												<label class="custom-control-label" for="cst_<?php echo $count; ?>">&nbsp;</label>
											</div>

										<?php } ?>
									<?php } ?>

								</td>
							<?php } ?>
							<td><b><a href="customer_packages_view.php?id=<?php echo $row->order_id; ?>"><?php echo $row->order_prefix . $row->order_no; ?></a></b></td>
							<td class="text-center">
								<?php echo $row->order_date; ?>
							</td>

							<?php
							if ($userData->userlevel != 1) { ?>

								<td class="text-center">
									<?php echo $sender_data->fname; ?> <?php echo $sender_data->lname; ?>
								</td>

							<?php } ?>



							<td class="text-center"><?php echo $address_order->sender_country; ?>-<?php echo $address_order->sender_city; ?></td>
							<td class="text-center"><?php echo $courier_com->name_com; ?></td>

							<td class="text-center">
								<?php echo $row->provider_purchase; ?>
							</td>

							<td class="text-center">
								<?php echo $row->tracking_purchase; ?>
							</td>

							<td class="">

								<?php
								if ($row->is_prealert == 1) { ?>

									<span style="background: #ffa6a6;" class="label label-large">Pre alert</span>

								<?php } ?>
								<span style="background: <?php echo $row->color; ?>;" class="label label-large"><?php echo $row->mod_style; ?></span>

							</td>

							<td>
								<?php

								if ($driver_data != null) {
									echo $driver_data->fname; ?> <?php echo $driver_data->lname;
																} ?>

							</td>


							<td class="text-center">
								<b><?php echo $core->currency; ?></b> <?php echo cdb_money_format($row->total_order); ?>
							</td>

							<td class="text-center">
								<?php if ($row->status_invoice == 2) { ?>
										<?php if ($userData->userlevel == 1) { ?>

										<a style="background: #34e89e;" class="label label" href="add_payment_gateways_package.php?id_order=<?php echo $row->order_id; ?>">
                            			<i style="color:#343a40" class="fas fa-dollar-sign"></i>&nbsp;Add payment</a>
                            		<?php } ?>
                            	<?php } ?>	
							</td>

							<td>
								<span class="label label-large <?php echo $label_class; ?>"><?php echo $text_status; ?></span>

							</td>

							<td align='center'>
								<div class="btn-group">
									<button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown" data-flip="false">Actions
									</button>
									<div class="dropdown-menu scrollable-menu">
										<a class="dropdown-item" href="customer_packages_view.php?id=<?php echo $row->order_id; ?>" title="<?php echo $lang['tooledit'] ?>"><i style="color:#343a40" class="fa fa-search"></i>&nbsp;Show details</a>


										<?php if ($row->status_invoice == 2) { ?>
											<?php if ($userData->userlevel == 1) { ?>



												<a class="dropdown-item" href="add_payment_gateways_package.php?id_order=<?php echo $row->order_id; ?>">
													<i style="color:#343a40" class="fas fa-dollar-sign"></i>&nbsp;Add invoice payment</a>


											<?php } ?>

										<?php } ?>


										<?php if ($row->status_invoice == 3) { ?>
											<?php if ($userData->userlevel != 1) { ?>


												<a class="dropdown-item" data-toggle="modal" data-target="#detail_payment_packages" data-id="<?php echo $row->order_id; ?>" data-customer="<?php echo $row->sender_id; ?>"><i style="color:#343a40" class="fas fa-dollar-sign"></i>&nbsp; Verify payment</a>


											<?php } ?>

										<?php } ?>



										<?php if ($userData->userlevel == 9 || $userData->userlevel == 2) { ?>

											<?php if ($row->status_courier != 8) { ?>
												<?php if ($row->status_invoice != 1) { ?>

													<a class="dropdown-item" href="customer_package_edit.php?id=<?php echo $row->order_id; ?>"><i style="color:#343a40" class="ti-pencil"></i>&nbsp;Edit package</a>
												<?php } ?>
											<?php } ?>

										<?php } ?>


										<?php if ($userData->userlevel == 9 || $userData->userlevel == 2) { ?>
											<?php if ($row->status_courier != 8) { ?>
												<?php if ($row->status_invoice != 1) { ?>
														<a class="dropdown-item" data-id="<?php echo $row->order_id; ?>" href="#" data-toggle="modal" data-target="#myModalDeletesPa"> <i style="color:#f62d51" class="ti-trash"></i>&nbsp;Delete</a>
												<?php } ?>
											<?php } ?>
										<?php } ?>





										<?php if ($row->status_courier != 21) { ?>
											<?php if ($row->status_courier != 12) { ?>


												<?php if ($userData->userlevel != 1) { ?>

													<?php if ($row->status_courier != 8) { ?>


														<a class="dropdown-item" data-toggle="modal" data-target="#modalDriver" data-id_shipment="<?php echo $row->order_id; ?>"><i style="color:#ff0000" class="fas fa-car"></i>&nbsp; <?php echo $lang['left208'] ?></a>
													<?php } ?>
												<?php } ?>


												<a class="dropdown-item" target="blank" href="print_invoice_package.php?id=<?php echo $row->order_id; ?>"> <i style="color:#343a40" class="ti-printer"></i>&nbsp;Print Package</a>

												<a class="dropdown-item" href="print_label_package.php?id=<?php echo $row->order_id; ?>" target="_blank"> <i style="color:#343a40" class="ti-printer"></i>&nbsp;<?php echo $lang['toollabel'] ?> </a>


												<?php if ($row->status_invoice == 1) { ?>

													<?php if ($userData->userlevel != 1) { ?>


														<?php if ($row->status_courier != 8) { ?>
															<?php if ($row->status_courier != 21) { ?>
																<?php if ($row->status_courier != 12) { ?>


																	<a class="dropdown-item" href="customer_package_tracking.php?id=<?php echo $row->order_id; ?>"><i style="color:#20c997" class="ti-reload">&nbsp;</i>Package tracking</a>

																	<a class="dropdown-item" href="customer_package_deliver.php?id=<?php echo $row->order_id; ?>"><i style="color:#2962FF" class="ti-package"></i>&nbsp;Deliver package</a>
																<?php } ?>
															<?php } ?>
														<?php } ?>
													<?php } ?>
												<?php } ?>




												<?php if ($userData->userlevel != 1) { ?>

													<a class="dropdown-item" href="#" data-toggle="modal" data-id="<?php echo $row->order_id; ?>" data-email="<?php echo $sender_data->email; ?>" data-order="<?php echo $row->order_prefix . $row->order_no; ?>" data-target="#myModal"><i class="fas fa-envelope"></i>&nbsp;Send email</a>

												<?php } ?>


											<?php } ?>

										<?php } ?>


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

		<script src="dataJs/customers_packages_ajax.js"></script>

	</div>
<?php } ?>