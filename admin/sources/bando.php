<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$urldanhmuc ="";

$urldanhmuc.= (isset($_REQUEST['typechild'])) ? "&type1=".addslashes($_REQUEST['typechild']) : "";
$url_back=$_SERVER['HTTP_REFERER'];
$id=@$_REQUEST['id'];
switch($act){

#==================================== Start Danh Sach Ban Do   ===============================

	case "man":
		get_items();
		$template = "bando/items";
		break;
	case "add":		
		$template = "bando/item_add";
		break;
	case "edit":		
		get_item();
		$template = "bando/item_add";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
	

		
#==================================== END Danh Sach Ban Do    ===============================

		
	default:
		$template = "index";
}

#====================================


function fns_Rand_digit($min,$max,$num)
	{
		$result='';
		for($i=0;$i<$num;$i++){
			$result.=rand($min,$max);
		}
		return $result;	
	}
	

function get_items(){

	

	
	global $d, $items, $paging,$urldanhmuc, $url_back , $url_link,$totalRows , $pageSize, $offset;
	

	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['chon'];		
		
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_bando SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect($url_back);			
		}
		
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_bando SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect($url_back);			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){
				$sql="SELECT * FROM table_bando where id='".$id_array[$i]."'";
				$d->query($sql);
				//$cats= $d->fetch_array();


				if($d->num_rows()>0){
					while($row = $d->fetch_array()){
						delete_file(_upload_bando.$row['photo']);
						delete_file(_upload_bando.$row['thumb']);	
					}
				
					
				$d->reset();
				$sql="select photo, thumb from #_hasp where id_photo='".$id_array[$i]."' and com='habando'";
				$d->query($sql);
				$row_d=$d->result_array();
				if(!empty($row_d)){
					foreach($row_d as $row_d_item){
						delete_file(_upload_product.$row_d_item['photo']);
						delete_file(_upload_product.$row_d_item['thumb']);
					}
					$sql="delete from #_hasp where id_photo='".$id_array[$i]."' and com='habando'";
					$d->query($sql);
				}
				$sql = "delete from #_bando where id='".$id_array[$i]."'";
				$d->query($sql);
				}



				

			

				
				$sql = "delete from table_bando where id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect($url_back);			
		}
		
		
	}
	

	#----------------------------------------------------------------------------------------
	
	
	
	
	#----------------------------------------------------------------------------------------
	if($_REQUEST['hienthi']!='')
	{
	$id_up = $_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_bando where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_bando SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_bando SET hienthi =0  WHERE  id = ".$id_up."";
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
	
	
	
	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%' or ten_en LIKE '%$keyword%' or ten_cn LIKE '%$keyword%' or ten_ge LIKE '%$keyword%' ";
	}


	$sql="SELECT count(id) AS numrows FROM #_bando where id  $where ";
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
	
	$sql = "select * from #_bando where id $where order by stt,id desc limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=bando&act=man&typechild=$_GET[typechild]".$urldanhmuc;

}


function get_item(){
	global $d, $item, $url_back,$list_hasp;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", $url_back);
	
	$sql = "select * from #_bando where id='".$id."' and com='$_GET[typechild]'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", $url_back);
	$item = $d->fetch_array();

	
	///lấy hình ảnh liên quan

	$sql = "select * from #_hasp where id_photo='".$id."' and com='habando' order by stt asc";
	$d->query($sql);
	$list_hasp = $d->result_array();

}


