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

if (isset($_GET['recipient'])) {
    $data = cdp_getRecipientEdit($_GET['recipient']);
}

if (!isset($_GET['recipient']) or $data['rowCount'] != 1) {
    cdp_redirect_to("recipients_list.php");
}

$row_recipient = $data['data'];

$db->cdp_query("SELECT * FROM cdb_recipients_addresses WHERE recipient_id='" . $_GET['recipient'] . "'");
$recipient_addreses = $db->cdp_registros();



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
    <title><?php echo $lang['edit_recipient'] ?> | <?php echo $core->site_name ?></title>
    <!-- This Page CSS -->
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/input-css/intlTelInput.css">
    <link href="assets/css/style.min.css" rel="stylesheet">
    <link href="assets/css/front.css" rel="stylesheet" type="text/css">
    <link href="assets/customClassPagination.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/select2/dist/css/select2.min.css">

    <script type="text/javascript" src="assets/js/jquery.js"></script>
    <script type="text/javascript" src="assets/js/jquery-ui.js"></script>
    <script src="assets/js/jquery.ui.touch-punch.js"></script>
    <script src="assets/js/jquery.wysiwyg.js"></script>
    <script src="assets/js/global.js"></script>
    <script src="assets/js/custom.js"></script>
    <style>
        .select2-selection__rendered {
            line-height: 31px !important;
        }

        .select2-container .select2-selection--single {
            height: 35px !important;
        }

        .select2-selection__arrow {
            height: 34px !important;
        }
    </style>
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

            <div class="page-breadcrumb ">
                <div class="row">
                    <div class="col-8 align-self-center offset-1">
                        <h4 class="page-title"><?php
                                                // echo $lang['shiplist'] 
                                                ?>
                            <?php echo $lang['edit_recipient']; ?></h4>

                    </div>
                </div>
            </div>


            <div class="container-fluid">

                <div class="row justify-content-center">
                    <!-- Column -->
                    <div class="col-lg-10 col-xlg-12 col-md-12">
                        <div class="card">

                            <div class="card-body">
                                <!-- <div id="loader" style="display:none"></div> -->
                                <div id="resultados_ajax"></div>
                                <form class="form-horizontal form-material" id="save_user" name="save_user" method="post">
                                    <section>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="emailAddress1"><?php echo $lang['user_manage6'] ?></label>
                                                    <input type="text" class="form-control" name="fname" id="fname" placeholder="<?php echo $lang['user_manage6'] ?>" value="<?php echo $row_recipient->fname; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phoneNumber1"><?php echo $lang['user_manage7'] ?></label>
                                                    <input type="text" class="form-control" name="lname" id="lname" placeholder="<?php echo $lang['user_manage7'] ?>" value="<?php echo $row_recipient->lname; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="emailAddress1"><?php echo $lang['user_manage5'] ?></label>
                                                    <input type="text" class="form-control" id="email" name="email" placeholder="<?php echo $lang['user_manage5'] ?>" value="<?php echo $row_recipient->email; ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phoneNumber1"><?php echo $lang['user_manage9'] ?></label>
                                                    <br>
                                                    <input type="tel" class="form-control" name="phone_custom" id="phone_custom" value="<?php echo $row_recipient->phone; ?>">

                                                    <span id="valid-msg" class="hide"></span>
                                                    <div id="error-msg" class="hide text-danger"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <hr>
                                        <h4>Addresses</h4>
                                        <br>

                                        <?php

                                        $count = 0;

                                        foreach ($recipient_addreses as $rowAddress) {
                                            $count++;

                                            $db->cdp_query("SELECT * FROM cdb_countries where id= '" . $rowAddress->country . "'");
                                            $country = $db->cdp_registro();

                                            $db->cdp_query("SELECT * FROM cdb_states where id= '" . $rowAddress->state . "'");
                                            $state = $db->cdp_registro();

                                            $db->cdp_query("SELECT * FROM cdb_cities where id= '" . $rowAddress->city . "'");
                                            $city = $db->cdp_registro();

                                        ?>
                                            <div id="div_parent_<?php echo $count; ?>">

                                                <?php if ($count > 1) {
                                                    echo '<hr>';
                                                } ?>

                                                <h4><?php echo $lang['laddress'];
                                                    echo ' ' . $count; ?> </h4>

                                                <div class="row">
                                                    <div class="col-md-4 mb-3">
                                                        <div class="form-group">
                                                            <label class="control-label col-form-label">Country</label>
                                                            <select class="select2 form-control custom-select" name="country[]" id="country<?php echo $count; ?>">
                                                                <option value="<?php echo $country->id; ?>"><?php echo $country->name; ?></option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <div class="form-group">
                                                            <label class="control-label col-form-label">State</label>
                                                            <select class="select2 form-control custom-select" id="state<?php echo $count; ?>" name="state[]">
                                                                <option value="<?php echo $state->id; ?>"><?php echo $state->name; ?></option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <div class="form-group">
                                                            <label class="control-label col-form-label">City</label>
                                                            <select class="select2 form-control custom-select" id="city<?php echo $count; ?>" name="city[]">
                                                                <option value="<?php echo $city->id; ?>"><?php echo $city->name; ?></option>

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="phoneNumber1"><?php echo $lang['user_manage14'] ?></label>
                                                            <input type="text" class="form-control form-control-sm" value="<?php echo $rowAddress->zip_code; ?>" name="postal[]" id="postal<?php echo $count; ?>" placeholder="<?php echo $lang['user_manage14'] ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="phoneNumber1"><?php echo $lang['user_manage10'] ?></label>
                                                            <input type="text" class="form-control form-control-sm" value="<?php echo $rowAddress->address; ?>" name="address[]" id="address<?php echo $count; ?>" placeholder="<?php echo $lang['user_manage10'] ?>">
                                                        </div>
                                                    </div>

                                                    <input type="hidden" name="address_id[]" id="address_id<?php echo $count; ?>" value="<?php echo $rowAddress->id_addresses; ?>" />


                                                    <?php

                                                    if ($count > 1) { ?>
                                                        <div class="col-md-4">
                                                            <label> &nbsp;</label>
                                                            <div class="form-group">
                                                                <button type="button" name="remove_row" id="<?php echo $count; ?>" class="btn btn-danger remove_row">
                                                                    <span class="fa fa-trash"></span> <?php echo $lang['delete_address_recepient'] ?>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>

                                            </div>
                                        <?php
                                        }

                                        ?>

                                        <input type="hidden" name="total_address" id="total_address" value="<?php echo $count; ?>" />
                                        <input type="hidden" name="phone" id="phone" value="<?php echo $row_recipient->phone; ?>" />

                                        <input type="hidden" name="recipient_id" id="recipient_id" value="<?php echo $row_recipient->id; ?>" />

                                        <div id="div_address_multiple"></div>

                                        <div align="left">
                                            <button type="button" name="add_row" id="add_row" class="btn btn-success mb-2"><span class="fa fa-plus"></span> <?php echo $lang['add_address_recepient'] ?></button>
                                        </div>
                                    </section>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-outline-primary btn-confirmation" id="save_data" name="save_data" type="submit"><?php echo $lang['edit_recipient'] ?><span><i class="icon-ok"></i></span></button>
                                            <a href="recipients_list.php" class="btn btn-outline-secondary btn-confirmation"><span><i class="ti-share-alt"></i></span> <?php echo $lang['user_manage30'] ?></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>

                <input type="hidden" name="count_address" id="count_address" value="<?php echo $count; ?>" />
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
    <script src="assets/select2/dist/js/select2.min.js"></script>

    <script src="assets/js/input-js/intlTelInput.js"></script>
    <script src="dataJs/recipients_edit.js"></script>


</body>

</html>