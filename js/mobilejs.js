$(document).bind("mobileinit", function(){
	$.mobile.defaultPageTransition = 'flip';
	$.mobile.defaultDialogTransition = 'flip';
});

function showError(message){
	$("<div class='ui-loader ui-overlay-shadow ui_body_error ui-corner-all'><h1>"+message+"</h1></div>").css({ position: "absolute","display": "block", "opacity": 0.96, top: $(window).scrollTop() + 100,left: parseInt($(window).width() / 2) - parseInt(150) })
		.appendTo( $.mobile.pageContainer )
		.delay( 2000 )
		.fadeOut( 400, function(){
		$(this).remove();
	});
}

function showSuccess(message){
	$("<div class='ui-loader ui-overlay-shadow ui_body_success ui-corner-all'><h1>"+message+"</h1></div>").css({ "display": "block", "opacity": 0.96, top: $(window).scrollTop() + 100,left: parseInt($(window).width() / 2) - parseInt(150) })
		.appendTo( $.mobile.pageContainer )
		.delay( 2000 )
		.fadeOut( 400, function(){
		$(this).remove();
	});
}

