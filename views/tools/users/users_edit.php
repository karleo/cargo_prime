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



$userData = $user->cdp_getUserData();
$office = $core->cdp_getOffices();

if (intval($userData->id) !== intval($_GET['user']) && !$user->cdp_is_Admin()) {
	cdp_redirect_to("login.php");
}

require_once('helpers/querys.php');

if (isset($_GET['user'])) {
	$data = cdp_getUserEdit4bozo($_GET['user']);
}

if (!isset($_GET['user']) or $data['rowCount'] != 1) {
	cdp_redirect_to("login.php");
}

$row_user = $data['data'];


$db->cdp_query("SELECT * FROM cdb_users_multiple_addresses WHERE user_id='" . $_GET['user'] . "'");
$user_addreses = $db->cdp_registros();

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
	<link rel="stylesheet" href="assets/css/input-css/intlTelInput.css">

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

			<!-- ============================================================== -->
			<!-- Bread crumb and right sidebar toggle -->
			<!-- ============================================================== -->
			<div class="page-breadcrumb">
				<div class="row">
					<div class="col-5 align-self-center">
						<h4 class="page-title"><?php echo $lang['tools-config61'] ?> | User List</h4>

					</div>
				</div>
			</div>

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

			<!-- ============================================================== -->
			<!-- End Bread crumb and right sidebar toggle -->
			<!-- ============================================================== -->
			<!-- ============================================================== -->
			<!-- Container fluid  -->
			<!-- ============================================================== -->
			<div class="container-fluid">
				<!-- ============================================================== -->
				<!-- Start Page Content -->
				<!-- ============================================================== -->
				<!-- Row -->



				<div class="row">
					<div class="col-lg-4 col-xlg-3 col-md-5">
						<div class="card">
							<div class="card-body">
								<center class="m-t-30"> <img src="assets/<?php echo ($row_user->avatar) ? $row_user->avatar : "uploads/blank.png"; ?>" class="rounded-circle" width="150" />
									<h4 class="card-title m-t-10"><?php echo $row_user->fname; ?> <?php echo $row_user->lname; ?></h4>
									<h6 class="card-subtitle"><span><?php echo $lang['user_manage2'] ?> <i class="icon-double-angle-right"></i></span>
										<div class="badge badge-pill badge-light font-16"><span class="ti-user text-warning"></span> <?php echo $row_user->username; ?></div>
									</h6>
									<?php if ($userData->userlevel == 9) { ?>

										<h6 class="card-subtitle"><span>Sucursal <i class="icon-double-angle-right"></i></span>
											<div class="badge badge-pill badge-light font-16"> <?php echo $row_user->name_off; ?></div>
										</h6>
									<?php } ?>
								</center>
							</div>
							<div>
								<hr>
							</div>
							<div class="card-body"> <small class="text-muted">Email </small>
								<h6><?php echo $row_user->email; ?></h6> <small class="text-muted p-t-30 db">Phone</small>
								<h6><?php echo $row_user->phone; ?></h6>
							</div>
							<div class="card-body row text-center">
								<div class="col-6 border-right">
									<h6><?php echo $row_user->created; ?></h6>
									<span><?php echo $lang['user-account18'] ?></span>
								</div>
								<div class="col-6">
									<h6><?php echo $row_user->lastlogin; ?></h6>
									<span><?php echo $lang['user-account19'] ?></span>
								</div>
							</div>
						</div>


						<form enctype="multipart/form-data" class="form-horizontal form-material" id="edit_user" name="edit_user" method="post">

							<?php if ($userData->userlevel == 3) { ?>

								<div class="card">
									<div class="card-body">
										<h4 class="card-title m-t-10">User driver license / State ID</h4>

										<div class="row">
											<div class="col-md-4">
												<div>
													<label class="control-label" id="selectItem"> Attach images</label>
												</div>

												<input class="custom-file-input" id="filesMultiple" name="filesMultiple[]" multiple="multiple" type="file" style="display: none;" onchange="cdp_validateZiseFiles(); cdp_preview_images(); verifyCountFiles();" />


												<button type="button" id="openMultiFile" class="btn btn-default  pull-left  mb-4"> <i class='fa fa-paperclip' id="openMultiFile" style="font-size:18px; cursor:pointer;"></i> Upload images </button>

												<input type="hidden" name="total_item_files" id="total_item_files" value="0" />
												<input type="hidden" name="deleted_file_ids" id="deleted_file_ids" />

											</div>
										</div>

										<div class="col-md-12 row" id="image_preview"></div>

										<div class="col-md-4 mt-4">
											<div id="clean_files" class="hide">
												<button type="button" id="clean_file_button" class="btn btn-danger ml-3"> <i class='fa fa-trash' style="font-size:18px; cursor:pointer;"></i> Cancel attachments </button>

											</div>
										</div>

										<div class="row">

											<div class="resultados_file col-md-4 pull-right mt-4">


											</div>
										</div>
									</div>

								</div>
							<?php } ?>



							<?php

							$db->cdp_query("SELECT * FROM cdb_driver_files where driver_id='" . $_GET['user'] . "' ORDER BY date_file");
							$files_order = $db->cdp_registros();
							$numrows = $db->cdp_rowCount();



							if ($numrows > 0) {
							?>
								<div class="row">
									<div class="col-lg-12">
										<div class="card">
											<div class="card-body">
												<h5 class="card-title"><i class="fa fa-paperclip"></i> Attached files preview</h5>
												<hr>
												<div class="col-md-12 row">

													<?php
													$count = 0;
													foreach ($files_order as $file) {

														$date_add = date("Y-m-d h:i A", strtotime($file->date_file));

														$src = 'assets/images/no-preview.jpeg';

														if (
															$file->file_type == 'jpg' ||
															$file->file_type == 'jpeg' ||
															$file->file_type == 'png' ||
															$file->file_type == 'ico'
														) {

															$src = $file->url;
														}

														$count++;
													?>

														<div class="col-md-6" id="file_delete_item_<?php echo $file->id; ?>">

															<img style="width: 180px; height: 180px;" class="img-thumbnail" src="<?php echo $src; ?>">

															<div class="row ">
																<div class=" col-md-12 mb-3 mt-2">
																	<p class="text-justify"><a style="color:#7460ee;" target="_blank" href="<?php echo $file->url; ?>" class=""><?php echo $file->name; ?> </a></p>

																</div>

															</div>

															<div class="row">
																<div class="mb-2">
																	<button type="button" class="btn btn-danger btn-sm" onclick="cdp_deleteImgAttached('<?php echo $file->id; ?>');"><i class="fa fa-trash"></i></button>
																</div>
															</div>
														</div>
													<?php
													} ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php
							} ?>
					</div>



					<div class="col-lg-8 col-xlg-9 col-md-7">
						<div class="card">
							<!-- Tabs -->
							<ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false">Setting profile</a>
								</li>
							</ul>
							<!-- Tabs -->
							<div class="tab-content" id="pills-tabContent">
								<div class="tab-pane fade show active" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
									<div class="card-body">
										<div id="msgholder"></div>
										<section>
											<div class="row">
												<?php if ($userData->userlevel == 9) { ?>
													<div class="col-md-12">
														<div class="form-group">
															<label for="firstName1">Office group</label>
															<input class="custom-select col-12" name="branch_office" id="branch_office" list="browsers1" autocomplete="off" value="<?php echo $row_user->name_off; ?>">
															<datalist id="browsers1">
																<?php foreach ($office as $off) : ?>
																	<option value="<?php echo $off->name_off; ?>"><?php echo $off->name_off; ?></option>
																<?php endforeach; ?>
															</datalist>
														</div>
													</div>
												<?php } else if ($userData->userlevel == 2) { ?>
													<div class="col-md-12">
														<div class="form-group">
															<label for="firstName1">Office group</label>
															<input class="form-control" id="branch_office" name="branch_office" value="<?php echo $user->name_off; ?>" readonly>
														</div>
													</div>
												<?php } ?>

												<div class="col-md-6">
													<div class="form-group">
														<label for="firstName1"><?php echo $lang['user_manage3'] ?></label>
														<input type="text" class="form-control" disabled="disabled" id="username" name="username" readonly="readonly" value="<?php echo $row_user->username; ?>" placeholder="<?php echo $lang['user_manage3'] ?>">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="lastName1"><?php echo $lang['user_manage4'] ?></label>
														<input type="text" class="form-control" id="password" name="password" placeholder="<?php echo $lang['user_manage32'] ?>">
													</div>
												</div>
											</div>
											<?php if ($userData->userlevel == 1) { ?>

												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label for="phoneNumber1">Document type</label>
															<select class="custom-select form-control" id="document_type" name="document_type" value="<?php echo $row_user->document_type; ?>">


																<option value="NIT" <?php if ($row_user->document_type == 'NIT') {
																						echo 'selected';
																					} ?>>NIT</option>



																<option value="CC" <?php if ($row_user->document_type == 'CC') {
																						echo 'selected';
																					} ?>>CC</option>



																<option value="DNI" <?php if ($row_user->document_type == 'DNI') {
																						echo 'selected';
																					} ?>>DNI</option>


																<option value="PASSPORT" <?php if ($row_user->document_type == 'PASSPORT') {
																								echo 'selected';
																							} ?>>PASSPORT</option>
															</select>
														</div>
													</div>


													<div class="col-md-6">
														<div class="form-group">
															<label for="phoneNumber1">Document number</label>
															<input type="text" class="form-control" id="document_number" name="document_number" value="<?php echo $row_user->document_number; ?>" placeholder="Document number">
														</div>
													</div>
												</div>

											<?php } ?>

											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label for="emailAddress1"><?php echo $lang['user_manage6'] ?></label>
														<input type="text" class="form-control" id="fname" name="fname" value="<?php echo $row_user->fname; ?>" placeholder="<?php echo $lang['user_manage6'] ?>">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="phoneNumber1"><?php echo $lang['user_manage7'] ?></label>
														<input type="text" class="form-control" id="lname" name="lname" value="<?php echo $row_user->lname; ?>" placeholder="<?php echo $lang['user_manage7'] ?>">
													</div>
												</div>
											</div>


											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label for="emailAddress1"><?php echo $lang['user_manage5'] ?></label>
														<input type="text" class="form-control" id="email" name="email" value="<?php echo $row_user->email; ?>" placeholder="<?php echo $lang['user_manage5'] ?>">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="phoneNumber1"><?php echo $lang['user_manage9'] ?></label>
														<input type="text" class="form-control" id="phone_custom" name="phone_custom" value="<?php echo $row_user->phone; ?>" placeholder="<?php echo $lang['user_manage9'] ?>">
														<span id="valid-msg" class="hide"></span>
														<div id="error-msg" class="hide text-danger"></div>
													</div>
												</div>

											</div>
											<div class="row">

												<div class="col-md-6">
													<div class="form-group">
														<label for="phoneNumber1"><?php echo $lang['user_manage11'] ?></label>
														<select class="custom-select form-control" id="gender" name="gender" value="<?php echo $row_user->gender; ?>" placeholder="<?php echo $lang['user_manage11'] ?>">
															<option value="Male" <?php if ($row_user->gender == 'Male') {
																						echo 'selected';
																					} ?>>Male</option>
															<option value="Female" <?php if ($row_user->gender == 'Female') {
																						echo 'selected';
																					} ?>>Female</option>
															<option value="Other" <?php if ($row_user->gender == 'Other') {
																						echo 'selected';
																					} ?>>Others</option>
														</select>
													</div>
												</div>
												<?php if ($row_user->userlevel == 9 || $row_user->userlevel == 2) { ?>

													<div class="col-md-6">
														<div class="form-group">
															<label for="emailAddress1"><?php echo $lang['user_manage15'] ?></label>
															<select class="custom-select form-control" id="userlevel" name="userlevel">
																<?php echo $user->cdp_getUserLevels($row_user->userlevel); ?>
															</select>
														</div>
													</div>

												<?php
												}
												?>

												<div class="col-md-6">
													<div class="form-group">
														<label for="lastName1"><?php echo $lang['user_manage24'] ?></label>
														<input class="form-control" name="avatar" id="avatar" type="file" />
													</div>
												</div>
											</div>

											<input type="hidden" name="phone" id="phone" value="<?php echo $row_user->phone; ?>" />

											<div class="row">

												<div class="col-md-6">
													<div class="form-group">
														<label for="phoneNumber1"><?php echo $lang['user_manage20'] ?></label>
														<div class="inline-group">
															<label class="btn">
																<div class="custom-control custom-radio">
																	<input type="radio" id="customRadio4" class="custom-control-input" name="active" value="1" <?php cdp_getChecked($row_user->active, "1"); ?>>
																	<label class="custom-control-label" for="customRadio4"> <?php echo $lang['user_manage16'] ?></label>
																</div>
															</label>
															<label class="btn">
																<div class="custom-control custom-radio">
																	<input type="radio" id="customRadio3" class="custom-control-input" name="active" value="0" <?php cdp_getChecked($row_user->active, "0"); ?>>
																	<label class="custom-control-label" for="customRadio3"> <?php echo $lang['user_manage17'] ?></label>
																</div>
															</label>

														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="phoneNumber1"><?php echo $lang['user_manage23'] ?></label>
														<div class="btn-group" data-toggle="buttons">
															<label class="btn">
																<div class="custom-control custom-radio">
																	<input type="radio" id="customRadio4" name="newsletter" value="1" <?php cdp_getChecked($row_user->newsletter, 1); ?> class="custom-control-input">
																	<label class="custom-control-label" for="customRadio4"> <?php echo $lang['tools-config14'] ?></label>
																</div>
															</label>
															<label class="btn">
																<div class="custom-control custom-radio">
																	<input type="radio" id="customRadio5" name="newsletter" value="0" <?php cdp_getChecked($row_user->newsletter, 0); ?> class="custom-control-input">
																	<label class="custom-control-label" for="customRadio5"> <?php echo $lang['tools-config15'] ?></label>
																</div>
															</label>
														</div>
													</div>
												</div>
											</div>



											<hr />
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="emailAddress1"><?php echo $lang['user_manage28'] ?></label>
														<textarea class="form-control" id="notes" name="notes" rows="6" name="notes" placeholder="<?php echo $lang['user_manage31'] ?>"><?php echo $row_user->notes; ?></textarea>
													</div>
												</div>
											</div>

										</section>
										<div class="form-group">
											<div class="col-sm-12">
												<button class="btn btn-outline-primary btn-confirmation" name="dosubmit" type="submit"><?php echo $lang['user-account20'] ?><span><i class="icon-ok"></i></span></button>
												<a href="users_list.php" class="btn btn-outline-secondary btn-confirmation"><span><i class="ti-share-alt"></i></span> <?php echo $lang['user_manage30'] ?></a>
											</div>
											<input id="id" name="id" type="hidden" value="<?php echo $row_user->id; ?>" />
											<input id="userlevel" name="userlevel" type="hidden" value="<?php echo $row_user->userlevel ?>" />
										</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
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

	<script src="assets/js/input-js/intlTelInput.js"></script>
	<script src="dataJs/users_edit.js"></script>



</body>

</html>