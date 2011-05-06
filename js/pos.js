/* ------------------------------------------------------------------------
	mysample
------------------------------------------------------------------------- */

function checkForOtherDoctor() {
    //var otherDoctorText = document.createTextNode('Other Doctor?');
    
    //return false;
    
    if($('select[id=doctor_id]').val()=='OTHER')			//DOUG 9-14-10 - I changed the value to OTHER to match the array key I changed - This was working until I added the dispencer_id field above this.  Sorry it's broke - The other box is displayed if you go BACK in the browser.  Strange
	{
		$('#otherDoctor').val('');
		$('#otherDoctor').show('slow')
	}
	else
	{
		$('#otherDoctor').val('');
		$('#otherDoctor').hide('slow')
		
	}
}
function remakeReason()
{
	 if($('#order_type').val()!='')
	 {
		if(($('#carrier').val()!='NONE') && ($('#carrier').val()!='DISCOUNT'))  //DOUG 9-14-10 - I changed the value to NONE and DISCOUNT to match the array key I changed in the mlists model - ask if any questions
		{
			alert('Field Insurance ID, D.O.B, Date Filed, Authorization, Diag Code');
			$('#order_type').val('');
			return false;
		}
		else if($('#order_type').val()=='New' || $('#order_type').val()=='')
		{
			$('#allHiddenDiv').show('slow');
		}
		else
		{
			var originalValueTrimmed = $.trim($('select[id=remake_reason]').val());              
			if(originalValueTrimmed!='')
			{
				$('#allHiddenDiv').show();
			} 
		}
		
	 }
	 
	 
	 if($('#order_type').val()=='New' || $('#order_type').val()=='')
		{
			$('#remake_reason_box').hide('slow')
		}
		else
		{
			
			if($('#remake_reason_box').css('display')=='none')
			$('#remake_reason_box').show('slow')
			
		}
/** change lens type ***/
	changeLenseType();
}
function changeLenseType()
{
	if($('select[name=lens_type]').val()=='1')
	{
		$('div[id^=segment_height_]').parent().hide('slow');
	}
	else
	{
		if($('div[id^=segment_height_]').parent().css('display')=='none')
			$('div[id^=segment_height_]').parent().show('slow');
	}
}

function usernameByDispercerId()
{
	$dispencer_id	=	$('input[id=dispencer_id]').val();
$.ajax(
		{
				type:'post',
				data:{"dispencer_id":$dispencer_id},
				url:$sitePath+"order/dispancerUsernameById",
				async: true,
				success:function(response)
				{
					$('#dispancerUsername').html(response);
					
				}
			});	
}

function getFrameDivisionByManufacturerId(val)
{
	document.body.style.opacity='0.65';
	document.body.style.cursor = 'wait';
	var div_id='frame_division';
	$.ajax({
	  url: $sitePath+'ajaxframe/generate_division',
	  type: "POST",
      data: ({id : val}),
	  success: function(data) {
		var div=data.split('^^^');
		$("#"+div_id).html("<option value=''> - - - </option>");
		for(var i=0; i<div.length; i++) 
		{
			if(div[i]!="")
			{
				div_info = div[i].split('|||');
				$("#"+div_id).append("<option value='" + div_info[0] + "'>" + div_info[1] + "</option>");
			}
		}  
		document.body.style.opacity='1';
		document.body.style.cursor = 'auto';
	  }
	}); 
}

function LensType()
{
	document.body.style.opacity='0.65';
	document.body.style.cursor = 'wait';
	
	val	=	$('select[name=lens_type]').val();
	var div_id='frame_name';
	$.ajax({
	  url: $sitePath+'ajaxframe/generate_frame',
	  type: "POST",
      data: ({id : val}),
	  success: function(data) {
		var div=data.split('^^^');		
		$("#"+div_id).html("<option value=''> - - - </option>");
		for(var i=0; i<div.length; i++) 
		{
			if(div[i]!="")
			{
				div_info = div[i].split('|||');
				$("#"+div_id).append("<option value='" + div_info[0] + "'>" + div_info[1] + "</option>");
			}
		}  
		document.body.style.opacity='1';
		document.body.style.cursor = 'auto';
	  }
	});
}


