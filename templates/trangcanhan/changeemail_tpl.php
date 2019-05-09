<script type="text/javascript">
$(document).ready(function() { 

	 $('#Send_tk').click(function() {  

			var code= $('#captcha-code').val();
			
			/// email validation
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			
				var emailaddressVal = $("#emailtk").val();
				//var emailhientai = <?=$_SESSION["login"]["email"]?>;
			
			
			// email cu
			var emailoldVal = $("#email_old").val();

			if(emailoldVal == '') {
				$("#emailold_error").html('');
				$("#email_old").after('<div class="error" id="emailold_error"><b class=images_error><?=_emailError?>.</b></div>');
				$("#email_old").focus();
				return false
			}
			else if(!emailReg.test(emailoldVal)) {
				$("#emailold_error").html('');
				$("#email_old").after('<div class="error" id="emailold_error"><b class=images_error><?=_emailError1?>.</b></div>');
				$("#email_old").focus();
				return false
			 
			}
			else if(emailoldVal != emailaddressVal){
				$("#emailold_error").html('');
				$("#email_old").after('<div class="error" id="emailold_error"><b class=images_error><?=_emailhientaikhongdung?></b></div>');
				$("#email_old").focus();
				return false
			}
			else
			{
				$("#emailold_error").html('');	
			}
			
			
		// email moi
			var emailnewVal = $("#EmailNew").val();

			if(emailnewVal == '') {
				$("#EmailNew_error").html('');
				$("#EmailNew").after('<div class="error" id="EmailNew_error"><b class=images_error><?=_emailError?>.</b></div>');
				$("#EmailNew").focus();
				return false
			}
			else if(!emailReg.test(emailnewVal)) {
				$("#EmailNew_error").html('');
				$("#EmailNew").after('<div class="error" id="EmailNew_error"><b class=images_error><?=_emailError1?>.</b></div>');
				$("#EmailNew").focus();
				return false
			 
			}
			else{
				$("#EmailNew_error").html('');
			}
			
			
			
			
			// check reemail validation
			var reemailVal = $("#reemail").val();
			if(reemailVal == '') {
				$("#reemail_error").html('');
				$("#reemail").after('<div class="error" id="reemail_error"><b class=images_error><?=_xinnhaplaiemail?></b></div>');
				$("#reemail").focus();
				return false
			}
			else{
				$("#reemail_error").html('');
			}
			if(reemailVal !=emailnewVal){
				$("#email_error").html('');
				$("#EmailNew").after('<div class="error" id="email_error"><b class=images_error><?=_haiemailkhonggiong?></b></div>');
				$("#EmailNew").focus();
				return false
			}else{
				$("#email_error").html('');
				$("#reemail_error").html('');
			}
			
		
			$.ajax({
				url:"ajax/reset_email.php",
				type:"POST",
				data:{code:code,emailnew:emailnewVal,emailold:emailoldVal,email:emailaddressVal},
				async:true,
				dataType:"text",
				success:function(response){
					//alert(response);
					if(response==1){//them thanh cong
						$("#after_submit").html('');
						$("#Send_tk").after(function() {
                            $(".customNotify").jmNotify({
								html: '<?=_doiemailthanhcong?>',
								delay:1500,
								onClose:redirect()
							});	
                        });
						
						change_captcha();
						clear_form();
					}else if(response==3){ // insert ko thanh cong
						$("#after_submit").html('');
						$("#Send_tk").after(function() {
                            $(".customNotify").jmNotify({
								html: '<?=_vuilongquaylaisau?>'
							});	
                        });
					
						change_captcha();
						clear_form();
					}
					else if(response==4){ // emailold ko dung
						$("#after_submit").html('');
						$("#Send_tk").after(function() {
                            $(".customNotify").jmNotify({
								html: '<?=_emailhientaikhongdung?>'
							});	
                        });
					
						change_captcha();
						clear_form();
					}
					else{
						$("#after_submit").html('');
						$("#Send_tk").after(function() {
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


<div class="bold-title"><?=_suadiachiemail?></div><!--end bold-title-->
 <input name="emailtk"  type="hidden" value="<?=$item_user['email']?>" id="emailtk" >
<table class="pwdtable change-email">
	
    <tr>
        <td>
           <?=_emailhientai?>
        </td>
        <td>
            <input type="email" name="email_old" id="email_old" class="keycode" style="width:300px;" />
             
        </td>
    </tr>

    <?php /*?><tr>
        <td>
           <?=_emailhientai?>
        </td>
        <td>
           <div class="collection"> <?=$item_user['email']?></div>
             
        </td>
    </tr><?php */?>
    <tr>
        <td>
           <?=_emailmoi?>
        </td>
        <td>
            <input type="email" name="EmailNew" id="EmailNew"  class="keycode" style="width:300px;" />
            
          
        </td>
    </tr>
    
    
    <tr>
        <td>
            <?=_nhaplaiemail?>
        </td>
        <td>
     <input name="reemail" type="email" id="reemail" class="keycode" style="width:300px;" />
          
        </td>
    </tr>
    
    

    <tr>
		
    
     <td> 					
                          
          <label for="captcha-code" class="control-label"><span class="required">*</span><?=_mabaove?>: </label><!--end captcha-code--> 
      </td>
      
      
       <td>   
            
            <div class="form-field" style="margin:0; padding:0;" >
              
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
            </div><!--end controls-->
    		
            </div><!--end form-field-->
          
          </td>
      
			</tr>
    
    <tr>
        <td></td>
        <td>
            <input type="submit" value="<?=_luu?>" id="Send_tk" class="button-blue" style="width:57px;" /></td>
           
    </tr>
</table>


<style>

#captcha-wrap {
    width: 290px;
    border: solid #870500 1px;
	float:none;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    border-radius: 10px;
    background: #870500;
    text-align: left;
    padding: 3px;
    margin-top: 3px;
    height: 100px;
    margin: 0 auto;
}

</style>


</div><!--END pad10-->

<script type="text/javascript">
    $(document).ready(function () {
								
        $(".datetimepicker").datepicker({
            dateFormat: "dd-mm-yy",
            changeYear: true,
            changeMonth: true,
            yearRange: "-100:+100"
        });
		
		
		
		
	});

   
</script>


<link rel="stylesheet" type="text/css" href="js/datepicker/jquery-ui.css" media="all" />
<script src="js/posting/datepicker/jquery.ui.core.js" type="text/javascript"></script>
<script type="text/javascript" src="js/datepicker/jquery.ui.datepicker.js"></script>

