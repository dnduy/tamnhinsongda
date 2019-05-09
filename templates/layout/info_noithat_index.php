<?php
	
	$d->reset();
	$sql = "select  mota_$lang as mota, noidung_$lang as noidung from #_info where  com='gioithieu_nt' ";
	$d->query($sql);
	$row_gioithieu=$d->fetch_array();
	

	
	$d->reset();
	$sql_news = "select ten_$lang as ten,id,tenkhongdau_$lang as tenkhongdau,photo from #_product where hienthi=1 and com='noithat' and spnoibat>0   order by id desc";
	$d->query($sql_news);
	$sp_product_nb = $d->result_array();
	
	
	$d->reset();
	$sql_news = "select ten_$lang as ten,id,tenkhongdau_$lang as tenkhongdau,photo from #_product where hienthi=1 and com='duan' and spnoibat>0   order by id desc";
	$d->query($sql_news);
	$duan_nb = $d->result_array();
	
	
	$d->reset();
	$sql_news = "select ten_$lang as ten,id,tenkhongdau_$lang as tenkhongdau,photo from #_news where hienthi=1 and com='hoatdongsanxuat' and tinnoibat>0   order by id desc";
	$d->query($sql_news);
	$hd_sx = $d->result_array();

	
	$d->reset();
	$sql_news = "select ten_$lang as ten,id,tenkhongdau_$lang as tenkhongdau,photo from #_news where hienthi=1 and com='bosuutap' and tinnoibat>0   order by id desc";
	$d->query($sql_news);
	$bosuutap = $d->result_array();
	
	
	
	$d->reset();
	$sql_news = "select ten_$lang as ten,id,tenkhongdau_$lang as tenkhongdau,photo from #_product where hienthi=1 and com='thietbi' and spnoibat>0   order by id desc";
	$d->query($sql_news);
	$thietbi_nb = $d->result_array();
	

	
?>


<div class="box-about-index container">
		
			<div class="info-about col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
				<div class="frame_about_des">
				
					<div class="des-about">
					
						<?=$row_gioithieu["noidung"]?>
					
					</div><!--end des-about-->
				
				</div><!--end frame_about_des-->
			
			</div><!--end frame_about_des-->
			
<div class="clear"></div>
		
</div><!--end box-about-index-->


<?php if (count($sp_product_nb)>0) {?>

<div class="box-product-noithat-index">

		<div class="tieude_pro_nt container"><a href="san-pham-de-vuong.html"><?=_sanpham?></a></div>
		
			<div class="bg-box-frame-pro">
			
			
				<div class="container">
				
				
			<script type="text/javascript">
	$(document).on('ready', function() {
	
	$(".slide_pro_noithat").slick({
			
	dots: false,
    infinite: 0,
    autoplay: true,
    autoplaySpeed: 2000,
    pauseOnFocus: false,
    pauseOnHover: false,
    pauseOnDotsHover: false,
    slidesToShow: 4,
    slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
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
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }

  ]
	
		  }) 


		});
	  </script>
	
				
				
	
				
						<div class="items_pro_noithat">
						
							<ul class="slide_pro_noithat">
							
							
							<?php 
						$com_href="san-pham-de-vuong";	 
						foreach ($sp_product_nb as $i =>$v_nt) {?>
							
								<li>
									<a class="img_pro_noithat" href="<?=$com_href?>/<?=$v_nt["tenkhongdau"]?>-<?=$v_nt["id"]?>.html"><img src="thumb/270x255/1/<?=_upload_product_l.$v_nt["photo"]?>"></a>
									<a class="name_pro_noithat" href="<?=$com_href?>/<?=$v_nt["tenkhongdau"]?>-<?=$v_nt["id"]?>.html"><?=$v_nt["ten"]?></a>
								</li>
								
							<?php }?>
							
							</ul>
						
						
						</div><!--end slide_pro_noithat-->
				
				
				
				</div><!--end bg-box-frame-pro-->
			
				
			
			</div><!--end bg-box-frame-pro-->
			
<div class="clear"></div>
		
</div><!--end box-product-noithat-index-->

<?php }?>





<?php if (count($duan_nb)>0) {?>

<div class="box-product-noithat-index">

		<div class="tieude_pro_nt container"><a href="du-an-de-vuong.html"><?=_duanthuchien?></a></div>
		
			<div class="bg-box-frame-pro">
			
			
				<div class="container">
				
				
		<script type="text/javascript">
	$(document).on('ready', function() {
	
	$(".slide_duan_noithat").slick({
			
	dots: false,
    infinite: 0,
    autoplay: true,
    autoplaySpeed: 2500,
    pauseOnFocus: false,
    pauseOnHover: false,
    pauseOnDotsHover: false,
    slidesToShow: 3,
    slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
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
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }

  ]
	
		  }) 


		});
	  </script>				
				
		
				
				
						<div class="items_pro_noithat">
						
							<ul class="slide_duan_noithat">
							
							
							<?php
							$com_href="du-an-de-vuong";	 
							foreach ($duan_nb as $i =>$v_nt) {?>
							
								<li>
									<a class="img_pro_noithat" href="<?=$com_href?>/<?=$v_nt["tenkhongdau"]?>-<?=$v_nt["id"]?>.html"><img src="thumb/370x265/1/<?=_upload_product_l.$v_nt["photo"]?>"></a>
									<a class="name_pro_noithat" href="<?=$com_href?>/<?=$v_nt["tenkhongdau"]?>-<?=$v_nt["id"]?>.html"><?=$v_nt["ten"]?></a>
								</li>
								
							<?php }?>
							
							</ul>
						
						
						</div><!--end slide_duan_noithat-->
				
				
				
				</div><!--end bg-box-frame-pro-->
			
				
			
			</div><!--end bg-box-frame-pro-->
			
