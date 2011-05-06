<?php
class Main extends Controller 
{

		// Used for registering and changing password form validation
		var $min_username = 3;
		var $max_username = 20;
		var $min_password = 5;
		var $max_password = 20;	
		
	function Main()	{
		parent::Controller();
				
	    $buildheadercontent = '';
		
		$buildheadercontent .= '<link href="' . base_url() . 'css/cssReset.css" rel="stylesheet" type="text/css">';
		$buildheadercontent .= '<link href="' . base_url() . 'css/default.css" rel="stylesheet" type="text/css">';
	
		//take user to the login page when session expires. 
		$buildheadercontent .= '<meta http-equiv="Refresh" content="' . $this->config->item('sess_expiration') . ';url=' . base_url() . 'auth/login">';
		
	    //$buildheadercontent .= '<link href="' . base_url() . 'css/prettyCheckboxes.css" rel="stylesheet" type="text/css">';
		//$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/jquery-1.3.2.js"></script> ';
		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/calendar/calendar.js"></script> ';
		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/calendar/lang/calendar-en.js"></script> ';
		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/calendar/calendar-setup.js"></script> ';
//		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/function_search.js"></script>';
		//$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/prototype.js"></script> '; @DOUG 16-09-2010 conflict with JQUERY library
//		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/effects.js"></script> ';
//		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/controls.js"></script> ';
		
		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/prettyCheckboxes.js"  charset="utf-8"></script>';
		//$buildheadercontent .= '<!-- the scriptaculous javascript library is available at http://script.aculo.us/ -->'; //</script>;

		//echo '<script type="text/javascript">  var _gaq = _gaq || [];  _gaq.push([''_setAccount'', ''UA-5136386-9'']); _gaq.push([''_trackPageview'']);  (function() {    var ga = document.createElement(''script''); ga.type = ''text/javascript''; ga.async = true;    ga.src = (''https:'' == document.location.protocol ? ''https://ssl'' : ''http://www'') + ''.google-analytics.com/ga.js'';    var s = document.getElementsByTagName ''script'')[0]; s.parentNode.insertBefore(ga, s);  })(); </script>';

		$loadmyjs['extraHeadContent'] =	$buildheadercontent;
		$this->load->vars($loadmyjs);		
		$this->load->library('Form_validation');
		$this->load->library('DX_Auth');
		$this->load->library('Table');
		$this->load->library('Pagination');
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		// $this->config->item('sess_expiration')
		// $this->session->userdata('last_activity')
		
		//If not yet set then l set the session for StoreName to display in the NAVBAR.  
		//  Useres DX_Auth User_id to lookup the store id then look up the store name.
		if ($this->dx_auth->is_logged_in()){
			if (!$this->session->userdata('storename') ) {
				$this->load->model('mstores');
				$this->load->model('musers');
				$this->session->set_userdata('store_id' , $this->musers->GetStoreID($this->dx_auth->get_user_id()));
				$this->session->set_userdata('storename', $this->mstores->getStoreName($this->session->userdata('store_id')));
				$this->session->set_userdata('storenumber', $this->mstores->getStoreNumber($this->session->userdata('store_id')));
								
			}
		} 	
	}
	
	function testemail($email, $from, $subject, $message)
	{
		$this->load->library('email');

		$this->email->from($from, $from);
		$this->email->to($email);
		$this->email->subject($subject);
		$this->email->message($message);
		
		$this->email->send();
		
		echo $this->email->print_debugger();
	}

