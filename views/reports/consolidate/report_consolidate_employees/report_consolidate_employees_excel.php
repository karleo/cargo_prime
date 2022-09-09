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
header("Content-Disposition: attachment; filename=Report-Consolidated_by_employees" . date('d-m-Y') . ".xls");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);



$db = new Conexion;

$status_courier = intval($_REQUEST['status_courier']);
$range = $_REQUEST['range'];
$employee_id = intval($_REQUEST['employee_id']);


$sWhere = "";


if ($status_courier > 0) {

	$sWhere .= " and  a.status_courier = '" . $status_courier . "'";
}

if ($employee_id > 0) {

	$db->cdp_query("SELECT * FROM cdb_users where id= '" . $employee_id . "'");
	$user = $db->cdp_registro();

	$userfilter = $user->fname . ' ' . $user->lname;

	$sWhere .= " and a.user_id = '" . $employee_id . "'";
} else {

	$userfilter = 'All';
}

if (!empty($range)) {

	$fecha =  explode(" - ", $range);
	$fecha = str_replace('/', '-', $fecha);

	$fecha_inicio = date('Y-m-d', strtotime($fecha[0]));
	$fecha_fin = date('Y-m-d', strtotime($fecha[1]));


	$sWhere .= " and  a.c_date between '" . $fecha_inicio . "'  and '" . $fecha_fin . "'";
}

$sql = "SELECT a.origin_off, a.agency, a.total_weight, a.total_tax_discount, a.sub_total, a.total_tax_insurance, a.total_tax_custom_tariffis, a.total_tax,   a.total_order, a.consolidate_id, a.c_prefix, a.c_no, a.c_date, a.sender_id, a.order_courier,a.status_courier,  b.mod_style, b.color FROM cdb_consolidate as a
			 INNER JOIN cdb_styles as b ON a.status_courier = b.id
			 $sWhere
			  and a.status_courier!=14

			 order by consolidate_id desc 
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
		Consolidated report by employee <br>

		[' . $fecha[0] . ' - ' . $fecha[1] . ']

		<br>
		Employee: ' . $userfilter . '

		</h2>


		<table border=1>
		<tbody>
			<tr style="background-color: #3e5569; color: white">				
				<th><b></b></th>
				<th><b>' . $lang['ltracking'] . '</b></th>
				<th><b>' . $lang['ddate'] . '</b></th>
				<th><b>Agency</b></th>
				<th><b>Office</b></th>
				<th><b>' . $lang['lstatusshipment'] . '</b></th>
				<th><b>Weight</b></th>
				<th><b>Subtotal</b></th>
				<th><b>Discount</b></th>
				<th><b>Insurance</b></th>
				<th><b>Customs tariffs</b></th>
				<th><b>Tax</b></th>
				<th><b>Total</b></th>
			</tr>';

if ($numrows > 0) {

	$count = 0;
	$sumador_weight = 0;
	$sumador_subtotal = 0;
	$sumador_discount = 0;
	$sumador_insurance = 0;
	$sumador_c_tariff = 0;
	$sumador_tax = 0;
	$sumador_total = 0;

	foreach ($data as $row) {


		$db->cdp_query("SELECT * FROM cdb_offices where id= '" . $row->origin_off . "'");
		$offices = $db->cdp_registro();


		$db->cdp_query("SELECT * FROM cdb_branchoffices where id= '" . $row->agency . "'");
		$branchoffices = $db->cdp_registro();




		$weight = $row->total_weight;
		$sub_total = $row->sub_total;
		$discount = $row->total_tax_discount;
		$insurance = $row->total_tax_insurance;
		$custom_c = $row->total_tax_custom_tariffis;
		$tax = $row->total_tax;
		$total = $row->total_order;

		$sumador_weight += $weight;
		$sumador_subtotal += $sub_total;
		$sumador_discount += $discount;
		$sumador_insurance += $insurance;
		$sumador_c_tariff += $custom_c;
		$sumador_tax += $tax;
		$sumador_total += $total;
		$count++;


		$html .= '<tr>';
		$html .= '<td ><b>' . $count . '</b></td>';
		$html .= '<td>' . $row->c_prefix . $row->c_no . '</td>';
		$html .= '<td>' . $row->c_date . '</td>';
		$html .= '<td>' . $branchoffices->name_branch . '</td>';
		$html .= '<td>' . $offices->name_off . '</td>';
		$html .= '<td>' . $row->mod_style . '</td>';
		$html .= '<td>' . $row->total_weight) . '</td>';
		$html .= '<td>' . cdb_money_format_bar($row->sub_total) . '</td>';
		$html .= '<td>' . cdb_money_format_bar($row->total_tax_discount) . '</td>';
		$html .= '<td>' . cdb_money_format_bar($row->total_tax_insurance) . '</td>';
		$html .= '<td>' . cdb_money_format_bar($row->total_tax_custom_tariffis) . '</td>';
		$html .= '<td>' . cdb_money_format_bar($row->total_tax) . '</td>';
		$html .= '<td>' . cdb_money_format_bar($row->total_order) . '</td>';
		$html .= '</tr>';
	}

	$html .= '<tr>';
	$html .= '<td><b>TOTAL</td> </b>';
	$html .= '<td  colspan="5"></td>';
	$html .= '<td><b>' . $sumador_weight . ' </b></td>';
	$html .= '<td><b>' . cdb_money_format_bar($sumador_subtotal) . ' </b></td>';
	$html .= '<td><b>' . cdb_money_format_bar($sumador_discount) . ' </b></td>';
	$html .= '<td><b>' . cdb_money_format_bar($sumador_insurance) . ' </b></td>';
	$html .= '<td><b>' . cdb_money_format_bar($sumador_c_tariff) . ' </b></td>';
	$html .= '<td><b>' . cdb_money_format_bar($sumador_tax) . ' </b></td>';
	$html .= '<td><b>' . cdb_money_format_bar($sumador_total) . ' </b></td>';
	$html .= '</tr>';
}

$html .= '</table></html>';
echo utf8_decode($html);
