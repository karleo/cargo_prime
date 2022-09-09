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
    <title><?php echo $lang['report-general01'] ?> | <?php echo $core->site_name ?></title>
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

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title"> <?php echo $lang['report-general01'] ?></h4>

                    </div>
                </div>
            </div>

            <!-- Action part -->
            <!-- Button group part -->
            <div class="bg-light p-15">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-12">
                                <!-- <div id="loader" style="display:none"></div> -->
                                <div id="resultados_ajax"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Action part -->


            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- REPORTS GENERALS 1 -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- ONLINE SHIPPING -->
                    <div class="col-sm-12 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <!-- title -->
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title"><span class="display-7"><i class="mdi mdi-cart-outline" style="color:#9B9B8C"></i></span> <?php echo $lang['report-general02'] ?></h4>
                                        <h5 class="card-subtitle"><span class=""><i class="ti ti-angle-double-right"></i></span> <?php echo $lang['report-general07'] ?></h5>
                                    </div>

                                </div>
                                <!-- title -->
                                <table class="tablesaw table-hover table no-border">
                                    <tbody>

                                        <tr>
                                            <td class="title"><a class="link" href="report_packages_registered.php"><i class="ti ti-arrow-right" style="color:#00D900"></i> <?php echo $lang['report-general03'] ?></a></td>
                                        </tr>

                                        <?php if ($user->userlevel == 9 || $user->userlevel == 2) { ?>

                                            <tr>
                                                <td class="title"><a class="link" href="report_packages_registered_employee.php"><i class="ti ti-arrow-right" style="color:#00D900"></i> <?php echo $lang['report-general04'] ?></a></td>
                                            </tr>

                                            <tr>
                                                <td class="title"><a class="link" href="report_packages_registered_agency.php"><i class="ti ti-arrow-right" style="color:#00D900"></i> <?php echo $lang['report-general05'] ?></a></td>
                                            </tr>

                                            <tr>
                                                <td class="title"><a class="link" href="report_packages_registered_driver.php"><i class="ti ti-arrow-right" style="color:#00D900"></i> <?php echo $lang['report-general06'] ?></a></td>
                                            </tr>

                                            <tr>
                                                <td class="title"></td>
                                            </tr>
                                            <br>
                                        <?php
                                        }

                                        ?>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <!-- ONLINE SHOPPING-->


                    <!-- SHIPMENT -->
                    <div class="col-sm-12 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <!-- title -->
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title"><span class="display-7"><i class="mdi mdi-package-variant" style="color:#9B9B8C"></i></span> <?php echo $lang['report-general08'] ?></h4>
                                        <h5 class="card-subtitle"><span class=""><i class="ti ti-angle-double-right"></i></span> <?php echo $lang['report-general09'] ?></h5>
                                    </div>

                                </div>
                                <!-- title -->
                                <table class="tablesaw table-hover table no-border">
                                    <tbody>

                                        <tr>
                                            <td class="title"><a class="link" href="report_general.php"><i class="ti ti-arrow-right" style="color:#00D900"></i> <?php echo $lang['report-general010'] ?></a></td>
                                        </tr>

                                        <?php if ($user->userlevel == 9 || $user->userlevel == 2) { ?>

                                            <tr>
                                                <td class="title"><a class="link" href="report_customer.php"><i class="ti ti-arrow-right" style="color:#00D900"></i> <?php echo $lang['report-general011'] ?></a></td>
                                            </tr>

                                            <tr>
                                                <td class="title"><a class="link" href="report_employees.php"><i class="ti ti-arrow-right" style="color:#00D900"></i> <?php echo $lang['report-general012'] ?></a></td>
                                            </tr>

                                            <tr>
                                                <td class="title"><a class="link" href="report_agency.php"><i class="ti ti-arrow-right" style="color:#00D900"></i> <?php echo $lang['report-general013'] ?></a></td>
                                            </tr>

                                            <tr>
                                                <td class="title"><a class="link" href="report_driver_list.php"><i class="ti ti-arrow-right" style="color:#00D900"></i> <?php echo $lang['report-general014'] ?></a></td>
                                            </tr>
                                        <?php
                                        }

                                        ?>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <!-- SHIPMENT -->
                </div>
                <!-- ============================================================== -->
                <!-- REPORT GENERALS 1 -->
                <!-- ============================================================== -->



                <!-- ============================================================== -->
                <!-- REPORTS GENERALS 2 -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- PICK UP SHIPMENT -->
                    <div class="col-sm-12 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <!-- title -->
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title"><span class="display-6"><i class="mdi mdi-cube-send" style="color:#9B9B8C"></i></span> <?php echo $lang['report-general015'] ?></h4>
                                        <h5 class="card-subtitle"><span class=""><i class="ti ti-angle-double-right"></i></span> <?php echo $lang['report-general016'] ?></h5>
                                    </div>

                                </div>
                                <!-- title -->
                                <table class="tablesaw table-hover table no-border">
                                    <tbody>

                                        <tr>
                                            <td class="title"><a class="link" href="report_pickup_general_list.php"><i class="ti ti-arrow-right" style="color:#00D900"></i> <?php echo $lang['report-general017'] ?></a></td>
                                        </tr>

                                        <?php if ($user->userlevel == 9 || $user->userlevel == 2) { ?>

                                            <tr>
                                                <td class="title"><a class="link" href="report_pickup_customers_list.php"><i class="ti ti-arrow-right" style="color:#00D900"></i> <?php echo $lang['report-general018'] ?></a></td>
                                            </tr>

                                            <tr>
                                                <td class="title"><a class="link" href="report_pickup_employees_list.php"><i class="ti ti-arrow-right" style="color:#00D900"></i> <?php echo $lang['report-general019'] ?></a></td>
                                            </tr>

                                            <tr>
                                                <td class="title"><a class="link" href="report_pickup_agency_list.php"><i class="ti ti-arrow-right" style="color:#00D900"></i> <?php echo $lang['report-general020'] ?></a></td>
                                            </tr>

                                            <tr>
                                                <td class="title"><a class="link" href="report_pickup_driver_list.php"><i class="ti ti-arrow-right" style="color:#00D900"></i> <?php echo $lang['report-general021'] ?></a></td>
                                            </tr>

                                            <tr>
                                                <td class="title"></td>
                                            </tr>

                                        <?php
                                        }

                                        ?>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <!-- PICK UP SHIPMENT-->


                    <!-- CONSOLIDATE -->
                    <div class="col-sm-12 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <!-- title -->
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title"><span class="display-7"><i class="fas fas fa-boxes" style="color:#9B9B8C"></i></span> <?php echo $lang['report-general022'] ?></h4>
                                        <h5 class="card-subtitle"><span class=""><i class="ti ti-angle-double-right"></i></span> <?php echo $lang['report-general023'] ?></h5>
                                    </div>

                                </div>
                                <!-- title -->
                                <table class="tablesaw table-hover table no-border">
                                    <tbody>

                                        <tr>
                                            <td class="title"><a class="link" href="report_consolidate_general_list.php"><i class="ti ti-arrow-right" style="color:#00D900"></i> <?php echo $lang['report-general024'] ?></a></td>
                                        </tr>

                                        <?php if ($user->userlevel == 9 || $user->userlevel == 2) { ?>

                                            <tr>
                                                <td class="title"><a class="link" href="report_consolidate_customers_list.php"><i class="ti ti-arrow-right" style="color:#00D900"></i> <?php echo $lang['report-general025'] ?></a></td>
                                            </tr>

                                            <tr>
                                                <td class="title"><a class="link" href="report_consolidate_employees_list.php"><i class="ti ti-arrow-right" style="color:#00D900"></i> <?php echo $lang['report-general026'] ?></a></td>
                                            </tr>

                                            <tr>
                                                <td class="title"><a class="link" href="report_consolidate_agency_list.php"><i class="ti ti-arrow-right" style="color:#00D900"></i> <?php echo $lang['report-general027'] ?></a></td>
                                            </tr>

                                            <tr>
                                                <td class="title"><a class="link" href="report_consolidate_driver_list.php"><i class="ti ti-arrow-right" style="color:#00D900"></i> <?php echo $lang['report-general028'] ?></a></td>
                                            </tr>

                                            <tr>
                                                <td class="title"></td>
                                            </tr>
                                        <?php
                                        }

                                        ?>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <!-- CONSOLIDATE-->

                </div>
                <!-- ============================================================== -->
                <!-- REPORT GENERAL 2 -->
                <!-- ============================================================== -->


                <!-- ============================================================== -->
                <!-- REPORTS GENERALS 3 -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- ACCOUNTS RECEIVABLE -->
                    <div class="col-sm-12 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <!-- title -->
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title"><span class="display-7"><i class="mdi mdi-chart-line" style="color:#9B9B8C"></i></span> <?php echo $lang['report-general029'] ?></h4>
                                        <h5 class="card-subtitle"><span class=""><i class="ti ti-angle-double-right"></i></span> <?php echo $lang['report-general030'] ?></h5>
                                    </div>

                                </div>
                                <!-- title -->
                                <table class="tablesaw table-hover table no-border">
                                    <tbody>


                                        <?php if ($user->userlevel == 9 || $user->userlevel == 2) { ?>

                                            <tr>
                                                <td class="title"><a class="link" href="report_customers_balance_list.php"><i class="ti ti-arrow-right" style="color:#00D900"></i> <?php echo $lang['report-general031'] ?></a></td>
                                            </tr>

                                            <tr>
                                                <td class="title"><a class="link" href="report_summary_list.php"><i class="ti ti-arrow-right" style="color:#00D900"></i> <?php echo $lang['report-general032'] ?></a></td>
                                            </tr>

                                            <tr>
                                                <td class="title"><a class="link" href="report_payments_received_list.php"><i class="ti ti-arrow-right" style="color:#00D900"></i> <?php echo $lang['report-general033'] ?></a></td>
                                            </tr>

                                        <?php
                                        }

                                        ?>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <!-- ACCOUNTS RECEIVABLE-->

                </div>
                <!-- ============================================================== -->
                <!-- REPORT GENERAL 3 -->
                <!-- ============================================================== -->

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


</body>

</html>