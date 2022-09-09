<!-- ============================================================== -->
<!-- Right Part contents-->
<!-- ============================================================== -->
<div class="right-part mail-list bg-white">
	<div class="p-15 b-b">
		<div class="d-flex align-items-center">
			<div>
				<span><?php echo $lang['tools-config61'] ?> | <?php echo $lang['left709'] ?></span>
			</div>

		</div>
	</div>
	<!-- Action part -->
	<!-- Button group part -->
	<div class="bg-light p-15">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="row">
					<div class="col-12">
						<div id="loader" style="display:none"></div>
						<div id="resultados_ajax"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Action part -->
	<?php $zonerow = $core->cdp_getZone(); ?>
	<?php $code_currency = $core->cdp_getCodeCountries(); ?>

	<div class="row">
		<!-- Column -->
		<div class="col-12">
			<div class="card-body">
				<form class="form-horizontal form-material" id="save_config" name="save_config" method="post">

					<h4 class="card-title"><b><?php echo $lang['tools-config33'] ?></b></h4>
					<br>
					<section>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="phoneNumber1"><?php echo $lang['tools-config34'] ?></label>
									<input class="form-control" name="timezone" id="timezone" value="<?php echo $core->timezone; ?>" list="browsers" autocomplete="off" required="required">
									<datalist id="browsers">
										<option><?php echo $core->timezone; ?></option>
										<?php foreach ($zonerow as $row) : ?>
											<option value="<?php echo $row->zone_name; ?>"><?php echo $row->zone_name; ?></option>
										<?php endforeach; ?>
									</datalist>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="phoneNumber1"><img src='assets/images/alert/lang.png' width='20' /> <?php echo $lang['tools-config62'] ?></label>
									<select class="custom-select form-control" name="language" id="language">
										<optgroup label="Select language">
											<option value="en" <?php if ($core->language == "en") echo " selected=\"selected\""; ?> data-flag="us"> <?php echo $lang['tools-config63'] ?></option>
											<option value="es" <?php if ($core->language == "es") echo " selected=\"selected\""; ?> data-flag="es"> <?php echo $lang['tools-config64'] ?></option>

											<option value="he" <?php if ($core->language == "he") echo " selected=\"selected\""; ?> data-flag="he"> <?php echo $lang['tools-config66'] ?></option>
										</optgroup>
									</select>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
		                            <label for="cformat">Currency Format</label>
		                            <select class="custom-select form-control" name="cformat" id="cformat">
		                                <option value="1" <?php if ($core->dec_point == "." AND $core->thousands_sep == "") echo " selected=\"selected\""; ?>>
		                                    1234.56
		                                </option>
		                                <option value="2" <?php if ($core->dec_point == "." AND $core->thousands_sep == ",") echo " selected=\"selected\""; ?>>
		                                    1,234.56
		                                </option>
		                                <option value="3" <?php if ($core->dec_point == "," AND $core->thousands_sep == "") echo " selected=\"selected\""; ?>>
		                                    1234,56
		                                </option>
		                                <option value="4" <?php if ($core->dec_point == "," AND $core->thousands_sep == ".") echo " selected=\"selected\""; ?>>
		                                    1.234,56
		                                </option>
		                            </select>
		                        </div>
		                    </div>

		                    <div class="col-md-3">

		                        <div class="form-group">
		                        	<label for="dec_point">Decimal Point</label>
		                        	<input type="text" class="form-control" id="dec_point" name="dec_point" value="<?php echo $core->dec_point; ?>" readonly>

		                        </div>
		                     </div>

		                    <div class="col-md-3"> 
		                        <div class="form-group">
		                        	<label for="thousands_sep">Thousands Separator</label>
		                        	<input type="text" class="form-control" id="thousands_sep" name="thousands_sep" value="<?php echo $core->thousands_sep; ?>" readonly>

		                        </div>
		                    </div>
	                    </div>

						

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="phoneNumber1"><?php echo $lang['tools-config52'] ?></label>

									<select class="form-control" id="colaboradores" value="<?php echo $core->currency; ?>" list="browsers12" autocomplete="off" required="required">

									   <option><?php echo $core->currency; ?></option>
									    <?php foreach ($code_currency as $row) : ?>
									        <?php

										        $data="data-currency_symbol=\"$row->currency_symbol\"data-currency=\"$row->currency\"";
									            $value="value=\"$row->id\"";
									            echo "<option $value $data>".$row->currency . " - " . $row->name."</option>";

										        ?>
									    <?php endforeach; ?>
									</select>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="phoneNumber1">Symbol Currency</label>

									<input type="text" class="form-control" id="currency_symbol" name="for_symbol" value="<?php echo $core->for_symbol; ?>" required="required">

									<input id="id" type="hidden" class="form-control" placeholder="id" />
						    		<input id="currency" type="hidden" class="form-control" name="currency" value="<?php echo $core->currency; ?>" />

								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
		                            <label for="currency_decimal_digits">Currency Symbol Position</label>
		                            <select class="form-control" name="for_currency" id="for_currency" value="<?php echo $core->for_currency; ?>">

		                                <option value="p" <?php if ($core->for_currency == 'p') echo " selected=\"selected\""; ?>>Left</option>
		                                <option value="s" <?php if ($core->for_currency == 's') echo " selected=\"selected\""; ?>>Right</option>

		                            </select>
		                        </div>
		                    </div>

							<div class="col-md-6">
								<div class="form-group">
		                            <label for="currency_decimal_digits">Currency Decimal Digits</label>
		                            <select class="form-control" name="for_decimal" id="for_decimal" value="<?php echo $core->for_decimal; ?>">

		                                <option value="false" <?php if ($core->for_decimal == 'false') echo " selected=\"selected\""; ?>>0 (e.g. 100)</option>
		                                <option value="true" <?php if ($core->for_decimal == 'true') echo " selected=\"selected\""; ?>>2 (e.g. 100.00)</option>



		                            </select>
		                        </div>
		                    </div>
		                </div>

					</section>
					<div class="form-group">
						<div class="col-sm-12">
							<button type="submit" class="btn btn-primary btn-confirmation" name="dosubmit"><?php echo $lang['tools-config56'] ?> <span><i class="icon-ok"></i></span></button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- Column -->
	</div>

	<div class="p-15 m-t-30">

	</div>
</div>


<script src="dataJs/config_general.js"></script>

<script type="text/javascript">
							
document.getElementById('colaboradores').onchange = function() {
  /* Referencia al option seleccionado */
  var mOption = this.options[this.selectedIndex];
  /* Referencia a los atributos data de la opción seleccionada */
  var mData = mOption.dataset;

  /* Referencia a los input */
  var elId = document.getElementById('id');
  var elCodigo = document.getElementById('currency_symbol');
  var elCurren = document.getElementById('currency');


  /* Asignamos cada dato a su input*/
  elId.value = this.value;
  elCodigo.value = mData.currency_symbol;
  elCurren.value = mData.currency;


};
</script>