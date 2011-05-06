<?php
class Mlists extends Model {

	function Mlists()
	{
		parent::Model();
	}
	
	function get_list_carriers(){
        $result = array();
        $array_keys_values = $this->db->query('SELECT carrier FROM list_carriers WHERE active = TRUE ORDER BY id ASC');
       foreach ($array_keys_values->result() as $row)
        {
            $result[$row->carrier]= $row->carrier;
            //add blank AND {manager allowed discount} to beginning of array
            $result=array_merge(array("DISCOUNT"=>$this->lang->line('discount_allowed')),$result); 
            $result=array_merge(array("NONE"=>"{None}"),$result); 
        }
        return $result;
    } 

	function get_list_bridges(){
	    $result = array();
	    $array_keys_values = $this->db->query('SELECT bridge FROM list_bridges WHERE active = TRUE ORDER BY bridge asc');
	   foreach ($array_keys_values->result() as $row)
	    {
	        $result[$row->bridge]= $row->bridge;
	    }
	    return $result;
	}	

	function get_list_discounts(){
	    $result = array();
	    $array_keys_values = $this->db->query('SELECT description, discount_id FROM list_discounts WHERE active = TRUE ORDER BY description asc');
	   foreach ($array_keys_values->result() as $row)
	    {
	        $result[$row->description]= $row->discount_id;
	    }
	    return $result;
	}
	
	function get_frame_divisions(){
	    $result = array();
	    $array_keys_values = $this->db->query('SELECT division FROM frame_divisions WHERE active = TRUE ORDER BY division asc');
	   foreach ($array_keys_values->result() as $row)
	    {
	        $result[$row->division]= $row->division;
	    }
	    return $result;
	}
	
	function get_list_all_frame_divisions(){
	    $result = array();
	    $array_keys_values = $this->db->query('SELECT division FROM frame_divisions WHERE active = TRUE ORDER BY division asc');
	   foreach ($array_keys_values->result() as $row)
	    {
	        $result[$row->division]= $row->division;
	    }
	    return $result;
	}
	
	function get_list_invoice_Status(){
	    $result = array();
	    $array_keys_values = $this->db->query('SELECT status FROM list_invoice_status WHERE active = TRUE ORDER BY status asc');
	   foreach ($array_keys_values->result() as $row)
	    {
	        $result[$row->status]= $row->status;
	    }
	    return $result;
	}

	function get_list_order_type(){
	    $result = array();
	    $array_keys_values = $this->db->query('SELECT order_type FROM list_order_type WHERE active = TRUE ORDER BY order_type asc');
	   foreach ($array_keys_values->result() as $row)
	    {
	        $result[$row->order_type]= $row->order_type;
	    }
	    return $result;
	}
	
	function get_list_lens_types(){
	    $result = array();
	    $array_keys_values = $this->db->query('SELECT id, type FROM lens_types WHERE active = TRUE ORDER BY id asc');
	   foreach ($array_keys_values->result() as $row)
	    {
	        $result[$row->id]= $row->type;
	    }
	    return $result;
	}
	
	function get_list_lens_designs(){
	    $result = array();
	    $array_keys_values = $this->db->query('SELECT id, design FROM lens_designs WHERE active = TRUE ORDER BY design asc');
	   foreach ($array_keys_values->result() as $row)
	    {
	        $result[$row->id]= $row->design ;
	    }
	    return $result;
	}		
	
	function get_list_lens_designs_by_type_id($lensTypeId)
	{	    
		$result = array();		
		$array_keys_values = $this->db->query('SELECT id, design FROM lens_designs WHERE type_id='.$lensTypeId.' and active = TRUE ORDER BY design asc');	   
		foreach ($array_keys_values->result() as $row)	    
		{	        
			$result[$row->id]= $row->design ;	    
		}	    
		return $result;	
	}	
	
	function get_frame_colors_frame_id($frame_id 	)
	{	    
		$result = array();		
		$array_keys_values = $this->db->query('SELECT id, color FROM frame_colors WHERE frame_id ='.$frame_id.' or frame_id=0');	   
		foreach ($array_keys_values->result() as $row)	    
		{	        
			$result[$row->id]= $row->color ;	    
		}	    
		return $result;	
	}
	
	function get_list_lens_materials(){
	    $result = array();
	    $array_keys_values = $this->db->query('SELECT id, material FROM lens_materials WHERE active = TRUE ORDER BY material asc');
	   foreach ($array_keys_values->result() as $row)
	    {
	        $result[$row->id]= $row->material ;//. ' - $' . $row->price ;
	    }
	    return $result;
	}		function getLensMaterialByDesignId($lensTypeId){	    $result = array();		$array_keys_values = $this->db->query('SELECT lens_materials.id, material FROM lens_materials,lens_pricing WHERE lens_pricing.design_id='.$lensTypeId.' and 																														 lens_pricing.material_id=lens_materials.id and 																														 lens_materials.active = TRUE 																																		ORDER BY material asc');	   foreach ($array_keys_values->result() as $row)	    {	        $result[$row->id]= $row->material ;	    }	    return $result;	}		
	
	function get_list_lens_treatments(){
	    $result = array();
	    $array_keys_values = $this->db->query('SELECT id, treatment, retail_price FROM lens_treatments WHERE active = TRUE ORDER BY treatment asc');
	   foreach ($array_keys_values->result() as $row)
	    {
	        $result[$row->id]= $row->treatment;// . ' - $' . $row->price;
	    }
	    return $result;
	}
	
