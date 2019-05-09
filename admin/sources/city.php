<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$urldanhmuc ="";
$urldanhmuc.= (isset($_REQUEST['id_list'])) ? "&id_list=".addslashes($_REQUEST['id_list']) : "";
$urldanhmuc.= (isset($_REQUEST['id_cat'])) ? "&id_cat=".addslashes($_REQUEST['id_cat']) : "";
$urldanhmuc.= (isset($_REQUEST['id_item'])) ? "&id_item=".addslashes($_REQUEST['id_item']) : "";
$duongdan=$_SERVER['HTTP_REFERER'];
$id=@$_REQUEST['id'];
switch($act){

	case "man":
		get_items();
		$template = "city/items";
		break;
	case "add":		
		$template = "city/item_add";
		break;
	case "edit":		
		get_item();
		$template = "city/item_add";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
		
	#===================================================	
	case "man_sub":
		get_subs();
		$template = "city/subs";
		break;
	case "add_sub":		
		$template = "city/sub_add";
		break;
	case "edit_sub":		
		get_sub();
		$template = "city/sub_add";
		break;
	case "save_sub":
		save_sub();
		break;
	case "delete_sub":
		delete_sub();
		break;
		
	#===================================================	
	case "man_item":
		get_loais();
		$template = "city/loais";
		break;
	case "add_item":		
		$template = "city/loai_add";
		break;
	case "edit_item":		
		get_loai();
		$template = "city/loai_add";
		break;
	case "save_item":
		save_loai();
		break;
	case "delete_item":
		delete_loai();
		break;
		
	#===================================================	
	case "man_cat":
		get_cats();
		$template = "city/cats";
		break;
	case "add_cat":		
		$template = "city/cat_add";
		break;
	case "edit_cat":		
		get_cat();
		$template = "city/cat_add";
		break;
	case "save_cat":
		save_cat();
		break;
	case "delete_cat":
		delete_cat();
		break;
	#===================================================	
	case "man_list":
		get_lists();
		$template = "city/lists";
		break;
	case "add_list":		
		$template = "city/list_add";
		break;
	case "edit_list":		
		get_list();
		$template = "city/list_add";
		break;
	case "save_list":
		save_list();
		break;
	case "delete_list":
		delete_list();
		break;
		
		
	case "man_danhmuc":
		get_danhmucs();
		$template = "city/danhmucs";
		break;
	case "add_danhmuc":		
		$template = "city/danhmuc_add";
		break;
	case "edit_danhmuc":		
		get_danhmuc();
		$template = "city/danhmuc_add";
		break;
	case "save_danhmuc":
		save_danhmuc();
		break;
	case "delete_danhmuc":
		delete_danhmuc();
		break;	
		
		
	
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
#=================CAP 1===================
function get_lists(){
	global $d, $items, $paging,$duongdan ,$url_link,$totalRows , $pageSize, $offset;
	
	
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['chonxoa'];
		
		//$id_array = explode(",",$_GET['listid']);
		
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_city_list SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=city&act=man_list");			
		}
		
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
		//echo($id_array[$i]);
		//die();
				$sql = "UPDATE table_city_list SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=city&act=man_list");			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){
				$sql="SELECT * FROM table_city_list where id='".$id_array[$i]."'";
				$d->query($sql);
				$cats= $d->fetch_array();
				//$id_parent=$cats['id'];
				
				//$sql = "UPDATE table_city_list SET id = '".$id_parent."' WHERE  id = ".$id_array[$i]."";
				//mysql_query($sql) or die("Not query sqlUPDATE_ORDER");
				
				$sql = "delete from table_city_list where id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=city&act=man_list");			
		}
		
		
	}
	
	
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['noibat']!='')
	{
		$id_up = $_REQUEST['noibat'];
		$sql_sp = "SELECT id,noibat FROM table_city_list where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$time=time();
		$hienthi=$cats[0]['noibat'];
		if($hienthi==0)
		{
		$sqlUPDATE_ORDER = "UPDATE table_city_list SET noibat ='$time' WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
		$sqlUPDATE_ORDER = "UPDATE table_city_list SET noibat =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}	
		redirect($duongdan);
	}
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['hienthi']!='')
	{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_city_list where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
		$sqlUPDATE_ORDER = "UPDATE table_city_list SET hienthi =1 WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
		$sqlUPDATE_ORDER = "UPDATE table_city_list SET hienthi =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}	
	redirect($duongdan);
	}
	
	
	
	if(@$_REQUEST['keyword']!='')
	{
	$keyword=addslashes($_REQUEST['keyword']);
	$where.=" and ten_vi LIKE '%$keyword%' or ten_en LIKE '%$keyword%' ";
	}
	
	$sql="SELECT count(id) AS numrows FROM #_city_list where id  $where ";
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
	
	$sql = "select * from #_city_list where  id $where order by stt,id asc limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();		
	$url_link="index.php?com=city&act=man_list";
}

