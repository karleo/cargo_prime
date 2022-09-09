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



require_once("../loader.php");
require_once("../helpers/querys.php");
require_once("../helpers/phpmailer/class.phpmailer.php");
require_once("../helpers/phpmailer/class.smtp.php");

$user = new User;
$core = new Core;

$errors = array();

if (empty($_POST['email']))

  $errors['email'] = 'Enter a valid email address';

if (!$user->cdp_emailExists($_POST['email']))

  $errors['email'] = 'The email address you entered does not exist.';

if (!$user->cdp_isValidEmail($_POST['email']))

  $errors['email'] = 'The email address you entered is invalid.';



if (empty($errors)) {


  $user_email = cdp_sanitize($_POST["email"]);

  $verify = cdp_verifyEmailt1xle($user_email);

  if ($verify) {
    //Generar pass aleatorio
    $possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";

    $maxlength = strlen($possible);

    $length = 8;

    $i = 0;

    $password = "";

    while ($i < $length) {
      // elige un caracter al azar de los posibles
      $char = substr($possible, mt_rand(0, $maxlength - 1), 1);

      //¿Ya hemos usado este carácter en $ contraseña?
      if (!strstr($password, $char)) {
        // no, así que está bien agregarlo al final de lo que ya tenemos ...
        $password .= $char;
        // . y aumentar el contador en uno
        $i++;
      }
    }

    $user_password = $password;

    $datos = [
      'password' => password_hash($user_password, PASSWORD_DEFAULT),
      'email' => $user_email
    ];

    $update = cdp_updatePassword5glmh($datos);

    $email_template = cdp_getEmailTemplatesdg1i4(2);

    $user_emailData = cdp_getUserForEmail($user_email);


    $body = str_replace(
      array(
        '[USERNAME]',
        '[PASSWORD]',
        '[URL]',
        '[LINK]',
        '[URL_LINK]',
        '[IP]',
        '[SITE_NAME]'
      ),
      array(
        $user_emailData->username,
        $user_password,
        $core->site_url,
        $core->site_url,
        $core->logo,
        $_SERVER['REMOTE_ADDR'],
        $core->site_name
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
      mail($user_email, $subject, $message, $header);
      /*FINALIZA RECOLECTANDO DATOS PARA FUNCION MAIL*/

      if ($update) {

        $messages[] = "You have successfully changed your password. Please check your email for more information!";
      } else {

        $errors['critical_error'] = "An error occurred during the registration process. Contact the administrator ...";
      }
    } elseif ($core->mailer == 'SMTP') {


      //PHPMAILER PHP


      $destinatario = $user_email;


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

      $update = $mail->Send();
      if ($update) {

        $messages[] = "You have successfully changed your password. Please check your email for more information!";
      } else {

        $errors['critical_error'] = "An error occurred during the registration process. Contact the administrator ...";
      }
    }
  }
}


if (!empty($errors)) {
?>
  <div class="alert alert-danger" id="success-alert">
    <p><span class="icon-minus-sign"></span><i class="close icon-remove-circle"></i>
      <span>Error! </span> There was an error processing the request <br>
      <?php
      foreach ($errors as $error) { ?>

        <?php
        echo $error . "<br>";

        ?>


      <?php

      }
      ?>


    </p>
  </div>



<?php
}

if (isset($messages)) {

?>

  <div class="alert alert-success" id="success-alert">
    <p><span class="icon-minus-sign"></span><i class="close icon-remove-circle"></i>
      <span>Success!</span>
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