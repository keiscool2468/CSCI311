<?php 

class Scout_chief_award_model extends MY_Model {
        public $_table = 'scout_chief_awards';
        public function get_scout_chief_awards($slug = TRUE)
        {
                if ($slug === TRUE)
                {
                        $query = $this->db->get_where('scout_chief_awards');
                        return $query->result_array();
                        // print_r($query);
                }

                // $query = $this->db->get_where('admin_users_groups', 'group_id');
                return $query->row_array();
        }
}