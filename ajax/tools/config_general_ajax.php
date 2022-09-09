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

if (empty($_POST['timezone']))

    $errors['timezone'] = 'Please enter Timezone!';

if (empty($_POST['language']))

    $errors['language'] = 'Please enter language!';

if (empty($_POST['currency']))

    $errors['currency'] = 'Please enter currency!';

if (empty($_POST['for_currency']))

    $errors['for_currency'] = 'Please enter currency formatter!';

if (empty($_POST['for_symbol']))

    $errors['for_symbol'] = 'Please enter symbol currency!';

if (empty($_POST['for_decimal']))

    $errors['for_decimal'] = 'Please enter decimal digits!';



if (empty($errors)) {

    if ($_POST['cformat'] == 1) {

    $cform = 1;
    $decpoint = ".";
    $thousandssep = "";

    } else if ($_POST['cformat'] == 2) {

    $cform = 2;
    $decpoint = ".";
    $thousandssep = ",";

    } else if ($_POST['cformat'] == 3) {

    $cform = 3;
    $decpoint = ",";
    $thousandssep = "";

    } else if ($_POST['cformat'] == 4) {

    $cform = 4;
    $decpoint = ",";
    $thousandssep = ".";

    }

    $data = array(
        'timezone' => cdp_sanitize($_POST['timezone']),
        'language' => cdp_sanitize($_POST['language']),
        'currency' => cdp_sanitize($_POST['currency']),
        'for_currency' => cdp_sanitize($_POST['for_currency']),
        'for_symbol' => cdp_sanitize($_POST['for_symbol']),
        'for_decimal' => cdp_sanitize($_POST['for_decimal']),
        'cformat' => $cform,
        'dec_point' => $decpoint,
        'thousands_sep' => $thousandssep,
    );


    $insert = cdp_updateConfigGeneral0gqr5($data);

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