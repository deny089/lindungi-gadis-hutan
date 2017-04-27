<?php
class TukarSampah_controller extends CI_Controller {
	function __construct(){ 
			parent::__construct();
			$this->load->model('Home_model');
		}

	function index(){}
	
	function uploadKupon(){
        if($this->input->post('image')){
            
            //Check whether user upload picture
            if(!empty($_FILES['picture']['name'])){
                $config['upload_path'] = 'http://lindungihutan.org/public/kupon/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['picture']['name'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('picture')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                    $array = array('insert' => 'succeed');
		    echo json_encode($array);
			
                }else{
                    $picture = '';
                    $array = array('insert' => 'failed 1');
		    echo json_encode($array);
                }
            }else{
                $picture = '';
		$array = array('insert' => 'failed 2');
		echo json_encode($array);
            }
            
         
        }
        
    }
}
?>