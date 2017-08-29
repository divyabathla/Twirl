<?php
require "init.php";
$response = array();
if(isset($_POST["email"])){
	
	if($User->resetPassword($_POST["email"])){
		$response["success"] = 1;
		$response["msg"] = "Recovery Email is send to your email : " . $_POST["email"];
	}else{
		$response["success"] = 0;
	}
}else{
	$response["success"] = 0;
}
	echo json_encode($response);

?>