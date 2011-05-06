// JavaScript Document
	$(function() {
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		
		$( "#create-insurance" )
			.button()
			.click(function() {
				
				var data;
				
				$.get( BASE_URL  +  "inventory/insurance_info", function (html){
					$("<div></div>").html(html).dialog({
						title: "Add Insurance",
						buttons: {
									'Save & Add': function (){
										
												save($(this), 'add', true);
																	
										},
									Save: function () {
														
														save($(this),'add',false);
															
													  },
									Close: function (){ $(this).dialog("destroy"); }
								 }	
					});
				});
			});
			
			
			
			
			$(".a-insurance").live("click",function () {
				var id = this.id;
				
				$.get(BASE_URL + "inventory/insurance_info/" + id, function (html){
					$("<div></div>").html(html).dialog({
						title: "Edit Insurance",
						buttons: {
									
									Save: function () {
														save($(this),'edit',false);
													  },
									Close: function (){ $(this).dialog("destroy"); }
								 }	
					});
				});
			});
			
			
			$(".a-delete-insurance").live("click",function () {
			
				var id = $(this).attr('rel');
				var elem = $(this);
				var insurance = $(this).attr("insurance_name");
				$("<div>Sure to Delete Insurance? <br>Insurance: "+ insurance +"</div>").dialog({
						title: "Delete Confirmation",
						buttons: {
								Yes : function () {
										var m_dialog = $(this);
											$.post(BASE_URL + "inventory/insurance_delete", {id:id}, function (){
																															elem.parent().parent().fadeOut();
																															m_dialog.dialog("destroy");
																												          });
																														  
												  },
								No  : function () { $(this).dialog("destroy"); }										  
							}
					});
			
			});
			
			function save(m_dialog, m_op, m_add_more)
			{
					var bValid = true;
												
												bValid = bValid && checkLength( $("#insurance-name"), "Insurance", 3, 30 );
																					
												if(bValid)
												{
															data = $('#form-insurance-detail').serialize();
															
															$.post(BASE_URL + "inventory/insurance_save",data,function (type_id){
																
																		if (m_op == 'edit')
																		{
																			window.location.reload();
																			return
																		}
																
																		var template = '<tr><td><a href="#" class="a-type" id="__ID__">__INSURANCE__</a></td><td> <a href="#" rel="__ID__" insurance_name="__INSURANCE__" class="a-delete-insurance tooltip" title="Delete Insurance"><img src="'+ BASE_URL +'images/icons/delete.png"  /></a> </td></tr>';
																		
																		template = template.replace(/__ID__/g, type_id);
																		template = template.replace(/__INSURANCE__/g, $("#insurance-name").val());
																		
																		
																		$("#tbl_insurance tbody").append(template);
																		$(".tooltip").tipsy({gravity: 's'});
																		
																		
																		if (!m_add_more)
																			m_dialog.dialog("destroy");
																		else
																		{
																			$("#insurance-name").val("");
																			$('#insurance-name').focus();
																		}
																		
															});
												}	
			}
			
			
			
			
			
	});