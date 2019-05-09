<?php		

	$d->reset();
	$sql="select ten_$lang, tenkhongdau, id from #_product_list where hienthi=1  order by stt,id desc";
	$d->query($sql);
	$pro_cap1=$d->result_array();
	
	
	
	$d->reset();
	$sql="select ten_$lang, tenkhongdau, id,photo,mota_$lang from #_news where hienthi=1 and com='gioithieu' and noibat>0 order by stt,id desc limit 1";
	$d->query($sql);
	$about_indexnb=$d->result_array();
	
	
	
		$d->reset();
	$sql="select ten_$lang, tenkhongdau, id,photo,mota_$lang,ngaytao,luotxem from #_news where hienthi=1 and com='news' order by stt,id desc limit 8";
	$d->query($sql);
	$news_indexnb=$d->result_array();
	

?>

        <aside id="sidebar-primary-sidebar" class="sidebar" role="complementary" aria-label="Primary Sidebar" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
        
 
 <?php if (count($about_indexnb)>0 ) {?>
 
 	
     <!------------------------------START ABOUT----------------------->     
    
    <?php for ($i=0;$i<count($about_indexnb);$i++) {?>    
      <div id="bs-theme-about-1" class="primary-sidebar-widget widget widget_bs-theme-about">
      
      <h4 class="widget-heading"><span class="h-text"><?=$about_indexnb[$i]["ten_$lang"]?></span></h4><div class="bs-theme-shortcode bs-about">
        
        <h4 class="about-title">
        <a href="gioi-thieu/<?=$about_indexnb[$i]["tenkhongdau"]?>-<?=$about_indexnb[$i]["id"]?>.html"> 
        <img class="logo-image" src="timthumb.php?src=<?=_upload_news_l.$about_indexnb[$i]['photo']?>&h=285&w=285&zc=2&q=80" alt="<?=$about_indexnb[$i]["ten_$lang"]?>">
        </a> 
        </h4>
        
        <div class="about-text">
        <p><?=catchuoi($about_indexnb[$i]["mota_$lang"],300)?></p>
        </div>
        <div class="about-link heading-typo">
        <a href="gioi-thieu/<?=$about_indexnb[$i]["tenkhongdau"]?>-<?=$about_indexnb[$i]["id"]?>.html"><?=_xemtiep?>...</a>
        </div>
        </div> 
        
        </div><!--END bs-theme-about-1-->
        
     <?php }?>   
        
    <!------------------------------END ABOUT----------------------->      
 
 
 <?php }?>       
 
 
 
 	<!----------------------------------START DANH MUC SAN PHAM --------------------------------->
    
    
   <div id="categories-3" class="primary-sidebar-widget widget widget_categories">
        <h4 class="widget-heading"><span class="h-text"><?=_danhmucsanpham?></span></h4> 
        
            <ul>
    
    	<?php for ($i=0;$i<count($pro_cap1);$i++) 
		
		
		
		{?>
        
        
        
        <?php 
		
			$d->reset();
	$sql="select ten_$lang, tenkhongdau, id from #_product where hienthi=1 and id_list='".$pro_cap1[$i]["id"]."'  order by stt,id desc";
	$d->query($sql);
	$pro_count=$d->result_array();
	$count_sanpham=count($pro_count);
		
		
		?>
            
           <li class="cat-item cat-item-2"><a href="<?=$pro_cap1[$i]["tenkhongdau"]?>/" title="<?=$pro_cap1[$i]["ten_$lang"]?>"><?=$pro_cap1[$i]["ten_$lang"]?> <span class="post-count"><?=$count_sanpham?></span></a>
            </li>
		<?php }?>
    
            </ul>
        
        </div><!--END categories-3-->
    
    
    
    <!----------------------------------END DANH MUC SAN PHAM ------------------------------>
        
  
        
      <?php /*?>  <div id="bs-theme-subscribe-newsletter-1" class="  primary-sidebar-widget widget widget_bs-theme-subscribe-newsletter"><h4 class="widget-heading"><span class="h-text">Newsletter</span></h4><div class="bs-theme-shortcode bs-subscribe-newsletter">
        <div class="subscribe-message">
        <p>Subscribe to our email newsletter for useful tips and valuable resources, sent out every second Tuesday.</p>
        </div>
        <form method="post" action="http://feedburner.google.com/fb/a/mailverify" class="bs-subscribe-feedburner clearfix" target="_blank">
        <input type="hidden" value="#test" name="uri"/>
        <input type="hidden" name="loc" value="en_US"/>
        <input type="text" id="feedburner-email" name="email" class="feedburner-email" placeholder="Enter your e-mail .."/>
        <input class="feedburner-subscribe" type="submit" name="submit" value="Subscribe"/>
        </form> 
        </div> 
        
        </div><!--end bs-theme-subscribe-newsletter-1--><?php */?>
        
        
        
        
      <div id="bs-theme-recent-posts-1" class="primary-sidebar-widget widget widget_bs-theme-recent-posts">
        
        <h4 class="widget-heading"><span class="h-text">Tin tức gần đây</span></h4>
       
       <div class="bs-theme-shortcode bs-recent-posts">
       
        <ul class="listing listing-widget listing-widget-thumbnail listing-widget-simple-thumbnail-meta">
       
     <?php
	 $com_recent="tin-tuc";
	 for ($i=0;$i<count($news_indexnb);$i++) {?>   
        <li class="listing-item clearfix">
        <article class="post-579 post type-post status-publish format-standard has-post-thumbnail category-food category-lifestyle tag-slider" itemscope="itemscope" itemtype="http://schema.org/Article">
        <a href="<?=$com_recent?>/<?=$news_indexnb[$i]["tenkhongdau"]?>-<?=$news_indexnb[$i]["id"]?>.html"><img width="150" height="150" class="img-responsive wp-post-image" alt="<?=$news_indexnb[$i]["ten_$lang"]?>" title="<?=$news_indexnb[$i]["ten_$lang"]?>" srcset="timthumb.php?src=<?=_upload_news_l.$news_indexnb[$i]['photo']?>&h=80&w=80&zc=2&q=80, timthumb.php?src=<?=_upload_news_l.$news_indexnb[$i]['photo']?>&h=150&w=150&zc=2&q=80 2x"/></a>
        <h4 class="title"><a class="post-url" itemprop="url" rel="bookmark" href="<?=$com_recent?>/<?=$news_indexnb[$i]["tenkhongdau"]?>-<?=$news_indexnb[$i]["id"]?>.html" title="<?=$news_indexnb[$i]["ten_$lang"]?>"><span class="post-title" itemprop="headline"><?=$news_indexnb[$i]["ten_$lang"]?></span></a></h4>
        <div class="post-meta">
        <span class="time"><time class="post-published updated"><?=date("d-m-y",$news_indexnb[$i]["ngaytao"])?></time></span>
        <a href="<?=$com_recent?>/<?=$news_indexnb[$i]["tenkhongdau"]?>-<?=$news_indexnb[$i]["id"]?>.html" title="<?=$news_indexnb[$i]["ten_$lang"]?>" class="comments" itemprop="interactionCount"><?=$news_indexnb[$i]["luotxem"]?>&nbsp;<?=_luotxem?></a> </div> 
        </article>
        </li>
     <?php }?>   
        
        
        
        </ul>
        
         </div><!--end bs-theme-shortcode bs-recent-posts--> 
        
        </div><!--end "bs-theme-recent-posts-1-->
        
        
        </aside>  