<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$urldanhmuc ="";
$urldanhmuc.= (isset($_REQUEST['id_list'])) ? "&id_list=".addslashes($_REQUEST['id_list']) : "";
$urldanhmuc.= (isset($_REQUEST['id_cat'])) ? "&id_cat=".addslashes($_REQUEST['id_cat']) : "";
$urldanhmuc.= (isset($_REQUEST['id_item'])) ? "&id_item=".addslashes($_REQUEST['id_item']) : "";
$duongdan=$_SERVER['HTTP_REFERER'];
$url_back=$_SERVER['HTTP_REFERER'];
$id=@$_REQUEST['id'];
switch($act){

	case "man":
		get_items();
		$template = "users/items";
		break;
	case "add":		
		$template = "users/item_add";
		break;
	case "edit":		
		get_item();
		$template = "users/item_add";
		break;
	
	case "delete_img":
		delete_img();
		break;	
		
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
		
	case "capnhat_info":
		get_info();
		$template = "users/items";
		break;
		
	case "save_info":
		save_info();
		break;		
		
	#===================================================	
	
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
	global $d, $items, $paging,$urldanhmuc,$duongdan;
	
	
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['chon'];
		
		
		
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_user SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");	
				$_SESSION["login_member"]["active"]=1;	
			}
			redirect("index.php?com=users&act=man");			
		}
		
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){

				$sql = "UPDATE table_user SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");	
				$_SESSION["login_member"]["active"]=0;				
			}
			redirect("index.php?com=users&act=man");			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){
				$sql="SELECT * FROM table_user where id='".$id_array[$i]."'";
				$d->query($sql);
				$cats= $d->fetch_array();
			
				$sql = "delete from table_user where id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=users&act=man");			
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
		
		$_SESSION["login_member"]["active"]=1;

	
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_user SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		$_SESSION["login_member"]["active"]=0;
	}	
	redirect($duongdan);	
	}
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['daily']!='')
	{
	$id_up = @$_REQUEST['daily'];
	$sql_sp = "SELECT id,daily FROM table_user where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['daily'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_user SET daily =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_user SET daily =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	redirect($duongdan);	
	}
	#-------------------------------------------------------------------------------

	
	
	$sql = "select * from #_user where role='1' and com='member'";	
	
	if(@$_REQUEST['keyword']!='')
	{
	$keyword=addslashes($_REQUEST['keyword']);
	$sql.=" and ten LIKE '%$keyword%'";
	}
	
	
	
	
	if(@$_REQUEST['active_user']!=''){
		if($_REQUEST['active_user']==0)
			$sql.=" and hienthi = '0' ";
		else $sql.=" and hienthi > '0' ";
	}
	
	$sql.=" order by id desc";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=users&act=man".$urldanhmuc;
	$maxR=20;
	$maxP=20;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
	


	
}

function get_item(){
	global $d, $item,$ds_tags, $city,$district;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=users&act=man");	
	$sql = "select * from #_user where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=users&act=man");
	$item = $d->fetch_array();
	
	
	$d->reset();
	$sql = "select ten_vi,id from table_city_list where id=".$item['tinh'];
	$d->query($sql); 
	$city = $d->fetch_array(); 
	
	$d->reset();
	$sql = "select ten_vi,id from table_city_cat where id=".$item['huyen'];
	$d->query($sql);
	$district = $d->fetch_array();
	
	
	$d->reset();
	$sql = "select ten_vi,id from table_city_item where id=".$item['phuongxa'];
	$d->query($sql);
	$phuongxa = $d->fetch_array();
	
}

