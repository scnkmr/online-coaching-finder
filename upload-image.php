<?php

error_reporting(0);

?>

<?php

	require 'include/conn.php';
	require	'include/config.php';
	session_start();
	
$msg = ""; 

// check if the user has clicked the button "UPLOAD" 

if (isset($_POST['uploadfile'])) {

    $filename = $_FILES["image"]["name"];

    $tempname = $_FILES["image"]["tmp_name"];  

        $folder = "image/".$filename;   

    // connect with the database

    $connection = new Scn_connection($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);  //Establishing Connection 
	
	$query_result=$connection->scn_update_record('coaching',
	'{"image_link":"'.$filename.'"}','id='.$_SESSION["client_id"]);
	

        if (move_uploaded_file($tempname, $folder)) {

            $msg = "Image uploaded successfully";
			header("Location: dashboard.php");

        }else{

            $msg = "Failed to upload image";

    }

}
echo $msg;
?>