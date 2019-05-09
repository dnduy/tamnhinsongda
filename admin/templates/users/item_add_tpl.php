<script type="text/javascript" src="js/script_gaconit.js"></script>
<script type="text/javascript">
<?php 
	if(@$_REQUEST['act']=='edit' and $item['tinh']!=0){
?>
		load_tinh_edit(<?=$item['tinh']?>);
<?php
		if($item['huyen']!=0){
?>
		load_huyen_edit(<?=$item['tinh']?>,<?=$item['huyen']?>);
<?php
		}else{
?>
		load_huyen(<?=$item['tinh']?>);

 
<?php
		}
		if($item['phuongxa']!=0){
?>
		load_phuong_edit(<?=$item['tinh']?>, <?=$item['huyen']?>, <?=$item['phuongxa']?>);
<?php
		}else if($item['huyen']!=0){
?>
		load_phuong(<?=$item['huyen']?>);
<?php
		}
	}else{
?>
	load_tinh();
<?php
	}
?>


</script>

<div class="wrapper">
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=dskhorder&act=man"><span>Xem Thành Viên</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
    
    
</div><!--end control_frm-->


<form name="frm" id="validate" class="form" method="post" action="index.php?com=users&act=save&curPage=<?=@$_REQUEST['curPage']?>" enctype="multipart/form-data" class="nhaplieu">

	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Dữ liệu</h6>
		</div>		

		
        <?php /*?><div class="formRow">
			<label>Tải hình ảnh: </label>
			<div class="formRight ">
            					 <?php if ($_REQUEST['act']=='edit' && $item['photo']!='' ) { ?>
                                  <img width="200px" src="<?=_upload_users.$item['photo']?>">
                    <a title="Xoá ảnh" href="index.php?com=users&act=delete_img&id=<?=@$item['id']?>">Xoá ảnh</a>
                    <br>
                    <?php }?>
                    
                                <input type="file" id="file" name="file" /><img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình đại diện (ảnh JPEG, GIF , JPG , PNG)"> Width:250px;| Height:250px;
                               
			</div>
			<div class="clear"></div>
		</div><?php */?>

		
        <div class="formRow">
			<label>Họ và Tên</label>
			<div class="formRight">
                <input type="text" name="hoten" title="Nhập họ tên" id="hoten" class="tipS validate[required]" value="<?=@$item['hoten']?>" />
			</div><!--end formRight-->
			<div class="clear"></div>
		</div><!--end formRow-->
        
        
      
    
    
    <?php if ($_REQUEST['act']=='add'){?>
    
       <div class="formRow">
			<label>Mật khẩu</label>
			<div class="formRight">
              <input type="password" name="pass"  class="input"/>
			</div>
			<div class="clear"></div>
		</div>
     <?php }?>   
        
        
          <div class="formRow">
			<label>Email</label>
			<div class="formRight">
                <input type="text" name="email" title="Email" id="name" class="tipS validate[required]" value="<?=@$item['email']?>" />
			</div>
			<div class="clear"></div>
		</div>
        
      
           <div class="formRow">
			<label>Ngày Sinh</label>
            
			<div class="formRight">
            
            <input type="text" name="ngaysinh" id="ngaysinh_tk"   value="<?=date('d/m/Y',@$item['ngaysinh'])?>" class="input" />
            
            
              <script type="text/javascript">
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
				
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="formRow">
			<label>Giới tính</label>
			<div class="formRight">
        
        <div class="canh_deu">  <input type="radio" name="gender" value="0" <?php if($item['sex']=="0") echo'checked="checked"'; ?>  />Nữ</div>
        
        
         <div class="canh_deu"> <input type="radio" name="gender" value="1"    <?php if($item['sex']=="1") echo'checked="checked"'; ?> />Nam </div>



          <div class="canh_deu"> <input type="radio" name="gender" value="2"    <?php if($item['sex']=="2") echo'checked="checked"'; ?> />Khác </div>

			</div>
			<div class="clear"></div>
		</div>
		
		
		<div class="formRow">
			<label>Số điện thoại</label>
			<div class="formRight">
                <input type="text" name="dienthoai" title="Nhập số điện thoại" id="dienthoai" class="tipS" value="<?=@$item['dienthoai']?>" />
			</div><!--end formRight-->
			<div class="clear"></div>
		</div>

		<div class="formRow" style="border-bottom: none;">
			<label>Địa chỉ</label>
			<div class="formRight">
                <input type="text" name="diachi" title="Nhập địa chỉ" id="diachi" class="tipS" value="<?=@$item['diachi']?>" />
			</div><!--end formRight-->
			<div class="clear"></div>
		</div>
       
        
        
        
          
		
		
		<div class="formRow">
			<label>Tỉnh/Thành</label>
            
			<div class="formRight">
				<div class="selector">
					<select id="id_tinh" name="id_tinh" class="main_font" onchange="load_huyen(this.value)">
						<option value="0">Chọn Tỉnh/Thành</option>
					</select>
				</div>
			</div><!--end formRight-->
			<div class="clear"></div>
		</div><!--end formRow-->
		
		
		<div class="formRow">
			<label>Quận/Huyện</label>
            
			<div class="formRight">
				<div class="selector">
					 <select id="id_huyen" name="id_huyen" class="main_font" onchange="load_phuong(this.value)" >
                        <option value="0">Chọn Quận/Huyện</option>
					</select>
				</div>
			</div><!--end formRight-->
			<div class="clear"></div>
		</div><!--end formRow-->
		
		
		
		
		
		
		
        

        <div class="formRow">
          <label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
          <div class="formRight">
          
            
            <input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
            <label for="check1">Hiển thị</label>   


			
			
			<input type="checkbox" name="hoahong" id="check2" value="1" <?=(!isset($item['hoahong']) || $item['hoahong']==1)?'checked="checked"':''?> />
            <label for="check2">Hoa hồng</label>  


			
          </div>
          <div class="clear"></div>
        </div>
        <div class="formRow">
            <label>Số thứ tự: </label>
            <div class="formRight">
                <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
            </div>
            <div class="clear"></div>
        </div>
		
    
		
	
    <div class="formRow">
			<div class="formRight">
            
            
       
    <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="blueB" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=users&act=man'" class="blueB" />        
            
            
			</div>
			<div class="clear"></div>
		</div>	
		
		
	</div>  
	
</form>



</div><!--end wrapper-->
