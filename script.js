$(".phpsuccess").delay(3000).fadeOut();
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

	var linkdel=document.getElementsByClassName("linkdelete");
	
	var delfunc=function(){
		var element= this.parentNode;
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               	element.remove();
            }
        };
        xmlhttp.open("GET", "deletelink.php?listid=" +this.parentNode.id, true);
        xmlhttp.send();
	}	
	for (let i = 0; i < linkdel.length; i++) {
    	linkdel[i].addEventListener('click', delfunc, false);
	}
});
