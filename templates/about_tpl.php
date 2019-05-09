<div id="main_content_web">

	<ul class="breadcrumb">
	
	<div class="container_breadcrumb">

<li><a href="index.html" class="transitionAll"><?=_trangchu?></a> </li>
<li><a href="<?=$com?>.html" class="transitionAll"><?=_gioithieu?></a></li>

</div><!--end container_breadcrumb-->

</ul><!--end breadcrumb-->


<div class="clear"></div>

<div class="block_content">

<div class="container">

	<div class="tieude"><?=$ten_info?></div>

    <div class="clear"></div>
    
    <div class="show-pro">

           <div class="chitiettin"><?=$noidung_info?></div>
           
		   <div class="clear"></div>
		   
           <div class="mangxahoi">
				<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style">
				<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
				<a class="addthis_button_tweet"></a>
				<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
				<a class="addthis_counter addthis_pill_style"></a>
				</div>
				<script type="text/javascript">var addthis_config = {"data_track_addressbar":false};</script>
				<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52843d4e1ff0313a"></script>
				<!-- AddThis Button END -->
			</div><!--end mangxahoi-->
          
    </div><!--end show-pro-->
	
	</div><!--end container-->
	
	
	 <div class="show-info-add">

           <ul class="breadcrumb">
		   
		   	<div class="container_breadcrumb">

			<li><a href="index.html" class="transitionAll"><?=_trangchu?></a> </li>
			
			<li><a href="<?=$com?>.html" class="transitionAll">Concepter</a></li>
			
			</div>

			</ul><!--end breadcrumb-->
				
			<div class="clear"></div>
			
			
			<div class="container">
			
			  <div class="chitiettin"><?=$concepter_info?></div>
			  
			 </div> 
			 <div class="clear"></div>

	</div><!--end show-pro-->
	
	
	
	<div class="show-info-add">

           <ul class="breadcrumb">

		    <div class="container_breadcrumb">
				<li><a href="index.html" class="transitionAll"><?=_trangchu?></a> </li>
				
				<li><a href="<?=$com?>.html" class="transitionAll">Brochure</a></li>
				
			</div>	

			</ul><!--end breadcrumb-->
				
			<div class="clear"></div>
			
			
		
			<div class="container">
			
				<div class="chitiettin">
			  
			  <?php 
			  
	$d->reset();
	$sql = "select photo,link, ten_$lang as ten from #_image_url where hienthi=1 and com='slide_brochure' order by stt,id desc";
	$d->query($sql);
	$slide_brochure=$d->result_array();
	if (count($slide_brochure)>0){		  
			  ?>
			  
			  
			  <script type="text/javascript">
	$(document).on('ready', function() {
		
		$(".slide_brochure ul").slick({
			
	dots: false,
  infinite: true,
   autoplay:true,
  autoplaySpeed:3500,
  speed: 300,
  slidesToShow: 1,
  slidesToScroll: 1,
 
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: false,
        dots: false
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }

  ]
	
		  });

		});
	  </script>
	  
	  
	  
	  
<div class="slide_brochure">


	<ul>
	<?php foreach ($slide_brochure as $i =>$v) {?>
		<li class="pdl_project"><a href="<?=$v["link"]?>" target="_blank"><img src="thumb/1200x500/2/<?=_upload_hinhanh_l.$v["photo"]?>"></a>
		
			<a href="<?=$v["link"]?>" target="_blank" class="name_project"><span><?=$v["ten"]?> </span></a>
		
		</li>
	<?php }?>
	
	</ul>


</div><!--end slide_brochure-->


	<?php }?>
			  
				
				<?php /*?><iframe src="https://drive.google.com/viewerng/viewer?url=http://<?=$config_url?>/<?=_upload_info_l.$brochure_info?>?pid=explorer&efh=true&a=v&chrome=true&embedded=true" width="100%" class="iframe_embedded"  frameborder="0"></iframe><?php */?>
			  
			  </div><!--end chitiettin-->

			
			</div>
			
			<div class="clear"></div>
			
			  
	</div><!--end show-info-add-->
    
 </div><!--end block_content-->
 




 </div><!--end main_content_web-->



