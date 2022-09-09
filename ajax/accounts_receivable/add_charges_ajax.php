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

session_start();


$errors = array();

if (empty($_POST['total_pay']))
  $errors['total_pay'] = 'Please Enter total pay';


if (empty($_POST['mode_pay']))
  $errors['mode_pay'] = 'Please Enter mode payment';

if (empty($_POST['amount']))
  $errors['amount'] = 'Please Enter amount';

if (empty($_POST['balance']))
  $errors['balance'] = 'Please Enter balance';

if ($_POST['total_pay'] > $_POST['balance'])
  $errors['eees'] = 'The amount to be collected must be less than the total balance.';



if (empty($errors)) {

  $data = array(
    'total' => cdp_sanitize($_POST['total_pay']),
    'payment_type' => cdp_sanitize($_POST['mode_pay']),
    'notes' => cdp_sanitize($_POST['notes']),
    'order_id' => cdp_sanitize($_POST['order_id_alone']),
    'user' => $_SESSION['userid']
  );


  $insert = cdp_insertCharges($data);

  if ($insert) {

    $messages[] = "New charge added successfully!";
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