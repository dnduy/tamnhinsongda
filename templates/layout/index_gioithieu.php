    
    <div class="main-wrap">

    	
        
      <header  id="header" class="header header-style-2 header-scheme-light" role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
             
          
        <?php include _template."layout/header.php"; ?>     
                
             
    </header><!--end header-->


    <div class="clear"></div>
	
	

	
	<nav class="nav-menu-header-mobile">   
    
	<?php include _template."layout/menu_mobile.php"; ?> 
			
	</nav><!--end nav-menu-mobile--> 

          
   
   <main class="main-wrap-bg">

    <?php if ($_GET["com"]=="" || $_GET["com"]=="index") {?>

     <div class="slider-container slider-container-2">

        <?php include _template."layout/slide_show.php"; ?>     

    </div><!--end slider-container-->    

    <?php }?>






    <div class="content-wrap container-fluid">
	
		<div class="row pd0 mg0">
		
				  
		   <div  class="col_main ">
						   
			  
			   <?php include _template.$template."_tpl.php"; ?>       

						
			   <div class="clear"></div>
		
			</div><!--col_main--> 
			
			

		</div>	
		
        

    </div><!--end content-wrap-->


	
	   <div class="clear"></div>
		<?php if ($_GET["com"]=="" || $_GET["com"]=="index") {?>


			<?php //include _template."layout/news_video.php"; ?> 

		<?php }?>	

     
     <?php include _template."layout/doitac.php"; ?>        


 <div class="footer-instagram clearfix">
     
     <?php include _template."layout/footer.php"; ?>        
    
 </div><!--end footer-instagram-->
                    

   </main> <!--end main-wrap-bg-->                    
     
 </div><!--end main-wrap-->
