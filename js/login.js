$(function(){ 	

	$('#loginform').submit( function(e){
		$.post('libs/auth.php', $('#loginform').serialize(), function(response){
			if(response == 'true'){
				showSuccess("Logged in successful!");
				setTimeout(function(){
					/*
					IF USE $.mobile.changePage, THE NEW PAGE CONTENT WILL NOT BE LOADED INTO D DOM
					USE window.location SO THAT profile.php WILL BE LOADED INTO D DOM
					NOTE: *** USE $.mobile.changePage IF REDIRECT TO DIFFERENT <div> IN D SAME page
							*** ELSE USE window.location
					*/
					window.location = 'profile.php'; 
				},1000);
			}else{
				showError("Incorrect login credentials!");
			}
		});
	});
});



function executeLogin(username,password){
	$('#box').html(username +'<br />'+password);
	return false;
}

function validateUser(){
	/*
	if($('#username').val().length != 0 && $('#password').val().length != 0){
		showSuccess("Logged in successfully!");
		return true;
	}else{
		showError("Incorrect username or password!");
		return false;
	}
	*/
}