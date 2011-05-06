<div id="view_order">
<fieldset>
 <?php

	foreach ($orderdata as $order){
	
		if ( $order['invoice_id'] != '' )
		{
			$invoice = anchor( 'invoice/view_invoice/ ' . $order['invoice_id'], 'View Invoice ' . $order['invoice_id'] );
		} else {
			$invoice = '<b>No Invoice Available</b> ';
			$invoice .= anchor('invoice/payment/' . $order['invoice_id'], 'Enter Payment');
		}
?>		
		<div class="order_box" id="order_view" >
			<div class="order_title">
				<h1 class="name_form">View Order</h1>
			</div>
			<div class="subcateg_title">1.</div>
			<div class="info_box">
			     <ul>
				    <li><label for="order_id">Order_id:</label><input type="text" id="order_id" class="field" value="<?=$order['order_id']?>"/></li>
				    <li><label for="client_id">Client_id:</label><input type="text" id="client_id" class="field" value="<?=$order['client_id']?> "/></li>
				    <li>Invoice_id: <?=$invoice?></li>	
				 </ul>
				 <p class="clear">&nbsp;</p>
			</div>
			<div class="subcateg_title ">2.</div>
			<div class="info_box pink">
			    <ul>
				    <li><label for="order_date">Order_date:</label><input type="text" id="order_date" class="field" value="<?=$order['order_date'] ?>"/></li>
				    <li><label for="order_type">Order_type:</label><input type="text" id="order_type" class="field" value="<?=$order['order_type']?>"/></li>
				    <li><label for="insurance_id">Insurance_id:</label><input type="text" id="insurance_id" class="field" value="<?=$order['insurance_id']?>"/></li>
				    <li><label for="tray_num">Tray_num:</label><input type="text" id="tray_num" class="field" value="<?=$order['tray_num']?>"/></li>
				    <li><label for="doctor_id">Doctor_id:</label><input type="text" id="doctor_id" class="field" value="<?=$order['doctor_id']?>"/></li>
				    <li><label for="due_date">Due_date:</label><input type="text" id="due_date" class="field" value="<?=$order['due_date']?>"/></li>
				    <li><label for="complete_date">Complete Date:</label><input type="text" id="complete_date" class="field" value="<?=$order['complete_date']?>"/></li>
				    <li><label for="delivered_date">Delivered Date:</label><input type="text" id="delivered_date" class="field" value="<?=$order['delivered_date']?>"/></li>
				    <li><label for="remake_reason">Remake Reason:</label><input type="text" id="remake_reason" class="field" value="<?=$order['remake_reason']?>"/></li>
				</ul>
				<p class="clear">&nbsp;</p>
			</div>
			<div class="subcateg_title">3.</div>
			<div class="info_box">
				<ul>
				    <li><label for="segment_decentration">Segment Decentration:</label><input type="text" id="segment_decentration" class="field" value="<?=$order['segment_decentration']?>"/></li>
				    <li><label for="segment_height_l">segment_height l:</label><input type="text" id="segment_height_l" class="field" value="<?=$order['segment_height_l']?>"/></li>
				    <li><label for="segment_height_r">segment_height r:</label><input type="text" id="segment_height_r" class="field" value="<?=$order['segment_height_r']?>"/></li>
				    <li><label for="lens_color">Lens Color:</label><input type="text" id="lens_color" class="field" value="<?=$order['lens_color']?>"/></li>
				    <li><label for="lens_size_a">Lens Size A:</label><input type="text" id="lens_size_a" class="field" value="<?=$order['lens_size_a']?>"/></li>
				    <li><label for="lens_size_b">Lens Size B:</label><input type="text" id="lens_size_b" class="field" value="<?=$order['lens_size_b']?>"/></li>
				    <li><label for="lens_size_ed">Lens Size ED:</label><input type="text" id="lens_size_ed" class="field" value="'<?=$order['lens_size_ed']?>"/></li>
				    <li><label for="lens_shape">Lens Shape:</label><input type="text" id="lens_shape" class="field" value="<?=$order['lens_shape']?>"/></li>
				    <li><label for="lens_material">Lens Material:</label><input type="text" id="lens_material" class="field" value="<?=$order['lens_material']?>"/></li>
				    <li><label for="lens_treatment">Lens Treatment:</label><input type="text" id="lens_treatment" class="field" value="<?=$order['lens_treatment']?>"/></li>
				    <li><label for="lens_coating">Lens Coating:</label><input type="text" id="lens_coating" class="field" value="<?=$order['lens_coating']?>"/></li>
				    <li><label for="lens_treatment_price">Lens Treatment Price:</label><input type="text" id="lens_treatment_price" class="field" value="<?=$order['lens_treatment_price']?>"/></li>
				    <li><label for="lens_coating_price">Lens Coating Price: </label><input type="text" id="lens_coating_price" class="field" value="<?=$order['lens_coating_price']?>"/></li>
				</ul>  
				<p class="clear">&nbsp;</p>
			</div>
			<div class="subcateg_title ">4.</div>
			<div class="info_box pink">
				<ul>
					<li><label for="bridge_size">Bridge:</label><input type="text" id="bridge_size" class="field" value="<?=$order['bridge_size']?>"/></li>
					<li><label for="temple_length">Temple Length:</label><input type="text" id="temple_length" class="field" value="<?=$order['temple_length']?>"/></li>
				</ul>
				<p class="clear">&nbsp;</p>
                <ul>				
					<li><label for="add_l">Add L: </label><input type="text" id="add_l" class="field" value="<?=$order['add_l']?>"/></li>
					<li><label for="add_r">Add R: </label><input type="text" id="add_r" class="field" value="<?=$order['add_r']?>"/></li>
					<li><label for="lens_id">Lens Id:</label><input type="text" id="lens_id" class="field" value="<?=$order['lens_id']?>"/></li>
					<li><label for="lens_type">Lens Type:</label><input type="text" id="lens_type" class="field" value="<?=$order['lens_type']?>"/></li>
					<li><label for="lens_design">Lens Design:</label><input type="text" id="lens_design" class="field" value="<?=$order['lens_design']?>"/></li>
					<li><label for="lens_material">Lens Material:</label><input type="text" id="lens_material" class="field" value="<?=$order['lens_material']?>"/></li>
					<li><label for="lens_treatment">Lens Treatment:</label><input type="text" id="lens_treatment" class="field" value="<?=$order['lens_treatment']?>"/></li>
					<li><label for="special_instructions">Special Instructions: </label><input type="text" id="special_instructions" class="field" value="<?=$order['special_instructions']?>"/></li>
					<li><label for="pd_near_l">PD Near L:</label><input type="text" id="pd_near_l" class="field" value="<?=$order['pd_near_l']?>"/></li>
					<li><label for="pd_near_r">PD Near R:</label><input type="text" id="pd_near_r" class="field" value="<?=$order['pd_near_r']?>"/></li>
					<li><label for="pd_far_l">PD FAR L:</label><input type="text" id="pd_far_l" class="field" value="<?=$order['pd_far_l']?>"/></li>
					<li><label for="pd_far_r">PD FAR R:</label><input type="text" id="pd_far_r" class="field" value="<?=$order['pd_far_r']?>"/></li>
					<li><label for="diag_code">Diag Code:</label><input type="text" id="diag_code" class="field" value="<?=$order['diag_code']?>"/></li>
					<li><label for="frame_id">Frame ID:</label><input type="text" id="frame_id" class="field" value="<?=$order['frame_id']?>"/></li>
					<li><label for="paid_in_full">Paid In Full:</label><input type="text" id="paid_in_full" class="field" value="<?=$order['paid_in_full']?>"/></li>
			    </ul>  
				<p class="clear">&nbsp;</p>
			</div>	
		</div>
        <?
	/*	
		echo '<div>Order_id: ' . $order['order_id']?></div>';
		echo '<div>Client_id: ' . $order['client_id']?></div>';
		echo '<div>invoice_id: ' . 	$invoice . '</div>';
			
		echo '<div>order_date: ' . $order['order_date']?></div>';
		echo '<div>order_type: ' . $order['order_type']?></div>';
		echo '<div>insurance_id: ' . $order['insurance_id']?></div>';
		echo '<div>tray_num: ' . $order['tray_num']?></div>';
		echo '<div>doctor_id: ' . $order['doctor_id']?></div>';
		echo '<div>due_date: ' . $order['due_date']?></div>';
		echo '<div>complete_date: ' . $order['complete_date']?></div>';
		echo '<div>delivered_date: ' . $order['delivered_date']?></div>';
		echo '<div>remake_reason: ' . $order['remake_reason']?></div>';
		
		echo '<div>segment_decentration: ' . $order['segment_decentration']?></div>';
		echo '<div>segment_height: ' . $order['segment_height_l']?></div>';
		echo '<div>segment_height: ' . $order['segment_height_r']?></div>';
		echo '<div>Lens Color: ' . $order['lens_color']?></div>';
		echo '<div>Lens Size A: ' . $order['lens_size_a']?></div>';
		echo '<div>Lens Size B: ' . $order['lens_size_b']?></div>';	
		echo '<div>Lens Size ED: ' . $order['lens_size_ed']?></div>';
		echo '<div>Lens Shape' . $order['lens_shape']?></div>';
		echo '<div>Lens Material: ' . $order['lens_material']?></div>';
		echo '<div>Lens Treatment: ' . $order['lens_treatment']?></div>';
		echo '<div>Lens Coating: ' . $order['lens_coating']?></div>';
		echo '<div>Lens Treatment Price: ' . $order['lens_treatment_price']?></div>';
		echo '<div>Lens Coating Price: ' . $order['lens_coating_price']?></div>';		
		echo '<div>Bridge: ' . $order['bridge_size']?></div>';
		echo '<div>Temple Length: ' . $order['temple_length']?></div>';
		echo '<div>Add L: ' . $order['add_l']?></div>';
		echo '<div>Add r: ' . $order['add_r']?></div>';
		echo '<div>Lens Id: ' . $order['lens_id']?></div>';
		echo '<div>Lens Type: ' . $order['lens_type']?></div>';
		echo '<div>Lens design: ' . $order['lens_design']?></div>';
		echo '<div>Lens Material: ' . $order['lens_material']?></div>';
		echo '<div>Lens Treatment: ' . $order['lens_treatment']?></div>';
		echo '<div>Lens Id: ' . $order['lens_id']?></div>';
		echo '<div>Special Instructions: ' . $order['special_instructions']?></div>';
		echo '<div>PD Near L: ' . $order['pd_near_l']?></div>';
		echo '<div>PD Near R: ' . $order['pd_near_r']?></div>';
		echo '<div>PD FAR L: ' . $order['pd_far_l']?></div>';
		echo '<div>PD FAR R: ' . $order['pd_far_r']?></div>';
		echo '<div>Diag Code: ' . $order['diag_code']?></div>';
		echo '<div>Frame ID: ' . $order['frame_id']?></div>';
		echo '<div>Paid In Full: ' . $order['paid_in_full']?></div>';
	*/	
	}		

?>
</fieldset>
</div>