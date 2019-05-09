<?php if(!@defined('_lib')) die("Error");
/////////////////////////////////////////////////////// Khai Báo Biến Thay Đổi Tên ////////////////////////////////////////////


	$btn_them_active=""; // Nếu $btn_them_active="on" là có sử dụng  
	$btn_hien_active=""; // Nếu $btn_hien_active="on" là có sử dụng  
	$btn_an_active=""; // Nếu $btn_an_active="on" là có sử dụng  
	$btn_xoa_active=""; // Nếu $btn_xoa_active="on" là có sử dụng  
	$check_rating=""; // rating
	$kichthuoc_image=""; // Đặt kích thước ảnh 
	$name_photo=""; // Đặt tiêu đề cho mục hình ảnh
	$name_cap=""; // Đặt tiêu đề cho danh mục và bài viết
	$image_active=""; // Nếu $image_active="on" là có sử dụng add ảnh 

	if ($_GET["com"]=="product" || $_REQUEST['typeparent']=='product' || $_REQUEST['typechild']=='product')
	{


		//Thêm Cấp 1


		if($_REQUEST['typeparent']=='product' && ($_GET["act"]=="man_list" ||  $_GET["act"]=="add_list") )
		{

			$kichthuoc_image="Width: 640px - Height: 420px";
			$name_cap="Thêm Danh Mục Sản Phẩm Cấp 1";
			$icon_active="off";
			$image_active="on";
			$check_httc="on";
			$mota_active ="on";
			
			
		}



		//Sửa Cấp 1


		if($_REQUEST['typeparent']=='product' && $_GET["act"]=="edit_list" )
		{

			$kichthuoc_image="Width: 640px - Height: 420px";
			$name_cap="Sửa Danh Mục Sản Phẩm Cấp 1";
			$image_active="on";
			$icon_active="off";
			$mota_active ="on";
			
		}



		//Thêm Cấp 2


		if($_REQUEST['typeparent']=='product' && ($_GET["act"]=="man_cat" ||  $_GET["act"]=="add_cat") )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Thêm Danh Mục Sản Phẩm Cấp 2";
			$image_active="off";
			$check_httc="off";
			
		}



		//Sửa Cấp 2


		if($_REQUEST['typeparent']=='product' && $_GET["act"]=="edit_cat" )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Sửa Danh Mục Sản Phẩm Cấp 2";
			$image_active="off";
			$check_httc="off";
			
		}





		//Thêm Cấp 3


		if($_REQUEST['typeparent']=='product' &&  ($_GET["act"]=="man_item" || $_GET["act"]=="add_item") )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Thêm Danh Mục Sản Phẩm Cấp 3";
			$image_active="off";
			
		}



		//Sửa Cấp 3


		if($_REQUEST['typeparent']=='product' && $_GET["act"]=="edit_item")
		{ 

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Sửa Danh Mục Sản Phẩm Cấp 3";
			$image_active="off";
			
		}






		//Thêm Cấp 4


		if($_REQUEST['typeparent']=='product' && ($_GET["act"]=="man_sub" || $_GET["act"]=="add_sub") )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Thêm Danh Mục Sản Phẩm Cấp 4";
			$image_active="on";
			
		}



		//Sửa Cấp 4


		if($_REQUEST['typeparent']=='product' && $_GET["act"]=="edit_sub")
		{ 

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Sửa Danh Mục Sản Phẩm Cấp 4";
			$image_active="on";
			
		}





		//Thêm Danh Sach San Pham


		if($_REQUEST['typechild']=='product'  && ($_GET["act"]=="man" || $_GET["act"]=="add" ) )
		{

			$kichthuoc_image="Width: 600px - Height: 600px";
			$name_cap="Thêm Danh Sách Sản Phẩm ";
			$image_active="on";
			$mutile_image_active="on";

			$check_rating="off";


			$mota_active ="on";
			$noidung_active="on";

			$danhmuc_cap1="on";
			$danhmuc_cap2="on";
			$danhmuc_cap3="on";
			$danhmuc_cap4="off";


			$check_moi="off";
			$check_noibat="on";
			$check_hot="off";
			$check_km="off";


			$btn_them_active="on";  
			$btn_hien_active="on"; 
			$btn_an_active="on"; 
			$btn_sua_active="on"; 
			$btn_xoa_active="on"; 
			
		}



		//Sửa Danh Sách Sản Phẩm


		if($_REQUEST['typechild']=='product' &&  $_GET["act"]=="edit")
		{ 

			$kichthuoc_image="Width: 600px - Height: 600px";
			$name_cap="Sửa Danh Sách Sản Phẩm";
			$image_active="on";
			$mutile_image_active="on";

			$check_rating="off";


			$mota_active ="on";
			$noidung_active="on";

			$danhmuc_cap1="on";
			$danhmuc_cap2="on";
			$danhmuc_cap3="on";
			$danhmuc_cap4="off";




			$btn_them_active="on";  
			$btn_hien_active="on"; 
			$btn_an_active="on"; 
			$btn_sua_active="on"; 
			$btn_xoa_active="on"; 
			
		}
	





	}





		/*********************************Start Danh Muc Project *******************************************/




	if ($_GET["com"]=="product" || $_REQUEST['typeparent']=='project' || $_REQUEST['typechild']=='project')
	{


		//Thêm Cấp 1


		if($_REQUEST['typeparent']=='project' && ($_GET["act"]=="man_list" ||  $_GET["act"]=="add_list") )
		{

			$kichthuoc_image="Width: 370px - Height: 230px";
			$kichthuoc_icon="Width: 45px - Height: 45px";
			$name_cap="Thêm Danh Mục Dự án cấp 1";
			$image_active="off";
			$icon_active="on";
			$check_httc="off";
			$mota_active="on";
			
		}



		//Sửa Cấp 1


		if($_REQUEST['typeparent']=='project' && $_GET["act"]=="edit_list" )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$kichthuoc_icon="Width: 45px - Height: 45px";
			$name_cap="Sửa Danh Mục Dự án Cấp 1";
			$image_active="off";
			$icon_active="on";
			$mota_active="on";
			
		}



		//Thêm Cấp 2


		if($_REQUEST['typeparent']=='project' && ($_GET["act"]=="man_cat" ||  $_GET["act"]=="add_cat") )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Thêm Danh Mục Dự Án Cấp 2";
			$image_active="off";
			
		}



		//Sửa Cấp 2


		if($_REQUEST['typeparent']=='project' && $_GET["act"]=="edit_cat" )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Sửa Danh Mục Dự Án Cấp 2";
			$image_active="off";
			
		}





		//Thêm Cấp 3


		if($_REQUEST['typeparent']=='project' &&  ($_GET["act"]=="man_item" || $_GET["act"]=="add_item") )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Thêm Danh Mục Dự Án Cấp 3";
			$image_active="on";
			
		}



		//Sửa Cấp 3


		if($_REQUEST['typeparent']=='project' && $_GET["act"]=="edit_item")
		{ 

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Sửa Danh Mục Dự Án Cấp 3";
			$image_active="on";
			
		}






		//Thêm Cấp 4


		if($_REQUEST['typeparent']=='project' && ($_GET["act"]=="man_sub" || $_GET["act"]=="add_sub") )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Thêm Danh Mục Dự Án Cấp 4";
			$image_active="on";
			
		}



		//Sửa Cấp 4


		if($_REQUEST['typeparent']=='project' && $_GET["act"]=="edit_sub")
		{ 

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Sửa Danh Mục Dự án Cấp 4";
			$image_active="on";
			
		}





		//Thêm Danh Sach San Pham


		if($_REQUEST['typechild']=='project'  && ($_GET["act"]=="man" || $_GET["act"]=="add" ) )
		{

			$kichthuoc_image="Width: 600px - Height: 600px";
			$name_cap="Thêm Danh Sách Dự Án ";
			$image_active="on";
			$mutile_image_active="on";

			$check_rating="off";


			$mota_active ="on";
			$noidung_active="on";

			$danhmuc_cap1="on";
			$danhmuc_cap2="off";
			$danhmuc_cap3="off";
			$danhmuc_cap4="off";


			$check_moi="off";


			$check_noibat="on";


			$btn_them_active="on";  
			$btn_hien_active="on"; 
			$btn_an_active="on"; 
			$btn_sua_active="on"; 
			$btn_xoa_active="on"; 
			
		}



		//Sửa Danh Sách Sản Phẩm


		if($_REQUEST['typechild']=='project' &&  $_GET["act"]=="edit")
		{ 

			$kichthuoc_image="Width: 600px - Height: 600px";
			$name_cap="Sửa Danh Sách Dự Án";
			$image_active="on";
			$mutile_image_active="on";

			$check_rating="off";


			$mota_active ="on";
			$noidung_active="on";

			$danhmuc_cap1="on";
			$danhmuc_cap2="off";
			$danhmuc_cap3="off";
			$danhmuc_cap4="off";




			$btn_them_active="on";  
			$btn_hien_active="on"; 
			$btn_an_active="on"; 
			$btn_sua_active="on"; 
			$btn_xoa_active="on"; 
			
		}
	





	}




	
	
	
	if ($_GET["com"]=="product" || $_REQUEST['typeparent']=='kientruc' || $_REQUEST['typechild']=='kientruc')
	{


		//Thêm Cấp 1


		if($_REQUEST['typeparent']=='kientruc' && ($_GET["act"]=="man_list" ||  $_GET["act"]=="add_list") )
		{

			$kichthuoc_image="Width: 370px - Height: 230px";
			$kichthuoc_icon="Width: 45px - Height: 45px";
			$name_cap="Thêm Danh Mục cấp 1";
			$image_active="off";
			$icon_active="on";
			$check_httc="off";
			$mota_active="on";
			
		}



		//Sửa Cấp 1


		if($_REQUEST['typeparent']=='kientruc' && $_GET["act"]=="edit_list" )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$kichthuoc_icon="Width: 45px - Height: 45px";
			$name_cap="Sửa Danh Mục Cấp 1";
			$image_active="off";
			$icon_active="on";
			$mota_active="on";
			
		}



		//Thêm Cấp 2


		if($_REQUEST['typeparent']=='kientruc' && ($_GET["act"]=="man_cat" ||  $_GET["act"]=="add_cat") )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Thêm Danh Mục Cấp 2";
			$image_active="off";
			
		}



		//Sửa Cấp 2


		if($_REQUEST['typeparent']=='kientruc' && $_GET["act"]=="edit_cat" )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Sửa Danh Mục Cấp 2";
			$image_active="off";
			
		}





		//Thêm Cấp 3


		if($_REQUEST['typeparent']=='kientruc' &&  ($_GET["act"]=="man_item" || $_GET["act"]=="add_item") )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Thêm Danh Mục Cấp 3";
			$image_active="on";
			
		}



		//Sửa Cấp 3


		if($_REQUEST['typeparent']=='kientruc' && $_GET["act"]=="edit_item")
		{ 

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Sửa Danh Mục Cấp 3";
			$image_active="on";
			
		}






		//Thêm Cấp 4


		if($_REQUEST['typeparent']=='kientruc' && ($_GET["act"]=="man_sub" || $_GET["act"]=="add_sub") )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Thêm Danh Mục Cấp 4";
			$image_active="on";
			
		}



		//Sửa Cấp 4


		if($_REQUEST['typeparent']=='kientruc' && $_GET["act"]=="edit_sub")
		{ 

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Sửa Danh Mục Cấp 4";
			$image_active="on";
			
		}





		//Thêm Danh Sach San Pham


		if($_REQUEST['typechild']=='kientruc'  && ($_GET["act"]=="man" || $_GET["act"]=="add" ) )
		{

			$kichthuoc_image="Width: 600px - Height: 600px";
			$name_cap="Thêm Danh Sách Kiến Trúc ";
			$image_active="on";
			$mutile_image_active="on";

			$check_rating="off";


			$mota_active ="on";
			$noidung_active="on";

			$danhmuc_cap1="on";
			$danhmuc_cap2="off";
			$danhmuc_cap3="off";
			$danhmuc_cap4="off";


			$check_moi="off";


			$check_noibat="on";


			$btn_them_active="on";  
			$btn_hien_active="on"; 
			$btn_an_active="on"; 
			$btn_sua_active="on"; 
			$btn_xoa_active="on"; 
			
		}



		//Sửa Danh Sách Sản Phẩm


		if($_REQUEST['typechild']=='kientruc' &&  $_GET["act"]=="edit")
		{ 

			$kichthuoc_image="Width: 600px - Height: 600px";
			$name_cap="Sửa Danh Sách Kiến trúc";
			$image_active="on";
			$mutile_image_active="on";

			$check_rating="off";


			$mota_active ="on";
			$noidung_active="on";

			$danhmuc_cap1="on";
			$danhmuc_cap2="off";
			$danhmuc_cap3="off";
			$danhmuc_cap4="off";




			$btn_them_active="on";  
			$btn_hien_active="on"; 
			$btn_an_active="on"; 
			$btn_sua_active="on"; 
			$btn_xoa_active="on"; 
			
		}
	





	}




	
		if ($_GET["com"]=="product" || $_REQUEST['typeparent']=='noithat' || $_REQUEST['typechild']=='noithat')
	{


		//Thêm Cấp 1


		if($_REQUEST['typeparent']=='noithat' && ($_GET["act"]=="man_list" ||  $_GET["act"]=="add_list") )
		{

			$kichthuoc_image="Width: 370px - Height: 230px";
			$kichthuoc_icon="Width: 45px - Height: 45px";
			$name_cap="Thêm Danh Mục cấp 1";
			$image_active="off";
			$icon_active="off";
			$check_httc="off";
			$mota_active="off";
			
		}



		//Sửa Cấp 1


		if($_REQUEST['typeparent']=='noithat' && $_GET["act"]=="edit_list" )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$kichthuoc_icon="Width: 45px - Height: 45px";
			$name_cap="Sửa Danh Mục Cấp 1";
			$image_active="off";
			$icon_active="off";
			$mota_active="off";
			
		}



		//Thêm Cấp 2


		if($_REQUEST['typeparent']=='noithat' && ($_GET["act"]=="man_cat" ||  $_GET["act"]=="add_cat") )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Thêm Danh Mục Cấp 2";
			$image_active="off";
			
		}



		//Sửa Cấp 2


		if($_REQUEST['typeparent']=='noithat' && $_GET["act"]=="edit_cat" )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Sửa Danh Mục Cấp 2";
			$image_active="off";
			
		}





		//Thêm Cấp 3


		if($_REQUEST['typeparent']=='noithat' &&  ($_GET["act"]=="man_item" || $_GET["act"]=="add_item") )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Thêm Danh Mục Cấp 3";
			$image_active="on";
			
		}



		//Sửa Cấp 3


		if($_REQUEST['typeparent']=='noithat' && $_GET["act"]=="edit_item")
		{ 

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Sửa Danh Mục Cấp 3";
			$image_active="on";
			
		}






		//Thêm Cấp 4


		if($_REQUEST['typeparent']=='noithat' && ($_GET["act"]=="man_sub" || $_GET["act"]=="add_sub") )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Thêm Danh Mục Cấp 4";
			$image_active="on";
			
		}



		//Sửa Cấp 4


		if($_REQUEST['typeparent']=='noithat' && $_GET["act"]=="edit_sub")
		{ 

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Sửa Danh Mục Cấp 4";
			$image_active="on";
			
		}





		//Thêm Danh Sach San Pham


		if($_REQUEST['typechild']=='noithat'  && ($_GET["act"]=="man" || $_GET["act"]=="add" ) )
		{

			$kichthuoc_image="Width: 600px - Height: 600px";
			$name_cap="Thêm Danh Sách Nội thất ";
			$image_active="on";
			$mutile_image_active="on";

			$check_rating="off";


			$mota_active ="on";
			$noidung_active="on";

			$danhmuc_cap1="on";
			$danhmuc_cap2="off";
			$danhmuc_cap3="off";
			$danhmuc_cap4="off";


			$check_moi="off";


			$check_noibat="on";


			$btn_them_active="on";  
			$btn_hien_active="on"; 
			$btn_an_active="on"; 
			$btn_sua_active="on"; 
			$btn_xoa_active="on"; 
			
		}



		//Sửa Danh Sách Sản Phẩm


		if($_REQUEST['typechild']=='noithat' &&  $_GET["act"]=="edit")
		{ 

			$kichthuoc_image="Width: 600px - Height: 600px";
			$name_cap="Sửa Danh Sách Nội thất";
			$image_active="on";
			$mutile_image_active="on";

			$check_rating="off";


			$mota_active ="on";
			$noidung_active="on";

			$danhmuc_cap1="on";
			$danhmuc_cap2="off";
			$danhmuc_cap3="off";
			$danhmuc_cap4="off";




			$btn_them_active="on";  
			$btn_hien_active="on"; 
			$btn_an_active="on"; 
			$btn_sua_active="on"; 
			$btn_xoa_active="on"; 
			
		}
	





	}


	
	
	
	
	
		if ($_GET["com"]=="product" || $_REQUEST['typeparent']=='duan' || $_REQUEST['typechild']=='duan')
	{



		//Thêm Danh Sach San Pham


		if($_REQUEST['typechild']=='duan'  && ($_GET["act"]=="man" || $_GET["act"]=="add" ) )
		{

			$kichthuoc_image="Width: 600px - Height: 600px";
			$name_cap="Thêm Danh Sách Dự án ";
			$image_active="on";
			$mutile_image_active="on";

			$check_rating="off";


			$mota_active ="on";
			$noidung_active="on";

			$danhmuc_cap1="off";
			$danhmuc_cap2="off";
			$danhmuc_cap3="off";
			$danhmuc_cap4="off";


			$check_moi="off";


			$check_noibat="on";


			$btn_them_active="on";  
			$btn_hien_active="on"; 
			$btn_an_active="on"; 
			$btn_sua_active="on"; 
			$btn_xoa_active="on"; 
			
		}



		//Sửa Danh Sách Sản Phẩm


		if($_REQUEST['typechild']=='duan' &&  $_GET["act"]=="edit")
		{ 

			$kichthuoc_image="Width: 600px - Height: 600px";
			$name_cap="Sửa Danh Sách Dự án";
			$image_active="on";
			$mutile_image_active="on";

			$check_rating="off";


			$mota_active ="on";
			$noidung_active="on";

			$danhmuc_cap1="off";
			$danhmuc_cap2="off";
			$danhmuc_cap3="off";
			$danhmuc_cap4="off";




			$btn_them_active="on";  
			$btn_hien_active="on"; 
			$btn_an_active="on"; 
			$btn_sua_active="on"; 
			$btn_xoa_active="on"; 
			
		}
	





	}


	
	
	
	
	
		if ($_GET["com"]=="product" || $_REQUEST['typeparent']=='thietbi' || $_REQUEST['typechild']=='thietbi')
	{



		//Thêm Danh Sach San Pham


		if($_REQUEST['typechild']=='thietbi'  && ($_GET["act"]=="man" || $_GET["act"]=="add" ) )
		{

			$kichthuoc_image="Width: 600px - Height: 600px";
			$name_cap="Thêm Danh Sách Thiết bị ";
			$image_active="on";
			$mutile_image_active="on";

			$check_rating="off";


			$mota_active ="on";
			$noidung_active="on";

			$danhmuc_cap1="off";
			$danhmuc_cap2="off";
			$danhmuc_cap3="off";
			$danhmuc_cap4="off";


			$check_moi="off";


			$check_noibat="on";


			$btn_them_active="on";  
			$btn_hien_active="on"; 
			$btn_an_active="on"; 
			$btn_sua_active="on"; 
			$btn_xoa_active="on"; 
			
		}



		//Sửa Danh Sách Sản Phẩm


		if($_REQUEST['typechild']=='thietbi' &&  $_GET["act"]=="edit")
		{ 

			$kichthuoc_image="Width: 600px - Height: 600px";
			$name_cap="Sửa Danh Sách Thiết bị";
			$image_active="on";
			$mutile_image_active="on";

			$check_rating="off";


			$mota_active ="on";
			$noidung_active="on";

			$danhmuc_cap1="off";
			$danhmuc_cap2="off";
			$danhmuc_cap3="off";
			$danhmuc_cap4="off";




			$btn_them_active="on";  
			$btn_hien_active="on"; 
			$btn_an_active="on"; 
			$btn_sua_active="on"; 
			$btn_xoa_active="on"; 
			
		}
	





	}


	
	
	
		/*********************************End Danh Muc Project *******************************************/

		

