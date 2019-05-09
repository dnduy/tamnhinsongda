<?php if(!defined('_source')) die("Error");
		$title_bar= _lienhe;
		if(!empty($_POST)){
			
			/*if($_SESSION['captcha_code']!= strtoupper($_POST['capcha']))
				{
					transfer("incorrect Security Code", "lien-he.html");
					exit();
				}
				*/
			
			
			$data["hoten"] = $_POST["ten"];
			$data['diachi'] = $_POST['diachi'];
			$data['dienthoai'] = $_POST['dienthoai'];
			$data['email'] = $_POST['email'];
			$data['tieude'] = $_POST['tieude1'];
			$data['noidung'] = $_POST['noidung'];		
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
					<th>Họ tên :</th><td>'.$_POST["ten"].'</td>
				</tr>
				<tr>
					<th>Địa chỉ :</th><td>'.$_POST['diachi'].'</td>
				</tr>
				<tr>
					<th>Điện thoại :</th><td>'.$_POST['dienthoai'].'</td>
				</tr>
				<tr>
					<th>Email :</th><td>'.$_POST['email'].'</td>
				</tr>
				<tr>
					<th>Nội dung :</th><td>'.$_POST['noidung'].'</td>
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

			$d->reset();
			$sql_contact = "select noidung_$lang,mota_$lang,ten_$lang from #_info where com='lienhe' ";
			$d->query($sql_contact);
			$company_contact = $d->fetch_array();
			
			
			
			$d->reset();
			$sql="select id,ten_$lang, mota_$lang, toado from #_bando where hienthi=1 and com='bando' order by stt,id desc limit 0,4";
			$d->query($sql);
			$map=$d->result_array();
			
			
	
	$title_tcat=_lienhe;
	
	$d->reset();
	$sql_banner_giua = "select banner_$lang from #_banner where com='banner_top' ";
	$d->query($sql_banner_giua);
	$row_logo = $d->fetch_array();

	$image="http://".$config_url."/"._upload_hinhanh_l.$row_logo["banner_$lang"]."";
	$url_web="http://".$config_url."/"."".$com."".".html";
	
	$description_web=strip_tags($row_setting["title_$lang"]);
			



	
?>