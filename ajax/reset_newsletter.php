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

	$email = ($_REQUEST['email']);
	
	
		
	$d->reset();
	$sql="select id,password,email,sex,hoten from #_user where hienthi=1 and id=".$_SESSION["login"]["id"]." and com='member' order by stt,id desc";
	$d->query($sql);
	$email_val=$d->result_array();
	$hoten=$email_val[0]["hoten"];
	$gender=$email_val[0]["sex"];


	if(@strtolower($_REQUEST['code']) == strtolower($_SESSION['random_number']))
	{
		

		if (($_REQUEST["email"])!=($email_val[0]["email"]) )
		{
			
			echo 4; //Email OLD KHONG DUNG
			exit();
			
		}
		
		else
		{

		
			$sql = "select * from #_newsletter where email='".$email."'";
			$d->query($sql);
			
			if( ($d->num_rows() > 0) and ($_REQUEST["nhantin"]!=1)  )
			{
				
				while($row = $d->fetch_array()){
					
					$sql = "delete from #_newsletter where email='".$email."'";
				}
			
				$d->query($sql);
				
						echo 2;	
				
			}
		
		else if(  ($d->num_rows() <> 1) and ($_REQUEST["nhantin"]==1)  )
		{
			
		$d->reset();
		$sql = "insert into #_newsletter (email,hoten,sex,stt,hienthi,ngaytao) value('$email','$hoten','$gender',1,1,".time().")";
		$d->query($sql);
		
	
		echo 1;	
			
		}
		else
		{
			echo 3;
	
		}
		
		
		}
	}
	
	else
	{
	
		echo 0; // invalid code
	}
	?>
