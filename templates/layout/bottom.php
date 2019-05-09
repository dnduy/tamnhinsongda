<?php	


	$d->reset();
    $sql="select ten_$lang as ten, tenkhongdau_$lang as tenkhongdau, id,photo from #_news where hienthi=1 and com='news' and tinnoibat>0 order by stt,id desc";
    $d->query($sql);
    $tintuc_left=$d->result_array();


		$d->reset();
    $sql="select ten_$lang as ten, tenkhongdau_$lang as tenkhongdau, id,photo from #_news where hienthi=1 and com='dichvu' and tinnoibat>0 order by stt,id desc";
    $d->query($sql);
    $dichvu_left=$d->result_array();	
	

?>

<div class="bg_bottom_top">	
    
  <div class="main-bottom">


    <div class="left_bottom">


        <div class="content-bottom">
		
		
		 <h4><?=_tintuc?></h4>

          <ul class="ul_bottom">
	
		<?php foreach ($tintuc_left as $i =>$v) {?>
		  <li><a href="tin-tuc/<?=$v["tenkhongdau"]?>-<?=$v["id"]?>.html"><?=$v["ten"]?></a></li>
		<?php }?>  
		  
		  </ul>
		   
		  

        </div><!--end content-bottom-->


    </div><!--end left_bottom-->


	<div class="center_bottom">
	
		<div class="content-bottom">
		
		 <h4><?=_dichvu?></h4>
		 
		  <ul class="ul_bottom">
	
		<?php foreach ($dichvu_left as $i =>$v) {?>
		  <li><a href="dich-vu/<?=$v["tenkhongdau"]?>-<?=$v["id"]?>.html"><?=$v["ten"]?></a></li>
		<?php }?>  
		  
		  </ul>	
		
		
		</div><!--end content-bottom-->
	
	</div><!--end center_bottom-->
	
	
	
	
	<div class="center_bottom2">
	
		<div class="content-bottom">
		
		 <h4><?=_dangkynhantin?></h4>
		 
		  <div class="cont-foot">
					
					<div class="dknt_p">Đăng ký nhận tin từ chúng tôi và nhận thông tin khuyến mãi</div>
				
                    <div class="clear"></div>
					<input name="email-nhantin" onkeypress="doEnter_dknt(event)" class="email-nhantin" id="email-nhantin" placeholder="Địa chỉ Email của bạn" />
					<div>
						<div class="btn-sex" id="1">Nam</div>
						<div class="btn-sex" id="0">Nữ</div>
					</div>
					<div class="hepl-nhanmail">
						Thông tin của bạn sẽ được giữ kín tuyệt đối, và bạn có thể hủy đăng ký bất cứ lúc nào. Mỗi khách hàng chỉ tham gia chương trình 1 lần. 
					</div>
				</div>
			<script type="text/javascript">
$(document).ready(function() { 
	 $('.btn-sex').click(function() {  

			/// email validation
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;		
			var emailaddressVal = $("#email-nhantin").val();
			 var gender = $(this).attr('id');
			
		
			if(emailaddressVal == '') {
				$("#email_error").html('');
				$("#email-nhantin").after('<div class="error" id="email_error"><b class=images_error>Xin vui lòng nhập email.</b></div>');
				$("#email-nhantin").focus();
				return false
			}
			else if(!emailReg.test(emailaddressVal)) {
				$("#email_error").html('');
				$("#email-nhantin").after('<div class="error" id="email_error"><b class=images_error>Email không đúng định dạng.</b></div>');
				$("#email-nhantin").focus();
				return false
			 
			}
			else{
				$("#email_error").html('');
			}

			
			$.ajax({
				url:"ajax/newsletter.php",
				type:"POST",
				data:{email_newsletter:emailaddressVal, gender:gender,},
				async:true,
				dataType:"text",
				success:function(response){
					if(response==1){// thanh cong
						$("#after_submit").html('');
						$(".btn-sex").after(function() {
							
							
							$(".alert-container").html('<div class="alert alert-dismissable alert-shadow alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><p style="margin-right: 15px;">Đăng Ký Nhận Tin Thành Công !</p></div>');
							$(".alert-container").fadeIn().delay(2500).fadeOut();	
							
                          
                        });
						
					}
					else{
						$("#after_submit").html('');
						$(".btn-sex").after(function() {
							
							
					$(".alert-container").html('<div class="alert alert-dismissable alert-shadow alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><p style="margin-right: 15px;">Lỗi ! Email này đã tồn tại !</p></div>');
					$(".alert-container").fadeIn().delay(2500).fadeOut();	
							
							
                        
                        });
						
						clear_form();
					}
				}
			})
		return false;
	 });
	 function clear_form(){
		$("#email-nhantin").val('');
		
	 }
	  function redirect(){
		window.setTimeout(function () {
			<?php
				if(isset($_SESSION['duongdandangnhap']) && $_SESSION['duongdandangnhap']!=""){ ?>
				location.href = "<?=$_SESSION['duongdandangnhap']?>";
			<?php	}else{ ?>
				location.href = "index.html";
			<?php } ?>
		}, 1000)
	 }
	 
	 function doEnter_dknt(evt){
                // IE					// Netscape/Firefox/Opera
                var key;
                if(evt.keyCode == 13 || evt.which == 13){
                    build_newsletter(evt);
                }else{
                    return false;	
                }
                }
	
	function build_newsletter()
	{
		/// email validation
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;		
			var emailaddressVal = $("#email-nhantin").val();
			
			if(emailaddressVal == '') {
				$("#email_error").html('');
				$("#email-nhantin").after('<div class="error" id="email_error"><b class=images_error>Xin vui lòng nhập email.</b></div>');
				$("#email-nhantin").focus();
				return false
			}
			else if(!emailReg.test(emailaddressVal)) {
				$("#email_error").html('');
				$("#email-nhantin").after('<div class="error" id="email_error"><b class=images_error>Email không đúng định dạng.</b></div>');
				$("#email-nhantin").focus();
				return false
			 
			}
			else{
				$("#email_error").html('');
			}

			
			$.ajax({
				url:"ajax/newsletter.php",
				type:"POST",
				data:{email_newsletter:emailaddressVal,},
				async:true,
				dataType:"text",
				success:function(response){
					if(response==1){// thanh cong
						
						
					$('.alert-container').html('<div class="alert alert-dismissable alert-shadow alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><p style="margin-right: 15px;">Đăng Ký Nhận Tin Thành Công !</p></div>');
                    $('.alert-container').fadeIn().delay(2500).fadeOut();
						
                          
                       
						
					}
					else{
						
					
					
					$('.alert-container').html('<div class="alert alert-dismissable alert-shadow alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><p style="margin-right: 15px;">Lỗi ! Email này đã tồn tại !</p></div>');
                    $('.alert-container').fadeIn().delay(2500).fadeOut();
					
                           
						
						clear_form();
					}
				}
			})
		return false;
	 
			
		
	}
				
	 
});
	
</script>
		
		
		</div><!--end content-bottom-->
	
	</div><!--end center_bottom2-->



    <div class="right_bottom">


        <div class="content-bottom">
		
		<h4>Fanpage</h4>

		<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.async=true;
			  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.4";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, "script", "facebook-jssdk"));</script>




     <div class="fb-page" data-href="<?=$row_setting["fanpage"]?>" data-width="290" data-height="175" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"></div>
    
    

		
		
		<div class="clear"></div>    

        </div><!--end content-bottom-->
		

    </div><!--end right_bottom-->



  <div class="clear"></div>

    </div><!--end bottom_main-->

  
  </div><!--end bg_bottom_top-->
