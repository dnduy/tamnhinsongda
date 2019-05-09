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
		$id_coupon = $_POST['id_coupon'];
		$id_user = $_POST['id_user'];
		$total_order = $_POST['total'];
		
		$time = time();
		// lấy giá trị của mã giảm giá
		$d->reset();
		$sql="select id,loai,giatri,max from #_coupon where id='".$id_coupon."' and thoigiantu<=$time and thoigianden>=$time";
		$d->query($sql);
		$row_detail = $d->fetch_array();
		if(!empty($row_detail)){
			$d->reset();
			$sql="select id,loai,giatri,max from #_coupon where id='".$id_coupon."' and thoigiantu<=$time and thoigianden>=$time and min<=$total_order";
			$d->query($sql);
			$result = $d->fetch_array();
			if(!empty($result)){
				$arr_result['err'] = 0;
				$arr_result['loai'] = $row_detail['loai'];
				$arr_result['giatri'] = $row_detail['giatri'];
				$arr_result['max'] = $row_detail['max'];
				$arr_result['id_coupon'] = $row_detail['id'];
				echo json_encode($arr_result);
				die();
			}else{
				$arr_result['err'] = 2; // lỗi: giá trị hóa đơn không đủ để áp dụng
				echo json_encode($arr_result);
				die();
			}
		}else{
			$arr_result['err'] = 1; // lỗi: vượt quá thời gian sử dụng
			echo json_encode($arr_result);
			die();
		}
		
	}
	die();
?>

