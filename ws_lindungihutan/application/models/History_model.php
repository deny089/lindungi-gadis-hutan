<?php

date_default_timezone_set('Asia/Jakarta');
class History_model extends CI_Model {
	
	function getHistoryCampaign() {
		$this->load->database();
		$query = $this->db->query("select h.id, c.title, c.location, c.goal, c.tanggal_pelaksanaan, 
									h.type, h.total, h.status 
									from history_campaign h, users u, campaigns c
									where h.id_user=u.id
									and h.id_campaign=c.id
									order by h.date desc");
		$result = $query->result();
		return $result;
	}
	
	function getHistoryCampaignById($id_user) {
		$this->load->database();
		$query = $this->db->query("select uc.id, c.title, c.location, c.tanggal_pelaksanaan
									from user_campaign uc, users u, campaigns c
									where uc.id_user=u.id
									and uc.id_campaign=c.id
									and u.id='".$id_user."'
									order by uc.id desc");
		$result = $query->result();
		return $result;
	}
	
	function updateStatusHistoryCampaign($id){
		$now = date("Y-m-d H:i:s");
		$this->load->database();
		$this->db->set('status','sudah konfirmasi');
		$this->db->set('date_update',$now);
		$this->db->where('id',$id);
		$this->db->update('history_campaign');
	}
	
	function getHistoryPantiHewan() {
		$this->load->database();
		$query = $this->db->query("select h.id, p.name, p.location, h.type, h.total, h.status 
									from history_panti_hewan h, users u, panti_hewan p
									where h.id_user=u.id
									and h.id_panti_hewan=p.id
									order by h.date desc");
		$result = $query->result();
		return $result;
	}
	
	function getHistoryPantiHewanById($id) {
		$this->load->database();
		$query = $this->db->query("select h.id, p.name, p.location, h.type, h.total, h.status 
									from history_panti_hewan h, users u, panti_hewan p
									where h.id_user=u.id
									and h.id_panti_hewan=p.id
									and h.id='".$id."'");
									
		$result = $query->result();
		return $result;
	}
	
	function updateStatusHistoryPantiHewan($id){
		$now = date("Y-m-d H:i:s");
		$this->load->database();
		$this->db->set('status','sudah konfirmasi');
		$this->db->set('date_update',$now);
		$this->db->where('id',$id);
		$this->db->update('history_panti_hewan');
	}
	
}
?>