/***********************************************************Start Muc Luc Tin Tức ********************************************/


	if ($_GET["com"]=="news")
	{


		//Thêm Cấp 1


		if($_REQUEST['typeparent']=='news' &&  ( $_GET["act"]=="man_list" || $_GET["act"]=="add_list") )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Thêm Danh Mục Tin Cấp 1";
			$image_active="off";
			$menutop_active="on";
			$rename_menutop="Nhóm Menu top";
			
			$nhomtin_active="on";
			$rename_nhomtin="Nhóm Tin Nổi Bật";
			
		}



		//Sửa Cấp 1


		if($_REQUEST['typeparent']=='news' && $_GET["act"]=="edit_list" )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Sửa Danh Mục Tin Cấp 1";
			$image_active="off";
			$menutop_active="on";
			$rename_menutop="Nhóm Menu top";
			
			$nhomtin_active="on";
			$rename_nhomtin="Nhóm Tin Nổi Bật";
			
		}



		//Thêm Cấp 2


		if($_REQUEST['typeparent']=='news' && ( $_GET["act"]=="man_cat" || $_GET["act"]=="add_cat") )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Thêm Danh Mục Tin Cấp 2";
			$image_active="off";
			
		}



		//Sửa Cấp 2


		if($_REQUEST['typeparent']=='news' && $_GET["act"]=="edit_cat" )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Sửa Danh Mục Tin Cấp 2";
			$image_active="off";
			
		}





			//Thêm Cấp 3


		if($_REQUEST['typeparent']=='news' && ($_GET["act"]=="man_item" || $_GET["act"]=="add_item") )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Thêm Danh Mục Tin Cấp 3";
			$image_active="on";
			
		}



		//Sửa Cấp 3


		if($_REQUEST['typeparent']=='news' && $_GET["act"]=="edit_item"  )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Sửa Danh Mục Tin Cấp 3";
			$image_active="on";
			
		}




		//Thêm Cấp 4


		if($_REQUEST['typeparent']=='news' && ( $_GET["act"]=="man_sub" || $_GET["act"]=="add_sub") )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Thêm Danh Mục Tin Cấp 4";
			$image_active="on";
			
		}



		//Sửa Cấp 4


		if($_REQUEST['typeparent']=='news' && $_GET["act"]=="edit_sub" )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Sửa Danh Mục Tin Cấp 4";
			$image_active="on";
			
		}



		//Thêm Danh Sách Tin 


		if($_REQUEST['typechild']=='news' && $_GET["act"]=="man" || $_GET["act"]=="add")
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Thêm Danh Sách Tin";
		

			$btn_them_active="on";  
			$btn_hien_active="on"; 
			$btn_an_active="on"; 
			$btn_sua_active="on"; 
			$btn_xoa_active="on"; 

			$check_tinnoibat="on";
			$rename_tinnoibat="Tin nổi bật";

			$check_tinmoi="off"; 
			$rename_tinmoi="Tin mới"; 

			$danhmuc_cap1="off";
			$danhmuc_cap2="off";
			$danhmuc_cap3="off";
			$danhmuc_cap4="off";
			
			$image_active ="on";
			$mutile_image_active="off";

			$mota_active ="on";
			$noidung_active="on";
			
		}



		//Sửa Danh Sách Tin 


		if($_REQUEST['typechild']=='news' && $_GET["act"]=="edit" )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Sửa Danh Sách Tin";
			
			$danhmuc_cap1="off";
			$danhmuc_cap2="off";
			$danhmuc_cap3="off";
			$danhmuc_cap4="off";

			$image_active="on";
			$mutile_image_active="off";


			$mota_active ="on";
			$noidung_active="on";

			
		}



	}


	/***********************************************************End Muc Luc Tin Tức ********************************************/


	//Thêm Cấp 1


		if($_REQUEST['typeparent']=='video' &&  ( $_GET["act"]=="man_list" || $_GET["act"]=="add_list") )
		{

			$kichthuoc_image="Width: 365px - Height: 245px";
			$name_cap="Thêm Danh Video Cấp 1";
			$image_active="off";
			$nhomtin_active="on";
			$rename_nhomtin="Nhóm Tin Nổi Bật";
			$mota_active ="off";
			
		}



		//Sửa Cấp 1


		if($_REQUEST['typeparent']=='video' && $_GET["act"]=="edit_list" )
		{

			$kichthuoc_image="Width: 365px - Height: 245px";
			$name_cap="Sửa Danh Video Cấp 1";
			$image_active="off";
			$nhomtin_active="on";
			$rename_nhomtin="Nhóm Tin Nổi Bật";
			$mota_active ="off";
			
		}


		
		//Thêm Cấp 2


		if($_REQUEST['typeparent']=='video' && ( $_GET["act"]=="man_cat" || $_GET["act"]=="add_cat") )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Thêm Danh Mục Video Cấp 2";
			$image_active="off";
			
		}



		//Sửa Cấp 2


		if($_REQUEST['typeparent']=='video' && $_GET["act"]=="edit_cat" )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Sửa Danh Mục Video Cấp 2";
			$image_active="off";
			
		}
		
		
		
		
		
		//Thêm Cấp 3


		if($_REQUEST['typeparent']=='video' && ( $_GET["act"]=="man_item" || $_GET["act"]=="add_item") )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Thêm Danh Mục Video Cấp 3";
			$image_active="off";
			
		}



		//Sửa Cấp 3


		if($_REQUEST['typeparent']=='video' && $_GET["act"]=="edit_item" )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Sửa Danh Mục Video Cấp 3";
			$image_active="off";
			
		}




		//Thêm Danh Sách Tin 


		if($_REQUEST['typechild']=='video' && ($_GET["act"]=="man" || $_GET["act"]=="add") )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Thêm Danh Sách Video";
		

			$btn_them_active="on";  
			$btn_hien_active="on"; 
			$btn_an_active="on"; 
			$btn_sua_active="on"; 
			$btn_xoa_active="on"; 

			$check_tinnoibat="on";
			$rename_tinnoibat="Tin nổi bật";

			$check_tinmoi="off"; 
			$rename_tinmoi="Tin mới"; 

			$danhmuc_cap1="on";
			$danhmuc_cap2="on";
			$danhmuc_cap3="on";
			$danhmuc_cap4="off";
			
			$image_active ="off";
			$mutile_image_active="off";

			$mota_active ="off";
			$noidung_active="on";
			
			$link_active ="on";
			
		}



		//Sửa Danh Sách Tin 


		if($_REQUEST['typechild']=='video' && $_GET["act"]=="edit" )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Sửa Danh Sách Video";
			
			$danhmuc_cap1="on";
			$danhmuc_cap2="on";
			$danhmuc_cap3="on";
			$danhmuc_cap4="off";

			$image_active="off";
			$mutile_image_active="off";


			$mota_active ="off";
			$noidung_active="on";
			
			$link_active ="on";

			
		}



