$(function(){

	$('#updateuser').submit(function(){
		$.post('libs/updateuser.php', $('#updateuser').serialize(), function(response){
			if(response == 'true'){
				showSuccess("User successfully updated");
				//$(location).attr('href',"profile.php"); //works with this also
				//setTimeout(function(){
					window.location = 'profile.php';
				//},1000);
			}else{
				showError("Error updating user");
			}
		});
	});
});