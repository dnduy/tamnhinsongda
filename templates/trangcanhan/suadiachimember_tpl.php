<script type="text/javascript">
$(document).ready(function() { 
	
		
	//Load combobox quoc gia tinh thanh - quan huyen
	$("#quocgia").change(function(){
		var id_danhmuc=$(this).val();
		$("#tinh").load('ajax/ajax_country.php?id_danhmuc='+id_danhmuc);
	});
	
	$("#tinh").change(function(){
		var id_list=$(this).val();
		$("#huyen").load('ajax/ajax_city.php?id_list='+id_list);
	});
	
	$("#huyen").change(function(){
		var id_cat=$(this).val();
		$("#phuongxa").load('ajax/ajax_city_item.php?id_cat='+id_cat);
	});
	


	 $('#Send_editaddress').click(function() {  

			/// email validation
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			var phone_regex=/^0([0-9]{9,10})$/;
			var emailaddressVal = $("#emailtk").val();
			var code= $('#captcha-code').val();
			var id_thanhvien=<?=$_SESSION["login_member"]["id"]?>;
			

			// name validation
			var nameVal = $("#hoten").val();
			if(nameVal == '') {
				$("#hoten_error").html('');
				$("#hoten").after('<div class="error" id="hoten_error"><b class=images_error><?=_nameError?>.</b></div>');
				$("#hoten").focus();
				return false
			}
			else{
				$("#hoten_error").html('');
			}
			
			
			// phone validation
			var phoneVal = $("#dienthoai").val();
			if(phoneVal == '') {
				$("dienthoai_error").html('');
				$("#dienthoai").after('<div class="error" id="dienthoai_error"><b class=images_error><?=_phoneError?>.</b></div>');
				$("#dienthoai").focus();
				return false
			}
			else{
				$("#dienthoai_error").html('');
			}
			
			if(!phone_regex.test(phoneVal)){
				$("dienthoai_error").html('');
				$("#dienthoai").after('<div class="error" id="dienthoai_error"><b class=images_error><?=_phoneError1?>.</b></div>');
				$("#dienthoai").focus();
				return false
			}else{
				$("#dienthoai_error").html('');
			}
			
			
			// address validation
			var addressVal = $("#diachigiaohang").val();
			if(addressVal == '') {
				$("#diachigiaohang_error").html('');
				$("#diachigiaohang").after('<div class="error" id="diachigiaohang_error"><b class=images_error><?=_addressErrorgiaohang?>.</b></div>');
				$("#diachigiaohang").focus();
				return false
			}
			else{
				$("#diachigiaohang_error").html('');
			}
			// address validation
			
			
				var quocgiaVal = $("#quocgia").val();
			if(quocgiaVal == '') {
				$("#quocgia_error").html('');
				$("#quocgia").after('<div class="error" id="quocgia_error"><b class=images_error><?=_chonquocgia?>.</b></div>');
				$("#quocgia").focus();
				return false
			}
			else{
				$("#quocgia_error").html('');
			}
			
			
			var tinhVal = $("#tinh").val();
			if(tinhVal == '') {
				$("#tinh_error").html('');
				$("#tinh").after('<div class="error" id="tinh_error"><b class=images_error><?=_chontinhthanh?>.</b></div>');
				$("#tinh").focus();
				return false
			}
			else{
				$("#tinh_error").html('');
			}
		
			
			
			
			var huyenVal = $("#huyen").val();
			if(huyenVal == '') {
				$("#huyen_error").html('');
				$("#huyen").after('<div class="error" id="huyen_error"><b class=images_error><?=_chonquanhuyen?>.</b></div>');
				$("#huyen").focus();
				return false
			}
			else{
				$("#tinh_error").html('');
			}

			var phuongVal = $("#phuong").val();
			if(phuongVal == '') {
				$("#phuong_error").html('');
				$("#phuong").after('<div class="error" id="phuong_error"><b class=images_error><?=_chonphuongxa?>.</b></div>');
				$("#phuong").focus();
				return false
			}
			else{
				$("#phuong_error").html('');
			}
			

			
			$.ajax({
				url:"ajax/edit_address_member.php",
				type:"POST",
				data:{code:code,id_thanhvien:id_thanhvien,email:emailaddressVal,name:nameVal,quocgia:quocgiaVal,tinh:tinhVal,huyen:huyenVal,phuong:phuongVal,phone:phoneVal,diachigiaohang:addressVal},
				async:true,
				dataType:"text",
				success:function(response){
					//alert(response);
					if(response==1){//them thanh cong
						$("#after_submit").html('');
						$("#Send_editaddress").after(function() {
                            $(".customNotify").jmNotify({
								html: '<?=_capnhatdiachithanhcong?>',
								delay:1500,
								onClose:redirect()
							});	
                        });

						change_captcha();
						clear_form();
					}else if(response==3){ // insert ko thanh cong
						$("#after_submit").html('');
						$("#Send_editaddress").after(function() {
                            $(".customNotify").jmNotify({
								html: '<?=_vuilongquaylaisau?>'
							});	
                        });
					
						change_captcha();
						clear_form();
					}
					else{
						$("#after_submit").html('');
						$("#Send_editaddress").after(function() {
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
	 
	function clear_form_address()
	{
		$("#diachigiaohang").val('');
	}
	
	 function clear_form(){
		$("#hoten").val('');
		$("#dienthoai").val('');
		$("#diachigiaohang").val('');
		$("#quocgia").val('');
		$("#tinh").val('');
		$("#huyen").val('');
		$("#phuong").val('');		
		$("#captcha-code").val('');
		
	 }
	  function redirect(){
		  
		  location.href="http://<?=$config_url?>/trang-ca-nhan/so-dia-chi/member";
		
	 }
});	
</script>	


<div class="pad10">


<div class="bold-title"><?=_suadiachi?></div><!--end bold-title-->

<div id="editIndividualForm">
 
 <form action="" class="form-horizontal" id="frm_taodiachi" method="post" name="frm_taodiachi" enctype="multipart/form-data">
  <input name="emailtk"  type="hidden" value="<?=$item_user['email']?>" id="emailtk" >    
     <table class="adminform" style="background-color: white; border: 0; width: 100%;">
            <tbody><tr>
                <td style="width: 100%; vertical-align: top;">
                    <div class="blueborline">
                        <span id="MainContent__userPage_ctl00_lblProfileTitle"><?=_diachilienhe?></span>
                    </div>
                    <table class="tblInfo" style="width: 100%;">
                        <tbody>

                        <tr>
                            <td style="width: 130px;">
                                <span id="MainContent__userPage_ctl00_lblFullname"><?=_hoten?></span>
                                <span style="color: #f00;">(*)</span>
                            </td>
                            <td>
     
            
       <input name="hoten" type="text" maxlength="50" id="hoten" value="<?=$item_info["hotenkh"]?>" class="keycode" style="width:50%;">
                                
                            </td>
                        </tr>
                        
                        
                        
                        <tr>
                            <td style="width: 130px;">
                                <span id="MainContent__userPage_ctl00_lblFullname"><?=_dienthoai?></span>
                                <span style="color: #f00;">(*)</span>
                            </td>
                            <td>
     
            
       <input name="dienthoai" type="text"  maxlength="50" id="dienthoai" value="<?=$item_info["dienthoai"]?>" class="keycode" style="width:50%;">
                                
                            </td>
                        </tr> 
                        
                        
                         <tr>
                            <td style="width: 130px;">
                                <span id="MainContent__userPage_ctl00_lblFullname"><?=_diachigiaohang?></span>
                                <span style="color: #f00;">(*)</span>
                            </td>
                            <td>
     
            
       <input name="diachigiaohang" type="text"  maxlength="50" id="diachigiaohang" value="<?=$item_info["diachi"]?>" class="keycode" style="width:50%;">
                                
                            </td>
                        </tr> 
                        
                        
                        <tr>
                            <td style="width: 130px;">
                                <span id="MainContent__userPage_ctl00_lblFullname"><?=_quocgia?></span>
                                <span style="color: #f00;">(*)</span>
                            </td>
                            <td>
     
            
    				<div class="advance-control">
                                                
                                                
                <select name="quocgia" id="quocgia">
                    <option value=""><?=_chon?></option>
                    <?php 
                        //Load tinh thanh
                        $d->reset();
                        $sql="select id,ten_$lang from #_city_danhmuc where hienthi =1 order by stt asc";
                        $d->query($sql);
                        $quocgia = $d->result_array();
                        for($i=0,$count_tinh=count($quocgia);$i<$count_tinh;$i++) { ?>
                         <option <?php if($item_info['quocgia']==$quocgia[$i]['id']) echo 'selected="selected"'; ?> value="<?=$quocgia[$i]['id']?>"><?=$quocgia[$i]["ten_$lang"]?></option>
                    <? }?>
                </select>
                                                
                                         
                   </div>
                                
                            </td>
                        </tr>
                        
                        
                        
                        
                         <tr>
                            <td style="width: 130px;">
                                <span id="MainContent__userPage_ctl00_lblFullname"><?=_tinhthanh?></span>
                                <span style="color: #f00;">(*)</span>
                            </td>
                            <td>
     
            
    				<div class="advance-control">
                                                
                                                
                <select name="tinh" id="tinh">
                    <option value=""><?=_chontinhthanh?></option>
                    <?php 
                        //Load tinh thanh
                        $d->reset();
                        $sql="select id,ten_$lang from #_city_list where hienthi =1 and id_danhmuc=$item_info[quocgia] order by stt asc";
                        $d->query($sql);
                        $tinhthanh = $d->result_array();
                        for($i=0,$count_tinh=count($tinhthanh);$i<$count_tinh;$i++) { ?>
                         <option <?php if($item_info['tinh']==$tinhthanh[$i]['id']) echo 'selected="selected"'; ?> value="<?=$tinhthanh[$i]['id']?>"><?=$tinhthanh[$i]["ten_$lang"]?></option>
                    <? }?>
                </select>
                                                
                                         
                   </div>
                                
                            </td>
                        </tr> 
                        
                        
          
                        
                 <tr>
                            <td style="width: 130px;">
                                <span id="MainContent__userPage_ctl00_lblFullname"><?=_quanhuyen?></span>
                                <span style="color: #f00;">(*)</span>
                            </td>
                            <td>
     
            
    			<div class="advance-control">
                                                
                                                
                  <select name="huyen" id="huyen">
                    <option value=""><?=_chonquanhuyen?></option>
                    <?php 
                        //Load tinh thanh
                        $d->reset();
                        $sql="select id,ten_$lang from #_city_cat where hienthi =1 and id_list=$item_info[tinh] order by stt asc";
                        $d->query($sql);
                        $huyen = $d->result_array();
						if (($item_info["huyen"])>0) { 
                        for($i=0,$count_huyen=count($huyen);$i<$count_huyen;$i++) { ?>
                         <option <?php if($item_info['huyen']==$huyen[$i]['id']) echo 'selected="selected"'; ?> value="<?=$huyen[$i]['id']?>"><?=$huyen[$i]["ten_$lang"]?></option>
                    <? } } else {?>
                    
                    <?php }?>
                    
                </select>
              </div><!--end advance-control-->
                                
                            </td>
                        </tr>

                     
                        <tr>
                            <td style="width: 130px;">
                                <span id="MainContent__userPage_ctl00_lblFullname"><?=_phuongxa?></span>
                                <span style="color: #f00;">(*)</span>
                            </td>
                            <td>
     
            
			    			<div class="advance-control">
			                                                
			                                                
			                  <select name="phuong" id="phuong">
			                    <option value=""><?=_chonphuongxa?></option>
			                    <?php 
			                        //Load tinh thanh
			                        $d->reset();
			                        $sql="select id,ten_$lang from #_city_item where hienthi =1 and id_cat=$item_info[huyen] order by stt asc";
			                        $d->query($sql);
			                        $phuong = $d->result_array();
									if (($item_info["phuongxa"])>0) { 
			                        for($i=0,$count_huyen=count($phuong);$i<$count_huyen;$i++) { ?>
			                         <option <?php if($item_info['phuongxa']==$phuong[$i]['id']) echo 'selected="selected"'; ?> value="<?=$phuong[$i]['id']?>"><?=$phuong[$i]["ten_$lang"]?></option>
			                    <? } } else {?>
			                    
			                    <?php }?>
			                    
			                  </select>
			              	</div><!--end advance-control-->
                                
                            </td>
                		</tr>
                        
                        
                    </tbody></table>
                </td>
            </tr>
            
            
            
            
            <tr>
				<td>
	
    <div class="control-group" style="margin:0 auto; text-align:center;">
    					  
          <label for="captcha-code" class="control-label"><span class="required">*</span><?=_mabaove?>: </label><!--end captcha-code--> 
            
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
            
          </div><!--end control-group-->          
                    
				</td>
			</tr>
            
            <tr>
                <td class="aligncenter">
                    <input type="submit" value="<?=_luu?>"  id="Send_editaddress" class="button-blue">
                </td>
            </tr>
        </tbody></table>
   
   </form>     
        
    </div><!--end editIndividualForm-->

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