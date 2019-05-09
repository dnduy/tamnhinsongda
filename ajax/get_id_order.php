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

	if(!empty($_POST)){
		$arr_result = array();
		$email = $_POST['email'];
		$id_order = $_POST['num_order'];

		// lấy giá trị của mã giảm giá
		$sql="select * from #_order where madonhang='".$id_order."' and email='$email' limit 0,1";
		$d->query($sql);
		$row_detail = $d->fetch_array();
		if(!empty($row_detail)){
			$arr_result['err'] = '0';
			$arr_result['id_order'] = $row_detail['id'];
			$arr_result['date'] = $row_detail['ngaytao'];
			$arr_result['code_order'] = $row_detail['madonhang'];
		}else{
			$arr_result['err'] = '1';
		}
		echo json_encode($arr_result);
	}
	die();
?>

