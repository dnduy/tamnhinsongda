<?php  if(!defined('_source')) die("Error");
	//include_once _lib."functions_member.php";
	//include_once _lib."functions.php";
	//$cauhinh_hethong=get_cau_hinh();
		
	if (!isset($_SESSION["login_member"]["mauser"],$_SESSION["nguyenngoctan"]))
		
	{
		redirect("http://".$config_url."/index.html");
	}
		
	else
	{
		get_info_trangcanhan();
		
	}
	
	global $d;	
	switch($_GET['act'])
	{
		
		case 'quan-ly-tai-khoan':
			checkLogin();
			getMember();
			$trangcanhan = "quanlytaikhoan";			
			break;
				
		case 'thong-tin-ca-nhan':
			checkLogin();
			getMember();
			change_infouser();
			$trangcanhan = "thongtincanhan";			
			break;
			
		case 'doi-mat-khau':
			checkLogin();
			getMember();
			$trangcanhan = "doimatkhau";
			break;	
			
			
		case 'newsletter':
			checkLogin();
			getMember();
			check_newsletter();
			$trangcanhan = "newsletter";
			break;		
			
		
		case 'change-email':
			checkLogin();
			getMember();
			$trangcanhan = "changeemail";
			break;	
			
		case 'so-dia-chi':
			checkLogin();
			getMember();
			get_infodiachi();
			$trangcanhan = "sodiachi";
			break;		
			
			
		case 'tao-dia-chi':
			checkLogin();
			getMember();
			$trangcanhan = "taodiachi";
			break;		
			
			
		case 'sua-dia-chi':
			checkLogin();
			getMember();
			get_infoaddress();
			$trangcanhan = "suadiachi";
			break;		
			
			
		case 'sua-dia-chi-member':
			checkLogin();
			getMember();
			get_infoaddress_user();
			$trangcanhan = "suadiachimember";
			break;		
			
		
		case 'don-hang-cua-toi':
			checkLogin();
			getMember();
			get_info_orders();
			$trangcanhan = "donhangcuatoi";
			break;	
		
		case 'huy-don-hang':
			checkLogin();
			getMember();
			get_orders_cancel();
			$trangcanhan = "donhanghuy";
			break;
			
	case 'chi-tiet-don-hang':
			checkLogin();
			getMember();
			get_order_detail();
			$trangcanhan = "chitietdonhang";
			break;			
			
			
		case 'phuong-thuc-thanh-toan':
			checkLogin();
			getMember();
			$trangcanhan = "phuongthucthanhtoan";
			break;	
			
			
		case 'quan-ly-doi-tra-hang':
			checkLogin();
			getMember();
			$trangcanhan = "quanlydoitrahang";
			break;		
			
			
		case 'phieu-giam-gia':
			checkLogin();
			getMember();
			$trangcanhan = "phieugiamgia";
			break;		

		case 'diem-tich-luy':
			checkLogin();
			getMember();
			$trangcanhan = "quanlydiemtichluy";
			break;	

		case 'tien-hoa-hong':
			checkLogin();
			getMember();
			$trangcanhan = "quanlyhoahong";
			break;	
			
		case 'share-link':
			checkLogin();
			getMember();
			$trangcanhan = "sharelink";
			break;

		default: 
			checkLogin();
			getMember();
			$trangcanhan = "index";
			break;
	
	}
	

	function checkLogin()
	{
		
		//echo("asdasd");

		global $config_url;
		if (!isset($_SESSION["login_member"]["mauser"]))
		
		{
			redirect("http://".$config_url."/dang-nhap.html");
		}

	}
	
	

	
	
	
	function getMember()
	{
		global $d,$config_url,$item_user;
		
		
		if(isset($_SESSION['login_member']["mauser"], $_SESSION['nguyenngoctan']))
		{
			//Lay thong tin tai khoan
			
			$username = $_SESSION['login_member']['email'];
			$d->reset();
			$sql="select * from #_user where id='".$_SESSION['login_member']['id']."'";
			$d->query($sql);
			$item_user=$d->fetch_array();	
		}

	}
	
	
	
	function check_newsletter()
	{
		global $d,$config_url,$item_newsletter;
		
		
		if(isset($_SESSION['login_member']["mauser"], $_SESSION['nguyenngoctan']))
		{
		//Lay thong tin tai khoan
		
		$email = $_SESSION['login_member']['email'];
		$d->reset();
		$sql="select * from #_newsletter where  email='".$email."' order by id desc ";
		$d->query($sql);
		$item_newsletter=$d->fetch_array();	
		}

	}
	
	
	function change_infouser()
	{
		global $d,$config_url;
		
		
		
		if(isset($_SESSION['login_member']["mauser"], $_SESSION['nguyenngoctan']))
		{
		//Lay thong tin tai khoan
	

			if (!empty($_POST['sub_info'])){
					
					$data['email'] = ($_POST['email_taikhoan']);
					$data['hoten'] = trim(strip_tags($_POST['name']));
					$data['ngaysinh'] = strtotime($_POST['ngaysinh']);
					$data['sex'] = ($_POST['gender']);
					$data['salutation'] = ($_POST['salutation']);
					$data['dienthoai'] = trim(strip_tags($_POST['dienthoai']));
					// $data['diachi'] = trim(strip_tags($_POST['diachi']));
					$data['role'] = 1;
					$data['com'] = "member";

					
					$d->reset();
					$d->setTable('user');
					$d->setWhere('email', $_POST['email_taikhoan']);
					
					
					if ($d->update($data)) {
						//echo 1; //Thành công
						redirect("http://".$config_url."/trang-ca-nhan/quan-ly-tai-khoan/member");
					}
					
					else transfer(_capnhatthatbai, "");
	
			}


			if (!empty($_POST['sub_dkaff'])){
					
					
					// Array ( [hoahong] => on [email_taikhoan] => vmcuongnina@gmail.com [name_bank] => 1 [tenthe] => sdf sdf ds [sothe] => 2132 4324 3242 3432 [exp_month] => 12 [exp_year] => 12 [ccv] => 123 [sub_dkaff] => _dongy )
					if($_POST['hoahong']){
						$dk_hoahong = 1;
					}else{
						$dk_hoahong = 0;
					}
					
					$email = trim(strip_tags($_POST['email_taikhoan']));
					$bank = trim(strip_tags($_POST['name_bank']));
					$tenthe = trim(strip_tags($_POST['tenthe']));
					$sothe = trim(strip_tags($_POST['sothe']));
					$exp_month = trim(strip_tags($_POST['exp_month']));
					$exp_year = trim(strip_tags($_POST['exp_year']));
					$ccv = trim(strip_tags($_POST['ccv']));

					$d->reset();
					$sql = "UPDATE table_user SET dk_hoahong='$dk_hoahong', bank='$bank',tenthe='$tenthe', sothe='$sothe', exp_month='$exp_month', exp_year='$exp_year', ccv='$ccv' WHERE email='$email'";
					if($d->query($sql)){
						transfer(_dkaffsucc, "http://".$config_url."/trang-ca-nhan/thong-tin-ca-nhan/member");
					}else{
						transfer(_capnhatthatbai, "");
					}

			}


		
		}

	}
	
	
	
	
	function get_infodiachi()
		{
			global $d,$config_url,$items_address,$url_link,$totalRows,$pageSize,$offset;
			
			if(isset($_SESSION['login_member']["mauser"], $_SESSION['nguyenngoctan']))
			{
				
		
		
		$d->reset();
		$sql="select * from #_taodiachi where hienthi=1 and id_thanhvien='".$_SESSION['login_member']['id']."' order by id asc";
		$d->query($sql);
		$count_items=$d->result_array();
				
				
				///kiểm tra bộ lọc
		switch(@$_GET['sortby']){
			case "0":
				$sortby = " order by stt asc,id desc";
				break;
			case "1":
				$sortby = " order by hoten asc";
				break;
			case "2":		
				$sortby = " order by hoten desc";
				break;
			case "3":		
				$sortby = " order by ngaytao desc";
				break;
			case "4":
				$sortby = " order by ngaytao asc";
				break;


			default:
				$sortby = " order by id asc";
		}			
		
		//lấy số tin dang trong 1 trang
		@$limit=(int)$_GET['limit'];

		$sql="SELECT count(id) AS numrows FROM #_taodiachi where hienthi=1 and id_thanhvien='".$_SESSION['login_member']['id']."' ";
		$d->query($sql);	
		$dem=$d->fetch_array();
		$totalRows=$dem['numrows'];
		$page=$_GET['curPage'];
		
		$pageSize=4;
		if($limit){
			$pageSize=$limit;
		}
		$offset=5;
							
		if ($page=="")
			$page=1;
		else 
			$page=$_GET['curPage'];
		$page--;
		$bg=$pageSize*$page;	
		
		
		//Lay thong tin hop thu đi messenger theo user
		$d->reset();
			$sql="select * from #_taodiachi where hienthi=1 and id_thanhvien='".$_SESSION['login_member']['id']."'  ".$sortby." limit $bg,$pageSize ";
			$d->query($sql);
			$items_address=$d->result_array();
			
			
		
			
			$sequence = isset($_GET['sortby']) ? "sortby=".$_GET['sortby']."/" : "";
			$url_link="http://".$config_url."/".$_REQUEST["com"]."/".$_REQUEST["act"]."/".$sequence."page";	
			
			if(!empty($_POST))
				{
				$multi=$_REQUEST['multi'];
				$id_array=$_POST['chon'];
				$count=count($id_array);
				
					
					if($multi=='del')
					{
						for($i=0;$i<$count;$i++)
						{
							$sql="SELECT * FROM table_taodiachi where id='".$id_array[$i]."'";
							$d->query($sql);
							$cats= $d->fetch_array();
						
							$sql = "delete from table_taodiachi where id = ".$id_array[$i]."";
							mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
						}
						redirect("http://".$config_url."/".$_REQUEST["com"]."/".$_REQUEST["act"]."");			
					}
					
					
					if($multi=='tinhtrang')
					{
						for($i=0;$i<$count;$i++)
						{
					
							$sql = "UPDATE table_taodiachi SET tinhtrang =1 WHERE  id = ".$id_array[$i]."";
							mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
						}
						redirect("http://".$config_url."/".$_REQUEST["com"]."/".$_REQUEST["act"]."");
					}
				
				
				}
		
		
			

			}
	
		}	
		
		
	function get_infoaddress()
	{
		global $d,$config_url,$item_info;
		
		
		if(isset($_SESSION['login_member']["mauser"], $_SESSION['nguyenngoctan']))
		{
		//Lay thong tin tai khoan
		
		$id_thanhvien = $_SESSION['login_member']['id'];
		
		if ($_GET["id"]!="")
		{
		$id_address=$_GET["id"];
		
		$d->reset();
		$sql="select * from #_taodiachi where  id_thanhvien='".$id_thanhvien."' and id='".$id_address."' order by id desc ";
		$d->query($sql);
		$item_info=$d->fetch_array();	
		
		}
		
		if ($_GET["id_member"]!="")
		{
		$id_member=$_GET["id_member"];	
		
		$d->reset();
		$sql="select * from #_user where  id='".$id_thanhvien."' and id='".$id_member."' order by id desc ";
		$d->query($sql);
		$item_info=$d->fetch_array();	
			
		}
		
		
		
	
		}

	}	
	
	
	
	function get_infoaddress_user()
	{
		global $d,$config_url,$item_info;
		
		
		if(isset($_SESSION['login_member']["mauser"], $_SESSION['nguyenngoctan']))
		{
		//Lay thong tin tai khoan
		
			$id_thanhvien = $_SESSION['login_member']['id'];
			
			
			$id_address=$_GET["id"];
			
			$d->reset();
			$sql="select * from #_user where  id='".$id_thanhvien."' and id='".$id_address."' order by id desc ";
			$d->query($sql);
			$item_info=$d->fetch_array();	
		
	
		}

	}	
	
	function get_orders_cancel()
	{
		global $d,$config_url,$arr_order_cancel;
		
		
		if(isset($_SESSION['login_member']["mauser"], $_SESSION['nguyenngoctan']))
		{
			//Lay thong tin tai khoan
			
			$id_thanhvien = $_SESSION['login_member']['id'];
			
			$d->reset();
			$sql="select * from #_order where hienthi=1 and trangthai=4 and id_thanhvien='".$_SESSION['login_member']['id']."' order by ngaytao desc";

			$d->query($sql);
			$arr_order_cancel=$d->result_array();	
		
	
		}

	}	
	
	
	function get_info_orders()
		{
			global $d,$config_url,$items_order,$url_link,$totalRows,$pageSize,$offset;
			
			if(isset($_SESSION['login_member']["mauser"], $_SESSION['nguyenngoctan']))
			{

				
		//kiểm tra bộ lọc
		switch(@$_GET['sortby']){
			case "0":
				$sortby = " order by stt asc,id desc";
				break;
			case "1":
				$sortby = " order by  hoten asc";
				break;
			case "2":		
				$sortby = " order by hoten desc";
				break;
			case "3":		
				$sortby = " order by tonggia desc";
				break;
			case "4":
				$sortby = " order by tonggia asc";
				break;


			default:
				$sortby = " order by stt asc,id desc";
		}
		
		// lấy time lich su don hang
		
		// lấy loại tin rao
		@$timeLimit=(int)$_GET['timeLimit'];
		
		
		
		if ($timeLimit!=0)
		{
			if ($timeLimit==1)
			{
			
			@$songay=15;
			$sortby_timeLimit=" and ".countDays(date("Y-m-d","ngaytao"))." <= ".@$songay."  ";
			
			
			}
			
			if ($timeLimit==2)
			{
			@$songay=30;
			$sortby_timeLimit=" and  ".countDays(date("Y-m-d","ngaytao"))." <= ".@$songay." ";
			//print_r($sortby_timeLimit);
			}
			
			if ($timeLimit==3)
			{
			@$songay=180;
			$sortby_timeLimit=" and  ".countDays(date("Y-m-d","ngaytao"))." <= ".@$songay." ";
			//print_r($sortby_timeLimit);
			}
		}
		
		if ((int)$_GET["id_dh"]!="")
		{
			$id_dh=$_GET["id_dh"];
			
			$sortby_iddh=" and id='".$id_dh."' ";
			
			
			
		}
		
		
		//lấy số tin dang trong 1 trang
		@$limit=(int)$_GET['limit'];

		$sql="SELECT count(id) AS numrows FROM #_order where hienthi=1 and id_thanhvien='".$_SESSION['login_member']['id']."' ".$sortby_iddh." ";
		$d->query($sql);	
		$dem=$d->fetch_array();
		$totalRows=$dem['numrows'];
		$page=$_GET['curPage'];
		
		$pageSize=4;
		if($limit){
			$pageSize=$limit;
		}
		$offset=5;
							
		if ($page=="")
			$page=1;
		else 
			$page=$_GET['curPage'];
		$page--;
		$bg=$pageSize*$page;	
		
		
			//Lay thong tin DON HANG theo user
			$d->reset();
			$sql="select * from #_order where hienthi=1 and trangthai!=4 and id_thanhvien='".$_SESSION['login_member']['id']."' ".$sortby_timeLimit." ".$sortby_iddh." ".$sortby."  limit $bg,$pageSize ";
			$d->query($sql);
			$items_order=$d->result_array();
			$sequence = isset($_GET['sortby']) ? "sortby=".$_GET['sortby']."/" : "";
			$url_link="http://".$config_url."/".$_REQUEST["com"]."/".$_REQUEST["act"]."/".$sequence."page";	
			
			if(!empty($_POST))
				{
				$multi=$_REQUEST['multi'];
				$id_array=$_POST['chon'];
				$count=count($id_array);
				
					
					if($multi=='del')
					{
						for($i=0;$i<$count;$i++)
						{
							$sql="SELECT * FROM table_order where id='".$id_array[$i]."'";
							$d->query($sql);
							$cats= $d->fetch_array();
						
							$sql = "delete from table_order where id = ".$id_array[$i]."";
							mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
						}
						redirect("http://".$config_url."/".$_REQUEST["com"]."/".$_REQUEST["act"]."/member");			
					}
					
					
					
				
				
				}
		
		
			

			}
	
		}	
	
	
	
	function get_order_detail()
	{
		global $d,$config_url,$item_info;
		
		
		if(isset($_SESSION['login_member']["mauser"], $_SESSION['nguyenngoctan']))
		{
		//Lay thong tin tai khoan
		
		$id_thanhvien = $_SESSION['login_member']['id'];
		
		
		$id_order=$_GET["id"];
		
		$d->reset();
		$sql="select * from #_order where  id_thanhvien='".$id_thanhvien."' and id='".$id_order."' order by id desc ";
		$d->query($sql);
		$item_info=$d->fetch_array();	
		
	
		}

	}	


	
	
	function get_info_trangcanhan()
	{
		global $d,$config_url,$mesg_send,$mesg_recived,$mesg_feedback,$tinda_saved,$paid_posting,$nopaid_posting,$member_info;
		
		
		if(isset($_SESSION['login_member']["mauser"], $_SESSION['nguyenngoctan']))
		{
		//Lay thong tin trang ca nhan
		
		
		$d->reset();
		$sql="select * from #_user where hienthi=1 and id='".$_SESSION['login_member']['id']."' order by id desc ";
		$d->query($sql);
		$member_info=$d->result_array();


		$d->reset();
		$sql="select * from #_taothumoi where hienthi=1 and id_thanhvien='".$_SESSION['login_member']['id']."' order by id desc ";
		$d->query($sql);
		$mesg_send=$d->result_array();
		
		

		


		
		}

	}
	
		
	
	
?>