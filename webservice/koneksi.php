<?php
	$server 	= "ftp.lindungihutan.org";
	$username 	= "lindungihutan";
	$password	= "masmon123!";
	$database 	= "lindungihutan_dua";
	
	mysql_connect($server,$username,$password) or die("Koneksi gagal");
	mysql_select_db($database) or die("Database tidak bisa dibuka");
?>