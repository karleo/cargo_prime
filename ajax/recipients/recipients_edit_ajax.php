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

if (empty($_POST['fname']))

    $errors['fname'] = 'Please enter the name';
if (empty($_POST['lname']))

    $errors['lname'] = 'Please enter the last name';


if (empty($_POST['email']))

    $errors['email'] = 'Enter a valid email address';

if (cdp_recipientEmailExists($_POST['email'], $_POST['recipient_id']))

    $errors[] = 'The email address you entered is already in use.';

if (!$user->cdp_isValidEmail($_POST['email']))

    $errors[] = 'The email address you entered is invalid.';



if (empty($_POST['phone_custom']))

    $errors['phone_custom'] = 'Please enter the phone';


if (empty($errors)) {

    $data = array(
        'lname' => cdp_sanitize($_POST['lname']),
        'fname' => cdp_sanitize($_POST['fname']),
        'phone' => cdp_sanitize($_POST['phone']),
        'email' => cdp_sanitize($_POST['email']),
        'id_recipient' => $_POST['recipient_id'],
    );

    $update = cdp_updateRecipient($data);

    if ($update  && isset($_POST["total_address"])) {

        for ($count = 0; $count < $_POST["total_address"]; $count++) {

            if (isset($_POST["address_id"][$count]) && !empty($_POST["address_id"][$count])) {

                $dataAddresses = array(
                    'address_id' =>  cdp_sanitize($_POST["address_id"][$count]),
                    'address' =>  cdp_sanitize($_POST["address"][$count]),
                    'country' =>  cdp_sanitize($_POST["country"][$count]),
                    'city' =>  cdp_sanitize($_POST["city"][$count]),
                    'state' =>  cdp_sanitize($_POST["state"][$count]),
                    'postal' =>  cdp_sanitize($_POST["postal"][$count])
                );

                cdp_updateRecipientAddress($dataAddresses);
            } else {

                $dataAddresses = array(
                    'recipient_id' =>   cdp_sanitize($_POST['recipient_id']),
                    'address' =>  cdp_sanitize($_POST["address"][$count]),
                    'country' =>  cdp_sanitize($_POST["country"][$count]),
                    'city' =>  cdp_sanitize($_POST["city"][$count]),
                    'state' =>  cdp_sanitize($_POST["state"][$count]),
                    'postal' =>  cdp_sanitize($_POST["postal"][$count])
                );

                cdp_insertAddressRecipient($dataAddresses);
            }
        }
    }

    if ($update) {

        $messages[] = "Recipient updated successfully!";
    } else {

        $errors['critical_error'] = "the registration was not completed";
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