<?php
class Sampah_gunung_model extends CI_Model {

	function getSampahGunungById($id_user) {
		$this->load->database();
		$this->db->where("id_user",$id_user);
		$this->db->order_by("date", "desc");
		$query = $this->db->get("sampah_gunung");
		$result = $query->result();
		return $result;
	}
	
	function insertSampahGunung($id_user, $image, $location) {
		$this->load->database();
		$this->db->set('id_user',$id_user);
		$this->db->set('image',$image);
		$this->db->set('location',$location);
		$this->db->insert('sampah_gunung');
	}
	
	function getImageSampahGunung($id_sampah_gunung){
		$this->load->database();
		$this->db->select("image");
		$this->db->where("id",$id_sampah_gunung);
		$query = $this->db->get("sampah_gunung");
		$row = $query->row();
		$result = $row->image;
		return $result;
	}
	
	function deleteSampahGunung($id_sampah_gunung){
		$this->load->database();
		$this->db->where("id",$id_sampah_gunung);
		$this->db->delete('sampah_gunung');
	}
	
}
?>