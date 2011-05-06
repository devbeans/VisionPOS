<?php

//initiate variable
$authorization_field	= "example";
$dispencer_id_field		= "example";
$insurance_id_field		= "example";
$invoice_employer_field	= "";	
$dob_field				= "example";
$special_instructions_field = '<textarea id="special_instructions" rows="4" cols="108" name="special_instructions"></textarea>';

$current_client= "21245"; //number of client

//doctor where to put it ,on default I put near dispencer

//  missing  Insurance Co.:   ID ->carrier  // i add the field   

//add img just for : shere, cylinder, axis, addition

// add <div id="allHiddenDiv" style="display:block;">  why we need this block of HIDDEN DIV ??

// #frame_name doesn`t work - I don`t know what does the function on jquery

// modify remakeReason() -  need to hide label + drop_down 


?>

<script type="text/javascript">
$sitePath	=	'<?php echo  site_url();?>'
$(document).ready(function(){
	
/********************************/	
/***Albert Add-ins ******************/


	$("#frame_manufacturer,#frame_division,#frame_name,#frame_color").change(function () {
		
		var m_frame = $("#frame_name :selected").val();
		var m_color = $("#frame_color :selected").val();
		
		$.ajax({
					url: "<?=site_url("ajaxframe/ajax_frame_sizes")?>", 
					data: 'frame=' + m_frame + '&color=' + m_color, 
					dataType: "json",
					type: "post",
					jsonp : false,
					success: function (sizes)
					{
						
						$("select[name=eye_size]").html(sizes.eye_sizes);
						$("select[name=bridge_size]").html(sizes.bridge_sizes);
						$("select[name=temple_length]").html(sizes.temple_sizes);
					
					}
			  });
		
	
	});
	
	$("#lens_type").change(function () {
	
		var m_type_id = $(this).val();
		
		$.post("<?=site_url("ajaxframe/ajax_brands")?>", {type_id: m_type_id}, function (options){
		
			$("#lens_brand").html(options);
			$("#lens_brand").trigger("change");
		
		});
	
	});
	
	
	$("#lens_brand").change(function () {
	
		var m_brand_id = $(this).val();
		
		$.post("<?=site_url("ajaxframe/ajax_designs")?>", {brand_id: m_brand_id}, function (options){
		
			$("#lens_designs").html(options);
			$("#lens_designs").trigger("change");
		});
	});
	
	$("#lens_designs").change(function () {
	
		var m_design_id = $(this).val();
		
		$.post("<?=site_url("ajaxframe/ajax_materials")?>", {design_id: m_design_id}, function (options){
		
			$("#lens_materials").html(options);
			$("#lens_materials").trigger("change");
		});
	
	});
	
	$("#lens_materials").change(function () {
		var price = $("#lens_materials option:selected").attr("price");
		$("#lenses_field").val(price);
		calculation();
	
	});


	$("#prism_show a").click(function(){
		$("#prism_hide").show();
		$("#prism_show").hide();
	});

	$("#prism_hide a").click(function(){
		$("#prism_hide").hide();
		$("#prism_show").show();
	});

	$("#patientinfo-show a").click(function(){
		$("#patientinfo-hide").show();
		$("#patientinfo-show").hide();
	});

	$("#patientinfo-hide a").click(function(){
		$("#patientinfo-hide").hide();
		$("#patientinfo-show").show();
	});

	$("input[name=frame_source]").click(function () {
	
		if($(this).val() == 1)
		{
			$(".fe_manual").hide();
			$(".fe").show();
		}
		else
		{
			$(".fe_manual").show();
			$(".fe").hide();
		}
	
	});
	
	$("input[name=lens_color]").click(function () {

		
		if($(this).val() == 1)
		{
			$("#div-has-lens-color").show();
			
		}
		else
		{
			$("#div-has-lens-color").hide();
		}
		
	});
	
	$("input[name=gradient]").click(function () {

		
		if($(this).val() == 1)
		{
			$("#has-gradient-color").show();
			
		}
		else
		{
			$("#has-gradient-color").hide();
		}
		
	});


/******************************/
	
	
	usernameByDispercerId();
	
	/* $('input[id=dispencer_id]').bind('keyup',function(){
		usernameByDispercerId();
	}); */
	$('#dispencer_id').blur(function(){
		dispencer_name($('#dispencer_id').val());
	});
	/** for select Doctor start **/
	$('select[id=doctor_id]').bind('change',function(){
		checkForOtherDoctor();
	});
	checkForOtherDoctor();
	/** for select Doctor end  **/

	/** for select order type start **/
	remakeReason();
	/** for select order type end **/
	/** form Validator Start  **/
	$("#order_form").validate({
		rules:{
			carrier: {required:true},
			insurance_id: {required:function() {return ($("#carrier").val()=='NONE')?false:true;}},
			dob: {required:function() {return ($("#carrier").val()=='NONE')?false:true;}},
			date_filed: {required:function() {return ($("#carrier").val()=='NONE')?false:true;}},
			authorization: {required:function() {return ($("#carrier").val()=='NONE')?false:true;}},
			diag_code: {required:function() {return ($("#carrier").val()=='NONE')?false:true;}},
			lens_material: {required:true},
			lens_coating: {required:true},
			lens_color: {required: function() { return $("input#lens-color-checkbox").attr("checked"); }},
			lens_gradient: {required: function() { return $("input#lens-color-style-gradient").attr("checked"); }},
			doctor_id: {required: true}
			},
		messages:{
					carrier: {required:"Required"},
					insurance_id: {required:"Required"},
					dob: {required:"Required"},
					date_filed: {required:"Required"},
					authorization: {required:"Required"},
					diag_code: {required:"Required"},
					lens_material: {required:"Required"},
					lens_coating: {required:"Required"},
					lens_color: {required:"Required"},
					lens_gradient: {required:"Required"},
					doctor_id : {required: "Required"}
	    		}
		
	});
	/** form Validator end  **/
	
	/************* order Type with remake start ************/
	$('select[id=carrier]').bind('change',function(){
		if($('#carrier').val()=='NONE'|| $('#carrier').val()=='DISCOUNT') 
			$('#carrierHiddenDiv').hide();
		else
			$('#carrierHiddenDiv').show();
		
		if($('#carrier').val()=='NONE')
		{
			$('#drop_discount').val(0);			
			$('#drop_discount').attr('disabled', 'disabled');
			$('#drop_discount').css("backgroundColor","#FFD3E0");
			$('#employer_div').hide();
		}
		else
		{
			$('#drop_discount').removeAttr('disabled');
			$('#drop_discount').css("backgroundColor","#ffffff");
			$('#employer_div').show();
		}
		
	});
	
	$('select[id=order_type]').bind('change',function(){
		if($('#order_type').val()=='') 
			$('#allHiddenDiv').hide();
		else
			$('#allHiddenDiv').show();
		remakeReason();
	});
	
	$('select[id=remake_reason]').bind('change',function(){
		var originalValueTrimmed = $.trim($('select[id=remake_reason]').val());              
		if(originalValueTrimmed=='')
		//if($('select[id=remake_reason]').val().trim()=='')
		{
			$('#allHiddenDiv').hide();
		}
		else
		{
			$('#allHiddenDiv').show('slow');
		}
	});
	
	$('img[id^=img]').each(function(){
		$(this).css('cursor','pointer');
		$elId=$(this).attr('id');
		$varEl	=	($elId.split('_'))[1];
		$(this).attr('title','copy from Left '+ $varEl+' to right');
			
		$(this).bind('click',function(){
			$elId=$(this).attr('id');
			$varEl	=	($elId.split('_'))[1];
			$(this).attr('alt','copy from Left '+ $varEl+' right');
			$('select[name='+$varEl+'_r]').val($('select[name='+$varEl+'_l]').val());
		});
	}); 
	/*** Left right copy section end  ****************/	
	
	/*** frame section start here ****************/
	$('select[name=frame_manufacturer]').bind('change',function(){
		var manuf=$('#frame_manufacturer').val();
		getFrameDivisionByManufacturerId(manuf);
	});
	$('select[name=frame_division]').bind('change',function(){
	   var div_id=$('#frame_division').val();
		getFrameNameByDivisionId(div_id);
	});
	$('select[name=frame_name]').bind('change',function(){
		//getFrameColorByName();
		var val=$('#frame_name').val();
		getFrameColorByName(val);
		getPrice(val);
	});
	
	$('select[name=frame_color]').bind('change',function(){
		var manuf=$('#frame_color').val();
		//getFrameColorByName(frame_id);
	});
	
	$('select[name=lens_coating]').bind('change',function(){
		getLensCoatingPrice();
	});
	
	$('select[name=lens_type]').bind('change',function(){
		getLensDesignByTypeId();
	});
	
	$('select[name=lens_design]').bind('change',function(){
		getLensMaterialByDesignId();
	});
	
	$('select[name=lens_material]').bind('change',function(){
		LensPrice();
	});
	
	var manuf=$('#frame_manufacturer').val();
	getFrameDivisionByManufacturerId(manuf);
	
	function set_real_treatments()
	{
		var opts = Array();
		$("select[id=lens_treatment] option").each(function (i, opt) {
			
			if ($(opt).val() != "")
				opts.push($(opt).val());
		
		});
		
		$("#real_treatments_selected").val(opts.join(","));
	}
	/*** frame section end  ****************/
	$('select[name=select_lens_treatment]').bind('click',function(){
		selectTreatmentAdd();
		
		set_real_treatments();
	});
	$('select[id=lens_treatment]').bind('click',function(){
		selectTreatmentRemove();
		set_real_treatments();
	});
	
	
	
	
	$('select[id=bridge_size]').bind('change',function(){
		var i=$('select[id=bridge_size]').val()
		$('select[name=dbl]').val(i);
	});
	
	$('select[id=dbl]').bind('change',function(){
		var i=$('select[id=dbl]').val()
		$('select[name=bridge_size]').val(i);
	});
	
	
	$('#drop_other').blur(function(){
		var a = $('#lenses_field').val();
		var b = $('#frames_field').val();
		var c = $('#lens_coating_field').val();
		var d = $('#lens_treatments_field').val();
		var e = $('#drop_other').val();
		var ee =$("#lens_materials option:selected").attr("price");
		var f = parseFloat(a) + parseFloat(b) + parseFloat(c) + parseFloat(d) + parseFloat(e) + parseFloat(ee);
		$('#drop_subtotal').val(format_number(f,2));
	});
	
	$('#drop_discount').blur(function(){
		var f = $('#drop_subtotal').val();
		var g = $('#drop_discount').val();
		
		var h = format_number(parseFloat(f) - parseFloat(g),2);
		$('#drop_total').val(h);
	});
	
	$('#drop_deposit').blur(function(){
		var h = $('#drop_total').val();
		var i = $('#drop_tax').val();
		var j = $('#drop_deposit').val();
		var due = format_number(parseFloat(h) + parseFloat(i)- parseFloat(j),2);
		$('#balance_due').val(due);
	});
	
	$("#rx_expiration").datepicker({
			changeMonth: true,
			changeYear: true,
			yearRange: '<?=date("Y")+1?>:<?=date("Y")+50?>'
		});
	$("#date_filed").datepicker();
	
	$("#dob").datepicker({
			changeMonth: true,
			changeYear: true,
			yearRange: '<?=date("Y")-70?>:<?=date("Y")?>'
	});
	
	
	
	/*$("#rx_expiration").dateValidator();
	$("#date_filed").dateValidator();
	$("#dob").dateValidator();*/
	
});


