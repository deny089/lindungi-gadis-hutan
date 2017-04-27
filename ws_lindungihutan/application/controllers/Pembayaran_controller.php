<?php

class Pembayaran_controller extends CI_Controller {
	function __construct(){ 
			parent::__construct();
			$this->load->model('Pembayaran_model');
		}

	function index(){}
	
	function getPembayaran(){
		//http://localhost/ws_lindungihutan/index.php/Pembayaran_controller/getPembayaran
		$this->load->model('Pembayaran_model');
		$data = $this->Pembayaran_model->getPembayaran();
		echo json_encode($data);
	}
	
	function getIdPembayaran(){
		//http://localhost/ws_lindungihutan/index.php/Pembayaran_controller/getIdPembayaran?nama=nama
		$nama = $this->input->get("nama");
		$this->load->model('Pembayaran_model');
		$data = $this->Pembayaran_model->getIdPembayaran($nama);
		echo json_encode($data);
	}
	
	function getPembayaranByNama(){
		//http://localhost/ws_lindungihutan/index.php/Pembayaran_controller/getPembayaranByNama?nama=nama
		$nama = $this->input->get("nama");
		$this->load->model('Pembayaran_model');
		$data = $this->Pembayaran_model->getPembayaranByNama($nama);
		echo json_encode($data);
	}
	
}
 
?>