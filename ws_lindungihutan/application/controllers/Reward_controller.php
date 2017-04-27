<?php

class Reward_controller extends CI_Controller {
	function __construct(){ 
			parent::__construct();
			$this->load->model('Reward_model');
		}

	function index(){}
		
	function getReward(){
		//http://localhost/ws_lindungihutan/index.php/Reward_controller/getReward
		$this->load->model('Reward_model');
		$data = $this->Reward_model->getReward();
		echo json_encode($data);
	}
	
}
 
?>