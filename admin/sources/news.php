<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$urldanhmuc ="";
$urldanhmuc.= (isset($_REQUEST['id_list'])) ? "&id_list=".addslashes($_REQUEST['id_list']) : "";
$urldanhmuc.= (isset($_REQUEST['id_cat'])) ? "&id_cat=".addslashes($_REQUEST['id_cat']) : "";
$urldanhmuc.= (isset($_REQUEST['id_item'])) ? "&id_item=".addslashes($_REQUEST['id_item']) : "";
$urldanhmuc.= (isset($_REQUEST['id_sub'])) ? "&id_sub=".addslashes($_REQUEST['id_sub']) : "";
$urldanhmuc.= (isset($_REQUEST['typechild'])) ? "&type1=".addslashes($_REQUEST['typechild']) : "";
$url_back=$_SERVER['HTTP_REFERER'];
$id=@$_REQUEST['id'];
switch($act){

#==================================== Start Danh Sach Bai Viet   ===============================

	case "man":
		get_items();
		$template = "news/items";
		break;
	case "add":		
		$template = "news/item_add";
		break;
	case "edit":		
		get_item();
		$template = "news/item_add";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
	

		
#==================================== END Danh Sach Bai Viet   ===============================

		
#==================================== Start Danh Muc Cap 1   ===============================
	
	case "man_list":
		get_lists();
		$template = "news/lists";
		break;
	case "add_list":		
		$template = "news/list_add";
		break;
	case "edit_list":		
		get_list();
		$template = "news/list_add";
		break;
	case "save_list":
		save_list();
		break;
		

		
	case "delete_list":
		delete_list();
		break;

#==================================== END Danh Muc Cap 1   ===============================			

#==================================== Start Danh Muc Cap 2   ===============================	


	case "man_cat":
		get_cats();
		$template = "news/cats";
		break;
	case "add_cat":		
		$template = "news/cat_add";
		break;
	case "edit_cat":		
		get_cat();
		$template = "news/cat_add";
		break;
	case "save_cat":
		save_cat();
		break;
	case "delete_cat":
		delete_cat();
		break;


		
#==================================== END Danh Muc Cap 2   ===============================	
		
#==================================== Start Danh Muc Cap 3   ===============================

	case "man_item":
		get_loais();
		$template = "news/loais";
		break;
	case "add_item":		
		$template = "news/loai_add";
		break;
	case "edit_item":		
		get_loai();
		$template = "news/loai_add";
		break;
	case "save_item":
		save_loai();
		break;
	case "delete_item":
		delete_loai();
		break;
	


#==================================== END Danh Muc Cap 3   ===============================

#==================================== Start Danh Muc Cap 4   ===============================

	case "man_sub":
		get_subs();
		$template = "news/subs";
		break;

	case "add_sub":		
		$template = "news/sub_add";
		break;

	case "edit_sub":		
		get_sub();
		$template = "news/sub_add";
		break;

	case "save_sub":
		save_sub();
		break;

	case "delete_sub":
		delete_sub();
		break;


#==================================== End Danh Muc Cap 4   ===============================		
		
		

		
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
				$sql = "UPDATE table_news SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect($url_back);			
		}
		
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_news SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect($url_back);			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){
				$sql="SELECT * FROM table_news where id='".$id_array[$i]."'";
				$d->query($sql);
				//$cats= $d->fetch_array();


				if($d->num_rows()>0){
					while($row = $d->fetch_array()){
						delete_file(_upload_news.$row['photo']);
						delete_file(_upload_news.$row['thumb']);	
					}
				
					
				$d->reset();
				$sql="select photo, thumb from #_hasp where id_photo='".$id_array[$i]."' and com='hanews'";
				$d->query($sql);
				$row_d=$d->result_array();
				if(!empty($row_d)){
					foreach($row_d as $row_d_item){
						delete_file(_upload_product.$row_d_item['photo']);
						delete_file(_upload_product.$row_d_item['thumb']);
					}
					$sql="delete from #_hasp where id_photo='".$id_array[$i]."' and com='hanews'";
					$d->query($sql);
				}
				$sql = "delete from #_news where id='".$id_array[$i]."'";
				$d->query($sql);
				}



				

			

				
				$sql = "delete from table_news where id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect($url_back);			
		}
		
		
	}
	

	#----------------------------------------------------------------------------------------
	if($_REQUEST['tinmoi']!='')
	{
	$id_up = $_REQUEST['tinmoi'];
	$sql_sp = "SELECT id,tinmoi FROM table_news where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$time=time();
	$hienthi=$cats[0]['tinmoi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_news SET tinmoi ='$time' WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_news SET tinmoi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	redirect($url_back);	
	}
	
	#----------------------------------------------------------------------------------------
	if($_REQUEST['tinnoibat']!='')
	{
	$id_up = $_REQUEST['tinnoibat'];
	$sql_sp = "SELECT id,tinnoibat FROM table_news where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$time=time();
	$hienthi=$cats[0]['tinnoibat'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_news SET tinnoibat ='$time' WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_news SET tinnoibat =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	redirect($url_back);
	}
	#-------------------------------------------------------------------------------
	
	#----------------------------------------------------------------------------------------
	if($_REQUEST['hienthi']!='')
	{
	$id_up = $_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_news where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_news SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_news SET hienthi =0  WHERE  id = ".$id_up."";
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
	
	
	if(@$_REQUEST['id_list']!='')
	{
		$id_list=addslashes($_REQUEST['id_list']);
		$where.=" and id_list='$id_list'";
	}
	
	
	
	if(@$_REQUEST['id_cat']!='')
	{
		$id_cat=addslashes($_REQUEST['id_cat']);
		$where.=" and id_cat='$id_cat'";
	}
	
	
		if(@$_REQUEST['id_item']!='')
	{
		$id_item=addslashes($_REQUEST['id_item']);
		$where.=" and id_item='$id_item'";
	}
	
	
	
	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%' or ten_en LIKE '%$keyword%' or ten_cn LIKE '%$keyword%' or ten_ge LIKE '%$keyword%' ";
	}


	$sql="SELECT count(id) AS numrows FROM #_news where id  $where ";
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
	
	$sql = "select * from #_news where id $where order by id desc limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=news&act=man&typechild=$_GET[typechild]".$urldanhmuc;

}


function get_item(){
	global $d, $item, $url_back,$list_hasp;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", $url_back);
	
	$sql = "select * from #_news where id='".$id."' and com='$_GET[typechild]'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", $url_back);
	$item = $d->fetch_array();

	
	///lấy hình ảnh liên quan

	$sql = "select * from #_hasp where id_photo='".$id."' and com='hanews' order by stt asc";
	$d->query($sql);
	$list_hasp = $d->result_array();

}


