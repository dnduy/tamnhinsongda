<?php

	@define ( '_template' , '../templates/');
	@define ( '_source' , '../sources/');
	@define ( '_lib' , '../admin/lib/');
	@define ( _upload_folder , '../media/upload/' );
	//Lưu ngôn ngữ chọn vào $_SESSION
	$lang_arr=array("vi","en","ge");
	if (isset($_GET['lang']) == true){
        if (in_array($_GET['lang'], $lang_arr)==true){
            $lang = $_GET['lang'];
            $_SESSION['lang']=$lang;
		  header('Location: '.$_SERVER['HTTP_REFERER']);
        } 
	}
    if(isset($_SESSION['lang'])){
        $lang= $_SESSION['lang'];
    }else{
        $lang="vi";
    }
	require_once _source."lang_$lang.php";	
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."class.database.php";
	include_once _lib."file_requick.php";
	include_once _source."counter.php";
	include_once _source."useronline.php";
	
	$d = new database($config['database']);
	
	@$id = $_GET["id"];

	$d->reset();
	$sql_video = "select * from #_product where hienthi=1  and id='".$id."'   order by id desc";
	$d->query($sql_video);
	$row_tintuc = $d->result_array();
	
	

?>

  <img src="<?=_upload_product_l.$row_tintuc[0]["photo"]?>" width="120" height="120" />
        
     