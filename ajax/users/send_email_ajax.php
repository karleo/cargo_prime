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
$db = new Conexion;

$errors = array();

if (empty($_POST['subject']))
  $errors['subject'] = "Please Enter Newsletter Subject";

if (empty($_POST['body']))
  $errors['body'] = "Please Enter Email Message!";




if (empty($errors)) {

  $to = '';
  $subject = cdp_sanitize($_POST['subject']);
  $body = cdp_cleanOut($_POST['body']);


  switch ($to) {
    case "all":

      $db->cdp_query("SELECT email, CONCAT(fname,' ',lname) as name FROM cdb_users  WHERE id != 1");

      $db->cdp_execute();

      $userrow = $db->cdp_registros();

      $replacements = array();


      $array = array();

      foreach ($userrow as $cols) {
        $replacements[$cols->email] = array('[NAME]' => $cols->name, '[SITE_NAME]' => $core->site_name, '[URL]' => $core->site_url);
      }

      $body = str_replace(
        array(
          '[NAME]',
          '[URL]',
          '[SITE_NAME]'
        ),
        array(
          "",
          $core->site_url,
          $core->site_name
        ),
        $body
      );



      foreach ($userrow as $user) {

        array_push($array, $user->email);
      }



      //SENDMAIL PHP

      if ($core->mailer == 'PHP') {

        /*SIGUE RECOLECTANDO DATOS PARA FUNCION MAIL*/
        $message = $body;
        $websiteName = $core->site_name;
        $emailAddress = $core->site_email;
        $header = "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $header .= "From: " . $websiteName . " <" . $emailAddress . ">\r\n";
        $subject = $subject;
        $mail_send = mail(cdp_email_users_notifications($array), $subject, $message, $header);
        /*FINALIZA RECOLECTANDO DATOS PARA FUNCION MAIL*/
      } elseif ($core->mailer == 'SMTP') {


        //PHPMAILER PHP

        $message = $body;
        $destinatario = cdp_email_users_notifications($array);


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

        $mail->Subject = $subject; // Este es el titulo del email.
        $mail->Body = "<html> 
                  
                  <body> 
                  
                  <p>{$message}</p>
                  
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


        $mail_send = $mail->Send();
      }




      break;

    case "newsletter":

      $db->cdp_query("SELECT email, CONCAT(fname,' ',lname) as name FROM cdb_users WHERE newsletter = '1' AND id != 1");

      $db->cdp_execute();

      $userrow = $db->cdp_registros();

      $replacements = array();
      $array = array();


      foreach ($userrow as $cols) {
        $replacements[$cols->email] = array('[NAME]' => $cols->name, '[SITE_NAME]' => $core->site_name, '[URL]' => $core->site_url);
      }

      $body = str_replace(
        array(
          '[NAME]',
          '[URL]',
          '[SITE_NAME]'
        ),
        array(
          "",
          $core->site_url,
          $core->site_name
        ),
        $body
      );



      foreach ($userrow as $user) {

        array_push($array, $user->email);
      }


      //SENDMAIL PHP

      if ($core->mailer == 'PHP') {


        /*SIGUE RECOLECTANDO DATOS PARA FUNCION MAIL*/
        $message = $body;
        $websiteName = $core->site_name;
        $emailAddress = $core->site_email;
        $header = "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $header .= "From: " . $websiteName . " <" . $emailAddress . ">\r\n";
        $subject = $subject;
        $mail_send = mail(cdp_email_users_notifications($array), $subject, $message, $header);
        /*FINALIZA RECOLECTANDO DATOS PARA FUNCION MAIL*/
      } elseif ($core->mailer == 'SMTP') {


        //PHPMAILER PHP

        $message = $body;
        $destinatario = cdp_email_users_notifications($array);


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

        $mail->Subject = $subject; // Este es el titulo del email.
        $mail->Body = "<html> 
                  
                  <body> 
                  
                  <p>{$message}</p>
                  
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


        $mail_send = $mail->Send();
      }




      break;

    default:

      $db->cdp_query("SELECT email, CONCAT(fname,' ',lname) as name FROM cdb_users WHERE email LIKE '%" . trim($to) . "%'");

      $db->cdp_execute();

      $userrow = $db->cdp_registro();


      $body = str_replace(
        array(
          '[NAME]',
          '[URL]',
          '[SITE_NAME]'
        ),
        array(
          $userrow->name,
          $core->site_url,
          $core->site_name
        ),
        $body
      );

      //SENDMAIL PHP

      if ($core->mailer == 'PHP') {

        /*SIGUE RECOLECTANDO DATOS PARA FUNCION MAIL*/
        $message = $body;
        $websiteName = $core->site_name;
        $emailAddress = $core->site_email;
        $header = "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $header .= "From: " . $websiteName . " <" . $emailAddress . ">\r\n";
        $subject = $subject;
        $mail_send = mail($userrow->email, $subject, $message, $header);
        /*FINALIZA RECOLECTANDO DATOS PARA FUNCION MAIL*/
      } elseif ($core->mailer == 'SMTP') {


        //PHPMAILER PHP

        $message = $body;
        $destinatario = $userrow->email;


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

        $mail->Subject = $subject; // Este es el titulo del email.
        $mail->Body = "<html> 
                  
                  <body> 
                  
                  <p>{$message}</p>
                  
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


        $mail_send = $mail->Send();
      }

      break;
  }


  if ($mail_send) {

    $messages[] = "All Email(s) have been sent successfully!";
  } else {

    $errors['critical_error'] = "Some of the emails could not be reached!";
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