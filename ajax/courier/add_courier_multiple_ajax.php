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

ini_set('display_errors', 0);


require_once("../../loader.php");
require_once("../../helpers/querys.php");
require_once("../../helpers/phpmailer/class.phpmailer.php");
require_once("../../helpers/phpmailer/class.smtp.php");
require_once '../../helpers/vendor/autoload.php';
require_once '../../helpers/src/src/Twilio/autoload.php';

use Twilio\Rest\Client;

$user = new User;
$core = new Core;
$errors = array();

if (empty($_POST['sender_id']))

    $errors['sender_id'] = 'Select sender';

if (empty($_POST['sender_address_id']))

    $errors['sender_address_id'] = 'Select sender address';

if (empty($_POST['recipient_id']))

    $errors['recipient_id'] = 'Select recipient';

if (empty($_POST['recipient_address_id']))

    $errors['recipient_address_id'] = 'Select recipient address';

if (empty($_POST['agency']))

    $errors['agency'] = 'Select agency';

if (empty($_POST['origin_off']))

    $errors['origin_off'] = 'Select Origin Office';

if (empty($_POST['order_item_category']))

    $errors['order_item_category'] = 'Select Logistics Services';

if (empty($_POST['order_package']))

    $errors['order_package'] = 'Select Packaging Type';

if (empty($_POST['order_courier']))

    $errors['order_courier'] = 'Select Courier Company';

if (empty($_POST['order_service_options']))
    $errors['order_service_options'] = 'Select Shipping Methods';

if (empty($_POST['order_deli_time']))
    $errors['order_deli_time'] = 'Select Delivery Time';

if (empty($_POST['order_pay_mode']))
    $errors['order_pay_mode'] = 'Select Pay mode';

if (empty($_POST['status_courier']))
    $errors['status_courier'] = 'Select Delivery Status';

if (empty($_POST['order_payment_method']))
    $errors['order_payment_method'] = 'Select Payment Method';

