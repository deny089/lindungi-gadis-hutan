<?php
class Home_model extends CI_Model {

	function getNilai() {
		$this->load->database();
		$query = $this->db->get("nilai");
		$result = $query->result();
		return $result;
	}
	
	function getTotalCampaignInProgress() {
		$this->load->database();
		$this->db->select("count(*) in_progress");
		$this->db->where("status","active");
		$this->db->where("finalized","0");
		$query = $this->db->get("campaigns");
		$row = $query->row();
		$result = $row->in_progress;
		return $result;
	}
	
	function getTotalCampaignCompleted() {
		$this->load->database();
		$this->db->select("count(*) completed");
		$this->db->where("status","active");
		$this->db->where("finalized","1");
		$query = $this->db->get("campaigns");
		$row = $query->row();
		$result = $row->completed;
		return $result;
	}
	
	function getPohonTertanam() {
		$this->load->database();
		$query = $this->db->query("select sum(a.sum_pt) pohon_tertanam from(
									select sum(donations.donation)/campaigns.hargapohon sum_pt
									from donations, campaigns
									where
									donations.campaigns_id=campaigns.id
									group by campaigns.id) a
									");
		$row = $query->row();
		$result = $row->pohon_tertanam;
		return $result;
	}
	
	function getPohonTertanamById($id) {
		$this->load->database();
		$query = $this->db->query("select sum(donations.donation)/campaigns.hargapohon pohon_tertanam
									from donations, campaigns
									where
									donations.campaigns_id=campaigns.id
									and campaigns.id=".$id."
									group by campaigns.id
									");
		$result = $query->result();
		return $result;
	}
	
	function getTotalMember() {
		$this->load->database();
		$this->db->select("count(*) member");
		$query = $this->db->get("users");
		$row = $query->row();
		$result = $row->member;
		return $result;
	}
	
	function getCampaign() {
		$this->load->database();
		$this->db->select("id, small_image, title, location, tanggal_pelaksanaan");
		$this->db->order_by("date", "desc");
		$query = $this->db->get("campaigns");
		$result = $query->result();
		return $result;
	}
	
	function getCampaignById($id) {
		$this->load->database();
		$this->db->where("id",$id);
		$query = $this->db->get("campaigns");
		$result = $query->result();
		return $result;
	}
	
	function getPantiHewan() {
		$this->load->database();
		$this->db->order_by("date", "desc");
		$query = $this->db->get("panti_hewan");
		$result = $query->result();
		return $result;
	}
	
	function getPantiHewanById($id) {
		$this->load->database();
		$this->db->where("id",$id);
		$query = $this->db->get("panti_hewan");
		$result = $query->result();
		return $result;
	}
	
	function getOlahanSampah() {
		$this->load->database();
		$this->db->order_by("date", "desc");
		$query = $this->db->get("olahan_sampah");
		$result = $query->result();
		return $result;
	}
	
	function getOlahanSampahById($id) {
		$this->load->database();
		$this->db->where("id",$id);
		$query = $this->db->get("olahan_sampah");
		$result = $query->result();
		return $result;
	}
	
	function insertCampaignDonasi($id_campaign, $name, $email, $donation, $comment, $anonymous, $transfer_bank, $telepon, $id_pembayaran) {
		$this->load->database();
		$this->db->set('campaigns_id',$id_campaign);
		$this->db->set('fullname',$name);
		$this->db->set('email',$email);
		$this->db->set('donation',$donation);
		$this->db->set('comment',$comment);
		$this->db->set('anonymous',$anonymous);
		$this->db->set('transferbank',$transfer_bank);
		$this->db->set('phone',$telepon);
		$this->db->set('id_pembayaran',$id_pembayaran);
		$this->db->insert('donations');
	}
	
	function checkCampaignGabungAksi($id_user, $id_campaign){
		$this->load->database();
		$this->db->select("id");
		$this->db->where("id_user",$id_user);
		$this->db->where("id_campaign",$id_campaign);
		$query = $this->db->get("user_campaign");
		$result = $query->result();
		return $result;
	}
	
	function insertCampaignGabungAksi($id_user, $id_campaign) {
		$this->load->database();
		$this->db->set('id_user',$id_user);
		$this->db->set('id_campaign',$id_campaign);
		$this->db->insert('user_campaign');
	}
	
	function insertPantiHewanDonasi($total, $id_user, $id_panti_hewan) {
		$this->load->database();
		$this->db->set('type',"donasi");
		$this->db->set('total',$total);
		$this->db->set('status',"menunggu pembayaran");
		$this->db->set('id_user',$id_user);
		$this->db->set('id_panti_hewan',$id_panti_hewan);
		$this->db->insert('history_panti_hewan');
	}
	
}
?>