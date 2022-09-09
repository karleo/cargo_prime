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
    <title><?php echo $lang['filter80'] ?> | <?php echo $core->site_name ?></title>
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
    <link rel="stylesheet" href="assets/css/input-css/intlTelInput.css">




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
                            <?php echo $lang['filter80']; ?></h4>

                    </div>
                </div>
            </div>


            <div class="container-fluid">

                <div class="row justify-content-center">
                    <!-- Column -->
                    <div class="col-lg-10 col-xlg-12 col-md-12">
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
                                                    <input type="text" class="form-control" name="phone_custom" id="phone_custom" placeholder="<?php echo $lang['user_manage9'] ?>">

                                                    <span id="valid-msg" class="hide"></span>
                                                    <div id="error-msg" class="hide text-danger"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="emailAddress1"><?php echo $lang['edit-clien59'] ?></label>
                                                    <input type="text" class="form-control" id="enrollment" name="enrollment" required placeholder="<?php echo $lang['edit-clien59'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phoneNumber1"><?php echo $lang['edit-clien60'] ?></label>
                                                    <input type="text" class="form-control" id="vehiclecode" name="vehiclecode" placeholder="<?php echo $lang['edit-clien60'] ?>" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phoneNumber1"><?php echo $lang['user_manage11'] ?></label>
                                                    <select class="custom-select form-control" name="gender" id="gender" placeholder="<?php echo $lang['user_manage11'] ?>">
                                                        <option value="">Choose option</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>


                                        <input type="hidden" name="phone" id="phone" />

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
                                            <a href="drivers_list.php" class="btn btn-outline-secondary btn-confirmation"><span><i class="ti-share-alt"></i></span> <?php echo $lang['user_manage30'] ?></a>
                                        </div>
                                    </div>
                                    <input name="locker" id="locker" type="hidden" value="<?php echo cdp_generarCodigo(6); ?>" />
                                </form>
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
    <script src="dataJs/drivers_add.js"></script>

</body>

</html>