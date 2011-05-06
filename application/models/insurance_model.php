<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    class Insurance_model extends Model
    {
        function Insurance_model()
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
            $this->db->where("active" , 1);
            $result = $this->db->get("list_carriers");
            return $result->row()->total;
        }
        /*
         * Returns lens designs resultset
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
            $this->db->where("active" , 1);
            return $this->db->get("list_carriers");
        }
        /*
         * Returns the lens row given the id
         */
        public function get($id)
        {
            $this->db->where("id", $id);
            return $this->db->get("list_carriers")->row();
        }
        /*
         * Inserts new lens material row
         * returns the inserted id
         */
        public function insert($data)
        {
            $this->db->insert("list_carriers", $data);
            return $this->db->insert_id();
        }
        /*
         * Updates a lens material row
         * Param $id - the id of the row to update
         * Param $data - the key value array of columns to update
         */
        public function update($id, $data)
        {
            $this->db->where("id", $id);
            $this->db->update("list_carriers", $data);
        }

        public function delete($id)
        {
            $this->db->where("id", $id);
            $this->db->update("list_carriers", array("active" => 0));
        }
    }
?>
