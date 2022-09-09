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



$userData = $user->cdp_getUserData();

if (isset($_GET['id'])) {
    $data = cdp_getCustomerPackagePrint($_GET['id']);
}

if (!isset($_GET['id']) or $data['rowCount'] != 1) {
    cdp_redirect_to("customer_packages_list.php");
}

if (isset($_GET['id_notification'])) {
    # code...

    $user_log = $_SESSION['userid'];
    $id_notification = $_GET['id_notification'];

    cdp_updateNotificationRead($user_log, $id_notification);
}

$payrow = $core->cdp_getPayment();



$row_order = $data['data'];
$db->cdp_query("SELECT * FROM cdb_styles where id= '" . $row_order->status_courier . "'");
$status_courier = $db->cdp_registro();

$db->cdp_query("SELECT * FROM cdb_users where id= '" . $row_order->sender_id . "'");
$sender_data = $db->cdp_registro();


$db->cdp_query("SELECT * FROM cdb_address_shipments where order_track='" . $row_order->order_prefix . $row_order->order_no . "'");
$address_order = $db->cdp_registro();


$db->cdp_query("SELECT * FROM cdb_courier_com where id= '" . $row_order->order_courier . "'");
$courier_com = $db->cdp_registro();

$db->cdp_query("SELECT * FROM cdb_met_payment where id= '" . $row_order->order_pay_mode . "'");
$met_payment = $db->cdp_registro();

$db->cdp_query("SELECT * FROM cdb_category where id= '" . $row_order->order_item_category . "'");
$category = $db->cdp_registro();

$db->cdp_query("SELECT * FROM cdb_shipping_mode where id= '" . $row_order->order_service_options . "'");
$order_service_options = $db->cdp_registro();

$db->cdp_query("SELECT * FROM cdb_packaging where id= '" . $row_order->order_package . "'");
$packaging = $db->cdp_registro();


$db->cdp_query("SELECT * FROM cdb_delivery_time where id= '" . $row_order->order_deli_time . "'");
$delivery_time = $db->cdp_registro();

$db->cdp_query("SELECT * FROM cdb_branchoffices where id= '" . $row_order->agency . "'");
$branchoffices = $db->cdp_registro();

$db->cdp_query("SELECT * FROM cdb_offices where id= '" . $row_order->origin_off . "'");
$offices = $db->cdp_registro();


$db->cdp_query("SELECT * FROM cdb_customers_packages_detail WHERE order_id='" . $_GET['id'] . "'");
$order_items = $db->cdp_registros();


$dias_ = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
$meses_ = array('01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec');





$fecha = strtotime($row_order->order_datetime);
$anio = date("Y", $fecha);
$mes = date("m", $fecha);
$dia = date("d", $fecha);


if ($row_order->status_invoice == 1) {

    $text_status = $lang['invoice_paid'];
    $label_class = "label-success";
} else if ($row_order->status_invoice == 2) {

    $text_status = $lang['invoice_pending'];
    $label_class = "label-warning";
} else if ($row_order->status_invoice == 3) {
    $text_status = $lang['verify_payment'];
    $label_class = "label-info";
}


