<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Panel management, includes: 
 * 	- Admin Users CRUD
 * 	- Admin User Groups CRUD
 * 	- Admin User Reset Password
 * 	- Account Settings (for login user)
 */
class Award extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('admin_user_model');
		$this->load->model('admin_user_group_model');
		$this->load->model('year_scout_model');
		$this->load->model('scout_personal_particular_model');
		$this->load->model('scout_personal_particular_update_record_model');
		$this->load->model('scout_membership_award_model');
		$this->load->model('scout_pathfinder_award_model');
		$this->load->model('scout_standard_award_model');
		$this->load->model('scout_advanced_award_model');
		$this->load->model('scout_chief_award_model');
		$this->load->model('scout_award_update_record_model');
	}

	public function scout_progressive()
	{
		$crud = $this->generate_crud('scout_personal_particulars');
		$crud->set_relation('user_id', 'admin_users', 'id');
		// $crud->set_relation('id', 'admin_users_groups', '{group_id}');
		$crud->where('award_path >', 0);
		$crud->where('active >', 0);
		$crud->where('age >', 10);
		$crud->columns('chinese_name', 'english_first_name', 'english_last_name', 'age');
		$this->unset_crud_fields('ip_address', 'last_login');
		if ( $this->ion_auth->in_group(array('webmaster', 'Leader')) )
		{
			$crud->add_action("Chief Scout's Award", 'http://prog.scouting.org.hk/scouts/TS/Progressive/ChiefScoutsAward.gif', $this->mModule.'/award/scout_chief_award');
			$crud->add_action('Advanced Award', 'http://prog.scouting.org.hk/scouts/TS/Progressive/Challenger.gif', $this->mModule.'/award/scout_advanced_award');
			$crud->add_action('Standard Award', 'http://prog.scouting.org.hk/scouts/TS/Progressive/Voyager.gif', $this->mModule.'/award/scout_standard_award');
			$crud->add_action('Pathfinder Award', 'http://prog.scouting.org.hk/scouts/TS/Progressive/Pathfinder.gif', $this->mModule.'/award/scout_pathfinder_award');
			$crud->add_action('Membership Badge', 'http://prog.scouting.org.hk/scouts/TS/Progressive/MembershipBadge.gif', $this->mModule.'/award/scout_membership_award' );
		}
		
		// disable direct create / delete Admin User
		$crud->unset_add();
		$crud->unset_delete();
		$crud->unset_export();
		$crud->unset_print();
		$crud->unset_read();
		$crud->unset_edit();
		$this->mPageTitle = 'Scout Progressive Award';
		$this->render_crud();
	}

	public function scout_membership_award($crud_id)
	{
		$sign = array(
			'one'	=> '',
			'two'	=> '',
			'three'	=> '',
			'four'	=> '',
			'five'	=> '',
			'six'	=> '',
			'seven'	=> '',
			'eight'	=> '',
			'nine'	=> '',
			'ten'	=> '',
		);
		$time = array(
			'one'	=> '',
			'two'	=> '',
			'three'	=> '',
			'four'	=> '',
			'five'	=> '',
			'six'	=> '',
			'seven'	=> '',
			'eight'	=> '',
			'nine'	=> '',
			'ten'	=> '',
		);
		$sPP = $this->db->get_where('scout_personal_particulars', array('id' => $crud_id))->result_array();
		$user_id = $sPP[0]['user_id'];
		$award = $this->db->get_where('scout_membership_awards', array('user_id' => $user_id));
		$thisRecord = $this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 1, 'sign' => 1, 'leatest' => 1))->result_array();
	   	if($award->num_rows()==0) {
	   		$new_spp = array(
				'user_id'			=> $user_id,
			);
			$this->db->insert('scout_membership_awards', $new_spp);
			refresh();
	   	} else {
			$awards = $award->result_array();
			$awardData = $awards[0];
   			$point = $awards[0]['one']+$awards[0]['two']+$awards[0]['three']+$awards[0]['four']+$awards[0]['five']+$awards[0]['six']+$awards[0]['seven']+$awards[0]['eight']+$awards[0]['nine']+$awards[0]['ten'];
   			if($point == 10) {
   				$awardData = array (
					'issue_date'	 => date("d/m/Y"),
				);
   				$this->db->update('scout_membership_awards', $awardData);
   			} else {
				$awardData = array (
					'issue_date'	 => '',
				);
   				$this->db->update('scout_membership_awards', $awardData);
   			}
	  	}
	  	$award = $this->db->get_where('scout_membership_awards', array('user_id' => $user_id));
	  	$awards = $award->result_array();
		$awardData = $awards[0];
	  	for($i = 0; $i < sizeof($thisRecord); $i++) {
			switch ($thisRecord[$i]["field"]) {
				case "one":
					if($awards[0]['one'] > 0) {
						$time['one'] = $thisRecord[$i]['update_time'];
						$sign['one'] = $thisRecord[$i]['leader_user_name'];
					}		
					break;

				case "two":
					if($awards[0]['two'] > 0) {
						$time['two'] = $thisRecord[$i]['update_time'];
						$sign['two'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "three":
					if($awards[0]['three'] > 0) {
						$time['three'] = $thisRecord[$i]['update_time'];
						$sign['three'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "four":
					if($awards[0]['four'] > 0) {
						$time['four'] = $thisRecord[$i]['update_time'];
						$sign['four'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "five":
					if($awards[0]['five'] > 0) {
						$time['five'] = $thisRecord[$i]['update_time'];
						$sign['five'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "six":
					if($awards[0]['six'] > 0) {
						$time['six'] = $thisRecord[$i]['update_time'];
						$sign['six'] = $thisRecord[$i]['leader_user_name'];		
					}
					break;

				case "seven":
					if($awards[0]['seven'] > 0) {
						$time['seven'] = $thisRecord[$i]['update_time'];
						$sign['seven'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "eight":
					if($awards[0]['eight'] > 0) {
						$time['eight'] = $thisRecord[$i]['update_time'];
						$sign['eight'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "nine":
					if($awards[0]['nine'] > 0){
						$time['nine'] = $thisRecord[$i]['update_time'];
						$sign['nine'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "ten":
					if($awards[0]['ten'] > 0)
					$time['ten'] = $thisRecord[$i]['update_time'];
					$sign['ten'] = $thisRecord[$i]['leader_user_name'];
				break;
			}
		}
	  	$item = ['one','two','three','four','five','six','seven','eight','nine','ten'];
		$form = $this->form_builder->create_form();
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$update_record = array(
				'user_id'			=> $user_id,
				'award_id'			=> 1,
				'field'				=> $item[$this->input->post('field')],
				'leader_user_name'	=> $this->mUser->username,
				'update_time'		=> date("d/m/Y"),
			);
			$award_record = array(
				'user_id'		=> $user_id,
			);
			
			switch ($this->input->post('bool')) {
				case '0'://sign
					$award_record = array(
						$item[$this->input->post('field')]		=> 1,
					);
					$update_record['leatest'] = 1;
					$update_record['sign'] = 1;		
					break;
				case '1'://unsign
					$award_record = array(
						$item[$this->input->post('field')]		=> 0,
					);
					$update_record['leatest'] = 1;
					$update_record['sign'] = 0;
					$update_new = array(
						'user_id'		=> $user_id,
						'leatest'		=> 0
					);
					$array = array(
						'user_id'		=> $user_id,
						'award_id'		=> 1,
						'field'			=> $item[$this->input->post('field')],
						'leatest'		=> 1
					);
					$this->db->where($array);
					$this->db->update('scout_award_update_records', $update_new);
					break;
			}
			$this->db->where('user_id', $user_id);
			$this->db->update('scout_membership_awards', $award_record);
			
			$this->db->insert('scout_award_update_records', $update_record);
			refresh();
		}
		$award_detail = array(
	  		'name'	=>	'會員章 Member ship Badge',
	  		'1'		=>	'1:與你的⼩隊長商議有關加入童軍團之安排。',
	  		'2'		=>	'2:加⼈⼀⼩隊及從⼩隊活動中認識隊中其他成員。',
	  		'3'		=>	'3:最少參加六次團集會／活動，其中⼀次應在⼾舉⾏。',
	  		'4'		=>	'4:對世界及香港童軍運動之發展有普及的認識。',
	  		'5'		=>	'5:明瞭及接立納童軍誓詞、規律和銘⾔。',
	  		'6'		=>	'6:認識你在宣誓時應有之禮儀。',
	  		'7'		=>	'7:能認辨認識中華⼈⺠共和國國旗和國徽；並能說明其含意。',
	  		'8'		=>	'8:能認辨認識香港特別⾏政區區旗和區徽；並能說明其含意。',
	  		'9'		=>	'9:在國歌奏唱和升掛國旗、區旗時表現應有之禮儀。',
	  		'10'	=>	'10:明瞭設立國歌的⽤意，並能背唱之。',
  		);
		$this->mPageTitle = 'Membership Badge';
		$this->mViewData = array(
				'form'					=>	$form,
				'time'					=>	$time,
				'sign'					=>	$sign,
				'award_detail'			=>	$award_detail,
				'awardData'				=>	$awardData,
				'vistor'				=> 	$this->mUser->username
		); 
		$this->render('panel/scout_membership_award');
	}

	public function scout_pathfinder_award($crud_id)
	{
		$sign = array(
			'A1a'		=>	'',
			'A1b'		=>	'',
			'A1c'		=>	'',
			'A1d'		=>	'',
			'A2a'		=>	'',
			'A2b'		=>	'',
			'A2c'		=>	'',
			'A3a'		=>	'',
			'A3b'		=>	'',
			'A4a'		=>	'',
			'A4bi'		=>	'',
			'A4bii'		=>	'',
			'A4biii'	=>	'',
			'A5a'		=>	'',
			'A5b'		=>	'',
			'A6a'		=>	'',
			'A6bi'		=>	'',
			'A6bii'		=>	'',
			'A6biii'	=>	'',
			'B1a'		=>	'',
			'B2a'		=>	'',
			'B3a'		=>	'',
			'B4a'		=>	'',
			'B4b'		=>	'',
			'C1a'		=>	'',
			'C1b'		=>	'',
			'C2a'		=>	'',
			'D1a'		=>	'',
			'D2a'		=>	'',
		);
		$time = array(
			'A1a'		=>	'',
			'A1b'		=>	'',
			'A1c'		=>	'',
			'A1d'		=>	'',
			'A2a'		=>	'',
			'A2b'		=>	'',
			'A2c'		=>	'',
			'A3a'		=>	'',
			'A3b'		=>	'',
			'A4a'		=>	'',
			'A4bi'		=>	'',
			'A4bii'		=>	'',
			'A4biii'	=>	'',
			'A5a'		=>	'',
			'A5b'		=>	'',
			'A6a'		=>	'',
			'A6bi'		=>	'',
			'A6bii'		=>	'',
			'A6biii'	=>	'',
			'B1a'		=>	'',
			'B2a'		=>	'',
			'B3a'		=>	'',
			'B4a'		=>	'',
			'B4b'		=>	'',
			'C1a'		=>	'',
			'C1b'		=>	'',
			'C2a'		=>	'',
			'D1a'		=>	'',
			'D2a'		=>	'',
		);
		$sPP = $this->db->get_where('scout_personal_particulars', array('id' => $crud_id))->result_array();
		$user_id = $sPP[0]['user_id'];
		$scoutType = $this->db->get_where('admin_users_groups', array('user_id' => $user_id))->result_array();
		$updatePath = array(
			'user_id'		=> $user_id,
		);
		if ($scoutType[0]['group_id'] == 3) {
			$updatePath['award_path'] = 1;
		} elseif ($scoutType[0]['group_id'] == 4) {
			$updatePath['award_path'] = 2;
		} elseif ($scoutType[0]['group_id'] == 5) {
			$updatePath['award_path'] = 3;
		}
		$this->db->where('user_id', $user_id);
		$this->db->update('scout_personal_particulars', $updatePath);
		$award = $this->db->get_where('scout_pathfinder_awards', array('user_id' => $user_id));
		$thisRecord = $this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 2, 'sign' => 1, 'leatest' => 1))->result_array();	   	
		if($award->num_rows() == 0) {
	   		$new_spp = array(
				'user_id'			=> $user_id,
			);
			$this->db->insert('scout_pathfinder_awards', $new_spp);
			refresh();
	   	} else {
			$awards = $award->result_array();
			$awardData = $awards[0];
   			$record = $this->db->get_where('scout_pathfinder_awards', array('user_id' => $user_id))->result_array();
   			$checkPathS = $record[0]['A4a']+$record[0]['A4bi']+$record[0]['A4bii']+$record[0]['A4biii'];
   			$checkPathSs = $record[0]['A5a']+$record[0]['A5b'];
   			$checkPathAs = $record[0]['A6a']+$record[0]['A6bi']+$record[0]['A6bii']+$record[0]['A6biii'];

   			if ($checkPathS > 1) {
   				$updatePath['award_path'] = 1;
   			} elseif ($checkPathSs > 1) {
   				$updatePath['award_path'] = 2;
   			} elseif ($checkPathAs > 1) {
   				$updatePath['award_path'] = 3;
   			}
   			$this->db->where('user_id', $user_id);
			$this->db->update('scout_personal_particulars', $updatePath);
   			$scout = $this->db->get_where('scout_personal_particulars', array('user_id' => $user_id))->result_array();
   			if($scout[0]['award_path'] == 1) {
   				$point = $record[0]['A1a']+$record[0]['A1b']+$record[0]['A1c']+$record[0]['A1d']+$record[0]['A2a']+$record[0]['A2b']+$record[0]['A2c']+$record[0]['A3a']+$record[0]['A3b']+$record[0]['A4a']+$record[0]['A4bi']+$record[0]['A4bii']+$record[0]['A4biii']+$record[0]['B1a']+$record[0]['B2a']+$record[0]['B3a']+$record[0]['B4a']+$record[0]['B4b']+$record[0]['C1a']+$record[0]['C1b']+$record[0]['C2a']+$record[0]['D1a']+$record[0]['D2a'];//23in total
   			} elseif ($scout[0]['award_path'] == 2) {
   				$point = $record[0]['A1a']+$record[0]['A1b']+$record[0]['A1c']+$record[0]['A1d']+$record[0]['A2a']+$record[0]['A2b']+$record[0]['A2c']+$record[0]['A3a']+$record[0]['A3b']+$record[0]['A5a']+$record[0]['A5b']+$record[0]['B1a']+$record[0]['B2a']+$record[0]['B3a']+$record[0]['B4a']+$record[0]['B4b']+$record[0]['C1a']+$record[0]['C1b']+$record[0]['C2a']+$record[0]['D1a']+$record[0]['D2a'];//21 in total
   			} else {
   				$point = $record[0]['A1a']+$record[0]['A1b']+$record[0]['A1c']+$record[0]['A1d']+$record[0]['A2a']+$record[0]['A2b']+$record[0]['A2c']+$record[0]['A3a']+$record[0]['A3b']+$record[0]['A6a']+$record[0]['A6bi']+$record[0]['A6bii']+$record[0]['A6biii']+$record[0]['B1a']+$record[0]['B2a']+$record[0]['B3a']+$record[0]['B4a']+$record[0]['B4b']+$record[0]['C1a']+$record[0]['C1b']+$record[0]['C2a']+$record[0]['D1a']+$record[0]['D2a'];//23in total
   			}
   			if ($point > 20) {
				$awardData = array (
					'issue_date'	 => date("d/m/Y"),
				);
				$this->db->update('scout_pathfinder_awards', $awardData);
			} else {
				$awardData = array (
					'issue_date'	 => '',
				);
				$this->db->update('scout_pathfinder_awards', $awardData);
			}
	  	}
	  	$award = $this->db->get_where('scout_pathfinder_awards', array('user_id' => $user_id));
		$awards = $award->result_array();
		$awardData = $awards[0];
		for($i = 0; $i < sizeof($thisRecord); $i++) {
			switch ($thisRecord[$i]["field"]) {
				case "A1a":
					if($awards[0]['A1a'] > 0) {
						$time['A1a'] = $thisRecord[$i]['update_time'];
						$sign['A1a'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A1b":
					if($awards[0]['A1b'] > 0) {
						$time['A1b'] = $thisRecord[$i]['update_time'];
						$sign['A1b'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A1c":
					if($awards[0]['A1c'] > 0) {
						$time['A1c'] = $thisRecord[$i]['update_time'];
						$sign['A1c'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A1d":
					if($awards[0]['A1d'] > 0) {
						$time['A1d'] = $thisRecord[$i]['update_time'];
						$sign['A1d'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A2a":
					if($awards[0]['A2a'] > 0) {
						$time['A2a'] = $thisRecord[$i]['update_time'];
						$sign['A2a'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A2b":
					if($awards[0]['A2b'] > 0) {
						$time['A2b'] = $thisRecord[$i]['update_time'];
						$sign['A2b'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A2c":
					if($awards[0]['A2c'] > 0) {
						$time['A2c'] = $thisRecord[$i]['update_time'];
						$sign['A2c'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A3a":
					if($awards[0]['A3a'] > 0) {
						$time['A3a'] = $thisRecord[$i]['update_time'];
						$sign['A3a'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A3b":
					if($awards[0]['A3b'] > 0) {
						$time['A3b'] = $thisRecord[$i]['update_time'];
						$sign['A3b'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A4a":
					if($awards[0]['A4a'] > 0) {
						$time['A4a'] = $thisRecord[$i]['update_time'];
						$sign['A4a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "A4bi":
					if($awards[0]['A4bi'] > 0) {
						$time['A4bi'] = $thisRecord[$i]['update_time'];
						$sign['A4bi'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "A4bii":
					if($awards[0]['A4bii'] > 0) {
						$time['A4bii'] = $thisRecord[$i]['update_time'];
						$sign['A4bii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "A4biii":
					if($awards[0]['A4biii'] > 0) {
						$time['A4biii'] = $thisRecord[$i]['update_time'];
						$sign['A4biii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "A5a":
					if($awards[0]['A5a'] > 0){
					$time['A5a'] = $thisRecord[$i]['update_time'];
					$sign['A5a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "A5b":
					if($awards[0]['A5b'] > 0){
					$time['A5b'] = $thisRecord[$i]['update_time'];
					$sign['A5b'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "A6a":
					if($awards[0]['A6a'] > 0){
					$time['A6a'] = $thisRecord[$i]['update_time'];
					$sign['A6a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "A6bi":
					if($awards[0]['A6bi'] > 0){
					$time['A6bi'] = $thisRecord[$i]['update_time'];
					$sign['A6bi'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "A6bii":
					if($awards[0]['A6bii'] > 0){
					$time['A6bii'] = $thisRecord[$i]['update_time'];
					$sign['A6bii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "A6biii":
					if($awards[0]['A6biii'] > 0){
					$time['A6biii'] = $thisRecord[$i]['update_time'];
					$sign['A6biii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B1a":
					if($awards[0]['B1a'] > 0){
					$time['B1a'] = $thisRecord[$i]['update_time'];
					$sign['B1a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B2a":
					if($awards[0]['B2a'] > 0){
					$time['B2a'] = $thisRecord[$i]['update_time'];
					$sign['B2a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B3a":
					if($awards[0]['B3a'] > 0){
					$time['B3a'] = $thisRecord[$i]['update_time'];
					$sign['B3a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B4a":
					if($awards[0]['B4a'] > 0){
					$time['B4a'] = $thisRecord[$i]['update_time'];
					$sign['B4a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B4b":
					if($awards[0]['B4b'] > 0){
					$time['B4b'] = $thisRecord[$i]['update_time'];
					$sign['B4b'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "C1a":
					if($awards[0]['C1a'] > 0){
					$time['C1a'] = $thisRecord[$i]['update_time'];
					$sign['C1a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "C1b":
					if($awards[0]['C1b'] > 0){
					$time['C1b'] = $thisRecord[$i]['update_time'];
					$sign['C1b'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "C2a":
					if($awards[0]['C2a'] > 0){
					$time['C2a'] = $thisRecord[$i]['update_time'];
					$sign['C2a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "D1a":
					if($awards[0]['D1a'] > 0){
					$time['D1a'] = $thisRecord[$i]['update_time'];
					$sign['D1a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "D2a":
					if($awards[0]['D2a'] > 0){
					$time['D2a'] = $thisRecord[$i]['update_time'];
					$sign['D2a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;
			}
		}
		$form = $this->form_builder->create_form();
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$itemS = ['A1a','A1b','A1c','A1d','A2a','A2b','A2c','A3a','A3b','A4a','A4bi','A4bii','A4biii','A5a','A5b','A6a','A6bi','A6bii','A6biii','B1a','B2a','B3a','B4a','B4b','C1a','C1b','C2a','D1a','D2a'];
			$itemSs = ['A1a','A1b','A1c','A1d','A2a','A2b','A2c','A3a','A3b','A5a','A5b','B1a','B2a','B3a','B4a','B4b','C1a','C1b','C2a','D1a','D2a'];
			$itemAs = ['A1a','A1b','A1c','A1d','A2a','A2b','A2c','A3a','A3b','A6a','A6bi','A6bii','A6biii','B1a','B2a','B3a','B4a','B4b','C1a','C1b','C2a','D1a','D2a'];
			// passed validation
			$update_record = array(
				'user_id'			=> $user_id,
				'award_id'			=> 2,
				'leatest'			=> '',
				'sign'				=> '',
				'leader_user_name'	=> $this->mUser->username,
				'update_time'		=> date("d/m/Y"),
			);
			$sl = '';
			$award_record = array(
				'user_id'								=>$user_id,
			);
			$partA = 0;
			switch ($scout[0]['award_path']) {
				case '2':
					$award_record	= array(
						$itemSs[$this->input->post('field')] 	=> 1,
					);
					$update_record['field']	= $itemSs[$this->input->post('field')];
					$sl = $itemSs[$this->input->post('field')];
					$partA = $record[0]['A1a']+$record[0]['A1b']+$record[0]['A1c']+$record[0]['A1d']+$record[0]['A2a']+$record[0]['A2b']+$record[0]['A2c']+$record[0]['A3a']+$record[0]['A3b']+$record[0]['A5a']+$record[0]['A5b'];
					if ($partA > 9){
						$outdoorAct = array(
							'user_id'				=> $user_id,
							'A5a' 					=> 1,
						);
						$this->db->where('user_id', $user_id);
						$this->db->update('scout_standard_awards', $outdoorAct);
					}
					break;
				
				case '3':
					$award_record	= array(
						$itemAs[$this->input->post('field')] 	=> 1,
					);
					$update_record['field']	= $itemAs[$this->input->post('field')];
					$sl = $itemAs[$this->input->post('field')];
					$partA = $record[0]['A1a']+$record[0]['A1b']+$record[0]['A1c']+$record[0]['A1d']+$record[0]['A2a']+$record[0]['A2b']+$record[0]['A2c']+$record[0]['A3a']+$record[0]['A3b']+$record[0]['A6a']+$record[0]['A6bi']+$record[0]['A6bii']+$record[0]['A6biii'];
					if ($partA > 9){
						$outdoorAct = array(
							'user_id'				=> $user_id,
							'A6a' 					=> 1,
						);
						$this->db->where('user_id', $user_id);
						$this->db->update('scout_standard_awards', $outdoorAct);
					}
					break;

				case '1':
					$award_record	= array(
						$itemS[$this->input->post('field')]		=> 1,
					);
					$update_record['field']	= $itemS[$this->input->post('field')];
					$sl = $itemS[$this->input->post('field')];
					$partA = $record[0]['A1a']+$record[0]['A1b']+$record[0]['A1c']+$record[0]['A1d']+$record[0]['A2a']+$record[0]['A2b']+$record[0]['A2c']+$record[0]['A3a']+$record[0]['A3b']+$record[0]['A4a']+$record[0]['A4bi']+$record[0]['A4bii']+$record[0]['A4biii'];
					if ($partA > 9){
						$outdoorAct = array(
							'user_id'				=> $user_id,
							'A4a' 					=> 1,
						);
						$this->db->where('user_id', $user_id);
						$this->db->update('scout_standard_awards', $outdoorAct);
					}
					break;
			}
			switch ($sl) {
				case 'A4bi':

					$award_record[$sl] = 0.1;
					break;

				case 'A4bii':
					$award_record[$sl] = 0.1;
					break;

				case 'A4biii':
					$award_record[$sl] = 0.1;
					break;

				case 'A6bi':
					$award_record[$sl] = 0.1;
					break;

				case 'A6bii':
					$award_record[$sl] = 0.1;
					break;

				case 'A6biii':
					$award_record[$sl] = 0.1;
					break;
			}
			switch ($this->input->post('bool')) {
				case '0':
					$update_record['leatest'] = 1;
					$update_record['sign'] = 1;
					break;
				case '1':
					$award_record = array(
						'user_id'								=>$user_id,
						$itemSs[$this->input->post('field')] 	=> 0,
					);
					$update_record['leatest'] = 1;
					$update_record['sign'] = 0;
					$update_new = array(
						'user_id'		=> $user_id,
						'leatest'		=> 0
					);
					$array = array(
						'user_id'		=> $user_id,
						'award_id'		=> 2,
						'field'			=> $item[$this->input->post('field')],
						'leatest'		=> 1
					);
					$this->db->where($array);
					$this->db->update('scout_award_update_records', $update_new);
					break;
			}
			$this->db->where('user_id', $user_id);
			$this->db->update('scout_pathfinder_awards', $award_record);
			$this->db->insert('scout_award_update_records', $update_record);
			if($partA > 9){

			}
			refresh();
		}
		$award_detail = array(
	  		'name'		=>	'童軍探索獎章 Scout Pathfinder Award',
	  		'A1a'		=>	'A1a:參與一次露營活動',
			'A1b'		=>	'A1b:收拾一個兩日一夜露營用的背囊',
			'A1c'		=>	'A1c:安全使用有潛在危之工具',
			'A1d'		=>	'A1d:保養露營物品',
			'A2a'		=>	'A2a:參與一次郊野旅程',
			'A2b'		=>	'A2b:認識地圖及習用圖例',
			'A2c'		=>	'A2c:收捨一個一日郊野旅程用的背囊',
			'A3a'		=>	'A3a:示範及指出所列繩結之結法及用途,包括平結、八字結、雙套結、半結、反手結、稱人結、接繩結、繫木結、縮成結及曳木結',
			'A3b'		=>	'A3b:認識如何保養繩結',
			'A4a'		=>	'A4a:明瞭戶外活動安全指引及郊野守則',
			'A4bi'		=>	'A4bi:參與一次追蹤符號應用之活動',
			'A4bii'		=>	'A4bii:參與一次公園定向活動',
			'A4biii'	=>	'A4biii:參與一次使用用密碼通訊之活動',
			'A5a'		=>	'A5a:明瞭海上活動安全守則',
			'A5b'		=>	'A5b:通過本會之游泳測試',
			'A6a'		=>	'A6a:能指出旅客在機場及航機內一航空全守則',
			'A6bi'		=>	'A6bi:參與一個與航空有關的戶外活動',
			'A6bii'		=>	'A6bii:說出現代飛機〈包括定翼機、宜昇機和軍用機〉的各主要部份及名稱',
			'A6biii'	=>	'A6biii:懂得基本航機辨認方法及能辨認初級航空章課程內的四種飛行器',
			'B1a'		=>	'B1a:參與一次以運動或體能競技為主題的小隊活動',
			'B2a'		=>	'B2a:認識小隊歡乎',
			'B3a'		=>	'B3a:參與一次小隊會議',
			'B4a'		=>	'B4a:分享在日常生活中運用童軍誓詞、規律及銘言的例子',
			'B4b'		=>	'B4b:參與一次默禱儀式',
			'C1a'		=>	'C1a:示範如何處理流鼻血、燒傷、割傷、及刺傷等意外事件',
			'C1b'		=>	'C1b:參與不少於四小時服務',
			'C2a'		=>	'C2a:介紹社區設施',
			'D1a'		=>	'D1a:參與一個以自然生境或生態為主題的展覽或地方',
			'D2a'		=>	'D2a:認識天氣與氣候之別,並列舉天氣及氣候對戶外活動的影響',
  		);
		$this->mPageTitle = 'Scout Pathfinder Award';
		$this->mViewData = array(
				'form'					=>	$form,
				'time'					=>	$time,
				'sign'					=>	$sign,
				'award_detail'			=>	$award_detail,
				'awardData'				=>	$awardData,
				'awardPath'				=>  $scout[0]['award_path'],
				'vistor'				=> 	$this->mUser->username
		); 
		$this->render('panel/scout_pathfinder_award');
	}

	public function scout_standard_award($crud_id)
	{	
		$sign = array(	  		
			'A1a'		=>	'',
			'A1b'		=>	'',
			'A1c'		=>	'',
			'A1d'		=>	'',
			'A1e'		=>	'',
			'A2a'		=>	'',
			'A2b'		=>	'',
			'A2c'		=>	'',
			'A2d'		=>	'',
			'A3a'		=>	'',
			'A3b'		=>	'',
			'A3c'		=>	'',
			'A4a'		=>	'',
			'A4b'		=>	'',
			'A4ci'		=>	'',
			'A4cii'		=>	'',
			'A5a'		=>	'',
			'A5b'		=>	'',
			'A5c'		=>	'',
			'A6a'		=>	'',
			'A6b'		=>	'',
			'A6ci'		=>	'',
			'A6cii'		=>	'',
			'B1ai'		=>	'',
			'B1aii'		=>	'',
			'B2a'		=>	'',
			'B2bi'		=>	'',
			'B2bii'		=>	'',
			'B2biii'	=>	'',
			'B2biv'		=>	'',
			'B2bv'		=>	'',
			'B2bvi'		=>	'',
			'B3a'		=>	'',
			'B4a'		=>	'',
			'B4bi'		=>	'',
			'B4bii'		=>	'',
			'C1a'		=>	'',
			'C1b'		=>	'',
			'C1c'		=>	'',
			'C1d'		=>	'',
			'C2a'		=>	'',
			'C3a'		=>	'',
			'D1a'		=>	'',
			'D2ai'		=>	'',
			'D2aii'		=>	'',
			'D3ai'		=>	'',
			'D3aii'		=>	'',
			'E1a'		=>	'',
		);
		$time = array(	  	
			'A1a'		=>	'',
			'A1b'		=>	'',
			'A1c'		=>	'',
			'A1d'		=>	'',
			'A1e'		=>	'',
			'A2a'		=>	'',
			'A2b'		=>	'',
			'A2c'		=>	'',
			'A2d'		=>	'',
			'A3a'		=>	'',
			'A3b'		=>	'',
			'A3c'		=>	'',
			'A4a'		=>	'',
			'A4b'		=>	'',
			'A4ci'		=>	'',
			'A4cii'		=>	'',
			'A5a'		=>	'',
			'A5b'		=>	'',
			'A5c'		=>	'',
			'A6a'		=>	'',
			'A6b'		=>	'',
			'A6ci'		=>	'',
			'A6cii'		=>	'',
			'B1ai'		=>	'',
			'B1aii'		=>	'',
			'B2a'		=>	'',
			'B2bi'		=>	'',
			'B2bii'		=>	'',
			'B2biii'	=>	'',
			'B2biv'		=>	'',
			'B2bv'		=>	'',
			'B2bvi'		=>	'',
			'B3a'		=>	'',
			'B4a'		=>	'',
			'B4bi'		=>	'',
			'B4bii'		=>	'',
			'C1a'		=>	'',
			'C1b'		=>	'',
			'C1c'		=>	'',
			'C1d'		=>	'',
			'C2a'		=>	'',
			'C3a'		=>	'',
			'D1a'		=>	'',
			'D2ai'		=>	'',
			'D2aii'		=>	'',
			'D3ai'		=>	'',
			'D3aii'		=>	'',
			'E1a'		=>	'',
		);
		$sPP = $this->db->get_where('scout_personal_particulars', array('id' => $crud_id))->result_array();
		$user_id = $sPP[0]['user_id'];
		$award = $this->db->get_where('scout_standard_awards', array('user_id' => $user_id));
		$record = $this->db->get_where('scout_standard_awards', array('user_id' => $user_id))->result_array();
		$scout = $this->db->get_where('scout_personal_particulars', array('user_id' => $user_id))->result_array();
		$thisRecord = $this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 3, 'sign' => 1, 'leatest' => 1))->result_array();
	   	if($award->num_rows()==0) {
	   		$new_spp = array(
				'user_id'			=> $user_id,
			);
			$this->db->insert('scout_standard_awards', $new_spp);
			refresh();
	   	} else {
	   		$awards = $award->result_array();
			$awardData = $awards[0];
   			if($scout[0]['award_path'] == 0) {
   				$pointACE = $record[0]['A1a']+$record[0]['A1b']+$record[0]['A1c']+$record[0]['A1d']+$record[0]['A1e']+$record[0]['A2a']+$record[0]['A2b']+$record[0]['A2c']+$record[0]['A2d']+$record[0]['A3a']+$record[0]['A3b']+$record[0]['A3c']+$record[0]['A4a']+$record[0]['A4b']+$record[0]['A4ci']+$record[0]['A4cii']+$record[0]['C1a']+$record[0]['C1b']+$record[0]['C1c']+$record[0]['C1d']+$record[0]['C2a']+$record[0]['C3a']+$record[0]['E1a'];//>21in total
   			} elseif ($scout[0]['award_path'] == 2) {
   				$pointACE = $record[0]['A1a']+$record[0]['A1b']+$record[0]['A1c']+$record[0]['A1d']+$record[0]['A1e']+$record[0]['A2a']+$record[0]['A2b']+$record[0]['A2c']+$record[0]['A2d']+$record[0]['A3a']+$record[0]['A3b']+$record[0]['A3c']+$record[0]['A5a']+$record[0]['A5b']+$record[0]['A5c']+$record[0]['C1a']+$record[0]['C1b']+$record[0]['C1c']+$record[0]['C1d']+$record[0]['C2a']+$record[0]['C3a']+$record[0]['E1a'];//>21in total
   			} else {
   				$pointACE = $record[0]['A1a']+$record[0]['A1b']+$record[0]['A1c']+$record[0]['A1d']+$record[0]['A1e']+$record[0]['A2a']+$record[0]['A2b']+$record[0]['A2c']+$record[0]['A2d']+$record[0]['A3a']+$record[0]['A3b']+$record[0]['A3c']+$record[0]['A6a']+$record[0]['A6b']+$record[0]['A6ci']+$record[0]['A6cii']+$record[0]['C1a']+$record[0]['C1b']+$record[0]['C1c']+$record[0]['C1d']+$record[0]['C2a']+$record[0]['C3a']+$record[0]['E1a'];//>21in total
   			}
   			$pointB1 = $record[0]['B1ai']+$record[0]['B1aii'];
   			$pointB2 = $record[0]['B2a']+$record[0]['B2bi']+$record[0]['B2bii']+$record[0]['B2biii']+$record[0]['B2biv']+$record[0]['B2bv']+$record[0]['B2bvi'];
   			$pointB34 = $record[0]['B3a']+$record[0]['B4a']+$record[0]['B4bi']+$record[0]['B4bii'];
   			$pointD12 = $record[0]['D1a']+$record[0]['D2ai']+$record[0]['D2aii'];
   			$pointD3 = $record[0]['D3ai']+$record[0]['D3aii'];
   			$point = 0;
   			if ($pointACE > 21) {
   				$point++;
			}
			if ($pointB1 > 0) {
   				$point++;
			}
			if ($pointB2 > 1) {
   				$point++;
			}
			if ($pointB34 > 2) {
   				$point++;
			}
			if ($pointD12 > 1) {
   				$point++;
			}
			if ($pointD3 > 0) {
   				$point++;
			}

			if ($point == 6) {
				$awardData = array (
					'issue_date'	 => date("d/m/Y"),
				);
				$this->db->update('scout_standard_awards', $awardData);
			} else {
				$awardData = array (
					'issue_date'	 => '',
				);
				$this->db->update('scout_standard_awards', $awardData);
			}
	  	}
	  	$award = $this->db->get_where('scout_standard_awards', array('user_id' => $user_id));
   		$awards = $award->result_array();
		$awardData = $awards[0];
		for($i = 0; $i < sizeof($thisRecord); $i++) {
			switch ($thisRecord[$i]["field"]) {
				case "A1a":
					if($awards[0]['A1a'] > 0) {
						$time['A1a'] = $thisRecord[$i]['update_time'];
						$sign['A1a'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A1b":
					if($awards[0]['A1b'] > 0) {
						$time['A1b'] = $thisRecord[$i]['update_time'];
						$sign['A1b'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A1c":
					if($awards[0]['A1c'] > 0) {
						$time['A1c'] = $thisRecord[$i]['update_time'];
						$sign['A1c'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A1d":
					if($awards[0]['A1d'] > 0) {
						$time['A1d'] = $thisRecord[$i]['update_time'];
						$sign['A1d'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A1e":
					if($awards[0]['A1e'] > 0) {
						$time['A1e'] = $thisRecord[$i]['update_time'];
						$sign['A1e'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A2a":
					if($awards[0]['A2a'] > 0) {
						$time['A2a'] = $thisRecord[$i]['update_time'];
						$sign['A2a'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A2b":
					if($awards[0]['A2b'] > 0) {
						$time['A2b'] = $thisRecord[$i]['update_time'];
						$sign['A2b'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A2c":
					if($awards[0]['A2c'] > 0) {
						$time['A2c'] = $thisRecord[$i]['update_time'];
						$sign['A2c'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A2d":
					if($awards[0]['A2d'] > 0) {
						$time['A2d'] = $thisRecord[$i]['update_time'];
						$sign['A2d'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A3a":
					if($awards[0]['A3a'] > 0) {
						$time['A3a'] = $thisRecord[$i]['update_time'];
						$sign['A3a'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A3b":
					if($awards[0]['A3b'] > 0) {
						$time['A3b'] = $thisRecord[$i]['update_time'];
						$sign['A3b'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A3c":
					if($awards[0]['A3c'] > 0) {
						$time['A3c'] = $thisRecord[$i]['update_time'];
						$sign['A3c'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A4a":
					if($awards[0]['A4a'] > 0) {
						$time['A4a'] = $thisRecord[$i]['update_time'];
						$sign['A4a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "A4b":
					if($awards[0]['A4b'] > 0) {
						$time['A4b'] = $thisRecord[$i]['update_time'];
						$sign['A4b'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "A4ci":
					if($awards[0]['A4ci'] > 0) {
						$time['A4ci'] = $thisRecord[$i]['update_time'];
						$sign['A4ci'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "A4cii":
					if($awards[0]['A4cii'] > 0) {
						$time['A4cii'] = $thisRecord[$i]['update_time'];
						$sign['A4cii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;


				case "A5a":
					if($awards[0]['A5a'] > 0) {
						$time['A5a'] = $thisRecord[$i]['update_time'];
						$sign['A5a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "A5b":
					if($awards[0]['A5b'] > 0) {
						$time['A5b'] = $thisRecord[$i]['update_time'];
						$sign['A5b'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "A5c":
					if($awards[0]['A5c'] > 0) {
						$time['A5c'] = $thisRecord[$i]['update_time'];
						$sign['A5c'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "A6a":
					if($awards[0]['A6a'] > 0) {
						$time['A6a'] = $thisRecord[$i]['update_time'];
						$sign['A6a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "A6b":
					if($awards[0]['A6b'] > 0) {
						$time['A6b'] = $thisRecord[$i]['update_time'];
						$sign['A6b'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "A6ci":
					if($awards[0]['A6ci'] > 0) {
						$time['A6ci'] = $thisRecord[$i]['update_time'];
						$sign['A6ci'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "A6cii":
					if($awards[0]['A6cii'] > 0) {
						$time['A6cii'] = $thisRecord[$i]['update_time'];
						$sign['A6cii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B1ai":
					if($awards[0]['B1ai'] > 0) {
						$time['B1ai'] = $thisRecord[$i]['update_time'];
						$sign['B1ai'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B1aii":
					if($awards[0]['B1aii'] > 0) {
						$time['B1aii'] = $thisRecord[$i]['update_time'];
						$sign['B1aii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B2a":
					if($awards[0]['B2a'] > 0) {
						$time['B2a'] = $thisRecord[$i]['update_time'];
						$sign['B2a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B2bi":
					if($awards[0]['B2bi'] > 0) {
						$time['B2bi'] = $thisRecord[$i]['update_time'];
						$sign['B2bi'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B2bii":
					if($awards[0]['B2bii'] > 0) {
						$time['B2bii'] = $thisRecord[$i]['update_time'];
						$sign['B2bii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B2biii":
					if($awards[0]['B2biii'] > 0) {
						$time['B2biii'] = $thisRecord[$i]['update_time'];
						$sign['B2biii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B2biv":
					if($awards[0]['B2biv'] > 0) {
						$time['B2biv'] = $thisRecord[$i]['update_time'];
						$sign['B2biv'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B2bv":
					if($awards[0]['B2bv'] > 0) {
						$time['B2bv'] = $thisRecord[$i]['update_time'];
						$sign['B2bv'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B2bvi":
					if($awards[0]['B2bvi'] > 0) {
						$time['B2bvi'] = $thisRecord[$i]['update_time'];
						$sign['B2bvi'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B3a":
					if($awards[0]['B3a'] > 0) {
						$time['B3a'] = $thisRecord[$i]['update_time'];
						$sign['B3a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B4a":
					if($awards[0]['B4a'] > 0) {
						$time['B4a'] = $thisRecord[$i]['update_time'];
						$sign['B4a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B4bi":
					if($awards[0]['B4bi'] > 0) {
						$time['B4bi'] = $thisRecord[$i]['update_time'];
						$sign['B4bi'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B4bii":
					if($awards[0]['B4bii'] > 0) {
						$time['B4bii'] = $thisRecord[$i]['update_time'];
						$sign['B4bii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "C1a":
					if($awards[0]['C1a'] > 0) {
						$time['C1a'] = $thisRecord[$i]['update_time'];
						$sign['C1a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "C1b":
					if($awards[0]['C1b'] > 0) {
						$time['C1b'] = $thisRecord[$i]['update_time'];
						$sign['C1b'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "C1c":
					if($awards[0]['C1c'] > 0) {
						$time['C1c'] = $thisRecord[$i]['update_time'];
						$sign['C1c'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "C1d":
					if($awards[0]['C1d'] > 0) {
						$time['C1d'] = $thisRecord[$i]['update_time'];
						$sign['C1d'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "C2a":
					if($awards[0]['C2a'] > 0) {
						$time['C2a'] = $thisRecord[$i]['update_time'];
						$sign['C2a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "C3a":
					if($awards[0]['C3a'] > 0) {
						$time['C3a'] = $thisRecord[$i]['update_time'];
						$sign['C3a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "D1a":
					if($awards[0]['D1a'] > 0) {
						$time['D1a'] = $thisRecord[$i]['update_time'];
						$sign['D1a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "D2ai":
					if($awards[0]['D2ai'] > 0) {
						$time['D2ai'] = $thisRecord[$i]['update_time'];
						$sign['D2ai'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "D2aii":
					if($awards[0]['D2aii'] > 0) {
						$time['D2aii'] = $thisRecord[$i]['update_time'];
						$sign['D2aii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "D3ai":
					if($awards[0]['D3ai'] > 0) {
						$time['D3ai'] = $thisRecord[$i]['update_time'];
						$sign['D3ai'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "D3aii":
					if($awards[0]['D3aii'] > 0) {
						$time['D3aii'] = $thisRecord[$i]['update_time'];
						$sign['D3aii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "E1a":
					if($awards[0]['E1a'] > 0) {
						$time['E1a'] = $thisRecord[$i]['update_time'];
						$sign['E1a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;
			}
		}
		$form = $this->form_builder->create_form();
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$itemS = ['A1a','A1b','A1c','A1d','A1e','A2a','A2b','A2c','A2d','A3a','A3b','A3c','A4a','A4b','A4ci','A4cii','B1ai','B1aii','B2a','B2bi','B2bii','B2biii','B2biv','B2bv','B2bvi','B3a','B4a','B4bi','B4bii','C1a','C1b','C1c','C1d','C2a','C3a','D1a','D2ai','D2aii','D3ai','D3aii','E1a'];
			$itemSs = ['A1a','A1b','A1c','A1d','A1e','A2a','A2b','A2c','A2d','A3a','A3b','A3c','A5a','A5b','A5c','B1ai','B1aii','B2a','B2bi','B2bii','B2biii','B2biv','B2bv','B2bvi','B3a','B4a','B4bi','B4bii','C1a','C1b','C1c','C1d','C2a','C3a','D1a','D2ai','D2aii','D3ai','D3aii','E1a'];
			$itemAs = ['A1a','A1b','A1c','A1d','A1e','A2a','A2b','A2c','A2d','A3a','A3b','A3c','A6a','A6b','A6ci','A6cii','B1ai','B1aii','B2a','B2bi','B2bii','B2biii','B2biv','B2bv','B2bvi','B3a','B4a','B4bi','B4bii','C1a','C1b','C1c','C1d','C2a','C3a','D1a','D2ai','D2aii','D3ai','D3aii','E1a'];
			$itemSuper = ['A1a','A1b','A1c','A1d','A1e','A2a','A2b','A2c','A2d','A3a','A3b','A3c','A4a','A4b','A4ci','A4cii','A5a','A5b','A5c','A6a','A6b','A6ci','A6cii','B1ai','B1aii','B2a','B2bi','B2bii','B2biii','B2biv','B2bv','B2bvi','B3a','B4a','B4bi','B4bii','C1a','C1b','C1c','C1d','C2a','C3a','D1a','D2ai','D2aii','D3ai','D3aii','E1a'];
			// passed validation
			$update_record = array(
				'user_id'			=> $user_id,
				'award_id'			=> 3,
				'leatest'			=> '',
				'sign'				=> '',
				'leader_user_name'	=> $this->mUser->username,
				'update_time'		=> date("d/m/Y"),
			);
			switch ($scout[0]['award_path']) {
				case '2':
					$award_record	= array(
						'user_id'								=>$user_id,
						$itemSs[$this->input->post('field')] 	=> 1,
					);
					$update_record['field']	= $itemSs[$this->input->post('field')];
					$sl = $itemSs[$this->input->post('field')];
					$partA = $record[0]['A1a']+$record[0]['A1b']+$record[0]['A1c']+$record[0]['A1d']+$record[0]['A1e']+$record[0]['A2a']+$record[0]['A2b']+$record[0]['A2c']+$record[0]['A2d']+$record[0]['A3a']+$record[0]['A3b']+$record[0]['A3c']+$record[0]['A5a']+$record[0]['A5b']+$record[0]['A5c'];
					if ($partA > 14){
						$outdoorAct = array(
							'user_id'				=> $user_id,
							'A5a' 					=> 1,
						);
						$this->db->where('user_id', $user_id);
						$this->db->update('scout_advanced_awards', $outdoorAct);
					}
					break;
				
				case '3':
					$award_record	= array(
						'user_id'								=>$user_id,
						$itemAs[$this->input->post('field')] 	=> 1,
					);
					$update_record['field']	= $itemAs[$this->input->post('field')];
					$sl = $itemAs[$this->input->post('field')];
					$partA = $record[0]['A1a']+$record[0]['A1b']+$record[0]['A1c']+$record[0]['A1d']+$record[0]['A1e']+$record[0]['A2a']+$record[0]['A2b']+$record[0]['A2c']+$record[0]['A2d']+$record[0]['A3a']+$record[0]['A3b']+$record[0]['A3c']+$record[0]['A6a']+$record[0]['A6b']+$record[0]['A6ci']+$record[0]['A6cii'];
					if ($partA > 14){
						$outdoorAct = array(
							'user_id'				=> $user_id,
							'A6a' 					=> 1,
						);
						$this->db->where('user_id', $user_id);
						$this->db->update('scout_advanced_awards', $outdoorAct);
					}
					break;

				case '1':

					$award_record	= array(
						'user_id'								=>$user_id,
						$itemS[$this->input->post('field')]		=> 1,
					);
					$update_record['field']	= $itemS[$this->input->post('field')];
					$sl = $itemSuper[$this->input->post('field')];
					$partA = $record[0]['A1a']+$record[0]['A1b']+$record[0]['A1c']+$record[0]['A1d']+$record[0]['A1e']+$record[0]['A2a']+$record[0]['A2b']+$record[0]['A2c']+$record[0]['A2d']+$record[0]['A3a']+$record[0]['A3b']+$record[0]['A3c']+$record[0]['A4a']+$record[0]['A4b']+$record[0]['A4ci']+$record[0]['A4cii'];
					if ($partA > 9){
						$outdoorAct = array(
							'user_id'				=> $user_id,
							'A4a' 					=> 1,
						);
						$this->db->where('user_id', $user_id);
						$this->db->update('scout_advanced_awards', $outdoorAct);
					}
					break;
			}
			switch ($sl) {
				case 'B2bi':
					$award_record[$sl] = 0.1;
				break;

				case 'B2bii':
					$award_record[$sl] = 0.1;
				break;

				case 'B2biii':
					$award_record[$sl] = 0.1;
				break;

				case 'B2bvi':
					$award_record[$sl] = 0.1;
				break;

				case 'B2bv':
					$award_record[$sl] = 0.1;
				break;

				case 'B2bvi':
					$award_record[$sl] = 0.1;
				break;

				case 'A4ci':
					$award_record[$sl] = 0.1;
					break;

				case 'A4cii':
					$award_record[$sl] = 0.1;
					break;

				case 'B4bi':
					$award_record[$sl] = 0.1;
					break;

				case 'B4bii':
					$award_record[$sl] = 0.1;
					break;

				case 'D2ai':
					$award_record[$sl] = 0.1;
					break;

				case 'D2aii':
					$award_record[$sl] = 0.1;
					break;
			}
			switch ($this->input->post('bool')) {
				case '0':
					$update_record['leatest'] = 1;
					$update_record['sign'] = 1;
					break;
				case '1':
					$award_record = array(
						'user_id'								=>$user_id,
						$itemSs[$this->input->post('field')] 	=> 0,
					);
					$update_record['leatest'] = 1;
					$update_record['sign'] = 0;
					$update_new = array(
						'user_id'		=> $user_id,
						'leatest'		=> 0
					);
					$array = array(
						'user_id'		=> $user_id,
						'award_id'		=> 3,
						'field'			=> $item[$this->input->post('field')],
						'leatest'		=> 1
					);
					$this->db->where($array);
					$this->db->update('scout_award_update_records', $update_new);
					break;
			}
			$this->db->where('user_id', $user_id);
			$this->db->update('scout_standard_awards', $award_record);
			$this->db->insert('scout_award_update_records', $update_record);
			refresh();
		}
		$award_detail = array(
	  		'name'		=>	'童軍標準獎章 Scout Standard Award',
	  		'A1a'		=>	'A1a:參與及記錄一次露營活動',
			'A1b'		=>	'A1b:架搭、收捨及存放營幕',
			'A1c'		=>	'A1c:完成不少於四項營地建設',
			'A1d'		=>	'A1d:示範利用天然物品及火柴在戶外生火',
			'A1e'		=>	'A1e:認識及體驗在戶外烹調',
			'A2a'		=>	'A2a:參與及記錄一次郊野旅程',
			'A2b'		=>	'A2b:認識地圖比例及距離',
			'A2c'		=>	'A2c:示範正置地圖',
			'A2d'		=>	'A2d:利用指南針及地圖尋找自己的位置',
			'A3a'		=>	'A3a:示範及指出所列繩結之結法及用途,包括四方編結、十字編結、八字編結、圓周編結及展立編結',
			'A3b'		=>	'A3b:遵守先鋒工程的安全守則',
			'A3c'		=>	'A3c:運用結、索及編結進行一項先鋒工程活動',
			'A4a'		=>	'A4a:完成童軍探索獎章戶外活動部分',
			'A4b'		=>	'A4b:考獲一個從未在過往獎章獲得,並與戶外活動有關之專科徽章',
			'A4ci'		=>	'A4ci:參與一次城巿追蹤活動',
			'A4cii'		=>	'A4cii:參與一次使用密碼、旗號或類類似形式之通訊活動',
			'A5a'		=>	'A5a:完成童軍探索獎章海上活動部分',
			'A5b'		=>	'A5b:考獲艇工章',
			'A5c'		=>	'A5c:於本會海上活動中心,參與一次童軍標準艇以外之海上活動',
			'A6a'		=>	'A6a:完成童軍探索獎章航空活動部分',
			'A6b'		=>	'A6b:考獲初級航空活動章',
			'A6ci'		=>	'A6ci:明瞭風如何影響飛行活動',
			'A6cii'		=>	'A6cii:認識與飛行空全相關的航空法例',
			'B1ai'		=>	'B1ai:考獲一個從未在過往獎章獲得,並與體適能有關之專科徽章',
			'B1aii'		=>	'B1aii:設計及烹調一份正餐食譜',
			'B2a'		=>	'B2a:參與一次營火會或營燈會活動',
			'B2bi'		=>	'B2bi:考獲一個從未在過往獎章獲得,並與藝術或創意有關之專科徽章',
			'B2bii'		=>	'B2bii:參觀一個藝術表演節目',
			'B2biii'	=>	'B2biii:欣賞一個藝術品展覽',
			'B2biv'		=>	'B2biv:表演一首小隊歌',
			'B2bv'		=>	'B2bv:參觀一個科技展覽',
			'B2bvi'		=>	'B2bvi:製作一個電子小工具',
			'B3a'		=>	'B3a:參與一次小隊活動',
			'B4a'		=>	'B4a:參與一次童軍崇拜會',
			'B4bi'		=>	'B4bi:介紹一個宗教',
			'B4bii'		=>	'B4bii:分享一個信念',
			'C1a'		=>	'C1a:示範在意外發生時,如何迅速進行基本檢查及召喚緊急服務',
			'C1b'		=>	'C1b:收捨一個適合一日戶外活動用的個人急救用品',
			'C1c'		=>	'C1c:認識社區參與活動',
			'C1d'		=>	'C1d:參與不少於八小時服務',
			'C2a'		=>	'C2a:參與或觀賞一個本地的文化習俗或傳統節慶活動',
			'C3a'		=>	'C3a:介紹一種外地的活動或文化',
			'D1a'		=>	'D1a:介紹生物鏈,生物網及物種生態循環',
			'D2ai'		=>	'D2ai:介紹風速和風向的量度方法',
			'D2aii'		=>	'D2aii:介紹雲的形成過程及十種基本雲層的種類',
			'D3ai'		=>	'D3ai:介紹自然災難對環境的影響',
			'D3aii'		=>	'D3aii:認識「不留痕」(Leave No Trace)',
			'E1a'		=>	'E1a:以童軍身份參與一次與其他旅團或團體的交流活動',
  		);
		$this->mPageTitle = 'Scout Standard Award';
		$this->mViewData = array(
				'form'					=>	$form,
				'time'					=>	$time,
				'sign'					=>	$sign,
				'award_detail'			=>	$award_detail,
				'awardData'				=>	$awardData,
				'awardPath'				=>  $scout[0]['award_path'],
				'vistor'				=> 	$this->mUser->username
		); 
		$this->render('panel/scout_standard_award');
	}

	public function scout_advanced_award($crud_id)
	{
		$sign = array(	  		
			'A1a'		=>	'',
			'A1b'		=>	'',
			'A1c'		=>	'',
			'A2ai'		=>	'',
			'A2aii'		=>	'',
			'A2b'		=>	'',
			'A2c'		=>	'',
			'A3a'		=>	'',
			'A3b'		=>	'',
			'A3c'		=>	'',
			'A4a'		=>	'',
			'A4bi'		=>	'',
			'A4bii'		=>	'',
			'A5a'		=>	'',
			'A5b'		=>	'',
			'A5c'		=>	'',
			'A6a'		=>	'',
			'A6b'		=>	'',
			'A6c'		=>	'',
			'B1ai'		=>	'',
			'B1aii'		=>	'',
			'B1aiii'	=>	'',
			'B1aiv'		=>	'',
			'B2a'		=>	'',
			'B2bi'		=>	'',
			'B2bii'		=>	'',
			'B2biii'	=>	'',
			'B2biv'		=>	'',
			'B2bv'		=>	'',
			'B2bvi'		=>	'',
			'B3a'		=>	'',
			'B4a'		=>	'',
			'B4bi'		=>	'',
			'B4bii'		=>	'',
			'C1a'		=>	'',
			'C1b'		=>	'',
			'C1c'		=>	'',
			'C1d'		=>	'',
			'C1chop'	=>	'',
			'C2ai'		=>	'',
			'C2aii'		=>	'',
			'C2aiii'	=>	'',
			'C3ai'		=>	'',
			'C3aii'		=>	'',
			'D1a'		=>	'',
			'D2ai'		=>	'',
			'D2aii'		=>	'',
			'D2bi'		=>	'',
			'D2bii'		=>	'',
			'D3ai'		=>	'',
			'D3aii'		=>	'',
			'E1'		=>	'',
		);
		$time = array(	  	
			'A1a'		=>	'',
			'A1b'		=>	'',
			'A1c'		=>	'',
			'A2ai'		=>	'',
			'A2aii'		=>	'',
			'A2b'		=>	'',
			'A2c'		=>	'',
			'A3a'		=>	'',
			'A3b'		=>	'',
			'A3c'		=>	'',
			'A4a'		=>	'',
			'A4bi'		=>	'',
			'A4bii'		=>	'',
			'A5a'		=>	'',
			'A5b'		=>	'',
			'A5c'		=>	'',
			'A6a'		=>	'',
			'A6b'		=>	'',
			'A6c'		=>	'',
			'B1ai'		=>	'',
			'B1aii'		=>	'',
			'B1aiii'	=>	'',
			'B1aiv'		=>	'',
			'B2a'		=>	'',
			'B2bi'		=>	'',
			'B2bii'		=>	'',
			'B2biii'	=>	'',
			'B2biv'		=>	'',
			'B2bv'		=>	'',
			'B2bvi'		=>	'',
			'B3a'		=>	'',
			'B4a'		=>	'',
			'B4bi'		=>	'',
			'B4bii'		=>	'',
			'C1a'		=>	'',
			'C1b'		=>	'',
			'C1c'		=>	'',
			'C1d'		=>	'',
			'C1chop'	=>	'',
			'C2ai'		=>	'',
			'C2aii'		=>	'',
			'C2aiii'	=>	'',
			'C3ai'		=>	'',
			'C3aii'		=>	'',
			'D1a'		=>	'',
			'D2ai'		=>	'',
			'D2aii'		=>	'',
			'D2bi'		=>	'',
			'D2bii'		=>	'',
			'D3ai'		=>	'',
			'D3aii'		=>	'',
			'E1'		=>	'',
		);
		$sPP = $this->db->get_where('scout_personal_particulars', array('id' => $crud_id))->result_array();
		$user_id = $sPP[0]['user_id'];
		$award = $this->db->get_where('scout_advanced_awards', array('user_id' => $user_id));
		$thisRecord = $this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 4, 'sign' => 1, 'leatest' => 1))->result_array();
		$award_detail = array(
	  		'name'		=>	'童軍高級獎章 Scout Advanced Award',
			'A1a'		=>	'A1a:協助策劃及參與一次露營活動,並在活動中負責其中一個範疇的工作',
			'A1b'		=>	'A1b:完成不少於六項營地建設',
			'A1c'		=>	'A1c:進行一次原野烹飪活動',
			'A2ai'		=>	'A2ai:毅進行一次兩日一夜之郊野旅程',
			'A2aii'		=>	'A2aii:參與策劃、進行及記錄一次由黃昏至黎明之遠足旅程',
			'A2b'		=>	'A2b:認識等高線與地形的關係',
			'A2c'		=>	'A2c:示範在没有使用指南針的情況下辨明方向的技巧',
			'A3a'		=>	'A3a:示範及指出所列繩結之結法及用途,包括雙接繩結、漁翁結、三套結、勾口結、吊皮結及普通繩端結',
			'A3b'		=>	'A3b:選擇、使用及保養適合先鋒工程之工具',
			'A3c'		=>	'A3c:運用不少於兩種編結製作兩項先峰工程',
			'A4a'		=>	'A4a:完成童軍標準獎戶外活動部分',
			'A4bi'		=>	'指定技能組專科徽章(一)',
			'A4bii'		=>	'指定技能組專科徽章(二)',
			'A5a'		=>	'A5a:完成童軍標準章海上活動部分',
			'A5b'		=>	'A5b:考獲水手章',
			'A5c'		=>	'A5c:考獲與海上活動有關之專科徽章',
			'A6a'		=>	'A6a:完成童軍標準獎航空活動部分',
			'A6b'		=>	'A6b:考獲中級航空活動徽章',
			'A6c'		=>	'A6c:認識簡單的航空氣象,如雷暴、積水及濃霧對飛機構成的危險,並能講述在不同情況下可能形成的天氣',
			'B1ai'		=>	'B1ai:考獲一一個從未在過往獎章獲得,並與體適能有關之專科徽章',
			'B1aii'		=>	'B1aii:執行行及記錄一個為期四至六個星期的體能訓練',
			'B1aiii'	=>	'B1aiii:介紹人體生長和發育過程及不良嗜好對健康的影響',
			'B1aiv'		=>	'B1aiv:宣傳一個有關健康生活的主題',
			'B2a'		=>	'B2a:考獲一個從未在過往獎章獲得,並與藝術、創意或科技有關之專科徽章',
			'B2bi'		=>	'B2bi:表演一個節目',
			'B2bii'		=>	'B2bii:製作一件藝術品',
			'B2biii'	=>	'B2biii:創作及表演一首小隊歌',
			'B2biv'		=>	'B2biv:製作一個模型',
			'B2bv'		=>	'B2bv:利用資訊科技宣傳小隊、團或旅活動',
			'B2bvi'		=>	'B2bvi:製作一個電動機械動物或昆蟲或相類似之電動機械模型',
			'B3a'		=>	'B3a:出席小隊長會議及執行一個議案',
			'B4a'		=>	'B4a:擔任及履行一小隊或旅團職務不少於三個月',
			'B4bi'		=>	'B4bi:參加一一個宗教/靈性發活動',
			'B4bii'		=>	'B4bii:分享個人宗教人信仰',
			'C1a'		=>	'C1a:收捨一個適合兩日一夜戶外活動用的小隊急救藥囊',
			'C1b'		=>	'C1b:示範如何處理創傷、出血,中暑及熱衰竭之情況',
			'C1c'		=>	'C1c:認識如何策劃社區參參與活動',
			'C1d'		=>	'C1d:協助策劃及參與共不少於十二小小時服務',
			'C1chop'	=>	'認許單位蓋印',
			'C2ai'		=>	'C2ai:考獲一個與社區認識有關的專科徽章或獎章',
			'C2aii'		=>	'C2aii:介紹區議會及立法會之組織和功能',
			'C2aiii'	=>	'C2aiii:參與一次共融活動',
			'C3ai'		=>	'C3ai:介紹一個國際組織',
			'C3aii'		=>	'C3aii:介紹一個其他國家/地區的童軍組織',
			'D1a'		=>	'D1a:介紹香港生境、物種的分類、其多樣性及分佈,並舉出香港的瀕危物種及其面對的威脅',
			'D2ai'		=>	'D2ai:介紹四季的成因',
			'D2aii'		=>	'D2aii:介紹廿四節氣',
			'D2bi'		=>	'D2bi:介紹本港的氣候',
			'D2bii'		=>	'D2bii:介紹本港常用之天氣術語、警告定義及惡劣天氣應變措施',
			'D3ai'		=>	'D3ai:介紹香港在「可持續發展」的工作',
			'D3aii'		=>	'D3aii:參與一毎不少於一天或兩次的環境保育工作',
			'E1'		=>	'E1:參與一項從未嘗試之活動,並向團內其他成員介紹',
  		);
	   	if($award->num_rows() == 0) {
	   		$new_spp = array(
				'user_id'			=> $user_id,
			);
			$this->db->insert('scout_advanced_awards', $new_spp);
			refresh();
	   	} else {
			$awards = $award->result_array();
			$awardData = $awards[0];
	   		$record = $this->db->get_where('scout_advanced_awards', array('user_id' => $user_id))->result_array();
   			$scout = $this->db->get_where('scout_personal_particulars', array('user_id' => $user_id))->result_array();
   			if($scout[0]['award_path'] == 0) {
   				$pointAE = $record[0]['A1a']+$record[0]['A1b']+$record[0]['A1c']+$record[0]['A2ai']+$record[0]['A2aii']+$record[0]['A2b']+$record[0]['A2c']+$record[0]['A3a']+$record[0]['A3b']+$record[0]['A3c']+$record[0]['A4a']+$record[0]['A4bi']+$record[0]['A4bii']+$record[0]['E1'];//>21in total
   			} elseif ($scout[0]['award_path'] == 2) {
   				$pointAE = $record[0]['A1a']+$record[0]['A1b']+$record[0]['A1c']+$record[0]['A2ai']+$record[0]['A2aii']+$record[0]['A2b']+$record[0]['A2c']+$record[0]['A3a']+$record[0]['A3b']+$record[0]['A3c']+$record[0]['A5a']+$record[0]['A5b']+$record[0]['A5c']+$record[0]['E1'];//>21in total
   			} else {
   				$pointAE = $record[0]['A1a']+$record[0]['A1b']+$record[0]['A1c']+$record[0]['A2ai']+$record[0]['A2aii']+$record[0]['A2b']+$record[0]['A2c']+$record[0]['A3a']+$record[0]['A3b']+$record[0]['A3c']+$record[0]['A6a']+$record[0]['A6b']+$record[0]['A6c']+$record[0]['E1'];//>21in total
   			}
   			$pointB1 = $record[0]['B1ai']+$record[0]['B1aii']+$record[0]['B1aiii']+$record[0]['B1aiv'];
   			$pointB2 = $record[0]['B2a']+$record[0]['B2bi']+$record[0]['B2bii']+$record[0]['B2biii']+$record[0]['B2biv']+$record[0]['B2bv']+$record[0]['B2bvi'];
   			$pointB34 = $record[0]['B3a']+$record[0]['B4a']+$record[0]['B4bi']+$record[0]['B4bii'];
   			$pointC12 = $record[0]['C1a']+$record[0]['C1b']+$record[0]['C1c']+$record[0]['C1d']+$record[0]['C1chop']+$record[0]['C2ai']+$record[0]['C2aii']+$record[0]['C2aiii'];
   			$pointC3 = $record[0]['C3ai']+$record[0]['C3aii'];
   			$pointD12 = $record[0]['D1a']+$record[0]['D2ai']+$record[0]['D2aii']+$record[0]['D2bi']+$record[0]['D2bii'];
   			$pointD3 = $record[0]['D3ai']+$record[0]['D3aii'];
   			$point = 0;
   			if ($pointAE > 12) {
   				$point++;
			}
			if ($pointB1 > 0) {
   				$point++;
			}
			if ($pointB2 > 1) {
   				$point++;
			}
			if ($pointB34 > 2) {
   				$point++;
			}
			if ($pointC12 > 5) {
				$point++;
			}
			if ($pointC3 > 0) {
				$point++;
			}
			if ($pointD12 == 2) {
   				$point++;
			}
			if ($pointD3 > 0) {
   				$point++;
			}
			if ($point == 8) {
				$awardData = array (
					'issue_date'	 => date("d/m/Y"),
				);
				$this->db->update('scout_advanced_awards', $awardData);
			} else {
				$awardData = array (
					'issue_date'	 => '',
				);
				$this->db->update('scout_advanced_awards', $awardData);
			}
	  	}
	  	$award = $this->db->get_where('scout_advanced_awards', array('user_id' => $user_id));
		$awards = $award->result_array();
		$awardData = $awards[0];
		for($i = 0; $i < sizeof($thisRecord); $i++) {
			switch ($thisRecord[$i]["field"]) {
				case "A1a":
					if($awards[0]['A1a'] > 0) {
						$time['A1a'] = $thisRecord[$i]['update_time'];
						$sign['A1a'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A1b":
					if($awards[0]['A1b'] > 0) {
						$time['A1b'] = $thisRecord[$i]['update_time'];
						$sign['A1b'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A1c":
					if($awards[0]['A1c'] > 0) {
						$time['A1c'] = $thisRecord[$i]['update_time'];
						$sign['A1c'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A2ai":
					if($awards[0]['A2ai'] > 0) {
						$time['A2ai'] = $thisRecord[$i]['update_time'];
						$sign['A2ai'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A2aii":
					if($awards[0]['A2aii'] > 0) {
						$time['A2aii'] = $thisRecord[$i]['update_time'];
						$sign['A2aii'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A2b":
					if($awards[0]['A2b'] > 0) {
						$time['A2b'] = $thisRecord[$i]['update_time'];
						$sign['A2b'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A2c":
					if($awards[0]['A2c'] > 0) {
						$time['A2c'] = $thisRecord[$i]['update_time'];
						$sign['A2c'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A3a":
					if($awards[0]['A3a'] > 0) {
						$time['A3a'] = $thisRecord[$i]['update_time'];
						$sign['A3a'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A3b":
					if($awards[0]['A3b'] > 0) {
						$time['A3b'] = $thisRecord[$i]['update_time'];
						$sign['A3b'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A3c":
					if($awards[0]['A3c'] > 0) {
						$time['A3c'] = $thisRecord[$i]['update_time'];
						$sign['A3c'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A4a":
					if($awards[0]['A4a'] > 0) {
						$time['A4a'] = $thisRecord[$i]['update_time'];
						$sign['A4a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "A4bi":
					if($awards[0]['A4bi'] > 0) {
						$time['A4bi'] = $thisRecord[$i]['update_time'];
						$sign['A4bi'] = $thisRecord[$i]['leader_user_name'];
					}
				break;


				case "A2bii":
					if($awards[0]['A2bii'] > 0) {
						$time['A2bii'] = $thisRecord[$i]['update_time'];
						$sign['A2bii'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A5a":
					if($awards[0]['A5a'] > 0) {
						$time['A5a'] = $thisRecord[$i]['update_time'];
						$sign['A5a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "A5b":
					if($awards[0]['A5b'] > 0) {
						$time['A5b'] = $thisRecord[$i]['update_time'];
						$sign['A5b'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "A5c":
					if($awards[0]['A5c'] > 0) {
						$time['A5c'] = $thisRecord[$i]['update_time'];
						$sign['A5c'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "A6a":
					if($awards[0]['A6a'] > 0) {
						$time['A6a'] = $thisRecord[$i]['update_time'];
						$sign['A6a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "A6b":
					if($awards[0]['A6b'] > 0) {
						$time['A6b'] = $thisRecord[$i]['update_time'];
						$sign['A6b'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "A6c":
					if($awards[0]['A6c'] > 0) {
						$time['A6c'] = $thisRecord[$i]['update_time'];
						$sign['A6c'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B1ai":
					if($awards[0]['B1ai'] > 0) {
						$time['B1ai'] = $thisRecord[$i]['update_time'];
						$sign['B1ai'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B1aii":
					if($awards[0]['B1aii'] > 0) {
						$time['B1aii'] = $thisRecord[$i]['update_time'];
						$sign['B1aii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B1aiii":
					if($awards[0]['B1aiii'] > 0) {
						$time['B1aiii'] = $thisRecord[$i]['update_time'];
						$sign['B1aiii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B1aiv":
					if($awards[0]['B1aiv'] > 0) {
						$time['B1aiv'] = $thisRecord[$i]['update_time'];
						$sign['B1aiv'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B2a":
					if($awards[0]['B2a'] > 0) {
						$time['B2a'] = $thisRecord[$i]['update_time'];
						$sign['B2a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B2bi":
					if($awards[0]['B2bi'] > 0) {
						$time['B2bi'] = $thisRecord[$i]['update_time'];
						$sign['B2bi'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B2bii":
					if($awards[0]['B2bii'] > 0) {
						$time['B2bii'] = $thisRecord[$i]['update_time'];
						$sign['B2bii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B2biii":
					if($awards[0]['B2biii'] > 0) {
						$time['B2biii'] = $thisRecord[$i]['update_time'];
						$sign['B2biii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B2biv":
					if($awards[0]['B2biv'] > 0) {
						$time['B2biv'] = $thisRecord[$i]['update_time'];
						$sign['B2biv'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B2bv":
					if($awards[0]['B2bv'] > 0) {
						$time['B2bv'] = $thisRecord[$i]['update_time'];
						$sign['B2bv'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B2bvi":
					if($awards[0]['B2bvi'] > 0) {
						$time['B2bvi'] = $thisRecord[$i]['update_time'];
						$sign['B2bvi'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B3a":
					if($awards[0]['B3a'] > 0) {
						$time['B3a'] = $thisRecord[$i]['update_time'];
						$sign['B3a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B4a":
					if($awards[0]['B4a'] > 0) {
						$time['B4a'] = $thisRecord[$i]['update_time'];
						$sign['B4a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B4bi":
					if($awards[0]['B4bi'] > 0) {
						$time['B4bi'] = $thisRecord[$i]['update_time'];
						$sign['B4bi'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B4bii":
					if($awards[0]['B4bii'] > 0) {
						$time['B4bii'] = $thisRecord[$i]['update_time'];
						$sign['B4bii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "C1a":
					if($awards[0]['C1a'] > 0) {
						$time['C1a'] = $thisRecord[$i]['update_time'];
						$sign['C1a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "C1b":
					if($awards[0]['C1b'] > 0) {
						$time['C1b'] = $thisRecord[$i]['update_time'];
						$sign['C1b'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "C1c":
					if($awards[0]['C1c'] > 0) {
						$time['C1c'] = $thisRecord[$i]['update_time'];
						$sign['C1c'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "C1d":
					if($awards[0]['C1d'] > 0) {
						$time['C1d'] = $thisRecord[$i]['update_time'];
						$sign['C1d'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "C2ai":
					if($awards[0]['C2ai'] > 0) {
						$time['C2ai'] = $thisRecord[$i]['update_time'];
						$sign['C2ai'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "C2aii":
					if($awards[0]['C2aii'] > 0) {
						$time['C2aii'] = $thisRecord[$i]['update_time'];
						$sign['C2aii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "C2aiii":
					if($awards[0]['C2aiii'] > 0) {
						$time['C2aiii'] = $thisRecord[$i]['update_time'];
						$sign['C2aiii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "C3ai":
					if($awards[0]['C3ai'] > 0) {
						$time['C3ai'] = $thisRecord[$i]['update_time'];
						$sign['C3ai'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "C3aii":
					if($awards[0]['C3aii'] > 0) {
						$time['C3aii'] = $thisRecord[$i]['update_time'];
						$sign['C3aii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "D1a":
					if($awards[0]['D1a'] > 0) {
						$time['D1a'] = $thisRecord[$i]['update_time'];
						$sign['D1a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "D2ai":
					if($awards[0]['D2ai'] > 0) {
						$time['D2ai'] = $thisRecord[$i]['update_time'];
						$sign['D2ai'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "D2aii":
					if($awards[0]['D2aii'] > 0) {
						$time['D2aii'] = $thisRecord[$i]['update_time'];
						$sign['D2aii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "D2bi":
					if($awards[0]['D2bi'] > 0) {
						$time['D2bi'] = $thisRecord[$i]['update_time'];
						$sign['D2bi'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "D2bii":
					if($awards[0]['D2bii'] > 0) {
						$time['D2bii'] = $thisRecord[$i]['update_time'];
						$sign['D2bii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "D3ai":
					if($awards[0]['D3ai'] > 0) {
						$time['D3ai'] = $thisRecord[$i]['update_time'];
						$sign['D3ai'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "D3aii":
					if($awards[0]['D3aii'] > 0) {
						$time['D3aii'] = $thisRecord[$i]['update_time'];
						$sign['D3aii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "E1":
					if($awards[0]['E1'] > 0) {
						$time['E1'] = $thisRecord[$i]['update_time'];
						$sign['E1'] = $thisRecord[$i]['leader_user_name'];
					}
				break;
			}
		}
		$form = $this->form_builder->create_form();
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$itemS = ['A1a','A1b','A1c','A2ai','A2aii','A2b','A2c','A3a','A3b','A3c','A4a','A4bi','A4bii','B1ai','B1aii','B1aiii','B1aiv','B2a','B2bi','B2bii','B2biii','B2biv','B2bv','B2bvi','B3a','B4a','B4bi','B4bii','C1a','C1b','C1c','C1d','C1chop','C2ai','C2aii','C2aiii','C3ai','C3aii','D1a','D2ai','D2aii','D2bi','D2bii','D3ai','D3aii','E1'];
			$itemSs = ['A1a','A1b','A1c','A2ai','A2aii','A2b','A2c','A3a','A3b','A3c','A5a','A5b','A5c','B1ai','B1aii','B1aiii','B1aiv','B2a','B2bi','B2bii','B2biii','B2biv','B2bv','B2bvi','B3a','B4a','B4bi','B4bii','C1a','C1b','C1c','C1d','C1chop','C2ai','C2aii','C2aiii','C3ai','C3aii','D1a','D2ai','D2aii','D2bi','D2bii','D3ai','D3aii','E1'];
			$itemAs = ['A1a','A1b','A1c','A2ai','A2aii','A2b','A2c','A3a','A3b','A3c','A6a','A6b','A6c','B1ai','B1aii','B1aiii','B1aiv','B2a','B2bi','B2bii','B2biii','B2biv','B2bv','B2bvi','B3a','B4a','B4bi','B4bii','C1a','C1b','C1c','C1d','C1chop','C2ai','C2aii','C2aiii','C3ai','C3aii','D1a','D2ai','D2aii','D2bi','D2bii','D3ai','D3aii','E1'];
			// $itemSuper = ['A1a','A1b','A1c','A2ai','A2aii','A2b','A2c','A3a','A3b','A3c','A6a','A6b','A6c','B1ai','B1aii','B1aiii','B1aiv','B2a','B2bi','B2bii','B2biii','B2biv','B2bv','B2bvi','B3a','B4a','B4bi','B4bii','C1a','C1b','C1c','C1d','C1chop','C2ai','C2aii','C2aiii','C3ai','C3aii','D1a','D2ai','D2aii','D2bi','D2bii','E1'];
			// passed validation
			$update_record = array(
				'user_id'			=> $user_id,
				'award_id'			=> 4,
				'leatest'			=> '',
				'sign'				=> '',
				'leader_user_name'	=> $this->mUser->username,
				'update_time'		=> date("d/m/Y"),
			);
			switch ($scout[0]['award_path']) {
				case '2':
					$award_record	= array(
						'user_id'								=>$user_id,
						$itemSs[$this->input->post('field')] 	=> 1,
					);
					$update_record['field']	= $itemSs[$this->input->post('field')];
					$sl = $itemSs[$this->input->post('field')];
					$partA = $record[0]['A1a']+$record[0]['A1b']+$record[0]['A1c']+$record[0]['A2ai']+$record[0]['A2aii']+$record[0]['A2b']+$record[0]['A2c']+$record[0]['A3a']+$record[0]['A3b']+$record[0]['A3c']+$record[0]['A5a']+$record[0]['A5b']+$record[0]['A5c'];
					if ($partA > 10){
						$outdoorAct = array(
							'user_id'				=> $user_id,
							'A5a' 					=> 1,
						);
						$this->db->where('user_id', $user_id);
						$this->db->update('scout_chief_awards', $outdoorAct);
					}
					break;
				
				case '3':
					$award_record	= array(
						'user_id'								=>$user_id,
						$itemAs[$this->input->post('field')] 	=> 1,
					);
					$update_record['field']	= $itemAs[$this->input->post('field')];
					$sl = $itemAs[$this->input->post('field')];
					$partA = $record[0]['A1a']+$record[0]['A1b']+$record[0]['A1c']+$record[0]['A2ai']+$record[0]['A2aii']+$record[0]['A2b']+$record[0]['A2c']+$record[0]['A3a']+$record[0]['A3b']+$record[0]['A3c']+$record[0]['A6a']+$record[0]['A6b']+$record[0]['A6c'];
					if ($partA > 10){
						$outdoorAct = array(
							'user_id'				=> $user_id,
							'A6a' 					=> 1,
						);
						$this->db->where('user_id', $user_id);
						$this->db->update('scout_chief_awards', $outdoorAct);
					}
					break;

				case '1':
					$award_record	= array(
						'user_id'								=>$user_id,
						$itemS[$this->input->post('field')]		=> 1,
					);
					$update_record['field']	= $itemS[$this->input->post('field')];
					$sl = $itemS[$this->input->post('field')];
					$partA = $record[0]['A1a']+$record[0]['A1b']+$record[0]['A1c']+$record[0]['A2ai']+$record[0]['A2aii']+$record[0]['A2b']+$record[0]['A2c']+$record[0]['A3a']+$record[0]['A3b']+$record[0]['A3c']+$record[0]['A4a']+$record[0]['A4bi']+$record[0]['A4bii'];
					if ($partA > 10){
						$outdoorAct = array(
							'user_id'				=> $user_id,
							'A4a' 					=> 1,
						);
						$this->db->where('user_id', $user_id);
						$this->db->update('scout_chief_awards', $outdoorAct);
					}
					break;
			}
			switch ($sl) {
				case 'A2ai':
					$award_record[$sl] = 0.1;
				break;

				case 'A2aii':
					$award_record[$sl] = 0.1;
				break;
				
				case 'B1ai':
					$award_record[$sl] = 0.1;
				break;

				case 'B1aii':
					$award_record[$sl] = 0.1;
				break;

				case 'B1aiii':
					$award_record[$sl] = 0.1;
				break;

				case 'B1aiv':
					$award_record[$sl] = 0.1;
				break;

				case 'B2bi':
					$award_record[$sl] = 0.1;
				break;

				case 'B2bii':
					$award_record[$sl] = 0.1;
				break;

				case 'B2biii':
					$award_record[$sl] = 0.1;
				break;

				case 'B2bvi':
					$award_record[$sl] = 0.1;
				break;

				case 'B2bv':
					$award_record[$sl] = 0.1;
				break;

				case 'B2bvi':
					$award_record[$sl] = 0.1;
				break;

				case 'B4bi':
					$award_record[$sl] = 0.1;
				break;

				case 'B4bii':
					$award_record[$sl] = 0.1;
				break;

				case 'C2ai':
					$award_record[$sl] = 0.1;
				break;
				
				case 'C2aii':
					$award_record[$sl] = 0.1;
				break;

				case 'C2aiii':
					$award_record[$sl] = 0.1;
				break;

				case 'C3ai':
					$award_record[$sl] = 0.1;
				break;

				case 'C3aii':
					$award_record[$sl] = 0.1;
				break;

				case 'D2ai':
					$award_record[$sl] = 0.25;
					break;

				case 'D2aii':
					$award_record[$sl] = 0.25;
					break;

				case 'D2bi':
					$award_record[$sl] = 0.75;
				break;

				case 'D2bii':
					$award_record[$sl] = 0.75;
					break;

				case 'D3ai':
					$award_record[$sl] = 0.1;
				break;

				case 'D3aii':
					$award_record[$sl] = 0.1;
					break;
			}
			switch ($this->input->post('bool')) {
				case '0':
					$update_record['leatest'] = 1;
					$update_record['sign'] = 1;
					break;
				case '1':
					$award_record = array(
						'user_id'								=>$user_id,
						$itemSs[$this->input->post('field')] 	=> 0,
					);
					$update_record['leatest'] = 1;
					$update_record['sign'] = 0;
					$update_new = array(
						'user_id'		=> $user_id,
						'leatest'		=> 0
					);
					$array = array(
						'user_id'		=> $user_id,
						'award_id'		=> 4,
						'field'			=> $item[$this->input->post('field')],
						'leatest'		=> 1
					);
					$this->db->where($array);
					$this->db->update('scout_award_update_records', $update_new);
					break;
			}
			$this->db->where('user_id', $user_id);
			$this->db->update('scout_advanced_awards', $award_record);
			$this->db->insert('scout_award_update_records', $update_record);
			refresh();
		}
		$this->mPageTitle = 'Scout Advanced Award';
		$this->mViewData = array(
				'form'					=>	$form,
				'time'					=>	$time,
				'sign'					=>	$sign,
				'award_detail'			=>	$award_detail,
				'awardData'				=>	$awardData,
				'awardPath'				=>  $scout[0]['award_path'],
				'vistor'				=> 	$this->mUser->username
		); 
		$this->render('panel/scout_advanced_award');
	}

	public function scout_chief_award($crud_id)
	{
		$sign = array(	  		
			'A1a'		=>	'',
			'A1b'		=>	'',
			'A1c'		=>	'',
			'A2a'		=>	'',
			'A2b'		=>	'',
			'A2c'		=>	'',
			'A3a'		=>	'',
			'A3b'		=>	'',
			'A4a'		=>	'',
			'A4b'		=>	'',
			'A5a'		=>	'',
			'A5b'		=>	'',
			'A6a'		=>	'',
			'A6b'		=>	'',
			'B1a'		=>	'',
			'B1b'		=>	'',
			'B2a'		=>	'',
			'B2bi'		=>	'',
			'B2bii'		=>	'',
			'B2biii'	=>	'',
			'B2biv'		=>	'',
			'B2bv'		=>	'',
			'B2bvi'		=>	'',
			'B3a'		=>	'',
			'B4a'		=>	'',
			'B4bi'		=>	'',
			'B4bii'		=>	'',
			'B4biii'	=>	'',
			'C1a'		=>	'',
			'C1b'		=>	'',
			'C1c'		=>	'',
			'C1chop'	=>	'',
			'C2a'		=>	'',
			'C2bi'		=>	'',
			'C2bii'		=>	'',
			'C2biii'	=>	'',
			'C3a'		=>	'',
			'C3bi'		=>	'',
			'C3bii'		=>	'',
			'C3biii'	=>	'',
			'D1a'		=>	'',
			'D2a'		=>	'',
			'D2bi'		=>	'',
			'D2bii'		=>	'',
			'D3a'		=>	'',
			'D3b'		=>	'',
			'E1'		=>	'',
			'E2'		=>	'',
		);
		$time = array(	  	
			'A1a'		=>	'',
			'A1b'		=>	'',
			'A1c'		=>	'',
			'A2a'		=>	'',
			'A2b'		=>	'',
			'A2c'		=>	'',
			'A3a'		=>	'',
			'A3b'		=>	'',
			'A4a'		=>	'',
			'A4b'		=>	'',
			'A5a'		=>	'',
			'A5b'		=>	'',
			'A6a'		=>	'',
			'A6b'		=>	'',
			'B1a'		=>	'',
			'B1b'		=>	'',
			'B2a'		=>	'',
			'B2bi'		=>	'',
			'B2bii'		=>	'',
			'B2biii'	=>	'',
			'B2biv'		=>	'',
			'B2bv'		=>	'',
			'B2bvi'		=>	'',
			'B3a'		=>	'',
			'B4a'		=>	'',
			'B4bi'		=>	'',
			'B4bii'		=>	'',
			'B4biii'	=>	'',
			'C1a'		=>	'',
			'C1b'		=>	'',
			'C1c'		=>	'',
			'C1chop'	=>	'',
			'C2a'		=>	'',
			'C2bi'		=>	'',
			'C2bii'		=>	'',
			'C2biii'	=>	'',
			'C3a'		=>	'',
			'C3bi'		=>	'',
			'C3bii'		=>	'',
			'C3biii'	=>	'',
			'D1a'		=>	'',
			'D2a'		=>	'',
			'D2bi'		=>	'',
			'D2bii'		=>	'',
			'D3a'		=>	'',
			'D3b'		=>	'',
			'E1'		=>	'',
			'E2'		=>	'',
		);
		$sPP = $this->db->get_where('scout_personal_particulars', array('id' => $crud_id))->result_array();
		$user_id = $sPP[0]['user_id'];
		$award = $this->db->get_where('scout_chief_awards', array('user_id' => $user_id));
		$thisRecord = $this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1))->result_array();
		$award_detail = array(
			'name'		=>	"總領袖獎章 Chief Scout's Award",
	  		'A1a'		=>	'A1a:計劃及實行一次露營',
			'A1b'		=>	'A1b:教授基本露營技巧',
			'A1c'		=>	'A1c:製一個露營報告',
			'A2a'		=>	'A2a:參與策劃、進行及記錄一次不少於兩日一夜之郊野旅程',
			'A2b'		=>	'A2b:教授基本郊野旅程技巧',
			'A2c'		=>	'A2c:明瞭野外基本求生技能',
			'A3a'		=>	'A3a:計劃及帶領小隊完成一個應用不少於三種編結之先鋒工程',
			'A3b'		=>	'A3b:教授基本先鋒工程技巧',
			'A4a'		=>	'A4a:完成童軍高級獎章戶外活動部分',
			'A4b'		=>	'A4b:策劃释參與一個全日小小隊戶外活動',
			'A5a'		=>	'A5a:完成童軍高級獎章海上活動部分',
			'A5b'		=>	'A5b:策劃及參與一個不少於六小時之海上旅程',
			'A6a'		=>	'A6a:完成童軍高級獎章航空活動部分',
			'A6b'		=>	'A6b:與團長商議後,於自選航空活動項目內選擇其中兩項從未進行過之項目',
			'B1a'		=>	'B1a:考獲一個從未在過往獎章獲得,並與體適能有關之專科徽章',
			'B1b'		=>	'B1b:計劃及執行一次以運動或體能競技為主題的小隊活動',
			'B2a'		=>	'B2a:創作及帶領一個營火會或營燈會歡呼、表演節目或遊戲',
			'B2bi'		=>	'B2bi:分享一件藝術品製作過程',
			'B2bii'		=>	'B2bii:教授製作一個模型',
			'B2biii'	=>	'B2biii:教授以資訊科技製作宣傳品',
			'B2biv'		=>	'B2biv:教授製作一個以電池驅動的機械',
			'B2bv'		=>	'B2bv:利用電子地圖建立路線',
			'B2bvi'		=>	'B2bvi:製人作一個可操控之機械模型',
			'B3a'		=>	'B3a:考獲領導才獎章',
			'B4a'		=>	'B4a:介紹童軍誓詞、規則及銘言',
			'B4bi'		=>	'B4bi:帶領一次默禱儀式',
			'B4bii'		=>	'B4bii:協助一次童軍崇拜會',
			'B4biii'	=>	'B4biii:考獲宗教章',
			'C1a'		=>	'C1a:考獲指定服務組專科徽章',
			'C1b'		=>	'C1b:探討社區參參與活動',
			'C1c'		=>	'C1c:協助策劃及參與共不少於十六小時服務',
			'C1chop'	=>	'認許單位蓋印',
			'C2a'		=>	'C2a:探討一個本土時事話題',
			'C2bi'		=>	'C2bi:考獲旅遊(興趣組)專科徽章',
			'C2bii'		=>	'C2bii:學習與有特殊需要人士日常生活中的溝通方法',
			'C2biii'	=>	'C2biii:調查社區設施及服務',
			'C3a'		=>	'C3a:探討一個國際問題',
			'C3bi'		=>	'C3bi:參加國際電訊日',
			'C3bii'		=>	'C3bii:介紹一位外地童軍朋友',
			'C3biii'	=>	'C3biii:參加一個與外地童軍交流活動',
			'D1a'		=>	'D1a:考獲一個從未在過往獎章獲得,並與生態環境有關之專科徽章',
			'D2a'		=>	'D2a:教授一項氣象知識',
			'D2bi'		=>	'D2bi:考獲氣象(興趣組)專科徽章',
			'D2bii'		=>	'D2bii:介紹天氣圖及紀錄一個童軍營地自動氣象站的一週天氣',
			'D3a'		=>	'D3a:介紹人類活動對環境的影響',
			'D3b'		=>	'D3b:計劃及帶領一個環境保育工作',
			'E1'		=>	'E1:參與一項從未嘗試之活動,並向團內其他成員介紹',
			'E2'		=>	'E2:考獲一個教導組專科徽章',
  		);
	   	if($award->num_rows()==0) {
	   		$new_spp = array(
				'user_id'			=> $user_id,
			);
			$this->db->insert('scout_chief_awards', $new_spp);
			refresh();
	   	} else {
			$awards = $award->result_array();
			$awardData = $awards[0];
	   		$record = $this->db->get_where('scout_chief_awards', array('user_id' => $user_id))->result_array();
   			$scout = $this->db->get_where('scout_personal_particulars', array('user_id' => $user_id))->result_array();
   			// print_r($scout);exit;
   			if($scout[0]['award_path'] == 0) {
   				$pointAE = $record[0]['A1a']+$record[0]['A1b']+$record[0]['A1c']+$record[0]['A2a']+$record[0]['A2b']+$record[0]['A2c']+$record[0]['A3a']+$record[0]['A3b']+$record[0]['A4a']+$record[0]['A4b']+$record[0]['E1']+$record[0]['E2'];
   			} elseif ($scout[0]['award_path'] == 2) {
   				$pointAE = $record[0]['A1a']+$record[0]['A1b']+$record[0]['A1c']+$record[0]['A2a']+$record[0]['A2b']+$record[0]['A2c']+$record[0]['A3a']+$record[0]['A3b']+$record[0]['A5a']+$record[0]['A5b']+$record[0]['E1']+$record[0]['E2'];
   			} else {
   				$pointAE = $record[0]['A1a']+$record[0]['A1b']+$record[0]['A1c']+$record[0]['A2a']+$record[0]['A2b']+$record[0]['A2c']+$record[0]['A3a']+$record[0]['A3b']+$record[0]['A6a']+$record[0]['A6b']+$record[0]['E1']+$record[0]['E2'];
   			}
   			$pointB123 = $record[0]['B1a']+$record[0]['B1b']+$record[0]['B2a']+$record[0]['B2bi']+$record[0]['B2bii']+$record[0]['B2biii']+$record[0]['B2biv']+$record[0]['B2bv']+$record[0]['B2bvi']+$record[0]['B3a'];
   			$pointB4 = $record[0]['B4a']+$record[0]['B4bi']+$record[0]['B4bii']+$record[0]['B4biii'];
   			$pointC12 = $record[0]['C1a']+$record[0]['C1b']+$record[0]['C1c']+$record[0]['C1chop']+$record[0]['C2a']+$record[0]['C2bi']+$record[0]['C2bii']+$record[0]['C2biii'];
   			$pointC3 = $record[0]['C3a']+$record[0]['C3bi']+$record[0]['C3bii']+$record[0]['C3biii'];
   			$pointD = $record[0]['D1a']+$record[0]['D2a']+$record[0]['D2bi']+$record[0]['D2bii']+$record[0]['D3a']+$record[0]['D3b'];
   			$point = 0;
   			if ($pointAE > 2) {
   				$point++;
			}
			if ($pointB123 > 4) {
   				$point++;
			}
			if ($pointB4 > 1) {
   				$point++;
			}
			if ($pointC12 > 5) {
				$point++;
			}
			if ($pointC3 > 1) {
				$point++;
			}
			if ($pointD > 4) {
   				$point++;
			}
			if ($point == 6) {
				$awardData = array (
					'issue_date'	 => date("d/m/Y"),
				);
				$this->db->update('scout_chief_awards', $awardData);
			} else {
				$awardData = array (
					'issue_date'	 => '',
				);
				$this->db->update('scout_chief_awards', $awardData);
			}
	  	}
	  	$award = $this->db->get_where('scout_chief_awards', array('user_id' => $user_id));
	  	$awards = $award->result_array();
		$awardData = $awards[0];
		for($i = 0; $i < sizeof($thisRecord); $i++) {
			switch ($thisRecord[$i]["field"]) {
				case "A1a":
					if($awards[0]['A1a'] > 0) {
						$time['A1a'] = $thisRecord[$i]['update_time'];
						$sign['A1a'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A1b":
					if($awards[0]['A1b'] > 0) {
						$time['A1b'] = $thisRecord[$i]['update_time'];
						$sign['A1b'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A1c":
					if($awards[0]['A1c'] > 0) {
						$time['A1c'] = $thisRecord[$i]['update_time'];
						$sign['A1c'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A2a":
					if($awards[0]['A2a'] > 0) {
						$time['A2a'] = $thisRecord[$i]['update_time'];
						$sign['A2a'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A2b":
					if($awards[0]['A2b'] > 0) {
						$time['A2b'] = $thisRecord[$i]['update_time'];
						$sign['A2b'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A2c":
					if($awards[0]['A2c'] > 0) {
						$time['A2c'] = $thisRecord[$i]['update_time'];
						$sign['A2c'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A3a":
					if($awards[0]['A3a'] > 0) {
						$time['A3a'] = $thisRecord[$i]['update_time'];
						$sign['A3a'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A3b":
					if($awards[0]['A3b'] > 0) {
						$time['A3b'] = $thisRecord[$i]['update_time'];
						$sign['A3b'] = $thisRecord[$i]['leader_user_name'];
					}
					break;

				case "A4a":
					if($awards[0]['A4a'] > 0) {
						$time['A4a'] = $thisRecord[$i]['update_time'];
						$sign['A4a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "A4b":
					if($awards[0]['A4b'] > 0) {
						$time['A4b'] = $thisRecord[$i]['update_time'];
						$sign['A4b'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "A5a":
					if($awards[0]['A5a'] > 0) {
						$time['A5a'] = $thisRecord[$i]['update_time'];
						$sign['A5a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "A5b":
					if($awards[0]['A5b'] > 0) {
						$time['A5b'] = $thisRecord[$i]['update_time'];
						$sign['A5b'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "A6a":
					if($awards[0]['A6a'] > 0) {
						$time['A6a'] = $thisRecord[$i]['update_time'];
						$sign['A6a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "A6b":
					if($awards[0]['A6b'] > 0) {
						$time['A6b'] = $thisRecord[$i]['update_time'];
						$sign['A6b'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B1a":
					if($awards[0]['B1a'] > 0) {
						$time['B1a'] = $thisRecord[$i]['update_time'];
						$sign['B1a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B1b":
					if($awards[0]['B1b'] > 0) {
						$time['B1b'] = $thisRecord[$i]['update_time'];
						$sign['B1b'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B2a":
					if($awards[0]['B2a'] > 0) {
						$time['B2a'] = $thisRecord[$i]['update_time'];
						$sign['B2a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B2bi":
					if($awards[0]['B2bi'] > 0) {
						$time['B2bi'] = $thisRecord[$i]['update_time'];
						$sign['B2bi'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B2bii":
					if($awards[0]['B2bii'] > 0) {
						$time['B2bii'] = $thisRecord[$i]['update_time'];
						$sign['B2bii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B2biii":
					if($awards[0]['B2biii'] > 0) {
						$time['B2biii'] = $thisRecord[$i]['update_time'];
						$sign['B2biii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B2biv":
					if($awards[0]['B2biv'] > 0) {
						$time['B2biv'] = $thisRecord[$i]['update_time'];
						$sign['B2biv'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B2bv":
					if($awards[0]['B2bv'] > 0) {
						$time['B2bv'] = $thisRecord[$i]['update_time'];
						$sign['B2bv'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B2bvi":
					if($awards[0]['B2bvi'] > 0) {
						$time['B2bvi'] = $thisRecord[$i]['update_time'];
						$sign['B2bvi'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B3a":
					if($awards[0]['B3a'] > 0) {
						$time['B3a'] = $thisRecord[$i]['update_time'];
						$sign['B3a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B4a":
					if($awards[0]['B4a'] > 0) {
						$time['B4a'] = $thisRecord[$i]['update_time'];
						$sign['B4a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B4bi":
					if($awards[0]['B4bi'] > 0) {
						$time['B4bi'] = $thisRecord[$i]['update_time'];
						$sign['B4bi'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B4bii":
					if($awards[0]['B4bii'] > 0) {
						$time['B4bii'] = $thisRecord[$i]['update_time'];
						$sign['B4bii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "B4biii":
					if($awards[0]['B4biii'] > 0) {
						$time['B4biii'] = $thisRecord[$i]['update_time'];
						$sign['B4biii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "C1a":
					if($awards[0]['C1a'] > 0) {
						$time['C1a'] = $thisRecord[$i]['update_time'];
						$sign['C1a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "C1b":
					if($awards[0]['C1b'] > 0) {
						$time['C1b'] = $thisRecord[$i]['update_time'];
						$sign['C1b'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "C1c":
					if($awards[0]['C1c'] > 0) {
						$time['C1c'] = $thisRecord[$i]['update_time'];
						$sign['C1c'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "C1chop":
					if($awards[0]['C1chop'] > 0) {
						$time['C1chop'] = $thisRecord[$i]['update_time'];
						$sign['C1chop'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "C2a":
					if($awards[0]['C2a'] > 0) {
						$time['C2a'] = $thisRecord[$i]['update_time'];
						$sign['C2a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "C2bi":
					if($awards[0]['C2bi'] > 0) {
						$time['C2bi'] = $thisRecord[$i]['update_time'];
						$sign['C2bi'] = $thisRecord[$i]['leader_user_name'];
					}
				break;
				
				case "C2bii":
					if($awards[0]['C2bii'] > 0) {
						$time['C2bii'] = $thisRecord[$i]['update_time'];
						$sign['C2bii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "C2biii":
					if($awards[0]['C2biii'] > 0) {
						$time['C2biii'] = $thisRecord[$i]['update_time'];
						$sign['C2biii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "C3a":
					if($awards[0]['C3a'] > 0) {
						$time['C3a'] = $thisRecord[$i]['update_time'];
						$sign['C3a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "C3bi":
					if($awards[0]['C3bi'] > 0) {
						$time['C3bi'] = $thisRecord[$i]['update_time'];
						$sign['C3bi'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "C3bii":
					if($awards[0]['C3bii'] > 0) {
						$time['C3bii'] = $thisRecord[$i]['update_time'];
						$sign['C3bii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "C3biii":
					if($awards[0]['C3biii'] > 0) {
						$time['C3biii'] = $thisRecord[$i]['update_time'];
						$sign['C3biii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "D1a":
					if($awards[0]['D1a'] > 0) {
						$time['D1a'] = $thisRecord[$i]['update_time'];
						$sign['D1a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "D2a":
					if($awards[0]['D2a'] > 0) {
						$time['D2a'] = $thisRecord[$i]['update_time'];
						$sign['D2a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "D2bi":
					if($awards[0]['D2bi'] > 0) {
						$time['D2bi'] = $thisRecord[$i]['update_time'];
						$sign['D2bi'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "D2bii":
					if($awards[0]['D2bii'] > 0) {
						$time['D2bii'] = $thisRecord[$i]['update_time'];
						$sign['D2bii'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "D3a":
					if($awards[0]['D3a'] > 0) {
						$time['D3a'] = $thisRecord[$i]['update_time'];
						$sign['D3a'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "D3b":
					if($awards[0]['D3b'] > 0) {
						$time['D3b'] = $thisRecord[$i]['update_time'];
						$sign['D3b'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "E1":
					if($awards[0]['E1'] > 0) {
						$time['E1'] = $thisRecord[$i]['update_time'];
						$sign['E1'] = $thisRecord[$i]['leader_user_name'];
					}
				break;

				case "E2":
					if($awards[0]['E2'] > 0) {
						$time['E2'] = $thisRecord[$i]['update_time'];
						$sign['E2'] = $thisRecord[$i]['leader_user_name'];
					}
				break;
			}
		}
		$form = $this->form_builder->create_form();
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$itemS = ['A1a','A1b','A1c','A2a','A2b','A2c','A3a','A3b','A4a','A4b','B1a','B1b','B2a','B2bi','B2bii','B2biii','B2biv','B2bv','B2bvi','B3a','B4a','B4bi','B4bii','B4biii','C1a','C1b','C1c','C1chop','C2a','C2bi','C2bii','C2biii','C3a','C3bi','C3bii','C3biii','D1a','D2a','D2bi','D2bii','D3a','D3b','E1','E2'];
			$itemSs = ['A1a','A1b','A1c','A2a','A2b','A2c','A3a','A3b','A5a','A5b','B1a','B1b','B2a','B2bi','B2bii','B2biii','B2biv','B2bv','B2bvi','B3a','B4a','B4bi','B4bii','B4biii','C1a','C1b','C1c','C1chop','C2a','C2bi','C2bii','C2biii','C3a','C3bi','C3bii','C3biii','D1a','D2a','D2bi','D2bii','D3a','D3b','E1','E2'];
			$itemAs = ['A1a','A1b','A1c','A2a','A2b','A2c','A3a','A3b','A6a','A6b','B1a','B1b','B2a','B2bi','B2bii','B2biii','B2biv','B2bv','B2bvi','B3a','B4a','B4bi','B4bii','B4biii','C1a','C1b','C1c','C1chop','C2a','C2bi','C2bii','C2biii','C3a','C3bi','C3bii','C3biii','D1a','D2a','D2bi','D2bii','D3a','D3b','E1','E2'];
			// $itemSuper = ['A1a','A1b','A1c','A2a','A2b','A2c','A3a','A3b','A4a','A4b','A5a','A5b','A6a','A6b','B1a','B1b','B2a','B2bi','B2bii','B2biii','B2biv','B2bv','B2bvi','B3a','B4a','B4bi','B4bii','B4biii','C1a','C1b','C1c','C1chop','C2a','C2bi','C2bii','C2biii','C3a','C3bi','C3bii','C3biii','D1a','D2a','D2bi','D2bii','D3a','D3b','E1','E2'];
			// passed validation
			$update_record = array(
				'user_id'			=> $user_id,
				'award_id'			=> 5,
				'leatest'			=> '',
				'sign'				=> '',
				'leader_user_name'	=> $this->mUser->username,
				'update_time'		=> date("d/m/Y"),
			);
			switch ($scout[0]['award_path']) {
				case '2':
					$award_record	= array(
						'user_id'								=>$user_id,
						$itemSs[$this->input->post('field')] 	=> 1,
					);
					$update_record['field']	= $itemSs[$this->input->post('field')];
					$sl = $itemSs[$this->input->post('field')];
					break;
				
				case '3':
					$award_record	= array(
						'user_id'								=>$user_id,
						$itemAs[$this->input->post('field')] 	=> 1,
					);
					$update_record['field']	= $itemAs[$this->input->post('field')];
					$sl = $itemAs[$this->input->post('field')];
					break;

				case '1':
					$award_record	= array(
						'user_id'								=>$user_id,
						$itemS[$this->input->post('field')]		=> 1,
					);
					$update_record['field']	= $itemS[$this->input->post('field')];
					$sl = $itemS[$this->input->post('field')];
					break;
			}
			switch ($sl) {
				case 'B2bi':
					$award_record[$sl] = 0.1;
				break;

				case 'B2bii':
					$award_record[$sl] = 0.1;
				break;

				case 'B2biii':
					$award_record[$sl] = 0.1;
				break;

				case 'B2bvi':
					$award_record[$sl] = 0.1;
				break;

				case 'B2bv':
					$award_record[$sl] = 0.1;
				break;

				case 'B2bvi':
					$award_record[$sl] = 0.1;
				break;

				case 'B4bi':
					$award_record[$sl] = 0.1;
				break;

				case 'B4bii':
					$award_record[$sl] = 0.1;
				break;

				case 'B4biii':
					$award_record[$sl] = 0.1;
				break;

				case 'C2bi':
					$award_record[$sl] = 0.1;
				break;
				
				case 'C2bii':
					$award_record[$sl] = 0.1;
				break;

				case 'C2b[iii':
					$award_record[$sl] = 0.1;
				break;

				case 'C3bi':
					$award_record[$sl] = 0.1;
				break;

				case 'C3bii':
					$award_record[$sl] = 0.1;
				break;

				case 'C3biii':
					$award_record[$sl] = 0.1;
				break;

				case 'D2bi':
					$award_record[$sl] = 0.25;
					break;

				case 'D2bii':
					$award_record[$sl] = 0.25;
					break;
			}
			switch ($this->input->post('bool')) {
				case '0':
					$update_record['leatest'] = 1;
					$update_record['sign'] = 1;
					break;
				case '1':
					$award_record = array(
						'user_id'								=>$user_id,
						$itemSs[$this->input->post('field')] 	=> 0,
					);
					$update_record['leatest'] = 1;
					$update_record['sign'] = 0;
					$update_new = array(
						'user_id'		=> $user_id,
						'leatest'		=> 0
					);
					$array = array(
						'user_id'		=> $user_id,
						'award_id'		=> 5,
						'field'			=> $item[$this->input->post('field')],
						'leatest'		=> 1
					);
					$this->db->where($array);
					$this->db->update('scout_award_update_records', $update_new);
					break;
			}
			$this->db->where('user_id', $user_id);
			$this->db->update('scout_chief_awards', $award_record);
			$this->db->insert('scout_award_update_records', $update_record);
			refresh();
		}
		$this->mPageTitle = "Chief Scout's Award";
		$this->mViewData = array(
				'form'					=>	$form,
				'time'					=>	$time,
				'sign'					=>	$sign,
				'award_detail'			=>	$award_detail,
				'awardData'				=>	$awardData,
				'awardPath'				=>  $scout[0]['award_path'],
				'vistor'				=> 	$this->mUser->username
		); 
		$this->render('panel/scout_chief_award');
	}

}