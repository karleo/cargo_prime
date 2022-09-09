<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link type='text/css' href='assets/custom_dependencies/print_consolidate.css' rel='stylesheet' />

	<title>Print multiple consolidated</title>

</head>

<body onload="window.print();">
	<div id="page-wrap">

		<?php

		$userData = $user->cdp_getUserData();

		require_once('helpers/querys.php');

		if (!isset($_GET['data'])) {

			cdp_redirect_to("consolidate_list.php");
		}


		if (isset($_GET['data'])) {

			$data = json_decode($_GET['data']);

			foreach ($data as $key) {

				$data_key = cdp_getConsolidatePrintMultiple($key);


				$row_order = $data_key['data'];


				$db->cdp_query("SELECT * FROM cdb_shipping_mode where id= '" . $row_order->order_service_options . "'");
				$order_service_options = $db->cdp_registro();

				$db->cdp_query("SELECT * FROM cdb_users where id= '" . $row_order->sender_id . "'");
				$sender_data = $db->cdp_registro();

				$db->cdp_query("SELECT * FROM cdb_recipients where id= '" . $row_order->receiver_id . "'");
				$receiver_data = $db->cdp_registro();


				$db->cdp_query("SELECT * FROM cdb_address_shipments where order_track='" . $row_order->c_prefix . $row_order->c_no . "'");
				$address_order = $db->cdp_registro();

				$db->cdp_query("SELECT * FROM cdb_delivery_time where id= '" . $row_order->order_deli_time . "'");
				$delivery_time = $db->cdp_registro();

				$db->cdp_query("SELECT * FROM cdb_styles where id= '" . $row_order->status_courier . "'");
				$status_courier = $db->cdp_registro();

				$db->cdp_query("SELECT * FROM cdb_courier_com where id= '" . $row_order->order_courier . "'");
				$courier_com = $db->cdp_registro();
		?>

				<table class="table" style=" margin-left: auto; margin-right: auto; font-family:Arial, Helvetica, sans-serif;" border="0" width="100%">
					<tbody>
						<tr>
							<td>
								<table style="text-align: center; table-layout:fixed;" cellspacing="2" width="100%">
									<tbody>
										<tr>
											<td width="75%">
												<p style="text-align: left;">
													<font size=6 face="arial"><strong><?php echo $order_service_options->ship_mode; ?></strong></font>
												</p>
											</td>
											<td width="25%">
												<p style="text-align: center;">


													<?php echo ($core->logo) ? '<img src="assets/' . $core->logo . '" alt="' . $core->site_name . '" width="' . $core->thumb_w . '" height="' . $core->thumb_h . '"/>' : $core->site_name; ?>

												</p>
											</td>
										</tr>
									</tbody>
								</table>
								<hr />
								<table width="100%" style="text-align: center; table-layout:fixed;">
									<tbody>
										<tr bgcolor="#6c757d">
											<td width="50%">
												<p style="text-align: center;"><strong>
														<font color="white" size="5"><?php echo $lang['inv-label1'] ?></font>
													</strong></p>
											</td>
											<td width="50%">
												<p style="text-align: center;">
													<font size="5" face="arial" color="white"><strong><?php echo $lang['inv-label2'] ?></strong></font>
												</p>
											</td>
										</tr>
										<tr>
											<font size=4>
												<td align="center" style=" border-top-color:#000000; border-right-color:#333; border-right-width:2px;border-right-style:solid;  border-collapse: collapse;">
													<p style="text-align: left;">
														<font size="4"><b><?php echo $core->site_name; ?></b></font>
													</p>
													<p style="text-align: left; "><?php echo $core->c_phone; ?></p>
													<p style="text-align: left; "><strong><?php echo $core->site_email; ?> </strong></p>
													<p style="text-align: left;">
														<font size=5><strong><?php echo $core->c_address; ?> - <?php echo $core->c_country; ?>-<?php echo $core->c_city; ?></strong></font>
													</p>
												</td>
												<td>
													<p style="text-align: left;">
														<font size="4"><b>&nbsp;&nbsp;&nbsp; <?php echo $receiver_data->fname . ' ' . $receiver_data->lname; ?></b></font>
													</p>
													<p style="text-align: left;">&nbsp;&nbsp;&nbsp;<?php echo $receiver_data->phone; ?></p>
													<p style="text-align: left; "><strong>&nbsp;&nbsp;&nbsp;<?php echo $address_order->recipient_address; ?> </strong></p>
													<p style="text-align: left;">
														<font size=5><strong>&nbsp;&nbsp;<?php echo $address_order->recipient_country; ?></strong></font>
													</p>
												</td>
											</font>
										</tr>
									</tbody>
								</table>
								<hr />
								<table style="text-align: center;" width="100%">
									<tbody>
										<tr>
											<td width="50%">
												<p><strong><?php echo $lang['inv-label4'] ?></strong></p>
												<p>
													<font size=4><b><?php echo $delivery_time->delitime; ?></b></font>
												</p>
											</td>
											<td width="50%">
												<p><strong><?php echo $lang['inv-label5'] ?></strong></p>
												<p>
													<font size=4><strong><b><?php echo $courier_com->name_com; ?></b></strong>
												</p>
											</td>
										</tr>
									</tbody>
								</table>

								<center width="100%">
									<div class="output">
										<p style='padding:5px; text-align:center; font-size:24px; font-family:Arial,Helvetica;'><?php echo $lang['inv-label8'] ?></p>
										<section class="output">
											<img src='https://barcode.tec-it.com/barcode.ashx?data=<?php echo $row_order->c_prefix . $row_order->c_no; ?>&code=Code39&multiplebarcodes=false&translate-esc=false&unit=Fit&dpi=150&imagetype=Gif&rotation=0&color=%23000000&bgcolor=%23ffffff&qunit=Mm&quiet=0&modulewidth=50' alt='<?php echo $row_order->c_prefix . $row_order->c_no; ?>' />
										</section>
									</div>
								</center>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='https://barcode.tec-it.com/barcode.ashx?data=<?php echo $row_order->c_prefix . $row_order->c_no; ?> &code=QRCode&multiplebarcodes=false&translate-esc=false&unit=Fit&dpi=120&imagetype=Gif&rotation=0&color=%23000000&bgcolor=%23ffffff&qunit=Mm&quiet=0&modulewidth=120&eclevel=L' alt='<?php echo $row_order->c_prefix . $row_order->c_no; ?> ' />
							</td>
						</tr>
					</tbody>
				</table>
				<br><br><br><br><br><br><br>


		<?php
			}
		} ?>
	</div>


</body>

</html>