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

$db = new Conexion;

$search = cdp_sanitize($_REQUEST['track']);
$search = intval($search);


$sql_digits = "SELECT * FROM cdb_settings";

$db->cdp_query($sql_digits);
$db->cdp_execute();
$trackd = $db->cdp_registro();

$digits = $trackd->track_digit;

$format_track = str_pad($search, "" . $digits . "", "0", STR_PAD_LEFT);

$sql = "SELECT order_no FROM cdb_customers_packages WHERE order_no = '" . $format_track . "'";

$db->cdp_query($sql);
$db->cdp_execute();

$data = $db->cdp_registro();

if ($data) {

	echo json_encode(true);
} else {

	echo json_encode(false);
}
