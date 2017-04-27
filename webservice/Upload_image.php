<?php
    include "koneksi.php";
	
	class emp{}
	
	$image 	= $_POST['image'];
	$name 	= $_POST['name'];
	
	if (empty($name)) { 
		$response = new emp();
		$response->success = 0;
		$response->message = "Please dont empty Name."; 
		die(json_encode($response));
	} else {
		$random = random_word(20);
		
		$path = $random.".png";
		
		// sesuiakan ip address laptop/pc atau URL server
		$actualpath = "http://lindungihutan.org/public/campaigns/small/$path";
		
		//$query = mysql_query("INSERT INTO volley_upload (photo,name) VALUES ('$actualpath','$name')");
		
		if ($query){
			file_put_contents($path,base64_decode($image));
			
			$response = new emp();
			$response->success = 1;
			$response->message = "Successfully Uploaded";
			die(json_encode($response));
		} else{ 
			$response = new emp();
			$response->success = 0;
			$response->message = "Error Upload image";
			die(json_encode($response)); 
		}
	}	
	
	// fungsi random string pada gambar utuk meghindari nama file yang sama
	function random_word($id = 20){
		$pool = '1234567890abcdefghijkmnpqrstuvwxyz';
		
		$word = '';
		for ($i = 0; $i < $id; $i++){
			$word .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
		}
		return $word; 
	}
    
 ?>