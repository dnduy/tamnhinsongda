<?php
error_reporting(0);
session_start();
$session = session_id();

@define('_template', '../templates/');


@define('_source', '../sources/');
@define('_lib', '../libraries/');
@define(_upload_folder, '../media/upload/');


include_once _lib . "config.php";



//Lưu ngôn ngữ chọn vào $_SESSION
$lang_arr = array("vi", "en", "cn", "ge");
if (isset($_GET['lang']) == true) {
    if (in_array($_GET['lang'], $lang_arr) == true) {
        $lang = $_GET['lang'];
        $_SESSION['lang'] = $lang;
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
if (isset($_SESSION['lang'])) {
    $lang = $_SESSION['lang'];
} else {

    $lang = $config["lang_default"];
}



require_once _source . "lang_$lang.php";



include_once _lib . "constant.php";

include_once _lib . "functions.php";

include_once _lib . "functions_giohang.php";

include_once _lib . "library.php";

include_once _lib . "class.database.php";



$d = new database($config['database']);




		$email = ($_REQUEST['email']);
		$pass = ($_REQUEST['pass']);
		$sql = "select * from #_user where (email='".$email."' or dienthoai='".$email."') and ((com='member'  and mauser!='') )";
		$d->query($sql);
		
		
		if($d->num_rows() == 1){
			
			$row = $d->fetch_array();
			if(($row['password'] == md5($pass)) && ($row['role'] == 1 || $row['role'] == 3)){
				
			
				
				$_SESSION['nguyenngoctan'] = true;
				$_SESSION['login_member']['email'] = $email;
				$_SESSION['login_member']['hoten'] = $row['hoten'];
				$_SESSION['login_member']['active'] = $row['hienthi'];
				$_SESSION['login_member']['id'] = $row['id'];
				
			
				$_SESSION['login_member']['phone'] = $row['dienthoai'];

				
				$_SESSION['login_member']['user'] = $row['user'];
				$_SESSION['login_member']['mauser'] = $row['mauser'];
				
				
				$_SESSION['login_member']['trangthai'] = 'now';
				$_SESSION['login_member']['mess'] = 'Đăng nhập thành công!';
				
				
						
				//Lần đăng nhập cuối
			$sql_lastlogin = "update table_user SET lastlogin='".time()."' WHERE  id = '".$row['id']."' and com='member' ";
			mysql_query($sql_lastlogin);	
			
			
			
			//Set Cookie
				setcookie("id", $row['id'], time()+86400,'/');
				setcookie("secretkey", $row['randomkey'], time()+86400,'/');
			
				
				echo 1;
			}
		}else{
			echo 0;
		}

	
	?>
