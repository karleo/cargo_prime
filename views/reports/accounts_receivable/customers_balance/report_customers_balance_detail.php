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




$db = new Conexion;
$user = new User;
$core = new Core;
$userData = $user->cdp_getUserData();

$customer_id = intval($_REQUEST['customer']);
$fecha_inicio = cdp_sanitize($_REQUEST['fecha_inicio']);
$fecha_fin = cdp_sanitize($_REQUEST['fecha_fin']);

$sWhere = "";


if ($customer_id > 0) {

    $sWhere .= " and sender_id = '" . $customer_id . "'";
}



$sql = "SELECT * FROM cdb_add_order where order_payment_method !=1  
            and order_date between '$fecha_inicio'  and '$fecha_fin'
            $sWhere
            
             order by order_id desc 
             ";


$query_count = $db->cdp_query($sql);
$db->cdp_execute();
$numrows = $db->cdp_rowCount();


$db->cdp_query($sql);
$data = $db->cdp_registros();


$db->cdp_query("SELECT * FROM cdb_users where id= '" . $customer_id . "'");
$sender_data = $db->cdp_registro();


$fecha_inicio = str_replace('-', '/', $fecha_inicio);
$fecha_fin = str_replace('-', '/', $fecha_fin);


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
    <title>Customers balance report detail</title>
    <!-- This Page CSS -->
    <!-- Custom CSS -->
    <link href="assets/css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="assets/jquery-ui.css" type="text/css" />

    <script type="text/javascript" src="assets/js/jquery.js"></script>
    <script type="text/javascript" src="assets/js/jquery-ui.js"></script>

    <link href="assets/css/front.css" rel="stylesheet" type="text/css">
    <script src="assets/js/jquery.ui.touch-punch.js"></script>
    <script src="assets/js/jquery.wysiwyg.js"></script>
    <script src="assets/js/global.js"></script>
    <script src="assets/js/custom.js"></script>
    <link href="assets/customClassPagination.css" rel="stylesheet">
    <!--    daterangerpicker-master 
 -->
    <link rel="stylesheet" href="assets/css/daterangepicker.css">
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/daterangepicker.js"></script>


    <style type="text/css">
        .scrollable-menu {
            height: auto;
            max-height: 300px;
            overflow-x: hidden;
        }

        .card-outline {
            border-top: 3px solid #bbb;
        }
    </style>


    <script>
        $(function() {
            "use strict";
            $("#main-wrapper").AdminSettings({
                Theme: false, // this can be true or false ( true means dark and false means light ),
                Layout: 'vertical',
                LogoBg: 'skin6', // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6 
                NavbarBg: 'skin1', // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6
                SidebarType: 'mini-sidebar', // You can change it full / mini-sidebar / iconbar / overlay
                SidebarColor: 'skin6', // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6
                SidebarPosition: true, // it can be true / false ( true means Fixed and false means absolute )
                HeaderPosition: true, // it can be true / false ( true means Fixed and false means absolute )
                BoxedLayout: false, // it can be true / false ( true means Boxed and false means Fluid ) 
            });
        });
    </script>

