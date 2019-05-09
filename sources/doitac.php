<?php  if(!defined('_source')) die("Error");
		

			$sql = "select * from #_image_url where hienthi=1  and com='doitac' order by stt asc,id desc";	
			$d->query($sql);
			$doitac = $d->result_array();	
			
			
			
				
				
			$title_bar=_doitac;	
			$title_tcat=_doitac;
			$curPage = isset($_GET['p']) ? $_GET['p'] : '1';
			$search = isset($_GET['keyword']) ? 'keyword='.$_GET['keyword'] .'/' : '';
			$url = 'tim-kiem/'.$search;
			$maxR=8;
			$maxP=5;
			$paging=paging_home($doitac, $url, $curPage, $maxR, $maxP);
			$doitac=$paging['source'];



?>