function save_item(){
	global $d, $url_back,$config,$urldanhmuc;

	$file_name=changeTitle($_POST['ten_vi']).fns_Rand_digit(0,3,5);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=news&act=man&typechild=$_GET[typechild]&curPage=".$_REQUEST['curPage'].$urldanhmuc);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
		if($id){
		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", _format_duoihinh, _upload_news,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], _news_thumb_w, _news_thumb_h, _upload_news,$file_name,1);		
			$d->setTable('news');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_news.$row['photo']);	
				delete_file(_upload_news.$row['thumb']);				
			}
		}
		


		if ($_REQUEST["delete_img_present"]=="delete_img")
		{

			$id =  themdau($_GET['id']);
			$delete_img_present=$_REQUEST['delete_img_present'];
			


			if($delete_img_present=='delete_img'){

				if(isset($_GET['id'])){
				
				$d->reset();
				$sql = "select id,thumb, photo from #_news where id='".$id."'";
				$d->query($sql);
				if($d->num_rows()>0){
					while($row = $d->fetch_array()){
						delete_file(_upload_news.$row['photo']);
						delete_file(_upload_news.$row['thumb']);			
					}
				$sql = "UPDATE #_news SET photo ='',thumb='' WHERE  id = '".$id."'";
				$d->query($sql);
				}
				if($d->query($sql))
					redirect($url_back);
					
				else
					transfer("Xóa dữ liệu bị lỗi", $url_back);
			}else transfer("Không nhận được dữ liệu", $url_back);


			}

		}
		
		
		$data['id_list'] = (int)$_POST['id_list'];			
		$data['id_cat'] = (int)$_POST['id_cat'];	
		$data['id_item'] = (int)$_POST['id_item'];
		$data['id_sub'] = (int)$_POST['id_sub'];	
		$data['com'] = $_REQUEST['typechild'];	
		
		

		foreach ($config["lang"] as $key => $value) {


			$data['h1_'.$value] = magic_quote($_POST['h1_'.$value]);
			$data['h2_'.$value] = magic_quote($_POST['h2_'.$value]);	
			$data['h3_'.$value] = magic_quote($_POST['h3_'.$value]);
			$data['h4_'.$value] = magic_quote($_POST['h4_'.$value]);
			$data['h5_'.$value] = magic_quote($_POST['h5_'.$value]);
			$data['h6_'.$value] = magic_quote($_POST['h6_'.$value]);	
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
	
		
	
		
		
		if($_POST['handang']!=''){
			$data['handang'] = strtotime($_POST['handang']);
		}
	
	
		$data['link'] = magic_quote($_POST['link']);
	
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['is_index'] = isset($_POST['is_index']) ? 1 : 0;
		$data['is_follow'] = isset($_POST['is_follow']) ? 1 : 0;
		$data['ngaysua'] = time();
		
		$d->setTable('news');
		$d->setWhere('id', $id);
		if($d->update($data)){
			
			
			//Xử lý hình thêm 
			if (isset($_FILES['files'])) {
	            $myFile = $_FILES['files'];
	            $fileCount = count($myFile["name"]);
	            $file_name=fns_Rand_digit(0,9,6);
				
	            for ($i = 0; $i < $fileCount; $i++) {  
		            if(move_uploaded_file($myFile["tmp_name"][$i], _upload_news."/".$file_name."_".$myFile["name"][$i])){		            							
						$data1['stt'] = (int)$_POST['stthinh'][$i];
						$data1['photo'] = $file_name."_".$myFile["name"][$i];	
						$data1['id_photo'] = $id;
						$data1['hienthi'] = 1;
						$data1['com'] = "hanews";
						$d->setTable('hasp');
						$d->insert($data1);
		            }
	            }
	        }
			
			
			
			redirect("index.php?com=news&act=man&typechild=$_GET[typechild]&curPage=".$_REQUEST['curPage'].$urldanhmuc);
		}
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=news&act=man&typechild=$_GET[typechild]&curPage=".$_REQUEST['curPage'].$urldanhmuc);
	}else{
		
		if($photo = upload_image("file", _format_duoihinh, _upload_news,$file_name)){
			$data['photo'] = $photo;		
			$data['thumb'] = create_thumb($data['photo'], _news_thumb_w, _news_thumb_h, _upload_news,$file_name,1);		
		}	
		
		
		
		
		
		$data['id_list'] = (int)$_POST['id_list'];			
		$data['id_cat'] = (int)$_POST['id_cat'];	
		$data['id_item'] = (int)$_POST['id_item'];	
		$data['id_sub'] = (int)$_POST['id_sub'];	
		$data['com'] = $_REQUEST['typechild'];	
		
		$data['link'] = magic_quote($_POST['link']);


		foreach ($config["lang"] as $key => $value) {
			
		$data['h1_'.$value] = magic_quote($_POST['h1_'.$value]);
		$data['h2_'.$value] = magic_quote($_POST['h2_'.$value]);	
		$data['h3_'.$value] = magic_quote($_POST['h3_'.$value]);
		$data['h4_'.$value] = magic_quote($_POST['h4_'.$value]);
		$data['h5_'.$value] = magic_quote($_POST['h5_'.$value]);
		$data['h6_'.$value] = magic_quote($_POST['h6_'.$value]);	
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
		
		
		
		
	
		
		if($_POST['handang']!=''){
			$data['handang'] = strtotime($_POST['handang']);
		}
		
		
		$sql = "SELECT stt FROM table_news where com='".$_GET["typechild"]."'  order by stt desc limit 0,1 ";
		$result = mysql_query($sql);
		$max_stt = mysql_fetch_array($result);
		
		if ( ($max_stt["stt"]) >= ($_POST['stt']) )
		{
			
			$data["stt"]=$max_stt["stt"]+1;
	
		
		}
		else
		{
			$data['stt'] = magic_quote($_POST['stt']);

			
		}
		
		//$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['is_index'] = isset($_POST['is_index']) ? 1 : 0;
		$data['is_follow'] = isset($_POST['is_follow']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		$d->setTable('news');
		if($d->insert($data))
		{
		
		$idpro = mysql_insert_id();
			
		//Xử lý hình lien quan

	     	if (isset($_FILES['files'])) {
	            $myFile = $_FILES['files'];
	            $fileCount = count($myFile["name"]);
	            $file_name=fns_Rand_digit(0,9,6);

	            for ($i = 0; $i < $fileCount; $i++) {  
		            if(move_uploaded_file($myFile["tmp_name"][$i], _upload_news."/".$file_name."_".$myFile["name"][$i])){
		            	$data1['stt'] = (int)$_POST['stthinh'][$i];
						$data1['photo'] = $file_name."_".$myFile["name"][$i];	
						$data1['id_photo'] = $idpro;
						$data1['hienthi'] = 1;
						$data1['com'] = 'hanews';
						$d->setTable('hasp');
						$d->insert($data1);
		            }
	            }
	        }
		
		
			redirect("index.php?com=news&act=man&typechild=$_GET[typechild]&curPage=".$_REQUEST['curPage'].$urldanhmuc);
		
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=news&act=man&typechild=$_GET[typechild]&curPage=".$_REQUEST['curPage'].$urldanhmuc);
	}
}


function delete_img()
{
	global $d , $url_back;
	

	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,thumb, photo from #_news where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_news.$row['photo']);
				delete_file(_upload_news.$row['thumb']);			
			}
		$sql = "UPDATE #_news SET photo ='',thumb='' WHERE  id = '".$id."'";
		$d->query($sql);
		}
		if($d->query($sql))
			redirect($url_back);
		else
			transfer("Xóa dữ liệu bị lỗi", $url_back);
	}else transfer("Không nhận được dữ liệu", $url_back);
}



