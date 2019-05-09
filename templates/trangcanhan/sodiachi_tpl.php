<script type="text/javascript" src="js/jquery.msgBox/js/jquery.msgBox.js"></script>
<link rel="stylesheet" type="text/css" href="js/jquery.msgBox/css/msgBoxLight.css"/>

<script type="text/javascript">
function location_delete(id)
{ 
	$.msgBox({
			title : "<?=_xoadiachi?>",
			content : "<?=_cochacxoadiachi?> <?=$_SESSION["login_member"]["hoten"]?>",
			type : "alert",
			buttons : [{
				value : "<?=_yes?>"
			}, {
				value : "<?=_no?>"
			}],
			
			success : function(result) {
				if (result == "<?=_yes?>") {
					$(".location_delete" + id).hide(300);
				
					$.ajax({
						type : "POST",
						url : "ajax/delete_address.php",
						data : "ac=del&id=" + id,
						success : function(msg) {
							
						},
						error : function(msg) {
							
						}
					});
				}
			}
		});
		
}
var viewalert = false;
var maxalert = 0;
var curentalert = 0;
var listalert = new Array();
function viewalertxx() {
	if (curentalert < maxalert) {
		$.msgBox({
			title : "<?=_thongbao?> !",
			content : listalert[curentalert],
			buttons : [{
				value : "OK"
			}],
			success : function(result) {
				if (result == "OK") {
					curentalert++;
					viewalertxx();

				}
			}
		});

	} else
		viewalert = false;
}

</script>

