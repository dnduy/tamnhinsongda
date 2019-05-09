<?php

error_reporting(0);
session_start();
$session = session_id();

@define('_template', '../templates/');


@define('_source', '../sources/');
@define('_lib', '../libraries/');
@define(_upload_folder, '../media/upload/');


include_once _lib . "config.php";

//Lưu ngôn ngữ chọn vào $_SESSION
$lang_arr = array("vi", "en", "cn", "ge");
if (isset($_GET['lang']) == true) {
    if (in_array($_GET['lang'], $lang_arr) == true) {
        $lang = $_GET['lang'];
        $_SESSION['lang'] = $lang;
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
if (isset($_SESSION['lang'])) {
    $lang = $_SESSION['lang'];
} else {

    $lang = $config["lang_default"];
}

require_once _source . "lang_$lang.php";

include_once _lib . "constant.php";
include_once _lib . "functions.php";
include_once _lib . "functions_giohang.php";
include_once _lib . "library.php";
include_once _lib . "class.database.php";
include_once _lib . "file_requick.php";
include_once _source . "counter.php";
include_once _source . "useronline.php";

$d = new database($config['database']);

?>



       <a href="#" class="dropdown-toggle shopcart-status load-cart-status active" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="shopcart-icon shopcart-full"></i>
                            <span class="fix-shopcart-span">&nbsp;(<?=get_total_qty()?>)</span>
                        </a>
                        <span class="ssIcon arrow-sub-icon fix-arrow-sub-icon"></span>
                       
					   
	<div class="dropdown-menu dropdown-cart-shop">
    <div class="cart-info">
        <div class="cart-content">
             <h4><?=_giohang?></h4>
			 
		
		<div class="box-cart-position">
		
		<div id="cart-content" class="nano has-scrollbar">
                
				<div class="nano-content" tabindex="0">

                     <table class="table-cart">
                        <tbody>
							
			<?php  if(is_array($_SESSION['cart'])){
				
			
				$max=count($_SESSION['cart']);
				for($i=0;$i<$max;$i++){
					$pid=$_SESSION['cart'][$i]['productid'];
					$q=$_SESSION['cart'][$i]['qty'];	
					$size=$_SESSION['cart'][$i]['size'];
					$color=$_SESSION['cart'][$i]['color'];	
					
					$pname=get_product_name($pid,$lang);
					$sizename=get_size_name($size,$lang);
					$colorname=get_color_name($color,$lang);
					$pimg=get_product_img($pid);
					if($q==0) continue;			
				
				
			?>	
			
<script type="text/javascript">

  $(document).ready(function() {
	    
	  
	  $(".box-cart-position-load").click(function () {

		  
		  $(".box-cart-position-load").addClass("open_jav");
		  
	  })
	  
      $('.btn-remove-cart-ajax<?=$i?>').click(function(e) { 
          
		  
		
  
        var pid=0;
       
        pid =$(".btn-remove-cart-ajax<?=$i?>").data("id");
		

                
            $.ajax({
              type: "POST",
              url: "ajax/ajax_remove_cart.php", 
              dataType:'text',
              data: {pid:pid},
              success: function(string){
                   $('.box-cart-position-load').addClass("open");
				    $('#notice_cart').html('<?=_bandaxoathanhcong?>');
                      $('#notice_cart').fadeIn().delay(2500).fadeOut();
					  load_cart();
                }          
              });
     

      });//end click

  });
  
  function load_cart(){
	
	
	//alert ("Bạn đã thêm vào giỏ hàng thành công !")
	$(".box-cart-position-load").load("ajax/update_boxcart.php", function(){
																 
																 
		//$('.dropdown-cart-shop').css('display','block');
		
		$(".box-cart-position").css({visibility: "visible",display: "none"}).slideDown('fast'); 
	});
	

}

</script>  
				
			
					<tr>
						<td class="cart-product-info">
							<a href="javascript:void(0);">
								<img src="thumb/60x85/1/<?=_upload_product_l.$pimg?>" alt="<?=$pname?>" ></a>
								
									<div class="cart-product-desc">
										<p><a class="invarseColor" ><?=$pname?></a>
										
										<a href="javascript:void(0);" data-id="<?=$pid?>" class="btn btn-mini btn-remove-cart-ajax<?=$i?> remove-pro"><i class="glyphicon glyphicon-remove"></i></a>
										<b class="clear"></b>
										</p>
										
										<ul class="unstyled">
											<?php if (isset($size)) {?>
											<li class="fix-li"><span>Size:</span>
												<select class="sl-input" disabled="">
													<option  selected=""><?=$sizename?></option>
												</select>
											</li>
											<?php }?>
											
											<?php if (isset($color)) {?>
											<li class="fix-li"><span>Color:</span>
												<select class="sl-input" disabled="">
													<option  selected=""><?=$colorname?></option>
												</select>
											</li>
											<?php }?>
											
											<li><span><?=_soluong?>:</span>
												<select class="sl-input"  data-key="">
													<option value="<?=$q?>" selected=""><?=$q?></option>
												</select>
											</li>
										</ul>
									</div>
									
								<div class="cart-product-setting">		
									<p class="price-cart"><strong>x <?=number_format((get_price($pid)*$q)-($q*get_price($pid)*get_price_km($pid)),0, ',', '.') ?>&nbsp;₫</strong></p>
									
									<div class="clear"></div>
								</div><!--end cart-product-setting-->	
									
								</td>
							
							
						</tr>
                       

			<?php } } else {?>
			
			<tr id="cart-empty-tr" >
                <td class="txt-center"><?php	echo ""._emptycart."";?></td>
            </tr>

			<?php }?>	
						
						
					 
						
						
                        </tbody>
						
                    </table><!--end table-cart-->
					
                </div><!--end nano-content-->
				
      
									
			</div><!--end cart-content-->
                
			<?php  if(isset($_SESSION['cart'])){?>
			<table class="table-cart">
                <tfoot>
                   <tr>
						<td class="cart-product-info">
                           <a href="gio-hang.html" title="<?=_xemgiohang?>" class="btn btn-primary btn-sm"><?=_xemgiohang?></a>
                           <a href="thanh-toan.html" title="<?=_thanhtoan?>" class="btn btn-warning btn-custom-checkout btn-sm"><?=_thanhtoan?></a>
                        </td>
                        
						<td class="total-money">
                            <h5><span id="cart-total-money"><?=number_format(get_order_total(),0, ',', '.')?></span>&nbsp;₫</h5>
                        </td>
                    </tr>
                </tfoot>
           </table><!--end table-cart-->
			<?php }?>
				

		</div><!--end box-cart-position-->	
                
			
        </div><!--end cart-content-->
    </div><!--end cart-info-->

</div><!--end dropdown-menu-->