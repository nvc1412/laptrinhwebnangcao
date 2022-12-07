<?php
	$dbHost = 'localhost';
	$dbUsername = 'root';
	$dbPassword = '';
	$dbName = 'webdogiadung';

	$conn = mysqli_connect($dbHost,$dbUsername,$dbPassword,$dbName);
	
	if($conn){
		$setLang = mysqli_query($conn, "SET NAMES 'utf8'");
	}else{
		die("Ket noi that bai!".mysqli_connect_error());
	}

?>