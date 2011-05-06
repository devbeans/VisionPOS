// JavaScript Document
	$(function() {
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		
		$( "#create-doctor" )
			.button()
			.click(function() {
				
				var data;
				
				$.get( BASE_URL  +  "settings/doctor_info", function (html){
					$("<div></div>").html(html).dialog({
						title: "Add Doctor",
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
			
			
			
			
			$(".a-doctor").live("click",function () {
				var id = this.id;
				
				$.get(BASE_URL + "settings/doctor_info/" + id, function (html){
					$("<div></div>").html(html).dialog({
						title: "Edit Doctor",
						buttons: {
									
									Save: function () {
														save($(this),'edit',false);
													  },
									Close: function (){ $(this).dialog("destroy"); }
								 }	
					});
				});
			});
			
			
			$(".a-delete-doctor").live("click",function () {
			
				var id = $(this).attr('rel');
				var elem = $(this);
				var type = $(this).attr("doctor_name");
				$("<div>Sure to Delete Doctor? <br>Doctor Name: "+ type +"</div>").dialog({
						title: "Delete Confirmation",
						buttons: {
								Yes : function () {
										var m_dialog = $(this);
											$.post(BASE_URL + "settings/doctor_delete", {id:id}, function (){
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
												
												bValid = bValid && checkLength( $("#firstname"), "First Name", 3, 30 );
												bValid = bValid && checkLength( $("#lastname"), "Last Name", 3, 30 );
												bValid = bValid && checkLength( $("#email"), "Email", 3, 30 );
																					
												if(bValid)
												{
															data = $('#form-doctor-detail').serialize();
															
															$.post(BASE_URL + "settings/doctor_save",data,function (doctor_id){
																
																		if (m_op == 'edit')
																		{
																			window.location.reload();
																			return
																		}
																
																		var template = '<tr><td><a href="#" class="a-brand tooltip" title="Edit" id="__ID__">__ID__</a></td><td>__LNAME__</td><td>__FNAME__</td><td>__EMAIL__</td><td>__ADDRESS__</td><td> <a href="#" rel="__ID__" doctor_name="__LNAME__, __FNAME__" class="a-delete-doctor tooltip" title="Delete Doctor"><img src="'+ BASE_URL +'images/icons/delete.png"  /></a> </td></tr>';
																		
																		template = template.replace(/__ID__/g, doctor_id);
																		template = template.replace(/__LNAME__/g, $("#lastname").val());
																		template = template.replace(/__FNAME__/g, $("#firstname").val());
																		template = template.replace(/__ADDRESS__/g, $("#address").val());
																		template = template.replace(/__EMAIL__/g, $("#email").val());
																		
																		
																		$("#tbl_doctors tbody").append(template);
																		$(".tooltip").tipsy({gravity: 's'});
																		
																		
																		if (!m_add_more)
																			m_dialog.dialog("destroy");
																		else
																		{
																			$(':input','#form-doctor-detail')
																			 .not(':button, :submit, :reset, :hidden')
																			 .val('')
																			 .removeAttr('checked')
																			 .removeAttr('selected');
																			$('#lastname').focus();
																		}
																		
															});
												}	
			}
			
			
			
			
			
	});