function get_list(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", $duongdan);	
	$sql = "select * from #_city_list where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", $duongdan);
	$item = $d->fetch_array();	
}

function save_list(){
	global $d,$duongdan;
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", $duongdan);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		if($photo = upload_image("file", 'jpg|png|gif|jpeg|JPG|JPEG|PNG|GIF', _upload_city,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], 210, 170, _upload_city,$file_name,2);		
			$d->setTable('city');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_city.$row['photo']);	
				delete_file(_upload_city.$row['thumb']);				
			}
		}							
		$data['ten_vi'] = $_POST['ten_vi'];
		$data['ten_en'] = $_POST['ten_en'];
		$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
		
		$d->setTable('city_list');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=city&act=man_list&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Cập nhật dữ liệu bị lỗi","index.php?com=city&act=man_list&curPage=".$_REQUEST['curPage']."");
	}else{	
		if($photo = upload_image("file", 'jpg|png|gif|jpeg|JPG|JPEG|PNG|GIF', _upload_city,$file_name)){
			$data['photo'] = $photo;		
			$data['thumb'] = create_thumb($data['photo'], 210, 170, _upload_city,$file_name,2);		
		}			
		$data['ten_vi'] = $_POST['ten_vi'];
		$data['ten_en'] = $_POST['ten_en'];
		$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		$d->setTable('city_list');
		if($d->insert($data))
			redirect("index.php?com=city&act=man_list&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Lưu dữ liệu bị lỗi","index.php?com=city&act=man_list&curPage=".$_REQUEST['curPage']."");
	}
}
function delete_list(){
	global $d,$duongdan;

	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,thumb, photo from #_city_list where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_city.$row['photo']);
				delete_file(_upload_city.$row['thumb']);			
			}
		$sql = "delete from #_city_list where id='".$id."'";
		$d->query($sql);
		}
		if($d->query($sql))
			redirect($duongdan);
		else
			transfer("Xóa dữ liệu bị lỗi", $duongdan);
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id, photo,thumb from #_city_list where id='".$id."'";
			$d->query($sql);
		
			while($row = $d->fetch_array()){
				delete_file(_upload_city.$row['photo']);
				delete_file(_upload_city.$row['thumb']);
			}
			$sql = "delete from #_city_list where id='".$id."'";
			$d->query($sql);
			
		} 
		redirect($duongdan);
		
	} else transfer("Không nhận được dữ liệu", $duongdan);
		
}

#=================CAP 2===================
function get_cats(){
	global $d, $items, $paging,$duongdan,$url_link,$totalRows , $pageSize, $offset;
	
	
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['chonxoa'];
		
		//$id_array = explode(",",$_GET['listid']);
		
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_city_cat SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=city&act=man_cat");			
		}
		
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
		//echo($id_array[$i]);
		//die();
				$sql = "UPDATE table_city_cat SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=city&act=man_cat");			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){
				$sql="SELECT * FROM table_city_cat where id='".$id_array[$i]."'";
				$d->query($sql);
				$cats= $d->fetch_array();
				//$id_parent=$cats['id'];
				
				//$sql = "UPDATE table_city_list SET id = '".$id_parent."' WHERE  id = ".$id_array[$i]."";
				//mysql_query($sql) or die("Not query sqlUPDATE_ORDER");
				
				$sql = "delete from table_city_cat where id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=city&act=man_cat");			
		}
		
		
	}
	
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['noibat']!='')
	{
		$id_up = $_REQUEST['noibat'];
		$sql_sp = "SELECT id,noibat FROM table_city_cat where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$time=time();
		$hienthi=$cats[0]['noibat'];
		if($hienthi==0)
		{
		$sqlUPDATE_ORDER = "UPDATE table_city_cat SET noibat ='$time' WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
		$sqlUPDATE_ORDER = "UPDATE table_city_cat SET noibat =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}	
		redirect($duongdan);
	}
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['hienthi']!='')
	{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_city_cat where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
		$sqlUPDATE_ORDER = "UPDATE table_city_cat SET hienthi =1 WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
		$sqlUPDATE_ORDER = "UPDATE table_city_cat SET hienthi =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}	
	redirect($duongdan);
	}
	#-------------------------------------------------------------------------------
	
	if((int)@$_REQUEST['id_list']!='')
	{
	$where.=" and id_list=".$_REQUEST['id_list']."";
	}
	
	
	if(@$_REQUEST['keyword']!='')
	{
	$keyword=addslashes($_REQUEST['keyword']);
	$where.=" and ten_vi LIKE '%$keyword%' or ten_en LIKE '%$keyword%' ";
	}
	

	
	$sql="SELECT count(id) AS numrows FROM #_city_cat where id  $where ";
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
	
	$sql = "select * from #_city_cat where  id $where order by stt,id asc limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();		
	$url_link="index.php?com=city&act=man_cat";
}