</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <?php $agencyrow = $core->cdp_getBranchoffices(); ?>


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

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Action part -->


            <div class="container-fluid">

                <div class="row">
                    <!-- Column -->

                    <div class="col-lg-12 col-xl-12 col-md-12">

                        <div class="card card-outline">
                            <h3 class="card-title  ml-4 mt-3"> Customers balance report detail
                                <br>
                                [<?php echo $fecha_inicio . ' - ' . $fecha_fin; ?>]

                            </h3>

                            <h4 class="card-title  ml-4 mt-3">

                                Customer: <?php echo $sender_data->fname . ' ' . $sender_data->lname; ?>
                            </h4>

                            <div class="card-body">

                                <table id="zero_config" class="table table-condensed table-hover table-striped">
                                    <thead>
                                        <tr>

                                            <th><b><?php echo $lang['ltracking'] ?></b></th>
                                            <th class="text-center"><b><?php echo $lang['ddate'] ?></b></th>
                                            <th class="text-center"><b>Due date</b></th>
                                            <th class="text-center"><b><?php echo $lang['lstatusinvoice'] ?></b></th>
                                            <th class="text-center"><b>Total amount</b></th>
                                            <th class="text-center"><b>Total paid</b></th>
                                            <th class="text-center"><b>balance</b></th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($numrows > 0) {

                                            $count = 0;
                                            $sumador_pendiente = 0;
                                            $sumador_total = 0;
                                            $sumador_pagado = 0;
                                            foreach ($data as $row) {

                                                $db->cdp_query("SELECT * FROM cdb_users where id= '" . $row->sender_id . "'");
                                                $sender_data = $db->cdb_registro();



                                                $db->cdp_query('SELECT  IFNULL(sum(total), 0)  as total  FROM cdb_charges_order WHERE order_id=:order_id');

                                                $db->bind(':order_id', $row->order_id);

                                                $db->cdp_execute();

                                                $sum_payment = $db->cdp_registro();
                                                // var_dump($sum_payment->total);

                                                $pendiente = $row->total_order - $sum_payment->total;

                                                if ($row->status_invoice == 1) {
                                                    $text_status = $lang['invoice_paid'];
                                                    $label_class = "label-success";
                                                } else if ($row->status_invoice == 2) {
                                                    $text_status = $lang['invoice_pending'];
                                                    $label_class = "label-warning";
                                                } else if ($row->status_invoice == 3) {
                                                    $text_status = $lang['invoice_due'];
                                                    $label_class = "label-danger";
                                                }



                                                $sumador_pendiente += $pendiente;
                                                $sumador_total += $row->total_order;
                                                $sumador_pagado += $sum_payment->total;




                                        ?>
                                                <tr class="card-hover">

                                                    <td><b><a data-toggle="modal" data-target="#charges_list" data-id="<?php echo $row->order_id; ?>"><?php echo $row->order_prefix . $row->order_no; ?></a></b></td>

                                                    <td class="text-center">
                                                        <?php echo $row->order_date; ?>
                                                    </td>


                                                    <td class="text-center">
                                                        <?php echo $row->due_date; ?>
                                                    </td>

                                                    <td class="text-center">
                                                        <span class="label label-large <?php echo $label_class; ?>"><?php echo $text_status; ?></span>

                                                    </td>

                                                    <td class="text-center">
                                                        <b><?php echo $core->currency; ?></b> <?php echo cdb_money_format($row->total_order); ?>
                                                    </td>

                                                    <td class="text-center">
                                                        <b><?php echo $core->currency; ?></b> <?php echo cdb_money_format($sum_payment->total); ?>
                                                    </td>

                                                    <td class="text-center">
                                                        <b><?php echo $core->currency; ?></b> <?php echo cdb_money_format($pendiente); ?>
                                                    </td>


                                    </tbody>

                                <?php $count++;
                                            } ?>

                            <?php } ?>
                            <tfoot>
                                <tr class="card-hover">
                                    <td class="text-left"><b>TOTAL</b></td>

                                    <td colspan="3"></td>
                                    <td class="text-center  ">
                                        <b><?php echo cdb_money_format($sumador_total); ?> </b>
                                    </td>

                                    <td class="text-center  ">
                                        <b><?php echo cdb_money_format($sumador_pagado); ?> </b>
                                    </td>

                                    <td class="text-center  ">
                                        <b><?php echo cdb_money_format($sumador_pendiente); ?> </b>
                                    </td>

                                </tr>

                            </tfoot>
                                </table>

                                <div class="pull-right">

                                    <a class="btn btn-primary" href="report_customers_balance_list.php">back to report</a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
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
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <script src="assets/js/app.min.js"></script>
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