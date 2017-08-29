<?php
class User{
	
	var $db,$_query,$_data;
	
	function __construct($dbConnection){
		$this->db = $dbConnection;
		$this->createTable();
		$this->checkUser();
	}
	
	private function createTable(){
		try{
			$query = "CREATE TABLE IF NOT EXISTS user( ".
					   "id INT NOT NULL AUTO_INCREMENT, ".
					   "username VARCHAR(100) NOT NULL, ".
					   "name VARCHAR(40) NOT NULL, ".
					   "email VARCHAR(100) NOT NULL, ".
					   "password VARCHAR(100) NOT NULL, ".
					   "tw_name VARCHAR(140), ".
					   "PRIMARY KEY ( id )); ";
			$createTable = $this->db->prepare($query);
			if($createTable->execute()){
				//Logger::consoleLog("User table created.");
			}else{
				//Logger::consoleLog("User table already exist.");
			}
		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}
	
	private function attachValues($sqlQuery, $params = array()) {
		if ($this->_query = $this->db->prepare($sqlQuery)) {
			$binder = 1;
			if (count($params)) {
				foreach ($params as $para){
					$this->_query->bindValue($binder, $para);
					$binder++;
				}
			}
			if ($this->_query->execute()) {
				
				return true;
			} else {
				return false;
			}
		}
		return $this;
	}
	
	public function checkUser($user = null){
		if(!$user){
			if((@Seassions::getDataFromSession("username")) ? true : false){
				$user = Seassions::getDataFromSession("username");
				if(!$this->findUser($user)){
					$this->logoutUser();
				}
			}
		}
	}
	
	public function findUser($user){
		if($user){
			try{
				$getUserData = $this->db->prepare("select * from user where username = :username");
				$getUserData->execute(array(":username" => $user));
				$this->_data = $getUserData->fetchAll(PDO::FETCH_OBJ);
				if($this->_data){
					return true;
				}
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
		}
		return false;
	}
	
	
	public function registerUser($data = array()){
		if (count($data)) {
			$keys   = array_keys($data);
			$values = '';
			$binder = 1;
			foreach ($data as $field) {
				$values .= '?';
				if ($binder < count($data)) {
					$values .= ', ';
				}
				$binder++;
			}
			$sqlQuery = "insert into `user` (`" . implode('`, `', $keys) . "`) VALUES ({$values})";
			if ($this->attachValues($sqlQuery, $data) != false) {
				return true;
			}
		}
		return false;
	}
	
	public function getUserData($user = null){
		if($user){
			if(is_numeric($user)){
				try{
					$getUserData = $this->db->prepare("select * from user where id = :id");
					$getUserData->execute(array(":id" => $user));
					$data = $getUserData->fetchAll(PDO::FETCH_OBJ);
					if($data){
						return $data[0];
					}
				}
				catch(Exception $e){
					echo $e->getMessage();
				}
			}else{
				try{
					$getUserData = $this->db->prepare("select * from user where username = :username");
					$getUserData->execute(array(":username" => $user));
					$data = $getUserData->fetchAll(PDO::FETCH_OBJ);
					if($data){
						return $data[0];
					}
				}
				catch(Exception $e){
					echo $e->getMessage();
				}
			}
		}
		return $this->_data[0];
	}
	
	public function loginUser($username,$password){
		if($username && $password){
			$databasePassword = $this->getUserData()->password;
			if($password != $databasePassword){
				return false;
			}else {
				Seassions::insertDataInSession("username",$username);
				Seassions::insertDataInSession("uid",$this->getUserData()->id);
				Seassions::insertDataInSession("tw_name",$this->getUserData()->tw_name);
				Seassions::insertDataInSession("loggedIn",true);
				return true;
			}
		}
	}

	public function logoutUser(){
		Seassions::delDataFromSession("username");
		Seassions::delDataFromSession("uid");
		Seassions::delDataFromSession("loggedIn");
		return true;
	}
	
	public function listAllUser(){
		$allUsers = $this->db->prepare("SELECT * FROM user");
		$allUsers->execute();
		
		$result = $allUsers->fetchAll(PDO::FETCH_OBJ);
		
		return $result;
	}
	
	
	public function resetPassword($email){
		try{
				$getUserData = $this->db->prepare("select * from user where email = :email");
				$getUserData->execute(array(":email" => $email));
				$data = $getUserData->fetchAll(PDO::FETCH_OBJ);
				if($data){
					//sendMail
					return true;
					}
				}
				catch(Exception $e){
					//echo $e->getMessage();
					return false;
				}
			return false;
	}
}
?>