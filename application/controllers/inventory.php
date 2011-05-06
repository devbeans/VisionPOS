<?php
class Inventory extends Controller 
{

		// Used for registering and changing password form validation
		var $min_username = 3;
		var $max_username = 20;
		var $min_password = 5;
		var $max_password = 20;
                
		
	function Inventory()	{
		parent::Controller();
				
	    $buildheadercontent = '';
		
		$buildheadercontent .= '<link href="' . base_url() . 'css/default.css" rel="stylesheet" type="text/css">';
                $buildheadercontent .= '<link href="' . base_url() . 'css/table.css" rel="stylesheet" type="text/css">';
                $buildheadercontent .= '';
	    //$buildheadercontent .= '<link href="' . base_url() . 'css/prettyCheckboxes.css" rel="stylesheet" type="text/css">';
		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/calendar/calendar.js"></script> ';
		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/calendar/lang/calendar-en.js"></script> ';
		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/calendar/calendar-setup.js"></script> ';
//		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/function_search.js"></script>';
	
		//$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/effects.js"></script> ';
		//$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/controls.js"></script> ';
		//$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/jquery-1.5.1.min.js"></script> ';
		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/prettyCheckboxes.js"  charset="utf-8"></script>';
		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/ajax.js"  charset="utf-8"></script>';
                $buildheadercontent .= '';
                $buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'includes/lens_design.js"  charset="utf-8"></script>';
                $buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'includes/lens_materials.js"  charset="utf-8"></script>';
                $buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'includes/lens_types.js"  charset="utf-8"></script>';
                $buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'includes/lens_brands.js"  charset="utf-8"></script>';
                $buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'includes/insurance.js"  charset="utf-8"></script>';
		$buildheadercontent .= '<!-- the scriptaculous javascript library is available at http://script.aculo.us/ -->'; //</script>;

		$loadmyjs['extraHeadContent'] =	$buildheadercontent;
		$this->load->vars($loadmyjs);		
		$this->load->library('Form_validation');
		$this->load->library('DX_Auth');
		$this->load->library('Table');
		$this->load->library('Pagination');
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		//If not yet set then l set the session for StoreName to display in the NAVBAR.  
		//  Useres DX_Auth User_id to lookup the store id then look up the store name.
		if ($this->dx_auth->is_logged_in()){

                    #set default value for pagination per page count

                    if ($this->session->userdata("pagination_per_page") < 1)
                            $this->session->set_userdata("pagination_per_page",10);


			if (!$this->session->userdata('storename')) {
				$this->load->model('mstores');
				$this->load->model('musers');
				$this->session->set_userdata('store_id' , $this->musers->GetStoreID($this->dx_auth->get_user_id()));
				$this->session->set_userdata('storename', $this->mstores->getStoreName($this->session->userdata('store_id')));
				$this->session->set_userdata('storenumber', $this->mstores->getStoreNumber($this->session->userdata('store_id')));
				
			}
		}
                else
                    redirect("/");
        	
	}

        public function pagination_per_page_set()
        {
            $this->session->set_userdata("pagination_per_page",$this->input->post("per_page"));
        }

