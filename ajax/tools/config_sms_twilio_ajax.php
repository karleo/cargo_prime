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

$errors = array();

if (empty($_POST['twilio_sms_sid']))
    $errors['twilio_sms_sid'] = 'Please Enter twilio sms ACCOUNT SID';

if (empty($_POST['twilio_sms_token']))
    $errors['twilio_sms_token'] = 'Please Enter twilio sms AUTH TOKEN';

if (empty($_POST['twilio_sms_number']))
    $errors['twilio_sms_number'] = 'Please Enter twilio sms NUMBER';

if (empty($errors)) {

    $data = array(
        'twilio_sms_sid' => cdp_sanitize($_POST['twilio_sms_sid']),
        'twilio_sms_token' => cdp_sanitize($_POST['twilio_sms_token']),
        'twilio_sms_number' => cdp_sanitize($_POST['twilio_sms_number']),
    );

    $insert = cdp_updateTwiliosmsConfig($data);

    if ($insert) {

        $messages[] = "Twilio sms settings updated successfully!";
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