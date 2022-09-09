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
$db = new Conexion;
$user = new User;
$userData = $user->cdp_getUserData();

$errors = array();



if (empty($_POST['id_delete']))

    $errors['id'] = 'Please select shipment';



if (empty($errors)) {

    $db->cdp_query("SELECT * FROM cdb_add_order where order_id=" . $_POST['id_delete'] . "");
$trackings_order = $db->cdp_registro();


$track_resulta = $trackings_order->order_prefix . $trackings_order->order_no;

    $data = array(

        'id' => cdp_sanitize($_POST['id_delete'])
    );



    $insert = cdp_deleteFullCourier($data); 

    //INSERT HISTORY USER
    $date = date("Y-m-d H:i:s");
    $db->cdp_query("
                INSERT INTO cdb_order_user_history 
                (
                    user_id,
                    order_id,
                    action,
                    date_history                   
                    )
                VALUES
                    (
                    :user_id,
                    :order_id,
                    :action,
                    :date_history
                    )
            ");



    $db->bind(':order_id',  $data['id']);
    $db->bind(':user_id',  $_SESSION['userid']);
    $db->bind(':action', 'delete shipping '.$track_resulta.'');
    $db->bind(':date_history',  trim($date));
    $db->cdp_execute();


    if ($insert) {

        $messages[] = "Delete courier ".$track_resulta." successfully!";
    } else {

        $errors['critical_error'] = "the delete was not completed";
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