function delete_item(){
	global $d, $url_back;	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,thumb, photo from #_news where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_news.$row['photo']);
				delete_file(_upload_news.$row['thumb']);	
			}
		
			
		$d->reset();
		$sql="select photo, thumb from #_hasp where id_photo='$id' and com='hanews'";
		$d->query($sql);
		$row_d=$d->result_array();
		if(!empty($row_d)){
			foreach($row_d as $row_d_item){
				delete_file(_upload_product.$row_d_item['photo']);
				delete_file(_upload_product.$row_d_item['thumb']);
			}
			$sql="delete from #_hasp where id_photo='$id' and com='hanews'";
			$d->query($sql);
		}
		$sql = "delete from #_news where id='".$id."'";
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
			$d->setTable('news');
			$d->setWhere('id', $listid_item);
			$d->select();
			if($d->num_rows()==0) transfer("Dữ liệu không có thực", $url_back);
			$row = $d->fetch_array();
			$id_d=$row['id'];
			delete_file(_upload_news.$row['photo']);
			delete_file(_upload_news.$row['thumb']);	
			
			
			$d->reset();
			$sql="select photo, thumb from #_hasp where id_photo='$id_d' and com='hanews'";
			$d->query($sql);
			$row_d=$d->result_array();
			if(!empty($row_d)){
				foreach($row_d as $row_d_item){
					delete_file(_upload_product.$row_d_item['photo']);
					delete_file(_upload_product.$row_d_item['thumb']);	
				}
				$sql="delete from #_hasp where id_photo='$id_d' and com='hanews'";
				$d->query($sql);
			}
			$sql = "delete from #_news where id='".$id_d."'";
			$d->query($sql);
		}
		redirect($url_back);
	}else transfer("Không nhận được dữ liệu", $url_back);
}






#==================================== Start Danh Muc Cap 2   ===============================


function get_cats(){
	global $d, $items, $paging, $url_back , $url_link,$totalRows , $pageSize, $offset;

	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['chon'];
		
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_news_cat SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=news&act=man_cat&typeparent=$_GET[typeparent]");			
		}
		
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){

				$sql = "UPDATE table_news_cat SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=news&act=man_cat&typeparent=$_GET[typeparent]");			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){
				$sql="SELECT * FROM table_news_cat where id='".$id_array[$i]."'";
				$d->query($sql);
				//$cats= $d->fetch_array();


				if($d->num_rows()>0){
				while($row = $d->fetch_array()){

						delete_file(_upload_news.$row['photo']);
						delete_file(_upload_news.$row['thumb']);			
					}
				}
				
				
				$sql = "delete from table_news_cat where id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=news&act=man_cat&typeparent=$_GET[typeparent]");			
		}
		
		
	}
	
	
	
	
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['hienthi']!='')
	{
	$id_up = $_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_news_cat where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_news_cat SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_news_cat SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	redirect($url_back);
	}
	
	#----------------------------------------------------------------------------------------


	if(@$_REQUEST['typeparent']!='')
	{
		$typeparent=addslashes($_REQUEST['typeparent']);
		$where.=" and com='$typeparent'";
	}else{
		$where.=" and com";
	}


	if((int)@$_REQUEST['id_list']!='')
	{
	$where.=" and id_list=".$_REQUEST['id_list']."";
	}



	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%' or ten_en LIKE '%$keyword%' or ten_cn LIKE '%$keyword%' or ten_ge LIKE '%$keyword%' ";
	}
	


	$sql="SELECT count(id) AS numrows FROM #_news_cat where id  $where ";
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
	
	$sql = "select * from #_news_cat where id $where order by stt,id desc limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=news&act=man_cat&typeparent=$_GET[typeparent]".$urldanhmuc;

}

function get_cat(){
	global $d, $item, $url_back;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", $url_back);
	
	$sql = "select * from #_news_cat where id='".$id."' and com='$_GET[typeparent]'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", $url_back);
	$item = $d->fetch_array();
}

