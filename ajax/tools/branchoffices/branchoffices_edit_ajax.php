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

if (empty($_POST['name_branch']))
  $errors['name_branch'] = 'Please Enter New Branch Offices';

if (cdp_branchofficeExistsr9ufr($_POST['name_branch'], $_POST['id']))
  $errors['name_branch'] = 'The new branch office is already in use.. <b>"' . $_POST['name_branch'] . '"</b>';


if (empty($_POST['branch_address']))
  $errors['branch_address'] = 'Please Enter New Address';

if (empty($_POST['branch_city']))
  $errors['branch_city'] = 'Please Enter New City';

if (empty($_POST['phone_branch']))
  $errors['phone_branch'] = 'Please Enter Phone';


if (empty($errors)) {

  $data = array(
    'name_branch' => cdp_sanitize($_POST['name_branch']),
    'branch_address' => cdp_sanitize($_POST['branch_address']),
    'branch_city' => cdp_sanitize($_POST['branch_city']),
    'phone_branch' => cdp_sanitize($_POST['phone_branch']),
    'id' => cdp_sanitize($_POST['id'])
  );

  $insert = cdp_updateBranchOffices($data);

  if ($insert) {

    $messages[] = "New branch Office updated successfully!";
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