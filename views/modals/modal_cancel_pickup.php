	<!-- Modal -->
	<div class="modal fade" id="myModalCancel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
				<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-envelope'></i> Cancel pickup</h4>
		  		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="cancel_pickup_form" name="cancel_pickup_form">
			<div class="resultados_ajax_mail text-center"></div>			  
	
			  <div class="row">
				<div class="col-sm-12">
					<label for="message" class="control-label">Reason for cancellation</label>
					 <input type="hidden" class="form-control" id="id_cancel" name="id_cancel" placeholder="" required>				
					<textarea class="form-control" id="message" name="message" rows="4" required></textarea>
				</div>
			  </div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-danger" id="guardar_datos">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>