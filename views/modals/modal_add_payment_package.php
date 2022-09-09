	<!-- Modal -->
	<div class="modal fade" id="add_payment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header">
				<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-envelope'></i> Add charge</h4>
		  		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="add_charges" name="add_charges">
				  	
				<input type="hidden" name="order_id" id="order_id">
				<input type="hidden" name="customer_id" id="customer_id">

			  <div class="row">
				<div class="form-group col-sm-12">
					<label for="total_pay" class="control-label">Total amount</label>
				
				  <input type="text" onkeypress="return cdp_soloNumeros(event)"  class="form-control" id="total_pay" name="total_pay" placeholder="" readonly>
				</div>
			  </div>

			  <div class="row">

				   <div class="form-group col-md-12">
	                    <label for="inputEmail3" class="control-label col-form-label"><?php echo $lang['left243'] ?></label>
	                    <div class="input-group mb-3">                                       
	                        <select class="custom-select col-12" id="mode_pay" name="mode_pay" required="" >
	                         <option value=""><?php echo $lang['left243'] ?></option>
	                        <?php foreach ($payrow as $row):?>
	                            <option value="<?php echo $row->id; ?>"><?php echo $row->name_pay; ?></option>
	                        <?php endforeach;?>
	                        </select>
	                    </div>
	                </div> 
	            </div> 


	            <div class="row mb-3">                                
                    <div class="col-md-12">                             

                       <div>
                            <label class="control-label" id="selectItem" > Attach files</label>
                        </div>

                        <input class="custom-file-input" id="filesMultiple" name="filesMultiple"  type="file"  style="display: none;" onchange="cdp_validateZiseFiles();"/>
                         
                         
                        <button type="button" id="openMultiFile" class="btn btn-info  pull-left "> <i class='fa fa-paperclip' id="openMultiFile" style="font-size:18px; cursor:pointer;"></i> Attach proof of payment</button>

                        <div id="clean_files" class="hide">     
                         <button type="button" id="clean_file_button" class="btn btn-danger ml-3"> <i class='fa fa-trash' style="font-size:18px; cursor:pointer;"></i> Cancel attachments </button>
                        
                        </div>
                    </div>                                
                </div> 

			  <div class="row">
				<div class="form-group col-sm-12">
					<label for="notes" class="control-label">notes</label>
				
					<textarea class="form-control" id="notes" name="notes" rows="2"></textarea>
				</div>
			  </div>
			 
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			<button type="submit" class="btn btn-success" id="save_form2">Save</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>