function getFrameNameByDivisionId(val)
{
	document.body.style.opacity='0.65';
	document.body.style.cursor = 'wait';
	var div_id='frame_name';
	$.ajax({
	  url: $sitePath+'ajaxframe/generate_frame',
	  type: "POST",
      data: ({id : val}),
	  success: function(data) {
		var div=data.split('^^^');		
		$("#"+div_id).html("<option value=''> - - - </option>");
		for(var i=0; i<div.length; i++) 
		{
			if(div[i]!="")
			{
				div_info = div[i].split('|||');
				$("#"+div_id).append("<option value='" + div_info[0] + "'>" + div_info[1] + "</option>");
			}
		}  
		document.body.style.opacity='1';
		document.body.style.cursor = 'auto';
	  }
	});
}

function getPrice(val)
{
	$.ajax({
	  url: $sitePath+'ajaxframe/frame_price',
	  type: "POST",
      data: ({id : val}),
	  success: function(data) {
		var div=data.split('^^^');
		$("#frames_field").val(div[0]);
		// $("#retail_frames_field").val(div[1]);
	  }
	});
}

function getLensCoatingPrice()
{
	val	=	$('select[name=lens_coating]').val();
	$.ajax({
	  url: $sitePath+'ajaxframe/coating_price',
	  type: "POST",
      data: ({id : val}),
	  success: function(data) {
		var div=data.split('^^^');
		$("#lens_coating_field").val(div[0]);
		// $("#retail_lens_coating_field").val(div[1]);
	  }
	});
}

function LensPrice()
{
	lens_design_id	=	$('select[name=lens_design]').val();
	lens_material	=	$('select[name=lens_material]').val();
	$.ajax({
	  url: $sitePath+'ajaxframe/lens_price',
	  type: "POST",
      data: ({lens_design_id : lens_design_id, lens_material_id : lens_material}),
	  success: function(data) {
		var div=data.split("^^^");
		$("#lenses_field").val(div[0]);
		// $("#retail_lenses_field").val(div[1]);
	  }
	});
}


function getTreatmentPrice(val)
{
	$.ajax({
	  url: $sitePath+'ajaxframe/treatment_price',
	  type: "POST",
      data: ({id : val}),
	  success: function(data) {
		var div=data.split('^^^');
		$("#lens_treatments_field").val(div[0]);
		// $("#retail_lens_treatments_field").val(div[1]);
	  }
	});
}


function add_treatment_price(val,text)
{
	/*$.ajax({
	  url: $sitePath+'ajaxframe/get_treatment_price',
	  type: "POST",
      data: ({id : val}),
	  success: function(data) {
		$("#show_treatment").show();
		var str ="<div style='padding:2px 0px 0px 0px;' id='treat_id_"+val+"' ><label for='treat_price' style='padding-left:15px;width:85px;'>"+text+"</label><input type='text' name='treat_price[]' id='treat_price' value='"+data+"' style='background:#FFD3E0'  disabled /></div>";
		$("#all_selected_treatment").append(str);
	  }
	});*/
}

function getFrameColorByName()
{
	$frame_id	=	$('select[name=frame_name]').val();
	$.ajax(
		{
				type:'post',
				data:{"frame_id":$frame_id},
				url:$sitePath+"order/getFrameColorByName",
				async: true,
				dataType:"json",
				jsonp:false,
				success:function(response)
				{
					
					makeSelectWithJson($('select[name=frame_color]'),response);
				}
			});	
}

function getLensDesignByTypeId()
{
	$lens_type_id	=	$('select[name=lens_type]').val();
	$.ajax(
		{
				type:'post',
				data:{"lens_type_id":$lens_type_id},
				url:$sitePath+"order/getLensDesignByTypeId",
				async: true,
				dataType:"json",
				success:function(response)
				{
					makeSelectWithJson($('select[name=lens_design]'),response);
				}
			});	
}

function getLensMaterialByDesignId()
{
	$lens_type_id	=	$('select[name=lens_design]').val();
	$.ajax(
		{
				type:'post',
				data:{"lens_type_id":$lens_type_id},
				url:$sitePath+"order/getLensMaterialByDesignId",
				async: true,
				dataType:"json",
				success:function(response)
				{
					makeSelectWithJson($('select[name=lens_material]'),response);
				}
			});	
}