if (empty($errors)) {

    $settings = cdp_getSettingsCourier();

    $order_prefix = $settings->prefix;
    $site_email = $settings->email_address;
    $check_mail = $settings->mailer;
    $names_info = $settings->smtp_names;
    $mlogo = $settings->logo;
    $msite_url = $settings->site_url;
    $msnames = $settings->site_name;
    //SMTP
    $smtphoste = $settings->smtp_host;
    $smtpuser = $settings->smtp_user;
    $smtppass = $settings->smtp_password;
    $smtpport = $settings->smtp_port;
    $smtpsecure = $settings->smtp_secure;
    $value_weight = $settings->value_weight;
    $meter = $settings->meter;

    $min_cost_tax = $core->min_cost_tax;
    $min_cost_declared_tax = $core->min_cost_declared_tax;

    $date = date('Y-m-d', strtotime(cdp_sanitize($_POST["order_date"])));
    $time = date("H:i:s");
    $date = $date . ' ' . $time;
    $sale_date   = date("Y-m-d H:i:s");

    $payment_methods = cdp_getPaymentMethodCourier($_POST["order_payment_method"]);
    $days = $payment_methods->days;
    $days = intval($days);
    $due_date = cdp_sumardias($sale_date, $days);

    if ($days == 0) {
        $status_invoice = 1;
    } else {
        $status_invoice = 2;
    }

    if (isset($_POST["prefix_check"]) && intval($_POST["prefix_check"]) == 1) {
        $code_prefix = cdp_sanitize($_POST["code_prefix2"]);
    } else {
        $code_prefix = cdp_sanitize($_POST["code_prefix"]);
    }


    if (isset($_POST["packages"])) {

        $packages = json_decode($_POST['packages']);

        foreach ($packages as $package) {

            $sumador_total = 0;
            $sumador_valor_declarado = 0;
            $max_fixed_charge = 0;
            $sumador_libras = 0;
            $sumador_volumetric = 0;

            $precio_total = 0;
            $total_impuesto = 0;
            $total_descuento = 0;
            $total_seguro = 0;
            $total_peso = 0;
            $total_impuesto_aduanero = 0;
            $total_valor_declarado = 0;

            $tariffs_value = $_POST["tariffs_value"];
            $declared_value_tax = $_POST["declared_value_tax"];
            $insurance_value = $_POST["insurance_value"];
            $tax_value = $_POST["tax_value"];
            $discount_value = $_POST["discount_value"];
            $reexpedicion_value = $_POST["reexpedicion_value"];
            $price_lb = $_POST["price_lb"];
            $insured_value = $_POST["insured_value"];

            $next_order = $core->cdp_order_track();

            $is_pickup = false;
            $order_incomplete = 0;

            $dataShipment = array(
                'user_id' =>  $_SESSION['userid'],
                'order_incomplete' =>  $order_incomplete,
                'is_pickup' =>  $is_pickup,
                'order_prefix' =>  $code_prefix,
                'order_no' => $next_order,
                'order_datetime' =>  cdp_sanitize($date),
                'sender_id' =>  cdp_sanitize(intval($_POST["sender_id"])),
                'recipient_id' =>  cdp_sanitize(intval($_POST["recipient_id"])),
                'sender_address_id' =>  cdp_sanitize(intval($_POST["sender_address_id"])),
                'recipient_address_id' =>  cdp_sanitize(intval($_POST["recipient_address_id"])),
                'order_date' =>  date("Y-m-d H:i:s"),
                'agency' =>  cdp_sanitize(intval($_POST["agency"])),
                'origin_off' =>  cdp_sanitize(intval($_POST["origin_off"])),
                'order_package' =>  cdp_sanitize(intval($_POST["order_package"])),
                'order_item_category' =>  cdp_sanitize(intval($_POST["order_item_category"])),
                'order_courier' =>  cdp_sanitize(intval($_POST["order_courier"])),
                'order_service_options' =>  cdp_sanitize(intval($_POST["order_service_options"])),
                'order_deli_time' =>  cdp_sanitize(intval($_POST["order_deli_time"])),
                'order_pay_mode' =>  cdp_sanitize(intval($_POST["order_pay_mode"])),
                'order_payment_method' =>  cdp_sanitize(intval($_POST["order_payment_method"])),
                'status_courier' =>  cdp_sanitize(intval($_POST["status_courier"])),
                'driver_id' =>  cdp_sanitize(intval($_POST["driver_id"])),
                'due_date' =>  $due_date,
                'status_invoice' =>  $status_invoice,
                'volumetric_percentage' =>  $meter
            );

            $shipment_id = cdp_insertCourierShipment($dataShipment);

            if ($shipment_id !== null) {

                $dataAddresses = array(
                    'order_id' =>  $shipment_id,
                    'qty' =>  $package->qty,
                    'description' =>  $package->description,
                    'length' =>  $package->length,
                    'width' =>  $package->width,
                    'height' =>  $package->height,
                    'weight' =>  $package->weight,
                    'declared_value' =>  $package->declared_value,
                    'fixed_value' =>  $package->fixed_value,
                );

                cdp_insertCourierShipmentPackages($dataAddresses);

                // calculate weight columetric box size
                $total_metric = $package->length * $package->width * $package->height / $meter;
                $weight = $package->weight;

                // calculate weight x price
                if ($weight > $total_metric) {
                    $calculate_weight = $weight;
                    $sumador_libras += $weight;
                } else {
                    $calculate_weight = $total_metric;
                    $sumador_volumetric += $total_metric;
                }

                $precio_total = $calculate_weight * $price_lb;
                $sumador_total += $precio_total;
                $sumador_valor_declarado += $package->declared_value;
                $max_fixed_charge += $package->fixed_value;

                if ($sumador_total > $min_cost_tax) {
                    $total_impuesto = $sumador_total * $tax_value / 100;
                }

                if ($sumador_valor_declarado > $min_cost_declared_tax) {
                    $total_valor_declarado = $sumador_valor_declarado * $declared_value_tax / 100;
                }


                $total_descuento = $sumador_total * $discount_value / 100;
                $total_peso = $sumador_libras + $sumador_volumetric;
                $total_seguro = $insured_value * $insurance_value / 100;
                $total_impuesto_aduanero = $total_peso * $tariffs_value;
                $total_envio = ($sumador_total - $total_descuento) + $total_seguro + $total_impuesto + $total_impuesto_aduanero + $total_valor_declarado + $max_fixed_charge + $reexpedicion_value;

                $dataShipmentUpdateTotals = array(
                    'order_id' =>  $shipment_id,
                    'value_weight' =>  floatval($price_lb),
                    'sub_total' =>  floatval($sumador_total),
                    'tax_discount' =>  floatval($discount_value),
                    'total_insured_value' => floatval($insured_value),
                    'tax_insurance_value' => floatval($insurance_value),
                    'tax_custom_tariffis_value' => floatval($tariffs_value),
                    'tax_value' => floatval($tax_value),
                    'declared_value' =>  floatval($declared_value_tax),
                    'total_reexp' =>  floatval($reexpedicion_value),
                    'total_declared_value' =>  floatval($total_valor_declarado),
                    'total_fixed_value' =>  floatval($max_fixed_charge),
                    'total_tax_discount' =>  floatval($total_descuento),
                    'total_tax_insurance' =>  floatval($total_seguro),
                    'total_tax_custom_tariffis' =>  floatval($total_impuesto_aduanero),
                    'total_tax' =>  floatval($total_impuesto),
                    'total_weight' =>  floatval($total_peso),
                    'total_order' =>  floatval($total_envio),
                );

                $update = cdp_updateCourierShipmentTotals($dataShipmentUpdateTotals);

                $order_track = $code_prefix . $next_order;

                $dataTrack = array(
                    'user_id' =>  $_SESSION['userid'],
                    'order_id' =>  $shipment_id,
                    'order_track' =>  $order_track,
                    't_date' =>  date("Y-m-d H:i:s"),
                    'status_courier' =>  cdp_sanitize(intval($_POST["status_courier"])),
                    'comments' =>  'Shipping created',
                    'office' => cdp_sanitize(intval($_POST["origin_off"]))
                );

                cdp_insertCourierShipmentTrack($dataTrack);

                $sender_data = cdp_getSenderCourier(intval($_POST["sender_id"]));
                $receiver_data = cdp_getRecipientCourier(intval($_POST["recipient_id"]));


                $add_status =   intval($_POST["status_courier"]);
                $date_ship   = date("Y-m-d H:i:s a");

                $app_url = $settings->site_url . 'track.php?order_track=' . $order_track;
                $subject = "a new shipment has been created, tracking number $order_track";

                $email_template = cdp_getEmailTemplatesdg1i4(16);

                $body = str_replace(
                    array(
                        '[NAME]',
                        '[TRACKING]',
                        '[DELIVERY_TIME]',
                        '[URL]',
                        '[URL_LINK]',
                        '[SITE_NAME]',
                        '[URL_SHIP]'
                    ),
                    array(
                        $sender_data->fname . ' ' . $sender_data->lname,
                        $order_track,
                        $date_ship,
                        $msite_url,
                        $mlogo,
                        $msnames,
                        $app_url
                    ),
                    $email_template->body
                );

                $newbody = cdp_cleanOut($body);

                //SENDMAIL PHP

                if ($check_mail == 'PHP') {

                    $message = $newbody;
                    $to = $sender_data->email;
                    $from = $site_email;
                    $header = "MIME-Version: 1.0\r\n";
                    $header .= "Content-type: text/html; charset=UTF-8 \r\n";
                    $header .= "From: " . $from . " \r\n";
                    try {
                        mail($to, $subject, $message, $header);
                    } catch (Exception $e) {
                    }
                } elseif ($check_mail == 'SMTP') {

                    //PHPMAILER PHP
                    $destinatario = $sender_data->email;

                    $mail = new PHPMailer();
                    $mail->IsSMTP();
                    $mail->SMTPAuth = true;
                    $mail->Port = $smtpport;
                    $mail->IsHTML(true);
                    $mail->CharSet = "utf-8";

                    // Datos de la cuenta de correo utilizada para enviar vía SMTP
                    $mail->Host = $smtphoste;       // Dominio alternativo brindado en el email de alta
                    $mail->Username = $smtpuser;    // Mi cuenta de correo
                    $mail->Password = $smtppass;    //Mi contraseña

                    $mail->From = $site_email; // Email desde donde envío el correo.
                    $mail->FromName = $names_info;
                    $mail->AddAddress($destinatario); // Esta es la dirección a donde enviamos los datos del formulario

                    $mail->Subject = $subject; // Este es el titulo del email.
                    $mail->Body = "
                    <html> 
                    <body> 
                    <p>{$newbody}</p>
                    </body> 
                    </html>
                    <br />"; // Texto del email en formato HTML

                    $mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );

                    try {
                        $estadoEnvio = $mail->Send();
                        echo "El correo fue enviado correctamente.";
                    } catch (Exception $e) {
                        echo "Ocurrió un error inesperado.";
                    }
                }

                //NOTIFY WHATSAPP API

                if (isset($_POST['notify_whatsapp_sender']) && intval($_POST['notify_whatsapp_sender']) == 1) {

                    if ($core->twilio_sid != null && $core->twilio_token != null && $core->twilio_number != null) {
                        $phone_sender = $sender_data->phone;
                        $sid    = $core->twilio_sid;
                        $token  = $core->twilio_token;
                        try {
                            $twilio = new Client($sid, $token);
                            $message = $twilio->messages
                                ->create(
                                    "whatsapp:" . $phone_sender, // to 
                                    array(
                                        "from" => "whatsapp:" . $core->twilio_number,
                                        "body" => "a new shipment has been registered, *Tracking #$fullshipment* Follow up on your package by entering the following link and you will have detailed information on the status of your packages $app_url"
                                    )
                                );
                        } catch (Exception $e) {
                        }
                    }
                }


                $dataHistory = array(
                    'user_id' =>  $_SESSION['userid'],
                    'order_id' =>  $shipment_id,
                    'order_track' =>  $order_track,
                    'action' => 'create shipment',
                    'date_history' =>  cdp_sanitize(date("Y-m-d H:i:s")),
                );

                //INSERT HISTORY USER
                cdp_insertCourierShipmentUserHistory(
                    $dataHistory
                );

                $dataNotification = array(
                    'user_id' =>  $_SESSION['userid'],
                    'order_id' =>  $shipment_id,
                    'notification_description' => 'There is a new shipment, please check it',
                    'shipping_type' => '1',
                    'notification_date' =>  cdp_sanitize(date("Y-m-d H:i:s")),
                );
                // SAVE NOTIFICATION
                cdp_insertNotification(
                    $dataNotification
                );

                $notification_id = $db->dbh->lastInsertId();

                //NOTIFICATION TO DRIVER
                cdp_insertNotificationsUsers($notification_id, intval($_POST["driver_id"]));
                //NOTIFICATION TO ADMIN AND EMPLOYEES
                $users_employees = cdp_getUsersAdminEmployees();

                foreach ($users_employees as $key) {
                    cdp_insertNotificationsUsers($notification_id, $key->id);
                }
                //NOTIFICATION TO CUSTOMER
                cdp_insertNotificationsUsers($notification_id, intval($_POST['sender_id']));



                $sender_address_data = cdp_getSenderAddress(intval($_POST["sender_address_id"]));
                $sender_country = $sender_address_data->country;
                $sender_state = $sender_address_data->state;
                $sender_city = $sender_address_data->city;
                $sender_zip_code = $sender_address_data->zip_code;
                $sender_address = $sender_address_data->address;

                $_sender_country = cdp_getCountry($sender_country);
                $final_sender_country = $_sender_country['data'];

                $_sender_state = cdp_getState($sender_state);
                $final_sender_state = $_sender_state['data'];

                $sender_city = cdp_getCity($sender_city);
                $final_sender_city = $sender_city['data'];

                $recipient_address_data = cdp_getRecipientAddress(intval($_POST["recipient_address_id"]));

                $recipient_address = $recipient_address_data->address;
                $recipient_country = $recipient_address_data->country;
                $recipient_city = $recipient_address_data->city;
                $recipient_state = $recipient_address_data->state;
                $recipient_zip_code = $recipient_address_data->zip_code;

                $_recipient_country = cdp_getCountry($recipient_country);
                $final_recipient_country = $_recipient_country['data'];

                $_recipient_state = cdp_getState($recipient_state);
                $final_recipient_state = $_recipient_state['data'];

                $recipient_city = cdp_getCity($recipient_city);
                $final_recipient_city = $recipient_city['data'];

                // SAVE ADDRESS FOR Shipments
                $dataAddresses = array(
                    'order_id' =>   $shipment_id,
                    'order_track' =>   $order_track,
                    'sender_country' =>   $final_sender_country->name,
                    'sender_state' =>   $final_sender_state->name,
                    'sender_city' =>   $final_sender_city->name,
                    'sender_zip_code' =>   $sender_zip_code,
                    'sender_address' =>   $sender_address,
                    'recipient_country' =>   $final_recipient_country->name,
                    'recipient_state' =>   $final_recipient_state->name,
                    'recipient_city' =>   $final_recipient_city->name,
                    'recipient_zip_code' =>   $recipient_zip_code,
                    'recipient_address' =>   $recipient_address,
                );

                cdp_insertCourierShipmentAddresses($dataAddresses);

                $messages[] = "Shipment has been created successfully!";
            } else {
                $errors['critical_error'] = "the deleted was not completed";
            }
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
        'messages' => $messages,
    ]);
}
