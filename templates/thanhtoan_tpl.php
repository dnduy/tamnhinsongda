<?php 
$d->reset();
$sql="select * from table_news where com='httt' order by stt asc";
$d->query($sql);
$list_httt=$d->result_array();	

 ?>
<script type="text/javascript">
function validEmail(obj) {
	var s = obj.value;
	for (var i=0; i<s.length; i++)
		if (s.charAt(i)==" "){
			return false;
		}
	var elem, elem1;
	elem=s.split("@");
	if (elem.length!=2)	return false;

	if (elem[0].length==0 || elem[1].length==0)return false;

	if (elem[1].indexOf(".")==-1)	return false;

	elem1=elem[1].split(".");
	for (var i=0; i<elem1.length; i++)
		if (elem1[i].length==0)return false;
	return true;
}//Kiem tra dang email
function IsNumeric(sText)
{
	var ValidChars = "0123456789";
	var IsNumber=true;
	var Char;

	for (i = 0; i < sText.length && IsNumber == true; i++) 
	{ 
		Char = sText.charAt(i); 
		if (ValidChars.indexOf(Char) == -1) 
		{
			IsNumber = false;
		}
	}
	return IsNumber;
}//Kiem tra dang so
function check()
		{
			var frm 	= document.frm_order;
			
			if(frm.ten.value=='') 
			{ 
				alert( "<?=_nameError?>" );
				frm.ten.focus();
				return false;
			}
			if(frm.dienthoai.value=='') 
			{ 
				alert( "<?=_phoneError?>" );
				frm.dienthoai.focus();
				return false;
			}
			if(frm.diachi.value=='') 
			{ 
				alert( "<?=_addressError?>" );
				frm.diachi.focus();
				return false;
			}
			
			if(frm.email.value=='') 
			{ 
				alert( "<?=_emailError?>" );
				frm.email.focus();
				return false;
			}
			if(!validEmail(frm.email)){
				alert('<?=_emailError1?>');
				frm.email.focus();
				return false;
			}												
			frm.submit();		
		}	
</script>
<script language='javascript'>
  function isNumberKey(evt)
 {
 var charCode = (evt.which) ? evt.which : event.keyCode
 if (charCode > 31 && (charCode < 48 || charCode > 57))
 return false;
 return true;
 }
 
</script>

<script type="text/javascript">
$(document).ready(function(e) {
    $('.grid').click(function(e) {
		var $bien = $(this).find('.content-expand');
		if ($bien.is(':visible')){
			
		} else {
			$('.content-expand').slideUp();
			$('.button-control').slideUp();
			$('.button-control').css({display:'block'})
			$(this).find('.content-expand').slideDown(500);
			$(this).find('.radio-lv1').prop('checked',true);	
		}
    });
	
	$('.listBank li').click(function(e) {
		$(this).find('input').prop('checked',true);	
		$(this).parent().parent().find('.button-control').slideDown();
		
    });
	$('.button-control').click(function(e) {
        $('.frm_order').submit();
    });
	

	$("#tinh").change(function(){
		var id_list=$(this).val();
		$("#huyen").load('ajax/ajax_city.php?id_list='+id_list);
	});
	
	
	
});
</script>

