$("#login-nav").click(function(){
	$(".log-reg").css("display","block");
	$(".login-nav").css("transform","rotateY(120deg)");
	setTimeout(function(){
$(".login").css("z-index","50");
		$(".login").fadeToggle();
	}, 700);
});

$("#register-nav").click(function(){
	$(".log-reg").css("display","block");
	$(".register-nav").css("transform","rotateY(-120deg)");
	setTimeout(function(){
		$(".register").fadeToggle();
	}, 700);
});
$(document).ready(function(){
	$("#preloader").delay(1000).slideUp();
});