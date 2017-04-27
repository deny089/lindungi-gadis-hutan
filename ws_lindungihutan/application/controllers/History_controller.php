<?php

class History_controller extends CI_Controller {
	function __construct(){ 
			parent::__construct();
			$this->load->model('History_model');
		}

	function index(){}
	
	function getHistoryCampaign(){
		//http://localhost/ws_lindungihutan/index.php/History_controller/getHistoryCampaign
		$this->load->model('History_model');
		$data = $this->History_model->getHistoryCampaign();
		echo json_encode($data);
	}
	
	function getHistoryCampaignById(){
		//http://localhost/ws_lindungihutan/index.php/History_controller/getHistoryCampaignById?id=id_user
		$id_user = $this->input->get("id");
		$this->load->model('History_model');
		$data = $this->History_model->getHistoryCampaignById($id_user);
		echo json_encode($data);
	}
	
	function updateStatusHistoryCampaign(){
		//http://localhost/ws_lindungihutan/index.php/History_controller/updateStatusHistoryCampaign?id=id
		$id = $this->input->get("id");
		$this->load->model('History_model');
		$data = $this->History_model->updateStatusHistoryCampaign($id);
		$array = array('update' => 'succeed');
		echo json_encode($array);
	}
	
	function getHistoryPantiHewan(){
		//http://localhost/ws_lindungihutan/index.php/History_controller/getHistoryPantiHewan
		$this->load->model('History_model');
		$data = $this->History_model->getHistoryPantiHewan();
		echo json_encode($data);
	}
	
	function getHistoryPantiHewanById(){
		//http://localhost/ws_lindungihutan/index.php/History_controller/getHistoryPantiHewanById?id=id
		$id = $this->input->get("id");
		$this->load->model('History_model');
		$data = $this->History_model->getHistoryPantiHewanById($id);
		echo json_encode($data);
	}
	
	function updateStatusHistoryPantiHewan(){
		//http://localhost/ws_lindungihutan/index.php/History_controller/updateStatusHistoryPantiHewan?id=id
		$id = $this->input->get("id");
		$this->load->model('History_model');
		$data = $this->History_model->updateStatusHistoryPantiHewan($id);
		$array = array('update' => 'succeed');
		echo json_encode($array);
	}
	
}
 
?>