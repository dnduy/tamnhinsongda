<?php  if(!defined('_source')) die("Error");
	

	

	$d->reset();
	$sql_banner_giua = "select banner_$lang from #_banner where com='logo_top' ";
	$d->query($sql_banner_giua);
	$row_logo = $d->fetch_array();
	
	
		$d->reset();
	$sql_banner_giua = "select banner_$lang as banner from #_banner where com='logo_home' ";
	$d->query($sql_banner_giua);
	$logo_home = $d->fetch_array();

	$image="http://".$config_url."/"._upload_hinhanh_l.$row_logo["banner_$lang"]."";
	$url_web="http://".$config_url."";
	$title_bar=$row_setting["title_$lang"];
	$description_web=strip_tags($row_setting["title_$lang"]);
	
	
	
		$d->reset();
	$sql = "select noidung_$lang as noidung from #_info where hienthi=1 and com='footer' order by stt,id desc";
	$d->query($sql);
	$footer_nd=$d->fetch_array();
	
	
	
	$d->reset();
	$sql_gioithieu = "select id,ten_$lang as ten,mota_$lang as mota,noidung_$lang as noidung,photo from #_info where com='gioithieu' ";
	$d->query($sql_gioithieu);
	$row_gioithieu = $d->fetch_array();
	
	
		$d->reset();
	$sql_gioithieu = "select id,ten_$lang as ten,mota_$lang as mota,noidung_$lang as noidung,photo from #_info where com='linhvuckinhdoanh' ";
	$d->query($sql_gioithieu);
	$lv_kd = $d->fetch_array();



	$d->reset();
	$sql_news = "select ten_$lang as ten,id,tenkhongdau_$lang as tenkhongdau,photo,mota_$lang as mota from #_product_list where hienthi=1 and com='product' and hienthitc>0   order by stt asc";
	$d->query($sql_news);
	$list_spindex = $d->result_array();

	
	
	$d->reset();
	$sql = "select photo,link, ten_$lang as ten, mota_$lang as mota from #_image_url where hienthi=1 and com='image_GD' order by stt,id desc";
	$d->query($sql);
	$image_GD=$d->result_array();
	
	
	$d->reset();
	$sql = "select photo,link, ten_$lang as ten, mota_$lang as mota from #_image_url where hienthi=1 and com='mangxahoi_home' order by stt,id desc";
	$d->query($sql);
	$mangxahoi_home=$d->result_array();


	if(!empty($_POST)){
			
			/*if($_SESSION['captcha_code']!= strtoupper($_POST['capcha']))
				{
					transfer("incorrect Security Code", "lien-he.html");
					exit();
				}
				*/
			
			
			$data["hoten"] = $_POST["ten_ft"];

			$data['dienthoai'] = $_POST['dienthoai_ft'];
			$data['email'] = $_POST['email_ft'];
	
			$data['noidung'] = $_POST['noidung_ft'];		
			$data['ngaytao'] = time();
			$data['stt'] = 1;
			$data['hienthi'] = 1;
			
			
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
					<th>Họ tên :</th><td>'.$_POST["ten_ft"].'</td>
				</tr>
			
				<tr>
					<th>Điện thoại :</th><td>'.$_POST['dienthoai_ft'].'</td>
				</tr>
				<tr>
					<th>Email :</th><td>'.$_POST['email_ft'].'</td>
				</tr>
				<tr>
					<th>Nội dung :</th><td>'.$_POST['noidung_ft'].'</td>
				</tr>';
			$body .= '</table>';
			
					
			$d->setTable('contact');
			if($d->insert($data));
			
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
			$mail->AddAddress($_POST['email'],$$_POST['hoten']);
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


?>