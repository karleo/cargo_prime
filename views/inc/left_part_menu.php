	
    <style>
    .menutext {
        color: #666;
        overflow:hidden;
    }
    </style>

	<aside class="left-part">
        <a class="ti-menu ti-close btn btn-success show-left-part d-block d-md-none" href="javascript:void(0)"></a>
        <div class="scroll-sidebar">

			<div class="p-15">
				<a id="compose_mail" class="waves-effect waves-light btn btn-danger d-block" href=""><?php echo $lang['apis04'] ?></a>
			</div>

			<div class="divider"></div>
			<!-- Sidebar navigation-->
			<nav class="sidebar-nav idebar-collapse">

			<?php if ($userData->userlevel == 9) { ?>
				
					<ul class="list-group" id="sidebarnav">

						<li>
							<small class="p-15 grey-text text-lighten-1 db"></small>
						</li>
						<li class="list-group-item">
							<a href="tools.php?list=config_general" class="list-group-item-action"><i class="mdi mdi-settings-box"></i> <?php echo $lang['left601'] ?></a>
						</li>
						<li class="list-group-item">
							<a href="tools.php?list=config" class="list-group-item-action"><i class="mdi mdi-briefcase-check"></i> <?php echo $lang['setcompany'] ?></a>
						</li>
						<li class="list-group-item">
							<a href="tools.php?list=config_email" class="list-group-item-action"><i class="mdi mdi-email"></i> <?php echo $lang['leftemail'] ?></a>
						</li>

						<li class="list-group-item sidebar-item"><a class="list-group-item-action has-arrow waves-effect waves-dark" href="javascript:void(0)"> <i class="mdi mdi-playlist-plus"></i>  <?php echo $lang['template'] ?></a>

							<ul aria-expanded="false" class="collapse  first-level">
								<li class="list-group-item sidebar-item"><a href="templates_email.php" class="sidebar-link"><i class="ti ti-check" style="color:#975EF7"></i><span class="menutext"> <?php echo $lang['emailtemplate'] ?></span></a></li>
							</ul>
						</li>


						<li class="list-group-item sidebar-item"><a class="list-group-item-action has-arrow waves-effect waves-dark" href="javascript:void(0)"> <i class="mdi mdi-playlist-plus"></i> <?php echo $lang['apis03'] ?></a>
							<ul aria-expanded="false" class="collapse  first-level">

								<li class="list-group-item sidebar-item"><a href="activate_whatsapp.php" class="sidebar-link"><i class="ti ti-check" style="color:#975EF7"></i><span class="menutext">Activate Twilio Whatssap</span></a></li>


								<li class="list-group-item sidebar-item"><a href="config_twilio.php" class="sidebar-link"><i class="ti ti-check" style="color:#975EF7"></i><span class="menutext">Config Twilio Whatssap</span></a></li>

							</ul>
						</li>


						<li class="list-group-item sidebar-item"><a class="list-group-item-action has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"> <i class="mdi mdi-playlist-plus"></i><?php echo $lang['leftorder255'] ?></a>
							<ul aria-expanded="false" class="collapse  first-level">

								<li class="list-group-item sidebar-item"><a href="activate_sms.php" class="sidebar-link"><i class="ti ti-check" style="color:#975EF7"></i><span class="menutext">Activate Twilio SMS</span></a></li>


								<li class="list-group-item sidebar-item"><a href="config_sms.php" class="sidebar-link"><i class="ti ti-check" style="color:#975EF7"></i><span class="menutext">Config Twilio SMS</span></a></li>

								<li class="list-group-item sidebar-item"><a href="templates_sms.php" class="sidebar-link"><i class="ti ti-check" style="color:#975EF7"></i><span class="menutext">Templates SMS</span></a></li>

							</ul>
						</li>

						<li class="list-group-item">
							<a href="backup.php" class="list-group-item-action"> <i class="mdi mdi-backup-restore"></i> <?php echo $lang['restorbackup'] ?> </a>
						</li>
						<li class="list-group-item">
							<hr>
						</li>

					</ul>
				
				<?php } ?>
				</nav>
			</div>
		</aside>