<div class="wrapper">
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=thongkeiptruycap&act=man"><span>Xem Thống Kê IP</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
    
    
</div><!--end control_frm-->



<form name="supplier" id="validate" class="form" action="index.php?com=thongkeiptruycap&act=save" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Nhập dữ liệu</h6>
		</div>		


		  <div class="formRow">
			<label>Thành Viên</label>
            
			<div class="formRight">
				<input type="text" disabled="disabled" value="<?php
	if ($item['id_thanhvien']!=0){
				$sql_danhmuc="select hoten from table_user where id='".$item['id_thanhvien']."'";
				$result=mysql_query($sql_danhmuc);
				$item_danhmuc =mysql_fetch_array($result);
				echo @$item_danhmuc['hoten'];
				
	}
	else if ($item['id_thanhvien']==0){
			
				echo "Không phải thành viên";
				
	}
			?>" name="id_thanhvien" title="Thành Viên" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		
        
        <div class="formRow">
			<label>IP</label>
			<div class="formRight">
                <input type="text" disabled="disabled" name="ip_reportspam" title="IP" id="name" class="tipS validate[required]" value="<?=@$item['ip_reportspam']?>" />
			</div>
			<div class="clear"></div>
		</div>
        
        
        
        <div class="formRow">
			<label>Nhóm Tin</label>
			<div class="formRight">
            <input type="text" name="id_product" disabled="disabled" title="Tin Báo Cáo" id="name" class="tipS validate[required]" value=" <?php
	if ($item['id_product']!=0){
		
	$d->reset();
	$sql = "select ten_vi,id,id_list from table_product where id='".$item['id_product']."'";
	$d->query($sql);
	$result_tinspam=$d->result_array();
	
	
	$d->reset();
	$sql = "select ten_vi,id from table_product_list where id='".$result_tinspam[0]['id_list']."'";
	$d->query($sql);
	$nhomtin_list=$d->result_array();
	echo @$nhomtin_list[0]['ten_vi'];
				
	}
	else if ($item['id_product']==0){
			
				echo "Null";
				
	}
			?>    " />
			</div>
			<div class="clear"></div>
		</div>
        
        
          <div class="formRow">
			<label>Tin Báo Cáo</label>
			<div class="formRight">
            <input type="text" name="id_product" disabled="disabled" title="Tin Báo Cáo" id="name" class="tipS validate[required]" value="<?php
	if ($item['id_product']!=0){
				$sql_danhmuc="select ten_vi from table_product where id='".$item['id_product']."'";
				$result=mysql_query($sql_danhmuc);
				$item_danhmuc =mysql_fetch_array($result);
				echo @$item_danhmuc['ten_vi'];
				
	}
	else if ($item['id_product']==0){
			
				echo "Null";
				
	}
			?>" />
			</div>
			<div class="clear"></div>
		</div>
        
        
          <div class="formRow">
			<label>Loại Vi Phạm</label>
            
			<div class="formRight">
				<input type="text" disabled="disabled"  value="<?php
	if ($item['id_loaivipham']!=0){
				$sql_danhmuc="select ten_vi from table_news where id='".$item['id_loaivipham']."' and com='reportspam' ";
				$result=mysql_query($sql_danhmuc);
				$item_danhmuc =mysql_fetch_array($result);
				echo @$item_danhmuc['ten_vi'];
				
	}
	else if ($item['id_loaivipham']==0){
			
				echo "Null";
				
	}
			?>" name="id_loaivipham" title="Loại vi phạm" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
        
        
        
        <div class="formRow">
			<label>Nội dung</label>
            
			<div class="formRight">
				<textarea rows="8" cols="" disabled="disabled" title="Nội dung"  name="noidung" id="short"><?=@$item['noidung']?></textarea>
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
	<?php /*?><input type="submit" value="Lưu" class="blueB" /><?php */?>
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=thongkeiptruycap&act=man'" class="blueB" />
            
            
			</div>
			<div class="clear"></div>
		</div>	
		
		
	</div>  
	
</form>



</div><!--end wrapper-->