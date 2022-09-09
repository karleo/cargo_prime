

<!DOCTYPE html>
    <html lang="en">

<head>
        <meta charset="utf-8" />
        <title><?php echo $lang['langs_010106'] ?> | <?php echo $core->site_name;?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="Courier DEPRIXA-Integral Web System">
        <meta name="author" content="Jaomweb">
        <meta name="description" content="">
        <!-- favicon -->
        <link rel="icon" type="image/png" sizes="16x16" href="assets/<?php echo $core->favicon ?>">
        <!-- Bootstrap -->
        <link href="assets/css_main_deprixa/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Icons -->
        <link href="assets/css_main_deprixa/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
        <!-- Main Css -->
        <link href="assets/css_main_deprixa/css/style.css" rel="stylesheet" type="text/css" id="theme-opt" />
        <link href="assets/css_main_deprixa/css/colors/default.css" rel="stylesheet" id="color-opt">

        <script type="text/javascript" src="assets/js/jquery.js"></script>
        <script type="text/javascript" src="assets/js/jquery-ui.js"></script>
        <script src="assets/js/jquery.ui.touch-punch.js"></script>
        <script src="assets/js/jquery.wysiwyg.js"></script>
        <script src="assets/js/global.js"></script>
        <script src="assets/js/custom.js"></script>
        <script src="assets/js/checkbox.js"></script>

    </head>

<body>

        <!-- Loader -->
        <div id="preloader">
            <div id="status">
                <div class="spinner">
                    <div class="double-bounce1"></div>
                    <div class="double-bounce2"></div>
                </div>
            </div>
        </div>
        <!-- Loader -->
        
        <div class="back-to-home">
            <a href="" class="back-button btn btn-icon btn-primary"><i data-feather="arrow-left" class="icons"></i></a>
        </div>

        <!-- Hero Start -->
        <section class="cover-user bg-home bg-white">
            <div class="container-fluid px-0">
                <div class="row g-0 position-relative">
                    <div class="col-lg-5 cover-my-30 order-2">
                        <div class="cover-user-img d-flex align-items-center">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card border-0" style="z-index: 1">
                                        <div class="card-title text-center">
                                           <a class="logo" href="index.php">
                                               
                                               <?php echo ($core->logo) ? '<img src="assets/' . $core->logo . '" alt="' . $core->site_name . '" width="' . $core->thumb_w . '" height="' . $core->thumb_h . '"/>' : $core->site_name; ?>
                                           </a>
                                        </div>
                                        <div><br></div>
                                        <div class="card-body p-0">
                                            <h4 class="card-title text-center"><?php echo $lang['left172'] ?></h4> 
                                            <div id="resultados_ajax"></div>
                                            <div id="loader" style="display:none"></div> 
                                            <form class="login-form mt-4" name="forgotPassword" id="forgotPassword" method="post">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <p class="text-muted">Please enter your email address. You will receive a link to create a new password via email.</p>
                                                        <div class="mb-3">
                                                            <label class="form-label"><?php echo $lang['lemailad'] ?> <span class="text-danger">*</span></label>
                                                            <div class="form-icon position-relative">
                                                                <i data-feather="mail" class="fea icon-sm icons"></i>
                                                                <input type="email" class="form-control ps-5" placeholder="<?php echo $lang['left176'] ?>" id="email" name="email" required="">
                                                            </div>
                                                        </div>
                                                    </div><!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="d-grid">
                                                            <button type="submit" name="dosubmit"  class="btn btn-primary "><?php echo $lang['langs_010108'] ?></button>
                                                        </div>
                                                    </div><!--end col-->
                                                    <div class="mx-auto">
                                                        <p class="mb-0 mt-3"><small class="text-dark me-2"><?php echo $lang['langs_010109'] ?> </br><?php if($core->reg_allowed):?></small> 
                                                            <a href="sign-up.php" class="text-dark fw-bold"><?php echo $lang['langs_010110'] ?></a><?php endif;?> | <a href="index.php" class="text-dark fw-bold"><?php echo $lang['langs_010111'] ?></a>

                                                        </p>
                                                    </div><!--end col-->
                                                </div><!--end row-->
                                            </form>
                                        </div>
                                    </div>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div> <!-- end about detail -->
                    </div> <!-- end col -->    

                    <div class="col-lg-7 offset-lg-5 padding-less img order-1" style="background-image:url('assets/css_main_deprixa/images/user/03.jpg')" data-jarallax='{"speed": 0.5}'></div><!-- end col -->    
                </div><!--end row-->
            </div><!--end container fluid-->
        </section><!--end section-->
        <!-- Hero End -->




        <!-- javascript -->
        <script src="assets/css_main_deprixa/main_deprixa/js/jquery.min.js"></script>
        <script src="assets/css_main_deprixa/js/bootstrap.bundle.min.js"></script>
        <!-- Icons -->
        <script src="assets/css_main_deprixa/js/feather.min.js"></script>
        <!-- Main Js -->
        <script src="assets/css_main_deprixa/js/plugins.init.js"></script><!--Note: All init js like tiny slider, counter, countdown, maintenance, lightbox, gallery, swiper slider, aos animation etc.-->
        <script src="assets/css_main_deprixa/js/app.js"></script><!--Note: All important javascript like page loader, menu, sticky menu, menu-toggler, one page menu etc. -->

        <script src="dataJs/forgot_password.js"></script> 


    </body>

</html>