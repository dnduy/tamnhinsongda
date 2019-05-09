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
		
		

		
		if($_POST['cmd']=='load_list'){
			$com_type=$_POST['com_type'];
			$d->reset();
			$sql = "select id, ten_vi from #_news_list where hienthi=1 and com='".$com_type."' order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			echo '<option value="0">Chọn danh mục cấp 1</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
					<option value="<?=$result_item['id']?>"><?=$result_item["ten_vi"]?></option>
<?php	
				}
			}
		}
		else if($_POST['cmd']=='load_list_edit' and isset($_POST['id_list'])){
			$com_type=$_POST['com_type'];
			$id_list=(int)$_POST['id_list'];
			$d->reset();
			$sql = "select id, ten_vi from #_news_list where hienthi=1 and com='".$com_type."' order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			echo '<option value="0">Chọn danh mục cấp 1</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
					<option value="<?=$result_item['id']?>"<?php if($result_item['id']==$id_list) echo ' selected="selected"'; ?>><?=$result_item["ten_vi"]?></option>
<?php	
				}
			}
			
		}else if($_POST['cmd']=='load_cat' and isset($_POST['id_list'])){
			$com_type=$_POST['com_type'];
			$id_list=(int)$_POST['id_list'];
			$d->reset();
			$sql = "select id, ten_vi from #_news_cat where hienthi=1 and com='".$com_type."' and id_list='$id_list' order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			echo '<option value="0">Chọn danh mục cấp 2</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
					<option value="<?=$result_item['id']?>"><?=$result_item["ten_vi"]?></option>
<?php	
				}
			}
		}else if($_POST['cmd']=='load_cat_edit' and isset($_POST['id_list']) and isset($_POST['id_cat'])){
			$com_type=$_POST['com_type'];
			$id_list=(int)$_POST['id_list'];
			$id_cat=(int)$_POST['id_cat'];
			$d->reset();
			$sql = "select id, ten_vi from #_news_cat where hienthi=1 and com='".$com_type."' and id_list='$id_list' order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			echo '<option value="0">Chọn danh mục cấp 2</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
					<option value="<?=$result_item['id']?>"<?php if($result_item['id']==$id_cat) echo ' selected="selected"'; ?>><?=$result_item["ten_vi"]?></option>
<?php	
				}
			}
		}else if($_POST['cmd']=='load_item_edit' and isset($_POST['id_list']) and isset($_POST['id_cat']) and isset($_POST['id_item'])){
			$com_type=$_POST['com_type'];
			$id_list=(int)$_POST['id_list'];
			$id_cat=(int)$_POST['id_cat'];
			$id_item=(int)$_POST['id_item'];
			$d->reset();
			$sql = "select id, ten_vi from #_news_item where hienthi=1 and com='".$com_type."' and id_cat='$id_cat' order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			echo '<option value="0">Chọn danh mục cấp 3</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
	<option value="<?=$result_item['id']?>"<?php if($result_item['id']==$id_item) echo ' selected="selected"'; ?>><?=$result_item["ten_vi"]?></option>
<?php
				}
			}
		}else if($_POST['cmd']=='load_item' and isset($_POST['id_cat'])){
			$com_type=$_POST['com_type'];
			$id_cat=(int)$_POST['id_cat'];
			$d->reset();
			$sql = "select id, ten_vi from #_news_item where hienthi=1 and com='".$com_type."' and id_cat='$id_cat' order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			echo '<option value="0">Chọn danh mục cấp 3</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
					<option value="<?=$result_item['id']?>"><?=$result_item["ten_vi"]?></option>
<?php
				}
				
			}
		}
		
		
		
		
		else if($_POST['cmd']=='load_sub_edit' and isset($_POST['id_list']) and isset($_POST['id_cat']) and isset($_POST['id_item']) and isset($_POST['id_sub']) ){
			$com_type=$_POST['com_type'];
			$id_list=(int)$_POST['id_list'];
			$id_cat=(int)$_POST['id_cat'];
			$id_item=(int)$_POST['id_item'];
			$id_sub=(int)$_POST['id_sub'];
			$d->reset();
			$sql = "select id, ten_vi from #_news_sub where hienthi=1 and com='".$com_type."' and id_item='$id_item' order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			echo '<option value="0">Chọn danh mục cấp 4</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
	<option value="<?=$result_item['id']?>"<?php if($result_item['id']==$id_sub) echo ' selected="selected"'; ?>><?=$result_item["ten_vi"]?></option>
<?php
				}
			}
		}else if($_POST['cmd']=='load_sub' and isset($_POST['id_item'])){
			$com_type=$_POST['com_type'];
			$id_item=(int)$_POST['id_item'];
			$d->reset();
			$sql = "select id, ten_vi from #_news_sub where hienthi=1  and com='".$com_type."' and id_item='$id_item' order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			echo '<option value="0">Chọn danh mục cấp 4</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
					<option value="<?=$result_item['id']?>"><?=$result_item["ten_vi"]?></option>
<?php
				}
				
			}
		}
		
		
		
	}else{
		echo 'error';
	}
	
?>