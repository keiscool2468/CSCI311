<?php 

class Year_scout_model extends MY_Model {
        public $_table = 'year_scouts';
        public function get_year_scouts($slug = TRUE)
        {
                if ($slug === TRUE)
                {
                        $query = $this->db->get_where('year_scouts');
                        return $query->result_array();
                        // print_r($query);
                }

                // $query = $this->db->get_where('admin_users_groups', 'group_id');
                return $query->row_array();
        }
}