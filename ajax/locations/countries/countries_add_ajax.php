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

if (empty($_POST['country_name']))
  $errors['country_name'] = 'Please enter  country name';

if (cdp_countryExists($_POST['country_name']))
  $errors['country_name'] = 'The country name is already in use.. <b>"' . $_POST['country_name'] . '"</b>';

if (empty($_POST['currency']))
  $errors['currency'] = 'Please enter currency';

if (empty($_POST['currency_symbol']))
  $errors['currency_symbol'] = 'Please enter currency symbol';

if (empty($errors)) {

  $data = array(
    'name' => cdp_sanitize($_POST['country_name']),
    'iso3' => cdp_sanitize($_POST['iso3']),
    'phone_code' => cdp_sanitize($_POST['phone_code']),
    'capital' => cdp_sanitize($_POST['capital']),
    'currency_name' => cdp_sanitize($_POST['currency']),
    'currency_symbol' => cdp_sanitize($_POST['currency_symbol']),
    'is_active' => 1,
    'region' => cdp_sanitize($_POST['region'])
  );

  $insert = cdp_insertCountry($data);

  if ($insert) {

    $messages[] = "Country has been added successfully!";
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