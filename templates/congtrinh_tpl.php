
<div id="main_content_web">



		 <div class="title-bg-web">
				<h3 class="title-bg-name"><span><a href="<?=$com?>.html"><?=$title_tcat?></a></span></h3>
		</div><!--END title_index--> 

    <div class="clear"></div>

<div class="block_content tintuc-box">



    <div class="clear"></div>
    
    <div class="show-pro">
		  <?php
       if(count($tintuc)>0){
    $com_href="cong-trinh";  
       foreach($tintuc as $i => $v_ct) {
     ?>
        <div  class="box_news_ct"   <?php if ( ($i+1)%4==0 ) {?> style="margin-right:0;"<?php }?>>
            <div class="image_boder_ct"><a href="<?=$com_href?>/<?=$v_ct["tenkhongdau"]?>-<?=$v_ct['id']?>.html" title="<?=$v_ct["ten_$lang"]?>"><img src="thumb/280x200/1/<?php if($v_ct['photo']!=NULL) echo _upload_news_l.$v_ct['photo']; else echo 'images/no-image-available.png';?>" onerror="this.src='images/noimage.gif';" /></a></div>
           
		  <div class="arrow_ct"></div>
		   <div class="box-info-news_ct">
		   
		    <h4 class="h4_news_ct"> <a href="<?=$com_href?>/<?=$v_ct["tenkhongdau_$lang"]?>-<?=$v_ct['id']?>.html" title="<?=$v_ct["ten_$lang"]?>"><?=catchuoi($v_ct["ten_$lang"],30)?></a></h4>
			
			
          <p class="news_mota_ct"><?=catchuoi($v_ct["mota_$lang"],130)?></p>
		   
		   </div><!--end box-right-news-->
		
         
          <div class="clear"></div>
        </div>
		
	   <?php if ( ($i+1)%4==0 ) {?> <div class="clear"></div><?php }?>
		
        <?php } }else echo '<p class="notice">'._noidungdangcapnhat.'</p>';  ?>    
        <div class="clear"></div>         
        <div class="clear"></div>                                 
            
   <div class="wrap_paging">
            <div class="paging paging_ajax clearfix"><?=pagesListLimit_layout($url_link , $totalRows , $pageSize, $offset)?></div>
        </div><!--end wrap_paging-->     

        <div class="clear"></div>
        
        
        
        
    </div><!--end show-pro-->
    
</div><!--end block_content-->

</div><!--end main_content_web-->