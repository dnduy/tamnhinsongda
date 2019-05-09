<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$url_back=$_SERVER['HTTP_REFERER'];
switch($act){
	case "man_photo":
		get_photos();
		$template = "quangcaobody/photos";
		break;
	case "add_photo":
		$template = "quangcaobody/photo_add";
		break;
	case "edit_photo":
		get_photo();
		$template = "quangcaobody/photo_edit";
		break;
	case "save_photo":
		save_photo();
		break;
	case "delete_photo":
		delete_photo();
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
function get_photos(){
	global $d, $items, $paging, $url_back;;
	
	
	
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['iddel'];
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_quangcao SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect($url_back);			
		}
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_quangcao SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect($url_back);			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){
				
				$sql = "select id,photo from #_quangcao where id= ".$id_array[$i]."";
				$d->query($sql);
				if($d->num_rows()>0){
					while($row = $d->fetch_array()){
						delete_file(_upload_hinhanh.$row['photo']);
					}
				}
				$sql = "delete from table_quangcao where id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");			
							
			}
			redirect($url_back);			
		}				
	}
	
	
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['hienthi']!='')
	{
	$id_up = @$_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_quangcao where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_quangcao SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_quangcao SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	redirect($_SERVER['HTTP_REFERER']);
	}
	$d->setTable('quangcao');
	$d->setWhere('com', 'quangcaobody');
	$d->setOrder('stt,id desc');
	$d->select('*');
	$d->query();
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=quangcaobody&act=man_photo";
	$maxR=10;
	$maxP=4;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];

}
function get_photo(){
	global $d, $item, $list_cat;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=quangcaobody&act=man_photo");
	
	$d->setTable('quangcao');
	$d->setWhere('com', 'quangcaobody');
	$d->setWhere('id', $id);
	$d->select();
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=quangcaobody&act=man_photo");
	$item = $d->fetch_array();
	$d->reset();
}
function save_photo(){
	global $d;
	$file_name=fns_Rand_digit(0,9,6);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=quangcaobody&act=man_photo");
	
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){ // cap nhat
		
			if($photo = upload_image("file", 'jpg|png|gif|JPG|PNG|GIF|swf|SWF', _upload_hinhanh,$file_name)){
				$data['photo'] = $photo;				
				$d->setTable('quangcao');
				$d->setWhere('id', $id);
				$d->select();
				if($d->num_rows()>0){
					$row = $d->fetch_array();
					delete_file(_upload_hinhanh.$row['photo']);				
				}
			}
			$data['id'] = $_REQUEST['id'];
			$data['stt'] = $_POST['stt'];
			$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
			$data['com'] = 'quangcaobody';
			$data['mota_vi'] = $_POST['mota_vi'];
			$data['mota_vi'] = $_POST['mota_vi'];
			$data['vitri'] = $_POST['vitri'];
			$data['link'] = $_POST['link'];

			$d->reset();
			$d->setTable('quangcao');
			$d->setWhere('id', $id);
			if(!$d->update($data)) transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=quangcaobody&act=man_photo");
			header("Location:index.php?com=quangcaobody&act=man_photo");
	}{ // them moi
		
			for($i=0; $i<5; $i++){
				if($photo = upload_image("file".$i, 'jpg|png|gif|JPG|PNG|GIF|swf|SWF', _upload_hinhanh,$file_name.$i))
					{
						$data['photo'] = $photo;					
							
						$data['mota_vi'] = "mota_vi :".$i;
						$data['stt'] = $_POST['stt'.$i];
						$data['hienthi'] = isset($_POST['hienthi'.$i]) ? 1 : 0;
						$data['com'] = 'quangcaobody';
						$data['mota_vi'] = $_POST['mota_vi'.$i];
						$data['mota_en'] = $_POST['mota_en'.$i];
						
						$data['vitri'] = $_POST['vitri'.$i];
						$data['link'] = $_POST['link'.$i];

						$data['id_photo'] = $_REQUEST['idc'];
						
						$d->setTable('quangcao');
						if(!$d->insert($data)) transfer("Lưu dữ liệu bị lỗi", "index.php?com=quangcaobody&act=man_photo");
					}
			}
			header("Location:index.php?com=quangcaobody&act=man_photo");
		
	}
}


function delete_photo(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->setTable('quangcaobody');
		$d->setWhere('id', $id);
		$d->select();
		if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=quangcaobody&act=man_photo");
		$row = $d->fetch_array();
		delete_file(_upload_hinhanh.$row['photo']);	
		if($d->delete())
		
			header("Location:index.php?com=quangcaobody&act=man_photo");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=quangcaobody&act=man_photo");
	}else transfer("Không nhận được dữ liệu", "index.php?com=quangcaobody&act=man_photo");
}

?>

	
