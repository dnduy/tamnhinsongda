<?php  if(!defined('_source')) die("Error");


			$d->reset();
			$sql_contact = "select noidung_$lang,mota_$lang,ten_$lang from #_info where com='users' ";
			$d->query($sql_contact);
			$about_users = $d->fetch_array();
			

?>