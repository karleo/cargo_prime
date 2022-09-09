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



require_once("../loader.php");

$user = new User;
$db = new Conexion;
$userData = $user->cdp_getUserData();
$sWhere = "";

$sWhere .= " and a.user_id ='" . $_SESSION['userid'] . "'";


// // pagination variables
$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
$per_page = 10; //how much records you want to show
$adjacents  = 4; //gap between pages after number of adjacents
$offset = ($page - 1) * $per_page;

$sql = "SELECT b.user_id,  b.shipping_type,  a.id_notifi_user, b.notification_description, b.notification_date , b.order_id , a.notification_status, a.notification_read, b.notification_id

		FROM cdb_notifications_users as a

		INNER JOIN cdb_notifications as b ON a.notification_id = b.notification_id

		$sWhere
		order by b.notification_id desc";

$query_count = $db->cdp_query($sql);
$db->cdp_execute();
$numrows = $db->cdp_rowCount();


$db->cdp_query($sql . " limit $offset, $per_page");
$data = $db->cdp_registros();

$total_pages = ceil($numrows / $per_page);


if ($numrows > 0) { ?>

	<div class="table-responsive">

		<table id="zero_config" class="table table-condensed table-hover table-striped" data-pagination="true" data-page-size="5">
			<thead>
				<tr>
					<th class="tex-center"><b>Date</b></th>
					<th class="tex-center"><b>Sender</b></th>
					<th class="tex-center"><b>Notification</b></th>
					<th class="tex-center"><b>Status</b></th>
					<th class="tex-center"><b></b></th>
				</tr>
			</thead>


			<?php if (!$data) { ?>
				<tr>
					<td colspan="6">
						<?php echo "
				<i align='center' class='display-3 text-warning d-block'><img src='assets/images/alert/ohh_shipment.png' width='150' /></i>								
				", false; ?>
					</td>
				</tr>
			<?php } else { ?>
				<?php foreach ($data as $row) {

					if ($row->notification_read == 1) {

						$label = 'label label-inverse';
						$text = 'Readed';
					} else {

						$label = 'label label-success';
						$text = 'New';
					}

					$href = '';


					switch ($row->shipping_type) {
						case '1':
							# code...
							$href = 'courier_view.php?id=' . $row->order_id . '&id_notification=' . $row->notification_id;

							break;

						case '2':
							# code...
							$href = 'consolidate_view.php?id=' . $row->order_id . '&id_notification=' . $row->notification_id;

							break;

						case '3':
							# code...
							$href = 'prealert_list.php?id_notification=' . $row->notification_id;

							break;

						case '4':
							# code...
							$href = 'customer_packages_view.php?id=' . $row->order_id . '&id_notification=' . $row->notification_id;

							break;



						default:
							# code...
							$href = 'users_edit.php?user=' . $row->user_id;

							break;
					}





					$db->cdp_query("SELECT * FROM cdb_users where id= '" . $row->user_id . "'");
					$sender_data = $db->cdp_registro();


					$role = '';

					switch ($sender_data->userlevel) {
						case '1':
							$role = 'Client';
							break;

						case '2':

							$role = 'Employee';

							break;

						case '3':

							$role = 'Driver';

							break;

						case '9':

							$role = 'System Administration';

							break;

						default:
							# code...
							break;
					}


				?>
					<tr>
						<td class="tex-center"><?php echo $row->notification_date; ?></td>
						<td class="tex-center"><?php echo $role; ?></td>
						<td class="tex-center"><?php echo $row->notification_description; ?></td>
						<td class="tex-center"><span class="<?php echo $label; ?>"><?php echo $text; ?></span></s></td>
						<td> <a href="<?php echo $href; ?>" class="btn btn-info btn-sm"><i class="fa fa-search"></i></a></td>

					</tr>
				<?php } ?>

			<?php } ?>

		</table>


		<div class="pull-right">
			<?php echo cdp_paginate($page, $total_pages, $adjacents);	?>
		</div>
	</div>
	</div>
<?php } ?>