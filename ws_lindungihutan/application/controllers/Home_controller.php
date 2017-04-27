<?php

class Home_controller extends CI_Controller {
	function __construct(){ 
			parent::__construct();
			$this->load->model('Home_model');
		}

	function index(){}
		
	function getNilai(){
		//http://localhost/ws_lindungihutan/index.php/Home_controller/getNilai
		$this->load->model('Home_model');
		$data = $this->Home_model->getNilai();
		echo json_encode($data);
	}
	
	function getTotalCampaignInProgress(){
		//http://localhost/ws_lindungihutan/index.php/Home_controller/getTotalCampaignInProgress
		//kampanye alam dalam proses
		$this->load->model('Home_model');
		$data = $this->Home_model->getTotalCampaignInProgress();
		echo json_encode($data);
	}
	
	function getTotalCampaignCompleted(){
		//http://localhost/ws_lindungihutan/index.php/Home_controller/getTotalCampaignCompleted
		//kampanye alam terselesaikan
		$this->load->model('Home_model');
		$data = $this->Home_model->getTotalCampaignCompleted();
		echo json_encode($data);
	}
	
	function getPohonTertanam(){
		//http://localhost/ws_lindungihutan/index.php/Home_controller/getPohonTertanam
		//pohon tertanam
		$this->load->model('Home_model');
		$data = $this->Home_model->getPohonTertanam();
		echo json_encode($data);
	}
	
	function getPohonTertanamById(){
		//http://localhost/ws_lindungihutan/index.php/Home_controller/getPohonTertanamById?id=id
		//pohon tertanam
		$this->load->model('Home_model');
		$id = $this->input->get("id");
		$data = $this->Home_model->getPohonTertanamById($id);
		echo json_encode($data);
	}
	
	function getTotalMember(){
		//http://localhost/ws_lindungihutan/index.php/Home_controller/getTotalMember
		//sahabat alam
		$this->load->model('Home_model');
		$data = $this->Home_model->getTotalMember();
		echo json_encode($data);
	}
	
	function getKontribusiKita(){
		//http://localhost/ws_lindungihutan/index.php/Home_controller/getKontribusiKita
		$this->load->model('Home_model');
		$nilai = $this->Home_model->getNilai();
		$totalCampaignInProgress = $this->Home_model->getTotalCampaignInProgress();
		$totalCampaignCompleted = $this->Home_model->getTotalCampaignCompleted();
		$pohonTertanam = $this->Home_model->getPohonTertanam();
		$totalMember = $this->Home_model->getTotalMember();
		
		$i=0;
		foreach($nilai as $row){
			$sampahTerkumpul = $row->sampah_terkumpul;
			$pantiHewan = $row->panti_hewan;
			$hewanTertangani = $row->hewan_tertangani;
			$laporanAlam = $row->laporan_alam;
			$i++;
		}
		
		$array = array("sampah_terkumpul" => $sampahTerkumpul,
						"panti_hewan" => $pantiHewan,
						"hewan_tertangani" => $hewanTertangani,
						"laporan_alam" => $laporanAlam,
						"in_progress" => $totalCampaignInProgress,
						"completed" => $totalCampaignCompleted,
						"pohon_tertanam" => $pohonTertanam,
						"member" => $totalMember);
		$result[] = $array;
		
		echo json_encode($result);
	}
	
	function getCampaign(){
		//http://localhost/ws_lindungihutan/index.php/Home_controller/getCampaign
		$this->load->model('Home_model');
		$data = $this->Home_model->getCampaign();
		echo json_encode($data);
	}
	
	function getCampaignById(){
		//http://localhost/ws_lindungihutan/index.php/Home_controller/getCampaignById?id=id
		$id = $this->input->get("id");
		$this->load->model('Home_model');
		$data = $this->Home_model->getCampaignById($id);
		echo json_encode($data);
	}
	
	function getPantiHewan(){
		//http://localhost/ws_lindungihutan/index.php/Home_controller/getPantiHewan
		$this->load->model('Home_model');
		$data = $this->Home_model->getPantiHewan();
		echo json_encode($data);
	}
	
	function getPantiHewanById(){
		//http://localhost/ws_lindungihutan/index.php/Home_controller/getPantiHewanById?id=id
		$id = $this->input->get("id");
		$this->load->model('Home_model');
		$data = $this->Home_model->getPantiHewanById($id);
		echo json_encode($data);
	}
	
	function getOlahanSampah(){
		//http://localhost/ws_lindungihutan/index.php/Home_controller/getPantiHewan
		// $this->load->model('Home_model');
		// $data = $this->Home_model->getOlahanSampah();
		// echo json_encode($data);
	}
	
	function getOlahanSampahById(){
		//http://localhost/ws_lindungihutan/index.php/Home_controller/getPantiHewanById?id=id
		$id = $this->input->get("id");
		$this->load->model('Home_model');
		$data = $this->Home_model->getOlahanSampahById($id);
		echo json_encode($data);
	}
	
