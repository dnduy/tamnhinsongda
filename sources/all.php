<?php  if(!defined('_source')) die("Error");

	
	@$id = addslashes($_GET['id']);
	
	// Kiểm tra Sản phẩm
	
	// Lấy id_list
	$d->reset();	
	$sql = "select id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,photo,title_$lang as title,description_$lang as description,keyword_$lang as keyword,h1_$lang as h1,h2_$lang as h2,h3_$lang as h3,h4_$lang as h4,h5_$lang as h5,h6_$lang as h6,mota_$lang as mota from #_product_list where tenkhongdau_$lang ='".$id."'";
	
	$d->query($sql);
	if($d->num_rows()>0){
		$template = 'product';
		$id_list = $d->fetch_array();
		
		
				
		// Lấy id_item neu co cap 3
	$d->reset();	
	$sql = "select id,id_list,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,photo,thumb,title_$lang as title,description_$lang as description,keyword_$lang as keyword,h1_$lang as h1,h2_$lang as h2,h3_$lang as h3,h4_$lang as h4,h5_$lang as h5,h6_$lang as h6  from #_product_cat where id_list ='".$id_list["id"]."'";
	$d->query($sql);
	$id_cat = $d->result_array();
		if (count($id_cat)>0)
		{
			$template = 'product';
		}
		else 
		{
			$template = 'product_item';
		}
		
		

		$idl = $id_list['id'];
		$id_listhome=$id_list['id'];
		$cat1=$id_list['tenkhongdau'];
		

		
		// Share Facebook info product 
		if ($id_list["photo"]!="")
		{
		$image = "http://".$config_url."/"._upload_product_list_l.$id_list['photo'];
		}
       
        $url_web = "http://".$config_url."/".$cat1."";
		$description_web=strip_tags($id_list["mota"]);
		
      

		// Get Keyword + Des +  heading (h1,h2) 

		if($id_list["keyword"]!='')
			$row_setting["keywords_$lang"]=$id_list["keyword"];
		if($id_list["description"]!='')
			$row_setting["description_$lang"]=$id_list["description"];
			
		if($id_list["h1"]!='')
				$row_setting["h1_$lang"]=$id_list["h1"];	
				
		if($id_list["h2"]!='')
				$row_setting["h2_$lang"]=$id_list["h2"];		

		if($id_list["h3"]!='')
				$row_setting["h3_$lang"]=$id_list["h3"];	

		if($id_list["h4"]!='')
				$row_setting["h4_$lang"]=$id_list["h4"];		

		if($id_list["h5"]!='')
				$row_setting["h5_$lang"]=$id_list["h5"];	

		if($id_list["h6"]!='')
				$row_setting["h6_$lang"]=$id_list["h6"];		
				
			if($id_list["title"]!='')
			{
				$title_bar=$id_list["title"];	
			}
			else
			
			{
				$title_bar=$id_list["ten"];	
				
			}	
				
	
		$title_tcat=$id_list["ten"];
		
		
		
		$d->reset();	
		$sql = "select id,id_list,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,h1_$lang as h1,h2_$lang as h2,h3_$lang as h3,h4_$lang as h4,h5_$lang as h5,h6_$lang as h6 from #_product_cat where id_list=$idl";
		$d->query($sql);
		$item = $d->result_array();
		

		
		$sql="SELECT count(id) AS numrows FROM #_product  where hienthi=1  and id_list=$idl  order by id desc";
		$d->query($sql);	
		$dem=$d->fetch_array();
		$totalRows=$dem['numrows'];
		$page=$_GET['curPage'];
		
		$pageSize=12;
		
		$offset=5;
							
		if ($page=="")
			$page=1;
		else 
			$page=$_GET['curPage'];
		$page--;
		$bg=$pageSize*$page;		
		
		
	$d->reset();
	$sql = "select id_cat,id_list,id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,mota_$lang as mota,alt_$lang as alt,title_$lang as title,description_$lang as description,keyword_$lang as keyword,photo,thumb,gia,luotxem,video_$lang as video from #_product where hienthi=1  and id_list=$idl  order by id desc limit $bg,$pageSize";		
	$d->query($sql);
	$product = $d->result_array();
	$page_url="".$cat1."/";		
	$url_link="http://".$config_url."/".$page_url."page";	

	return false;
	
	}
		
	// Lấy id_cat
	$d->reset();	
	$sql = "select id,id_list,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,photo,thumb,title_$lang as title,description_$lang as description,keyword_$lang as keyword,h1_$lang as h1,h2_$lang as h2,h3_$lang as h3,h4_$lang as h4,h5_$lang as h5,h6_$lang as h6  from #_product_cat where tenkhongdau_$lang ='".$id."'";
	
	$d->query($sql);
	if($d->num_rows()>0){
		
		$id_cat = $d->fetch_array();
		
		
	// Lấy id_item neu co cap 3
	$d->reset();	
	$sql = "select id,id_list,id_cat,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,photo,thumb,title_$lang as title,description_$lang as description,keyword_$lang as keyword,h1_$lang as h1,h2_$lang as h2,h3_$lang as h3,h4_$lang as h4,h5_$lang as h5,h6_$lang as h6  from #_product_item where id_cat ='".$id_cat["id"]."'";
	$d->query($sql);
	$id_item = $d->result_array();
		if (count($id_item)>0)
		{
			$template = 'product_cat';
		}
		else 
		{
			$template = 'product_item';
		}
		
		

		
		
		$idc = $id_cat['id'];
		$id_listhome=$id_cat['id_list'];
		$id_cathome=$id_cat['id'];
		$cat2=$id_cat['tenkhongdau'];
		
		// Share Facebook info product 
		if ($id_cat["photo"]!="")
		{
		$image = "http://".$config_url."/"._upload_product_cat_l.$id_cat['photo'];
		}
       
        $url_web = "http://".$config_url."/".$cat2."";
		$description_web=strip_tags($id_cat["ten"]);
		
      

		// Get Keyword + Des +  heading (h1,h2) 

		if($id_cat["keyword"]!='')
			$row_setting["keywords_$lang"]=$id_cat["keyword"];
		if($id_cat["description"]!='')
			$row_setting["description_$lang"]=$id_cat["description"];
			
		if($id_cat["h1"]!='')
				$row_setting["h1_$lang"]=$id_cat["h1"];	
				
		if($id_cat["h2"]!='')
				$row_setting["h2_$lang"]=$id_cat["h2"];	

	
		if($id_cat["h3"]!='')
				$row_setting["h3_$lang"]=$id_cat["h3"];
			
		if($id_cat["h4"]!='')
				$row_setting["h4_$lang"]=$id_cat["h4"];	
			
			
		if($id_cat["h5"]!='')
				$row_setting["h5_$lang"]=$id_cat["h5"];	

		if($id_cat["h6"]!='')
				$row_setting["h6_$lang"]=$id_cat["h6"];			
			
				
			if($id_cat["title"]!='')
			{
				$title_bar=$id_cat["title"];	
			}
			else
			
			{
				$title_bar=$id_cat["ten"];	
				
			}	
				
	
		$title_tcat=$id_cat["ten"];
		
		
		$d->reset();	
		$sql = "select id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,photo,thumb,title_$lang as title,description_$lang as description,keyword_$lang as keyword,h1_$lang as h1,h2_$lang as h2,h3_$lang as h3,h4_$lang as h4,h5_$lang as h5,h6_$lang as h6  from #_product_list where id=".$id_cat['id_list'];
		$d->query($sql);
		if($d->num_rows()>0){
			$id_list = $d->fetch_array();				
			$idl = $id_list['id'];
			$slide = $id_list['photo'];
		}
		
		$d->reset();	
		$sql = "select id,id_list,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau from #_product_cat where id_list=$idl";
		$d->query($sql);
		$item = $d->result_array();
		
		
		
		$sql="SELECT count(id) AS numrows FROM #_product  where hienthi=1 and id_list=$idl and id_cat=$idc  order by stt,id asc";
		$d->query($sql);	
		$dem=$d->fetch_array();
		$totalRows=$dem['numrows'];
		$page=$_GET['curPage'];
		
		$pageSize=12;
		
		$offset=5;
							
		if ($page=="")
			$page=1;
		else 
			$page=$_GET['curPage'];
		$page--;
		$bg=$pageSize*$page;		
		
		
	$d->reset();
	$sql = "select id_cat,id_list,id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,mota_$lang as mota,alt_$lang as alt,title_$lang as title,description_$lang as description,keyword_$lang as keyword,photo,thumb,gia,luotxem,video_$lang as video from #_product where hienthi=1  and id_list=$idl and id_cat=$idc  order by id desc limit $bg,$pageSize";		
	$d->query($sql);
	$product = $d->result_array();
	$page_url="".$cat2."/";		
	$url_link="http://".$config_url."/".$page_url."page";	

	return false;
	
	}
		
	
	
	// Lấy id_item
	$d->reset();	
	$sql = "select id,id_list,id_cat,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,photo,thumb,title_$lang as title,description_$lang as description,keyword_$lang as keyword,h1_$lang as h1,h2_$lang as h2,h3_$lang as h3,h4_$lang as h4,h5_$lang as h5,h6_$lang as h6  from #_product_item where tenkhongdau_$lang ='".$id."'";
	
	$d->query($sql);
	if($d->num_rows()>0){
		$template = 'product_item';
		$id_item = $d->fetch_array();

		
		
		$idi = $id_item['id'];
		$id_listhome=$id_item['id_list'];
		$id_cathome=$id_item['id_cat'];
		$id_itemhome=$id_item['id'];
		$cat3=$id_item['tenkhongdau'];
		
		// Share Facebook info product 
		if ($id_item["photo"]!="")
		{
		$image = "http://".$config_url."/"._upload_product_item_l.$id_item['photo'];
		}
       
        $url_web = "http://".$config_url."/".$cat3."";
		$description_web=strip_tags($id_item["ten"]);
		
      

		// Get Keyword + Des +  heading (h1,h2) 

		if($id_item["keyword"]!='')
			$row_setting["keywords_$lang"]=$id_item["keyword"];
		if($id_item["description"]!='')
			$row_setting["description_$lang"]=$id_item["description"];
			
		if($id_item["h1"]!='')
				$row_setting["h1_$lang"]=$id_item["h1"];	
				
		if($id_item["h2"]!='')
				$row_setting["h2_$lang"]=$id_item["h2"];	

		if($id_item["h3"]!='')
				$row_setting["h3_$lang"]=$id_item["h3"];

		if($id_item["h4"]!='')
				$row_setting["h4_$lang"]=$id_item["h4"];	

		if($id_item["h5"]!='')
				$row_setting["h5_$lang"]=$id_item["h5"];		

		if($id_item["h6"]!='')
				$row_setting["h6_$lang"]=$id_item["h6"];			
				
			if($id_item["title"]!='')
			{
				$title_bar=$id_item["title"];	
			}
			else
			
			{
				$title_bar=$id_item["ten"];	
				
			}	
				
	
		$title_tcat=$id_item["ten"];
		
		
		$d->reset();	
		$sql = "select id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,photo,thumb,title_$lang as title,description_$lang as description,keyword_$lang as keyword,h1_$lang as h1,h2_$lang as h2,h3_$lang as h3,h4_$lang as h4,h5_$lang as h5,h6_$lang as h6  from #_product_list where id=".$id_item['id_list'];
		$d->query($sql);
		if($d->num_rows()>0){
			$id_list = $d->fetch_array();				
			$idl = $id_list['id'];
			$slide = $id_list['photo'];
		}
		
		
		
		$d->reset();	
		$sql = "select id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,photo,thumb,title_$lang as title,description_$lang as description,keyword_$lang as keyword,h1_$lang as h1,h2_$lang as h2,h3_$lang as h3,h4_$lang as h4,h5_$lang as h5,h6_$lang as h6  from #_product_cat where id=".$id_item['id_cat'];
		$d->query($sql);
		if($d->num_rows()>0){
			$id_cat = $d->fetch_array();				
			$idc = $id_cat['id'];
			$slide = $id_cat['photo'];
		}
		
		$d->reset();	
		$sql = "select id,id_list,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau from #_product_cat where id_list=$idl";
		$d->query($sql);
		$item = $d->result_array();
		
		
		$d->reset();	
		$sql = "select id,id_list,id_cat,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,noidung_$lang as noidung from #_product_item where hienthi=1 and id_list='".$idl."' and id_cat='".$idc."' and id='".$idi."'";
		$d->query($sql);
		$fetch_idi = $d->fetch_array();
		
		
		
		$sql="SELECT count(id) AS numrows FROM #_product  where hienthi=1 and id_list='".$idl."' and id_cat='".$idc."' and id_item='".$idi."'  order by stt,id asc";
		$d->query($sql);	
		$dem=$d->fetch_array();
		$totalRows=$dem['numrows'];
		$page=$_GET['curPage'];
		
		$pageSize=12;
		
		$offset=5;
							
		if ($page=="")
			$page=1;
		else 
			$page=$_GET['curPage'];
		$page--;
		$bg=$pageSize*$page;		
		
		
	$d->reset();
	$sql = "select id_cat,id_list,id_item,id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,mota_$lang as mota,alt_$lang as alt,title_$lang as title,description_$lang as description,keyword_$lang as keyword,photo,thumb,gia,luotxem,video_$lang as video from #_product where hienthi=1  and id_list='".$idl."' and id_cat='".$idc."' and id_item='".$idi."'  order by id desc limit $bg,$pageSize";		
	$d->query($sql);
	$product = $d->result_array();
	$page_url="".$cat2."/";		
	$url_link="http://".$config_url."/".$page_url."page";	

	return false;
	}
		
	
	
	// Lấy sản phẩm detail
	$d->reset();
	$sql_detail = "select id,id_cat,id_list,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,thumb,photo,mota_$lang as mota,noidung_$lang as noidung,congdung_$lang as congdung,nhasx,gia,giakm,masp,luotxem,title_$lang as title,description_$lang as description,keyword_$lang as keyword,h1_$lang as h1,h2_$lang as h2,h3_$lang as h3,h4_$lang as h4,h5_$lang as h5,h6_$lang as h6,video_$lang as video,list_video from #_product where tenkhongdau_$lang='".$id."'";
	$d->query($sql_detail);
	if($d->num_rows()>0){
		$template = 'product_detail';
		$row_detail = $d->fetch_array();
		

		
		
		$d->reset();	
		$sql = "select id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,photo,title_$lang as title,description_$lang as description,keyword_$lang as keyword,h1_$lang as h1, h2_$lang as h2 from #_product_list where id=".$row_detail['id_list'];
		$d->query($sql);
		if($d->num_rows()>0){
			$id_list = $d->fetch_array();				
			$idl = $id_list['id'];
			
		}
		
		
		$d->reset();	
		$sql = "select id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,photo,title_$lang as title,description_$lang as description,keyword_$lang as keyword,h1_$lang as h1,h2_$lang as h2,h3_$lang as h3,h4_$lang as h4,h5_$lang as h5,h6_$lang as h6  from #_product_cat where id=".$row_detail['id_cat'];
		$d->query($sql);
		if($d->num_rows()>0){
			$id_cat = $d->fetch_array();				
			$idc = $id_cat['id'];
			
		}
		

		
		$luotxem = $row_detail['luotxem']+1;
		$sql_update = "update #_product SET luotxem=$luotxem where id=".$row_detail['id'];
		$d->query($sql_update);
		
		
			  // Share Facebook info product 
        $image = "http://".$config_url."/"._upload_product_l.$row_detail['photo'];
        $url_web = "http://".$config_url."/".$row_detail['tenkhongdau']."";
		$description_web=strip_tags($row_detail["mota"]);
		

		// Get Keyword + Des +  heading (h1,h2) 

		if($row_detail["keyword"]!='')
			$row_setting["keywords_$lang"]=$row_detail["keyword"];
		if($row_detail["description"]!='')
			$row_setting["description_$lang"]=$row_detail["description"];
			
		if($row_detail["h1"]!='')
				$row_setting["h1_$lang"]=$row_detail["h1"];
			
		if($row_detail["h2"]!='')
				$row_setting["h2_$lang"]=$row_detail["h2"];	
			
		if($row_detail["h3"]!='')
				$row_setting["h3_$lang"]=$row_detail["h3"];		
			
		if($row_detail["h4"]!='')
				$row_setting["h4_$lang"]=$row_detail["h4"];	
			
		if($row_detail["h5"]!='')
				$row_setting["h5_$lang"]=$row_detail["h5"];	
			
		if($row_detail["h6"]!='')
				$row_setting["h6_$lang"]=$row_detail["h6"];		
		
		
			
		if($row_detail["title"]!='')
		{
			$title_bar=$row_detail["title"];	
		}
		else
		
		{
			$title_bar=$row_detail["ten"];	
			
		}	

		


		$d->reset();
		$sql_detail = "select id,photo from #_hasp where hienthi=1 and id_photo='".$row_detail['id']."'";
		$d->query($sql_detail);
		$album_hinh = $d->result_array();
		
		
		
			#các sản phẩm khác======================		
		$d->reset();					
		$sql_sanphamkhac = "select id,id_cat,id_list,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,thumb,photo,mota_$lang as mota,noidung_$lang as noidung,congdung_$lang as congdung,nhasx,gia,giakm,masp,luotxem,title_$lang as title,description_$lang as description,keyword_$lang as keyword,h1_$lang as h1,h2_$lang as h2,h3_$lang as h3,h4_$lang as h4,h5_$lang as h5,h6_$lang as h6 from #_product where hienthi=1 and tenkhongdau_$lang <>'".$id."' and id_list=".$row_detail['id_list']." order by id desc limit 0,6";
		$d->query($sql_sanphamkhac);
		$sanpham_khac = $d->result_array();			

		
		
		return false;
	}
	
	
	
	
	
	
	
	
	// Kiểm tra danh sách tin tức

	$d->reset();
	$sql = "select id,id_list,id_cat,id_item,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,photo,thumb,mota_$lang as mota,noidung_$lang as noidung,ngaytao,luotxem,title_$lang as title,description_$lang as description,keyword_$lang as keyword,h1_$lang as h1,h2_$lang as h2,h3_$lang as h3,h4_$lang as h4,h5_$lang as h5,h6_$lang as h6 from #_news where hienthi=1 and com='news' and tenkhongdau_$lang='".$id."'";
	$d->query($sql);
	if($d->num_rows()>0){
		$template = "news_detail";
		$tintuc_detail = $d->result_array();
		
		$com_href="tin-tuc";
		
		$ten_list=$tintuc_detail[0]['tenkhongdau'];
		$ten_cat=$tintuc_detail[0]['tenkhongdau'];
		$id_listhome=$tintuc_detail[0]['id_list'];
		$id_cathome=$tintuc_detail[0]['id_cat'];
		$id_itemhome=$tintuc_detail[0]['id_item'];
		$com_title=_tintuc;
		
	
	$title_tcat=$com_title;
	
	if($tintuc_detail[0]["keyword_"]!='')
		$row_setting["keywords_$lang"]=$tintuc_detail[0]["keyword"];
	if($tintuc_detail[0]["description"]!='')
		$row_setting["description_$lang"]=$tintuc_detail[0]["description"];
		
	if($tintuc_detail[0]["h1"]!='')
		$row_setting["h1_$lang"]=$tintuc_detail[0]["h1"];	
		
	if($tintuc_detail[0]["h2"]!='')
		$row_setting["h2_$lang"]=$tintuc_detail[0]["h2"];	
	
	if($tintuc_detail[0]["h3"]!='')
		$row_setting["h3_$lang"]=$tintuc_detail[0]["h3"];
	
	if($tintuc_detail[0]["h4"]!='')
		$row_setting["h4_$lang"]=$tintuc_detail[0]["h4"];
	
	if($tintuc_detail[0]["h5"]!='')
		$row_setting["h5_$lang"]=$tintuc_detail[0]["h5"];
	
	if($tintuc_detail[0]["h6"]!='')
		$row_setting["h6_$lang"]=$tintuc_detail[0]["h6"];
		
	if($tintuc_detail[0]["title"]!='')
		{
			$title_bar=$tintuc_detail[0]["title"];	
		}
		else
		
		{
			$title_bar=$tintuc_detail[0]["ten"];	
			
		}
		
		  // Share Facebook info news 
        $image = "http://".$config_url."/"._upload_news_l.$tintuc_detail[0]['photo'];
        $url_web = "http://".$config_url."/".$tintuc_detail[0]["tenkhongdau"]."";
		$description_web=strip_tags($tintuc_detail[0]["mota"]);
	
	
		$luotxem = $tintuc_detail[0]['luotxem']+1;
		$sql_update = "update #_news SET luotxem=$luotxem where id=".$tintuc_detail[0]['id'];
		$d->query($sql_update);
		
		$d->reset();
		$sql_khac = "select id,id_list,id_cat,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,photo,thumb,ngaytao from #_news where hienthi=1 and com='news' and id !=".$tintuc_detail[0]['id']." order by id desc";
		$d->query($sql_khac);
		$tintuc_khac = $d->result_array();

		return false;
	}
	
	
	
	
	
	
	// Kiểm tra danh sách chính sách công ty

	$d->reset();
	$sql = "select id,id_list,id_cat,id_item,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,photo,thumb,mota_$lang as mota,noidung_$lang as noidung,ngaytao,luotxem,title_$lang as title,description_$lang as description,keyword_$lang as keyword,h1_$lang as h1,h2_$lang as h2,h3_$lang as h3,h4_$lang as h4,h5_$lang as h5,h6_$lang as h6 from #_news where hienthi=1 and com='chinhsachcongty' and tenkhongdau_$lang='".$id."'";
	$d->query($sql);
	if($d->num_rows()>0){
		$template = "news_detail";
		$tintuc_detail = $d->result_array();
		$com_href="chinh-sach-cong-ty";
		$ten_list=$tintuc_detail[0]['tenkhongdau'];
		$ten_cat=$tintuc_detail[0]['tenkhongdau'];
		$id_listhome=$tintuc_detail[0]['id_list'];
		$id_cathome=$tintuc_detail[0]['id_cat'];
		$id_itemhome=$tintuc_detail[0]['id_item'];
		$com_title=_chinhsachcongty;
		
	
	$title_tcat=$com_title;
	
	if($tintuc_detail[0]["keyword_"]!='')
		$row_setting["keywords_$lang"]=$tintuc_detail[0]["keyword"];
	if($tintuc_detail[0]["description"]!='')
		$row_setting["description_$lang"]=$tintuc_detail[0]["description"];
		
	if($tintuc_detail[0]["h1"]!='')
		$row_setting["h1_$lang"]=$tintuc_detail[0]["h1"];	
		
	if($tintuc_detail[0]["h2"]!='')
		$row_setting["h2_$lang"]=$tintuc_detail[0]["h2"];	
	
	if($tintuc_detail[0]["h3"]!='')
		$row_setting["h3_$lang"]=$tintuc_detail[0]["h3"];
	
	if($tintuc_detail[0]["h4"]!='')
		$row_setting["h4_$lang"]=$tintuc_detail[0]["h4"];
	
	if($tintuc_detail[0]["h5"]!='')
		$row_setting["h5_$lang"]=$tintuc_detail[0]["h5"];
	
	
	if($tintuc_detail[0]["h6"]!='')
		$row_setting["h6_$lang"]=$tintuc_detail[0]["h6"];
		
	if($tintuc_detail[0]["title"]!='')
		{
			$title_bar=$tintuc_detail[0]["title"];	
		}
		else
		
		{
			$title_bar=$tintuc_detail[0]["ten"];	
			
		}
		
		  // Share Facebook info news 
        $image = "http://".$config_url."/"._upload_news_l.$tintuc_detail[0]['photo'];
        $url_web = "http://".$config_url."/".$tintuc_detail[0]["tenkhongdau"]."";
		$description_web=strip_tags($tintuc_detail[0]["mota"]);
	
	
		$luotxem = $tintuc_detail[0]['luotxem']+1;
		$sql_update = "update #_news SET luotxem=$luotxem where id=".$tintuc_detail[0]['id'];
		$d->query($sql_update);
		
		$d->reset();
		$sql_khac = "select id,id_list,id_cat,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,photo,thumb,ngaytao from #_news where hienthi=1 and com='chinhsachcongty' and id !=".$tintuc_detail[0]['id']." order by id desc";
		$d->query($sql_khac);
		$tintuc_khac = $d->result_array();

		return false;
	}
	

	
	
	// Kiểm tra danh sách khách hàng

	$d->reset();
	$sql = "select id,id_list,id_cat,id_item,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,photo,thumb,mota_$lang as mota,noidung_$lang as noidung,ngaytao,luotxem,title_$lang as title,description_$lang as description,keyword_$lang as keyword,h1_$lang as h1,h2_$lang as h2,h3_$lang as h3,h4_$lang as h4,h5_$lang as h5,h6_$lang as h6 from #_news where hienthi=1 and com='khachhang' and tenkhongdau_$lang='".$id."'";
	$d->query($sql);
	if($d->num_rows()>0){
		$template = "news_detail";
		$tintuc_detail = $d->result_array();
		
		$com_href="khach-hang";
		
		$ten_list=$tintuc_detail[0]['tenkhongdau'];
		$ten_cat=$tintuc_detail[0]['tenkhongdau'];
		$id_listhome=$tintuc_detail[0]['id_list'];
		$id_cathome=$tintuc_detail[0]['id_cat'];
		$id_itemhome=$tintuc_detail[0]['id_item'];
		$com_title=_khachhang;
		
	
	$title_tcat=$com_title;
	
	if($tintuc_detail[0]["keyword_"]!='')
		$row_setting["keywords_$lang"]=$tintuc_detail[0]["keyword"];
	if($tintuc_detail[0]["description"]!='')
		$row_setting["description_$lang"]=$tintuc_detail[0]["description"];
		
	if($tintuc_detail[0]["h1"]!='')
		$row_setting["h1_$lang"]=$tintuc_detail[0]["h1"];	
		
	if($tintuc_detail[0]["h2"]!='')
		$row_setting["h2_$lang"]=$tintuc_detail[0]["h2"];	
	
	
	if($tintuc_detail[0]["h3"]!='')
		$row_setting["h3_$lang"]=$tintuc_detail[0]["h3"];
	
	if($tintuc_detail[0]["h4"]!='')
		$row_setting["h4_$lang"]=$tintuc_detail[0]["h4"];
	
	if($tintuc_detail[0]["h5"]!='')
		$row_setting["h5_$lang"]=$tintuc_detail[0]["h5"];
	
	if($tintuc_detail[0]["h6"]!='')
		$row_setting["h6_$lang"]=$tintuc_detail[0]["h6"];
		
	if($tintuc_detail[0]["title"]!='')
		{
			$title_bar=$tintuc_detail[0]["title"];	
		}
		else
		
		{
			$title_bar=$tintuc_detail[0]["ten"];	
			
		}
		
		  // Share Facebook info news 
        $image = "http://".$config_url."/"._upload_news_l.$tintuc_detail[0]['photo'];
        $url_web = "http://".$config_url."/".$tintuc_detail[0]["tenkhongdau"]."";
		$description_web=strip_tags($tintuc_detail[0]["mota"]);
	
	
		$luotxem = $tintuc_detail[0]['luotxem']+1;
		$sql_update = "update #_news SET luotxem=$luotxem where id=".$tintuc_detail[0]['id'];
		$d->query($sql_update);
		
		$d->reset();
		$sql_khac = "select id,id_list,id_cat,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,photo,thumb,ngaytao from #_news where hienthi=1 and com='khachhang' and id !=".$tintuc_detail[0]['id']." order by id desc";
		$d->query($sql_khac);
		$tintuc_khac = $d->result_array();

		return false;
	}
	
	
	
	// Lấy id_list cap 1 tin tức
	$d->reset();	
	$sql = "select id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,photo,mota_$lang as mota,title_$lang as title,description_$lang as description,keyword_$lang as keyword,h1_$lang as h1,h2_$lang as h2,h3_$lang as h3,h4_$lang as h4,h5_$lang as h5,h6_$lang as h6 from #_news_list where tenkhongdau_$lang ='".$id."' and com='video'";
	$d->query($sql);
	if($d->num_rows()>0){
		$template = 'video';
		$id_list = $d->fetch_array();
		
	
		
		$idl = $id_list['id'];
		
		
		$id_listhome=$id_list['id'];
		$cat1=$id_list['tenkhongdau'];
		

		
		// Share Facebook info product 
		if ($id_list["photo"]!="")
		{
		$image = "http://".$config_url."/"._upload_news_l.$id_list['photo'];
		}
       
        $url_web = "http://".$config_url."/".$cat1."";
		$description_web=strip_tags($id_list["mota"]);
		
      

		// Get Keyword + Des +  heading (h1,h2) 

		if($id_list["keyword"]!='')
			$row_setting["keywords_$lang"]=$id_list["keyword"];
		if($id_list["description"]!='')
			$row_setting["description_$lang"]=$id_list["description"];
			
		if($id_list["h1"]!='')
				$row_setting["h1_$lang"]=$id_list["h1"];	
				
		if($id_list["h2"]!='')
				$row_setting["h2_$lang"]=$id_list["h2"];	

	
		if($id_list["h3"]!='')
				$row_setting["h3_$lang"]=$id_list["h3"];
			
		if($id_list["h4"]!='')
				$row_setting["h4_$lang"]=$id_list["h4"];	
			
		if($id_list["h5"]!='')
				$row_setting["h5_$lang"]=$id_list["h5"];

		if($id_list["h6"]!='')
				$row_setting["h6_$lang"]=$id_list["h6"];		
			
				
			if($id_list["title"]!='')
			{
				$title_bar=$id_list["title"];	
			}
			else
			
			{
				$title_bar=$id_list["ten"];	
				
			}	
				
	
		$title_tcat=$id_list["ten"];
		

		
		
			$sql="SELECT count(id) AS numrows FROM #_news  where hienthi=1  and id_list=$idl  order by id desc";
		$d->query($sql);	
		$dem=$d->fetch_array();
		$totalRows=$dem['numrows'];
		$page=$_GET['curPage'];
		
		$pageSize=12;
		
		$offset=5;
							
		if ($page=="")
			$page=1;
		else 
			$page=$_GET['curPage'];
		$page--;
		$bg=$pageSize*$page;		
		
		
	$d->reset();
	$sql = "select id,id_list,id_cat,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,mota_$lang as mota,noidung_$lang as noidung,photo,thumb,ngaytao,luotxem,link from #_news where hienthi=1  and id_list=$idl  order by id desc limit $bg,$pageSize";		
	$d->query($sql);
	$tintuc = $d->result_array();
	$page_url="".$cat1."/";		
	$url_link="http://".$config_url."/".$page_url."page";	
		
		
		return false;
		
	}
	
	
	
	
	
	
	
	// Lấy id_cat
	$d->reset();	
	$sql = "select id,id_list,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,photo,thumb,title_$lang as title,description_$lang as description,keyword_$lang as keyword,h1_$lang as h1,h2_$lang as h2,h3_$lang as h3,h4_$lang as h4,h5_$lang as h5,h6_$lang as h6  from #_news_cat where tenkhongdau_$lang ='".$id."'";
	
	$d->query($sql);
	if($d->num_rows()>0){
		$template = 'video';
		$id_cat = $d->fetch_array();

		
		
		$idc = $id_cat['id'];
		$id_listhome=$id_cat['id_list'];
		$id_cathome=$id_cat['id'];
		$cat2=$id_cat['tenkhongdau'];
		
		// Share Facebook info product 
		if ($id_cat["photo"]!="")
		{
		$image = "http://".$config_url."/"._upload_news_l.$id_cat['photo'];
		}
       
        $url_web = "http://".$config_url."/".$cat1."";
		$description_web=strip_tags($id_cat["ten"]);
		
      

		// Get Keyword + Des +  heading (h1,h2) 

		if($id_cat["keyword"]!='')
			$row_setting["keywords_$lang"]=$id_cat["keyword"];
		if($id_cat["description"]!='')
			$row_setting["description_$lang"]=$id_cat["description"];
			
		if($id_cat["h1"]!='')
				$row_setting["h1_$lang"]=$id_cat["h1"];	
				
		if($id_cat["h2"]!='')
				$row_setting["h2_$lang"]=$id_cat["h2"];		

		if($id_cat["h3"]!='')
				$row_setting["h3_$lang"]=$id_cat["h3"];		
			
		if($id_cat["h4"]!='')
				$row_setting["h4_$lang"]=$id_cat["h4"];	
			
		if($id_cat["h5"]!='')
				$row_setting["h5_$lang"]=$id_cat["h5"];	
			
		if($id_cat["h6"]!='')
				$row_setting["h6_$lang"]=$id_cat["h6"];		
				
			if($id_cat["title"]!='')
			{
				$title_bar=$id_cat["title"];	
			}
			else
			
			{
				$title_bar=$id_cat["ten"];	
				
			}	
				
	
		$title_tcat=$id_cat["ten"];
		
		
		$d->reset();	
		$sql = "select id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,photo,thumb,title_$lang as title,description_$lang as description,keyword_$lang as keyword,h1_$lang as h1,h2_$lang as h2,h3_$lang as h3,h4_$lang as h4,h5_$lang as h5,h6_$lang as h6  from #_news_list where id=".$id_cat['id_list'];
		$d->query($sql);
		if($d->num_rows()>0){
			$id_list = $d->fetch_array();				
			$idl = $id_list['id'];
			$slide = $id_list['photo'];
		}
		
		$d->reset();	
		$sql = "select id,id_list,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau from #_news_cat where id_list=$idl";
		$d->query($sql);
		$item = $d->result_array();
		
		
		
		$sql="SELECT count(id) AS numrows FROM #_news  where hienthi=1 and id_list=$idl and id_cat=$idc  order by id desc";
		$d->query($sql);	
		$dem=$d->fetch_array();
		$totalRows=$dem['numrows'];
		$page=$_GET['curPage'];
		
		$pageSize=12;
		
		$offset=5;
							
		if ($page=="")
			$page=1;
		else 
			$page=$_GET['curPage'];
		$page--;
		$bg=$pageSize*$page;		
		
		
	$d->reset();
	$sql = "select id_cat,id_list,id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,mota_$lang as mota,alt_$lang as alt,title_$lang as title,description_$lang as description,keyword_$lang as keyword,photo,thumb,luotxem,link from #_news where hienthi=1  and id_list=$idl and id_cat=$idc  order by id desc limit $bg,$pageSize";		
	$d->query($sql);
	$tintuc = $d->result_array();
	$page_url="".$cat2."/";		
	$url_link="http://".$config_url."/".$page_url."page";	

	return false;
	}
		
	
	
	
	
	
	// Kiểm tra chi tiết danh sách video

	$d->reset();
	$sql = "select id,id_list,id_cat,id_item,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,photo,thumb,mota_$lang as mota,noidung_$lang as noidung,ngaytao,luotxem,title_$lang as title,description_$lang as description,keyword_$lang as keyword,h1_$lang as h1,h2_$lang as h2,h3_$lang as h3,h4_$lang as h4,h5_$lang as h5,h6_$lang as h6,link from #_news where hienthi=1 and com='video' and tenkhongdau_$lang='".$id."'";
	$d->query($sql);
	if($d->num_rows()>0){
		$template = "video_detail";
		$tintuc_detail = $d->result_array();
		
		$ten_list=$tintuc_detail[0]['tenkhongdau'];
		$ten_cat=$tintuc_detail[0]['tenkhongdau'];
		$id_listhome=$tintuc_detail[0]['id_list'];
		$id_cathome=$tintuc_detail[0]['id_cat'];
		$id_itemhome=$tintuc_detail[0]['id_item'];
		$com_title="Video Clip";
		
	
	$title_tcat=$com_title;
	
	if($tintuc_detail[0]["keyword_"]!='')
		$row_setting["keywords_$lang"]=$tintuc_detail[0]["keyword"];
	if($tintuc_detail[0]["description"]!='')
		$row_setting["description_$lang"]=$tintuc_detail[0]["description"];
		
	if($tintuc_detail[0]["h1"]!='')
		$row_setting["h1_$lang"]=$tintuc_detail[0]["h1"];	
		
	if($tintuc_detail[0]["h2"]!='')
		$row_setting["h2_$lang"]=$tintuc_detail[0]["h2"];	
	
	if($tintuc_detail[0]["h3"]!='')
		$row_setting["h3_$lang"]=$tintuc_detail[0]["h3"];
	
	
	if($tintuc_detail[0]["h4"]!='')
		$row_setting["h4_$lang"]=$tintuc_detail[0]["h4"];
	
	if($tintuc_detail[0]["h5"]!='')
		$row_setting["h5_$lang"]=$tintuc_detail[0]["h5"];
	
	if($tintuc_detail[0]["h6"]!='')
		$row_setting["h6_$lang"]=$tintuc_detail[0]["h6"];
		
	if($tintuc_detail[0]["title"]!='')
		{
			$title_bar=$tintuc_detail[0]["title"];	
		}
		else
		
		{
			$title_bar=$tintuc_detail[0]["ten"];	
			
		}
		
		  // Share Facebook info news 
        $image = "http://".$config_url."/"._upload_news_l.$tintuc_detail[0]['photo'];
        $url_web = "http://".$config_url."/".$tintuc_detail[0]["tenkhongdau"]."";
		$description_web=strip_tags($tintuc_detail[0]["mota"]);
	
	
		$luotxem = $tintuc_detail[0]['luotxem']+1;
		$sql_update = "update #_news SET luotxem=$luotxem where id=".$tintuc_detail[0]['id'];
		$d->query($sql_update);
		
		$d->reset();
		$sql_khac = "select id,id_list,id_cat,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,photo,thumb,ngaytao,link from #_news where hienthi=1 and com='video' and id !=".$tintuc_detail[0]['id']." order by id desc";
		$d->query($sql_khac);
		$tintuc_khac = $d->result_array();

		return false;
	}
	
	
	
	
	
	header('location:http://'.$config_url.'/khong-tim-thay-trang');
	
?>