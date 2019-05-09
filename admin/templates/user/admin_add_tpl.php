<script language="javascript" src="js/my_script.js"></script>
<script language="javascript">
function js_submit(){

	if(isEmpty(document.supplier.oldpassword, "Chưa nhập mật khẩu cũ.")){
		return false;
	}
	
	
	if(isEmpty(document.supplier.new_pass, "Chưa nhập mật khẩu mới.")){
		return false;
	}
	
	
	if(!isEmpty(document.supplier.new_pass) && document.supplier.new_pass.value.length<5){
		alert("Mật khẩu phải nhiều hơn 4 ký tự.");
		document.supplier.new_pass.focus();
		return false;
	}
	
	
	if(isEmpty(document.supplier.renew_pass, "Chưa nhập lại mật khẩu mới.")){
		return false;
	}
	
	
	if(!isEmpty(document.supplier.new_pass) && document.supplier.new_pass.value!=document.supplier.renew_pass.value){
		alert("Nhập lại mật khẩu mới không chính xác.");
		document.supplier.renew_pass.focus();
		return false;
	}
	
	if(isEmpty(document.supplier.email, "Chưa nhập Email.")){
		return false;
	}
	
	if(!isEmpty(document.supplier.email) && !check_email(document.supplier.email.value)){
		alert('Email không hợp lệ.');
		document.supplier.email.focus();
		return false;
	}
	
	  document.supplier.submit();
}
</script>

<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=setting&act=capnhat"><span>Thông tin tài khoản</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Cập nhật thông tin</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">		
	/*function TreeFilterChanged2(){		
				$('#validate').submit();		
	}*/
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=user&act=admin_edit" method="post" >	        
    <div class="widget">
		<div class="title"><img src="./images/icons/dark/pencil.png" alt="" class="titleIcon" />
			<h6>Thông tin tài khoản</h6>
		</div>			
		<div class="formRow">
			<label>Tên đăng nhập</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['username']?>" name="username" id="username" title="Tên đăng nhập quản trị" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
        <div class="formRow">
			<label>Mật khẩu</label>
			<div class="formRight">
				<input type="password" value="" name="oldpassword" id="oldpassword" title="Nhập mật khẩu hiện tại" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
        
         <div class="formRow">
			<label>Mật khẩu mới</label>
			<div class="formRight">
				<input type="password" value="" name="new_pass" id="new_pass" title="Nhập mật khẩu mới" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
        
         <div class="formRow">
			<label>Nhập lại mật khẩu mới</label>
			<div class="formRight">
				<input type="password" value="" name="renew_pass" id="renew_pass" title="Nhập lại mật khẩu mới" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="formRow">
			<label>Họ tên</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['hoten']?>" name="hoten" id="ten" title="Nhập họ tên của bạn" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
        
        <div class="formRow">
			<label>Email</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['email']?>" name="email" id="email" title="Nhập email của bạn" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
        
        <div class="formRow">
			<label>Điện thoại</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['dienthoai']?>" name="dienthoai" title="Nhập điện thoại của bạn" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		
		
        <div class="formRow">
			<div class="formRight">
               <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
            	<input type="button" class="blueB" onclick="js_submit();"  return false;" value="Hoàn tất" />
			</div>
			<div class="clear"></div>
		</div> 			
	</div>
    
      
</form>   