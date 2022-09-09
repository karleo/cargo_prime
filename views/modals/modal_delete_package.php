	<!-- Modal -->
	<div class="modal fade" id="myModalDeletesPa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
				<h4 class="modal-title" id="myModalLabel"><i class="ti ti-trash" style="color:#FF4000"></i> Delete Courier package</h4>
		  		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="delete_package_form" name="delete_package_form">
			<div class="resultados_ajax_mail text-center"></div>			  
	
			  <div class="row">
				<div class="col-sm-12">
					<label for="message" class="control-label">Are you sure you want to permanently delete this item?</label>
					 <input type="hidden" class="form-control" id="id_delete" name="id_delete" placeholder="" required>
		

				</div>
			  </div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-danger" id="guardar_datos">Delete</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>