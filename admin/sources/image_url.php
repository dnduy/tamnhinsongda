<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$url_back=$_SERVER['HTTP_REFERER'];
switch($act){
	case "man_photo":
		get_photos();
		$template = "image_url/photos";
		break;
	case "add_photo":		
		$template = "image_url/photo_add";
		break;
	case "edit_photo":
		get_photo();
		$template = "image_url/photo_edit";
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
	global $d, $items, $paging, $url_back , $url_link,$totalRows , $pageSize, $offset;
	
	
	
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['iddel'];
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_image_url SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect($url_back);			
		}
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_image_url SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect($url_back);			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){
				
				$sql = "select id,photo from #_image_url where id= ".$id_array[$i]."";
				$d->query($sql);
				if($d->num_rows()>0){
					while($row = $d->fetch_array()){
						delete_file(_upload_hinhanh.$row['photo']);
					}
				}
				$sql = "delete from table_image_url where id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");			
							
			}
			redirect($url_back);			
		}				
	}
	
	#----------------------------------------------------------------------------------------
	if($_REQUEST['hienthi']!='')
	{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_image_url where id='".$id_up."'";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
		$sqlUPDATE_ORDER = "UPDATE table_image_url SET hienthi =1 WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
		$sqlUPDATE_ORDER = "UPDATE table_image_url SET hienthi =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		redirect($url_back);
	}
	#-------------------------------------------------------------------------------

	if(@$_REQUEST['typechild']!='')
	{
		$typechild=addslashes($_REQUEST['typechild']);
		$where.=" and com='$typechild'";
	}else{
		$where.=" and com";
	}
	
	if((int)$_REQUEST['id_list']!='')
	{
		$where.=" and	id_list=".$_REQUEST['id_list']."";
	}
	
	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%' or ten_en LIKE '%$keyword%' ";
	}

	$sql="SELECT count(id) AS numrows FROM #_image_url where id  $where ";
	$d->query($sql);	
	$dem=$d->fetch_array();
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
	
	$sql = "select * from #_image_url where id $where order by stt,id desc limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=image_url&typechild=$_REQUEST[typechild]&act=man_photo";

	
	
	

}

function get_photo(){
	global $d, $item, $list_cat, $url_back;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=image_url&typechild=$_REQUEST[typechild]&act=man_photo");
	$d->setTable('image_url');
	$d->setWhere('id', $id);
	$d->select();
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=image_url&typechild=$_REQUEST[typechild]&act=man_photo");
	$item = $d->fetch_array();	
}

function save_photo(){
	global $d, $url_back,$config;
	
	
	
	$file_name=changeTitle($_POST['ten_vi']).fns_Rand_digit(0,3,8);
	
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=image_url&typechild=$_REQUEST[typechild]&act=man_photo");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
			if($photo = upload_image("file", _format_duoihinh, _upload_hinhanh,$file_name)){
				$data['photo'] = $photo;
				
				$data['thumb'] = create_thumb($data['photo'], _hinhanh_thumb_w,_hinhanh_thumb_h, _upload_hinhanh,$file_name,2);
				$d->setTable('image_url');
				$d->setWhere('id', $id);
				$d->select();
				if($d->num_rows()>0){
					$row = $d->fetch_array();
					delete_file(_upload_hinhanh.$row['photo']);
				}
			}
			
			
			
			$data['stt'] = $_POST['stt'];
			$data['link'] = $_POST['link'];
			$data['com'] = $_REQUEST['typechild'];	
			


			foreach ($config["lang"] as $key => $value) {
				
		
			$data['title_'.$value] = magic_quote($_POST['title_'.$value]);
			$data['alt_'.$value] = magic_quote($_POST['alt_'.$value]);
			
			$data['ten_'.$value] = magic_quote($_POST['ten_'.$value]);
			
			$data['mota_'.$value] = magic_quote($_POST['mota_'.$value]);
			

			}
		
			
		
		
			
			$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
			$d->reset();
			$d->setTable('image_url');
			$d->setWhere('id', $id);
			if(!$d->update($data)) transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=image_url&typechild=$_REQUEST[typechild]&act=man_photo");
			if(isset($_POST['referer_link']))
				redirect($_POST['referer_link']);
			else
				redirect("index.php?com=image_url&typechild=$_REQUEST[typechild]&act=man_photo");
			
	}
	
	{ 			
		for($i=0; $i<5; $i++)
		{
			
			$photo = upload_image("file".$i, _format_duoihinh, _upload_hinhanh,$file_name.$i);

			if ($photo!="" || $_POST['ten_vi'.$i]!="" || $_POST['link'.$i]!="" )
			{



				if($photo = upload_image("file".$i, _format_duoihinh, _upload_hinhanh,$file_name.$i)){
						$data['photo'] = $photo;	
						$data['thumb'] = create_thumb($data['photo'], _hinhanh_thumb_w, _hinhanh_thumb_h, _upload_hinhanh,$file_name.$i,2);		
					}	
	
							
					

						$data['com'] = $_REQUEST['typechild'];	
					
							
						$data['stt'] = $_POST['stt'.$i];
						
						$data['ten_vi'] = $_POST['ten_vi'.$i];	
						$data['ten_en'] = $_POST['ten_en'.$i];	
						$data['ten_cn'] = $_POST['ten_cn'.$i];	
						$data['ten_ge'] = $_POST['ten_ge'.$i];
					
					
						
						
						$data['mota_vi'] = $_POST['mota_vi'.$i];	
						$data['mota_en'] = $_POST['mota_en'.$i];	
						$data['mota_cn'] = $_POST['mota_cn'.$i];	
						$data['mota_ge'] = $_POST['mota_ge'.$i];
						
						$data['link'] = $_POST['link'.$i];	
																
						$data['hienthi'] = isset($_POST['hienthi'.$i]) ? 1 : 0;																	
						$d->setTable('image_url');
						if(!$d->insert($data)) transfer("Lưu dữ liệu bị lỗi", "index.php?com=image_url&typechild=$_REQUEST[typechild]&act=man_photo");


			}


					
			}
			redirect("index.php?com=image_url&typechild=$_REQUEST[typechild]&act=man_photo");
	}
}

function delete_photo(){
	global $d, $url_back;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->setTable('image_url');
		$d->setWhere('id', $id);
		$d->select();
		if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=image_url&typechild=$_REQUEST[typechild]&act=man_photo");
		$row = $d->fetch_array();
		delete_file(_upload_hinhanh.$row['photo']);
		if($d->delete())
			redirect("index.php?com=image_url&typechild=$_REQUEST[typechild]&act=man_photo");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=image_url&typechild=$_REQUEST[typechild]&act=man_photo");
	}else if(isset($_GET['listid'])){
		$listid = explode(",",$_GET['listid']);
		foreach($listid as $listid_item){
			$d->reset();
			$d->setTable('image_url');
			$d->setWhere('id', $listid_item);
			$d->select();
			if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=image_url&typechild=$_REQUEST[typechild]&act=man_photo");
			$row = $d->fetch_array();
			delete_file(_upload_hinhanh.$row['photo']);
			$d->delete();
		}
		redirect("index.php?com=image_url&typechild=$_REQUEST[typechild]&act=man_photo");
	}else transfer("Không nhận được dữ liệu", "index.php?com=image_url&typechild=$_REQUEST[typechild]&act=man_photo");
}
?>

	
