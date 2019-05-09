<?php
	
	
	$d->reset();
	$sql = "select photo,link, ten_$lang as ten from #_image_url where hienthi=1 and com='slide_project' order by stt,id desc";
	$d->query($sql);
	$slide_project=$d->result_array();
	

	$d->reset();
	$sql = "select id, ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,mota_$lang as mota,icon,photo from #_product_list where hienthi=1 and com='project' order by stt asc";
	$d->query($sql);
	$project_list=$d->result_array();
	
	
	  
  $d->reset();
  $sql = "select id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,mota_$lang as mota,photo from #_news where hienthi=1 and com='taisaochonchungtoi' order by id desc";
  $d->query($sql);
  $taisaochonchungtoi=$d->result_array();
  
  
  	$d->reset();
	$sql_banner_giua = "select banner_$lang as banner from #_banner where com='banner_chungtoi_project' ";
	$d->query($sql_banner_giua);
	$banner_chungtoi_project = $d->fetch_array();
	
?>



<script type="text/javascript">
	$(document).on('ready', function() {
	
	$(".slide_project ul").slick({
			
	dots: false,
    infinite: 0,
    autoplay: true,
    autoplaySpeed: 2000,
    pauseOnFocus: true,
    pauseOnHover: true,
    pauseOnDotsHover: true,
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
	
		  }) 


		});
	  </script>



<div class="slide_project">


	<ul>
	<?php foreach ($slide_project as $i =>$v) {?>
		<li class="pdl_project"><a href="<?=$v["link"]?>" target="_blank"><img src="thumb/1900x580/1/<?=_upload_hinhanh_l.$v["photo"]?>"></a>
		
		
			<?php /*if ($v["ten"]!="") {?>
			<a href="<?=$v["link"]?>" target="_blank" class="name_project"><span><?=$v["ten"]?> </span></a>
			<?php }*/?>
		
		</li>
	<?php }?>
	
	</ul>


</div><!--end slide_project-->

<div class="clear"></div>

<?php /*?>



<div class="container">

	<div class="list_catalog_group">

		<div class="box_list_catalog_group">
		
		
		<?php foreach ($project_list as $i =>$v) {?>

			<div class="item_catalog_group col-lg-4 col-md-4 col-sm-6 col-xs-12">
			
				<div class="img_catalog_group">
					<div class="span">
						<div class="table_cell">
							<a href="<?=$com?>/<?=$v["tenkhongdau"]?>/"><img src="<?=_upload_product_list_l.$v["icon"]?>"></a>
						</div>	

					</div>	
				
					
				
				</div><!--end img_catalog_group-->
				
				
				<div class="info_catalog_group">
				
					<h4><a href="<?=$com?>/<?=$v["tenkhongdau"]?>/"><?=$v["ten"]?></a></h4>
					
					<div class="des_catalog_group"><?=strip_tags(catchuoi($v["mota"],200))?></div><!--end des_catalog_group-->
					
					<a href="<?=$com?>/<?=$v["tenkhongdau"]?>/" class="view_catalog_group"><?=_xemthem?> >></a>
				
				</div><!--end info_catalog_group-->
			
			
			</div><!--end item_catalog_group-->
			
		<?php }?>
		
		<div class="clear"></div>

		</div><!--end list_catalog_group-->	


	</div><!--end list_catalog_group-->

</div>


<div class="clear"></div>


<div class="bg_taisaochonchungtoi">

	<div class="container">
	
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<img src="<?=_upload_hinhanh_l.$banner_chungtoi_project["banner"]?>" class="img_special">
		</div>
		
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		
			<h3 class="tieude_taisaochungtoi"><?=_taisaochungtoi?></h3>
			
			<div class="accordion">
			
				<?php foreach ($taisaochonchungtoi as $i =>$v) {?>
					<div class="accordion-item accent-color-<?=$i?> accent-color-4">
						<a class="accordion-item-toggle" href="#"> <span><div class="span"><div class="img"><img src="thumb/40x40/2/<?=_upload_news_l.$v["photo"]?>"></div></div></span> <?=$v["ten"]?> </a>
						<div class="accordion-item-content">
							<?=$v["mota"]?>
						</div>
					</div>
					<div class="clear"></div>
				<?php }?>	
					
					
					
				</div>
				
		</div>
	
	
	</div><!--end container-->


</div><!--end bg_taisaochonchungtoi-->



<?php */?>

<div class="clear margin_height" ></div>

