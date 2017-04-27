<?php

class Monitoring_controller extends CI_Controller {
	function __construct(){ 
			parent::__construct();
			$this->load->model('Monitoring_model');
		}

	function index(){}
		
	function getPohonById(){
		//http://localhost/ws_lindungihutan/index.php/Monitoring_controller/getPohonById?id=id_pohon
		$id = $this->input->get("id");
		$this->load->model('Monitoring_model');
		$data = $this->Monitoring_model->getPohonById($id);
		echo json_encode($data);
	}
}

?>