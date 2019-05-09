<?php	


	
	$d->reset();
	$sql = "select noidung_$lang from #_info where hienthi=1 and com='footer' order by stt,id desc";
	$d->query($sql);
	$footer_nd=$d->fetch_array();

	

if ($_GET["com"]=="de-vuong")
{
	  
      $d->reset();
  $sql = "select ten_$lang as ten,photo,link from #_image_url where hienthi=1 and com='mxh_nt' order by stt,id desc";
  $d->query($sql);
  $mxh_ft=$d->result_array();
}
else 
{
	
	    $d->reset();
  $sql = "select ten_$lang as ten,photo,link from #_image_url where hienthi=1 and com='mangxahoi_ft' order by stt,id desc";
  $d->query($sql);
  $mxh_ft=$d->result_array();
	
}

  
  

  
  
  
  $d->reset();
  $sql = "select id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,mota_$lang as mota,photo from #_news where tinnoibat>0 and hienthi=1 and com='news' order by id desc limit 10";
  $d->query($sql);
  $tintuc_ft=$d->result_array();
  


?>

<div class="container-fluid">

	<div class="row pd0 mg0">
	
 <script type="text/javascript">
                $(document).ready(function(e) {
                    $('#send_email_newsletter').click(function(){
                        var el = $('#email_newsletter');
                        var sex = $('input[type="radio"]:checked');
                        var first_name = $('#first_name');
                        var last_name = $('#last_name');
						
						 var phone_nt = $('#phone_newsletter');
						
                        var emailRegExp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.([a-z]){2,4})$/;
                        if(el.val()==''){el.focus();alert('<?=_emailError?>');return false;}
                        if(!emailRegExp.test(el.val())){
                            el.focus();
                            alert('<?=_emailError1?>');
                        }else{
                            $.ajax({
                                type: 'POST',
                                url : 'ajax/newsletter.php',
                           data: 'email='+el.val()+'&sex='+sex.val()+'&first_name='+first_name.val()+'&last_name='+last_name.val()+'&phone_nt='+phone_nt.val(),
                                success: function(result){
                                    alert(result);
                                }
                            }); 
                        }
                        return false;
                    });
                });
            </script> 
	
	
						<div class="form_newsletter">
						
							<div class="container">
							
								<div class="tieude_newsletter col-lg-4 col-md-3 col-sm-3 col-xs-12">
									<?=_dangkytuvan?>
								</div><!--end tieude_newsletter-->
								
								
								<form class="col-lg-8 col-md-9 col-sm-9 col-xs-12" action="#" method="post" id="subscribe_form" name="subscribe-form">
									<input type="email" name="phone_newsletter" id="phone_newsletter" value="<?=_sodienthoai?>....." onfocus="if(this.value =='<?=_sodienthoai?>.....') this.value=''" class="email-form keycode col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<input type="email" name="email_newsletter" id="email_newsletter" value="Email....." onfocus="if(this.value =='Email.....') this.value=''" class="col-lg-4 col-md-4 col-sm-4 col-xs-12 email-form keycode">
									<input type="submit" value="&nbsp;<?=_dangky?>&nbsp;" name="subscribe-go" id="send_email_newsletter" class="guimail col-lg-2 col-md-2 col-sm-2 col-xs-12">
									<div class="clear"></div>
								</form>
							<div class="clear"></div>
							
							</div><!--end container-->
					
							
						
						</div><!--end form_newsletter-->
	
	
	
		<div class="container">
		
	
	<div class="bg_footer_top">	
			
		  <div class="main-footer">


			<div class="left_footer col-lg-5 col-md-5 col-sm-5 col-xs-12">


				<div class="footer_tieude"><a href="lien-he.html"><?=$row_setting["ten_$lang"]?></a></div>
			
				<div class="content-footer">
			
				   <?=$footer_nd["noidung_$lang"]?>
			
				<div class="clear"></div>  
				
			

				</div><!--end content-footer-->


			</div><!--end left_footer-->


			<div class="center_footer_left col-lg-4 col-md-4 col-sm-6 col-xs-12">
			
			<div class="footer_tieude"><a><?=_tintuc?></a></div>
			
				<div class="content-footer">
				
				
					<div class="list_group_news">
					
					<?php foreach ($tintuc_ft as $i =>$v_tin) {?>
				
						<div class="item_new_ft">
						
							<div class="img_new_ft col-lg-4 col-md-3 col-sm-4 col-xs-4 pdl0">
								<a href="tin-tuc/<?=$v_tin["tenkhongdau"]?>-<?=$v_tin["id"]?>.html">
									<img src="thumb/110x70/1/<?=_upload_news_l.$v_tin["photo"]?>">
								</a>
							</div>
							
							<div class="des_new_ft col-lg-8 col-md-9 col-sm-8 col-xs-8">
								<a href="tin-tuc/<?=$v_tin["tenkhongdau"]?>-<?=$v_tin["id"]?>.html">
								<?=strip_tags(catchuoi($v_tin["ten"],100))?>
								</a>
							</div><!--end des_new_ft-->
							
							<div class="clear"></div>
						
						</div><!--end item_new_ft-->
						
					<?php }?>	
					
					</div><!--end list_group_news-->
											
				
				
				</div><!--end content-footer-->

			</div><!--end center_footer_left-->
				 
	

			
			
			<div class="right_footer col-lg-2 col-md-2 col-sm-6 col-xs-12">

				
				<div class="footer_tieude"><a><?=_mangxahoi?></a></div>
			
			
				<div class="content-footer ">
			
					<div class="list_group_li">
					
						<ul class="mangxahoi">
					
					<?php foreach ($mxh_ft as $i =>$v_mxh) {?>
						
						<li><a href="<?=$v_mxh["link"]?>" target="_blank"><img src="<?=_upload_hinhanh_l.$v_mxh["photo"]?>"><span><?=$v_mxh["ten"]?></span></a></li>
						
					<?php }?>	
						
						</ul><!--end mangxahoi-->
				
					
					</div><!--end list_group_li-->
							
				</div><!--end content-footer-->


			</div><!--end right_footer-->



		  <div class="clear"></div>

			</div><!--end footer_main-->

		  
		  </div><!--end bg_footer_top-->
		  
  
			
		
		</div><!--end container-->
			
	
	
	</div><!--end row pd0 mg0-->


</div><!--end container-fluid-->


<div class="bg_bottom_footer container-fluid">

	<div class="row pd0 mg0">
		
		<div class="container">
		
			
<div class="bottom_footer">

	<div class="left_bottom_footer col-lg-7 col-md-7 col-sm-12 col-xs-12">
	
	2017 Copyright © TAM NHIN SONG DA. All rights reserved. Web Design by Nina.vn
	
	</div><!--end left_bottom_footer-->
	
	<div class="right_bottom_footer col-lg-5 col-md-5 col-sm-12 col-xs-12">
	
	 <div class="counter">

         <ul>

           <li class="online"> <span><?=_online?>: </span><b><?=$count_user_online?></b></li>
          <li class="day"><span><?=_thongketuan?></span>:<b><?=$week_visitors?></b></li>
       
          <li class="statistics" style="border:none;"><span><?=_tongtruycap?></span>: <b><?=$all_visitors?></b></li> 

         </ul>
     
          <div class="clear"></div>   

        </div><!--end counter-->

	
	</div><!--end right_bottom_footer-->
	
	<div class="clear"></div>

	
</div><!--end bottom_footer-->


			
		</div>
			
	</div>		


</div><!--end bg_bottom_footer-->  
