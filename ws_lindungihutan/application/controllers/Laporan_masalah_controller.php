<?php

class Laporan_masalah_controller extends CI_Controller {
	function __construct(){ 
			parent::__construct();
			$this->load->model('Laporan_masalah_model');
			date_default_timezone_set('Asia/Jakarta');
			$this->load->helper(array('form', 'url'));
			$this->load->library('upload');
	        $this->load->library('image_lib');
		}

	function index(){}
	
	function config_image($file_name,$path){
		$config['image_library'] = 'gd2';
		$config['file_name']=$file_name;
		$config['upload_path']=$path;
		$config['allowed_types']='png|jpg|gif';
		$config['max_size']=2000;
		$config['max_height']=2000;
		$config['max_width']=2000;
		$config['overwrite']=TRUE;
		return $config;
	}

	function resize_image($data){
		$image_data=array();
		$image_data = $data;
		$configer =  array(
			'image_library'   => 'gd2',
			'source_image'    =>  $image_data['full_path'],
			'maintain_ratio'  =>  TRUE,
			'quality' 		  => '20%'
		);
		
		$this->image_lib->clear();
		$this->image_lib->initialize($configer);
		$this->image_lib->resize();

	}
	
	function getExtension($str){
		$i = strrpos($str,".");
		if (!$i) { return ""; } 
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}
	
	function compressImage($ext,$target_file,$path,$actual_image_name,$newwidth){
		if($ext=="jpg" || $ext=="jpeg" ){
			$src = imagecreatefromjpeg($target_file);
		}
		else if($ext=="png"){
			$src = imagecreatefrompng($target_file);
		}
		else if($ext=="gif"){
			$src = imagecreatefromgif($target_file);
		}
		else{
			$src = imagecreatefrombmp($target_file);
		}
																		
		list($width,$height)=getimagesize($target_file);
		$newheight=($height/$width)*$newwidth;
		$tmp=imagecreatetruecolor($newwidth,$newheight);
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
		$filename = $path.$actual_image_name;
		imagejpeg($tmp,$filename,100);
		imagedestroy($tmp);
		return $filename;
	}
	
	function insertLaporanMasalah(){
		//http://localhost/ws_lindungihutan/index.php/Laporan_masalah_controller/insertLaporanMasalah
		$title = $this->input->post("title");
		$description = $this->input->post("description");
		$location = $this->input->post("location");
		$id_user = $this->input->post("id_user");
		$anonymous = $this->input->post("anonymous");
		$latitude = $this->input->post("latitude");
		$longitude = $this->input->post("longitude");
		
		$path = "../public/laporan_masalah/";
		$file_name = htmlspecialchars($_FILES['photo']['name']);
		$mod_file_name = date("YmdHis")."_".$id_user."_".htmlspecialchars($_FILES['photo']['name']);
		$target_file = $path.$mod_file_name;
		$valid_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
		$maxsize = 1536*1024;
		$response = array("success" => FALSE);
		
		if($id_user!=null) {
			if ($_FILES["photo"]["error"] > 0) {
				$response["success"] = FALSE;
				$response["message"] = "Insert gagal, user tidak ditemukan";
			} 
			else {
				if (@getimagesize($_FILES["photo"]["tmp_name"]) !== false) {
					list($txt, $extension) = explode(".", $file_name);
					$extension = strtolower($this->getExtension($file_name));
					
					if(in_array($extension,$valid_formats)){
						if($_FILES['photo']['size']<=$maxsize){
							move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
							$widthArray = 500;
							$this->compressImage($extension,$target_file,$path,$mod_file_name,$widthArray);
							$this->load->model('Laporan_masalah_model');
							$data = $this->Laporan_masalah_model->insertLaporanMasalah($title, $description, $location, $mod_file_name,
																				$id_user, $anonymous, $latitude, $longitude);
							$response["success"] = TRUE;
							$response["message"] = "Pembuatan laporan masalah alam berhasil dan akan diverifikasi";
						}
						else{
							$response["success"] = FALSE;
							$response["message"] = "Upload gagal, file harus kurang dari 1.5 MB";
						}
					}
					else{
						$response["success"] = FALSE;
						$response["message"] = "Format gambar salah";
					}					
				}
				else{
					$response["success"] = FALSE;
					$response["message"] = "Pembuatan laporan masalah alam gagal";
				}

			echo json_encode($response);
			}
		}	
		
	}
	
