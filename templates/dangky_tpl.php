<div id="main_content_web">


<ul class="breadcrumb">

<li><a href="index.html" class="transitionAll"><?=_trangchu?></a> </li>

<li><a href="<?=$com?>.html" class="transitionAll"><?=_dangky?></a></li>


</ul><!--end breadcrumb-->

    <div class="clear"></div>


<div class="block_content">

    <div class="clear"></div>
    
    <div class="show-pro">

	
	<div class="tab-pane" id="Registration" style="display: block;">
            
			
			 <form class="form-horizontal" name="dangkytk_form" action="#" method="post" enctype="multipart/form-data" id="dangkytk_form register">
                                <div class="form-group">
                                    <label for="frm_name" class="col-sm-4 control-label"><?=_hoten?><span>*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="frm_name" required/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="emailtk" class="col-sm-4 control-label">Email<span>*</span></label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="emailtk" required/>
                                    </div>
                                </div>
                        
                                <div class="form-group">
                                    <label for="pass_tk" class="col-sm-4 control-label"><?=_matkhau?><span>*</span></label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" id="pass_tk" required/>
                                        <div class="clear"></div>
                                        <span class="note-frm"><?=_matkhauminimum?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="repass_tk" class="col-sm-4 control-label"><?=_nhaplaimatkhau?><span>*</span></label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" id="repass_tk" required/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="ngaysinh_tk" class="col-sm-4 control-label"><?=_ngaysinh?><span>*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="ngaysinh_tk" required/>
                                    </div>
                                </div>
                                <script>
									  $(function() {
										$( "#ngaysinh_tk" ).datepicker({
											dateFormat: "dd-mm-yy",
											changeMonth: true,
											changeYear: true,
											// dayNamesMin: [ "CN", "T2", "T3", "T4", "T5", "T6", "T7" ],
											// monthNamesShort: [ "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12" ],
											yearRange: "1900:now"
										});
									  });
								  </script>

								  <div class="form-group">
                                    <label for="gender_tk" class="col-sm-4 control-label"><?=_gioitinh?><span>*</span></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="gioitinh" id="gender_tk">
                                        	<option value="" checked><?=_luachon?></option>
                                        	<option value="1"><?=_sexnam?></option>
                                        	<option value="0"><?=_sexnu?></option>
                                        	<option value="2"><?=_sexkhac?></option>
                                        </select>
                                    </div>
                                </div>



                               <?php /*?> <div class="form-group">
                                    <label for="gender_tk" class="col-sm-4 control-label"><?=_quocgia?>*</label>
                                    <div class="col-sm-8">
                                        
                                    	 <select class="form-control" name="quocgia" id="quocgia">
						                    <option value="0"><?=_chonquocgia?></option>
						                    <?php 
						                        //Load quoc gia
						                        $d->reset();
						                        $sql="select id,ten_$lang from #_city_danhmuc where hienthi =1 order by stt asc";
						                        $d->query($sql);
						                        $quocgia = $d->result_array();
						                        for($i=0,$count_tinh=count($quocgia);$i<$count_tinh;$i++) { ?>
						                         <option value="<?=$quocgia[$i]['id']?>"><?=$quocgia[$i]["ten_$lang"]?></option>
						                    <? }?>
						                </select>	


                                    </div>
                                </div><?php */?>



                                <div class="form-group">
                                    <label for="gender_tk" class="col-sm-4 control-label"><?=_tinhthanh?><span>*</span></label>
                                    <div class="col-sm-8">
						                   <select class="form-control" name="tinh" id="tinh">
							                    <option value="0"><?=_chontinhthanh?></option>
												
												<?php 
						                        //Load tinh thanh
						                        $d->reset();
						                        $sql="select id,ten_$lang from #_city_list where hienthi =1 order by stt asc";
						                        $d->query($sql);
						                        $tinh = $d->result_array();
						                        for($i=0,$count_tinh=count($tinh);$i<$count_tinh;$i++) { ?>
						                         <option value="<?=$tinh[$i]['id']?>"><?=$tinh[$i]["ten_$lang"]?></option>
						                    <?php }?>
							                   
							                </select>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label for="gender_tk" class="col-sm-4 control-label"><?=_quanhuyen?><span>*</span></label>
                                    <div class="col-sm-8">
         
							            <select class="form-control" name="huyen" id="huyen">
				                  		  <option value="0"><?=_chonquanhuyen?></option>
				               			</select>


                                    </div>
                                </div>

                                

                                <div class="form-group">
                                    <label for="diachi" class="col-sm-4 control-label"><?=_diachi?></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="diachi" class="form-control" id="diachi"/>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label for="dienthoai" class="col-sm-4 control-label"><?=_dienthoai?><span>*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="dienthoai" class="form-control" id="dienthoai" />
                                    </div>
                                </div>
								
								
								<div class="form-group form-group-captcha">
                                  <label for="captcha" class="col-sm-4 control-label"><?=_macaptcha?><span>*</span></label>
								  <div id="captcha-wrap">
									<div class="captcha-box">
										<img src="ajax/check_captcha/get_captcha.php"  id="captcha" />
									</div><!--end captcha-box-->
									<div class="text-box">
										<p>Type the two words:</p>
										<input name="captcha-code" type="text" id="captcha-code" />
									</div>
									<div class="captcha-action">
										<img src="images/login_resity/refresh.jpg"  alt="" id="captcha-refresh" />
									</div>
								</div><!--end captcha-wrap-->
								  
                                </div><!--end form-group-->
								
								
								
								
          
                           
                             
				            

                                <div class="row">
                                    <div class="col-sm-4">
                                    </div>
                                    <div class="col-sm-8">
                                        <button type="button" class="btn btn-primary btn-sm btn-regis" id="Send_tk"><?=_gui?></button>
                                    </div>
                                </div>
                                </form>
                           
			
			
			
		</div>



          
    </div><!--end show-pro-->
    
 </div><!--end block_content-->
 
 </div><!--end main_content_web-->


