<?php

class Mlens_treatments extends Model {



	function Mlens_treatments()

	{

		parent::Model();

	}
	
	function get_list_treatments(){
	    $result = array();
	    $query = $this->db->query('SELECT * FROM lens_treatments WHERE active = TRUE ORDER BY treatment asc');
		if ($query->num_rows() > 0) {	
			$result =  $query->result_array();
			return $result;
		} 
	}
	
	function delete_lens_treatment( $treatment )
	{
		$data = array(
			'active' => 'FALSE'
		);
		$this->db->where( 'treatment', $treatment );
		$result = $this->db->update( 'lens_treatments', $data);
		
		return $result;
	}
	
	function add_lens_treatment ( $treatment )
	{
		$this->db->where('treatment', $treatment );
		$num_rows = $this->db->count_all_results('lens_treatments');

		if ( $num_rows < 1 ) 
		{
			$data = array( 
				'treatment' => $treatment
			);
			$result = $this->db->insert('lens_treatments', $data );
			return $result;
		}  		
	}
	

	function get_treatment_price( $id ) 
	{	
		$this->db->select( 'retail_price' );
		$this->db->where( 'id', $id ) ;
		$query = $this->db->get('lens_treatments');
		
		if ($query->num_rows() > 0)
		{
		   $row = $query->row(); 
		   $treatment_price =  $row->retail_price;
		   return $treatment_price;
		}
	}


	
	
}
?>