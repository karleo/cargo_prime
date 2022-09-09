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



require_once("../../loader.php");
require_once("../../helpers/querys.php");

$user = new User;
$core = new Core;
$errors = array();



if (empty($_POST['mode_pay']))

    $errors['mode_pay'] = 'Selected pay mode';

if (empty($_FILES['file_invoice']['name']))

    $errors['file_invoice'] = 'attach proof of payment';


if (!empty($_FILES['file_invoice']['name'])) {

    $target_dir = "../../assets/payment_packages/";
    $image_name = time() . "_" . basename($_FILES["file_invoice"]["name"]);
    $target_file = $target_dir . $image_name;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    $imageFileZise = $_FILES["file_invoice"]["size"];
}

$status_invoice = 3;


if (empty($errors)) {

    $data = array(

        'mode_pay'   =>   cdp_sanitize($_POST["mode_pay"]),
        'order_id'   =>   trim($_GET["order_id"]),
        'notes'   =>   cdp_sanitize($_POST["notes"]),
        'status_invoice'   =>   $status_invoice,
        'payment_date'   =>  date("Y-m-d H:i:s"),

    );

    $data['file_invoice'] = '';



    if (!empty($_FILES['file_invoice']['name'])) {

        move_uploaded_file($_FILES["file_invoice"]["tmp_name"], $target_file);
        $imagen = basename($_FILES["file_invoice"]["name"]);
        $data['file_invoice'] = 'payment_packages/' . $image_name;
    }

    $insert = cdp_updatePaymentConsolidate($data);



    if ($insert) {

        $messages[] = "Payment added successfully!";

        // SAVE NOTIFICATION
        $db->cdp_query("
                    INSERT INTO cdb_notifications 
                    (
                        user_id,
                        order_id,
                        notification_description,
                        shipping_type,
                        notification_date

                    )
                    VALUES
                        (
                        :user_id,      
                        :order_id,

                        :notification_description,
                        :shipping_type,
                        :notification_date                    
                        )
                ");



        $db->bind(':user_id',  $_SESSION['userid']);
        $db->bind(':order_id', $_GET["order_id"]);
        $db->bind(':notification_description', 'Consolidated has been paid, please check it');
        $db->bind(':shipping_type', '2');
        $db->bind(':notification_date',  date("Y-m-d H:i:s"));

        $db->cdp_execute();


        $notification_id = $db->dbh->lastInsertId();


        $users_employees = cdp_getUsersAdminEmployees();

        foreach ($users_employees as $key) {

            cdp_insertNotificationsUsers($notification_id, $key->id);
        }

        cdp_insertNotificationsUsers($notification_id, $_SESSION['userid']);
    } else {

        $errors['critical_error'] = "was not completed";
    }
}


if (!empty($errors)) {
?>
    <div class="alert alert-danger" id="success-alert">
        <p><span class="icon-minus-sign"></span><i class="close icon-remove-circle"></i>
            <span>Error! </span> There was an error processing the request
        <ul class="error">
            <?php
            foreach ($errors as $error) { ?>
                <li>
                    <i class="icon-double-angle-right"></i>
                    <?php
                    echo $error;

                    ?>

                </li>
            <?php

            }
            ?>


        </ul>
        </p>
    </div>



<?php
}

if (isset($messages)) {

?>
    <div class="alert alert-info" id="success-alert">
        <p><span class="icon-info-sign"></span><i class="close icon-remove-circle"></i>
            <?php
            foreach ($messages as $message) {
                echo $message;
            }
            ?>
        </p>
    </div>

    <script>
        setTimeout('redirect()', 3000);
    </script>

<?php
}
?>