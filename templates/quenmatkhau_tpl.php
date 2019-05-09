<script type="text/javascript">
$(document).ready(function() { 
	 $('#Send_forgetpass').click(function() {  
										
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			/// email validation
			var emailaddressVal = $("#email_forgetpass").val();
			var code= $('#captcha-code-forgetpass').val();
			
			
			if(emailaddressVal == '') {
				$("#email_forgetpass_error").html('');
				$("#email_forgetpass").after('<label class="error" id="email_forgetpass_error"><?=_emailError?>.</label>');
				$("#email_forgetpass").focus();
				return false
			}
			else if(!emailReg.test(emailaddressVal)) {
				$("#email_forgetpass_error").html('');
				$("#email_forgetpass").after('<label class="error" id="email_forgetpass_error"><?=_emailError1?>.</label>');
				$("#email_forgetpass").focus();
				return false
			 
			}
			else{
				$("#email_forgetpass_error").html('');
			}
		
			
			$.ajax({
				url:"ajax/quenmatkhau.php",
				type:"POST",
				data:{code:code,email:emailaddressVal},
				async:true,
				dataType:"text",
				success:function(response){
					//alert(response);
					if(response==1){// thanh cong
						$("#after_submit").html('');
						$("#Send_forgetpass").after(function() {
                            $(".customNotify").jmNotify({
								html: '<?=_laylaimatkhauerro?>',
								delay:5000,
								onClose:redirect()
								
							});	
                        });
						
						change_captcha();
						clear_form();
			

					}
					else if(response==2){ //  email khong ton tai
						$("#after_submit").html('');
						$("#Send_forgetpass").after(function() {
                            $(".customNotify").jmNotify({
								html: '<?=_loithongtinemail?>'
							});	
                        });
						
						$("#captcha-code-forgetpass").focus();
					}
					else{
						
						$("#after_submit").html('');
						$("#Send_forgetpass").after(function() {
                            $(".customNotify").jmNotify({
								html: '<?=_loinhapmasai?>'
							});	
                        });
						
						$("#captcha-code-forgetpass").focus();

						
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
		$("#email_forgetpass").val('');
		$("#captcha-code-forgetpass").val('');
	 }
	 function redirect(){
		window.setTimeout(function () {
			location.href = "index.html";
		}, 5000)
	 }
});
	
</script>		 



<div id="main_content_web">


<ul class="breadcrumb">

<li><a href="index.html" class="transitionAll"><?=_trangchu?></a> </li>

<li><a href="<?=$com?>.html" class="transitionAll"><?=_quenmatkhau?></a></li>

</ul><!--end breadcrumb-->
	


    <div class="clear"></div>


<div class="block_content">



    <div class="clear"></div>
    
    <div class="show-pro">

      
  <div class="box-container-register">
  
  <h5><?=_cungcapthongtinnhanmatkhau?></h5>
  
  <p class="register"><u><?=_batbuoc1?> <span class="font-red">*</span> <?=_batbuoc2?>.</u></p>
	  <form class="form-horizontal" name="quenmatkhau_from" id="quenmatkhau_from" method="post">
		
		<div class="content">
		  <table class="form">      
			<tbody><tr>
				<td>
             
					<div class="control-group">
						<label class="control-label-tan" for="email"> Email&nbsp;<span class="required">(*)</span></label>
						<div class="controls">
							<input name="email_forgetpass" size="30" type="text" id="email_forgetpass" class="input_text"/>
						</div>
					</div><!--end control-group-->
                    
				</td>
			</tr>
            
            
            <tr>
				<td>
					<div class="control-group">
	
    
    					  <!-- Captcha HTML Code -->
                          
        <label for="captcha-code-forgetpass"  class="control-label-tan"><span class="required">*</span><?=_mabaove?>:</label>                   
            
            <div class="form-field" style="margin:0; padding:0;" >
                
                <div id="captcha-wrap">
                    <div class="captcha-box">
                        <img src="ajax/check_captcha/get_captcha.php" alt="" id="captcha" />
                    </div>
                    <div class="text-box">
                        <p>Type the two words:</p>
                        <input name="captcha-code-forgetpass" type="text" id="captcha-code-forgetpass" />
                    </div>
                    <div class="captcha-action">
                        <img src="images/login_resity/refresh.jpg"  alt="" id="captcha-refresh" />
                    </div>
                </div>
            </div>
            
                    <div class="clear"></div>
    					
						
					</div>
                    
           <h5><?=_notesendemailbox?></h5>   
       
				</td>
			</tr>

            
			
		  </tbody>
          </table>
		</div>
        
        
     
        
	
		
		
	
    <div class="buttons" style="text-align:center;">
		  
			
            <div class="form-field" style="margin:0; padding:0;">
                
                <p class="result"><input value="<?=_laylaimatkhau?>" type="submit" id="Send_forgetpass" />
                 <input type="reset" value="<?=_nhaplai?>" class="reset"/></p>
                </div>
			
		  
		</div>
	</form>
    
    <br />
    
    </div><!--end box-container-->
        
   
          
    </div><!--end show-pro-->
    
 </div><!--end block_content-->
 
 </div><!--end main_content_web-->