	function insertLaporanMasalah_bck(){
		//http://localhost/ws_lindungihutan/index.php/Laporan_masalah_controller/insertLaporanMasalah
		$title = $this->input->post("title");
		$description = $this->input->post("description");
		$location = $this->input->post("location");
		$id_user = $this->input->post("id_user");
		$anonymous = $this->input->post("anonymous");
		$latitude = $this->input->post("latitude");
		$longitude = $this->input->post("longitude");
		
		$path = "../public/laporan_masalah/";
		$file_name = htmlspecialchars($_FILES['photo']['name']);
		$mod_file_name = date("YmdHis")."_".$id_user."_".htmlspecialchars($_FILES['photo']['name']);
		$target_file = $path.$file_name;
		
		$response = array("success" => FALSE);
		
		if($id_user!=null) {
			if ($_FILES["photo"]["error"] > 0) {
				$response["success"] = FALSE;
				$response["message"] = "Insert gagal, user tidak ditemukan";
			} 
			else {
				if (@getimagesize($_FILES["photo"]["tmp_name"]) !== false) {
					$config=$this->config_image($file_name, $path);
					$this->upload->initialize($config);
					$this->upload->do_upload('photo');
					if(!$this->upload->do_upload('photo')){
						$response["success"] = FALSE;
						$response["message"] = "Upload Gagal";
						echo json_encode($response);
						exit();
					}
					$this->resize_image($this->upload->data());	
					
					// move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
					$this->load->model('Laporan_masalah_model');
					$data = $this->Laporan_masalah_model->insertLaporanMasalah($title, $description, $location, $mod_file_name,
																				$id_user, $anonymous, $latitude, $longitude);
					$response["success"] = TRUE;
					$response["message"] = "Insert Berhasil";
				}
				else{
					$response["success"] = FALSE;
					$response["message"] = "Insert Gagal";
				}

			echo json_encode($response);
			}
		}	
		
	}
	
	function getLaporanMasalah(){
		//http://localhost/ws_lindungihutan/index.php/Laporan_masalah_controller/getLaporanMasalah
		$this->load->model('Laporan_masalah_model');
		$data = $this->Laporan_masalah_model->getLaporanMasalah();
		echo json_encode($data);
	}
	
	function getLaporanMasalahById(){
		//http://localhost/ws_lindungihutan/index.php/Laporan_masalah_controller/getLaporanMasalahById?id=id
		$id = $this->input->get("id");
		$this->load->model('Laporan_masalah_model');
		$data = $this->Laporan_masalah_model->getLaporanMasalahById($id);
		echo json_encode($data);
	}
	
	function updateLaporanMasalah(){
		//http://localhost/ws_lindungihutan/index.php/Laporan_masalah_controller/updateLaporanMasalah
		$id = $this->input->get("id");
		$title = $this->input->get("title");
		$description = $this->input->get("description");
		$location = $this->input->get("location");
		$image = $this->input->get("image");
		$anonymous = $this->input->get("anonymous");
		$latitude = $this->input->get("latitude");
		$longitude = $this->input->get("longitude");
		$this->load->model('Laporan_masalah_model');
		$data = $this->Laporan_masalah_model->updateLaporanMasalah($id, $title, $description, $location, $image, $anonymous, $latitude, $longitude);
		$array = array('update' => 'succeed');
		echo json_encode($array);
	}
	
	function deleteLaporanMasalah(){
		//http://localhost/ws_lindungihutan/index.php/Laporan_masalah_controller/deleteLaporanMasalah?id=id
		$id = $this->input->get("id");
		$data = $this->Laporan_masalah_model->deleteLaporanMasalah($id);
		$array = array('delete' => 'succeed');
		echo json_encode($array);
	}
	
}
 
?>