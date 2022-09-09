	<!-- Modal -->

    <?php $driverrow = $user->cdp_userAllDriver();?>

	<div class="modal fade" id="modalDriver" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Edit shipping driver</h4>
		  		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
		  <div class="modal-body">
		  	<form class="form-horizontal" method="post" id="driver_update" name="driver_update">

			<div class="resultados_ajax_mail text-center"></div>
			  
			  <div class="row">
				<div class="col-sm-12">
				<label for="sendto" class="control-label"><?php echo $lang['left208'] ?></label>

				<div class="input-group">          

				<input type="hidden" name="id_shipment" id="id_shipment">                             
				<input type="hidden" name="id_senderclient_driver_update" id="id_senderclient_driver_update">                             
                    <select class="form-control custom-select" id="driver_id" name="driver_id" required>
                    
                    <option value="0">--<?php echo $lang['left209'] ?>--</option>
                    <?php foreach ($driverrow as $row):?>                                            
                    <option value="<?php echo $row->id; ?>"><?php echo $row->fname.' '.$row->lname; ?></option>
                        
                        <?php endforeach;?>
                    </select>
                </div>	
				
				</div>
			  </div>			  	
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			<button type="submit" class="btn btn-success" id="update_driver">Update</button>
		  </div>
		</form>
		</div>
	  </div>
	</div>