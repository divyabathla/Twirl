<?php
session_start();

	$serverName = "localhost";
	$username = "admin_tw";
	$password = "GlD25TEWZW";
try{
	
	spl_autoload_register(function($class){
		include "classes/" .$class . ".php";
	});
	
	$conn = new PDO("mysql:host=$serverName;dbname=admin_tw",$username,$password);
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
	//Class Objects.
	$User = new User($conn);
}
catch(Exception $e){
	die($e->getMessage());
}

?>