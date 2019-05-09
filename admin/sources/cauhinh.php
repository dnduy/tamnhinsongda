<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	case "capnhat":
		get_cauhinh();
		$template = "cauhinh/item_add";
		break;
	case "save":
		save_cauhinh();
		break;
		
	default:
		$template = "index";
}

function get_cauhinh(){
	global $d, $item;

	$sql = "select * from #_cauhinh limit 0,1";
	$d->query($sql);
	//if($d->num_rows()==0) transfer("Dữ liệu chưa khởi tạo.", "index.php");
	$item = $d->fetch_array();
}

function save_cauhinh(){
	global $d;
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=cauhinh&act=capnhat");
	
	$data['diemnangcapmoi'] = $_POST['diemnangcapmoi'];
	$data['diemnangcap'] = $_POST['diemnangcap'];
	
	$data['phanthuongtien'] = $_POST['phanthuongtien'];
	$data['phanthuongdiem'] = $_POST['phanthuongdiem'];
		
	$data['phantramhoahong'] = $_POST['phantramhoahong'];
	$data['sotienruttoithieu'] = $_POST['sotienruttoithieu'];
	$data['sotienruttoida'] = $_POST['sotienruttoida'];
	$data['phiruttien'] = $_POST['phiruttien'];
	$data['chuyendiemtoithieu'] = $_POST['chuyendiemtoithieu'];
	$data['chuyendiemtoida'] = $_POST['chuyendiemtoida'];
	$data['phihoandoi'] = $_POST['phihoandoi'];
	$data['tylehoandoi'] = $_POST['tylehoandoi'];
	$data['sotienhoandoi'] = $_POST['sotienhoandoi'];
	
	
	
	$d->reset();
	$d->setTable('cauhinh');
	if($d->update($data))
		header("Location:index.php?com=cauhinh&act=capnhat");
	else
		transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=cauhinh&act=capnhat");
}

?>