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



require_once('helpers/querys.php');

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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/uploads/favicon.png">

    <title>Payments received reportPayments received reportPayments received reportPayments received reportPayments received reportPayments received report</title>
    <link href="assets/custom_dependencies/print_report.css" rel="stylesheet">


</head>

<body>
    <div id="page-wrap">

        <h2><?php echo $core->site_name; ?><br>
            Payments received report <br>

            [<?php echo $fecha[0] . ' - ' . $fecha[1]; ?>] <br>


        </h2>


        <table>
            <tr>
                <th></th>
                <th class="text-center"><b>Payment number</b></th>
                <th class="text-center"><b><?php echo $lang['ddate'] ?></b></th>
                <th class="text-center"><b>Customer</b></th>
                <th class="text-center"><b>Pay mode</b></th>
                <th class="text-center"><b><?php echo $lang['ltracking'] ?></b></th>
                <th class="text-center"><b>Amount</b></th>
            </tr>

            <?php

            if ($numrows > 0) {

                $count = 1;
                $sumador_total = 0;

                foreach ($data as $row) {

                    $db->cdp_query('SELECT  * FROM cdb_met_payment WHERE id=:id');

                    $db->bind(':id', $row->payment_type);

                    $db->cdp_execute();

                    $met_payment = $db->cdp_registro();


                    $sumador_total += $row->total;

            ?>
                    <tr>
                        <td class="text-center">
                            <?php echo $count; ?>
                        </td>
                        <td class="text-center">
                            <?php echo $row->id_charge; ?>
                        </td>

                        <td class="text-center">
                            <?php echo $row->charge_date; ?>
                        </td>


                        <td class="text-center">
                            <?php echo $row->fname . ' ' . $row->lname; ?>
                        </td>
                        <td class="text-center">
                            <?php echo $met_payment->name_pay; ?>
                        </td>

                        <td class="text-center">
                            <?php echo $row->order_prefix . $row->order_no; ?>
                        </td>

                        <td class="text-center">
                            <?php echo cdb_money_format($row->total); ?>
                        </td>
                    </tr>
                <?php

                    $count++;
                }
                ?>

                <tr>
                    <td class="text-left"><b>TOTAL</b></td>


                    <td colspan="5"></td>
                    <td class="text-left">
                        <b><?php echo cdb_money_format($sumador_total); ?> </b>
                    </td>

                </tr>
            <?php
            }
            ?>


        </table>

        <button class='button -dark center no-print' onClick="window.print();" style="font-size:16px; margin-top: 20px;">Print &nbsp;&nbsp; <i class="fa fa-print"></i></button>
    </div>

</body>

</html>