function calculation()
{
	var a = $('#lenses_field').val();
	var b = $('#frames_field').val();
	var c = $('#lens_coating_field').val();
	var d = $('#lens_treatments_field').val();
	var e = $('#drop_other').val();
	var ee = 0;//$("#lens_materials option:selected").attr("price");
	var lensColor = $("#lens_color_field").val();
	
	var f = parseFloat(a) + parseFloat(b) + parseFloat(c) + parseFloat(d) + parseFloat(e) + parseFloat(lensColor) + parseFloat(ee);
	var tax_amount = f * <?=settings_get("TAX")?>;
	$('#drop_subtotal').val(format_number(f,2));
	$("#drop_tax").val(format_number(tax_amount,2));

	var f = $('#drop_subtotal').val();
	var g = $('#drop_discount').val();
	
	var h = format_number((parseFloat(f) - parseFloat(g)) + tax_amount,2);
	$('#drop_total').val(h);

	var h = $('#drop_total').val();
	
	var j = $('#drop_deposit').val();
	var due = format_number(parseFloat(h) + parseFloat(i)- parseFloat(j),2);
	$('#balance_due').val(due);
}

function format_number(pnumber,decimals){
	if (isNaN(pnumber)) { return 0};
	if (pnumber=='') { return 0};
	
	var snum = new String(pnumber);
	var sec = snum.split('.');
	var whole = parseFloat(sec[0]);
	var result = '';
	
	if(sec.length > 1){
		var dec = new String(sec[1]);
		dec = String(parseFloat(sec[1])/Math.pow(10,(dec.length - decimals)));
		dec = String(whole + Math.round(parseFloat(dec))/Math.pow(10,decimals));
		var dot = dec.indexOf('.');
		if(dot == -1){
			dec += '.'; 
			dot = dec.indexOf('.');
		}
		while(dec.length <= dot + decimals) { dec += '0'; }
		result = dec;
	} else{
		var dot;
		var dec = new String(whole);
		dec += '.';
		dot = dec.indexOf('.');		
		while(dec.length <= dot + decimals) { dec += '0'; }
		result = dec;
	}	
	return result;
}

