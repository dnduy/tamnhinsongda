<script type="text/javascript">
$(document).ready(function() { 

	 $('#Send_newsletter').click(function() {  

			var code= $('#captcha-code').val();
			
			/// email validation
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			
			var emailaddressVal = $("#emailtk").val();
			//var nhantin=$("#nhantin_member").val();
			var nhantin= $('input[name=nhantin_member]:checked').val();
		
		
			$.ajax({
				url:"ajax/reset_newsletter.php",
				type:"POST",
				data:{code:code,email:emailaddressVal,nhantin:nhantin},
				async:true,
				dataType:"text",
				success:function(response){
					//alert(response);
					if(response==1){//them thanh cong
						$("#after_submit").html('');
						$("#Send_newsletter").after(function() {
                            $(".customNotify").jmNotify({
								html: '<?=_dangkynhantinthanhcong?>',
								delay:1500,
								onClose:redirect()
							});	
                        });
						
						change_captcha();
						clear_form();
					}else if(response==2){ // update thanh cong
						$("#after_submit").html('');
						$("#Send_newsletter").after(function() {
                            $(".customNotify").jmNotify({
								html: '<?=_capnhatthanhcong?>',
								delay:1500,
								onClose:redirect()
							});	
                        });
					
						change_captcha();
						clear_form();
					}
					
					
					else if(response==3){ // đã tồn tại
						$("#after_submit").html('');
						$("#Send_newsletter").after(function() {
                            $(".customNotify").jmNotify({
								html: '<?=_emailtontai?>'
							});	
                        });
					
						change_captcha();
						clear_form();
					}
					else if(response==4){ // emailold ko dung
						$("#after_submit").html('');
						$("#Send_newsletter").after(function() {
                            $(".customNotify").jmNotify({
								html: '<?=_emailhientaikhongdung?>'
							});	
                        });
					
						change_captcha();
						clear_form();
					}
					else{
						$("#after_submit").html('');
						$("#Send_newsletter").after(function() {
                            	$(".customNotify").jmNotify({
								html: '<?=_loinhapmasai?>'
							});	
                        });
					
						$("#captcha-code").focus();
					}
				}
			})
			
		return false;
	 });
	 // refresh captcha
	 $('img#captcha-refresh').click(function() {  		
			change_captcha();
	 });
	 function change_captcha(){
		document.getElementById('captcha').src="ajax/check_captcha/get_captcha.php?rnd=" + Math.random();
	 }

	 
	 function clear_form(){

		
		$("#EmailNew").val('');
	
		
	 }
	  function redirect(){

		window.setTimeout(function () 
		{
			location.href="http://<?=$config_url?>/trang-ca-nhan/quan-ly-tai-khoan/member";
			
		}, 2000)
		
	 }
});	
</script>	


<div class="pad10">


<div class="bold-title"><?=_quanlybantin?></div><!--end bold-title-->

<form action="" class="form-horizontal" id="frm_newsletter" method="post" name="frm_newsletter" enctype="multipart/form-data">
 <input name="emailtk"  type="hidden" value="<?=$item_user['email']?>" id="emailtk" >

<input class="ui-inputCheckbox" id="nhantin_member" name="nhantin_member" value="1" <?php if ($item_user["email"]==$item_newsletter["email"]) {?> checked="checked" <?php }?>   type="checkbox">

<label class="inline ui-inputCheckboxLabel" for="categorie_id_1">Newsletter</label>

					
                          
       
      
      
  
            
            <div class="form-field" style="margin:0; padding:0;" >
            
               <label for="captcha-code" class="control-label"><span class="required">*</span><?=_mabaove?>: </label><!--end captcha-code--> 

              
              <div class="controls">  
                <div id="captcha-wrap">
                    <div class="captcha-box">
                        <img src="ajax/check_captcha/get_captcha.php" alt="" id="captcha" />
                    </div>
                    <div class="text-box">
                        <p>Type the two words:</p>
                        <input name="captcha-code" type="text" id="captcha-code" />
                    </div>
                    <div class="captcha-action">
                        <img src="images/login_resity/refresh.jpg"  alt="" id="captcha-refresh" />
                    </div>
                </div>
                
                 <div class="clear"></div>
                
            </div><!--end controls-->
            
            <div class="clear"></div>
    		
            </div><!--end form-field-->
 


<div class="xacthuc_chinhsach"><?=_chinhsacbantin?>&nbsp;<?=$row_setting["ten_$lang"]?></div>


 <input type="submit" value="<?=_luu?>"  id="Send_newsletter" class="button-blue">
 
 </form>

</div><!--END pad10-->


