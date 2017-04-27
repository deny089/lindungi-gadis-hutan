<?php

date_default_timezone_set('Asia/Jakarta');
class Laporan_masalah_model extends CI_Model {

	function insertLaporanMasalah($title, $description, $location, $image, $id_user, $anonymous, $latitude, $longitude) {
		$this->load->database();
		$this->db->set('title',$title);
		$this->db->set('description',$description);
		$this->db->set('location',$location);
		$this->db->set('image',$image);
		$this->db->set('id_user',$id_user);
		$this->db->set('anonymous',$anonymous);
		$this->db->set('latitude',$latitude);
		$this->db->set('longitude',$longitude);
		$this->db->set('id_status_laporan',1);
		$this->db->insert('laporan_masalah');
	}
	
	function getLaporanMasalah() {
		$this->load->database();
		$query = $this->db->query("select lm.id, lm.title, lm.description, lm.location, 
									lm.date, lm.date_update, lm.image, lm.id_user, lm.anonymous, 
									lm.latitude, lm.longitude, slm.status, u.name
									from laporan_masalah lm, status_laporan_masalah slm, users u
									where lm.id_status_laporan=slm.id
									and lm.id_user=u.id
									and slm.status not in('belum diverifikasi')
									order by lm.id desc");
		$result = $query->result();
		return $result;
	}
	
	function getLaporanMasalahById($id) {
		$this->load->database();
		$query = $this->db->query("select lm.id, lm.title, lm.description, lm.location, 
									lm.date, lm.date_update, lm.image, lm.id_user, lm.anonymous, 
									lm.latitude, lm.longitude, lm.id_status_laporan, slm.status, u.name
									from laporan_masalah lm, status_laporan_masalah slm, users u
									where lm.id_status_laporan=slm.id
									and lm.id_user=u.id
									and lm.id='".$id."'");
		$result = $query->result();
		return $result;
	}
	
	function getImageLaporanMasalah($id){
		$this->load->database();
		$this->db->select("image");
		$this->db->where("id",$id);
		$query = $this->db->get("kupon");
		$row = $query->row();
		$result = $row->image;
		return $result;
	}
	
	function updateLaporanMasalah($id, $title, $description, $location, $image, $anonymous, $latitude, $longitude){
		$now = date("Y-m-d H:i:s");
		$this->load->database();
		$this->db->set('title',$title);
		$this->db->set('description',$description);
		$this->db->set('location',$location);
		$this->db->set('image',$image);
		$this->db->set('anonymous',$anonymous);
		$this->db->set('latitude',$latitude);
		$this->db->set('longitude',$longitude);
		$this->db->set('date_update',$now);
		$this->db->where('id',$id);
		$this->db->update('laporan_masalah');
	}
	
	function deleteLaporanMasalah($id){
		$this->load->database();
		$this->db->where("id",$id);
		$this->db->delete('laporan_masalah');
	}
	
}
?>