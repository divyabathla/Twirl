<?php
require "init.php";
if(isset($_POST)){
	if($User->findUser($_POST["userName"])){
		$responce["success"] = 0;
		$responce["msg"] = "User with username(".$_POST["userName"].") already exist. Please Try again.";
	}else{
		$registerData = array(
		"username" => $_POST["userName"],
		"name" => $_POST["name"],
		"email" => $_POST["email"],
		"password" => $_POST["password"],
		"tw_name" => $_POST["tw_name"],
		);
		if($User->registerUser($registerData)){
			$responce["success"] = 1;
			$responce["msg"] = $_POST["userName"] . " added success!";
		}else{
			$responce["success"] = 0;
			$responce["msg"] = "Error Code 'R1' Occur.";
		}
	}
	
	echo json_encode($responce);
}
?>