<?php
	error_reporting(0);
	session_start();
	$session=session_id();
	//@define ( '_template' , './templates/');

	
	@define ( '_source' , './sources/');
	@define ( '_lib' , './libraries/');
	@define ( _upload_folder , './media/upload/' );
	
	include_once _lib."Mobile_Detect.php";
    
    $detect = new Mobile_Detect;
    $deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
   
	@define ( '_template' , './templates/');
	@define ( '_trangcanhan' , './templates/trangcanhan/');

	include_once _lib."config.php";
	
	//Lưu ngôn ngữ chọn vào $_SESSION
	$lang_arr=array("vi","en","cn","ge");
	if (isset($_GET['lang']) == true){
        if (in_array($_GET['lang'], $lang_arr)==true){
            $lang = $_GET['lang'];
            $_SESSION['lang']=$lang;
		  header('Location: '.$_SERVER['HTTP_REFERER']);
        } 
	}
    if(isset($_SESSION['lang'])){
        $lang= $_SESSION['lang'];
    }else{
    	
        $lang=$config["lang_default"];
    }
	
	require_once _source."lang_$lang.php";	
	
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";
	include_once _lib."file_requick.php";
	include_once _source."counter.php";
	include_once _source."useronline.php";
	
	$d = new database($config['database']);
	
	
	if($_REQUEST['command']=='add' && $_REQUEST['productid']>0)
	{
		$pid=$_REQUEST["productid"];
		$q=isset($_GET['quality']) ? ($_GET['quality']) : "1";
		addtocart($pid,$q);
		redirect("http://$config_url/gio-hang.html");
	}	

   

?>


<html lang="en-US" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"><!--<![endif]-->
<head>
<base href="http://<?=$config_url?>/" />
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php if(isset($title_bar)) echo $title_bar; else echo $row_setting["title_$lang"]; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
 <meta name="robots" content="index, follow" />


 	<meta name="author" content="<?=$row_setting["author"]?>">
    <meta name="keywords" content="<?=$row_setting["keywords_$lang"]?>" />
    <meta name="description" content="<?=$row_setting["description_$lang"]?>" />

    <meta http-equiv="Content-Language" content="vi" />
	<meta name="Language" content="vietnamese" />
    
  	<meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?=$title_bar?>" />
    <meta property="og:image" content="<?=$image?>" />
    <meta property="article:publisher" content="<?=$row_setting["fanpage"]?>" />
    <meta property="og:site_name" content="<?=$row_setting["ten_$lang"]?>"/>
    <meta property="og:url" content="<?=$url_web?>" />
    <meta property="og:description" content="<?=$description_web?>" />
    
    <meta itemprop="name" content="<?=$row_setting["title_$lang"]?>">
    <meta property="twitter:title" content="<?=$title_bar?>">
    <meta property="twitter:url" content="<?=$url_web?>">
    <meta property="twitter:card" content="summary"> 



    <?=$row_setting["geo_meta"];?>


    <link rel="canonical" href="<?=getCurrentPageURL();?>" />	

	<link rel="shortcut icon" href="<?=_upload_hinhanh_l.$row_setting["favicon"]?>">


	<?php    if ($_GET["com"]!="de-vuong" && $_GET["com"]!="thiet-bi" && $_GET["com"]!="bo-suu-tap" && $_GET["com"]!="hoat-dong-san-xuat" && $_GET["com"]!="du-an-de-vuong" && $_GET["com"]!="san-pham-de-vuong") {?>
     <?php include _template."layout/style_web.php"; ?>
	 
	<?php } else {?>
			<?php include _template."layout/style_noithat.php"; ?>
	<?php }?>

	       <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css " />
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.styles.css" />

	<link rel='stylesheet' id='font-awesome-css'  href='fonts/font-awesome/css/font-awesome.min.css?ver=4.0.3' type='text/css' media='all' /> 
	   

	<script type="text/javascript" src="js/jquery-1.9.1.js" ></script>

	<script type="text/javascript" src="bootstrap/js/bootstrap.js "></script>
	
		<script type="text/javascript" src="js/jquery.validate.min.js"></script>
	
	<script src="js/jquery-ui.js"></script>
	
	<script type="text/javascript" src="js/jquery.jmNotify.js"></script>
	
	<script src="js/jquery.scrollToTop.js"></script>
	<script defer src="js/jquery.flexslider.js"></script>

	<script type="text/javascript" src="js/my_srcipt_gaconit91_full.js" ></script>  
	
	<?php /*?>
	<script type="text/javascript" src="js/jquery.hoverIntent.minified.js"></script>
	<script type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="js/jquery.cycle.all.js"></script>
	<script type="text/javascript" language="javascript">
	    $(document).ready(function(){
	        
	        $('.accordion-2').dcAccordion({
	            eventType: 'hover',
	            autoClose: false,
	            menuClose   : true,   
	            classExpand : 'dcjq-current-parent',
	            saveState: false,
	            disableLink: false,
	            showCount: false,
	            hoverDelay   : 50,
	            speed: 'slow'
	        });
	        $('.fade').cycle();
	    });
	</script>
	<?php */?>
	
		<link type="text/css" rel="stylesheet" href="http://<?=$config_url?>/css/jquery.mmenu.all.css" />
		<script type="text/javascript" src="http://<?=$config_url?>/js/jquery.mmenu.min.all.js"></script>
		
		<script src="http://<?=$config_url?>/js/script_menu.js"></script>
