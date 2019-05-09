<?php
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	$d = new database($config['database']);
	
	$d->reset();
	$sql_setting = "select * from #_setting limit 0,1";
	$d->query($sql_setting);
	$row_setting= $d->fetch_array();
	
	$d->reset();
	$sql_banner_giua = "select banner_$lang from #_banner where com='logo_top' ";
	$d->query($sql_banner_giua);
	$row_logo = $d->fetch_array();
	

	$image="http://".$config_url."/"._upload_hinhanh_l.$row_logo["banner_$lang"]."";
	$url_web="http://".$config_url."/".$com.".html";
	$title_bar=$row_setting["title_$lang"];
	$description_web=strip_tags($row_setting["title_$lang"]);
	
	
	$d->reset();
	$sql="select * from #_lang_define order by id desc";
	$d->query($sql);
	$define=$d->result_array();
	foreach($define as $v){
		@define($v["ten"], $v["lang_".$lang]);
	}
	
	
	switch($com){
		
		case 'langs':
		if(isset($_GET['lang'])){
			switch($_GET['lang']){
				case 'vi':
					$_SESSION['lang']='vi';
					break;
				case 'en':
					$_SESSION['lang']='en';
					break;
				case 'cn':
					$_SESSION['lang']='cn';
					break;	
				case 'ge':
					$_SESSION['lang']='ge';
					break;
				default :
					$_SESSION['lang']='vi';
					break;
				}
			}else{
				$_SESSION['lang']='vi';
			}
			if(@$_GET['loai']=='intro'){
				echo '<script type="text/javascript">
						window.location = "index.html";
					</script>';
			}
		break;
		
		
		case 'all':
			$source = "all";
			break;
		
		case 'affiliate':
			$source = "affiliate";
			$template = "affiliate";
			
	
			case 'tag':
			$source = "tag";
			$template = "tag";
			break;

	
			
		case 'ban-do':
			$source = "map";
			$template ="map";
			break;
		
		
		case 'gioi-thieu':
			$source = "about";
			$com_type = "gioithieu";
			$com_title = _gioithieu;
			$template ="about";
			break;
			
			

	
	case 'kien-truc':
			$source = "product";
			$com_type = "kientruc";
			$com_title = _kientruc;
			$title_other = _kientruclienquan;
			$template =isset($_GET['id']) ? "product_detail" : "product";
			break;
			
			
	case 'thiet-bi':
			$source = "product";
			$com_type = "thietbi";
			$com_title = _thietbi;
			$title_other = _thietbilienquan;
			$template =isset($_GET['id']) ? "product_detail" : "product";
			break;		
			
			
	case 'de-vuong':
			$source = "product";
			$com_type = "noithat";
			$com_title = _devuong;
			$title_other = _devuonglienquan;
			$template =isset($_GET['id']) ? "product_detail" : "product";
			break;		



	case 'noi-that':
			$source = "product";
			$com_type = "project";
			$com_title = _noithat;
			$title_other = _noithatlienquan;
			$template =isset($_GET['id']) ? "product_detail" : "product";
			break;	


	case 'du-an-de-vuong':
			$source = "product";
			$com_type = "duan";
			$com_title = _duan;
			$title_other = _duanlienquan;
			$template =isset($_GET['id']) ? "product_detail" : "product";
			break;	


	case 'san-pham-de-vuong':
			$source = "product";
			$com_type = "noithat";
			$com_title = _devuong;
			$title_other = _devuonglienquan;
			$template =isset($_GET['id']) ? "product_detail" : "product";
			break;	
	

	case 'tuyen-dung':
			$source = "news";
			$com_type = "tuyendung";
			$com_title = _tuyendung;
			$template = isset($_GET['id']) ? "news_detail" : "tuyendung";
			break;		
	

	case 'hoat-dong-san-xuat':
			$source = "news";
			$com_type = "hoatdongsanxuat";
			$com_title = _hoatdongsanxuat;
			$template = isset($_GET['id']) ? "news_detail" : "news";
			break;		


	case 'bo-suu-tap':
			$source = "news";
			$com_type = "bosuutap";
			$com_title = _bosuutap;
			$template = isset($_GET['id']) ? "news_detail" : "news";
			break;				


case 'video-clip':
			$source = "videoclip";
			$com_type = "video";
			$com_title = "Video Clip";
			$template = isset($_GET['id']) ? "video_detail" : "video";
			break;	



case 'dich-vu':
			$source = "news";
			$com_type = "dichvu";
			$com_title = _dichvu;
			$template = isset($_GET['id']) ? "news_detail" : "news";
			break;	
			
	

			
	
	case 'tin-tuc':
			$source = "news";
			$com_type = "news";
			$com_title = _tintuc;
			$template = isset($_GET['id']) ? "news_detail" : "news";
			break;	
			

			

	
	
		case 'lien-he':
			$source = "contact";
			$template = "contact";
			break;
		
		case 'tim-kiem':
			$source = "search";
			$com_title = _sanpham;
			$template = "search";
			break;
			
		case 'doi-tac':
			$source = "doitac";
			$com_type = "doitac";
			$com_title = _doitac;
			$template = "doitac";
			break;	

		case 'gio-hang':
			$source = "giohang";
			$template = "giohang";
			break;	
			
		case 'thanh-toan':
			$source = "thanhtoan";
			$template = "thanhtoan";
			break;		
			
			
			
	/**************************START TRANG CA NHAN **********************/
					
		case 'thoat':
			$source = "logout";
			break;	
			
	
	
		case 'dang-ky':
			$source = "dangky";
			$template ="dangky";
			break;
			
			
		case 'dang-nhap':
			$source = "dangnhap";
			$template ="dangnhap";
			break;

		case 'quen-mat-khau':
			$source = "quenmatkhau";
			$template ="quenmatkhau";
			break;			
	
		case 'kich-hoat-mail':
			$source = "kichhoatmail";
			$template = "kichhoatmail";
			break; 
				

		case 'kiem-tra-don-hang':
			$source = "kiemtradonhang";
			$template = isset($_GET['id']) ? "kiemtradonhang_detail" : "kiemtradonhang";
			break;	
			
	
		case 'trang-ca-nhan':
		
				$source = "trangcanhan";
				$template = "trangcanhan";
				break;

				
			case 'kich-hoat-mail':
			$source = "kichhoatmail";
			$template = "kichhoatmail";
			break; 
					
				
	/**************************END TRANG CA NHAN **********************/
		
			
			
		

		default: 
			$source = "index";
			$template = "index";
			break;
	}
	
	
	
	
	if($source!="") include _source.$source.".php";
	
	if($_REQUEST['com']=='logout')
	{
		session_unregister($login_name);
		header("Location:index.php");
	}		
?>