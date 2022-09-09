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



require_once("../../../loader.php");

$db = new Conexion;


$search = cdp_sanitize($_REQUEST['search']);

$tables = "cdb_styles";
$fields = "*";

$sWhere = "";


$sWhere .= " mod_style LIKE '%" . $search . "%'";


$sWhere .= " order by mod_style desc";

// // pagination variables
$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
$per_page = 10; //how much records you want to show
$adjacents  = 4; //gap between pages after number of adjacents
$offset = ($page - 1) * $per_page;

$sql = "SELECT $fields FROM  $tables where $sWhere";
$query_count = $db->cdp_query($sql);
$db->cdp_execute();
$numrows = $db->cdp_rowCount();


$db->cdp_query($sql . " limit $offset, $per_page");
$data = $db->cdp_registros();

$total_pages = ceil($numrows / $per_page);


if ($numrows > 0) { ?>


	<table id="zero_config" class="table table-condensed table-hover table-striped" data-pagination="true" data-page-size="5">
		<thead>
			<tr>
				<th data-sort-initial="true" data-toggle="true"><b><?php echo $lang['tools-statuscourier13'] ?></b></th>
				<th data-hide="Description"><b><?php echo $lang['tools-statuscourier14'] ?></b></th>
				<th data-hide="Button"><b><?php echo $lang['tools-statuscourier15'] ?></b></th>
				<th data-sort-ignore="true" class="text-center"><b><?php echo $lang['tools-statuscourier16'] ?></b></th>
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
			<?php foreach ($data as $row) { ?>
				<tr>
					<td><?php echo $row->mod_style; ?></td>
					<td><?php echo $row->detail; ?></td>
					<td><span style="background: <?php echo $row->color; ?>;" class="label label-large"><?php echo $row->color; ?></span></td>
					<td class="text-center">
						<?php if ($row->mod_style == 'Pending') { ?>
						<?php } else if ($row->mod_style == 'Delivered') { ?>
						<?php } else if ($row->mod_style == 'Approved') { ?>
						<?php } else if ($row->mod_style == 'Rejected') { ?>
						<?php } else if ($row->mod_style == 'Pick up') { ?>
						<?php } else if ($row->mod_style == 'Picked up') { ?>
						<?php } else if ($row->mod_style == 'No Picked up') { ?>
						<?php } else if ($row->mod_style == 'Quotation') { ?>
						<?php } else if ($row->mod_style == 'In Transit') { ?>
						<?php } else if ($row->mod_style == 'Pre Alert') { ?>
						<?php } else if ($row->mod_style == 'Invoiced') { ?>
						<?php } else if ($row->mod_style == 'Consolidate') { ?>
						<?php } else if ($row->mod_style == 'Cancelled') { ?>
						<?php } else if ($row->mod_style == 'Pending payment') { ?>
						<?php } else { ?>
							<a href="status_courier_edit.php?id=<?php echo $row->id; ?>" data-toggle="tooltip" data-original-title="<?php echo $lang['tools-statuscourier18'] ?>"><i class="ti-pencil" aria-hidden="true"></i></a>
							<a id="item_<?php echo $row->id; ?>" onclick="cdp_eliminar('<?php echo $row->id; ?>');" class="delete" data-rel="<?php echo $row->mod_style; ?>" data-toggle="tooltip" data-original-title="<?php echo $lang['tools-statuscourier19'] ?>"><i class="ti-close" aria-hidden="true"></i></a>
						<?php } ?>
					</td>
				</tr>
			<?php } ?>

		<?php } ?>

	</table>


	<div class="pull-right">
		<?php echo cdp_paginate($page, $total_pages, $adjacents);	?>
	</div>
	</div>
<?php } ?>