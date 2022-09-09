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

if (empty($_POST['met_payment']))

    $errors['met_payment'] = 'Please Enter New Method Payment';

if (cdp_paymentMethods2Exists($_POST['met_payment'], $_POST['id']))

    $errors['met_payment'] = 'The new Method Payment is already in use.. <b>"' . $_POST['met_payment'] . '"</b>';

if (empty($_POST['detail']))

    $errors['detail'] = 'Please Enter Days';

if (empty($errors)) {

    $data = array(
        'met_payment' => cdp_sanitize($_POST['met_payment']),
        'detail' => cdp_sanitize($_POST['detail']),
        'id' => cdp_sanitize($_POST['id']),
    );

    $insert = cdp_updatePaymentMethods2($data);

    if ($insert) {
        $messages[] = "New Method Payment added successfully!";
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