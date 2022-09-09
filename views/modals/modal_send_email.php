	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
				<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-envelope'></i> Send Email</h4>
		  		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="send_email" name="send_email">
			<div class="resultados_ajax_mail text-center"></div>
			  
			  <div class="row">
				<div class="col-sm-12">
				<label for="sendto" class="control-label">Addressee</label>
				
				  <input type="email" class="form-control" id="sendto" name="sendto" placeholder="" required>
				  <input type="hidden" class="form-control" id="id" name="id" placeholder="" required>
				</div>
			  </div>			  	

			  <div class="row">
				<div class="col-sm-12">
					<label for="subject" class="control-label">Subject</label>
				
				  <input type="text" class="form-control" id="subject" name="subject" placeholder="" required>
				</div>
			  </div>
			  <div class="row">
				<div class="col-sm-12">
					<label for="message" class="control-label">Message</label>
				
					<textarea class="form-control" id="message" name="message" rows="4" required>Good morning, I attach invoice</textarea>
				</div>
			  </div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			<button type="submit" class="btn btn-success" id="guardar_datos">Send</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>