	function index()
	{
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			redirect('/main/login/', 'refresh');
		} else {
		$data['title'] = $this->lang->line('system_name') . ' - ' . $this->lang->line('page_inventory_index');		
		$data['main'] = 'inventory/home';
		$this->load->vars($data);
		$this->load->view('template');
		}
	}

        /** Listing Page for Lens Materials
         */
        public function lens_materials($page = 0)
        {
            $this->load->helper("pagination");
            $this->load->model("Mlens_materials", "lens");
            $per_page = $per_page = $this->session->userdata("pagination_per_page");
            $lens_count = $this->lens->count();

            # initialize pagination values
            $config = format_pagination();
            $config['base_url'] = site_url("inventory/lens_materials");
            $config['total_rows'] = $lens_count;
            $config['per_page'] = $per_page;

            $this->pagination->initialize($config);

            $data['lenses'] = $this->lens->select(($page == 0) ? 0 : $page - 1, $per_page);
            $data['pages'] = $this->pagination->create_links();
            $data['title'] = $this->lang->line('system_name') . ' - ' . $this->lang->line('page_inventory_edit_lens_materials');
            $data['main'] = "lens_materials/list";
            $this->load->vars($data);
            $this->load->view("template");
        }

        public function lens_material_info($id = 0)
        {
            $this->load->model("Mlens_materials", "lens");
            $this->load->model("Mlens_designs", "designs");


            $data['id'] = $id;
            $data['designs'] = $this->designs->get_list_designs();
            
            if ($id != 0)
            {
                $data['lens_material'] = $this->lens->get($id);
            }
            
            $this->load->view("lens_materials/detail", $data);
        }

        public function lens_material_save()
        {
            $this->load->model("Mlens_materials", "lens");

            $id = $this->input->post("id");
            $design_id = $this->input->post("design_id");
            $material = $this->input->post("material");
            $retail_price = $this->input->post("retail_price");
            $cost_price = $this->input->post("cost_price");
            
            $data = array("design_id" => $design_id, 
                          "material" => $material,
                          "retail_price" => $retail_price,
                          "cost_price" => $cost_price);
            if ($id == 0)
            {
                //$this->session->set_flashdata('flashmessage', 'Lens Material Successfully Added!');
                $id = $this->lens->insert($data);
            }
            else
            {
                //$this->session->set_flashdata('flashmessage', 'Lens Material Successfully Updated!');
                $this->lens->update($id, $data);
            }
            echo $id;

        }

        /*
         * Deletes lens material, expects ID POST variable
         */
        public function lens_material_delete()
        {
            $this->load->model("Mlens_materials", "lens");
            $id = $this->input->post("id");
            $this->lens->delete($id);
        }
        /**
         * Lens Designs Landing page/Listing page
         */
        public function lens_designs($page = 0)
        {
            $this->load->model("Mlens_designs", "designs");
            $this->load->helper("pagination");
            $per_page = $this->session->userdata("pagination_per_page");
            $design_count = $this->designs->count();

            # initialize pagination values

            $config = format_pagination();
            $config['base_url'] = site_url("inventory/lens_designs");
            $config['total_rows'] = $design_count;
            $config['per_page'] = $per_page;

            //$page = ($page == 0) ? 0 : $page - 1;
            //echo $per_page;die;
            
            $this->pagination->initialize($config);
            $data['pages'] = $this->pagination->create_links();
            $data['designs'] = $this->designs->select($page, $per_page);

            $data['title'] = $this->lang->line('system_name') . ' - ' . $this->lang->line('page_inventory_edit_lens_designs');
            $data['main'] = "lens_designs/list";
            $this->load->vars($data);
            $this->load->view("template");
        }


        public function lens_design_info($id = 0)
        {
            $this->load->model("Mlens_designs", "designs");
            $this->load->model("Brands_model","brands");
            $data['id'] = $id;

            $data['brands'] = $this->brands->select();

            if ($id > 0)
            {
                $data['lens_design'] = $this->designs->get($id);
            }

            $this->load->view("lens_designs/detail", $data);
        }


        public function lens_design_save()
        {
            $this->load->model("Mlens_designs", "designs");
            $id = $this->input->post("id");
            $brand_id = $this->input->post("brand_id");
            $design = $this->input->post("design");

            $data = array("brand_id" => $brand_id,
                          "design" => $design);


            if ($id == 0)
                $id = $this->designs->insert($data);
            else
                $this->designs->update($id, $data);

            echo $id;
        }

        public function lens_design_delete()
        {
            $this->load->model("Mlens_designs", "designs");
            $id = $this->input->post("id");
            $this->designs->delete($id);
        }


        public function lens_types($page = 0)
        {
            $this->load->model("Types_model", "types");
            $this->load->helper("pagination");
            $design_count = $this->types->count();
            $per_page = $this->session->userdata("pagination_per_page");
            # initialize pagination values

            $config = format_pagination();
            $config['base_url'] = site_url("inventory/lens_types");
            $config['total_rows'] = $design_count;
            $config['per_page'] = $per_page;

            //$page = ($page == 0) ? 0 : $page - 1;
            //echo $per_page;die;

            $this->pagination->initialize($config);
            $data['pages'] = $this->pagination->create_links();
            $data['types'] = $this->types->select($page, $per_page);

            $data['title'] = $this->lang->line('system_name') . ' - ' . $this->lang->line('page_inventory_edit_lens_designs');
            $data['main'] = "lens_types/list";
            $this->load->vars($data);
            $this->load->view("template");
        }

        public function lens_type_info($id = 0)
        {
            $this->load->model("Types_model", "types");
            
            $data['id'] = $id;


            if ($id > 0)
            {
                $data['type'] = $this->types->get($id);
            }

            $this->load->view("lens_types/detail", $data);
        }

        public function lens_type_save()
        {
            $this->load->model("Types_model", "types");
            $type = $this->input->post("type");
            $id = $this->input->post('id');

            $data = array("type" => $type);

            if ($id == 0)
               $id = $this->types->insert($data);
            else
                $this->types->update($id, $data);

            echo $id;
        }

        public function lens_type_delete()
        {
            $this->load->model("Types_model", "types");
            $id = $this->input->post("id");

            $this->types->delete($id);

        }

        public function lens_brands($page = 0)
        {
            $this->load->model("brands_model", "brands");

            $this->load->helper("pagination");
            $per_page = $this->session->userdata("pagination_per_page");
            $design_count = $this->brands->count();

            # initialize pagination values

            $config = format_pagination();
            $config['base_url'] = site_url("inventory/lens_brands");
            $config['total_rows'] = $design_count;
            $config['per_page'] = $per_page;

            //$page = ($page == 0) ? 0 : $page - 1;
            //echo $per_page;die;

            $this->pagination->initialize($config);
            $data['pages'] = $this->pagination->create_links();
            $data['brands'] = $this->brands->select($page, $per_page);

            $data['title'] = $this->lang->line('system_name') . ' - ' . $this->lang->line('page_inventory_edit_lens_designs');
            $data['main'] = "lens_brands/list";
            $this->load->vars($data);
            $this->load->view("template");
        }

        public function lens_brand_info($id = 0)
        {
            $this->load->model("brands_model", "brands");
            $this->load->model("Types_model", "types");

            $data['id'] = $id;
            $data['types'] = $this->types->select();
            
            if ($id > 0)
            {
                $data['lens_brand'] = $this->brands->get($id);
               
            }
            

            $this->load->view("lens_brands/detail", $data);
            
        }

        public function lens_brand_delete()
        {
            $this->load->model("brands_model", "brands");
            $id = $this->input->post("id");

            $this->brands->delete($id);
        }

        public function lens_brand_save()
        {
            $this->load->model("brands_model", "brands");

            $id = $this->input->post("id");
            $type_id = $this->input->post("type_id");
            $brand = $this->input->post("brand");

            $data = array("type_id" => $type_id,
                          "brand" => $brand);

            if ($id == 0)
                $id = $this->brands->insert($data);
            else
                $this->brands->update($id, $data);

            echo $id;
        }

        public function insurance_list($page = 0)
        {
            $this->load->model("insurance_model", "insurance");

            $this->load->helper("pagination");
            $per_page = $this->session->userdata("pagination_per_page");
            $insurance_count = $this->insurance->count();

            # initialize pagination values

            $config = format_pagination();
            $config['base_url'] = site_url("inventory/insurance_list");
            $config['total_rows'] = $insurance_count;
            $config['per_page'] = $per_page;

            //$page = ($page == 0) ? 0 : $page - 1;
            //echo $per_page;die;

            $this->pagination->initialize($config);
            $data['pages'] = $this->pagination->create_links();
            $data['insurance'] = $this->insurance->select($page, $per_page);

            $data['title'] = $this->lang->line('system_name') . ' - ' . $this->lang->line('page_inventory_edit_lens_designs');
            $data['main'] = "insurance/list";
            $this->load->vars($data);
            $this->load->view("template");
        }

        public function insurance_info($id = 0)
        {
            $this->load->model("Insurance_model", "insurance");
            $data['id'] = $id;


            if ($id > 0)
            {
                $data['insurance'] = $this->insurance->get($id);
            }

            $this->load->view("insurance/detail", $data);
        }

        public function insurance_save()
        {
            $this->load->model("Insurance_model", "insurance");
            $id = $this->input->post("id");

            $data = array("carrier" => $this->input->post("insurance"));

            if ($id == 0)
                $this->insurance->insert($data);
            else
                $this->insurance->update($id, $data);
        }

        public function insurance_delete()
        {
            $this->load->model("Insurance_model", "insurance");
            $this->insurance->delete($this->input->post("id"));
        }

	function edit_manufacturers()
	{
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			redirect('/main/login/', 'refresh');
		} else {

		$this->session->unset_userdata('frame_mfg');

		$this->load->helper('form');
		$attributes = array('class' => 'add_manufacturer', 'id' => 'manufacturer');
		$open_string = '<div width="100" class="add_manufacturer"><div>';
		$close_string = "</div></div></p>";
		$add_manufacturer_form = '<p>' 
			. $open_string
			. form_fieldset('Add Manufacturer')
			. form_open('inventory/add_manufacturer', 'input')
			. form_input('manufacturer_name') 
			. form_submit('submit','submit') 
			. form_close() 
			. $close_string;
	
		$this->load->model('mframes');
		$manufacturers = $this->mframes->get_frame_manufacturers();
		$resultrows = array();
		$data['manufacturer_table'] = 'No Results';
		if (isset( $manufacturers ) )	
		{
		
		
		//echo print_r($manufacturers);
		
			$numresults = 0;
			foreach ($manufacturers as $item)	{
			
			//echo $item['id'];
				$item = array(    
			    anchor( 'inventory/edit_divisions/' . $item['id'] , $item['manufacturer'] ),
			    anchor( 'inventory/delete_manufacturer/' .$item['id'] , '<img src="../images/delete.png">') 
			    
			    );
				$this->table->add_row($item);
				$numresults++;
			}
				
            $this->table->set_heading(array('Manufacturers' ));
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
			$manufacturer_table = $this->table->generate();
			$data['numresults'] = $numresults;
			$data['page'] = $add_manufacturer_form . $manufacturer_table;
		}
		
		$data['title'] = $this->lang->line('system_name') . ' - ' . $this->lang->line('page_inventory_edit_manufacturers');
		$data['main'] = 'inventory/edit_manufacturer';
		$this->load->vars($data);
		$this->load->view('template');
		}
	}
	
	function edit_divisions()
	{
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			redirect('/main/login/', 'refresh');
		} else {
		
		$this->session->unset_userdata('division_id');
		
		$this->load->helper('form');
		$attributes = array('class' => 'add_division', 'id' => 'division');
		$open_string = '<div width="100" class="add_division"><div>';
		$close_string = "</div></div></p>";
		$add_division_form = '<p>' 
			. $open_string
			. form_fieldset('Add Division')
			. form_open('inventory/add_division', 'input')
			. form_input('division_name') 
			. form_hidden( 'manufacturer', $this->uri->segment(3) )
			. form_submit('submit','submit') 
			. form_close() 
			. $close_string;
		
		$this->load->model('mframes');
		$divisions = $this->mframes->get_frame_divisions( $this->uri->segment(3) );

		$resultrows = array();
		$data['division_table'] = 'No Results';
		if (isset( $divisions ) )	
		{
			$numresults = 0;
			foreach ($divisions as $rows)	{
				$row = array(	
			    anchor( 'inventory/edit_frames/' . $rows['id'] , $rows['division'] ),
			    anchor( 'inventory/delete_division/' . $this->uri->segment(3) . '/' . $rows['division'] , '<img src="' . site_url() . 'images/delete.png">') 		    
			);
				$this->table->add_row($row);
				$numresults++;
			}
				
            $this->table->set_heading(array('Divisions for ' . $this->uri->segment(3) ), 'Delete');
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
			$division_table = $this->table->generate();
			$numresults = '<p>Number of divisions for ' . $this->uri->segment(3) . ': ' . $numresults . '</p>';

		} else {
			$division_table = 'This manufacturer has no divisions listed.  Please add at least one.';
			$numresults = '';
		}
		
		$data['manufacturer'] = $this->uri->segment(3);
		
		$data['page'] = $add_division_form . $division_table . $numresults;
		
		$data['title'] = $this->lang->line('system_name') . ' - ' . $this->lang->line('page_inventory_edit_divisions');		
		$data['main'] = 'inventory/edit_division';
		$this->load->vars($data);
		$this->load->view('template');
		}
	}
	
	function edit_frames()
	{
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			redirect('/main/login/', 'refresh');
		} else {
		
		$frame_session = array(
		                   'division_id' => $this->uri->segment(3)
		               );
		
		$this->session->set_userdata($frame_session);
		
		$this->load->helper('form');
		$attributes = array('class' => 'add_frame', 'id' => 'frame');
		$open_string = '<div width="100" class="add_frame"><div>';
		$close_string = "</div></div></p>";
		$add_frame_form = '<p>' 
			. $open_string
			. form_fieldset('Add Frame')
			. form_open('inventory/add_frame', 'input')
			. 'Frame Name: '
			. form_input('frame_name') 
			. '<BR>'
			. 'Wholesale Price: '
			. form_input('cost_price')
			. '<BR>'
			. 'Retail Price: '
			. form_input('retail_price')
			. form_hidden( 'division_id', $this->uri->segment(3) )
			. form_submit('submit','submit') 
			. form_close() 
			. $close_string;
		
		$this->load->model('mframes');
		$frames = $this->mframes->get_frames( $this->uri->segment(3) );
		$resultrows = array();
		$data['frame_table'] = 'No Results';
		if (isset( $frames ) )	
		{
			$numresults = 0;
			foreach ($frames as $rows)	{
				$row = array(	
			    $rows['name'] ,
//			    $rows['frame_color'] ,
			    anchor( 'inventory/delete_frame/' . $rows['id'] , '<img src="' . site_url() . 'images/delete.png">') 		    
			);
				$this->table->add_row($row);
				$numresults++;
			}
				
            $this->table->set_heading(array('Frames for ' . anchor( 'inventory/edit_divisions/' . $this->session->userdata('frame_mfg') , $this->session->userdata('frame_mfg') ) . '/' . $this->session->userdata('division_id') ),  'Delete');
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
			$frame_table = $this->table->generate();
			$numresults = '<p>Number of frames for product line ' . $this->session->userdata('division_id') . ': ' . $numresults . '</p>';

		} else {
			$division_table = 'This division has no frames listed.  Please add at least one.';
			$frame_table = '';
			$numresults = '';
		}
		
		$data['page'] = $add_frame_form . $frame_table . $numresults;
		
		$data['title'] = $this->lang->line('system_name') . ' - ' . $this->lang->line('page_inventory_edit_frames');		
		$data['main'] = 'inventory/edit_division';
		$this->load->vars($data);
		$this->load->view('template');
		}
	}
	
	function delete_frame() 
	{
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			redirect('/main/login/', 'refresh');
		} else {	
			$this->load->model('mframes');
			$result = $this->mframes->delete_frame( $this->uri->segment(3) );
			
			if ( $result ) 
			{	
				$this->session->set_flashdata('flashmessage', 'Frame successfully archived.'); 
			} else {
				$this->session->set_flashdata('flashmessage', 'Something went wrong. Please try again or contact support.'); 
			}
			
			redirect('inventory/edit_frames/' . $this->uri->segment(3) , 'refresh');
		}
	}
	
	function reports()
	{
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			redirect('/main/login/', 'refresh');
		} else {
		$data['title'] = $this->lang->line('system_name') . ' - ' . $this->lang->line('page_inventory_reports');		
		$data['main'] = 'inventory/reports';
		$this->load->vars($data);
		$this->load->view('template');
		}
	}

	function delete_manufacturer( $manufacturer ) 
	{
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			redirect('/main/login/', 'refresh');
		} else {	
			$this->load->model('mframes');
			$result = $this->mframes->delete_manufacturer( $manufacturer );
			
			if ( $result ) 
			{
				$this->session->set_flashdata('flashmessage', 'Manufacturer ' . $manufacturer . ' successfully archived.'); 
			} else {
				$this->session->set_flashdata('flashmessage', 'Something went wrong. Please try again or contact support.'); 
			}
			
			redirect('inventory/edit_manufacturers/', 'refresh');
		}
	}
	
	function add_manufacturer()
	{	
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			redirect('/main/login/', 'refresh');
		} else {	
			if (  isset($_POST['manufacturer_name']) )
			{
				$this->load->model('mframes');
				$manufacturer_name = $_POST['manufacturer_name'] ;
				$result = $this->mframes->add_manufacturer( $manufacturer_name );
				
				if ( $result ) 
				{
					$this->session->set_flashdata('flashmessage', 'Manufacturer ' . $manufacturer_name . ' successfully added.'); 
				} else {
					$this->session->set_flashdata('flashmessage', 'Error: Maufacturer not added possibly because it already exists.'); 
				}
			} else {
				$this->session->set_flashdata('flashmessage', 'ERROR. Please try again or contact support.'); 
			}
			
			redirect('inventory/edit_manufacturers/', 'refresh');
		}
	} 
	
	function delete_division( $manufacturer, $division ) 
	{
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			redirect('/main/login/', 'refresh');
		} else {	
			$this->load->model('mframes');
			$result = $this->mframes->delete_division( $manufacturer, $division );
			
			if ( $result ) 
			{
				$this->session->set_flashdata('flashmessage', 'Division ' . $division . ' successfully archived.'); 
			} else {
				$this->session->set_flashdata('flashmessage', 'Something went wrong. Please try again or contact support.'); 
			}
			
			redirect('inventory/edit_divisions/' . $this->uri->segment(3), 'refresh');
		}
	}
	
	function add_division()
	{	
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			redirect('/main/login/', 'refresh');
		} else {	
			if (  isset($_POST['division_name']) )
			{
				$this->load->model('mframes');
				$division_name = $_POST['division_name'] ;
				$manufacturer = $_POST['manufacturer'] ;
				$result = $this->mframes->add_division( $manufacturer, $division_name );
				
				if ( $result ) 
				{
					$this->session->set_flashdata('flashmessage', 'Division ' . $division_name . ' successfully added.'); 
				} else {
					$this->session->set_flashdata('flashmessage', 'Error: division not added possibly because it already exists for this manufacturer.'); 
				}
			} else {
				$this->session->set_flashdata('flashmessage', 'ERROR. Please try again or contact support.'); 
			}
			
			redirect('inventory/edit_divisions/' . $manufacturer . '/', 'refresh');
		}
	} 

	function add_frame()
	{	
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			redirect('/main/login/', 'refresh');
		} else {	
			if (  isset($_POST['frame_name']) )
			{
				$this->load->model('mframes');
				$frame_name = $_POST['frame_name'] ;
				$division_id = $_POST['division_id'];
				$cost_price = $_POST['cost_price'];
				$retail_price = $_POST['retail_price'];
				$result = $this->mframes->add_frame( $division_id, $frame_name, $cost_price, $retail_price );
				
				if ( $result ) 
				{
					$this->session->set_flashdata('flashmessage', 'Frame ' . $frame_name . ' successfully added.'); 
				} else {
					$this->session->set_flashdata('flashmessage', 'Error: frame not added possibly because it already exists for this division.'); 
				}
			} else {
				$this->session->set_flashdata('flashmessage', 'ERROR. Please try again or contact support.'); 
			}
			
			redirect('inventory/edit_frames/' . $this->session->userdata('division_id'), 'refresh');
		}
	} 
	
	function refresh_new_store()
	{
		alert('test');
		redirect('inventory/store_inventory/' . '24vogueleetown' , 'refresh');
	}
	
	function store_inventory()
	{
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			redirect('/main/login/', 'refresh');
		} else {
				
				$this->load->model('mframes');
				$this->load->model('ajaxinventory');
				$options=$this->ajaxinventory->get_inventory_frame_manufacturers();
				$options = array_merge(array("0"=>array("id"=>"Other","manufacturer"=>"Other Mfg")),$options);
				foreach($options as $item)
				{
					$key = $item['id'];
					$option1[$key] = $item['manufacturer'];
				}
				ksort ($option1);
				$js1 = 'id="mfg1" onChange="get_div(this,\'div1\',1)"';
				$manu_drop = form_dropdown('manufacturer[]', $option1,'',$js1);
				
				//$options = $this->ajaxinventory->get_frame_color();
				$options = array();
				$options = array_merge(array("0"=>array("id"=>"Other","color"=>"Other Color")),$options);
				$options = array_merge(array("0"=>array("id"=>"","color"=>"- - - ")),$options);
				foreach($options as $item)
				{
					$key = $item['id'];
					$option2[$key] = $item['color'];
				}
				$color_drop = form_dropdown('color[]', $option2,'','id="color1" onchange="get_color(\'color1\',1)"');	
				
				$js2 = 'id="div1" onChange="get_frame(1)"';
				$js3 = 'id="frame1" onChange="get_other_frame(1)"';
				
				$this->load->model('msettings');
				$this->load->helper('list_builder'); 
				
				$bridge_params = $this->msettings->bridge_params();
				$bridge_values = inventory_list_builder( $bridge_params );
				
				$temple_length_params = $this->msettings->temple_length_params();
				$temple_length_values = inventory_list_builder($temple_length_params);

				$eye_size_params 	  = $this->msettings->eye_size_params();
				$eye_size_values      = inventory_list_builder($eye_size_params);				
				
				
				
				$content = "<div class='row'>".$manu_drop."
								<div id='mfg1_other_div' style='display:none;'><input type='text' name='mfg_other[]' id='mfg_other1' size='8'></div>
							</div>
						    <div class='row'>".form_dropdown('div[]',array(''=>"- - -"),'',$js2)."
								<div id='other_div1' style='display:none;'><input type='text' name='div_other[]' id='div_other1' size='8'></div>
							</div>
						    <div class='rowframe'><div id='pframe1'>".form_dropdown('frame_id[]',array(''=>"- - -"),'',$js3)."</div>
							<div id='oframe1' style='display:none;'><input type='text' name='other[]' id='other1'>Wholesale:&nbsp;<input type='text' name='cost_price[]' id='cost_price1' size='5'>Retail:&nbsp;<input type='text' name='retail_price[]' id='retail_price1' size='5'></div></div>
						    <div class='row'>".$color_drop."
								<div id='color1_div' style='display:none;'><input type='text' name='color_other[]' id='color_other1' size='8'></div>
							</div>
							<div class='small_row'>".form_dropdown('bridge_size[]', $bridge_values, '','id=bridge_size1')."</div>
							<div class='small_row'>".form_dropdown('temple_length[]', $temple_length_values, '','id=temple_length1' )."</div>
							<div class='small_row'>".form_dropdown('eye_size[]', $eye_size_values, '','id=eye_size1' )."</div>
						   ";
						   
				
			$data['page'] =  $content;
			
			
			$all_store=$this->ajaxinventory->all_store();
			foreach($all_store as $item)
			{
				$key = $item['store_id'];
				$all_store_value[$key] = $item['name'];
			}
			$data['store'] =  form_dropdown('store_id',$all_store_value,$this->session->userdata('store_id'));
	
			$data['title'] = $this->lang->line('system_name') . ' - ' . $this->lang->line('page_inventory_store_inventory');		
			$data['main'] = 'inventory/store_inventory';
			$this->load->vars($data);
			$this->load->view('template');
		}
	}
	
	function add_inventory()
	{	
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			redirect('/main/login/', 'refresh');
		} else {	
			if (  isset($_POST['Submit']) )
			{
				$this->load->model('mframes');
				$this->load->model('ajaxinventory');
				for($i=0;$i<count($_REQUEST['manufacturer']);$i++)
				{
					$manufacturer = $_POST['manufacturer'][$i];
					$mfg_other    = $_POST['mfg_other'][$i];
					
					$div       = $_POST['div'][$i];
					$div_other = $_POST['div_other'][$i];
					
					$frame_id = $_POST['frame_id'][$i]; 
					$other    = $_POST['other'][$i]; 	
					$cost_price   = $_POST['cost_price'][$i];	
					$retail_price = $_POST['retail_price'][$i];	
					
					$color_id    = $_POST['color'][$i];
					$color_other = $_POST['color_other'][$i];
					
					$store_id  = $_POST['store_id'];

					$eye_size 	  = $_POST['eye_size'][$i];
					$bridge_size  = $_POST['bridge_size'][$i];	
					$temple_size  = $_POST['temple_length'][$i];	
					
					$result = $this->ajaxinventory->add_inventory( $manufacturer,$mfg_other,
																   $div,$div_other,
																   $frame_id, $other, 
																   $color_id, $color_other, $store_id, 
																   $eye_size , $bridge_size , $temple_size, $cost_price , $retail_price 
																 );
				}
				if ( $result ) 
				{
					$this->session->set_flashdata('flashmessage', 'Inventory successfully added.'); 
				} else {
					$this->session->set_flashdata('flashmessage', 'Error: Inventory not added.'); 
				}
			} else {
				$this->session->set_flashdata('flashmessage', 'ERROR. Please try again or contact support.'); 
			}
			
			redirect('inventory/store_inventory', 'refresh');
		}
	} 

	function edit_lens_designs()
	{
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			redirect('/main/login/', 'refresh');
		} else {

		$this->load->helper('form');
		$attributes = array('class' => 'add_lens_design', 'id' => 'design');
		$open_string = '<div width="100" class="add_lens_design"><div>';
		$close_string = "</div></div></p>";
		$add_lens_designs_form = '<p>' 
			. $open_string
			. form_fieldset('Add lens design')
			. form_open('inventory/add_lens_designs', 'input')
			. form_input('design') 
			. form_submit('submit','Add Design') 
			. form_close() 
			. $close_string;
	
		$this->load->model('mlens_designs');
		$lens_designs = $this->mlens_designs->get_list_designs();
		
		$resultrows = array();
		$data['lens_designs'] = 'No Results';
		if (isset( $lens_designs ) )	
		{
			$numresults = 0;
			foreach ($lens_designs as $rows)	{
				$row = array(
			    anchor( 'inventory/edit_lens_design/' . $rows['design'] , $rows['design'] ),
			    anchor( 'inventory/delete_lens_design/' .$rows['design'] , '<img src="../images/delete.png">') 
			    
			    );
				$this->table->add_row($row);
				$numresults++;
			}
				
            $this->table->set_heading(array('Lens Designs' ));
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
			$lens_designs_table = $this->table->generate();
			$data['numresults'] = $numresults;
			$data['page'] = $add_lens_designs_form . $lens_designs_table;
		}
		
		$data['title'] = $this->lang->line('system_name') . ' - ' . $this->lang->line('page_inventory_edit_lens_designs');
		$data['main'] = 'inventory/edit_lists';
		$this->load->vars($data);
		$this->load->view('template');
		}
	}
	
	function add_lens_designs()
	{	
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			redirect('/main/login/', 'refresh');
		} else {	
			if (  isset( $_POST['design']) )
			{
				$this->load->model('mlens_designs');
				$design = $_POST['design'] ;
				$result = $this->mlens_designs->add_lens_design( $design );
				if ( $result ) 
				{
					$this->session->set_flashdata('flashmessage', 'Design ' . $design . ' successfully added.'); 
				} else {
					$this->session->set_flashdata('flashmessage', 'Error: frame not added possibly because it already exists for this manufacturer/division.'); 
				}
			} else {
				$this->session->set_flashdata('flashmessage', 'ERROR. Please try again or contact support.'); 
			}
			
			redirect('inventory/edit_lens_designs/' , 'refresh');
		}
	} 
	
	function delete_lens_design( $design ) 
	{
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			redirect('/main/login/', 'refresh');
		} else {	
			$this->load->model('mlens_designs');
			$result = $this->mlens_designs->delete_lens_design( $this->uri->segment(3) );
			
			if ( $result ) 
			{
				$this->session->set_flashdata('flashmessage', 'Design ' . $design . ' successfully archived.'); 
			} else {
				$this->session->set_flashdata('flashmessage', 'Something went wrong. Please try again or contact support.'); 
			}
			
			redirect('inventory/edit_lens_designs/' . $this->uri->segment(3), 'refresh');
		}
	}

	function edit_lens_materials()
	{
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			redirect('/main/login/', 'refresh');
		} else {

		$this->load->helper('form');
		$attributes = array('class' => 'add_lens_material', 'id' => 'design');
		$open_string = '<div width="100" class="add_lens_material"><div>';
		$close_string = "</div></div></p>";
		$add_lens_materials_form = '<p>' 
			. $open_string
			. form_fieldset('Add lens material')
			. form_open('inventory/add_lens_material', 'input')
			. form_input('material') 
			. form_submit('submit','Add Material') 
			. form_close() 
			. $close_string;

		$this->load->model('mlens_materials');
		$lens_materials = $this->mlens_materials->get_list_materials();
		
		$resultrows = array();
		$data['lens_materials'] = 'No Results';
		if (isset( $lens_materials ) )	
		{
			$numresults = 0;
			foreach ($lens_materials as $rows)	{
				$row = array(
			    anchor( 'inventory/edit_lens_material/' . $rows['material'] , $rows['material'] ),
			    anchor( 'inventory/delete_lens_material/' .$rows['material'] , '<img src="../images/delete.png">') 
			    
			    );
				$this->table->add_row($row);
				$numresults++;
			}
				
            $this->table->set_heading(array('Lens Material' ));
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
			$lens_materials_table = $this->table->generate();
			$data['numresults'] = $numresults;
			$data['page'] = $add_lens_materials_form . $lens_materials_table;
		}
		
		$data['title'] = $this->lang->line('system_name') . ' - ' . $this->lang->line('page_inventory_edit_lens_materials');
		$data['main'] = 'inventory/edit_lists';
		$this->load->vars($data);
		$this->load->view('template');
		}
	}
	
	function add_lens_material()
	{	
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			redirect('/main/login/', 'refresh');
		} else {	
			if (  isset( $_POST['material']) )
			{
				$this->load->model('mlens_materials');
				$material = $_POST['material'] ;
				$result = $this->mlens_materials->add_lens_material( $material );
				if ( $result ) 
				{
					$this->session->set_flashdata('flashmessage', 'Material ' . $material . ' successfully added.'); 
				} else {
					$this->session->set_flashdata('flashmessage', 'Error: frame not added possibly because it already exists.'); 
				}
			} else {
				$this->session->set_flashdata('flashmessage', 'ERROR. Please try again or contact support.'); 
			}
			
			redirect('inventory/edit_lens_materials/' , 'refresh');
		}
	} 
	
	function delete_lens_material( $material ) 
	{
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			redirect('/main/login/', 'refresh');
		} else {	
			$this->load->model('mlens_materials');
			$result = $this->mlens_materials->delete_lens_material( $this->uri->segment(3) );
			
			if ( $result ) 
			{
				$this->session->set_flashdata('flashmessage', 'Material ' . $material . ' successfully archived.'); 
			} else {
				$this->session->set_flashdata('flashmessage', 'Something went wrong. Please try again or contact support.'); 
			}
			
			redirect('inventory/edit_lens_materials/' . $this->uri->segment(3), 'refresh');
		}
	}

	function edit_lens_treatments()
	{
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			redirect('/main/login/', 'refresh');
		} else {

		$this->load->helper('form');
		$attributes = array('class' => 'add_lens_treatment', 'id' => 'design');
		$open_string = '<div width="100" class="add_lens_treatment"><div>';
		$close_string = "</div></div></p>";
		$add_lens_treatments_form = '<p>' 
			. $open_string
			. form_fieldset('Add lens treatment')
			. form_open('inventory/add_lens_treatment', 'input')
			. form_input('treatment') 
			. form_submit('submit','Add treatment') 
			. form_close() 
			. $close_string;
	
		$this->load->model('mlens_treatments');
		$lens_treatments = $this->mlens_treatments->get_list_treatments();
		
		$resultrows = array();
		$data['lens_treatments'] = 'No Results';
		if (isset( $lens_treatments ) )	
		{
			$numresults = 0;
			foreach ($lens_treatments as $rows)	{
				$row = array(
			    anchor( 'inventory/edit_lens_treatment/' . $rows['treatment'] , $rows['treatment'] ),
			    anchor( 'inventory/delete_lens_treatment/' .$rows['treatment'] , '<img src="../images/delete.png">') 
			    
			    );
				$this->table->add_row($row);
				$numresults++;
			}
				
            $this->table->set_heading(array('Lens treatment' ));
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
			$lens_treatments_table = $this->table->generate();
			$data['numresults'] = $numresults;
			$data['page'] = $add_lens_treatments_form . $lens_treatments_table;
		}
		
		$data['title'] = $this->lang->line('system_name') . ' - ' . $this->lang->line('page_inventory_edit_lens_treatments');
		$data['main'] = 'inventory/edit_lists';
		$this->load->vars($data);
		$this->load->view('template');
		}
	}
	
	function add_lens_treatment()
	{	
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			redirect('/main/login/', 'refresh');
		} else {	
			if (  isset( $_POST['treatment']) )
			{
				$this->load->model('mlens_treatments');
				$treatment = $_POST['treatment'] ;
				$result = $this->mlens_treatments->add_lens_treatment( $treatment );
				if ( $result ) 
				{
					$this->session->set_flashdata('flashmessage', 'treatment ' . $treatment . ' successfully added.'); 
				} else {
					$this->session->set_flashdata('flashmessage', 'Error: frame not added possibly because it already exists.'); 
				}
			} else {
				$this->session->set_flashdata('flashmessage', 'ERROR. Please try again or contact support.'); 
			}
			
			redirect('inventory/edit_lens_treatments/' , 'refresh');
		}
	} 
	
	function delete_lens_treatment( $treatment ) 
	{
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			redirect('/main/login/', 'refresh');
		} else {	
			$this->load->model('mlens_treatments');
			$result = $this->mlens_treatments->delete_lens_treatment( $this->uri->segment(3) );
			
			if ( $result ) 
			{
				$this->session->set_flashdata('flashmessage', 'treatment ' . $treatment . ' successfully archived.'); 
			} else {
				$this->session->set_flashdata('flashmessage', 'Something went wrong. Please try again or contact support.'); 
			}
			
			redirect('inventory/edit_lens_treatments/' . $this->uri->segment(3), 'refresh');
		}
	}

        /*
         * Needs this utility to test sandbox
         */
        public function utility()
        {
            $this->db->query("INSERT INTO `lens_brands` (`id`, `type_id`, `brand`, `active`) VALUES (1, 1, 'Brand Sample', 1)");
        }
	


}
?>