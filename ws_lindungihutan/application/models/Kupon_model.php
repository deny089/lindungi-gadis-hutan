<?php
class Kupon_model extends CI_Model {

	function getKuponById($id_user) {
		$this->load->database();
		$this->db->where("id_user",$id_user);
		$this->db->order_by("date", "desc");
		$query = $this->db->get("kupon");
		$result = $query->result();
		return $result;
	}
	
	function insertKupon($id_user, $image) {
		$this->load->database();
		$this->db->set('image',$image);
		$this->db->set('id_user',$id_user);
		$this->db->insert('kupon');
	}
	
	function getImageKupon($id_kupon){
		$this->load->database();
		$this->db->select("image");
		$this->db->where("id",$id_kupon);
		$query = $this->db->get("kupon");
		$row = $query->row();
		$result = $row->image;
		return $result;
	}
	
	function deleteKupon($id_kupon){
		$this->load->database();
		$this->db->where("id",$id_kupon);
		$this->db->delete('kupon');
	}
	
}
?>