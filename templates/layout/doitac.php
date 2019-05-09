<?php
	$d->reset();
	$sql="select ten_$lang, link, photo from #_image_url where hienthi=1 and com='doitac' order by stt,id desc";
	$d->query($sql);
	$doitac= $d->result_array();

?>

<?php if (count($doitac)>0) {?>
	
	<script type="text/javascript">
	$(document).on('ready', function() {
		
		$(".slide_doitac_scroll").slick({
			
	dots: false,
  infinite: true,
   autoplay:true,
  autoplaySpeed:3500,
  speed: 300,
  slidesToShow: 7,
  slidesToScroll: 1,
 
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: false,
        dots: false
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    }

  ]
	
		  });

		});
	  </script>

	
	<div class="bg-list-doitac">
	
	
		<div class="main-list-doitac container">
		
				<div class="tieude_doitac">
				
					<h5><?=_doitac?></h5>
					<p><?=$row_setting["desdoitac_$lang"]?></p>
				
				</div>
		
			
			<div >
		
			<ul class="slide_doitac_scroll">
		<?php foreach ($doitac as $i =>$v) {?>	
			<li><a href="<?=$v["link"]?>" target="_blank"><img src="thumb/130x130/2/<?=_upload_hinhanh_l.$v["photo"]?>"></a></li>
		<?php }?>	
			</ul>
			
			</div>
		
		</div><!--end doitac-->
	
	
	</div><!--end bg-list-doitac-->

	<?php }?>	
	
