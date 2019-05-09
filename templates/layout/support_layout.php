<?php		
	
	$d->reset();
	$sql="select id,link,ten_$lang from #_video where hienthi=1   order by stt,id desc";
	$d->query($sql);
	$video=$d->result_array();
	
	
	$d->reset();			
	$sql_mau = "select * from #_bgintro ";			
	$d->query($sql_mau);			
	$bgintro = $d->fetch_array();
	

?>

<div class="support_index wow fadeInUp" style="background:url(<?=_upload_color_l.$bgintro["photo"]?>) no-repeat center;">

<div class="video-support" >

<a href="video-clip.html">



</a>

    <div class="support-online">
    	
        <h4>Hãy gọi ngay cho chúng tôi</h4>
        
        <div class="content-support-online">
        
        	<?=$row_setting["support_$lang"]?>
        
        </div><!--end content-support-online-->
    
    
    </div><!--end support-online-->

<div class="clear"></div>

</div><!--end video-support-->

   </div><!--end support_index-->