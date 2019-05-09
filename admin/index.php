<?php
	session_start();
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , '../libraries/');

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."construct_name.php";
	include_once _lib."functions.php";
	include_once _lib."functions_member.php";
	include_once _lib."admin_functions.php";
	include_once _lib."functions_giohang.php";
		include_once _lib."fix_orientation.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";	
	include_once _lib."pclzip.php";
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";	

	
	$login_name = 'GaConIT100591';	
	$d = new database($config['database']);	
	
	$atool = new AdminTools($d);
	$archive = new PclZip($file);



	$_SESSION['SCRIPT_FILENAME'] = str_replace("/admin/index.php","",$_SERVER['SCRIPT_FILENAME']);
	$_SESSION['SERVER_FOLDER'] = $config['finder']['folder'];
	$_SESSION['UPLOAD_DIR'] = $config['finder']['dir'];

	if($_GET['author']!=""){ 
      header('Content-Type: text/html; charset=utf-8');
      echo '<pre>';
      print_r($config['author']);
      echo '</pre>';
      die();
	}


	switch($com){

			case 'hoahong':
       $source = "hoahong";
    break;	

	case 'lang_define':
       $source = "lang_define";
    break;		

	case 'quangcaobody':
			$source = "quangcaobody";
			break;	
			
	
		case 'nhanhopdong':
			$source = "nhanhopdong";
			break;	
			

		case 'contact':
			$source = "contact";
			break;	
		
		case 'newsletter':
			$source = "newsletter";
			break;

		case 'sendmailmember':
			$source = "sendmailmember";
			break;	
			
		case 'city':
			$source = "city";
			break;		


		case 'order':
			$source = "order";
			break;

		case 'database':
			$source = "database";
			break;	
		
		case 'backup':
			$source = "backup";
			break;		
		
		case 'info':
			$source = "info";
			break;


		case 'bando':
			$source = "bando";
			break;	



		case 'news':
			$source = "news";
			break;		
	
			
			
		case 'product':
			$source = "product";				
			break;
			
		case 'users':
			$source = "users";
			break;		
			
		case 'user':
			$source = "user";
			break;		



		case 'setting':
			$source = "setting";
			break;	

		case 'support_online':
			$source = "support_online";
			break;
													

	
	case 'banner':
			$source = "banner";
			break;
			
	case 'image_url':
			$source = "image_url";
			break;		
			
	case 'hasp':
			$source = "hasp";
			break;				
			
	case 'download':
			$source = "download";
			break;		
		
			
	case 'color':
			$source = "color";
			break;		


	case 'background':
			$source = "background";
			break;

	case 'video':
			$source = "video";
			break;										
			
		default: 
			$source = "";
			$template = "index";
			break;
	}
	
	if((!isset($_SESSION[$login_name]) || $_SESSION[$login_name]==false) && $act!="login"){
		redirect("index.php?com=user&act=login");
	}
	$atool->execPer();
	if($source!="") include _source.$source.".php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrator - Hệ thống quản trị nội dung</title>

<!-- Font Awesome -->
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

<link href="css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.7.1.js"></script>
<script type="text/javascript" src="js/external.js"></script>
<script type="text/javascript" src="js/datepicker/datepicker/js/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="js/datepicker/datepicker/js/bootstrap-datepicker.js"></script>
<link href="js/datepicker/datepicker/css/datepicker.css" rel="stylesheet" type="text/css" />
 <script src="ckeditor/ckeditor.js" type="text/javascript" ></script>
	<script src="ckfinder/ckfinder.js" type="text/javascript" ></script>
	


