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


$db = new Conexion;
$db->cdp_query("SELECT * FROM cdb_settings");

$db->cdp_execute();
$settings = $db->cdp_registro();
$numrows = $db->cdp_rowCount();

if ($numrows > 0) {

	$files = $settings->language;
	if (empty($_SESSION["languages"])) {

		$language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
		$_SESSION["languages"] = $language;
		if ($language != "en") {
			$_SESSION["languages"] = "en";
		}
	}

	if (isset($_SESSION["languages"])) {
		$language = $_SESSION["languages"];
	}

	switch ($language) {
		case "fr":
			//echo "PAGE FR";
			include("languages/$files.php"); //include check session FR
			break;
		case "br":
			//echo "PAGE BRAZIL";
			include("languages/$files.php");
			break;
		case "he":
			//echo "PAGE ISRAEL";
			include("languages/$files.php");
			break;
		case "es":
			//echo "PAGE ES";
			include("languages/$files.php");
			break;
		case "en":
			//echo "PAGE EN";
			include("languages/$files.php");
			break;
		default:
			//echo "PAGE EN - Setting Default";
			include("languages/$files.php"); //include EN in all other cases of different lang detection
			break;
	}
}