function save_item(){
	global $d, $url_back,$config;

	$file_name=changeTitle($_POST['ten_vi']).fns_Rand_digit(0,3,5);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=bando&act=man&typechild=$_GET[typechild]");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
		if($id){
		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", _format_duoihinh, _upload_bando,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], _bando_thumb_w, _bando_thumb_h, _upload_bando,$file_name,1);		
			$d->setTable('bando');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_bando.$row['photo']);	
				delete_file(_upload_bando.$row['thumb']);				
			}
		}
		


		if (!empty($_POST))
		{

			$id =  themdau($_GET['id']);
			$delete_img_present=$_REQUEST['delete_img_present'];
			


			if($delete_img_present=='delete_img'){

				if(isset($_GET['id'])){
				
				$d->reset();
				$sql = "select id,thumb, photo from #_bando where id='".$id."'";
				$d->query($sql);
				if($d->num_rows()>0){
					while($row = $d->fetch_array()){
						delete_file(_upload_bando.$row['photo']);
						delete_file(_upload_bando.$row['thumb']);			
					}
				$sql = "UPDATE #_bando SET photo ='',thumb='' WHERE  id = '".$id."'";
				$d->query($sql);
				}
				if($d->query($sql))
					redirect($url_back);
					
				else
					transfer("Xóa dữ liệu bị lỗi", $url_back);
			}else transfer("Không nhận được dữ liệu", $url_back);


			}

		}
		
		

		$data['com'] = $_REQUEST['typechild'];	
		
		

		foreach ($config["lang"] as $key => $value) {


			$data['h1_'.$value] = magic_quote($_POST['h1_'.$value]);
			$data['h2_'.$value] = magic_quote($_POST['h2_'.$value]);	
			$data['title_'.$value] = magic_quote($_POST['title_'.$value]);
			$data['alt_'.$value] = magic_quote($_POST['alt_'.$value]);
			$data['keyword_'.$value] = magic_quote($_POST['keyword_'.$value]);
			$data['description_'.$value] = magic_quote($_POST['description_'.$value]);
			$data['deschar_'.$value] = magic_quote($_POST['deschar_'.$value]);


			$data['ten_'.$value] = magic_quote($_POST['ten_'.$value]);
			$data['tenkhongdau_'.$value] = changeTitle($_POST['ten_'.$value]);

			$data['mota_'.$value] = magic_quote($_POST['mota_'.$value]);
			$data['noidung_'.$value] = magic_quote($_POST['noidung_'.$value]);	

			

		}	
	
		
	
		$data['toado'] = magic_quote($_POST['toado']);
	
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['is_index'] = isset($_POST['is_index']) ? 1 : 0;
		$data['ngaysua'] = time();
		
		$d->setTable('bando');
		$d->setWhere('id', $id);
		if($d->update($data)){
			
			
			//Xử lý hình thêm 
			if (isset($_FILES['files'])) {
	            $myFile = $_FILES['files'];
	            $fileCount = count($myFile["name"]);
	            $file_name=fns_Rand_digit(0,9,6);
				
	            for ($i = 0; $i < $fileCount; $i++) {  
		            if(move_uploaded_file($myFile["tmp_name"][$i], _upload_bando."/".$file_name."_".$myFile["name"][$i])){		            							
						$data1['stt'] = (int)$_POST['stthinh'][$i];
						$data1['photo'] = $file_name."_".$myFile["name"][$i];	
						$data1['id_photo'] = $id;
						$data1['hienthi'] = 1;
						$data1['com'] = "habando";
						$d->setTable('hasp');
						$d->insert($data1);
		            }
	            }
	        }
			
			
			
			redirect("index.php?com=bando&act=man&typechild=$_GET[typechild]&curPage=".$_REQUEST['curPage']."");
		}
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=bando&act=man&typechild=$_GET[typechild]");
	}else{
		
		if($photo = upload_image("file", _format_duoihinh, _upload_bando,$file_name)){
			$data['photo'] = $photo;		
			$data['thumb'] = create_thumb($data['photo'], _bando_thumb_w, _bando_thumb_h, _upload_bando,$file_name,1);		
		}	
		

		
		$data['com'] = $_REQUEST['typechild'];	
		



		foreach ($config["lang"] as $key => $value) {
			
		$data['h1_'.$value] = magic_quote($_POST['h1_'.$value]);	
		$data['h2_'.$value] = magic_quote($_POST['h2_'.$value]);	
		$data['title_'.$value] = magic_quote($_POST['title_'.$value]);
		$data['alt_'.$value] = magic_quote($_POST['alt_'.$value]);
		$data['keyword_'.$value] = magic_quote($_POST['keyword_'.$value]);
		$data['description_'.$value] = magic_quote($_POST['description_'.$value]);
		$data['deschar_'.$value] = magic_quote($_POST['deschar_'.$value]);

		$data['ten_'.$value] = magic_quote($_POST['ten_'.$value]);
		$data['tenkhongdau_'.$value] = changeTitle($_POST['ten_'.$value]);
		$data['mota_'.$value] = magic_quote($_POST['mota_'.$value]);
		$data['noidung_'.$value] = magic_quote($_POST['noidung_'.$value]);

		}
		
		
		
		
	
	
		$data['toado'] = magic_quote($_POST['toado']);
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['is_index'] = isset($_POST['is_index']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		$d->setTable('bando');
		if($d->insert($data))
		{
		
		$idpro = mysql_insert_id();
			
		//Xử lý hình lien quan

	     	if (isset($_FILES['files'])) {
	            $myFile = $_FILES['files'];
	            $fileCount = count($myFile["name"]);
	            $file_name=fns_Rand_digit(0,9,6);

	            for ($i = 0; $i < $fileCount; $i++) {  
		            if(move_uploaded_file($myFile["tmp_name"][$i], _upload_bando."/".$file_name."_".$myFile["name"][$i])){
		            	$data1['stt'] = (int)$_POST['stthinh'][$i];
						$data1['photo'] = $file_name."_".$myFile["name"][$i];	
						$data1['id_photo'] = $idpro;
						$data1['hienthi'] = 1;
						$data1['com'] = 'habando';
						$d->setTable('hasp');
						$d->insert($data1);
		            }
	            }
	        }
		
		
			redirect("index.php?com=bando&act=man&typechild=$_GET[typechild]");
		
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=bando&act=man&typechild=$_GET[typechild]");
	}
}






function delete_item(){
	global $d, $url_back;	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,thumb, photo from #_bando where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_bando.$row['photo']);
				delete_file(_upload_bando.$row['thumb']);	
			}
		
			
		$d->reset();
		$sql="select photo, thumb from #_hasp where id_photo='$id' and com='habando'";
		$d->query($sql);
		$row_d=$d->result_array();
		if(!empty($row_d)){
			foreach($row_d as $row_d_item){
				delete_file(_upload_product.$row_d_item['photo']);
				delete_file(_upload_product.$row_d_item['thumb']);
			}
			$sql="delete from #_hasp where id_photo='$id' and com='habando'";
			$d->query($sql);
		}
		$sql = "delete from #_bando where id='".$id."'";
		$d->query($sql);
		}
		if($d->query($sql))
			redirect($url_back);
		else
			transfer("Xóa dữ liệu bị lỗi", $url_back);
	}else if(isset($_GET['listid'])){
		$listid = explode(",",$_GET['listid']);
		foreach($listid as $listid_item){
			$d->reset();
			$d->setTable('bando');
			$d->setWhere('id', $listid_item);
			$d->select();
			if($d->num_rows()==0) transfer("Dữ liệu không có thực", $url_back);
			$row = $d->fetch_array();
			$id_d=$row['id'];
			delete_file(_upload_bando.$row['photo']);
			delete_file(_upload_bando.$row['thumb']);	
			
			
			$d->reset();
			$sql="select photo, thumb from #_hasp where id_photo='$id_d' and com='habando'";
			$d->query($sql);
			$row_d=$d->result_array();
			if(!empty($row_d)){
				foreach($row_d as $row_d_item){
					delete_file(_upload_product.$row_d_item['photo']);
					delete_file(_upload_product.$row_d_item['thumb']);	
				}
				$sql="delete from #_hasp where id_photo='$id_d' and com='habando'";
				$d->query($sql);
			}
			$sql = "delete from #_bando where id='".$id_d."'";
			$d->query($sql);
		}
		redirect($url_back);
	}else transfer("Không nhận được dữ liệu", $url_back);
}

?>