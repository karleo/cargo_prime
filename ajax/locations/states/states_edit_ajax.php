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

if (empty($_POST['country']))
  $errors['country'] = 'Please enter country';

if (empty($_POST['state_name']))
  $errors['state_name'] = 'Please enter state name';

if (cdp_stateExists($_POST['state_name'], $_POST['id']))
  $errors['state_name'] = 'The state name is already in use.. <b>"' . $_POST['state_name'] . '"</b>';


if (empty($errors)) {

  $data = array(
    'country' => cdp_sanitize($_POST['country']),
    'state_name' => cdp_sanitize($_POST['state_name']),
    'iso' => cdp_sanitize($_POST['iso']),
    'id' => cdp_sanitize($_POST['id'])
  );

  $insert = cdp_updateState($data);

  if ($insert) {

    $messages[] = "State has been updated successfully!";
  } else {

    $errors['critical_error'] = "the updated was not completed";
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