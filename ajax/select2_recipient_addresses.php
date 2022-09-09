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

$recipient = cdp_sanitize($_REQUEST['id']);

$list = array();
$data = [];

$sql = "SELECT *  FROM cdb_recipients_addresses WHERE recipient_id='" . $recipient . "'";

$db->cdp_query($sql);
$db->cdp_execute();

$datas = $db->cdp_registros();

foreach ($datas as $key) {

	$db->cdp_query("SELECT * FROM cdb_countries where id= '" . $key->country . "'");
	$country = $db->cdp_registro();

	$db->cdp_query("SELECT * FROM cdb_states where id= '" . $key->state . "'");
	$state = $db->cdp_registro();

	$db->cdp_query("SELECT * FROM cdb_cities where id= '" . $key->city . "'");
	$city = $db->cdp_registro();

	$data[] = array(
		'id' => $key->id_addresses,
		'text' => $key->address,
		'country' => $country->name,
		'state' => $state->name,
		'city' => $city->name,
		'zip_code' => $key->zip_code,
	);
}

echo json_encode($data);