	function insertCampaignDonasi(){	
//	http://localhost/ws_lindungihutan/index.php/Home_controller/insertCampaignDonasi?id_campaign=id_campaign&&name=name&&email=email&&donation=donation&&comment=comment&&anonymous=anonymous&&transfer_bank=transfer_bank&&telepon=telepon&&id_pembayaran=id_pembayaran
		$id_campaign = $this->input->get("id_campaign");
		$name = $this->input->get("name");
		$email = $this->input->get("email");
		$donation = $this->input->get("donation");
		$comment = $this->input->get("comment");
		$anonymous = $this->input->get("anonymous");
		$transfer_bank = $this->input->get("transfer_bank");
		$telepon = $this->input->get("telepon");
		$id_pembayaran = $this->input->get("id_pembayaran");
		$this->load->model('Home_model');
		
		
		//generate nominal rupiah
		$jumlah_desimal ="2";
		$pemisah_desimal =",";
		$pemisah_ribuan =".";
		$nominal_donation = number_format($donation, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		
		//query get detail pembayaran
		$this->load->model('Pembayaran_model');		
		$detail_pembayaran = $this->Pembayaran_model->getPembayaranById($id_pembayaran);
		
		$i=0;
		foreach($detail_pembayaran as $row){
			$nama_pembayaran = $row->nama;
			$detail = $row->detail;
			$pemilik = $row->pemilik;
			$i++;
		}
		
		//echo $id_pembayaran." ----- ".$nama_pembayaran;
		
		//proses send email
		$from_email="admin@lindungihutan.org";
		$subject  = "Pembayaran Donasi Kampanye Alam";
		
		if($nama_pembayaran=="Bank Mandiri" || $nama_pembayaran=="Bank BNI"  || $nama_pembayaran=="Bank BCA"  || $nama_pembayaran=="Bank BRI"){
			$message  = "Terima kasih telah melakukan donasi kampanye alam.<br>
						 Nominal donasi anda adalah Rp ".$nominal_donation.". Pembayaran dilakukan melalui ".$nama_pembayaran.".<br>
						 Nomor rekening : ".$detail." a.n. ".$pemilik.".<br><br><br><br>
						 Salam,<br><br><br>
						 lindungihutan.org";	
		}
		else if($nama_pembayaran=="CIMB Clicks atau Rekening Ponsel" || $nama_pembayaran=="Penjemputan"){
			$message  = "Terima kasih telah melakukan donasi kampanye alam.<br>
						 Nominal donasi anda adalah Rp ".$nominal_donation.". Pembayaran dilakukan melalui ".$nama_pembayaran.".<br>
						 Nomor telepon : ".$detail." a.n. ".$pemilik.".<br><br><br><br>
						 Salam,<br><br><br>
						 lindungihutan.org";
		}
		else if($nama_pembayaran=="DOKU Wallet"){
			$message  = "Terima kasih telah melakukan donasi kampanye alam.<br>
						 Nominal donasi anda adalah Rp ".$nominal_donation.". Pembayaran dilakukan melalui ".$nama_pembayaran.".<br>
						 Alamat email : ".$detail." a.n. ".$pemilik.".<br><br><br><br>
						 Salam,<br><br><br>
						 lindungihutan.org";
		}
		else if($nama_pembayaran=="Paypal"){
			$message  = "Terima kasih telah melakukan donasi kampanye alam.<br>
						 Nominal donasi anda adalah Rp ".$nominal_donation.". Pembayaran dilakukan melalui ".$nama_pembayaran.".<br>
						 Alamat email : ".$detail." a.n. ".$pemilik.".<br><br><br><br>
						 Salam,<br><br><br>
						 lindungihutan.org";
		}
		
		$this->load->library('email');    
		$this->email->from($from_email, 'lindungihutan.org'); 
		$this->email->to($email);
		$this->email->subject($subject); 
		$this->email->message($message);
		
		$data = $this->Home_model->insertCampaignDonasi($id_campaign, $name, $email, $donation, $comment, $anonymous, 
														$transfer_bank, $telepon, $id_pembayaran);
			
		$array = array('insert' => 'succeed');
		echo json_encode($array);
		$this->email->send();
		
		//Send mail 
		// if($this->email->send()){ 
			// $data = $this->Home_model->insertCampaignDonasi($id_campaign, $name, $email, $donation, $comment, $anonymous, 
														// $transfer_bank, $telepon, $id_pembayaran);
			
			// $array = array('insert' => 'succeed');
			// echo json_encode($array);
		// }
		// else{
			// $array = array('insert' => 'failed, cannot send mail');
			// echo json_encode($array);
		// }
	}
	
	function insertCampaignGabungAksi(){
		//http://localhost/ws_lindungihutan/index.php/Home_controller/insertCampaignGabungAksi?id_user=id_user&&id_campaign=id_campaign
		$id_user = $this->input->get("id_user");
		$id_campaign = $this->input->get("id_campaign");
		$this->load->model('Home_model');
		$check_gabung_aksi = $this->Home_model->checkCampaignGabungAksi($id_user, $id_campaign);
		
		if($check_gabung_aksi!=null){
			$array = array('insert_gabung_aksi' => 'already joined');
		}
		else{
			$data = $this->Home_model->insertCampaignGabungAksi($id_user, $id_campaign);
			$array = array('insert_gabung_aksi' => 'succeed');
		}
		echo json_encode($array);
	}
	
	function insertPantiHewanDonasi(){
		$total = $this->input->get("total");
		$id_user = $this->input->get("id_user");
		$id_panti_hewan = $this->input->get("id_panti_hewan");
		$this->load->model('Home_model');
		$data = $this->Home_model->insertPantiHewanDonasi($total, $id_user, $id_panti_hewan);
		$array = array('insert' => 'succeed');
		echo json_encode($array);
	}
	
}
 
?>