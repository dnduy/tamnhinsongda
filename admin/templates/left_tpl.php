<?php 
	$d->reset();
	$sql = "select banner_vi from #_banner where com='logo_top'";
	$d->query($sql);
	$logo = $d->fetch_array();
	


?>


<div class="logo"> <a href="../" target="_blank" > <img src="<?=_upload_hinhanh.$logo["banner_vi"]?>" style="width:100%;"  alt="" /> </a></div>
<div class="sidebarSep mt0"></div>
<!-- Left navigation -->
<ul id="menu" class="nav">
  <li class="dash" id="menu1"><a class=" active" title="" href="index.php"><span>Trang chủ</span></a></li>
  

<li class="categories_li<?php if($_GET['typechild']=='banner_chungtoi_project' || $_GET['typeparent']=='project' || $_GET['typechild']=='project' || $_GET['typechild']=='slide_project' || $_GET['typechild']=='taisaochonchungtoi'  ) echo ' activemenu' ?>" id="menu_danhmucproject"><a href="" title="" class="exp"><span>Danh Mục Nội Thất</span><strong></strong></a>
    <ul class="sub">
	

	<?=$atool->generateMenuTypeList("product",array("man_exec"=>"man_list"),"Danh mục cấp 1","","project","product_list")?>

	<?=$atool->generateMenuType("product",array("man_exec"=>"man"),"Danh Sách Dự án","","project","product")?>
	
	<?=$atool->generateMenuType("image_url",array("man_exec"=>"man_photo"),"Slide Dự án","","slide_project","image_url")?> 
	
	<?=$atool->generateMenuType("news",array("man_exec"=>"man"),"Tại sao chọn chúng tôi","","taisaochonchungtoi","news")?> 
		
	<?=$atool->generateMenuType("banner",array("man_exec"=>"capnhat"),"Cập nhật hình Tại sao chọn chúng tôi","","banner_chungtoi_project","banner")?>

    </ul>
  </li>
  
  
  
  
  <li class="categories_li<?php if($_GET['typechild']=='slide_kientruc' || $_GET['typechild']=='taisaochonchungtoi_kt' || $_GET['typechild']=='banner_chungtoi_kt' || $_GET['typeparent']=='kientruc' || $_GET['typechild']=='kientruc' || $_GET['typechild']=='slide_kientruc'  ) echo ' activemenu' ?>" id="menu_danhmuckientruc"><a href="" title="" class="exp"><span>Danh Mục Kiến Trúc</span><strong></strong></a>
    <ul class="sub">
	

	<?=$atool->generateMenuTypeList("product",array("man_exec"=>"man_list"),"Danh mục cấp 1","","kientruc","product_list")?>

	<?=$atool->generateMenuType("product",array("man_exec"=>"man"),"Danh Sách Kiến trúc","","kientruc","product")?>
	
		<?=$atool->generateMenuType("image_url",array("man_exec"=>"man_photo"),"Slide Dự án","","slide_kientruc","image_url")?> 
	
	<?=$atool->generateMenuType("news",array("man_exec"=>"man"),"Tại sao chọn chúng tôi","","taisaochonchungtoi_kt","news")?> 
		
	<?=$atool->generateMenuType("banner",array("man_exec"=>"capnhat"),"Cập nhật hình Tại sao chọn chúng tôi","","banner_chungtoi_kt","banner")?>
	
	
		

    </ul>
  </li>
  
  
  
  
    <li class="categories_li<?php if($_GET['typechild']=='thietbi' || $_GET['typechild']=='bosuutap' || $_GET['typechild']=='hoatdongsanxuat' || $_GET['typechild']=='duan' || $_GET['typechild']=='gioithieu_nt' || $_GET['typechild']=='bg_web_nt' || $_GET['typechild']=='slide_nt' || $_GET['typechild']=='logo_noithat' || $_GET['typeparent']=='noithat' || $_GET['typechild']=='noithat' || $_GET['typechild']=='slide_kientruc'  ) echo ' activemenu' ?>" id="menu_danhmucnoithat"><a href="" title="" class="exp"><span>Danh Mục Đế Vương</span><strong></strong></a>
    <ul class="sub">
	
	<?=$atool->generateMenuTypeList("product",array("man_exec"=>"man_list"),"Danh mục cấp 1","","noithat","product_list")?>
	
	<?=$atool->generateMenuType("product",array("man_exec"=>"man"),"Danh Sách Sản phẩm Nội thất","","noithat","product")?>
	
	
	<?=$atool->generateMenuType("product",array("man_exec"=>"man"),"Danh Sách Dự án Nội thất","","duan","product")?>
	
	<?=$atool->generateMenuType("product",array("man_exec"=>"man"),"Danh Sách Trang thiết bị","","thietbi","product")?>
		
	<?=$atool->generateMenuType("banner",array("man_exec"=>"capnhat"),"Cập nhật Logo Header","","logo_noithat","banner")?> 
	
	
		
	<?=$atool->generateMenuType("image_url",array("man_exec"=>"man_photo"),"Slide Nội thất","","slide_nt","image_url")?> 

	
	<?=$atool->generateMenuType("background",array("man_exec"=>"capnhat"),"Background Web","","bg_web_nt","background")?>  	
	
	
	<?=$atool->generateMenuType("info",array("man_exec"=>"capnhat"),"Giới thiệu","","gioithieu_nt","info")?>  
	
	
	<?=$atool->generateMenuType("news",array("man_exec"=>"man"),"Hoạt động sản xuất","","hoatdongsanxuat","news")?> 	
		
    
	<?=$atool->generateMenuType("news",array("man_exec"=>"man"),"Bộ sưu tập","","bosuutap","news")?> 	
	
	
		<?=$atool->generateMenuType("image_url",array("man_exec"=>"man_photo"),"Mạng xã hội nội thất","","mxh_nt","image_url")?> 
	
		

    </ul>
  </li>
  
  

  


	<li class="article_li<?php if($_GET['typechild']=='news' || $_GET['typechild']=='tuyendung' || $_GET['typechild']=='gioithieu'   ) echo ' activemenu' ?>" id="menu_baiviet"><a href="#" title="" class="exp"><span>Danh Mục Bài Viết</span><strong></strong></a>
		<ul class="sub">
		
		
		
		<?=$atool->generateMenuType("info",array("man_exec"=>"capnhat"),"Giới thiệu","","gioithieu","info")?>  
		
	
		<?=$atool->generateMenuType("news",array("man_exec"=>"man"),"Tuyển dụng","","tuyendung","news")?> 
		
		
		<?=$atool->generateMenuType("news",array("man_exec"=>"man"),"Tin tức","","news","news")?> 	
		
		


	
			
		</ul>
		
	</li>
	
 
  <li class="template_li<?php if($_GET['typechild']=='lienhe'  || $_GET['typechild']=='footer' ) echo ' activemenu' ?>" id="menu_trangtinh"><a href="#" title="" class="exp"><span>Trang tĩnh</span><strong></strong></a>
    <ul class="sub">
    
	<?=$atool->generateMenuType("info",array("man_exec"=>"capnhat"),"Footer","","footer","info")?>  
	
	<?=$atool->generateMenuType("info",array("man_exec"=>"capnhat"),"Liên hệ","","lienhe","info")?> 

    </ul>
  </li>



  
  <li class="gallery_li<?php if( $_GET["typechild"]=="logo_top" ||  $_GET["typechild"]=="logo_home"  || $_GET["com"]=="video" || $_GET["com"]=="background" || $_GET["com"]=="image_url" || $_GET["com"]=="support_online" || $_GET["typechild"]=="bando"  ) echo ' activemenu' ?>" id="menu6"><a href="#" title="" class="exp"><span>Hình Ảnh - Support </span><strong></strong></a>
    <ul class="sub">
	
	
		<?=$atool->generateMenuType("image_url",array("man_exec"=>"man_photo"),"Slide Brochure","","slide_brochure","image_url")?> 
	
	
	<?=$atool->generateMenuType("image_url",array("man_exec"=>"man_photo"),"Hình ảnh Giao Diện","","image_GD","image_url")?> 
	
	
	<?=$atool->generateMenuType("background",array("man_exec"=>"capnhat"),"Background Web","","bg_web","background")?>  	
    

	
	<?=$atool->generateMenuType("banner",array("man_exec"=>"capnhat"),"Cập nhật Logo Home","","logo_home","banner")?> 
	
	<?=$atool->generateMenuType("banner",array("man_exec"=>"capnhat"),"Cập nhật Logo Header","","logo_top","banner")?> 
	

	
	<?=$atool->generateMenuType("image_url",array("man_exec"=>"man_photo"),"Đối tác","","doitac","image_url")?> 

	

	
	
	<?=$atool->generateMenuType("image_url",array("man_exec"=>"man_photo"),"Mạng xã hội Home","","mangxahoi_home","image_url")?> 

	<?=$atool->generateMenuType("image_url",array("man_exec"=>"man_photo"),"Mạng xã hội Footer","","mangxahoi_ft","image_url")?> 
	
	<?=$atool->generateMenuType("bando",array("man_exec"=>"man"),"Bản đồ","","bando","bando")?> 

	<?=$atool->generateMenuType("support_online",array("man_exec"=>"man"),"Hỗ trợ trực tuyến","","support_online","support_online")?> 

    </ul>
  </li>
  

   
  
  
 
<li class="setting_li<?php if($_GET['com']=='contact' || $_GET['com']=='setting' || $_GET['com']=='lang_define' || $_GET['com']=='database' || $_GET['com']=='backup' || $_GET['com']=='user' || $_GET['com']=='newsletter') echo ' activemenu' ?>" id="menu8"><a href="#" title="" class="exp"><span>Cấu hình website</span><strong></strong></a>
 
    <ul class="sub">
 

	   
	<?=$atool->generateMenu("newsletter",array("man_exec"=>"man"),"Đăng Ký Nhận Tin","newsletter")?> 


<?=$atool->generateMenu("contact",array("man_exec"=>"man"),"Mail liên hệ ","contact")?> 
	
	<?=$atool->generateMenu("setting",array("man_exec"=>"capnhat"),"Cấu hình chung","setting")?>
	
	<?=$atool->generateMenu("user",array("man_exec"=>"admin_edit"),"Thông tin Tài khoản","user")?>
  

	</ul>
  </li>
</ul>