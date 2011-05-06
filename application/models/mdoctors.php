<?php

class Mdoctors extends Model {



	function Mdoctors()

	{

		parent::Model();

	}

        public function count($args = NULL)
        {
            if (is_array($args))
            {
                foreach ($args as $field => $value)
                {
                    $this->db->where($field, $value);
                }
            }

            $this->db->select("count(*) AS 'total'");
            $result = $this->db->get("doctors");
            return $result->row()->total;
        }
        /*
         * Returns lens types resultset
         * Param $start = starting index
         * Param $limit = number of rows to return
         * Param $args  = fields to filter
         */
        public function select($start = NULL, $limit = NULL, $args = NULL)
        {
            if (is_array($args))
            {
                foreach ($args as $field => $value)
                {
                    $this->db->where($field, $value);
                }
            }
            if ($start >= 0)
                $this->db->limit($limit, $start);


            return $this->db->get("doctors");
        }
        /*
         * Returns the lens row given the id
         */
        public function get($id)
        {
            $this->db->where("doctor_id", $id);
            return $this->db->get('doctors')->row();
        }
        /*
         * Inserts new lens material row
         * returns the inserted id
         */
        public function insert($data)
        {
            $this->db->insert("doctors", $data);
            return $this->db->insert_id();
        }
        /*
         * Updates a lens material row
         * Param $id - the id of the row to update
         * Param $data - the key value array of columns to update
         */
        public function update($id, $data)
        {
            $this->db->where("doctor_id", $id);
            $this->db->update("doctors", $data);
        }

        public function delete($id)
        {
            $this->db->where("doctor_id", $id);
            $this->db->delete("doctors");
        }


	function get_dropdown_array($key, $value){
        $result = array();
        $array_keys_values = $this->db->query('SELECT '.$key.', '.$value.' FROM doctors WHERE active = TRUE ORDER BY  ' . $value . ' ASC');
       foreach ($array_keys_values->result() as $row)
        {
            $result[$row->$key]= $row->$value;
        }
        //add blank AND Outside_Source to beginning of array
        $result=array_merge(array("OTHER"=>$this->lang->line('non_listed_doctor')),$result); 
        $result=array_merge(array("BLANK"=>" "),$result); 
        
        return $result;
    } 
    
    function get_list_doctors()
    {
		$this->db->select('lastname, firstname, doctor_id');
		$this->db->order_by('lastname', 'ASC');
		$this->db->where('doctor_id <>', 'outside_source');
		$this->db->where('active', '1');
		$query = $this->db->get('doctors');

    	if ($query->num_rows() > 0) {	
		$result =  $query->result_array();
		return $result;
		}   	
    }
    
    function add_doctor ( $lastname, $firstname )
    {
    //echo $firstname . $lastname;
    	$this->db->select('lastname, firstname'  );
    	$this->db->where('lastname', $lastname );
    	$this->db->where('firstname', $firstname );
    	$num_rows = $this->db->count_all_results('doctors');
    	
    	if ( $num_rows <= 0 ) {
    		$data = array( 
    			'lastname' => $lastname,
    			'firstname' => $firstname,
    			'doctor_id' => substr($firstname,0,1) . $lastname
    		);
    		$result = $this->db->insert('doctors', $data );
    		return $result;
    	}  
    }
    
    function delete_doctor( $doctor_id )
    {
    	$data = array(
    		'active' => '0'
    	);
    	$this->db->where( 'doctor_id', $doctor_id );
    	$result = $this->db->update( 'doctors', $data);
    	
    	return $result;
    }
	
}
?>