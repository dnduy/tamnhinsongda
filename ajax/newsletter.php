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

	
	
	$email = $_POST['email'];
	$name_newsletter = $_POST['name_newsletter'];
	$phone_newsletter = $_POST['phone_nt'];
	$noidung_newsletter = $_POST['noidung_newsletter'];
	$sex = $_POST['sex'];
	
	$sql = "select * from #_newsletter where email='$email'";
	$d->query($sql);
	if($d->num_rows()>0){
	echo 'Email này đã đăng ký';return;	
	}
	$d->reset();
	$sql = "insert into #_newsletter (email,hoten,dienthoai,noidung,stt,hienthi,ngaytao) value('$email','$name_newsletter','$phone_newsletter','$noidung_newsletter',1,1,".time().")";
	if($d->query($sql))echo 'Bạn đã đăng ký thành công';
	else echo 'Vui lòng thực hiện lại !!!';
	
?>