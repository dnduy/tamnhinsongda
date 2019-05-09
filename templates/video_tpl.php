<div id="main_content_web">


<ul class="breadcrumb">

<li><a href="" class="transitionAll"><?=_trangchu?></a> </li>


<li><a  class="transitionAll"><?=$title_tcat?></a></li>


</ul><!--end breadcrumb-->

<div class="clear"></div>

<div class="block_content">

    <style>
	
	a.detail_view
	{
	margin: 10px auto;
	}
	</style>

    <div class="clear"></div>
    
    <div class="show-pro">
    
        <div class="product-group">
        
       
		<?php
		   if(count($tintuc)>0){
		$com_href="video-clip";	 
		   for($j=0,$count_product=count($tintuc);$j<$count_product;$j++){
	   ?>
       
	   <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12  mg0 des320">
       
       <div class="product-item">
                     
                           
		<div class="product-image">
                              
			<a href="<?=$tintuc[$j]["tenkhongdau"]?>" title="<?=$tintuc[$j]["ten"]?>">
				<img src="<?=video_image($tintuc[$j]['link'])?>"/>
			</a>
        
		</div><!--end product-image-->
							
							
					
		 <div class="product-info">
			
				 <div class="product-name">

					<h3> <a href="<?=$tintuc[$j]["tenkhongdau"]?>" title="<?=$tintuc[$j]["ten"]?>"><?=catchuoi($tintuc[$j]["ten"],30)?></a></h3>
					
					
			
					
					
					
				</div><!--end product-name-->  
				
				<a class="detail_view" href="<?=$tintuc[$j]["tenkhongdau"]?>"><?=_chitiet?></a>
			
				<div class="clear"></div>	

			</div><!--end product-info-->	
					
  
  
              	<div class="clear"></div>
	</div> <!-- product-item -->
       
	   
	   </div>
       
        <?php } }else echo '<p class="notice">'._noidungdangcapnhat.'</p>';  ?>    
        <div class="clear"></div>                                 
             
   <div class="wrap_paging">
            <div class="paging paging_ajax clearfix"><?=pagesListLimit_layout($url_link , $totalRows , $pageSize, $offset)?></div>
        </div><!--end wrap_paging-->     

        <div class="clear"></div>
        
        
        
        
    </div><!--end show-pro-->
    
     </div><!--end product-group-->
    
    
    
</div><!--end block_content-->

</div><!--end main_content_web-->