<?php

class Kupon_controller extends CI_Controller {
	function __construct(){ 
			parent::__construct();
			$this->load->model('Kupon_model');
			date_default_timezone_set('Asia/Jakarta');
			$this->load->helper(array('form', 'url'));
		}

	function index(){}
	
	function getKuponById(){
		//http://localhost/ws_lindungihutan/index.php/Kupon_controller/getKuponById?id=id
		$id = $this->input->get("id");
		$this->load->model('Kupon_model');
		$data = $this->Kupon_model->getKuponById($id);
		echo json_encode($data);
	}
	
	function uploadPhotoKupon(){
		//http://localhost/ws_lindungihutan/index.php/Kupon_controller/uploadPhotoKupon
		$path = "../public/kupon/";
		$file_name = date("YmdHis")."_".htmlspecialchars($_FILES['photo']['name']);
		$target_file = $path.$file_name;		
		$id_user = $this->input->post("idUser");
		$response = array("success" => FALSE);
		
		if($id_user!=null) {
			if ($_FILES["photo"]["error"] > 0) {
				$response["success"] = FALSE;
				$response["message"] = "Upload Gagal";
			} 
			else {
				$name_file=htmlspecialchars($_FILES['photo']['name']);
				if (@getimagesize($_FILES["photo"]["tmp_name"]) !== false) {
					move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
					$this->load->model('Kupon_model');
					$data = $this->Kupon_model->insertKupon($id_user, $file_name);
					$response["success"] = TRUE;
					$response["message"] = "Upload Berhasil";
				}
				else{
					$response["success"] = FALSE;
					$response["message"] = "Upload Gagal";
				}

			echo json_encode($response);
			}
		}		
	}
	
	function deleteKupon(){
		//http://localhost/ws_lindungihutan/index.php/Kupon_controller/deleteKupon?id=id_kupon
		$path = "../public/kupon/";
		$id_kupon = $this->input->get("id");
		$this->load->model('Kupon_model');
		$image = $this->Kupon_model->getImageKupon($id_kupon);
		if(file_exists($path.$image)==true){
			$data = $this->Kupon_model->deleteKupon($id_kupon);	
			unlink($path.$image);
			$array = array('delete_kupon' => 'succeed');
		}
		else{
			$array = array('delete_kupon' => 'failed, image not found');
		}		
		echo json_encode($array);		
	}
	
}
 
?>