function save_cat(){
	global $d, $url_back ,$config,$urldanhmuc;
	
	$file_name=changeTitle($_POST['ten_vi']).fns_Rand_digit(0,3,5);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=news&act=man_cat&typeparent=$_GET[typeparent]&curPage=".$_REQUEST['curPage'].$urldanhmuc);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		
		
		if($photo = upload_image("file", _format_duoihinh, _upload_news,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], _news_cat_thumb_w, _news_cat_thumb_h, _upload_news,$file_name,1);	
			$d->setTable('news_cat');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_news.$row['photo']);	
				delete_file(_upload_news.$row['thumb']);				
			}
		}
		
		
		$data['id_list'] = $_POST['id_list'];


		foreach ($config["lang"] as $key => $value) {


			$data['h1_'.$value] = magic_quote($_POST['h1_'.$value]);
			$data['h2_'.$value] = magic_quote($_POST['h2_'.$value]);	
			$data['h3_'.$value] = magic_quote($_POST['h3_'.$value]);
			$data['h4_'.$value] = magic_quote($_POST['h4_'.$value]);
			$data['h5_'.$value] = magic_quote($_POST['h5_'.$value]);
			$data['h6_'.$value] = magic_quote($_POST['h6_'.$value]);	
			$data['title_'.$value] = magic_quote($_POST['title_'.$value]);
			$data['alt_'.$value] = magic_quote($_POST['alt_'.$value]);
			$data['keyword_'.$value] = magic_quote($_POST['keyword_'.$value]);
			$data['description_'.$value] = magic_quote($_POST['description_'.$value]);
			$data['deschar_'.$value] = magic_quote($_POST['deschar_'.$value]);


			$data['ten_'.$value] = magic_quote($_POST['ten_'.$value]);
			$data['tenkhongdau_'.$value] = changeTitle($_POST['ten_'.$value]);

			$data['mota_'.$value] = magic_quote($_POST['mota_'.$value]);
			

			

		}
		

		if ($_REQUEST["delete_img_present"]=="delete_img")
		{

			$id =  themdau($_GET['id']);
			$delete_img_present=$_REQUEST['delete_img_present'];
			
			

			if($delete_img_present=='delete_img'){

				if(isset($_GET['id'])){
				
				$d->reset();
				$sql = "select id,thumb, photo from #_news_cat where id='".$id."'";
				$d->query($sql);
				if($d->num_rows()>0){
					while($row = $d->fetch_array()){
						delete_file(_upload_news.$row['photo']);
						delete_file(_upload_news.$row['thumb']);			
					}
				$sql = "UPDATE #_news_cat SET photo ='',thumb='' WHERE  id = '".$id."'";
				$d->query($sql);
				}
				if($d->query($sql))
					redirect($url_back);
					
				else
					transfer("Xóa dữ liệu bị lỗi", $url_back);
			}else transfer("Không nhận được dữ liệu", $url_back);


			}

		}

		
		$data['stt'] = $_POST['stt'];
		$data['com'] = $_GET['typeparent'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['is_index'] = isset($_POST['is_index']) ? 1 : 0;
		$data['is_follow'] = isset($_POST['is_follow']) ? 1 : 0;
		$data['ngaysua'] = time();
		
		$d->setTable('news_cat');
		$d->setWhere('id', $id);
		if($d->update($data)){
			redirect("index.php?com=news&act=man_cat&typeparent=$_GET[typeparent]&curPage=".$_REQUEST['curPage'].$urldanhmuc);
		}
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=news&act=man_cat&typeparent=$_GET[typeparent]&curPage=".$_REQUEST['curPage'].$urldanhmuc);
	}else{	
	
	
		if($photo = upload_image("file", _format_duoihinh, _upload_news,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], _news_cat_thumb_w, _news_cat_thumb_h, _upload_news,$file_name,1);		
		}
		
		
		$data['id_list'] = $_POST['id_list'];
		

		foreach ($config["lang"] as $key => $value) {
			
		$data['h1_'.$value] = magic_quote($_POST['h1_'.$value]);
		$data['h2_'.$value] = magic_quote($_POST['h2_'.$value]);	
		$data['h3_'.$value] = magic_quote($_POST['h3_'.$value]);
		$data['h4_'.$value] = magic_quote($_POST['h4_'.$value]);
		$data['h5_'.$value] = magic_quote($_POST['h5_'.$value]);
		$data['h6_'.$value] = magic_quote($_POST['h6_'.$value]);	
		$data['title_'.$value] = magic_quote($_POST['title_'.$value]);
		$data['alt_'.$value] = magic_quote($_POST['alt_'.$value]);
		$data['keyword_'.$value] = magic_quote($_POST['keyword_'.$value]);
		$data['description_'.$value] = magic_quote($_POST['description_'.$value]);
		$data['deschar_'.$value] = magic_quote($_POST['deschar_'.$value]);

		$data['ten_'.$value] = magic_quote($_POST['ten_'.$value]);
		$data['tenkhongdau_'.$value] = changeTitle($_POST['ten_'.$value]);
		$data['mota_'.$value] = magic_quote($_POST['mota_'.$value]);


		}
				
		$sql = "SELECT stt FROM table_news_cat where com='".$_GET["typeparent"]."'  order by stt desc limit 0,1 ";
		$result = mysql_query($sql);
		$max_stt = mysql_fetch_array($result);
		
		if ( ($max_stt["stt"]) >= ($_POST['stt']) )
		{
			
			$data["stt"]=$max_stt["stt"]+1;
	
		
		}
		else
		{
			$data['stt'] = magic_quote($_POST['stt']);

			
		}		

		//$data['stt'] = $_POST['stt'];
		$data['com'] = $_GET['typeparent'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['is_index'] = isset($_POST['is_index']) ? 1 : 0;
		$data['is_follow'] = isset($_POST['is_follow']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		$d->setTable('news_cat');
		if($d->insert($data))
			redirect("index.php?com=news&act=man_cat&typeparent=$_GET[typeparent]&curPage=".$_REQUEST['curPage'].$urldanhmuc);
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=news&act=man_cat&typeparent=$_GET[typeparent]&curPage=".$_REQUEST['curPage'].$urldanhmuc);
	}
}




function delete_catimg()
{
	global $d , $url_back;
	
	//echo ("test");
	//die();
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,thumb, photo from #_news_cat where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_news.$row['photo']);
				delete_file(_upload_news.$row['thumb']);			
			}
		$sql = "UPDATE #_news_cat SET photo ='',thumb='' WHERE  id = '".$id."'";
		$d->query($sql);
		}
		if($d->query($sql))
			redirect($url_back);
		else
			transfer("Xóa dữ liệu bị lỗi", $url_back);
	}else transfer("Không nhận được dữ liệu", $url_back);
}


function delete_cat(){
	global $d, $url_back;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,thumb, photo from #_news_cat where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_news.$row['photo']);
				delete_file(_upload_news.$row['thumb']);			
			}
		}
		$d->reset();	
		$sql = "delete from #_news_cat where id='".$id."'";
		$d->query($sql);
		if($d->query($sql))
			redirect($url_back);
		else
			transfer("Xóa dữ liệu bị lỗi", $url_back);
	}else if(isset($_GET['listid'])){
		$listid = explode(",",$_GET['listid']);
		foreach($listid as $listid_item){
			$d->reset();
			$d->setTable('news_cat');
			$d->setWhere('id', $listid_item);
			$d->select();
			if($d->num_rows()==0) transfer("Dữ liệu không có thực", $url_back);
			$row = $d->fetch_array();
			delete_file(_upload_news.$row['photo']);
			delete_file(_upload_news.$row['thumb']);	
			$d->delete();
		}
		redirect($url_back);
	}else transfer("Không nhận được dữ liệu", $url_back);
}

/*---------------END DANH MUC CAP 2------------------*/


/*---------------START DANH MUC CAP 1------------------*/
function get_lists(){
	global $d, $items, $paging, $url_back , $url_link,$totalRows , $pageSize, $offset;
	
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['chon'];		
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_news_list SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=news&act=man_list&typeparent=$_GET[typeparent]");			
		}
		
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_news_list SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=news&act=man_list&typeparent=$_GET[typeparent]");			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){
				$sql="SELECT * FROM table_news_list where id='".$id_array[$i]."'";
				$d->query($sql);
				//$cats= $d->fetch_array();

				if($d->num_rows()>0){
				while($row = $d->fetch_array()){

						delete_file(_upload_news.$row['photo']);
						delete_file(_upload_news.$row['thumb']);			
					}
				}

				
				$sql = "delete from table_news_list where id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=news&act=man_list&typeparent=$_GET[typeparent]");			
		}
		
		
	}
	
	
	
	#----------------------------------------------------------------------------------------
	if($_REQUEST['menu_footer']!='')

	{
	$id_up = $_REQUEST['menu_footer'];
	$sql_sp = "SELECT id,menu_footer FROM table_news_list where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$time=time();
	$hienthi=$cats[0]['menu_footer'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_news_list SET menu_footer ='$time' WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_news_list SET menu_footer =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	redirect($url_back);	
	}
	#----------------------------------------------------------------------------------------



	#----------------------------------------------------------------------------------------
	if($_REQUEST['menu_top']!='')

	{
	$id_up = $_REQUEST['menu_top'];
	$sql_sp = "SELECT id,menu_top FROM table_news_list where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$time=time();
	$hienthi=$cats[0]['menu_top'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_news_list SET menu_top ='$time' WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_news_list SET menu_top =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	redirect($url_back);	
	}
	#----------------------------------------------------------------------------------------
	
	
	
	
	#----------------------------------------------------------------------------------------
	if($_REQUEST['nhom_tin']!='')

	{
	$id_up = $_REQUEST['nhom_tin'];
	$sql_sp = "SELECT id,nhom_tin FROM table_news_list where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$time=time();
	$hienthi=$cats[0]['nhom_tin'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_news_list SET nhom_tin ='$time' WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_news_list SET nhom_tin =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	redirect($url_back);	
	}
	#----------------------------------------------------------------------------------------





	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['hienthi']!='')
	{
	$id_up = $_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_news_list where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_news_list SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_news_list SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	redirect($url_back);
	}
	
	#----------------------------------------------------------------------------------------
	
	
	
	
	if(@$_REQUEST['typeparent']!='')
	{
		$typeparent=addslashes($_REQUEST['typeparent']);
		$where.=" and com='$typeparent'";
	}else{
		$where.=" and com";
	}


	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%' or ten_en LIKE '%$keyword%' or ten_cn LIKE '%$keyword%' or ten_ge LIKE '%$keyword%' ";
	}
	
	
	
	$sql="SELECT count(id) AS numrows FROM #_news_list where id  $where ";
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
	
	$sql = "select * from #_news_list where id $where order by stt,id desc limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=news&act=man_list&typeparent=$_GET[typeparent]".$urldanhmuc;
	


	
	
}

