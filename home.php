<?php
require "init.php";

$response["Users"] = array();
if(isset($_POST["data"])){	
		$result = $User->listAllUser();
		$response["success"] = 1;
	}else if(isset($_POST["uid"])){
		$result = $User->getUserData($_POST["uid"]);
		$response["success"] = 1;
	}else{
		if(($User->getUserData())? true : false){
		$result = $User->getUserData();
		$response["success"] = 1;
		}else{
			echo "Error Code H1.";
			die();
		}
	}
	
	array_push($response["Users"], $result);
	echo json_encode($response);

?>