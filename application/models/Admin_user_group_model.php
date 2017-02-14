<?php 

class Admin_user_group_model extends MY_Model {
	public $_table = 'admin_users_groups';
        public function get_admin_user_groups($slug = TRUE)
        {
                if ($slug === TRUE)
                {
                        $query = $this->db->get_where('admin_users_groups');
                        return $query->result_array();
                        // print_r($query);
                }

                // $query = $this->db->get_where('admin_users_groups', 'group_id');
                return $query->row_array();
        }
}