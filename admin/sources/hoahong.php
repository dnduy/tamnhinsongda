<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$urldanhmuc ="";
$urldanhmuc.= (isset($_REQUEST['id_list'])) ? "&id_list=".addslashes($_REQUEST['id_list']) : "";
$urldanhmuc.= (isset($_REQUEST['id_cat'])) ? "&id_cat=".addslashes($_REQUEST['id_cat']) : "";
$urldanhmuc.= (isset($_REQUEST['id_item'])) ? "&id_item=".addslashes($_REQUEST['id_item']) : "";
$duongdan=$_SERVER['HTTP_REFERER'];
$url_back=$_SERVER['HTTP_REFERER'];
$id=@$_REQUEST['id'];


if($_SESSION['login_admin']['type']=='daily'){
	if($_SESSION['login_admin']['id']!=$id){
		transfer("Bạn không có quyền truy cập vào đây","index.php");
	}
}


switch($act){

	
	case "edit":	
		get_item();	
		$template = "hoahong/item_add";
		break;

	case "delete":
		delete_item();
		break;
		
	case "save":
		save_item();
		break;
		
	#===================================================	
	
	default:
		$template = "index";
}

#====================================

function get_item(){
	global $d, $id_user,$arr_ruttienmat ,$url_link,$totalRows , $pageSize, $offset, $user_detail;
	$id_user = isset($_GET['id_user']) ? themdau($_GET['id_user']) : "";
	if(!$id_user)
		transfer("Không nhận được dữ liệu", "index.php?com=user&act=man");	
	

	$totalRows=$dem['numrows'];
	$page=$_GET['p'];
	
	$pageSize=20;
	$offset=5;
						
	if ($page=="")
		$page=1;
	else 
		$page=$_GET['p'];
	$page--;
	$bg=$pageSize*$page;

	$user_detail = get_info_user($id_user);	

	$sql = "select * from #_hoahong_detail where id_user='".$id_user."' and trangthai=5 order by thoigiannhan desc limit $bg,$pageSize";
	$d->query($sql);
	$arr_ruttienmat = $d->result_array();

	$url_link="index.php?com=hoahong&act=edit&id_user=$id_user";
}

function save_item(){
	global $d,$config_url,$id_user;
	$id_user = $_POST['id_user'];
	$tienhoahong = $_POST['tienhoahong'];

	if(!empty($tienhoahong) && $tienhoahong>0){
		
		if(total_hoahong_current($id_user) < $tienhoahong){
			transfer("Số tiền cần rút đã vượt quá tiền hoa hồng hiện tại", "index.php?com=hoahong&act=edit&id_user=".$id_user);
		}
		$data['id_user'] = $id_user; 
		$data['thoigiannhan'] = time();
		$data['tienhoahong'] = $tienhoahong;
		$data['noidung'] = 3; // 3: đã rút tiền mặt
		$data['trangthai'] = 5; // 5: đã rút tiền mặt

		$d->setTable('hoahong_detail');
		if($d->insert($data)){
			redirect("index.php?com=hoahong&act=edit&id_user=".$id_user."&curPage=".@$_REQUEST['curPage']."");
		}else{
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=hoahong&act=edit&id_user=".$id_user);
		}
	}else{
		redirect("index.php?com=hoahong&act=edit&id_user=".$id_user);
	}
	
}

function delete_item(){
	global $d,$id_user;
	
	$id_user = $_GET['id_user'];
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "delete from #_hoahong_detail where id='".$id."'";
		if($d->query($sql))
			redirect("index.php?com=hoahong&act=edit&id_user=".$id_user);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=hoahong&act=edit&id_user=".$id_user);
	}else{
		redirect("index.php?com=hoahong&act=edit&id_user=".$id_user);
	}
	
}


?>