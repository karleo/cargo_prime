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



	require_once ("../../../loader.php");

	$db = new Conexion;
	$user = new User;
	$core = new Core;
	$userData = $user->cdp_getUserData();

	$year = date('Y');

	$data = array();


	for ($month = 1; $month <= 12; $month ++){

    	$sql="SELECT IFNULL(SUM(total_order), 0) as total FROM cdb_customers_packages WHERE status_courier!=21 and month(order_date)='$month' AND year(order_date)='$year'"; 
	       
        $db->cdp_query($sql); 
        $total_data= $db->cdp_registro();

		$data[] = number_format($total_data->total, 2,'.','');
        
    }
	echo json_encode($data);
