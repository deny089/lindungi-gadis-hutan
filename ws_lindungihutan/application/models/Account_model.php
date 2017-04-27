<?php
class Account_model extends CI_Model {

	function getAccountById($id) {
		$this->load->database();
		$this->db->select("id, name, email, telpon, kode_area, avatar");
		$this->db->from("users");
		$this->db->where("users.id",$id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	function getAccountById2($id) {
		$this->load->database();
		$this->db->select("users.id, users.name, users.email, users.telpon, countries.country_name, users.kode_area, users.avatar");
		$this->db->from("users");
		$this->db->join("countries","users.countries_id=countries.id");
		$this->db->where("users.id",$id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	// function getPasswordById($id, $password) {
		// $this->load->database();
		// $this->db->select("password");
		// $this->db->where("id",$id);
		// $query = $this->db->get("users");
		// $result = $query->result();
		// return $result;
	// }
	
	function checkPassword($id, $password) {
		$this->load->database();
		$query = $this->db->select('id');
		$this->db->where("id",$id);
		$this->db->where('password',md5($password));
		$query = $this->db->get("users");
		$row = $query->row();
		if(empty($row))
			$result='false';
		else{
			$id_user = $row->id;
			$result='true';
		}
		return $result;
	}
	
	function updateAccount($id, $name, $email, $telpon, $kode_area) {
		$this->load->database();
		$this->db->set('name',$name);
		$this->db->set('email',$email);
		$this->db->set('telpon',$telpon);
		$this->db->set('kode_area',$kode_area);
		$this->db->where('id',$id);
		$this->db->update('users');
	}
	
	function updateAccount2($id, $name, $email, $telpon, $countries_id, $kode_area) {
		$this->load->database();
		$this->db->set('name',$name);
		$this->db->set('email',$email);
		$this->db->set('telpon',$telpon);
		$this->db->set('countries_id',$countries_id);
		$this->db->set('kode_area',$kode_area);
		$this->db->where('id',$id);
		$this->db->update('users');
	}	
	
	function updatePassword($id, $password) {
		$this->load->database();
		$this->db->set('password',$password);
		$this->db->where('id',$id);
		$this->db->update('users');
	}
	
	function getAvatarById($id){
		$this->load->database();
		$this->db->select("avatar");
		$this->db->where("id",$id);
		$query = $this->db->get("users");
		$row = $query->row();
		$result = $row->avatar;
		return $result;
	}

	function updatePhotoUser($id, $avatar) {
		$this->load->database();
		$this->db->set('avatar',$avatar);
		$this->db->where('id',$id);
		$this->db->update('users');
	}
	
}
?>