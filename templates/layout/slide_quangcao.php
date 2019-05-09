<?php
	
	$d->reset();
	$sql = "select photo,link, ten_$lang, mota_$lang from #_image_url where hienthi=1 and com='quangcao' order by stt,id desc";
	$d->query($sql);
	$hinh_quangcao=$d->result_array();
	

	
?>

        <script src="owl-carousel/owl.carousel.js"></script>
        <!-- Owl Carousel Assets -->
        <link href="owl-carousel/owl.carousel.css" rel="stylesheet">
        <link href="owl-carousel/owl.theme.css" rel="stylesheet">
        <link href="owl-carousel/my_css.css" rel="stylesheet">

  <script type="text/javascript">
          $(document).ready(function() {
            
            $("#owl_quangcao_photo").owlCarousel({

            items : 1, //10 items above 1000px browser width
            itemsDesktop : [1350,1], //5 items between 1000px and 901px
            itemsDesktopSmall : [1300,1], // 3 items betweem 900px and 601px
            itemsTablet: [1100,1], //2 items between 600 and 0;
            itemsMobile : [479,1], // itemsMobile disabled - inherit from itemsTablet option
            navigation: true,
            autoPlay : true,
            pagination: false,
            paginationNumbers: false,
            scrollPerPage : 1,
            slideSpeed: 700
            });

          });
          </script>


  <div id="owl_quangcao_photo" class="owl_product">
                <?php for($k=0,$count_cn=count($hinh_quangcao);$k<$count_cn;$k++ ){?>
                    <?php if($k%1==0){?><div class="wrap_item_pro"><?php }?>
                    <div class="item_pro wow fadeInUp">
               <a href="<?=$hinh_quangcao[$k]["link"]?>" target="_blank" class="img_pro"><img src="<?=_upload_hinhanh_l.$hinh_quangcao[$k]['photo']?>" title="<?=$hinh_quangcao[$k]["ten_$lang"]?>" alt="<?=$hinh_quangcao[$k]["ten_$lang"]?>" /></a>
                        
                    </div>
                    
                    <?php if((($k+1)%1==0)||($k==count($hinh_quangcao)-1)){?></div><?php }?>
                <?php }?>         

  </div>              