<div class="main-member">

	<div class="bg-title-member">
        <h2 class="title-address pbs ui-borderBottom"><?=_sodiachi?></h2>
        
        <div class="create-address">
       <a href="http://<?=$config_url?>/trang-ca-nhan/tao-dia-chi/member" class="ui-button fss sel-my-addresses-button"><?=_addadressnew?></a>
        
        </div><!--end create-address-->
          <div class="clear"></div>
   </div><!--end bg-title-member-->     
        
      
        
        <p class="mtm strong"><?=_xinchao?> <?=$_SESSION["login_member"]["hoten"]?>  </p>
      
        
        
     

        <div class="line mbl">
            
            
           <div class="frame-info">
                
                <div class="box-myaccount">
                    <h4 class="ui-borderBottom pbs fsml"><?=_addressdefault?></h4>
                    
                    <div class="ui-borderBottom">
                            <h4 class="adress-title"><?=_addresspaydefault?></h4>
                            
                            <p class="des-adress ">
							
							 <?php if ($item_user["tinh"]!="" and $item_user["huyen"]!="" and $item_user["diachi"]!="" ) {?>
                             
                             
                             <div class="des-adress">
                                <p><?=$item_user["hotenkh"]?> <br><?=$item_user['diachi']?><br>
                                 <span id="citycode_1072475">
                              <?=getNameTinhthanh($item_user['tinh'],$lang)?> - <?=getNameQuanhuyen($item_user['huyen'],$lang)?> - <?=getNamePhuongxa($item_user['phuongxa'],$lang)?>
                                 
                                 </span><br>
                                 </p>
                                <p class="mbs"><?=$item_user["dienthoai"]?><br> </p>
                       </div><!--end address-->
                       
        <a class="suadiachi-link" href="http://<?=$config_url?>/trang-ca-nhan/sua-dia-chi-member/<?=$item_user["id"]?>"><?=_suadiachi?></a>      
                       
         					
                            
                            <?php } else {?>
                            
                            <?=_addresspaykhongtontai?>
                            
                            <?php }?>
                            
                            </p>
                        </div>
                  
                  
                  
                   <div class="ui-borderBottom" style="    border-bottom: initial !important;">
                            <h4 class="adress-title"><?=_addressdeliverydefault?></h4>
                            <p class="des-adress">
                            
                            
                             <?php if ($item_user["tinh"]!="" and $item_user["huyen"]!="" and $item_user["diachi"]!="" ) {?>
							
                            
                            <div class="des-adress">
                                <p><?=$item_user["hotenkh"]?> <br><?=$item_user['diachi']?><br>
                                 <span id="citycode_<?=$items_address[0]["id"]?>">
                            <?=getNameQuocGia($item_user['quocgia'],$lang)?> - <?=getNameTinhthanh($item_user['tinh'],$lang)?> - <?=getNameQuanhuyen($item_user['huyen'],$lang)?> - <?=getNamePhuongxa($item_user['phuongxa'],$lang)?>
                                 
                                 </span><br>
                                 </p>
                                <p class="mbs"><?=$item_user["dienthoai"]?><br> </p>
                       </div><!--end address-->
                       
                            
                            <?php } else {?>
                            
                            <?=_noaddressdefault?>
                             <a href="http://<?=$config_url?>/trang-ca-nhan/tao-dia-chi/member" title="" class="add_address_new"><?=_addadressnew?></a>    
                            
                            <?php }?>
                            
                            </p>
                            
                       
                        </div>
                    
            
             <div class="clear"></div>
            
                </div><!--end box-myaccount-->
                
            </div><!--end frame-info--> 
            
           

            <div class="frame-info" style="float:right; margin-right:0;">
                
                <div class="box-myaccount" id="newsletter-section">
                    
                   <h4 class="ui-borderBottom pbs fsml"><?=_addressother?></h4>
                   
                   <?php if (count($items_address)>0) {?>
                    
                      <?php for ($i=0;$i<count($items_address);$i++) {?>
                      
                          <div class="border-bottom-line"  <?php if ($i==0) {?> style="border-top:initial;" <?php }?>></div><!--end border-bottom-line--> 
                           <div class="des-adress location_delete<?=$items_address[$i]["id"]?>">
                                <p><?=$items_address[$i]["hoten"]?> <br>
                                  <?=$items_address[$i]["diachigiaohang"]?><br>
                                    <span id="citycode_<?=$items_address[$i]["id"]?>"><?=getNameQuocGia($items_address[$i]['id_quocgia'],$lang)?>-<?=getNameTinhthanh($items_address[$i]['id_tinh'],$lang)?> - <?=getNameQuanhuyen($items_address[$i]['id_huyen'],$lang)?> - <?=getNamePhuongxa($items_address[$i]['id_phuong'],$lang)?></span><br>
                                </p>
                                <p class="mbs"> <?=$items_address[$i]["dienthoai"]?><br> </p>
                          
                    
            <a class="suadiachi-link" href="http://<?=$config_url?>/trang-ca-nhan/sua-dia-chi/<?=$items_address[$i]["id"]?>"><?=_suadiachi?></a>
            
            <a class="ui-link icon i-remove" onclick="location_delete(<?=$items_address[$i]["id"]?>)"><?=_xoadiachi?> </a>
            
            
            <a class="ui-link icon i-favorite" href=""><?=_seetingpttgiaohangdefault?></a>
            
              </div><!--end address-->
              
        
            
            <?php }?>
            
            
             <div class="clear"></div>
    
    <div class="wrap_paging">
		<div class="paging clearfix"><?=pagesListLimit_layout($url_link , $totalRows , $pageSize, $offset)?></div>
	</div>
            
            
            <?php } else {?>
            
            
              <p class="des-adress">
                     <?=_notechuacodiachi?> <a href="http://<?=$config_url?>/trang-ca-nhan/tao-dia-chi/member" title="<?=_dangkydiachikhac?>"><?=_taiday?></a>
                    </p><!--end mtm-->
                    
            
            
            <?php }?>
            
            <div class="clear"></div>
                    
                </div><!--end box-myaccount-->
                
            </div><!--end frame-info-->
            
            
            
        </div><!--end mtm-->
        
    </div><!--END l-main-->