<?php  if(!defined('_source')) die("Error");
			
		
		if(isset($_GET['tag'])){
			
			$tukhoa = $_GET['tag'];
			$tukhoa = trim(strip_tags($tukhoa));    	
    		if (get_magic_quotes_gpc()==false) {
    			$tukhoa = mysql_real_escape_string($tukhoa);    			
    		}			
			$str='0';
			$tagkhongdau=stripUnicode($tukhoa);
			$sql="select item_id from #_tag where (tag like '%$tukhoa%') or (tag like '%$tagkhongdau%') group by item_id";
			$d->query($sql);			
			$result_id=$d->result_array();
			
			for($i=0;$i<count($result_id);$i++){
			$str.=','.$result_id[$i]['item_id'];		
		}
		//$str=substr($str,1,-1);							
			// cac tin tuc
				$title_bar='Tag:'.$tukhoa.', '.$tagkhongdau;	
	$title_tcat='Tag: <span style="text-transform:none">'.$tukhoa.', '.$tagkhongdau.'</span>';
			
			$sql_tintuc = "select p.id,p.ten_$lang,p.tenkhongdau,p.photo,i.tenkhongdau as tenloai, c.tenkhongdau as danhmuc from #_product as p,#_product_cat as i,#_product_list as c where p.hienthi = 1 and p.id_list=c.id and p.id_cat = i.id and  p.id in($str) order by p.stt,p.id desc";			
			$d->query($sql_tintuc);
			$product = $d->result_array();	
			
			$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
			$url=getCurrentPageURL();
			$maxR=18;
			$maxP=5;
			$paging=paging_home($product, $url, $curPage, $maxR, $maxP);
			$product=$paging['source'];
		}
?>