function get_list(){
	global $d, $item, $url_back;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", $url_back);
	
	$sql = "select * from #_news_list where id='".$id."' and com='$_GET[typeparent]'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", $url_back);
	$item = $d->fetch_array();
}

function save_list(){
	global $d, $url_back,$config,$urldanhmuc;

	$file_name=changeTitle($_POST['ten_vi']).fns_Rand_digit(0,3,5);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=news&act=man_list&typeparent=$_GET[typeparent]&curPage=".$_REQUEST['curPage'].$urldanhmuc);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
if($id){
		if($photo = upload_image("file", _format_duoihinh, _upload_news,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], _news_thumb_w, _news_thumb_h, _upload_news,$file_name,1);	
			$d->setTable('news_list');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_news.$row['photo']);	
				delete_file(_upload_news.$row['thumb']);				
			}
		}
		
		

		
		foreach ($config["lang"] as $key => $value) {


			$data['h1_'.$value] = magic_quote($_POST['h1_'.$value]);
			$data['h2_'.$value] = magic_quote($_POST['h2_'.$value]);	
			$data['h3_'.$value] = magic_quote($_POST['h3_'.$value]);
			$data['h4_'.$value] = magic_quote($_POST['h4_'.$value]);
			$data['h5_'.$value] = magic_quote($_POST['h5_'.$value]);
			$data['h6_'.$value] = magic_quote($_POST['h6_'.$value]);	
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
		
		

		if ($_REQUEST["delete_img_present"]=="delete_img")
		{

			$id =  themdau($_GET['id']);
			$delete_img_present=$_REQUEST['delete_img_present'];
			
			

			if($delete_img_present=='delete_img'){

				if(isset($_GET['id'])){
				
				$d->reset();
				$sql = "select id,thumb, photo from #_news_list where id='".$id."'";
				$d->query($sql);
				if($d->num_rows()>0){
					while($row = $d->fetch_array()){
						delete_file(_upload_news.$row['photo']);
						delete_file(_upload_news.$row['thumb']);			
					}
				$sql = "UPDATE #_news_list SET photo ='',thumb='' WHERE  id = '".$id."'";
				$d->query($sql);
				}
				if($d->query($sql))
					redirect($url_back);
					
				else
					transfer("Xóa dữ liệu bị lỗi", $url_back);
			}else transfer("Không nhận được dữ liệu", $url_back);


			}

		}
		
		
		$data['stt'] = $_POST['stt'];
		$data['com'] = $_GET['typeparent'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['is_index'] = isset($_POST['is_index']) ? 1 : 0;
		$data['is_follow'] = isset($_POST['is_follow']) ? 1 : 0;
		$data['ngaysua'] = time();
		$d->setTable('news_list');
		$d->setWhere('id', $id);
		if($d->update($data))
			if(isset($_POST['referer_link']))
				redirect($_POST['referer_link']);
			else
				redirect("index.php?com=news&act=man_list&typeparent=$_GET[typeparent]&curPage=".$_REQUEST['curPage'].$urldanhmuc);
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=news&act=man_list&typeparent=$_GET[typeparent]&curPage=".$_REQUEST['curPage'].$urldanhmuc);
	}else{	
		if($photo = upload_image("file", _format_duoihinh, _upload_news,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], _news_thumb_w, _news_thumb_h, _upload_news,$file_name,1);		
		}
		
		foreach ($config["lang"] as $key => $value) {
			
		$data['h1_'.$value] = magic_quote($_POST['h1_'.$value]);
		$data['h2_'.$value] = magic_quote($_POST['h2_'.$value]);	
		$data['h3_'.$value] = magic_quote($_POST['h3_'.$value]);
		$data['h4_'.$value] = magic_quote($_POST['h4_'.$value]);
		$data['h5_'.$value] = magic_quote($_POST['h5_'.$value]);
		$data['h6_'.$value] = magic_quote($_POST['h6_'.$value]);	
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
		
		
		$sql = "SELECT stt FROM table_news_list where com='".$_GET["typeparent"]."' order by stt desc limit 0,1 ";
		$result = mysql_query($sql);
		$max_stt = mysql_fetch_array($result);
		
		if ( ($max_stt["stt"]) >= ($_POST['stt']) )
		{
			
			$data["stt"]=$max_stt["stt"]+1;
	
		
		}
		else
		{
			$data['stt'] = magic_quote($_POST['stt']);
	
		}

		//$data['stt'] = $_POST['stt'];
		$data['com'] = $_GET['typeparent'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['is_index'] = isset($_POST['is_index']) ? 1 : 0;
		$data['is_follow'] = isset($_POST['is_follow']) ? 1 : 0;
		$data['ngaytao'] = time();
		$d->setTable('news_list');
		if($d->insert($data)){
			if(isset($_POST['referer_link']))
				redirect($_POST['referer_link']);
			else
				redirect("index.php?com=news&act=man_list&typeparent=$_GET[typeparent]&curPage=".$_REQUEST['curPage'].$urldanhmuc);
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=news&act=man_list&typeparent=$_GET[typeparent]&curPage=".$_REQUEST['curPage'].$urldanhmuc);
	}
}



function delete_listimg()
{
	global $d , $url_back;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,thumb, photo from #_news_list where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_news.$row['photo']);
				delete_file(_upload_news.$row['thumb']);			
			}
		$sql = "UPDATE #_news_list SET photo ='',thumb='' WHERE  id = '".$id."'";
		$d->query($sql);
		}
		if($d->query($sql))
			redirect($url_back);
		else
			transfer("Xóa dữ liệu bị lỗi", $url_back);
	}else transfer("Không nhận được dữ liệu", $url_back);
}



