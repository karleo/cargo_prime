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

if (empty($_POST['namesms']))

  $errors['namesms'] = 'Please Enter SMS Company';

if (empty($_POST['api_key']))

  $errors['api_key'] = 'Please Enter Api Key';

if (empty($_POST['api_secret']))

  $errors['api_secret'] = 'Please Enter Api Secret';

if (empty($_POST['nexmo_number']))

  $errors['nexmo_number'] = 'Please Enter Nexmo Number';




if (empty($errors)) {

  $data = array(
    'namesms' => cdp_sanitize($_POST['namesms']),
    'api_key' => cdp_sanitize($_POST['api_key']),
    'api_secret' => cdp_sanitize($_POST['api_secret']),
    'nexmo_number' => cdp_sanitize($_POST['nexmo_number']),
    'active_nex' => intval($_POST['active_nex']),
    'id' => intval($_POST['id'])
  );

  $insert = cdp_updateConfigSmsNexmo($data);

  if ($insert) {

    $messages[] = "SMS Nexmo updated successfully!";
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