	<link href="<?=base_url()?>includes/css/uni-form.css" media="screen" rel="stylesheet"/>
   
    <link href="<?=base_url()?>includes/css/default.uni-form.css" id="formStyle" title="Default Style" media="screen" rel="stylesheet"/>

    <!--[if lte ie 7]>
      <style type="text/css" media="screen">
        /* Move these to your IE6/7 specific stylesheet if possible */
        .uniForm, .uniForm fieldset, .uniForm .ctrlHolder, .uniForm .formHint, .uniForm .buttonHolder, .uniForm .ctrlHolder ul{ zoom:1; }
      </style>
    <![endif]-->
    
    <script type="text/javascript" src="<?=base_url()?>includes/js/uni-form.jquery.js"></script>
    <script type="text/javascript">
      $(function(){
        
        // init Uni-Form
        $('form.uniForm').uniform();
        
        // specific for this page
        
      });
    </script>


<!-- VIEW->search.php  -->		<div id="clientsearch" >
 <?php if (isset($table)) {	
		echo $table; '<BR />';
		} else {
			echo 'Sorry, no results found.';
			if (isset($button)){
		}
			echo '<p class="search-results"><BR>';
			if (isset($search_results) )
			{
				echo $search_results; 
			}
				echo '</p><BR>';
			}
		
		
		//link to add new client  - to be displayed on search results page
		if (@$show_add_new_client == true){
			echo '<p class="line_bottom">&nbsp;</p>';
			echo '<p id="add_client">' . anchor('main/new_client', '<span>'.$this->lang->line('add_new_client').'</span>',array('class'=>'button_grey_a') );
		}
	?>		
