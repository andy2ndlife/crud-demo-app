<?php
	ob_start();
	include_once('libs/session.php');
	include_once('core/class.manageUsers.php');
	$init = new ManageUsers;
	$allUsers = $init->listUsers();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.css" />
	<link rel="stylesheet" href="css/mobilecss.css" />
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="js/mobilejs.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.js"></script>
	<script type="text/javascript" src="js/adduser.js"></script>
	<!--script type="text/javascript" src="js/deleteuser.js"></script-->
	<script type="text/javascript" src="js/updateuser.js"></script>
	<script type="text/javascript" src="js/logout.js"></script>
	<title>My Mobile</title>	
</head>  
  
<body>
	<!-- PAGE1: list_user -->
	<div data-role="page" data-title="List User" id="list_user" data-theme="e">
		<div data-role="header" data-position="fixed">
			<a data-role="button" id="logout" data-icon="delete" data-iconpos="notext" data-ajax="false">Log out</a>
			<h1>User List</h1>
		</div>
		<div data-role="content">
			<?php 
			if(sizeof($allUsers) <= 1){
				echo "
				<div data-role='fieldcontain'>
					<div class='white'><hr><h2>Currently, there are no users in the system.<br /><br />Click on \"Add Users\" button below to go on.</h2><hr></div>
				</div>
				";
			}else{  ?>
				<div class='white'><center><h2>Click To Edit User Info!</h2></center></div>
				<div id="boxdiv" width="30 height="30">
					<script>
						function listViewClick(e){ 
							sessionStorage.userid = e.attr('id'); //STORE userid IN LOCAL STORAGE
							$.mobile.changePage('#update_user');
							getUserInfo(); //INSERT USER INFO INTO UPDATE FORM FIELDS
						}
					</script>
					<ul id="userlist" data-role="listview" data-filter="true" data-filter-placeholder="Search names..." data-inset="true">
						<?php 
						if(sizeof($allUsers) > 1){
							foreach($allUsers as $userinfo){
								echo "<li><a id='".$userinfo['userid']."' onclick='listViewClick($(this));' href='#'>". $userinfo['last'] .", ". $userinfo['first'] ."</a></li>";
							}
						}
						?>
					</ul>
				</div>
			<?php } ?>
		</div>
		<div data-role="footer" data-position="fixed">
			<div data-role="navbar">
				<ul>
					<li><a href="#add_user" data-icon="plus" data-rel="dialog" onclick='focusInput()'>Add Users</a></li>
					<?php if($_SESSION['user_type'] == 'admin') { ?>
						<li><a href="#delete_user" data-icon="delete" data-rel="page">Delete Users</a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<script>
		function focusInput(){ 
			setTimeout(function(){
				$("#adduser input[id='first']").select(); 
				$("#adduser input[id='first']").focus(); 
			}, 1000);
		}</script>
	</div>
	<!-- PAGE2: add_user -->
	<div data-role="dialog" data-title="Add User" id="add_user" data-theme="e">
		<div data-role="header" data-position="fixed">
			<h1>Add User</h1>
		</div>
		<div data-role="content">
			<table><tr><td>
				<form method="post" id="adduser">
					<div data-role="fieldcontain">
						<label for="first">Frist Name:</label>
						<input type="text" name="first" id="first" required="required" />
					</div>
					<div data-role="fieldcontain">
						<label for="last">Last Name:</label>
						<input type="text" name="last" id="last" required="required" />
					</div>
					<div data-role="fieldcontain">
						<label for="username">Username:</label>
						<input type="text" name="username" id="username" required="required" />
					</div>
					<div data-role="fieldcontain">
						<label for="password">Password:</label>
						<input type="password" name="password" id="password" required="required" />
					</div>
					<div data-role="fieldcontain">
						<label for="email">Email:</label>
						<input type="text" name="email" id="email" required="required" />
					</div>
					<div data-role="fieldcontain">
						<label for="email">&nbsp;</label>
						<input data-role="button" type="submit" value="Add User Now"/>
					</div>
				</form>
			</td></tr></table>
		</div>
	</div>
	<!-- PAGE3: delet_user -->
	<div data-role="page" data-title="Remove User" id="delete_user" data-theme="e">
		<div data-role="header" data-position="fixed">
			<a data-role="button" id="logout" data-icon="delete" data-iconpos="notext" data-ajax="false">Log out</a>
			<h1>Remove User</h1>
		</div>
		<div data-role="content">
			<div id="boxdiv" width="30 height="30">
				<h2><center><font color="#FFFFFF">Click to remove a user!</font></center></h2>
				<div>
					<ul data-role="listview" data-filter="true" data-filter-placeholder="Search names..." data-inset="true">
						<?php 
						foreach($allUsers as $userinfo){
							echo "<li><a href='#' onclick=\"confirmDel(".$userinfo['userid'].");\">". $userinfo['last'] .", ". $userinfo['first'] ."</a></li>";
						}
						?>
					</ul>
				</div>
				<!--a data-role="button" data-rel="back" data-inline="true">Cancel</a-->
			</div>
			<!-- ****** DELETE USER PANEL ******** -->
			<script type='text/javascript'>
				function confirmDel(userid){ 
					//ASSIGN href to "YES" CONFIRMATION BUTTON TO REMOVE USER
					$("#confirmation a[id='yes']").attr("href","libs/deleteuser.php?userid="+ userid);
					$('#deletepanel').popup('open'); 
					$('#deletepanel').on({
						 popupbeforeposition: function() {
							  var h = $( window ).height();
							  $('#deletepanel').css('height', h );
						 }
					});
				}
			</script>
			<div data-role='popup' id='deletepanel' data-theme='none' data-transition='slide' data-corners="false" data-shadow="false" data-tolerance="0,0">
				<div><br /><hr />
					<h2><b><font color="#FFFFFF">Are you sure you want<br /> to remove this user?</font></b></h2>
					<div id="confirmation"><center>
						<a id="yes" data-role="button" data-inline="true" data-ajax="false">Yes</a>
						<a href="#list_user" data-role="button" data-inline="true">No</a></center>
					</div><br /><br /><hr />
				</div>
			</div>
			<!-- ****** DELETE USER PANEL ******** -->
		</div>
		<div data-role="footer" data-position="fixed"><h1>&copy; Vuong Software Development</h1></div>
	</div>
	<!-- PAGE UPDATE USER -->
	<div data-role="page" data-title="Update User" id="update_user" data-theme="e">
		<div data-role="header" data-position="fixed">
			<h1>Update User</h1>
		</div>
		<div data-role="content" class="white">
			<form method="post" id="updateuser">
				<div data-role="fieldcontain">
					<label for="first">Frist Name:</label>
					<input type="text" name="first" id="first" required="required" />
				</div>
				<div data-role="fieldcontain">
					<label for="last">Last Name:</label>
					<input type="text" name="last" id="last" required="required" />
				</div>
				<div data-role="fieldcontain">
					<label for="username">Username:</label>
					<input type="text" name="username" id="username" required="required" />
				</div>
				<div data-role="fieldcontain">
					<label for="password">Password:</label>
					<input type="password" name="password" id="password" required="required" />
				</div>
				<div data-role="fieldcontain">
					<label for="email">Email:</label>
					<input type="text" name="email" id="email" required="required" />
				</div>
				<div data-role="fieldcontain">
					<label for="button">&nbsp;</label>
					<input type="hidden" name="userid" id="userid" />
					<input type="submit" value="Upate User Now" data-inline="true"/>
				</div>
			</form>
		</div>
		<div data-role="footer" data-position="fixed">
			<div data-role="navbar">
				<ul>
					<li><a href="profile.php#add_user" data-icon="plus" data-rel="dialog">Add Users</a></li>
					<?php if($_SESSION['user_type'] == 'admin') { ?>
						<li><a href="#delete_user" data-icon="delete">Delete Users</a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<script>
			function getUserInfo(){
				//POPULATE JS USER DATA INTO PROPER FIELDS
				var userdata = <?php echo json_encode($allUsers); ?>;
				for(var i in userdata){
					if(userdata[i].userid == sessionStorage.userid){
						$("#updateuser input[id='first']").val(userdata[i].first);
						$("#updateuser input[id='last']").val(userdata[i].last);
						$("#updateuser input[id='username']").val(userdata[i].username);
						$("#updateuser input[id='password']").val(userdata[i].password);
						$("#updateuser input[id='email']").val(userdata[i].email);
						$("#updateuser input[id='userid']").val(userdata[i].userid);
					}
				}
			}
		</script>
	</div>
	</body>
</html>