	<header class="topbar">
		<nav class="navbar top-navbar navbar-expand-md navbar-dark">
			<div class="navbar-header">
				<!-- This is for the sidebar toggle which is visible on mobile only -->
				<a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
				<!-- ============================================================== -->
				<!-- Logo -->
				<!-- ============================================================== -->
				<a class="navbar-brand" href="index.php">
					<!-- Logo text -->
					<span class="logo-text">
						<!-- dark Logo text -->
						<?php echo ($core->logo) ? '<img src="assets/' . $core->logo . '" alt="' . $core->site_name . '" width="' . $core->thumb_w . '" height="' . $core->thumb_h . '"/>' : $core->site_name; ?>
					</span>
				</a>

				<!-- ============================================================== -->
				<!-- End Logo -->
				<!-- ============================================================== -->
				<!-- ============================================================== -->
				<!-- Toggle which is visible on mobile only -->
				<!-- ============================================================== -->
				<a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
			</div>
			<!-- ============================================================== -->
			<!-- End Logo -->
			<!-- ============================================================== -->
			<div class="navbar-collapse collapse" id="navbarSupportedContent">
				<!-- ============================================================== -->
				<!-- toggle and nav items -->
				<!-- ============================================================== -->
				<ul class="navbar-nav float-left mr-auto">
					<li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>

				</ul>


				<!-- ============================================================== -->
				<!-- Right side toggle and nav items -->
				<!-- ============================================================== -->
				<ul class="navbar-nav float-right">
					<!-- ============================================================== -->
					<!-- create new -->
					<!-- ============================================================== -->
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<?php if ($core->language == "en") { ?>
								<img src="assets/icon-flag/us.png" width="34" />
							<?php } else if ($core->language == "es") { ?>
								<img src="assets/icon-flag/es.png" width="34" />
							<?php } else if ($core->language == "he") { ?>
								<img src="assets/icon-flag/he.png" width="34" />
							<?php } ?>
						</a>
					</li>
					<!-- ============================================================== -->
					<!-- Comment -->
					<!-- ============================================================== -->

					<li class="nav-item dropdown">
						<a id="clickme" class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

							<img src="assets/images/alert/bell.png" width="26" /><span class="badge badge-notify badge-sm up badge-light pull-top-xs" id="countNotifications">0</span>


						</a>

						<div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
							<div id="ajax_response"></div>

						</div>

					</li>


					<!-- ============================================================== -->
					<!-- User profile and search -->
					<!-- ============================================================== -->
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/<?php echo ($userData->avatar) ? $userData->avatar : "uploads/blank.png"; ?>" class="rounded-circle" width="50" />&nbsp; <i class="fa fa-caret-down"></i></a>
						<div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
							<span class="with-arrow"><span class="bg-primary"></span></span>
							<div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
								<div class=""><img src="assets/<?php echo ($userData->avatar) ? $userData->avatar : "uploads/blank.png"; ?>" class="rounded-circle" width="80" /> </div>
								<div class="m-l-10">
									<h4 class="m-b-0"><?php echo $userData->username; ?></h4>
									<p class=" m-b-0"><?php echo $userData->email; ?></p>
								</div>
							</div>

							<?php
							if ($userData->userlevel == 9 || $userData->userlevel == 2) {
							?>
								<a class="dropdown-item" href="users_edit.php?user=<?php echo $userData->id; ?>"><i class="ti-user m-r-5 m-l-5"></i> <?php echo $lang['miprofile'] ?></a>
							<?php
							} else	if ($userData->userlevel == 1) {

							?>
								<a class="dropdown-item" href="customers_edit.php?user=<?php echo $userData->id; ?>"><i class="ti-user m-r-5 m-l-5"></i> <?php echo $lang['miprofile'] ?></a>
							<?php

							} else	if ($userData->userlevel == 3) {

							?>
								<a class="dropdown-item" href="drivers_edit.php?user=<?php echo $userData->id; ?>"><i class="ti-user m-r-5 m-l-5"></i> <?php echo $lang['miprofile'] ?></a>
							<?php
							}
							?>


							<div class="dropdown-divider"></div>
							<?php
							if ($userData->userlevel == 9) {
							?>
								<a class="dropdown-item" href="users_list.php"><i class="ti-settings m-r-5 m-l-5"></i> <?php echo $lang['accountset'] ?></a>
								<div class="dropdown-divider"></div>
							<?php
							}
							?>

							<a class="dropdown-item" href="logout.php"><i class="fa fa-power-off m-r-5 m-l-5"></i>
								<?php echo $lang['logoouts'] ?></a>
						</div>
					</li>
					<!-- ============================================================== -->
					<!-- User profile and search -->
					<!-- ============================================================== -->
				</ul>
			</div>
		</nav>
	</header>

	<audio id="chatAudio">
		<source src="assets/notify.mp3" type="audio/mpeg">
	</audio>


	<script src="dataJs/load_notifications_all.js"> </script>