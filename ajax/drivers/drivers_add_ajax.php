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
require_once("../../helpers/phpmailer/class.phpmailer.php");
require_once("../../helpers/phpmailer/class.smtp.php");

$user = new User;
$core = new Core;
$errors = array();

if (empty($_POST['username']))

    $errors['username'] = 'Enter a valid username';

if ($value = $user->cdp_usernameExists($_POST['username']))

    if ($value == 1)

        $errors['username'] = 'Username is too short (less than 4 characters long).';

if ($value == 2)

    $errors['username'] = 'Invalid characters found in the username.';

if ($value == 3)
    $errors['username'] = 'Sorry, this username is already taken';



if (empty($_POST['fname']))

    $errors['fname'] = 'Please enter the name';
if (empty($_POST['lname']))

    $errors['lname'] = 'Please enter the last name';

if (empty($_POST['password']))

    $errors['password'] = 'Enter a valid password.';

if (empty($_POST['email']))

    $errors['email'] = 'Enter a valid email address';

if ($user->cdp_emailExists($_POST['email']))

    $errors[] = 'The email address you entered is already in use.';

if (!$user->cdp_isValidEmail($_POST['email']))

    $errors[] = 'The email address you entered is invalid.';

if (empty($_POST['phone']))

    $errors['phone'] = 'Please enter the phone';



if (!empty($_FILES['avatar']['name'])) {

    $target_dir = "../../assets/uploads/";
    $image_name = time() . "_" . basename($_FILES["avatar"]["name"]);
    $target_file = $target_dir . $image_name;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    $imageFileZise = $_FILES["avatar"]["size"];

    if (($imageFileType != "jpg" && $imageFileType != "png")) {

        $errors['avatar'] = "<p>Illegal file type. Only jpg and png file types are allowed..</p>";
    } else if (empty(getimagesize($_FILES['avatar']['tmp_name']))) { //1048576 byte=1MB

        $errors['avatar'] = "<p>Illegal file type. Only jpg and png file types are allowed.";
    }
}

if (empty($errors)) {

    $data = array(
        'enrollment' => cdp_sanitize($_POST['enrollment']),
        'vehiclecode' => cdp_sanitize($_POST['vehiclecode']),
        'username' => cdp_sanitize($_POST['username']),
        'email' => cdp_sanitize($_POST['email']),
        'lname' => cdp_sanitize($_POST['lname']),
        'fname' => cdp_sanitize($_POST['fname']),
        'newsletter' => intval($_POST['newsletter']),
        'notes' => cdp_sanitize($_POST['notes']),
        'phone' => cdp_sanitize($_POST['phone']),
        'gender' => cdp_sanitize($_POST['gender']),
        'userlevel' => 3,
        'locker' => cdp_sanitize($_POST['locker']),
        'active' => cdp_sanitize($_POST['active'])
    );

    if ($_POST['password'] != "") {

        $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }

    $data['avatar'] = '';


    $data['created'] = date("Y-m-d H:i:s");


    if (!empty($_FILES['avatar']['name'])) {

        move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
        $imagen = basename($_FILES["avatar"]["name"]);
        $data['avatar'] = 'uploads/' . $image_name;
    }

    $insert = cdp_insertDrivers1fcoe($data);

    $recipient_id = $db->dbh->lastInsertId();

    if ($insert) {

        $messages[] = "Driver added successfully!";
    } else {

        $errors['critical_error'] = "the registration was not completed";
    }



    if (isset($_POST['notify']) && $_POST['notify'] == 1) {
        $email_template = cdp_getEmailTemplatesdg1i4(3);

        $body = str_replace(
            array(
                '[USERNAME]',
                '[PASSWORD]',
                '[NAME]',
                '[SITE_NAME]',
                '[URL]'
            ),
            array(
                cdp_sanitize($_POST['username']),
                cdp_sanitize($_POST['password']),
                cdp_sanitize($_POST['fname']) . ' ' . cdp_sanitize($_POST['lname']),
                $core->site_name,
                $core->site_url
            ),
            $email_template->body
        );


        $newbody = cdp_cleanOut($body);



        //SENDMAIL PHP

        if ($core->mailer == 'PHP') {


            /*SIGUE RECOLECTANDO DATOS PARA FUNCION MAIL*/
            $message = $newbody;
            $websiteName = $core->site_name;
            $emailAddress = $core->site_email;
            $header = "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html; charset=iso-8859-1\r\n";
            $header .= "From: " . $websiteName . " <" . $emailAddress . ">\r\n";
            $subject = $email_template->subject;
            mail(cdp_sanitize($_POST['email']), $subject, $message, $header);
            /*FINALIZA RECOLECTANDO DATOS PARA FUNCION MAIL*/
        } elseif ($core->mailer == 'SMTP') {


            //PHPMAILER PHP


            $destinatario = "" . cdp_sanitize($_POST['email']) . "";


            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->Port = $core->smtp_port;
            $mail->IsHTML(true);
            $mail->CharSet = "utf-8";

            // Datos de la cuenta de correo utilizada para enviar vía SMTP
            $mail->Host = $core->smtp_host;       // Dominio alternativo brindado en el email de alta
            $mail->Username = $core->smtp_user;    // Mi cuenta de correo
            $mail->Password = $core->smtp_password;    //Mi contraseña


            $mail->From = $core->site_email; // Email desde donde envío el correo.
            $mail->FromName = $core->smtp_names;
            $mail->AddAddress($destinatario); // Esta es la dirección a donde enviamos los datos del formulario

            $mail->Subject = $email_template->subject; // Este es el titulo del email.
            $mail->Body = "<html> 
                  
                  <body> 
                  
                  <p>{$newbody}</p>
                  
                  </body> 
                  
                  </html>
                  
                  <br />"; // Texto del email en formato HTML
            // FIN - VALORES A MODIFICAR //

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $estadoEnvio = $mail->Send();
        }
    }
}


if (!empty($errors)) {
    // var_dump($errors);
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