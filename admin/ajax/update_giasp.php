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
	@$giasp = $_POST['giasp'];

	
	
	if($_POST['loai']=='update' && $_POST['giasp'] !="")
	{
		//cap nhat so tien tai vi tri  chon
		//$res[0]=1;
		
		$sql = "Update INTO table_product (gia) VALUES ('$giasp')";
		$d->query($sql);
		
		//echo number_format(get_order_total(),0, ',', '.').' VNĐ';
		 
		//echo json_encode($res);
		//echo number_format($tonggia,0, ',', '.').' VNĐ';
	}

	
?>