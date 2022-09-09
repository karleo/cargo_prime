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

if (empty($_POST['country_destiny']))
    $errors['country_destiny'] = 'Please select destiny';

if (empty($_POST['state_destinystates']))
    $errors['state_destinystates'] = 'Please select state';


if (empty($_POST['city_destinycities']))
    $errors['city_destinycities'] = 'Please select city';

if (empty($_POST['country_origin']))
    $errors['country_origin'] = 'Please select origin';

if (empty($_POST['initial_range']))
    $errors['initial_range'] = 'Please enter starting weight range';

if (empty($_POST['final_range']))
    $errors['final_range'] = 'Please enter weight range';

if (empty($_POST['tariff_price']))
    $errors['tariff_price'] = 'Please Enter tariff price'; 


if (isset($_POST['initial_range']) && isset($_POST['final_range']) && ($_POST['final_range'] < $_POST['initial_range'])) {
    $errors['greater'] = 'Final range cannot be less than start range';
} else if (isset($_POST['country_origin']) && isset($_POST['country_destiny']) && isset($_POST['initial_range']) && isset($_POST['final_range'])) {
    if (cdp_verifyRangeTariffsExist($_POST['country_origin'], $_POST['country_destiny'], $_POST['initial_range'], $_POST['final_range'], $_POST['id']))
        $errors['valid_range'] = "There is already a tariff created for origin and destination within this range";
}

if (empty($errors)) {
    $data = array(
        'tariff_price' => cdp_sanitize($_POST['tariff_price']),
        'initial_range' => cdp_sanitize($_POST['initial_range']),
        'final_range' => cdp_sanitize($_POST['final_range']),
        'country_origin' => cdp_sanitize($_POST['country_origin']),
        'country_destiny' => cdp_sanitize($_POST['country_destiny']),
        'state_destinystates' => cdp_sanitize($_POST['state_destinystates']),
        'city_destinycities' => cdp_sanitize($_POST['city_destinycities']),
        'id' => cdp_sanitize($_POST['id'])
    );

    $insert = cdp_updateTariffs($data);

    if ($insert) {
        $messages[] = "Tariffs updated successfully!";
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