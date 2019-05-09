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

	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

	if($act=='update'){
		//Cap nhat so thu tu
		$table=addslashes($_POST['table']);
		$id=addslashes($_POST['id']);
		$num=(int)$_POST['num'];
		$sql="update #_$table set stt='$num' where id='$id' ";
		$d->query($sql);
	}
	if($act=='delete'){
		//Cap nhat so thu tu
		$table=addslashes($_POST['table']);
		$id=addslashes($_POST['id']);
		$sql="delete from table_$table where id='$id' ";
		$d->query($sql);
	}

?>