<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	case "capnhat":
		get_gioithieu();
		$template = "color/item_add";
		break;
	case "save":
		save_gioithieu();
		break;
		
	default:
		$template = "index";
}
function fns_Rand_digit($min,$max,$num)
	{
		$result='';
		for($i=0;$i<$num;$i++){
			$result.=rand($min,$max);
		}
		return $result;	
	}

function get_gioithieu(){
	global $d, $item;

	$sql = "select * from #_color limit 0,1";
	$d->query($sql);
	//if($d->num_rows()==0) transfer("Dữ liệu chưa khởi tạo.", "index.php");
	$item = $d->fetch_array();
}

function save_gioithieu(){
	global $d;
	$file_name_item=fns_Rand_digit(0,9,10);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=color&act=capnhat");
		//Hinh body
		if($photo = upload_image("file", 'jpg|png|gif|jpeg|PNG|GIF|JPEG|JPG', _upload_color,$file_name_item)){
			$data['photo'] = $photo;
			$d->setTable('color');
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_color.$row['photo']);
			}
		}
//chung
	$data['nenbackground'] = magic_quote($_POST['color1']);
	$data['repeat1'] = magic_quote($_POST['repeat']);
	$data['vitri'] = magic_quote($_POST['vitri']);
	$data['vitri1'] = magic_quote($_POST['vitri1']);
	$data['fixed'] = magic_quote($_POST['fixed']);
	$data['chonbg'] = isset($_POST['chonbg']) ? 1 : 0;
	$d->reset();
	$d->setTable('color');
	if($d->update($data))
	redirect("index.php?com=color&act=capnhat");
	else
		transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=color&act=capnhat");
}

?>