</head>
<?php if(isset($_SESSION[$login_name]) && ($_SESSION[$login_name] == true)){?>  
<body >




<!-- Left side content -->    
<script type="text/javascript">
$(function(){
	var num = $('#menu').children(this).length;
	for (var index=0; index<=num; index++)
	{
		var id = $('#menu').children().eq(index).attr('id');
		$('#'+id+' strong').html($('#'+id+' .sub').children(this).length);
		$('#'+id+' .sub li:last-child').addClass('last');
	}
	$('#menu .activemenu .sub').css('display', 'block');
	$('#menu .activemenu a').removeClass('inactive');
})
</script>


<script language="javascript">
	$(document).ready(function(){
		
	$(".editor").each(function(){
				$id=$(this).attr("id");
				var editor = CKEDITOR.replace(''+$id, {
				uiColor: '#EAEAEA',
				language: 'en',
				skin: 'moono',
				width: <?=$config['ckeditor']['width']?>,
				resize_enabled: true,
				removePlugins: 'resize',
				removePlugins : 'elementspath',
				height: <?=$config['ckeditor']['height']?>,
				filebrowserImageBrowseUrl: 'ckfinder/ckfinder.html?Type=Images',
				filebrowserFlashBrowseUrl: 'ckfinder/ckfinder.html?Type=Flash',
				filebrowserLinkBrowseUrl: 'ckfinder/ckfinder.html',
				filebrowserImageUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
				filebrowserFlashUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
				filebrowserLinkUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload',
			});
			})	
		
    //  When user clicks on tab, this code will be executed
    $("#tabs li").click(function() {
        //  First remove class "active" from currently active tab
        $("#tabs li").removeClass('active');
 
        //  Now add class "active" to the selected/clicked tab
        $(this).addClass("active");
 
        //  Hide all tab content
        $(".tab_content").hide();
 
        //  Here we get the href value of the selected tab
        var selected_tab = $(this).find("a").attr("href");
 
        //  Show the selected tab content
        $(selected_tab).fadeIn();
 
        //  At the end, we add return false so that the click on the link is not executed
        return false;
    });
	
	
	
	$("#tabs_seo li").click(function() {
        //  First remove class "active" from currently active tab
        $("#tabs_seo li").removeClass('active');
 
        //  Now add class "active" to the selected/clicked tab
        $(this).addClass("active");
 
        //  Hide all tab content
        $(".tab_seo_content").hide();
 
        //  Here we get the href value of the selected tab
        var selected_tab = $(this).find("a").attr("href");
 
        //  Show the selected tab content
        $(selected_tab).fadeIn();
 
        //  At the end, we add return false so that the click on the link is not executed
        return false;
    });
	
});
</script>



<script language="javascript">

// JavaScript Document
$(document).ready(function(e) {
	
 <?php foreach ($config["lang"] as $key => $value) {?>	
    $('#validate textarea[name="description_<?=$value?>"]').keyup(function(){
		var num_<?=$value?> = $(this).val().length;
		$('input[name="deschar_<?=$value?>"]').val(num_<?=$value?>);
	})	
 <?php }?>	
	
	
});

function CreateTitleSEO(){
	var f = document.getElementById("validate");
	
<?php foreach ($config["lang"] as $key => $value) {?>
	ten_<?=$value?> = f.ten_<?=$value?>.value;
 <?php }?>		
	
	
	<?php foreach ($config["lang"] as $key => $value) {?>
	f.h1_<?=$value?>.value = ten_<?=$value?>;
	 <?php }?>	
	
	
	
	<?php foreach ($config["lang"] as $key => $value) {?>
	f.h2_<?=$value?>.value = ten_<?=$value?>;
	 <?php }?>	
	 
	 
	 <?php foreach ($config["lang"] as $key => $value) {?>
	f.h3_<?=$value?>.value = ten_<?=$value?>;
	 <?php }?>	
	 
	 <?php foreach ($config["lang"] as $key => $value) {?>
	f.h4_<?=$value?>.value = ten_<?=$value?>;
	 <?php }?>	
	 
	  <?php foreach ($config["lang"] as $key => $value) {?>
	f.h5_<?=$value?>.value = ten_<?=$value?>;
	 <?php }?>	

	 
	   <?php foreach ($config["lang"] as $key => $value) {?>
	f.h6_<?=$value?>.value = ten_<?=$value?>;
	 <?php }?>	

	<?php foreach ($config["lang"] as $key => $value) {?>
	f.title_<?=$value?>.value = ten_<?=$value?>;
 <?php }?>	
	
	<?php foreach ($config["lang"] as $key => $value) {?>
	f.alt_<?=$value?>.value = ten_<?=$value?>;
	<?php }?>
	
	//f.title_en.value = name_en;
	<?php foreach ($config["lang"] as $key => $value) {?>
	f.keyword_<?=$value?>.value = ten_<?=$value?>.toLowerCase() + ", " + StripVi(name).toLowerCase();
	<?php }?>

	<?php foreach ($config["lang"] as $key => $value) {?>
	f.description_<?=$value?>.value = f.mota_<?=$value?>.value;
	<?php }?>

	

	<?php foreach ($config["lang"] as $key => $value) {?>
	f.deschar_<?=$value?>.value = f.mota_<?=$value?>.value.length;
	<?php }?>
	
	
	//f.des_en_char.value = f.short_en.value.length;
}

function CreateTitleSEOWidthTag(){
	var f = document.getElementById("validate");
	<?php foreach ($config["lang"] as $key => $value) {?>
	ten_<?=$value?> = f.ten_<?=$value?>.value;
	<?php }?>
	

	
	<?php foreach ($config["lang"] as $key => $value) {?>
	f.h1_<?=$value?>.value = ten_<?=$value?>;
	<?php }?>
	
	<?php foreach ($config["lang"] as $key => $value) {?>
	f.h2_<?=$value?>.value = ten_<?=$value?>;
	<?php }?>
	
	
	<?php foreach ($config["lang"] as $key => $value) {?>
	f.h3_<?=$value?>.value = ten_<?=$value?>;
	<?php }?>
	
	
	<?php foreach ($config["lang"] as $key => $value) {?>
	f.h4_<?=$value?>.value = ten_<?=$value?>;
	<?php }?>
	
	
	<?php foreach ($config["lang"] as $key => $value) {?>
	f.h5_<?=$value?>.value = ten_<?=$value?>;
	<?php }?>
	
	
	<?php foreach ($config["lang"] as $key => $value) {?>
	f.h6_<?=$value?>.value = ten_<?=$value?>;
	<?php }?>

	
	<?php foreach ($config["lang"] as $key => $value) {?>
	f.title_<?=$value?>.value = ten_<?=$value?>;
	<?php }?>
	

	
	<?php foreach ($config["lang"] as $key => $value) {?>
	f.alt_<?=$value?>.value = ten_<?=$value?>;
	<?php }?>
	

	

	
	if (f.tags.value)
		f.keyword_vn.value = f.keyword_vi.value = f.tags.value;
		
	else
	{
		f.keyword_vn.value = name.toLowerCase() + ", " + StripVi(name).toLowerCase();
		//f.keyword_en.value = name_en.toLowerCase();
	}
	
	
	if (f.tags.value)
		f.keyword_en.value = f.keyword_en.value = f.tags.value;
		
	else
	{
		f.keyword_en.value = name.toLowerCase() + ", " + StripVi(name).toLowerCase();
		//f.keyword_en.value = name_en.toLowerCase();
	}
	
	
	if (f.tags.value)
		f.keyword_cn.value = f.keyword_cn.value = f.tags.value;
		
	else
	{
		f.keyword_cn.value = name.toLowerCase() + ", " + StripVi(name).toLowerCase();
		//f.keyword_en.value = name_en.toLowerCase();
	}
	
	
	if (f.tags.value)
		f.keyword_ge.value = f.keyword_ge.value = f.tags.value;
		
	else
	{
		f.keyword_ge.value = name.toLowerCase() + ", " + StripVi(name).toLowerCase();
		//f.keyword_en.value = name_en.toLowerCase();
	}
	
	<?php foreach ($config["lang"] as $key => $value) {?>
	
	f.des_<?=$value?>.value = f.short_<?=$value?>.value;
	
	<?php }?>
	
	<?php foreach ($config["lang"] as $key => $value) {?>
	f.unique_key_<?=$value?>.value = StripVi2(f.name.value).toLowerCase();
	<?php }?>
	
	
	<?php foreach ($config["lang"] as $key => $value) {?>
	f.des_<?=$value?>_char.value = f.short_<?=$value?>.value.length;
	<?php }?>
	

}

</script>


<!-- MultiUpload -->
<link href="js/plugins/multiupload/css/jquery.filer.css" type="text/css" rel="stylesheet" />
<link href="js/plugins/multiupload/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/plugins/multiupload/jquery.filer.min.js"></script>
<!-- MultiUpload -->

<div id="leftSide">
<?php include _template."left_tpl.php";?>
</div>
<!-- Right side -->
    <div id="rightSide">
        <!-- Top fixed navigation -->
        <div class="topNav">
	        <?php include _template."header_tpl.php"?>
		</div>

<div class="wrapper">
<?php include _template.$template."_tpl.php"?>
</div></div>
    <div class="clear"></div>
</body>
<?php }else{?>
<body class="nobg loginPage">   
<?php include _template.$template."_tpl.php"?>
<!-- Footer line -->
<div id="footer">
	
</div></body>
<?php }?>
</html>
