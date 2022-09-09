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



require_once("../../../loader.php"); 
require_once("../../../helpers/querys.php");

$errors = array();

if (empty($_POST['name_pay']))
    $errors['name_pay'] = 'Please Enter name payment';

if (cdp_paymentMethodExists($_POST['name_pay'], $_POST['id']))

    $errors['name_pay'] = 'The new Method Payment is already in use.. <b>"' . $_POST['name_pay'] . '"</b>';

if (empty($_POST['detail_pay']))
    $errors['detail_pay'] = 'Please Enter name detail';


if (empty($_POST['public_key']))
    $errors['public_key'] = 'Please Enter public key';

if (empty($_POST['secret_key']))
    $errors['secret_key'] = 'Please Enter secret key';


if (!isset($_POST['is_active'])){

$is_active=0;

}else{

$is_active=$_POST['is_active'];
}


if (empty($errors)) {

    $data = array(
        'name_pay' => cdp_sanitize($_POST['name_pay']),
        'detail_pay' => cdp_sanitize($_POST['detail_pay']),
        'public_key' => cdp_sanitize($_POST['public_key']),
        'secret_key' => cdp_sanitize($_POST['secret_key']),
        'is_active' => $is_active, 
        'id' => cdp_sanitize($_POST['id']),
    );

    $insert = cdp_updatePaymentMethod_paystack($data);

    if ($insert) {

        $messages[] = "Payments settings updated successfully!";
    } else {

        $errors['critical_error'] = "the insert was not completed";
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