function save_item(){
	global $d;
	$file_name=fns_Rand_digit(0,9,12);
	$file_name1=fns_Rand_digit(0,9,11);
	$mastv = fns_Rand_digit(0,5,5);
	$maso = ChuoiNgauNhien(20);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=users&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	
	if($id){
		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_users,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], 208,106, _upload_users,$file_name,2);		
			$d->setTable('user');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_users.$row['photo']);	
				delete_file(_upload_users.$row['thumb']);				
			}
		}
		if($photo1 = upload_image("file1", 'mp4|flv|avi|wmv|MP4|FLV|AVI|WMV', _upload_users,$file_name1)){
			$data['video'] = $photo1;	
			
			$d->setTable('user');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_users.$row['video']);	
				
			}
		}			
		
		
		// kiem tra ten trung
		$d->reset();
		$sql="select id from #_user where email='".$_POST['email']."' and com='member' and id <> $id";
		$d->query($sql);
		if($d->num_rows()>0) transfer("Email này đã có.<br>Xin chọn tên khác.", "index.php?com=users&act=edit&id=".$id);
		
		
		$data['cmnd'] = $_POST['cmnd'];
		$data['loaithecao'] = $_POST['loaithecao'];
		$data['nganhang'] = $_POST['nganhang'];
		$data['sotaikhoan'] = $_POST['sotaikhoan'];
		$data['tienmat'] = $_POST['tienmat'];				
		$data['diemthuong'] = $_POST['diemthuong'];	
		
		$data['tiencoccosan'] = $_POST['tiencoccosan'];	
		$data['tiencoccho'] = $_POST['tiencoccho'];
	
		


		$data['email'] = ($_POST['email']);
		$data['hoten'] = ($_POST['hoten']);
		$data['dienthoai'] = ($_POST['dienthoai']);
		$data['bidanh'] = ($_POST['bidanh']);
		$data['tinh'] = ($_POST['id_tinh']);
		$data['huyen'] = ($_POST['id_huyen']);
		$data['phuongxa'] = ($_POST['id_phuong']);
		$data['khuvucsinhsong'] = ($_POST['khuvucsinhsong']);
		$data['dienthoaicodinh'] = ($_POST['dienthoaicodinh']);
		$data['dienthoai'] = ($_POST['dienthoai']);
		$data['nick_yahoo'] = ($_POST['nick_yahoo']);
		$data['nick_skype'] = ($_POST['nick_skype']);
		$data['gioithieu'] = ($_POST['gioithieu']);
		$data['loaitaikhoan'] = ($_POST['typeaccount']);
		$data['loaitaikhoan'] = ($_POST['typeaccount']);
		
		$data['sex'] = ($_POST['gender']);
		
		$data['hoahong'] = ($_POST['hoahong']);
	

		$ngaysinh = $_POST['ngaysinh'];
		$Ngay_arr = explode("/",$ngaysinh); // array(17,11,2010)
		$Ngay_arr = explode("/",$ngaysinh); // array(17,11,2010)
		if (count($Ngay_arr)==3) {
		$ngay = $Ngay_arr[0]; //17
		$thang = $Ngay_arr[1]; //11
		$nam = $Ngay_arr[2]; //2010
		if (checkdate($thang,$ngay,$nam)==false){ $coloi=true; $error_ngaysinh = "Bạn nhập chưa đúng ngày sinh<br>";} else $ngaysinh=$nam."-".$thang."-".$ngay;
		}	
		$data['ngaysinh'] = strtotime($ngaysinh);
		
		
		$data['ngaydangky'] = time();
		$data['role'] = 1;		
		$data['com'] = "member";	
		
		$d->reset();
        $sql = "select stt from #_user where role=1 and com='member' order by stt desc limit 0,1";
        $d->query($sql);
        $stt_user = $d->fetch_array();
		
		$data['stt'] = $stt_user['stt'] + 1;
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$d->setTable('user');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=users&act=man&curPage=".@$_REQUEST['curPage']."");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=users&act=man");
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_users,$file_name)){
			$data['photo'] = $photo;		
			$data['thumb'] = create_thumb($data['photo'], 208,106, _upload_users,$file_name,2);		
		}
		if($photo1 = upload_image("file1", 'mp4|flv|avi|wmv|MP4|FLV|AVI|WMV', _upload_users,$file_name1)){
			$data['video'] = $photo1;				
		}		
		
	// kiem tra email trung
		$d->reset();
		$d->setTable('user');
		$d->setWhere('email', $_POST['email']);
		$d->select();
		if($d->num_rows()>0) transfer("Email này đã có.<br>Xin chọn email khác.", "index.php?com=users&act=add");
			
		
		$data['cmnd'] = $_POST['cmnd'];
		
		$data['user'] = $maso;
		$data['mauser'] = $mastv;	
		
		$data['loaithecao'] = $_POST['loaithecao'];
		
		$data['password'] = md5($_REQUEST['pass']);
		$data['old_pass'] = ($_POST['pass']);
		
		$data['email'] = ($_POST['email']);
		$data['hoten'] = ($_POST['hoten']);
		$data['dienthoai'] = ($_POST['dienthoai']);
		$data['bidanh'] = ($_POST['bidanh']);
		$data['tinh'] = ($_POST['id_tinh']);
		$data['huyen'] = ($_POST['id_huyen']);
		$data['phuongxa'] = ($_POST['id_phuong']);
		$data['khuvucsinhsong'] = ($_POST['khuvucsinhsong']);
		$data['dienthoaicodinh'] = ($_POST['dienthoaicodinh']);
		$data['dienthoai'] = ($_POST['dienthoai']);
		$data['nick_yahoo'] = ($_POST['nick_yahoo']);
		$data['nick_skype'] = ($_POST['nick_skype']);
		$data['gioithieu'] = ($_POST['gioithieu']);
		$data['loaitaikhoan'] = ($_POST['typeaccount']);
		$data['loaitaikhoan'] = ($_POST['typeaccount']);
		
		$data['sex'] = ($_POST['gender']);
		
		$data['tiencoccosan'] = $_POST['tiencoccosan'];	
		$data['tiencoccho'] = $_POST['tiencoccho'];
		
		
		$data['hoahong'] = ($_POST['hoahong']);
		
		
		$data['nganhang'] = $_POST['nganhang'];
		$data['sotaikhoan'] = $_POST['sotaikhoan'];
		
		$ngaysinh = $_POST['ngaysinh'];
		$Ngay_arr = explode("/",$ngaysinh); // array(17,11,2010)
	$Ngay_arr = explode("/",$ngaysinh); // array(17,11,2010)
	if (count($Ngay_arr)==3) {
		$ngay = $Ngay_arr[0]; //17
		$thang = $Ngay_arr[1]; //11
		$nam = $Ngay_arr[2]; //2010
		if (checkdate($thang,$ngay,$nam)==false){ $coloi=true; $error_ngaysinh = "Bạn nhập chưa đúng ngày sinh<br>";} else $ngaysinh=$nam."-".$thang."-".$ngay;
	}	
		$data['ngaysinh'] = strtotime($ngaysinh);
		
		$data['tienmat'] = $_POST['tienmat'];				
		$data['diemthuong'] = $_POST['diemthuong'];	
		$data['ngaydangky'] = time();
		
		$data['role'] = 1;
		$data['com'] = "member";						

		
		
		$d->reset();
        $sql = "select stt from #_user where role=1 and com='member' order by stt desc limit 0,1";
        $d->query($sql);
        $stt_user = $d->fetch_array();
		
		$data['stt'] = $stt_user['stt'] + 1;
		
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		$d->setTable('user');
		if($d->insert($data))
		{			
			redirect("index.php?com=users&act=man");
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=users&act=man");
	}
}

