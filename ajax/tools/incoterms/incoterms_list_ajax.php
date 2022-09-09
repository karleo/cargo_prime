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


$search = trim($_REQUEST['search']);

$tables = "cdb_incoterm";
$fields = "*";

$sWhere = "";


$sWhere .= " inco_name LIKE '%" . $search . "%'";


$sWhere .= " order by id desc";

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
				<th data-sort-initial="true" data-toggle="true"><b><?php echo $lang['tools-incoterms11'] ?></b></th>
				<th data-hide="Description"><b><?php echo $lang['tools-incoterms12'] ?></b></th>
				<th data-sort-ignore="true" class="text-center"><b><?php echo $lang['tools-incoterms13'] ?></b></th>
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
					<td><?php echo $row->inco_name; ?></td>
					<td><?php echo $row->detail; ?></td>
					<td class="text-center">
						<a href="incoterms_edit.php?id=<?php echo $row->id; ?>" data-toggle="tooltip" data-original-title="<?php echo $lang['tools-shipline15'] ?>"><i class="ti-pencil" aria-hidden="true"></i></a>
						<a onclick="cdp_eliminar('<?php echo $row->id; ?>')" id="item_<?php echo $row->id; ?>" class="delete" data-rel="<?php echo $row->inco_name; ?>" data-toggle="tooltip" data-original-title="<?php echo $lang['tools-shipline16'] ?>"><i class="ti-close" aria-hidden="true"></i></a>
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