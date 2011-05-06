<?php
	class Settings extends Controller 
{

		// Used for registering and changing password form validation
		var $min_username = 3;
		var $max_username = 20;
		var $min_password = 5;
		var $max_password = 20;	
		
	function Settings()	{
		parent::Controller();
				
	    $buildheadercontent = '';
		
		$buildheadercontent .= '<link href="' . base_url() . 'css/default.css" rel="stylesheet" type="text/css">';
                 $buildheadercontent .= '<link href="' . base_url() . 'css/table.css" rel="stylesheet" type="text/css">';
	    //$buildheadercontent .= '<link href="' . base_url() . 'css/prettyCheckboxes.css" rel="stylesheet" type="text/css">';
		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/calendar/calendar.js"></script> ';
		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/calendar/lang/calendar-en.js"></script> ';
		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/calendar/calendar-setup.js"></script> ';
//		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/function_search.js"></script>';
		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/prettyCheckboxes.js"  charset="utf-8"></script>';
                $buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'includes/doctor.js"  charset="utf-8"></script>';
		$buildheadercontent .= '<!-- the scriptaculous javascript library is available at http://script.aculo.us/ -->'; //</script>;

		$loadmyjs['extraHeadContent'] =	$buildheadercontent;
		$this->load->vars($loadmyjs);		
		$this->load->library('Form_validation');
		$this->load->library('DX_Auth');
//		$this->load->library('Table');
		$this->load->library('Pagination');
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		//If not yet set then l set the session for StoreName to display in the NAVBAR.  
		//  Useres DX_Auth User_id to lookup the store id then look up the store name.
		if ($this->dx_auth->is_logged_in()){
			if (!$this->session->userdata('storename')) {
				$this->load->model('mstores');
				$this->load->model('musers');
				$this->session->set_userdata('store_id' , $this->musers->GetStoreID($this->dx_auth->get_user_id()));
				$this->session->set_userdata('storename', $this->mstores->getStoreName($this->session->userdata('store_id')));
				$this->session->set_userdata('storenumber', $this->mstores->getStoreNumber($this->session->userdata('store_id')));
				
				
			}
		}
        	
	}

	function index()
	{

		if ( ! $this->dx_auth->is_logged_in())
		{				 
			$this->login();
		} else {
			$data['title'] = $this->lang->line('system_name') . ' - ' . $this->lang->line('page_settings_home');	
			$data['main'] = 'settings/home';
			$this->load->vars($data);
			$this->load->view('template');
		}

	}


        function doctor_list($page = 0)
        {
            $this->load->model("Mdoctors","doctors");
            $this->load->helper("pagination");



            $per_page = $this->session->userdata("pagination_per_page");

            if (is_null($per_page))
                $per_page = 10;

            $doctor_count = $this->doctors->count();

            # initialize pagination values

            $config = format_pagination();
            $config['base_url'] = site_url("settings/doctor_list");
            $config['total_rows'] = $doctor_count;
            $config['per_page'] = $per_page;

            //$page = ($page == 0) ? 0 : $page - 1;
            //echo $per_page;die;

            $this->pagination->initialize($config);
            $data['pages'] = $this->pagination->create_links();
            $data['doctors'] = $this->doctors->select($page, $per_page);

            $data['title'] = $this->lang->line('system_name') . ' - Doctors' ;
            $data['main'] = "doctors/list";
            $this->load->vars($data);
            $this->load->view("template");

        }

