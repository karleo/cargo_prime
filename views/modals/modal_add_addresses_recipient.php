	<!-- Modal -->
	<div class="modal fade" id="myModalAddRecipientAddresses" role="dialog" aria-labelledby="modal_add_address_title">
	    <div class="modal-dialog modal-lg" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h4 class="modal-title">Add recipient address</h4>
	                <button type=" button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	            </div>
	            <div class="modal-body">
	                <form class="form-horizontal" method="post" id="add_address_recipients_from_modal_shipments" name="add_address_recipients_from_modal_shipments">
	                    <div class="resultados_ajax_mail text-center"></div>

	                    <div class="row">
	                        <div class="col-md-4">
	                            <div class="form-group">
	                                <label>Country</label>
	                                <select style="width: 100% !important;" class="select2 form-control" name="country_modal_recipient_address" id="country_modal_recipient_address">
	                                </select>
	                            </div>
	                        </div>

	                        <div class="col-md-4">
	                            <div class="form-group">
	                                <label class="">State</label>
	                                <select style="width: 100% !important;" disabled class="select2 form-control" id="state_modal_recipient_address" name="state_modal_recipient_address">
	                                </select>
	                            </div>
	                        </div>

	                        <div class="col-md-4">
	                            <div class="form-group">
	                                <label class="">City</label>
	                                <select style="width: 100% !important;" disabled class="select2 form-control" id="city_modal_recipient_address" name="city_modal_recipient_address">
	                                </select>
	                            </div>
	                        </div>

	                        <div class="col-md-4">
	                            <div class="form-group">
	                                <label for="phoneNumber1"><?php echo $lang['user_manage14'] ?></label>
	                                <input type="text" class="form-control" name="postal_modal_recipient_address" id="postal_modal_recipient_address" placeholder="<?php echo $lang['user_manage14'] ?>">
	                            </div>
	                        </div>

	                        <div class="col-md-4">
	                            <div class="form-group">
	                                <label for="phoneNumber1"><?php echo $lang['user_manage10'] ?></label>
	                                <input type="text" class="form-control" name="address_modal_recipient_address" id="address_modal_recipient_address" placeholder="<?php echo $lang['user_manage10'] ?>">
	                            </div>
	                        </div>
	                    </div>

	            </div>
	            <div class="modal-footer">
	                <button type="submit" class="btn btn-success" id="save_data_address_recipients">Save</button>
	                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	            </div>
	            </form>
	        </div>
	    </div>
	</div>