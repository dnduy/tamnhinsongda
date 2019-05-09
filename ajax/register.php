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

		/*$d->reset();
		$d->setTable('user');
		$d->setWhere('email', $_REQUEST['email']);
		$d->select();*/
		
		$sql = "select * from #_user where email='".$_REQUEST['email']."'  and dienthoai='".$_REQUEST['dienthoai']."' and ((com='member'  and mauser!='') )";
		$d->query($sql);
		
		if($d->num_rows()>0){
			echo 2; // trùng email or phone
			exit();
		}else{
			

			$maso = ChuoiNgauNhien(20);
			$mastv = fns_Rand_digit(0,5,5);
			$linkweb = $row_setting["website"];

		

			$data['password'] = md5($_REQUEST['pass']);
			$data['email'] = ($_REQUEST['email']);
			$email_dk = $_REQUEST['email'];
			$data['user'] = $maso;
			$data['mauser'] = $mastv;
			$data['hoten'] = ($_REQUEST['name']);
			$data['ngaysinh'] = strtotime($_POST['ngaysinh']);
			$data['sex'] = ($_REQUEST['gender']);
			$data['quocgia'] = ($_REQUEST['quocgia']);
			$data['tinh'] = ($_REQUEST['tinh']);
			$data['huyen'] = ($_REQUEST['huyen']);
			$data['phuongxa'] = ($_REQUEST['phuong']);
			$data['diachi'] = ($_REQUEST['diachi']);
			$data['dienthoai'] = ($_REQUEST['dienthoai']);
			
			$data['ngaydangky'] = time();
			
			$data['ngaydangky'] = time();

			$data['hienthi'] = 0;
			$data1['stt'] = 1;
			$data['role'] = 1;
			$data['com'] = "member";
			$d->setTable('user');
			
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
		$mail->AddAddress($_REQUEST['email'], $_REQUEST['hoten']);
		
			
		
		$mail->AddAddress($email_dk, $_REQUEST['hoten']);
		
		
		
		//Thiết lập email nhận email hồi đáp
		//nếu người nhận nhấn nút Reply
		$mail->AddReplyTo($row_setting['email'],$row_setting["ten_$lang"]);

		/*=====================================
		 * THIET LAP NOI DUNG EMAIL
 		*=====================================*/
		
		

		//Thiết lập tiêu đề
		$mail->Subject    = "Xác Nhận Tài Khoản ".$row_setting["ten_$lang"]." ";
		$mail->IsHTML(true);
		//Thiết lập định dạng font chữ
		$mail->CharSet = "utf-8";	

			$body = '<table style="text-align:left;">';
			$body .= '
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				
				<tr  padding:10px; height:100px; margin:0 auto; width:100%;">
				
		<td colspan="2"><img src="http://'.$config_url.'/'._upload_hinhanh_l.$row_logo["banner_$lang"].'" style="height:62px;  "/></td>
														
				</tr>
				
				
				<tr>
				
				<p class="MsoNormal"><span style="font-size:10.0pt;font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;"><u></u>&nbsp;<u></u></span></p>
				
				
					<p class="MsoNormal" align="center" style="text-align:center"><span style="font-size:13.5pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">THÔNG TIN XÁC NHẬN TÀI KHOẢN </span><span style="font-size:10.0pt;font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;"><br>
</span><span style="font-size:10.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">Được gởi
từ hệ thống của <span style="color:#1f497d">'.$row_setting["ten_$lang"].'</span> - <span style="color:#1f497d">'.$row_setting["website"].'</span> </span><span style="font-size:10.0pt;font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;"><u></u><u></u></span></p>	
				
				</tr>
				
				
		
				
				
			<tr>
				  <td colspan="2" style="border:none;padding:7.5pt 7.5pt 7.5pt 7.5pt">
				  <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%">
				   <tbody><tr>
					<td width="100%" valign="top" style="width:100%;padding:1.5pt 1.5pt 1.5pt 1.5pt">
					<p class="MsoNormal">'.$row_setting["diachi_$lang"].'</p>
					</td>
					
				   </tr>
				  </tbody></table>
				  </td>
 			</tr>
			
			
			<tr>
			  <td colspan="2" style="border:none;background:#f3ebc3;padding:7.5pt 7.5pt 7.5pt 7.5pt">
			  <p class="MsoNormal"><span style="font-size:10.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">Cảm ơn bạn đã đăng ký thành viên trên '.$row_setting["ten_$lang"].' . Để tài khoản thành viên có hiệu lực, bạn vui lòng nhấn vào liên kết dưới đây: </b> <br>
			  <br>
			  <a href="http://'.$config_url.'/kich-hoat-mail/'.$maso.'.html">http://'.$config_url.'/kich-hoat-mail/'.$maso.'.html</a> <br>
			  <br>
			  Email truy cập : <a href="mailto:'.$_REQUEST['email'].'">'.$_REQUEST['email'].'</a> <br>
			 Mật khẩu : '.$_REQUEST['pass'].' 	<br>	
			 
			 	Mã Số Thành Viên:'.$mastv.'
			 
			 </td>
 		
		
		</tr>
				<hr>
				
				
				<tr>
					<td colspan="2">'.$row_setting["mailphanhoi_$lang"].'</td>
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
				
				
				$_SESSION['nguyenngoctan'] = true;
				$_SESSION['login_member']['email'] = $data['email'];
				$_SESSION['login_member']['phone'] = $data['dienthoai'];
				$_SESSION['login_member']['hoten'] = $data['hoten'];
				$_SESSION['login_member']['active'] = $data['hienthi'];
				$_SESSION['login_member']['user'] = $data['user'];
				$_SESSION['login_member']['mauser'] = $data['mauser'];
				$_SESSION['login_member']['role'] = 1;
				$_SESSION['login_member']['id'] = mysql_insert_id();

				echo 1; //Thành công
				exit();

			}
			else
			{
				echo 3; //Thất bại insert
				exit();
			}
		}
	}
		
	else
	{
		echo 0; // invalid code
	}
	
	?>

