<?php  if(!defined('_source')) die("Error");
		if(isset($_GET['keyword'])){
			$tukhoa = trim(strip_tags($_GET['keyword']));    	
			if (get_magic_quotes_gpc()==false) {
				$tukhoa = mysql_real_escape_string($tukhoa);    			
			}



		$sql="SELECT count(id) AS numrows FROM #_product  where hienthi=1  and ten_vi like'%$tukhoa%' or ten_en like'%$tukhoa%' or tenkhongdau_$lang like'%$tukhoa%' order by stt asc,id asc";
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
	$sql = "select * from #_product where hienthi=1  and ten_vi like'%$tukhoa%' or ten_en like'%$tukhoa%' or tenkhongdau_$lang like'%$tukhoa%' order by id desc,stt asc limit $bg,$pageSize";		
	$d->query($sql);
	$product = $d->result_array();
	$search = isset($_GET['keyword']) ? 'keyword='.$_GET['keyword'] .'/' : '';
	$page_url="tim-kiem/";		
	$url_link="http://".$config_url."/".$page_url."".$search."page";	
						

			if($lang=='en')
				$notice = "Found <b>".count($product)."</b> results";
			else
				$notice = "Tìm thấy <b>".count($product)."</b> kết quả";

			$title_bar=_timkiem;	
			$title_tcat=_timkiem;
			
			
			$path='<a href="http://'.$config_url.'>" title="'._trangchu.'">'._trangchu.'</a><span>→</span>
    <a href="javascript:;" title="'._timkiem.'">'._timkiem.'</a>';
			
		}else{
			header('index.html');	
		}
?>