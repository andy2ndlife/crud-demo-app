<?php
	//AJAX login
	session_start();
	if($_POST){
		include_once('../core/class.manageUsers.php');
		$init = new ManageUsers;
		
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$login = $init->loginUsers($username,$password);
		if($login){
			$param = array("username" => $username);
			$userInfo = $init->listUsers($param);
			foreach($userInfo as $value){
				$_SESSION['username'] = $value['username'];
				$_SESSION['user_type'] = $value['userlevel'];
			}
			echo 'true';
		}else{
			echo 'Invalid credential!';
		}
	}
?>