?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/<?php echo $core->favicon ?>">
    <title> View Packages #<?php echo $row_order->order_prefix . $row_order->order_no; ?> | <?php echo $core->site_name ?></title>
    <!-- This Page CSS -->
    <!-- Custom CSS -->
    <link href="assets/css/style.min.css" rel="stylesheet">

    <link href="assets/css/front.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="assets/js/jquery.js"></script>
    <script type="text/javascript" src="assets/js/jquery-ui.js"></script>
    <script src="assets/js/jquery.ui.touch-punch.js"></script>
    <script src="assets/js/jquery.wysiwyg.js"></script>
    <script src="assets/js/global.js"></script>
    <script src="assets/js/custom.js"></script>
    <link href="assets/customClassPagination.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/bootstrap-datetimepicker.min.css">

    <link href="assets/css/scroll-menu.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/custom_dependencies/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->


    <?php include 'views/inc/preloader.php'; ?>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->

        <?php include 'views/inc/topbar.php'; ?>

        <!-- End Topbar header -->


        <!-- Left Sidebar - style you can find in sidebar.scss  -->

        <?php include 'views/inc/left_sidebar.php'; ?>


        <!-- End Left Sidebar - style you can find in sidebar.scss  -->

        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">



            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" style=" padding-bottom: 40px">
                            <div class="card-body">

                                <div class="mb-3" id="resultados_ajax_cancel"></div>
                                <div class="mb-3" id="resultados_ajax"></div>


                                <div class="row">


                                    <div class="col-md-6">
                                        <h3 class=" pull-left"><b class="text-danger">INVOICE</b> <span>#<?php echo $row_order->order_prefix . $row_order->order_no; ?></span></h3>

                                    </div>



                                    <div class="col-md-6  pull-right">
                                        <div class="btn-group pull-right">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" data-flip="false">
                                                Invoice Actions
                                            </button>
                                            <div class="dropdown-menu scrollable-menu">


                                                <?php if ($row_order->status_invoice == 2) { ?>
                                                    <?php if ($userData->userlevel == 1) { ?>

                                                        <a class="dropdown-item" href="add_payment_gateways_package.php?id_order=<?php echo $row_order->order_id; ?>">
                                                            <i style="color:#343a40" class="fas fa-dollar-sign"></i>&nbsp;Add invoice payment</a>



                                                    <?php } ?>
                                                <?php } ?>



                                                <?php if ($row_order->status_invoice == 3) { ?>
                                                    <?php if ($userData->userlevel != 1) { ?>


                                                        <a class="dropdown-item" data-toggle="modal" data-target="#detail_payment_packages" data-id="<?php echo $row_order->order_id; ?>" data-customer="<?php echo $row_order->sender_id; ?>"><i style="color:#343a40" class="fas fa-dollar-sign"></i>&nbsp; Verify payment</a>


                                                    <?php } ?>

                                                <?php } ?>


                                                <?php if ($row_order->status_courier != 8) { ?>

                                                    <?php if ($userData->userlevel == 9 || $userData->userlevel == 2) { ?>
                                                        <?php if ($row_order->status_invoice != 1) { ?>


                                                            <a class="dropdown-item" href="customer_package_edit.php?id=<?php echo $_GET['id']; ?>"><i style="color:#343a40" class="ti-pencil"></i>&nbsp; Edit package</a>

                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>


                                                <?php if ($row_order->status_courier != 21) { ?>
                                                    <?php if ($row_order->status_courier != 12) { ?>


                                                        <?php if ($userData->userlevel != 1) { ?>

                                                            <?php if ($row_order->status_courier != 8) { ?>

                                                                <a class="dropdown-item" data-toggle="modal" data-target="#modalDriver" data-id_shipment="<?php echo $row_order->order_id; ?>"><i style="color:#ff0000" class="fas fa-car"></i>&nbsp; <?php echo $lang['left208'] ?></a>

                                                            <?php } ?>
                                                        <?php } ?>

                                                        <a class="dropdown-item" target="blank" href="print_invoice_package.php?id=<?php echo $_GET['id']; ?>"> <i style="color:#343a40" class="ti-printer"></i>&nbsp; Print Package</a>

                                                        <a class="dropdown-item" href="print_label_package.php?id=<?php echo $_GET['id']; ?>" target="_blank"> <i style="color:#343a40" class="ti-printer"></i>&nbsp;<?php echo $lang['toollabel'] ?> </a>

                                                        <?php if ($row_order->status_invoice == 1) { ?>

                                                            <?php if ($userData->userlevel != 1) { ?>
                                                                <?php if ($row_order->status_courier != 8) { ?>
                                                                    <?php if ($row_order->status_courier != 21) { ?>
                                                                        <?php if ($row_order->status_courier != 12) { ?>


                                                                            <a class="dropdown-item" href="customer_package_tracking.php?id=<?php echo $_GET['id']; ?>"><i style="color:#20c997" class="ti-reload">&nbsp;</i>Package tracking</a>

                                                                            <a class="dropdown-item" href="customer_package_deliver.php?id=<?php echo $row_order->order_id; ?>" title="<?php echo $lang['tooldeliver'] ?>"><i style="color:#2962FF" class="ti-package"></i>&nbsp;Deliver package</a>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } ?>


                                                        <?php if ($userData->userlevel != 1) { ?>

                                                            <a class="dropdown-item" href="#" data-toggle="modal" data-id="<?php echo $row_order->order_id; ?>" data-email="<?php echo $sender_data->email; ?>" data-order="<?php echo $row_order->order_prefix . $row_order->order_no; ?>" data-target="#myModal"><i class="fas fa-envelope"></i>&nbsp;Send email</a>

                                                        <?php } ?>

                                                    <?php } ?>

                                                <?php } ?>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class=" col-md-4 pull-left">
                                            <b class="">Package status</b>
                                            <span class="label" style="background-color: <?php echo $status_courier->color; ?>"><?php echo $status_courier->mod_style; ?>
                                            </span>
                                        </div>

                                        <div class=" col-md-4 pull-left">
                                            <b class="">Invoice Status</b>
                                            <span class="label <?php echo $label_class; ?>"><?php echo $text_status; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="pull-left">
                                            <h5> &nbsp;<b>Agency</b></h5>
                                            <p class="text-muted  m-l-5"><?php if ($branchoffices != null) {
                                                                                echo $branchoffices->name_branch;
                                                                            } ?></p>


                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <div class="pull-left">
                                            <h5> &nbsp;<b>Office</b></h5>
                                            <p class="text-muted  m-l-5"><?php if ($offices != null) {
                                                                                echo $offices->name_off;
                                                                            } ?></p>
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <div class="pull-left">
                                            <h5> &nbsp;<b><?php echo $lang['itemcategory'] ?></b></h5>
                                            <p class="text-muted  m-l-5"><?php echo $category->name_item; ?></p>
                                        </div>

                                    </div>

                                </div>


                                <!-- <hr> -->
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="pull-left">
                                            <h5> &nbsp;<b>Estimated delivery date </b></h5>
                                            <p class="text-muted  m-l-5"><?php echo $meses_[$mes] . ' ' . $dia . ', ' . $anio; ?></p>

                                            <h5> &nbsp;<b>Delivery time</b></h5>
                                            <p class="text-muted  m-l-5"><?php if ($delivery_time != null) {
                                                                                echo $delivery_time->delitime;
                                                                            } ?></p>
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <div class="pull-left">
                                            <h5> &nbsp;<b>Packing type</b></h5>
                                            <p class="text-muted  m-l-5"><?php echo $packaging->name_pack; ?></p>

                                            <h5> &nbsp;<b>Shipping mode</b></h5>
                                            <p class="text-muted  m-l-5"><?php if ($order_service_options != null) {
                                                                                echo $order_service_options->ship_mode;
                                                                            } ?></p>
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <div class="pull-left">
                                            <h5> &nbsp;<b>Courier company</b></h5>
                                            <p class="text-muted  m-l-5"><?php if ($courier_com != null) {
                                                                                echo $courier_com->name_com;
                                                                            } ?></p>


                                        </div>

                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="pull-left">

                                            <h5> &nbsp;<b><?php echo $lang['left63'] ?></b></h5>
                                            <p class="text-muted  m-l-5"><?php echo $row_order->tracking_purchase; ?></p>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="pull-left">

                                            <h5> &nbsp;<b><?php echo $lang['left64'] ?></b></h5>
                                            <p class="text-muted  m-l-5"><?php echo $row_order->provider_purchase ?></p>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="pull-left">
                                            <h5> &nbsp;<b><?php echo $lang['left66'] ?></b></h5>
                                            <p class="text-muted  m-l-5"><?php echo $row_order->price_purchase ?></p>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                $track_c = $row_order->order_prefix . $row_order->order_no;


                                $db->cdp_query("SELECT * FROM cdb_payments_gateway  where order_track ='" . $track_c . "'");

                                $order_ = $db->cdp_registro();

                                if ($order_) {

                                    if ($order_->status === 'COMPLETED' || $order_->status === 'succeeded' || $order_->status === 'success') {
                                        $text_status_payment = 'Completed';
                                        $label_class_payment = "label-success";
                                    } else {

                                        $text_status_payment = $order_->status;
                                        $label_class_payment = "label-warning";
                                    }

                                ?>

                                    <div class="row">

                                        <div class="col-md-12">
                                            <br>
                                            <br>

                                            <h4 class=" pull-left"><span><b>Payment details</b></span></h4>
                                            <br>
                                            <br>
                                        </div>



                                        <div class="col-md-4">

                                            <div class="pull-left">
                                                <h5> &nbsp;<b>Payment date</b></h5>
                                                <p class="text-muted  m-l-5"><?php echo date('Y-m-d h:i A', strtotime($order_->date_payment)); ?></p>
                                            </div>

                                        </div>



                                        <div class="col-md-4">

                                            <div class="pull-left">

                                                <h5> &nbsp;<b>Gateway</b></h5>
                                                <p class="text-muted  m-l-5"><?php echo $order_->gateway; ?></p>
                                            </div>

                                        </div>




                                        <div class="col-md-4">

                                            <div class="pull-left">
                                                <h5> &nbsp;<b># Transaction </b></h5>
                                                <b class="text-muted  m-l-5"><?php echo $order_->payment_transaction; ?></b>


                                            </div>

                                        </div>

                                        <div class="col-md-4">

                                            <div class="pull-left">
                                                <h5> &nbsp;<b>Amount </b></h5>
                                                <b class="text-muted  m-l-5"><?php echo $order_->amount; ?></b>


                                            </div>

                                        </div>

                                        <div class="col-md-4">

                                            <div class="pull-left">
                                                <h5> &nbsp;<b>Currency </b></h5>
                                                <b class="text-muted  m-l-5"><?php echo $order_->currency; ?></b>


                                            </div>

                                        </div>

                                        <div class="col-md-4">

                                            <div class="pull-left">
                                                <h5> &nbsp;<b>Status </b></h5>

                                                <span class="label <?php echo $label_class_payment; ?>"><?php echo $text_status_payment; ?>
                                                </span>


                                            </div>

                                        </div>
                                    </div>

                                <?php

                                }

                                ?>

                                <?php

                                if ($row_order->url_payment_attach != null || $row_order->status_invoice == 3) { ?>



                                    <div class="row">

                                        <div class="col-md-12">
                                            <br>
                                            <br>

                                            <h5 class=" pull-left"><span>Attached proof of payment</span></h5>



                                        </div>

                                        <div class="col-md-12">
                                            <a href="assets/<?php echo $row_order->url_payment_attach; ?>" target="blank" class="btn btn-default text- btn-sm">
                                                see attached file
                                            </a>
                                        </div>


                                        <div class="col-md-4">
                                            <br>
                                            <br>
                                            <div class="pull-left">
                                                <h5> &nbsp;<b>Payment date</b></h5>
                                                <p class="text-muted  m-l-5"><?php echo date('Y-m-d h:i A', strtotime($row_order->payment_date)); ?></p>
                                            </div>

                                        </div>



                                        <div class="col-md-4">
                                            <br>
                                            <br>
                                            <div class="pull-left">

                                                <h5> &nbsp;<b>Payment method</b></h5>
                                                <p class="text-muted  m-l-5"><?php echo $met_payment->name_pay; ?></p>
                                            </div>

                                        </div>

                                        <div class="col-md-4">
                                            <br>
                                            <br>

                                            <div class="pull-left">
                                                <h5> &nbsp;<b>Notes</b></h5>
                                                <b class="text-muted  m-l-5"><?php if ($row_order->notes != null) {
                                                                                    echo $row_order->notes;
                                                                                } ?></b>


                                            </div>
                                        </div>
                                    </div>

                                <?php

                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                <?php
                if ($row_order->status_courier == 8) {


                    $db->cdp_query("SELECT * FROM cdb_courier_track where order_track='" . $row_order->order_prefix . $row_order->order_no . "' and status_courier=8");
                    $courier_track = $db->cdp_registro();

                    $fecha_delivered = strtotime($courier_track->t_date);
                    $anio_delivered = date("Y", $fecha_delivered);
                    $mes_delivered = date("m", $fecha_delivered);
                    $dia_delivered = date("d", $fecha_delivered);
                    $time_delivered = date("h:i A", $fecha_delivered);

                    $db->cdp_query("SELECT * FROM cdb_users where id='" . $courier_track->user_id . "'");
                    $user_delivered = $db->cdp_registro();

                ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">shipping delivered</h5>
                                    <hr>



                                    <!-- <hr> -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="pull-left">
                                                <h5> &nbsp;<b>Delivered date</b></h5>
                                                <p class="text-muted  m-l-5"><?php echo $meses_[$mes_delivered] . ' ' . $dia_delivered . ', ' . $anio_delivered . ' ' . $time_delivered; ?></p>

                                            </div>

                                        </div>

                                        <div class="col-md-4">
                                            <div class="pull-left">
                                                <h5> &nbsp;<b>Delivered By</b></h5>
                                                <p class="text-muted  m-l-5"><?php echo $user_delivered->fname . ' ' . $user_delivered->lname; ?></p>

                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="pull-left">
                                                <h5> &nbsp;<b>Received By</b></h5>
                                                <p class="text-muted  m-l-5"><?php echo $row_order->person_receives; ?></p>
                                            </div>

                                        </div>

                                    </div>

                                    <?php
                                    $dir = 'doc_signs/package' . $row_order->order_id . '.png';

                                    ?>


                                    <div class="row">

                                        <div class="col-md-6">
                                            <h5> &nbsp;<b>Receiver Signature</b></h5>

                                            <img src="doc_signs/package<?php echo $row_order->order_id; ?>.png" width="400" height="250">
                                        </div>
                                        <?php

                                        if (!empty($row_order->photo_delivered)) { ?>

                                            <div class="col-md-6">
                                                <h5> &nbsp;<b>Photo delivered</b></h5>

                                                <img src="<?php echo $row_order->photo_delivered; ?>" width="400" height="250">
                                            </div>
                                        <?php
                                        } ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>


                <?php

                $db->cdp_query("SELECT * FROM cdb_customer_package_files where order_id='" . $_GET['id'] . "' ORDER BY date_file");
                $files_order = $db->cdp_registros();
                $numrows = $db->cdp_rowCount();


                if ($numrows > 0) {
                ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fa fa-paperclip"></i> Attached files details</h5>
                                    <hr>

                                    <div class="table-responsive">
                                        <table id="zero_config" class="table table-striped">
                                            <thead class="bg-inverse text-white">
                                                <tr>
                                                    <th>Nº</th>
                                                    <th>File</th>
                                                    <th>Added</th>
                                                </tr>
                                            </thead>
                                            <tbody id="projects-tbl">

                                                <?php
                                                $count = 0;
                                                foreach ($files_order as $file) {

                                                    $date_add = date("Y-m-d h:i A", strtotime($file->date_file));



                                                    $count++;
                                                ?>

                                                    <tr class="card-hover">
                                                        <td><?php echo $count; ?></td>
                                                        <td> <a style="color:#7460ee;" target="_blank" href="<?php echo $file->url; ?>" class=""><?php echo $file->name; ?> </a></td>
                                                        <td><?php echo $date_add; ?></td>

                                                    </tr>
                                                <?php
                                                } ?>


                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                } ?>


                <?php

                $db->cdp_query("SELECT * FROM cdb_customer_package_files where order_id='" . $_GET['id'] . "' ORDER BY date_file");
                $files_order = $db->cdp_registros();
                $numrows = $db->cdp_rowCount();


                if ($numrows > 0) {
                ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fa fa-paperclip"></i> Attached files preview</h5>
                                    <hr>
                                    <div class="col-md-12 row">

                                        <?php
                                        $count = 0;
                                        foreach ($files_order as $file) {

                                            $date_add = date("Y-m-d h:i A", strtotime($file->date_file));

                                            $src = 'assets/images/no-preview.jpeg';

                                            if (
                                                $file->file_type == 'jpg' ||
                                                $file->file_type == 'jpeg' ||
                                                $file->file_type == 'png' ||
                                                $file->file_type == 'ico'
                                            ) {

                                                $src = $file->url;
                                            }

                                            $count++;
                                        ?>

                                            <div class="col-md-3">

                                                <img style="width: 180px; height: 180px;" class="img-thumbnail" src="<?php echo $src; ?>">

                                                <div class="row ">
                                                    <div class=" col-md-12 mb-2 mt-2">
                                                        <p class="text-justify"><a style="color:#7460ee;" target="_blank" href="<?php echo $file->url; ?>" class=""><?php echo $file->name; ?> </a></p>

                                                    </div>

                                                </div>
                                            </div>
                                        <?php
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                } ?>


                <?php

                $db->cdp_query("SELECT * FROM cdb_courier_track where order_track='" . $row_order->order_prefix . $row_order->order_no . "' ORDER BY t_date");
                $courier_track_items = $db->cdp_registros();
                $numrows = $db->cdp_rowCount();


                if ($numrows > 0) {
                ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"> <?php echo $lang['left502'] ?></h5>
                                    <hr>

                                    <div class="table-responsive">
                                        <table id="zero_config" class="table table-striped">
                                            <thead class="bg-inverse text-white">
                                                <tr>
                                                    <th><?php echo $lang['left503'] ?></th>
                                                    <th><?php echo $lang['left504'] ?></th>
                                                    <th><?php echo $lang['left505'] ?></th>
                                                    <th><?php echo $lang['left506'] ?></th>
                                                    <th><?php echo $lang['left507'] ?></th>
                                                </tr>
                                            </thead>
                                            <tbody id="projects-tbl">

                                                <?php
                                                foreach ($courier_track_items as $track_item) {

                                                    $date_update = date("Y-m-d", strtotime($track_item->t_date));
                                                    $time_update = date("h:i A", strtotime($track_item->t_date));

                                                    $db->cdp_query("SELECT * FROM cdb_styles where id= '" . $track_item->status_courier . "'");
                                                    $status_courier_item = $db->cdp_registro();

                                                ?>

                                                    <tr class="card-hover">
                                                        <td><?php echo $date_update; ?></td>
                                                        <td><?php echo $time_update; ?></td>
                                                        <td><?php echo $track_item->t_dest; ?> /<br>
                                                            <?php echo $track_item->t_city; ?></td>
                                                        <td>
                                                            <span class="label" style="background-color: <?php echo $status_courier_item->color; ?>"><?php echo $status_courier_item->mod_style; ?>
                                                            </span>
                                                        </td>
                                                        <td><?php echo $track_item->comments; ?></td>

                                                    </tr>
                                                <?php
                                                } ?>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                } ?>

                <?php
                if ($user->cdp_is_Admin()) {

                    $db->cdp_query("SELECT * FROM cdb_order_user_history where order_track='" . $row_order->order_prefix . $row_order->order_no . "' ORDER BY history_id");
                    $order_user_history = $db->cdp_registros();
                    $numrows = $db->cdp_rowCount();


                    if ($numrows > 0) {
                ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"> History of user actions</h5>
                                        <hr>

                                        <div class="table-responsive">
                                            <table id="zero_config" class="table table-striped">
                                                <thead class="bg-inverse text-white">
                                                    <tr>
                                                        <th><?php echo $lang['left503'] ?></th>
                                                        <th><?php echo $lang['left504'] ?></th>
                                                        <th>User</th>
                                                        <th>Role</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="projects-tbl">

                                                    <?php
                                                    foreach ($order_user_history as $track_item) {

                                                        $date_update = date("Y-m-d", strtotime($track_item->date_history));
                                                        $time_update = date("h:i A", strtotime($track_item->date_history));


                                                        $db->cdp_query("SELECT * FROM cdb_users where id= '" . $track_item->user_id . "'");
                                                        $sender_data2 = $db->cdp_registro();


                                                        $role = '';

                                                        switch ($sender_data2->userlevel) {
                                                            case '1':
                                                                $role = 'Client';
                                                                break;

                                                            case '2':

                                                                $role = 'Employee';

                                                                break;

                                                            case '3':

                                                                $role = 'Driver';

                                                                break;

                                                            case '9':

                                                                $role = 'System Administration';

                                                                break;

                                                            default:
                                                                # code...
                                                                break;
                                                        }




                                                    ?>

                                                        <tr class="card-hover">
                                                            <td><?php echo $date_update; ?></td>
                                                            <td><?php echo $time_update; ?></td>
                                                            <td><?php echo $sender_data2->fname . ' ' . $sender_data2->lname; ?></td>
                                                            <td><?php echo $role; ?></td>
                                                            <td><?php echo $track_item->action; ?></td>

                                                        </tr>
                                                    <?php
                                                    } ?>


                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } ?>

                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Payment & Items Details</h5>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-hover" id="tabla">
                                        <thead class="bg-inverse text-white">
                                            <tr>
                                                <th><b><?php echo $lang['left214'] ?></b></th>
                                                <th><b><?php echo $lang['left213'] ?></b></th>
                                                <th></th>
                                                <th><b><?php echo $lang['left215'] ?></b></th>
                                                <th><b><?php echo $lang['left216'] ?></b></th>
                                                <th><b><?php echo $lang['left217'] ?></b></th>
                                                <th><b><?php echo $lang['left218'] ?></b></th>
                                                <th><b>Weight vol</b></th>
                                                <th><b>Fixed Charge</b></th>
                                                <th><b>Declared value</b></th>
                                            </tr>
                                        </thead>
                                        <tbody id="projects-tbl">
                                            <?php
                                            if ($order_items) {

                                                $sumador_total = 0;
                                                $sumador_valor_declarado = 0;
                                                $sumador_fixed_charge = 0;
                                                $max_fixed_charge = 0;
                                                $sumador_libras = 0;
                                                $sumador_volumetric = 0;
                                                $precio_total = 0;
                                                $total_impuesto = 0;
                                                $total_seguro = 0;
                                                $total_peso = 0;
                                                $total_descuento = 0;
                                                $total_impuesto_aduanero = 0;
                                                $count_item = 0;

                                                $total_valor_declarado = 0;

                                                foreach ($order_items as $row_order_item) {

                                                    $description_item = $row_order_item->order_item_description;
                                                    $weight_item =  (float) $row_order_item->order_item_weight;
                                                    $length_item =  (float) $row_order_item->order_item_length;
                                                    $width_item =  (float) $row_order_item->order_item_width;
                                                    $height_item =  (float) $row_order_item->order_item_height;
                                                    $meter = (float) $row_order->volumetric_percentage;

                                                    $total_metric =  ($length_item *  $width_item *  $height_item) /  $meter;
                                                    $total_metric = round($total_metric, 2);
                                                    // calculate weight x price
                                                    if ($weight_item > $total_metric) {
                                                        $calculate_weight = $weight_item;
                                                        $sumador_libras += $weight_item; //Sumador
                                                    } else {
                                                        $calculate_weight = $total_metric;
                                                        $sumador_volumetric += $total_metric; //Sumador
                                                    }

                                                    $precio_total =  ($calculate_weight *  (float)$row_order->value_weight);
                                                    (float) $sumador_total +=  $precio_total;
                                                    (float)$sumador_valor_declarado += $row_order_item->order_item_declared_value;
                                                    (float) $sumador_fixed_charge += $row_order_item->order_item_fixed_value;
                                                    (float) $max_fixed_charge += $row_order_item->order_item_fixed_value;
                                                    if ($sumador_total > $core->min_cost_tax) {

                                                        $total_impuesto = $sumador_total * $row_order->tax_value / 100;
                                                    }

                                                    if ($sumador_valor_declarado > $core->min_cost_declared_tax) {

                                                        $total_valor_declarado = $sumador_valor_declarado * $row_order->declared_value / 100;
                                                    }

                                            ?>

                                                    <tr class="card-hover">
                                                        <td><?php echo $row_order_item->order_item_quantity; ?></td>
                                                        <td><?php echo $description_item; ?></td>
                                                        <td></td>
                                                        <td><?php echo $weight_item; ?></td>
                                                        <td><?php echo $row_order_item->order_item_length; ?></td>
                                                        <td><?php echo $row_order_item->order_item_width; ?></td>
                                                        <td><?php echo $row_order_item->order_item_height; ?></td>
                                                        <td><?php echo $total_metric; ?></td>
                                                        <td class="text-center"><?php echo $row_order_item->order_item_fixed_value; ?></td>
                                                        <td class="text-center"><?php echo $row_order_item->order_item_declared_value; ?></td>

                                                    </tr>
                                                <?php

                                                }
                                                $total_descuento = $sumador_total * $row_order->tax_discount / 100;
                                                $total_peso = $sumador_libras + $sumador_volumetric;

                                                $total_seguro = $row_order->tax_insurance_value * $row_order->total_insured_value / 100;

                                                $total_impuesto_aduanero = $total_peso * $row_order->tax_custom_tariffis_value;

                                                $total_envio = ($sumador_total - $total_descuento) + $total_impuesto + $total_seguro + $max_fixed_charge + $total_impuesto_aduanero + $total_valor_declarado + $row_order->total_reexp;

                                                $sumador_total = cdb_money_format_bar($sumador_total);
                                                $sumador_libras = $sumador_libras;
                                                $sumador_volumetric = $sumador_volumetric;
                                                $total_envio = cdb_money_format($total_envio);
                                                $total_seguro = cdb_money_format_bar($total_seguro);
                                                $total_peso = $total_peso;
                                                $total_impuesto_aduanero = cdb_money_format_bar($total_impuesto_aduanero);
                                                $total_impuesto = cdb_money_format_bar($total_impuesto);
                                                $total_descuento = cdb_money_format_bar($total_descuento);
                                                $sumador_valor_declarado = cdb_money_format_bar($sumador_valor_declarado);
                                                $sumador_fixed_charge = cdb_money_format_bar($sumador_fixed_charge);
                                                $total_valor_declarado = cdb_money_format_bar($total_valor_declarado);

                                                ?>
                                        </tbody>


                                        <tfoot>
                                            <tr class="card-hover">
                                                <td colspan="3"></td>

                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td colspan="2" class="text-right"><b><?php echo $lang['left240'] ?></b></td>
                                                <td class="text-center"><?php echo $sumador_total; ?></td>
                                                <td></td>
                                            </tr>

                                            <tr class="card-hover">
                                                <td colspan="3"><b>Price &nbsp; <?php echo $core->weight_p; ?>:</b> <?php echo $row_order->value_weight; ?></td>

                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td colspan="2" class="text-right"><b>Discount <?php echo $row_order->tax_discount; ?> % </b></td>
                                                <td class="text-center"><?php echo $total_descuento; ?></td>
                                                <td></td>
                                            </tr>

                                            <tr>
                                                <td colspan="3"><b><?php echo $lang['left232'] ?>:</b> <span id="total_libras"><?php echo $sumador_libras; ?></span></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td colspan="3" class="text-right"><b>Shipping insurance <?php echo $row_order->tax_insurance_value; ?> % </b></td>
                                                <td class="text-center" id="insurance"><?php echo $total_seguro; ?></td>
                                                <td></td>
                                            </tr>

                                            <tr>
                                                <td colspan="3"><b><?php echo $lang['left234'] ?>:</b> <span id="total_volumetrico"><?php echo $sumador_volumetric; ?></span></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td colspan="3" class="text-right"> <b>Customs tariffs <?php echo $row_order->tax_custom_tariffis_value; ?> %</b></td>
                                                <td class="text-center" id="total_impuesto_aduanero"><?php echo $total_impuesto_aduanero; ?></td>
                                                <td></td>

                                            </tr>

                                            <tr>
                                                <td colspan="3"><b><?php echo $lang['left236'] ?></b>: <span id="total_peso"><?php echo $total_peso; ?></span></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td colspan="2" class="text-right"><b>Tax <?php echo $row_order->tax_value; ?> % </b></td>
                                                <td class="text-center" id="impuesto"><?php echo $total_impuesto; ?></td>
                                                <td></td>
                                            </tr>

                                            <tr>
                                                <td colspan="3"><b>Total declared value:</b> <span><?php echo $sumador_valor_declarado; ?></span></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td colspan="2" class="text-right"><b>Declared tax <?php echo $row_order->declared_value; ?> % </b></td>
                                                <td class="text-center" id="impuesto"><?php echo $total_valor_declarado; ?></td>
                                                <td></td>
                                            </tr>

                                            <tr>
                                                <td colspan="3"></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>

                                                <td colspan="2" class="text-right"><b>Total fixed charge: </b></td>
                                                <td class="text-center" id="reexp"><?php echo $sumador_fixed_charge; ?></td>
                                                <td></td>
                                            </tr>

                                            <tr>
                                                <td colspan="3"></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td colspan="2" class="text-right"><b>Re expedition </b></td>
                                                <td class="text-center" id="reexp"><?php echo cdb_money_format_bar($row_order->total_reexp); ?></td>
                                                <td></td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td colspan="3" class="text-right"><b><?php echo $lang['add-title44'] ?> &nbsp; <?php echo $core->currency; ?></b></td>
                                                <td class="text-center" id="total_envio"><?php echo $total_envio; ?></td>
                                                <td></td>

                                            </tr>
                                        </tfoot>
                                    <?php
                                            } ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->


                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Address Details</h5>
                                <hr>
                                <!-- <hr> -->
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="pull-left">
                                            <h5> &nbsp;<b>Name</b></h5>
                                            <p class="text-muted  m-l-5"><?php echo $sender_data->fname . ' ' . $sender_data->lname; ?></p>


                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="pull-left">
                                            <h5> &nbsp;<b>Email</b></h5>
                                            <p class="text-muted  m-l-5"><?php echo $sender_data->email; ?></p>
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <div class="pull-left">
                                            <h5> &nbsp;<b>Phone</b></h5>
                                            <p class="text-muted  m-l-5"><?php echo $sender_data->phone; ?></p>


                                        </div>
                                    </div>
                                </div>


                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="pull-left">
                                            <h5> &nbsp;<b>Address</b></h5>
                                            <p class="text-muted  m-l-5"><?php echo $address_order->sender_address; ?></p>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="pull-left">
                                            <h5> &nbsp;<b>Country</b></h5>
                                            <p class="text-muted  m-l-5"><?php echo $address_order->sender_country; ?></p>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="pull-left">
                                            <h5> &nbsp;<b>City</b></h5>
                                            <p class="text-muted  m-l-5"><?php echo $address_order->sender_city; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <?php include('views/modals/modal_send_email.php'); ?>
            <?php include('views/modals/modal_update_driver.php'); ?>
            <?php include('views/modals/modal_add_payment_package.php'); ?>
            <?php include('views/modals/modal_verify_payment_packages.php'); ?>



        </div>


    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->




    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/custom_dependencies/jquery-3.6.0.min.js"></script>
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/custom_dependencies/bootstrap.min.js"></script>
    <!-- apps -->
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/app.init.js"></script>
    <script src="assets/js/app-style-switcher.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/js/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="assets/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="assets/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="assets/js/custom.min.js"></script>
    <script src="dataJs/customers_packages_view.js"></script>

</body>

</html>