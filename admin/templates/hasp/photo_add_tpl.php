<?php

	$kichthuoc="";
	$name_photo="";
	if($_REQUEST['type1']=='themvideo')
		$kichthuoc="Width: 200px - Height: 200px";
		$name_photo="Video";
		
	if($_REQUEST['type1']=='guibaiviet')
		$kichthuoc="Dung lượng 20 MB";
		$name_photo="Gửi Bài Viết";	
	


		
?>
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	     <li><a href="index.php?com=slider&type1=<?=$_REQUEST['type1']?>&act=man_photo"><span><?=$name_photo?></span></a></li>
                       <li class="current"><a href="#" onclick="return false;">Thêm <?=$name_photo?></a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}	
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=hasp&type1=<?=$_REQUEST['type1']?>&act=save_photo&idc=<?=$_REQUEST['idc']?>" method="post" enctype="multipart/form-data">
	<div class="widget">
				
		
        <?php for($i=0; $i<5; $i++){?>
        <div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Thêm <?=$name_photo?> <?=$i+1?></h6>
		</div>
        <div class="formRow">
			<label>Tên hình ảnh VI</label>
			<div class="formRight">
                <input type="text" name="ten_vi<?=$i?>" title="Nhập tên VI hình ảnh" id="name" <?php /*?>class="tipS validate[required]"<?php */?> value="" />
			</div>
			<div class="clear"></div>
		</div>
        
        
        
      
        		                     
        <div class="formRow <?php if ($_GET["type1"]=="guibaiviet") {?> hidden-an <?php }?>">
            <label>Link Vimeo:</label>
            <div class="formRight">
                <input type="text" id="code_pro" name="link<?=$i?>" value=""  title="Nhập link liên kết cho hình ảnh" class="tipS" />
                
                  <span>Ví dụ:https://player.vimeo.com/video/93454467</span>
                
            </div>
            <div class="clear"></div>
        </div>
		<div class="formRow">
			<label>Tải hình ảnh:</label>
			<div class="formRight">
            					<input type="file" id="file" name="file<?=$i?>" />
				<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)"><?=$kichthuoc?>
			</div>
			<div class="clear"></div>
		</div>
        <div class="formRow">
          <label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
          <div class="formRight">           
            <input type="checkbox" name="hienthi<?=$i?>" id="check1" value="1" checked="checked" />
            <label for="check1">Hiển thị</label>           
          </div>
          <div class="clear"></div>
        </div>
        <div class="formRow">
            <label>Số thứ tự: </label>
            <div class="formRight">
                <input type="text" class="tipS" value="1" name="stt<?=$i?>" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của hình ảnh, chỉ nhập số">
            </div>
            <div class="clear"></div>
        </div>
		<?php } ?>
	<div class="formRow">
			<div class="formRight">

                <input type="submit" value="Lưu" class="blueB" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=hasp&type1=<?=$_REQUEST['type1']?>&act=man_photo&idc=<?=$_REQUEST['idc']?>'" class="blueB" />
                
                
        
                
			</div>
			<div class="clear"></div>
		</div>	
	</div>
   
	
</form>   