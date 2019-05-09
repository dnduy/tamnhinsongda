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
include_once _lib . "file_requick.php";
include_once _source . "counter.php";
include_once _source . "useronline.php";

$d = new database($config['database']);


@$masp=$_POST["masp"];

	$sql = "select * from #_product where hienthi=1 and masp='".$masp."' and ((com='product'  or com='productadd') )";
	$d->query($sql);
		if($d->num_rows() == 1 ){
					
					$row = $d->fetch_array();
					
					if ($row["trangthaikho"]>0)
					{
						@$pid = $row['id'];
						@$color =0;
						@$size =0;
						@$soluong =1;


						$result_giohang = addtocart($pid,$soluong,$size,$color);



						$count = count($_SESSION['cart']);

						//$result = array('result_giohang' => $result_giohang, 'count' => $count);

						//echo json_encode($result);

						echo 1;
					}
					
					else 
					{
						echo 2;
						
					}
					
					
					
		}
		
		else 
		{
			echo 0;
		}







?>