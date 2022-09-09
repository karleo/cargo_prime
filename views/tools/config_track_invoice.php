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
						<span><?php echo $lang['tools-config61'] ?> | <?php echo $lang['lefttrackin'] ?></span>

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
								<header><b>
										<h4 class="card-title"><b><?php echo $lang['tools-config35'] ?></b></h4>
									</b></header>
								<form class="form-horizontal form-material" id="save_config" name="save_config" method="post">
									<hr />

									<section>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="firstName1"><?php echo $lang['tools-config36'] ?></label>
													<input type="text" title="<?php echo $lang['tools-config37'] ?>" data-toggle="tooltip" class="form-control" name="prefix" id="prefix" value="<?php echo $core->prefix; ?>" placeholder="<?php echo $lang['tools-config40'] ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="lastName1"><i class="mdi mdi-cube-send"></i> <?php echo $lang['tools-config38'] ?></label>
													<input type="text" title="<?php echo $lang['tools-config49'] ?>" data-toggle="tooltip" class="form-control" name="track_digit" id="track_digit" value="<?php echo $core->track_digit; ?>" placeholder="<?php echo $lang['tools-config39'] ?>">
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="firstName1"><?php echo $lang['tools-config71'] ?></label>
													<input type="text" title="<?php echo $lang['tools-config67'] ?>" data-toggle="tooltip" class="form-control" name="prefix_consolidate" id="prefix_consolidate" value="<?php echo $core->prefix_consolidate; ?>" placeholder="<?php echo $lang['tools-config68'] ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="lastName1"><i class="mdi mdi-gift" style="color:#7460ee"></i> <?php echo $lang['tools-config72'] ?></label>
													<input type="text" title="<?php echo $lang['tools-config69'] ?>" data-toggle="tooltip" class="form-control" name="track_consolidate" id="track_consolidate" value="<?php echo $core->track_consolidate; ?>" placeholder="<?php echo $lang['tools-config70'] ?>">
												</div>
											</div>
										</div>



										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="firstName1"><?php echo $lang['tools-config74'] ?></label>
													<input type="text" title="<?php echo $lang['tools-config67'] ?>" data-toggle="tooltip" class="form-control" name="prefix_online_shopping" id="prefix_online_shopping" value="<?php echo $core->prefix_online_shopping; ?>" placeholder="<?php echo $lang['tools-config74'] ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="lastName1"><i class="mdi mdi-gift" style="color:#7460ee"></i> <?php echo $lang['tools-config73'] ?></label>
													<input type="text" title="<?php echo $lang['tools-config73'] ?>" data-toggle="tooltip" class="form-control" name="track_online_shopping" id="track_online_shopping" value="<?php echo $core->track_online_shopping; ?>" placeholder="<?php echo $lang['tools-config73'] ?>">
												</div>
											</div>
										</div>

										<div><br></div>

										<div class="row">
											<div class="col-md-6">
												<label for="firstName1">Default Shipment Code Number Type</label>
												<div class="form-group">

													<div class="btn-group" data-toggle="buttons">
														<label class="btn">
															<div class="custom-control custom-radio">
																<input type="radio" id="customRadio4" name="code_number" value="1" <?php cdp_getChecked($core->code_number, 1); ?> class="custom-control-input">
																<label class="custom-control-label" for="customRadio4"> Auto-incrementing tracking</label>
															</div>
														</label>
														<label class="btn">
															<div class="custom-control custom-radio">
																<input type="radio" id="customRadio5" name="code_number" value="0" <?php cdp_getChecked($core->code_number, 0); ?> class="custom-control-input">
																<label class="custom-control-label" for="customRadio5"> Random (Recommended, for security)</label>
															</div>
														</label>
													</div>
													
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label for="lastName1"><i class="mdi mdi-cube-send"></i> Track digits random</label>
													<input type="text" title="Track digits random" data-toggle="tooltip" class="form-control" name="digit_random" id="digit_random" value="<?php echo $core->digit_random; ?>" placeholder="Track digits random">
												</div>
											</div>
										</div>

										<div><br><br></div>

										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label for="emailAddress1"><?php echo $lang['tools-config42'] ?></label>
													<textarea class="form-control" rows="6" name="interms" id="interms"><?php echo $core->interms; ?></textarea>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="firstName1"><?php echo $lang['tools-config43'] ?></label>
													<input type="text" class="form-control" name="signing_company" id="signing_company" value="<?php echo $core->signing_company; ?>" placeholder="<?php echo $lang['tools-config43'] ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="lastName1"><?php echo $lang['tools-config44'] ?></label>
													<input type="text" class="form-control" name="signing_customer" id="signing_customer" value="<?php echo $core->signing_customer; ?>" placeholder="<?php echo $lang['tools-config44'] ?>">
												</div>
											</div>
										</div>
										<hr />
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
	 

	<script src="dataJs/config_track.js"></script>



	
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
	<script src="dataJs/config_info_ship_default.js"></script> 

</body>

</html>