<div class="container">

	<div class="box_list_group_catalog">
	
	
		<div class="tieude_group_catalog">
					<h5><?=_duantieubieu?></h5>
					<p><a><?=_cacduandangdathuchien?></a></p>
		</div>
		<div class="clear"></div>
		
		
		<div class="list_pro_index">
		
		
			<script type="text/javascript">
				$(document).ready(function(){
				$('#tabs_pro_index div#tab-pro-<?=$project_list[0]["id"]?>').show();
				<?php for ($i=1;$i<count($project_list);$i++) {?>
				$('#tabs_pro_index div#tab-pro-<?=$project_list[$i]["id"]?>').hide();
				<?php }?>
		
				$('#tabs_pro_index div:first').show();
				$('#tabs_pro_index ul li:first').addClass('active');
				$('#tabs_pro_index ul li a').click(function(){ 
				$('#tabs_pro_index ul li').removeClass('active');
				$(this).parent().addClass('active'); 
				var currentTab = $(this).attr('href'); 
				$('#tabs_pro_index div#tab-pro-<?=$project_list[0]["id"]?>').hide();
				<?php for ($i=1;$i<count($project_list);$i++) {?>
				$('#tabs_pro_index div#tab-pro-<?=$project_list[$i]["id"]?>').hide();
			<?php }?>
				$(currentTab).show();
				return false;
				});
				});
				</script>
		
		
		
		<div class="group_tab_catalog">
		
		
		<div id="tabs_pro_index">
            
			<ul>
			<?php /*?><li id="tab_pro_indexformat"><a href="#tab-pro-all"><?=_tatca?></a></li><?php */?>
            <?php for ($i=0;$i<count($project_list);$i++) {?>
            <li id="tab_pro_indexformat"><a href="#tab-pro-<?=$project_list[$i]["id"]?>"><?=$project_list[$i]["ten"]?></a></li>
			<?php }?>
            </ul>
			
            <div class="clear"></div>
			
			<?php /*?>
			<div id="tab-pro-all">
                
                <div class="box-list-pro">    
				
			<?php $d->reset();
			$sql_news = "select ten_$lang as ten,id,tenkhongdau_$lang as tenkhongdau,photo,alt_$lang as alt,mota_$lang as mota from #_product where hienthi=1 and com='project'  order by id desc limit 8";
			$d->query($sql_news);
			$pro_moi = $d->result_array();
			if (count($pro_moi)>0){?>
			

					
			<?php
			
		
			
			if(count($pro_moi)>0){
			$com_href=$com;	 
			
			foreach ($pro_moi as $k => $index_sp) {?>
			
		  
		   
		   
		   <div class="product-item col-lg-3 col-md-3 col-sm-6 col-xs-12 " >
						 
			
			 <div class="portfolio-item">
			 
			<div class="product-image">
								  
				<a href="<?=$com_href?>/<?=$index_sp["tenkhongdau"]?>-<?=$index_sp["id"]?>.html" title="<?=$index_sp["ten"]?>">
				<img  effect="mono" inverse="true" class="img-responsive has-tt colorup colorUpped" src="thumb/380x380/1/<?php if($index_sp['photo']!=NULL) echo _upload_product_l.$index_sp['photo']; else echo 'images/no-image-available.png';?>" alt="<?=$index_sp["alt"]?>" />
				</a>

			</div><!--end product-image-->
			
			
			 <div class="product-info portfolio-item-overlay">
			
				 <div class="product-name">

					<h3> <a href="<?=$com_href?>/<?=$index_sp["tenkhongdau"]?>-<?=$index_sp["id"]?>.html" title="<?=$index_sp["ten"]?>"><?=catchuoi($index_sp["ten"],80)?></a></h3>
		
				</div><!--end product-name-->  
	
				<div class="clear"></div>	

			</div><!--end product-info-->	
		
			 </div><!--end portfolio-item-->
		 



		<div class="clear"></div>
		</div> <!-- product-item -->
		   
		   
			<?php } }else echo '<p class="notice">'._noidungdangcapnhat.'</p>';  ?>    
			
	
			<div class="clear"></div>
			
			
			<?php }?>
            
             
              
                 </div><!--end box-list-pro-->
          
            </div><!--end tab-pro-new-->
    

           <?php */?> 
        
		 <?php foreach ($project_list as $l =>$v_list) {?>
         
            <div id="tab-pro-<?=$v_list["id"]?>">
                
                <div class="box-list-pro">    
				
			<?php $d->reset();
			$sql_news = "select ten_$lang as ten,id,tenkhongdau_$lang as tenkhongdau,photo,alt_$lang as alt,mota_$lang as mota from #_product where hienthi=1 and com='project'  and id_list='".$v_list["id"]."'   order by id desc limit 8";
			$d->query($sql_news);
			$pro_moi = $d->result_array();
			if (count($pro_moi)>0){?>
			

					
			<?php
			
		
			
			if(count($pro_moi)>0){
			$com_href=$com;	 
			
			foreach ($pro_moi as $k => $index_sp) {?>
			
		  
		   
		   
		   <div class="product-item col-lg-3 col-md-3 col-sm-6 col-xs-12" >
						 
			 <div class="portfolio-item">
			 
				<div class="product-image">
								  
				<a href="<?=$com_href?>/<?=$index_sp["tenkhongdau"]?>-<?=$index_sp["id"]?>.html" title="<?=$index_sp["ten"]?>">
				<img  effect="mono" inverse="true" class="img-responsive has-tt colorup colorUpped" src="thumb/380x380/1/<?php if($index_sp['photo']!=NULL) echo _upload_product_l.$index_sp['photo']; else echo 'images/no-image-available.png';?>" alt="<?=$index_sp["alt"]?>" />
				</a>

				</div><!--end product-image-->
				
				
			<div class="product-info portfolio-item-overlay">
			
				 <div class="product-name">

					<h3> <a href="<?=$com_href?>/<?=$index_sp["tenkhongdau"]?>-<?=$index_sp["id"]?>.html" title="<?=$index_sp["ten"]?>"><?=catchuoi($index_sp["ten"],40)?></a></h3>
		
					
				</div><!--end product-name-->  
			
				<div class="clear"></div>	

			</div><!--end product-info-->
				
			 
			 </div><!--end portfolio-item-->
		 
			
			
			
		
							   




		<div class="clear"></div>
		</div> <!-- product-item -->
		   
		   
			<?php } }else echo '<p class="notice">'._noidungdangcapnhat.'</p>';  ?>    
			
	
			<div class="clear"></div>
			
			
			<?php }?>
            
             
              
                 </div><!--end box-list-pro-->
          
            </div><!--end tab-pro-new-->
    

		 <?php }?>

      </div><!--end tabs_pro_index-->
      

		
		
		</div><!--end group_tab_catalog-->
	
		
		
		</div><!--end list_pro_index-->
		
		
	
	</div><!--end box_list_group_catalog-->
	  

</div><!--end container-->


		