function delete_list(){
	global $d, $url_back;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,thumb, photo from #_news_list where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_news.$row['photo']);
				delete_file(_upload_news.$row['thumb']);			
			}
		}
		$d->reset();	
		$sql = "delete from #_news_list where id='".$id."'";
		$d->query($sql);
		if($d->query($sql))
			redirect($url_back);
		else
			transfer("Xóa dữ liệu bị lỗi", $url_back);
	}else if(isset($_GET['listid'])){
		$listid = explode(",",$_GET['listid']);
		foreach($listid as $listid_item){
			$d->reset();
			$d->setTable('news_list');
			$d->setWhere('id', $listid_item);
			$d->select();
			if($d->num_rows()==0) transfer("Dữ liệu không có thực", $url_back);
			$row = $d->fetch_array();
			delete_file(_upload_news.$row['photo']);
			delete_file(_upload_news.$row['thumb']);	
			$d->delete();
		}
		redirect($url_back);
	}else transfer("Không nhận được dữ liệu", $url_back);
}


/*---------------END DANH MUC CAP 1------------------*/

/*---------------START DANH MUC CAP 3------------------*/

function get_loais(){
	global $d, $items, $paging, $url_back , $url_link,$totalRows , $pageSize, $offset;
	
	
	
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['chon'];
		
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_news_item SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=news&act=man_item&typeparent=$_GET[typeparent]");			
		}
		
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_news_item SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=news&act=man_item&typeparent=$_GET[typeparent]");			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){
				$sql="SELECT * FROM table_news_item where id='".$id_array[$i]."'";
				$d->query($sql);
				//$cats= $d->fetch_array();

				if($d->num_rows()>0){
				while($row = $d->fetch_array()){

						delete_file(_upload_news.$row['photo']);
						delete_file(_upload_news.$row['thumb']);			
					}
				}
				
				$sql = "delete from table_news_item where id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=news&act=man_item&typeparent=$_GET[typeparent]");			
		}
		
		
	}
	
	#----------------------------------------------------------------------------------------
	if($_REQUEST['hienthi']!='')
	{
	$id_up = $_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_news_item where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_news_item SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_news_item SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	redirect($url_back);
	}
	


	if(@$_REQUEST['typeparent']!='')
	{
		$typeparent=addslashes($_REQUEST['typeparent']);
		$where.=" and com='$typeparent'";
	}else{
		$where.=" and com";
	}


	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%' or ten_en LIKE '%$keyword%' or ten_cn LIKE '%$keyword%' or ten_ge LIKE '%$keyword%' ";
	}


	if((int)$_REQUEST['id_list']!='')
	{
		$where.=" and	id_list=".$_REQUEST['id_list']."";
	}
	if((int)$_REQUEST['id_cat']!='')
	{
		$where.=" and	id_cat=".$_REQUEST['id_cat']."";
	}
	
	
	$sql="SELECT count(id) AS numrows FROM #_news_item where id  $where ";
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
	
	$sql = "select * from #_news_item where id $where order by stt,id desc limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=news&act=man_item&typeparent=$_GET[typeparent]".$urldanhmuc;
	
	
	
}

function get_loai(){
	global $d, $item, $url_back ,$config;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", $url_back);
	
	$sql = "select * from #_news_item where id='".$id."' and com='$_REQUEST[typeparent]'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", $url_back);
	$item = $d->fetch_array();
}

function save_loai(){
	global $d, $url_back,$config,$urldanhmuc;
	$file_name=changeTitle($_POST['ten_vi']).fns_Rand_digit(0,3,5);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=news&act=man_item&typeparent=$_GET[typeparent]&curPage=".$_REQUEST['curPage'].$urldanhmuc);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		
		
		if($photo = upload_image("file", _format_duoihinh, _upload_news,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], _news_item_thumb_w, _news_item_thumb_h, _upload_news,$file_name,1);	
			$d->setTable('news_item');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_news.$row['photo']);	
				delete_file(_upload_news.$row['thumb']);				
			}
		}
		
		foreach ($config["lang"] as $key => $value) {


			$data['h1_'.$value] = magic_quote($_POST['h1_'.$value]);
			$data['h2_'.$value] = magic_quote($_POST['h2_'.$value]);	
			$data['h3_'.$value] = magic_quote($_POST['h3_'.$value]);
			$data['h4_'.$value] = magic_quote($_POST['h4_'.$value]);
			$data['h5_'.$value] = magic_quote($_POST['h5_'.$value]);
			$data['h6_'.$value] = magic_quote($_POST['h6_'.$value]);	
			$data['title_'.$value] = magic_quote($_POST['title_'.$value]);
			$data['alt_'.$value] = magic_quote($_POST['alt_'.$value]);
			$data['keyword_'.$value] = magic_quote($_POST['keyword_'.$value]);
			$data['description_'.$value] = magic_quote($_POST['description_'.$value]);
			$data['deschar_'.$value] = magic_quote($_POST['deschar_'.$value]);


			$data['ten_'.$value] = magic_quote($_POST['ten_'.$value]);
			$data['tenkhongdau_'.$value] = changeTitle($_POST['ten_'.$value]);

			$data['mota_'.$value] = magic_quote($_POST['mota_'.$value]);
			

			

		}




		if ($_REQUEST["delete_img_present"]=="delete_img")
		{

			$id =  themdau($_GET['id']);
			$delete_img_present=$_REQUEST['delete_img_present'];
		

			if($delete_img_present=='delete_img'){

				if(isset($_GET['id'])){
				
				$d->reset();
				$sql = "select id,thumb, photo from #_news_item where id='".$id."'";
				$d->query($sql);
				if($d->num_rows()>0){
					while($row = $d->fetch_array()){
						delete_file(_upload_news.$row['photo']);
						delete_file(_upload_news.$row['thumb']);			
					}
				$sql = "UPDATE #_news_item SET photo ='',thumb='' WHERE  id = '".$id."'";
				$d->query($sql);
				}
				if($d->query($sql))
					redirect($url_back);
					
				else
					transfer("Xóa dữ liệu bị lỗi", $url_back);
			}else transfer("Không nhận được dữ liệu", $url_back);


			}

		}

	
		$data['id_list'] = $_POST['id_list'];	
		$data['id_cat']= $_POST['id_cat'];
		$data['com'] = $_REQUEST['typeparent'];			
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['is_index'] = isset($_POST['is_index']) ? 1 : 0;
		$data['is_follow'] = isset($_POST['is_follow']) ? 1 : 0;
		$data['ngaysua'] = time();
		
		$d->setTable('news_item');
		$d->setWhere('id', $id);
		if($d->update($data)){
			redirect("index.php?com=news&act=man_item&typeparent=$_GET[typeparent]&curPage=".$_REQUEST['curPage'].$urldanhmuc);
		}
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=news&act=man_item&typeparent=$_GET[typeparent]&curPage=".$_REQUEST['curPage'].$urldanhmuc);
	}else{
		
		
		if($photo = upload_image("file", _format_duoihinh, _upload_news,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], _news_item_thumb_w, _news_item_thumb_h, _upload_news,$file_name,1);		
		}
		
		
		foreach ($config["lang"] as $key => $value) {
			
		$data['h1_'.$value] = magic_quote($_POST['h1_'.$value]);
		$data['h2_'.$value] = magic_quote($_POST['h2_'.$value]);	
		$data['h3_'.$value] = magic_quote($_POST['h3_'.$value]);
		$data['h4_'.$value] = magic_quote($_POST['h4_'.$value]);
		$data['h5_'.$value] = magic_quote($_POST['h5_'.$value]);
		$data['h6_'.$value] = magic_quote($_POST['h6_'.$value]);	
		$data['title_'.$value] = magic_quote($_POST['title_'.$value]);
		$data['alt_'.$value] = magic_quote($_POST['alt_'.$value]);
		$data['keyword_'.$value] = magic_quote($_POST['keyword_'.$value]);
		$data['description_'.$value] = magic_quote($_POST['description_'.$value]);
		$data['deschar_'.$value] = magic_quote($_POST['deschar_'.$value]);

		$data['ten_'.$value] = magic_quote($_POST['ten_'.$value]);
		$data['tenkhongdau_'.$value] = changeTitle($_POST['ten_'.$value]);
		$data['mota_'.$value] = magic_quote($_POST['mota_'.$value]);
		

		}
				
		
		
		$data['id_list'] = $_POST['id_list'];
		$data['id_cat']= $_POST['id_cat'];	
		$data['com'] = $_REQUEST['typeparent'];	
		
		
		$sql = "SELECT stt FROM table_news_item where com='".$_GET["typeparent"]."'  order by stt desc limit 0,1 ";
		$result = mysql_query($sql);
		$max_stt = mysql_fetch_array($result);
		
		if ( ($max_stt["stt"]) >= ($_POST['stt']) )
		{
			
			$data["stt"]=$max_stt["stt"]+1;
	
		
		}
		else
		{
			$data['stt'] = magic_quote($_POST['stt']);

			
		}	
					
		//$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['is_index'] = isset($_POST['is_index']) ? 1 : 0;
		$data['is_follow'] = isset($_POST['is_follow']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		$d->setTable('news_item');
		if($d->insert($data))
			redirect("index.php?com=news&act=man_item&typeparent=$_GET[typeparent]&curPage=".$_REQUEST['curPage'].$urldanhmuc);
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=news&act=man_item&typeparent=$_GET[typeparent]&curPage=".$_REQUEST['curPage'].$urldanhmuc);
	}
}


