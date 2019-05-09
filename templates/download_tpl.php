
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
		   for($i=0,$count_tintuc=count($tintuc);$i<$count_tintuc;$i++){
	   ?>
        <div  class="box_news<?php if($i>(count($tintuc)-2)) echo ' noborder'; ?>">
            <div class="image_boder"><a href="<?=$com?>/<?=$tintuc[$i]["tenkhongdau_$lang"]?>-<?=$tintuc[$i]['id']?>.html" title="<?=$tintuc[$i]["ten_$lang"]?>"><img src="thumb/175x130/2/<?php if($tintuc[$i]['photo']!=NULL) echo _upload_news_l.$tintuc[$i]['photo']; else echo 'images/no-image-available.png';?>" onerror="this.src='images/noimage.gif';" /></a></div>
           
		    <div class="box-right-news">
			
			<h4 class="h4_news"> <a href="<?=$com?>/<?=$tintuc[$i]["tenkhongdau_$lang"]?>-<?=$tintuc[$i]['id']?>.html" title="<?=$tintuc[$i]["ten_$lang"]?>"><?=$tintuc[$i]["ten_$lang"]?></a></h4>
          
			<div class="date-post"><i class="fa fa-calendar" aria-hidden="true"></i><?=date('d-m-Y',$tintuc[$i]["ngaytao"])?> <span><?=_luotxem?>:<?=$tintuc[$i]['luotxem']?></span></div>
		  
          <p class="news_mota"><?=catchuoi($tintuc[$i]["mota_$lang"],430)?></p>

			</div><!--end box-right-news-->	
		   
          
         
          <div class="clear"></div>
        </div>
        <?php } }else echo '<p class="notice">'._noidungdangcapnhat.'</p>';  ?>    
        <div class="clear"></div>                                 
            
   <div class="wrap_paging">
            <div class="paging paging_ajax clearfix"><?=pagesListLimit_layout($url_link , $totalRows , $pageSize, $offset)?></div>
        </div><!--end wrap_paging-->     

        <div class="clear"></div>
        
        
        
        
    </div><!--end show-pro-->
    
</div><!--end block_content-->

</div><!--end main_content_web-->