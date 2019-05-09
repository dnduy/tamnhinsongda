<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	
	case "capnhat":
		get_banner();
		$template = "banner/logo_add";
		break;
	case "save":
		save_banner();
		break;
	#====================================
	
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


function get_banner(){
	global $d, $item;

	$sql = "select * from #_banner where com='$_GET[typechild]' ";
	$d->query($sql);
	//if($d->num_rows()==0) transfer("Dữ liệu chưa khởi tạo.", "index.php");
	$item = $d->fetch_array();
}

function save_banner(){
	global $d;
	$file_name=fns_Rand_digit(0,9,3);
	$sql = "select * from #_banner where com='$_GET[typechild]'";
	$d->query($sql);
	$item = $d->fetch_array();
	$id=$item['id'];
	//echo dump($id);
	
	if($id){ // cap nhat

		$data['ten_vi'] = '';
		if($banner_vi = upload_image("file_vi", _format_duoihinh_banner, _upload_hinhanh,$file_name.'_vi')){
			$data['banner_vi'] = $banner_vi;
			$d->setTable('banner');
			$d->setWhere('id', $id);
			$d->select();
			$row = $d->fetch_array();
			delete_file(_upload_hinhanh.$row['banner_vi']);
		}
		if($banner_en = upload_image("file_en", _format_duoihinh_banner, _upload_hinhanh,$file_name.'_en')){
			$data['banner_en'] = $banner_en;
			$d->setTable('banner');
			$d->setWhere('id', $id);
			$d->select();
			$row = $d->fetch_array();
			delete_file(_upload_hinhanh.$row['banner_en']);
		}

		if($banner_cn = upload_image("file_cn", _format_duoihinh_banner, _upload_hinhanh,$file_name.'_cn')){
			$data['banner_cn'] = $banner_cn;
			$d->setTable('banner');
			$d->setWhere('id', $id);
			$d->select();
			$row = $d->fetch_array();
			delete_file(_upload_hinhanh.$row['banner_cn']);
		}

		if($banner_ge = upload_image("file_ge", _format_duoihinh_banner, _upload_hinhanh,$file_name.'_ge')){
			$data['banner_ge'] = $banner_ge;
			$d->setTable('banner');
			$d->setWhere('id', $id);
			$d->select();
			$row = $d->fetch_array();
			delete_file(_upload_hinhanh.$row['banner_ge']);
		}
		
		//echo dump($data);
		$d->setTable('banner');

		$d->setWhere('id', $id);
		$d->setWhere('com',$_GET['typechild']);

		
		if($d->update($data))
			redirect("index.php?com=banner&act=capnhat&typechild=$_GET[typechild]");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=banner&act=capnhat&typechild=$_GET[typechild]");
	}else{ // them moi
	
		$data['banner_vi'] = upload_image("file_vi", _format_duoihinh_banner, _upload_hinhanh,$file_name.'_vi');
		if(!$data['banner_vi']) $data['banner_vi']="";
		$data['banner_en'] = upload_image("file_en", _format_duoihinh_banner, _upload_hinhanh,$file_name.'_en');
		if(!$data['banner_en']) $data['banner_en']="";

		$data['banner_cn'] = upload_image("file_cn", _format_duoihinh_banner, _upload_hinhanh,$file_name.'_cn');
		if(!$data['banner_cn']) $data['banner_cn']="";

		$data['banner_ge'] = upload_image("file_ge", _format_duoihinh_banner, _upload_hinhanh,$file_name.'_ge');
		if(!$data['banner_ge']) $data['banner_ge']="";
		$data['com']=$_GET['typechild'];
		$d->setTable('banner');
		if($d->insert($data))
		redirect("index.php?com=banner&act=capnhat&typechild=$_GET[typechild]");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=banner&act=capnhat&typechild=$_GET[typechild]");
	
}
}


?>