function get_cat(){
	global $d, $item,$duongdan;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", $duongdan);
	
	$sql = "select * from #_city_cat where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", $duongdan);
	$item = $d->fetch_array();
}

function save_cat(){
	global $d,$duongdan;
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", $duongdan);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
			if($photo = upload_image("file", 'jpg|png|gif|jpeg|JPG|JPEG|GIF|PNG', _upload_city,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], 175,175, _upload_city,$file_name,2);		
			$d->setTable('city_cat');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_city.$row['photo']);	
				delete_file(_upload_city.$row['thumb']);				
			}
		}			
		$data['ten_vi'] = $_POST['ten_vi'];
		$data['ten_en'] = $_POST['ten_en'];
		$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);		
		$data['id_list'] = $_POST['id_list'];			
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
		
		$d->setTable('city_cat');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=city&act=man_cat&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Cập nhật dữ liệu bị lỗi", $duongdan);
	}else{	
		if($photo = upload_image("file", 'jpg|png|gif|jpeg|JPG|JPEG|GIF|PNG', _upload_city,$file_name)){
			$data['photo'] = $photo;		
			$data['thumb'] = create_thumb($data['photo'], 175,175, _upload_city,$file_name,2);		
		}	
		$data['id_list'] = $_POST['id_list'];
		$data['ten_vi'] = $_POST['ten_vi'];
		$data['ten_en'] = $_POST['ten_en'];
		$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		$d->setTable('city_cat');
		if($d->insert($data))
			redirect("index.php?com=city&act=man_cat&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=city&act=man_cat&curPage=".$_REQUEST['curPage']."");
	}
}

function delete_cat(){
	global $d,$duongdan;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,thumb, photo from #_city_cat where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_city.$row['photo']);
				delete_file(_upload_city.$row['thumb']);			
			}
		$sql = "delete from #_city_cat where id='".$id."'";
		$d->query($sql);
		}
		if($d->query($sql))
			redirect($duongdan);
		else
			transfer("Xóa dữ liệu bị lỗi", $duongdan);
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id, photo,thumb from #_city_cat where id='".$id."'";
			$d->query($sql);
		
			while($row = $d->fetch_array()){
				delete_file(_upload_city.$row['photo']);
				delete_file(_upload_city.$row['thumb']);
			}
			$sql = "delete from #_city_cat where id='".$id."'";
			$d->query($sql);
			
		} 
		redirect($duongdan);
		
	} else transfer("Không nhận được dữ liệu", $duongdan);
		
}
#==================CAP 3==================
function get_loais(){
	global $d, $items, $paging,$duongdan;
	
	
	
	
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['chonxoa'];
		
		//$id_array = explode(",",$_GET['listid']);
		
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_city_item SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=city&act=man_item");			
		}
		
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
		//echo($id_array[$i]);
		//die();
				$sql = "UPDATE table_city_item SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=city&act=man_item");			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){
				$sql="SELECT * FROM table_city_item where id='".$id_array[$i]."'";
				$d->query($sql);
				$cats= $d->fetch_array();
				//$id_parent=$cats['id'];
				
				//$sql = "UPDATE table_city_list SET id = '".$id_parent."' WHERE  id = ".$id_array[$i]."";
				//mysql_query($sql) or die("Not query sqlUPDATE_ORDER");
				
				$sql = "delete from table_city_item where id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=city&act=man_item");			
		}
		
		
	}
	
	
	#----------------------------------------------------------------------------------------
	if($_REQUEST['hienthi']!='')
	{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_city_item where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
		$sqlUPDATE_ORDER = "UPDATE table_city_item SET hienthi =1 WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
		$sqlUPDATE_ORDER = "UPDATE table_city_item SET hienthi =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}	
		redirect($duongdan);
	}
	
	$sql = "select * from #_city_item";
		
	if((int)@$_REQUEST['id_list']!='')
	{
	$sql.=" where  	id_list=".$_REQUEST['id_list']."";
	}
	if((int)@$_REQUEST['id_cat']!='')
	{
	$sql.=" and	id_cat=".$_REQUEST['id_cat']."";
	}
	
	
	
	if(@$_REQUEST['keyword']!='')
	{
	$keyword=addslashes($_REQUEST['keyword']);
	$sql.=" where ten_vi LIKE '%$keyword%' or ten_en LIKE '%$keyword%' ";
	}
	
	$sql.=" order by stt";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=city&act=man_item";
	$maxR=20;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_loai(){
	global $d, $item,$duongdan;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", $duongdan);
	
	$sql = "select * from #_city_item where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", $duongdan);
	$item = $d->fetch_array();
}

