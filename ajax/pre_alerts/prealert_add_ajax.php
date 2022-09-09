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

if (empty($_POST['tracking_prealert']))

    $errors['tracking_prealert'] = 'Enter tracking purchase';

if ($values = cdp_validateTrack($_POST['tracking_prealert'])) 

if ($values == 2)
            
    $errors['tracking_prealert'] = 'Sorry, this tracking number is not valid';    

if (empty($_POST['provider_prealert']))

    $errors['provider_prealert'] = 'Please enter Shop/Provider';

if (empty($_POST['courier_prealert']))

    $errors['courier_prealert'] = 'Please enter coruier company';

if (empty($_POST['price_prealert']))

    $errors['price_prealert'] = 'Enter purchase price';

if (empty($_POST['description_prealert']))

    $errors['description_prealert'] = 'Enter purchase description';

if (empty($_POST['date_prealert']))

    $errors['date_prealert'] = 'Enter date estimated';

if (empty($_FILES['file_invoice']['name']))

    $errors['file_invoice'] = 'attach invoice';


if (!empty($_FILES['file_invoice']['name'])) {

    $target_dir = "../../pre_alert_files/";
    $image_name = time() . "_" . basename($_FILES["file_invoice"]["name"]);
    $target_file = $target_dir . $image_name;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    $imageFileZise = $_FILES["file_invoice"]["size"];
}

$date = date('Y-m-d', strtotime(trim($_POST["date_prealert"])));


if (empty($errors)) {

    $data = array(

        'tracking_prealert'   =>   cdp_sanitize($_POST["tracking_prealert"]),
        'provider_prealert'   =>   cdp_sanitize($_POST["provider_prealert"]),
        'courier_prealert'    =>   cdp_sanitize($_POST["courier_prealert"]),
        'customer_id'         =>   $_SESSION['userid'],
        'price_prealert'     =>   cdp_sanitize($_POST["price_prealert"]),
        'description_prealert' =>   cdp_sanitize($_POST["description_prealert"]),
        'estimated_date'      =>   cdp_sanitize($date),
        'prealert_date'       =>   date("Y-m-d H:i:s"),

    );

    $data['file_invoice'] = '';



    if (!empty($_FILES['file_invoice']['name'])) {

        move_uploaded_file($_FILES["file_invoice"]["tmp_name"], $target_file);
        $imagen = basename($_FILES["file_invoice"]["name"]);
        $data['file_invoice'] = 'pre_alert_files/' . $image_name;
    }

    $insert = cdp_insertPreAlert($data);



    if ($insert) {

        $messages[] = "Pre alert added successfully!";

        // SAVE NOTIFICATION
        $db->cdp_query("
                    INSERT INTO cdb_notifications 
                    (
                        user_id,
                        notification_description,
                        shipping_type,
                        notification_date

                    )
                    VALUES
                        (
                        :user_id,              
                        :notification_description,
                        :shipping_type,
                        :notification_date                    
                        )
                ");



        $db->bind(':user_id',  $_SESSION['userid']);
        $db->bind(':notification_description', 'a new pre alert has been registered, please check it');
        $db->bind(':shipping_type', '3');
        $db->bind(':notification_date',  date("Y-m-d H:i:s"));

        $db->cdp_execute();


        $notification_id = $db->dbh->lastInsertId();


        $users_employees = cdp_getUsersAdminEmployees();

        foreach ($users_employees as $key) {

            cdp_insertNotificationsUsers($notification_id, $key->id);
        }

        cdp_insertNotificationsUsers($notification_id, $_SESSION['userid']);
    } else {

        $errors['critical_error'] = "the pre alert was not completed";
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
        $("#form_prealert")[0].reset();
    </script>

<?php
}
?>