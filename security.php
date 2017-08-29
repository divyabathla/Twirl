<?php
require "init.php";

	if(Seassions::existsSession("loggedIn")){
		$response["success"] = 0;
	}else{
		$response["success"] = 1;
	}
	
	echo json_encode($response);

?>