function save_loai(){
	global $d,$duongdan;
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", $duongdan);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){		
		if($photo = upload_image("file", 'jpg|png|gif|jpeg|JPG|JPEG|PNG|GIF', _upload_city,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], 165,179, _upload_city,$file_name,2);		
			$d->setTable('city_item');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_city.$row['photo']);	
				delete_file(_upload_city.$row['thumb']);				
			}
		}
		$data['ten_vi'] = $_POST['ten_vi'];
		$data['ten_en'] = $_POST['ten_en'];
		$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);		
		$data['id_list'] = $_POST['id_list'];	
		$data['id_cat']= $_POST['id_cat'];			
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
		
		$d->setTable('city_item');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=city&act=man_item&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Cập nhật dữ liệu bị lỗi","index.php?com=city&act=man_item&curPage=".$_REQUEST['curPage']."");
	}else{	
		if($photo = upload_image("file", 'jpg|png|gif|jpeg|JPG|JPEG|PNG|GIF', _upload_city,$file_name)){
			$data['photo'] = $photo;		
			$data['thumb'] = create_thumb($data['photo'], 165,179, _upload_city,$file_name,2);		
		}		
		$data['id_list'] = $_POST['id_list'];
		$data['id_cat']= $_POST['id_cat'];	
		$data['ten_vi'] = $_POST['ten_vi'];
		$data['ten_en'] = $_POST['ten_en'];
		$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		$d->setTable('city_item');
		if($d->insert($data))
			redirect("index.php?com=city&act=man_item&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=city&act=man_item&curPage=".$_REQUEST['curPage']."");
	}
}

function delete_loai(){
	global $d,$duongdan;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,thumb, photo from #_city_item where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_city.$row['photo']);
				delete_file(_upload_city.$row['thumb']);			
			}
		$sql = "delete from #_city_item where id='".$id."'";
		$d->query($sql);
		}
		if($d->query($sql))
			redirect($duongdan);
		else
			transfer("Xóa dữ liệu bị lỗi", $duongdan);
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id, photo,thumb from #_city_item where id='".$id."'";
			$d->query($sql);
		
			while($row = $d->fetch_array()){
				delete_file(_upload_city.$row['photo']);
				delete_file(_upload_city.$row['thumb']);
			}
			$sql = "delete from #_city_item where id='".$id."'";
			$d->query($sql);
			
		} 
		redirect($duongdan);
		
	} else transfer("Không nhận được dữ liệu", $duongdan);
		
}


