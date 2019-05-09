<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$url_back=$_SERVER['HTTP_REFERER'];
switch($act){
	case "login":
		if(!empty($_POST)) login();
		$template = "user/login";
		break;
	case "admin_edit":
		edit();
		$template = "user/admin_add";
		break;
	case "logout":
		logout();
		break;	
	case "man":
		get_items();
		$template = "user/items";
		break;
	case "add":
		$template = "user/item_add";
		break;
	case "edit":
		get_item();
		$template = "user/item_add";
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

//////////////////
function get_items(){
	global $d, $items, $paging,$url_back , $url_link,$totalRows , $pageSize, $offset;
	
	/*$sql = "select * from #_user where role=1 order by username";
	$d->query($sql);
	$items = $d->result_array();*/
	
	/*$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=user&act=man";
	$maxR=10;
	$maxP=4;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];*/
	
	
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['chon'];
		
		
		
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_user SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=user&act=man");			
		}
		
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){

				$sql = "UPDATE table_user SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=user&act=man");			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){
				$sql="SELECT * FROM table_user where id='".$id_array[$i]."'";
				$d->query($sql);
				$cats= $d->fetch_array();
			
				$sql = "delete from table_user where id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=user&act=man");			
		}
		
		
	}
	
	
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['hienthi']!='')
	{
	$id_up = @$_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_user where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_user SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_user SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	redirect($url_back);
	}
	#---
	
	
		
	$sql="SELECT count(id) AS numrows FROM #_user where role!=3 and com='user' order by stt,id desc";
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
	
	$sql = "select * from #_user where role!=3 and com='user' order by stt,id desc limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link='index.php?com=user&act=man';	
	
}

function get_item(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=user&act=man");
	
	$sql = "select * from #_user where id='".$id."' ";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=user&act=man");
	$item = $d->fetch_array();
}

function save_item(){
	global $d;
	
	if (empty($_POST))
        transfer("Không nhận được dữ liệu", "index.php?com=user&act=man");
    $id = isset($_POST['id']) ? themdau($_POST['id']) : "";
    if ($id) { // cap nhat
        $id = themdau($_POST['id']);

        // kiem tra
        /* $d->reset();
        $d->setTable('user');
        $d->setWhere('id', $id);
        $d->select();
        if ($d->num_rows() > 0) {
            $row = $d->fetch_array();
            if ($row['role'] != 1)
                transfer("Bạn không có quyền trên tài khoản này.<br>Mọi thắc mắc xin liên hệ quản trị website.", "index.php?com=user&act=man");
        } */

        // kiem tra ten trung
        $d->reset();
        $d->setTable('user');
        $d->setWhere('id', $id);
        $d->select();
		$row_u=$d->fetch_array();
		
		if($row_u["username"]!=$_POST["username"]){
			
			$d->reset();
			$d->setTable('user');
			$d->setWhere('username', $_POST['username']);
			$d->select();
			if ($d->num_rows() > 0)
				transfer("Tên dăng nhập nay đã có.<br>Xin chọn tên khác.", "index.php?com=user&act=edit&id=" . $id);
		}
        


        $data['username'] = $_POST['username'];
        if ($_POST['oldpassword'] != "")
            $data['password'] = md5($_POST['oldpassword']);
        $data['email'] = $_POST['email'];
		$data['old_pass'] = $_POST['oldpassword'];
        $data['hoten'] = $_POST['hoten'];
        $data['sex'] = $_POST['sex'];
        $data['dienthoai'] = $_POST['dienthoai'];
        $data['nick_yahoo'] = $_POST['nick_yahoo'];
        $data['nick_skype'] = $_POST['nick_skype'];
        $data['diachi'] = $_POST['diachi'];
        $data['congty'] = $_POST['congty'];
        $data['country'] = $_POST['country'];
        $data['city'] = $_POST['city'];
		$data['role'] = $_POST['role'];
		
		$data['hienthi'] = $_POST['hienthi'];
		$data['stt'] = $_POST['stt'];
		
		

        $d->reset();
        $d->setTable('user');
        $d->setWhere('id', $id);
        if ($d->update($data))
            transfer("Dữ liệu đã được cập nhật", "index.php?com=user&act=man");
        else
            transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=user&act=man");
    }else { // them moi
        // kiem tra ten trung
        $d->reset();
        $d->setTable('user');
        $d->setWhere('username', $_POST['username']);
        $d->select();
        if ($d->num_rows() > 0)
            transfer("Tên dăng nhập nay đã có.<br>Xin chọn tên khác.", "index.php?com=user&act=edit&id=" . $id);

        if ($_POST['oldpassword'] == "")
            transfer("Chưa nhập mật khẩu", "index.php?com=user&act=add");

        $data['username'] = $_POST['username'];
        $data['password'] = md5($_POST['oldpassword']);
		$data['old_pass'] = ($_POST['oldpassword']);
        $data['email'] = $_POST['email'];
        $data['hoten'] = $_POST['hoten'];
        $data['sex'] = $_POST['sex'];
        $data['dienthoai'] = $_POST['dienthoai'];
        $data['nick_yahoo'] = $_POST['nick_yahoo'];
        $data['nick_skype'] = $_POST['nick_skype'];
        $data['diachi'] = $_POST['diachi'];
        $data['congty'] = $_POST['congty'];
        $data['country'] = $_POST['country'];
        $data['city'] = $_POST['city'];
        $data['role'] = $_POST['role'];
		
				$data['hienthi'] = $_POST['hienthi'];
		$data['stt'] = $_POST['stt'];
		
        $data['com'] = "user";

        $d->setTable('user');
        if ($d->insert($data))
            transfer("Dữ liệu đã được lưu", "index.php?com=user&act=man");
        else
            transfer("Lưu dữ liệu bị lỗi", "index.php?com=user&act=man");
    }
}

