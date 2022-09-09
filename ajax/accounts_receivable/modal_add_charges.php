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

$db = new Conexion;
$user = new User;
$core = new Core;
$userData = $user->cdp_getUserData();

$payrow = $core->cdp_getPayment();

$order_id = intval($_REQUEST['id']);

$sWhere = "";

if ($order_id > 0) {

	$sWhere .= " where order_id = '" . $order_id . "'";
}


$sql = "SELECT * FROM cdb_add_order 
			$sWhere
			
			 order by order_id desc 
			 ";


$db->cdp_query($sql);
$data = $db->cdp_registro();

$sql_customer = "SELECT * FROM cdb_users where id= '" . $data->sender_id . "'			
			 ";


$db->cdp_query($sql_customer);
$customer = $db->cdp_registro();


$db->cdp_query('SELECT  IFNULL(sum(total), 0)  as total  FROM cdb_charges_order WHERE order_id=:order_id');

$db->bind(':order_id', $data->order_id);

$db->cdp_execute();

$sum_payment = $db->cdp_registro();

$pendiente = $data->total_order - $sum_payment->total;

?>


<div class="row">

	<div class="form-group col-sm-6">
		<label for="sendto" class="control-label">Tracking</label>

		<input type="tracking" class="form-control" id="tracking" name="tracking" placeholder="" readonly required value="<?php echo $data->order_prefix . $data->order_no; ?>">
	</div>

	<div class="form-group col-sm-6">
		<label for="customers" class="control-label">Customer</label>

		<input type="text" class="form-control" id="customers" name="customers" placeholder="" readonly required value="<?php echo $customer->fname . ' ' . $customer->lname; ?>">
	</div>
</div>
<input type="hidden" name="order_id_alone" id="order_id_alone" value="<?php echo $order_id; ?>">


<div class="row">
	<div class="form-group col-sm-6">
		<label for="amount" class="control-label">Total Amount</label>

		<input type="number" class="form-control" id="amount" name="amount" placeholder="" readonly required value="<?php echo $data->total_order; ?>">
	</div>
	<div class="form-group col-sm-6">
		<label for="balance" class="control-label">Balance</label>

		<input type="number" class="form-control" id="balance" name="balance" placeholder="" readonly required value="<?php echo $pendiente; ?>">
	</div>
</div>


<div class="row">
	<div class="form-group col-sm-12">
		<label for="total_pay" class="control-label">Total to pay</label>

		<input type="text" onkeypress="return cdp_soloNumeros(event)" class="form-control" id="total_pay" name="total_pay" placeholder="" required>
	</div>
</div>

<div class="row">

	<div class="form-group col-md-12">
		<label for="inputEmail3" class="control-label col-form-label"><?php echo $lang['left243'] ?></label>
		<div class="input-group mb-3">
			<select class="custom-select col-12" id="mode_pay" name="mode_pay" required="">
				<option value=""><?php echo $lang['left243'] ?></option>
				<?php foreach ($payrow as $row) : ?>
					<option value="<?php echo $row->id; ?>"><?php echo $row->name_pay; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>
</div>

<div class="row">
	<div class="form-group col-sm-12">
		<label for="notes" class="control-label">notes</label>

		<textarea class="form-control" id="notes" name="notes" rows="2"></textarea>
	</div>
</div>