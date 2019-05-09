  
<div class="main-wrap">

    	
        
      <header  id="header" class="header header-style-2 header-scheme-light" role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
             
          
        <?php include _template."layout/header_noithat.php"; ?>     
                
             
    </header><!--end header-->


    <div class="clear"></div>
	
	<nav class="nav-menu-header">   
    
	<?php include _template."layout/menu_top_noithat.php"; ?> 
			
	</nav><!--end nav-menu-heade--> 

	
	<nav class="nav-menu-header-mobile">   
    
	<?php include _template."layout/menu_mobile.php"; ?> 
			
	</nav><!--end nav-menu-mobile--> 

      

	<?php if ($_GET["com"]=="de-vuong") {?>
	  
   	<div class="bg_bottom_header"><img src="images/bg_top_header.png"></div>
	
	
   <main class="main-wrap-bg">


    <div class="slider-container slider-container-2">

        <?php include _template."layout/slide_noithat.php"; ?>     

    </div><!--end slider-container-->    
	<div class="bg_bottom_header"><img src="images/bg_bottom_header.png"></div>

	<?php }?>
	

    <div class="content-wrap container-fluid">
	
		<div class="row pd0 mg0">
		
		
		<div class="clear"></div>
		
		<?php if ( ($_GET["com"]=="de-vuong" && $template!="product_detail" ) && $_GET["idl"]=="" ) {?>
			
			<?php include _template."layout/info_noithat_index.php"; ?> 

	
			<?php } else {?>


       <div  class="col_main container <?php if(isset($_GET['com']) and $_GET['com']!='index' ) {?> center_full <?php }?> " <?php if(!isset($_GET['com']) || $_GET['com']=='index'  ) echo ' style="width:100%;padding-top: 0px;margin-top: 0px;background: none; "'; ?>>
                       
          
		  <?php include _template.$template."_tpl.php"; ?>  
                    
                    <div class="clear"></div>
    
        </div><!--col_main--> 

		<?php }?>

		</div>	
		
        

    </div><!--end content-wrap-->


	
	   <div class="clear"></div>
		<?php if ($_GET["com"]=="" || $_GET["com"]=="index") {?>


			<?php //include _template."layout/news_video.php"; ?> 

		<?php }?>	

     


 <div class="footer-instagram clearfix">
     
     <?php include _template."layout/footer.php"; ?>        
    
 </div><!--end footer-instagram-->
                    

   </main> <!--end main-wrap-bg-->                    
     
 </div><!--end main-wrap-->
