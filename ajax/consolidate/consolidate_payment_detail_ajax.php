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



require_once("../../loader.php");

$db = new Conexion;
$user = new User;
$core = new Core;
$userData = $user->cdp_getUserData();


$order_id = intval($_REQUEST['id']);

$sWhere = "";

if ($order_id > 0) {

    $sWhere .= "";
}



$sql = "SELECT * FROM cdb_consolidate   where consolidate_id = '" . $order_id . "' ";


$query_count = $db->cdp_query($sql);
$db->cdp_execute();
$numrows = $db->cdp_rowCount();


$db->cdp_query($sql);
$data = $db->cdp_registro();



$db->cdp_query("SELECT * FROM cdb_met_payment where id= '" . $data->order_pay_mode . "'");
$met_payment = $db->cdp_registro();


?>


<div class="row">


    <div class="col-md-6">
        <h3 class=" pull-left"><b class="text-danger">INVOICE</b> <span>#<?php echo $data->c_prefix . $data->c_no; ?></span></h3>

    </div>

    <div class="col-md-6  pull-right">
        <div class="btn-group pull-right">
            <a href="assets/<?php echo $data->url_payment_attach; ?>" target="blank" class="btn btn-info text-white">
                see proof of payment
            </a>

        </div>

    </div>


    <br>
    <br>
    <br>


    <div class="col-md-4">
        <div class="pull-left">
            <h5> &nbsp;<b>Payment date</b></h5>
            <p class="text-muted  m-l-5"><?php echo date('Y-m-d h:i A', strtotime($data->payment_date)); ?></p>
        </div>

    </div>

    <div class="col-md-4">
        <div class="pull-left">
            <h5> &nbsp;<b>Total Amount</b></h5>
            <p class="text-muted  m-l-5"><?php echo cdb_money_format($data->total_order); ?></p>
        </div>

    </div>

    <div class="col-md-4">
        <div class="pull-left">

            <h5> &nbsp;<b>Payment method</b></h5>
            <p class="text-muted  m-l-5"><?php echo $met_payment->name_pay; ?></p>
        </div>

    </div>


    <div class="col-md-12 pt-2">
        <div class="pull-left">
            <h5> &nbsp;<b>Notes</b></h5>
            <b class="text-muted  m-l-5"><?php if ($data->notes != null) {
                                                echo $data->notes;
                                            } ?></b>


        </div>
    </div>
</div>