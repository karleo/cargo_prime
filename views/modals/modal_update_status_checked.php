
<?php
	$statusrow = $core->cdp_getStatus(); 
?>
	<!-- Modal -->
	<div class="modal fade" id="modalCheckboxStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Edit Shipments Statuses</h4>
		  		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
		  <div class="modal-body">
		  	<form class="form-horizontal" method="post" id="send_checkbox_status" name="send_checkbox_status">

			<div class="resultados_ajax_mail text-center"></div>
			  
			  <div class="row">
				<div class="col-sm-12">
				<label for="sendto" class="control-label">Status</label>

				<div class="input-group">                                       
                    <select class="form-control custom-select" id="status_courier_modal" name="status_courier_modal" required>
                    <option value="">--<?php echo $lang['left210'] ?>--</option>
                    <?php foreach ($statusrow as $row):

                    	if($row->id!=8){?>   

                        <option value="<?php echo $row->id; ?>"><?php echo $row->mod_style; ?></option>
                        
                        <?php 
                    }

                    endforeach;?>
                    </select>
                </div>	
				
				</div>
			  </div>			  	
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			<button type="submit" class="btn btn-success" id="guardar_datos">Update</button>
		  </div>
		</form>
		</div>
	  </div>
	</div>