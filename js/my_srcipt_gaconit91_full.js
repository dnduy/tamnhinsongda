// Code GaConIT:Nguyễn Ngọc Tân
// Email yahoo:nguyentanit_91@yahoo.com OR Email Gmail:tanit91.nina@gmail.com




/*******************************************START BACK-TOP *********************************/

 $(document).ready(function() {
	 
	 
	 
	 handleAccordionsAndToogles();
           
          $(window).scroll(function() {
            if($(window).scrollTop() != 0) {
                $('#back-top').fadeIn();
            } else {
                $('#back-top').fadeOut();
            }
          });
          $('#back-top').click(function() {
            $('html, body').animate({scrollTop:0},500);
          });
        });

		
 function handleAccordionsAndToogles() {
	   
		// accordeon
		
		$('.accordion a.accordion-item-toggle').click(function (e) { 
			var dropDown = $(this).closest('.accordion-item').find('.accordion-item-content');
			$(this).closest('.accordion').find('.accordion-item-content').not(dropDown).slideUp();
			if ($(this).hasClass('active')) { 
				$(this).removeClass('active');
			} else { 
				$(this).closest('.accordion').find('.accordion-item-toggle.active').removeClass('active');
				$(this).addClass('active');
			}
			dropDown.stop(false, true).slideToggle();
			e.preventDefault();
		});
		
		// toggle
		
		$('.toggle a.toggle-item-toggle').click(function (e) { 
			var dropDown = $(this).closest('.toggle-item').find('.toggle-item-content');
			if ($(this).hasClass('active')) { 
				$(this).removeClass('active');
			} else { 
				$(this).addClass('active');
			}
			dropDown.stop(false, true).slideToggle();
			e.preventDefault();
		});
   
   }   

/*******************************************END BACK-TOP *********************************/


$(document).ready(function(){
    $("#toTop").scrollToTop(800);

    $(".selebox_header > span").on("click",function(){
        $obj = $(this).parent();
        if($obj.hasClass('active')){
            $(".dropdown-list").hide();
            $obj.removeClass('active');
        }else{
            $(".selebox_header").removeClass('active');
            $obj.addClass('active');
            $obj.find(".dropdown-list").show();
            $obj.mouseleave(function(){
                $(".selebox_header").removeClass('active');
                $(".dropdown-list").hide();
            })
        }
    })


    $('.flexslider').flexslider({
        animation: "slide",
        animationLoop: false,
        controlNav: false,
        itemWidth: 262,
        itemMargin: 41,
        minItems: 4,
        maxItems: 4,
        touch: true,
    });

   


    function goToByScroll(id){
        // Remove "link" from the ID
        id = id.replace("link", "");
        // Scroll
        $('html,body').animate({
            scrollTop: $("#"+id).offset().top},
            'slow');
    }

    function Show_Mesage(text,second){
        HoldOn.open({
            theme:'sk-fading-circle',
            message:text,
        });
        
        setTimeout(function(){
            HoldOn.close();
        },second);
    }

});

function number_format(number, decimals, dec_point, thousands_sep) {
  //  discuss at: http://phpjs.org/functions/number_format/
  // original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // improved by: davook
  // improved by: Brett Zamir (http://brett-zamir.me)
  // improved by: Brett Zamir (http://brett-zamir.me)
  // improved by: Theriault
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // bugfixed by: Michael White (http://getsprink.com)
  // bugfixed by: Benjamin Lupton
  // bugfixed by: Allan Jensen (http://www.winternet.no)
  // bugfixed by: Howard Yeend
  // bugfixed by: Diogo Resende
  // bugfixed by: Rival
  // bugfixed by: Brett Zamir (http://brett-zamir.me)
  //  revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
  //  revised by: Luke Smith (http://lucassmith.name)
  //    input by: Kheang Hok Chin (http://www.distantia.ca/)
  //    input by: Jay Klehr
  //    input by: Amir Habibi (http://www.residence-mixte.com/)
  //    input by: Amirouche
  //   example 1: number_format(1234.56);
  //   returns 1: '1,235'
  //   example 2: number_format(1234.56, 2, ',', ' ');
  //   returns 2: '1 234,56'
  //   example 3: number_format(1234.5678, 2, '.', '');
  //   returns 3: '1234.57'
  //   example 4: number_format(67, 2, ',', '.');
  //   returns 4: '67,00'
  //   example 5: number_format(1000);
  //   returns 5: '1,000'
  //   example 6: number_format(67.311, 2);
  //   returns 6: '67.31'
  //   example 7: number_format(1000.55, 1);
  //   returns 7: '1,000.6'
  //   example 8: number_format(67000, 5, ',', '.');
  //   returns 8: '67.000,00000'
  //   example 9: number_format(0.9, 0);
  //   returns 9: '1'
  //  example 10: number_format('1.20', 2);
  //  returns 10: '1.20'
  //  example 11: number_format('1.20', 4);
  //  returns 11: '1.2000'
  //  example 12: number_format('1.2000', 3);
  //  returns 12: '1.200'
  //  example 13: number_format('1 000,50', 2, '.', ' ');
  //  returns 13: '100 050.00'
  //  example 14: number_format(1e-8, 8, '.', '');
  //  returns 14: '0.00000001'

  number = (number + '')
    .replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + (Math.round(n * k) / k)
        .toFixed(prec);
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
    .split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '')
    .length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1)
      .join('0');
  }
  return s.join(dec);
}
