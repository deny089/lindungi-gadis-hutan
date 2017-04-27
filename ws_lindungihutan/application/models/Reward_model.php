<?php
class Reward_model extends CI_Model {

	function getReward() {
		$this->load->database();
		$this->db->where("status","active");
		$this->db->order_by("date", "desc");
		$query = $this->db->get("reward");
		$result = $query->result();
		return $result;
	}
	
}
?>