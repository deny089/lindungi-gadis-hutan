<?php
class Pembayaran_model extends CI_Model {

	function getPembayaran() {
		$this->load->database();
		$query = $this->db->get("pembayaran");
		$result = $query->result();
		return $result;
	}

	function getIdPembayaran($nama) {
		$this->load->database();
		$this->db->select("id");
		$this->db->where("nama",$nama);
		$query = $this->db->get("pembayaran");
		$result = $query->result();
		return $result;
	}
	
	function getPembayaranByNama($nama) {
		$this->load->database();
		$this->db->where("nama",$nama);
		$query = $this->db->get("pembayaran");
		$result = $query->result();
		return $result;
	}
	
	function getPembayaranById($id){
		$this->load->database();
		$this->db->where("id",$id);
		$query = $this->db->get("pembayaran");
		$result = $query->result();
		return $result;
	}
	
}
?>