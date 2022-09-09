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

$id = $_REQUEST['id'];

$errors = array();

if (empty($errors)) {

    $verifyExistsShipment = cdp_verifyReferentialIntegrity('cdb_add_order', 'receiver_address_id', $id);
    $verifyExistsCustomerPackages = cdp_verifyReferentialIntegrity('cdb_customers_packages', 'receiver_address_id', $id);
    $verifyExistsConsolidate = cdp_verifyReferentialIntegrity('cdb_consolidate', 'receiver_address_id', $id);

    if ($verifyExistsShipment || $verifyExistsCustomerPackages || $verifyExistsConsolidate) {
        $errors['constrains'] = "You cannot delete this address because it is linked to a shipment";
    } else {

        $delete = cdp_deleteRecipientAddress($id);
        if ($delete) {
            $messages[] = "deleted successfully!";
        } else {
            $errors['critical_error'] = "the deleted was not completed";
        }
    }
}





if (!empty($errors)) {

    echo json_encode([
        'success' => false,
        'errors' => $errors
    ]);
} else {

    echo json_encode([
        'success' => true,
        'messages' => $messages
    ]);
}
