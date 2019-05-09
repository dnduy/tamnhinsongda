<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$url_back=$_SERVER['HTTP_REFERER'];
switch($act){
	case "capnhat":
		get_info();
		$template = "info/item_add";
		break;
	case "save":
		save_info();
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

function get_info(){
	global $d, $item;

	$sql = "select * from #_info where com='$_GET[typechild]' limit 0,1";
	$d->query($sql);
	$item = $d->fetch_array();
	if($d->num_rows()==0){
		$data['mota_vi']='';
		$data['noidung_vi']="Nội dung đang cập nhật...";
		$data['is_index'] = 1;
		$data['com']=$_GET['typechild'];
		$d->setTable('info');
		if($d->insert($data)){
			$sql = "select * from #_info where com='$_GET[typechild]' limit 0,1";
			$item = $d->fetch_array();
		}else{
			transfer("Dữ liệu chưa khởi tạo.", "index.php");
		}
	};
}

function save_info(){
	global $d,$config,$url_back;
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=info&act=capnhat&typechild=$_GET[typechild]");
	
	$file_name=changeTitle($_POST['ten_vi']).fns_Rand_digit(0,3,5);
	
	$file_brochure_vi=changeTitle($_POST['ten_vi']).fns_Rand_digit(0,3,4);
	$file_brochure_en=changeTitle($_POST['ten_en']).fns_Rand_digit(0,3,4);

	if($photo = upload_image("file", _format_duoihinh,_upload_info,$file_name)){
		$data['photo'] = $photo;
		$d->setTable('info');			
		$d->select();
		if($d->num_rows()>0){
			$row = $d->fetch_array();
			delete_file(_upload_info.$row['photo']);
		}
	}
	
	if($brochure_vi = upload_image("brochure_vi", _format_duoitailieu, _upload_info,$file_brochure_vi."_vi")){
			$data['brochure_vi'] = $brochure_vi;	
			$d->setTable('setting');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_info.$row['brochure_vi']);	
			}
		}	
		
		
		if($brochure_en = upload_image("brochure_en", _format_duoitailieu, _upload_info,$file_brochure_en."_en")){
			$data['brochure_en'] = $brochure_en;	
			$d->setTable('setting');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_hinhanh.$row['brochure_en']);	
			}
		}	
		
	
	
	if (!empty($_POST))
		{

			
			$delete_img_present=$_REQUEST['delete_img_present'];
			
			

			if($delete_img_present=='delete_img'){

				if(isset($_GET['typechild'])){
				
				$d->reset();
				$sql = "select id,thumb, photo from #_info where com='".$_GET["typechild"]."'";
				$d->query($sql);
				if($d->num_rows()>0){
					while($row = $d->fetch_array()){
						delete_file(_upload_news.$row['photo']);
						delete_file(_upload_news.$row['thumb']);			
					}
				$sql = "UPDATE #_info SET photo ='',thumb='' WHERE  com = '".$_GET["typechild"]."'";
				$d->query($sql);
				}
				if($d->query($sql))
					redirect($url_back);
					
				else
					transfer("Xóa dữ liệu bị lỗi", $url_back);
			}else transfer("Không nhận được dữ liệu", $url_back);


			}
			
			
			
			
			$delete_present_file_vi=$_REQUEST['delete_present_file_vi'];
		

			if($delete_present_file_vi=='delete_file_vi'){

				if(isset($_GET['typechild'])){
				
				$d->reset();
				$sql = "select id,brochure_vi from #_info where com='".$_GET["typechild"]."'";
				$d->query($sql);
				if($d->num_rows()>0){
					while($row = $d->fetch_array()){
						delete_file(_upload_info.$row['brochure_vi']);
							
					}
				$sql = "UPDATE #_info SET brochure_vi ='' WHERE  com = '".$_GET["typechild"]."'";
				$d->query($sql);
				}
				if($d->query($sql))
					redirect($url_back);
					
				else
					transfer("Xóa dữ liệu bị lỗi", $url_back);
			}else transfer("Không nhận được dữ liệu", $url_back);


			}
			
			
			
			$delete_present_file_en=$_REQUEST['delete_present_file_en'];
		

			if($delete_present_file_en=='delete_file_en'){

				if(isset($_GET['typechild'])){
				
				$d->reset();
				$sql = "select id,brochure_en from #_info where com='".$_GET["typechild"]."'";
				$d->query($sql);
				if($d->num_rows()>0){
					while($row = $d->fetch_array()){
						delete_file(_upload_info.$row['brochure_en']);
							
					}
				$sql = "UPDATE #_info SET brochure_en ='' WHERE  com = '".$_GET["typechild"]."'";
				$d->query($sql);
				}
				if($d->query($sql))
					redirect($url_back);
					
				else
					transfer("Xóa dữ liệu bị lỗi", $url_back);
			}else transfer("Không nhận được dữ liệu", $url_back);


			}
			
			

		}


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
			
			$data['concepter_'.$value] = magic_quote($_POST['concepter_'.$value]);

			

		}
		
		

	
	$data['is_index'] = isset($_POST['is_index']) ? 1 : 0;
	$data['is_follow'] = isset($_POST['is_follow']) ? 1 : 0;	
	
	$d->reset();
	$d->setTable('info');
	$d->setWhere('com',$_GET['typechild']);
	if($d->update($data))
		transfer("Dữ liệu được cập nhật", "index.php?com=info&act=capnhat&typechild=$_GET[typechild]");
	else
		transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=info&act=capnhat&typechild=$_GET[typechild]");
}

?>