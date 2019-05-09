<?php
	session_start();
	date_default_timezone_set('Asia/Ho_Chi_Minh');
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
	include_once _lib."functions_giohang.php";
	
	include_once _lib."library.php";
	include_once _lib."class.database.php";	
	
	include_once _lib."file_requick.php";
	$d = new database($config['database']);
	
	
	function fns_Rand_digit($min,$max,$num)
		{
			$result='';
			for($i=0;$i<$num;$i++){
				$result.=rand($min,$max);
			}
			return $result;	
		}
	
	
	if(@strtolower($_REQUEST['code']) == strtolower($_SESSION['random_number']))
	{
		

		$d->reset();
		$d->setTable('user');
		$d->setWhere('id', $_REQUEST['id_thanhvien']);
		$d->select();
		$check_email=$d->fetch_array();	
		
		if ($check_email["email"]!=$_REQUEST["email"])
		{
			echo 2; // Kiểm tra email đúng với email hiện tại ???
			die();
		}		
		
		else
		{
			

				
			$id_thanhvien=$check_email["id"];
			$randomkey = ChuoiNgauNhien(32);		
			$linkweb = $row_setting["website"];			
			$data['id_thanhvien'] = $id_thanhvien;			
			$data['randomkey'] = $randomkey;
			$email_taodiachi = $check_email["email"];				
			$hoten_taodiachi = $check_email["hoten"];
			
			$data['email_taodiachi'] =$email_taodiachi;
			$data['hoten_taodiachi'] =$hoten_taodiachi;
			
			$data['hoten'] = ($_REQUEST['name']);
			$data['dienthoai'] = ($_REQUEST['phone']);
			$data['diachigiaohang'] = ($_REQUEST['diachigiaohang']);
			$data['id_quocgia'] = ($_REQUEST['quocgia']);
			$data['id_tinh'] = ($_REQUEST['tinh']);
			$data['id_huyen'] = ($_REQUEST['huyen']);
			$data['id_phuong'] = ($_REQUEST['phuong']);
			$data['ngaytao'] = time();			


		
		
			$d->reset();
			$d->setTable('taodiachi');
			$d->setWhere('id_thanhvien', ($_REQUEST['id_thanhvien']));
			if($d->update($data))
			{
					echo 1; //Thành công
					exit();
			}

			else
			{
				echo 3; //Thất bại insert
				exit();
			}
		}
	}else
	{
		echo 0; // invalid code
	}

	?>