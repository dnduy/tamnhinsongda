<?php
	session_start();
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$session=session_id();
	@define ( '_template' , '../templates/');
	@define ( '_source' , '../sources/');
	@define ( '_lib' , '../libraries/');
	@define ( _upload_folder , '../media/upload/' );
	
	//Lưu ngôn ngữ chọn vào $_SESSION
	$lang_arr=array("vi","en","ge");
	if (isset($_GET['lang']) == true){
        if (in_array($_GET['lang'], $lang_arr)==true){
            $lang = $_GET['lang'];
            $_SESSION['lang']=$lang;
		  header('Location: '.$_SERVER['HTTP_REFERER']);
        } 
	}
    if(isset($_SESSION['lang'])){
        $lang= $_SESSION['lang'];
    }else{
        $lang="vi";
    }
	require_once _source."lang_$lang.php";	
	
    include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	
	include_once _lib."library.php";
	include_once _lib."class.database.php";	
	
	include_once _lib."file_requick.php";
	$d = new database($config['database']);
	
	
	function fns_Rand_digit($min,$max,$num)
		{
			$result='';
			for($i=0;$i<$num;$i++){
				$result.=rand($min,$max);
			}
			return $result;	
		}
	
	
	if(@strtolower($_REQUEST['code']) == strtolower($_SESSION['random_number']))
	{
		

		$d->reset();
		$d->setTable('user');
		$d->setWhere('id', $_REQUEST['id_thanhvien']);
		$d->select();
		$check_email_send=$d->fetch_array();	
		
		if ($check_email_send["email"]==$_REQUEST["email"])
		{
			echo 2; // Kiểm tra email nhập trùng với email đăng nhập ???
			die();
		}
		
		
		$d->reset();
		$d->setTable('user');
		$d->setWhere('email',$_REQUEST["email"]);
		$d->select();
		$check_email_receive=$d->fetch_array();	
		
		if($d->num_rows()!=1) 
		{
			echo 4; // kiểm tra xem thành viên có tồn tại không???
			die();
		}
		
		//if($d->num_rows()>0)
		//{
			//echo 2; // trùng email 
			//exit();
		//}
		else
		{
			

				
			$id_thanhvien=$check_email_send["id"];
			$id_thanhvien_receive=$check_email_receive["id"];
			$randomkey = ChuoiNgauNhien(32);		
			$linkweb = $row_setting["website"];			
			$data['id_thanhvien'] = $id_thanhvien;
			
			if ($_REQUEST["id_feedback"]!="")
			{
				$data["id_feedback"]=$_REQUEST["id_feedback"];
			}
			
			$data['id_thanhvien_receive'] = $id_thanhvien_receive;
			$data['randomkey'] = $randomkey;
			
			$email_receive = $check_email_receive["email"];
			$email_send = $check_email_send["email"];
						
			$hoten_receive = $check_email_receive["hoten"];
			$hoten_send = $check_email_send["hoten"];
			
			$data['tieude'] = ($_REQUEST['tieude']);
			$data['noidung'] = ($_REQUEST['noidung']);

			$data['ngaychuyen'] = time();

			
			$data['tinhtrang'] = 1;
			$data['hienthi'] = 1;

		
		
			$d->setTable('taothumoi');
			
			//$d->setTable('user');
			
		
			
		/*********************************Start Send To FeedBakc Regerity for user ********************************/

			
		include_once "../phpmailer/class.phpmailer.php";	
		
	
		
		$mail = new PHPMailer();
		$mail->IsSMTP(); // Gọi đến class xử lý SMTP
		$mail->Host       = $row_setting["iphost"];  // tên SMTP server
		$mail->SMTPAuth   = true;                  // Sử dụng đăng nhập vào account
		$mail->Username   = $row_setting["usernameaccount"];// SMTP account username
		$mail->Password   = $row_setting["password"];   

		

		//Thiet lap thong tin nguoi gui va email nguoi gui
		$mail->SetFrom($row_setting["mailhost"],$row_setting["ten_$lang"]);

		//Thiết lập thông tin người nhận
		$mail->AddAddress($email_receive, $hoten_receive);
		
			
		//Thiết lập thông tin người gửi
		$mail->AddAddress($email_send, $hoten_send);
		
		
		
		//Thiết lập email nhận email hồi đáp
		//nếu người nhận nhấn nút Reply
		$mail->AddReplyTo($row_setting['email'],$row_setting["ten_$lang"]);

		/*=====================================
		 * THIET LAP NOI DUNG EMAIL
 		*=====================================*/
		
		

		//Thiết lập tiêu đề
		$mail->Subject    = "Xác Nhận Thông Tin Gửi Thư ".$row_setting["ten_$lang"]." ";
		$mail->IsHTML(true);
		//Thiết lập định dạng font chữ
		$mail->CharSet = "utf-8";	

			$body = '<table style="text-align:left;">';
			$body .= '
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				
				<tr  style="padding:10px; height:100px; margin:0 auto; width:100%; text-align: center;">
				
		<td colspan="2" style="text-align: center;"><img src="http://'.$config_url.'/'._upload_hinhanh_l.$row_logo["banner_$lang"].'" style="height:62px;  "/></td>
														
				</tr>
				
				<br>
				
				
				<tr>
				
					
				<td colspan="2" style="margin: 0 auto;width: 100%;">	
				
					<p class="MsoNormal" align="center" style="text-align:center"><span style="font-size:13.5pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">THÔNG TIN GỬI TIN NHẮN THÀNH VIÊN </span><span style="font-size:10.0pt;font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;"><br>
</span><span style="font-size:10.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">Được gởi
từ hệ thống của <span style="color:#1f497d">'.$row_setting["ten_$lang"].'</span> - <span style="color:#1f497d">'.$row_setting["website"].'</span> </span><span style="font-size:10.0pt;font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;"><u></u><u></u></span></p>	
				</td>
				
				</tr>
				<br>
				
				<tr>
					<th>Email thành viên gửi :</th><td>'.$email_send.'</td>
				</tr>
				
				<tr>
					<th>Họ tên thành viên gửi :</th><td>'.$hoten_send.'</td>
				</tr>
				
				<tr>
					<th>Email nhận :</th><td>'.$email_receive.'</td>
				</tr>
				<tr>
					<th>Họ tên người nhận :</th><td>'.$hoten_receive.'</td>
				</tr>
				<tr>
					<th>Tiêu đề :</th><td>'.$_REQUEST['tieude'].'</td>
				</tr>
				<tr>
					<th>Nội Dung :</th><td>'.$_REQUEST['noidung'].'</td>
				</tr>
				

				
				<tr>
					<td colspan="2">Lưu ý: Đây chỉ là thư thông báo. Các hồi đáp lại thông báo này sẽ không được theo dõi hoặc giải đáp.</td>
				</tr>
				';
			$body .= '</table>';
			
			$mail->Body = $body;
			
			
			
					
	/*********************************End Send To FeedBakc Regerity for user ********************************/
	
			
			
	
			if($d->insert($data) && $mail->Send())
			{
				
				
				
			
				echo 1; //Thành công
				exit();

			}
			else
			{
				echo 3; //Thất bại insert
				exit();
			}
		}
	}else
	{
		echo 0; // invalid code
	}

	?>
    
    
    
  