function delete_itemimg()
{
	global $d , $url_back;
	

	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,thumb, photo from #_news_item where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_news.$row['photo']);
				delete_file(_upload_news.$row['thumb']);			
			}
		$sql = "UPDATE #_news_item SET photo ='',thumb='' WHERE  id = '".$id."'";
		$d->query($sql);
		}
		if($d->query($sql))
			redirect($url_back);
		else
			transfer("Xóa dữ liệu bị lỗi", $url_back);
	}else transfer("Không nhận được dữ liệu", $url_back);
}

function delete_loai(){
	global $d, $url_back;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,thumb, photo from #_news_item where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_news.$row['photo']);
				delete_file(_upload_news.$row['thumb']);			
			}
		}
		$d->reset();	
		$sql = "delete from #_news_item where id='".$id."'";
		$d->query($sql);
		if($d->query($sql))
			redirect($url_back);
		else
			transfer("Xóa dữ liệu bị lỗi", $url_back);
	}else if(isset($_GET['listid'])){
		$listid = explode(",",$_GET['listid']);
		foreach($listid as $listid_item){
			$d->reset();
			$d->setTable('news_item');
			$d->setWhere('id', $listid_item);
			$d->select();
			if($d->num_rows()==0) transfer("Dữ liệu không có thực", $url_back);
			$row = $d->fetch_array();
			delete_file(_upload_news.$row['photo']);
			delete_file(_upload_news.$row['thumb']);	
			$d->delete();
		}
		redirect($url_back);
	}else transfer("Không nhận được dữ liệu", $url_back);
}
/*---------------END DANH MUC CAP 3------------------*/


/*---------------START DANH MUC CAP 4------------------*/


function get_subs(){
	global $d, $items, $paging, $url_back , $url_link,$totalRows , $pageSize, $offset;
	
	
	
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['chonxoa'];
		
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_news_sub SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect($url_back);			
		}
		
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_news_sub SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect($url_back);			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){
				$sql="SELECT * FROM table_news_sub where id='".$id_array[$i]."'";
				$d->query($sql);
				//$cats= $d->fetch_array();


				if($d->num_rows()>0){
				while($row = $d->fetch_array()){

						delete_file(_upload_news.$row['photo']);
						delete_file(_upload_news.$row['thumb']);			
					}
				}
				
				$sql = "delete from table_news_sub where id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect($url_back);			
		}
		
		
	}
	
	
	#----------------------------------------------------------------------------------------
	if($_REQUEST['hienthi']!='')
	{
	$id_up = $_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_news_sub where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_news_sub SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_news_sub SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	redirect($url_back);
	}


	if(@$_REQUEST['typeparent']!='')
	{
		$typeparent=addslashes($_REQUEST['typeparent']);
		$where.=" and com='$typeparent'";
	}else{
		$where.=" and com";
	}


	if((int)$_REQUEST['id_list']!='')
	{
		$where.=" and	id_list=".$_REQUEST['id_list']."";
	}
	if((int)$_REQUEST['id_cat']!='')
	{
		$where.=" and	id_cat=".$_REQUEST['id_cat']."";
	}
	if((int)$_REQUEST['id_item']!='')
	{
		$where.=" and	id_item=".$_REQUEST['id_item']."";
	}


	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%' or ten_en LIKE '%$keyword%' or ten_cn LIKE '%$keyword%' or ten_ge LIKE '%$keyword%' ";
	}
	

	
	$sql="SELECT count(id) AS numrows FROM #_news_sub where id  $where ";
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
	
	$sql = "select * from #_news_sub where id $where order by stt,id desc limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=news&act=man_sub&typeparent=$_GET[typeparent]".$urldanhmuc;

}

function get_sub(){
	global $d, $item, $url_back;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", $url_back);
	
	$sql = "select * from #_news_sub where id='".$id."' and com='$_REQUEST[typeparent]' ";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", $url_back);
	$item = $d->fetch_array();
}

