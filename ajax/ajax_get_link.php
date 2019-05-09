<?php
	error_reporting(0);
	session_start();
	$session=session_id();
	
	@define ( '_template' , '../templates/');
	@define ( '_source' , '../sources/');
	@define ( '_lib' , '../libraries/');
	
    include_once _lib."config.php";
    include_once _lib."constant.php";
    include_once _lib."functions.php";
    include_once _lib."class.database.php";
	$d = new database($config['database']);

	if(!empty($_POST['id_product']) && !empty($_POST['id_user'])){
		$id_product=$_POST['id_product'];
		$id_user=$_POST['id_user'];

		$item = getInfoPro($id_product);

		$url_cur = 'http://'.$config_url.'/san-pham/'.$item['tenkhongdau'].'-'.$item['id'].'.html';

		insert_md5_user($id_user);
		$code_md5 = md5($id_user);
		$url_cur .= '/'.$code_md5;
		echo $url_cur;
	}
	die();

?>