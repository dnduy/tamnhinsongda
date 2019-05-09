
<div id="main_content_web">

<ul class="breadcrumb">

<div class="container_breadcrumb">

<li><a href="" class="transitionAll"><?=_trangchu?></a> </li>
<li><a class="transitionAll"><?=$title_tcat?></a></li>

</div><!--end container_breadcrumb-->

</ul><!--end breadcrumb-->


<div class="container">

	<div class="block_content tintuc-box">

    <div class="show-pro">
		<?php
		   if(count($tintuc)>0){
		$com_href=$com;	   
		foreach ($tintuc as $i =>$v) {	   
		   
	   ?>
	   
	   
	   
	   <div class="product-item col-lg-3 col-md-3 col-sm-6 col-xs-12 " >
						 
			
			 <div class="portfolio-item">
			 
				<div class="product-image">
									  
					<a href="<?=$com_href?>/<?=$v["tenkhongdau_$lang"]?>-<?=$v["id"]?>.html" title="<?=$v["ten_$lang"]?>">
					<img  effect="mono" inverse="true" class="img-responsive has-tt colorup colorUpped" src="thumb/380x380/1/<?php if($v['photo']!=NULL) echo _upload_news_l.$v['photo']; else echo 'images/no-image-available.png';?>" alt="<?=$v["alt_$lang"]?>" />
					</a>

				</div><!--end product-image-->
			
			
				 <div class="product-info portfolio-item-overlay">
				
					 <div class="product-name">

						<h3> <a href="<?=$com_href?>/<?=$v["tenkhongdau_$lang"]?>-<?=$v["id"]?>.html" title="<?=$v["ten_$lang"]?>"><?=catchuoi($v["ten_$lang"],80)?></a></h3>
			
					</div><!--end product-name-->  
		
					<div class="clear"></div>	

				</div><!--end product-info-->	
		
			 </div><!--end portfolio-item-->
		 
		<div class="clear"></div>
		</div> <!-- product-item -->
	

        <?php } }else echo '<p class="notice">'._noidungdangcapnhat.'</p>';  ?>    
        <div class="clear"></div>                                 
            
   <div class="wrap_paging">
            <div class="paging paging_ajax clearfix"><?=pagesListLimit_layout($url_link , $totalRows , $pageSize, $offset)?></div>
        </div><!--end wrap_paging-->     

        <div class="clear"></div>
        
        
        
        
    </div><!--end show-pro-->
    
</div><!--end block_content-->

</div><!--end container-->


</div><!--end main_content_web-->