<link rel="stylesheet" type="text/css" href="js/slick/slick.css">
  <link rel="stylesheet" type="text/css" href="js/slick/slick-theme.css">
  <script src="js/slick/slick.js" type="text/javascript" charset="utf-8"></script>

    <script type="text/javascript"
src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDIcgayYKPPDnRhRPUdgsCi63XC3-VB12k">
</script>
	

 	<?=$row_setting["code_analytics"];?>



    <h1 style="display:none;"><?=$row_setting["h1_$lang"];?></h1>
    <h2 style="display:none;"><?=$row_setting["h2_$lang"];?></h2>
	<h3 style="display:none;"><?=$row_setting["h3_$lang"];?></h3>
	<h4 style="display:none;"><?=$row_setting["h4_$lang"];?></h4>
	<h5 style="display:none;"><?=$row_setting["h5_$lang"];?></h5>
	<h6 style="display:none;"><?=$row_setting["h6_$lang"];?></h6>
	
    
</head>    

<style type="text/css">
<?php

 if ($_GET["com"]=="de-vuong" || $_GET["com"]=="thiet-bi" || $_GET["com"]=="bo-suu-tap" || $_GET["com"]=="hoat-dong-san-xuat" || $_GET["com"]=="du-an-de-vuong" || $_GET["com"]=="san-pham-de-vuong") {
	 $bg_web="bg_web_nt";
 } else 
 {
	 $bg_web="bg_web";
 }
 



      $d->reset();      
      $sql_mau = "select * from #_background where com='".$bg_web."' ";      
      $d->query($sql_mau);      
      $bg_header_option = $d->fetch_array();
      $bg="";
      if($bg_header_option['chonbg']==1)
        $bg.=" url("._upload_background_l.$bg_header_option['photo'].")";
        
      if($bg_header_option['repeat1']==0)
        $bg.=" repeat";
      else if($bg_header_option['repeat1']==1)
        $bg.=" repeat-x";
      else if($bg_header_option['repeat1']==2)
        $bg.=" repeat-y";
      else if($bg_header_option['repeat1']==3)
        $bg.=" no-repeat";
      
      if($bg_header_option['vitri']==1)
        $bg.=" top";
      else if($bg_header_option['vitri']==2)
        $bg.=" right";
      else if($bg_header_option['vitri']==3)
        $bg.=" bottom";
      else if($bg_header_option['vitri']==4)
        $bg.=" left";
      else if($bg_header_option['vitri']==5)
        $bg.=" center";
      
      if($bg_header_option['vitri1']==1)
        $bg.=" top";
      else if($bg_header_option['vitri1']==2)
        $bg.=" right";
      else if($bg_header_option['vitri1']==3)
        $bg.=" bottom";
      else if($bg_header_option['vitri1']==4)
        $bg.=" left";
      else if($bg_header_option['vitri1']==5)
        $bg.=" center";
      
      if($bg_header_option['fixed']==1)
        $bg.=" fixed";


    ?>

    <?php ?>
		body{
			background:<?=$bg_header_option['nenbackground'],$bg?>;
		}
		<?php ?>
	</style>	

<body <?php if ($_GET["com"]=="lien-he") {?> onLoad="initialize_contact(),initialize_footer();" <?php } else {?> onload="" <?php }?>>

<div class="alert-container"></div>

<div class="customNotify"></div>

	<script language="javascript">
      function addtocart(pid){
        document.form1.productid.value=pid;
        document.form1.command.value='add';
        document.form1.submit();
        return false;       
      }
    </script>
        <form name="form1" action="index.php">
            <input type="hidden" name="productid" />
            <input type="hidden" name="command" />
        </form>

    <div id="container_NNT">  
	
	
	<?php if ($_GET["com"]=="" || $_GET["com"]=="index" || $source=="index") {?>
	
		
		<?php include _template."layout/index_home.php"; ?> 
	
	
	<?php } else  if ($_GET["com"]=="gioi-thieu") {?>
	
		<?php include _template."layout/index_gioithieu.php"; ?> 
	
	<?php } else  if ($_GET["com"]=="noi-that") {?>
	
		<?php include _template."layout/index_duan.php"; ?> 
	
	<?php } else  if ($_GET["com"]=="kien-truc") {?>
	
			<?php include _template."layout/index_kientruc.php"; ?> 
	
	<?php } else  if ($_GET["com"]=="de-vuong" || $_GET["com"]=="thiet-bi" || $_GET["com"]=="bo-suu-tap" || $_GET["com"]=="hoat-dong-san-xuat" || $_GET["com"]=="du-an-de-vuong" || $_GET["com"]=="san-pham-de-vuong") {?>
	
	<?php include _template."layout/index_noithat.php"; ?> 
	
	<?php } else  {?>
	
	<?php include _template."layout/index_gioithieu.php"; ?> 
	
	<?php }?>
	
	

 </div><!--END container_NNT-->
 
  <?php if ($deviceType=="phone") {?>
<?php include _template."layout/call_sms_map.php"; ?> 
  <?php }?>


<?php include _template."layout/back-top.php"; ?> 

 <?=$row_setting["codechat"];?>
 
    </body>

</html>