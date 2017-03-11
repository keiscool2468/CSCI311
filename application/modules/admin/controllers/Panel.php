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
		$this->load->model('scout_membership_award_model');
		$this->load->model('scout_pathfinder_award_model');
		$this->load->model('scout_standard_award_model');
		$this->load->model('scout_advanced_award_model');
		$this->load->model('scout_chief_award_model');
		$this->load->model('scout_award_update_record_model');
	}

	public function scout_progressive()
	{
		$crud = $this->generate_crud('admin_users');
		$crud->set_relation('id', 'admin_users_groups', 'group_id');
		$crud->where('group_id >', 2);
		$crud->where('active >', 0);
		$crud->columns('username', 'first_name', 'last_name', 'active');
		$this->unset_crud_fields('ip_address', 'last_login');
		if ( $this->ion_auth->in_group(array('webmaster', 'admin')) )
		{
			$crud->add_action("Chief Scout's Award", 'http://prog.scouting.org.hk/scouts/TS/Progressive/ChiefScoutsAward.gif', $this->mModule.'/panel/scout_chief_award');
			$crud->add_action('Advanced Award', 'http://prog.scouting.org.hk/scouts/TS/Progressive/Challenger.gif', $this->mModule.'/panel/scout_advanced_award');
			$crud->add_action('Standard Award', 'http://prog.scouting.org.hk/scouts/TS/Progressive/Voyager.gif', $this->mModule.'/panel/scout_standard_award');
			$crud->add_action('Pathfinder Award', 'http://prog.scouting.org.hk/scouts/TS/Progressive/Pathfinder.gif', $this->mModule.'/panel/scout_pathfinder_award');
			$crud->add_action('Membership Badge', 'http://prog.scouting.org.hk/scouts/TS/Progressive/MembershipBadge.gif', $this->mModule.'/panel/scout_membership_award' );
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

	public function scout_membership_award($user_id)
	{
		$award = $this->db->get_where('scout_membership_awards', array('user_id' => $user_id));
		$awards = $award->result_array();
		$awardData = $awards[0];
		// print_r($awards[0]);exit;
		$thisRecord = $this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 1, 'sign' => 1, 'leatest' => 1))->result_array();
		$sign = array(
			'one'		=>	'',
			'two'		=>	'',
			'three'		=>	'',
			'four'		=>	'',
			'five'		=>	'',
			'six'		=>	'',
			'seven'		=>	'',
			'eight'		=>	'',
			'nine'		=>	'',
			'ten'		=>	'',
		);
		for($i = 0; $i < sizeof($thisRecord); $i++) {
			switch ($thisRecord[$i]["field"]) {
				case "one":
					if($awards[0]['one'] != 0)
					$sign['one'] = $thisRecord[$i]['leader_user_name'];
					break;

				case "two":
					if($awards[0]['two'] != 0)
					$sign['two'] = $thisRecord[$i]['leader_user_name'];
					break;

				case "three":
					if($awards[0]['three'] != 0)
					$sign['three'] = $thisRecord[$i]['leader_user_name'];
					break;

				case "four":
					if($awards[0]['four'] != 0)
					$sign['four'] = $thisRecord[$i]['leader_user_name'];
					break;

				case "five":
					if($awards[0]['five'] != 0)
					$sign['five'] = $thisRecord[$i]['leader_user_name'];
					break;

				case "six":
					if($awards[0]['six'] != 0)
					$sign['six'] = $thisRecord[$i]['leader_user_name'];
					break;

				case "seven":
					if($awards[0]['seven'] != 0)
					$sign['seven'] = $thisRecord[$i]['leader_user_name'];
					break;

				case "eight":
					if($awards[0]['eight'] != 0)
					$sign['eight'] = $thisRecord[$i]['leader_user_name'];
					break;

				case "nine":
					if($awards[0]['nine'] != 0)
					$sign['nine'] = $thisRecord[$i]['leader_user_name'];
					break;

				case "ten":
					if($awards[0]['ten'] != 0)
					$sign['ten'] = $thisRecord[$i]['leader_user_name'];
				break;
			}
		}
		$time = array(
			'one'		=>	'',
			'two'		=>	'',
			'three'		=>	'',
			'four'		=>	'',
			'five'		=>	'',
			'six'		=>	'',
			'seven'		=>	'',
			'eight'		=>	'',
			'nine'		=>	'',
			'ten'		=>	'',
		);
		for($i = 0; $i < sizeof($thisRecord); $i++) {
			switch ($thisRecord[$i]["field"]) {
				case "one":
					if($awards[0]['one'] != 0)
					$time['one'] = $thisRecord[$i]['update_time'];
					break;

				case "two":
					if($awards[0]['two'] != 0)
					$time['two'] = $thisRecord[$i]['update_time'];
					break;

				case "three":
					if($awards[0]['three'] != 0)
					$time['three'] = $thisRecord[$i]['update_time'];
					break;

				case "four":
					if($awards[0]['four'] != 0)
					$time['four'] = $thisRecord[$i]['update_time'];
					break;

				case "five":
					if($awards[0]['five'] != 0)
					$time['five'] = $thisRecord[$i]['update_time'];
					break;

				case "six":
					if($awards[0]['six'] != 0)
					$time['six'] = $thisRecord[$i]['update_time'];
					break;

				case "seven":
					if($awards[0]['seven'] != 0)
					$time['seven'] = $thisRecord[$i]['update_time'];
					break;

				case "eight":
					if($awards[0]['eight'] != 0)
					$time['eight'] = $thisRecord[$i]['update_time'];
					break;

				case "nine":
					if($awards[0]['nine'] != 0)
					$time['nine'] = $thisRecord[$i]['update_time'];
					break;

				case "ten":
					if($awards[0]['ten'] != 0)
					$time['ten'] = $thisRecord[$i]['update_time'];
				break;
			}
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
	   	if($award->num_rows()==0) {
	   		$new_spp = array(
				'user_id'			=> $user_id,
			);
			$this->db->insert('scout_membership_awards', $new_spp);
			refresh();
	   	} else {
   			$point = $awards[0]['one']+$awards[0]['two']+$awards[0]['three']+$awards[0]['four']+$awards[0]['five']+$awards[0]['six']+$awards[0]['seven']+$awards[0]['eight']+$awards[0]['nine']+$awards[0]['ten'];
	  		// print_r($point);exit;
   			if($point == 10) {
   				$awardData['issue_date'] = date("Y/m/d");
   				$this->db->update('scout_membership_awards', $awardData);
   				
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
				'update_time'		=> date("Y/m/d"),
			);
			$award_record = array(
				'user_id'			=> $user_id,
			);
			switch ($this->input->post('bool')) {
				case '0':
					$award_record = array(
						$item[$this->input->post('field')]		=> 1,
					);
					$update_record['leatest'] = 1;
					$update_record['sign'] = 1;		
					break;
				case '1':
					$award_record = array(
						$item[$this->input->post('field')]		=> 0,
					);
					$update_record['leatest'] = 1;
					$update_record['sign'] = 0;
					break;
			}
			$this->db->where('user_id', $user_id);
			$this->db->update('scout_membership_awards', $award_record);
			$this->db->insert('scout_award_update_records', $update_record);
			refresh();
		}
		$this->mPageTitle = 'Membership Badge';
		$this->mViewData = array(
				'form'					=>	$form,
				'time'					=>	$time,
				'sign'					=>	$sign,
				'award_detail'			=>	$award_detail,
				'awardData'				=>	$awardData,
		); 
		$this->render('panel/scout_membership_award');
	}

	public function scout_pathfinder_award($user_id)
	{
		$award = $this->db->get_where('scout_pathfinder_awards', array('user_id' => $user_id));
		// $award_path = $scout[0]['award_path'];
		$awards = $award->result_array();
		$awardData = $awards[0];
		$thisRecord = $this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 2, 'sign' => 1, 'leatest' => 1))->result_array();
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
		for($i = 0; $i < sizeof($thisRecord); $i++) {
			switch ($thisRecord[$i]["field"]) {
				case "A1a":
					if($awards[0]['A1a'] != 0)
					$sign['A1a'] = $thisRecord[$i]['leader_user_name'];
					break;

				case "A1b":
					if($awards[0]['A1b'] != 0)
					$sign['A1b'] = $thisRecord[$i]['leader_user_name'];
					break;

				case "A1c":
					if($awards[0]['A1c'] != 0)
					$sign['A1c'] = $thisRecord[$i]['leader_user_name'];
					break;

				case "A1d":
					if($awards[0]['A1d'] != 0)
					$sign['A1d'] = $thisRecord[$i]['leader_user_name'];
					break;

				case "A2a":
					if($awards[0]['A2a'] != 0)
					$sign['A2a'] = $thisRecord[$i]['leader_user_name'];
					break;

				case "A2b":
					if($awards[0]['A2b'] != 0)
					$sign['A2b'] = $thisRecord[$i]['leader_user_name'];
					break;

				case "A2c":
					if($awards[0]['A2c'] != 0)
					$sign['A2c'] = $thisRecord[$i]['leader_user_name'];
					break;

				case "A3a":
					if($awards[0]['A3a'] != 0)
					$sign['A3a'] = $thisRecord[$i]['leader_user_name'];
					break;

				case "A3b":
					if($awards[0]['A3b'] != 0)
					$sign['A3b'] = $thisRecord[$i]['leader_user_name'];
					break;

				case "A4a":
					if($awards[0]['A4a'] != 0)
					$sign['A4a'] = $thisRecord[$i]['leader_user_name'];
				break;

				case "A4bi":
					if($awards[0]['A4bi'] != 0)
					$sign['A4bi'] = $thisRecord[$i]['leader_user_name'];
				break;

				case "A4bii":
					if($awards[0]['A4bii'] != 0)
					$sign['A4bii'] = $thisRecord[$i]['leader_user_name'];
				break;

				case "A4biii":
					if($awards[0]['A4biii'] != 0)
					$sign['A4biii'] = $thisRecord[$i]['leader_user_name'];
				break;

				case "A5a":
					if($awards[0]['A5a'] != 0)
					$sign['A5a'] = $thisRecord[$i]['leader_user_name'];
				break;

				case "A5b":
					if($awards[0]['A5b'] != 0)
					$sign['A5b'] = $thisRecord[$i]['leader_user_name'];
				break;

				case "A6a":
					if($awards[0]['A6a'] != 0)
					$sign['A6a'] = $thisRecord[$i]['leader_user_name'];
				break;

				case "A6bi":
					if($awards[0]['A6bi'] != 0)
					$sign['A6bi'] = $thisRecord[$i]['leader_user_name'];
				break;

				case "A6bii":
					if($awards[0]['A6bii'] != 0)
					$sign['A6bii'] = $thisRecord[$i]['leader_user_name'];
				break;

				case "A6biii":
					if($awards[0]['A6biii'] != 0)
					$sign['A6biii'] = $thisRecord[$i]['leader_user_name'];
				break;

				case "B1a":
					if($awards[0]['B1a'] != 0)
					$sign['B1a'] = $thisRecord[$i]['leader_user_name'];
				break;

				case "B2a":
					if($awards[0]['B2a'] != 0)
					$sign['B2a'] = $thisRecord[$i]['leader_user_name'];
				break;

				case "B3a":
					if($awards[0]['B3a'] != 0)
					$sign['B3a'] = $thisRecord[$i]['leader_user_name'];
				break;

				case "B4a":
					if($awards[0]['B4a'] != 0)
					$sign['B4a'] = $thisRecord[$i]['leader_user_name'];
				break;

				case "B4b":
					if($awards[0]['B4b'] != 0)
					$sign['B4b'] = $thisRecord[$i]['leader_user_name'];
				break;

				case "C1a":
					if($awards[0]['C1a'] != 0)
					$sign['C1a'] = $thisRecord[$i]['leader_user_name'];
				break;

				case "C1b":
					if($awards[0]['C1b'] != 0)
					$sign['C1b'] = $thisRecord[$i]['leader_user_name'];
				break;

				case "C2a":
					if($awards[0]['C2a'] != 0)
					$sign['C2a'] = $thisRecord[$i]['leader_user_name'];
				break;

				case "D1a":
					if($awards[0]['D1a'] != 0)
					$sign['D1a'] = $thisRecord[$i]['leader_user_name'];
				break;

				case "D2a":
					if($awards[0]['D2a'] != 0)
					$sign['D2a'] = $thisRecord[$i]['leader_user_name'];
				break;
			}
		}
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
		for($i = 0; $i < sizeof($thisRecord); $i++) {
			switch ($thisRecord[$i]["field"]) {
				case "A1a":
					if($awards[0]['A1a'] != 0)
					$time['A1a'] = $thisRecord[$i]['update_time'];
					break;

				case "A1b":
					if($awards[0]['A1b'] != 0)
					$time['A1b'] = $thisRecord[$i]['update_time'];
					break;

				case "A1c":
					if($awards[0]['A1c'] != 0)
					$time['A1c'] = $thisRecord[$i]['update_time'];
					break;

				case "A1d":
					if($awards[0]['A1d'] != 0)
					$time['A1d'] = $thisRecord[$i]['update_time'];
					break;

				case "A2a":
					if($awards[0]['A2a'] != 0)
					$time['A2a'] = $thisRecord[$i]['update_time'];
					break;

				case "A2b":
					if($awards[0]['A2b'] != 0)
					$time['A2b'] = $thisRecord[$i]['update_time'];
					break;

				case "A2c":
					if($awards[0]['A2c'] != 0)
					$time['A2c'] = $thisRecord[$i]['update_time'];
					break;

				case "A3a":
					if($awards[0]['A3a'] != 0)
					$time['A3a'] = $thisRecord[$i]['update_time'];
					break;

				case "A3b":
					if($awards[0]['A3b'] != 0)
					$time['A3b'] = $thisRecord[$i]['update_time'];
					break;

				case "A4a":
					if($awards[0]['A4a'] != 0)
					$time['A4a'] = $thisRecord[$i]['update_time'];
				break;

				case "A4bi":
					if($awards[0]['A4bi'] != 0)
					$time['A4bi'] = $thisRecord[$i]['update_time'];
				break;

				case "A4bii":
					if($awards[0]['A4bii'] != 0)
					$time['A4bii'] = $thisRecord[$i]['update_time'];
				break;

				case "A4biii":
					if($awards[0]['A4biii'] != 0)
					$time['A4biii'] = $thisRecord[$i]['update_time'];
				break;

				case "A5a":
					if($awards[0]['A5a'] != 0)
					$time['A5a'] = $thisRecord[$i]['update_time'];
				break;

				case "A5b":
					if($awards[0]['A5b'] != 0)
					$time['A5b'] = $thisRecord[$i]['update_time'];
				break;

				case "A6a":
					if($awards[0]['A6a'] != 0)
					$time['A6a'] = $thisRecord[$i]['update_time'];
				break;

				case "A6bi":
					if($awards[0]['A6bi'] != 0)
					$time['A6bi'] = $thisRecord[$i]['update_time'];
				break;

				case "A6bii":
					if($awards[0]['A6bii'] != 0)
					$time['A6bii'] = $thisRecord[$i]['update_time'];
				break;

				case "A6biii":
					if($awards[0]['A6biii'] != 0)
					$time['A6biii'] = $thisRecord[$i]['update_time'];
				break;

				case "B1a":
					if($awards[0]['B1a'] != 0)
					$time['B1a'] = $thisRecord[$i]['update_time'];
				break;

				case "B2a":
					if($awards[0]['B2a'] != 0)
					$time['B2a'] = $thisRecord[$i]['update_time'];
				break;

				case "B3a":
					if($awards[0]['B3a'] != 0)
					$time['B3a'] = $thisRecord[$i]['update_time'];
				break;

				case "B4a":
					if($awards[0]['B4a'] != 0)
					$time['B4a'] = $thisRecord[$i]['update_time'];
				break;

				case "B4b":
					if($awards[0]['B4b'] != 0)
					$time['B4b'] = $thisRecord[$i]['update_time'];
				break;

				case "C1a":
					if($awards[0]['C1a'] != 0)
					$time['C1a'] = $thisRecord[$i]['update_time'];
				break;

				case "C1b":
					if($awards[0]['C1b'] != 0)
					$time['C1b'] = $thisRecord[$i]['update_time'];
				break;

				case "C2a":
					if($awards[0]['C2a'] != 0)
					$time['C2a'] = $thisRecord[$i]['update_time'];
				break;

				case "D1a":
					if($awards[0]['D1a'] != 0)
					$time['D1a'] = $thisRecord[$i]['update_time'];
				break;

				case "D2a":
					if($awards[0]['D2a'] != 0)
					$time['D2a'] = $thisRecord[$i]['update_time'];
				break;
			}
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
			'B1a'		=>	'B1a:參與一次以運動或體能競技為主題的小小隊活動',
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
	   	if($award->num_rows()==0) {
	   		$new_spp = array(
				'user_id'			=> $user_id,
			);
			$this->db->insert('scout_pathfinder_awards', $new_spp);
			refresh();
	   	} else {
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
					'issue_date'	 => date("Y/m/d"),
				);
				$this->db->update('scout_pathfinder_awards', $awardData);
			}
	  	}
		$form = $this->form_builder->create_form();
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$itemS = ['A1a','A1b','A1c','A1d','A1d','A2a','A2b','A2c','A3a','A3a','A3b','A4a','A4bi','A4bii','A4biii','A5a','A5b','A6a','A6bi','A6bii','A6biii','B1a','B2a','B3a','B4a','B4b','C1a','C1b','C2a','D1a','D2a'];
			$itemSs = ['A1a','A1b','A1c','A1d','A1d','A2a','A2b','A2c','A3a','A3a','A3b','A5a','A5b','B1a','B2a','B3a','B4a','B4b','C1a','C1b','C2a','D1a','D2a'];
			$itemAs = ['A1a','A1b','A1c','A1d','A1d','A2a','A2b','A2c','A3a','A3a','A3b','A6a','A6bi','A6bii','A6biii','B1a','B2a','B3a','B4a','B4b','C1a','C1b','C2a','D1a','D2a'];
			// passed validation
			$update_record = array(
				'user_id'			=> $user_id,
				'award_id'			=> 2,
				'leatest'			=> '',
				'sign'				=> '',
				'leader_user_name'	=> $this->mUser->username,
				'update_time'		=> date("Y/m/d"),
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
				case 'A4bi':

					$award_record[$sl] = 0.25;
					break;

				case 'A4bii':
					$award_record[$sl] = 0.25;
					break;

				case 'A4biii':
					$award_record[$sl] = 0.25;
					break;

				case 'A6bi':
					$award_record[$sl] = 0.25;
					break;

				case 'A6bii':
					$award_record[$sl] = 0.25;
					break;

				case 'A6biii':
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
					break;
			}
			$this->db->where('user_id', $user_id);
			$this->db->update('scout_pathfinder_awards', $award_record);
			$this->db->insert('scout_award_update_records', $update_record);
			refresh();
		}
		$this->mPageTitle = 'Pathfinder Award';
		$this->mViewData = array(
				'form'					=>	$form,
				'time'					=>	$time,
				'sign'					=>	$sign,
				'award_detail'			=>	$award_detail,
				'awardData'				=>	$awardData,
				'awardPath'				=>  $scout[0]['award_path'],
		); 
		$this->render('panel/scout_pathfinder_award');
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
				'english_name'				=> '',
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
	   		$this->db->where('user_id', $user_id);
   			$q = $this->db->get('scout_personal_particulars');
   			$record = $q->result_array();
	  	}
		$form = $this->form_builder->create_form();
		if ($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			// passed validation
			$person = array(
				'user_id'				=> $user_id,
				'chinese_name'			=> $this->input->post('chinese_name'),
				'english_name'			=> $this->input->post('english_name'),
				'date_of_birth'			=> $this->input->post('date_of_birth'),
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
		$this->mPageTitle = 'Personal Particular';
		// print_r($record);
		$region = [
		'Kowloon',
		 'East Kowloon',
		  'New Territories',
		   'New Territories East',
		    'Hong Kong Island', ''];
		$district = [
		'Chai Wan',
		 'Northern',
		  'Sau Kei Wan',
		   'Southern',
		    'Victoria City',
		     'Wan Chai',
		      'Western',//0~6 is Hong Kong Island
		       'Ho Man Tin',
		        'Hung Hom',
		         'Kowloon City',
		          'Kowloon Tong',
		           'Mong Kok',
		            'Sham Mong',
		             'Sham Shui Po East',
		              'Sham Shui Po West',
		               'Yau Tsim',//7~15 is Kowloon
		               	'Kowloon Bay',
		               	 'Kwun Tong',
		               	  'Lei Yue Mun',
		               	   'Sai Kung',
		               	    'Sau Mau Ping',
		               	     'Tseung Kwan O',
		               	      'Tsz Wan Shan',
		               	       'Wong Tai Sin',//16~23 is East Kowloon
		               	        'Island',
		               	         'North Kwai Chung',
		               	          'Shep Pak Heung',
		               	           'South Kwai Chung',
		               	            'Tsing Yi',
		               	             'Tsuen Wan',
		               	              'Tuen Mun East District',
		               	               'Tuen Mun West',
		               	                'Yuen Long East',
		               	                 'Yuen Long West',//24~33 is New Terrisories
		               	                  'Pik Fung',
		               	                   'Shatin East',
		               	                    'Shatin North',
		               	                     'Shatin South',
		               	                      'Shatin West',
		               	                       'Sheung Yue',
		               	                        'Tai Po South',
		               	                         'Tai Po North',//34~42 is New Territories East
		               	                          'Silver Jubilee',''];
		$this->mViewData = array(
				'form'					=>	$form,
				'vister'				=>	$this->mUser->username,
				'record'				=> 	$record[0],
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
		if ( $this->ion_auth->in_group(array('webmaster', 'admin')) )
		{
			$crud->add_action('Reset Password', '', $this->mModule.'/panel/admin_user_reset_password', 'fa fa-repeat');
			$crud->add_action('Personal Particular', '', $this->mModule.'/panel/personal_particular_edit', 'fa fa-id-card-o');
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
