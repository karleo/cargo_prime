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
$statusrow = $core->cdp_getStatus();

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
    <title>Dashboard packages registered | <?php echo $core->site_name ?></title>

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

    <script src="assets/libs/chart.js-2.8/Chart.min.js"></script>

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
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">

                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title">Sales summary</h4>
                                        <h5 class="card-subtitle">Overview of Latest Month</h5>

                                    </div>
                                </div>

                                <div class="row">
                                    <!-- column -->
                                    <div class="col-lg-12 col-md-12">
                                        <div class="row m-t-30 m-b-20">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="m-r-10"><a href="customer_packages_list.php"><span class="text-primary display-6"><i class="fas fa-cube"></i></span></a></div>
                                                    <div><span>Packages Registered</span>
                                                        <h3 class="font-medium m-b-0">
                                                            <?php

                                                            $db->cdp_query('SELECT COUNT(*) as total FROM cdb_customers_packages');

                                                            $db->cdp_execute();

                                                            $count = $db->cdp_registro();

                                                            echo $count->total;
                                                            ?>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="m-r-10"><a href="customer_packages_list.php"><span class="text-orange display-6"><i class="fas fa-cube"></i></span></a></div>
                                                    <div><span>Packages Registered Pending</span>
                                                        <h3 class="font-medium m-b-0">
                                                            <?php

                                                            $db->cdp_query('SELECT COUNT(*) as total FROM cdb_customers_packages where status_invoice = 2');

                                                            $db->cdp_execute();

                                                            $count = $db->cdp_registro();

                                                            echo $count->total;
                                                            ?>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-lg-6 col-md-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="m-r-10"><a href="customer_packages_list.php"><span class="text-info display-6"><i class="fas fa-cube"></i></span></a></div>
                                                    <div><span>Packages Registered payment verification</span>
                                                        <h3 class="font-medium m-b-0">
                                                            <?php

                                                            $db->cdp_query('SELECT COUNT(*) as total FROM cdb_customers_packages where status_invoice = 3');

                                                            $db->cdp_execute();

                                                            $count = $db->cdp_registro();

                                                            echo $count->total;
                                                            ?>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-lg-6 col-md-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="m-r-10"><a href="customer_packages_list.php"><span class="text-success display-6"><i class="fas fa-cube"></i></span></a></div>
                                                    <div><span>Packages Registered paid</span>
                                                        <h3 class="font-medium m-b-0">
                                                            <?php

                                                            $db->cdp_query('SELECT COUNT(*) as total FROM cdb_customers_packages where status_invoice = 1');

                                                            $db->cdp_execute();

                                                            $count = $db->cdp_registro();

                                                            echo $count->total;
                                                            ?>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-lg-6 col-md-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="m-r-10"><a href="prealert_list.php"><span class="text-danger display-6"><i class="mdi mdi-clock-alert"></i></span></a></div>
                                                    <div><span>Packages Pre Alerts</span>
                                                        <h3 class="font-medium m-b-0">
                                                            <?php

                                                            $db->cdp_query('SELECT COUNT(*) as total FROM cdb_customers_packages where is_prealert=1');

                                                            $db->cdp_execute();

                                                            $count = $db->cdp_registro();

                                                            echo $count->total;
                                                            ?>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">

                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title">Sales graph</h4>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        
                                            <canvas id="myChart" style="height: 220px;">
                                            </canvas>
                                       
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- Table -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-lg-12">
                                                <div class="card">
                            <div class="card-body">

                                <div class="row mb-5">
                                    <div class="col-md-3 col-sm-12">
                                        <div class="btn-group mt-2 hide" id="div-actions-checked">
                                            <span class="mt-2 mr-4"><strong id="countChecked"> Selected: 0</strong></span>
                                            <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Selected actions
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalCheckboxStatus"><i style="color:#20c997" class="ti-reload"></i>&nbsp;Edit Status</a>

                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalDriverCheckbox"><i style="color:#ff0000" class="fas fa-car"></i>&nbsp;<?php echo $lang['left208'] ?></a>

                                                <a class="dropdown-item" onclick="cdp_printMultipleLabel();" target="_blank"> <i style="color:#343a40" class="ti-printer"></i>&nbsp;<?php echo $lang['toollabel'] ?> </a>


                                            </div>
                                        </div>

                                    </div>

                                    <?php
                                    if ($user->cdp_is_Admin()) { ?>

                                        <div class=" col-sm-12 col-md-2 offset-7">

                                            <div class="form-group">
                                                <a href="customer_packages_add.php"><button type="button" class="btn btn-primary "><i class="ti-plus" aria-hidden="true"></i> Register Packages</button></a>
                                            </div>
                                        </div>

                                    <?php } ?>

                                </div>

                                <div class="row mb-3 ml-2">

                                    <div class=" col-sm-12 col-md-4">

                                        <div class="input-group">
                                            <input type="text" name="search" id="search" class="form-control input-sm float-right" placeholder="search tracking" onkeyup="cdp_load(1);">
                                            <div class="input-group-append input-sm">
                                                <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                                            </div>

                                        </div>
                                    </div><!-- /.col -->

                                    <div class="col-sm-12 col-md-3">
                                        <div class="input-group">
                                            <select onchange="cdp_load(1);" class="form-control custom-select" id="status_courier" name="status_courier">
                                                <option value="0">--<?php echo $lang['left210'] ?>--</option>
                                                <?php foreach ($statusrow as $row) : ?>
                                                    <option value="<?php echo $row->id; ?>"><?php echo $row->mod_style; ?></option>

                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="outer_divz"></div>


                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Table -->
                <!-- ============================================================== -->

            </div>

            <?php
            include('views/modals/modal_update_status_checked.php');
            ?>
            <?php include('views/modals/modal_send_email.php'); ?>

            <?php include('views/modals/modal_update_driver.php'); ?>
            <?php include('views/modals/modal_update_driver_checked.php'); ?>
            <?php include('views/modals/modal_delete_package.php'); ?>

            <?php include('views/modals/modal_add_payment_package.php'); ?>
            <?php include('views/modals/modal_verify_payment_packages.php'); ?>

        </div>
    </div>


    <script src="dataJs/dashboard_packages.js"></script> 
     <script src="dataJs/customers_packages.js"></script> 


    <?php include 'views/inc/footer.php'; ?>