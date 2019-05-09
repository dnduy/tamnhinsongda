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

		
	$d->reset();
	$sql="select id,password,email from #_user where hienthi=1 and id=".$_SESSION["login"]["id"]." and com='member' order by stt,id desc";
	$d->query($sql);
	$emailold_val=$d->result_array();
	

	if(@strtolower($_REQUEST['code']) == strtolower($_SESSION['random_number']))
	{
		

		//$data['emailold'] = ($_REQUEST['emailold']);
		//$data['password'] = md5($_REQUEST['emailold']);
		
		if (($_REQUEST["emailold"])!=($emailold_val[0]["email"]) )
		{
			
			echo 4; //Email OLD KHONG DUNG
			exit();
			
		}
		
		else
		{

		$data['email'] = $_REQUEST['emailnew'];
		$data['role'] = 1;
		$data['com'] = "member";
		
		
		
		$d->reset();
		$d->setTable('user');
		$d->setWhere('email', ($_REQUEST['email']));
		if($d->update($data))
		{

			$_SESSION["nguyenngoctan"]=true;
			unset($_SESSION["login"]["email"]);
			$_SESSION["login"]["email"]=$data["email"];
			
			echo 1; //Thành công
			exit();
		}
		else
		{
			echo 3; //Thất bại insert
			exit();
		}
		
		}
	}
	
	else
	{
	
		echo 0; // invalid code
	}
	?>
