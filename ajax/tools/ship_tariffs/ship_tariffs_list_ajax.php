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


$origin = intval($_REQUEST['origin']);
$destiny = intval($_REQUEST['destiny']);

$sWhere = "";

if ($origin > 0) {
	$sWhere .= " and  a.origin = '" . $origin . "'";
}
if ($destiny > 0) {
	$sWhere .= " and  a.destiny = '" . $destiny . "'";
}

// $sWhere .= " order_service_options LIKE '%" . $search . "%'";


// // pagination variables
$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
$per_page = 10; //how much records you want to show
$adjacents  = 4; //gap between pages after number of adjacents
$offset = ($page - 1) * $per_page;

$sql = "SELECT a.id, a.origin, a.destiny, a.state, a.city, a.initial_range, a.final_range, a.price FROM `cdb_shipping_fees` as a 
		INNER JOIN cdb_countries as b ON a.origin = b.id 
		INNER JOIN cdb_countries as c on a.destiny = c.id
		$sWhere
		order by a.id desc 
";


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
				<th><b>Origin</b></th>
				<th><b>Destiny</b></th>
				<th><b>Starting weight range</b></th>
				<th><b>final weight range</b></th>
				<th><b>Tariff price</b></th>
				<th><b>Action</b></th>
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

				$db->cdp_query("SELECT * FROM cdb_countries where id= '" . $row->origin . "'");
				$origin = $db->cdp_registro();

				$db->cdp_query("SELECT * FROM cdb_countries where id= '" . $row->destiny . "'");
				$destiny = $db->cdp_registro();

				$db->cdp_query("SELECT * FROM cdb_states where id= '" . $row->state . "'");
				$destinystate = $db->cdp_registro();


				$db->cdp_query("SELECT * FROM cdb_cities where id= '" . $row->city . "'");
				$destinycity = $db->cdp_registro();

			?>
				<tr>
					<td><?php echo $origin->name; ?></td>
					<td><?php echo $destiny->name.' -'. $destinystate->name.' - '. $destinycity->name; ?></td>
					<td><?php echo  number_format($row->initial_range, 2, '.', '.'); ?></td>
					<td><?php echo  number_format($row->final_range, 2, '.', '.'); ?></td>
					<td><?php echo  number_format($row->price, 2, '.', '.'); ?></td>
					<td class="text-center">
						<a href="shipping_tariffs_edit.php?id=<?php echo $row->id; ?>"><i class="ti-pencil" aria-hidden="true"></i></a>
						<a id="item_<?php echo $row->id; ?>" onclick="cdp_eliminar('<?php echo $row->id; ?>');" class="delete" data-rel="<?php echo $row->order_service_options; ?>"><i class="ti-close" aria-hidden="true"></i></a>
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