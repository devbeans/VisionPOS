<?php

class Morders extends Model {



	function Morders()

	{

		parent::Model();

	}
	
	function getOrders ( )
	{
		$query = $this->db->query('SELECT client_id, order_id, invoice_id, order_date, delivered_date, paid_in_full, order_type FROM orders  WHERE client_id = \'' . $this->session->userdata('current_client') .'\'' );
			
		if ($query->num_rows() > 0) 
		{
			return $query->result_array(); 
		}
	}

	function get_order ( $order_id )
	{
	
		$this->db->select('*, lm.material AS lens_material, lc.coating AS lens_coating, lc.retail_price AS lens_coating_price, lc.coating AS lens_type, lc.coating AS lens_treatment, lc.coating AS lens_design, lc.coating AS lens_coating, lc.coating AS lens_treatment_price ');  		//, lt.type AS lens_type
		$this->db->where( 'order_id', $order_id );
		$this->db->limit('1');
		$this->db->join('lens_materials lm', 'lm.id = o.material_id');
		$this->db->join('lens_coatings lc' , 'lc.id = o.coating_id');
	//	$this->db->join('lens_types lt', 'lt.id = o.type_id');
		
		$query = $this->db->get('orders o');
		
		if ($query->num_rows() > 0) 
		{
			return $query->result_array(); 
		}
	
	}


        public function lens_treatment_price($lt_id)
        {
            $treatments_price = 0;

            if (is_array($lt_id))
            {
                foreach ($lt_id as $i)
                {
                   $this->db->select_sum( 'retail_price' );
                    $this->db->where( 'id', $i ) ;

                    $query = $this->db->get('lens_treatments');

                    if ($query->num_rows() > 0)
                    {
                       $row = $query->row();
                       $treatments_price +=  $row->retail_price;
                    }
                }
            }
            else
            {
                $this->db->select_sum( 'retail_price' );
                $this->db->where( 'id', $lt_id ) ;

                $query = $this->db->get('lens_treatments');

		if ($query->num_rows() > 0)
		{
		   $row = $query->row();
		   $treatments_price =  $row->retail_price;
		}

            }

            return $treatments_price;
        }

        public function coating_price($lc_id)
        {
           
		$this->db->select_sum( 'retail_price' );
		$this->db->where( 'id', $lc_id ) ;
		$query = $this->db->get('lens_coatings');
		$coatings_price = 0;
		if ($query->num_rows() > 0)
		{
		   $row = $query->row(); 
		   $coatings_price =  $row->retail_price;
		}

                return $coatings_price;
        }

	function write_order ( )