function delete_item(){
	global $d,$duongdan;
	if($_REQUEST['id_cat']!='')
	{ $id_catt="&id_cat=".$_REQUEST['id_cat'];
	}
	if($_REQUEST['curPage']!='')
	{ $id_catt.="&curPage=".$_REQUEST['curPage'];
	}
	
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		
		$sql = "delete from #_user where id='".$id."'";
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
			$sql = "delete from #_user where id='".$id."'";
			$d->query($sql);
			
		} 
		redirect($duongdan);
		
	} else transfer("Không nhận được dữ liệu", $duongdan);
}


function delete_img(){
	global $d;		
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,thumb, photo from #_user where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_users.$row['photo']);
				delete_file(_upload_users.$row['thumb']);			
			}
		$sql = "UPDATE #_user SET photo ='',thumb='' WHERE  id = '".$id."'";
		$d->query($sql);
		}
		if($d->query($sql))
			redirect("index.php?com=users&act=edit&id=".$id);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=users&act=edit&id=".$id);
	}else transfer("Không nhận được dữ liệu", "index.php?com=users&act=edit&id=".$id);
}


#====================================



function get_info(){
	global $d, $item_type;


	$sql = "select * from #_info where com='$_GET[type1]' limit 0,1";
	$d->query($sql);
	$item_type = $d->fetch_array();
	

	if($d->num_rows()==0){
		$data['mota_vi']='';
		$data['noidung_vi']="Nội dung đang cập nhật...";
		$data['is_noindex'] = 1;
		$data['com']=$_GET['type1'];
		$d->setTable('info');
		if($d->insert($data)){
			$sql = "select * from #_info where com='$_GET[type1]' limit 0,1";
			$item_type = $d->fetch_array();
		}else{
			transfer("Dữ liệu chưa khởi tạo.", "index.php");
		}
	};
}


