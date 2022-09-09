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

if (empty($_POST['fname']))

    $errors['fname'] = 'Please enter the name';
if (empty($_POST['lname']))

    $errors['lname'] = 'Please enter the last name';

if (empty($_POST['phone_custom']))

    $errors['phone_custom'] = 'Please enter the phone';

if (empty($_POST['address_modal_user']))

    $errors['address_modal_user'] = 'Please enter the address';

if (isset($_POST['register_customer_to_user']) && $_POST['register_customer_to_user'] == 1) {


    if (empty($_POST['password']))

        $errors['password'] = 'Enter a valid password.';


    if (empty($_POST['username']))

        $errors['username'] = 'Enter a valid username';

    if ($value = $user->cdp_usernameExists($_POST['username']))

        if ($value == 1)

            $errors['username'] = 'Username is too short (less than 4 characters long).';

    if ($value == 2)

        $errors['username'] = 'Invalid characters found in the username.';

    if ($value == 3)
        $errors['username'] = 'Sorry, this username is already taken';
}

if (empty($errors)) {

    $data = array(
        'lname' => cdp_sanitize($_POST['lname']),
        'fname' => cdp_sanitize($_POST['fname']),
        'phone' => cdp_sanitize($_POST['phone']),
        'email' => cdp_sanitize($_POST['email']),
        'userlevel' => '1',
        'active' => '1',
        'locker' => '',
        'username' => '',
        'password' => '',
        'created' => date("Y-m-d H:i:s"),
    );

    if (isset($_POST['register_customer_to_user']) && $_POST['register_customer_to_user'] == 1) {

        $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $data['username'] = cdp_sanitize($_POST['username']);

        $data['locker'] = cdp_generarCodigo(6);
    }

    $db->cdp_query('INSERT INTO cdb_users
              (   
                  username,
                  password,
                  locker,
                  userlevel,
                  email,
                  fname,
                  lname,
                  created,
                  phone,
                  active
              )

              VALUES (
                  :username,
                  :password,
                  :locker,
                  :userlevel,
                  :email,
                  :fname,
                  :lname,
                  :created,           
                  :phone,
                  :active
              )');

    $db->bind(':userlevel', $data['userlevel']);
    $db->bind(':locker', $data['locker']);
    $db->bind(':email', $data['email']);
    $db->bind(':fname', $data['fname']);
    $db->bind(':lname', $data['lname']);
    $db->bind(':phone', $data['phone']);
    $db->bind(':active', $data['active']);
    $db->bind(':username', $data['username']);
    $db->bind(':password', $data['password']);
    $db->bind(':created', $data['created']);

    $db->cdp_execute();

    $recipient_id = $db->dbh->lastInsertId();

    $db->cdp_query("SELECT * FROM cdb_users where id= '" . $recipient_id . "'");
    $customer_data = $db->cdp_registro();

    $db->cdp_query("
                  INSERT INTO cdb_senders_addresses 
                  (
                    country,
                    state,
                    city,
                    zip_code,
                    address,
                    user_id                                 
                  )
                  VALUES 
                  (
                    :country,
                    :state,
                    :city, 
                    :zip_code,
                    :address,
                    :user_id                            
                  )
                ");


    $db->bind(':user_id',  $recipient_id);
    $db->bind(':address',  cdp_sanitize($_POST["address_modal_user"]));
    $db->bind(':country',  cdp_sanitize($_POST["country_modal_user"]));
    $db->bind(':state',  cdp_sanitize($_POST["state_modal_user"]));
    $db->bind(':city',  cdp_sanitize($_POST["city_modal_user"]));
    $db->bind(':zip_code',  cdp_sanitize($_POST["postal_modal_user"]));

    $insert = $db->cdp_execute();

    $last_address_id = $db->dbh->lastInsertId();

    $db->cdp_query("SELECT * FROM cdb_senders_addresses where id_addresses= '" . $last_address_id . "'");
    $customer_address = $db->cdp_registro();


    if ($insert) {

        $messages[] = "User added successfully!";
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
            $("#add_user_from_modal_shipments")[0].reset();
        </script>
    </div>
    <script>
        var data = {
            id: <?php echo $customer_data->id; ?>,
            text: "<?php echo $customer_data->fname . ' ' . $customer_data->lname; ?>"
        };

        var newOption = new Option(data.text, data.id, false, false);

        $('#sender_id').append(newOption).trigger('change');
        $('#sender_id').val(data.id).trigger('change');

        var data_address = {
            id: <?php echo $customer_address->id_addresses; ?>,
            text: "<?php echo $customer_address->address; ?>"
        };

        var newOption = new Option(data_address.text, data_address.id, false, false);

        $('#sender_address_id').append(newOption).trigger('change');
        $('#sender_address_id').val(data_address.id).trigger('change');

        $("#recipient_address_id").attr("disabled", true);

        $("#add_address_recipient").attr("disabled", true);

        $("#recipient_id").val(null).trigger('change');
        $("#recipient_address_id").val(null).trigger('change');
    </script>

<?php
}
?>