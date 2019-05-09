<?php  if(!defined('_source')) die("Error");
	$d->setTable('info');
	$d->setWhere("com",$com_type);
	$d->select("ten_$lang,noidung_$lang, keyword_$lang, description_$lang,title_$lang,h1_$lang,h2_$lang,is_index,photo,mota_$lang,concepter_$lang,brochure_$lang,luotxem,id");
	if($d->num_rows()>0){
		$row = $d->fetch_array();
		$ten_info= $row["ten_$lang"];
		$mota_info= $row["mota_$lang"];
		$noidung_info= $row["noidung_$lang"];
		$concepter_info= $row["concepter_$lang"];
		$brochure_info= $row["brochure_$lang"];
		if($row["keyword_$lang"]!='')
			$row_setting["keywords_$lang"]=$row["keyword_$lang"];
		if($row["description_$lang"]!='')
			$row_setting["description_$lang"]=$row["description_$lang"];
			
	if($row["h1_$lang"]!='')
			$row_setting["h1_$lang"]=$row["h1_$lang"];		
			
	if($row["h2_$lang"]!='')
			$row_setting["h2_$lang"]=$row["h2_$lang"];				
			
	if($row["title_$lang"]!='')
	{
			$title_bar=$row["title_$lang"];	
	}
	else
		
	{
			$title_bar=$row["ten_$lang"];	
			
	}		
		
		$sql_lanxem = "UPDATE #_info SET luotxem=luotxem+1  WHERE id ='".$row["id"]."'";
		$d->query($sql_lanxem);
			
	}
	
	
	
	
	// thanh tieu de
	//$title_bar= _gioithieu;

	$title_com=$com_title;
	
	if ($row["ten_$lang"]!='')
	{
		
		$title_tcat=$row["ten_$lang"];
		
	}
	else
	{
		$title_tcat=$com_title;
	}
	
	
	
	$d->reset();
	$sql_banner_giua = "select banner_$lang from #_banner where com='banner_top' ";
	$d->query($sql_banner_giua);
	$row_logo = $d->fetch_array();

	$image="http://".$config_url."/"._upload_hinhanh_l.$row_logo["banner_$lang"]."";
	$url_web="http://".$config_url."/"."".$com."".".html";
	
	$description_web=strip_tags($row_setting["title_$lang"]);
?>