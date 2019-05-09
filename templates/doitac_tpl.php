<div id="main_content_web">

<div class="title-info">
        <h3 class="title-info-bg"><?=$title_tcat?></h3>
</div><!--END title_index--> 

<div class="block_content">

    

    <div class="clear"></div>
    
    <div class="show-pro">
    
        <div class="product-group">
        
       
		<?php
		   if(count($doitac)>0){
		$com_href="san-pham";	 
		   for($j=0,$count_product=count($doitac);$j<$count_product;$j++){
	   ?>
       
       
       <div class="product-item" <?php if ( ($j+1)%3==0) {?> style="margin-right:0;" <?php }?>>
                     
                           
		<div class="product-image">
                              
			<a href="<?=$doitac[$j]["link"]?>" target="_blank" title="<?=$doitac[$j]["ten_$lang"]?>">
		<img  effect="mono" inverse="true" class="img-responsive has-tt colorup colorUpped" src="thumb/210x150/2/<?php if($doitac[$j]['photo']!=NULL) echo _upload_hinhanh_l.$doitac[$j]['photo']; else echo 'images/no-image-available.png';?>" alt="<?=$doitac[$j]["alt_$lang"]?>" />
		</a>
        
		</div><!--end product-image-->
							
  
  <div class="product-name">

     <h3> <a href="<?=$doitac[$j]["link"]?>" target="_blank" title="<?=$doitac[$j]["ten_$lang"]?>"><?=catchuoi($product[$j]["ten_$lang"],70)?></a></h3>

  </div><!--end product-name-->
							
          
    <div class="clear"></div>
	</div> <!-- product-item -->
       
       <?php if(($j+1)%3==0){?> <div class="clear" ></div><?php }?>		
        
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