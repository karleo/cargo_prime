<style>

	* { margin: 0; padding: 0; }
	body {
	    font: 14px/1.4 Helvetica, Arial, sans-serif;
	}
	#page-wrap { width: 800px; margin: 0 auto; }

	

	#header { height: 15px; width: 100%; margin: 20px 0; background: #222; text-align: center; color: white; font: bold 15px Helvetica, Sans-Serif; text-decoration: uppercase; letter-spacing: 20px; padding: 8px 0px; }

	#address { width: 250px; height: 150px; float: left; }
	#customer { overflow: hidden; }

	#logo { text-align: right; float: right; position: relative; margin-top: 25px; border: 1px solid #fff; max-width: 540px; overflow: hidden; }
	#customer-title { font-size: 20px; font-weight: bold; float: left; }

	#meta { margin-top: 1px; width: 100%; float: right; }
	#meta td { text-align: right;  }
	#meta td.meta-head { text-align: left; background: #6c757d; }
	#meta td textarea { width: 100%; height: 20px; text-align: right; }

	#signing { margin-top: 0px; width: 100%; float: center; }
	#signing td { text-align: center;  }
	#signing td.signing-head { text-align: center; background: #eee; }
	#signing td textarea { width: 100%; height: 20px; text-align: center; }

	#items { clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black; }
	#items th { background: #6c757d; }
	#items textarea { width: 80px; height: 50px; }
	#items tr.item-row td {  vertical-align: top; }
	#items td.description { width: 300px; }
	#items td.item-name { width: 175px; }
	#items td.description textarea, #items td.item-name textarea { width: 100%; }
	#items td.total-line { border-right: 0; text-align: right; }
	#items td.total-value { border-left: 0; padding: 10px; }
	#items td.total-value textarea { height: 20px; background: none; }
	#items td.balance { background: #6c757d; }
	#items td.blank { border: 0; }

	#terms { text-align: center; margin: 20px 0 0 0; }
	#terms h5 { text-transform: uppercase; font: 13px Helvetica, Sans-Serif; letter-spacing: 10px; border-bottom: 1px solid black; padding: 0 0 8px 0; margin: 0 0 8px 0; }
	#terms textarea { width: 100%; text-align: center;}



	.delete-wpr { position: relative; }
	.delete { display: block; color: #000; text-decoration: none; position: absolute; background: #EEEEEE; font-weight: bold; padding: 0px 3px; border: 1px solid; top: -6px; left: -22px; font-family: Verdana; font-size: 12px; }



	</style>

<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 13px; font-family: helvetica" >
	

    <table style="width: 100%;">
        <tr>
            <td style="width: 20%">
				<?php echo ($core->logo) ? '<img src="assets/' . $core->logo . '" alt="' . $core->site_name . '" width="' . $core->thumb_w . '" height="' . $core->thumb_h . '"/>' : $core->site_name; ?>
            </td> 
			<td style="width: 40%; text-align: center">
				<?php echo $lang['inv-shipping1'] ?>: <?php echo $core->c_nit; ?> <br> 				 
				<?php echo $lang['inv-shipping2'] ?>: <?php echo $core->c_phone; ?><br>
				<?php echo $lang['inv-shipping3'] ?>: <?php echo $core->site_email; ?><br>
				<?php echo $lang['inv-shipping4'] ?>: <?php echo $core->c_address; ?> - <?php echo $core->c_country; ?>-<?php echo $core->c_city; ?>
			</td>
            <td style="width: 40%; text-align: center">
				<br><img src='https://barcode.tec-it.com/barcode.ashx?data=<?php echo $row->c_prefix.$row->c_no; ?>&code=Code128&multiplebarcodes=false&translate-esc=false&unit=Fit&dpi=72&imagetype=Gif&rotation=0&color=%23000000&bgcolor=%23ffffff&qunit=Mm&quiet=0&modulewidth=50' alt=''/>
			</td>
			
        </tr>
    </table>
    <hr style=" height: 1px; color: solid grey;">
    <br>

        <table id="meta" style="width: 100%;  border-collapse: collapse;">
            <tr style="border: 1px solid black">
                <td rowspan="5" style="border: 1px solid white;  text-align: left; width: 60%">
                <strong style="font-size: 15px"><?php echo $lang['inv-shipping5'] ?></strong> <br>
				<!-- <table id="items"> -->
					<?php echo $sender_data->fname." ".$sender_data->lname; ?><br> <br>
					<?php echo $address_order->sender_address; ?> <br>
					<?php echo $address_order->sender_country." | ".$address_order->sender_city; ?> <br>
					<?php echo $sender_data->phone; ?> <br>
					<?php echo $sender_data->email; ?> 
				<!-- </table>	 -->
				</td>
				<td  style="border-bottom:  2px; border-top:  2px; border-left: 2px" class="meta-head"><p style="color:white;"><?php echo $lang['inv-shipping6'] ?></p></td>
                <td style="border: 2px">
					<?php echo $met_payment->name_pay; ?>
				</td>	
            </tr>
            <tr >
				<td style="border-bottom:  2px" class="meta-head"><p style="color:white;"><?php echo $lang['inv-shipping7'] ?></p></td>
                <td style="border: 2px"><?php echo $courier_com->name_com; ?></td>
            </tr>
            <tr >
                <td  style="border-bottom:  2px"class="meta-head"><p style="color:white;"><?php echo $lang['inv-shipping8'] ?></p></td>
                <td style="border: 2px"><?php echo $fecha; ?></td>
            </tr>
            <tr>
                <td style="border-bottom:  2px;" class="meta-head"><p style="color:white;"><?php echo $lang['inv-shipping9'] ?>.</p></td>
                <td style="border: 2px"><b><?php echo $row->c_prefix.$row->c_no; ?></b></td>
            </tr>
        </table>

<!-- 
        table { border-collapse: collapse; }
	table td, table th { border: 1px solid black; padding: 5px; }
 -->
    <table id="items" style=" width: 100%; border-collapse: collapse; margin-right:  5px">

        <tr style=" border: 1px solid black; padding: 2px;">

            <th style="color:white;  border: 1px solid black; padding: 2px; width: 50%;" ><b><?php echo $lang['ltracking'] ?></b></th>
            <th style="color:white;  border: 1px solid black; padding: 2px; width: 25%;"><b>Weights</b></th>
            
            <th style="color:white;  border: 1px solid black; padding: 2px; width: 25%;"><b>Weight vol.</b></th>                  
        </tr>

        <?php 

           
            $sumador_total=0;
            $sumador_libras=0;
            $sumador_volumetric=0;

            $precio_total=0;
            $total_impuesto=0;
            $total_seguro=0;
            $total_peso=0;
            $total_descuento=0;
            $total_impuesto_aduanero =0;

            foreach ($order_items as $row_order_item){
               
                $weight_item = $row_order_item->weight;
                
                $total_metric = $row_order_item->length * $row_order_item->width * $row_order_item->height/$row->volumetric_percentage;  

                // calculate weight x price
                if ($weight_item > $total_metric) {

                    $calculate_weight = $weight_item;
                    $sumador_libras+=$weight_item;//Sumador

                } else {

                    $calculate_weight = $total_metric;                                                 
                    $sumador_volumetric+=$total_metric;//Sumador
                }

                $precio_total=$calculate_weight* $row->value_weight;
                $precio_total=cdb_money_format($precio_total);//Precio total formateado

                $sumador_total+=$precio_total;

                if($sumador_total>200){

                    $total_impuesto= $sumador_total *$row->tax_value /100;
                }

                $total_descuento= $sumador_total *$row->tax_discount /100;
                $total_peso =$sumador_libras + $sumador_volumetric;

                $total_seguro= $sumador_total * $row->tax_insurance_value /100;

                $total_impuesto_aduanero= $total_peso * $row->tax_custom_tariffis_value;

                $total_envio = ($sumador_total-$total_descuento)+ $total_impuesto + $total_seguro+ $total_impuesto_aduanero+ $row->total_reexp;

                $sumador_total=cdb_money_format($sumador_total);
                $sumador_libras=cdb_money_format($sumador_libras);
                $sumador_volumetric=cdb_money_format($sumador_volumetric);
                $total_envio=cdb_money_format($total_envio);
                $total_seguro=cdb_money_format($total_seguro);
                $total_peso=cdb_money_format($total_peso);
                $total_impuesto_aduanero=cdb_money_format($total_impuesto_aduanero);
                $total_impuesto=cdb_money_format($total_impuesto);
                $total_descuento=cdb_money_format($total_descuento);

            ?>

            <tr class="item-row">
                <td style=" border: 1px solid black; padding: 3px;"><?php echo $row_order_item->order_prefix.$row_order_item->order_no; ?></td>
                <td style=" border: 1px solid black; padding: 3px;"><?php echo $weight_item; ?></td>
                <td style=" border: 1px solid black; padding: 3px;"><?php echo $row_order_item->weight_vol; ?></td>              
            </tr>
        <?php

        }?>

        <tr class="">                                   
            <td style=" border: 1px solid black; padding: 3px; width: 50%;" ></td>           
            <td style=" border: 1px solid black; padding: 3px;width: 25%;" class="text-right"><b><?php echo $lang['left240'] ?></b></td>
            <td style=" border: 1px solid black; padding: 3px; width: 25%;" class="text-center"><?php echo $sumador_total; ?></td>              
            
        </tr>

        <tr class="">                                   
            <td style=" border: 1px solid black; padding: 3px; width: 50%;"><b>Price &nbsp; <?php echo $core->weight_p; ?>:</b> <?php echo $row->value_weight;?></td>

           <td style=" border: 1px solid black; padding: 3px; width: 25%;"  class="text-right"><b>Discount <?php echo $row->tax_discount; ?> %< </b></td>
            <td style=" border: 1px solid black; padding: 3px; width: 25%;" class="text-center"><?php echo $total_descuento; ?></td>              
            
        </tr>

        <tr>                
            <td style=" border: 1px solid black; padding: 3px; width: 50%;"><b><?php echo $lang['left232'] ?>:</b> <span id="total_libras"><?php echo $sumador_libras; ?></span></td>
                                                                               
            <td style=" border: 1px solid black; padding: 3px; width: 25%;"  class="text-right"><b>Shipping insurance <?php echo $row->tax_insurance_value; ?> % </b></td>
            <td style=" border: 1px solid black; padding: 3px; width: 25%;" class="text-center" id="insurance"><?php echo $total_seguro; ?></td>              
                                                         
        </tr>

        <tr>
            <td style=" border: 1px solid black; padding: 3px; width: 50%;" ><b><?php echo $lang['left234'] ?>:</b> <span id="total_volumetrico"><?php echo $sumador_volumetric; ?></span></td>                                            

            <td style=" border: 1px solid black; padding: 3px; width: 25%;"  class="text-right"> <b>Customs tariffs <?php echo $row->tax_custom_tariffis_value; ?> %</b></td>
            <td style=" border: 1px solid black; padding: 3px; width: 25%;" class="text-center" id="total_impuesto_aduanero"><?php echo $total_impuesto_aduanero; ?></td>              
                                                        

        </tr>

        <tr>                
            <td style=" border: 1px solid black; padding: 3px; width: 50%;"><b><?php echo $lang['left236'] ?></b>: <span id="total_peso"><?php echo $total_peso; ?></span></td>                          

            <td style=" border: 1px solid black; padding: 3px; width: 25%;"  class="text-right"><b>Tax <?php echo $row->tax_value; ?> % </b></td>
            <td style=" border: 1px solid black; padding: 3px; width: 25%;"  class="text-center" id="impuesto"><?php echo $total_impuesto; ?></td> 
                                                                     
        </tr>

        <tr>                
            <td style=" border: 1px solid black; padding: 3px; width: 50%;"></td>                          

            <td style=" border: 1px solid black; padding: 3px; width: 25%;"  class="text-right"><b>Re expedition</b></td>
            <td style=" border: 1px solid black; padding: 3px; width: 25%;"  class="text-center" id="impuesto"><?php echo $eow->total_reexp; ?></td> 
                                                                     
        </tr>   

        <tr>                                            
            <td style=" border: 1px solid black; padding: 3px; width: 50%;"></td>

            <td style=" border: 1px solid black; padding: 3px; width: 25%;"  class="text-right"><b><?php echo $lang['add-title44'] ?> &nbsp; <?php echo $core->currency;?></b></td>
            <td style=" border: 1px solid black; padding: 3px; width: 25%;" class="text-center" id="total_envio"><?php echo $total_envio; ?></td>              
                                                                  

        </tr>
    </table>
    		<br>
    		<table style="width: 100%;">
        <tr>
            <td style="width: 20%">
            </td> 
			<td style="width: 60%; text-align: center">
   		 	<h5><?php echo $lang['inv-shipping18'] ?></h5>
				
			</td>
            <td style="width: 20%; text-align: center">
				
			</td>
			
        </tr>
    </table>
 	    <hr style=" height: 1px; color: solid grey;">
		<p align="justify"><?php echo cdp_cleanOut($core->interms);?></p>
	
	  <table cellspacing="10" style="width: 100%; text-align: left; font-size: 11pt;">
			 <tr>
                <td style="width:30%;text-align: center;border-top:solid 0px"></td>
               <td style="width:10%;text-align: center;border-top:solid 0px"></td>
               <td style="width:60%;text-align: center;border-top:solid 0px; ">
               
               </td>
            </tr>		
			 <tr>
               <td style="width:40%;text-align: center;">
               	 <hr style=" height: 1px; color: solid grey; margin-top:45px">

               	 <br>

               <?php echo $core->signing_company;?>

           		</td>
               <td style="width:60%;text-align: center">
               		
               	
               	 <hr style=" height: 1px; color: solid grey; margin-top: 45px">
               		
               	<br>

               <?php echo $core->signing_customer;?></td>
            </tr>
        </table>

</page>

