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
	include_once _lib."functions_member.php";
	
	include_once _lib."file_requick.php";
	$d = new database($config['database']);
	

	
	$username = strtolower($_POST['username']);
	if (get_magic_quotes_gpc()==false) {
			$username = mysql_real_escape_string($username);
	}
	
	$d->reset();
	$sql_user = "select * from #_user where email='".$username."' ";
	$d->query($sql_user);
	$row_user = $d->result_array();
	if(count($row_user)==1){
		echo 'Số CMND: '.$row_user[0]['cmnd']."\n";
		echo 'Tên người nhận: '.$row_user[0]['hoten'];
		
	}else echo 'Không tồn tại thành viên '.$username;

?>