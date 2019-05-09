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
	
	if(@strtolower($_REQUEST['code']) == strtolower($_SESSION['random_number']))
	{
		
		$data['email'] = ($_REQUEST['email']);
		$data['hoten'] = ($_REQUEST['name']);
		$data['bidanh'] = ($_REQUEST['bidanh']);
		$data['ngaysinh'] = strtotime($_POST['ngaysinh']);
		$data['sex'] = ($_REQUEST['gender']);
		$data['tinh'] = ($_REQUEST['tinh']);
		$data['huyen'] = ($_REQUEST['huyen']);
		$data['phuongxa'] = ($_REQUEST['phuongxa']);
		$data['khuvucsinhsong'] = ($_REQUEST['khuvucsinhsong']);
		$data['dienthoaicodinh'] = ($_REQUEST['dienthoaicodinh']);
		$data['dienthoai'] = ($_REQUEST['phone']);
		$data['nick_yahoo'] = ($_REQUEST['nick_yahoo']);
		$data['nick_skype'] = ($_REQUEST['nick_skype']);
		$data['gioithieu'] = ($_REQUEST['gioithieu']);
		$data['loaitaikhoan'] = ($_REQUEST['loaitaikhoan']);
		
		$data['ngaysinh'] = strtotime($_POST['ngaysinh']);
		$data['role'] = 1;
		$data['com'] = "user";
		
		//echo ($_FILES['files']);
		//echo ("asda");
		//die();
		
		  if(count($_FILES['files']) > 0)
		{
			$files = array();
			$i=0;
			foreach($_FILES['files'] as $k=>$v)
			{
				
				$tmp = array();
				$tmp['name'] = $_FILES['files']['name'][$i];
				$tmp['type'] = $_FILES['files']['type'][$i];
				$tmp['tmp_name'] = $_FILES['files']['tmp_name'][$i];
				$tmp['error'] = $_FILES['files']['error'][$i];
				$files[] = $tmp;
				$i++;
				
			}
			$photos = array();
			$_FILES = $files;
			
			foreach($files as $k=>$v)
			{
				
				
				if($v['name'])
				{
					$file_photo_firtname = changeTitle($_REQUEST['name'])."-".rand(0,999)."";

					if(!$k)
					{

						if($photo = upload_image($k, _format_duoihinh, _upload_hinhanh_l,$file_photo_firtname))
						{
							
						
						
							$data['photo'] = $photo;	
							$data['thumb'] = create_thumb($data['photo'], 110, 110, _upload_hinhanh_l,$file_photo_firtname,2);									
							
							
						}
					
					}
					else
					{
						if($photo = upload_image($k, _format_duoihinh, _upload_hinhanh_l,$file_photo_firtname))
						{
					
					
						//print_r($v['name']);
					//print_r($photo);
					//die();
						$data['photo'] = $photo;	
						$data['thumb'] = create_thumb($data['photo'], 110, 110, _upload_hinhanh_l,$file_photo_firtname,2);									
					
						}
					}
					
				}
			}
			
			//print_r($_FILES['files']);
			//print_r($photo);
			//die();
		}
		
		$d->reset();
		$d->setTable('user');
		$d->setWhere('email', $_REQUEST['email']);
		if($d->update($data))
		{
			echo 1; //Thành công
			exit();
		}else{
			echo 3; //Thất bại insert
			exit();
		}
	}
	else{
	
		echo 0; // invalid code
	}
	
	
				
	
	?>
    
    
   