#==================CAP 3==================
function get_subs(){
	global $d, $items, $paging,$duongdan;
	
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['chonxoa'];
		
		//$id_array = explode(",",$_GET['listid']);
		
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_city_sub SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=city&act=man_sub");			
		}
		
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
		//echo($id_array[$i]);
		//die();
				$sql = "UPDATE table_city_sub SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=city&act=man_sub");			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){
				$sql="SELECT * FROM table_city_sub where id='".$id_array[$i]."'";
				$d->query($sql);
				$cats= $d->fetch_array();
				//$id_parent=$cats['id'];
				
				//$sql = "UPDATE table_city_list SET id = '".$id_parent."' WHERE  id = ".$id_array[$i]."";
				//mysql_query($sql) or die("Not query sqlUPDATE_ORDER");
				
				$sql = "delete from table_city_sub where id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=city&act=man_sub");			
		}
		
		
	}
	
	
	#----------------------------------------------------------------------------------------
	if($_REQUEST['hienthi']!='')
	{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_city_sub where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
		$sqlUPDATE_ORDER = "UPDATE table_city_sub SET hienthi =1 WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
		$sqlUPDATE_ORDER = "UPDATE table_city_sub SET hienthi =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}	
		redirect($duongdan);
	}
	
	$sql = "select * from #_city_sub";
		
	if((int)@$_REQUEST['id_list']!='')
	{
	$sql.=" where  	id_list=".$_REQUEST['id_list']."";
	}
	if((int)@$_REQUEST['id_cat']!='')
	{
	$sql.=" and	id_cat=".$_REQUEST['id_cat']."";
	}
	if((int)@$_REQUEST['id_item']!='')
	{
	$sql.=" and	id_item=".$_REQUEST['id_item']."";
	}
	
	
	
	if(@$_REQUEST['keyword']!='')
	{
	$keyword=addslashes($_REQUEST['keyword']);
	$sql.=" where ten_vi LIKE '%$keyword%' or ten_en LIKE '%$keyword%' ";
	}
	
	$sql.=" order by stt";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=city&act=man_sub";
	$maxR=20;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_sub(){
	global $d, $item,$duongdan;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", $duongdan);
	
	$sql = "select * from #_city_sub where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", $duongdan);
	$item = $d->fetch_array();
}

function save_sub(){
	global $d,$duongdan;
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", $duongdan);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){		
		if($photo = upload_image("file", 'jpg|png|gif|jpeg|JPG|JPEG|PNG|GIF', _upload_city,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], 165,179, _upload_city,$file_name,2);		
			$d->setTable('city_sub');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_city.$row['photo']);	
				delete_file(_upload_city.$row['thumb']);				
			}
		}
		$data['ten_vi'] = $_POST['ten_vi'];
		$data['ten_en'] = $_POST['ten_en'];
		$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);		
		$data['id_list'] = $_POST['id_list'];	
		$data['id_cat']= $_POST['id_cat'];	
		$data['id_item']= $_POST['id_item'];	
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
		
		$d->setTable('city_sub');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=city&act=man_sub&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Cập nhật dữ liệu bị lỗi","index.php?com=city&act=man_sub&curPage=".$_REQUEST['curPage']."");
	}else{	
		if($photo = upload_image("file", 'jpg|png|gif|jpeg|JPG|JPEG|PNG|GIF', _upload_city,$file_name)){
			$data['photo'] = $photo;		
			$data['thumb'] = create_thumb($data['photo'], 165,179, _upload_city,$file_name,2);		
		}		
		$data['id_list'] = $_POST['id_list'];
		$data['id_cat']= $_POST['id_cat'];	
		$data['id_item']= $_POST['id_item'];	
		$data['ten_vi'] = $_POST['ten_vi'];
		$data['ten_en'] = $_POST['ten_en'];
		$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		$d->setTable('city_sub');
		if($d->insert($data))
			redirect("index.php?com=city&act=man_sub&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=city&act=man_sub&curPage=".$_REQUEST['curPage']."");
	}
}

function delete_sub(){
	global $d,$duongdan;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,thumb, photo from #_city_sub where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_city.$row['photo']);
				delete_file(_upload_city.$row['thumb']);			
			}
		$sql = "delete from #_city_sub where id='".$id."'";
		$d->query($sql);
		}
		if($d->query($sql))
			redirect($duongdan);
		else
			transfer("Xóa dữ liệu bị lỗi", $duongdan);
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id, photo,thumb from #_city_sub where id='".$id."'";
			$d->query($sql);
		
			while($row = $d->fetch_array()){
				delete_file(_upload_city.$row['photo']);
				delete_file(_upload_city.$row['thumb']);
			}
			$sql = "delete from #_city_sub where id='".$id."'";
			$d->query($sql);
			
		} 
		redirect($duongdan);
		
	} else transfer("Không nhận được dữ liệu", $duongdan);
		
}


