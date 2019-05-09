<div class="main-member">
        <h2 class="pbs ui-borderBottom"><?=_quanlytaikhoan?></h2>
        <p class="mtm strong"><?=_xinchao?> <?=$_SESSION["login_member"]["hoten"]?>  </p>
        <p class="mbm mts"><?=_noteqlytk?></p>
        
        <div class="line">
            
            <div class="frame-info">
                
                <div class="box-myaccount">
                    <h4 class="ui-borderBottom pbs fsml"><?=_diachilienhe?></h4>
                    <p class="ptm">
                        <?=$_SESSION["login_member"]["hoten"]?> <br>
                        <?=$_SESSION["login_member"]["email"]?>  - <a href="http://<?=$config_url?>/trang-ca-nhan/change-email/member" class="sel-link-change-email"><?=_thaydoidiachiemail?></a><br>
                    </p>
                    
                    <p class="mtm">
             <a href="http://<?=$config_url?>/trang-ca-nhan/doi-mat-khau/member" class="sel-link-change-pass"><?=_changpass?></a>
                    </p>
            <a class="rfloat sel-link-edit-contact" href="http://<?=$config_url?>/trang-ca-nhan/thong-tin-ca-nhan/member"><?=_chinhsua?></a>
                </div><!--end box-myaccount-->
                
            </div><!--end frame-info-->
           
            <div class="frame-info" style="float:right; margin-right:0;">
                <div class="box-myaccount" id="newsletter-section">
                    <h4 class="ui-borderBottom pbs fsml"><?=_bantin?></h4>
                    <p class="ptm"><?=_notebantin?></p>
                    <a class="rfloat" href="http://<?=$config_url?>/trang-ca-nhan/newsletter/member"><?=_chinhsua?></a>
                </div>
            </div><!--end frame-info-->
            
         <div class="clear"></div>   
            
        </div><!--end line-->
		
		<?php /*?>

        <div class="box-info-address mtl">
            <div class="l-row ui-borderBottom pbs">
                <h3 class="l-cell ptm"><?=_sodiachi?></h3>
                <a href="http://<?=$config_url?>/trang-ca-nhan/so-dia-chi/member" class="rfloat sel-link-my-addresses"><?=_quanlydiachi?></a>
                <div class="clear"></div>
                
            </div>
        </div>

		
		
        <div class="line mbl">
            
            
           <div class="frame-info">
                
                <div class="box-myaccount">
                    <h4 class="ui-borderBottom pbs fsml"><?=_addresspaydefault?></h4>
                  
                    <p class="mtm">
                    <?php if ($item_user["tinh"]!="" and $item_user["huyen"]!="" and $item_user["diachi"]!="" ) {?>
                       <div class="address">
                                <p><?=$item_user["hotenkh"]?> <br><?=$item_user['diachi']?><br>
                                 <span id="citycode_1072475">
                                <?=getNameTinhthanh($item_user['tinh'],$lang)?> - <?=getNameQuanhuyen($item_user['huyen'],$lang)?> - <?=getNamePhuongxa($item_user['phuongxa'],$lang)?>
                                 
                                 </span><br>
                                 </p>
                                <p class="mbs"><?=$item_user["dienthoai"]?><br> </p>
                       </div><!--end address-->
                       
        <a class="mts rfloat" href="http://<?=$config_url?>/trang-ca-nhan/sua-dia-chi-member/<?=$item_user["id"]?>"><?=_suadiachi?></a>      
                       
                   <?php } else {?>
                   
                   <?=_addresspaykhongtontai?>
                   
                   <?php }?>    
                       
                    </p>
          
            
             <div class="clear"></div>
            
                </div><!--end box-myaccount-->
                
            </div><!--end frame-info--> 
            
           
            
            <div class="frame-info" style="float:right; margin-right:0;">
                
                <div class="box-myaccount" id="newsletter-section">
                    
                   <h4 class="ui-borderBottom pbs fsml"><?=_addressdeliverydefault?></h4>
                    
                     <p class="mtm">
                     
                     <?php if ($item_user["tinh"]!="" and $item_user["huyen"]!="" and $item_user["diachi"]!="" ) {?>
                       <div class="address">
                                <p><?=$item_user["hotenkh"]?> <br><?=$item_user['diachi']?><br>
                                 <span id="citycode_1072475">
                              <?=getNameTinhthanh($item_user['tinh'],$lang)?> - <?=getNameQuanhuyen($item_user['huyen'],$lang)?> - <?=getNamePhuongxa($item_user['phuongxa'],$lang)?>
                                 
                                 </span><br>
                                 </p>
                                <p class="mbs"><?=$item_user["dienthoai"]?><br> </p>
                                
                                
                       </div><!--end address-->
                       
                 <a class="mts rfloat" href="http://<?=$config_url?>/trang-ca-nhan/sua-dia-chi-member/<?=$item_user["id"]?>"><?=_suadiachi?></a>
                       
                   <?php } else {?>
                   
                   <?=_addressdeliverykhongtontai?>
                   
                   <?php }?>    
                    
                     
                     
                    </p><!--end mtm-->
                    
           
            
            <div class="clear"></div>
                    
                </div><!--end box-myaccount-->
                
            </div><!--end frame-info-->
            
            
            
        </div><!--end mtm-->
        
		<?php */?>
    </div><!--END l-main-->