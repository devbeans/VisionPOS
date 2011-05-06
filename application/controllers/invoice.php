<?php
	class Invoice extends Controller 
{

		// Used for registering and changing password form validation
		var $min_username = 3;
		var $max_username = 20;
		var $min_password = 5;
		var $max_password = 20;	
		
	function Invoice()	{
		parent::Controller();
				
	    $buildheadercontent = '';
		
		$buildheadercontent .= '<link href="' . base_url() . 'css/default.css" rel="stylesheet" type="text/css">';
	    //$buildheadercontent .= '<link href="' . base_url() . 'css/prettyCheckboxes.css" rel="stylesheet" type="text/css">';
		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/calendar/calendar.js"></script> ';
		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/calendar/lang/calendar-en.js"></script> ';
		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/calendar/calendar-setup.js"></script> ';
//		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/function_search.js"></script>';
		//$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/prototype.js"></script> ';
		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/effects.js"></script> ';
		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/controls.js"></script> ';
		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/jquery-1.3.2.js"></script> ';
		$buildheadercontent .= '<script type="text/javascript" src="' . base_url() . 'js/prettyCheckboxes.js"  charset="utf-8"></script>';
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
			$data['title'] = $this->lang->line('system_name') . ' - ' . $this->lang->line('page_invoice_home');	
			$data['main'] = 'invoice/home';
			$this->load->vars($data);
			$this->load->view('template');
		}

	}
	
	function create()
	{
		if ( ! $this->dx_auth->is_logged_in())
		{				 
			$this->login();
		} else {
		
			if ( isset( $_POST['submit'] )) 
			{

			//	$this->load->model('minvoices');
				
				$invoice_already_created = $this->minvoices-> invoice_already_created();
			
				if (!$invoice_already_created) {
					$invoice_id = $this->minvoices->create_invoice( $_POST['frame_price'], $_POST['lens_price'], $_POST['treatment_price'], $_POST['coating_price'], $_POST['subtotal'], $_POST['discount'], $_POST['tax'], $_POST['total'], $_POST['deposit'] );
					
					//computer balance due to enter in ledger based on order total minus deposit
					$balance_due = $_POST['total'] - $_POST['deposit'];

					$this->load->model('mledger');
					$entry_type = 0;	//type = new invoice
					$ledger_id = $this->mledger->write_to_ledger( $balance_due, $entry_type );
				
								
					if ($invoice_id > 0){
						$this->session->set_flashdata('flashmessage', 'Invoice created successfully');
						$this->session->unset_userdata( 'order_id' );
					} else {
						$this->session->set_flashdata('flashmessage', 'An error occured trying to create the invoice');
					}
					
					redirect('invoice/print_invoice/' . $invoice_id, 'location');
				} else {
					$this->session->set_flashdata('flashmessage', 'An invoice already exists for this order');
					redirect('main/display_client/' . $this->session->userdata('current_client') , 'location');	
				}

			
				
			} else {
					
	
				$this->load->model('morders');
				$this->load->model('mlenses');
				$this->load->model('mframes');
				$this->load->model('mlens_treatments');
				$this->load->model('mlens_coatings');
				$this->load->model('msettings');
		
				$order_id = $this->morders->get_new_order_id( $this->session->userdata('current_client') );
				$this->session->set_userdata('order_id', $order_id );
			
				//Get customer name
				$this->load->model('mclients');
				$data['customer_name'] = $this->mclients->get_client_name( $this->session->userdata('current_client') );
				
				//get lens price
				$order_information = $this->morders->get_order_information( $order_id );
				
				foreach ($order_information as $item)
				{
					$lens_price = 0;//$this->mlenses->get_lens_price( $item['lens_id'] ) ;
					$treatment_price = $this->mlens_treatments->get_treatment_price( $item['treatment_id'] );
					$coating_price = $this->mlens_coatings->get_coating_price( $item['coating_id'] );
					$frame_price = $this->mframes->get_frame_price( $item['frame_id'] );
					$insurance = $item['insurance'];
				}
							
				//set discount field
				if (isset($_POST['discount_amount'])) { $discount_amount = $_POST['discount_amount']; } else { $discount_amount = 0.00; }
				if ( $insurance <> 'NONE' ) 
				{ 
				//insurance selected or manager allowed selected so display field to enter discount amount
					$form_data = array(
					              'name'        => 'discount_amount',
					              'id'          => 'discount_amount',
					              'value'       => $discount_amount,
					              'maxlength'   => '8',
					              'size'        => '5',
								  'onblur'		=> "discount_calculate(this);"
					            );
					$data['discount_amount_field'] = form_input($form_data) ;	
				} else {
					$data['discount_amount_field'] = $this->lang->line('discount_not_allowered_text');
				}
				
				//fill in the invoice fields
				$discount_percent = FALSE;
				$data['order_id'] = $order_id;
					
				//calculate subtotal
				$subtotal = $lens_price + $frame_price + $treatment_price + $coating_price;
				
				//Get lab fee from msettings
				$get_lab_fee = $this->msettings->get_lab_fee();
				foreach ($get_lab_fee as $item)	{
					$lab_fee_type = $item['type'];
					$lab_fee = $item['fee'];
				}
				
				//Calculate lab fee if type is percentage (not a flat fee)
				if ($lab_fee_type == 'P') {
					$lab_fee = $lab_fee / 100 ; 
					$lab_fee = $subtotal * $lab_fee;				}
					
				//Add lab fee to sub total
				$subtotal = $subtotal + $lab_fee;
				
				if ( $discount_percent ) {
					$subtotal = $subtotal * ( 1 - ($discount_amount / 100));
					$discount = $discount_amount . '%';
					$data['discount'] =  $discount ;
				} else {
					$subtotal = $subtotal - $discount_amount;
					$data['discount'] = '$' . number_format( $discount_amount, 2 );
				}
				
				//calculate tax
				//NEED TO COMPLETE - TAX RATE LOOKUP
				$tax_rate = .06;
				$tax = $subtotal * $tax_rate;
				
				//down payment box
				if ( isset($_POST['deposit'])) {
					$deposit = $_POST['deposit'];
				} else {
					$deposit = 0;
				}
				$form_data = array(
				              'name'        => 'deposit',
				              'id'          => 'deposit',
				              'value'       => $deposit ,
				              'maxlength'   => '8',
				              'size'        => '8',
							  'onblur'		=> "check(this);"
				            );
				$data['deposit_field']	= form_input($form_data) ;
				
				//computer total price
				$total = $subtotal + $tax;
	
				$hidden = array('frame_price' => $frame_price, 'lens_price' => $lens_price, 'treatment_price' => $treatment_price, 'coating_price' => $coating_price, 'subtotal' => $subtotal, 'discount' => $discount_amount, 'tax' => $tax, 'total' => $total, 'labfee' => $lab_fee );
				
				$data['form_open'] = form_open('invoice/create' ) . '<BR>' .  form_hidden($hidden);;
				
				//format output
				$data['total'] = '$' . number_format( $total, 2);
				$data['frame_price'] = '$' . number_format( $frame_price, 2);
				$data['lens_price'] = '$' . number_format( $lens_price, 2 );
				$data['treatments_price'] = '$' . number_format( $treatment_price, 2 );
				$data['coatings_price'] = '$' . number_format( $coating_price, 2 );
				$data['lab_fee'] = '$' . number_format( $lab_fee, 2 );
				$data['subtotal'] = '$' . number_format( $subtotal, 2 );
				$data['tax'] = '$' . number_format( $tax, 2 );
				
				$data['just_total'] = number_format( $total, 2);
				$data['just_subtotal'] = number_format( $subtotal, 2 );
								
				$data['title'] = $this->lang->line('system_name') . ' - ' . $this->lang->line('page_invoice_create');
				$data['main'] = 'invoice/create';
				$this->load->vars($data);
				$this->load->view('template');
				
			}
		}
		
	}
	
	function print_invoice()
	{
		$this->load->model('minvoices');
		$invoice = $this->minvoices->print_invoice($this->uri->segment(3) );
		 
//	echo print_r($invoice); 

		$this->load->library('cezpdf');
		$this->load->helper('pdf');
//		foreach ($invoice as $field){ 
//			$output = $field['firstname']
//		}
		$this->cezpdf->ezText('Invoice ' . $this->uri->segment(3) , 18, array('justification' => 'center'));
		$content = 'DATA GOES HERE';  //echo print_r($invoice) ;

		//Get division name to print on the invoice
		$division_name = 'TEST TEST TEST';
		prep_pdf_invoice( $division_name, $this->lang->line('return_policy') ); 
		
		$this->cezpdf->ezText($content, 10);
		$this->cezpdf->ezStream();
		
		redirect('main/search', 'location');
	}
	
	function view() {
		echo 'this is where the invoice will be displayed.  It will pull the invoice PDF file and display it.  Will be completed after the invoice format is complete and I can create PDF invoices';	
		
	}
	
	function payment()  {
		//allow customer to make a payment on outstanding balance
		echo 'this is the payment screen . When done the user can enter a cash/CC or Insurance payment on customers existing invoice';
		
	}
	
	



}
?>