#==================SANPHAM==================
function get_items(){
	global $d, $items, $paging,$urldanhmuc,$duongdan;
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['spbc']!='')
	{
		$id_up = $_REQUEST['spbc'];
		$sql_sp = "SELECT id,spbc FROM table_city where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$time=time();
		$hienthi=$cats[0]['spbc'];
		if($hienthi==0)
		{
		$sqlUPDATE_ORDER = "UPDATE table_city SET spbc ='$time' WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
		$sqlUPDATE_ORDER = "UPDATE table_city SET spbc =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		redirect($duongdan);
	}
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['noibat']!='')
	{
		$id_up = $_REQUEST['noibat'];
		$sql_sp = "SELECT id,noibat FROM table_city where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$time=time();
		$hienthi=$cats[0]['noibat'];
		if($hienthi==0)
		{
		$sqlUPDATE_ORDER = "UPDATE table_city SET noibat ='$time' WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
		$sqlUPDATE_ORDER = "UPDATE table_city SET noibat =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}	
		redirect($duongdan);
	}
	#-------------------------------------------------------------------------------
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['tieubieu']!='')
	{
		$id_up = $_REQUEST['tieubieu'];
		$sql_sp = "SELECT id,tieubieu FROM table_city where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$time=time();
		$hienthi=$cats[0]['tieubieu'];
		if($hienthi==0)
		{
		$sqlUPDATE_ORDER = "UPDATE table_city SET tieubieu ='$time' WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
		$sqlUPDATE_ORDER = "UPDATE table_city SET tieubieu =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}	
		redirect($duongdan);
	}
	#-------------------------------------------------------------------------------
	
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['hienthi']!='')
	{
		$id_up = @$_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_city where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
		$sqlUPDATE_ORDER = "UPDATE table_city SET hienthi =1 WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
		$sqlUPDATE_ORDER = "UPDATE table_city SET hienthi =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		redirect($duongdan);	
	}
	#-------------------------------------------------------------------------------
	$sql = "select * from #_city";	
	if((int)@$_REQUEST['id_list']!='')
	{
	$sql.=" where  	id_list=".$_REQUEST['id_list']."";
	}
	if((int)@$_REQUEST['id_cat']!='')
	{
	$sql.=" and	id_cat=".$_REQUEST['id_cat']."";
	}
	if((int)@$_REQUEST['id_item']!='')
	{
	$sql.=" and	id_item=".$_REQUEST['id_item']."";
	}
	
	if(@$_REQUEST['keyword']!='')
	{
	$keyword=addslashes($_REQUEST['keyword']);
	$sql.=" where ten LIKE '%$keyword%'";
	}
	$sql.=" order by stt,id desc";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=city&act=man".$urldanhmuc;
	$maxR=20;
	$maxP=20;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_item(){
	global $d, $item,$ds_tags, $duongdan;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", $duongdan);	
	$sql = "select * from #_city where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", $duongdan);
	$item = $d->fetch_array();	
}

