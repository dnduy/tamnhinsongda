 <!-- CSS Vs JS MagicZoom -->
      <link href="js/magiczoomplus/magiczoomplus.css" rel="stylesheet" type="text/css" media="screen"/>
      <script src="js/magiczoomplus/magiczoomplus.js" type="text/javascript"></script>

      <!-- Insert to your webpage before the </head> -->
      <script src="js/magiczoomplus/thumb-carousel/amazingcarousel.js"></script>
      <link rel="stylesheet" type="text/css" href="js/magiczoomplus/thumb-carousel/initcarousel-1.css">
      <script src="js/magiczoomplus/thumb-carousel/initcarousel-1.js"></script>
      <!-- End of head section HTML codes -->

      <!-- Style CSS MagicZoom Plus And Carousel -->
      <link href="js/magiczoomplus/magiczoomplus-style.css" rel="stylesheet" type="text/css" media="screen"/>
      <style type="text/css">
		.amazingcarousel-1 { width: 100% !important; }
          #amazingcarousel-container-1 .amazingcarousel-list-container { width: 100% !important; }
          #amazingcarousel-container-1 .amazingcarousel-list-wrapper { width: 100% !important; }
      </style>


<?php 

     $d->reset();
     $sql = "select * from #_product_list where hienthi=1 and id=".$row_detail['id_list'];
     $d->query($sql);
     $dm1 = $d->fetch_array();
     
     $d->reset();
     $sql = "select * from #_product_cat where hienthi=1 and id=".$row_detail['id_cat'];
     $d->query($sql);
     $dm2 = $d->fetch_array();
	 
	 
	 $d->reset();
     $sql = "select id,ten_$lang as ten, tenkhongdau_$lang as tenkhongdau from #_product_list where hienthi=1 and com='".$com_type."' order by id desc";
     $d->query($sql);
     $pro_list = $d->result_array();

?>


<div id="main_content_web">




<div id="main_dm_product">


<ul class="breadcrumb">

<?php if ($_GET["com"]!="de-vuong" && $_GET["com"]!="thiet-bi" && $_GET["com"]!="bo-suu-tap" && $_GET["com"]!="hoat-dong-san-xuat" && $_GET["com"]!="du-an-de-vuong" && $_GET["com"]!="san-pham-de-vuong") {?>
<div class="container_breadcrumb">
<?php }?>	
				
<li><a href="" class="transitionAll"><?=_trangchu?></a> </li>
<?php if ($dm1!="") {?>
<li><a href="<?=$com?>/<?=$dm1["tenkhongdau_$lang"]?>" class="transitionAll"><?=$dm1["ten_$lang"]?></a></li>
<?php }?>


<?php if ($dm2!="") {?>
<li><a href="<?=$com?>/<?=$dm2["tenkhongdau_$lang"]?>" class="transitionAll"><?=$dm2["ten_$lang"]?></a></li>
<?php }?>


<li><a  class="transitionAll"><?=$row_detail["ten_$lang"]?></a></li>

<?php if (count($pro_list)>0) {?>
<div class="catalog_pro">

	<ul>
	
	<li><a href="<?=$com?>.html"><?=_danhmucsanpham?></a>
	
		<ul>
		
		<?php foreach ($pro_list as $i =>$v_list) {?>
			<li><a href="<?=$com?>/<?=$v_list["tenkhongdau"]?>/"><?=$v_list["ten"]?></a></li>
		<?php }?>
		
		</ul>
	
	</li>
	
	</ul>

</div><!--end catalog_pro-->

<?php }?>

<div class="clear"></div>

				
<?php if ($_GET["com"]!="de-vuong" && $_GET["com"]!="thiet-bi" && $_GET["com"]!="bo-suu-tap" && $_GET["com"]!="hoat-dong-san-xuat" && $_GET["com"]!="du-an-de-vuong" && $_GET["com"]!="san-pham-de-vuong") {?>
</div><!--end container_breadcrumb-->
<?php }?>	
				

</ul><!--end breadcrumb-->

<div class="clear"></div>


