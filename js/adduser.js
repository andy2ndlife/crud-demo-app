$(function(){

	$('#adduser').submit(function(){
		$.post('libs/adduser.php', $('#adduser').serialize(), function(response){
			if(response == 'true'){
				showSuccess("User successfully added");
				//$(location).attr('href',"profile.php"); //works with this also
				//setTimeout(function(){
					window.location = 'profile.php';
				//},1000);
			}else{
				showError("Error inserting user");
			}
		});
	});
});