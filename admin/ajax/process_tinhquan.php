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
	if(isset($_POST['cmd'])){
		
		
	
		
		if($_POST['cmd']=='load_tinh'){
			$d->reset();
			$sql = "select id, ten_vi from #_city_list where hienthi=1  order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			echo '<option value="0">Chọn Tỉnh/Thành</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
					<option value="<?=$result_item['id']?>"><?=$result_item["ten_vi"]?></option>
<?php	
				}
			}
		}else if($_POST['cmd']=='load_tinh_edit' and isset($_POST['id_tinh'])){
			$id_tinh=(int)$_POST['id_tinh'];
			$d->reset();
			$sql = "select id, ten_vi from #_city_list where hienthi=1  order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			echo '<option value="0">Chọn Tỉnh/Thành</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
					<option value="<?=$result_item['id']?>"<?php if($result_item['id']==$id_tinh) echo ' selected="selected"'; ?>><?=$result_item["ten_vi"]?></option>
<?php	
				}
			}
			
		}
        
        
 	  else if($_POST['cmd']=='load_huyen' and isset($_POST['id_tinh'])){
			$id_tinh=(int)$_POST['id_tinh'];
			$d->reset();
			$sql = "select id, ten_vi from #_city_cat where hienthi=1 and id_list='$id_tinh'  order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			echo '<option value="0">Chọn Quận/Huyện</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
					<option value="<?=$result_item['id']?>"><?=$result_item["ten_vi"]?></option>
<?php	
				}
			}
		}else if($_POST['cmd']=='load_huyen_edit' and isset($_POST['id_tinh']) and isset($_POST['id_huyen'])){
			$id_tinh=(int)$_POST['id_tinh'];
			$id_huyen=(int)$_POST['id_huyen'];
			$d->reset();
			$sql = "select id, ten_vi from #_city_cat where hienthi=1 and id_list='$id_tinh'  order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			echo '<option value="0">Chọn  Quận/Huyện</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
					<option value="<?=$result_item['id']?>"<?php if($result_item['id']==$id_huyen) echo ' selected="selected"'; ?>><?=$result_item["ten_vi"]?></option>
<?php	
				}
			}
		}
		
		
		else if($_POST['cmd']=='load_phuong_edit' and isset($_POST['id_tinh']) and isset($_POST['id_huyen']) and isset($_POST['id_phuong'])){
			$id_tinh=(int)$_POST['id_tinh'];
			$id_huyen=(int)$_POST['id_huyen'];
			$id_phuong=(int)$_POST['id_phuong'];
			$d->reset();
			$sql = "select id, ten_vi from #_city_item where hienthi=1 and id_cat='$id_huyen' order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			echo '<option value="0">Chọn Phường/Xã</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
	<option value="<?=$result_item['id']?>"<?php if($result_item['id']==$id_phuong) echo ' selected="selected"'; ?>><?=$result_item["ten_vi"]?></option>
<?php
				}
			}
		}
		
		else if($_POST['cmd']=='load_phuong' and isset($_POST['id_huyen'])){
			
			$id_huyen=(int)$_POST['id_huyen'];
			$d->reset();
			$sql = "select id, ten_vi from #_city_item where hienthi=1 and id_cat='$id_huyen' order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			echo '<option value="0">Chọn Phường/Xã</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
					<option value="<?=$result_item['id']?>"><?=$result_item["ten_vi"]?></option>
<?php
				}
				
			}
		}
		
		else if($_POST['cmd']=='load_duong_edit' and isset($_POST['id_tinh']) and isset($_POST['id_huyen']) and isset($_POST['id_phuong']) and isset($_POST['id_duong']) ){
			$id_tinh=(int)$_POST['id_tinh'];
			$id_huyen=(int)$_POST['id_huyen'];
			$id_phuong=(int)$_POST['id_phuong'];
			$id_duong=(int)$_POST['id_duong'];
			$d->reset();
			$sql = "select id, ten_vi from #_city_sub where hienthi=1 and id_item='$id_phuong' order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			echo '<option value="0">Chọn Đường/Phố</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
	<option value="<?=$result_item['id']?>"<?php if($result_item['id']==$id_duong) echo ' selected="selected"'; ?>><?=$result_item["ten_vi"]?></option>
<?php
				}
			}
		}
		
		else if($_POST['cmd']=='load_duong' and isset($_POST['id_phuong'])){
			
			$id_phuong=(int)$_POST['id_phuong'];
			$d->reset();
			$sql = "select id, ten_vi from #_city_sub where hienthi=1 and id_item='$id_phuong' order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			echo '<option value="0">Chọn Đường/Phố</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
					<option value="<?=$result_item['id']?>"><?=$result_item["ten_vi"]?></option>
<?php
				}
				
			}
		}
		
		
	}
	
	
	else
        
        {
		echo 'error';
	}
    
	
?>