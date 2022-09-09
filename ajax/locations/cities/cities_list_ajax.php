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

$tables = "cdb_cities";
$fields = "*";

$sWhere = "";


$sWhere .= " name LIKE '%" . $search . "%'";



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
                <th><b>State</b></th>
                <th data-sort-initial="true" data-toggle="true"><b>City</b></th>
                <th></th>

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

                $db->cdp_query("SELECT * FROM cdb_states where id= '" . $row->state_id . "'");
                $state = $db->cdp_registro();

                $db->cdp_query("SELECT * FROM cdb_countries where id= '" . $state->country_id . "'");
                $country = $db->cdp_registro();
            ?>
                <tr>
                    <td><?php echo $row->name; ?></td>
                    <td><?php echo $state->name; ?></td>
                    <td class="text-center">
                        <a href="cities_edit.php?id=<?php echo $row->id; ?>"><i class="ti-pencil" aria-hidden="true"></i></a>
                        <a id="item_<?php echo $row->id; ?>" onclick="cdp_eliminar('<?php echo $row->id; ?>');" class="delete"><i class="ti-close" aria-hidden="true"></i></a>
                    </td>
                </tr>
            <?php } ?>

        <?php } ?>

    </table>


    <div class="pull-right">
        <?php echo cdp_paginate($page, $total_pages, $adjacents);    ?>
    </div>
    </div>
<?php } ?>