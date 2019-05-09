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
	

	if(@strtolower($_REQUEST['code']) == strtolower($_SESSION['random_number']))
	{
		
		
	
	$d->reset();
	$sql="select id,hoten,email,mauser,dienthoai,com from #_user where hienthi=1 and email='".$_REQUEST["email"]."' and com='member' and mauser!='' order by stt,id desc";
	$d->query($sql);
	$info_member=$d->result_array();
	
	
	
	
	
	

	
	// kiem tra email dang ki
	//$d->reset();
	//$d->setTable('user');
	//	$d->setWhere('email', $_REQUEST['email']);
	//$d->select();
	if(count($info_member)<>1){
		echo 2;	
		exit();
	}
	
	
	
	
	$email=($_REQUEST['email']);
	$string = md5(rand(0,999)*time());
	$newpass = substr($string, 15, 6);
	
	
	
	
	//$data['password'] = md5($newpass);
	
	if ($info_member[0]["email"]==$_REQUEST["email"])
	{
		
			$d->reset();
			$data['com'] = "member";
			$data['password'] = md5($newpass);
			$d->setTable('user');
			$d->setWhere('id', ($info_member[0]['id']));
			$d->update($data);
		
		//echo("ok");
		//print_r($d);		
		//die();
	}
	
	//$d->reset();	
	//$d->query("UPDATE table_user set password='".md5($newpass)."'  WHERE email ='".$_REQUEST['email']."' and com='member'");
	
	//print_r($d);
	//die();

	//$d->setTable('user');
	//$d->setWhere('email', ($_REQUEST['email']));
	//$d->update($data);
	
	//print_r($d);
	//die();
	
	

		
	//include_once _lib."C_email.php";
	$subject = ""._laylaimatkhau." ";
			
$body = '<table style="text-align:center;">';
			$body .= '
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				
				<tr  padding:10px; height:100px; margin:0 auto; width:100%;">
				
		<td colspan="2"><img src="http://'.$config_url.'/'._upload_hinhanh_l.$row_logo["banner_$lang"].'" style="height:62px;  "/></td>
														
				</tr>
				
				
				<tr>
				
				<p class="MsoNormal"><span style="font-size:10.0pt;font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;"><u></u>&nbsp;<u></u></span></p>
				
				
					<p class="MsoNormal" align="center" style="text-align:center"><span style="font-size:13.5pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">'._thongtinlaylaimatkhau.' </span><span style="font-size:10.0pt;font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;"><br>
</span><span style="font-size:10.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">'._duocgoi.' <span style="color:#1f497d">'.$row_setting["ten_$lang"].'</span> - <span style="color:#1f497d">'.$row_setting["website"].'</span> </span><span style="font-size:10.0pt;font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;"><u></u><u></u></span></p>	
				
				</tr>
				
				
			
		<tr>
			  <td colspan="2" style="border:none;background:#f3ebc3;padding:7.5pt 7.5pt 7.5pt 7.5pt">
			  <p class="MsoNormal"><span style="font-size:10.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">'._taikhoancuaban.' '.$_REQUEST['email'].' . '._taikhoancapmoi.': </b> <br>
			 
			  <br>
			  '._emailtruycap.' : <a href="mailto:'.$_REQUEST['email'].'">'.$_REQUEST['email'].'</a> <br>
			'._matkhaumoicuaban.': : '.$newpass.' 	<br>	
			 
			 	'._masothanhvien.':'.$info_member[0]["mauser"].'
			 
			 </td>
 		
		
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
			
			
				<hr>
				
				
				<tr>
					<td colspan="2">'.$row_setting["mailphanhoi_$lang"].'</td>
				</tr>
				
		
				
				<tr>
					<td colspan="2">'._luuythuthongbao.'d>
				</tr>
				';
			$body .= '</table>';
			
		
			
			include_once "../phpmailer/class.phpmailer.php";
		//Khởi tạo đối tượng
		$mail = new PHPMailer();
		//Thiet lap thong tin nguoi gui va email nguoi gui
		$mail->IsSMTP(); // Gọi đến class xử lý SMTP
		$mail->SMTPAuth   = true;                
		
		
		
		// Sử dụng đăng nhập vào account
		
		$mail->Host       = $row_setting["iphost"];  // tên SMTP server
		$mail->SMTPAuth   = true;                  // Sử dụng đăng nhập vào account
		$mail->Username   = $row_setting["usernameaccount"];// SMTP account username
		$mail->Password   = $row_setting["password"];   

		

		//Thiet lap thong tin nguoi gui va email nguoi gui
		$mail->SetFrom($row_setting["mailhost"],$row_setting["ten_$lang"]);

		//Thiết lập thông tin người nhận
		$mail->AddAddress($_REQUEST['email'], $info_member[0]['hoten']);


		//Thiết lập email nhận email hồi đáp
		//nếu người nhận nhấn nút Reply
		//$mail->AddReplyTo($row_setting['email'],$row_setting['ten']);

		/*=====================================
		 * THIET LAP NOI DUNG EMAIL
		 *=====================================*/

		//Thiết lập tiêu đề
		$mail->Subject    = _laylaimatkhau;

		//Thiết lập định dạng font chữ
		$mail->CharSet = "utf-8";

		$mail->AltBody = "To view the message, please use an HTML compatible email viewer!";

		//Thiết lập nội dung chính của email
		$mail->MsgHTML($body);

		if(!$mail->Send())
		{
					echo 2;
					die();
		}
		else 
		{
					 
					echo 1;	
					//echo (count($info_member));
					
					//print_r($info_member);
	
					die();
		}	
		
	}
		
		else
		{
			echo 0; // invalid code
			die();
		}

		
	
	?>
