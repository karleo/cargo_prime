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


if (empty($_POST['address_modal_recipient_address']))

    $errors['address'] = 'Please enter the address';

if (empty($_POST['country_modal_recipient_address']))

    $errors['country'] = 'Please enter the country';

if (empty($_POST['state_modal_recipient_address']))

    $errors['state'] = 'Please enter the state';

if (empty($_POST['city_modal_recipient_address']))

    $errors['city'] = 'Please enter the city';

if (empty($_POST['postal_modal_recipient_address']))

    $errors['postal'] = 'Please enter the postal';

if (empty($errors)) {

    $db->cdp_query("
                  INSERT INTO cdb_recipients_addresses 
                  (
                    country,
                    state,
                    city,
                    address,
                    zip_code,
                    recipient_id                                
                  )
                  VALUES 
                  (
                      :country,
                      :state,
                      :city, 
                      :address,
                      :zip_code,
                      :recipient_id                            
                  )
                ");

    $db->bind(':country',  cdp_sanitize($_POST["country_modal_recipient_address"]));
    $db->bind(':state',  cdp_sanitize($_POST["state_modal_recipient_address"]));
    $db->bind(':city',  cdp_sanitize($_POST["city_modal_recipient_address"]));
    $db->bind(':address',  cdp_sanitize($_POST["address_modal_recipient_address"]));
    $db->bind(':zip_code',  cdp_sanitize($_POST["postal_modal_recipient_address"]));
    $db->bind(':recipient_id',  $_GET["recipient"]);

    $insert = $db->cdp_execute();

    $last_address_id = $db->dbh->lastInsertId();

    $db->cdp_query("SELECT * FROM cdb_recipients_addresses where id_addresses= '" . $last_address_id . "'");
    $customer_address = $db->cdp_registro();

    if ($insert) {

        $messages[] = "Address added successfully!";
    } else {

        $errors['critical_error'] = "the registration was not completed";
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
            $("#add_address_recipients_from_modal_shipments")[0].reset();
        </script>
    </div>

    <script>
        var data_address = {
            id: <?php echo $customer_address->id_addresses; ?>,
            text: "<?php echo $customer_address->address; ?>"
        };

        var newOption = new Option(data_address.text, data_address.id, false, false);

        $('#recipient_address_id').append(newOption).trigger('change');
        $('#recipient_address_id').val(data_address.id).trigger('change');
    </script>

<?php
}
?>