/***********************************************************Start Muc Luc Cập Nhật Nhiều Bài Viết ********************************************/	


	if ($_GET["com"]=="news"  )
	{
		
	
		
		//Thêm Danh Sách Tin 
		
		if($_REQUEST['typechild']=='httt' &&  ($_GET["act"]=="man" || $_GET["act"]=="add" ) )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Thêm Hình thức thanh toán";
			
			$image_active ="off";
			$mutile_image_active="off";


			$mota_active ="off";
			$noidung_active="on";

			$danhmuc_cap1="off";
			$danhmuc_cap2="off";
			$danhmuc_cap3="off";
			$danhmuc_cap4="off";

			$check_tinnoibat="off";
			$rename_tinnoibat="Tin nổi bật";

			$check_tinmoi="off"; 
			$rename_tinmoi="Tin mới"; 


			$btn_them_active="on";  
			$btn_hien_active="on"; 
			$btn_an_active="on"; 
			$btn_sua_active="on"; 
			$btn_xoa_active="on"; 
			
		}



		//Sửa Danh Sách Tin 


		if($_REQUEST['typechild']=='httt' && $_GET["act"]=="edit" )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Sửa Hình thức thanh toán";
			
			$image_active="off";
			$mutile_image_active="off";

			$mota_active ="off";
			$noidung_active="on";

			$danhmuc_cap1="off";
			$danhmuc_cap2="off";
			$danhmuc_cap3="off";
			$danhmuc_cap4="off";



			
		}


		//Thêm Danh Sách Tin 

		if($_REQUEST['typechild']=='taisaochonchungtoi' && ($_GET["act"]=="man" || $_GET["act"]=="add") )
		{

			$kichthuoc_image="Width: 40px - Height: 40px";
			$name_cap="Thêm Tại sao chọn chúng tôi";


			$btn_them_active="on";  
			$btn_hien_active="on"; 
			$btn_an_active="on"; 
			$btn_sua_active="on"; 
			$btn_xoa_active="on"; 

			$check_tinnoibat="off";
			$rename_tinnoibat="Tin nổi bật";

			$check_tinmoi="off"; 
			$rename_tinmoi="Tin mới"; 

			$danhmuc_cap1="off";
			$danhmuc_cap2="off";
			$danhmuc_cap3="off";
			$danhmuc_cap4="off";
			
			$image_active ="on";
			$mutile_image_active="off";

			$mota_active ="on";
			$noidung_active="off";
			
		}



		//Sửa Danh Sách Tin 


		if($_REQUEST['typechild']=='taisaochonchungtoi' && $_GET["act"]=="edit" )
		{

			$kichthuoc_image="Width: 40px - Height: 40px";
			$name_cap="Sửa Tại sao chọn chúng tôi";

			$danhmuc_cap1="off";
			$danhmuc_cap2="off";
			$danhmuc_cap3="off";
			$danhmuc_cap4="off";

			$image_active="on";
			$mutile_image_active="off";


			$mota_active ="on";
			$noidung_active="off";

		}
		
		
		
		
		
		
		//Thêm Danh Sách Tin 

		if($_REQUEST['typechild']=='taisaochonchungtoi_kt' && ($_GET["act"]=="man" || $_GET["act"]=="add") )
		{

			$kichthuoc_image="Width: 40px - Height: 40px";
			$name_cap="Thêm Tại sao chọn chúng tôi";


			$btn_them_active="on";  
			$btn_hien_active="on"; 
			$btn_an_active="on"; 
			$btn_sua_active="on"; 
			$btn_xoa_active="on"; 

			$check_tinnoibat="off";
			$rename_tinnoibat="Tin nổi bật";

			$check_tinmoi="off"; 
			$rename_tinmoi="Tin mới"; 

			$danhmuc_cap1="off";
			$danhmuc_cap2="off";
			$danhmuc_cap3="off";
			$danhmuc_cap4="off";
			
			$image_active ="on";
			$mutile_image_active="off";

			$mota_active ="on";
			$noidung_active="off";
			
		}



		//Sửa Danh Sách Tin 


		if($_REQUEST['typechild']=='taisaochonchungtoi_kt' && $_GET["act"]=="edit" )
		{

			$kichthuoc_image="Width: 40px - Height: 40px";
			$name_cap="Sửa Tại sao chọn chúng tôi";

			$danhmuc_cap1="off";
			$danhmuc_cap2="off";
			$danhmuc_cap3="off";
			$danhmuc_cap4="off";

			$image_active="on";
			$mutile_image_active="off";


			$mota_active ="on";
			$noidung_active="off";

		}





		//Thêm Danh Sách Tin 

		if($_REQUEST['typechild']=='hoatdongsanxuat' && ($_GET["act"]=="man" || $_GET["act"]=="add") )
		{

			$kichthuoc_image="Width: 380px - Height: 260px";
			$name_cap="Thêm Hoạt động sản xuất";


			$btn_them_active="on";  
			$btn_hien_active="on"; 
			$btn_an_active="on"; 
			$btn_sua_active="on"; 
			$btn_xoa_active="on"; 

			$check_tinnoibat="on";
			$rename_tinnoibat="Tin nổi bật";

			$check_tinmoi="off"; 
			$rename_tinmoi="Tin mới"; 

			$danhmuc_cap1="off";
			$danhmuc_cap2="off";
			$danhmuc_cap3="off";
			$danhmuc_cap4="off";
			
			$image_active ="on";
			$mutile_image_active="off";

			$mota_active ="on";
			$noidung_active="on";
			
		}



		//Sửa Danh Sách Tin 


		if($_REQUEST['typechild']=='hoatdongsanxuat' && $_GET["act"]=="edit" )
		{

			$kichthuoc_image="Width: 380px - Height: 260px";
			$name_cap="Sửa Hoạt động sản xuất";

			$danhmuc_cap1="off";
			$danhmuc_cap2="off";
			$danhmuc_cap3="off";
			$danhmuc_cap4="off";

			$image_active="on";
			$mutile_image_active="off";


			$mota_active ="on";
			$noidung_active="on";

			
		}




		
		
		
				//Thêm Danh Sách Tin 

		if($_REQUEST['typechild']=='bosuutap' && ($_GET["act"]=="man" || $_GET["act"]=="add") )
		{

			$kichthuoc_image="Width: 320px - Height: 255px";
			$name_cap="Thêm Bộ sưu tập";


			$btn_them_active="on";  
			$btn_hien_active="on"; 
			$btn_an_active="on"; 
			$btn_sua_active="on"; 
			$btn_xoa_active="on"; 

			$check_tinnoibat="on";
			$rename_tinnoibat="Tin nổi bật";

			$check_tinmoi="off"; 
			$rename_tinmoi="Tin mới"; 

			$danhmuc_cap1="off";
			$danhmuc_cap2="off";
			$danhmuc_cap3="off";
			$danhmuc_cap4="off";
			
			$image_active ="on";
			$mutile_image_active="off";

			$mota_active ="on";
			$noidung_active="on";
			
		}



		//Sửa Danh Sách Tin 


		if($_REQUEST['typechild']=='bosuutap' && $_GET["act"]=="edit" )
		{

			$kichthuoc_image="Width: 320px - Height: 255px";
			$name_cap="Sửa Bộ sưu tập";

			$danhmuc_cap1="off";
			$danhmuc_cap2="off";
			$danhmuc_cap3="off";
			$danhmuc_cap4="off";

			$image_active="on";
			$mutile_image_active="off";


			$mota_active ="on";
			$noidung_active="on";

			
		}




		
		



		//Thêm Danh Sách Tin 
		
		if($_REQUEST['typechild']=='tuyendung' &&  ($_GET["act"]=="man" || $_GET["act"]=="add" ) )
		{

			$kichthuoc_image="Width: 403px - Height: 357px";
			$name_cap="Thêm Bài tuyển dụng";
			
			$image_active ="on";
			$mutile_image_active="off";


			$mota_active ="on";
			$noidung_active="on";

			$danhmuc_cap1="off";
			$danhmuc_cap2="off";
			$danhmuc_cap3="off";
			$danhmuc_cap4="off";

			$check_tinnoibat="off";
			$rename_tinnoibat="Tin nổi bật";

			$check_tinmoi="off"; 
			$rename_tinmoi="Tin mới"; 


			$btn_them_active="on";  
			$btn_hien_active="on"; 
			$btn_an_active="on"; 
			$btn_sua_active="on"; 
			$btn_xoa_active="on"; 
			
		}



		//Sửa Danh Sách Tin 


		if($_REQUEST['typechild']=='tuyendung' && $_GET["act"]=="edit" )
		{

			$kichthuoc_image="Width: 403px - Height: 357px";
			$name_cap="Sửa Danh Sách Bài tuyển dụng";
			
			$image_active="on";
			$mutile_image_active="off";

			$mota_active ="on";
			$noidung_active="on";

			$danhmuc_cap1="off";
			$danhmuc_cap2="off";
			$danhmuc_cap3="off";
			$danhmuc_cap4="off";



			
		}





	}



