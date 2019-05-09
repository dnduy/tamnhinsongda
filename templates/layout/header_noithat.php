<?php

	$d->reset();
	$sql_banner_giua = "select banner_$lang as banner from #_banner where com='logo_noithat' ";
	$d->query($sql_banner_giua);
	$row_logo = $d->fetch_array();
	

	$d->reset();
	$sql="select ten_$lang,id,link,photo from #_image_url where hienthi=1 and com='mangxahoi' order by stt asc";
	$d->query($sql);
	$mxh_social=$d->result_array();

	
?>

<div id="header_top">

<div class="header_main container-fluid">

	<div class="row pd0 mg0">
	
		
		<div class="container container_header pd0">
		
	
		
			
			<div class="logo_web">

					<a href="index.html"><img src="<?=_upload_hinhanh_l.$row_logo["banner"]?>"   /></a>

					<div class="clear"></div>

				</div><!--end logo_web-->
			
	

			<div class="lang_page">
					
					<a href="langs/vi.htm" title="VI">
						<img src="images/vi.jpg" alt="VI">
					</a>
					<a href="langs/en.htm" title="EN">
						<img src="images/en.jpg" alt="EN">
					</a>
				</div><!--end lang_page-->
		
		
		
		
		</div><!--end container pd0-->
	
	
	</div><!--end row pd0 mg0-->

<div class="clear"></div>




</div><!--end header_main-->

</div><!--end header_top-->


	   
