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
		
		
		
		
		/*******************************************START LOAD GROUP THUOC TINH *****************************/
		
		
		if($_POST['cmd']=='load_hangxe'){
			$d->reset();
			$sql = "select id, ten_vi from #_news_list where hienthi=1 and com='oto' order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			echo '<option value="0">Chọn Hãng Xe</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
					<option value="<?=$result_item['id']?>"><?=$result_item["ten_vi"]?></option>
<?php	
				}
			}
		}
		else if($_POST['cmd']=='load_hangxe_edit' and isset($_POST['id_hangxe'])){
			$id_hangxe=(int)$_POST['id_hangxe'];
			$d->reset();
			$sql = "select id, ten_vi from #_news_list where hienthi=1 and com='oto' order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			
			
			
			
			
			echo '<option value="0">Chọn Hãng Xe</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
					<option value="<?=$result_item['id']?>"<?php if($result_item['id']==$id_hangxe) echo ' selected="selected"'; ?>><?=$result_item["ten_vi"]?></option>
<?php	
				}
			}
			
		}else if($_POST['cmd']=='load_tenxe' and isset($_POST['id_hangxe'])){
			$id_hangxe=(int)$_POST['id_hangxe'];
			$d->reset();
			$sql = "select id, ten_vi from #_news_cat where hienthi=1 and com='oto' and id_list='$id_hangxe' order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			echo '<option value="0">Chọn Tên Xe</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
					<option value="<?=$result_item['id']?>"><?=$result_item["ten_vi"]?></option>
<?php	
				}
			}
		}else if($_POST['cmd']=='load_tenxe_edit' and isset($_POST['id_hangxe']) and isset($_POST['id_tenxe'])){
			$id_hangxe=(int)$_POST['id_hangxe'];
			$id_tenxe=(int)$_POST['id_tenxe'];
			$d->reset();
			$sql = "select id, ten_vi from #_news_cat where hienthi=1 and com='oto' and id_list='$id_hangxe' order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			echo '<option value="0">Chọn Tên Xe</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
					<option value="<?=$result_item['id']?>"<?php if($result_item['id']==$id_tenxe) echo ' selected="selected"'; ?>><?=$result_item["ten_vi"]?></option>
<?php	
				}
			}
		}
		
		
		
		
		
		if($_POST['cmd']=='load_tinhtrang')
	
		{
			
			$d->reset();
			$sql = "select id, ten_vi from #_news where hienthi=1 and com='tinhtrang' order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			//echo '<option value="0">Chọn Tình trạng</option>';
			if(!empty($result))
			{
				foreach($result as $result_item)
				{
		?>
					<option value="<?=$result_item['id']?>"><?=$result_item["ten_vi"]?></option>
	<?php	
				}
			}
		}
		else if($_POST['cmd']=='load_tinhtrang_edit' and isset($_POST['id_tinhtrang'])){
			$id_tinhtrang=(int)$_POST['id_tinhtrang'];
			$d->reset();
			$sql = "select id, ten_vi from #_news where hienthi=1 and com='tinhtrang' order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
		//	echo '<option value="0">Chọn Tình trạng</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
					<option value="<?=$result_item['id']?>"<?php if($result_item['id']==$id_tinhtrang) echo ' selected="selected"'; ?>><?=$result_item["ten_vi"]?></option>

			 
                
			<?php	
				}
			}
		}
		
		
		
		
		if($_POST['cmd']=='load_donvi')
	
		{
			
			$d->reset();
			$sql = "select id, ten_vi from #_news where hienthi=1 and com='donvigia' order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			//echo '<option value="0">Chọn Đơn Vị Giá</option>';
			if(!empty($result))
			{
				foreach($result as $result_item)
				{
		?>
					<option value="<?=$result_item['id']?>"><?=$result_item["ten_vi"]?></option>
	<?php	
				}
			}
		}
		else if($_POST['cmd']=='load_donvi_edit' and isset($_POST['id_donvi'])){
			$id_donvi=(int)$_POST['id_donvi'];
			$d->reset();
			$sql = "select id, ten_vi from #_news where hienthi=1 and com='donvigia' order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
		//	echo '<option value="0">Chọn Đơn Vị Giá</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
					<option value="<?=$result_item['id']?>"<?php if($result_item['id']==$id_donvi) echo ' selected="selected"'; ?>><?=$result_item["ten_vi"]?></option>

			 
                
			<?php	
				}
			}
		}
		
		
		
		
		
		if($_POST['cmd']=='load_mauxe')
	
		{
			
			$d->reset();
			$sql = "select id, ten_vi from #_news where hienthi=1 and com='oto' order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			echo '<option value="0">Chọn Màu Xe</option>';
			if(!empty($result))
			{
				foreach($result as $result_item)
				{
		?>
					<option value="<?=$result_item['id']?>"><?=$result_item["ten_vi"]?></option>
	<?php	
				}
			}
		}
		else if($_POST['cmd']=='load_mauxe_edit' and isset($_POST['id_mauxe'])){
			$id_mauxe=(int)$_POST['id_mauxe'];
			$d->reset();
			$sql = "select id, ten_vi from #_news where hienthi=1 and com='oto' order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			echo '<option value="0">Chọn Màu Xe</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
					<option value="<?=$result_item['id']?>"<?php if($result_item['id']==$id_mauxe) echo ' selected="selected"'; ?>><?=$result_item["ten_vi"]?></option>

			 
                
			<?php	
				}
			}
		}
	
	
	
	
	
	
	
		
			if($_POST['cmd']=='load_loaibds')
	
		{
			
			$d->reset();
			$sql = "select id, ten_vi from #_news where hienthi=1 and com='loaibds' order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			echo '<option value="0">Chọn Loại BĐS</option>';
			if(!empty($result))
			{
				foreach($result as $result_item)
				{
		?>
					<option value="<?=$result_item['id']?>"><?=$result_item["ten_vi"]?></option>
	<?php	
				}
			}
		}
		else if($_POST['cmd']=='load_loaibds_edit' and isset($_POST['id_loaibds'])){
			$id_loaibds=(int)$_POST['id_loaibds'];
			
			
			
			$d->reset();
			$sql = "select id, ten_vi from #_news where hienthi=1 and com='loaibds' order by stt,id";
			$d->query($sql);
			$result=$d->result_array();
			echo '<option value="0">Chọn Loại BĐS</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
					<option value="<?=$result_item['id']?>"<?php if($result_item['id']==$id_loaibds) echo ' selected="selected"'; ?>><?=$result_item["ten_vi"]?></option>

			 
                
			<?php	
				}
			}
		}
	
	
	
		
		
		/*********************************************END LOAD GROUP THUOC TINH *********************************/
		
		
		if($_POST['cmd']=='load_typeposting')
	
		{
			
			$d->reset();
			$sql = "select id, ten_vi from #_type_posting where hienthi=1 order by stt desc";
			$d->query($sql);
			$result=$d->result_array();
			//echo '<option value="0">Chọn Loại Tin Rao</option>';
			if(!empty($result))
			{
				foreach($result as $result_item)
				{
		?>
					<option value="<?=$result_item['id']?>"><?=$result_item["ten_vi"]?></option>
	<?php	
				}
			}
		}
		else if($_POST['cmd']=='load_typeposting_edit' and isset($_POST['id_typeposting'])){
			$id_typeposting=(int)$_POST['id_typeposting'];
			$d->reset();
			$sql = "select id, ten_vi from #_type_posting where hienthi=1 order by stt desc";
			$d->query($sql);
			$result=$d->result_array();
			//echo '<option value="0">Chọn Loại Tin Rao</option>';
			if(!empty($result)){
				foreach($result as $result_item){
?>
					<option value="<?=$result_item['id']?>"<?php if($result_item['id']==$id_typeposting) echo ' selected="selected"'; ?>><?=$result_item["ten_vi"]?></option>

			 
                
			<?php	
				}
			}
		}
	
	
	
	

		
		
		
		if($_POST['cmd']=='load_list'){
			$com_type=$_POST['com_type'];
			$d->reset();
			$sql = "select id, ten_vi from #_product_list where hienthi=1 and com='".$com_type."' order by stt,id";
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
			$sql = "select id, ten_vi from #_product_list where hienthi=1 and com='".$com_type."' order by stt,id";
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
			$sql = "select id, ten_vi from #_product_cat where hienthi=1 and com='".$com_type."' and id_list='$id_list' order by stt,id";
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
			$sql = "select id, ten_vi from #_product_cat where hienthi=1 and com='".$com_type."' and id_list='$id_list' order by stt,id";
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
			$sql = "select id, ten_vi from #_product_item where hienthi=1 and com='".$com_type."' and id_cat='$id_cat' order by stt,id";
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
			$sql = "select id, ten_vi from #_product_item where hienthi=1 and com='".$com_type."' and id_cat='$id_cat' order by stt,id";
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
			$sql = "select id, ten_vi from #_product_sub where hienthi=1 and com='".$com_type."' and id_item='$id_item' order by stt,id";
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
			$sql = "select id, ten_vi from #_product_sub where hienthi=1  and com='".$com_type."' and id_item='$id_item' order by stt,id";
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