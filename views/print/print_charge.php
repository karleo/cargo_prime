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



require_once('helpers/querys.php');

if (isset($_GET['id'])) {
    $data = cdp_getChargePrint($_GET['id']);
}



$row = $data['data'];

$db->cdp_query("SELECT * FROM cdb_add_order WHERE order_id='" . $row->order_id . "'");
$row_order = $db->cdp_registro();


$db->cdp_query("SELECT * FROM cdb_users where id= '" . $row_order->sender_id . "'");
$sender_data = $db->cdp_registro();


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <title>Charge - #<?php echo $row->id_charge; ?></title>

    <link type='text/css' href='assets/custom_dependencies/print.css' rel='stylesheet' />

</head>

<body>
    <div id="page-wrap">
        <table width="100%">
            <tr>
                <td style="border: 0;  text-align: left" width="18%">
                    <div id="logo">

                        <?php echo ($core->logo) ? '<img src="assets/' . $core->logo . '" alt="' . $core->site_name . '" width="' . $core->thumb_w . '" height="' . $core->thumb_h . '"/>' : $core->site_name; ?>
                </td>
                <td style="border: 0;  text-align: center" width="56%">
                    <?php echo $lang['inv-shipping1'] ?>: <?php echo $core->c_nit; ?> </br>
                    <?php echo $lang['inv-shipping2'] ?>: <?php echo $core->c_phone; ?></br>
                    <?php echo $lang['inv-shipping3'] ?>: <?php echo $core->site_email; ?></br>
                    <?php echo $lang['inv-shipping4'] ?>: <?php echo $core->c_address; ?> - <?php echo $core->c_country; ?>-<?php echo $core->c_city; ?>
                </td>
                <td style="border: 0;  text-align: center" width="48%">
                    </br><img src='https://barcode.tec-it.com/barcode.ashx?data=<?php echo $row->id_charge; ?>&code=Code128&multiplebarcodes=false&translate-esc=false&unit=Fit&dpi=72&imagetype=Gif&rotation=0&color=%23000000&bgcolor=%23ffffff&qunit=Mm&quiet=0&modulewidth=50' alt='' />
                </td>
    </div>
    </tr>
    </table>
    <hr>
    </br>
    <div id="customer">

        <table id="meta">
            <tr>
                <td rowspan="5" style="border: 1px solid black;   text-align: left" width="62%">

                    <strong>DATE:</strong>
                    <?php echo $row->charge_date; ?></br> </br>

                    <strong>RECEIVED FROM:</strong>
                    <?php echo $sender_data->fname . " " . $sender_data->lname; ?></br> </br>

                    <strong>THE SUM OF:</strong>
                    <?php echo cdb_money_format($row->total); ?> </br></br>

                    <strong>IN CONCEPT OF:</strong> payment to shipping <b><?php echo $row_order->order_prefix . $row_order->order_no; ?></b>

                    <?php if ($row->note != null) { ?>


                        <br>
                        <br>
                        <br>


                        <strong>Note:</strong>
                        <?php echo $row->note; ?></br> </br>

                    <?php } ?>
                </td>

            </tr>

        </table>
    </div>


    <!--    end related transactions -->

    <div id="terms">
        <table style="width: 100%;border: 1px solid black; border-radius: 30px">
            <tr>
                <td>
                    <p align="justify">This voucher is valid without amendments or erasures and must have the signature and stamp of the authorized person.</p>
                </td>
            </tr>

        </table>
        </br></br></br>
        <table id="signing">
            <tr class="noBorder">
                <td align="center">
                    <h4></h4>
                </td>
                <td align="center">
                    <h4></h4>
                </td>
                <td align="center">
                    <h4></h4>
                </td>
            </tr>
            <tr class="noBorder">
                <td align="center">Made by</td>
                <td align="center">Received</td>
                <td align="center">Authorized</td>
            </tr>


        </table>
    </div>
    <button class='button -dark center no-print' onClick="window.print();" style="font-size:16px">Print receipt of payment &nbsp;&nbsp; <i class="fa fa-print"></i></button>
    </div>

</body>

</html>