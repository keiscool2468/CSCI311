<?php 

class Scout_standard_award_model extends MY_Model {
        public $_table = 'scout_standard_awards';
        public function get_scout_standard_awards($slug = TRUE)
        {
                if ($slug === TRUE)
                {
                        $query = $this->db->get_where('scout_standard_awards');
                        return $query->result_array();
                        // print_r($query);
                }

                // $query = $this->db->get_where('admin_users_groups', 'group_id');
                return $query->row_array();
        }
}