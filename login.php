<?php
require "init.php";
if(isset($_POST)){
	if($User->findUser($_POST["userName"],0)){
		if($User->loginUser($_POST["userName"],$_POST["password"])){
			$responce["success"] = 1;
			$responce["msg"] = "Login Success! Please wait redirecting in ";
		}else{
			$responce["success"] = 0;
			$responce["msg"] = "Error Invalid Password. Please try again.";
		}
	}else{
		$responce["success"] = 0;
		$responce["msg"] = $_POST["userName"] . " not found!. Please <a href='register.html'>register</a> and try again.";
	}
	
	echo json_encode($responce);
}
?>