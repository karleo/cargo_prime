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



require_once("../helpers/querys.php");

require_once("../loader.php");
$user = new User;
$db = new Conexion;
$userData = $user->cdp_getUserData();

$dias_ = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
$meses_ = array('01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec');

$sWhere = "";


$sWhere .= " and a.user_id ='" . $_SESSION['userid'] . "'";


$db->cdp_query("

		SELECT b.user_id,  a.user_id, b.shipping_type,  a.id_notifi_user, b.notification_description, b.notification_date , b.order_id , a.notification_status, a.notification_read, b.notification_id

		FROM cdb_notifications_users as a

		INNER JOIN cdb_notifications as b ON a.notification_id = b.notification_id

		WHERE a.notification_read ='0'

		$sWhere

		-- GROUP BY  a.notification_id
		order by b.notification_id desc


	");


$db->cdp_execute();

$data = $db->cdp_registros();
$rowCount = $db->cdp_rowCount();


if ($rowCount > 0) {

    $bg = 'bg-primary';
} else {

    $bg = 'bg-danger';
}

?>


<ul class="list-style-none">
    <li>
        <div class="drop-title  text-white	<?php echo $bg; ?>">
            <h4 class="m-b-0 m-t-5"><?php echo $rowCount; ?></h4>
            <span class="font-light">Notifications</span>
        </div>
    </li>

    <li>
        <div class="message-center notifications" id="messages">

            <?php

            if ($rowCount > 0) {

                foreach ($data as $key) {

                    $fecha = strtotime($key->notification_date);
                    $anio = date("Y", $fecha);
                    $mes = date("m", $fecha);
                    $dia = date("d", $fecha);
                    $hora = date("h", $fecha);
                    $minuto = date("i", $fecha);
                    $segundo = date("s", $fecha);


                    $href = '';

                    switch ($key->shipping_type) {
                        case '1':
                            # code...
                            $href = 'courier_view.php?id=' . $key->order_id . '&id_notification=' . $key->notification_id;

                            break;

                        case '2':
                            # code...
                            $href = 'consolidate_view.php?id=' . $key->order_id . '&id_notification=' . $key->notification_id;

                            break;

                        case '3':
                            # code...
                            $href = 'prealert_list.php?id_notification=' . $key->notification_id;

                            break;

                        case '4':
                            # code...
                            $href = 'customer_packages_view.php?id=' . $key->order_id . '&id_notification=' . $key->notification_id;

                            break;



                        default:
                            # code...
                            $href = 'users_edit.php?user=' . $key->user_id;

                            break;
                    }

            ?>

                    <!-- Message -->
                    <a href="<?php echo $href; ?>" class="message-item">
                        <span><i class="mdi mdi-bell font-18"></i></span>

                        <span class="mail-contnet">
                            <h6 class="message-title"><?php echo $key->notification_description; ?></h6> <span class="mail-desc"> </span> <span class="time">
                                <?php echo $meses_[$mes] . ' ' . $dia . ', ' . $anio . ' ' . $hora . ':' . $minuto . ':' . $segundo;  ?>
                            </span>
                        </span>
                    </a>


            <?php

                    if ($key->notification_status == 0) {

                        echo "<script> 
					$('#clickme').click();

					$('#chatAudio')[0].play();
					// var fullName = $('#name').val();
					// $(document).prop('title', fullName+ 'AJfffdasdas Te ha enviado un mensaje');

					</script>";

                        cdp_updateNotificationStatus($_SESSION['userid'], $key->notification_id);
                    }
                }
            }

            ?>

        </div>
    </li>

    <li>
        <a class="nav-link text-center m-b-5" href="notifications_list.php"> <strong style="color: black">Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
    </li>
</ul>

<input type="hidden" id="countNotificationsInput" value="<?php echo $rowCount; ?>">
<input type="hidden" id="lengthScroll" value="0">
<input type="hidden" id="currentScroll" value="0">

<script>
    $('#countNotifications').html('<?php echo $rowCount; ?>');

    var count = $('#countNotificationsInput').val();

    if (count > 0) {

        $('#countNotifications').addClass('bg-danger text-white');

    } else {

        $('#countNotifications').removeClass('bg-danger');

    }
</script>

<script>
    $("#messages").on('scroll', function() {
        currentScroll = $('#messages').scrollTop();
        $('#currentScroll').val(currentScroll);

        console.log(currentScroll);
    });
</script>