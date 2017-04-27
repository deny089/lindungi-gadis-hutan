<?php

class Main_controller extends CI_Controller {
	function __construct(){ 
			parent::__construct();
			$this->load->model('Main_model');
			//$this->load->library('email');
		}

	function index(){}
	
	function getUserLogin(){
		//http://localhost/ws_lindungihutan/index.php/Main_controller/getUserLogin?email=email&&password=password
		$email = $this->input->get("email");
		$password = $this->input->get("password");
		$this->load->model('Main_model');
		$data = $this->Main_model->getUserLogin($email, md5($password));
		echo json_encode($data);
	}
	
	function getUserFromFb(){
		//http://localhost/ws_lindungihutan/index.php/Main_controller/getUserFromFb?email=email
		$email = $this->input->get("email");
		$this->load->model('Main_model');
		$data = $this->Main_model->getUserFromFb($email);
		echo json_encode($data);
	}
	
	function checkEmail(){
		//http://localhost/ws_lindungihutan/index.php/Main_controller/checkEmail?email=email
		$email = $this->input->get("email");
		$this->load->model('Main_model');
		$result = $this->Main_model->checkEmail($email);
		if($result==1){
			$array = array('email' => 'found');
			echo json_encode($array);
		}
		else if($result==0){
			$array = array('email' => 'empty');
			echo json_encode($array);
		}
	}
	
	function getCountries(){
		$this->load->model('Main_model');
		$data = $this->Main_model->getCountries();
		echo json_encode($data);
	}
	
	function getCountriesById(){
		$id = $this->input->get("id");
		$this->load->model('Main_model');
		$data = $this->Main_model->getCountriesById($id);
		echo json_encode($data);
	}
	
	function getIdCountries(){
		$country_name = $this->input->get("country_name");
		$this->load->model('Main_model');
		$data = $this->Main_model->getIdCountries($country_name);
		echo json_encode($data);
	}
	
	function insertSignUp(){
		//http://localhost/ws_lindungihutan/index.php/Main_controller/insertSignUp?name=name&&email=email&&telpon=telpon&&kode_area=kode_area&&password=password
		$name = $this->input->get("name");
		$email = $this->input->get("email");
		$telpon = $this->input->get("telpon");
		$kode_area = $this->input->get("kode_area");
		$password = $this->input->get("password");
		$this->load->model('Main_model');
		$data1 = $this->Main_model->checkEmail($email);
		if($data1==0){
			$data2 = $this->Main_model->insertSignUp($name,$email,$telpon,$kode_area,md5($password));
			$array = array('insert' => 'succeed');
			echo json_encode($array);
		}
		else if($data1>0){
			$array = array('insert' => 'duplicate email');
			echo json_encode($array);
		}		
	}
		
	function forgetPasswordBck(){
		$email = $this->input->get("email");
		//membuat password baru
		$digit = 10;
		$karakter = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789";

		srand((double)microtime()*1000000);
		$i = 0;
		$pass = "";
		while ($i <= $digit-1){
			$num = rand() % 32;
			$tmp = substr($karakter,$num,1);
			$pass = $pass.$tmp;
			$i++;
		}
		$newPassword = $pass;
		//echo $newPassword;
		
		//check email
		$this->load->model('Main_model');
		$data1 = $this->Main_model->checkEmail($email);
		if($data1>0){
			// title atau subject email
			$title  = "New Password";

			// isi pesan email disertai password
			$message  = "Password Anda yang baru adalah: ".$newPassword;

			// header email berisi alamat pengirim
			$header = "From: lindungihutan.org";

			// mengirim email
			$sendEmail = mail($email, $title, $message, $header);

			// cek status pengiriman email
			if ($sendEmail) {
				// update password baru ke database (jika pengiriman email sukses)
				// $data2 = $this->Main_model->updatePassword($email,$newPassword);
				$array = array('reset_password' => 'succeed');
				echo json_encode($array);
			}
			else{
				$array = array('reset_password' => 'send email failed');
				echo json_encode($array);
			}			
		}
		else if($data1==0){
			$array = array('reset_password' => 'email not found');
			echo json_encode($array);
		}
	}
	
	function forgetPassword(){
		$this->load->library('email');
		$email = $this->input->get("email");
		//membuat password baru
		$digit = 10;
		$karakter = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789";

		srand((double)microtime()*1000000);
		$i = 0;
		$pass = "";
		while ($i <= $digit-1){
			$num = rand() % 32;
			$tmp = substr($karakter,$num,1);
			$pass = $pass.$tmp;
			$i++;
		}
		$new_password = $pass;
		//echo $newPassword;
		
		//check email
		$this->load->model('Main_model');
		$data1 = $this->Main_model->checkEmail($email);
		if($data1>0){
			$from_email="admin@lindungihutan.org";
			$subject  = "Reset Password Account lindungihutan.org";

			// isi pesan email disertai password
			$message  = "Anda telah melakukan permintaan untuk reset password.<br>
							Password anda yang baru adalah: ".$new_password.".<br><br><br><br>
							lindungihutan.org";			

			$this->load->library('email');    
			$this->email->from($from_email, 'lindungihutan.org'); 
			$this->email->to($email);
			$this->email->subject($subject); 
			$this->email->message($message); 

			//Send mail 
			if($this->email->send()){ 
				// update password baru ke database (jika pengiriman email sukses)
				$data2 = $this->Main_model->updatePassword($email,$new_password);
				$array = array('reset_password' => 'succeed');
				echo json_encode($array);
			}
			else{
				$array = array('reset_password' => 'send email failed');
				echo json_encode($array);
			}

			
		}
		else if($data1==0){
			$array = array('reset_password' => 'email not found');
			echo json_encode($array);
		}
	}
}
 
?>