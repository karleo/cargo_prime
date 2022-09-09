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


if (!$user->cdp_is_Admin())
    cdp_redirect_to("login.php");

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
    <title><?php echo $lang['filter5'] ?> | <?php echo $core->site_name ?></title>
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


            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title"><?php echo $lang['filter5']; ?></h4>

                    </div>
                </div>
            </div>


            <div class="container-fluid">
                <div class="row justify-content-center">
                    <!-- Column -->
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card">

                            <div class="card-body">
                                <div id="resultados_ajax"></div>
                                <form class="form-horizontal form-material" id="save_user" name="save_user" method="post">
                                    <section>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="firstName1"><?php echo $lang['user_manage3'] ?></label>
                                                    <input type="text" class="form-control" id="username" name="username" placeholder="<?php echo $lang['user_manage3'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="lastName1"><?php echo $lang['user_manage32'] ?></label>
                                                    <input type="text" class="form-control" name="password" id="password" placeholder="<?php echo $lang['user_manage32'] ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group">
                                                    <label for="phoneNumber1"><?php echo $lang['leftorder164'] ?></label>
                                                    <select class="custom-select form-control" id="document_type" name="document_type">
                                                        <option value="DNI"><?php echo $lang['leftorder165'] ?></option>
                                                        <option value="RIC"><?php echo $lang['leftorder166'] ?></option>
                                                        <option value="CI"><?php echo $lang['leftorder167'] ?></option>
                                                        <option value="CIE"><?php echo $lang['leftorder168'] ?></option>
                                                        <option value="CIN"><?php echo $lang['leftorder169'] ?></option>
                                                        <option value="CIE"><?php echo $lang['leftorder170'] ?></option>
                                                        <option value="CC"><?php echo $lang['leftorder171'] ?></option>
                                                        <option value="TI"><?php echo $lang['leftorder172'] ?></option>
                                                        <option value="CE"><?php echo $lang['leftorder173'] ?></option>
                                                        <option value="PSP"><?php echo $lang['leftorder174'] ?></option>
                                                        <option value="NIT"><?php echo $lang['leftorder1745'] ?></option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-md-6 mb-3">
                                                <div class="form-group">
                                                    <label for="phoneNumber1"><?php echo $lang['leftorder175'] ?></label>
                                                    <input type="text" class="form-control" id="document_number" name="document_number" placeholder="Document number">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="emailAddress1"><?php echo $lang['user_manage6'] ?></label>
                                                    <input type="text" class="form-control" name="fname" id="fname" placeholder="<?php echo $lang['user_manage6'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phoneNumber1"><?php echo $lang['user_manage7'] ?></label>
                                                    <input type="text" class="form-control" name="lname" id="lname" placeholder="<?php echo $lang['user_manage7'] ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="emailAddress1"><?php echo $lang['user_manage5'] ?></label>
                                                    <input type="text" class="form-control" id="email" name="email" placeholder="<?php echo $lang['user_manage5'] ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phoneNumber1"><?php echo $lang['user_manage9'] ?></label>
                                                    <input type="tel" class="form-control" name="phone_custom" id="phone_custom" placeholder="<?php echo $lang['user_manage9'] ?>">

                                                    <span id="valid-msg" class="hide"></span>
                                                    <div id="error-msg" class="hide text-danger"></div>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group">
                                                    <label for="phoneNumber1"><?php echo $lang['user_manage11'] ?></label>
                                                    <select class="custom-select form-control" name="gender" id="gender" placeholder="<?php echo $lang['user_manage11'] ?>">
                                                        <option value=""><?php echo $lang['leftorder177'] ?></option>
                                                        <option value="Male"><?php echo $lang['leftorder178'] ?></option>
                                                        <option value="Female"><?php echo $lang['leftorder179'] ?></option>
                                                        <option value="Other"><?php echo $lang['leftorder180'] ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <h4>Addresses</h4>
                                        <br>

                                        <h4><?php echo $lang['laddress'] ?> 1 </h4>

                                        <div class="row">

                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label class="control-label col-form-label">Country</label>
                                                    <select class="select2 form-control custom-select" name="country[]" id="country1">
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label class="control-label col-form-label">State</label>
                                                    <select class="select2 form-control custom-select" id="state1" name="state[]">
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label class="control-label col-form-label">City</label>
                                                    <select class="select2 form-control custom-select" id="city1" name="city[]">
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="phoneNumber1"><?php echo $lang['user_manage14'] ?></label>
                                                    <input type="text" class="form-control form-control-sm" name="postal[]" id="postal1" placeholder="<?php echo $lang['user_manage14'] ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="phoneNumber1"><?php echo $lang['user_manage10'] ?></label>
                                                    <input type="text" class="form-control form-control-sm" name="address[]" id="address1" placeholder="<?php echo $lang['user_manage10'] ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="total_address" id="total_address" value="1" />
                                        <input type="hidden" name="phone" id="phone" />

                                        <div id="div_address_multiple"></div>

                                        <div align="left">
                                            <button type="button" name="add_row" id="add_row" class="btn btn-success mb-2"><span class="fa fa-plus"></span> <?php echo $lang['add_address_recepient'] ?></button>
                                        </div>

                                        <hr>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phoneNumber1"><?php echo $lang['user_manage20'] ?></label>
                                                    <div class="btn-group">
                                                        <label class="btn">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" id="customRadio4" class="custom-control-input" name="active" value="1" checked="checked">
                                                                <label class="custom-control-label" for="customRadio4"> <?php echo $lang['user_manage16'] ?></label>
                                                            </div>
                                                        </label>
                                                        <label class="btn">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" id="customRadio3" class="custom-control-input" name="active" value="0">
                                                                <label class="custom-control-label" for="customRadio3"> <?php echo $lang['user_manage17'] ?></label>
                                                            </div>
                                                        </label>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phoneNumber1"><?php echo $lang['user_manage23'] ?></label>
                                                    <div class="btn-group" data-toggle="buttons">
                                                        <label class="btn">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" id="customRadio4" name="newsletter" value="1" checked="checked" class="custom-control-input">
                                                                <label class="custom-control-label" for="customRadio4"> <?php echo $lang['user_manage21'] ?></label>
                                                            </div>
                                                        </label>
                                                        <label class="btn">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" id="customRadio5" name="newsletter" value="0" class="custom-control-input">
                                                                <label class="custom-control-label" for="customRadio5"> <?php echo $lang['user_manage22'] ?></label>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="lastName1"><?php echo $lang['user_manage24'] ?></label>
                                                    <input class="form-control" id="avatar" name="avatar" type="file" />
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" name="notify" id="notify" value="1">
                                                        <i></i><?php echo $lang['edit-clien34'] ?>
                                                        <span class="custom-control-indicator"></span><br><br>
                                                        <label><span><i class="ti-email" style="color:#6610f2"></i>&nbsp; <?php echo $lang['edit-clien35'] ?></span></label>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="emailAddress1"><?php echo $lang['user_manage36'] ?></label>
                                                    <textarea class="form-control" id="notes" name="notes" rows="6" name="notes" placeholder="<?php echo $lang['user_manage36'] ?>"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </section>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-outline-primary btn-confirmation" id="save_data" name="save_data" type="submit"><?php echo $lang['user_manage37'] ?><span><i class="icon-ok"></i></span></button>
                                            <a href="customers_list.php" class="btn btn-outline-secondary btn-confirmation"><span><i class="ti-share-alt"></i></span> <?php echo $lang['user_manage30'] ?></a>
                                        </div>
                                    </div>
                                    <input name="locker" id="locker" type="hidden" value="<?php echo cdp_generarCodigo(6); ?>" />
                                </form>
                            </div>
                        </div>
                    </div>
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
    <script src="assets/js/input-js/intlTelInput.js"></script>
    <script src="assets/select2/dist/js/select2.min.js"></script>
    <script src="dataJs/customers_add.js"></script>


</body>

</html>