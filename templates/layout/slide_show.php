<?php
	
	$d->reset();
	$sql = "select photo,link, ten_$lang, mota_$lang from #_image_url where hienthi=1 and com='slider' order by stt,id desc";
	$d->query($sql);
	$slider=$d->result_array();
	


	
?>
<?php if ($deviceType=="computer") {?>
<link href="camera/css/camera.css" type="text/css" rel="stylesheet" />
<link href="camera/css/slider.css" type="text/css" rel="stylesheet" />
<script src="camera/scripts/jquery.mobile.customized.min.js"></script>
<script src="camera/scripts/camera.min.js"></script>
<script src="camera/scripts/jquery.easing.1.3.js"></script>


 <script type="text/javascript">
            jQuery(document).ready(function($) {
                jQuery('#camera_wrap_1').camera({
				
				width: '1366px',
				height:'475px',
				pagination: false,
				thumbnails: false
                });
            });
 </script>           



 
 
 <div id="slider-camera-wrapper">

<div class="camera_wrap camera_magenta_skin" id="camera_wrap_1">

	<?php for ($i=0;$i<count($slider);$i++) {?>	 		
		<div  data-src="thumb/1366x475/1/<?=_upload_hinhanh_l.$slider[$i]["photo"]?>" data-link="<?=$slider[$i]["link"]?>" data-title="<?=$slider[$i]["ten_$lang"]?>" data-target="_blank">
		</div>
     <?php }?>   
				
	</div><!-- #camera_wrap_1 -->
	

</div><!--end slider-camera-wrapper-->


 
 <?php } else {?>
 
 <link rel="stylesheet" type="text/css" href="js/wowslider/style.css" />

<div id="wowslider-container1">
	<div class="ws_images"><ul>
    
     <?php for ($i=0;$i<count($slider);$i++) {?>
		<li><a href="<?=$slider[$i]["link"]?>" target="_blank"><img src="thumb/1366x480/1/<?=_upload_hinhanh_l.$slider[$i]["photo"]?>" alt="<?=$slider[$i]["ten_$lang"]?>" title="<?=$slider[$i]["ten_$lang"]?>" id="wows1_0"/></a></li>
	<?php }?>
	</ul></div>
	<div class="ws_bullets"><div>
      <?php for ($i=0;$i<count($slider);$i++) {?>
		<a href="<?=$slider[$i]["link"]?>" title="<?=$slider[$i]["ten_$lang"]?>"><span><?=$i?></span></a>
        <?php }?>
	
	</div></div>
	<div class="ws_shadow"></div>
	</div>



	<script type="text/javascript" src="js/wowslider/wowslider.js"></script>
	<script type="text/javascript" src="js/wowslider/script.js"></script>


<?php }?> 
        
  

