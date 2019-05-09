<?php  if(!defined('_source')) die("Error");
$title_tcat=$com_title;

$d->setTable('info');
	$d->setWhere("com",$com_type);
	$d->select("ten_$lang,noidung_$lang, keyword_$lang, description_$lang,title_$lang,h1_$lang,h2_$lang,is_index,photo,mota_$lang,luotxem,id");
	if($d->num_rows()>0){
		$row = $d->fetch_array();
		$ten_info= $row["ten_$lang"];
		$mota_info= $row["mota_$lang"];
		$noidung_info= $row["noidung_$lang"];
		if($row["keyword_$lang"]!='')
			$row_setting["keywords_$lang"]=$row["keyword_$lang"];
		if($row["description_$lang"]!='')
			$row_setting["description_$lang"]=$row["description_$lang"];
			
	if($row["h1_$lang"]!='')
			$row_setting["h1_$lang"]=$row["h1_$lang"];		
			
	if($row["h2_$lang"]!='')
			$row_setting["h2_$lang"]=$row["h2_$lang"];				
			
	if($row["title_$lang"]!='')
	{
			$title_bar=$row["title_$lang"];	
	}
	else
		
	{
			$title_bar=$row["ten_$lang"];	
			
	}		
		
		$sql_lanxem = "UPDATE #_info SET luotxem=luotxem+1  WHERE id ='".$row["id"]."'";
		$d->query($sql_lanxem);
			
	}
	
	
	
	
	// thanh tieu de
	//$title_bar= _gioithieu;

	$title_com=$com_title;
	
	if ($row["ten_$lang"]!='')
	{
		
		$title_tcat=$row["ten_$lang"];
		
	}
	else
	{
		$title_tcat=$com_title;
	}
	
	
	
	$d->reset();
	$sql_banner_giua = "select banner_$lang from #_banner where com='banner_top' ";
	$d->query($sql_banner_giua);
	$row_logo = $d->fetch_array();

	$image="http://".$config_url."/"._upload_hinhanh_l.$row_logo["banner_$lang"]."";
	$url_web="http://".$config_url."/"."".$com."".".html";
	
	$description_web=strip_tags($row_setting["title_$lang"]);

