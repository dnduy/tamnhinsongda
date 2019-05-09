<?php  if(!defined('_source')) die("Error");	

	// thanh tieu de
	$title_bar= _thanhtoan;
	
	$info_user = getInfoUser($_SESSION['login_member']['id']);
	
	if(!empty($_POST)){
		$id_user_hoahong = $_POST['id_user_hoahong'];
			if(!empty($id_user_hoahong) && $id_user_hoahong!=$_SESSION['login_member']['id']){ // nếu có thành viên hoa hồng và thành viên chia sẻ khác với thành viên mua
			addtocart($_POST['id_product'],1,$id_user_hoahong);
		}else{
			//addtocart($_POST['id_product'],1);
		}
		$hoten=$_POST['ten'];
		$dienthoai=$_POST['dienthoai'];
		$diachi=$_POST['diachi'];
		$email=$_POST['email'];
		$noidung=$_POST['noidung'];
		$ghichu=$_POST['ghichu'];
		$httt=@$_POST['httt'];	
		$checkhttt=@$_POST['checkhttt'];	
		$xuathd=@$_POST['checkinvoice'];

		$tinh=$_POST['tinh'];
		if ($tinh!="")
		{
			$name_tinh=get_item_tinh($tinh);
		}
		
		$huyen=$_POST['huyen'];
		
		if ($huyen!="")
		{
			$name_huyen=get_item_quan($tinh,$huyen);
		}
			
		
		//dump($_POST);
		
		//validate dữ liệu


	
	$hoten = trim(strip_tags($hoten));
	$dienthoai = trim(strip_tags($dienthoai));	
	$diachi = trim(strip_tags($diachi));	
	$email = trim(strip_tags($email));	
	$noidung = trim(strip_tags($noidung));	
	$ghichu = trim(strip_tags($ghichu));	
	$checkhttt = trim(strip_tags($checkhttt));
	$xuathd = trim(strip_tags($xuathd));	
	settype($httt,"int");

	if (get_magic_quotes_gpc()==false) {
		$hoten = mysql_real_escape_string($hoten);
		$dienthoai = mysql_real_escape_string($dienthoai);
		$diachi = mysql_real_escape_string($diachi);
		$email = mysql_real_escape_string($email);
		$noidung = mysql_real_escape_string($noidung);	
		$ghichu = mysql_real_escape_string($ghichu);	
		$checkhttt = mysql_real_escape_string($checkhttt);
		$xuathd = mysql_real_escape_string($xuathd);		
	}
	$coloi=false;		
	if ($hoten == NULL) { 
		$coloi=true; $error_hoten = "Bạn chưa nhập họ tên<br>";
	} 
	if ($dienthoai == NULL) { 
		$coloi=true; $error_dienthoai = "Bạn chưa nhập điện thoại<br>";
	}
	if ($diachi == NULL) { 
		$coloi=true; $error_diachi = "Bạn chưa nhập địa chỉ<br>";
	}	
	
	if ($email == NULL) { 
		$coloi=true; $error_email = "Bạn chưa nhập email<br>";
	}elseif (filter_var($email,FILTER_VALIDATE_EMAIL)==FALSE) { 
		$coloi=true; $error_email="Bạn nhập email không đúng<br>";
	}
	/*if ($httt <1 and $httt>2) { 
		$coloi=true; $error_httt = "Bạn chưa chọn hình thức thanh toán<br>";
	}*/
	
	if ($coloi==FALSE) {
										
			 $body='<table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; background-color:#E1E1E1; padding:5px;" width="100%">';
			if(is_array($_SESSION['cart']))
			{
            	$body.='<tr bgcolor="#075992">
				<td align="center" style="font-weight:bold;color:#FFF">STT</td>
				<td style="font-weight:bold;color:#FFF">Tên</td>
				<td style="font-weight:bold;color:#FFF">Hình ảnh</td>
				<td align="center" style="font-weight:bold;color:#FFF">Giá</td>
				<td align="center" style="font-weight:bold;color:#FFF">Số lượng</td><td align="center" style="font-weight:bold;color:#FFF">Tổng giá</td></tr>';
				$max=count($_SESSION['cart']);
				for($i=0;$i<$max;$i++){
					$pid=$_SESSION['cart'][$i]['productid'];
					$q=$_SESSION['cart'][$i]['qty'];
										
					$pname=get_product_name($pid,'vi');
					$pimg=get_product_img($pid);
					
					if($q==0) continue;
            		$body.='<tr bgcolor="#FFFFFF"><td width="10%" align="center">'.($i+1).'</td>';
            		$body.='<td width="29%">'.$pname;				
					$body.='</td>';
					$body.='<td width="25%"><img src="http://'.$config_url.'/'._upload_product_l.$pimg;				
					$body.='" width="150"/></td>';
                    $body.='<td width="20%">'.number_format(get_price($pid),0, ',', '.').'&nbsp;VNĐ</td>';
					
                    $body.='<td width="14%">'.$q.'</td>';                 
                    $body.='<td>'.number_format((get_price($pid)*$q)-($q*get_price($pid)*get_price_km($pid)),0, ',', '.') .'&nbsp;VNĐ</td>
                    </tr>
					<br/>';
				}
				$body.='<tr><td colspan="5">
              <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
              <td style="text-align:left;"> '; 
               $body.=' <strong>Tổng giá bán: '. number_format(get_order_total(),0, ',', '.') .' &nbsp;VNĐ</strong></td>
              <td colspan="5" align="right">&nbsp;</td>
             </tr>
             </table>   
                </td></tr>';
            }
			else{
				$body.='<tr bgColor="#FFFFFF"><td>There are no items in your shopping cart!</td>';
			}
       $body.='</table><br />';
	  
  			
			$mahoadon=strtoupper (ChuoiNgauNhien(6));
			$ngaydangky=time();
			$tonggia=get_order_total();
			
			if ($xuathd==1)
			{
				$xuathoadon="Có xuất hóa đơn";
			}
			else 
			{
				$xuathoadon="Không có xuất hóa đơn";
			}
			
			
			if ($checkhttt==586)
			{
				$hinhttt="Giao nhận tiền (A/d KV.TPHCM)";
			}
			else 
			{
				$hinhttt="Chuyển Khoản Ngâng Hàng (A/d Toàn Qưốc)";
			}
			
		 $body1='<div style="font-size:18px;"><b>Mã đơn hàng:</b> <span>'.$mahoadon.'</span><br />		    
    			<Họ tên:</b> <span>'.$hoten.'</span><br />		  
        		<b>Điện thoại: </b><span>'.$dienthoai.'</span><br />		  
        		<b>Email: </b><span>'.$email.'</span><br />		  
				<b>Tỉnh/Thành: </b><strong>'.$name_tinh.'</strong><br />
				<b>Quận/Huyện: </b><strong>'.$name_huyen.'</strong><br />
           		
				<b>Xuất hóa đơn: </b><span>'.$xuathoadon.'</span><br />
				<b>Hình thức thanh toán: </b><span>'.$hinhttt.'</span><br />
				
				<b>Địa chỉ: </b><span>'.strip_tags($diachi).'</span><br />
				<b>Nội Dung: </b><span>'.strip_tags($noidung).'</span><br />
				<b>Ghi chú: </b><span>'.strip_tags($ghichu).'</span><br /></div>';
				
		$data_send=$body.$body1;		 

		// lấy địa chỉ IP
		$ip_address=getRealIPAddress();
	

			$sql_order = "INSERT INTO  table_order (madonhang,hoten,dienthoai,diachi,email,httt,tonggia,noidung,ghichu,ngaytao,trangthai,ip_address,xuathd,id_httt,id_tinhthanh,id_quanhuyen ) 
				  VALUES ('$mahoadon','$hoten','$dienthoai','$diachi','$email','$httt','$tonggia','$noidung','$ghichu','$ngaydangky','1','$ip_address','$xuathd','$checkhttt','$tinh','$huyen')";	  


				  	
			

				// Thêm đơn hàng vào Database
			mysql_query($sql_order) or die(mysql_error());
			$id_order_inserted = mysql_insert_id(); //lấy id của đơn hàng vừa lưu thành công



				// Duyệt từ phần tử trong giỏ hàng để lưu vào chi tiết đơn hàng
			foreach($_SESSION['cart'] as $item_cart) { 

				// lấy dữ liệu cho từng sản phẩm trong giỏ hàng
    		$d->reset();
    		$sql = "select ten_$lang,id,tenkhongdau_$lang,photo,gia from table_product where id='".$item_cart['productid']."'";
    		$d->query($sql);
    		$item_pro = $d->fetch_array(); 


    		// đơn giá của từng item (màu + giảm giá + option)
    		$price_item = $item_pro['gia'];
			
			
			    		// nếu có id_user ăn hoa hồng và không phải là hình thức thanh toán trả góp
    		if(!empty($item_cart['id_user_hoahong']) && is_user_hoahong($item_cart['id_user_hoahong']) ){
    			$item_hoahong_pro = $price_item*get_percent_hoahong($item_cart['productid'])/100; // lấy số tiền % ăn hoa hồng 1 sản phẩm
    			$total_price_hoahong = $item_hoahong_pro*$item_cart['qty']; // tổng số tiền ăn hoa hồng của sản phẩm đó
    			$link_share = 'http://'.$config_url.'/san-pham/'.$item_pro['tenkhongdau'].'-'.$item_pro['id'].'.html/'.md5($item_cart['id_user_hoahong']);
				if($total_price_hoahong>0){
					$d->reset();
					$sql = "INSERT INTO table_hoahong_detail (id_user,id_product,id_order,tienhoahong,thoigiannhan,noidung,trangthai,quydoi,link_share) 
				  		VALUES ('".$item_cart['id_user_hoahong']."','".$item_pro['id']."','$id_order_inserted','$total_price_hoahong','$ngaydathang','1','1','0','$link_share')";
				  	mysql_query($sql) or die(mysql_error());
				}
    		}


    			// lưu vào bảng chi tiết đơn hàng
    		$sql_order_detail = "INSERT INTO  table_order_detail (id_order,id_product,gia,soluong) 
				  				VALUES ('$id_order_inserted','$item_pro[id]','$price_item','$item_cart[qty]')";	
			mysql_query($sql_order_detail) or die(mysql_error());


			}
			
			/*----------------SEND MAIL CHO KHÁCH HÀNG  VÀ  CHỦ CỬA HÀNG--------------------*/
			$subject = "Đơn đặt hàng từ website Công ty TNHH Marina International Việt Nam ".$row_setting["ten_$lang"];
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
			//$mail->AddAddress($email,$hoten);
			$mail->AddAddress($row_setting['email'],$row_setting["ten_$lang"]);
			
			//Thiết lập email nhận email hồi đáp
			//nếu người nhận nhấn nút Reply
			$mail->AddReplyTo($row_setting['email'],$row_setting["ten_$lang"]);
			
			//print_r($mail);
			//die();
			
			/*=====================================
			 * THIET LAP NOI DUNG EMAIL
			 *=====================================*/
			
			//Thiết lập tiêu đề
			$mail->Subject    = "Đơn đặt hàng từ website ".$row_setting["ten_$lang"];
			
			//Thiết lập định dạng font chữ
			$mail->CharSet = "utf-8";
			
			$mail->AltBody = "To view the message, please use an HTML compatible email viewer!";
			
			//Thiết lập nội dung chính của email
			$mail->MsgHTML($data_send);
			
			if(!$mail->Send()) {
						 transfer( "Có lỗi xảy ra!","index.html");
			} else {
						unset($_SESSION['cart']); 
						transfer("Gửi đơn hàng thành công!<br/>", "index.html");	
			}	
						
			
			$iduser = mysql_insert_id();
			if($httt==2){
				require_once("nganluong.php");
				 //Tài khoản nhận tiền
				$receiver="duyhung862000@yahoo.com";
				//Khai báo url trả về 
				$return_url="http://localhost/tich-hop-nang-cao/complete.php";
				//Giá của cả giỏ hàng 
				$price=$tonggia;
				//Mã giỏ hàng 
				$order_code=$mahoadon;
				//Thông tin giao dịch
				$transaction_info="Hãy lập trình thông tin giao dịch của bạn vào đây";
				//Khai báo đối tượng của lớp NL_Checkout
				$nl= new NL_Checkout();
				//Tạo link thanh toán đến nganluong.vn
				$url= $nl->buildCheckoutUrl($return_url, $receiver, $transaction_info,  $order_code, $price);
				redirect($url);	
			}else{
				 unset($_SESSION['cart']);
				 transfer("Đơn hàng của bạn đã được gửi", "trang-chu.html");
				  
			}
			
	}
	
	}
?>