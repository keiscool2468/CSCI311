<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Printer extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('admin_user_model');
		$this->load->model('admin_user_group_model');
		$this->load->model('year_scout_model');
		$this->load->model('scout_proBadge_model');
		$this->load->model('scout_personal_particular_model');
		$this->load->model('scout_personal_particular_update_record_model');
	}
	public function print_form_crud($user_id)
	{	
		$paths = $this->db->get_where('scout_pathfinder_awards')->result_array();
		$stands = $this->db->get_where('scout_standard_awards')->result_array();
		$advans = $this->db->get_where('scout_advanced_awards')->result_array();
		$chiefs = $this->db->get_where('scout_chief_awards')->result_array();
		$printPath = array();
		$printStand = array();
		$printAdvan = array();
		$printChief = array();
		foreach ($paths as $path) {
			if ($path['issue_date']) {
				array_push($printPath,$this->db->get_where('scout_personal_particulars', array('user_id' => $path['user_id']))->result_array())[0];
			}
		}
		foreach ($stands as $stand) {
			if ($stand['issue_date']) {
				array_push($printStand,$this->db->get_where('scout_personal_particulars', array('user_id' => $stand['user_id']))->result_array())[0];
			}
		}
		foreach ($advans as $advan) {
			if ($advan['issue_date']) {
				array_push($printAdvan,$this->db->get_where('scout_personal_particulars', array('user_id' => $advan['user_id']))->result_array())[0];
			}
		}
		foreach ($chiefs as $chief) {
			if ($chief['issue_date']) {
				array_push($printChief,$this->db->get_where('scout_personal_particulars', array('user_id' => $chief['user_id']))->result_array())[0];
			}
		}
		$form = $this->form_builder->create_form();
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if($this->input->post('ddl1') == 4){
				$this->print_form($this->input->post('chief'));
			}elseif($this->input->post('ddl1') == 0){
				$this->render('errors/custom/error_404');
			}else{
				$this->print_badge($this->input->post('ddl1'),$this->input->post('chief'));
			}
		}
		$this->mPageTitle = 'Membership Badge';
		$this->mViewData = array(
				'form'			=> $form,
				'paths'			=> $printPath,
				'stands'		=> $printStand,
				'advans'		=> $printAdvan,
				'chiefs'		=> $printChief
		); 
		$this->render('print/chief_form_crud');

	}
	public function print_badge($badge,$user_id)
	{
		$scout = $this->db->get_where('scout_personal_particulars', array('user_id'=>$user_id))->result_array();
		$ViewData = array(
			'chinese_name'	=> $scout[0]['chinese_name'],
		);
		switch ($badge) {
			case '1':
				$award = $this->db->get_where('scout_pathfinder_awards', array('user_id' => $user_id))->result_array();
				$ViewData['issue_date'] = $award[0]['issue_date'];
				break;
			case '2':
				$award = $this->db->get_where('scout_standard_awards', array('user_id' => $user_id))->result_array();
				$ViewData['issue_date'] = $award[0]['issue_date'];
				break;
			case '3':
				$award = $this->db->get_where('scout_advanced_awards', array('user_id' => $user_id))->result_array();
				$ViewData['issue_date'] = $award[0]['issue_date'];
				break;
		}
		$this->load->view('print/print_badge',$ViewData);
	}
	public function print_form($user_id)
	{
		$personalParticular = $this->db->get_where('scout_personal_particulars', array('user_id' => $user_id))->result_array();
		$pathfinderAward = $this->db->get_where('scout_pathfinder_awards', array('user_id' => $user_id))->result_array();
		$standardAward = $this->db->get_where('scout_standard_awards', array('user_id' => $user_id))->result_array();
		$advancedAward = $this->db->get_where('scout_advanced_awards', array('user_id' => $user_id))->result_array();
		$chiefAward = $this->db->get_where('scout_chief_awards', array('user_id' => $user_id))->result_array();

		$pathfinderUpdate = $this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 2, 'sign' => 1, 'leatest' => 1))->result_array();
		$pathLastedDate = 0;
		foreach($pathfinderUpdate as $pathfinderUpdat){
		  $curDate = strtotime($pathfinderUpdat['update_time']);
		  if ($curDate > $pathLastedDate) {
		     $pathLastedDate = $curDate;
		  }
		}
		$pathLastedDate = date("d/m/Y",$pathLastedDate);
		$pathADate = $pathLastedDate;

		$standardUpdate = $this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 3, 'sign' => 1, 'leatest' => 1))->result_array();
		$standLastedDate = 0;
		foreach($standardUpdate as $standardUpdat){
		  $curDate = strtotime($standardUpdat['update_time']);
		  if ($curDate > $standLastedDate) {
		     $standLastedDate = $curDate;
		  }
		}
		$standLastedDate = date("d/m/Y",$standLastedDate);
		$standADate = $standLastedDate;

		$advancedUpdate = $this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 4, 'sign' => 1, 'leatest' => 1))->result_array();
		$advanLastedDate = 0;
		foreach($advancedUpdate as $advancedUpdat){
		  $curDate = strtotime($advancedUpdat['update_time']);
		  if ($curDate > $advanLastedDate) {
		     $advanLastedDate = $curDate;
		  }
		}
		$advanLastedDate = date("d/m/Y",$advanLastedDate);
		$advanADate = $advanLastedDate;

		$chiefUpdate = $this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1))->result_array();
		$chiefLastedDate = 0;
		foreach($chiefUpdate as $chiefUpdat){
		  $curDate = strtotime($pathfinderUpdat['update_time']);
		  if ($curDate > $chiefLastedDate) {
		     $chiefLastedDate = $curDate;
		  }
		}
		$chiefUpdateJson = array(
			'A1a'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'A1a'))->result_array(),
			'A1b'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'A1b'))->result_array(),
			'A1c'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'A1c'))->result_array(),
			'A2a'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'A2a'))->result_array(),
			'A2b'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'A2b'))->result_array(),
			'A2c'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'A2c'))->result_array(),
			'A3a'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'A3a'))->result_array(),
			'A3b'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'A3b'))->result_array(),
			'A4a'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'A4a'))->result_array(),
			'A4b'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'A4b'))->result_array(),
			'A5a'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'A5a'))->result_array(),
			'A5b'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'A5b'))->result_array(),
			'A6a'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'A6a'))->result_array(),
			'A6b'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'A6b'))->result_array(),
			'B1a'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'B1a'))->result_array(),
			'B1b'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'B1b'))->result_array(),
			'B2a'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'B2a'))->result_array(),
			'B2bi'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'B2bi'))->result_array(),
			'B2bii'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'B2bii'))->result_array(),
			'B2biii'	=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'B2biii'))->result_array(),
			'B2biv'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'B2biv'))->result_array(),
			'B2bv'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'B2bv'))->result_array(),
			'B2bvi'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'B2bvi'))->result_array(),
			'B3a'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'B3a'))->result_array(),
			'B4a'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'B4a'))->result_array(),
			'B4bi'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'B4bi'))->result_array(),
			'B4bii'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'B4bii'))->result_array(),
			'B4biii'	=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'B4biii'))->result_array(),
			'C1a'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'C1a'))->result_array(),
			'C1b'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'C1b'))->result_array(),
			'C1c'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'C1c'))->result_array(),
			'C1chop'	=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'C1chop'))->result_array(),
			'C2a'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'C2a'))->result_array(),
			'C2bi'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'C2bi'))->result_array(),
			'C2bii'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'C2bii'))->result_array(),
			'C2biii'	=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'C2biii'))->result_array(),
			'C3a'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'C3a'))->result_array(),
			'C3bi'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'C3bi'))->result_array(),
			'C3bii'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'C3bii'))->result_array(),
			'C3biii'	=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'C3biii'))->result_array(),
			'D1a'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'D1a'))->result_array(),
			'D2a'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'D2a'))->result_array(),
			'D2bi'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'D2bi'))->result_array(),
			'D2bii'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'D2bii'))->result_array(),
			'D3a'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'D3a'))->result_array(),
			'D3b'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'D3b'))->result_array(),
			'E1'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'E1'))->result_array(),
			'E2'		=>	$this->db->get_where('scout_award_update_records', array('user_id' => $user_id, 'award_id' => 5, 'sign' => 1, 'leatest' => 1,'field'=>'E2'))->result_array(),
		);
		$chiefLastedDate = date("d/m/Y",$chiefLastedDate);
		$chiefADate = $chiefLastedDate;

		$proBadgestandardA = $this->db->get_where('scout_proBadges', array('user_id' => $user_id, 'standardA' =>1))->result_array();
		$proBadgeadvancedA = $this->db->get_where('scout_proBadges', array('user_id' => $user_id, 'advancedA' =>1))->result_array();
		$proBadgeadvancedB = $this->db->get_where('scout_proBadges', array('user_id' => $user_id, 'advancedB' =>1))->result_array();
		$proBadgechiefA = $this->db->get_where('scout_proBadges', array('user_id' => $user_id, 'chiefA' =>1))->result_array();
		$proBadgechiefB = $this->db->get_where('scout_proBadges', array('user_id' => $user_id, 'chiefB' =>1))->result_array();
		$proBadgechiefC = $this->db->get_where('scout_proBadges', array('user_id' => $user_id, 'chiefC' =>1))->result_array();
		$proBadgechiefD = $this->db->get_where('scout_proBadges', array('user_id' => $user_id, 'chiefD' =>1))->result_array();
		$proBadgechiefE = $this->db->get_where('scout_proBadges', array('user_id' => $user_id, 'chiefE' =>1))->result_array();
		$proBadge = array(
			'proBadgestandardA'		=> $proBadgestandardA,
			'proBadgeadvancedA'		=> $proBadgeadvancedA,
			'proBadgeadvancedB'		=> $proBadgeadvancedB,
			'proBadgechiefA'		=> $proBadgechiefA,
			'proBadgechiefB'		=> $proBadgechiefB,
			'proBadgechiefC'		=> $proBadgechiefC,
			'proBadgechiefD'		=> $proBadgechiefD,
			'proBadgechiefE'		=> $proBadgechiefE
		);
		$region = ['Kowloon','East Kowloon','New Territories','New Territories East','Hong Kong Island', ''];
		$district = ['Chai Wan','Northern','Sau Kei Wan','Southern','Victoria City','Wan Chai','Western',//0~6 is Hong Kong Island
		       'Ho Man Tin','Hung Hom','Kowloon City','Kowloon Tong','Mong Kok','Sham Mong','Sham Shui Po East',
		              'Sham Shui Po West','Yau Tsim',//7~15 is Kowloon
		               	'Kowloon Bay','Kwun Tong','Lei Yue Mun','Sai Kung','Sau Mau Ping','Tseung Kwan O','Tsz Wan Shan','Wong Tai Sin',//16~23 is East Kowloon
		               	        'Island','North Kwai Chung','Shep Pak Heung','South Kwai Chung','Tsing Yi','Tsuen Wan',
		               	              'Tuen Mun East District','Tuen Mun West','Yuen Long East','Yuen Long West',//24~33 is New Terrisories
		               	                  'Pik Fung','Shatin East','Shatin North','Shatin South','Shatin West','Sheung Yue','Tai Po South','Tai Po North',//34~42 is New Territories East
		               	                          'Silver Jubilee',''];
		$this->mPageTitle = 'Chief Scout Printer';
		$this->mViewData = array(
			'user_id'				=> $user_id,
			'vistor'				=> $this->mUser->username,
			'personalParticular'	=> $personalParticular[0],
			'pathfinderAward'		=> $pathfinderAward[0],	
			'standardAward'			=> $standardAward[0],
			'advancedAward'			=> $advancedAward[0],
			'chiefAward'			=> $chiefAward[0],
			'pathLastedDate'		=> $pathLastedDate,
			'pathADate'				=> $pathADate,
			'standLastedDate'		=> $standLastedDate,
			'standADate'			=> $standADate,
			'advanLastedDate'		=> $advanLastedDate,
			'advanADate'			=> $advanADate,
			'chiefLastedDate'		=> $chiefLastedDate,
			'chiefADate'			=> $chiefADate,
			'chiefUpdate'			=> $chiefUpdateJson,
			'proBadge'				=> $proBadge,
			'region'				=> $region,
			'district'				=> $district
		); 
		$ViewData = array(
			'user_id'				=> $user_id,
			'vistor'				=> $this->mUser->username,
			'personalParticular'	=> $personalParticular[0],
			'pathfinderAward'		=> $pathfinderAward[0],	
			'standardAward'			=> $standardAward[0],
			'advancedAward'			=> $advancedAward[0],
			'chiefAward'			=> $chiefAward[0],
			'pathLastedDate'		=> $pathLastedDate,
			'pathADate'				=> $pathADate,
			'standLastedDate'		=> $standLastedDate,
			'standADate'			=> $standADate,
			'advanLastedDate'		=> $advanLastedDate,
			'advanADate'			=> $advanADate,
			'chiefLastedDate'		=> $chiefLastedDate,
			'chiefADate'			=> $chiefADate,
			'chiefUpdate'			=> $chiefUpdateJson,
			'proBadge'				=> $proBadge,
			'region'				=> $region,
			'district'				=> $district
		); 
		$this->load->view('print/chief_form',$ViewData);
		// $this->render('print/chief_form');
	}
}

