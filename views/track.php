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



require_once('helpers/querys.php');




if (isset($_GET['order_track'])) {

	$results = cdp_getCourierTrack($_GET['order_track']);

	$track = $results['data'];
} else {

	cdp_redirect_to("tracking.php");
}



$db->cdp_query("

	SELECT a.id, a.order_track, a.t_dest, a.t_date, a.t_city, a.comments, a.status_courier, b.mod_style FROM cdb_courier_track as a

	INNER JOIN cdb_styles as b ON a.status_courier = b.id 

	where a.order_track='" . $_GET['order_track'] . "' ORDER BY a.t_date");

$courier_track = $db->cdp_registros();
if ($track != null) {




	$db->cdp_query("SELECT * FROM cdb_users where id= '" . $track->sender_id . "'");
	$sender_data = $db->cdp_registro();

	$db->cdp_query("SELECT * FROM cdb_users where id= '" . $track->receiver_id . "'");
	$receiver_data = $db->cdp_registro();

	$db->cdp_query("SELECT * FROM cdb_delivery_time where id= '" . $track->order_deli_time . "'");
	$delivery_time = $db->cdp_registro();


	$db->cdp_query("SELECT * FROM cdb_address_shipments where order_track='" . $track->order_prefix . $track->order_no . "'");
	$address_order = $db->cdp_registro();


	$db->cdp_query("SELECT SUM(order_item_length) as total0 from cdb_add_order_item where order_id='" . $track->order_id . "'");
	$db->cdp_execute();
	$row0 = $db->cdp_registro();

	$rw_add0 = $row0->total0;


	// volumetric query of the box width

	$db->cdp_query("SELECT SUM(order_item_width) as total1 from cdb_add_order_item where order_id='" . $track->order_id . "'");
	$db->cdp_execute();
	$row1 = $db->cdp_registro();

	$rw_add1 = $row1->total1;

	// volumetric query of the box width

	$db->cdp_query("SELECT SUM(order_item_height) as total2 from cdb_add_order_item where order_id='" . $track->order_id . "'");
	$db->cdp_execute();
	$row2 = $db->cdp_registro();

	$rw_add2 = $row2->total2;

	$length = $rw_add0; //Length
	$width = $rw_add1; //Width
	$height = $rw_add2; //Height


	$total_metric = $length * $width * $height / $track->volumetric_percentage;


	$db->cdp_query("SELECT * FROM cdb_add_order_item WHERE order_id='" . $track->order_id . "'");
	$order_items = $db->cdp_registros();



	$sumador_libras = 0;
	$sumador_volumetric = 0;
	$count = 0;
	foreach ($order_items as $row_item) {

		$weight_item = $row_item->order_item_weight;

		$item_description = $row_item->order_item_description;

		$total_metric = $row_item->order_item_length * $row_item->order_item_width * $row_item->order_item_height / $track->volumetric_percentage;

		// calculate weight x price
		if ($weight_item > $total_metric) {

			$calculate_weight = $weight_item;
			$sumador_libras += $weight_item; //Sumador

		} else {

			$calculate_weight = $total_metric;
			$sumador_volumetric += $total_metric; //Sumador
		}

		$count++;
	}
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="keywords" content="Courier DEPRIXA-Integral Web System">
	<meta name="author" content="Jaomweb">
	<meta name="description" content="">
	<!-- For IE -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- For Resposive Device -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- For Window Tab Color -->
	<!-- Chrome, Firefox OS and Opera -->
	<meta name="theme-color" content="#fff">
	<!-- Windows Phone -->
	<meta name="msapplication-navbutton-color" content="#fff">
	<!-- iOS Safari -->
	<meta name="apple-mobile-web-app-status-bar-style" content="#fff">
	<title>Track Shipment Result | <?php echo $core->site_name; ?></title>
	<!-- favicon -->
	<link rel="icon" type="image/png" sizes="16x16" href="assets/<?php echo $core->favicon; ?>">
    <!-- Bootstrap -->
    <link href="assets/css_main_deprixa/main_deprixa/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons -->
    <link href="assets/css_main_deprixa/main_deprixa/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" /> 
    <!-- Main css --> 
    <link href="assets/css_main_deprixa/main_deprixa/css/style.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="assets/css_main_deprixa/main_deprixa/css/styles.css">
	<link rel="stylesheet" href="assets/css_main_deprixa/css/bundle.css">
	<link rel="stylesheet" type="text/css" href="assets/css_main_deprixa/main_deprixa/main.css">
	<link rel="stylesheet" href="assets/css_main_deprixa/main_deprixa/themify-icons.css">
	<link rel="stylesheet" href="assets/custom_dependencies/track_online_shopping.css">



	<script>
		function mostrarMensaje(id) {
			var popup = document.getElementById("myPopup_" + id);
			popup.classList.toggle("show");
		}
	</script>

</head>

<body>

	<!-- Loader -->
	<div id="preloader">
		<div id="status">
			<div class="spinner">
				<div class="double-bounce1"></div>
				<div class="double-bounce2"></div>
			</div>
		</div>
	</div>
	<!-- Loader -->

	<!-- Navbar STart -->
	<header id="topnav" class="defaultscroll sticky">
		<div class="container">
			<!-- Logo container-->
			<div>
				<a class="logo" href="index.php">

					<?php echo ($core->logo) ? '<img src="assets/' . $core->logo . '" alt="' . $core->site_name . '" width="' . $core->thumb_w . '" height="' . $core->thumb_h . '"/>' : $core->site_name; ?>
						
						
					</a>
			</div>
			<div class="buy-button">
				<a href="index.php" class="btn btn-secondary btn-sm"> <?php echo $lang['left180'] ?></a>
			</div> 
			<!--end login button-->
			<div class="menu-extras">
				<div class="menu-item">
					<!-- Mobile menu toggle-->
					<a class="navbar-toggle">
						<div class="lines">
							<span></span>
							<span></span>
							<span></span>
						</div>
					</a>
					<!-- End mobile menu toggle-->
				</div>
			</div>
		</div>
	</header>
	<!-- Navbar End -->


	<!-- ERROR PAGE -->
	<section class="bg-home">
		<div class="home-center">
			<div class="home-desc-center">
				<div class="container">
					<div class="checkout-form">
						<div class="row">
							<?php if (!$track) : ?>

								<!--============================= TRACKING NOT FOUND =============================-->
								<div class="col-lg-12">
									<div class="user-profile-data">
										<div class="row justify-content-center">
											<?php echo "
									<div class='col-lg-8 col-md-12 text-center'>
										<img src='assets/images/alert/ohh_shipment_rate.png' class='img-fluid' alt=''/>
										<div class='text-uppercase mt-4 display-4'>Oh ! no</div>
										<div class='text-capitalize text-dark mb-4 display-6'>" . $lang['track-shipment1'] . " <strong style='color:#FF0000;'>" . $_GET['order_track'] . " </strong></div>
										<p class='text-muted para-desc mx-auto'><span class='text-primary font-weight-bold'>" . $lang['track-shipment2'] . "</span></p>
									</div>
								", false; ?>
										</div>

										<div class="row">
											<div class="col-md-12 text-center">
												<a href="tracking.php" class="btn btn-light-outline rounded mt-4"><?php echo $lang['left182'] ?></a>
												<a href="index.php" class="btn btn-light rounded mt-4 ml-2"><?php echo $lang['left183'] ?></a>
											</div>
										</div>
									</div>
								</div>
								<!--//END TRACKING NOT FOUND -->
							<?php else : ?>

								<div class="col-lg-7">
									<div class="user-profile-data">

										<br><br><br>
										<div class="row">
											<div class="col-md-3">
												<div class="trackstatus-title">
													<p><span class="ti-package align-top" style="font-size: 30px;"></span> <b><?php echo $track->mod_style; ?></b></p>
													<label> </label>
												</div>
											</div>
											<div class="col-md-5">
												<div class="trackstatus-title">
													<label><?php echo $lang['track-shipment4'] ?> <b><?php echo $track->order_prefix . $track->order_no; ?></b></label>
												</div>
											</div>

											<div class="col-md-4">
												<div class="trackstatus-title">

													<a class="btn btn-secondary btn-sm" target="blank" href="print_inv_ship_track.php?id=<?php echo $track->order_id; ?>"><i style="color:white" class="ti-printer"></i>&nbsp;<?php echo $lang['toolprint'] ?></a>

												</div>
											</div>
										</div>

										<?php

										$db->cdp_query("SELECT * FROM cdb_order_files where order_id='" . $track->order_id . "' ORDER BY date_file");
										$files_order = $db->cdp_registros();
										$numrows = $db->cdp_rowCount();


										if ($numrows > 0) {
										?>
											<div class="payment-wrap">
												<div class="row">
													<div class="col-md-12">
														<div class="track-title">
															<h5 class="form_sub" style="background-color: #5a6d90; border-radius: 3px; color:white">Photo delivered</h5>
														</div>
													</div>

													<?php

													if (!empty($track->photo_delivered)) { ?>

														<div class="col-md-12">
															<img src="<?php echo $track->photo_delivered; ?>" style="max-width:100%;width:auto;height:auto;">
														</div>
													<?php
													} ?>
												</div>

											</div>

											<div class="payment-wrap">
												<div class="row">
													<div class="col-md-12">
														<div class="track-title">
															<h5 class="form_sub" style="background-color: #5a6d90; border-radius: 3px; color:white">Attached files</h5>
														</div>
													</div>

													<div class="table-responsive">
														<table id="zero_config" class="table table-sm">
															<thead>
																<tr>
																	<th class="text-left"> <b> Nº </b></th>
																	<th class="text-left"> <b> File </b></th>

																</tr>
															</thead>
															<tbody id="projects-tbl">

																<?php
																$count = 0;
																foreach ($files_order as $file) {

																	$date_add = date("Y-m-d h:i A", strtotime($file->date_file));



																	$count++;
																?>

																	<tr class="">
																		<td><b><?php echo $count; ?></b></td>
																		<td> <b><a style="color:#7460ee;" target="_blank" href="<?php echo $file->url; ?>" class=""><?php echo $file->name; ?> </a> </b></td>

																	</tr>
																<?php
																} ?>


															</tbody>
														</table>
													</div>
												</div>


											</div>

										<?php
										} ?>


										<!-- General Information -->
										<div class="payment-wrap">
											<div class="row">
												<div class="col-md-12">
													<div class="track-title">
														<h5 class="form_sub" style="background-color: #5a6d90; border-radius: 3px; color:white"><?php echo $lang['track-shipment5'] ?></h5>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="track-title">
														<span class="ti-location-pin align-top" style="font-size: 30px;"></span> <label><?php echo $lang['track-shipment6'] ?></br> <b><?php echo $address_order->sender_country; ?></b></label>
													</div>
												</div>
												<div class="col-md-6">
													<div class="track-title">
														<span class="ti-location-pin align-top" style="font-size: 30px;"></span> <label><?php echo $lang['track-shipment7'] ?></br> <b><?php echo $address_order->sender_city; ?></b></label>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="track-title">
														<span class="ti-calendar align-top" style="font-size: 30px;"></span> <label><?php echo $lang['track-shipment8'] ?></br> <b><?php echo $track->order_date; ?></b></label>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<div class="track-title">
															<span class="ti-timer align-top" style="font-size: 30px;"></span> <label><?php echo $lang['track-shipment9'] ?></br> 
																<b><?php if ($delivery_time != null) {
																	echo $delivery_time->delitime;
																} ?></b></label>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="track-title">
														<label><?php echo $lang['track-shipment20'] ?></br> <b><?php echo $sender_data->fname . " " . $sender_data->lname; ?></b></label>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<div class="track-title">
															<span class="ti-direction-alt align-top" style="font-size: 30px;"></span> <label><?php echo $lang['track-shipment10'] ?></br> <b><?php echo $address_order->sender_address; ?></b></label>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="track-title">
														<label><?php echo $lang['track-shipment11'] ?></br> <b><?php echo $count; ?></b></label>
													</div>
												</div>

												<div class="col-md-6">
													<div class="form-group">
														<div class="track-title">
															<label><?php echo $lang['track-shipment13'] ?></br> <b>
															<?php if ($sumador_libras > $sumador_volumetric) {
																echo  cdp_round_out($sumador_libras);
															} else {
																echo cdp_round_out($sumador_volumetric);
															} ?></b></label>
														</div>
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<div class="track-title">
															<span class="ti-comment-alt align-top" style="font-size: 30px;"></span> <label>Description</br> <b><?php echo $item_description; ?></b></label>
														</div>
													</div>
												</div>
											</div>

										</div>
										<!--// General Information -->

										<!-- track shipment -->
										<div class="payment-wrap">
											<div class="row">
												<div class="col-md-12">
													<div class="track-title">
														<h5 class="form_sub" style="background-color: #5a6d90; border-radius: 3px; color:white"><?php echo $lang['track-shipment15'] ?></h5>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="track-title">
														<span class="ti-location-pin align-top" style="font-size: 30px;"></span> <label><?php echo $lang['track-shipment16'] ?></br> <b><?php echo $address_order->recipient_city; ?></b></label>
													</div>
												</div>
												<div class="col-md-6">
													<div class="track-title">
														<span class="ti-location-pin align-top" style="font-size: 30px;"></span> <label><?php echo $lang['track-shipment17'] ?></br> <b><?php echo $address_order->recipient_city; ?></b></label>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="track-title">
														<span class="ti-calendar align-top" style="font-size: 30px;"></span> <label><?php echo $lang['track-shipment9'] ?></br> 
															<b><?php if ($delivery_time != null) {
																echo $delivery_time->delitime;
													} ?></b><</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<div class="track-title">
															<span class="ti-timer align-top" style="font-size: 30px;"></span> <label><?php echo $lang['track-shipment19'] ?></br> <b><?php echo $track->order_datetime; ?></b></label>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="track-title">

														<label><?php echo $lang['track-shipment20'] ?></br> <b><?php echo $receiver_data->fname . " " . $receiver_data->lname; ?></b></label>

													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<div class="track-title">
															<span class="ti-direction-alt align-top" style="font-size: 30px;"></span> <label><?php echo $lang['track-shipment10'] ?></br> <b><?php echo $address_order->recipient_address; ?></b></label>
														</div>
													</div>
												</div>
											</div>
										</div>

									</div> <!-- /.user-profile-data -->
								</div> <!-- /.col- -->

								
							<?php if (!$courier_track) : ?>
								<?php else : ?>
								<div class="col-lg-5">
									<br><br><br>
									<div class="booking-summary_block">
										<div class="booking-summary-box">
											<h5><?php echo $lang['track-shipment22'] ?></h5>
											<?php foreach ($courier_track  as $rows) : ?>
												<div class="track-cost">
													<ul class="timeline a">
														<li class="event">
															<div class="row">
																<div class="col-md-7">
																	<p class="text-left button5"><?php echo date('Y/m/d', strtotime($rows->t_date)); ?></p>
																	<h6 class="text-left button4">
																		<?php echo $rows->mod_style; ?>
																		<br>
																		<?php

																		if ($rows->t_dest != null) {
																			echo $rows->t_dest;
																		}

																		if ($rows->t_city != null) {
																			echo ', ' . $rows->t_city;
																		}

																		?>
																		<br>
																		+ <?php echo $rows->comments; ?>

																	</h6>
																
																</div>
																<div class="col-md-5">
																	<p class="text-right button5"><?php echo date('h:i:s a', strtotime($rows->t_date)); ?></p>
																	<h4></h4>
																</div>
															</div>
														</li>
														<!--event schedule 1 end-->
													</ul>
												</div>
											<?php endforeach; ?>
											<?php unset($row); ?>
										<?php endif; ?>
										</div>
									</div>
								</div>

							<?php endif; ?>

						</div> <!-- /.row -->
					</div> <!-- /.checkout-form -->
				</div> <!-- /.container -->
			</div>
		</div>
	</section>

	
	<!-- ERROR PAGE -->

	<!-- Back to top -->
	<a href="#" class="back-to-top rounded text-center" id="back-to-top">
		<i class="ti-angle-up d-block"> </i>
	</a>
	<!-- Back to top -->


	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<!-- jQuery -->
	<script src="assets/vendor/jquery.2.2.3.min.js"></script>
	<!-- Popper js -->
	<script src="assets/vendor/popper.js/popper.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!-- menu  -->
	<script src="assets/vendor/mega-menu/assets/js/custom.js"></script>
	<!-- js ui -->
	<script src="assets/vendor/jquery-ui/jquery-ui.min.js"></script>
	<script src="assets/css_main_deprixa/js/bootstrap.bundle.min.js"></script>
	<script src="assets/css_main_deprixa/js/jquery.easing.min.js"></script>
	<script src="assets/css_main_deprixa/js/scrollspy.min.js"></script>
	<!-- Main Js -->
	<script src="assets/css_main_deprixa/js/app.js"></script>
	<!-- Theme js -->
	<script src="assets/css_main_deprixa/js/theme.js"></script>

	</div> <!-- /.main-page-wrapper -->
</body>

</html>