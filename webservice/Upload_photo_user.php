<?php

date_default_timezone_set('Asia/Jakarta');

$path = "../public/avatar/";
$file_name = date("YmdHis")."_".htmlspecialchars($_FILES['photo']['name']);
$target_file = $path.$file_name;
$id_user = htmlspecialchars($_POST['idUser']);
$response = array("success" => FALSE);

if($id_user!=null) {
	if ($_FILES["photo"]["error"] > 0) {
		$response["success"] = FALSE;
		$response["message"] = "Upload Failed";
    } 
	else {
		$name_file=htmlspecialchars($_FILES['photo']['name']);
		if (@getimagesize($_FILES["photo"]["tmp_name"]) !== false) {
			move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
			$response["success"] = TRUE;
			$response["message"] = "Upload Successfull";
		}
		else{
			$response["success"] = FALSE;
			$response["message"] = "Upload Failed";
		}

	echo json_encode($response);
	}
}
 
?>