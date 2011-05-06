<?php
class Backend extends Controller
{
	function Backend()
	{
		parent::Controller();
		
		
	    $buildheadercontent = '';
		
		$buildheadercontent .= '<link href="' . base_url() . 'css/default.css" rel="stylesheet" type="text/css">';
	    //$buildheadercontent .= '<link href="' . base_url() . 'css/prettyCheckboxes.css" rel="stylesheet" type="text/css">';
		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/calendar/calendar.js"></script> ';
		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/calendar/lang/calendar-en.js"></script> ';
		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/calendar/calendar-setup.js"></script> ';
//		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/function_search.js"></script>';
		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/prototype.js"></script> ';
		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/effects.js"></script> ';
		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/controls.js"></script> ';
		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/jquery-1.3.2.js"></script> ';
		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/prettyCheckboxes.js"  charset="utf-8"></script>';
		$buildheadercontent .= '<!-- the scriptaculous javascript library is available at http://script.aculo.us/ -->'; //</script>;

		$loadmyjs['extraHeadContent'] =	$buildheadercontent;
		$this->load->vars($loadmyjs);		
		$this->load->library('Form_validation');
		$this->load->library('DX_Auth');
		$this->load->library('Table');
		$this->load->library('Pagination');
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		// Protect entire controller so only admin, 
		// and users that have granted role in permissions table can access it.
		$this->dx_auth->check_uri_permissions();
	}
	
	function index()
	{
		$this->users();
	}
	
	//Backend controller functions
	function users()
	{
		$this->load->model('dx_auth/users', 'users');			
		
		// Search checkbox in post array
		foreach ($_POST as $key => $value)
		{
			// If checkbox found
			if (substr($key, 0, 9) == 'checkbox_')
			{
				// If ban button pressed
				if (isset($_POST['ban']))
				{
					// Ban user based on checkbox value (id)
					$this->users->ban_user($value);
				}
				// If unban button pressed
				else if (isset($_POST['unban']))
				{
					// Unban user
					$this->users->unban_user($value);
				}
				else if (isset($_POST['reset_pass']))
				{
					// Set default message
					$data['reset_message'] = 'Reset password failed';
				
					// Get user and check if User ID exist
					if ($query = $this->users->get_user_by_id($value) AND $query->num_rows() == 1)
					{		
						// Get user record				
						$user = $query->row();
						
						// Create new key, password and send email to user
						if ($this->dx_auth->forgot_password($user->username))
						{
							// Query once again, because the database is updated after calling forgot_password.
							$query = $this->users->get_user_by_id($value);
							// Get user record
							$user = $query->row();
														
							// Reset the password
							if ($this->dx_auth->reset_password($user->username, $user->newpass_key))
							{							
								$data['reset_message'] = 'Reset password success';
							}
						}
					}
				}
			}				
		}
		
		/* Showing page to user */
		
		// Get offset and limit for page viewing
		$offset = (int) $this->uri->segment(3);
		// Number of record showing per page
		$row_count = 15;
		
		// Get all users except archived (active = FALSE)
		$data['users'] = $this->users->get_all($offset, $row_count)->result();
		
		// Pagination config
		$p_config['base_url'] = site_url() . '/backend/users/';
		$p_config['uri_segment'] = 3;
		$p_config['num_links'] = 2;
		$p_config['total_rows'] = $this->users->get_all()->num_rows();
		$p_config['per_page'] = $row_count;
				
		// Init pagination
		$this->pagination->initialize($p_config);		
		// Create pagination links
		$data['pagination'] = $this->pagination->create_links();
		
		// Load view
		$data['main'] = 'backend/users';
		$this->load->vars($data);
		$this->load->view('template');
	}
	
