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

$status_courier = intval($_REQUEST['status_courier']);
$range = cdp_sanitize($_REQUEST['range']);
$employee_id = intval($_REQUEST['employee_id']);


$sWhere = "";


if ($status_courier > 0) {

	$sWhere .= " and  a.status_courier = '" . $status_courier . "'";
}

if ($employee_id > 0) {

	$sWhere .= " and a.user_id = '" . $employee_id . "'";
}

if (!empty($range)) {

	$fecha =  explode(" - ", $range);
	$fecha = str_replace('/', '-', $fecha);

	$fecha_inicio = date('Y-m-d', strtotime($fecha[0]));
	$fecha_fin = date('Y-m-d', strtotime($fecha[1]));


	$sWhere .= " and  a.order_date between '" . $fecha_inicio . "'  and '" . $fecha_fin . "'";
}

$sql = "SELECT  a.total_declared_value, a.agency, a.origin_off, a.total_weight, a.sub_total, a.total_tax_discount, a.total_tax_insurance, a.total_tax_custom_tariffis, a.total_tax,  a.tracking_purchase, a.provider_purchase, a.price_purchase, a.status_invoice, a.total_order, a.order_id, a.order_prefix, a.order_no, a.order_date, a.sender_id, a.order_courier, a.order_pay_mode, a.status_courier, a.driver_id, a.order_service_options,  b.mod_style, b.color FROM
			 cdb_customers_packages as a
			 INNER JOIN cdb_styles as b ON a.status_courier = b.id
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


		<table id="zero_config" class="table-sm table table-condensed table-hover table-striped custom-table-checkbox">
			<thead>
				<tr style="background-color: #3e5569; color: white">

					<th><b><?php echo $lang['ltracking'] ?></b></th>
					<th class="text-center"><b><?php echo $lang['ddate'] ?></b></th>
					<th class="text-center"><b>Agency</b></th>
					<th class="text-center"><b>Office</b></th>
					<th class="text-center"><b><?php echo $lang['lstatusshipment'] ?></b></th>
					<th class="text-center"><b>Weight</b></th>
					<th class="text-center"><b>Subtotal</b></th>
					<th class="text-center"><b>Discount</b></th>
					<th class="text-center"><b>Insurance</b></th>
					<th class="text-center"><b>Customs tariffs</b></th>
					<th class="text-center"><b>Tax</b></th>
					<th class="text-center"><b>Declared tax</b></th>
					<th class="text-center"><b>Total</b></th>
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
					$sumador_weight = 0;
					$sumador_subtotal = 0;
					$sumador_discount = 0;
					$sumador_insurance = 0;
					$sumador_c_tariff = 0;
					$sumador_tax = 0;
					$sumador_total = 0;
					$sumador_declared_tax = 0;
					foreach ($data as $row) {



						$db->cdp_query("SELECT * FROM cdb_offices where id= '" . $row->origin_off . "'");
						$offices = $db->cdp_registro();


						$db->cdp_query("SELECT * FROM cdb_branchoffices where id= '" . $row->agency . "'");
						$branchoffices = $db->cdp_registro();


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



						$weight = $row->total_weight;
						$sub_total = $row->sub_total;
						$discount = $row->total_tax_discount;
						$insurance = $row->total_tax_insurance;
						$custom_c = $row->total_tax_custom_tariffis;
						$tax = $row->total_tax;
						$total = $row->total_order;
						$total_declared_tax = $row->total_declared_value;

						$sumador_weight += $weight;
						$sumador_subtotal += $sub_total;
						$sumador_discount += $discount;
						$sumador_insurance += $insurance;
						$sumador_c_tariff += $custom_c;
						$sumador_tax += $tax;
						$sumador_total += $total;
						$sumador_declared_tax += $total_declared_tax;


					?>


						<tr class="card-hover">

							<td><b><a href="customer_packages_view.php?id=<?php echo $row->order_id; ?>"><?php echo $row->order_prefix . $row->order_no; ?></a></b></td>
							<td class="text-center">
								<?php echo $row->order_date; ?>
							</td>




							<td class="text-center"><?php if ($branchoffices != null) {
														echo $branchoffices->name_branch;
													} ?></td>

							<td class="text-center">
								<?php if ($offices != null) {
									echo $offices->name_off;
								} ?>
							</td>

							<td class="">

								<?php
								if ($package_prealert != null) { ?>

									<span style="background: #ffa6a6;" class="label label-large">Pre alert</span>

								<?php } ?>

								<span style="background: <?php echo $row->color; ?>;" class="label label-large"><?php echo $row->mod_style; ?></span>


							</td>

							<td class="text-center">
								<?php echo $row->total_weight; ?>

							</td>

							<td class="text-center">
								<?php echo cdb_money_format_bar($row->sub_total); ?>

							</td>

							<td class="text-center">
								<?php echo cdb_money_format_bar($row->total_tax_discount); ?>

							</td>

							<td class="text-center">
								<?php echo cdb_money_format_bar($row->total_tax_insurance); ?>

							</td>

							<td class="text-center">
								<?php echo cdb_money_format_bar($row->total_tax_custom_tariffis); ?>

							</td>

							<td class="text-center">
								<?php echo cdb_money_format_bar($row->total_tax); ?>

							</td>

							<td class="text-center">
								<?php echo cdb_money_format_bar($row->total_declared_value); ?>

							</td>


							<td class="text-center">
								<b><?php echo $core->currency; ?></b> <?php echo cdb_money_format($row->total_order); ?>
							</td>

							<td>
								<span class="label label-large <?php echo $label_class; ?>"><?php echo $text_status; ?></span>

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
						<b> <?php echo $sumador_weight; ?> </b>

					</td>

					<td class="text-center">
						<b> <?php echo cdb_money_format($sumador_subtotal); ?> </b>

					</td>

					<td class="text-center">
						<b> <?php echo cdb_money_format($sumador_discount); ?> </b>

					</td>

					<td class="text-center">
						<b> <?php echo cdb_money_format($sumador_insurance); ?> </b>

					</td>

					<td class="text-center">
						<b> <?php echo cdb_money_format($sumador_c_tariff); ?> </b>

					</td>

					<td class="text-center">
						<b> <?php echo cdb_money_format($sumador_tax); ?> </b>

					</td>

					<td class="text-center">
						<b> <?php echo cdb_money_format($sumador_declared_tax); ?> </b>

					</td>


					<td class="text-center">
						<b><?php echo cdb_money_format($sumador_total); ?> </b>
					</td>

				</tr>
			</tfoot>

		</table>




	</div>
<?php } ?>