        function doctor_info($id = "")
        {
           $this->load->model("Mdoctors","doctors");
           $data['states'] = array("AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "DC", "FL", "GA", "HI", "ID", "IL", "IN", "IA", "KS", "KY", "LA", "ME", "MD", "MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ", "NM", "NY", "NC", "ND", "OH", "OK", "OR", "PA", "RI", "SC", "SD", "TN", "TX", "UT", "VT", "VA", "WA", "WV", "WI", "WY");
           $data['id'] = $id;


            if ($id != "")
            {
                $data['doctor'] = $this->doctors->get($id);
            }

            $this->load->view("doctors/detail", $data);
        }

        function doctor_save()
        {
            $this->load->model("Mdoctors","doctors");
            
            $fname = $this->input->post("firstname");
            $lname = $this->input->post("lastname");
            $title = $this->input->post("title");
            $phone = $this->input->post("phone");
            $email = $this->input->post("email");
            $license = $this->input->post("license");
            $license_expiry = $this->input->post("license_expiry");
            $address = $this->input->post("address");
            $state = $this->input->post("state");
            $city = $this->input->post("city");


            $data = array("firstname" => $fname,
                          "lastname"  => $lname,
                          "title"     => $title,
                          "phone"     => $phone,
                          "email"     => $email,
                          "license"   => $license,
                          "expiredate"=> date("Y-m-d", strtotime($license_expiry)),
                          "address"   => $address,
                          "city"      => $city,
                          "state"     => $state);

            $id = $this->input->post("id");

            if ($id == "")
            {
                $data['doctor_id'] = trim(substr($fname, 0, 1) . $lname);
                $this->doctors->insert($data);
                $id = $data['doctor_id'];
            }
            else
            {
                $this->doctors->update($id, $data);
            }

            echo $id;
        }

        function doctor_delete()
        {
            $this->load->model("Mdoctors","doctors");
            $id = $this->input->post("id");

            $this->doctors->delete($id);
        }

	function edit_doctors()
	{
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			redirect('/main/login/', 'refresh');
		} else {
			$this->load->helper('form');
			$attributes = array('class' => 'add_frame', 'id' => 'frame');
			$open_string = '<div width="100" class="add_doctor"><div>';
			$close_string = "</div></div></p>";
			$add_doctor_form = '<p>' 
				. $open_string
				. form_fieldset('Add Doctor')
				. form_open('settings/add_doctor', 'input')
				. 'Doctor First, Last name: '
				. form_input('firstname') 
				. form_input('lastname')
				. form_submit('submit','submit') 
				. form_close() 
				. $close_string;
			
			$this->load->model('mdoctors');
			$doctors = $this->mdoctors->get_list_doctors( $this->uri->segment(3), $this->uri->segment(4) );
	
			$resultrows = array();
			$data['doctor_table'] = 'No Results';
//			echo print_r($doctors);
			if (isset( $doctors ) )	
			{
				$numresults = 0;
				foreach ($doctors as $doctor)	{
					if ( $doctor['firstname'] <> ''){
						$firstname = ', ' . $doctor['firstname'] ;
					} else {
						$firstname = '';
					}
					$doctor = array(
				    'Dr. ' . $doctor['lastname'] . $firstname ,
	//			    $rows['frame_color'] ,
				    anchor( 'settings/delete_doctor/' . $doctor['doctor_id'] , '<img src="' . site_url() . 'images/delete.png">') 		    
				);
					$this->table->add_row($doctor);
					$numresults++;
				}
					
	            $this->table->set_heading('Doctors',  'Delete');
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
				$doctor_table = $this->table->generate();
				$numresults = '<p>Number of doctors: ' . $numresults . '</p>';
	
			} else {
				$doctor_table = 'There are no doctors listed.  Please add at least one.';
				$numresults = '';
			}
			
			$data['doctor_name'] = $this->uri->segment(3);
			$data['page'] = $add_doctor_form . $doctor_table . $numresults;
			
			$data['title'] = $this->lang->line('system_name') . ' - ' . $this->lang->line('page_inventory_edit_doctors');		
			$data['main'] = 'settings/edit_list';
			$this->load->vars($data);
			$this->load->view('template');
		}
	}	
	
	function delete_doctor() 
	{
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			redirect('/main/login/', 'refresh');
		} else {	
			$doctor_id = $this->uri->segment(3);
			$this->load->model('mdoctors');
			$result = $this->mdoctors->delete_doctor( $doctor_id );
			
			if ( $result ) 
			{
				$this->session->set_flashdata('flashmessage', 'doctor ' . $doctor_id . ' successfully archived.'); 
			} else {
				$this->session->set_flashdata('flashmessage', 'Something went wrong. Please try again or contact support.'); 
			}
			
			redirect('settings/edit_doctors/', 'refresh');
		}
	}
	
	function add_doctor()
	{	
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			redirect('/main/login/', 'refresh');
		} else {	
			if (  isset($_POST['lastname']) && isset($_POST['firstname']) )
			{
				$this->load->model('mdoctors');
				$lastname = $_POST['lastname'] ;
				$firstname = $_POST['firstname'];
				$result = $this->mdoctors->add_doctor( $lastname, $firstname );
				
				if ( $result ) 
				{
					$this->session->set_flashdata('flashmessage', 'Dr. ' . $lastname . ' successfully added.'); 
				} else {
					$this->session->set_flashdata('flashmessage', 'Error: Doctor not added possibly because it already exists.'); 
				}
			} else {
				$this->session->set_flashdata('flashmessage', 'Doctors FIRST and LAST names are required.'); 
			}
			
			redirect('settings/edit_doctors/', 'refresh');
		}
	} 



}
?>