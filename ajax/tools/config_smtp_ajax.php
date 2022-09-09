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

if (empty($_POST['smtp_names']))

  $errors['smtp_names'] = "Please enter smtp Names!";

if (empty($_POST['email_address']))

  $errors['email_address'] = "Please enter smtp Address!";

if (empty($_POST['smtp_host']))

  $errors['smtp_host'] = "Please enter smtp Host!";

if (empty($_POST['smtp_user']))

  $errors['smtp_user'] = "Please enter smtp User!";

if (empty($_POST['smtp_password']))

  $errors['smtp_password'] = "Please enter smtp Password!";

if (empty($_POST['smtp_port']))

  $errors['smtp_port'] = "Please enter smtp Port!";

if (empty($_POST['smtp_secure']))

  $errors['smtp_secure'] = "Please enter smtp Secure!";



if (empty($errors)) {

  $data = array(

    'mailer' => cdp_sanitize($_POST['mailer']),
    'smtp_names' => cdp_sanitize($_POST['smtp_names']),
    'email_address' => cdp_sanitize($_POST['email_address']),
    'smtp_host' => cdp_sanitize($_POST['smtp_host']),
    'smtp_user' => cdp_sanitize($_POST['smtp_user']),
    'smtp_password' => cdp_sanitize($_POST['smtp_password']),
    'smtp_port' => cdp_sanitize($_POST['smtp_port']),
    'smtp_secure' => cdp_sanitize($_POST['smtp_secure']),
  );


  $insert = cdp_updateConfigSmtpemailr2g61($data);

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