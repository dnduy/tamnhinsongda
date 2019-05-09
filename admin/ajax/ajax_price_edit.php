<?php
	error_reporting(-1);
	session_start();
	$session=session_id();
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , '../libraries/');

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";	
	$d = new database($config['database']);
	
	@$id = $_POST['id'];
	@$giaban = $_POST['giaban'];
	
	//alert($giaban);


	$d->reset();
	$sql= "select * from table_product where id='".$id."'";
	$d->query($sql);
	$price_edit = $d->fetch_array();
	
	
	$sql = "UPDATE table_product SET gia='".$giaban."' where id='".$id."'";
	mysql_query($sql);		

	
	echo number_format($giaban,0, ',', '.').'&nbsp;VNĐ';
	

?>
