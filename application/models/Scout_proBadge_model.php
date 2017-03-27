<?php 

class Scout_proBadge_model extends MY_Model {
        public $_table = 'scout_proBadges';
        public function get_scout_proBadges($slug = TRUE)
        {
                if ($slug === TRUE)
                {
                        $query = $this->db->get_where('scout_proBadges');
                        return $query->result_array();
                        // print_r($query);
                }

                // $query = $this->db->get_where('admin_users_groups', 'group_id');
                return $query->row_array();
        }
}