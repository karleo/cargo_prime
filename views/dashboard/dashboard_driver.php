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
                    <div class="col-sm-12 col-lg-8">
                        <div class="card">
                            <div class="card-body border-bottom">
                                <h4 class="card-title">Shipments summary</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- col -->
                                    <div class="col-lg-4 col-md-6">
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-10"><a href="courier_list.php"><span class="text-orange display-6"><i class="mdi mdi-package-variant-closed"></i></span> </a></div>
                                            <div><span>shipments</span>
                                                <h4 class="font-medium m-b-0">
                                                    <?php

                                                    $db->cdp_query("SELECT COUNT(*) as total FROM cdb_add_order WHERE is_pickup=0 and driver_id='" . $_SESSION['userid'] . "'");

                                                    $db->cdp_execute();

                                                    $count = $db->cdp_registro();

                                                    echo $count->total;
                                                    ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-4">
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-10"><a href="courier_list.php"><span class="text-success display-6"><i class="mdi mdi-package-down"></i></span></a></div>
                                            <div><span>Shipments Delivered</span>
                                                <h4 class="font-medium m-b-0">
                                                    <?php

                                                    $db->cdp_query("SELECT COUNT(*) as total FROM cdb_add_order WHERE status_courier=8 and is_pickup=0 and driver_id='" . $_SESSION['userid'] . "'");

                                                    $db->cdp_execute();

                                                    $count = $db->cdp_registro();

                                                    echo $count->total;
                                                    ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-4 col-md-4 ">
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-10"><a href="consolidate_list.php"><span class="text-danger display-6"><i class="mdi mdi-gift"></i></span></a></div>
                                            <div><span>Consolidated</span>
                                                <h4 class="font-medium m-b-0">
                                                    <?php

                                                    $db->cdp_query("SELECT COUNT(*) as total FROM cdb_consolidate WHERE driver_id='" . $_SESSION['userid'] . "'");

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


                        <div class="card">
                            <div class="card-body border-bottom">
                                <h4 class="card-title">Pickup summary</h4>
                            </div>
                            <div class="card-body ">
                                <div class="row">

                                    <div class="col-md-3 col-lg-3">
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-10"><a href="pickup_list.php"><span class="text-cyan display-6"><i class="mdi mdi-star-circlemdi mdi-clock-fast"></i></span></a></div>
                                            <div><span> Assigned pickup</span>
                                                <h4 class="font-medium m-b-0">
                                                    <?php

                                                    $db->cdp_query("SELECT COUNT(*) as total FROM cdb_add_order WHERE is_pickup=1 and driver_id='" . $_SESSION['userid'] . "' ");

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
                                    <div class="col-md-3 col-lg-3">
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-10"><a href="pickup_list.php"><span class="text-orange display-6"><i class="mdi mdi-backspace"></i></span> </a></div>
                                            <div><span>Pickup rejected</span>
                                                <h4 class="font-medium m-b-0">
                                                    <?php


                                                    $db->cdp_query("SELECT COUNT(*) as total FROM cdb_add_order WHERE is_pickup=1 and status_courier=12 and driver_id='" . $_SESSION['userid'] . "'");

                                                    $db->cdp_execute();

                                                    $count = $db->cdp_registro();

                                                    echo $count->total;
                                                    ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-lg-3">
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-10"><a href="pickup_list.php"><span class="text-danger display-6"><i class="mdi mdi-close-circle"></i></span> </a></div>
                                            <div><span>Pickup cancelled</span>
                                                <h4 class="font-medium m-b-0">
                                                    <?php

                                                    $db->cdp_query("SELECT COUNT(*) as total FROM cdb_add_order WHERE is_pickup=1 and status_courier=21 and driver_id='" . $_SESSION['userid'] . "'");

                                                    $db->cdp_execute();

                                                    $count = $db->cdp_registro();

                                                    echo $count->total;
                                                    ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-lg-3">
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-10"><a href="pickup_list.php"><span class="text-success display-6"><i class="mdi mdi-package-down"></i></span> </a></div>
                                            <div><span>Pickup Delivered</span>
                                                <h4 class="font-medium m-b-0">
                                                    <?php



                                                    $db->cdp_query("SELECT COUNT(*) as total FROM cdb_add_order WHERE status_courier=8 and  is_pickup=1 and driver_id='" . $_SESSION['userid'] . "'");

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


                    <div class="col-sm-12 col-md-7 col-lg-4">
                        <div class="card">
                            <div class="card-body border-bottom">
                                <h4 class="card-title">Sales summary</h4>
                            </div>
                            <div class="card-body">

                                <div class="row m-t-30 m-b-20">
                                    <!-- col -->
                                    <div class="col-sm-12 col-md-12 m-b-10">
                                        <span>Total shipments</span>
                                        <h4 class="m-b-0">
                                            <?php echo $core->currency; ?> 
                                            <?php

                                            $db->cdp_query('SELECT IFNULL(SUM(total_order),0) as total FROM cdb_add_order where is_pickup=0 and driver_id='. $_SESSION['userid'] . '');

                                            $db->cdp_execute();

                                            $row = $db->cdp_registro();

                                            $sum1 = $row->total;

                                            echo cdb_money_format($sum1);

                                            ?>
                                        </h4>

                                        <div class="progress m-t-10">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo cdb_money_format_bar($sum1) / 100; ?>%" aria-valuenow="47" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <!-- col -->
                                    <!-- col -->
                                    <div class="col-sm-12 col-md-12 m-b-10">
                                        <span>Total Pick up</span>
                                        <h4 class="m-b-0">
                                            <?php echo $core->currency; ?> 
                                            <?php

                                            $db->cdp_query('SELECT IFNULL(SUM(total_order),0) as total FROM cdb_add_order where is_pickup=1 and driver_id='. $_SESSION['userid'] . '');

                                            $db->cdp_execute();

                                            $row = $db->cdp_registro();

                                            $sum2 = $row->total;

                                            echo cdb_money_format($sum2);

                                            ?>
                                        </h4>

                                        <div class="progress m-t-10">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo cdb_money_format_bar($sum2) / 100; ?>%" aria-valuenow="47" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <!-- col -->
                                    <!-- col -->
                                    <div class="col-sm-12 col-md-12 m-b-10">
                                        <span>Total conslidated</span>
                                        <h4 class="m-b-0">


                                            <?php echo $core->currency; ?> 
                                            <?php

                                            $db->cdp_query('SELECT IFNULL(SUM(total_order),0) as total FROM cdb_consolidate where driver_id='. $_SESSION['userid'] . '');

                                            $db->cdp_execute();

                                            $row = $db->cdp_registro();

                                            $sum3 = $row->total;

                                            echo cdb_money_format($sum3);

                                            ?>
                                        </h4>

                                        <div class="progress m-t-10">
                                            <div class="progress-bar bg-orange" role="progressbar" style="width: <?php echo cdb_money_format_bar($sum3) / 100; ?>%" aria-valuenow="47" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title">Shipments list</h4>
                                        <input type="hidden" name="userid" id="userid" value="<?php echo $_SESSION['userid']; ?>">
                                    </div>

                                </div>
                                <div class="outer_div">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <script src="dataJs/dashboard_driver.js"></script>



    <?php include 'views/inc/footer.php'; ?>