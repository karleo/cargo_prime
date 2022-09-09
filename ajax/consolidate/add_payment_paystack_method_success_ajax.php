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

$user = new User;
$core = new Core;
$errors = array();
$db = new Conexion;

$db->cdp_query("SELECT * FROM cdb_met_payment WHERE id=4 ");
$active_paystack = $db->cdp_registro();

if ($active_paystack->is_active == 1){

    $secret_key_paystack = $active_paystack->secret_key;
}

if (empty($_POST['reference']))

  $errors['reference'] = 'send reference';





if (empty($errors)) {

  $reference = cdp_sanitize($_POST['reference']);
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . $reference,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "Authorization: Bearer " . $secret_key_paystack,
      "Cache-Control: no-cache",
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);

  if ($err) {

    echo "cURL Error #:" . $err;
  } else {

    $result = json_decode($response);

    $customer_code = $result->data->customer->customer_code;


    // UPDATE DATA CUSTOMER

    $url = "https://api.paystack.co/customer/" . $customer_code;

    $fields = [
      'first_name' => cdp_sanitize($_GET['firstname']),
      'last_name' => cdp_sanitize($_GET['lastname']),

    ];

    $fields_string = http_build_query($fields);
    //open connection
    $ch = curl_init();

    //set the url, number of POST vars, POST data
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      "Authorization: Bearer " . $secret_key_paystack,
      "Cache-Control: no-cache",
    ));

    //So that curl_exec returns the contents of the cURL; rather than echoing it
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //execute post
    $result_customer = curl_exec($ch);
  }


  if ($result->data->status == 'success') {

    $gateway = 'Paystack';
    $type_transaccition_courier = 'Consolidated';
    $order_track = cdp_sanitize($_GET['track_order']);
    $order_id = $_GET['order_id'];

    $status = $result->data->status;
    $currency_code = $result->data->currency;
    $amount = floatval($result->data->amount);
    $payment_id = $result->data->reference;


    $data = array(

      'amount' => ($amount / 100),
      'currency_code' => $currency_code,
      'status' => $status,
      'gateway' => $gateway,
      'payment_id' => $payment_id,
      'type_transaccition_courier' => $type_transaccition_courier,
      'date' => date("Y-m-d H:i:s"),
      'order_track' => $order_track,
      'order_track_customer_id' => $_GET['customer'],


    );


    $insert = cdp_insertPaymentGateway($data);

    if ($insert) {

      $messages[] = "Payment added successfully!";

      $status_invoice = 1;

      $db->cdp_query('UPDATE cdb_consolidate SET  status_invoice =:status_invoice WHERE  consolidate_id=:order_id');


      $db->bind(':status_invoice', $status_invoice);
      $db->bind(':order_id', $order_id);


      $db->cdp_execute();


      // SAVE NOTIFICATION
      $db->cdp_query("
                  INSERT INTO cdb_notifications 
                  (
                      user_id,
                      order_id,
                      notification_description,
                      shipping_type,
                      notification_date

                  )
                  VALUES
                      (
                      :user_id,      
                      :order_id,

                      :notification_description,
                      :shipping_type,
                      :notification_date                    
                      )
              ");



      $db->bind(':user_id',  $_SESSION['userid']);
      $db->bind(':order_id', $order_id);
      $db->bind(':notification_description', 'Consolidated payment has been addd, please check it');
      $db->bind(':shipping_type', '2');
      $db->bind(':notification_date',  date("Y-m-d H:i:s"));

      $db->cdp_execute();


      $notification_id = $db->dbh->lastInsertId();


      $users_employees = cdp_getUsersAdminEmployees();

      foreach ($users_employees as $key) {

        cdp_insertNotificationsUsers($notification_id, $key->id);
      }

      cdp_insertNotificationsUsers($notification_id, $_GET['customer']);
    } else {

      $errors['critical_error'] = "the insert was not completed";
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

    <script>
      setTimeout('redirect()', 3000);
    </script>
  </div>

<?php
}