function show_div(div)
{
	$('#'+div).show('slow');
}

function hide_div(div)
{
	$('#'+div).hide();
}

function move_all()
{
	var str = new Array("sphere","cylinder","axis","add");
	for(var i=0;i<str.length;i++)
	{
		var s=str[i];
		$('select[name='+s+'_r]').val($('select[name='+s+'_l]').val());
	}
}

</script>
 <fieldset>
	<?php echo form_open('order/edit_order', 'id="order_form"'); ?>
	<div class="order_box">

		<div class="order_title">
			<h1 id="name_form" class="name_form">PATIENT FORM</h1>
			<h2 id="form_id" class="form_id">No: <? echo  $current_client ; ?></h2>
			<p class="clear">&nbsp;</p>
		</div>
		
		<div class="subcateg_title">
			PATIENT INFORMATION
			( 
            <span id="patientinfo-show"><a href="javascript:show_div('patient_box')">Show</a></span>
			<span id="patientinfo-hide" style="display:none"><a href="javascript:hide_div('patient_box')">Hide</a> </span>
            )
		</div>
		<div class="info_box" id="patient_box" style="display:none;">
			<ul class="order_nav">
				<li>
					<p><label for="last_name" class="left">Last Name:</label><input type="text" id="last_name" name="last_name" class="field left" value="<? echo $lastname; ?>"/></p>
					<p><label for="first_name" class="left">First Name:</label><input type="text" id="first_name" name="first_name" class="field left size_field" value="<? echo $firstname; ?>"/></p>
					<p class="clear">&nbsp;</p>

				</li>
				<li>
					<p><label for="address_1_field" class="left">Address 1:</label><input type="text" id="address_1_field" name="address_1_field" value="<? echo $address; ?>" class="field left"/></p>
					<p><label for="address_2_field" class="left">Address 2:</label><input type="text" id="address_2_field" value="<? echo $address2; ?>" name="address_2_field" class="field left size_field"/></p>
					<p class="clear">&nbsp;</p>
				</li>	
				<li class="three_columns">	
					<p><label for="phone_1_field"   class="left">Phone 1:</label><input type="text" id="phone_1_field" name="phone_1_field" value="<? echo $phone; ?>" class="field left"/></p>
					<p><label for="phone_2_field"   class="left">Phone 2:</label><input type="text" id="phone_2_field" name="phone_2_field" value="<? echo $phone2; ?>" class="field left"/></p>
					<p><label for="phone_3_field"   class="left">Phone 3:</label><input type="text" id="phone_3_field" name="phone_3_field" value="<? echo $phone3; ?>" class="field left"/></p>
					<p class="clear">&nbsp;</p>
				</li>
				<li > 
					<p><label for="city"  class="left">City:</label><input type="text" id="city" name="city" value="<? echo $city; ?>" class="field left"/></p>

					<p id="zip_code_field"><label for="zip_code" class="left">Zip Code:</label><input type="text" id="zip_code" name="zip_code" value="<? echo $zip; ?>" class="field left size50"/></p>
					<p id="employer_field"><label for="patient_email_field" class="left">Patient email:</label><input type="text" id="patient_email_field" name="patient_email_field" value="<? echo $email; ?>" class="field left"/></p>
					<p class="clear">&nbsp;</p>
				</li>
			</ul>
			<p class="clear">&nbsp;</p>
		</div>
		
		<div class="subcateg_title">CONTACT INFORMATION</div>
		<div class="info_box" id="contact_box">
			
            <!--
		  <ul class="order_nav">
			<li class="left"><label for="mail_to_patient">Mail to Patient:</label><?php echo form_checkbox('mail_to_patient', 'accept', FALSE,'id="mail_to_patient"');?></li>
		  </ul>
          -->
          
		  <p class="clear">&nbsp;</p>
		  <ul class="order_nav" id="contact_detail">
		    <li>
				<p><label for="store" class="left">Store:</label><? foreach($list_all_store as $item){$key = $item['store_id'];$all_store_value[$key] = $item['name'];} echo form_dropdown('store',$all_store_value,$this->session->userdata('store_id'));?>
				</p>

				<p><label for="dispencer_id" class="left">Dispencer:</label><input type="text" id="dispencer_id" name="dispencer_id" class="field left" value="" /></p>
				<p><label for="carrier" class="left">Dispencer name:</label><span id='dispencer_name'></span></p>
				<?php /*<p><label for="doctor_id" class="left">Doctor:</label><?php echo $select_doctor;?></p>*/ ?>
				<p><label for="doctor_id" class="left">Doctor:</label>
                
				<?=$select_doctor?>                
                <!--<input type="text" id="doctor_id" name="doctor_id" /> -->
                
                </p>
			</li>
		  </ul>
		  <p class="clear">&nbsp;</p>
		</div>
		
        <div class="subcateg_title">
			<p style='padding-top:2px; margin-bottom:5px; color: #000000;font-size:12px;'>					
					<label for="date_now">Date </label> <input type="text" name="date_now" id="date_now" value="<?=date("Y-m-d")?>" />
			</p>
			Order type / Remake reason
		</div>
        <br style="clear:both" />
        <br />
        <div class="info_box" id="remake_box">
			    <div class="left">
					<?php echo  '<label  for="order_type">Order:</label>';?>
					<?$list_order_type = array_merge(array(""=>"- - - "),$list_order_type)?>
					<?php echo  form_dropdown('order_type',$list_order_type, '',' id="order_type" ' );?>
				</div>
				<div id="remake_reason_box" class="left" >
					<?php echo  '<label  for="remake_reason">Remake reason:</label>'; ?>
					<?php echo  form_dropdown('remake_reason', $list_remake_reasons, $remake_reason, 'id="remake_reason"' ); ?>
				</div>
				<p class="clear">&nbsp;</p>
        </div> 
		<div id="allHiddenDiv" style="display:none;" >
			
			<div class="subcateg_title">LENSES INFORMATION</div>

			<div class="info_box" id="lenses_box" >
				<div class="left_right_lenses left">
					<div class="legend_lenses">
						<span class="elem_0">&nbsp;</span>
						<span class="elem_1">Shere*</span>
						<span class="elem_2">Cylinder</span>
						<span class="elem_3">Axis</span>

						<span class="elem_4">Addition</span>
						<p class="clear">&nbsp;</p>
					</div>
							
					<div class="left_lenses">
						<span class="elem_0">LE</span>
						<span class="elem_1"><?php echo  form_dropdown('sphere_l', $sphere_values, $sphere_l );?></span>
						<span class="elem_2"><?php echo  form_dropdown('cylinder_l', $cylinder_values, $cylinder_l );?></span>
						<span class="elem_3"><?php echo  form_dropdown('axis_l', $axis_values, $axis_l );?></span>
						<span class="elem_4"><?php echo  form_dropdown('add_l', $add_values, $add_l );?></span>

						<p class="clear">&nbsp;</p>
					</div>					
					<div class="command_lenses">
						<span class="elem_0"><img src="<?php echo base_url();?>images/copytoright.gif"  alt="button" onclick='move_all()' /></span>
						<span class="elem_1"><img src="<?php echo base_url();?>images/copytoright.gif" id="img_sphere" alt="button"/></span>
						<span class="elem_2"><img src="<?php echo base_url();?>images/copytoright.gif" id="img_cylinder"  alt="button"/></span>
						<span class="elem_3"><img src="<?php echo base_url();?>images/copytoright.gif" id="img_axis"  alt="button"/></span>
						<span class="elem_4"><img src="<?php echo base_url();?>images/copytoright.gif" id="img_add"  alt="button"/></span>

						<p class="clear">&nbsp;</p>
					</div>
					<div class="right_lenses">
						<span class="elem_0">RE</span>
						<span class="elem_1"><?php echo  form_dropdown('sphere_r', $sphere_values, $sphere_r );?></span>
						<span class="elem_2"><?php echo  form_dropdown('cylinder_r', $cylinder_values, $cylinder_r );?></span>
						<span class="elem_3"><?php echo  form_dropdown('axis_r', $axis_values, $axis_r );?></span>
						<span class="elem_4"><?php echo  form_dropdown('add_r', $add_values, $add_r );?></span>
						<p class="clear">&nbsp;</p>
					</div>
					
				</div>
				<div class='prism_view'>
					Prism (  
                    		<span id="prism_show"><a href="javascript:show_div('prism_id');">Show</a></span>
                            
                            <span id="prism_hide" style="display:none"><a href="javascript:hide_div('prism_id');">Hide</a></span>
                          )
				</div>
				<div class='prism_view' id='prism_id' style='display:none'>
					<div class="prism left">
						<div style="width:180px; float:left;">
							<label for="prism1_r" >Prism_1 R:</label>
							<?php echo  form_dropdown('prism1_r', $prism_values, $prism1_r );?>
						</div>						
						<div style="width:180px; float:left;">
							<label for="base1_r" >Base_1 R:</label>
							<?php echo  form_dropdown('base1_r', $prism_values, $base1_r );?>
						</div>
						<div class="clear">&nbsp;</div>
					</div>
					<div class="prism left">
						<div style="width:180px; float:left;">
							<label for="prism1_l" >Prism_1 L:</label>
							<?php echo  form_dropdown('prism1_l', $prism_values, $prism1_l );?>
						</div>
						<div style="width:180px; float:left;">
							<label for="base1_l" >Base_1 L:</label>
							<?php echo  form_dropdown('base1_l', $prism_values, $base1_l );?>
						</div>						
						<div class="clear">&nbsp;</div>
					</div>
					<div class="base_view">&nbsp;<br /></div>
					<div class="prism left">
						<div style="width:180px; float:left;">
								<label for="prism2_r" >Prism_2 R:</label>
								<?php echo  form_dropdown('prism2_r', $prism_values, $prism2_r );?>
						</div>						
						<div style="width:180px; float:left;">
								<label for="base2_l" >Base_2 L:</label>
								<?php echo  form_dropdown('base2_l', $prism_values, $base2_l );?>
						</div>
						<div class="clear">&nbsp;</div>
					</div>								
					<div class="prism left">
						<div style="width:180px; float:left;">
							<label for="prism2_l" >Prism_2 L:</label>
							<?php echo  form_dropdown('prism2_l', $prism_values, $prism2_l );?>
						</div>
						<div style="width:180px; float:left;">
								<label for="base2_r" >Base_2 R:</label>
								<?php echo  form_dropdown('base2_r', $prism_values, $base2_r );?>
						</div>	
						<div class="clear">&nbsp;</div>
					</div>		
				</div>
				<div class='prism_view' style="width:100%"><br />&nbsp;</div>
				<div class="clear" style="width:100%">&nbsp;</div>
				<div class="add_distance_lenses" style="background:#dedede;">

					<ul>
						<li class="add_lenses">
							<ul class="add_lenses_elem">
								<li>
									<ul class="nav_bar">
										<li>Dist. PD *</li>
										<li><?php echo  form_dropdown('pd_far_r', $pd_values, $pd_far_r );?></li>
										<li>(RE) mm</li>

									</ul>
								</li>
								<li><span id="dist_image_lenses">&nbsp;</span></li>
								<li>
									<ul class="nav_bar">
										<li>Dist. PD *</li>
										<li><?php echo  form_dropdown('pd_far_l', $pd_values, $pd_far_l );?></li>
										<li>(LE) mm</li>

									</ul>
								</li>
							</ul>
						</li>
						<li class="add_lenses">
							<ul class="add_lenses_elem">
								<li>
									<ul class="nav_bar">
										<li>Near PD</li>

										<li><?php echo  form_dropdown('pd_near_r', $pd_values, $pd_near_r );?></li>
										<li>(RE) mm</li>
									</ul>
								</li>
								<li><span id="near_image_lenses">&nbsp;</span></li>
								<li>
									<ul class="nav_bar">
										<li>Near PD</li>

										<li><?php echo  form_dropdown('pd_near_l', $pd_values, $pd_near_l );?></li>
										<li>(LE) mm</li>
									</ul>
								</li>
							</ul>
						</li>
						<li class="add_lenses">
							<ul class="add_lenses_elem">

								<li>
									<ul class="nav_bar">
										<li>Height </li>
										<li><?php echo  form_dropdown('segment_height_r', $segment_height_values, $segment_height_r );?></li>
										<li>(RE) mm</li>
									</ul>
								</li>
								<li><span id="height_image_lenses">&nbsp;</span></li>

								<li>
									<ul class="nav_bar">
										<li>Height</li>
										<li><?php echo  form_dropdown('segment_height_l', $segment_height_values, $segment_height_l );?></li>
										<li>(LE) mm</li>
									</ul>
								</li>
							</ul>

						</li>
					</ul>
					<p class="clear">&nbsp;</p>
				</div>
                <!--
				<div class="details_lens">
					
					<label for="lens_type">Lens Type</label>
					<?php $list_lens_types = array('' => '- - -') + $list_lens_types; ?>
					<?php echo form_dropdown('lens_type', $list_lens_types, $lens_type,' id="lens_type" onchange="changeLensType();"'); ?>
					<label>Lens Brand</label>
                    <select id="lens_brand" name="lens_brand">
                    	
                    </select>
					<label for="lens_designs">Lens Design</label>
					<?php $list_lens_designs = array('0' => '- - -'); ?>
					<?php echo form_dropdown('lens_design', $list_lens_designs, $lens_design, ' id="lens_designs"'); ?>
					
					<label for="lens-color-checkbox">Lens Color?</label>
					<input id="lens-color-checkbox" type="checkbox" />
					<script type="text/javascript">
					$("input#lens-color-checkbox").click(function(){
						if ($(this).attr("checked")) {
							$("#lens-color-container").removeClass("hidden");
							if ($("input#lens-color-style-gradient").attr("checked")) {
								$("#lens-gradient-container").removeClass("hidden");
								$("#lens_color_field").val("35.00");
							} else {
								$("#lens-gradient-container").addClass("hidden");
								$("#lens_color_field").val("25.00");
							}
						} else {
							$("#lens-color-container").addClass("hidden");
							$("#lens_color_field").val("0");
						}
					});
					</script>
					
					<style>
					.details_lens span.hidden {
						display: none;
					}
					</style>
					
					<span id="lens-color-container" class="hidden">
						<label for="lens-color-select">Color</label>
						<?php 
							$options = $this->ajaxinventory->lens_color();
							$lens_colors = array('' => '- - -');
							foreach ($options as $row)
								$lens_colors[$row['id']] = $row['color'];
						?>
						<?php echo form_dropdown('lens_color', $lens_colors, $lens_color, ' id="lens_color"'); ?>
						
						<label for="lens-color-style-solid">Solid</label>
						<input id="lens-color-style-solid" type="radio" name="lens-color-style" value="solid" checked="checked" />
						<script type="text/javascript">
						$("input#lens-color-style-solid").click(function(){
							$("#lens-gradient-container").addClass("hidden");
							$("#lens_color_field").val("25.00");
						});
						</script>
						<label for="lens-color-style-gradient">Gradient</label>
						<input id="lens-color-style-gradient" type="radio" name="lens-color-style" value="gradient" />
						<script type="text/javascript">
						$("input#lens-color-style-gradient").click(function(){
							$("#lens-gradient-container").removeClass("hidden");
							$("#lens_color_field").val("35.00");
						});
						</script>
						
						<span id="lens-gradient-container" class="hidden">
							<?php echo form_dropdown('lens_gradient', $lens_gradient_params, $lens_gradient); ?>
						</span>
						
					</span>
					
					<div>
						<span>LENS MATERIAL</span> 
						<?php $list_lens_materials = array('0' => '- - -');?>
						<?php echo  form_dropdown('lens_material', $list_lens_materials, $lens_material , 'id="lens_materials"');?>
						<span>(Over +/- 6.00 attach RX)</span>							
					</div>
				
				</div>-->
                
                
                
                <div>
                
                		<div style="width:45%; float:left; text-align:left">
                        	<label style="display:inline-block; width:100px; text-align:left">Type</label>
                            <?php $list_lens_types = array('' => '- - -') + $list_lens_types; ?>
							<?php echo form_dropdown('lens_type', $list_lens_types, $lens_type,' id="lens_type" onchange="changeLensType();"'); ?>
                            <br/><br/>
                            
                            <label style="display:inline-block; width:100px; text-align:left">Brand</label>
                            <select id="lens_brand" name="lens_brand">
                            </select>
                            <br/><br/>
                            
                            <label style="display:inline-block; width:100px; text-align:left">Design</label>
                            <?php $list_lens_designs = array('0' => '- - -'); ?>
							<?php echo form_dropdown('lens_design', $list_lens_designs, $lens_design, ' id="lens_designs"'); ?>
                            <br/><br/>
                            
                            <label style="display:inline-block; width:100px; text-align:left">Material</label>
                            <?php $list_lens_materials = array('0' => '- - -');?>
							<?php echo  form_dropdown('lens_material', $list_lens_materials, $lens_material , 'id="lens_materials"');?>
                            <div style="margin-left:102px">(Over +/- 6.00 attach RX)</div>							
                            
                        </div>
                        
                        
                        <div style="width:40%; float:left; text-align:left">
                        	Lens Color<br/>
                            <div style="margin-left:35px">
                                Yes <input type="radio" checked="checked" name="lens_color" value="1" /><br/>
                                No &nbsp;<input type="radio" name="lens_color" value="0" /> 
                            </div>
                            <br/>
                            
                            <div id="div-has-lens-color">
								<?php 
                                $options = $this->ajaxinventory->lens_color();
                                $lens_colors = array('' => '- - -');
                                foreach ($options as $row)
                                    $lens_colors[$row['id']] = $row['color'];
                                ?>
                                
                                <label>Color</label> 
                                <?php echo form_dropdown('lens_color', $lens_colors, $lens_color, ' id="lens_color"'); ?><br /><br />
                                
                                Gradient<br/>
                                <div style="margin-left:35px">
                                    Yes <input type="radio" checked="checked" name="gradient" value="1" /><br/>
                                    No &nbsp;<input type="radio" name="gradient" value="0" /> 
                                </div> <br />
                                <div id="has-gradient-color">
                                    <label>Gradient Percentage</label>
                                    <?php echo form_dropdown('lens_gradient', $lens_gradient_params, $lens_gradient); ?>
                                </div>
                            </div>
                        </div>
                        
                		<div style="clear:both"/>
                </div>
                
                
				<div class="specific_lenses">
					<div align="center" style="line-height:2em">
                    <br />
                    	<span>
                    	    <label for="" style="width:80px;">Frame Enclosed</label>								
						    <input type='radio' name='frame_source' value='1' checked="checked">
                        </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        
                        <span>
                        <input type='radio' name='frame_source' value='0'>
                        <label for="frame_manufacturer" style="width:70px;">Supply Frame</label>
                        </span>
                    </div> <!-- centered -->
                    
                    <br />
					<div style="float:left; width:25%; text-align:left; margin-left:150px">
                    	<label style="display:inline-block; width:100px; text-align:left">Frame Manufacturer</label>	 
                        <?php echo  form_dropdown('frame_manufacturer', $list_frame_manufacturers, $frame_manufacturer, 'class="fe" id="frame_manufacturer" ' );?>
                        <input class="fe_manual" name="frame_manufacturer_m" type="text" style="width:70px; display:none" />
                        <br /><br />
                        <label style="display:inline-block; width:100px; text-align:left">Frame Division</label>
                        <? $list_frame_division = array(""=>"- - - "); ?>
                        <?php echo  form_dropdown('frame_division', $list_frame_division, $frame_division, 'class="fe" id="frame_division" ' );?>
                        <input class="fe_manual" name="frame_division_m" type="text" style="width:70px; display:none" />
                        <br /><br />
                        <label style="display:inline-block; width:100px; text-align:left">Frame Name</label>
                        <? $list_frame_name = array(""=>"- - - "); ?>
						<?php echo form_dropdown('frame_name', $list_frame_name, $frame_name, 'class="fe" id="frame_name" ' );?>
                        <input class="fe_manual" name="frame_name_m" type="text" style="width:70px; display:none" />
                         <br /><br />
                        <label style="display:inline-block; width:100px; text-align:left">Frame Color</label>
                        <? $list_frame_colors = array(""=>"- - - ");?>
						<?php echo  form_dropdown('frame_color', $list_frame_colors, $frame_color, 'class="fe" id="frame_color" ' );?>
                        <input class="fe_manual" name="frame_color_m" type="text" style="width:70px; display:none" />
                    </div> <!-- left float -->
                    
                    
                    <div style="float:left; width:35%; text-align:left; margin-left:15px">
                    
                    	<label style="display:inline-block; width:70px; text-align:left">Bridge Size</label>	 
                        <?php echo  form_dropdown('bridge_size', $bridge_values, $bridge_size, 'class="fe" id="bridge_size" '  );?></span>
                        <input class="fe_manual" name="bridge_size_m" type="text" style="width:30px; display:none" />
                        <br /><br />
                        <label style="display:inline-block; width:70px; text-align:left">Eye Size</label>	 
                       <?php echo  form_dropdown('eye_size', $eye_size_params, $eye_size , 'class="fe"'); ?></span>
                       <input class="fe_manual" name="eye_size_m" type="text" style="width:30px; display:none" />
                        <br /><br />
                        <label style="display:inline-block; width:70px; text-align:left">Temple Length</label>	 
                        <?php echo  form_dropdown('temple_length', $temple_length_values, $temple_length,'class="fe" id="temple_length" ' );?></span>
                        <input class="fe_manual" name="temple_length_m" type="text" style="width:30px; display:none" />
                        <br /><br />
                    </div> <!-- right float -->
					<!--
				   <ul>
						<li>
							<span class="elem_1" id="frame_label">
								<label for="frame_manufacturer" style="width:80px;">Frame Enclosed</label>								
								<input type='checkbox' name='frame_enclosed' value='1' style="width:20px;float:left">
							</span>							
							<span class="elem_2" id="frame_label">
								<label for="frame_manufacturer" style="width:70px;">Supply Frame</label>
								
							</span>
							<span class="elem_3">&nbsp;</span>
							<span class="elem_4">&nbsp;</span>
							<p class="clear">&nbsp;</p>
						</li>
						<li>							
							<span class="elem_1" id="frame_label">
								<label for="frame_manufacturer">Frame Manufact.</label>
								
								<?php echo  form_dropdown('frame_manufacturer', $list_frame_manufacturers, $frame_manufacturer, ' id="frame_manufacturer" ' );?>
							</span>							
							<span class="elem_2" id="frame_label">
								<label for="frame_manufacturer">Frame Division</label>
								<?$list_frame_division = array(""=>"- - - ");?>
								<?php echo  form_dropdown('frame_division', $list_frame_division, $frame_division, ' id="frame_division" ' );?>
							</span>
							<span class="elem_3">
								<label for="frame_name">Frame Name</label>
								<?$list_frame_name = array(""=>"- - - ");?>
								<?php echo form_dropdown('frame_name', $list_frame_name, $frame_name, ' id="frame_name" ' );?>
							</span>						
							<span class="elem_4"><label for="<?php echo @$bridge_size;?>">Bridge Size</label>
							<?php echo  form_dropdown('bridge_size', $bridge_values, $bridge_size, ' id="bridge_size" '  );?></span>
							<p class="clear">&nbsp;</p>
						</li>
						<li>
							<span class="elem_1" id="frame_label">
								<label for="frame_color">Frame Color</label>
								<?$list_frame_colors = array(""=>"- - - ");?>
								<?php echo  form_dropdown('frame_color', $list_frame_colors, $frame_color, ' id="frame_color" ' );?>
							</span>	
						
										
							<span class="elem_2" ><label for="<?php echo @$temple_length;?>">Temple Lenght</label><?php echo  form_dropdown('temple_length', $temple_length_values, $temple_length,' id="temple_length" ' );?></span>		
							<span class="elem_3" ><label for="temple_style">Eye Size</label><?php echo  form_dropdown('eye_size', $eye_size_params, $eye_size ); ?></span>	
							<span class="elem_4" >
								<input type='button' value='Check Inventory' onclick='check_frame()' style='border:1px solid #000;'>
							</span>	
							<p class="clear">&nbsp;</p>
						</li>
						<li>
							<p class="clear">&nbsp;</p>
						</li>
				   </ul> -->
				   <p class="clear">&nbsp;</p>
				</div>
				<div class="add_distance_lenses" id="ab_box_lenses">
					<ul>
						<li class="add_lenses">
							<ul class="add_lenses_elem">

								<li>
									<ul class="nav_bar">
										<li>A Box *</li>
										<li><?php echo  form_dropdown('lens_size_a', $lens_a_values, $lens_size_a  );?></li>
										<li>mm</li>
									</ul>
								</li>
								<li><span id="a_box_image_lenses">&nbsp;</span></li>

							</ul>
						</li>
						<li class="add_lenses">
							<ul class="add_lenses_elem">
								<li>
									<ul class="nav_bar">
										<li>B Box*</li>
										<li><?php echo  form_dropdown('lens_size_b', $lens_b_values, $lens_size_b );?></li>

										<li>mm</li>
									</ul>
								</li>
								<li><span id="b_box_image_lenses">&nbsp;</span></li>
							</ul>
						</li>
						<li class="add_lenses">
							<ul class="add_lenses_elem">

								<li>
									<ul class="nav_bar">
										<li>DBL *</li>
										<li>
											<?php echo  form_dropdown('dbl', $bridge_values, '', ' id="dbl" '  );?>		
										</li>
										<li>mm</li>
									</ul>
								</li>
								<li><span id="dbl_image_lenses">&nbsp;</span></li>

							</ul>
						</li>
						<li class="add_lenses">
							<ul class="add_lenses_elem">
								<li>
									<ul class="nav_bar">
										<li>ED *</li>
										<li><?php echo  form_dropdown('lens_size_ed', $lens_ed_values, $lens_size_ed );?></li>

										<li>mm</li>
									</ul>
								</li>
								<li><span id="ed_image_lenses">&nbsp;</span></li>
							</ul>
						</li>
					</ul>
					<p class="clear">&nbsp;</p>

				</div>
			</div>
			<div class="info_box" id="treatment_box">
			<ul>
				<li style='height:100px;'>
					<div style='float:left; width:200px;'>
						<label  for="select_lens_treatment">Available Treatment</label><?php echo  form_multiselect('select_lens_treatment', $list_lens_treatments, $lens_treatment,' id="select_lens_treatment" size="5"' );?>
					</div>
					<div style='float:left; width:200px;'>
						<label for="lens_treatment" >Selected Treatment</label><?php echo form_multiselect('lens_treatment[]',array(''=>'selected teatment'),'',' id="lens_treatment" size="5"');?>
					</div>
                    
                    <input type="hidden" id="real_treatments_selected" name="real_treatments_selected" />
					
					<div style='float:left; width:200px;'>
						<label  for="select_lens_treatment">Lens Coating</label>
						<?$arr[''] = "- - - "?>
						<?foreach($list_lens_coatings as $key => $val):
							$arr[$key]=$val;
						endforeach?>
						<?php echo  form_dropdown('lens_coating', $arr, $lens_coating,' id="lens_coating"' );?>
					</div>
				</li>				
				<li >
					<label  for="special_instruction">Special Instruction</label><?php echo @$special_instructions_field;?>
				</li>
			</ul>			
		</div>

			<div class="subcateg_title">INVOICE
					
			</div>
			<div class="info_box" id="invoice_box">
			<ul>
				
				<li><label for="referring_dr">REFERRING DR.</label><select name="referring_dr" id="referring_dr" ><option value="elem1">Elem 1</option><option value="elem2">Elem 2</option><option value="elem3">Elem 3</option></select></li>
				<li><label for="rx_expiration">RX. EXPIRATION</label><input name="rx_expiration" id="rx_expiration" type="text" /></li>
				<li><label for="diag_code">DIAGNOSIS CODES</label><?php echo form_dropdown('diag_code', $list_diag_codes, $diag_code, ' id="diag_code"' ) ; ?></li>
				<li><label for="carrier">Insurance Co.</label><? echo  form_dropdown('carrier', $list_carriers, $carrier,' id="carrier"'  ) . ' **'; ?></li>
				
				
				
				<li id='employer_div' style='display:none;' ><label for="invoice_employer_field">Employer</label><input type="text" name="invoice_employer_field" id="invoice_employer_field" value="<?php echo @$invoice_employer_field; ?>" /></li>
				<div style='display:none;' id='carrierHiddenDiv'>
					<li><label for="date_filed">DATE FILED</label><input type="text" name="date_filed" id="date_filed" value="<?php echo @$dob;?>"/></li>
					<li><label for="authorization">AUTHORIZATION</label><input type="text" name="authorization" id="authorization" value="<?php echo @$authorization_field ;?>" /></li>
                    
					<li><label for="insurance_id">Insurance ID</label><input type="text" name="insurance_id" id="insurance_id" value="<?php echo @$insurance_id_field; ?>" /></li>
					<li><label for="dob">D.O.B</label><input type="text" name="dob" id="dob" value="<?php echo @$dob;?>" /></li>
				</div>
				<li>
					<hr class='hr_invoice' />
				</li>
                
                <li>
                <label for="balance_due">BALANCE DUE   </label> <input type="text" name="balance_due" id="balance_due" />
                <br />
                <input type="button"  name="cal" value="Calculation" onclick="calculation()" style='border:1px solid #000; width:260px' />
                
                </li>
                <!--
				<li><label for="delivered_by">Delivered By</label><input type="text" name="delivered_by" id="delivered_by" /></li>
				<li><label for="form_date">Date</label><input type="text" name="form_date" id="form_date" /></li>
			-->
			</ul>
			<ul>				
				<li><label for="lenses_field">LENS</label><input type="text" name="lens_price" id="lenses_field" style='background:#FFD3E0'  value='0' readonly="readonly" /></li>
				<li><label for="frames_field">FRAMES</label><input type="text" name="frame_price" id="frames_field" style='background:#FFD3E0' value='0'  readonly="readonly" /></li>
				<li><label for="lens_color_field">LENS COLOR</label><input type="text" name="lens_color_field" id="lens_color_field" style="background:#FFD3E0" value="0" readonly="readonly"/></li>
				<li><label for="lens_coating_field">LENS COATING</label><input type="text" name="lens_coating_field" id="lens_coating_field" value='0' style='background:#FFD3E0'  readonly="readonly" /></li>
				<li style='display:none;' id='show_treatment'>
					<label for="lens_coating_field">TREATMENTS</label>
					<input type="hidden" name="lens_treatments_field" id="lens_treatments_field" value='0' style='background:#FFD3E0' disabled="disabled"  />
				
					<div id='all_selected_treatment' style='width:100%; float:left;'></div>
					<p class="clear">&nbsp;</p>
				</li>

				<li><label for="drop_other">OTHER</label><input type="text" name="drop_other" id="drop_other" value='0' /></li>
				<li><label for="drop_subtotal">SUBTOTAL</label><input type="text" name="subtotal_price" id="drop_subtotal" style='background:#FFD3E0' readonly="readonly" /></li>
				<li><label for="drop_discount">DISCOUNT</label><input type="text" name="drop_discount" id="drop_discount" value='0' style='background:#FFD3E0' disabled /></li>
				<li><label for="drop_total">TOTAL</label><input type="text" name="drop_total" id="drop_total" style='background:#FFD3E0'  readonly="readonly" /></li>
				<li><label for="drop_tax">TAX</label><input type="text" name="drop_tax" id="drop_tax" value='0' style='background:#FFD3E0'  readonly="readonly" /></li>
				<li><label for="drop_deposit">DEPOSIT</label><input type="text" name="drop_deposit" id="drop_deposit" value='0' /></li>
			</ul>
<!--
			<ul style='display:none'>				
				<li><input type="text" name="retail_lenses_field" id="retail_lenses_field" style='background:#FFD3E0'  disabled /></li>
				<li><input type="text" name="retail_frames_field" id="retail_frames_field" style='background:#FFD3E0'  disabled /></li>
				<li><input type="text" name="retail_lens_coating_field" id="retail_lens_coating_field" style='background:#FFD3E0'  disabled /></li>
				<li><input type="text" name="retail_lens_treatments_field" id="retail_lens_treatments_field" style='background:#FFD3E0'  disabled /></li>
			</ul>
-->
			<div class="clear">&nbsp;</div>
		</div>
		<div id="total_invoice">
			<p style='padding-right:137px;'></p>
						
		</div>
		</div>
		<input type="submit"  name="submit" value="Submit" />
	</div>
	<?php echo form_close(); ?>
 </fieldset>
