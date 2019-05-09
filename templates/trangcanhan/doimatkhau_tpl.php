<script type="text/javascript">
$(document).ready(function() { 

	 $('#Send_tk').click(function() {  

			var code= $('#captcha-code').val();
			
			var emailaddressVal = $("#emailtk").val();

			// pass validation
			
			
			var passoldVal = $("#pass_old").val();
			if(passoldVal == '') {
				$("#passold_error").html('');
				$("#pass_old").after('<div class="error" id="passold_error"><b class=images_error><?=_nhapmatkhaucu?></b></div>');
				$("#pass_old").focus();
				return false
			}
			else{
				$("#passold_error").html('');
			}
			
			
			var passVal = $("#pass").val();
			if(passVal == '') {
				$("#pass_error").html('');
				$("#pass").after('<div class="error" id="pass_error"><b class=images_error><?=_xinnhapmatkhau?></b></div>');
				$("#pass").focus();
				return false
			}
			else{
				$("#pass_error").html('');
			}
			
			// repass validation
			var repassVal = $("#repass").val();
			if(repassVal == '') {
				$("#repass_error").html('');
				$("#repass").after('<div class="error" id="repass_error"><b class=images_error><?=_xinnhaplaimatkhau?></b></div>');
				$("#repass").focus();
				return false
			}
			else{
				$("#repass_error").html('');
			}
			if(repassVal !=passVal){
				$("#pass_error").html('');
				$("#pass").after('<div class="error" id="pass_error"><b class=images_error><?=_haimatkhaukhonggiong?></b></div>');
				$("#pass").focus();
				return false
			}else{
				$("#pass_error").html('');
				$("#repass_error").html('');
			}
			
			$.ajax({
				url:"ajax/reset_doimatkhau.php",
				type:"POST",
				data:{code:code,pass:passVal,passold:passoldVal,email:emailaddressVal},
				async:true,
				dataType:"text",
				success:function(response){
					//alert(response);
					if(response==1){//them thanh cong
						$("#after_submit").html('');
						$("#Send_tk").after(function() {
                            $(".customNotify").jmNotify({
								html: '<?=_doitaikhoanthanhcong?>',
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
					else if(response==4){ // passold ko dung
						$("#after_submit").html('');
						$("#Send_tk").after(function() {
                            $(".customNotify").jmNotify({
								html: '<?=_matkhaucukhongdung?>'
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

		$("#pass_old").val('');
		$("#pass").val('');
		$("#repass").val('');

		$("#captcha-code").val('');
		
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


<div class="bold-title"><?=_thaydoimatkhau?></div><!--end bold-title-->
 <input name="emailtk"  type="hidden" value="<?=$item_user['email']?>" id="emailtk" >
<table class="pwdtable change-pass">
    <tr>
        <td>
           <?=_matkhaucu?>
        </td>
        <td>
            <input type="password" name="pass_old" id="pass_old" class="keycode" style="width:300px;" />
             
        </td>
    </tr>
    <tr>
        <td>
           <?=_matkhaumoi?>
        </td>
        <td>
            <input type="password" name="pass" id="pass"  class="keycode" style="width:300px;" />
            
          
        </td>
    </tr>
    <tr>
        <td>
            <?=_nhaplaimatkhau?>
        </td>
        <td>
     <input name="repass" type="password" id="repass" class="keycode" style="width:300px;" />
          
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

