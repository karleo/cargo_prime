<!-- ============================================================== -->
<!-- Right Part contents-->
<!-- ============================================================== -->
<div class="right-part mail-list bg-white">
	<div class="p-15 b-b">
		<div class="d-flex align-items-center">
			<div>
				<span><?php echo $lang['tools-config61'] ?> | Setup SMTP Email</span>
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
						<div id="loader" style="display:none"></div>
						<div id="resultados_ajax"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Action part -->

	<div class="row justify-content-center">
		<div class="col-lg-12">
			<div class="row">
				<!-- Column -->
				<div class="col-12">
					<div class="card-body">
						<header><b><?php echo $lang['tools-config57'] ?></b></header>
						<form class="form-horizontal form-material" id="save_config" name="save_config" method="post">
							<hr />

							<h4 class="card-title">Type</h4>
							<h6 class="card-subtitle">(<?php echo $lang['tools-config54'] ?>)</h6>

							<div class="row">
								<section class="col-md-12">
									<select class="form-control is-valid" name="mailer" id="mailer">
										<option value="PHP" <?php if ($core->mailer == "PHP") echo " selected=\"selected\""; ?>>Sendmail</option>
										<option value="SMTP" <?php if ($core->mailer == "SMTP") echo " selected=\"selected\""; ?>>SMTP Mailer</option>
									</select>
								</section>
							</div>
							<hr />
							<br><br>


							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="form-control-label" for="inputSuccess1">Mail From Name</label>
										<input type="text" class="form-control" name="smtp_names" id="smtp_names" value="<?php echo $core->smtp_names; ?>" placeholder="Mail From Name">
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label for="lastName1">Mail From Address</label>
										<input type="text" class="form-control" name="email_address" id="email_address" value="<?php echo $core->email_address; ?>" placeholder="Mail From Address">
									</div>
								</div>
							</div>


							<div class="row showsmtp">
								<div class="col-md-12">
									<div class="form-group">
										<h4 class="card-title">SMTP Settings</h4>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label for="lastName1">Mail Host</label>
										<input type="text" class="form-control" name="smtp_host" id="smtp_host" value="<?php echo $core->smtp_host; ?>" placeholder="Mail Host">
									</div>
								</div>


								<div class="col-md-12">
									<div class="form-group">
										<label for="firstName1">Mail Username</label>
										<input type="text" class="form-control" name="smtp_user" id="smtp_user" value="<?php echo $core->smtp_user; ?>" placeholder="Mail Username">
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label for="firstName1">Mail Password</label>
										<input type="text" class="form-control" name="smtp_password" id="smtp_password" value="<?php echo $core->smtp_password; ?>" placeholder="Mail Password">
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label for="firstName1">Mail Port - (<b>Recommended port <span class="badge badge-info">587</span></b>)</label>
										<input type="text" class="form-control" name="smtp_port" id="smtp_port" value="<?php echo $core->smtp_port; ?>" placeholder="Mail Port">
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label for="firstName1">Mail Encryption</label>
										<input type="text" class="form-control" name="smtp_secure" id="smtp_secure" value="<?php echo $core->smtp_secure; ?>" placeholder="Mail Encryption">
									</div>
								</div>

							</div>

							<div class="form-group">
								<div class="col-sm-12">
									<button type="submit" class="btn btn-primary btn-confirmation" name="dosubmit"><?php echo $lang['tools-config56'] ?> <span><i class="icon-ok"></i></span></button>
								</div>
							</div>

						</form>
					</div>
				</div>
				<!-- Column -->
			</div>
		</div>
	</div>
	<div class="p-15 m-t-30">

	</div>
</div>

<script src="dataJs/config_email.js"></script>