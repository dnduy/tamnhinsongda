<?php 
	error_reporting(0);
	session_start();
	$session=session_id();
	@define ( '_template' , '../templates/');
	@define ( '_source' , '../sources/');
	@define ( '_lib' , '../../libraries/');

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";	
	$d = new database($config['database']);
	
	$id_raovat=$_POST['id_raovat'];
	$id_thuoctinh=$_POST['id_thuoctinh'];
	

	
	
	
	if (isset($_POST['id_raovat']))
	{
	
	$d->reset();
	$sql = "select ten_vi,tenkhongdau,id,id_hangxe,id_tenxe,id_mauxe,dongxe,namsanxuat,xemoi,hopso,nhienlieu,noithat,mattien,duongvao,huongnha,sotang,sophongngu,sotoilet from #_product where  id_list='".$id_thuoctinh."' and id='".$id_raovat."'  order by id desc";
	$d->query($sql);
	$item = $d->fetch_array();
	}
	
	else if (isset($_POST["id_thuoctinh"]))
	
	{
		
		$d->reset();
	$sql = "select ten_vi,tenkhongdau,id,id_hangxe,id_tenxe,id_mauxe,dongxe,namsanxuat,xemoi,hopso,nhienlieu,noithat,mattien,duongvao,huongnha,sotang,sophongngu,sotoilet from #_product where  id_list='".$id_thuoctinh."'   order by id desc";
	$d->query($sql);
	$item = $d->fetch_array();	
		
	}
	
	
	//echo ($item["id_hangxe"]);
	//die();
	
?>







<?php if ($id_thuoctinh==159) {?>

<div class="formRow formRow_group">
			<label>Mặt tiền (m) </label>
			<div class="formRight">
				<input type="text" value="<?=@$item['mattien']?>" name="mattien" title="Nhập mặt tiền" class="tipS" />
			</div><!--end formRight-->
            
			<div class="clear"></div>           
		</div><!--end formRow-->
        
        
        
      <div class="formRow formRow_group">
			<label>Đường vào (m) </label>
			<div class="formRight">
				<input type="text" value="<?=@$item['duongvao']?>" name="duongvao" title="Nhập Đường vào (m)" class="tipS" />
			</div><!--end formRight-->
            
			<div class="clear"></div>           
		</div><!--end formRow-->  
        
        
       <div class="formRow formRow_group">
			<label>Hướng nhà</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['huongnha']?>" name="huongnha" title="Hướng nhà" class="tipS" />
			</div><!--end formRight-->
            
			<div class="clear"></div>           
		</div><!--end formRow-->   
        
        
        
          <div class="formRow formRow_group">
			<label>Số tầng</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['sotang']?>" name="sotang" title="Nhập số tầng" class="tipS" />
			</div><!--end formRight-->
            
			<div class="clear"></div>           
		</div><!--end formRow-->   
        
        
        <div class="formRow formRow_group">
			<label>Số phòng ngủ</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['sophongngu']?>" name="sophongngu" title="Nhập số phòng ngủ" class="tipS" />
			</div><!--end formRight-->
            
			<div class="clear"></div>           
		</div><!--end formRow-->  
        
        
        
         <div class="formRow formRow_group">
			<label>Số toilet</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['sotoilet']?>" name="sotoilet" title="Nhập Số toilet" class="tipS" />
			</div><!--end formRight-->
            
			<div class="clear"></div>           
		</div><!--end formRow-->   
        
        
        
    
        
        
        <div class="formRow">
			<label>Nội thất</label>
			<div class="formRight">
				
                <textarea name="noithat" id="noithat" cols="10" rows="10"><?=@$item['noithat']?></textarea>
               
			</div><!--end formRight-->
            
			<div class="clear"></div>           
		</div><!--end formRow-->    



<?php } else if ($id_thuoctinh==160) { ?>




 <div class="formRow formRow_group">
			<label>Dòng Xe </label>
			<div class="formRight">
				<input type="text" value="<?=@$item['dongxe']?>" name="dongxe" title="Nhập dòng xe" class="tipS" />
			</div><!--end formRight-->
            
			<div class="clear"></div>           
		</div><!--end formRow-->
        
        
        
      <div class="formRow formRow_group">
			<label>Năm sản xuất </label>
			<div class="formRight">
				<input type="text" value="<?=@$item['namsanxuat']?>" name="namsanxuat" title="Nhập năm sản xuất" class="tipS" />
			</div><!--end formRight-->
            
			<div class="clear"></div>           
		</div><!--end formRow-->  
        
        
       <div class="formRow formRow_group">
			<label>Xe mới (%) </label>
			<div class="formRight">
				<input type="text" value="<?=@$item['xemoi']?>" name="xemoi" title="Xe mới (%)" class="tipS" />
			</div><!--end formRight-->
            
			<div class="clear"></div>           
		</div><!--end formRow-->   
        
        
        
          <div class="formRow formRow_group">
			<label>Hộp số</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['hopso']?>" name="hopso" title="Hộp số" class="tipS" />
			</div><!--end formRight-->
            
			<div class="clear"></div>           
		</div><!--end formRow-->   
        
        
        <div class="formRow formRow_group">
			<label>Nhiên liệu</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['nhienlieu']?>" name="nhienlieu" title="Nhiên liệu" class="tipS" />
			</div><!--end formRight-->
            
			<div class="clear"></div>           
		</div><!--end formRow-->   
        
        
        
         <div class="formRow formRow_group">
			<label>Xuất xứ</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['xuatxu']?>" name="xuatxu" title="Xuất xứ" class="tipS" />
			</div><!--end formRight-->
            
			<div class="clear"></div>           
		</div><!--end formRow-->    
        
        
        
        <div class="formRow">
			<label>Nội thất</label>
			<div class="formRight">
				
                <textarea name="noithat" id="noithat" cols="10" rows="10"><?=@$item['noithat']?></textarea>
               
			</div><!--end formRight-->
            
			<div class="clear"></div>           
		</div><!--end formRow-->    


<?php } else if ($id_thuoctinh==0) {?>

 <?php echo ("<p class='feedback_thuoctinh'>Không tìm thấy kết quả !!!</p>"); ?>

<?php } else  {?>


 <?php echo ("<p class='feedback_thuoctinh'>Không tìm thấy kết quả !!!</p>"); ?>

<?php }?>

