<?php 

class Scout_personal_particular_update_record_model extends MY_Model {
        public $_table = 'scout_personal_particular_update_records';
        public function get_scout_personal_particular_update_records($slug = TRUE)
        {
                if ($slug === TRUE)
                {
                        $query = $this->db->get_where('scout_personal_particular_update_records');
                        return $query->result_array();
                        // print_r($query);
                }

                // $query = $this->db->get_where('admin_users_groups', 'group_id');
                return $query->row_array();
        }
}