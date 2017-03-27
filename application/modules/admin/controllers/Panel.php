<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Panel management, includes: 
 * 	- Admin Users CRUD
 * 	- Admin User Groups CRUD
 * 	- Admin User Reset Password
 * 	- Account Settings (for login user)
 */
class Panel extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('admin_user_model');
		$this->load->model('admin_user_group_model');
		$this->load->model('year_scout_model');
		$this->load->model('scout_personal_particular_model');
		$this->load->model('scout_personal_particular_update_record_model');
	}


	public function personal_particular_edit($user_id)
	{
		$number = $this->db->get('year_scouts')->result_array();
		$result = $this->db->get_where('scout_personal_particulars', array('user_id' => $user_id));
		$number2 = $number[0]['scout']/10;
		if($number2 >= 10) {
			$code = date("Y")*1000 + $number[0]['scout'];
		} else if($number2 >= 1) {
			$code = date("Y")*1000 + $number[0]['scout'];
		} else {
			$code = date("Y")*1000 + $number[0]['scout'];
		}
		// print_r("HKG/90/".$code);exit;
	   	if($result->num_rows()==0){
	   		$new_spp = array(
				'user_id'					=> $user_id,
				'chinese_name'				=> '',
				'english_first_name'		=> '',
				'english_last_name'			=> '',
				'date_of_birth'				=> '',
				'age'						=> '',
				'gender'					=> '',
				'hkid'						=> '',
				'record_book_number'		=> 'HKG/90/'.$code,
				'date_of_investiture'		=> '',
				'region'					=> '5',
				'district'					=> '43',
				'group_number'				=> '',
				'chinese_address'			=> '',
				'english_address'			=> '',
				'contact_number'			=> '',
				'email_address'				=> '',
			);
			$number[0]['scout']++;
			$this->db->insert('scout_personal_particulars', $new_spp);
			$this->db->update('year_scouts', $number[0]);
			refresh();
	   	} 
	   	else{
   			$q = $this->db->get_where('scout_personal_particulars',array('user_id' => $user_id));
   			$record = $q->result_array();
	  	}
		$form = $this->form_builder->create_form();
		if ($_SERVER['REQUEST_METHOD'] === 'POST')
		{	
			$scoutType = $this->db->get_where('admin_users_groups', array('user_id' => $user_id))->result_array();
			$updatePath = 0;
			if ($scoutType[0]['group_id'] == 3) {
				$updatePath = 1;
			} elseif ($scoutType[0]['group_id'] == 4) {
				$updatePath = 2;
			} elseif ($scoutType[0]['group_id'] == 5) {
				$updatePath = 3;
			}
			// passed validation
			$person = array(
				'award_path'			=> $updatePath,
				'user_id'				=> $user_id,
				'chinese_name'			=> $this->input->post('chinese_name'),
				'english_first_name'	=> $this->input->post('english_first_name'),
				'english_last_name'		=> $this->input->post('english_last_name'),
				'date_of_birth'			=> $this->input->post('date_of_birth'),
				'age'					=> $this->input->post('age'),
				'gender'				=> $this->input->post('gender'),
				'hkid'					=> $this->input->post('hkid'),
				'record_book_number'	=> $this->input->post('record_book_number'),
				'date_of_investiture'	=> $this->input->post('date_of_investiture'),
				'region'				=> $this->input->post('region'),
				'district'				=> $this->input->post('district'),
				'group_number'			=> $this->input->post('group_number'),
				'chinese_address'		=> $this->input->post('chinese_address'),
				'english_address'		=> $this->input->post('english_address'),
				'contact_number'		=> $this->input->post('contact_number'),
				'email_address'			=> $this->input->post('email_address')
			);
			$this->db->where('user_id', $user_id);
			$this->db->update('scout_personal_particulars', $person);
			refresh(); 
		}
		$q = $this->db->get_where('scout_personal_particulars',array('user_id' => $user_id));
		$record = $q->result_array()[0];
		$this->mPageTitle = 'Personal Particular';
		$region = ['Kowloon','East Kowloon','New Territories','New Territories East','Hong Kong Island', ''];
		$district = ['Chai Wan','Northern','Sau Kei Wan','Southern','Victoria City','Wan Chai','Western',//0~6 is Hong Kong Island
		       'Ho Man Tin','Hung Hom','Kowloon City','Kowloon Tong','Mong Kok','Sham Mong','Sham Shui Po East',
		              'Sham Shui Po West','Yau Tsim',//7~15 is Kowloon
		               	'Kowloon Bay','Kwun Tong','Lei Yue Mun','Sai Kung','Sau Mau Ping','Tseung Kwan O','Tsz Wan Shan','Wong Tai Sin',//16~23 is East Kowloon
		               	        'Island','North Kwai Chung','Shep Pak Heung','South Kwai Chung','Tsing Yi','Tsuen Wan',
		               	              'Tuen Mun East District','Tuen Mun West','Yuen Long East','Yuen Long West',//24~33 is New Terrisories
		               	                  'Pik Fung','Shatin East','Shatin North','Shatin South','Shatin West','Sheung Yue','Tai Po South','Tai Po North',//34~42 is New Territories East
		               	                          'Silver Jubilee',''];
		$this->mViewData = array(
				'form'					=>	$form,
				'vister'				=>	$this->mUser->username,
				'record'				=> 	$record,
				'user_id'				=>	$user_id,
				'region'				=>  $region,
				'district'				=>	$district
		); 
		$this->render('panel/scout_personal_particular_edit');
	}

	// Admin Users CRUD
	public function admin_user()
	{
		$crud = $this->generate_crud('admin_users');
		$crud->set_relation('id', 'admin_users_groups', 'group_id');
		$crud->where('group_id <', 3);
		$crud->columns('groups', 'username', 'active');
		$this->unset_crud_fields('ip_address', 'last_login');
		// cannot change Admin User groups once created
		if ($crud->getState()=='list')
		{
			$crud->set_relation_n_n('groups', 'admin_users_groups', 'admin_groups', 'user_id', 'group_id', 'name');
		}
		// only webmaster can reset Admin User password
		if ( $this->ion_auth->in_group(array('webmaster', 'admin')) )
		{
			$crud->add_action('Reset Password', '', $this->mModule.'/panel/admin_user_reset_password', 'fa fa-repeat');
		}
		
		
		// disable direct create / delete Admin User
		$crud->unset_edit();
		$crud->unset_add();
		$crud->unset_delete();
		$crud->unset_export();
		$crud->unset_print();
		$this->mPageTitle = 'Leader Account';
		$this->render_crud();
	}

	public function scout_user()
	{
		$crud = $this->generate_crud('admin_users');
		$crud->set_relation('id', 'admin_users_groups', 'group_id');
		$crud->where('group_id >', 2);
		$crud->columns('groups', 'username', 'first_name', 'last_name', 'active');
		$this->unset_crud_fields('ip_address', 'last_login');

		// cannot change Admin User groups once created
		if ($crud->getState()=='list')
		{
			$crud->set_relation_n_n('groups', 'admin_users_groups', 'admin_groups', 'user_id', 'group_id', 'name');
		}

		// only webmaster can reset Admin User password
		if ( $this->ion_auth->in_group(array('webmaster')) )
		{
			$crud->add_action('Reset Password', '', $this->mModule.'/panel/admin_user_reset_password', 'fa fa-repeat');
			$crud->add_action('Personal Particular', '', $this->mModule.'/panel/personal_particular_edit', 'fa fa-id-card-o');
			$crud->add_action('Print Chief Form', '', $this->mModule.'/printer/print_form_crud', 'fa fa-star');
			$crud->add_action('Scout Proficiency Badges', '', $this->mModule.'/badge/scout_badge', 'fa fa-star-o');
		} elseif ($this->ion_auth->in_group(array('webmaster','Leader')))
		{
			$crud->add_action('Print Chief Form', '', $this->mModule.'/printer/print_form_crud', 'fa fa-star');
			$crud->add_action('Scout Proficiency Badges', '', $this->mModule.'/badge/scout_badge', 'fa fa-star-o');
		}
		
		// disable direct create / delete Admin User
		$crud->unset_add();
		$crud->unset_delete();
		$crud->unset_export();
		$crud->unset_print();
		$crud->unset_jquery_ui();
		$this->mPageTitle = 'Scout Account';
		$this->render_crud();
	}

	// Create Admin User
	public function admin_user_create()
	{
		$form = $this->form_builder->create_form();
		if ($form->validate())
		{
			// passed validation
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$additional_data = array(
				'first_name'	=> $this->input->post('first_name'),
				'last_name'		=> $this->input->post('last_name'),
			$groups = $this->input->post('groups[]'),
			);
			// create user (default group as "members")
			$user = $this->ion_auth->register($username, $password, $email, $additional_data, $groups);
			if ($user)
			{
				// success
				$messages = $this->ion_auth->messages();
				$this->system_message->set_success($messages);
			}
			else
			{
				// failed
				$errors = $this->ion_auth->errors();
				$this->system_message->set_error($errors);
			}
		}

		$groups = $this->ion_auth->groups()->result();
		unset($groups[0]);	// disable creation of "webmaster" account
		$this->mViewData['groups'] = $groups;
		$this->mPageTitle = 'Create Admin User';

		$this->mViewData['form'] = $form;
		$this->render('panel/admin_user_create');
	}

	// Admin User Groups CRUD
	public function admin_user_group()
	{
		$crud = $this->generate_crud('admin_groups');
		$this->mPageTitle = 'Admin User Groups';
		$this->render_crud();
	}

	// Admin User Reset password
	public function admin_user_reset_password($user_id)
	{
		// only top-level users can reset Admin User passwords
		$this->verify_auth(array('webmaster'));

		$form = $this->form_builder->create_form();
		if ($form->validate())
		{
			// pass validation
			$data = array('password' => $this->input->post('new_password'));
			if ($this->ion_auth->update($user_id, $data))
			{
				$messages = $this->ion_auth->messages();
				$this->system_message->set_success($messages);
			}
			else
			{
				$errors = $this->ion_auth->errors();
				$this->system_message->set_error($errors);
			}
			refresh();
		}

		$this->load->model('admin_user_model', 'admin_users');
		$target = $this->admin_users->get($user_id);
		$this->mViewData['target'] = $target;

		$this->mViewData['form'] = $form;
		$this->mPageTitle = 'Reset Admin User Password';
		$this->render('panel/admin_user_reset_password');
	}

	// Account Settings
	public function account()
	{
		// Update Info form
		$form1 = $this->form_builder->create_form($this->mModule.'/panel/account_update_info');
		$form1->set_rule_group('panel/account_update_info');
		$this->mViewData['form1'] = $form1;

		// Change Password form
		$form2 = $this->form_builder->create_form($this->mModule.'/panel/account_change_password');
		$form1->set_rule_group('panel/account_change_password');
		$this->mViewData['form2'] = $form2;

		$this->mPageTitle = "Account Settings";
		$this->render('panel/account');
	}

	// Submission of Update Info form
	public function account_update_info()
	{
		$data = $this->input->post();
		if ($this->ion_auth->update($this->mUser->id, $data))
		{
			$messages = $this->ion_auth->messages();
			$this->system_message->set_success($messages);
		}
		else
		{
			$errors = $this->ion_auth->errors();
			$this->system_message->set_error($errors);
		}

		redirect($this->mModule.'/panel/account');
	}

	// Submission of Change Password form
	public function account_change_password()
	{
		$data = array('password' => $this->input->post('new_password'));
		if ($this->ion_auth->update($this->mUser->id, $data))
		{
			$messages = $this->ion_auth->messages();
			$this->system_message->set_success($messages);
		}
		else
		{
			$errors = $this->ion_auth->errors();
			$this->system_message->set_error($errors);
		}

		redirect($this->mModule.'/panel/account');
	}
	
	/**
	 * Logout user
	 */
	public function logout()
	{
		$this->ion_auth->logout();
		redirect($this->mConfig['login_url']);
	}
}
