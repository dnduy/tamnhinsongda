<?php
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	@define ( '_template' , '../templates/');
	@define ( '_source' , '../sources/');
	@define ( '_lib' , '../libraries/');

    include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."class.database.php";	
	
	$d = new database($config['database']);
	

	$email = ($_REQUEST['email']);
	$sql = "select * from #_user where email='".$email."'";
	$d->query($sql);
	$result = $d->fetch_array();
	if(!empty($result)){
		echo 1;
	}else{
		echo 0;
	}
	die();
?>
