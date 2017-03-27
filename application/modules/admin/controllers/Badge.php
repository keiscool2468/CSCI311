<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Badge extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('admin_user_model');
		$this->load->model('badge_user_model');
	}

	public function my_badge(){
		// print_r($this->mUser->user_id);exit;
		$user_id = $this->mUser->user_id;
		$myBadges = $this->db->get_where('badge_users', array('user_id' => $user_id))->result_array();
		$interest = array();
		$pursuit = array();
		$service = array();
		$instructor = array();
		$form = $this->form_builder->create_form();
		$badge_nameInt = ['Angler','Artist','Athlete','Campcook','CanoeistInt','Collector','Cyclist','Dragonboatman','Horseman','Librarian','Modelmaker','Musician','Naturalist','Parkorienteer','Photographer','Rowingboatman','Sailor','Smallholder','Swimmer','Tourism','Windsurfer','ArcheryInt','FootdrillInt','Animalcare',''];
		$badge_namePur = ['Astronomer','Boatswain','Camper','Canoeist','Canoepolo','Communicator','Computer','Cookchinesedishes','Craftsman','Electronics','Explorer','Treecarer','Internationalracingkayak','Mapmaker','Marksman','Masteratarms','Mechanic','Meteorologist','Navigator','Observer','Orienteer','Pioneer','Racehelmsman','Sailor','Skindiver','Sportsman','Worldfriendship','Archery','Backwoodscook',''];
		$badge_nameSer = ['Firstaid','Campwarden','Canoerescuer','Conservator','Environmentalprotection','Fireman','Guide','Interpreter','Jobman','Lifesaver','Pilot','Quartermaster','Secretary','Civics','Disabilityawareness',''];
		$badge_nameIns = ['ConservatorGold','LifesaverGold','CamperGold','CommunicatorGold','CookchinesedishesGold','TreecarerGold','MapmakerGold','MechanicGold','MeteorologistGold','ObserverGold','OrienteerGold','PioneerGold','CyclistGold','PhotographerGold','SailorGold','SwimmerGold','BackwoodscookGold',''];
		for($i = 0; $i < sizeof($myBadges); $i++) {
			switch ($myBadges[$i]['badge_type']) {
				case '1':
					array_push($interest,$myBadges[$i]['badge_name']);
					break;
				
				case '2':
					array_push($pursuit,$myBadges[$i]['badge_name']);
					break;

				case '3':
					array_push($service,$myBadges[$i]['badge_name']);
					break;

				case '4':
					array_push($instructor,$myBadges[$i]['badge_name']);
					break;
			}
		}
		$this->mPageTitle = 'My Proficiency Badges';
		
		$this->mViewData = array(
				'form'					=>	$form,
				'interest'				=>	$interest,
				'pursuit'				=>	$pursuit,
				'service'				=>	$service,
				'instructor'			=>	$instructor,
		); 
		$this->render('scout/my_badge');
	}


	public function scout_badge($user_id){
		$myBadges = $this->db->get_where('badge_users', array('user_id' => $user_id))->result_array();
		$interest = array();
		$pursuit = array();
		$service = array();
		$instructor = array();
		$act = array();
		$form = $this->form_builder->create_form();
		$badge_nameInt = ['Angler','Artist','Athlete','Campcook','CanoeistInt','Collector','Cyclist','Dragonboatman','Horseman','Librarian','Modelmaker','Musician','Naturalist','Parkorienteer','Photographer','Rowingboatman','Sailor','Smallholder','Swimmer','Tourism','Windsurfer','ArcheryInt','FootdrillInt','Animalcare'];
		$badge_namePur = ['Astronomer','Boatswain','Camper','Canoeist','Canoepolo','Communicator','Computer','Cookchinesedishes','Craftsman','Electronics','Explorer','Treecarer','Internationalracingkayak','Mapmaker','Marksman','Masteratarms','Mechanic','Meteorologist','Navigator','Observer','Orienteer','Pioneer','Racehelmsman','Sailor','Skindiver','Sportsman','Worldfriendship','Archery','Backwoodscook'];
		$badge_nameSer = ['Firstaid','Campwarden','Canoerescuer','Conservator','Environmentalprotection','Fireman','Guide','Interpreter','Jobman','Lifesaver','Pilot','Quartermaster','Secretary','Civics','Disabilityawareness'];
		$badge_nameIns = ['ConservatorGold','LifesaverGold','CamperGold','CommunicatorGold','CookchinesedishesGold','TreecarerGold','MapmakerGold','MechanicGold','MeteorologistGold','ObserverGold','OrienteerGold','PioneerGold','CyclistGold','PhotographerGold','SailorGold','SwimmerGold','BackwoodscookGold'];
		$badge_Act = ['Boatman','Coxswainsmate','Coxswain','Airman','Seniorairman','Masterairman'];
		$badge_type = ['','1','2','3','4','5'];
		for($i = 0; $i < sizeof($myBadges); $i++) {
			switch ($myBadges[$i]['badge_type']) {
				case '1':
					array_push($interest,$myBadges[$i]['badge_name']);
					break;
				
				case '2':
					array_push($pursuit,$myBadges[$i]['badge_name']);
					break;

				case '3':
					array_push($service,$myBadges[$i]['badge_name']);
					break;

				case '4':
					array_push($instructor,$myBadges[$i]['badge_name']);
					break;

				case '5':
					array_push($act,$myBadges[$i]['badge_name']);
					break;
			}
		}
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$award = array(
				'user_id'			=> $user_id,
				'badge_type'		=> $badge_type[$this->input->post('ddl1')],
			);
			$porBadge = array(
				'user_id'			=> $user_id,
				'badge'				=> $badge_type[$this->input->post('ddl2')],
				'issue_date'		=> date("d/m/Y"),
			);
			switch ($this->input->post('ddl1')) {
				case '1':
					$award['badge_name'] = $badge_nameInt[$this->input->post('ddl2')];
					break;

				case '2':
					$award['badge_name'] = $badge_namePur[$this->input->post('ddl2')];
					break;

				case '3':
					$award['badge_name'] = $badge_nameSer[$this->input->post('ddl2')];
					break;

				case '4':
					$award['badge_name'] = $badge_nameIns[$this->input->post('ddl2')];
					break;

				case '5':
					$award['badge_name'] = $badge_Act[$this->input->post('ddl2')];
					break;
			}
			switch ($this->input->post('ddl2')) {
				case 'Angler':
				case 'ArcheryInt':
				case 'Athlete':
				case 'CanoeistInt':
				case 'Cyclist':
				case 'Dragonboatman':
				case 'Swimmer':
				case 'Windsurfer':
				case 'SailorInt':
				case 'Parkorienteer':
				case 'Archery':
				case 'Canoeist':
				case 'Canoepolo':
				case 'Internationalracingkayak':
				case 'Marksman':
				case 'Orienteer':
				case 'Racehelmsman':
				case 'Sailor':
				case 'Canoerescuer':
				case 'Lifesaver':
				case 'Airman':
				case 'Boatman':
					$porBadge['standardA'] = 1;
					break;

				case 'Camper':
				case 'Explorer':
				case 'Observer':
				case 'Pioneer':
				case 'Coxswainsmate':
				case 'Seniorairman':
					$porBadge['advancedA'] = 1;
					break;

				case 'Artist':
				case 'Musician':
				case 'Computer':
				case 'Craftsman':
				case 'Electronics':
					$porBadge['advancedB'] = 1;
					break;

				case 'Firstaid':
				case 'Fireman':
				case 'Lifesaver':
					$porBadge['chiefA'] = 1;
					break;

				case 'Athlete':
				case 'Canoeist':
				case 'Cyclist':
				case 'Dragonboatman':
				case 'Horseman':
				case 'Parkorienteer':
				case 'Swimmer':
				case 'Windsurfer':
				case 'Archery':
				case 'Boatswain':
				case 'Explorer':
				case 'Marksman':
				case 'Orienteer':
				case 'Sportsman':
				case 'Canoerescuer':
				case 'Lifesaver':
					$porBadge['chiefB'] = 1;
					$porBadge['standardA'] = 0;
					break;

				case 'ConservatorGold':
				case 'LifesaverGold':
				case 'CamperGold':
				case 'CommunicatorGold':
				case 'CookchinesedishesGold':
				case 'TreecarerGold':
				case 'MapmakerGold':
				case 'MechanicGold':
				case 'MeteorologistGold':
				case 'ObserverGold':
				case 'OrienteerGold':
				case 'PioneerGold':
				case 'CyclistGold':
				case 'PhotographerGold':
				case 'SailorGold':
				case 'SwimmerGold':
				case 'BackwoodscookGold':
					$porBadge['chiefD'] = 1;
					break;

				case 'Animalcare':
				case 'Astronomer':
				case 'Meteorologist':
				case 'Treecarer':
					$porBadge['chiefE'] = 1;
					break;
			}
			$this->db->insert('badge_users', $award);
			refresh();
		}
		$this->mPageTitle = 'My Proficiency Badges';
		$this->mViewData = array(
				'form'					=>	$form,
				'interest'				=>	$interest,
				'pursuit'				=>	$pursuit,
				'service'				=>	$service,
				'instructor'			=>	$instructor,
		); 
		$this->render('scout/scout_badge');
	}
}