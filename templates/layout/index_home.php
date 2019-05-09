    
    <div class="main-wrap">

    	
	   <main class="main-wrap-bg"> <!--end main-wrap-bg-->  
	   
	   
			<div class="main-catalog main-catalog-index container ">
			
			
							
				<div class="info_company_web">
				
					<div class="logo_home"><a href=""><img src="<?=_upload_hinhanh_l.$logo_home["banner"]?>"></a></div>

					
					<?php if ($deviceType!="phone") {?>
					<div class="des_address">
					
						<?=$footer_nd["noidung"]?>
					
					</div>	
					
					
					<div class="social_home">
					
						<ul>
						<?php foreach ($mangxahoi_home as $i =>$v) {?>
							<li><a href="<?=$v["link"]?>" target="_blank"><img src="<?=_upload_hinhanh_l.$v["photo"]?>"></a></li>
						<?php }?>
						</ul>
					
					</div><!--end social_home-->
					
					<?php }?>
					
					<div class="lang_home col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<ul>
						
							<li>
								<a href="langs/vi.htm" title="VI">
									<img src="images/vi.jpg" alt="VI">
								</a>
							</li>
							
							<li>
							<a href="langs/en.htm" title="EN">
								<img src="images/en.jpg" alt="EN">
							</a>
							</li>
						
						</ul>
					</div><!--end lang_desktop-->
					
				
				</div><!--end info_address_web-->
			
			
				<ul class="list_catalog_web">
				
				<?php foreach ($image_GD as $i =>$v) {?>
					<li class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pdmin5 <?php if ($deviceType!="phone") {?> image_GD_<?=$i?> <?php }?>">
					
					
					<a class="img_catalog" href="<?=$v["link"]?>" ><img src="thumb/625x360/1/<?=_upload_hinhanh_l.$v["photo"]?>"></a>
					
					<a class="name_catalog name_catalog_<?=$i?>" href="<?=$v["link"]?>" ><?=$v["ten"]?></a>
					
					</li>
				<?php }?>
				
				<div class="clear"></div>
				
				</ul><!--end list_catalog_web-->
				
				
			<?php if ($deviceType=="phone") {?>
	
				<div class="footer_home">
					
					<div class="des_address">
						<?=$footer_nd["noidung"]?>
					</div>	
					
					
					<div class="social_home">
					
						<ul>
						<?php foreach ($mangxahoi_home as $i =>$v) {?>
							<li><a href="<?=$v["link"]?>" target="_blank"><img src="<?=_upload_hinhanh_l.$v["photo"]?>"></a></li>
						<?php }?>
						</ul>
					
					</div><!--end social_home-->
					
				</div><!--end footer_home-->	
					
					
					<?php }?>
			
			
			</div><!--end main-catalog-->


		</main> <!--end main-wrap-bg-->                    
     
 </div><!--end main-wrap-->
