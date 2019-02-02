<?php
include_once('class.database.php');

class ManageUsers {

	protected $link;
	
	function __construct(){
		$db_conn = new ManageDatabase;
		$this->link = $db_conn->connect();
		return $this->link;
	}

	function addUsers($username,$password,$first,$last,$email,$userlevel){
		$query = $this->link->prepare("
			INSERT INTO users (username,password,first,last,email,userlevel)
			VALUES (?,?,?,?,?,?)"
		);
		$valueArr = array($username,$password,$first,$last,$email,$userlevel);
		$query->execute($valueArr);
		$rowCount = $query->rowCount();
		return $rowCount;
	}

	function listUsers($param = null){
		if(isset($param)){
			foreach($param as $key => $value){
				$query = $this->link->query("SELECT * FROM users WHERE $key='$value' ORDER BY last ASC ");
			}
		}else{
			$query = $this->link->query("SELECT * FROM users WHERE userlevel!='admin' ORDER BY last ASC ");
		}
		$rowCount = $query->rowCount();
		if($rowCount >= 1){
			$result = $query->fetchAll(PDO::FETCH_ASSOC); //if want 
		}else{
			$result = 0;
		}
		return $result;
	}
	
	function editUsers($userid, $param){
		foreach($param as $key => $value){
			$query = $this->link->query("UPDATE users SET $key = '$value' WHERE userid='$userid'");
		}
		$rowCount = $query->rowCount();
		return $rowCount;
	}
	
	function deletUsers($userid){
		$query = $this->link->query("DELETE FROM users WHERE userid='$userid' LIMIT 1");
		$rowCount = $query->rowCount();
		return $rowCount;
	}

	function loginUsers($username,$password){
		$query = $this->link->query("SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1");
		$rowCount = $query->rowCount();
		return $rowCount;
	}
	
}

?>