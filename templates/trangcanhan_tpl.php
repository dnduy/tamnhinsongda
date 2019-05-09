<link href="css/style_member_trangcanhan.css" type="text/css" rel="stylesheet">    
<div class="member-col-content">

	
<div id="nav-head">
	<div class="wikis">
		<div class="nav-link" style="margin-top: 0px;">
			<span class="head-link"><a href="<?=$com?>"><?=_trangchu?></a></span>
			<span class="arrow-2"></span>
          
		 
    <span class="link-cur"><?=_trangthanhvien?></span>
     <span class="arrow-2"></span>
        



        <?php if ($trangcanhan=="quanlytaikhoan") {?>   

		<span class="link-cur"><a><?=_quanlytaikhoan?></a></span>
      
        <?php }?>
        
        <?php if ($trangcanhan=="thongtincanhan") {?>   

		<span class="link-cur"><a><?=_thongtintaikhoan?></a></span>
      
        <?php }?>
        
        
         <?php if ($trangcanhan=="doimatkhau") {?>   

		<span class="link-cur"><a><?=_thaydoimatkhau?></a></span>
      
        <?php }?>
        
        
         <?php if ($trangcanhan=="sodiachi") {?>   

		  <span class="link-cur"><a><?=_sodiachi?></a></span>
      
        <?php }?>
        
        
          <?php if ($trangcanhan=="suadiachi") {?>   

		    <span class="link-cur"><a><?=_suadiachi?></a></span>
      
        <?php }?>
        
        
           <?php if ($trangcanhan=="suadiachimember") {?>   

		<span class="link-cur"><a><?=_suadiachi?></a></span>
      
        <?php }?>
        
        
           <?php if ($trangcanhan=="taodiachi") {?>   

		<span class="link-cur"><a><?=_taodiachi?></a></span>
      
        <?php }?>
        
        
         <?php if ($trangcanhan=="donhangcuatoi") {?>   

		<span class="link-cur"><a><?=_donhangcuatoi?></a></span>
      
        <?php }?>

        <?php if ($trangcanhan=="phuongthucthanhtoan") {?>   

        <span class="link-cur"><a><?=_phuongthucthanhtoan?></a></span>
      
        <?php }?>
        
        
        <?php if ($trangcanhan=="changeemail") {?>   

		<span class="link-cur"><a><?=_thaydoidiachiemail?></a></span>
      
        <?php }?>
        
        
          <?php if ($trangcanhan=="newsletter") {?>   

		<span class="link-cur"><a><?=_bantin?></a></span>
      
        <?php }?>


       

          <?php if ($trangcanhan=="mailcuaban") {?>   

            <!-- <span class="link-cur"><a><?=_mailcuaban?></a></span> -->
      
        <?php }?>
          
         


        
        
        
        <?php if ($trangcanhan=="chitietdonhang") {?>   
            
            <span class="link-cur"><a href="http://<?=$config_url?>/trang-ca-nhan/don-hang-cua-toi/member"><?=_donhangcuatoi?></a></span>
            
            <span class="arrow-2"></span>

		<span class="link-cur"><a><?=_chitietdonhang?></a></span>
      
        <?php }?>
        
        
        
        <?php if ($trangcanhan=="quanlydoitrahang") {?>   

		<span class="link-cur"><a><?=_quanlydoitrahang?></a></span>
      
        <?php }?>

			
		</div>
		<div class="clear"></div>
	</div>
</div>

<div id="wrap-news-detail">

    <div class="wrap-hot wikis">
    
   		
    
    	<div id="column-left-user" class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div id="usercp">
                
                <div class="white-background-new">
                   
                    <div class="box-header">
                        <h3><?=_taikhoancuaban?></h3>
                    </div>
                    
                    
     <div class="row-info-account">

     



                    
                    	<ul>
                        
                     <li <?php if ($trangcanhan=="quanlytaikhoan") {?> class="selected" <?php }?>><a  href='http://<?=$config_url?>/trang-ca-nhan/quan-ly-tai-khoan/member' title="<?=_quanlytaikhoan?>"><?=_quanlytaikhoan?></a></li>   
                     
                     
                         <li <?php if ($trangcanhan=="thongtincanhan") {?> class="selected" <?php }?>><a  href='http://<?=$config_url?>/trang-ca-nhan/thong-tin-ca-nhan/member' title="<?=_thongtintaikhoan?>"><?=_thongtintaikhoan?></a></li>   
                         
                           <?php /*?> <li <?php if ($trangcanhan=="sodiachi" || $trangcanhan=="taodiachi" || $trangcanhan=="suadiachimember") {?> class="selected" <?php }?>><a  href='http://<?=$config_url?>/trang-ca-nhan/so-dia-chi/member' title="<?=_sodiachi?>"><?=_sodiachi?></a></li>    <?php */?>
                            
                            
                <li <?php if ($trangcanhan=="donhangcuatoi" || $trangcanhan=="chitietdonhang") {?> class="selected" <?php }?>><a  href='http://<?=$config_url?>/trang-ca-nhan/don-hang-cua-toi/member' title="<?=_donhangcuatoi?>"><?=_donhangcuatoi?></a>
                
              <?php if ($trangcanhan=="chitietdonhang") {?>  	
                    <ul>
                    
                    <li class="last "><a class="current-submenu"><?=_chitietdonhang?></a></li>
                    
                    </ul>
                <?php }?>
                
                
                </li>                  
                            
                            
                   
                          <li <?php if ($trangcanhan=="quanlydoitrahang") {?> class="selected" <?php }?>><a  href='http://<?=$config_url?>/trang-ca-nhan/quan-ly-doi-tra-hang/member' title="<?=_quanlydoitrahang?>"><?=_quanlydoitrahang?></a></li>
						  
						  
						  
						   <?php if(is_user_hoahong($_SESSION['login_member']['id'])) { ?>
                            <li <?php if ($trangcanhan=="quanlyhoahong") {?> class="selected" <?php }?>><a  href='http://<?=$config_url?>/trang-ca-nhan/tien-hoa-hong/member' title="<?=_quanlytienhoahong?>"><?=_quanlytienhoahong?></a></li>
                            <li <?php if ($trangcanhan=="sharelink") {?> class="selected" <?php }?>><a  href='http://<?=$config_url?>/trang-ca-nhan/share-link/member' title="<?=_sharelinkhoahong?>"><?=_sharelinkhoahong?></a></li>

                          <?php } ?>
                          
                          
                          
                  

                        </ul>
                    
             
                     </div><!--end row-info-account-->
                           
                </div><!--end white-background-new-->
                
                
            </div>
            <div>
                
            </div>
        </div>
        
        
        <div class="right-col col-lg-9 col-md-9 col-sm-12 col-xs-12">
        
        	
            <div class="faq-content">
            
            
            <div class="bor-arround">
            
            
            <?php include _trangcanhan.$trangcanhan."_tpl.php"; ?> 

                <div class="clear"></div>
                
            </div><!--end bor-arround-->
            
            
            </div><!--end faq-content-->
        
        
        </div><!--end right-col-->
        	
	<div class="clear"></div>
    
    </div><!--end wrap-hot wikis-->

	<div class="clear"></div>
	
</div><!--end wrap-news-detail-->

</div><!--end member-col-content-->