if(!empty($_POST)){
			
			/*if($_SESSION['captcha_code']!= strtoupper($_POST['capcha']))
				{
					transfer("incorrect Security Code", "lien-he.html");
					exit();
				}
				*/

		
			
			$data["hoten"] = $_POST["hoten"];
			$data['sodienthoai'] = $_POST['sodienthoai'];
			$data['email'] = $_POST['email'];
			$data['diachi'] = $_POST['diachi'];
			$data['soluong'] = $_POST['soluong'];
			$data['ngaytao'] = time();
			
			$data['hienthi'] = 1;
			$maid = ChuoiNgauNhien(50)+time();
			$data['maid'] = $maid;

			
			$hoten = $_POST["hoten"];
			$gioitinh = $_POST['gioitinh'];
			$sodienthoai = $_POST['sodienthoai'];
			$email = $_POST['email'];

			$diachi = $_POST['diachi'];
			$soluong = $_POST['soluong'];
			
			
	$error = '';	
	$success = false;
	  
	 		 
	  
	  if(count($_FILES['files']) > 0)
		{
			
			$files = array();
			$i=0;
			foreach($_FILES['files'] as $k=>$v)
			{
				
				$tmp = array();
				$tmp['name'] = $_FILES['files']['name'][$i];
				$tmp['type'] = $_FILES['files']['type'][$i];
				$tmp['tmp_name'] = $_FILES['files']['tmp_name'][$i];
				$tmp['error'] = $_FILES['files']['error'][$i];
				$files[] = $tmp;
				$i++;
				
			}
			$photos = array();
			$_FILES = $files;
			
			
			
			foreach($files as $k=>$v)
			{
				
			
			
				
				if($v['name'])
				{
					$file_photo_firtname = changeTitle($hoten)."-".rand(0,999)."";
				
			
					if(!$k)
					{
				
			
					
						if($photo = upload_image($k, _format_duoihinh, _upload_hinhanh_l,$file_photo_firtname))
						{

							$data['photo'] = $photo;	
							
							
						}
					
					}
					else
					{
						
					
						if($photo = upload_image($k, _format_duoihinh, _upload_hinhanh_l,$file_photo_firtname))
						{

						$data['photo'] = $photo;	
															
						$photos[$k-1]['photo'] = $data['photo'];
						
												
						}
					}
					
				}
			}
			
	
		}

			
			//$d->setTable('contact');
			
			$subject = "Thư liên hệ từ ".$row_setting["title_$lang"];
			$body = '<table>';
			$body .= '
				<tr>
					<th colspan="2">&nbsp;</th>
				</tr>
				<tr>
					<th colspan="2">Thư liên hệ từ website '.$row_setting["ten_$lang"].'</th>
				</tr>
				<tr>
					<th colspan="2">&nbsp;</th>
				</tr>
				
	
				
				<tr>
					<th>Họ tên :</th><td>'.$hoten.'</td>
				</tr>

				
				<tr>
					<th>Số điện thoại :</th><td>'.$sodienthoai.'</td>
				</tr>
				
				<tr>
					<th>Email :</th><td>'.$email.'</td>
				</tr>
				
				<tr>
					<th>Địa chỉ :</th><td>'.$_POST['diachi'].'</td>
				</tr>';
			$body .= '</table>';
			
			
			$d->reset();
			$sql_lienket = "select id,stt from #_nhanhopdong where hienthi=1  order by id desc ";
			$d->query($sql_lienket);
			$result_stt = $d->result_array();
			
			if ($result_stt[0]["stt"]>0)
			{
				$data['stt'] =$result_stt[0]["stt"]+1;
			}
			else 
			{
				$data['stt']=1;
			}
			
		
			
					
			$d->setTable('nhanhopdong');
			if($d->insert($data));
			{
				
				$d->reset();
        $sql_tintuc = "select id from #_nhanhopdong where id=".mysql_insert_id()." order by id desc limit 0,1";
        $d->query($sql_tintuc);
        $bv_moidang = $d->fetch_array();
		
		
		
		
		include(_lib.'class.uploader.php');
				
		$uploader = new Uploader();
		$data = $uploader->upload($_FILES['files'], array(
			'limit' => 100, //Maximum Limit of files. {null, Number}
			'maxSize' => 300, //Maximum Size of files {null, Number(in MB's)}
			'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
			'required' => false, //Minimum one file is required for upload {Boolean}
			'uploadDir' => _upload_files_l, //Upload directory {String}
			'title' => array('auto', 100), //New file name {null, String, Array} *please read documentation in README.md
			'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
			'perms' => null, //Uploaded file permisions {null, Number}
			'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
			'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
			'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
			'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
			'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
			'onRemove' => 'onFilesRemoveCallback' //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
		));
		
		
		if(count($photos) > 0)
		{
			
			foreach($photos as $k=>$v){
						
						
						$v['id_photo'] = $bv_moidang['id'];

						$v['hienthi'] = 1;
						$v['stt'] = $_POST['stt'. $k];
						$v['com'] = 'nhanhopdong';
					
						$d->setTable("hasp");
						$d->insert($v);
						$d->reset();

					}

		}
		
				
				
			}
			
			include_once "phpmailer/class.phpmailer.php";


			//Khởi tạo đối tượng
			$mail = new PHPMailer();
			//Thiet lap thong tin nguoi gui va email nguoi gui
			$mail->IsSMTP(); // Gọi đến class xử lý SMTP
			$mail->SMTPAuth   = true;                  // Sử dụng đăng nhập vào account
			$mail->Host       = $row_setting["iphost"];     // Thiết lập thông tin của SMPT
			$mail->Username   = $row_setting["usernameaccount"]; // SMTP account username
			$mail->Password   = $row_setting["password"];           // SMTP account password
			$mail->SetFrom($row_setting["mailhost"],$row_setting["ten_$lang"]);
			
			//Thiết lập thông tin người nhận
			$mail->AddAddress($_POST["email"],$_POST["hoten"]);
			$mail->AddAddress($row_setting['email'],$row_setting["ten_$lang"]);
			
			//Thiết lập email nhận email hồi đáp
			//nếu người nhận nhấn nút Reply
			$mail->AddReplyTo($row_setting['email'],$row_setting["ten_$lang"]);

/*=====================================
 * THIET LAP NOI DUNG EMAIL
 *=====================================*/

//Thiết lập tiêu đề
$mail->Subject    = "Thông tin liên hệ";

//Thiết lập định dạng font chữ
$mail->CharSet = "utf-8";

$mail->AltBody = "To view the message, please use an HTML compatible email viewer!";

//Thiết lập nội dung chính của email
$mail->MsgHTML($body);

if(!$mail->Send()) {
 			 transfer( "Có lỗi xảy ra!","index.html");
} else {
			 
			transfer("Gửi liên hệ thành công!<br/>", "index.html");	
}	
		}



			
			

			
			
	
	$title_tcat=$com_title;
	

?>