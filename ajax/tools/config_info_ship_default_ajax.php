<?php
// *************************************************************************
// *                                                                       *
// * DEPRIXA BASIC -  Freight Forwarding & Shipping Software Solutions     *
// * Copyright (c) JAOMWEB. All Rights Reserved                            *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: support@jaom.info                                              *
// * Website: https://deprixa.link/documentation/                          *
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

if (empty($_POST['logistics_default1']))

  $errors['logistics_default1'] = "Please enter service logistics!";

if (empty($_POST['packaging_default2']))

  $errors['packaging_default2'] = "Please enter packaging type!";

if (empty($_POST['courier_default3']))

  $errors['courier_default3'] = "Please enter courier company!";

if (empty($_POST['service_default4']))

  $errors['service_default4'] = "Please enter service mode!";

if (empty($_POST['time_default5']))

  $errors['time_default5'] = "Please enter delivery time!";

if (empty($_POST['pay_default6']))

  $errors['pay_default6'] = "Please enter pay mode!";

if (empty($_POST['payment_default7']))

  $errors['payment_default7'] = "Please enter payment method!";

if (empty($_POST['status_default8']))

  $errors['status_default8'] = "Please enter status courier!";



if (empty($errors)) {

  $data = array(

    'logistics_default1' => cdp_sanitize($_POST['logistics_default1']),
    'packaging_default2' => cdp_sanitize($_POST['packaging_default2']),
    'courier_default3' => cdp_sanitize($_POST['courier_default3']),
    'service_default4' => cdp_sanitize($_POST['service_default4']),
    'time_default5' => cdp_sanitize($_POST['time_default5']),
    'pay_default6' => cdp_sanitize($_POST['pay_default6']),
    'payment_default7' => cdp_sanitize($_POST['payment_default7']),
    'status_default8' => cdp_sanitize($_POST['status_default8']),
  );


  $insert = cdp_updateConfigInfoShipDefault4xiw0($data);

  if ($insert) {

    $messages[] = "Configuration updated successfully!";
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