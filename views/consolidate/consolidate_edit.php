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

$userData = $user->cdp_getUserData();
if ($userData->userlevel == 1)
    cdp_redirect_to("login.php");


if (isset($_GET['id'])) {
    $data = cdp_getConsolidatePrint($_GET['id']);
}

if (!isset($_GET['id']) or $data['rowCount'] != 1) {
    cdp_redirect_to("consolidate_list.php");
}

$row_order = $data['data'];


$db->cdp_query("SELECT * FROM cdb_consolidate_detail WHERE consolidate_id='" . $_GET['id'] . "'");
$order_items = $db->cdp_registros();

$db->cdp_query("SELECT * FROM cdb_users where id= '" . $row_order->sender_id . "'");
$sender_data = $db->cdp_registro();

$db->cdp_query("SELECT * FROM cdb_recipients where id= '" . $row_order->receiver_id . "'");
$receiver_data = $db->cdp_registro();


$db->cdp_query("SELECT * FROM cdb_address_shipments where order_track='" . $row_order->c_prefix . $row_order->c_no . "'");
$address_order = $db->cdp_registro();



if (isset($_POST["total_item"])) {

    $db = new Conexion;

    $db->cdp_query("
                UPDATE  cdb_consolidate SET                
                    
                    sender_id =:sender_id,
                    receiver_id =:receiver_id,     
                     sender_address_id= :sender_address_id,
                    receiver_address_id = :receiver_address_id,
                    value_weight=:value_weight,              
                    sub_total =:sub_total,
                    total_tax_insurance =:total_tax_insurance,
                    total_insured_value =:total_insured_value,
                    total_tax_custom_tariffis =:total_tax_custom_tariffis,                    
                    total_tax_discount=:total_tax_discount,
                    total_tax =:total_tax,
                    total_order =:total_order,                    
                    order_datetime =:order_datetime,
                    agency =:agency,
                    origin_off =:origin_off,
                    order_package =:order_package,
                    order_item_category =:order_item_category,
                    order_courier =:order_courier,
                    order_service_options =:order_service_options,
                    order_deli_time =:order_deli_time,                   
                    order_pay_mode =:order_pay_mode,
                    status_courier =:status_courier,
                    driver_id=:driver_id,
                    seals_package=:seals_package,
                    total_weight=:total_weight            

                    WHERE consolidate_id=:consolidate_id
                
            ");

    $db->bind(':consolidate_id',  $_GET['id']);
    $db->bind(':order_datetime',  trim($_POST["order_date"]));
    $db->bind(':sender_id',  cdp_sanitize($_POST["sender_id"]));
    $db->bind(':receiver_id',  cdp_sanitize($_POST["recipient_id"]));
    $db->bind(':sender_address_id',  cdp_sanitize($_POST["sender_address_id"]));
    $db->bind(':receiver_address_id',  cdp_sanitize($_POST["recipient_address_id"]));
    $db->bind(':value_weight',  floatval($_POST["price_lb"]));
    $db->bind(':sub_total',  floatval($_POST["subtotal_input"]));
    $db->bind(':total_tax_insurance',  floatval($_POST["insurance_input"]));
    $db->bind(':total_insured_value', floatval($_POST["insured_input"]));
    $db->bind(':total_tax_discount',  floatval($_POST["discount_input"]));
    $db->bind(':total_tax_custom_tariffis',  floatval($_POST["total_impuesto_aduanero_input"]));
    $db->bind(':total_tax',  floatval($_POST["impuesto_input"]));
    $db->bind(':total_order',  floatval($_POST["total_envio_input"]));
    $db->bind(':total_weight',  floatval($_POST["total_weight_input"]));

    $db->bind(':agency',  cdp_sanitize($_POST["agency"]));
    $db->bind(':origin_off',  cdp_sanitize($_POST["origin_off"]));
    $db->bind(':order_package',  cdp_sanitize($_POST["order_package"]));
    $db->bind(':order_item_category',  cdp_sanitize($_POST["order_item_category"]));
    $db->bind(':order_courier',  cdp_sanitize($_POST["order_courier"]));
    $db->bind(':order_service_options',  cdp_sanitize($_POST["order_service_options"]));
    $db->bind(':order_deli_time',  cdp_sanitize($_POST["order_deli_time"]));
    $db->bind(':order_pay_mode',  cdp_sanitize($_POST["order_pay_mode"]));
    $db->bind(':status_courier',  cdp_sanitize($_POST["status_courier"]));
    $db->bind(':driver_id',  cdp_sanitize($_POST["driver_id"]));
    $db->bind(':seals_package',  cdp_sanitize($_POST["seals"]));

    $db->cdp_execute();

    $order_id = $row_order->consolidate_id;

    $db->cdp_query("DELETE FROM  cdb_consolidate_detail WHERE consolidate_id='" . $order_id . "'");
    $db->cdp_execute();

    for ($count = 0; $count < $_POST["total_item"]; $count++) {

        $db->cdp_query("
                  INSERT INTO cdb_consolidate_detail 
                  (
                  consolidate_id,
                  order_id,
                  order_prefix,
                  order_no,
                  weight,
                  weight_vol,  
                  length,
                  width,
                  height              
                                  
                  )
                  VALUES 
                  (
                  :consolidate_id,
                  :order_id,
                  :order_prefix,
                  :order_no, 
                  :weight,
                  :weight_vol,
                  :length,
                  :width,
                  :height                               
                  )
                ");


        $db->bind(':consolidate_id',  $order_id);
        $db->bind(':order_prefix',  cdp_sanitize($_POST["prefix"][$count]));
        $db->bind(':order_no',  cdp_sanitize($_POST["order_no_item"][$count]));
        $db->bind(':weight',  cdp_sanitize($_POST["weight"][$count]));
        $db->bind(':length',  cdp_sanitize($_POST["length"][$count]));
        $db->bind(':width',  cdp_sanitize($_POST["width"][$count]));
        $db->bind(':height',  cdp_sanitize($_POST["height"][$count]));
        $db->bind(':weight_vol',  cdp_sanitize($_POST["weight_vol"][$count]));
        $db->bind(':order_id',  cdp_sanitize($_POST["order_id"][$count]));

        $db->cdp_execute();

        $is_consolidate = 1;

        $db->cdp_query("
                UPDATE  cdb_add_order SET                
                    
                    is_consolidate=:is_consolidate

                    WHERE order_id=:order_id                 
                
                ");

        $db->bind(':order_id',  cdp_sanitize($_POST["order_id"][$count]));
        $db->bind(':is_consolidate',  $is_consolidate);

        $db->cdp_execute();
    }

    //INSERT HISTORY USER
    $date = date("Y-m-d H:i:s");
    $db->cdp_query("
                INSERT INTO cdb_order_user_history 
                (
                    user_id,
                    order_id,
                    action,
                    date_history,
                    is_consolidate                  
                    )
                VALUES
                    (
                    :user_id,
                    :order_id,
                    :action,
                    :date_history,
                    :is_consolidate
                    )
            ");



    $db->bind(':order_id',  $order_id);
    $db->bind(':is_consolidate', '1');
    $db->bind(':user_id',  $_SESSION['userid']);
    $db->bind(':action', 'update consolidated');
    $db->bind(':date_history',  trim($date));
    $db->cdp_execute();

    $db->cdp_query("SELECT * FROM cdb_senders_addresses where id_addresses= '" . $_POST["sender_address_id"] . "'");

    $sender_address_data = $db->cdp_registro();

    $sender_country = $sender_address_data->country;
    $sender_state = $sender_address_data->state;
    $sender_city = $sender_address_data->city;
    $sender_zip_code = $sender_address_data->zip_code;
    $sender_address = $sender_address_data->address;

    $_sender_country = cdp_getCountry($sender_country);
    $final_sender_country = $_sender_country['data'];

    $_sender_state = cdp_getState($sender_state);
    $final_sender_state = $_sender_state['data'];

    $sender_city = cdp_getCity($sender_city);
    $final_sender_city = $sender_city['data'];


    $db->cdp_query("SELECT * FROM cdb_recipients_addresses where id_addresses= '" . $_POST["recipient_address_id"] . "'");

    $recipient_address_data = $db->cdp_registro();

    $recipient_address = $recipient_address_data->address;
    $recipient_country = $recipient_address_data->country;
    $recipient_city = $recipient_address_data->city;
    $recipient_state = $recipient_address_data->state;
    $recipient_zip_code = $recipient_address_data->zip_code;

    $_recipient_country = cdp_getCountry($recipient_country);
    $final_recipient_country = $_recipient_country['data'];

    $_recipient_state = cdp_getState($recipient_state);
    $final_recipient_state = $_recipient_state['data'];

    $recipient_city = cdp_getCity($recipient_city);
    $final_recipient_city = $recipient_city['data'];



    cdp_deleteCourierAddress($order_id);

    // SAVE ADDRESS FOR Shipments

    $db->cdp_query("
    INSERT INTO cdb_address_shipments
    (
        order_id,
        order_track,
        sender_country,
        sender_state,
        sender_city,
        sender_zip_code,
        sender_address,
        recipient_country,
        recipient_state,
        recipient_city,
        recipient_zip_code,
        recipient_address
    )
    VALUES
        (
        :order_id,    
        :order_track,
        :sender_country,
        :sender_state,
        :sender_city,
        :sender_zip_code,
        :sender_address,
        :recipient_country,
        :recipient_state,
        :recipient_city,
        :recipient_zip_code,                
        :recipient_address
        )
");

    $db->bind(':order_id', $order_id);
    $db->bind(':order_track',   $row_order->c_prefix . $row_order->c_no);
    $db->bind(':sender_country',   $final_sender_country->name);
    $db->bind(':sender_state',   $final_sender_state->name);
    $db->bind(':sender_city',   $final_sender_city->name);
    $db->bind(':sender_zip_code',   $sender_zip_code);
    $db->bind(':sender_address',   $sender_address);
    $db->bind(':recipient_country',   $final_recipient_country->name);
    $db->bind(':recipient_state',   $final_recipient_state->name);
    $db->bind(':recipient_city',   $final_recipient_city->name);
    $db->bind(':recipient_zip_code',   $recipient_zip_code);
    $db->bind(':recipient_address',   $recipient_address);

    $db->cdp_execute();


    if (count($_FILES['filesMultiple']['name']) > 0 && $_FILES['filesMultiple']['tmp_name'][0] != '') {

        $target_dir = "order_files/";

        $deleted_file_ids = array();

        if (isset($_POST['deleted_file_ids']) && !empty($_POST['deleted_file_ids'])) {

            $deleted_file_ids = explode(",", $_POST['deleted_file_ids']);
        }


        foreach ($_FILES["filesMultiple"]['tmp_name'] as $key => $tmp_name) {

            if (!in_array($key, $deleted_file_ids)) {

                $image_name = time() . "_" . basename($_FILES["filesMultiple"]["name"][$key]);
                $target_file = $target_dir . $image_name;
                $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                $imageFileZise = $_FILES["filesMultiple"]["size"][$key];

                if ($imageFileZise > 0) {

                    move_uploaded_file($_FILES["filesMultiple"]["tmp_name"][$key], $target_file);
                    $imagen = basename($_FILES["filesMultiple"]["name"][$key]);
                    $file = "image_path='img/usuarios/$image_name' ";
                }

                cdp_insertOrdersFiles($order_id, $target_file, $image_name, date("Y-m-d H:i:s"), '1', $imageFileType);
            }
        }
    }


    header("location:consolidate_view.php?id=$row_order->consolidate_id");
?>

<?php

}

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
    <title><?php echo $lang['langs_01'] ?> | <?php echo $core->site_name ?></title>
    <!-- This Page CSS -->
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/input-css/intlTelInput.css">

    <link rel="stylesheet" type="text/css" href="assets/select2/dist/css/select2.min.css">
    <link href="assets/css/front.css" rel="stylesheet" type="text/css">

    <link href="assets/css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/jquery-ui.css" type="text/css" />
    <link href="assets/css/front.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="assets/js/jquery.js"></script>
    <script type="text/javascript" src="assets/js/jquery-ui.js"></script>
    <script src="assets/js/global.js"></script>

    <link rel="stylesheet" href="assets/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="assets/custom_dependencies/bootstrap.min.css" rel="stylesheet">

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

        <?php $office = $core->cdp_getOffices(); ?>
        <?php $agencyrow = $core->cdp_getBranchoffices(); ?>
        <?php $courierrow = $core->cdp_getCouriercom(); ?>
        <?php $statusrow = $core->cdp_getStatus(); ?>
        <?php $packrow = $core->cdp_getPack(); ?>
        <?php $payrow = $core->cdp_getPayment(); ?>
        <?php $itemrow = $core->cdp_getItem(); ?>
        <?php $moderow = $core->cdp_getShipmode(); ?>
        <?php $driverrow = $user->cdp_userAllDriver(); ?>
        <?php $delitimerow = $core->cdp_getDelitime(); ?>
        <?php $track = $core->cdp_order_track(); ?>
        <?php $categories = $core->cdp_getCategories(); ?>

        <!-- End Left Sidebar - style you can find in sidebar.scss  -->

        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 align-self-center">
                        <h4 class="page-title"><i class="ti-package" aria-hidden="true"></i> <?php echo $lang['langs_01']; ?></h4>
                    </div>
                </div>
            </div>

            <form method="post" id="invoice_form" name="invoice_form">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-row">

                                        <div class="form-group col-md-3">

                                            <label for="inputcom" class="control-label col-form-label"><?php echo $lang['langs_020'] ?></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><span style="color:#ff0000"><b>Consolidate #</b></span></div>
                                                </div>
                                                <input type="text" class="form-control" name="order_no" id="order_no" value="<?php echo $row_order->c_prefix . $row_order->c_no; ?>" readonly>
                                            </div>

                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="inputlname" class="control-label col-form-label"><?php echo $lang['left201'] ?> </label>
                                            <div class="input-group mb-3">
                                                <select class="custom-select col-12" id="agency" name="agency">
                                                    <option value="0">--<?php echo $lang['left202'] ?>--</option>
                                                    <?php foreach ($agencyrow as $row) : ?>
                                                        <option value="<?php echo $row->id; ?>" <?php if ($row_order->agency == $row->id) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?php echo $row->name_branch; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>




                                        <?php if ($user->access_level = 'Admin') { ?>

                                            <div class="form-group col-md-3">
                                                <label for="inputname" class="control-label col-form-label"><?php echo $lang['add-title14'] ?></label>
                                                <div class="input-group mb-3">
                                                    <select class="custom-select col-12" id="exampleFormControlSelect1" name="origin_off">
                                                        <option value="0">--<?php echo $lang['left343'] ?>--</option>

                                                        <?php foreach ($office as $row) : ?>
                                                            <option value="<?php echo $row->id; ?>" <?php if ($row_order->origin_off == $row->id) {
                                                                                                        echo 'selected';
                                                                                                    } ?>><?php echo $row->name_off; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>


                                        <?php } ?>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="field-2" class="control-label col-form-label"><?php echo $lang['langs_021'] ?></label>
                                                <input name="seals" id="seals" value="<?php echo $row_order->seals_package; ?>" class="form-control" placeholder="00-00000">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row -->


                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="mdi mdi-information-outline" style="color:#36bea6"></i><?php echo $lang['langs_010']; ?></h4>
                                    <hr>

                                    <div class="resultados_ajax_add_user_modal_sender"></div>

                                    <div class="row">

                                        <div class="col-md-12 ">

                                            <label class="control-label col-form-label"><?php echo $lang['sender_search_title'] ?></label>

                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div class="input-group">
                                                        <select class="select2 form-control custom-select" id="sender_id" name="sender_id">
                                                            <option value="<?php echo $sender_data->id; ?>"><?php echo $sender_data->fname . " " . $sender_data->lname; ?></option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="input-group-append input-sm">
                                                        <button type="button" class="btn btn-default" data-type_user="user_customer" data-toggle="modal" data-target="#myModalAddUser"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                        <div class="col-md-12 ">

                                            <label for="inputcontact" class="control-label col-form-label"><?php echo $lang['sender_search_address_title'] ?></label>

                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div class="input-group">
                                                        <select class="select2 form-control" id="sender_address_id" name="sender_address_id">
                                                            <option value="<?php echo $row_order->sender_address_id; ?>"><?php echo $address_order->sender_address; ?></option>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-md-2">
                                                    <div class="input-group-append input-sm">
                                                        <button id="add_address_sender" data-type_user="user_customer" data-toggle="modal" data-target="#myModalAddUserAddresses" type="button" class="btn btn-default"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="mdi mdi-information-outline" style="color:#36bea6"></i><?php echo $lang['left334']; ?></h4>
                                    <hr>
                                    <div class="resultados_ajax_add_user_modal_recipient"></div>



                                    <div class="row">

                                        <div class="col-md-12">
                                            <label for="inputcontact" class="control-label col-form-label"><?php echo $lang['recipient_search_title'] ?></label>

                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div class="input-group">
                                                        <select class="select2 form-control custom-select" id="recipient_id" name="recipient_id">
                                                            <option value="<?php echo $receiver_data->id; ?>"><?php echo $receiver_data->fname . " " . $receiver_data->lname; ?></option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="input-group-append input-sm">
                                                        <button id="add_recipient" type="button" data-type_user="user_recipient" data-toggle="modal" data-target="#myModalAddRecipient" class="btn btn-default"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-md-12">

                                            <label for="inputcontact" class="control-label col-form-label"><?php echo $lang['recipient_search_address_title'] ?></label>

                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div class="input-group">
                                                        <select class="select2 form-control" id="recipient_address_id" name="recipient_address_id">
                                                            <option value="<?php echo $row_order->receiver_address_id; ?>"><?php echo $address_order->recipient_address; ?></option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="input-group-append input-sm">
                                                        <button id="add_address_recipient" type="button" data-type_user="user_recipient" data-toggle="modal" data-target="#myModalAddRecipientAddresses" class="btn btn-default"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row -->



                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="mdi mdi-book-multiple" style="color:#36bea6"></i> <?php echo $lang['add-title13'] ?></h4>
                                    <br>
                                    <div class="row">

                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <label for="emailAddress1"><?php echo $lang['itemcategory'] ?></label>
                                                <div class="input-group">
                                                    <select class="custom-select col-12" id="order_item_category" name="order_item_category" required>
                                                        <option value="0">--Select logistics service--</option>
                                                        <?php foreach ($categories as $row) :

                                                        ?>
                                                            <option value="<?php echo $row->id; ?>" <?php if ($row_order->order_item_category == $row->id) {
                                                                                                        echo 'selected';
                                                                                                    }  ?>><?php echo $row->name_item; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="inputlname" class="control-label col-form-label"><?php echo $lang['add-title17'] ?></label>
                                            <div class="input-group mb-3">
                                                <select class="custom-select col-12" id="order_package" name="order_package">
                                                    <option value="0">--<?php echo $lang['left203'] ?>--</option>
                                                    <?php foreach ($packrow as $row) : ?>
                                                        <option value="<?php echo $row->id; ?>" <?php if ($row_order->order_package == $row->id) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?php echo $row->name_pack; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>




                                        <div class="form-group col-md-3">
                                            <label for="inputcontact" class="control-label col-form-label"><?php echo $lang['add-title18'] ?></label>
                                            <div class="input-group mb-3">
                                                <select class="custom-select col-12" id="order_courier" name="order_courier">
                                                    <option value="0">--<?php echo $lang['left204'] ?>--</option>
                                                    <?php foreach ($courierrow as $row) : ?>
                                                        <option value="<?php echo $row->id; ?>" <?php if ($row_order->order_courier == $row->id) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?php echo $row->name_com; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>




                                        <div class="form-group col-md-3">
                                            <label for="inputEmail3" class="control-label col-form-label"><?php echo $lang['add-title22'] ?></label>
                                            <div class="input-group mb-3">
                                                <select class="custom-select col-12" id="order_service_options" name="order_service_options">
                                                    <option value="0">--<?php echo $lang['left205'] ?>--</option>
                                                    <?php foreach ($moderow as $row) : ?>
                                                        <option value="<?php echo $row->id; ?>" <?php if ($row_order->order_service_options == $row->id) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?php echo $row->ship_mode; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="inputcontact" class="control-label col-form-label"><?php echo $lang['add-title15'] ?></i></label>
                                            <div class="input-group">
                                                <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i style="color:#ff0000" class="fa fa-calendar"></i></div>
                                                </div>
                                                <input type='text' class="form-control" name="order_date" id="order_date" placeholder="--<?php echo $lang['left206'] ?>--" data-toggle="tooltip" data-placement="bottom" title="<?php echo $lang['add-title16'] ?>" value="<?php echo date("Y/m/d", strtotime($row_order->order_datetime)); ?>" readonly />
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail3" class="control-label col-form-label"><?php echo $lang['add-title20'] ?></label>
                                            <div class="input-group mb-3">
                                                <select class="custom-select col-12" id="order_deli_time" name="order_deli_time">
                                                    <option value="0">--<?php echo $lang['left207'] ?>--</option>
                                                    <?php foreach ($delitimerow as $row) : ?>
                                                        <option value="<?php echo $row->id; ?>" <?php if ($row_order->order_deli_time == $row->id) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?php echo $row->delitime; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!--/span-->

                                        <div class="form-group col-md-3">
                                            <label for="inputEmail3" class="control-label col-form-label"><?php echo $lang['add-title23'] ?> <i style="color:#ff0000" class="fas fa-donate"></i></label>
                                            <div class="input-group mb-3">
                                                <select class="custom-select col-12" id="order_pay_mode" name="order_pay_mode">
                                                    <option value="0">--<?php echo $lang['left243'] ?>--</option>
                                                    <?php foreach ($payrow as $row) : ?>
                                                        <option value="<?php echo $row->id; ?>" <?php if ($row_order->order_pay_mode == $row->id) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?php echo $row->name_pay; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <!--/span-->

                                        <div class="form-group col-md-3">
                                            <label for="inputcontact" class="control-label col-form-label"><?php echo $lang['langs_039'] ?> <i style="color:#ff0000" class="fas fa-shipping-fast"></i></label>
                                            <div class="input-group mb-3">
                                                <select class="custom-select col-12" id="status_courier" name="status_courier">
                                                    <option value="0">--<?php echo $lang['left210'] ?>--</option>
                                                    <?php foreach ($statusrow as $row) : ?>

                                                        <option value="<?php echo $row->id; ?>" <?php if ($row_order->status_courier == $row->id) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?php echo $row->mod_style; ?></option>

                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->

                                    <div class="row">

                                        <div class="col-md-4">

                                            <div>
                                                <label class="control-label" id="selectItem"> Attach files</label>
                                            </div>

                                            <input class="custom-file-input" id="filesMultiple" name="filesMultiple[]" multiple="multiple" type="file" style="display: none;" onchange="cdp_validateZiseFiles(); cdp_preview_images();" />


                                            <button type="button" id="openMultiFile" class="btn btn-default  pull-left  mb-4"> <i class='fa fa-paperclip' id="openMultiFile" style="font-size:18px; cursor:pointer;"></i> Upload files </button>



                                        </div>



                                    </div>

                                    <div class="col-md-12 row" id="image_preview"></div>

                                    <div class="col-md-4 mt-4">
                                        <div id="clean_files" class="hide">
                                            <button type="button" id="clean_file_button" class="btn btn-danger ml-3"> <i class='fa fa-trash' style="font-size:18px; cursor:pointer;"></i> Cancel attachments </button>

                                        </div>
                                    </div>

                                    <div class="row">



                                        <div class="resultados_file col-md-4 pull-right mt-4">


                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>


                    <?php

                    $db->cdp_query("SELECT * FROM cdb_order_files where order_id='" . $_GET['id'] . "' and is_consolidate='1' ORDER BY date_file");
                    $files_order = $db->cdp_registros();
                    $numrows = $db->cdp_rowCount();


                    if ($numrows > 0) {
                    ?>
                        <div class="row">
                            <div class="col-lg-12">

                                <div id="resultados_ajax_delete_file"></div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><i class="fa fa-paperclip"></i> Attached files</h5>
                                        <hr>
                                        <div class="col-md-12 row">

                                            <?php
                                            $count = 0;
                                            $count_hr = 0;

                                            foreach ($files_order as $file) {

                                                $date_add = date("Y-m-d h:i A", strtotime($file->date_file));

                                                $src = 'assets/images/no-preview.jpeg';

                                                if (
                                                    $file->file_type == 'jpg' ||
                                                    $file->file_type == 'jpeg' ||
                                                    $file->file_type == 'png' ||
                                                    $file->file_type == 'ico'
                                                ) {

                                                    $src = $file->url;
                                                }

                                                $count++;
                                            ?>

                                                <div class="col-md-3" id="file_delete_item_<?php echo $file->id; ?>">

                                                    <img style="width: 180px; height: 180px;" class="img-thumbnail" src="<?php echo $src; ?>">

                                                    <div class="row ">
                                                        <div class=" col-md-12 mb-3 mt-2">
                                                            <p class="text-justify"><a style="color:#7460ee;" target="_blank" href="<?php echo $file->url; ?>" class=""><?php echo $file->name; ?> </a></p>

                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="mb-2">
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="cdp_deleteImgAttached('<?php echo $file->id; ?>');"><i class="fa fa-trash"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            } ?>
                                        </div>



                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    } ?>


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">


                                    <div id="resultados_ajax"></div>
                                    <script>
                                        var selected = [];
                                    </script>
                                    <div class="table-responsive">
                                        <table id="invoice-item-table" class="table">
                                            <div align="right">
                                                <button type="button" data-toggle="modal" data-target="#myModalConsolidate" class="btn btn-success mb-2"><span class="fa fa-search"></span> Search Shipments</button>
                                            </div>
                                            <thead class="bg-inverse text-white">
                                                <tr>

                                                    <th colspan="3"><b><?php echo $lang['ltracking'] ?></b></th>
                                                    <th colspan="2" class="text-center"><b>Weights</b></th>
                                                    <th class="text-center"></th>
                                                    <th class="text-right"><b>Weight Vol.</b></th>
                                                    <th></th>

                                                </tr>
                                            </thead>
                                            <tbody id="projects-tbl">
                                                <?php
                                                if ($order_items) {

                                                    $sumador_total = 0;
                                                    $sumador_libras = 0;
                                                    $sumador_volumetric = 0;

                                                    $precio_total = 0;
                                                    $total_impuesto = 0;
                                                    $total_seguro = 0;
                                                    $total_peso = 0;
                                                    $total_descuento = 0;
                                                    $total_impuesto_aduanero = 0;
                                                    $count_item = 0;

                                                    foreach ($order_items as $row_order_item) {

                                                        // echo '<script> selected.push("'echo $row_order_item->order_id;'"); </script>';

                                                        $weight_item = $row_order_item->weight;

                                                        $total_metric = $row_order_item->length * $row_order_item->width * $row_order_item->height / $row_order->volumetric_percentage;

                                                        // calculate weight x price
                                                        if ($weight_item > $total_metric) {

                                                            $calculate_weight = $weight_item;
                                                            $sumador_libras += $weight_item; //Sumador

                                                        } else {

                                                            $calculate_weight = $total_metric;
                                                            $sumador_volumetric += $total_metric; //Sumador
                                                        }

                                                        $precio_total = $calculate_weight * $row_order->value_weight;
                                                        $precio_total = $precio_total; //Precio total formateado

                                                        $sumador_total += $precio_total;

                                                        if ($sumador_total > $core->min_cost_tax) {

                                                            $total_impuesto = $sumador_total * $row_order->tax_value / 100;
                                                        }

                                                        $total_descuento = $sumador_total * $row_order->tax_discount / 100;
                                                        $total_peso = $sumador_libras + $sumador_volumetric;

                                                        $total_seguro = $row_order->tax_insurance_value * $row_order->total_insured_value / 100;

                                                        $total_impuesto_aduanero = $total_peso * $row_order->tax_custom_tariffis_value;

                                                        $total_envio = ($sumador_total - $total_descuento) + $total_impuesto + $total_seguro + $total_impuesto_aduanero;


                                                        $count_item++;
                                                ?>


                                                        <tr class="card-hover" id="row_id_<?php echo $row_order_item->order_id; ?>">

                                                            <td colspan="3"><b><?php echo $row_order_item->order_prefix . $row_order_item->order_no; ?> </b></td>

                                                            <td colspan="2" class="text-center"><?php echo $weight_item; ?></td>
                                                            <td class="text-center"></td>

                                                            <td class="text-right"><?php echo $row_order_item->weight_vol; ?></td>

                                                            <td class="text-center">
                                                                <button type="button" name="remove_row" id="<?php echo $row_order_item->order_id; ?>" class="btn btn-danger btn-xs remove_row mt-2"><i class="fa fa-trash"></i></button>
                                                            </td>


                                                            <script>
                                                                selected.push('<?php echo $row_order_item->order_id; ?>');
                                                            </script>

                                                            <input type="hidden" id="total_vol_<?php echo $row_order_item->order_id; ?>" value="<?php echo $row_order_item->weight_vol; ?>" name="weight_vol[]">

                                                            <input type="hidden" id="order_prefix_<?php echo $row_order_item->order_id; ?>" value="<?php echo $row_order_item->order_prefix; ?>" name="prefix[]">

                                                            <input type="hidden" id="order_no_<?php echo $row_order_item->order_id; ?>" value="<?php echo $row_order_item->order_no; ?>" name="order_no_item[]">

                                                            <input type="hidden" id="weight_<?php echo $row_order_item->order_id; ?>" value="<?php echo $weight_item; ?>" name="weight[]">

                                                            <input type="hidden" id="length_<?php echo $row_order_item->order_id; ?>" value="<?php echo $row_order_item->length; ?>" name="length[]">

                                                            <input type="hidden" id="height_<?php echo $row_order_item->order_id; ?>" value="<?php echo $row_order_item->height; ?>" name="height[]">

                                                            <input type="hidden" id="width_<?php echo $row_order_item->order_id; ?>" value="<?php echo $row_order_item->width; ?>" name="width[]">

                                                            <input type="hidden" id="order_id_<?php echo $row_order_item->order_id; ?>" value="<?php echo $row_order_item->order_id; ?>" name="order_id[]">

                                                        </tr>
                                                    <?php

                                                    }

                                                    $sumador_total = cdb_money_format_bar($sumador_total);
                                                    $sumador_libras = $sumador_libras;
                                                    $sumador_volumetric = $sumador_volumetric;
                                                    $total_envio = cdb_money_format($total_envio);
                                                    $total_seguro = cdb_money_format_bar($total_seguro);
                                                    $total_peso = $total_peso;
                                                    $total_impuesto_aduanero = cdb_money_format_bar($total_impuesto_aduanero);
                                                    $total_impuesto = cdb_money_format_bar($total_impuesto);
                                                    $total_descuento = cdb_money_format_bar($total_descuento);

                                                    ?>
                                            </tbody>
                                            <tfoot>
                                                <tr class="card-hover">
                                                    <td colspan="2"></td>
                                                    <td colspan="2"></td>
                                                    <td colspan="2" class="text-right"><b><?php echo $lang['left240'] ?></b></td>
                                                    <td class="text-right" id="subtotal"><?php echo $sumador_total; ?></td>
                                                    <td></td>
                                                    <!-- <td ></td>  -->
                                                </tr>

                                                <tr class="card-hover">
                                                    <td colspan=""><b>Price &nbsp; <?php echo $core->weight_p; ?>:</b>

                                                        <input type="text" onkeypress="return cdp_soloNumeros(event)" onblur="cdp_cal_final_total();" class="form-control form-control-sm is is-invalid" value="<?php echo $row_order->value_weight; ?>" name="price_lb" id="price_lb" style="width: 160px;">
                                                    </td>
                                                    <td></td>
                                                    <td colspan="2"></td>


                                                    <td colspan="2" class="text-right"><b>Discount <?php echo $row_order->tax_discount; ?> % </b></td>
                                                    <td class="text-right"><?php echo $total_descuento; ?></td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td colspan="2"><b><?php echo $lang['left232'] ?>:</b> <span id="total_libras"><?php echo $sumador_libras; ?></span></td>
                                                    <td colspan="2"></td>

                                                    <td colspan="2" class="text-right"><b>Shipping insurance <?php echo $row_order->tax_insurance_value; ?> % </b></td>
                                                    <td class="text-right" id="insurance"><?php echo $total_seguro; ?></td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td colspan="2"><b><?php echo $lang['left234'] ?>:</b> <span id="total_volumetrico"><?php echo $sumador_volumetric; ?></span></td>
                                                    <td colspan="2"></td>

                                                    <td colspan="2" class="text-right"> <b>Customs tariffs <?php echo $row_order->tax_custom_tariffis_value; ?> %</b></td>
                                                    <td class="text-right" id="total_impuesto_aduanero"><?php echo $total_impuesto_aduanero; ?></td>
                                                    <td></td>

                                                </tr>

                                                <tr>
                                                    <td colspan="2"><b><?php echo $lang['left236'] ?></b>: <span id="total_peso"><?php echo $total_peso; ?></span></td>
                                                    <td colspan="2"></td>

                                                    <td colspan="2" class="text-right"><b>Tax <?php echo $row_order->tax_value; ?> % </b></td>
                                                    <td class="text-right" id="impuesto"><?php echo $total_impuesto; ?></td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td colspan="2"></td>

                                                    <td colspan="2" class="text-right"><b><?php echo $lang['add-title44'] ?> &nbsp; <?php echo $core->currency; ?></b></td>
                                                    <td class="text-right" id="total_envio"><?php echo $total_envio; ?></td>
                                                    <td></td>

                                                </tr>
                                            </tfoot>
                                            <input type="hidden" name="total_item" id="total_item" value="<?php echo $count_item; ?>" />
                                        <?php
                                                } ?>
                                        </table>
                                    </div>

                                    <div class="row">

                                        <div class="form-group col-md-6">
                                            <label for="inputname" class="control-label col-form-label"><?php echo $lang['left208'] ?></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="color:#ff0000"><i class="fas fa-car"></i></span>
                                                </div>
                                                <select class="custom-select col-12" id="driver_id" name="driver_id">
                                                    <option value="0">--<?php echo $lang['left209'] ?>--</option>
                                                    <?php foreach ($driverrow as $row) : ?>
                                                        <option value="<?php echo $row->id; ?>" <?php if ($row_order->driver_id == $row->id) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?php echo $row->fname . ' ' . $row->lname; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-actions">
                                                <div class="card-body">
                                                    <div class="text-right">

                                                        <input type="hidden" name="subtotal_input" id="subtotal_input" />
                                                        <input type="hidden" name="impuesto_input" id="impuesto_input" />
                                                        <input type="hidden" name="discount_input" id="discount_input" />
                                                        <input type="hidden" name="insurance_input" id="insurance_input" />
                                                        <input type="hidden" name="insured_input" id="insured_input" / value="<?php echo $row_order->total_insured_value; ?>">
                                                        <input type="hidden" name="total_impuesto_aduanero_input" id="total_impuesto_aduanero_input" />
                                                        <input type="hidden" name="total_envio_input" id="total_envio_input" />
                                                        <input type="hidden" name="total_weight_input" id="total_weight_input" />

                                                        <input type="submit" name="create_invoice" id="create_invoice" class="btn btn-success" value="Update consolidated " />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <input type="hidden" name="order_volumetric_percentage" id="order_volumetric_percentage" value="<?php echo $row_order->volumetric_percentage; ?>" />
                    <input type="hidden" name="order_value_weight" id="order_value_weight" value="<?php echo $row_order->value_weight; ?>" />
                    <input type="hidden" name="order_min_cost_tax" id="order_min_cost_tax" value="<?php echo  $core->min_cost_tax; ?>" />
                    <input type="hidden" name="order_tax_value" id="order_tax_value" value="<?php echo $row_order->tax_value; ?>" />
                    <input type="hidden" name="order_tax_discount" id="order_tax_discount" value="<?php echo $row_order->tax_discount; ?>" />
                    <input type="hidden" name="order_tax_insurance_value" id="order_tax_insurance_value" value="<?php echo $row_order->tax_insurance_value; ?>" />
                    <input type="hidden" name="order_insured_value" id="order_insured_value" value="<?php echo $row_order->total_insured_value; ?>" />
                    <input type="hidden" name="order_tax_custom_tariffis_value" id="order_tax_custom_tariffis_value" value="<?php echo $row_order->tax_custom_tariffis_value; ?>" />

            </form>

            <?php include('views/modals/modal_add_user_shipment.php'); ?>
            <?php include('views/modals/modal_add_recipient_shipment.php'); ?>
            <?php include('views/modals/modal_add_addresses_user.php'); ?>
            <?php include('views/modals/modal_add_addresses_recipient.php'); ?>

        </div>
    </div>


    </div>
    <?php
    include('views/modals/modal_add_ship_consolidate.php');
    ?>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    <!-- <script src="dataJs/consolidate_add.js"></script>  -->

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/custom_dependencies/jquery-3.6.0.min.js"></script>
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/custom_dependencies/bootstrap.min.js"></script>
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
    <script src="assets/moment.min.js" type="text/javascript"></script>
    <script src="assets/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/select2/dist/js/select2.full.min.js"></script>
    <script src="assets/select2/dist/js/select2.min.js"></script>
    <script src="assets/js/input-js/intlTelInput.js"></script>
    <script src="dataJs/consolidate_edit.js"></script>

</body>

</html>