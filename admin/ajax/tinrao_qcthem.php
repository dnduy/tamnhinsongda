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

	
	$id = $_POST['id_raovatqc'];

	
	$d->reset();
	$sql = "select ten_vi,id,thumb from #_product where hienthi=1 and id='".$id."' order by stt asc";
	$d->query($sql);
	$product = $d->result_array();

?>
<script language="javascript">
 $(document).ready(function(e) {
	$('.delete').click(function(e) {
        $(this).parent().remove();
    });
 });
</script>
<div class="load_raovatqc">

	<div class="left_raoqc">
    <?php if ($product[0]["thumb"]!="") {?>
	<img src="<?=_upload_product.$product[0]['thumb']?>"> 
   	<?php } else {?>
    <img src="images/error-image.png"> 
    <?php }?>
   	
    </div>
    
    <div class="right_raoqc">
    
     <p><?=$product[0]['ten_vi']?></p>
   
    
    </div><!--end right_raoqc-->
    <img src="images/delete_rvqc.png" alt="icon" title="xoa" class="delete">
    <input type="hidden" value="<?=$product[0]['id']?>" name="tinrao_kemtheo[]" >
    
    <div class="clear"></div>
    
</div><!--end load_raovatqc-->