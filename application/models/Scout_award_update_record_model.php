<?php 

class Scout_award_update_record_model extends MY_Model {
        public $_table = 'scout_award_update_records';
        public function get_scout_award_update_records($slug = TRUE)
        {
                if ($slug === TRUE)
                {
                        $query = $this->db->get_where('scout_award_update_records');
                        return $query->result_array();
                        // print_r($query);
                }

                // $query = $this->db->get_where('admin_users_groups', 'group_id');
                return $query->row_array();
        }
}