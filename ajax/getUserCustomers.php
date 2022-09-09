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

$search = cdp_sanitize($_REQUEST['term']);

$sql = "SELECT CONCAT(fname, ' ', lname) as label, id, fname, lname, email, phone, address,country, city, postal FROM cdb_users WHERE fname LIKE '%" . $search . "%'";

$db->cdp_query($sql);
$db->cdp_execute();

$data = $db->cdp_registros();

echo json_encode($data);