function save_item(){
	global $d,$duongdan;
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", $duongdan);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	
	if($id){
		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", 'jpg|png|gif|jpeg|JPG|JPEG|GIF|PNG', _upload_city,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'],286,286, _upload_city,$file_name,2);		
			$d->setTable('city');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_city.$row['photo']);	
				delete_file(_upload_city.$row['thumb']);				
			}
		}					 	
		$data['id_list'] = (int)$_POST['id_list'];		
		$data['id_khuvuc'] = (int)$_POST['id_khuvuc'];		
		$data['id_cat'] = (int)$_POST['id_cat'];	
		$data['id_item'] = (int)$_POST['id_item'];		
		$data['ten_vi'] = $_POST['ten_vi'];	
		$data['ten_en'] = $_POST['ten_en'];	
		$data['masp'] = $_POST['masp'];	
		$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);	
		$data['keyword'] = $_POST['keyword'];	
		$data['gia'] = (int)$_POST['gia'];		
		$data['giakm'] = (int)$_POST['giakm'];
		$data['phantram'] = (int)$_POST['phantram'];
		$data['damua'] = (int)$_POST['damua'];
		
		$thoigian = $_POST['thoigian'];
		$data['thoigian'] = strtotime($thoigian);
		
		$data['loai'] = $_POST['loai'];
		$data['noiapdung'] = implode(",",$_POST['noiapdung']);
		$data['diadiem'] = magic_quote($_POST['diadiem']);
		$data['toado'] = $_POST['toado'];					
		$data['mota'] = magic_quote($_POST['mota']);			
		$data['noidung'] = magic_quote($_POST['noidung']);
		$data['diemnoibat'] = magic_quote($_POST['diemnoibat']);
		$data['dieukien'] = magic_quote($_POST['dieukien']);										
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = timedatecurrent();
		$d->setTable('city');
		$d->setWhere('id', $id);
		if($d->update($data)){
			if(isset($_POST['linkduongdan'])){
				redirect($_POST['linkduongdan']);
			}else{
				redirect("index.php?com=city&act=man&curPage=".$_REQUEST['curPage']."");
			}
		}
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=city&act=man&curPage=".$_REQUEST['curPage']."");
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|jpeg|JPG|JPEG|GIF|PNG', _upload_city,$file_name)){
			$data['photo'] = $photo;		
			$data['thumb'] = create_thumb($data['photo'], 286,286, _upload_city,$file_name,2);		
		}		
		
		$data['id_list'] = (int)$_POST['id_list'];			
		$data['id_khuvuc'] = (int)$_POST['id_khuvuc'];			
		$data['id_cat'] = (int)$_POST['id_cat'];	
		$data['id_item'] = (int)$_POST['id_item'];		
		
		$data['ten_vi'] = $_POST['ten_vi'];	
		$data['ten_en'] = $_POST['ten_en'];	
		$data['keyword'] = $_POST['keyword'];	
		$data['masp'] = $_POST['masp'];	
		$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);	
		$data['gia'] = (int)$_POST['gia'];			
		$data['giakm'] = (int)$_POST['giakm'];
		$data['phantram'] = (int)$_POST['phantram'];
		$data['loai'] = $_POST['loai'];
		$data['noiapdung'] = implode(",",$_POST['noiapdung']);
		$data['diadiem'] = magic_quote($_POST['diadiem']);
		$data['toado'] = $_POST['toado'];
		$data['damua'] = (int)$_POST['damua'];
		
		
		$thoigian = $_POST['thoigian'];
		$data['thoigian'] = strtotime($thoigian);	
					
		$data['mota'] = magic_quote($_POST['mota']);			
		$data['noidung'] = magic_quote($_POST['noidung']);
		$data['diemnoibat'] = magic_quote($_POST['diemnoibat']);
		$data['dieukien'] = magic_quote($_POST['dieukien']);		
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		
		$data['ngaytao'] = timedatecurrent();
		$d->setTable('city');
		if($d->insert($data))
		{			
			redirect("index.php?com=city&act=man&curPage=".$_REQUEST['curPage']."");
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=city&act=man&curPage=".$_REQUEST['curPage']."");
	}
}

function delete_item(){
	global $d,$duongdan;

	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,thumb, photo from #_city where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_city.$row['photo']);
				delete_file(_upload_city.$row['thumb']);			
			}
		$sql = "delete from #_city where id='".$id."'";
		$d->query($sql);
		}
		if($d->query($sql))
			redirect($duongdan);
		else
			transfer("Xóa dữ liệu bị lỗi", $duongdan);
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id, photo,thumb from #_city where id='".$id."'";
			$d->query($sql);
		
			while($row = $d->fetch_array()){
				delete_file(_upload_city.$row['photo']);
				delete_file(_upload_city.$row['thumb']);
			}
			$sql = "delete from #_city where id='".$id."'";
			$d->query($sql);
			
		} 
		redirect($duongdan);
		
	} else transfer("Không nhận được dữ liệu", $duongdan);
		
}





