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

	
	$id = $_POST['id_sp'];

	
	$d->reset();
	$sql = "select ten_vi,id,link from #_news where hienthi=1 and id='".$id."' order by stt asc";
	$d->query($sql);
	$video = $d->result_array();

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
    <?php if ($video[0]["link"]!="") {?>
	  <img src="<?=video_image($video[0]["link"])?>"> 
	
   	<?php } else {?>
    <img src="images/error-image.png"> 
    <?php }?>
   	
    </div>
    
    <div class="right_raoqc">
    
    <p> <a title="<?=$video[0]['ten_vi']?>"><?=strip_tags(catchuoi($video[0]['ten_vi'],40))?></a></p>
		
    </div><!--end right_raoqc-->
    <img src="images/delete_rvqc.png" alt="icon" title="xoa" class="delete">
    <input type="hidden" value="<?=$video[0]['id']?>" name="list_video[]" >
    
    <div class="clear"></div>
    
</div><!--end load_raovatqc-->