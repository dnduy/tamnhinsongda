<?php if(!defined('_source')) die("Error");
		
		$kichhoat = $_GET['capcha'];
		
		//exit();
		$sqlUPDATE_ORDER = "UPDATE table_user SET hienthi=1 WHERE user='$kichhoat'";
        $d->reset();
        $sql = "select hoten from table_user where user='".$kichhoat."'";
        $d->query($sql);
        $taikhoan = $d->fetch_array();
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");

		$title_bar .= "Kích hoạt tài khoản";	
		
		
		
	$d->reset();
	$sql = "select noidung_$lang from #_info where com='about' ";	
	$d->query($sql);
	$about_active = $d->fetch_array();

		
?>