	function delete_user()	{
		$this->load->model('musers');
		$result = $this->musers->deleteuser( $this->uri->segment(3) );
		if ( $result ) {  	//if result TRUE then archive was successful
			$this->session->set_flashdata('flashmessage','User record archived successfully');
			redirect('backend/users/'); 
		} else {
			$this->session->set_flashdata('flashmessage','User record archive FAILED!');
			redirect('backend/users/'); 
		}
	}
	
	
		function stores()
		{
			if ( ! $this->dx_auth->is_logged_in())
			{				 
				$this->login();
			} else {
				//uri 3 = mode  (edit | add | delete
				//uri 4 = store_id
				if ($this->uri->segment(3) == 'edit') {
					$this->load->model('mstores');
					$store_list = $this->mstores->getstoredetails();
				
				} elseif ($this->uri->segment(3) == 'delete') {
					echo 'delete';
				
				} elseif ($this->uri->segment(3) == 'add') {
				
					echo 'add';
				} else {

					$this->load->model('mstores');
					$store_list = $this->mstores->getstores();
					$resultrows = array();
					if (isset($store_list) )	{
					
						foreach ($store_list as $rows)	{
							$row = array(
		                    anchor('backend/stores/edit/' . $rows['store_id'] , $rows['name'] ) ,
		                    $rows['number'] ,
		                    $rows['address'] . ' ' . $rows['city'] . ', ' . $rows['state'] . ' ' . $rows['zip']  ,
		                    $rows['manager'],
		                    $rows['phone']
						);
	    
						$this->table->add_row($row);
						}
					
		                $this->table->set_caption('Active stores');
		                $this->table->set_heading(array('Store',  'Store Number', 'Address', 'Store Manager', 'Phone'));
						
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
					} 
					
					$data['main'] = 'backend/stores_list';
					$this->load->vars($data);
					$this->load->view('template');
				}

			}
		}
	
