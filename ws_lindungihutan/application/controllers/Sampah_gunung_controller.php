<?php

class Sampah_gunung_controller extends CI_Controller {
	function __construct(){ 
			parent::__construct();
			$this->load->model('Sampah_gunung_model');
			date_default_timezone_set('Asia/Jakarta');
			$this->load->helper(array('form', 'url'));
			$this->load->library('upload');
	        $this->load->library('image_lib');
		}

	function index(){}
	
	function getSampahGunungById(){
		//http://localhost/ws_lindungihutan/index.php/Sampah_gunung_controller/getSampahGunungById?id=id
		$id = $this->input->get("id");
		$this->load->model('Sampah_gunung_model');
		$data = $this->Sampah_gunung_model->getSampahGunungById($id);
		echo json_encode($data);
	}
	
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
	
	function uploadPhotoSampahGunung(){
		//http://localhost/ws_lindungihutan/index.php/Sampah_gunung_controller/uploadPhotoSampahGunung		
		$id_user = $this->input->post("idUser");
		$location = $this->input->post("location");
		$path = "../public/sampah_gunung/";
		$file_name = htmlspecialchars($_FILES['photo']['name']);
		$mod_file_name = date("YmdHis")."_".$id_user."_".htmlspecialchars($_FILES['photo']['name']);		
		$target_file = $path.$mod_file_name;		
		$valid_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
		$maxsize = 1536*1024;
		$response = array("success" => FALSE);
		
		if($id_user!=null) {
			if ($_FILES["photo"]["error"] > 0) {
				$response["success"] = FALSE;
				$response["message"] = "Upload gagal, user tidak ditemukan";
			} 
			else {
				// $name_file=htmlspecialchars($_FILES['photo']['name']);
				if (@getimagesize($_FILES["photo"]["tmp_name"]) !== false) {
					list($txt, $extension) = explode(".", $file_name);
					$extension = strtolower($this->getExtension($file_name));
					
					if(in_array($extension,$valid_formats)){
						if($_FILES['photo']['size']<=$maxsize){
							move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
							$widthArray = 500;
							$this->compressImage($extension,$target_file,$path,$mod_file_name,$widthArray);
							$this->load->model('Sampah_gunung_model');
							$data = $this->Sampah_gunung_model->insertSampahGunung($id_user, $mod_file_name, $location);
							$response["success"] = TRUE;
							$response["message"] = "Upload sampah gunung berhasil";
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
					$response["message"] = "Insert data gagal, file tidak ada";
				}

			echo json_encode($response);
			}
		}		
	}
	
	function deleteSampahGunung(){
		//http://localhost/ws_lindungihutan/index.php/Sampah_gunung_controller/deleteSampahGunung?id=id_sampah_gunung
		$path = "../public/sampah_gunung/";
		$id_sampah_gunung = $this->input->get("id");
		$this->load->model('Sampah_gunung_model');
		$image = $this->Sampah_gunung_model->getImageSampahGunung($id_sampah_gunung);
		if(file_exists($path.$image)==true){
			$data = $this->Sampah_gunung_model->deleteSampahGunung($id_sampah_gunung);	
			unlink($path.$image);
			$array = array('delete' => 'succeed');
		}
		else{
			$array = array('delete' => 'failed, image not found');
		}		
		echo json_encode($array);		
	}
	
}
 
?>