function getLensPrice()
{
	$lens_type_id	=	$('select[name=lens_type]').val();
	$lens_design_id	=	$('select[name=lens_design]').val();
	if($lens_type_id==''||$lens_type_id=='0'||$lens_design_id==''||$lens_design_id=='0')
	{
		makeSelectWithJson($('select[name=lens_design]'),[]);
	}
	$.ajax({	type:'post',
				data:{"lens_type_id":$lens_type_id},
				url:$sitePath+"order/getLensDesignByTypeId",
				async: true,
				dataType:"json",
				success:function(response)
				{
					makeSelectWithJson($('select[name=lens_design]'),response);
				}
	});	
}

function check_frame()
{
	eye_size 	= $("#temple_length").val();
	bridge_size = $("#bridge_size").val();	
	color_id    = $("#lens_color").val();
	frame_id    = $("#frame_name").val();
	$.ajax({	type:'post',
				data:{"eye_size":eye_size,"bridge_size":bridge_size,"color_id":color_id,"frame_id":frame_id},
				url:$sitePath+"ajaxframe/check_frame",
				success:function(response)
				{
					if(response=='0')
						alert("out of stock");
					else
						alert("Avaiable");
				}
	});
}

function selectTreatmentAdd()
{
	$('select[name=select_lens_treatment] :selected').each(function(i, selected){ 
		//$('#selected_lens_treatment[value=6]')
		var alreadySelected = []; 
		
		$('select[id=lens_treatment] options').each(function(i,opt){ 
		
		alreadySelected[i] = $(opt).val()
		});

		if($.inArray($(this).val(),alreadySelected)==-1){
			$('select[id=lens_treatment]').append($("<option></option>")
																		 .attr("value",$(this).val())
																		 .text($(this).text())
			);
			add_treatment_price($(this).val(),$(this).text())
		}
	});
	
	if($('select[name=select_lens_treatment] :selected').val()!=''){

		var treat_div_id = $('select[name=select_lens_treatment] :selected').val();
		$("#treat_id_"+treat_div_id).remove();		
		$('select[name=select_lens_treatment] :selected').remove();
	};
	
	/*var str='';
	var j=0;
	$('select[id=lens_treatment] options').each(function(i,opt){
		if($(opt).val()!='')
		{
			if(j==0)
				str = $(opt).val();
			else
				str = str+','+$(opt).val();
			j++;
		}
	});
	if(str!='')
	{
		//getTreatmentPrice(str);
	}*/
}
function selectTreatmentRemove()
{
	if($('select[id=lens_treatment] :selected').val()!=''){

		var treat_div_id = $('select[id=lens_treatment] :selected').val();
		var treat_div_text = $('select[id=lens_treatment] :selected').text();
		$("#select_lens_treatment").append( $('<option></option>').val(treat_div_id).html(treat_div_text));
		$("#treat_id_"+treat_div_id).remove();
		
		$('select[id=lens_treatment] :selected').remove();
		
		

	};
	
/*	var str='';
	var j=0;
	$('select[id=lens_treatment] options').each(function(i,opt){
		if($(opt).val()!='')
		{
			if(j==0)
				str = $(opt).val();
			else
				str = str+','+$(opt).val();
			j++;
		}
	});
	if(j==0)
	{
		$("#show_treatment").hide();
	}*/
	//getTreatmentPrice(str);
}
function makeSelectWithJson(selectElement,newOptions)//first is the element and seccond is arrays 
{
var options = selectElement.attr('options');
$('option', selectElement).remove();

options[0] = new Option("- - -", "");

$.each(newOptions, function(val, text) {
    options[options.length] = new Option(text, val);
});

}


function dispencer_name(dispencer_id)
{
	$.ajax({
	  url: $sitePath+'ajaxframe/dispencer_name',
	  type: "POST",
      data: ({id : dispencer_id}),
	  success: function(data) {
		$("#dispencer_name").html(data);
	  }
	});
}