<div class="block_content_detail container" >
   
    <div class="show-pro-info">
    
       
        <div class="left_sp col-lg-6 col-md-6 col-sm-6 col-xs-12 pd0 mg0 des320">
		
			<div class="gallery-pro ">
			
			
			
      <div class="gallery-pro-detail">
	  
	  
	  	 <?php if(($row_detail['photo']!="")) { ?> 
                <a id="Zoom-1" class="MagicZoom" href="<?=_upload_product_l.$row_detail['photo']?>">
                    <img src="<?=_upload_product_l.$row_detail['photo']?>" alt="pro-pic-detail">
                </a>
		 <?php }?>		
				
                <!-- Nhiều hình ảnh -->
                <div class="selectors">
                    <div id="amazingcarousel-container-1">
                        <div id="amazingcarousel-1" style="display:none;position:relative;width:100%;margin:0px auto 0px;">
                            <div class="amazingcarousel-list-container">
                                <ul class="amazingcarousel-list">
								
								 <?php if(($row_detail['photo']!="")) { ?> 

                                    <li class="amazingcarousel-item">
                                        <div class="amazingcarousel-item-container">
                                            <div class="amazingcarousel-image">
                                                <a data-zoom-id="Zoom-1" href="<?=_upload_product_l.$row_detail['photo']?>">
                                                    <img src="<?=_upload_product_l.$row_detail['photo']?>" alt="pro-pic-detail">
                                                </a>
                                            </div>                    
                                        </div>
                                    </li>
									
								 <?php }?>	
                                    
                                    <?php if(!empty($album_hinh)) {
                                      foreach($album_hinh as $hinh){  
                                    ?>

                                    <li class="amazingcarousel-item">
                                        <div class="amazingcarousel-item-container">
                                            <div class="amazingcarousel-image">
                                                <a data-zoom-id="Zoom-1" href="<?=_upload_product_l.$hinh['photo']?>">
                                                    <img src="<?=_upload_product_l.$hinh['photo']?>" alt="pro-pic-detail">
                                                </a>
                                            </div>                    
                                        </div>
                                    </li>

                                    <?php } } ?>

                                </ul>
                                <div class="amazingcarousel-prev"></div>
                                <div class="amazingcarousel-next"></div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>

     
			
			
			</div><!--end gallery-pro-->
			

			
			
       
        <div class="clear"></div>

    </div> <!--LEFT_SP-->  
    
        
    <div class="right-pro-info col-lg-6 col-md-6 col-sm-6 col-xs-12 pd0 mg0 des320">


      <div class="product-description">  
      
			
			<div class="info-pro-detail">
      <div class="name"><h1><?=$row_detail["ten_$lang"]?></h1></div>

	  
	  
	
	 
	   <div class="row-attr">
            <div class="title-attr"><?=_luotxem?>:</div>
			
			<div class="cont-attr price-buy">
           <p><?=$row_detail['luotxem']?></p>
              </div>
            <div class="clear"></div>
          </div>

         
          
      <div class="row-attr">
        <div class="des-pro">
          <?=$row_detail["mota_$lang"]?>
        </div>
      </div>

      <div class="clear"></div>

	
     
     
      <div class="clear"></div>
      <div class="attr-content" style="margin-top: 20px;">
				<?php $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>
		
				<p class="attr-right">
					<a class="tooltip_a share-icon share-facebook" target="_blank" href="http://www.facebook.com/sharer.php?u=<?=$url?>" title="Facebook"></a>
					<a class="tooltip_a share-icon share-zing" target="_blank" href="http://link.apps.zing.vn/share?u=<?=$url?>" title="Zing me"></a>
					<a class="tooltip_a share-icon share-twitter" target="_blank" href="http://twitter.com/share?url=<?=$url?>&amp;text=<?=$row_detail["ten"]?>" title="Twitter"></a>
					<a class="tooltip_a share-icon share-googleplus" target="_blank" href="https://plus.google.com/share?url=<?=$url?>" title="Google Plus"></a>
					<a class="tooltip_a share-icon share-linkedin" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?=$url?>" title="LinkedIn"></a>
					<a class="tooltip_a share-icon share-email" target="_blank" href="mailto:?Subject=<?=_share?><?=$row_detail["ten"]?>&amp;Body=<?=$row_detail["ten"]?><?=$url?>" title="Email"></a>
				</p>
			</div>
      
    </div>

      
	  
	  </div><!--end product-description-->  
        
      


    </div><!--end right-pro-info-->
      
      
      
        
          <div class="clear"></div>


           <div class="mangxahoi_like_share">
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
            </div><!--end mangxahoi_like_share-->




           <div class="clear"></div>



           


