<?php
	include_once('../core/class.manageUsers.php');
	$init = new ManageUsers;

	$userid = trim($_GET['userid']);
	$result = $init->deletUsers($userid);
	if($result == 1){
		header('location: ../profile.php');
	}else{
		echo 'false';
	}
?>