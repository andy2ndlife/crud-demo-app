<?php
if($_POST){
	include_once('../core/class.manageUsers.php');
	$init = new ManageUsers;
	
	$userid = trim($_POST['userid']);
	$param = array('first' => trim($_POST['first']),
						'last'  => trim($_POST['last']),
						'username' => trim($_POST['username']),
						'password' => trim($_POST['password']),
						'email' => trim($_POST['email']),
						'userlevel' => 'user');
	$result = $init->editUsers($userid,$param);
	if($result >= 0){
		echo "true";
	}else{
		echo $result;
	}
}
?>