<?php
	error_reporting(0);
	session_start();
	$session=session_id();
	
	@define ( '_template' , '../templates/');
	@define ( '_source' , '../sources/');
	@define ( '_lib' , '../libraries/');
	@define ( _upload_folder , '../media/upload/' );
	
    include_once _lib."config.php";
    include_once _lib."constant.php";
    include_once _lib."functions.php";
    include_once _lib."class.database.php";
	$d = new database($config['database']);

	if(!empty($_POST['md5']) && !empty($_POST['qty'])){

		$md5 = $_POST['md5'];
		$q=$_POST['qty'];

		if(isset($_SESSION['cart'])){

			foreach($_SESSION['cart'] as $k=>$v){
				if($v['md5'] == $md5){
					$_SESSION['cart'][$k]['qty']=$q;
				}
			}

		}

		// trả về số lượng giỏ hàng
		// trả về số lượng giỏ hàng
		$sum=0;
		foreach($_SESSION['cart'] as $v){
			$q=$v['qty'];
			$sum+=$q;
		}
		
		echo $sum;
	}

	

	die();
?>