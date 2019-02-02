<?php
if($_POST){
	include_once('../core/class.manageUsers.php');
	$init = new ManageUsers;
	
	$first = trim($_POST['first']);
	$last = trim($_POST['last']);
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	$email = trim($_POST['email']);
	$userlevel = 'user';
	
	$result = $init->addUsers($username,$password,$first,$last,$email,$userlevel);
	if($result == 1){
		echo "true";
	}else{
		echo $result;
	}
}
?>