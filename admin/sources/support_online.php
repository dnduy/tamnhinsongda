<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$urldanhmuc ="";
$urldanhmuc.= (isset($_REQUEST['typechild'])) ? "&typechild=".addslashes($_REQUEST['typechild']) : "";
$url_back=$_SERVER['HTTP_REFERER'];

switch($act){
	case "man":
		get_items();
		$template = "support_online/items";
		break;
	case "add":
		$template = "support_online/item_add";
		break;
	case "edit":
		get_item();
		$template = "support_online/item_add";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
		
	default:
		$template = "index";
}


function get_items(){



	global $d, $items, $urldanhmuc,  $url_back , $url_link,$totalRows , $pageSize, $offset;
	
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['iddel'];
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_support_online SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect($url_back);			
		}
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_support_online SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect($url_back);			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){							
				$sql = "delete from table_support_online where id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");			
							
			}
			redirect($url_back);			
		}				
	}
	
	if(@$_REQUEST['hienthi']!='')
	{
	$id_up = @$_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_support_online where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	//echo "id:". $spdc1;
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_support_online SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_support_online SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");

	}	
	}


	if(@$_REQUEST['typechild']!='')
	{
		$typeparenthild=addslashes($_REQUEST['typechild']);
		$sql.=" where com='$typechild'";
	}else{
		$sql.=" where com";
	}
	

	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%' ";
	}
	
	$sql="SELECT count(id) AS numrows FROM #_support_online where id $where";
	$d->query($sql);	
	$dem=$d->fetch_array();
	$totalRows=$dem['numrows'];
	$page=$_GET['p'];
	
	$pageSize=10;
	$offset=5;
						
	if ($page=="")
		$page=1;
	else 
		$page=$_GET['p'];
	$page--;
	$bg=$pageSize*$page;		
	
	$sql = "select * from #_support_online where id $where order by stt,id desc limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=support_online&act=man&typechild=$_GET[typechild]".$urldanhmuc;


}	

function get_item(){
	global $d, $item,$url_back;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=support_online&act=man");
	
	$sql = "select * from #_support_online where id='".$id."' and com='$_REQUEST[typechild]'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=support_online&act=man&typechild=$_GET[typechild]");
	$item = $d->fetch_array();
}

function save_item(){
	global $d,$url_back,$config;
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=support_online&act=man&typechild=$_GET[typechild]");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){ // cap nhat
		$id =  themdau($_POST['id']);



		foreach ($config["lang"] as $key => $value) {


			
			$data['ten_'.$value] = magic_quote($_POST['ten_'.$value]);
			

		}	
	

		$data['com'] = $_REQUEST['typechild'];
		$data['dienthoai'] = $_POST['dienthoai'];
		$data['email'] = $_POST['email'];
		$data['yahoo'] = $_POST['yahoo'];
		$data['skype'] = $_POST['skype'];
		$data['zalo'] = $_POST['zalo'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
		
		$d->setTable('support_online');
		$d->setWhere('id', $id);
		if($d->update($data))
			header("Location:index.php?com=support_online&act=man&typechild=$_GET[typechild]");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=support_online&act=man&typechild=$_GET[typechild]");
	}else{ // them moi



		foreach ($config["lang"] as $key => $value) {


			
			$data['ten_'.$value] = magic_quote($_POST['ten_'.$value]);
			

		}	
	

		$data['com'] = $_REQUEST['typechild'];
		$data['dienthoai'] = $_POST['dienthoai'];
		$data['email'] = $_POST['email'];
		$data['yahoo'] = $_POST['yahoo'];
		$data['skype'] = $_POST['skype'];
		$data['zalo'] = $_POST['zalo'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		$d->setTable('support_online');
		if($d->insert($data))
			redirect("index.php?com=support_online&act=man&typechild=$_GET[typechild]&curPage=".@$_REQUEST['curPage']."");
			//header("Location:index.php?com=support_online&act=man&typechild=$_GET[typechild]");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=support_online&act=man&typechild=$_GET[typechild]");
	}
}

function delete_item(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		
		
		// xoa item
		$sql = "delete from #_support_online where id='".$id."'";
		if($d->query($sql))
			header("Location:index.php?com=support_online&act=man&typechild=$_GET[typechild]");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=support_online&act=man&typechild=$_GET[typechild]");
	}else transfer("Không nhận được dữ liệu", "index.php?com=support_online&act=man&typechild=$_GET[typechild]");
}
#--------------------------------------------------------------------------------------------- photo
?>