<div id="main-form" >
		 <!-- begin main form -->				
		 <link href="<?php echo base_url()."css/search.css";?>" rel="stylesheet" media="screen" type="text/css" />
		 <link href="<?php echo base_url()."js/modal/modal.css";?>" rel="stylesheet" media="screen" type="text/css" />
		 <!--<script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js"></script> -->
		 <script type="text/javascript" src="<?php echo base_url().'js/modal/modal_window.js';?>"></script> 
         <div style="width:60%">
         <form  id="client_search_form" method="post" action="<? site_url('main/search');?>" class="uniForm">
			<fieldset class="inlineLabels">
            		<h3>Search Patient</h3>
                    
                    <div class="ctrlHolder">
          				<label for="">Search Term</label>
                        <input type="text" maxlength="50" size="35" class="textInput small tooltip" title="Enter search keyword (e.g. Doug)" name="search_term" id="search_term" value="<?php if (isset($search_term) ) { echo $search_term; } ?>" style="color: rgb(175, 175, 175);" />
        			</div>
                    
                    <div class="ctrlHolder">
                    	<p class="label">Name Filter</p>
                        
                        <ul>
                        	<li>
                            	<input type="checkbox" name="searchoptionsname" id="nameonly" value="nameonly" /> Enable 
                            </li>
                            <li>
                            
                            	<input type="radio" name="namelike" id="namelike" value="like"  /> Like
		 		
		 		
		 							<input type="radio" name="namelike" id="nameexact" value="exact" /> Exact
		 		
                                
                            </li>
                        </ul>
                       
                    </div>
                    
                    <div class="ctrlHolder">
                    	<p class="label">Phone Only</p>
                        <ul>
                        	<li><input type="checkbox" name="searchoptionsphone" id="phoneonly" value="phoneonly" /> Enable</li>
                        </ul>
                    </div>
                    
                     <div class="ctrlHolder">
                    	<p class="label">Address Filter</p>
                        
                        <ul>
                        	<li>
                            	<input type="checkbox" name="searchoptionsaddress" id="addressonly" value="addressonly"  /> Enable 
                            </li>
                            <li>
                            	<input type="radio" name="addresslike" id="addresslike" value="like" /> Like
		 		
		 						<input type="radio" name="addresslike" id="addressexact" value="exact" /> Exact
                            </li>
                        </ul>
                       
                    </div>
                    
                    <div class="ctrlHolder">
                    	<p class="label">Everything</p>
                        <ul>
                        	<li><input type="checkbox" name="searchoptionseverything" id="everything" value="everything" /> Enable</li>
                        </ul>
                    </div>
                    
                    
                    <div class="ctrlHolder">
                    	<p class="label">Search MAS 90</p>
                        <ul>
                        	<li><input type="checkbox" name="includemas90" id="includemas90" value="includemas90" /> Enable</li>
                        </ul>
                    </div>
                    
                    
                    <div class="ctrlHolder">
                    	<p class="label">Include Archived</p>
                        <ul>
                        	<li><input type="checkbox" name="includearchived" id="includearchived" value="includearchived" /> Enable</li>
                        </ul>
                    </div>
                    
                    <div class="buttonHolder">
                        
                        <button class="primaryAction" type="submit">Search</button>
                      </div>
                    
                    
            </fieldset>
            

	</form>
    </div>     
      <!--
         
		 <form id="client_search_form" method="post" action="<? site_url('main/search');?>">
		 	<div id="search_for" >
		 		<span class="label_text">Search for?</span>	
				<input type="text" name="search_term" id="search_term" value="<?php if (isset($search_term) ) { echo $search_term; } ?>" />		
		 	</div>
		 	<div id="search_name_options" >	
		 		<span class="label_text">Name Only</span>
		 		<input type="checkbox" name="searchoptionsname" id="nameonly" value="nameonly" />
		 		<label for="namelike" >Like</label>
		 		Or
		 		<input type="radio" name="namelike" id="namelike" value="like"  />
		 		<label for="namelike" >Exact</label>
		 		<input type="radio" name="namelike" id="nameexact" value="exact" />
		 	</div>
		 	<div id="search_phone_options" >
		 		<span class="label_text">Phone Only</span>
		 		<input type="checkbox" name="searchoptionsphone" id="phoneonly" value="phoneonly" />
		 	</div>
		 	<div id="search_address_options" >
		 		<span class="label_text">Address Only</span>
		 		<input type="checkbox" name="searchoptionsaddress" id="addressonly" value="addressonly"  />
		 		<label for="addresslike" >Like</label>
		 		Or
		 		<input type="radio" name="addresslike" id="addresslike" value="like" />
		 		<label for="addresslike" >Exact</label>
		 		<input type="radio" name="addresslike" id="addressexact" value="exact" />
		 	</div>
		 	<div id="search_everything_option" >
		 		<span class="label_text">Everything</span>
		 		<input type="checkbox" name="searchoptionseverything" id="everything" value="everything" />
		 	</div>
		 	<div id="search_mas90_options" >
		 		<span class="label_text">Search MAS 90</span>
		 		<input type="checkbox" name="includemas90" id="includemas90" value="includemas90" />
		 	</div>
		 	<div id="search_everything_option" >
		 		<span class="label_text">Include Archived</span>
				<input type="checkbox" name="includearchived" id="includearchived" value="includearchived" />
		 	</div>
		 	<div>
				<button  class="button_grey" type="submit" value="search" id="search_button" name="search_button" >
					<span>search</span>
				</button>
				<span style="float:left;display:block;width:10px;">&nbsp;</span>
				<a class="button_grey_a" href="#dialog2" name="modal"><span>Help ?</span></a>
		 	</div>
			<div class="clear">&nbsp;</div>
		 </form>	-->
<!-- End of search-submit-field -->		 <!-- dialog help-->
</div>		


		<!-- START MODAL -->
		<div id="boxes">
			<!-- Start of Sticky Note -->
			<div id="dialog2" class="window">
				 <p> <?php echo $this->lang->line('search_help_intro');?></p>
					
				<div class="search-instructions" >
					<?php echo $this->lang->line('search_help_details');?>
				</div>
				<input type="button" value="Close it" class="close"/>
			</div>
			<!-- End of Sticky Note -->
			
			<!-- Mask to cover the whole screen -->
			<div id="mask"></div>
		</div>
		<!--END MODAL  -->
 </div> 
	