<?php
require "init.php";

	if($User->logoutUser()){
			$response["success"] = 1;
			$response["msg"] = "Logout success. Redirect in ";
	}else{
			$response["success"] = 0;
			$response["msg"] = "Something went wrong while logging out user.";
	}
	echo json_encode($response);

?>