<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$url_back=$_SERVER['HTTP_REFERER'];
switch($act){
	case "capnhat":
		get_background();
		$template = "background/item_add";
		break;
	case "save":
		save_background();
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


function get_background(){
	global $d, $item;

	$sql = "select * from #_background where com='$_GET[typechild]' limit 0,1";
	$d->query($sql);
	$item = $d->fetch_array();
	if($d->num_rows()==0){
		
		
		$data['com']=$_GET['typechild'];
		$d->setTable('background');
		if($d->insert($data)){
			$sql = "select * from #_background where com='$_GET[typechild]' limit 0,1";
			$item = $d->fetch_array();
		}else{
			transfer("Dữ liệu chưa khởi tạo.", "index.php");
		}
	};
}	



function save_background(){
	global $d,$url_back;
	$file_name_item=fns_Rand_digit(0,9,10);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=background&act=capnhat&typechild=$_GET[typechild]");
		//Hinh body
		if($photo = upload_image("file", _format_duoihinh, _upload_background,$file_name_item)){
			$data['photo'] = $photo;
			$d->setTable('background');
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_background.$row['photo']);
			}
		}
//chung
	$data['com'] = $_REQUEST['typechild'];		
	$data['nenbackground'] = magic_quote($_POST['color1']);
	$data['repeat1'] = magic_quote($_POST['repeat']);
	$data['vitri'] = magic_quote($_POST['vitri']);
	$data['vitri1'] = magic_quote($_POST['vitri1']);
	$data['fixed'] = magic_quote($_POST['fixed']);
	$data['chonbg'] = isset($_POST['chonbg']) ? 1 : 0;
	$d->reset();
	$d->setTable('background');
	$d->setWhere('com',$_GET['typechild']);
	if($d->update($data))
	redirect("index.php?com=background&act=capnhat&typechild=$_GET[typechild]");
	else
		transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=background&act=capnhat&typechild=$_GET[typechild]");
}

?>