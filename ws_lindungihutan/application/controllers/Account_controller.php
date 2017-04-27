<?php

class Account_controller extends CI_Controller {
	function __construct(){ 
			parent::__construct();
			$this->load->model('Account_model');
			date_default_timezone_set('Asia/Jakarta');
			$this->load->helper(array('form', 'url'));
			$this->load->library('upload');
	        $this->load->library('image_lib');
		}

	function index(){}
	
	function getAccountById(){
		//http://localhost/ws_lindungihutan/index.php/Account_controller/getAccountById?id=id
		$path = "../public/avatar/";
		$id = $this->input->get("id");
		$this->load->model('Account_model');
		$data = $this->Account_model->getAccountById($id);
		$i=0;
		foreach($data as $row){
			$id = $row->id;
			$name = $row->name;
			$email = $row->email;
			$telpon = $row->telpon;
			$kode_area = $row->kode_area;
			$avatar = $row->avatar;			
			$i++;
		}
		
		if(@getimagesize($path.$avatar) != true){
			$avatar = 'default_android.png';
		}		
		
		$array = array("id" => $id,
						"name" => $name,
						"email" => $email,
						"telpon" => $telpon,
						"kode_area" => $kode_area,
						"avatar" => $avatar);
		$result[] = $array;
		
		echo json_encode($result);
	}
	
	// function getPasswordById(){
		//http://localhost/ws_lindungihutan/index.php/Account_controller/getPasswordById?id=id&&password=password
		// $id = $this->input->get("id");
		// $password = $this->input->get("password");
		// $this->load->model('Account_model');
		// $data = $this->Account_model->getPasswordById($id, md5($password));
		// echo json_encode($data);
	// }
	
	function checkPassword(){
		//http://localhost/ws_lindungihutan/index.php/Account_controller/checkPassword?id=id_user&&password=password
		$id = $this->input->get("id");
		$password = $this->input->get("password");
		$this->load->model('Account_model');
		$result = $this->Account_model->checkPassword($id, $password);
		$array = array('password' => $result);
		echo json_encode($array);
	}
	
	function updateAccount(){
		//http://localhost/ws_lindungihutan/index.php/Account_controller/updateAccount?id=id&&name=name&&email=email&&telpon=telpon&&kode_area=kode_area
		$id = $this->input->get("id");
		$name = $this->input->get("name");
		$email = $this->input->get("email");
		$telpon = $this->input->get("telpon");
		$kode_area = $this->input->get("kode_area");
		$this->load->model('Account_model');
		$data = $this->Account_model->updateAccount($id, $name, $email, $telpon, $kode_area);
		$array = array('update' => 'succeed');
		echo json_encode($array);
	}
	
	function updatePassword(){
		//http://localhost/ws_lindungihutan/index.php/Account_controller/updatePassword?id=id&&password=password
		$id = $this->input->get("id");
		$password = $this->input->get("password");
		$this->load->model('Account_model');
		$data = $this->Account_model->updatePassword($id, md5($password));
		$array = array('update' => 'succeed');
		echo json_encode($array);
	}
	
	function getAvatarById(){
		$id = $this->input->get("id");
		$this->load->model('Account_model');
		$avatar = $this->Account_model->getAvatarById($id);
		echo $avatar;
		
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
			'width'           =>  400,
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
	
	function updatePhotoUser(){	
		//http://localhost/ws_lindungihutan/index.php/Account_controller/updatePhotoUser
		$id_user = $this->input->post("idUser");
		$path = "../public/avatar/";
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
							$this->load->model('Account_model');
							$avatar = $this->Account_model->getAvatarById($id_user);
							if(@getimagesize($path.$avatar) == true){
								unlink($path.$avatar);
							}							
							$data = $this->Account_model->updatePhotoUser($id_user, $mod_file_name);
							$response["success"] = TRUE;
							$response["message"] = "Upload berhasil";
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
	
	function updatePhotoUser_bck(){	
		//http://localhost/ws_lindungihutan/index.php/Account_controller/updatePhotoUser
		$id_user = $this->input->post("idUser");
		$path = "../public/avatar/";
		$file_name = date("YmdHis")."_".$id_user."_".htmlspecialchars($_FILES['photo']['name']);
		$target_file = $path.$file_name;		
		
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
							$config=$this->config_image($file_name, $path);
							$this->upload->initialize($config);
							$this->upload->do_upload('photo');
							
							if(!$this->upload->do_upload('photo')){
								$response["success"] = FALSE;
								$response["message"] = "Upload foto gagal";
								echo json_encode($response);
								exit();
							}
							$this->resize_image($this->upload->data());				
				
							// move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
							$this->load->model('Account_model');
							$avatar = $this->Account_model->getAvatarById($id_user);
							unlink($path.$avatar);
							$data = $this->Account_model->updatePhotoUser($id_user, $file_name);
							$response["success"] = TRUE;
							$response["message"] = "Upload berhasil";
						}
						else{
							$response["success"] = FALSE;
							$response["message"] = "Upload gagal, file harus kurang dari 1,5 MB";
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
	
	function updatePhotoUserTest(){
		//http://localhost/ws_lindungihutan/index.php/Account_controller/updatePhotoUser
		$path = "../public/avatar/";
		$file_name = date("YmdHis")."_".htmlspecialchars($_FILES['photo']['name']);
		$image_size = $_FILES['fileUpload']['size'];
		$image_width = $image_size[0];
		$image_height = $image_size[1];
		$target_file = $path.$file_name;		
		$id_user = $this->input->post("idUser");
		$response = array("success" => FALSE);
		
		if($id_user!=null) {
			if ($_FILES["photo"]["error"] > 0) {
				$response["success"] = FALSE;
				$response["message"] = "Upload Gagal";
			} 
			else {
				// $name_file=htmlspecialchars($_FILES['photo']['name']);
				if (@getimagesize($_FILES["photo"]["tmp_name"]) !== false) {
					
				
				
					move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
					$this->load->model('Account_model');
					$avatar = $this->Account_model->getAvatarById($id_user);
					unlink($path.$avatar);
					$data = $this->Account_model->updatePhotoUser($id_user, $file_name);
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
	
}
 
?>