	function get_list_lens_coatings() {
	    $result = array();
	    $array_keys_values = $this->db->query('SELECT id, coating, retail_price AS price FROM lens_coatings WHERE active = TRUE ORDER BY coating asc');
	   foreach ($array_keys_values->result() as $row)
	    {
	        $result[$row->id]= $row->coating . ' - $' . $row->price ;
	    }
	    return $result;
	}

	function get_list_lens_colors(){
	    $result = array();
	    $array_keys_values = $this->db->query('SELECT color FROM lens_colors WHERE active = TRUE ORDER BY color asc');
	   foreach ($array_keys_values->result() as $row)
	    {
	        $result[$row->color]= $row->color;
	    }
	    return $result;
	}	


	function get_list_lens_pd(){
	    $result = array();
	    $array_keys_values = $this->db->query('SELECT distance FROM list_lens_pd WHERE active = TRUE ORDER BY distance asc');
	   foreach ($array_keys_values->result() as $row)
	    {
	        $result[$row->distance]= $row->distance;
	    }
	    return $result;
	}
	
	function get_list_lens_shapes(){
	    $result = array();
	    $array_keys_values = $this->db->query('SELECT shape FROM list_lens_shapes WHERE active = TRUE ORDER BY shape asc');
	   foreach ($array_keys_values->result() as $row)
	    {
	        $result[$row->shape]= $row->shape;
	    }
	    return $result;
	}
	
	function get_list_lens_sizes(){
	    $result = array();
	    $array_keys_values = $this->db->query('SELECT size FROM list_lens_sizes WHERE active = TRUE ORDER BY size ASC');
	   foreach ($array_keys_values->result() as $row)
	    {
	        $result[$row->size]= $row->size;
	    }
	    return $result;
	}

	function get_list_lens_bases(){
	    $result = array();
	    $array_keys_values = $this->db->query('SELECT base FROM list_lens_bases WHERE active = TRUE ORDER BY id ASC');
	   foreach ($array_keys_values->result() as $row)
	    {
	        $result[$row->base]= $row->base;
	    }
	    return $result;
	}
	
	function get_list_bridge_sizes(){
	    $result = array();
	    $array_keys_values = $this->db->query('SELECT size FROM list_bridge_sizes WHERE active = TRUE ORDER BY size asc');
	   foreach ($array_keys_values->result() as $row)
	    {
	        $result[$row->size]= $row->size;
	    }
	    return $result;
	}
	
	function get_frame_manufacturers(){
	    $result = array();
	    $array_keys_values = $this->db->query('SELECT manufacturer FROM frame_manufacturers WHERE active = TRUE ORDER BY manufacturer asc');
	   foreach ($array_keys_values->result() as $row)
	    {
	        $result[$row->manufacturer]= $row->manufacturer;
	    }
	    return $result;
	}
	
	function get_frame_names(){
	    $result = array();
	    $array_keys_values = $this->db->query('SELECT name, id FROM frames WHERE active = TRUE ORDER BY name asc');
	   foreach ($array_keys_values->result() as $row)
	    {
	        $result[$row->id]= $row->name;
	    }
	    return $result;
	}	
	
	function get_frame_colors(){
	    $result = array();
	    $array_keys_values = $this->db->query('SELECT c.color AS color , c.id as id FROM frames f, frame_colors c, frame_inventory i WHERE  i.frame_id = f.id AND i.store_id = \'' . $this->session->userdata('store_id') . '\' GROUP BY color ' );
	   foreach ($array_keys_values->result() as $row)
	    {
	        $result[$row->id]= $row->color;
	    }
	    return $result;
	    
	    
	    // SELECT c.color AS color , c.id as id, i.store_id, f.name FROM frames f, frame_colors c, frame_inventory i WHERE  i.store_id = '34onehour' AND i.quantity > 0 AND f.id = i.frame_id GROUP BY color
	}

	function get_list_remake_reasons(){
	    $result = array();
	    $array_keys_values = $this->db->query('SELECT reason FROM list_remake_reasons WHERE active = TRUE ORDER BY reason asc');
	   foreach ($array_keys_values->result() as $row)
	    {
	        $result[$row->reason]= $row->reason;
	    }
	    return $result;
	}
	
	function get_list_temple_lengths(){
	    $result = array();
	    $array_keys_values = $this->db->query('SELECT temple_length FROM list_temple_lengths WHERE active = TRUE ORDER BY temple_length asc');
	   foreach ($array_keys_values->result() as $row)
	    {
	        $result[$row->temple_length]= $row->temple_length;
	    }
	    return $result;
	}
	
	function get_list_temple_styles(){
	    $result = array();
	    $array_keys_values = $this->db->query('SELECT temple_style FROM list_temple_styles WHERE active = TRUE ORDER BY temple_style asc');
	   foreach ($array_keys_values->result() as $row)
	    {
	        $result[$row->temple_style]= $row->temple_style;
	    }
	    return $result;
	}
	
	function get_list_diag_codes(){
	    $result = array();
	    $array_keys_values = $this->db->query('SELECT diag_code FROM list_diag_codes WHERE active = TRUE ORDER BY diag_code asc');
	   foreach ($array_keys_values->result() as $row)
	    {
	        $result[$row->diag_code]= $row->diag_code;
	    }
	    return $result;
	}
	
	function get_list_roles(){
	    $result = array();
	    $array_keys_values = $this->db->query('SELECT id, name FROM roles ORDER BY name ASC');
	   foreach ($array_keys_values->result() as $row)
	    {
	        $result[$row->id]= $row->name;
	    }
	    return $result;
	}	
	



}
?>