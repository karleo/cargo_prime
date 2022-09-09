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

session_start();

$db = new Conexion;

$errors = array();

if (empty($_POST['id_shipment']))
    $errors['id_shipment'] = 'Please Enter shipment';


if (empty($_POST['driver_id']))
    $errors['driver_id'] = 'Please selected driver';



if (empty($errors)) {

    $data = array(
        'id_shipment' => trim($_POST['id_shipment']),
        'driver_id' => trim($_POST['driver_id']),
    );

    $insert = cdp_updateDriverCourier($data);

    if ($insert) {

        $messages[] = "Driver updated successfully!";


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
        $db->bind(':order_id',  $_POST['id_shipment']);
        $db->bind(':notification_description', 'a new driver has been assigned to the shipment, please check it');
        $db->bind(':shipping_type', '1');
        $db->bind(':notification_date',  date("Y-m-d H:i:s"));

        $db->cdp_execute();


        $notification_id = $db->dbh->lastInsertId();

        //NOTIFICATION TO DRIVER

        cdp_insertNotificationsUsers($notification_id, $_POST["driver_id"]);


        //NOTIFICATION TO ADMIN AND EMPLOYEES

        $users_employees = cdp_getUsersAdminEmployees();

        foreach ($users_employees as $key) {

            cdp_insertNotificationsUsers($notification_id, $key->id);
        }
        //NOTIFICATION TO CUSTOMER

        cdp_insertNotificationsUsers($notification_id, $_POST['id_senderclient_driver_update']);
    } else {

        $errors['critical_error'] = "the update was not completed";
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

<?php
}
?>