/***********************************************************End Muc Luc Cập Nhật Nhiều Bài Viết ********************************************/	



	/***********************************************************Start Muc Luc Cập Nhật 1 Bài Viết ********************************************/


	if ($_GET["com"]=="info")
	{


		// Cập nhật 1 bài viết

		if($_REQUEST['typechild']=='gioithieu' && ( $_GET["act"]=="man" || $_GET["act"]=="capnhat") )
		{

			$kichthuoc_image="Width: 655px - Height: 415px";
			$name_cap="Giới thiệu";
			$image_active="off";
			$tieude_active="on";
			$mota_active="off";
			$noidung_active="on";
			$concepter_active="on";
			$brochure_active="on";
			
		}
		
		
		if($_REQUEST['typechild']=='gioithieu_nt' && ( $_GET["act"]=="man" || $_GET["act"]=="capnhat") )
		{

			$kichthuoc_image="Width: 655px - Height: 415px";
			$name_cap="Giới thiệu";
			$image_active="off";
			$tieude_active="off";
			$mota_active="off";
			$noidung_active="on";
			
		}
		
		
		
		if($_REQUEST['typechild']=='linhvuckinhdoanh' && ( $_GET["act"]=="man" || $_GET["act"]=="capnhat") )
		{

			$kichthuoc_image="Width: 655px - Height: 415px";
			$name_cap="Lĩnh vực kinh doanh";
			$image_active="off";
			$tieude_active="on";
			$mota_active="off";
			$noidung_active="on";
			
		}


		if($_REQUEST['typechild']=='footer' && ($_GET["act"]=="man" || $_GET["act"]=="capnhat") )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Footer";
			$image_active="off";
			$tieude_active="off";
			$mota_active="off";
			$noidung_active="on";
			
		}

		
		if($_REQUEST['typechild']=='bv_khuyenmai' && ($_GET["act"]=="man" || $_GET["act"]=="capnhat") )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Bài viết khuyến mãi";
			$image_active="off";
			$tieude_active="off";
			$mota_active="off";
			$noidung_active="on";
			
		}


		if($_REQUEST['typechild']=='lienhe' && ($_GET["act"]=="man" || $_GET["act"]=="capnhat") )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Liên hệ";
			$image_active="off";
			$tieude_active="off";
			$mota_active="off";
			$noidung_active="on";
			
		}

		
		
		
		if($_REQUEST['typechild']=='nhanhopdong' && ($_GET["act"]=="man" || $_GET["act"]=="capnhat") )
		{

			$kichthuoc_image="Width: 1366px - Height: 200px";
			$name_cap="Nhận hợp đồng";
			$image_active="on";
			$tieude_active="on";
			$mota_active="on";
			$noidung_active="on";
			
		}
		
		
			if($_REQUEST['typechild']=='thongtindathang' && ($_GET["act"]=="man" || $_GET["act"]=="capnhat") )
		{

			$kichthuoc_image="Width: 1366px - Height: 200px";
			$name_cap="Thông tin giao nhận";
			$image_active="off";
			$tieude_active="off";
			$mota_active="off";
			$noidung_active="on";
			
		}


		


	}
			
	
	/***********************************************************END Muc Luc Cập Nhật Bài Viết ********************************************/




	/***********************************************************Start Muc Luc Hình ảnh và Link ********************************************/





	if ($_GET["com"]=="image_url")
	{




		if($_REQUEST['typechild']=='linkmenu')
		{
			$kichthuoc_image="Width: 1366px - Height: 900px";
			$name_photo="Back Link Menu";

			$mota_active="off";
			$link_active="on";
			$image_active="off";

			$btn_them_active="on";
			$btn_hien_active="on";
			$btn_an_active="on";
			$btn_sua_active="on"; 
			$btn_xoa_active="on";
		}	


		if($_REQUEST['typechild']=='dichvukhac')
		{
			$kichthuoc_image="Width: 1366px - Height: 900px";
			$name_photo="Back LinK Dịch Vụ Khác";
			
			$mota_active="off";
			$link_active="on";
			$image_active="off";

			$btn_them_active="on";
			$btn_hien_active="on";
			$btn_an_active="on";
			$btn_sua_active="on"; 
			$btn_xoa_active="on";
		}	

		
		if($_REQUEST['typechild']=='slide_brochure')
		{
			$kichthuoc_image="Width: 1200PX - Height: 450px";
			$name_photo="Slide Brochure";

			$mota_active="off";
			$link_active="on";
			$image_active="on";

			$btn_them_active="on";
			$btn_hien_active="on";
			$btn_an_active="on";
			$btn_sua_active="on"; 
			$btn_xoa_active="on";
		}	


		if($_REQUEST['typechild']=='slider')
		{
			$kichthuoc_image="Width: 1366px - Height: 475px";
			$name_photo="Slide Show";

			$mota_active="off";
			$link_active="on";
			$image_active="on";

			$btn_them_active="on";
			$btn_hien_active="on";
			$btn_an_active="on";
			$btn_sua_active="on"; 
			$btn_xoa_active="on";
		}	
		
		
		if($_REQUEST['typechild']=='slide_nt')
		{
			$kichthuoc_image="Width: 1366px - Height: 500px";
			$name_photo="Slide Show";

			$mota_active="off";
			$link_active="on";
			$image_active="on";

			$btn_them_active="on";
			$btn_hien_active="on";
			$btn_an_active="on";
			$btn_sua_active="on"; 
			$btn_xoa_active="on";
		}	
		
		
			if($_REQUEST['typechild']=='slide_project')
		{
			$kichthuoc_image="Width: 1900px - Height: 580px";
			$name_photo="Slide Dự án";

			$mota_active="off";
			$link_active="on";
			$image_active="on";

			$btn_them_active="on";
			$btn_hien_active="on";
			$btn_an_active="on";
			$btn_sua_active="on"; 
			$btn_xoa_active="on";
		}	
		
		
		if($_REQUEST['typechild']=='slide_kientruc')
		{
			$kichthuoc_image="Width: 1900px - Height: 580px";
			$name_photo="Slide Kiến trúc";

			$mota_active="off";
			$link_active="on";
			$image_active="on";

			$btn_them_active="on";
			$btn_hien_active="on";
			$btn_an_active="on";
			$btn_sua_active="on"; 
			$btn_xoa_active="on";
		}	
		
		
		if($_REQUEST['typechild']=='image_GD')
		{
			$kichthuoc_image="Width: 630px - Height: 330px";
			$name_photo="Hình ảnh giao diện";

			$mota_active="off";
			$link_active="on";
			$image_active="on";

			$btn_them_active="off";
			$btn_hien_active="on";
			$btn_an_active="on";
			$btn_sua_active="on"; 
			$btn_xoa_active="off";
		}	
		
		
		if($_REQUEST['typechild']=='hinhsanpham')
		{
			$kichthuoc_image="Width: 260px - Height: 250px";
			$name_photo="Hình sản phẩm";

			$mota_active="off";
			$link_active="on";
			$image_active="on";

			$btn_them_active="on";
			$btn_hien_active="on";
			$btn_an_active="on";
			$btn_sua_active="on"; 
			$btn_xoa_active="on";
		}	
		
		
		if($_REQUEST['typechild']=='link_baiviet')
		{
			$kichthuoc_image="Width: 400px - Height: 230px";
			$name_photo="Link hình ảnh bài viết";

			$mota_active="off";
			$link_active="on";
			$image_active="on";

			$btn_them_active="off";
			$btn_hien_active="on";
			$btn_an_active="on";
			$btn_sua_active="on"; 
			$btn_xoa_active="off";
		}	


		if($_REQUEST['typechild']=='quangcao')
		{
			$kichthuoc_image="Width: 590px - Height: 238px";
			$name_photo="Hình ảnh quảng cáo";

			$mota_active="off";
			$link_active="on";
			$image_active="on";

			$btn_them_active="on";
			$btn_hien_active="on";
			$btn_an_active="on";
			$btn_sua_active="on"; 
			$btn_xoa_active="on";
		}	


		if($_REQUEST['typechild']=='doitac')
		{
			$kichthuoc_image="Width: 135px - Height: 130px";
			$name_photo="Đối tác";

			$mota_active="off";
			$link_active="on";
			$image_active="on";

			$btn_them_active="on";
			$btn_hien_active="on";
			$btn_an_active="on";
			$btn_sua_active="on"; 
			$btn_xoa_active="on";
		}	


		if($_REQUEST['typechild']=='mangxahoi')
		{
			$kichthuoc_image="Width: 40px - Height: 40px";
			$name_photo="Mạng Xã Hội Top";
			$image_active="on";

			$mota_active="off";
			$link_active="on";

			$btn_them_active="on";
			$btn_hien_active="on";
			$btn_an_active="on";
			$btn_sua_active="on"; 
			$btn_xoa_active="on";
		}	
	
	
		if($_REQUEST['typechild']=='mangxahoi_ft')
		{
			$kichthuoc_image="Width: 40px - Height: 40px";
			$name_photo="Mạng Xã Hội Footer";
			$image_active="on";

			$mota_active="off";
			$link_active="on";

			$btn_them_active="on";
			$btn_hien_active="on";
			$btn_an_active="on";
			$btn_sua_active="on"; 
			$btn_xoa_active="on";
		}	
		
		
		if($_REQUEST['typechild']=='mxh_nt')
		{
			$kichthuoc_image="Width: 40px - Height: 40px";
			$name_photo="Mạng Xã Hội Nội thất";
			$image_active="on";

			$mota_active="off";
			$link_active="on";

			$btn_them_active="on";
			$btn_hien_active="on";
			$btn_an_active="on";
			$btn_sua_active="on"; 
			$btn_xoa_active="on";
		}	
		
		
		if($_REQUEST['typechild']=='mangxahoi_home')
		{
			$kichthuoc_image="Width: 40px - Height: 40px";
			$name_photo="Mạng Xã Hội Home";
			$image_active="on";

			$mota_active="off";
			$link_active="on";

			$btn_them_active="on";
			$btn_hien_active="on";
			$btn_an_active="on";
			$btn_sua_active="on"; 
			$btn_xoa_active="on";
		}	



		if($_REQUEST['typechild']=='slideabout')
		{
			$kichthuoc_image="Width: 700px - Height: 280px";
			$name_photo="Slide giới thiệu";
			$image_active="on";

			$mota_active="on";
			$link_active="on";

			$btn_them_active="on";
			$btn_hien_active="on";
			$btn_an_active="on";
			$btn_sua_active="on"; 
			$btn_xoa_active="on";
		}	





	}	


	/***********************************************************END Muc Luc Cập Nhật Bài Viết ********************************************/







	/***********************************************************Start Muc Bản Đồ ********************************************/





	//Thêm Danh Sách Map 
		
		if($_REQUEST['typechild']=='bando' &&  ($_GET["act"]=="man" || $_GET["act"]=="add" ) )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Thêm Bản đồ";
			
			$image_active ="off";
			$mutile_image_active="off";

			$toado_active="on";

			$mota_active ="on";
			$noidung_active="off";

			$btn_them_active="on";  
			$btn_hien_active="on"; 
			$btn_an_active="on"; 
			$btn_sua_active="on"; 
			$btn_xoa_active="on"; 
			
		}



		//Sửa Danh Sách Tin 


		if($_REQUEST['typechild']=='bando' && $_GET["act"]=="edit" )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$name_cap="Sửa Danh Sách Bản đồ";
			
			$image_active="off";
			$mutile_image_active="off";

			$toado_active="on";

			$mota_active ="on";
			$noidung_active="off";

			$danhmuc_cap1="off";
			$danhmuc_cap2="off";
			$danhmuc_cap3="off";
			$danhmuc_cap4="off";



			
		}


	/***********************************************************END Muc Bản Đồ ********************************************/





	/***********************************************************Start Muc Video ********************************************/







	/***********************************************************END Muc Video ********************************************/


	

	/***********************************************************Start Background ********************************************/

	if ($_GET["com"]=="background")
	{


		// Cập nhật BG WEB 


		if($_REQUEST['typechild']=='bg_banner' && ( $_GET["act"]=="man" || $_GET["act"]=="capnhat") )
		{

			$kichthuoc_image="Width: 1366px - Height: 150px";
			$name_cap="Background Banner top";
			
			
		}
		
		if($_REQUEST['typechild']=='bg_chonchungtoi' && ( $_GET["act"]=="man" || $_GET["act"]=="capnhat") )
		{

			$kichthuoc_image="Width: 1366px - Height: 400px";
			$name_cap="Background Tại Sao Chọn Chúng Tôi";
	
		}
		
		
		if($_REQUEST['typechild']=='bg_ykienkhachhang' && ( $_GET["act"]=="man" || $_GET["act"]=="capnhat") )
		{

			$kichthuoc_image="Width: 1366px - Height: 593px";
			$name_cap="Background Ý Kiến Khách Hàng";
	
		}

		if($_REQUEST['typechild']=='bg_header' && ( $_GET["act"]=="man" || $_GET["act"]=="capnhat") )
		{

			$kichthuoc_image="Width: 1366px - Height: 575px";
			$name_cap="Background Header";
			
			
		}


		if($_REQUEST['typechild']=='bg_footer' && ( $_GET["act"]=="man" || $_GET["act"]=="capnhat") )
		{

			$kichthuoc_image="Width: 1366px - Height: 560px";
			$name_cap="Background Footer";
			
			
		}


		if($_REQUEST['typechild']=='bg_web' && ( $_GET["act"]=="man" || $_GET["act"]=="capnhat") )
		{

			$kichthuoc_image="Width: 1366px - Height: 560px";
			$name_cap="Background Web";
			
			
		}
		
		
		if($_REQUEST['typechild']=='bg_web_nt' && ( $_GET["act"]=="man" || $_GET["act"]=="capnhat") )
		{

			$kichthuoc_image="Width: 1366px - Height: 560px";
			$name_cap="Background Web";
			
			
		}

	}













	/***********************************************************Start Muc Luc Cập Nhật Banner ********************************************/


	if ($_GET["com"]=="banner")
	{


		// Cập nhật 1 bài viết

		if($_REQUEST['typechild']=='banner_chungtoi_project' && ( $_GET["act"]=="man" || $_GET["act"]=="capnhat") )
		{

			$kichthuoc_image="Width: 370px - Height: 370px";
			$name_cap="Cập nhật ảnh Banner Tại sao là chúng tôi";
			$image_active="on";
			$tieude_active="off";
			$mota_active="off";
			$noidung_active="off";
			
		}
		
		
		if($_REQUEST['typechild']=='banner_chungtoi_kt' && ( $_GET["act"]=="man" || $_GET["act"]=="capnhat") )
		{

			$kichthuoc_image="Width: 370px - Height: 370px";
			$name_cap="Cập nhật ảnh Banner Tại sao là chúng tôi";
			$image_active="on";
			$tieude_active="off";
			$mota_active="off";
			$noidung_active="off";
			
		}


		if($_REQUEST['typechild']=='banner_top' && ( $_GET["act"]=="man" || $_GET["act"]=="capnhat") )
		{

			$kichthuoc_image="Width: 675px - Height: 135px";
			$name_cap="Cập nhật ảnh Banner Top";
			$image_active="on";
			$tieude_active="on";
			$mota_active="on";
			$noidung_active="on";
			
		}

		if($_REQUEST['typechild']=='logo_top' && ( $_GET["act"]=="man" || $_GET["act"]=="capnhat") )
		{

			$kichthuoc_image="Width: 105px - Height:115px";
			$name_cap="Cập nhật ảnh Logo Top";
			$image_active="on";
			$tieude_active="on";
			$mota_active="on";
			$noidung_active="on";
			
		}
		
		
		
		if($_REQUEST['typechild']=='logo_noithat' && ( $_GET["act"]=="man" || $_GET["act"]=="capnhat") )
		{

			$kichthuoc_image="Width: 520px - Height:55px";
			$name_cap="Cập nhật ảnh Logo Top";
			$image_active="on";
			$tieude_active="on";
			$mota_active="on";
			$noidung_active="on";
			
		}
		
		
		
		if($_REQUEST['typechild']=='logo_home' && ( $_GET["act"]=="man" || $_GET["act"]=="capnhat") )
		{

			$kichthuoc_image="Width: 270px - Height:90px";
			$name_cap="Cập nhật ảnh Logo Home";
			$image_active="on";
			$tieude_active="on";
			$mota_active="on";
			$noidung_active="on";
			
		}



		

		
	}
	
	
	
	if ($_GET["com"]=="download")
	{
		
		
		//Thêm Danh Sách Tin 


		if($_REQUEST['typechild']=='download' && $_GET["act"]=="man" || $_GET["act"]=="add")
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			$kichthuoc_file="Dung lượng Max 15MB";
			$name_cap="Thêm Danh Sách Bảng giá";
		

			$btn_them_active="on";  
			$btn_hien_active="on"; 
			$btn_an_active="on"; 
			$btn_sua_active="on"; 
			$btn_xoa_active="on"; 

			$check_tinnoibat="off";
			$rename_tinnoibat="Tin nổi bật";

			$check_tinmoi="off"; 
			$rename_tinmoi="Tin mới"; 

			$danhmuc_cap1="off";
			$danhmuc_cap2="off";
			$danhmuc_cap3="off";
			$danhmuc_cap4="off";
			
			
			$image_active="on";
			$file_active="on";
			$mutile_image_active="off";

			$mota_active ="on";
			$noidung_active="on";
			
		}



		//Sửa Danh Sách Tin 


		if($_REQUEST['typechild']=='download' && $_GET["act"]=="edit" )
		{

			$kichthuoc_image="Width: 240px - Height: 165px";
			
			$kichthuoc_file="Dung lượng Max 15MB";
			$name_cap="Sửa Danh Sách Bảng giá";
			
			$danhmuc_cap1="off";
			$danhmuc_cap2="off";
			$danhmuc_cap3="off";
			$danhmuc_cap4="off";

			$image_active="on";
			$file_active="on";
			$mutile_image_active="off";


			$mota_active ="on";
			$noidung_active="on";

			
		}
		
	}
			
	
	/***********************************************************END Muc Luc Cập Nhật Bài Viết ********************************************/


?>