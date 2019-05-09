<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
       
        <li><a href="index.php?com=quangcaobody&act=man_photo"><span>Quảng cáo 2 bên</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Sửa quảng cáo 2 bên</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>

<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}
</script>


<form name="supplier" id="validate" class="form" action="index.php?com=quangcaobody&act=save_photo&id=<?=$_REQUEST['id'];?>&idc=<?=$_REQUEST['idc']?>" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Sửa hình ảnh</h6>
		</div>		
		<div class="formRow">
			<label>Tên hình ảnh </label>
			<div class="formRight">
                <input type="text" name="ten_vi" title="Nhập tên hình ảnh" id="name"  value="<?=@$item['ten_vi']?>" />
			</div>
			<div class="clear"></div>
		</div>
        
        
          
        <div class="formRow">
			<label>Vị trí</label>
			<div class="formRight">
            	<div class="selector">
					
                       
        <select name="vitri" id="vitri">    	
        <option value="1" <?php if($item['vitri']==1) echo selected ?>>Chạy bên trái</option>
        <option value="2" <?php if($item['vitri']==2) echo selected ?>>Chạy bên phải</option>       
    </select> 
                    
                </div>
			</div>
			<div class="clear"></div>
		</div>
        
        
   
		<div class="formRow">
			<label>Tải hình ảnh:</label>
			<div class="formRight">
               <div class="mt10"><img width="200px" src="<?=_upload_hinhanh.$item['thumb']?>"></div>
            					<input type="file" id="file" name="file" />
				<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)"><strong>Width: 130px - Dạng:.jpg|.gif|png</strong>
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
                <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của hình ảnh, chỉ nhập số">
            </div>
            <div class="clear"></div>
        </div>
			
	<div class="formRow">
			<div class="formRight">

                
                
              
     <input type="hidden" name="id" value="<?=$item['id']?>" />
	<input type="submit" value="Lưu" class="blueB" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=quangcaobody&act=man_photo'" class="blueB" />           
                
                
			</div>
			<div class="clear"></div>
		</div>     
		
	</div>
   
</form>