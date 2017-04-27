<?php
class Main_model extends CI_Model {

	function getUserLogin($email, $password) {
		$this->load->database();
		$this->db->where('email',$email);
		$this->db->where('password',$password);
		$query = $this->db->get("users");
		$result = $query->result();
		return $result;
	}

	function getCountries() {
		$this->load->database();
		$query = $this->db->get("countries");
		$result = $query->result();
		return $result;
	}

	function getIdCountries($country_name) {
		$this->load->database();
		$this->db->select("id");
		$this->db->where('country_name',$country_name);
		$query = $this->db->get("countries");
		$result = $query->result();
		return $result;
	}
	
	function getCountriesById($id) {
		$this->load->database();
		$this->db->select("country_name");
		$this->db->where("id",$id);
		$query = $this->db->get("countries");
		$result = $query->result();
		return $result;
	}
	
	function checkEmail($email) {
		$this->load->database();
		$query = $this->db->select('email');
		$this->db->where('email',$email);
		$query = $this->db->get("users");
		if($query->num_rows()==0){
			return $row_email=0;
		}
		else if($query->num_rows()>0){
			return $row_email=1;
		}
	}
	
	function getUserFromFB($email) {
		$this->load->database();
		$query = $this->db->select('id, email');
		$this->db->where('email',$email);
		$query = $this->db->get("users");
		$result = $query->result();
		return $result;
	}
	
	function insertSignUp($name, $email, $telpon, $kode_area, $password) {
		$this->load->database();
		$this->db->set('name',$name);
		$this->db->set('email',$email);
		$this->db->set('telpon',$telpon);
		$this->db->set('kode_area',$kode_area);
		$this->db->set('password',$password);
		$this->db->insert('users');
	}

	function insertSignUp2($name, $email, $telpon, $countries_id, $kode_area, $password) {
		$this->load->database();
		$this->db->set('name',$name);
		$this->db->set('email',$email);
		$this->db->set('telpon',$telpon);
		$this->db->set('countries_id',$countries_id);
		$this->db->set('kode_area',$kode_area);
		$this->db->set('password',$password);
		$this->db->insert('users');
	}
	
	function updatePassword($email, $password){
		$this->db->set('password',md5($password));
		$this->db->where('email',$email);
		$this->db->update('users');
	}
 
}
?>