	{

		if ( isset( $_POST['real_treatments_selected'] ) ) {
			$lens_treatment = $_POST['real_treatments_selected'];
		} else {
			$lens_treatment = '';
		}
		/*$this->db->select_sum( 'retail_price' );
		$this->db->where( 'id', $lens_treatment ) ;
		$query = $this->db->get('lens_treatments');
		
		if ($query->num_rows() > 0)
		{
		   $row = $query->row(); 
		   $treatments_price =  $row->retail_price;
		}*/
//		echo 'treatments price ' . $treatments_price;
//DOUG - NOT DONE - still need to get the total price of all items selected not just the one

                 if ( isset( $_POST['lens_coating'] ) ) {
			$lens_coating = $_POST['lens_coating'];
		} else {
			$lens_coating = '';
		}
                

		$treatments_price = $this->lens_treatment_price($lens_treatment);
                $coatings_price = $this->coating_price($lens_coating);
		
		
		$lens_price = 150;
		$frame_price = 250;
		
		$update_client = FALSE;
		if ( isset($_POST['insurance_id'])) $update_client = TRUE;
		if ( isset($_POST['doctor_id'])) $update_client = TRUE;
		if ( isset($_POST['dob'])) $update_client = TRUE;
		
		if ( $_POST['doctor_id'] == 'OTHER' ) {
			//other doctor selected so there should be an OTHER doctor value...set that value
			$other_doctor = $_POST['otherDoctor'];
			$doctor_id = 'OTHER';
		} else	{
			//a doctor from the list was selected so write that doctors ID to the DB
			$doctor_id = $_POST['doctor_id'];
			$other_doctor = '';
		}
		
		$order_data = array(
			'client_id' =>  $this->session->userdata('current_client') ,
			'dispencer_id' => $_POST['dispencer_id'] ,
			'order_date' =>  date('Y-m-d') ,
			'order_type' =>  $_POST['order_type'] ,
			'doctor_id' => $doctor_id ,
			'store_id' => $this->session->userdata('store_id') , 
			'other_doctor' => $other_doctor,
			'insurance_id' =>  $_POST['insurance_id']  ,
			'remake_reason' =>   $_POST['remake_reason'] ,
			'segment_height_l' =>  $_POST['segment_height_l']  ,
			'segment_height_r' =>  $_POST['segment_height_r']  ,
			'lens_color' =>  $_POST['lens_color']  ,
			'lens_size_a' =>  $_POST['lens_size_a']  ,
			'lens_size_b' =>  $_POST['lens_size_b']  ,
			'lens_size_ed' =>  $_POST['lens_size_ed']  ,
			'lens_id' =>  $_POST['lens_type']  ,
			'design_id' =>  $_POST['lens_design']  ,
			'material_id' =>  $_POST['lens_material']  ,
//			'treatment_id' =>  $lens_treatment  ,	//being saved to separate table so no need to save here. 
			'coating_id' =>  $_POST['lens_coating']  ,
//		 	'lens_treatment_price' =>  $treatments_price  ,
//		 	'lens_coating_price' =>  $coatings_price  ,
//		 	'lens_price' => $lens_price,
//		 	'frame_price' => $frame_price,
			'bridge_size' =>  $_POST['bridge_size']  ,
			'temple_length' =>  $_POST['temple_length']  ,
			'add_l' =>  $_POST['add_l']  ,
			'add_r' =>  $_POST['add_r']  ,
			'special_instructions' =>  $_POST['special_instructions']  ,
			'pd_near_l' =>  $_POST['pd_near_l']  ,
			'pd_near_r' =>  $_POST['pd_near_r']  ,
			'pd_far_l' =>  $_POST['pd_far_l']  ,
			'pd_far_r' =>  $_POST['pd_far_r']  ,
			'diag_code' =>  $_POST['diag_code']  ,
			'frame_id' =>  $_POST['frame_name']
		  );
	
		$this->db->insert(  'orders', $order_data  ); 
		$id = $this->db->insert_id();
		if ( $update_client ) {
			$client_data = array(
				'doctor_id' => $_POST['doctor_id'] ,
				'insurance_id' =>  $_POST['insurance_id']  ,
				'dob' => $_POST['dob']
			);
			$this->db->where('client_id', $this->session->userdata('current_client') );
			$this->db->update( 'clients', $client_data  );
			
			//NEED TO COMPLETE - Need to put in check that data was successfully written rather than just assuming it was.
		}

                return $id;
		
	}
	
	function get_new_order_id( $client_id )	
	{
	
		$this->db->select( 'order_id' );
		$this->db->where( 'invoice_id', NULL ) ;
		$this->db->where( 'client_id', $client_id );
		$query = $this->db->get('orders');
		
		if ($query->num_rows() > 0)
		{
		   $row = $query->row(); 
		   $order_id =  $row->order_id;
		   return $order_id;
		}
	}
	
	function check_for_uninvoiced_order()
	{
		 $this->db->query('SELECT order_id AS uninvoiced FROM orders WHERE client_id = \'' . $this->session->userdata('current_client') .'\' AND invoice_id IS NOT NULL' );
		 
		 $result = $this->db->count_all_results();
		 return $result;
		 
		 //NOT FINISHED
	}

	function print_work_order( $invoice_id ) 
	{
	
		//THIS STILL NEEDS MODIFIED TO load the fields for Work order rather than invoice.
	
		$query = $this->db->query(' select c.firstname AS firstname, c.lastname AS lastname, c.address AS address, c.address2 AS address2, c.city AS city, c.state AS state, c.zip AS zipcode, i.lens_price AS lens_price, i.frame_price AS frame_price, i.discount AS discount, i.tax AS tax, i.total AS total, i.deposit AS deposit, i.paid_in_full AS pif, u.username AS dispencer, s.name AS store_name, o.order_date AS order_date, d.lastname AS doctor, o.lens_color AS lens_color, o.lens_type AS lens_type, o.lens_design AS lens_design, o.lens_material AS lens_material, o.lens_treatment AS lens_treatment, o.lens_coating AS lens_coating, o.special_instructions AS spec_inst, o.diag_code AS diag_code, f.frame_name , f.frame_mfg AS frame_mfg
		FROM invoices i, orders o, clients c, users u, stores s, doctors d, frames f
		WHERE c.client_id = i.client_id AND u.id = o.dispencer_id AND s.store_id = i.store_id AND d.doctor_id = o.doctor_id AND f.frame_id = o.frame_id AND i.invoice_id = ' . $invoice_id );
		
		if ($query->num_rows() > 0) 
		{
			return $query->result_array(); 
		}

	}
	
	
	function get_order_information($id)
	{
		$this->db->select('frame_id, lens_id, treatment_id, coating_id, insurance' );
		$this->db->where('order_id', $id);
		$this->db->limit(1);
		$query = $this->db->get('orders');
		if ($query->num_rows() > 0) 
		{
			return $query->result_array(); 
		}	
	}
	

	
	

}

?>