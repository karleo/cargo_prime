<?php

require '../../helpers/stripe/init.php';
require_once("../../loader.php");

$core = new Core;

$db = new Conexion;

$db->cdp_query("SELECT * FROM cdb_met_payment WHERE id=3 ");
$active_stripe = $db->cdp_registro();

if ($active_stripe->is_active == 1){

    $secret_key_stripe = $active_stripe->secret_key;
}

// This is your real test secret API key.
\Stripe\Stripe::setApiKey($secret_key_stripe);

header('Content-Type: application/json');

try {
  // retrieve JSON from POST body
  $json_str = file_get_contents('php://input');
  $json_obj = json_decode($json_str);


  //get amount order

  $db->cdp_query('SELECT * FROM cdb_add_order WHERE order_id=:id');

  $db->bind(':id', $json_obj->order_id);

  $db->cdp_execute();

  $order = $db->cdp_registro();



  $customer = \Stripe\Customer::create([
    'email' => $json_obj->email_property_card_stripe,
    'name'  => $json_obj->name_property_card_stripe,


  ]);

  $description_payment = 'Shipment payment, invoice #' . $json_obj->track_order;

  $paymentIntent = \Stripe\PaymentIntent::create([
    'amount' => ($order->total_order * 100),
    'description' => $description_payment,
    'customer' => $customer,
    'currency' => 'usd',
    'metadata' => [
      'web site' => $core->site_url,
      'Order track' => $json_obj->track_order,
      'Total order' => $order->total_order,
    ],
  ]);

  $output = [
    'clientSecret' => $paymentIntent->client_secret,
  ];

  echo json_encode($output);
} catch (Error $e) {
  http_response_code(500);
  echo json_encode(['error' => $e->getMessage()]);
}
