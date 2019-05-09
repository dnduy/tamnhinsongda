<?php
	$title_bar= _aff;
	// Array
	// (
	//     [com] => gio-hang
	//     [step] => index
	//     [id_product] => 995
	//     [id_color] => 138
	//     [giamgia] => 10
	// )
	$action = magic_quote(@$_GET['act']);

	if(!empty($action) && $action=='signup'){
		$title_bar= 'Signup Afﬁliate';
	}

	if(!empty($action) && $action=='login'){
		$title_bar= 'Login Afﬁliate';
		if(!empty($_SESSION['login'])){
			redirect("http://".$config_url."/trang-ca-nhan/thong-tin-ca-nhan/member");
		}
	}
	
?>