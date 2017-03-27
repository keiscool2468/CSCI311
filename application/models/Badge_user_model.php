<?php 

class Badge_user_model extends MY_Model {
		public $_table = 'badge_users';
    	public function get_badge_users($slug = TRUE)
        {
                if ($slug === TRUE)
                {
                        $query = $this->db->get_where('badge_users');
                        return $query->result_array();
                }
                return $query->row_array();
        }
}