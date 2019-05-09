
<div class="wap_item">


  
<div class="dichvu-main-index">


<div class="container-web">


	<div class="home-title">
	<h4><a href="index.html"><?=_trangchu?></a></h4>
	</div><!--end home-title-->

<div class="clear"></div>
		 <div class="title-index">
			<h3 class="title-index-name"><a href="san-pham.html"><?=_sanpham?></a></h3>
			<div class="clear"></div>    
		</div><!--END title_index--> 

  <div class="clear"></div>  
  
  
  <div class="box-news-index services-group">
  
	
	<?php 
	
	$d->reset();
	$sql_news = "select ten_$lang as ten,id,tenkhongdau_$lang as tenkhongdau,photo from #_product_list where hienthi=1 and com='product' and hienthitc>0  order by stt asc limit 3";
	$d->query($sql_news);
	$dichvu_nb = $d->result_array();
	
	
	?>
  
		<?php foreach ($dichvu_nb as $j => $v_news) {?>
  
		<div class="items-news-list" <?php if (($j+1)%3==0 ) {?> style="margin-right:0;" <?php }?>>
		
			<div class="img-news-index">
			<a href="<?=$v_news["tenkhongdau"]?>/"><img src="thumb/380x250/1/<?php if($v_news['photo']!=NULL) echo _upload_product_list_l.$v_news['photo']; else echo 'images/no-image-available.png';?>"></a>
			
			</div><!--end img-news-index-->
			
			<div class="info-news-info">
			
				<h4><a href="<?=$v_news["tenkhongdau"]?>/"><?=$v_news["ten"]?></a></h4>
				
				
				
			</div>
		
		
		</div><!--end items-news-list-->
		
		<?php if (($j+1)%3==0 ) {?> <div class="clear"></div> <?php }?>
		
		<?php }?>
  
  
  
  </div>

	
  
  <div class="clear"></div>

</div><!--end container-web-->



               
  </div><!--end product-main-index-->


  <?php /*?><?php if (count($dichvu_nb)>4) {?>
  <script type="text/javascript">
          $(document).ready(function() {
            
            $(".services-group").owlCarousel({

            items : 4, //10 items above 1000px browser width
            itemsDesktop : [1350,4], //5 items between 1000px and 901px
            itemsDesktopSmall : [1300,4], // 3 items betweem 900px and 601px
            itemsTablet: [1100,2], //2 items between 600 and 0;
            itemsMobile : [479,1], // itemsMobile disabled - inherit from itemsTablet option
            navigation: true,
            autoPlay : true,
            pagination: false,
            paginationNumbers: false,
            scrollPerPage : 1,
            slideSpeed: 1000
            });


        

          });
          </script>
  <?php }?><?php */?>

</div><!--end wap_item-->  