<script type="text/javascript">
$(document).ready(function() { 	


//Load combobox tinh thanh - quan huyen - Phuong xa
	/*$("#quocgia").change(function(){
		var id_danhmuc=$(this).val();
		$("#tinh").load('ajax/ajax_national.php?id_danhmuc='+id_danhmuc);
	});*/

	$("#tinh").change(function(){
		var id_list=$(this).val();
		$("#huyen").load('ajax/ajax_city.php?id_list='+id_list);
	});
	
	/*$("#huyen").change(function(){
		var id_cat=$(this).val();
		$("#phuong").load('ajax/ajax_city_item.php?id_cat='+id_cat);
	});*/
	

/************************************** Start Send Login **************************/	
	 $('#send_login').click(function() {  

			/// email validation
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			var emailaddressVal = $("#email_login").val();
			
			if(emailaddressVal == '') {
				$("#email_error").html('');
				$("#email_login").after('<div class="error" id="email_error"><b class=images_error><?=_emailError?>.</b></div>');
				$("#email_login").focus();
				return false
			}
			else if(!emailReg.test(emailaddressVal)) {
				$("#email_error").html('');
				$("#email_login").after('<div class="error" id="email_error"><b class=images_error><?=_emailError1?>.</b></div>');
				$("#email_login").focus();
				return false
			 
			}
			else{
				$("#email_error").html('');
			}
		
			
			// pass validation
			var passVal = $("#pass_login").val();
			if(passVal == '') {
				$("#pass_error").html('');
				$("#pass_login").after('<div class="error" id="pass_error"><b class=images_error><?=_xinnhapmatkhau?>.</b></div>');
				$("#pass_login").focus();
				return false
			}
			else{
				$("#pass_error").html('');
			}
			
			
			
			
			
			$.ajax({
				url:"ajax/login.php",
				type:"POST",
				data:{email:emailaddressVal, pass:passVal},
				async:true,
				dataType:"text",
				success:function(response){
					if(response==1){// thanh cong
						$("#after_submit").html('');
						$("#send_login").after(function() {
                            redirect_login();
                        });
						
					}
					else{
						$("#after_submit").html('');
						$("#send_login").after(function() {
                            $(".customNotify").jmNotify({
								html: '<?=_loitaikhoan?>'
							});	
                        });
						
						clear_form_login();
					}
				}
			})
		return false;
	 });
	 function clear_form_login(){
		$("#email_login").val('');
		$("#pass_login").val('');
	 }
	  function redirect_login(){
		window.setTimeout(function () {
			<?php
				if(isset($_SESSION['duongdandangnhap']) && $_SESSION['duongdandangnhap']!=""){ ?>
				location.href = "<?=$_SESSION['duongdandangnhap']?>";
			<?php	}else{ ?>
			
				location.href = "http://<?=$config_url?>/trang-ca-nhan/quan-ly-tai-khoan/member";
			<?php } ?>
		}, 200)
	 }					   
						   
/************************************** End Send Login **************************/							   
						   

/************************************** Start Send register **************************/	

	$('#Send_tk').click(function()	
	{  			
			// email validation
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			var emailaddressVal = $("#emailtk").val();	
			var code= $('#captcha-code').val();
			
			// name validation
			var nameVal = $("#frm_name").val();
			if(nameVal == '') {
				$("#name_error").html('');
				$("#frm_name").after('<div class="error" id="name_error"><b class=images_error><?=_nameError?>.</b></div>');
				$("#frm_name").focus();
				return false
			}
			else{
				$("#name_error").html('');
			}
		
		

			if(emailaddressVal == '') {
				$("#email_error").html('');
				$("#emailtk").after('<div class="error" id="email_error"><b class=images_error><?=_emailError?>.</b></div>');
				$("#emailtk").focus();
				return false
			}
			else if(!emailReg.test(emailaddressVal)) {
				$("#email_error").html('');
				$("#emailtk").after('<div class="error" id="email_error"><b class=images_error><?=_emailError1?>.</div></div>');
				$("#emailtk").focus();
				return false
			 
			}
			else{
				$("#email_error").html('');
			}
			
			
			
			// pass validation
			var passVal = $("#pass_tk").val();
			if(passVal == '') {
				$("#pass_error").html('');
				$("#pass_tk").after('<div class="error" id="pass_error"><b class=images_error><?=_xinnhapmatkhau?>.</b></div>');
				$("#pass_tk").focus();
				return false
			}
			else{
				$("#pass_error").html('');
			}
			
			// repass validation
			var repassVal = $("#repass_tk").val();
			if(repassVal == '') {
				$("#repass_error").html('');
			$("#repass_tk").after('<div class="error" id="repass_error"><b class=images_error><?=_xinnhaplaimatkhau?>.</b></div>');
				$("#repass_tk").focus();
				return false
			}
			else{
				$("#repass_error").html('');
			}
			if(repassVal !=passVal){
				$("#pass_error").html('');
				$("#pass_tk").after('<div class="error" id="pass_error"><b class=images_error><?=_haimatkhaukhonggiong?>.</b></div>');
				$("#pass_tk").focus();
				return false
			}else{
				$("#pass_error").html('');
				$("#repass_error").html('');
			}
			
		
			// birthday validation
			var ngayVal = $("#ngaysinh_tk").val();
			if(ngayVal == "") {
				$("#ngaysinh_error").html('');
				$("#ngaysinh_tk").after('<div class="error" id="ngaysinh_error"><b class=images_error><?=_xinchonngaysinh?>.</b></div>');
				$("#ngaysinh_tk").focus();
				return false
			}
			else{
				$("#ngaysinh_error").html('');
			}
		
		
			var genderVal = $("#gender_tk").val();
			if(genderVal == '') {
				$("#gender_error").html('');
			$("#gender_tk").after('<div class="error" id="gender_error"><b class=images_error><?=_xinchongioitinh?>.</b></div>');
				$("#gender_tk").focus();
				return false
			}
			else{
				$("#gender_error").html('');
			}


			// address validation

		/*	var quocgiaVal = $("#quocgia").val();
			if(tinhVal == '') {
				$("#quocgia_error").html('');
				$("#quocgia").after('<div class="error" id="quocgia_error"><b class=images_error><?=_chonquocgia?></b></div>');
				$("#quocgia").focus();
				return false
			}
			else{
				$("#quocgia_error").html('');
			}*/

			
			var tinhVal = $("#tinh").val();
			if(tinhVal == '') {
				$("#tinh_error").html('');
				$("#tinh").after('<div class="error" id="tinh_error"><b class=images_error><?=_chontinhthanh?></b></div>');
				$("#tinh").focus();
				return false
			}
			else{
				$("#tinh_error").html('');
			}

			var huyenVal = $("#huyen").val();
			if(huyenVal == '') {
				$("#huyen_error").html('');
				$("#huyen").after('<div class="error" id="huyen_error"><b class=images_error><?=_chonquanhuyen?></b></div>');
				$("#huyen").focus();
				return false
			}
			else{
				$("#huyen_error").html('');
			}

			/*var phuongVal = $("#phuong").val();
			if(phuongVal == '') {
				$("#phuong_error").html('');
				$("#phuong").after('<div class="error" id="phuong_error"><b class=images_error><?=_chonphuongxa?></b></div>');
				$("#phuong").focus();
				return false
			}
			else{
				$("#phuong_error").html('');
			}*/



			var diachiVal = $("#diachi").val();
			
			
			// name validation
			var dienthoaiVal = $("#dienthoai").val();
			if(dienthoaiVal == '') {
				$("#dienthoai_error").html('');
				$("#dienthoai").after('<div class="error" id="dienthoai_error"><b class=images_error><?=_phoneError?>.</b></div>');
				$("#dienthoai").focus();
				return false
			}
			else{
				$("#dienthoai_error").html('');
			}
			
			
			if(code == '') {
				$("#captcha-code_error").html('');
				$("#captcha-wrap").after('<div class="error" id="captcha-code_error"><b class=images_error><?=_nhapmacaptcha?>.</b></div>');
				$("#captcha-").focus();
				return false
			}
			else{
				$("#captcha-code_error").html('');
			}

			
			$.ajax({
				url:"ajax/register.php",
				type:"POST",
				data:{code:code,email:emailaddressVal,pass:passVal,name:nameVal,ngaysinh:ngayVal,gender:genderVal,tinh:tinhVal,huyen:huyenVal,diachi:diachiVal,dienthoai:dienthoaiVal},
				async:true,
				dataType:"text",
				success:function(response){
					//alert(response);
					if(response==1){//them thanh cong
						$("#after_submit").html('');
						$("#Send_tk").after(function() {
                            $(".customNotify").jmNotify({
								html: '<?=_dangkythanhcong?>',
								delay:1000,
								onClose:redirect_register()
							});	
                        });
					
						change_captcha();
						clear_form_register();
					}else if(response==2){ // trung email
						$("#after_submit").html('');
						$("#Send_tk").after(function() {
                            $(".customNotify").jmNotify({
								html: '<?=_loiemaildaco?>'
							});	
                        });
						
						$("#captcha-code").focus();
					}else if(response==3){ // insert ko thanh cong
						$("#after_submit").html('');
						$("#Send_tk").after(function() {
                            $(".customNotify").jmNotify({
								html: '<?=_vuilongquaylaisau?>'
							});	
                        });
						
						change_captcha();
						clear_form_register();
					}
					
					
					else{
						$("#after_submit").html('');
						$("#Send_tk").after(function() {
                            $(".customNotify").jmNotify({
								html: 'Lỗi ! Nhập mã captcha sai!'
							});	
                        });
						
						//$("#captcha-code").focus();
					}
					
				}
			})
			
		return false;
	 });

	 
	 function clear_form_register(){
		$("#frm_name").val('');
		$("#emailtk").val('');
		$("#pass_tk").val('');
		$("#repass_tk").val('');
		$("#ngaysinh_tk").val('');
		$("#gender_tk").val('');
		//$("#quocgia").val('');
		$("#tinh").val('');
		$("#huyen").val('');
		$("#phuong").val('');
		$("#captcha-code").val('');
	 }
	 
	 // refresh captcha
	 $('img#captcha-refresh').click(function() {  		
			change_captcha();
	 });
	 function change_captcha(){
		document.getElementById('captcha').src="ajax/check_captcha/get_captcha.php?rnd=" + Math.random();
	 }

	  function redirect_register(){
		window.setTimeout(function () {location.href = "http://<?=$config_url?>/index.php";}, 2000)
	 }

	 

/************************************** Start Send register **************************/	
	 
	 
});	
</script>		 