<div class="clear"></div>
		
</div><!--end box-product-noithat-index-->

<?php }?>



<?php if (count($hd_sx)>0) {?>

<div class="box-product-noithat-index">

		<div class="tieude_pro_nt container"><a href="hoat-dong-san-xuat.html"><?=_hoatdongsanxuat?></a></div>
		
			<div class="bg-box-frame-pro">
			
			
				<div class="container">
				
				
<script type="text/javascript">
	$(document).on('ready', function() {
	
	$(".slide_hdsx_noithat").slick({
			
	dots: false,
    infinite: 0,
    autoplay: true,
    autoplaySpeed: 3500,
    pauseOnFocus: false,
    pauseOnHover: false,
    pauseOnDotsHover: false,
    slidesToShow: 3,
    slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
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
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }

  ]
	
		  }) 


		});
	  </script>							
				
				
		
						<div class="items_pro_noithat">
						
							<ul class="slide_hdsx_noithat">
							
							
							<?php 
								$com_href="hoat-dong-san-xuat";	 
								foreach ($hd_sx as $i =>$v_nt) {?>
							
								<li>
									<a class="img_pro_noithat" href="<?=$com_href?>/<?=$v_nt["tenkhongdau"]?>-<?=$v_nt["id"]?>.html"><img src="thumb/370x265/1/<?=_upload_news_l.$v_nt["photo"]?>"></a>
									<a class="name_pro_noithat" href="<?=$com_href?>/<?=$v_nt["tenkhongdau"]?>-<?=$v_nt["id"]?>.html"><?=$v_nt["ten"]?></a>
								</li>
								
							<?php }?>
							
							</ul>
						
						
						</div><!--end slide_duan_noithat-->
				
				
				
				</div><!--end bg-box-frame-pro-->
			
				
			
			</div><!--end bg-box-frame-pro-->
			
<div class="clear"></div>
		
</div><!--end box-product-noithat-index-->

<?php }?>




<?php if (count($thietbi_nb)>0) {?>

<div class="box-product-noithat-index">

		<div class="tieude_pro_nt container"><a href="thiet-bi.html"><?=_thietbi?></a></div>
		
			<div class="bg-box-frame-pro">
			
			
				<div class="container">
				
				
<script type="text/javascript">
	$(document).on('ready', function() {
	
	$(".slide_thietbi_noithat").slick({
			
	dots: false,
    infinite: 0,
    autoplay: true,
    autoplaySpeed: 3200,
    pauseOnFocus: false,
    pauseOnHover: false,
    pauseOnDotsHover: false,
    slidesToShow: 4,
    slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
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
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }

  ]
	
		  }) 


		});
	  </script>						
				
		
				
						<div class="items_pro_noithat">
						
							<ul class="slide_thietbi_noithat">
							
							
							<?php
							$com_href="thiet-bi";	
							foreach ($thietbi_nb as $i =>$v_nt) {?>
							
								<li>
									<a class="img_pro_noithat" href="<?=$com_href?>/<?=$v_nt["tenkhongdau"]?>-<?=$v_nt["id"]?>.html"><img src="thumb/270x255/1/<?=_upload_product_l.$v_nt["photo"]?>"></a>
									<a class="name_pro_noithat" href="<?=$com_href?>/<?=$v_nt["tenkhongdau"]?>-<?=$v_nt["id"]?>.html"><?=$v_nt["ten"]?></a>
								</li>
								
							<?php }?>
							
							</ul>
						
						
						</div><!--end slide_bst_noithat-->
				
				
				
				</div><!--end bg-box-frame-pro-->
			
				
			
			</div><!--end bg-box-frame-pro-->
			
<div class="clear"></div>
		
</div><!--end box-product-noithat-index-->

<?php }?>






<?php if (count($bosuutap)>0) {?>

<div class="box-product-noithat-index">

		<div class="tieude_pro_nt container"><a href="bo-suu-tap.html"><?=_bosuutap?></a></div>
		
			<div class="bg-box-frame-pro">
			
			
				<div class="container">
				
				
<script type="text/javascript">
	$(document).on('ready', function() {
	
	$(".slide_bst_noithat").slick({
			
	dots: false,
    infinite: 0,
    autoplay: true,
    autoplaySpeed: 3200,
    pauseOnFocus: false,
    pauseOnHover: false,
    pauseOnDotsHover: false,
    slidesToShow: 4,
    slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
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
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }

  ]
	
		  }) 


		});
	  </script>						
				
		
				
						<div class="items_pro_noithat">
						
							<ul class="slide_bst_noithat">
							
							
							<?php
							$com_href="bo-suu-tap";	
							foreach ($bosuutap as $i =>$v_nt) {?>
							
								<li>
									<a class="img_pro_noithat" href="<?=$com_href?>/<?=$v_nt["tenkhongdau"]?>-<?=$v_nt["id"]?>.html"><img src="thumb/270x255/1/<?=_upload_news_l.$v_nt["photo"]?>"></a>
									<a class="name_pro_noithat" href="<?=$com_href?>/<?=$v_nt["tenkhongdau"]?>-<?=$v_nt["id"]?>.html"><?=$v_nt["ten"]?></a>
								</li>
								
							<?php }?>
							
							</ul>
						
						
						</div><!--end slide_bst_noithat-->
				
				
				
				</div><!--end bg-box-frame-pro-->
			
				
			
			</div><!--end bg-box-frame-pro-->
			
<div class="clear"></div>
		
</div><!--end box-product-noithat-index-->

<?php }?>