<link href="css/style_thanhtoan.css"  rel="stylesheet">
<div id="main_content_web">


	<div class="block_content">
	
		
			
	<ul class="breadcrumb">

	<li><a href="index.html" class="transitionAll"><?=_trangchu?></a> </li>

	<li><a href="<?=$com?>.html" class="transitionAll"><?=_thanhtoan?></a></li>

	</ul><!--end breadcrumb-->
	


    <div class="clear"></div>
    <div class="show-info-web">
	
	
	
	<div class="cart-step">
		<a class="step step-active" href="gio-hang.html"><span class="step-number">1</span><br><span class="step-label"><?=_giohang?></span></a>
		<span class="step-line step-line-active-full"></span>
		<a class="step step-active" href="thanh-toan.html"><span class="step-number">2</span><br><span class="step-label"><?=_datmua?></span></a>
		<span class="step-line step-line-active"></span>
		<span class="step"><span class="step-number">3</span><br><span class="step-label"><?=_thanhcong?></span></span>
		<div class="clearfix"></div>
	</div><!--end cart-step-->
	
	
	
	<form method="post" name="frm_order" action="" enctype="multipart/form-data" onsubmit="return check();">
	
	<ol class="onepage" id="checkoutSteps">
	
		<li id="column-1" class="firecheckout-section col-lg-4 col-md-4 col-sm-12 col-xs-12">
			
			<ul>
				<li id="onepage-billing">
					<div class="page-title">
						<span class="billing-bg"></span> <h2><?=_thongtinnguoidathang?></h2>
						<div class="clear"></div>
					</div><!--END page-title-->
					
		

				<ul class="form-list">
				
					<fieldset class="form-group">
					   <label for="hoten"> <?=_hovaten?> <span>*</span></label>
						<div class="clear"></div>
					  
				<input type="text" name="ten" id="ten" value="<?=$info_user["hoten"]?>" placeholder="<?=_hoten?>" class="keycode form-control" />
							 
						
					</fieldset>
					
					
					<fieldset class="form-group">
          <label for="hoten"> <?=_dienthoai?> <span>*</span></label>
			<div class="clear"></div>
			
						<input type="text" name="dienthoai" id="dienthoai" value="<?=@$info_user['dienthoai']?>" placeholder="<?=_dienthoai?>" class="keycode form-control" onKeyPress="return isNumberKey(event)" />
							 
						
					</fieldset>
					
					<fieldset class="form-group">
       
	   
	      <label for="hoten"> <?=_diachi?> <span>*</span></label>
			<div class="clear"></div>
						<input type="text" name="diachi" id="diachi" value="<?=@$info_user['diachi']?>"  placeholder="<?=@$info_user['diachi']?>" class="keycode form-control"  />
							 
						
					</fieldset>
					
					
					<fieldset class="form-group">
					
			<label for="hoten"> <?=_email?> <span>*</span></label>
			<div class="clear"></div>
       
						<input type="text" name="email" id="email" value="<?=@$info_user['email']?>" class="keycode form-control"  />
							 
						
					</fieldset>
					
					
					<fieldset class="form-group">
					
						<label for="tinh"><span class="red">*</span> Tỉnh / Thành</label>
						<div class="clear"></div>
						
						 <select class="form-control br0 bg-ed" id="tinh" name="tinh"  required="" aria-required="true">
								
								<option value="">Vui lòng chọn</option>
								
								<?php 
						                        //Load tinh thanh
						                        $d->reset();
						                        $sql="select id,ten_$lang from #_city_list where hienthi =1 order by stt asc";
						                        $d->query($sql);
						                        $tinh = $d->result_array();
						                        for($i=0,$count_tinh=count($tinh);$i<$count_tinh;$i++) { ?>
						                         <option value="<?=$tinh[$i]['id']?>" <?php if ($info_user["tinh"]==$tinh[$i]['id']) {?> selected <?php }?>><?=$tinh[$i]["ten_$lang"]?></option>
						                    <?php }?>
								
                           </select>	    

					</fieldset>
					
					
					
					<fieldset class="form-group">
					
						<label for="huyen"><span class="red">*</span> Quận / Huyện</label>
						<div class="clear"></div>
						
						 <select class="form-control br0 bg-ed" id="huyen" name="huyen"  required="" aria-required="true">
                            <option value="">Vui lòng chọn</option>
							
								<?php 
						                        //Load tinh thanh
						                        $d->reset();
						                        $sql="select id,ten_$lang from #_city_cat where hienthi =1 order by stt asc";
						                        $d->query($sql);
						                        $huyen = $d->result_array();
						                        for($i=0,$count_tinh=count($huyen);$i<$count_tinh;$i++) { ?>
						                         <option value="<?=$huyen[$i]['id']?>" <?php if ($info_user["huyen"]==$huyen[$i]['id']) {?> selected <?php }?>><?=$huyen[$i]["ten_$lang"]?></option>
						                    <?php }?>
									
						</select>	

					</fieldset>
					
					
					
							
						
					
					<fieldset class="form-group">
       	<label for="hoten"> <?=_noidung?> </label>
			<div class="clear"></div>
				
						<textarea name="noidung"  cols="30" rows="5" class="keycode form-control"  ><?=@$_POST['noidung']?></textarea>
						
					</fieldset>
          
          
      
								
							
					
				
				
		
				</ul><!--end form-list-->

		</li><!--end onepage-shipping-->
								

							</ul>
						</li>

		
		
		<li id="column-2" class="firecheckout-section col-lg-4 col-md-4 col-sm-12 col-xs-12">
			
			<ul>
						
				<li id="onepage-shipping_method">
					<!---Title  of the page -->
					<div class="page-title" ><span class="shipping-method-bg"></span>  <h2><?=_giaonhan?></h2>
								  <div class="clear"></div>
					</div>
					<!---End of Title -->
								
					<div id="ajax-shipping-method">
					
					<style>
					
					.load_httt .open_httt
					{
						display:block !important;
						    padding: 10px;
					}
					
					.load_httt .httt_contant
					{
						display:none;
					}
					
					</style>
					
					
						<?php
	
						$d->reset();
						$sql_banner_giua = "select noidung_$lang as noidung from #_info where com='thongtindathang' ";
						$d->query($sql_banner_giua);
						$info_order = $d->fetch_array();

						?>
	
						<?=$info_order["noidung"]?>
					
					</div>					
          	
				
				</li><!--end onepage-shipping_method-->
				
				
				<li id="onepage-payment">
				
					<div class="page-title" style="    margin-bottom: 5px;">
					  <span class="payment-bg"></span>  <h2><?=_thanhtoan?></h2>
					  <div class="clear"></div>
					</div>
					
					<div id="ajax-payment-methods">
					
					<div class="htttarea">
         
			
            <?php foreach($list_httt as $j => $v){ ?>
			
			
		
            <div class="load_httt grid check_httt_<?=$j?>">
            <label><input class="httt_<?=$j?>" <?php if ($j==0) {?> checked="checked" <?php }?> type="radio" id="checkhttt" value="<?= $v['id'] ?>" name="checkhttt"><?= $v["ten_$lang"] ?></label>
			
				<div class="content-expand httt_contant info_httt_<?=$j?>">
				
					<?=$v["noidung_$lang"]?>
				
				</div>
			
          </div>
            <?php } ?>
          </div>
			
					
					</div><!--end ajax-payment-methods-->
				
				</li>
							
			</ul>

		</li><!--end column-2-->
						

		<li id="column-3" class="firecheckout-section col-lg-4 col-md-4 col-sm-12 col-xs-12">
			
			<ul>
				<li id="onepage-review">
					<div class="page-title"><span class="review-bg"></span>  <h2><?=_thongtindonhang?></h2>
						<div class="clear"></div>
					</div>

					<div class="order-review" id="checkout-review-load">
						
						<div id="checkout-review-table-wrapper">
						
			<?php if(is_array($_SESSION['cart'])){?>	
							<table class="onestepcheckout-summary" id="checkout-review-table">
								<colgroup>
									<col>
									<col width="1">
									<col width="1">
									<col width="1">
								</colgroup>
								
								<thead>
									<tr>
										<th rowspan="1" class="name"><?=_tensanpham?></th>
										<th colspan="1" style="font-weight:bold;" class=""><?=_gia?></th>
										<th rowspan="1" class="qty"><?=_soluong?></th>
										<th colspan="1" class="total"><?=_thanhtien?></th>
									</tr>
								</thead>
								
								<tfoot>
							
										
								
									
									
									<tr>
										<td style="" class="a-left" colspan="3">
											<strong><?=_tongcong?>:</strong>
										</td>
										<td class="a-right">
											<strong><span class="price"><?=number_format(get_order_total(),0, ',', '.')?></span>&nbsp;VNĐ</span></strong>
										</td>
									</tr>
								</tfoot>
								
								<tbody>
								
								
					<?php

						$max=count($_SESSION['cart']);
									for($i=0;$i<$max;$i++){
										$pid=$_SESSION['cart'][$i]['productid'];
										$q=$_SESSION['cart'][$i]['qty'];			
										$pname=get_product_name($pid,$lang);
										$pimg=get_product_img($pid);

										if($q==0) continue;


					 ?>					
								
									<tr>
										
										<td><?=$pname?></td>
										<td class="a-right">
											<span class="cart-price">
											<span class="price"><?=number_format(get_price($pid),0, ',', '.')?> &nbsp;VNĐ</span>
												
											</span>
										</td><!--end a-right-->
										
										<td class="a-center"><?=$q?></td>
								
										<td class="a-right">
	<span class="cart-price"> <span class="price"><?=number_format((get_price($pid)*$q)-($q*get_price($pid)*get_price_km($pid)),0, ',', '.') ?>
              &nbsp;VNĐ</span> </span>
										</td>
									</tr>
								
					<?php }?>			
								
								</tbody>
							</table>
						

			<?php } else {
				
				echo "<tr><td>"._emptycart."</td>";
			}?>
			
					
					
					<fieldset class="form-group" style="margin-top:10px;">
					
						<textarea name="ghichu"  cols="48" rows="5" class="keycode form-control" placeholder="<?=_nhapghichu?>"  ><?=@$_POST['ghichu']?></textarea>
						
					</fieldset>
					
			

						
						</div><!--end checkout-review-table-wrapper-->


					</div><!--end order-review-->



						 
					<div id="checkout-review-submit">
						


						<div class="button-set" id="review-buttons-container">
						
						
						   <input title='<?=_gui?>' class="button" type="submit" name="next" value="<?=_gui?>" style="cursor:pointer;"/>
        <input title='<?=_lamlai?>' class="button" type="reset" name="next" value="<?=_lamlai?>" style="cursor:pointer;"/>
					
					
					   
						</div>

					</div>
					<!---End of order information -->

					
					<div id="product-details"></div>
				</li>
			</ul>
		
		</li>
		
	
	</ol><!--end checkoutSteps-->
	
	</form>

	
  
  </div>
</div>

</div><!--end main_content_web-->