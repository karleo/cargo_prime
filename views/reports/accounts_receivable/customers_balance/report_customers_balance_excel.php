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



header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Report-customers_balance_" . date('d-m-Y') . ".xls");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);



$db = new Conexion;

$customer_id = intval($_REQUEST['customer_id']);
$range = cdp_sanitize($_REQUEST['range']);


$sWhere = "";


if ($customer_id > 0) {

    $sWhere .= " and b.sender_id = '" . $customer_id . "'";
}


if (!empty($range)) {

    $fecha =  explode(" - ", $range);
    $fecha = str_replace('/', '-', $fecha);

    $fecha_inicio = date('Y-m-d', strtotime($fecha[0]));
    $fecha_fin = date('Y-m-d', strtotime($fecha[1]));


    $sWhere .= " and  b.order_date between '" . $fecha_inicio . "'  and '" . $fecha_fin . "'";
}

$sql = "SELECT a.id, b.order_id, a.lname,a.fname, b.order_prefix, b.order_no FROM cdb_users as a
    INNER JOIN cdb_add_order as b on a.id =b.sender_id
    where b.order_payment_method!=1 
    $sWhere
    group by a.id

     ";


$query_count = $db->cdp_query($sql);
$db->cdp_execute();
$numrows = $db->cdp_rowCount();


$db->cdp_query($sql);
$data = $db->cdp_registros();

$fecha = str_replace('-', '/', $fecha);

$html = '
	<html>
		<body>
		
		<h2>' . $core->site_name . '<br>
		Customers balance report <br>

		[' . $fecha[0] . ' - ' . $fecha[1] . ']
		
		</h2>


		<table border=1>
		<tbody>
			<tr style="background-color: #3e5569; color: white">				
				<th><b></b></th>
				<th>Customer</th>
				<th><b>Balance</b></th>				
			</tr>';

if ($numrows > 0) {

    $count = 0;
    $order_pagado = 0;
    $order_total = 0;
    $sumador_balance = 0;

    foreach ($data as $row) {

        $db->cdp_query('SELECT  total_order, order_id FROM cdb_add_order WHERE sender_id=:id and  order_payment_method!=1 ');

        $db->bind(':id', $row->id);

        $db->cdp_execute();

        $a = $db->cdp_registros();

        foreach ($a as $key) {

            $db->cdp_query('SELECT  IFNULL(sum(total), 0)  as total  FROM cdb_charges_order WHERE order_id=:order_id');

            $db->bind(':order_id', $key->order_id);

            $db->cdp_execute();

            $sum_payment = $db->cdp_registro();

            $order_pagado += $sum_payment->total;

            $order_total += $key->total_order;


            $total_balance = $order_total - $order_pagado;
        }
        $sumador_balance += $total_balance;



        $count++;

        $order_pagado = 0;
        $order_total = 0;




        $html .= '<tr>';
        $html .= '<td ><b>' . $count . '</b></td>';
        $html .= '<td>' . $row->fname . ' ' . $row->lname . '</td>';
        $html .= '<td>' . cdb_money_format_bar($total_balance) . '</td>';
        $html .= '</tr>';
    }

    $html .= '<tr>';
    $html .= '<td><b>TOTAL</td> </b>';
    $html .= '<td></td>';
    $html .= '<td><b>' . cdb_money_format_bar($sumador_balance) . ' </b></td>';
    $html .= '</tr>';
}

$html .= '</table></html>';
echo utf8_decode($html);
