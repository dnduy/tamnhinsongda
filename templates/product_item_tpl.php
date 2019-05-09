<?php

	 $d->reset();
     $sql = "select id,ten_$lang as ten, tenkhongdau_$lang as tenkhongdau from #_product_list where hienthi=1 and com='".$com_type."' order by id desc";
     $d->query($sql);
     $pro_list = $d->result_array();

?>

<div id="main_content_web">
			
			
			<ul class="breadcrumb">
			
				<?php if ($_GET["com"]!="de-vuong" && $_GET["com"]!="thiet-bi" && $_GET["com"]!="bo-suu-tap" && $_GET["com"]!="hoat-dong-san-xuat" && $_GET["com"]!="du-an-de-vuong" && $_GET["com"]!="san-pham-de-vuong") {?>
				<div class="container_breadcrumb">
				<?php }?>	
				<li><a href="" class="transitionAll"><?=_trangchu?></a> </li>
				
				
				<li><a  class="transitionAll"><?=$title_tcat?></a></li>
				
				
				<?php if (count($pro_list)>0) {?>
					<div class="catalog_pro">

						<ul>
						
						<li><a href="<?=$com?>.html"><?=_danhmucsanpham?></a>
						
							<ul>
							
							<?php foreach ($pro_list as $i =>$v_list) {?>
								<li><a href="<?=$com?>/<?=$v_list["tenkhongdau"]?>/"><?=$v_list["ten"]?></a></li>
							<?php }?>
							
							</ul>
						
						</li>
						
						</ul>

					</div><!--end catalog_pro-->

					<?php }?>
				<div class="clear"></div>
				
		<?php if ($_GET["com"]!="de-vuong" && $_GET["com"]!="thiet-bi" && $_GET["com"]!="bo-suu-tap" && $_GET["com"]!="hoat-dong-san-xuat" && $_GET["com"]!="du-an-de-vuong" && $_GET["com"]!="san-pham-de-vuong") {?>
				</div><!--end container_breadcrumb-->	
		<?php }?>
				
			</ul><!--end breadcrumb-->
			
			<div class="clear"></div>
			
		

		<div class="container">			
			
			<div class="block_content">
				
				<div class="rowmin row pd0 mg0">
					
					
					<div class="clear"></div>
					
					<div class="show-pro">
						
						
						
						<div class="product-group ">
							
							
							<?php
								if(count($product)>0){
									$com_href=$com;	 
									
									foreach ($product as $i => $v_sp) {?>
									
									
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 pdmin mg0 des320">
										
										<div class="product-item" >
											
											<div class="portfolio-item">
											
											<div class="product-image">
												
												<a href="<?=$com_href?>/<?=$v_sp["tenkhongdau_$lang"]?>-<?=$v_sp["id"]?>.html" title="<?=$v_sp["ten_$lang"]?>">
													<img  effect="mono" inverse="true" class="img-responsive has-tt colorup colorUpped" src="thumb/380x380/1/<?php if($v_sp['photo']!=NULL) echo _upload_product_l.$v_sp['photo']; else echo 'images/no-image-available.png';?>" alt="<?=$v_sp["alt_$lang"]?>" />
												</a>
												
											</div><!--end product-image-->
											
											
											<div class="product-info portfolio-item-overlay">
												
												<div class="product-name">
													
													<h3> <a href="<?=$com_href?>/<?=$v_sp["tenkhongdau_$lang"]?>-<?=$v_sp["id"]?>.html" title="<?=$v_sp["ten_$lang"]?>"><?=catchuoi($v_sp["ten_$lang"],100)?></a></h3>
										
												</div><!--end product-name-->  
												
												<div class="clear"></div>	
												
											</div><!--end product-info-->	
											
											<div class="clear"></div>
											
											 </div><!--end portfolio-item-->	
											
										</div> <!-- product-item -->
										
									</div>
									
									
									
								<?php } }else echo '<p class="notice">'._noidungdangcapnhat.'</p>';  ?>    
								<div class="clear"></div>                                 
								
								<div class="wrap_paging">
									<div class="paging paging_ajax clearfix"><?=pagesListLimit_layout($url_link , $totalRows , $pageSize, $offset)?></div>
								</div><!--end wrap_paging-->     
								
								
								
								<div class="clear"></div>
								
								
								
								
						</div><!--end show-pro-->
						
					</div><!--end product-group-->
					
					
					
					
				</div>
				
				
				
			</div><!--end block_content-->
			
		</div><!--end block_content-->	
			
		</div><!--end main_content_web-->
		