function save_info(){
	global $d,$url_back;
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=users&act=capnhat_info&type1=$_GET[type1]");
	$file_name=fns_Rand_digit(0,9,5);
	if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|doc|pdf|docx|DOC|DOCX|PDF',_upload_hinhanh,$file_name)){
		$data['photo'] = $photo;
		$d->setTable('info');			
		$d->select();
		if($d->num_rows()>0){
			$row = $d->fetch_array();
			delete_file(_upload_hinhanh.$row['photo']);
		}
	}
	
	

	
		
	
		$data['deschar_vi'] = magic_quote($_POST['deschar_vi']);	
		$data['deschar_en'] = magic_quote($_POST['deschar_en']);	
	
		$data['h1_vi'] = magic_quote($_POST['h1_vi']);	
		$data['h1_en'] = magic_quote($_POST['h1_en']);	
		$data['h2_vi'] = magic_quote($_POST['h2_vi']);	
		$data['h2_en'] = magic_quote($_POST['h2_en']);	
	
	
		$data['title_vi'] = magic_quote($_POST['title_vi']);
		$data['title_en'] = magic_quote($_POST['title_en']);
		$data['title_ge'] = magic_quote($_POST['title_ge']);
		$data['keyword_vi'] = magic_quote($_POST['keyword_vi']);
		$data['keyword_en'] = magic_quote($_POST['keyword_en']);
		$data['keyword_ge'] = magic_quote($_POST['keyword_ge']);
		$data['description_vi'] = magic_quote($_POST['description_vi']);
		$data['description_en'] = magic_quote($_POST['description_en']);
		$data['description_ge'] = magic_quote($_POST['description_ge']);
	
	
	
	$data['mota_vi'] = magic_quote($_POST['mota_vi']);
	$data['noidung_vi'] = magic_quote($_POST['noidung_vi']);
	$data['ten_vi'] = magic_quote($_POST['ten_vi']);
	$data['ten_en'] = magic_quote($_POST['ten_en']);
	
	$data['tamnhin_vi'] = magic_quote($_POST['tamnhin_vi']);
	$data['sumenh_vi'] = magic_quote($_POST['sumenh_vi']);
	$data['trietlikinhdoanh_vi'] = magic_quote($_POST['trietlikinhdoanh_vi']);
	
	$data['mota_en'] = magic_quote($_POST['mota_en']);
	
	$data['noidung_en'] = magic_quote($_POST['noidung_en']);
	$data['mota_ge'] = magic_quote($_POST['mota_ge']);
	$data['noidung_ge'] = magic_quote($_POST['noidung_ge']);
	
	$data['is_noindex'] = isset($_POST['is_noindex']) ? 1 : 0;	
	//$data['com']=magic_quote($_GET['type1']);
	$d->reset();
	$d->setTable('info');
	$d->setWhere('com','users');
	
	
		//echo($_POST["mota_vi"]);
	//die();
	
	if($d->update($data))
		transfer("Dữ liệu được cập nhật", $url_back);
	else
		transfer("Cập nhật dữ liệu bị lỗi", $url_back);
}

?>