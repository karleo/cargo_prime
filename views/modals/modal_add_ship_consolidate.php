	<!-- Modal -->
	<div class="modal fade" id="myModalConsolidate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-envelope'></i> Search Shipments</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<div id="modal_consolidate"></div>
					<form class="form-horizontal" method="post" id="send_email" name="send_email">

						<div class="row mb-3 ml-2">

							<div class=" col-sm-12 col-md-6">

								<div class="input-group">
									<input type="text" name="search" id="search" class="form-control input-sm float-right" placeholder="search tracking" onkeyup="cdp_load(1);">
									<div class="input-group-append input-sm">
										<button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
									</div>

								</div>
							</div><!-- /.col -->
						</div>

						<div class="outer_div"></div><!-- Datos ajax Final -->

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				</div>
				</form>
			</div>
		</div>
	</div>