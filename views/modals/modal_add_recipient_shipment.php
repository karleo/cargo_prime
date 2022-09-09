	<!-- Modal -->
	<div class="modal fade" id="myModalAddRecipient" role="dialog" aria-labelledby="modal_add_user_title">
	    <div class="modal-dialog modal-lg" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h4 class="modal-title" id="modal_add_user_title">Add Recipient</h4>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	            </div>
	            <div class="modal-body">
	                <form class="form-horizontal" method="post" id="add_recipient_from_modal_shipments" name="add_recipient_from_modal_shipments">

	                    <div class="row">
	                        <div class="col-md-6">
	                            <div class="form-group">
	                                <label for="emailAddress1"><?php echo $lang['user_manage6'] ?></label>
	                                <input type="text" class="form-control" name="fname_recipient" id="fname_recipient" placeholder="<?php echo $lang['user_manage6'] ?>">
	                            </div>
	                        </div>
	                        <div class="col-md-6">
	                            <div class="form-group">
	                                <label for="phoneNumber1"><?php echo $lang['user_manage7'] ?></label>
	                                <input type="text" class="form-control" name="lname_recipient" id="lname_recipient" placeholder="<?php echo $lang['user_manage7'] ?>">
	                            </div>
	                        </div>
	                    </div>

	                    <div class="row">
	                        <div class="col-md-6">
	                            <div class="form-group">
	                                <label for="emailAddress1"><?php echo $lang['user_manage5'] ?></label>
	                                <input type="text" class="form-control" id="email_recipient" name="email_recipient" placeholder="<?php echo $lang['user_manage5'] ?>">
	                            </div>
	                        </div>

	                        <div class="col-md-6">
	                            <div class="form-group">
	                                <label for="phoneNumber1"><?php echo $lang['user_manage9'] ?></label>
	                                <br>
	                                <input type="tel" class="form-control" name="phone_custom_recipient" id="phone_custom_recipient">

	                                <span id="valid-msg" class="hide"></span>
	                                <div id="error-msg" class="hide text-danger"></div>
	                            </div>
	                        </div>
	                    </div>

	                    <hr>
	                    <h4><?php echo $lang['laddress'] ?> </h4>

	                    <div class="row">
	                        <div class="col-md-4">
	                            <div class="form-group">
	                                <label>Country</label>
	                                <select style="width: 100% !important;" class="select2 form-control" name="country_modal_recipient" id="country_modal_recipient">
	                                </select>
	                            </div>
	                        </div>

	                        <div class="col-md-4">
	                            <div class="form-group">
	                                <label class="">State</label>
	                                <select style="width: 100% !important;" disabled class="select2 form-control" id="state_modal_recipient" name="state_modal_recipient">
	                                </select>
	                            </div>
	                        </div>

	                        <div class="col-md-4">
	                            <div class="form-group">
	                                <label class="">City</label>
	                                <select style="width: 100% !important;" disabled class="select2 form-control" id="city_modal_recipient" name="city_modal_recipient">
	                                </select>
	                            </div>
	                        </div>

	                        <div class="col-md-4">
	                            <div class="form-group">
	                                <label for="phoneNumber1"><?php echo $lang['user_manage14'] ?></label>
	                                <input type="text" class="form-control" name="postal_modal_recipient" id="postal_modal_recipient" placeholder="<?php echo $lang['user_manage14'] ?>">
	                            </div>
	                        </div>

	                        <div class="col-md-4">
	                            <div class="form-group">
	                                <label for="phoneNumber1"><?php echo $lang['user_manage10'] ?></label>
	                                <input type="text" class="form-control" name="address_modal_recipient" id="address_modal_recipient" placeholder="<?php echo $lang['user_manage10'] ?>">
	                            </div>
	                        </div>
	                    </div>

	                    <input type="hidden" name="total_address_recipient" id="total_address_recipient" value="1" />
	                    <input type="hidden" name="phone_recipient" id="phone_recipient" />

	            </div>
	            <div class="modal-footer">
	                <button type="submit" class="btn btn-success" id="save_data_recipient">Save</button>
	                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	            </div>
	            </form>
	        </div>
	    </div>
	</div>