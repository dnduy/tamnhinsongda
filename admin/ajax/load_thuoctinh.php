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
	$sql = "select ten_vi,tenkhongdau,id,id_hangxe,id_tenxe,id_mauxe,id_loaibds,dientich,mucdich from #_product where id_list='".$id_thuoctinh."' and id='".$id_raovat."'  order by id desc";
	$d->query($sql);
	$item = $d->fetch_array();
	}
	
	else if (isset($_POST["id_thuoctinh"]))
	
	{
		
	$d->reset();
	$sql = "select ten_vi,tenkhongdau,id,id_hangxe,id_tenxe,id_mauxe,id_loaibds,dientich,mucdich from #_product where  id_list='".$id_thuoctinh."'   order by id desc";
	$d->query($sql);
	$item = $d->fetch_array();	
		
	}
	
	
	
	//echo ($item["id_hangxe"]);
	//die();
	
?>






<?php if ($id_thuoctinh==159) {?>


<script type="text/javascript">

<?php if($item['id_loaibds']!=0) {?>

	//alert("eidt");
		
		load_loaibds_edit(<?=$item['id_loaibds']?>);

<?php }  else {?>
	load_loaibds();
<?php } ?>

</script>



<div class="formRow check_menu_adv">
			<label>Danh mục Loại BĐS</label>
			
            
       <div class="formRight">
            	
           <div class="selector">
                
            <select id="id_loaibds" name="id_loaibds" class="main_font" >
                <option value="0">Chọn Loại BĐS</option>
            </select>
				
            </div><!--end selector-->
                
		
        </div><!--end formRight-->

</div><!--end check_menu_adv-->




<div class="formRow check_menu_adv">
			
  	<label>Diện tích </label>          
       <div class="formRight">
            	
		
			<div class="selector">
				<input type="text" value="<?=@$item['dientich']?>" name="dientich" title="Nhập diện tích" class="tipS" style="float:left; width:60%;" original-title="Nhập diện tích" /><b style="float:left; margin-left:10px; font-size:15px;">m²</b>
			</div><!--end selector-->
            
			<div class="clear"></div>                      
		
        </div><!--end formRight-->

</div><!--end check_menu_adv-->





<div class="formRow check_menu_adv">
			
			
            <label>Mục đích sử dụng</label>
             <div class="formRight">
            	
			
			<div class="selector">
				<input type="text" value="<?=@$item['mucdich']?>" name="mucdich" title="Nhập mục đích sử dụng" class="tipS" />
			</div><!--end selector-->
            
			<div class="clear"></div>                      
		
        </div><!--end formRight-->
            
       
</div><!--end check_menu_adv-->




<?php } else if ($id_thuoctinh==160)  { ?>





<script type="text/javascript">


<?php 
	if($item['id_hangxe']!=0){
?>
		load_hangxe_edit(<?=$item['id_hangxe']?>);
<?php
		if($item['id_tenxe']!=0){
?>
		load_tenxe_edit(<?=$item['id_hangxe']?>,<?=$item['id_tenxe']?>);
<?php
		}else{
?>
		load_tenxe(<?=$item['id_hangxe']?>);

 
<?php
		}
	}else{
?>
	load_hangxe();
<?php
	}
?>


<?php if($item['id_mauxe']!=0) {?>
		
		load_mauxe_edit(<?=$item['id_mauxe']?>);

<?php }  else {?>
	load_mauxe();
<?php } ?>






</script>


<div class="formRow check_menu_adv">
			<label>Danh mục Hãng Xe</label>
			
            
       <div class="formRight">
            	
           <div class="selector">
                
            <select id="id_hangxe" name="id_hangxe" class="main_font" onchange="load_tenxe(this.value)">
                <option value="0">Chọn Hãng Xe</option>
            </select>
				
            </div><!--end selector-->
                
		
        </div><!--end formRight-->

</div><!--end check_menu_adv-->




<div class="formRow check_menu_adv">
			<label>Danh mục Tên Xe</label>
			
            
       <div class="formRight">
            	
           <div class="selector">
                
            <select id="id_tenxe" name="id_tenxe" class="main_font" >
                <option value="0">Chọn Tên Xe</option>
            </select>
				
            </div><!--end selector-->
                
		
        </div><!--end formRight-->

</div><!--end check_menu_adv-->





<div class="formRow check_menu_adv">
			<label>Danh mục Màu Xe</label>
			
            
       <div class="formRight">
            	
           <div class="selector">
                
            <select id="id_mauxe" name="id_mauxe" class="main_font">
                <option value="0">Chọn Màu Xe</option>
            </select>
				
            </div><!--end selector-->
                
		
        </div><!--end formRight-->

</div><!--end check_menu_adv-->


<?php } else if ($id_thuoctinh==0) {?>

 <?php echo ("Không tìm thấy kết quả !!!"); ?>

<?php }?>

