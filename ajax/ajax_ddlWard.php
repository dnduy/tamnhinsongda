<?php
	error_reporting(0);
	session_start();
	$session=session_id();
	
	@define ( '_template' , '../templates/');
	@define ( '_source' , '../sources/');
	@define ( '_lib' , '../libraries/');
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
    include_once _lib."class.database.php";
	$d = new database($config['database']);
	if(isset($_GET['id_ddlWard'])){
		$id_ddlWard=$_GET['id_ddlWard'];
		//Lay quan huyen tu tinh thanh
		$d->reset();
		$sql_tinh="select id,ten_$lang from #_city_sub where id_item='".$id_ddlWard."'and hienthi =1 order by stt asc";
		$d->query($sql_tinh);
		$duongpho = $d->result_array();
		echo'<option value="">Chọn Đường/Phố</option>';
		for($i=0,$count_quan=count($duongpho);$i<$count_quan;$i++) { 
             echo'<option value="'.$duongpho[$i]['id'].'" rel="Đường">'.$duongpho[$i]["ten_$lang"].'</option>';
		}
	}
	

?>