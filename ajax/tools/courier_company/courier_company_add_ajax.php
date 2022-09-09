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

if (empty($_POST['name_com']))
    $errors['name_com'] = 'Please Enter New Courier Company';

if (cdp_courierExists9y45g($_POST['name_com']))

    $errors['name_com'] = 'The new Courier Company is already in use.. <b>"' . $_POST['name_com'] . '"</b>';

if (empty($_POST['address_cou']))
    $errors['address_cou'] = 'Please Enter New Address';

if (empty($_POST['phone_cou']))
    $errors['phone_cou'] = 'Please Enter Phone';

if (empty($_POST['country_cou']))
    $errors['country_cou'] = 'Please Enter New Country';

if (empty($_POST['city_cou']))
    $errors['city_cou'] = 'Please Enter New City';

if (empty($_POST['postal_cou']))
    $errors['postal_cou'] = 'Please Enter Postal Code';

if (empty($errors)) {

    $data = array(
        'name_com' => cdp_sanitize($_POST['name_com']),
        'address_cou' => cdp_sanitize($_POST['address_cou']),
        'phone_cou' => cdp_sanitize($_POST['phone_cou']),
        'country_cou' => cdp_sanitize($_POST['country_cou']),
        'city_cou' => cdp_sanitize($_POST['city_cou']),
        'postal_cou' => cdp_sanitize($_POST['postal_cou'])
    );

    $insert = cdp_insertCourierCompany($data);

    if ($insert) {

        $messages[] = "New Courier Company added successfully!";
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