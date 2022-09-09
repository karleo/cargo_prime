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
header("Content-Disposition: attachment; filename=Report-packages_registered_by_driver_" . date('d-m-Y') . ".xls");
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

	$sWhere .= " and a.driver_id = '" . $employee_id . "'";
} else {

	$userfilter = 'All';
}


if (!empty($range)) {

	$fecha =  explode(" - ", $range);
	$fecha = str_replace('/', '-', $fecha);

	$fecha_inicio = date('Y-m-d', strtotime($fecha[0]));
	$fecha_fin = date('Y-m-d', strtotime($fecha[1]));


	$sWhere .= " and  a.order_date between '" . $fecha_inicio . "'  and '" . $fecha_fin . "'";
}

$sql = "SELECT  a.total_declared_value, a.agency, a.origin_off, a.total_weight, a.sub_total, a.total_tax_discount, a.total_tax_insurance, a.total_tax_custom_tariffis, a.total_tax,  a.tracking_purchase, a.provider_purchase, a.price_purchase, a.status_invoice, a.total_order, a.order_id, a.order_prefix, a.order_no, a.order_date, a.sender_id, a.order_courier, a.order_pay_mode, a.status_courier, a.driver_id, a.order_service_options,  b.mod_style, b.color FROM
			 cdb_customers_packages as a
			 INNER JOIN cdb_styles as b ON a.status_courier = b.id
			 $sWhere
			  

			 order by order_id desc 
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
		Packages Registered report by driver <br>

		[' . $fecha[0] . ' - ' . $fecha[1] . ']

		<br>
		Driver: ' . $userfilter . '

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
				<th><b>Declared tax</b></th>
				<th><b>Total</b></th>
				<th><b></b></th>
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
	$sumador_declared_tax = 0;


	foreach ($data as $row) {


		$db->cdp_query("SELECT * FROM cdb_offices where id= '" . $row->origin_off . "'");
		$offices = $db->cdp_registro();


		$db->cdp_query("SELECT * FROM cdb_branchoffices where id= '" . $row->agency . "'");
		$branchoffices = $db->cdp_registro();


		$db->cdp_query("SELECT * FROM cdb_pre_alert where tracking= '" . $row->tracking_purchase . "'");
		$package_prealert = $db->cdp_registro();


		if ($row->status_invoice == 1) {
			$text_status = $lang['invoice_paid'];
			$label_class = "label-success";
		} else if ($row->status_invoice == 0 || $row->status_invoice == 2) {
			$text_status = $lang['invoice_pending'];
			$label_class = "label-warning";
		} else if ($row->status_invoice == 3) {
			$text_status = $lang['verify_payment'];
			$label_class = "label-info";
		}




		$weight = $row->total_weight;
		$sub_total = $row->sub_total;
		$discount = $row->total_tax_discount;
		$insurance = $row->total_tax_insurance;
		$custom_c = $row->total_tax_custom_tariffis;
		$tax = $row->total_tax;
		$total = $row->total_order;
		$total_declared_tax = $row->total_declared_value;

		$sumador_weight += $weight;
		$sumador_subtotal += $sub_total;
		$sumador_discount += $discount;
		$sumador_insurance += $insurance;
		$sumador_c_tariff += $custom_c;
		$sumador_tax += $tax;
		$sumador_total += $total;
		$count++;
		$sumador_declared_tax += $total_declared_tax;



		$html .= '<tr>';
		$html .= '<td ><b>' . $count . '</b></td>';
		$html .= '<td>' . $row->order_prefix . $row->order_no . '</td>';
		$html .= '<td>' . $row->order_date . '</td>';
		$html .= '<td>' . $branchoffices->name_branch . '</td>';
		$html .= '<td>' . $offices->name_off . '</td>';
		$html .= '<td>' . $row->mod_style . '</td>';
		$html .= '<td>' . $row->total_weight . '</td>';
		$html .= '<td>' . cdb_money_format_bar($row->sub_total) . '</td>';
		$html .= '<td>' . cdb_money_format_bar($row->total_tax_discount) . '</td>';
		$html .= '<td>' . cdb_money_format_bar($row->total_tax_insurance) . '</td>';
		$html .= '<td>' . cdb_money_format_bar($row->total_tax_custom_tariffis) . '</td>';
		$html .= '<td>' . cdb_money_format_bar($row->total_tax) . '</td>';
		$html .= '<td>' . cdb_money_format_bar($row->total_declared_value) . '</td>';
		$html .= '<td>' . cdb_money_format_bar($row->total_order) . '</td>';
		$html .= '<td>' . $text_status . '</td>';
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
	$html .= '<td><b>' . cdb_money_format_bar($sumador_declared_tax) . ' </b></td>';
	$html .= '<td><b>' . cdb_money_format_bar($sumador_total) . ' </b></td>';
	$html .= '<td></td>';
	$html .= '</tr>';
}

$html .= '</table></html>';
echo utf8_decode($html);
