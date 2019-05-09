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

?>


       (<span><?=get_total_qty()?></span>) <?=_sp?>

                        