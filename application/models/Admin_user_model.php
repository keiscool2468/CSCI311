<?php 

class Admin_user_model extends MY_Model {
		public $_table = 'admin_users';
    	public function get_admin_users($slug = TRUE)
        {
                if ($slug === TRUE)
                {
                        $query = $this->db->get_where('admin_users');
                        return $query->result_array();
                        // print_r($query);
                }

                // $query = $this->db->get_where('admin_users_groups', 'group_id');
                return $query->row_array();
        }
}