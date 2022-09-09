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
    <!-- <link href="assets/extra-libs/css-chart/css-chart.css" rel="stylesheet"> -->
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
        <?php include 'views/inc/preloader.php'; ?>

    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
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
                <!-- Earnings, Sale Locations -->
                <!-- ============================================================== -->
               

                <div class="row">

<div class="col-sm-12 col-md-7 col-lg-9">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <!-- column -->
                <div class="col-sm-12 col-md-6 col-lg-8">
                    <div class="card-body border-bottom">
                        <h5 class="card-title"><?php echo $lang['dashnew06'] ?></h5>
                    </div>

                    <div class="row">
                        <!-- col -->
                        <div class="col-lg-6 col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="m-r-10"><a href="dashboard_admin_shipments.php"><span class="text-orange display-6"><i class="mdi mdi-package-variant-closed"></i></span></a></div>
                                <div><span><?php echo $lang['dashnew07'] ?></span>
                                    <h3 class="font-medium m-b-0">
                                        <?php

                                        $db->cdp_query('SELECT COUNT(*) as total FROM cdb_add_order WHERE  order_incomplete=1');

                                        $db->cdp_execute();

                                        $count = $db->cdp_registro();

                                        echo $count->total;
                                        ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <!-- col -->
                        <div class="col-lg-6 col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="m-r-10"><a href="pickup_list.php"><span class="text-cyan display-6"><i class="mdi mdi-star-circlemdi mdi-clock-fast"></i></span> </a></div>
                                <div><span><?php echo $lang['dashnew08'] ?></span>
                                    <h3 class="font-medium m-b-0">
                                        <?php

                                        $db->cdp_query('SELECT COUNT(*) as total FROM cdb_add_order WHERE is_pickup=1 and status_courier=14');

                                        $db->cdp_execute();

                                        $count = $db->cdp_registro();

                                        echo $count->total;
                                        ?>

                                    </h3> 
                                </div>
                            </div>
                        </div>
                        <!-- col -->
                        <div class="col-lg-6 col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="m-r-10"><a href="consolidate_list.php"><span class="text-danger display-6"><i class="mdi mdi-gift"></i></span></a></div>
                                <div><span><?php echo $lang['dashnew09'] ?></span>
                                    <h3 class="font-medium m-b-0">
                                        <?php

                                        $db->cdp_query('SELECT COUNT(*) as total FROM cdb_consolidate');

                                        $db->cdp_execute();

                                        $count = $db->cdp_registro();

                                        echo $count->total;
                                        ?>
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <!-- col -->
                        <div class="col-lg-6 col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="m-r-10"><a href="accounts_receivable.php"><span class="text-primary display-6"><i class="mdi mdi-package-down"></i></span></a></div>
                                <div><span><?php echo $lang['dashnew10'] ?></span>
                                    <h3 class="font-medium m-b-0">
                                        <?php

                                        $db->cdp_query('SELECT COUNT(*) as total FROM cdb_add_order WHERE order_payment_method >1');

                                        $db->cdp_execute();

                                        $count = $db->cdp_registro();

                                        echo $count->total;
                                        ?>
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <!-- col -->
                        <div class="col-lg-6 col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="m-r-10"><a href="prealert_list.php"><span class="text-warning display-6"><i class="mdi mdi-clock-alert"></i></span></a></div>
                                <div><span><?php echo $lang['dashnew11'] ?></span>
                                    <h3 class="font-medium m-b-0">
                                        <?php

                                        $db->cdp_query('SELECT COUNT(*) as total FROM cdb_pre_alert where is_package=0');

                                        $db->cdp_execute();

                                        $count = $db->cdp_registro();

                                        echo $count->total;
                                        ?>
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <!-- col -->
                        <div class="col-lg-6 col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="m-r-10"><a href="customer_packages_list.php"><span class="text-success display-6"><i class="fas fa-cube"></i></span></a></div>
                                <div><span><?php echo $lang['dashnew12'] ?></span>
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
                        <!-- col -->
                    </div>

                    <div class="row">

                        <div class="col-md-6 col-sm-12 col-lg-6">
                            <div class="card-body border-bottom">
                        
                        </div>
                            <div class="d-flex align-items-center">
                                <div class="m-r-10"><span class="text-primary display-6"><i class="mdi mdi-basket"></i></span></div>
                                <div><span class="text-muted"><?php echo $lang['dashnew13'] ?></span>
                                    <h4 class="font-medium m-b-0"><?php echo $core->currency; ?>

                                        <?php

                                        $db->cdp_query('SELECT IFNULL(SUM(total_order),0) as total FROM cdb_customers_packages WHERE status_courier!=21');

                                        $db->cdp_execute();

                                        $count = $db->cdp_registro();

                                        echo cdb_money_format($count->total);

                                        ?>
                                    </h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12 col-lg-6">
                            <div class="card-body border-bottom">
                        
                        </div>
                            <div class="d-flex align-items-center">
                                <div class="m-r-10"><span class="text-orange display-6"><i class="mdi mdi-wallet"></i></span></div>
                                <div><span class="text-muted"><?php echo $lang['dashnew14'] ?></span>
                                    <h4 class="font-medium m-b-0"><?php echo $core->currency; ?>

                                        <?php

                                        $db->cdp_query('SELECT IFNULL(SUM(total_order),0) as total FROM cdb_add_order where status_courier!=21 and  status_invoice!=0 and order_payment_method>1');

                                        $db->cdp_execute();

                                        $count = $db->cdp_registro();

                                        echo cdb_money_format($count->total);
                                        ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- column -->
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card-body border-bottom">
                        <h5 class="card-title"><?php echo $lang['dashnew15'] ?></h5>
                    </div>
                    <ul class="list-style-none">
                        <li class="m-t-30">
                            <div class="d-flex align-items-center">
                                <div>
                                    <span class="text-muted"><?php echo $lang['dashnew16'] ?></span>
                                    <h4 class="m-b-0">
                                        <span class="font-16">
                                            <?php echo $core->currency; ?> 
                                            <?php

                                            $db->cdp_query('SELECT IFNULL(SUM(total_order),0) as total FROM cdb_add_order where status_courier!=21 and is_pickup=0');

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
                                <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo cdb_money_format_bar($sum1) / 100; ?>%" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </li>
                        <li class="m-t-30">
                            <div class="d-flex align-items-center">
                                <div>
                                    <span class="text-muted"><?php echo $lang['dashnew17'] ?></span>
                                    <h4 class="m-b-0">
                                        <span class="font-16">
                                            <?php echo $core->currency; ?> 
                                            <?php

                                            $db->cdp_query('SELECT IFNULL(SUM(total_order),0) as total FROM cdb_add_order where status_courier!=21 and is_pickup=1');

                                            $db->cdp_execute();

                                            $row = $db->cdp_registro();

                                            $sum2 = $row->total;

                                            echo cdb_money_format($sum2);

                                            ?>
                                        </span>
                                    </h4>
                                </div>
                            </div>
                            <div class="progress m-t-10">
                                <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo cdb_money_format_bar($sum2) / 100; ?>%" aria-valuenow="47" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </li>
                        <li class="m-t-30 m-b-40">
                            <div class="d-flex align-items-center">
                                <div>
                                    <span class="text-muted"><?php echo $lang['dashnew18'] ?></span>
                                    <h4 class="m-b-0">
                                        <span class="font-16">
                                            <?php echo $core->currency; ?>
                                            <?php

                                            $db->cdp_query('SELECT IFNULL(SUM(total_order),0) as total FROM cdb_consolidate WHERE status_courier!=21');

                                            $db->cdp_execute();

                                            $row = $db->cdp_registro();

                                            $sum3 = $row->total;

                                            echo cdb_money_format($sum3);

                                            ?>
                                        </span>
                                    </h4>
                                </div>
                            </div>
                            <div class="progress m-t-10">
                                <div class="progress-bar bg-red" role="progressbar" style="width: <?php echo cdb_money_format_bar($sum3) / 100; ?>%" aria-valuenow="47" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="col-sm-12 col-md-5 col-lg-3">
    <div class="card">
        <div class="card-body">
            <div class="card-body border-bottom">
                <h5 class="card-title"><?php echo $lang['dashnew01'] ?></h5>
                <!-- <h5 class="card-subtitle">Indicadores de usuarios</h5> -->
            </div>

            <div class="col-md-6 col-sm-12 col-lg-6 m-t-30 m-b-20">
                <div class="d-flex align-items-center">
                    <div class="m-r-10">
                        <?php if ($userData->userlevel == 9) { ?>
                        <a href="users_list.php"><span class="display-6"><i class="mdi mdi-account-settings-variant" style="color: #36bea6;"></i></span></a>
                        <?php } ?>
                        <?php if ($userData->userlevel == 2) { ?>
                        <a href="#"><span class="display-6"><i class="mdi mdi-account-settings-variant" style="color: #36bea6;"></i></span></a>
                        <?php } ?>
                    </div>
                    <div>
                        <span class="text-muted"><?php echo $lang['dashnew02'] ?></span>
                        <h3 class="font-medium m-b-0">
                            <?php

                            $db->cdp_query('SELECT COUNT(*) as total FROM cdb_users WHERE userlevel=9');

                            $db->cdp_execute();

                            $count = $db->cdp_registro();

                            echo $count->total;
                            ?>
                        </h3>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12 col-lg-6">
                <div class="d-flex align-items-center">
                    <div class="m-r-10">
                        <?php if ($userData->userlevel == 9) { ?>
                        <a href="users_list.php"><span class="display-6"><i class="mdi mdi-account-settings" style="color: #fb8c00;"></i></span></a>
                        <?php } ?>
                        <?php if ($userData->userlevel == 2) { ?>
                        <a href="#"><span class="display-6"><i class="mdi mdi-account-settings" style="color: #fb8c00;"></i></span></a>
                        <?php } ?>
                    </div>
                    <div><span class="text-muted"><?php echo $lang['dashnew03'] ?></span>
                        <h3 class="font-medium m-b-0">
                            <?php

                            $db->cdp_query('SELECT COUNT(*) as total FROM cdb_users WHERE userlevel=2');

                            $db->cdp_execute();

                            $count = $db->cdp_registro();

                            echo $count->total;
                            ?>
                        </h3>
                    </div>
                </div>
            </div>


            <div class="col-md-6 col-sm-12 col-lg-6">
                <div class="d-flex align-items-center">
                    <div class="m-r-10"><a href="drivers_list.php"><span class="display-6"><i class="mdi mdi-account-star-variant" style="color: #7460ee;"></i></span></a></div>
                    <div><span class="text-muted"><?php echo $lang['dashnew04'] ?></span>
                        <h3 class="font-medium m-b-0">
                            <?php

                            $db->cdp_query('SELECT COUNT(*) as total FROM cdb_users WHERE userlevel=3');

                            $db->cdp_execute();

                            $count = $db->cdp_registro();

                            echo $count->total;
                            ?>
                        </h3>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12 col-lg-6">
                <div class="d-flex align-items-center">
                    <div class="m-r-10"><a href="customers_list.php"><span class="display-6"><i class="mdi mdi-account-check" style="color: #1f95ff;"></i></span></a></div>
                    <div><span class="text-muted"><?php echo $lang['dashnew05'] ?></span>
                        <h3 class="font-medium m-b-0">
                            <?php

                            $db->cdp_query('SELECT COUNT(*) as total FROM cdb_users WHERE userlevel=1');

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
                <!--   paste the notes -->


                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-shipment" role="tab" aria-controls="pills-shipment" aria-selected="true"><?php echo $lang['dashnew19'] ?></a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-profile-tab" href="pickup_list.php"><?php echo $lang['dashnew20'] ?></a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-profile-tab" href="consolidate_list.php"><?php echo $lang['dashnew21'] ?></a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-profile-tab" href="prealert_list.php"><?php echo $lang['dashnew22'] ?></a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-profile-tab" href="customer_packages_list.php"><?php echo $lang['dashnew23'] ?></a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-shipment" role="tabpanel" aria-labelledby="pills-home-tab">

                                        <div class="col-md-4 mt-4 mb-4">
                                            <div class="input-group">
                                                <input type="text" name="search_shipment" id="search_shipment" class="form-control input-sm float-right" placeholder="search tracking" onkeyup="cdp_load(1);">
                                                <div class="input-group-append input-sm">
                                                    <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="results_shipments"></div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-pickup" role="tabpanel" aria-labelledby="pills-profile-tab">

                                        <div class="col-md-4 mt-4 mb-4">
                                            <div class="input-group">
                                                <input type="text" name="search_pickup" id="search_pickup" class="form-control input-sm float-right" placeholder="search tracking" onkeyup="cdp_load(1);">
                                                <div class="input-group-append input-sm">
                                                    <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="results_pickup"></div>

                                    </div>
                                    <div class="tab-pane fade" id="pills-consolidated" role="tabpanel" aria-labelledby="pills-contact-tab">
                                        <div class="col-md-4 mt-4 mb-4">
                                            <div class="input-group">
                                                <input type="text" name="search_consolidated" id="search_consolidated" class="form-control input-sm float-right" placeholder="search tracking" onkeyup="cdp_load(1);">
                                                <div class="input-group-append input-sm">
                                                    <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="results_consolidated"></div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="dataJs/dashboard_index.js"></script> 

    <?php include 'views/inc/footer.php'; ?>