<div id="container-tab">
<!--tag-->
<script type="text/javascript">

$(document).ready(function(){
$('#tabs div#tab-1').show();
$('#tabs div#tab-2').hide();
$('#tabs div#tab-3').hide();
$('#tabs div#tab-4').hide();
$('#tabs div#tab-5').hide();
$('#tabs div:first').show();
$('#tabs ul li:first').addClass('active');
$('#tabs ul li a').click(function(){ 
$('#tabs ul li').removeClass('active');
$(this).parent().addClass('active'); 
var currentTab = $(this).attr('href'); 
$('#tabs div#tab-1').hide();
$('#tabs div#tab-2').hide();
$('#tabs div#tab-3').hide();
$('#tabs div#tab-4').hide();
$('#tabs div#tab-5').hide();
$(currentTab).show();
return false;
});
});
</script>



<!--tag-->



<div id="tab_detail">
 

<div id="tabs">
            <ul>
            
			
			    <li id="tab_spformat"><a href="#tab-1"><?=_thongtinchitiet?></a></li>
			
              <?php /*?> <li id="tab_spformat"><a href="#tab-2"><?=_congdung?></a></li><?php */?>

		   <?php /*?> <li id="tab_spformat"><a href="#tab-3">Video Clip</a></li><?php */?>
                
                 
            </ul>
            <div class="clear"></div>
            
        
         
            <div id="tab-1">
                
                <div class="info-content">    
            
					<?=$row_detail["noidung_$lang"]?>
              
                 </div><!--end content-effect-->
          
            </div><!--end tab-1-->

            
        
              <?php /*?>    <div id="tab-2">
             
             <div class="info-content">        
              <?=$row_detail["congdung"]?>
              
              
             </div><!--end content-effect-->
          
            </div><!--end tab-2--><?php */?>
			
			
			<?php /*?> <div id="tab-3">
             
             <div class="info-content">        
              
              <?=$row_detail["video"]?>
              
             </div><!--end content-effect-->
			 
			 <?php */?>
          
            </div><!--end tab-2-->

      </div><!--end tabs-->
      

</div><!--end tab_detail-->      
      

      
</div><!--end container-->


  </div>
</div>


</div><!--end main_dm_product-->


 <div class="clear"></div>

<div class="other-pro container">

<div class="title-info">
        <h3 class="title-info-bg"><?=$title_other?></h3>
</div><!--END title_info--> 



<div class="clear"></div>

<div class="rowmin row pd0 mg0">

	
<div class="product-group">

  
  <?php
		   if(count($sanpham_khac)>0){
			$com_href=$com;	 
			
	foreach ($sanpham_khac as $i => $v_sp) {?>
	
	
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 pdmin mg0 des320">

	
		<div class="product-item" >
		
			<div class="product-image">
								  
			<a href="<?=$com_href?>/<?=$v_sp["tenkhongdau_$lang"]?>-<?=$v_sp["id"]?>.html" title="<?=$v_sp["ten_$lang"]?>">
			<img  effect="mono" inverse="true" class="img-responsive has-tt colorup colorUpped" src="thumb/380x380/1/<?php if($v_sp['photo']!=NULL) echo _upload_product_l.$v_sp['photo']; else echo 'images/no-image-available.png';?>" alt="<?=$v_sp["alt_$lang"]?>" />
			</a>

			</div><!--end product-image-->
			
			
			 <div class="product-info">
			
				 <div class="product-name">

					<h3> <a href="<?=$com_href?>/<?=$v_sp["tenkhongdau_$lang"]?>-<?=$v_sp["id"]?>.html" title="<?=$v_sp["ten_$lang"]?>"><?=catchuoi($v_sp["ten_$lang"],100)?></a></h3>
					
					
				</div><!--end product-name-->  
			
				<div class="clear"></div>	

			</div><!--end product-info-->	
							   




		<div class="clear"></div>
		</div> <!-- product-item -->
		   
		  
	
		
	</div>
	
  <?php } }else echo '<p class="notice">'._noidungdangcapnhat.'</p>';  ?> 
          <div class="clear"></div>
       
               
               
  </div><!--end items_frame-->

		
</div><!--end rowmin-->		

</div><!--end other-pro-->








</div>


