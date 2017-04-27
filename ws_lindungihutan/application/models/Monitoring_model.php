<?php
class Monitoring_model extends CI_Model {
	
	function getPohonTertanamById($id) {
		$this->load->database();
		$query = $this->db->query("select sum(a.sum_pt) pohon_tertanam from(
									select sum(donations.donation)/campaigns.hargapohon sum_pt
									from donations, campaigns
									where
									donations.campaigns_id=campaigns.id
									group by campaigns.id) a
									");
		$result = $query->result();
		return $result;
	}
	
	function getPohonById($id) {
		$this->load->database();
		$this->db->where("id_pohon",$id);
		$query = $this->db->get("pohon");
		$result = $query->result();
		return $result;
	}
}
?>