#=================QUỐC GIA===================
function get_danhmucs(){
	global $d, $items, $paging,$duongdan ,$url_link,$totalRows , $pageSize, $offset;
	
	
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['chonxoa'];
		
		//$id_array = explode(",",$_GET['listid']);
		
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_city_danhmuc SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=city&act=man_danhmuc");			
		}
		
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
		//echo($id_array[$i]);
		//die();
				$sql = "UPDATE table_city_danhmuc SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=city&act=man_danhmuc");			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){
				$sql="SELECT * FROM table_city_danhmuc where id='".$id_array[$i]."'";
				$d->query($sql);
				$cats= $d->fetch_array();
				//$id_parent=$cats['id'];
				
				//$sql = "UPDATE table_city_danhmuc SET id = '".$id_parent."' WHERE  id = ".$id_array[$i]."";
				//mysql_query($sql) or die("Not query sqlUPDATE_ORDER");
				
				$sql = "delete from table_city_danhmuc where id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=city&act=man_danhmuc");			
		}
		
		
	}
	
	
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['noibat']!='')
	{
		$id_up = $_REQUEST['noibat'];
		$sql_sp = "SELECT id,noibat FROM table_city_danhmuc where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$time=time();
		$hienthi=$cats[0]['noibat'];
		if($hienthi==0)
		{
		$sqlUPDATE_ORDER = "UPDATE table_city_danhmuc SET noibat ='$time' WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
		$sqlUPDATE_ORDER = "UPDATE table_city_danhmuc SET noibat =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}	
		redirect($duongdan);
	}
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['hienthi']!='')
	{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_city_danhmuc where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
		$sqlUPDATE_ORDER = "UPDATE table_city_danhmuc SET hienthi =1 WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
		$sqlUPDATE_ORDER = "UPDATE table_city_danhmuc SET hienthi =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}	
		redirect($duongdan);
	}
	
	//$sql = "select * from #_city_danhmuc";	
	
	
	if(@$_REQUEST['keyword']!='')
	{
	$keyword=addslashes($_REQUEST['keyword']);
	$where.=" and ten_vi LIKE '%$keyword%' or ten_en LIKE '%$keyword%' ";
	}
		
	
	$sql="SELECT count(id) AS numrows FROM #_city_danhmuc where id  $where ";
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
	
	$sql = "select * from #_city_danhmuc where  id $where order by stt,id desc limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();		
	$url_link="index.php?com=city&act=man_danhmuc";
}

function get_danhmuc(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", $duongdan);	
	$sql = "select * from #_city_danhmuc where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", $duongdan);
	$item = $d->fetch_array();	
}

function save_danhmuc(){
	global $d,$duongdan;
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", $duongdan);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		if($photo = upload_image("file", 'jpg|png|gif|jpeg|JPG|JPEG|PNG|GIF', _upload_city,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], 210, 170, _upload_city,$file_name,2);		
			$d->setTable('city');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_city.$row['photo']);	
				delete_file(_upload_city.$row['thumb']);				
			}
		}							
		$data['ten_vi'] = $_POST['ten_vi'];
		$data['ten_en'] = $_POST['ten_en'];
		$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
		
		$d->setTable('city_danhmuc');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=city&act=man_danhmuc&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Cập nhật dữ liệu bị lỗi","index.php?com=city&act=man_danhmuc&curPage=".$_REQUEST['curPage']."");
	}else{	
		if($photo = upload_image("file", 'jpg|png|gif|jpeg|JPG|JPEG|PNG|GIF', _upload_city,$file_name)){
			$data['photo'] = $photo;		
			$data['thumb'] = create_thumb($data['photo'], 210, 170, _upload_city,$file_name,2);		
		}			
		$data['ten_vi'] = $_POST['ten_vi'];
		$data['ten_en'] = $_POST['ten_en'];
		$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		$d->setTable('city_danhmuc');
		if($d->insert($data))
			redirect("index.php?com=city&act=man_danhmuc&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Lưu dữ liệu bị lỗi","index.php?com=city&act=man_danhmuc&curPage=".$_REQUEST['curPage']."");
	}
}
function delete_danhmuc(){
	global $d,$duongdan;

	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,thumb, photo from #_city_danhmuc where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_city.$row['photo']);
				delete_file(_upload_city.$row['thumb']);			
			}
		$sql = "delete from #_city_danhmuc where id='".$id."'";
		$d->query($sql);
		}
		if($d->query($sql))
			redirect($duongdan);
		else
			transfer("Xóa dữ liệu bị lỗi", $duongdan);
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id, photo,thumb from #_city_danhmuc where id='".$id."'";
			$d->query($sql);
		
			while($row = $d->fetch_array()){
				delete_file(_upload_city.$row['photo']);
				delete_file(_upload_city.$row['thumb']);
			}
			$sql = "delete from #_city_danhmuc where id='".$id."'";
			$d->query($sql);
			
		} 
		redirect($duongdan);
		
	} else transfer("Không nhận được dữ liệu", $duongdan);
		
}



?>