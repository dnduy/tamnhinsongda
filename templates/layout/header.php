<?php

	$d->reset();
	$sql_banner_giua = "select banner_$lang as banner from #_banner where com='logo_top' ";
	$d->query($sql_banner_giua);
	$row_logo = $d->fetch_array();
	

	$d->reset();
	$sql="select ten_$lang,id,link,photo from #_image_url where hienthi=1 and com='mangxahoi' order by stt asc";
	$d->query($sql);
	$mxh_social=$d->result_array();

	
?>
<?php
      $d->reset();      
      $sql_mau = "select * from #_background where com='bg_header' ";      
      $d->query($sql_mau);      
      $bg_header_option = $d->fetch_array();
      $bg="";
      if($bg_header_option['chonbg']==1)
        $bg.=" url("._upload_background_l.$bg_header_option['photo'].")";
        
      if($bg_header_option['repeat1']==0)
        $bg.=" repeat";
      else if($bg_header_option['repeat1']==1)
        $bg.=" repeat-x";
      else if($bg_header_option['repeat1']==2)
        $bg.=" repeat-y";
      else if($bg_header_option['repeat1']==3)
        $bg.=" no-repeat";
      
      if($bg_header_option['vitri']==1)
        $bg.=" top";
      else if($bg_header_option['vitri']==2)
        $bg.=" right";
      else if($bg_header_option['vitri']==3)
        $bg.=" bottom";
      else if($bg_header_option['vitri']==4)
        $bg.=" left";
      else if($bg_header_option['vitri']==5)
        $bg.=" center";
      
      if($bg_header_option['vitri1']==1)
        $bg.=" top";
      else if($bg_header_option['vitri1']==2)
        $bg.=" right";
      else if($bg_header_option['vitri1']==3)
        $bg.=" bottom";
      else if($bg_header_option['vitri1']==4)
        $bg.=" left";
      else if($bg_header_option['vitri1']==5)
        $bg.=" center";
      
      if($bg_header_option['fixed']==1)
        $bg.=" fixed";


    ?>

<div id="header_top" style="background:<?=$bg_header_option['nenbackground'],$bg?>;">

<div class="header_main container-fluid">

	<div class="row pd0 mg0">
	
		
		<div class="container container_header pd0">
		
	
		
			
			<div class="logo_web col-lg-3 col-md-3 col-sm-3 col-xs-12 pdl0">

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
		
		<nav class="nav-menu-header col-lg-9 col-md-9 col-sm-9 col-xs-12">   
			
			<?php include _template."layout/menu_top.php"; ?> 
					
			</nav><!--end nav-menu-heade--> 
		
		<div class="clear"></div>
		
		</div><!--end container pd0-->
	
	
	</div><!--end row pd0 mg0-->

<div class="clear"></div>




</div><!--end header_main-->

</div><!--end header_top-->


	   
