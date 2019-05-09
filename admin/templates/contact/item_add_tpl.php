<div class="wrapper">
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=contact&act=man"><span>Xem contact</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
    
    
</div><!--end control_frm-->



<form name="supplier" id="validate" class="form" action="index.php?com=contact&act=save" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Nhập dữ liệu</h6>
		</div>		


		 
		
        
        <div class="formRow">
			<label>Họ và Tên</label>
			<div class="formRight">
                <input type="text" name="hoten" title="Nhập họ tên" id="name" class="tipS validate[required]" value="<?=@$item['hoten']?>" />
			</div>
			<div class="clear"></div>
		</div>
        
        
          <div class="formRow">
			<label>Email</label>
			<div class="formRight">
            <input type="text" name="email" title="Email" id="name" class="tipS validate[required]" value="<?=@$item['email']?>" />
			</div>
			<div class="clear"></div>
		</div>
        
        
          <div class="formRow">
			<label>Điện thoại</label>
            
			<div class="formRight">
				<input type="text" value="<?=@$item['dienthoai']?>" name="dienthoai" title="Điện thoại" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
        
        
        
        <div class="formRow">
			<label>Nội dung</label>
            
			<div class="formRight">
				<textarea rows="8" cols="" title="Nội dung"  name="noidung" id="short"><?=@$item['noidung']?></textarea>
			</div>
			<div class="clear"></div>
		</div>
        
        
        
          
        
        
       
		     
       
		
        <div class="formRow">
          <label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
          <div class="formRight">
          
            
            <input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
            <label for="check1">Hiển thị</label>            
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
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=contact&act=man'" class="blueB" />
            
            
			</div>
			<div class="clear"></div>
		</div>	
		
		
	</div>  
	
</form>



</div><!--end wrapper-->