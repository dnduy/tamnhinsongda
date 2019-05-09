<?php 
if(!defined('_lib')) die("Error");
error_reporting(0);
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');

/* Developer Group Startup Number One (GaConIt) */

$config['author']['group'] = 'Nguyễn Ngọc Tân';
$config['author']['fullname'] = 'Nguyễn Ngọc Tân';
$config['author']['nickname'] = 'GaConIT1991';
$config['author']['email'] = 'nguyentanit91@yahoo.com';
$config['author']['timefinish'] = '4/04/2016';

/* Config Langs */

$config["langs"] = array('vi'=>'Tiếng Việt','en'=>'Tiếng Anh','cn'=>'Tiếng Trung','ge'=>'Tiếng Đức');
//$config['lang']=array('vi','en','cn','ge'); example
$config['lang']=array('vi','en'); // excute array langs presents
$config['lang_default'] = 'vi'; #Ngôn ngữ mặc định;

if(count($config['lang']) == 1){
	$config['langs'] = array('vi'=>'Nội dung');
}


/* config Connect Mysql  */
$config_folder='';
$config_url=$_SERVER["SERVER_NAME"].$config_folder;
$config['debug']=-1;    #Bật chế độ debug dành cho developer
$config['database']['servername'] = 'localhost';
$config['database']['username'] = 'tamnhinson_home';
$config['database']['password'] = '6Rov1KaFoq';
$config['database']['database'] = 'tamnhinson_home';
$config['database']['refix'] = 'table_';

/* ckfinder config */
	
$config['finder']['folder'] = $config_folder;
$config['finder']['dir'] = "/upload/";
$config['ckeditor']['width'] = '900';
$config['ckeditor']['height'] = '450';


//Config Firewall 
/*$fw_conf['firewall']='1'; //Bat tat firewall
$fw_conf['max_lockcount']=10;//So lan toi da phat hien dau hieu DDOS va khoa IP do vinh vien 
$fw_conf['max_connect']=15;//So ket noi toi da dc gioi han boi $fw_conf['time_limit']
$fw_conf['time_limit']=3;//Thoi gian dc thuc hien toi da $fw_conf['max_connect'] ket noi
$fw_conf['time_wait']=5;//Thoi gian cho de dc mo khoa khi IP bi khoa tam thoi
$fw_conf['email_admin']='nina@nina.vn';//Email lien lac voi Admin
$fw_conf['htaccess']=".htaccess";//Duong dan toi file htaccess tren server
$fw_conf['ip_allow']='';
$fw_conf['ip_deny']='';*/


?>