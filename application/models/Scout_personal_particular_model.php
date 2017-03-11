<?php 

class Scout_personal_particular_model extends MY_Model {
        public $_table = 'scout_personal_particulars';
        public function get_scout_personal_particulars($slug = TRUE)
        {
                if ($slug === TRUE)
                {
                        $query = $this->db->get_where('scout_personal_particulars');
                        return $query->result_array();
                        // print_r($query);
                }

                // $query = $this->db->get_where('admin_users_groups', 'group_id');
                return $query->row_array();
        }
}