function save_sub(){
	global $d, $url_back,$config,$urldanhmuc;
	
	$file_name=changeTitle($_POST['ten_vi']).fns_Rand_digit(0,3,5);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=news&act=man_sub&typeparent=$_GET[typeparent]&curPage=".$_REQUEST['curPage'].$urldanhmuc);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){	
	

		if($photo = upload_image("file", _format_duoihinh, _upload_news,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], _news_sub_thumb_w, _news_sub_thumb_h, _upload_news,$file_name,1);		
			$d->setTable('news');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_news.$row['photo']);	
				delete_file(_upload_news.$row['thumb']);				
			}
		}



		if ($_REQUEST["delete_img_present"]=="delete_img")
		{

			$id =  themdau($_GET['id']);
			$delete_img_present=$_REQUEST['delete_img_present'];
			


			if($delete_img_present=='delete_img'){

				if(isset($_GET['id'])){
				
				$d->reset();
				$sql = "select id,thumb, photo from #_news_sub where id='".$id."'";
				$d->query($sql);
				if($d->num_rows()>0){
					while($row = $d->fetch_array()){
						delete_file(_upload_news.$row['photo']);
						delete_file(_upload_news.$row['thumb']);			
					}
				$sql = "UPDATE #_news_sub SET photo ='',thumb='' WHERE  id = '".$id."'";
				$d->query($sql);
				}
				if($d->query($sql))
					redirect($url_back);
					
				else
					transfer("Xóa dữ liệu bị lỗi", $url_back);
			}else transfer("Không nhận được dữ liệu", $url_back);


			}

		}


		$data['id_list'] = $_POST['id_list'];	
		$data['id_cat']= $_POST['id_cat'];
		$data['id_item']= $_POST['id_item'];
		$data['com'] = $_REQUEST['typeparent'];		
	
		
		foreach ($config["lang"] as $key => $value) {


			$data['h1_'.$value] = magic_quote($_POST['h1_'.$value]);
			$data['h2_'.$value] = magic_quote($_POST['h2_'.$value]);	
			$data['h3_'.$value] = magic_quote($_POST['h3_'.$value]);
			$data['h4_'.$value] = magic_quote($_POST['h4_'.$value]);
			$data['h5_'.$value] = magic_quote($_POST['h5_'.$value]);
			$data['h6_'.$value] = magic_quote($_POST['h6_'.$value]);	
			$data['title_'.$value] = magic_quote($_POST['title_'.$value]);
			$data['alt_'.$value] = magic_quote($_POST['alt_'.$value]);
			$data['keyword_'.$value] = magic_quote($_POST['keyword_'.$value]);
			$data['description_'.$value] = magic_quote($_POST['description_'.$value]);
			$data['deschar_'.$value] = magic_quote($_POST['deschar_'.$value]);


			$data['ten_'.$value] = magic_quote($_POST['ten_'.$value]);
			$data['tenkhongdau_'.$value] = changeTitle($_POST['ten_'.$value]);

			$data['mota_'.$value] = magic_quote($_POST['mota_'.$value]);
			

			

		}

		
		

		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['is_index'] = isset($_POST['is_index']) ? 1 : 0;
		$data['is_follow'] = isset($_POST['is_follow']) ? 1 : 0;
		$data['ngaysua'] = time();
		
		$d->setTable('news_sub');
		$d->setWhere('id', $id);
		if($d->update($data)){
			redirect("index.php?com=news&act=man_sub&typeparent=$_GET[typeparent]&curPage=".$_REQUEST['curPage'].$urldanhmuc);
		}
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=news&act=man_sub&typeparent=$_GET[typeparent]&curPage=".$_REQUEST['curPage'].$urldanhmuc);
	}else{	


		if($photo = upload_image("file", _format_duoihinh, _upload_news,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], _news_sub_thumb_w, _news_sub_thumb_h, _upload_news,$file_name,1);		
		}	
	

		$data['id_list'] = $_POST['id_list'];
		$data['id_cat']= $_POST['id_cat'];
		$data['id_item']= $_POST['id_item'];
		$data['com'] = $_REQUEST['typeparent'];		
	
		foreach ($config["lang"] as $key => $value) {
			
		$data['h1_'.$value] = magic_quote($_POST['h1_'.$value]);
		$data['h2_'.$value] = magic_quote($_POST['h2_'.$value]);	
		$data['h3_'.$value] = magic_quote($_POST['h3_'.$value]);
		$data['h4_'.$value] = magic_quote($_POST['h4_'.$value]);
		$data['h5_'.$value] = magic_quote($_POST['h5_'.$value]);
		$data['h6_'.$value] = magic_quote($_POST['h6_'.$value]);	
		$data['title_'.$value] = magic_quote($_POST['title_'.$value]);
		$data['alt_'.$value] = magic_quote($_POST['alt_'.$value]);
		$data['keyword_'.$value] = magic_quote($_POST['keyword_'.$value]);
		$data['description_'.$value] = magic_quote($_POST['description_'.$value]);
		$data['deschar_'.$value] = magic_quote($_POST['deschar_'.$value]);

		$data['ten_'.$value] = magic_quote($_POST['ten_'.$value]);
		$data['tenkhongdau_'.$value] = changeTitle($_POST['ten_'.$value]);
		$data['mota_'.$value] = magic_quote($_POST['mota_'.$value]);
		

		}
		
		
		$sql = "SELECT stt FROM table_news_sub where com='".$_GET["typeparent"]."'  order by stt desc limit 0,1 ";
		$result = mysql_query($sql);
		$max_stt = mysql_fetch_array($result);
		
		if ( ($max_stt["stt"]) >= ($_POST['stt']) )
		{
			
			$data["stt"]=$max_stt["stt"]+1;
	
		
		}
		else
		{
			$data['stt'] = magic_quote($_POST['stt']);

			
		}


		//$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['is_index'] = isset($_POST['is_index']) ? 1 : 0;
		$data['is_follow'] = isset($_POST['is_follow']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		$d->setTable('news_sub');
		if($d->insert($data))
			redirect("index.php?com=news&act=man_sub&typeparent=$_GET[typeparent]&curPage=".$_REQUEST['curPage'].$urldanhmuc);
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=news&act=man_sub&typeparent=$_GET[typeparent]&curPage=".$_REQUEST['curPage'].$urldanhmuc);
	}
}


function delete_sub(){
	global $d, $url_back;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,thumb, photo from #_news_sub where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_news.$row['photo']);
				delete_file(_upload_news.$row['thumb']);			
			}
		}
		$d->reset();	
		$sql = "delete from #_news_sub where id='".$id."'";
		$d->query($sql);
		if($d->query($sql))
			redirect($url_back);
		else
			transfer("Xóa dữ liệu bị lỗi", $url_back);
	}else if(isset($_GET['listid'])){
		$listid = explode(",",$_GET['listid']);
		foreach($listid as $listid_item){
			$d->reset();
			$d->setTable('news_sub');
			$d->setWhere('id', $listid_item);
			$d->select();
			if($d->num_rows()==0) transfer("Dữ liệu không có thực", $url_back);
			$row = $d->fetch_array();
			delete_file(_upload_news.$row['photo']);
			delete_file(_upload_news.$row['thumb']);	
			$d->delete();
		}
		redirect($url_back);
	}else transfer("Không nhận được dữ liệu", $url_back);
}





/*---------------END DANH MUC CAP 4------------------*/



?>