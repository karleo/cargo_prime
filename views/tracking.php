<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Track Shipment | <?php echo $core->site_name; ?></title>
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
    <!-- Slider -->               
    <link rel="stylesheet" href="assets/css_main_deprixa/css/tiny-slider.css"/>
    <!-- Date picker -->
    <link rel="stylesheet" href="assets/css_main_deprixa/css/datepicker.min.css">
    <!-- Main Css -->
    <link href="assets/css_main_deprixa/css/style.css" rel="stylesheet" type="text/css" id="theme-opt" />
    <link href="assets/css_main_deprixa/css/colors/default.css" rel="stylesheet" id="color-opt">

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

        <!-- Navbar STart -->
        <header id="topnav" class="defaultscroll sticky">
            <div class="container">
                <!-- Logo container-->
              
            <a class="logo" href="index.php">
                <?php echo ($core->logo) ? '<img src="assets/' . $core->logo . '" alt="' . $core->site_name . '" width="' . $core->thumb_w . '" height="' . $core->thumb_h . '"/>' : $core->site_name; ?>
                    
                    
                </a>
                

                <!-- End Logo container-->
                <div class="menu-extras">
                    <div class="menu-item">
                        <!-- Mobile menu toggle-->
                        <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </div>
                </div>

                <!--Login button Start-->
                <ul class="buy-button list-inline mb-0">
                    <li class="list-inline-item mb-0">
                        <a href="index.php" >
                            <div class="login-btn-primary"><span class="btn btn-icon btn-pills btn-soft-primary"><i data-feather="home" class="fea icon-sm"></i></span></div>
                            <div class="login-btn-light"><span class="btn btn-icon btn-pills btn-light"><i data-feather="home" class="fea icon-sm"></i></span></div>
                        </a>
                    </li>
                    
                </ul>
                <!--Login button End-->
        
            </div><!--end container-->
        </header><!--end header-->
        <!-- Navbar End -->

        <!-- Hero Start -->
        <section class="bg-half-170 d-table w-100" style="background: url('assets/css_main_deprixa/images/user/bg.jpg') center center;">
            <div class="bg-overlay"></div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 col-md-6">
                        <div class="title-heading mt-4">
                            <h1 class="display-4 fw-bold text-white title-dark mb-3"><?php echo $lang['left127'] ?> </span> <br> <?php echo $lang['left128'] ?></h1>
                            
                        </div>
                    </div><!--end col-->

                    <div class="col-lg-5 col-md-6 mt-4 pt-2 mt-sm-0 pt-sm-0">
                        <div class="card shadow rounded border-0 ms-lg-5">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $lang['left129'] ?> <?php echo $core->site_name ?></h5>

                                <form class="login-form" method="POST" name="ib_form" id="ib_form">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group position-relative">

                                                <label><?php echo $lang['left129'] ?> <?php echo $core->site_name ?><span class="text-primary">.</span></label>
                                                <br>

                                                <div class="col-md-12">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="trackingType" id="trackingType" value="1" checked>
                                                        <label class="form-check-label" for="trackingType">Shipments</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="trackingType" id="trackingType" value="2">
                                                        <label class="form-check-label" for="trackingType">Online shopping</label>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                
                                                <div class="form-icon position-relative">
                                                    <i class="mdi mdi-cube-send ml-3 icons"></i>
                                                <textarea name="order_track" placeholder="<?php echo $lang['left130'] ?>" id="order_track" rows="4" class="form-control ps-5" required></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="col-md-12">
                                            <div class="d-grid">
                                                <button type="submit" name="submit" class="btn btn-primary rounded w-100"><i class="mdi mdi-cube-outline ml-3 icons"></i> <?php echo $lang['left131'] ?></button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div> <!--end container-->
        </section><!--end section-->

        <!-- Hero End -->
        



    <!-- javascript -->
    <script src="assets/css_main_deprixa/main_deprixa/js/jquery.min.js"></script>
    <script src="assets/css_main_deprixa/js/bootstrap.bundle.min.js"></script>
    <!-- SLIDER -->
    <script src="assets/css_main_deprixa/js/tiny-slider.js "></script>
    <!-- Datepicker -->
    <script src="assets/css_main_deprixa/js/datepicker.min.js"></script>
    <!-- Icons -->
    <script src="assets/css_main_deprixa/js/feather.min.js"></script>
    <!-- Main Js -->
    <script src="assets/css_main_deprixa/js/plugins.init.js"></script><!--Note: All init js like tiny slider, counter, countdown, maintenance, lightbox, gallery, swiper slider, aos animation etc.-->
    <script src="assets/css_main_deprixa/js/app.js"></script><!--Note: All important javascript like page loader, menu, sticky menu, menu-toggler, one page menu etc. -->

    <script src="dataJs/tracking.js"></script>

</body>

</html>