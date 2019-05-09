$(document).ready(function(){
	$('nav#menu').mmenu();


	$(".language-switcher").click(function() {
		if($(this).hasClass('active')){
			$(this).removeClass('active');
			$("ul.language-list").hide();
		}else{
			$(this).addClass('active');
			$("ul.language-list").show();
		}
	});

	$(".open-user-menu-icon").click(function(){
		if($(this).hasClass('active')){
			$(this).removeClass('active');
			$('.overlay').hide();
			$(".user-menu-popup").hide();
		}else{
			$(this).addClass('active');
			$('.overlay').show();
			$(".user-menu-popup").show();
			$(".overlay").click(function(){
				$(this).hide();
				$(".user-menu-popup").hide();
				$('.open-user-menu-icon').removeClass('active');
			})
		}
	})

    function Show_Mesage(text,second){
        HoldOn.open({
            theme:'sk-fading-circle',
            message:text,
        });
        
        setTimeout(function(){
            HoldOn.close();
        },second);
    }

    $(".back-to-top, .back-to-top-link").on("tap", function (e) {
        e.preventDefault();
        $("html, body").animate({scrollTop: 0}, 200);
    	return false;
    });
   
    
})

function goBack() {
    window.history.back();
}