function delete_item(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		
		// kiem tra
		$d->reset();
		$d->setTable('user');
		$d->setWhere('id', $id);
		$d->select();
		if($d->num_rows()>0){
			$row = $d->fetch_array();
			if($row['role'] != 1) transfer("Bạn không có quyền trên tài khoản này.<br>Mọi thắc mắc xin liên hệ quản trị website.", "index.php?com=user&act=man");
		}
		
		// xoa item
		$sql = "delete from #_user where id='".$id."'";
		if($d->query($sql))
			transfer("Dữ liệu đã được xóa", "index.php?com=user&act=man");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=user&act=man");
	}else transfer("Không nhận được dữ liệu", "index.php?com=user&act=man");
}


///////////////////////
/*function edit(){
	global $d, $item, $login_name;
	
	if(!empty($_POST)){
		$sql = "select * from #_user where username!='".$_SESSION['login']['username']."' and username='".$_POST['username']."' and role=3";
		$d->query($sql);
		if($d->num_rows() > 0) transfer("Tên đăng nhập này đã có","index.php?com=user&act=edit");
		
		$sql = "select * from #_user where username='".$_SESSION['login']['username']."'";
		$d->query($sql);
		if($d->num_rows() == 1){
			$row = $d->fetch_array();
			if($row['password'] != md5($_POST['oldpassword'])) transfer("Mật khẩu không chính xác","index.php?com=user&act=admin_edit");
		}else{
			die('Hệ thống bị lỗi. Xin liên hệ với admin. <br>Cám ơn.');
		}
		
		$data['username'] = $_POST['username'];
		if($_POST['new_pass']!="") 
			$data['password'] = md5($_POST['new_pass']);
		$data['hoten'] = $_POST['hoten'];
		$data['email'] = $_POST['email'];
		$data['nick_yahoo'] = $_POST['nick_yahoo'];
		$data['nick_skype'] = $_POST['nick_skype'];
		$data['dienthoai'] = $_POST['dienthoai'];
		
		$d->reset();
		$d->setTable('user');
		$d->setWhere('username', $_SESSION['login_admin']['username']);
		if($d->update($data)){
			session_unset();
			transfer("Dữ liệu đã được lưu.","index.php");
		}
	}
	
	$sql = "select * from #_user where username='".$_SESSION['login_admin']['username']."'";
	$d->query($sql);
	if($d->num_rows() == 1){
		$item = $d->fetch_array();
	}
}*/

function edit(){
	global $d, $item, $login_name;
	if(!empty($_POST)){
		$sql = "select * from #_user where username='".$_SESSION['login_admin']['username']."'";
		$d->query($sql);
		if($d->num_rows() == 1){
			$row = $d->fetch_array();
			if($row['password'] != md5($_POST['oldpassword'])) transfer("Mật khẩu không chính xác","index.php?com=user&act=admin_edit");
		}else{
			die('Hệ thống bị lỗi. Xin liên hệ với admin. <br>Cám ơn.');
		}
		if($_POST['new_pass']!="") 
			$data['password'] = md5($_POST['new_pass']);
			
		$data['username'] = $_POST['username'];	
		$data['hoten'] = $_POST['hoten'];
		$data['email'] = $_POST['email'];
		$data['dienthoai'] = $_POST['dienthoai'];
		
		$d->reset();
		$d->setTable('user');
		$d->setWhere('username', $_SESSION['login_admin']['username']);
		if($d->update($data)){
			session_unset();
			transfer("Dữ liệu đã được lưu.","index.php?com=user&act=admin_edit");
		}
	}
	
	$sql = "select * from #_user where username='".$_SESSION['login_admin']['username']."'";
	$d->query($sql);
	if($d->num_rows() == 1){
		$item = $d->fetch_array();
	}
}
	
function login(){
	global $d, $login_name;
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$sql = "select * from #_user where com='user' and username='".$username."'";
	$d->query($sql);
	if($d->num_rows() == 1){
		$row = $d->fetch_array();
		if(($row['password'] == md5($password)) /*&& ($row['role'] == 1)*/){
			$_SESSION[$login_name] = true;
			$_SESSION['isLoggedIn'] = true;
			$_SESSION['login_admin']['username'] = $username;
			$_SESSION['login_admin']['role'] = $row["role"];
			$_SESSION['login_admin']['id'] = $row["id"];
			transfer("Đăng nhập thành công","index.php");
		}
	}
	transfer("Tên đăng nhập, mật khẩu không chính xác", "index.php?com=user&act=login");
}

function logout(){
	global $login_name;
	$_SESSION[$login_name] = false;
	unset($_SESSION["login_admin"]);
	transfer("Đăng xuất thành công", "index.php?com=user&act=login");
}
?>