	function edit_user()
	{
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			$this->login();
		} else {
			$this->load->model('musers');
			if ($this->uri->segment(3))
			{
				if ($this->input->post('submit')){
					//SUBMIT clicked so process update to user record
					$this->musers->editUser(); 
				    $this->session->set_flashdata('flashmessage','User record updated');
		    		redirect('backend/users/'); 
					
				} elseif ( $this->input->post('submit_delete'))  {
					//Delete clicked so mark user as archived
					$user_id = $this->uri->segment(3);
					$result = $this->musers->deleteUser( $user_id );
					//if TRUE result then it was successful
					if ( $result ) {
						$this->session->set_flashdata('flashmessage', 'User successfully deleted.');
					} else {
						$this->session->set_flashdata('flashmessage', 'User delete failed.');
					}
						redirect ('backend/users', 'location');
						
				} else {
					//No button submitted so open page and display data.
					
					$data['title'] = "Edit User Account"; 
					$data['addoreditpage'] = 'backend/edit_user/' . $this->uri->segment(3);
					$data['main'] = 'backend/edit_user'; 

					$this->load->model('mstores');
					$data['content_stores'] = $this->mstores->get_dropdown_array('store_id', 'name'); 
				
					$userdata = $this->musers->getUserRecord($this->uri->segment(3));
					
		//echo print_r($userdata);
					
					foreach($userdata as $user){
					
						$data['email'] = $user['email'];
						$data['store_id'] = $user['store_id'];
						$data['username'] = $user['username'];
//						$data['user_id'] = $user['user_id'];
						$current_security_role = $user['security_role'];
					}
					
					if (isset( $_POST['security_role'] ) ) { if ( $_POST['security_role'] ) { $data['security_role'] =  $_POST['security_role']; } else { $security_role = $current_security_role ; } } else { $security_role = $current_security_role ; }
					$hidden = array('user_id' => $this->uri->segment(3));
					$data['open_form'] = form_open('backend/edit_user/'. $this->uri->segment(3), '',$hidden); 
					$data['form_submit_edit'] = form_submit('submit','Edit User');
					$data['form_submit_delete'] = form_submit('submit_delete','Delete User');
					
					$this->load->model('mlists');
					$list_roles = $this->mlists->get_list_roles();
					$data['security_roles'] = form_dropdown('security_role', $list_roles, $security_role );
					
					$this->load->vars($data); 
					$this->load->view('template'); 
				}   
			 } else {
			 	redirect ('main/search', 'location');
			 }
		}
	} 
	
	function unactivated_users()
	{
		$this->load->model('dx_auth/user_temp', 'user_temp');
		
		/* Database related */
		
		// If activate button pressed
		if ($this->input->post('activate'))
		{
			// Search checkbox in post array
			foreach ($_POST as $key => $value)
			{
				// If checkbox found
				if (substr($key, 0, 9) == 'checkbox_')
				{
					// Check if user exist, $value is username
					if ($query = $this->user_temp->get_login($value) AND $query->num_rows() == 1)
					{
						// Activate user
						$this->dx_auth->activate($value, $query->row()->activation_key);
					}
				}				
			}
		}
		
		/* Showing page to user */
		
		// Get offset and limit for page viewing
		$offset = (int) $this->uri->segment(3);
		// Number of record showing per page
		$row_count = 10;
		
		// Get all unactivated users
		$data['users'] = $this->user_temp->get_all($offset, $row_count)->result();
		
		// Pagination config
		$p_config['base_url'] = '/backend/unactivated_users/';
		$p_config['uri_segment'] = 3;
		$p_config['num_links'] = 2;
		$p_config['total_rows'] = $this->user_temp->get_all()->num_rows();
		$p_config['per_page'] = $row_count;
				
		// Init pagination
		$this->pagination->initialize($p_config);		
		// Create pagination links
		$data['pagination'] = $this->pagination->create_links();
		
		// Load view
		$data['main'] = 'backend/unactivated_users';
		$this->load->vars($data);
		$this->load->view('template');
	}
	
	function roles()
	{		
		$this->load->model('dx_auth/roles', 'roles');
		
		/* Database related */
					
		// If Add role button pressed
		if ($this->input->post('add'))
		{
			// Create role
			$this->roles->create_role($this->input->post('role_name'), $this->input->post('role_parent'));
		}
		else if ($this->input->post('delete'))
		{				
			// Loop trough $_POST array and delete checked checkbox
			foreach ($_POST as $key => $value)
			{
				// If checkbox found
				if (substr($key, 0, 9) == 'checkbox_')
				{
					// Delete role
					$this->roles->delete_role($value);
				}				
			}
		}

		/* Showing page to user */
	
		// Get all roles from database
		$data['roles'] = $this->roles->get_all()->result();
		
		// Load view
		$data['main'] = 'backend/roles';
		$this->load->vars($data);
		$this->load->view('template');
	}
	
	function uri_permissions()
	{
		function trim_value(&$value) 
		{ 
			$value = trim($value); 
		}
	
		$this->load->model('dx_auth/roles', 'roles');
		$this->load->model('dx_auth/permissions', 'permissions');
		
		if ($this->input->post('save'))
		{
			// Convert back text area into array to be stored in permission data
			$allowed_uris = explode("\n", $this->input->post('allowed_uris'));
			
			// Remove white space if available
			array_walk($allowed_uris, 'trim_value');
		
			// Set URI permission data
			// IMPORTANT: uri permission data, is saved using 'uri' as key.
			// So this key name is preserved, if you want to use custom permission use other key.
			$this->permissions->set_permission_value($this->input->post('role'), 'uri', $allowed_uris);
		}
		
		/* Showing page to user */		
		
		// Default role_id that will be showed
		$role_id = $this->input->post('role') ? $this->input->post('role') : 1;
		
		// Get all role from database
		$data['roles'] = $this->roles->get_all()->result();
		// Get allowed uri permissions
		$data['allowed_uris'] = $this->permissions->get_permission_value($role_id, 'uri');
		
		// Load view
		$data['main'] = 'backend/uri_permissions';
		$this->load->vars($data);
		$this->load->view('template');
	}
	
	function custom_permissions()
	{
		// Load models
		$this->load->model('dx_auth/roles', 'roles');
		$this->load->model('dx_auth/permissions', 'permissions');
	
		/* Get post input and apply it to database */
		
		// If button save pressed
		if ($this->input->post('save'))
		{
			// Note: Since in this case we want to insert two key with each value at once,
			// it's not advisable using set_permission_value() function						
			// If you calling that function twice that means, you will query database 4 times,
			// because set_permission_value() will access table 2 times, 
			// one for get previous permission and the other one is to save it.
			
			// For this case (or you need to insert few key with each value at once) 
			// Use the example below
		
			// Get role_id permission data first. 
			// So the previously set permission array key won't be overwritten with new array with key $key only, 
			// when calling set_permission_data later.
			$permission_data = $this->permissions->get_permission_data($this->input->post('role'));
		
			// Set value in permission data array
			$permission_data['edit'] = $this->input->post('edit');
			$permission_data['delete'] = $this->input->post('delete');
			
			// Set permission data for role_id
			$this->permissions->set_permission_data($this->input->post('role'), $permission_data);
		}
	
		/* Showing page to user */		
		
		// Default role_id that will be showed
		$role_id = $this->input->post('role') ? $this->input->post('role') : 1;
		
		// Get all role from database
		$data['roles'] = $this->roles->get_all()->result();
		// Get edit and delete permissions
		$data['edit'] = $this->permissions->get_permission_value($role_id, 'edit');
		$data['delete'] = $this->permissions->get_permission_value($role_id, 'delete');
	
		// Load view
		$data['main'] = 'backend/custom_permissions';
		$this->load->vars($data);
		$this->load->view('template');
	}

}
?>