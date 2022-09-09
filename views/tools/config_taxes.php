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



if (!$user->cdp_is_Admin())
	cdp_redirect_to("login.php");

$userData = $user->cdp_getUserData();

?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="assets/<?php echo $core->favicon ?>">
	<title><?php echo $lang['tools-config61'] ?> | <?php echo $core->site_name ?></title>
	<!-- This Page CSS -->
	<!-- Custom CSS -->
	<link href="assets/css/style.min.css" rel="stylesheet">

	<link href="assets/css/front.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="assets/js/jquery.js"></script>
	<script type="text/javascript" src="assets/js/jquery-ui.js"></script>
	<script src="assets/js/jquery.ui.touch-punch.js"></script>
	<script src="assets/js/jquery.wysiwyg.js"></script>
	<script src="assets/js/global.js"></script>
	<script src="assets/js/custom.js"></script>
	<link href="assets/customClassPagination.css" rel="stylesheet">




</head>

<body>
	<!-- ============================================================== -->
	<!-- Preloader - style you can find in spinners.css -->
	<!-- ============================================================== -->


	<?php include 'views/inc/preloader.php'; ?>
	<!-- ============================================================== -->
	<!-- Main wrapper - style you can find in pages.scss -->
	<!-- ============================================================== -->
	<div id="main-wrapper">
		<!-- ============================================================== -->
		<!-- Topbar header - style you can find in pages.scss -->
		<!-- ============================================================== -->

		<!-- ============================================================== -->
		<!-- Preloader - style you can find in spinners.css -->
		<!-- ============================================================== -->

		<?php include 'views/inc/topbar.php'; ?>

		<!-- End Topbar header -->


		<!-- Left Sidebar - style you can find in sidebar.scss  -->

		<?php include 'views/inc/left_sidebar.php'; ?>


		<!-- End Left Sidebar - style you can find in sidebar.scss  -->




		<!-- Page wrapper  -->
		<!-- ============================================================== -->
		<div class="page-wrapper">

			<div class="page-breadcrumb">
				<div class="row">
					<div class="col-5 align-self-center">
						<span><?php echo $lang['tools-config61'] ?> | <?php echo $lang['leftfees'] ?></span>

					</div>
				</div>
			</div>

			<!-- Action part -->
			<!-- Button group part -->
			<div class="bg-light p-15">
				<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="row">
							<div class="col-12">
								<!-- <div id="loader" style="display:none"></div> -->
								<div id="resultados_ajax"></div>

							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Action part -->


			<div class="container-fluid">

				<div class="row">
					<!-- Column -->

					<div class="col-lg-12 col-xl-12 col-md-12">

						<div class="card">
							<div class="card-body">
								<form class="form-horizontal form-material" id="save_config" name="save_config" method="post">
									<hr />
									<h4 class="card-title"><b><?php echo $lang['tools-config45'] ?></b></h4>
									<section>
										<div class="row">

											<div class="col-md-6">
												<div class="form-group">
													<label for="lastName1"><b style="color:#ff0000"><?php echo $core->currency; ?></b> Minimum cost to apply tax</label>
													<input type="text" class="form-control" name="min_cost_tax" id="min_cost_tax" value="<?php echo $core->min_cost_tax; ?>" placeholder="Minimum cost to apply tax">
												</div>
											</div>


											<div class="col-md-6">
												<div class="form-group">
													<label for="firstName1"><i class="fas fa-percent" style="color:#ff0000"></i> <?php echo $lang['tools-config46'] ?></label>
													<input type="text" class="form-control" name="tax" name="id" value="<?php echo $core->tax; ?>" placeholder="<?php echo $lang['tools-config46'] ?>">
												</div>
											</div>
										</div>

										<div class="row">

											<div class="col-md-6">
												<div class="form-group">
													<label for="lastName1"><b style="color:#ff0000"><?php echo $core->currency; ?></b> Minimum cost to apply declared tax</label>
													<input type="text" class="form-control" name="min_cost_declared_tax" id="min_cost_declared_tax" value="<?php echo $core->min_cost_declared_tax; ?>" placeholder="Minimum cost to apply tax">
												</div>
											</div>


											<div class="col-md-6">
												<div class="form-group">
													<label for="firstName1"><i class="fas fa-percent" style="color:#ff0000"></i> Declared Tax</label>
													<input type="text" class="form-control" name="declared_tax" id="declared_tax" value="<?php echo $core->declared_tax; ?>" placeholder="Declared Tax">
												</div>
											</div>
										</div>

										<div class="row">


											<div class="col-md-6">
												<div class="form-group">
													<label for="lastName1"><i class="fas fa-percent" style="color:#ff0000"></i> <?php echo $lang['tools-config47'] ?></label>
													<input type="text" class="form-control" name="insurance" id="insurance" value="<?php echo $core->insurance; ?>" placeholder="<?php echo $lang['tools-config48'] ?>">
												</div>
											</div>
											

											<div class="col-md-6">
												<div class="form-group">
													<label for="firstName1"><i class="fas fa-percent" style="color:#ff0000"></i> <?php echo $lang['langs_081'] ?></label>
													<input type="text" class="form-control" name="c_tariffs" id="c_tariffs" value="<?php echo $core->c_tariffs; ?>" placeholder="<?php echo $lang['langs_081'] ?>">
												</div>
											</div>

										</div>

										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<label for="firstName1"><i class="ti-package" style="color:#ff0000"></i> <?php echo $lang['tools-config50'] ?> <b>L x W x H / <?php echo $core->meter; ?></b></label>
													<input type="text" class="form-control" name="meter" id="meter" value="<?php echo $core->meter; ?>" placeholder="Volumetric">
												</div>
											</div>

											<div class="col-md-3">
												<div class="form-group">
													<label for="lastName1"> length units</label>
													<select class="custom-select form-control" name="units" id="units">
													<optgroup label="Select length units">
														<option value="cm" <?php if ($core->units == "cm") echo " selected=\"selected\""; ?> > Centimeter</option>
														<option value="m" <?php if ($core->units == "m") echo " selected=\"selected\""; ?> > Meter</option>
														<option value="Pie" <?php if ($core->units == "Pie") echo " selected=\"selected\""; ?> > Pie</option>
														<option value="in" <?php if ($core->units == "in") echo " selected=\"selected\""; ?> > Inch</option>
													</optgroup>
												</select>
												</div>
											</div>


											<div class="col-md-3">
												<div class="form-group">
													<label for="lastName1"><b style="color:#ff0000"><?php echo $core->currency; ?></b> <?php echo $lang['tools-config58'] ?></label>
													<input type="text" class="form-control" name="value_weight" id="value_weight" value="<?php echo $core->value_weight; ?>" placeholder="<?php echo $lang['tools-config58'] ?>">
												</div>
											</div>

											<div class="col-md-3">
												<div class="form-group">
													<label for="lastName1"> Weight units</label>
													<select class="custom-select form-control" name="weight_p" id="weight_p">
													<optgroup label="Select weight units">
														<option value="kg" <?php if ($core->weight_p == "kg") echo " selected=\"selected\""; ?> > Kilo</option>
														<option value="lb" <?php if ($core->weight_p == "lb") echo " selected=\"selected\""; ?> > Pound</option>
													</optgroup>
												</select>
												</div>
											</div>
										</div>


									</section>
									<div class="form-group">
										<div class="col-sm-12">
											<button type="submit" class="btn btn-primary btn-confirmation" name="dosubmit"><?php echo $lang['tools-config56'] ?> <span><i class="icon-ok"></i></span></button>
										</div>
									</div>
								</form>



							</div>
						</div>
					</div>
					<!-- Column -->
				</div>
			</div>


		</div>
		<!-- ============================================================== -->
		<!-- End Page wrapper  -->
		<!-- ============================================================== -->
	</div>
	<!-- ============================================================== -->
	<!-- End Wrapper -->
	<!-- ============================================================== -->


	<!-- ============================================================== -->
	<!-- All Jquery -->
	<!-- ============================================================== -->
	<!-- Bootstrap tether Core JavaScript -->
	<script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
	<script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- apps -->
	<script src="assets/js/app.min.js"></script>
	<script src="assets/js/app.init.js"></script>
	<script src="assets/js/app-style-switcher.js"></script>
	<!-- slimscrollbar scrollbar JavaScript -->
	<script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
	<script src="assets/js/sparkline/sparkline.js"></script>
	<!--Wave Effects -->
	<script src="assets/js/waves.js"></script>
	<!--Menu sidebar -->
	<script src="assets/js/sidebarmenu.js"></script>
	<!--Custom JavaScript -->
	<script src="assets/js/custom.min.js"></script>

	<script src="dataJs/config_taxes.js"></script>
</body>

</html>