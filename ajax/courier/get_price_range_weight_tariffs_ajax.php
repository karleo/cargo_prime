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


$error = "";
if (empty($_POST['sender_id']))
    $error = 'Select sender';

if (empty($_POST['sender_address']))
    $error = 'Select sender address';

if (empty($_POST['recipient_id']))
    $error = 'Select recipient';

if (empty($_POST['recipient_address']))
    $error = 'Select recipient address';

$list = array();
if (empty($error)) {

    if (isset($_POST["packages"])) {

        $settings = cdp_getSettingsCourier();
        $meter = $settings->meter;
        $packages = json_decode($_POST['packages']);
        $sumador_weight = 0;
        $sumador_volumetric = 0;
        $calculate_weight = 0;

        foreach ($packages as $package) {
            // calculate weight columetric box size
            $total_metric = $package->length * $package->width * $package->height / $meter;
            $weight = $package->weight;

            $total_metric = round($total_metric, 2);
            $weight = round($weight, 2);
            // calculate weight x price
            if ($weight > $total_metric) {
                $calculate_weight += $weight;
            } else {
                $calculate_weight += $total_metric;
            }
        }
        $calculate_weight = round($calculate_weight, 2);

        $sender_address_data = cdp_getSenderAddress(intval($_POST["sender_address"]));
        $origin = $sender_address_data->country;

        $recipient_address_data = cdp_getRecipientAddress(intval($_POST["recipient_address"]));
        $destiny = $recipient_address_data->country;
        $state = $recipient_address_data->state;
        $city = $recipient_address_data->city;

        $db = new Conexion;
        $sql = "SELECT * FROM cdb_shipping_fees WHERE origin=$origin and (destiny=$destiny or state=$state or city=$city) and ($calculate_weight between initial_range AND  final_range)";

        $db->cdp_query($sql);
        $db->cdp_execute();

        $data = $db->cdp_registro();
        if ($data) {
            echo json_encode([
                'success' => true,
                'data' => $data,
            ]);
        } else {
            $db = new Conexion;
            $sql2 = "SELECT min(initial_range) as min_initial_range, max(final_range) as max_final_range FROM cdb_shipping_fees  WHERE origin=$origin and (destiny=$destiny or state=$state or city=$city)";

            $db->cdp_query($sql2);
            $db->cdp_execute();

            $data2 = $db->cdp_registro();
            $min_initial_range = $data2->min_initial_range;
            $max_final_range = $data2->max_final_range;

            if ($min_initial_range !== null &&  $max_final_range !== null) {
                if ($calculate_weight > $max_final_range) {
                    $error = "The weight $calculate_weight is above the maximum required $max_final_range";
                } else if ($calculate_weight < $min_initial_range) {
                    $error = "The weight $calculate_weight is below the minimum required $min_initial_range";
                }
            } else {
                $error = "No hay tarifa configurada para";
            }
        }
    }
}


if (!empty($error)) {
    echo json_encode([
        'success' => false,
        'error' => $error
    ]);
}
