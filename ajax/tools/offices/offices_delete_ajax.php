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

$id = $_REQUEST['id'];


$errors = array();


if (empty($errors)) {

    $verifyExistsShipment = cdp_verifyReferentialIntegrity('cdb_add_order', 'origin_off', $id);
    $verifyExistsCustomerPackages = cdp_verifyReferentialIntegrity('cdb_customers_packages', 'origin_off', $id);
    $verifyExistsConsolidate = cdp_verifyReferentialIntegrity('cdb_consolidate', 'origin_off', $id);

    if ($verifyExistsShipment || $verifyExistsCustomerPackages || $verifyExistsConsolidate) {
        $errors['constrains'] = "You cannot delete this office because it is linked to a shipment";
    } else {

        $delete = cdp_deleteOffices($id);
        if ($delete) {
            $messages[] = "deleted successfully!";
        } else {
            $errors['critical_error'] = "the deleted was not completed";
        }
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
