<?php
		include 'include/header.php';
		require 'include/conn.php';
		require	'include/config.php';
		
		if(!isset($_GET["si"])){
			die("Bad Access!!! Be Careful");
		}
	
	$connection = new Scn_connection($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);  //Establishing Connection
		$temp = $connection->scn_delete_record("student","id=".$_GET['si']); //be carefule in 2nd parameter 
	if($temp->error){
		print_r($temp);
	}
	else{
		header("Location: dashboard.php");
	}
?>
    