	function index()
	{
	
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			$this->login();
		} else {
//			$data['title'] = 'Real Optics Inc Client Data System';		
//			$data['main'] = 'main/main';
//			$this->load->vars($data);
//			$this->load->view('template');

			redirect ('main/search', 'location');
		}
	}
	

	function support()
	{
		$data['title'] ='Contact Support';
		$data['main'] = 'support/support';
		$this->load->vars($data);
		$this->load->view('template');		
	}
	
	function about()
	{
		$data['title'] = "About this system";
		$data['main'] = 'main/about';
		$this->load->vars($data);
		$this->load->view('template');
	}
	
	function new_client()
	{
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			$this->login();
		} else {
	  		if ($this->input->post('firstname'))
	  		{ 
				$this->mclients->addClient(); 
			    $this->session->set_flashdata('flashmessage','Client created');
	    		redirect('order','location'); 

		  	}	else	{ 
			    $data['title'] = "Add new Client"; 
			    $data['main'] = 'client/input_add'; 
			    $this->load->model('mdoctors');
				$data['content_doctors'] = $this->mdoctors->get_dropdown_array('doctor_id', 'lastname');
			    $this->load->model('mstates');
			    $data['content_stores'] = $this->mstores->get_dropdown_array('store_id', 'name');
				$data['content_states'] = $this->mstates->get_dropdown_array('state_abbr', 'state');
				$data['prepop_lastexam'] = date("Y-n-j", mktime(0, 0, 0, date("m") , date("d") , date("Y"))); 
				$data['prepop_lastpurchase'] = date("Y-n-j", mktime(0, 0, 0, date("m") , date("d") , date("Y"))); 
			    $this->load->vars($data); 
			    $this->load->view('template');    
			} 
		}
	}
	
	function archive_client()
	{
		if ( ! $this->dx_auth->is_logged_in() )
		{				 
			$this->login();
		} else {
			$this->mclients->archiveClient();
			$this->session->set_flashdata('flashmessage', 'Client set to inactive status');
			redirect('main/display_client/' . $this->uri->segment(3) ,'location');
		}	
	}	
	
	function unarchive_client()
	{
		if ( ! $this->dx_auth->is_logged_in() )
		{				 
			$this->login();
		} else {
			$this->mclients->unArchiveClient();
			$this->session->set_flashdata('flashmessage', 'Client set to back to Active');
			redirect('main/display_client/' . $this->uri->segment(3) . '/' . $this->uri->segment(4) ,'location');
		}
	}
	
	function edit_client()
	{
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			$this->login();
		} else {
			if ($this->uri->segment(3))
			{	
				if ($this->input->post('submit')){
					$this->session->set_flashdata('flashmessage','Client record updated');
					if ( $this->uri->segment(4) == 'editmas90' ) {
						$this->load->model('mmas90data');
						$this->mmas90data->editClient_mas90();
						redirect('main/search/' . $this->uri->segment(3) ,'location');
					} else {
						$this->mclients->editClient();
						redirect('main/display_client/' . $this->uri->segment(3) ,'location');
					}
					 
				    
		    		 
					
				} else {
					$data['title'] = "Edit Client x"; 
					$data['addoreditpage'] = 'edit_client/' . $this->uri->segment(3);
					
					 
				    $this->load->model('mstates');
					$data['content_states'] = $this->mstates->get_dropdown_array('state_abbr', 'state');
					if ( $this->uri->segment(4) == 'editmas90' ) {
						$this->load->model('mmas90data');
						$data['clientdata'] = $this->mmas90data->getmas90ClientRecord($this->uri->segment(3));
						$data['main'] = 'client/input_edit_mas90'; 
					} else {
						$data['main'] = 'client/input_edit'; 
						$this->load->model('mdoctors');
						$data['content_doctors'] = $this->mdoctors->get_dropdown_array('doctor_id', 'lastname');
						$this->load->model('mstores');
						$data['content_stores'] = $this->mstores->get_dropdown_array('store_id', 'name'); 
						$data['clientdata'] = $this->mclients->getClientRecord($this->uri->segment(3));	
						$data['prepop_lastpurchase'] = date("Y-n-j", mktime(0, 0, 0, date("m") , date("d") , date("Y")));
						$data['prepop_lastexam'] = date("Y-n-j", mktime(0, 0, 0, date("m") , date("d") , date("Y")));
					}
					
					$this->load->vars($data); 
					//echo print_r($data['content_doctors']);
					$this->load->view('template'); 
				}   
			 } else {
			 	redirect ('main/search', 'location');
			 }
		}
	} 

	function archive_clients()
	{
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			$this->login();
		} else {
			$data['title'] = "Archive Inactive Clients";
			$data['main'] = 'archive_clients';
			$data['includemas90'] = 'includemas90';
			$this->load->vars($data);
			$this->load->view('template');
		}
	}
	
	function archivemas90()
	{
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			$this->login();
		} else {
			$this->load->model('mmas90data');
			$this->mmas90data->archiveclient($this->uri->segment(3));
		 
			$data['title'] = "Archive MAS90 Client";
			$data['main'] = 'main/search';
			$data['includemas90'] = 'includemas90';
			$this->load->vars($data);
			$this->load->view('template');
		}
	}
	
	function unarchivemas90()
	{
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			$this->login();
		} else {
			$this->load->model('mmas90data');
			$this->mmas90data->unarchiveclient($this->uri->segment(3));
		 
			$data['title'] = "Un-Archive MAS90 Client";
			$data['main'] = 'main/search';
			$this->load->vars($data);
			$this->load->view('template');
		}
	}

	function ajaxsearch()
	{
		$search_term = $this->input->post('search_term');
		$details = $this->input->post('client_details');
		echo $this->Mclients->getSearchResults($search_term, $details);
	}
        
	function search()
	{	
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			$this->login();
		} else {
		
			//create a segment variable saerch_box boolean
			$data['show_searchbox'] = false;
			$data['show_add_new_client'] = false;
			
			if ($this->uri->segment(3) == "search" )
			 {
				$data['show_searchbox']= true; 
			 }
			 
			if(strlen($this->input->post('search_button')) >0)
			{
				$data['show_add_new_client'] = true;
			}
			
	 		if ($this->input->post('search_term'))
	  		{ 

				$data['title'] = 'Database Query Search Results';
				$search['search_term'] = $this->input->post('search_term');
				$search['includearchived'] = $this->input->post('includearchived');
				$search['searchoptionsname'] = $this->input->post('searchoptionsname');
				$search['searchoptionsphone'] = $this->input->post('searchoptionsphone');
				$search['searchoptionsaddress'] = $this->input->post('searchoptionsaddress');
				$search['searchoptionseverything'] = $this->input->post('searchoptionseverything');
				$search['namelike'] = $this->input->post('namelike');
				$search['addresslike'] = $this->input->post('addresslike');
				$search['includemas90'] = $this->input->post('includemas90');
				if ( isset( $data['includemas90'] )) 
					$search['includemas90'] = 'includemas90';
					
				//echo '<BR>namelike = ' . $search['namelike'] . '<BR>';

				if ( $this->input->post('searchoptionsname') == 'nameonly' )	{
					$search['searchoptionsname'] = 'nameonly';
				} elseif ( $this->input->post('searchoptionsaddress') == 'addressonly' )	{
					$search['searchoptionsaddress'] = 'addressonly';
				}  elseif ( $this->input->post('searchoptionsphone')  == 'phoneonly')	{
					$search['searchoptionsphone'] = 'phoneonly';
				} else {
					$search['searchoptionseverything'] = 'everything';
				}
				
				$searchresults = $this->mclients->getSearchResults($search);
				
				$resultrows = array();
				if (isset($searchresults) )	{
					$searchheader = ' ';
					//echo print_r($searchresults);
					if ( $search['includemas90'] == 'includemas90' ) {
					
						$searchheader = '<B> MAS90 </b>';
						foreach ($searchresults as $rows)	{
							$status = 'Active';
							$buttonfunction = 'main/archivemas90/';
							$buttontitle = 'Archive';
							if ( $rows['archive'] == 1 )  { $status = 'Archived'; $buttonfunction = 'main/unarchivemas90/'; $buttontitle = 'Un-Archive';}
							$row = array(
						    anchor( 'main/edit_client/' . $rows['customer_number'] . '/editmas90', $rows['firstname'] ),
						    $rows['address'],
						    $rows['city'],
						    $rows['phone'],
							$status,
						    anchor( $buttonfunction . $rows['customer_number'], $buttontitle)
						    				    
						);
						$this->table->add_row($row);
						}
						$this->table->set_heading(array('Client',  'Address', 'City', 'Phone','Status' ,'Archive'));
						
					} else {
						foreach ($searchresults as $rows)	{
							$row = array(
		                    anchor('main/display_client/' . $rows['client_id'] , $rows['firstname'] . ' ' . $rows['lastname']),
		                    $rows['address'],
		                    $rows['city'],
		                    $rows['phone'],
		                    anchor( 'order/edit_order/' . $rows['client_id'] . '/shortcut', '<img src="' . site_url() . 'images/create_order.png">' )
						);
						$this->table->add_row($row);
						}
						$this->table->set_heading(array('Client',  'Address', 'City', 'Phone', 'New Order'));
					}
				
	                $this->table->set_caption('Your' . $searchheader . 'search results for <B>' . $search['search_term'] . '<B>' .'<p><p/>'); //MAS90 header
					
					$tmpl = array (
	                    'table_open'          => '<table class="search-results-table-box" border="1" cellpadding="4" cellspacing="1">',
	
	                    'heading_row_start'   => '<tr>',
	                    'heading_row_end'     => '</tr>',
	                    'heading_cell_start'  => '<th class="search_results_header">',
	                    'heading_cell_end'    => '</th>',
	
	                    'row_start'           => '<tr class="search_results_table_row_even">',
	                    'row_end'             => '</tr>',
	                    'cell_start'          => '<td>',
	                    'cell_end'            => '</td>',
	
	                    'row_alt_start'       => '<tr class="search_results_table_row_odd">',
	                    'row_alt_end'         => '</tr>',
	                    'cell_alt_start'      => '<td>',
	                    'cell_alt_end'        => '</td>',
	
	                    'table_close'         => '</table>'
	              );
	
					$this->table->set_template($tmpl); 
									
					$data['table'] =  $this->table->generate();
					
				} else {
					$this->session->set_flashdata('flashmessage', $searchresults); 
				}

				$data['main'] = 'main/search';
				$data['button'] = True;
				$data['includearchived'] = $this->input->post('includearchived');
				$data['includemas90'] = $this->input->post('includemas90');
				$data['searchoptionsname'] = $search['searchoptionsname'];
				$data['searchoptionsphone'] = $search['searchoptionsphone'];
				$data['searchoptionsaddress'] = $search['searchoptionsaddress'];
				$data['searchoptionseverything'] = $search['searchoptionseverything'];
				$data['search_term'] = $this->input->post('search_term');
				$data['namelike'] = $this->input->post('namelike');
				$data['addresslike'] = $this->input->post('addresslike');
				
				$this->load->vars($data);
				$this->load->view('template');
		  	}	else	{ 
		  		//$this->session->set_flashdata('flashmessage','test');  (FINISH THIS LATER)
		  		$data['table'] = '';
				$data['title'] = 'Database Query Search';
				$data['main'] = 'main/search';
				$this->load->vars($data);
				$this->load->view('template');
			}
		}
	}
	
	function display_client()
	{
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			$this->login();
		} else {
		
			$this->session->set_userdata('current_client' , $this->uri->segment(3) ) ;
			
			$data['title'] = "Client Display Screen " . $this->uri->segment(3);
			$data['clientdata'] = $this->mclients->getClientRecord( $this->uri->segment(3) );
			$this->load->model('mledger');
			$this->load->model('morders');
			$this->load->model('minvoices');
				
			$uninvoiced_orders = $this->morders->check_for_uninvoiced_order( $this->session->userdata('current_client') );
		
	
//			if ($uninvoiced_orders == 0 ) {
				$data['new_order_button'] = anchor('order/edit_order/' . $this->uri->segment(3) , "New Order");
//			} else {
//				$data['new_order_button'] = 'See uninvoiced orders below';
//			}
			
			$orders = $this->morders->getOrders( $this->session->userdata('current_client') );
			$resultrows = array();
			if (isset( $orders ) )	{
			
				//echo print_r($orders);
				$numresults = 0;
				foreach ($orders as $rows)	{
					if ( $rows['paid_in_full'] <> 1 )
					{
						$paid_in_full = 'Not Paid';
					} else {
						$paid_in_full = 'Paid';
					}
					
					if ($rows['delivered_date'] == '0000-00-00' )
					{
						$delivered_date = 'Pending';
					} else {
						$delivered_date = $rows['delivered_date'];
					}
					
					//get the invoice ID for the order_id
					$invoice_id = $this->minvoices->get_invoice_id( $rows['order_id'] );
				
					$row = array(
			        anchor( 'order/view_order/' . $rows['order_id'] , $rows['order_id'] ), 
			        $rows['order_date'],
			        $delivered_date,
			        $rows['order_type'],
			        $paid_in_full , 
			        anchor( 'invoice/view/' . $invoice_id, $invoice_id ),
					);
					$this->table->add_row($row);
					$numresults++;
					
					$this->table->set_heading(array('order_id',  'order_date', 'delivered_date', 'order_type', 'paid_in_full', 'View Invoice'));
					$tmpl = array (
		                'table_open'          => '<table class="search-results-table-box" border="1" cellpadding="4" cellspacing="1">',
		                'heading_row_start'   => '<tr>',
		                'heading_row_end'     => '</tr>',
		                'heading_cell_start'  => '<th class="list_orders_header">',
		                'heading_cell_end'    => '</th>',
		                'row_start'           => '<tr class="list_order_table_row_even">',
		                'row_end'             => '</tr>',
		                'cell_start'          => '<td>',
		                'cell_end'            => '</td>',
		                'row_alt_start'       => '<tr class="list_orders_table_row_odd">',
		                'row_alt_end'         => '</tr>',
		                'cell_alt_start'      => '<td>',
		                'cell_alt_end'        => '</td>',
		                'table_close'         => '</table>'
		          );

					$this->table->set_template($tmpl); 		
					$data['list_orders'] = $this->table->generate();
					
					
				}
			}
			
			$balance = $this->mledger->get_client_balance('balance'	);		
			if ($balance != 0 ) 
			{	//customer has a balance
				$balance_statement = '<b><font color="red">Account Balance: ' . $balance . '</font></b>';
			} else {
				$balance_statement = 'Customer has no balance';
			}
			$data['balance_statement'] = $balance_statement;
			//Add checkfor doctor_id here and display flash message if missing. Note for DOUG
			$data['main'] = "client/display";
			$this->load->vars($data);
			$this->load->view('template');
		}
	}
	
	function import_clients()
	{	
	
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			$this->login();
		} else {
			
			$this->load->model('mstores');

			$data['content_stores'] = $this->mstores->get_dropdown_array('store_id', 'name'); 
		
			$data['title'] = "Client Mass Import - CSV Upload";
			$data['errors'] = array('error' => ' ' );
			$data['main'] = 'upload/upload_form';
			$data['store_id'] = $this->dx_auth->get_store_id();
			$this->load->vars($data);
			$this->load->view('template');
		}
	}
	
	function do_upload()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'csv';
		$config['max_size']	= '0';
		
		$this->load->library('upload', $config);
	
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('upload_form', $error);
		}	
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$importdata['fullpath'] = $data['upload_data']['full_path'];
			$importdata['filename'] = $data['upload_data']['file_name'];
			$importdata['store_id'] = $this->input->post('store_id') ;
			$this->import($importdata);

			redirect('main/search', 'location');								
		}
	}	
	function do_uploadmas90data()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'csv|tsv|xls';
		$config['max_size']	= '0';
		
		$this->load->library('upload', $config);
	
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('upload_form', $error);
		}	
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$importdata['fullpath'] = $data['upload_data']['full_path'];
			$importdata['filename'] = $data['upload_data']['file_name'];
			$importdata['store_id'] = $this->input->post('store_id') ;
			$this->import_mas90($importdata);

			redirect('main/search', 'location');								
		}
	}

	function import_mas90($importdata)
	{
		$importresults = '';
		$dest = '/tmp/' . $importdata['filename'];
	
		if ( !copy($importdata['fullpath'], $dest) )
	            echo "Could not copy CSV file to temporary directory ready for importing.";
	         
	        $query = $this->db->query("LOAD DATA LOCAL INFILE \"$dest\" REPLACE INTO TABLE mas90_temp FIELDS TERMINATED BY '\t' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\n' (customer_number, customer_name, address1, address2, address3, city, state, zipcode, phone, period, amount )"); 
	                	        
	        if ($query) {
            $importresults .=   "<BR>All MAS90 items imported successfully.<BR><BR>";
	        } else {
	            $importresults .= "Import failed.<BR>";
	        }
	        
	        unlink ($dest); 
	       
	        //Check if already imported
	        $command = 'SELECT count(temp.customer_number) AS numrecords FROM mas90_temp temp JOIN mas90trans trans ON trans.customer_number = temp.customer_number AND trans.period = temp.period AND trans.amount = temp.amount';
	        $query = $this->db->query($command);
	        foreach ($query->result() as $row){
	        	$number_existing_records =  $row->numrecords;
	        }
	        
	        if ( $number_existing_records == 0 ) 
	        {
	        
		        $command = 'INSERT INTO mas90data ( customer_number, customer_name, address1, address2, address3, city, state, zipcode, phone ) SELECT customer_number, customer_name, address1, address2, address3, city, state, zipcode, phone FROM mas90_temp WHERE customer_number NOT IN ( SELECT customer_number FROM mas90data  )';
		        $query = $this->db->query($command);
			   if ($query) {
			    	$importresults .=  '<p> - Import new clients from mas90temp to mas90data complete<BR>' . '<i>' . $command .'</i></p>';
			    } else {
			    	$importresults .= 'Import new clients from mas90temp to mas90data failed.<BR>';
			    }
			    		    
			    $command = 'INSERT INTO mas90trans ( customer_number, period, amount ) SELECT customer_number, period, amount FROM mas90_temp;';
				$query = $this->db->query($command);
				if ($query) {
				   	$importresults .=  '<p> - Import MAS90 Transactions complete<BR>' . '<i>' . $command .'</i></p>';
				   } else {
				   	$importresults .= 'Import MAS90 Transactions  failed.<BR>';
				   } 
		   
		      	$this->load->model('mmas90data');
		      	$fieldname = 'customer_name';
		      	$this->mmas90data->set_proper_case();
		      	$this->mmas90data->split_customer_name();
		    	
			} ELSE {
				$importresults = 'Data set has already been imported.  Import ABORTED - ' . $number_existing_records;
			}
			
			$command = 'DELETE FROM mas90_temp where 1 = 1;';
			$query = $this->db->query($command);
			
			if ($query) {
			   	$importresults .=  '<p> - DELETE from mas90_temp complete<BR>' . '<i>' . $command .'</i></p>';
			} else {
			   	$importresults .= 'Delete from mas90_temp failed.<BR>';   
			}
	      	
	        $this->session->set_flashdata('flashmessage', $importresults);         
	}
		
	function import($importdata)
	{
		$importresults = '';
		$dest = '/tmp/' . $importdata['filename'];
	
	
	
		if ( !copy($importdata['fullpath'], $dest) )
	            echo "Could not copy CSV file to temporary directory ready for importing.";
	       
	       //$query = $this->db->query("LOAD DATA LOCAL INFILE \"$dest\" REPLACE INTO TABLE clients FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY 'EOF' (firstname, lastname, address, address2, city, state, zip, email, phone, phone2, phone3, examtype, @dummy, examdate, recalldate, @clientstatus, dob, insurance, insurance_id, notes) SET clientstatus = '1', store_id = '" . $importdata['store_id'] . "'");
	       
	       //empty temp database before just to be sure
	       $command = "DELETE FROM clients_temp";
	       $query= $this->db->query($command);
	        
	       $query = $this->db->query("LOAD DATA LOCAL INFILE \"$dest\" REPLACE INTO TABLE clients_temp FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\r' (firstname, lastname, address, address2, city, state, zip, email, phone, phone2, phone3, examtype, doctor_id, examdate, recalldate, clientstatus, dob, insurance, insurance_id, notes) SET  store_id = '" . $importdata['store_id'] . "'"); 
	                	        
	        if ($query) {
            $importresults .=   "<BR>All items imported successfully.<BR><BR>";
	        } else {
	            $importresults .= "Import failed.<BR>";
	        }
	        
	        unlink ($dest); 
			//*******************
			
			
			  //trim characters from firstname
			 $command = "UPDATE clients_temp SET firstname = TRIM(BOTH '\n' FROM firstname );
			 ";
			 $query = $this->db->query($command);
			 $command = "UPDATE clients_temp SET firstname = TRIM(BOTH '\r' FROM firstname ) 
			 ;";
			 $query = $this->db->query($command);
			 $command = "UPDATE clients_temp
			 	 SET client_id =  concat(date_format(now(), '%m%d%Y%H%i%s') , '-',  LEFT( RAND()*100000, 5 ) )
			 ;";
			 $query = $this->db->query($command);
			 $command = "UPDATE clients_temp
			 	 	        SET client_id = 
			 	 	        CONCAT(LEFT(REPLACE(firstname, '\r', ''),3), LEFT(lastname, 3) , client_id )
			 ;";
			 $query = $this->db->query($command);
			 $command = "INSERT INTO clients (doctor_id, store_id, firstname, lastname, address, address2, city, state, zip, email, phone, phone2, phone3, examtype, recalldate, examdate, examdue, lastcontact, clientstatus, dob, insurance, insurance_id, notes, client_id ) SELECT doctor_id, store_id, firstname, lastname, address, address2, city, state, zip, email, phone, phone2, phone3, examtype, recalldate, examdate, examdue, lastcontact, clientstatus, dob, insurance, insurance_id, notes, client_id FROM clients_temp
			 ;";
			 $query = $this->db->query($command);
			 $command = "DELETE FROM clients_temp";
			 $query = $this->db->query($command);
			
			 
			
			//********************
	       	
			// Changed by Doug March 15th, 2010 - needed because of recent changes to database structure			
	        //$command = "update clients set examtype = 0 where examtype = 'examonly'";
	        //$query = $this->db->query($command);
	        //if ($query) {
	        //	$importresults .=  '<p> - clean up step 1 completed. Examtype "EXAM ONLY" set to 0<BR>' . '<i>' . $command .'</i></p>';
	        //} else {
	        //	$importresults .= 'clean up step 1 failed.<BR>';
	        //}
	        
	        // Changed by Doug March 15th, 2010 - needed because of recent changes to database structure
	        //$command = "update clients set examtype = 1 where examtype = 'glasses'";
	        //$query = $this->db->query($command);
	        //if ($query) {
	        //	$importresults .=  '<p> - clean up step 2 completed. Examtype "GLASSES" set to 1<BR>' . '<i>' . $command .'</i></p>';
	        //} else {
	        //	$importresults .= 'clean up step 2 failed.<BR>';
	        //}
	      	
			// Changed by Doug March 15th, 2010 - needed because of recent changes to database structure
	      	//$command = "update clients set examtype = 2 where examtype = 'contacts'";
	        //$query = $this->db->query($command);
	        //if ($query) {
	        //	$importresults .=  '<p> - clean up step 3 completed. Examtype "CONTACTS" set to 2<BR>' . '<i>' . $command .'</i></p>';
	        //} else {
	        //	$importresults .= 'clean up step 3 failed.<BR>';
	        //}
	        
			// Changed by Doug March 15th, 2010 - needed because of recent changes to database structure
	        //$command = "update clients set examtype = 3 where examtype = 'both'";
	        //$query = $this->db->query($command);
	        //if ($query) {
	        //	$importresults .=  '<p> - clean up step 4 completed. Examtype "BOTH" set to 3<BR>' . '<i>' . $command .'</i></p>';
	        //} else {
	        //	$importresults .= 'clean up step 4 failed.<BR>';
	        //} 
	        
	        $command = "delete from clients where firstname='firstname' and lastname='lastname' ";
	        $query = $this->db->query($command);
	        if ($query) {
	        	$importresults .=  '<p> - clean up step 5 completed. Remove Header Row if left in.<BR>' . '<i>' . $command .'</i></p>';
	        } else {
	        	$importresults .= 'clean up step 5 failed.<BR>';
	        }
	        
	        $command = "update clients set examdue=date_add(examdate, interval 2 year) where examdue = '0000-00-00' and examtype = 'Glasses' ";
	        $query = $this->db->query($command);
	        if ($query) {
	        	$importresults .=  '<p> - clean up step 6 completed. Set next recall due date<BR>' . '<i>' . $command .'</i></p>';
	        } else {
	        	$importresults .= 'clean up step 6 failed.<BR>';
	        }

	        $command = "update clients set examdue=date_add(examdate, interval 1 year) where examdue = '0000-00-00' and (examtype = 'Contacts' or examtype='Both') ";
	        $query = $this->db->query($command);
	        if ($query) {
	        	$importresults .=  '<p> - clean up step 7 completed. Set next recall due date-part two<BR>' . '<i>' . $command .'</i></p>';
	        } else {
	        	$importresults .= 'clean up step 7 failed.<BR>';
	        }	
	        
		    $command = "update clients set lastcontact=examdate where lastcontact = '0000-00-00'";
	        $query = $this->db->query($command);
	        if ($query) {
	        	$importresults .=  '<p> - clean up step 8 completed. Set last contact date if 0000-00-00<BR>' . '<i>' . $command .'</i></p>';
	        } else {
	        	$importresults .= 'clean up step 8 failed.<BR>';
	        }
	        
	        $this->session->set_flashdata('flashmessage', $importresults);         
	}
	
	function checkin()
	{
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			$this->login();
		} else {
		
			$lastexamtype = $this->mclients->getlastexamtype();
			$doctor_id = $this->mclients->getdoctor_id();
			//echo 'test' . $doctor_id . 'XXX';
			if ( $doctor_id == '' | $doctor_id == 'undefined' )	{
				$this->session->set_flashdata('flashmessage', 'No Doctor set.  You must select a doctor before you can check-in customer for appointment');
				redirect('main/display_client/' . $this->uri->segment(3), 'location');
			}
			
			//echo $lastexamtype;
			if (  $lastexamtype == 'Glasses' )
			{
				$tilnextexam = '24';
			} else {
				$tilnextexam = '12';
			}
			 			
			$result = $this->mclients->checkIN($tilnextexam);
			if ($result){
				$message = 'Successfully checked in for appointment ' ;
			} else {
				$message = 'Failed to check in client';
			}
			$this->session->set_flashdata('flashmessage', $message);
			redirect('main/display_client/' . $this->uri->segment(3), 'location');
		}
	}
	
	function logcontact()
	{
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			$this->login();
		} else {
			 			
			$result = $this->mclients->logContact();
			if ($result){
				$message = 'Client contact successfully recorded' ;
			} else {
				$message = 'Failed to check in client';
			}
			$this->session->set_flashdata('flashmessage', $message);
			redirect('main/display_client/' . $this->uri->segment(3), 'location');
		}
	}
	
	function cleanup_mas90_import()
	{
		$this->load->model('mmas90data');
		$fieldname = 'customer_name';
		$this->mmas90data->set_proper_case();
		$this->mmas90data->split_customer_name();
	
	}
	
	function calendar()
	{
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			$this->login();
		} else {
			//$data['navlist'] = $this->mpages->getpages();
			$data['title'] = "Calendar Section";
			
			//$data['calendar'] = array(
	        //       3  => 'http://example.com/news/article/2006/03/',
	        //       7  => 'http://example.com/news/article/2006/07/',
	        //       13 => 'http://example.com/news/article/2006/13/',
	        //       26 => 'http://example.com/news/article/2006/26/'
	        //     );
		
			$prefs = array (
	               'start_day'    => 'sunday',
	               'month_type'   => 'long',
	               'day_type'     => 'short',
	               'show_next_prev'	=>	'TRUE',
	               'next_prev_url'   => base_url() . 'calendar/'
	             );
	
			$this->load->library('calendar', $prefs);
			$data['main'] = 'main/calendar';
			$this->load->vars($data);
			$this->load->view('template');
		}
	}	

	function login()
	{
		if ( ! $this->dx_auth->is_logged_in())
		{
			$val = $this->form_validation;
			
			// Set form validation rules
			$val->set_rules('username', 'Username', 'trim|required|xss_clean');
			$val->set_rules('password', 'Password', 'trim|required|xss_clean');
			$val->set_rules('remember', 'Remember me', 'integer');

			// Set captcha rules if login attempts exceed max attempts in config
			if ($this->dx_auth->is_max_login_attempts_exceeded())
			{
				$val->set_rules('captcha', 'Confirmation Code', 'trim|required|xss_clean|callback_captcha_check');
			}
				
			if ($val->run() AND $this->dx_auth->login($val->set_value('username'), $val->set_value('password'), $val->set_value('remember')))
			{
				// Redirect to homepage
				redirect('main/search', 'location');
			}
			else
			{
				// Check if the user is failed logged in because user is banned user or not
				if ($this->dx_auth->is_banned())
				{
					// Redirect to banned uri
					$this->dx_auth->deny_access('banned');
				}
				else
				{						
					// Default is we don't show captcha until max login attempts eceeded
					$data['show_captcha'] = FALSE;
				
					// Show captcha if login attempts exceed max attempts in config
					if ($this->dx_auth->is_max_login_attempts_exceeded())
					{
						// Create catpcha						
						$this->dx_auth->captcha();
						
						// Set view data to show captcha on view file
						$data['show_captcha'] = TRUE;
					}
					
					// Load login page view
					$data['main'] = $this->dx_auth->login_view;
					$this->load->vars($data);
					$this->load->view('template');
				}
			}
		}
		else
		{
			//$data['navlist'] = $this->mpages->getpages();
			$this->session->set_flashdata('flashmessage','You are already logged in.');
			#$data['auth_message'] = 'You are already logged in.';
			//$data['main'] = 'search';	#$this->dx_auth->logged_in_view;	
			//$this->load->vars($data);
			//$this->load->view('template');
			redirect('main/search','location');
		}
	}
	
	function functiontemplate()
	{
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			$this->login();
		} else {
			$data['title'] = 'TITLEGOESHERE';		
			$data['main'] = 'folder/VIEWPAGE';
			$this->load->vars($data);
			$this->load->view('template');
		}
	}
	
}
?>