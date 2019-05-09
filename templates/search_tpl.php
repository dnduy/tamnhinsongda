<div id="main_content_web">


<ul class="breadcrumb">

<li><a href="" class="transitionAll"><?=_trangchu?></a> </li>



<li><a  class="transitionAll"><?=$title_tcat?></a></li>


</ul><!--end breadcrumb-->

<div class="clear"></div>

    
    <div class="clear"></div>

    


  <?php if (!empty($product)) {?> 
	
	<div class="main_prouduct_dm">

   <p class="notice" style="text-align:center;"><?=$notice?></p>
 	'<span class="tukhoa"><?=$tukhoa?></span>' &nbsp;  <b class="chonfont"><?=$com_title?></b>

    <div class="product-group">

		<?php
		   if(count($product)>0){
			$com_href="san-pham";	 
			
			foreach ($product as $i => $v_sp) {?>
       
       
	   <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 pd0 mg0 des320">
	   
	   
	   <div class="product-item " >
	
			<div class="product-image">
								  
			<a href="<?=$com_href?>/<?=$v_sp["tenkhongdau_$lang"]?>-<?=$v_sp["id"]?>.html" title="<?=$v_sp["ten_$lang"]?>">
			<img  effect="mono" inverse="true" class="img-responsive has-tt colorup colorUpped" src="thumb/255x190/2/<?php if($v_sp['photo']!=NULL) echo _upload_product_l.$v_sp['photo']; else echo 'images/no-image-available.png';?>" alt="<?=$v_sp["alt_$lang"]?>" />
			</a>

			</div><!--end product-image-->
			
			
			 <div class="product-info">
			
				 <div class="product-name">

					<h3> <a href="<?=$com_href?>/<?=$v_sp["tenkhongdau_$lang"]?>-<?=$v_sp["id"]?>.html" title="<?=$v_sp["ten_$lang"]?>"><?=catchuoi($v_sp["ten_$lang"],100)?></a></h3>
					
					
					<div class="option_price">
					
						<div class="price_default"><?=_gia?>: <?php if(!empty($v_sp['gia'])) echo num_format($v_sp['gia'],$lang).' đ'; else echo _lienhe; ?></div>
					
					<div class="clear"></div>
					
					</div><!--end option_price-->
					
					
				</div><!--end product-name-->  
				
				
				
				<div class="clear"></div>	

			</div><!--end product-info-->	
							   




		<div class="clear"></div>
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

<?php }?>

</div><!--end main_content_web-->