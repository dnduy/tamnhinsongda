<?php  if(!defined('_source')) die("Error");
		@$idl =  addslashes($_GET['idl']);
		@$idcat =  addslashes($_GET['idcat']);
		@$idi =  addslashes($_GET['idi']);
		@$idsub =  addslashes($_GET['idsub']);
		@$id=  addslashes($_GET['id']);	
if(isset($_GET['id'])){
	#tin tuc chi tiet


	$id =  addslashes($_GET['id']);

	$sql_lanxem = "UPDATE #_news SET luotxem=luotxem+1  WHERE id ='".$id."'";
	$d->query($sql_lanxem);
			
	$sql = "select * from #_news where hienthi=1 and id='".$id."'";
	$d->query($sql);
	$tintuc_detail = $d->result_array();



	$ten_list=$tintuc_detail[0]['tenkhongdau_$lang'];
	$ten_cat=$tintuc_detail[0]['tenkhongdau_$lang'];
	$id_listhome=$tintuc_detail[0]['id_list'];
	$id_cathome=$tintuc_detail[0]['id_cat'];
	$id_itemhome=$tintuc_detail[0]['id_item'];
		
	
	$title_tcat=$com_title;
	
	if($tintuc_detail[0]["keyword_$lang"]!='')
		$row_setting["keywords_$lang"]=$tintuc_detail[0]["keyword_$lang"];
	if($tintuc_detail[0]["description_$lang"]!='')
		$row_setting["description_$lang"]=$tintuc_detail[0]["description_$lang"];
		
	if($tintuc_detail[0]["h1_$lang"]!='')
		$row_setting["h1_$lang"]=$tintuc_detail[0]["h1_$lang"];	
		
	if($tintuc_detail[0]["h2_$lang"]!='')
		$row_setting["h2_$lang"]=$tintuc_detail[0]["h2_$lang"];	
		
	if($tintuc_detail[0]["title_$lang"]!='')
		{
			$title_bar=$tintuc_detail[0]["title_$lang"];	
		}
		else
		
		{
			$title_bar=$tintuc_detail[0]["ten_$lang"];	
			
		}
		
		  // Share Facebook info news 
        $image = "http://".$config_url."/"._upload_news_l.$tintuc_detail[0]['photo'];
        $url_web = "http://".$config_url."/".$com."/".$tintuc_detail[0]["tenkhongdau_$lang"]."-".$tintuc_detail[0]['id'].".html";
		$description_web=strip_tags($tintuc_detail[0]["mota_$lang"]);



	#ALBUM HÌNH======================	
		
				
		$d->reset();
		$sql_detail = "select id,photo from #_hasp where hienthi=1 and id_photo='".$tintuc_detail[0]['id']."' and com='hanews' order by stt desc";
		$d->query($sql_detail);
		$album_hinh = $d->result_array();	
     
		
	#các tin cu hon
	$sql_khac = "select ten_$lang,tenkhongdau_$lang,ngaytao,id from #_news where hienthi=1 and id <>'".$id."' and com='".$com_type."' order by stt,ngaytao desc limit 0,5";
	$d->query($sql_khac);
	$tintuc_khac = $d->result_array();




	
}else{
	$title_bar=$com_title;		
	$title_tcat=$com_title;	
	//$sql_news = "select * from #_news where hienthi=1 and com='".$com_type."'";

	@$limit=(int)$_GET['limit'];

	$sql_news = "SELECT count(id) AS numrows FROM #_news where hienthi=1  and com='".$com_type."' ";

	if(isset($_GET['idl'])){
		$idl =  addslashes($_GET['idl']);
		$id_listhome=$idl;
		
		$d->reset();
		$sql_title="select ten_$lang,id,tenkhongdau_$lang from #_news_list where com='".$com_type."' and tenkhongdau_$lang='$idl'";
		$d->query($sql_title);
		$lay_idlist = $d->fetch_array();	
		
		$d->reset();
		$sql_title="select ten_$lang,id,tenkhongdau_$lang,title_$lang,keyword_$lang,description_$lang,mota_$lang,photo,h1_$lang,h2_$lang from #_news_list where com='".$com_type."' and tenkhongdau_$lang='$idl'";
		$d->query($sql_title);
		$title_car = $d->fetch_array();
		
		
		$d->reset();
		$sql = "select ten_$lang,id,tenkhongdau_$lang from #_news_list where hienthi=1 and com='".$com_type."' and id='".$lay_idlist['id']."'   order by stt,id desc";
		$d->query($sql);
		$id_list1 = $d->result_array();
		
		
		
		
		if($title_car["keyword_$lang"]!='')
			$row_setting["keywords_$lang"]=$title_car["keyword_$lang"];
		if($title_car["description_$lang"]!='')
			$row_setting["description_$lang"]=$title_car["description_$lang"];
			
	if($title_car["h1_$lang"]!='')
			$row_setting["h1_$lang"]=$title_car["h1_$lang"];	
			
		if($title_car["h2_$lang"]!='')
			$row_setting["h2_$lang"]=$title_car["h2_$lang"];			
			
			
		if($title_car["tenkhongdau_$lang"]!='')
			$url_web="http://".$config_url."/".$com."/".$title_car['tenkhongdau_$lang']."/";
		if($title_car["photo"]!='')
			$image="http://".$config_url."/"._upload_news_l.$title_car['photo'];
		
		if($title_car["title_$lang"]!='')
			$description_web=strip_tags($title_car["title_$lang"]);	
			
			
		if($title_car["title_$lang"]!='')
		{
			$title_bar=$title_car["title_$lang"];	
		}
		else
		
		{
			$title_bar=$title_car["ten_$lang"];	
			
		}
		
		
	
		$title_tcat=$title_car["ten_$lang"];
		$cat1=$title_car["tenkhongdau_$lang"].'';
		$sql_news.=" and id_list='".$id_list1[0]['id']."'";
		$sql_cap.=" and id_list='".$id_list1[0]['id']."'";
	}
	
	if(isset($_GET['idcat'])){
		$idcat =  addslashes($_GET['idcat']);
		$id_listhome=$idl;
		$id_cathome=$idcat;
		
		
		
		$d->reset();
		$sql = "select ten_$lang,id,tenkhongdau_$lang from #_news_list where com='".$com_type."' and tenkhongdau_$lang='$idl'";
		$d->query($sql);
		$layid_list = $d->fetch_array();
		
		$d->reset();
		$sql_title="select ten_$lang,id,tenkhongdau_$lang,title_$lang,keyword_$lang,description_$lang from #_news_cat where com='".$com_type."' and tenkhongdau_$lang='$idcat'";
		$d->query($sql_title);
		$title_car = $d->fetch_array();	
		
		$d->reset();
		$sql = "select ten_$lang,id,tenkhongdau_$lang,id_list from #_news_cat where hienthi=1 and com='".$com_type."' and id_list='".$layid_list['id']."' and id='".$title_car['id']."' order by stt,id desc";
		$d->query($sql);
		$id_cat1 = $d->result_array();
		
		
		
		if($title_car["keyword_$lang"]!='')
			$row_setting["keywords_$lang"]=$title_car["keyword_$lang"];
		if($title_car["description_$lang"]!='')
			$row_setting["description_$lang"]=$title_car["description_$lang"];
			
		if($title_car["tenkhongdau_$lang"]!='')
			$url_web="http://".$config_url."/".$com."/".$title_car['tenkhongdau_$lang']."/";
		if($title_car["photo"]!='')
			$image="http://".$config_url."/"._upload_news_l.$title_car['photo'];
		
		if($title_car["title_$lang"]!='')
			$description_web=strip_tags($title_car["title_$lang"]);	
			
		
		if($title_car["title_$lang"]!='')
		{
			$title_bar=$title_car["title_$lang"];	
		}
		else
		
		{
			$title_bar=$title_car["ten_$lang"];	
			
		}		
			
		
		$title_tcat=$title_car["ten_$lang"];
			
		
		$cat2=$title_car["tenkhongdau_$lang"].'/';
		$sql_news.=" and id_cat='".$id_cat1[0]['id']."'";

		$sql_cap.=" and id_cat='".$id_cat1[0]['id']."'";
	}
	
	
	if(isset($_GET['idi'])){
		$idi =  addslashes($_GET['idi']);
		$id_listhome=$idl;
		$id_cathome=$idcat;
		$id_itemhome=$idi;
		
		$d->reset();
		$sql = "select ten_$lang,id,tenkhongdau_$lang from #_news_list where com='".$com_type."' and tenkhongdau_$lang='$idl'";
		$d->query($sql);
		$layid_list = $d->fetch_array();
		
		$d->reset();
		$sql = "select ten_$lang,id,tenkhongdau_$lang from #_news_cat where com='".$com_type."' and tenkhongdau_$lang='$idcat'";
		$d->query($sql);
		$layid_cat = $d->fetch_array();
		
		$d->reset();
		$sql_title="select ten_$lang,id,tenkhongdau_$lang,title_$lang,keyword_$lang,description_$lang  from #_news_item where com='".$com_type."' and tenkhongdau_$lang='$idi'";
		$d->query($sql_title);
		$title_car = $d->fetch_array();	
		
		
		$d->reset();
		$sql = "select ten_$lang,id,tenkhongdau_$lang,id_list,id_cat from #_news_item where hienthi=1 and com='".$com_type."' and id_list='".$layid_list['id']."' and id_cat='".$layid_cat['id']."' and id='".$title_car['id']."'   order by stt,id desc";
		$d->query($sql);
		$id_item1 = $d->result_array();
		
		if($title_car["keyword_$lang"]!='')
			$row_setting["keywords_$lang"]=$title_car["keyword_$lang"];
		if($title_car["description_$lang"]!='')
			$row_setting["description_$lang"]=$title_car["description_$lang"];
		
		if($title_car["title_$lang"]!='')
		{
			$title_bar=$title_car["title_$lang"];	
		}
		else
		
		{
			$title_bar=$title_car["ten_$lang"];	
			
		}	
			
	
		$title_tcat=$title_car["ten_$lang"];
		$cat3=$title_car["tenkhongdau_$lang"].'/';
		$sql_news.=" and id_item='".$id_item1[0]['id']."'";
		$sql_cap.=" and id_item='".$id_item1[0]['id']."'  ";
		
		
	}	
	
	
	$sql_news.=" order by stt,ngaytao desc";

	$d->query($sql_news);	
	$dem=$d->fetch_array();

	$totalRows=$dem['numrows'];
	$page=$_GET['curPage'];
		
	$pageSize=12;
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

	$d->reset();
	$sql="select * from #_news where hienthi=1 and com='".$com_type."' $sql_cap  order by id desc  limit $bg,$pageSize ";

	
	$d->query($sql);
	$tintuc=$d->result_array();


	if(isset($_GET['idl'])  and !isset($_GET["idcat"]))
		{
		  $catalog_url=@$cat1."";
		  $gach_kc="";
		  $gach_sequence="";
		  $and_kc="";
		  
		  //echo ("cap 1");
		
		}
		else if (isset($_GET["idl"]) and isset($_GET["idcat"]) and !isset($_GET["idi"]) ){
			
			
			// echo ("cap 2");
		   $catalog_url=@$cat1."".@$cat2."";
		   $gach_kc="";
		   $gach_sequence="";
		   $and_kc="";
		
			
		}
		else if (isset($_GET["idi"]) and isset($_GET["idcat"]) and isset($_GET["idi"]))
		{
		  // echo ("cap 3");
		  $catalog_url=@$cat1."/".@$cat2."/".@$cat3."";
		  $gach_kc="/";
		  $gach_sequence="";
		  $and_kc="--&";
		}
		else{
		$catalog_url="$com.html/";
		}

	
	$url_link="http://".$config_url."/".$catalog_url."".$and_kc."page";	

	
	
}
?>