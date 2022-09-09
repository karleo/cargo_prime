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


$userData = $user->cdp_getUserData();

$db = new Conexion;


$sql = "SELECT * FROM cdb_add_order where status_courier!=21 and order_payment_method >1  and sender_id='" . $_SESSION['userid'] . "' ";



$db->cdp_query($sql);
$data = $db->cdp_registros();




$count = 0;
$sumador_pendiente = 0;
$sumador_total = 0;
$sumador_pagado = 0;

foreach ($data as $row) {



    $db->cdp_query('SELECT  IFNULL(sum(total), 0)  as total  FROM cdb_charges_order WHERE order_id=:order_id');

    $db->bind(':order_id', $row->order_id);

    $db->cdp_execute();

    $sum_payment = $db->cdp_registro();

    $pendiente = $row->total_order - $sum_payment->total;

    $sumador_pendiente += $pendiente;
    $sumador_total += $row->total_order;
    $sumador_pagado += $sum_payment->total;


    $count++;
}


?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Courier DEPRIXA-Integral Web System" />
    <meta name="author" content="Jaomweb">
    <title>Dashboard | <?php echo $core->site_name ?></title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/<?php echo $core->favicon ?>">

    <title></title>
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

</head>

<body>

    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->

        <?php include 'views/inc/preloader.php'; ?>

        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->

        <?php include 'views/inc/topbar.php'; ?>

        <!-- End Topbar header -->


        <!-- Left Sidebar - style you can find in sidebar.scss  -->

        <?php include 'views/inc/left_sidebar.php'; ?>


        <!-- End Left Sidebar - style you can find in sidebar.scss  -->

        <!-- Page wrapper  -->

        <div class="page-wrapper">

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">

                <div class="row">

                    <div class="col-sm-12 col-md-8 col-lg-6">
                        <div class="card">
                            <div class="card-body border-bottom">
                                <h4 class="card-title">Virtual address for online shopping</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <!-- column -->
                                    <div class="col-sm-12 col-md-12 col-lg-12">

                                        <table class="m-t-30 m-b-30">

                                            <thead class="table-light">
                                                <tr class="headt">
                                                    <td colspan="1" class="text-right"><b>Address Line 1:</b></td>
                                                   
                                                    <td class="text-left text-danger"><?php echo $core->locker_address; ?></td>
                                                </tr>
                                                <tr class="headt">
                                                    <td colspan="1" class="text-right"><b>Address Line 2:</b></td>
                                                  
                                                    <td class="text-left text-danger"><?php echo $userData->locker; ?></td>
                                                </tr>
                                                <tr class="headt">
                                                    <td colspan="1" class="text-right"><b>City:</b></td>
                                                   
                                                    <td class="text-left text-danger"><?php echo $core->c_city; ?></td>
                                                </tr>
                                                <tr class="headt">
                                                    <td colspan="1" class="text-right"><b>Zip Code:</b></td>
                                                    
                                                    <td class="text-left text-danger"><?php echo $core->c_postal; ?></td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card">

                            <div class="card-body border-bottom">
                                <h4 class="card-title">Shipments summary</h4>
                            </div>
                            <div class="card-body">
                                <div class="row m-t-10">

                                    <div class="col-lg-6 col-md-6">
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-10"><a href="prealert_list.php"><span class="text-warning display-6"><i class="mdi mdi-clock-alert"></i></span></a></div>
                                            <div><span>Pre Alerts</span>
                                                <h4 class="font-medium m-b-0">
                                                    <?php

                                                    $db->cdp_query("SELECT COUNT(*) as total FROM cdb_pre_alert where is_package=0 and customer_id='" . $_SESSION['userid'] . "'");

                                                    $db->cdp_execute();

                                                    $count = $db->cdp_registro();

                                                    echo $count->total;
                                                    ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-6 col-md-6">
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-10">
                                                <span class="text-primary display-6">
                                                <a href="customer_packages_list.php" class="text-primary display-6">
                                                    <i class="fas fa-cube"></i></a></span>
                                            </div>
                                            <div><span>Packages Registered</span>
                                                <h4 class="font-medium m-b-0">
                                                    <?php

                                                    $db->cdp_query("SELECT COUNT(*) as total FROM cdb_customers_packages where sender_id='" . $_SESSION['userid'] . "'");

                                                    $db->cdp_execute();

                                                    $count = $db->cdp_registro();

                                                    echo $count->total;
                                                    ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- col -->
                                    <div class="col-lg-6 col-md-6">
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-10">
                                                <span class="text-orange display-6">

                                            <a href="courier_list.php" class="text-orange display-6"> <i class="mdi mdi-package-variant-closed"></i> </a></span>
                                            </div>
                                            <div><span>shipments</span>
                                                <h4 class="font-medium m-b-0">
                                                    <?php

                                                    $db->cdp_query("SELECT COUNT(*) as total FROM cdb_add_order WHERE order_incomplete=1 and sender_id='" . $_SESSION['userid'] . "'");

                                                    $db->cdp_execute();

                                                    $count = $db->cdp_registro();

                                                    echo $count->total;
                                                    ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-6">
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-10"><span class="text-success display-6">
                                                    <a href="courier_list.php" class="text-success display-6"> <i class="mdi mdi-package-down"></i> </a></span></div>
                                            <div><span>Shipments Delivered</span>
                                                <h4 class="font-medium m-b-0">
                                                    <?php

                                                    $db->cdp_query("SELECT COUNT(*) as total FROM cdb_add_order WHERE status_courier=8 and sender_id='" . $_SESSION['userid'] . "'");

                                                    $db->cdp_execute();

                                                    $count = $db->cdp_registro();

                                                    echo $count->total;
                                                    ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-6 col-md-4 ">
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-10"><span class="text-info display-6">
                                                    <a href="consolidate_list.php" class="text-info display-6"> <i class="mdi mdi-gift"></i> </a></span></div>
                                            <div><span>Consolidated</span>
                                                <h4 class="font-medium m-b-0">
                                                    <?php

                                                    $db->cdp_query("SELECT COUNT(*) as total FROM cdb_consolidate WHERE sender_id='" . $_SESSION['userid'] . "'");

                                                    $db->cdp_execute();

                                                    $count = $db->cdp_registro();

                                                    echo $count->total;
                                                    ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-6">
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-10"><span class="text-danger display-6">
                                                    <a href="courier_list.php" class="text-danger display-6"> <i class="mdi mdi-gift"></i> </a></span></div>
                                            <div><span>Shipments consolidated</span>
                                                <h4 class="font-medium m-b-0">
                                                    <?php


                                                    $db->cdp_query("SELECT COUNT(*) as total FROM cdb_add_order WHERE  is_consolidate=1 and sender_id='" . $_SESSION['userid'] . "'");

                                                    $db->cdp_execute();

                                                    $count = $db->cdp_registro();

                                                    echo $count->total;
                                                    ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
 
                    </div>


                    <div class="col-sm-12 col-lg-6">
                    <div class="card">
                            <div class="card-body border-bottom">
                                <h4 class="card-title">Accounts receivable summary</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <!-- column -->
                                    <div class="col-sm-6 col-md-6 col-lg-6">

                                        <ul class="list-style-none">

                                            <li class="m-t-20">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <span class="text-muted">Total Accounts receivable</span>
                                                        <h4 class="m-b-0">
                                                            <span class="font-16">
                                                                <?php echo $core->currency; ?> <?php

                                                                echo cdb_money_format($sumador_total);
                                                                ?>
                                                            </span>
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="progress m-t-10">
                                                    <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo cdb_money_format_bar($sumador_total) / 100; ?>%" aria-valuenow="47" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </li>

                                            <li class="m-t-20">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <span class="text-muted">Total accounts paid</span>
                                                        <h4 class="m-b-0">
                                                            <span class="font-16">


                                                                <?php echo $core->currency; ?> <?php
                                                                echo cdb_money_format($sumador_pagado);
                                                                ?>
                                                            </span>
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="progress m-t-10">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo cdb_money_format_bar($sumador_pagado) / 100; ?>%" aria-valuenow="47" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>


                                    <!-- column -->
                                    <div class="col-sm-6 col-md-6 col-lg-6">

                                        <ul class="list-style-none">

                                            <li class="m-t-20">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <span class="text-muted">Total pending accounts</span>
                                                        <h4 class="m-b-0">
                                                            <span class="font-16">

                                                                <?php echo $core->currency; ?> <?php

                                                                echo cdb_money_format($sumador_pendiente);
                                                                ?>
                                                            </span>
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="progress m-t-10">
                                                    <div class="progress-bar bg-orange" role="progressbar" style="width: <?php echo cdb_money_format_bar($sumador_pendiente) / 100; ?>%" aria-valuenow="47" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </li>

                                            <li class="m-t-20">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <span class="text-muted">Total pending packages registered</span>
                                                        <h4 class="m-b-0">
                                                            <span class="font-16">


                                                                <?php echo $core->currency; ?> <?php


                                                                $db->cdp_query("SELECT IFNULL(SUM(total_order),0) as total FROM cdb_customers_packages where status_invoice=2 and sender_id='" . $_SESSION['userid'] . "'");

                                                                $db->cdp_execute();

                                                                $row = $db->cdp_registro();

                                                                $sum1 = $row->total;

                                                                echo cdb_money_format($sum1);
                                                                                                ?>
                                                            </span>
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="progress m-t-10">
                                                    <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo cdb_money_format_bar($sum1) / 100; ?>%" aria-valuenow="47" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-body border-bottom">
                                <h4 class="card-title">Pickup summary</h4>

                            </div>
                            <div class="card-body">
                                <div class="row m-t-20 m-b-10">
                                    <div class="col-md-4 col-lg-6">
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-10"><span class="text-cyan display-6">
                                                    <a href="pickup_list.php" class="text-cyan display-6"> <i class="mdi mdi-star-circlemdi mdi-clock-fast"></i></a></span></div>
                                            <div><span> Pickup</span>
                                                <h4 class="font-medium m-b-0">
                                                    <?php

                                                    $db->cdp_query("SELECT COUNT(*) as total FROM cdb_add_order WHERE is_pickup=1 and order_incomplete=1 and sender_id='" . $_SESSION['userid'] . "' ");

                                                    $db->cdp_execute();

                                                    $count = $db->cdp_registro();

                                                    echo $count->total;
                                                    ?>

                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- col -->
                                    <!-- col -->
                                    <div class="col-md-4 col-lg-6">
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-10"><span class="text-orange display-6">
                                                    <a href="pickup_list.php" class="text-orange display-6"> <i class="mdi mdi-backspace"></i> </a></span></div>
                                            <div><span>Pickup rejected</span>
                                                <h4 class="font-medium m-b-0">
                                                    <?php


                                                    $db->cdp_query("SELECT COUNT(*) as total FROM cdb_add_order WHERE is_pickup=1 and status_courier=12 and sender_id='" . $_SESSION['userid'] . "'");

                                                    $db->cdp_execute();

                                                    $count = $db->cdp_registro();

                                                    echo $count->total;
                                                    ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-6">
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-10"><span class="text-danger display-6">
                                                    <a href="pickup_list.php" class="text-danger display-6"><i class="mdi mdi-close-circle"></i> </a></span></div>
                                            <div><span>Pickup cancelled</span>
                                                <h4 class="font-medium m-b-0">
                                                    <?php



                                                    $db->cdp_query("SELECT COUNT(*) as total FROM cdb_add_order WHERE is_pickup=1 and status_courier=21 and sender_id='" . $_SESSION['userid'] . "'");

                                                    $db->cdp_execute();

                                                    $count = $db->cdp_registro();

                                                    echo $count->total;
                                                    ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-6">
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-10"><span class="text-success display-6">
                                            <a href="pickup_list.php" class="text-success display-6"> <i class="mdi mdi-package-down"></i> </a></span></div>
                                            <div><span>Pickup Delivered</span>
                                                <h4 class="font-medium m-b-0">
                                                    <?php



                                                    $db->cdp_query("SELECT COUNT(*) as total FROM cdb_add_order WHERE status_courier=8 and  is_pickup=1 and sender_id='" . $_SESSION['userid'] . "'");

                                                    $db->cdp_execute();

                                                    $count = $db->cdp_registro();

                                                    echo $count->total;
                                                    ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div><br><br></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-shipment" role="tab" aria-controls="pills-shipment" aria-selected="true">Shipments list</a>
                                        <input type="hidden" name="userid" id="userid" value="<?php echo $_SESSION['userid']; ?>">
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-profile-tab" href="prealert_list.php">Pre Alerts</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-profile-tab" href="customer_packages_list.php">Packages Registered</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-profile-tab" href="consolidate_list.php">Consolidated</a>
                                    </li>

                                </ul>

                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-shipment" role="tabpanel" aria-labelledby="pills-home-tab">

                                        <div class="outer_div"></div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>


    <script src="dataJs/dashboard_client.js"></script>



    <?php include 'views/inc/footer.php'; ?>