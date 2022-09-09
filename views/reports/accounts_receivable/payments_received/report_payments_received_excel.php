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
header("Content-Disposition: attachment; filename=Report-payments_received_" . date('d-m-Y') . ".xls");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);



$db = new Conexion;

$customer_id = intval($_REQUEST['customer_id']);
$pay_mode = intval($_REQUEST['pay_mode']);
$range = $_REQUEST['range'];


$sWhere = "";


if ($customer_id > 0) {

	$sWhere .= " and b.sender_id = '" . $customer_id . "'";
}


if ($pay_mode > 0) {

	$sWhere .= " and a.payment_type = '" . $pay_mode . "'";
}


if (!empty($range)) {

	$fecha =  explode(" - ", $range);
	$fecha = str_replace('/', '-', $fecha);

	$fecha_inicio = date('Y-m-d', strtotime($fecha[0]));
	$fecha_fin = date('Y-m-d', strtotime($fecha[1]));


	$sWhere .= " and  a.charge_date between '" . $fecha_inicio . "'  and '" . $fecha_fin . "'";
}

$sql = "SELECT c.lname, c.fname, a.id_charge, b.order_prefix, b.order_no, a.payment_type, a.charge_date, a.total FROM cdb_charges_order as a 
		INNER JOIN cdb_add_order as b ON a.order_id = b.order_id
		INNER JOIN cdb_users as c ON c.id = b.sender_id
		$sWhere
		order by a.id_charge
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
		Payments received report <br>

		[' . $fecha[0] . ' - ' . $fecha[1] . ']
		
		</h2>


		<table border=1>
		<tbody>
			<tr style="background-color: #3e5569; color: white">				
				<th><b></b></th>
				<th class="text-center"><b>Payment number</b></th>	
				<th><b>' . $lang['ddate'] . '</b></th>
				<th class="text-center"><b>Customer</b></th>
				<th class="text-center"><b>Pay mode</b></th>
				<th><b>' . $lang['ltracking'] . '</b></th>
				<th class="text-center"><b>Amount</b></th>				
			</tr>';

if ($numrows > 0) {

	$count = 0;
	$sumador_total = 0;

	foreach ($data as $row) {

		$db->cdp_query('SELECT  * FROM cdb_met_payment WHERE id=:id');

		$db->bind(':id', $row->payment_type);

		$db->cdp_execute();

		$met_payment = $db->cdp_registro();


		$sumador_total += $row->total;

		$count++;



		$html .= '<tr>';
		$html .= '<td >' . $count . '</td>';
		$html .= '<td >' . $row->id_charge . '</td>';
		$html .= '<td >' . $row->charge_date . '</td>';
		$html .= '<td>' . $row->fname . ' ' . $row->lname . '</td>';
		$html .= '<td >' . $met_payment->name_pay . '</td>';
		$html .= '<td >' . $row->order_prefix . $row->order_no . '</td>';
		$html .= '<td>' . cdb_money_format_bar($row->total) . '</td>';
		$html .= '</tr>';
	}

	$html .= '<tr>';
	$html .= '<td><b>TOTAL</td> </b>';
	$html .= '<td colspan="5"></td>';
	$html .= '<td><b>' . cdb_money_format_bar($sumador_total) . ' </b></td>';
	$html .= '</tr>';
}

$html .= '</table></html>';
echo utf8_decode($html);
