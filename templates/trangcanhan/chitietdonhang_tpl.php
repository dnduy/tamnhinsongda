<div class="pad10">

<div class="bold-title"><?=_chitietdonhang?></div><!--end bold-title-->


<div id="editIndividualForm">
 
 
 	<div class="order-title">

            <!-- <a href="" class="order-title__print"> <?=_indonhang?> </a> -->

            <ul class="horizontal-list">
                <li class="horizontal-list__item">

                    <div class="headline headline_layout_inline">
                        <span class="headline__label"><?=_madonhang?></span>
                        <span class="headline__value">#<?=$item_info["madonhang"]?></span>
                    </div>

                </li>
                <li class="horizontal-list__item">

                   <?=_datngay?> <?=date("d-m-Y" ,$item_info["ngaytao"])?>
                </li>
            </ul>

</div><!--end order-title-->
 
    
    <div class="clear"></div>
    
    
    
    <div class="customer-details">
            <div class="customer-details__item">

                <h3 class="customer-details__item-header"><?=_diachinhanhang?></h3>

                <div><?=$item_info['hoten']?>, <?=$item_info['dienthoai']?></div>
                <div><?=$item_info['diachi']?></div>
                <div><?=getNamePhuongxa($item_info['id_phuongxa'],$lang)?> - <?=getNameQuanhuyen($item_info['id_quanhuyen'],$lang)?> - <?=getNameTinhthanh($item_info['id_tinhthanh'],$lang)?> - <?=getNameQuocGia($item_info['id_quocgia'],$lang)?></div>
  
            </div>
            
            <div class="customer-details__item">

                
                <h3 class="customer-details__item-header"><?=_thongtinhoadon?>   </h3>

                <div><?=$item_info['hoten']?>, <?=$item_info['dienthoai']?></div>
                <div><?=$item_info['diachi']?></div>
                <div><?=getNamePhuongxa($item_info['id_phuongxa'],$lang)?> - <?=getNameQuanhuyen($item_info['id_quanhuyen'],$lang)?> - <?=getNameTinhthanh($item_info['id_tinhthanh'],$lang)?> - <?=getNameQuocGia($item_info['id_quocgia'],$lang)?></div>
                
            </div>
            <div class="customer-details__item" style="    float: right;  margin-right: 0;">

                <h3 class="customer-details__item-header"><?=_phuongthucthanhtoan?></h3>

                <?=get_name_payment($item_info['type_payment'],$lang);?>
            </div>
        </div><!--end customer-details-->
        
        
        <div class="clear"></div>
        
        
        
   <div class="order-details">
            <table class="flat-table flat-table_width_full">
                <caption>
                    * <?=_dongia?>: VND                </caption>
                <thead>
                     <tr>
                        <th class="order-details__shipment-head"><?=_phivanchuyen?></th>
                        <th class="order-details__shipment-product"><?=_sanpham?> </th>
                        <th class="order-details__shipment-price"><?=_dongia?>  </th>
                        <th class="order-details__shipment-quantity"><?=_soluong?> </th>
                        <th class="order-details__shipment-subtotal"><?=_tamtinh?>   </th>
                    </tr>
               </thead>
               
               
          <?php      
		
				$d->reset();
				$sql="select * from #_order_detail where id_order = '".$item_info['id']."'";
				$d->query($sql);
				$result_ctdonhang=$d->result_array();
		
				$tongtien=0;  
				
				for($j=0,$count_donhang=count($result_ctdonhang);$j<$count_donhang;$j++){	
        				$id_daily=$result_ctdonhang[$j]['id_daily'];
        				$id_orderdetail=$result_ctdonhang[$j]['id'];
        				$pid=$result_ctdonhang[$j]['id_product'];
        				$soluong_sp=$result_ctdonhang[$j]['soluong'];
        				$price_sp=$result_ctdonhang[$j]['gia'];
        				$Unname=get_unsigned_name($pid,$lang);
        				$pname=get_product_name($pid,$lang);
        				$pphoto=get_product_img($pid);
        				$tongtien+=	$result_ctdonhang[$j]['gia']*$result_ctdonhang[$j]['soluong'];	
				

                if(!empty($result_ctdonhang[$j]['id_color'])){
                     $mau = ' ('.getNameColor($result_ctdonhang[$j]['id_color'],$lang).')';
                  }else{
                    $mau ='';
                  }

                // lấy record option của sản phẩm nếu có
                  if(!empty($result_ctdonhang[$j]['id_option'])){
                    $option_pro = get_record_option_product($result_ctdonhang[$j]['id_option'],'vi');
                    $price_option = $option_pro['gia'];
                    $name_option = ' + '.$option_pro['ten_vi'].'(';
                    $name_option .= number_format($option_pro['gia'],0,'.','.').')';
                  }else{
                    $price_option = 0;
                    $name_option = '';
                  }

                  //Phí ship thêm cho từng sản phẩm nếu có
                   $shipadd=get_shipadd($pid);
                    $shipadd_item = $shipadd*$result_ctdonhang[$j]['soluong'];
                    $total_shipadd_item += $shipadd_item;
			?>     

               <tbody class="order-details__shipment">
					 <tr>
                                
                    <th rowspan="1" class="order-details__shipment-head">
                        <?php if($item_info['type_ship']==2) echo ucfirst(strtolower(_giaohangnhanh.' '._trongvong24h));else echo _giaohangtieuchuan; ?>
                     </th>

                   <td class="order-details__shipment-product">

                                    

    <div class="product-brief">
        
        <div class="product-brief__image">
    
            <a href="http://<?=$config_url?>/<?=$Unname?>-<?=$pid?>.html">
                <img src="<?=_upload_product_l.$pphoto?>" alt="<?=$pname?>" alt="<?=$pname?>" onerror="this.onerror = null; this.src = this.getAttribute('data-placeholder');" data-placeholder="http://<?=$config_url?>/images/noimage.gif">
            </a>
    
        </div>
        
        <div class="product-brief__body">
    
            <div class="product-brief__name">
                <a href="http://<?=$config_url?>/<?=$Unname?>-<?=$pid?>.html">
                  <?=$pname.$mau.$name_option?>      </a>
            </div><!--end product-brief__name-->
            
    
            <ul class="product-brief__properties-list">
               <li class="product-brief__properties-list-item"><?php if (($id_daily!=0)) {?> <?=_duocbanboi?> <?=getNameDaily($id_daily,$lang)?> <?php } else {?> <?=_duocbanboi?> <?=$row_setting["ten_$lang"]?> <?php }?> </li>
            </ul>
            
        </div><!--end product-brief__body-->
        
    </div><!--end product-brief-->

     </td>
    
     <td class="order-details__shipment-price"><?=number_format($price_sp,0, ',', '.')?></td>
                                
      <td class="order-details__shipment-quantity">  <?=$soluong_sp?> </td>
     
     <td class="order-details__shipment-subtotal"><?=number_format($tongtien,0, ',', '.')?></td>
   
    </tr>
                        
                    </tbody><!--end order-details__shipment-->
                    
       <?php }?>             
                                    
                   
                
                <tfoot class="order-details__summary">
                    <tr>
                        <td colspan="2"></td>
                        <th colspan="2" class="order-details__summary-label"><?=_tamtinh?></th>
                        <td class="order-details__summary-value">
                          <?=number_format(get_tong_tien($item_info['id']),0, ',', '.')?></td>
                    </tr>
                    
					<?php /*?><tr>
                        <td colspan="2"></td>
                        <th colspan="2" class="order-details__summary-label"> <?=_hanghoacongkenh?></th>
                        <td class="order-details__summary-value">
                          <?php if(!empty($total_shipadd_item)) echo number_format($total_shipadd_item,0,'.','.');else echo _mienphi; ?>
                        </td>
                    </tr><?php */?>

                    <tr>
                        <td colspan="2"></td>
                        <th colspan="2" class="order-details__summary-label"> <?=_phivanchuyenxuly?></th>
                        <td class="order-details__summary-value">
                          <?php if(!empty($item_info['phivanchuyen'])) echo number_format($item_info['phivanchuyen'],0,'.','.');else echo _mienphi; ?>
                        </td>
                    </tr>

                    <?php if($item_info['type_ship']==2) $phithdh = getPriceShipFast(); ?>
             
			  <?php /*?> 
			 
			 <tr>
                        <td colspan="2"></td>
                        <th colspan="2" class="order-details__summary-label"> <?=_phithuchiendonhang?></th>
                        <td class="order-details__summary-value">
                          <?php if(!empty($phithdh)) echo number_format($phithdh,0,'.','.');else echo _mienphi; ?>
                        </td>
                    </tr>
               
			<?php */?>	
			   
                    
					
					  <?php /*?><tr>
                        <td colspan="2"></td>
                        <th colspan="2" class="order-details__summary-label"> Voucher</th>
                        <td class="order-details__summary-value">
                          <?php
                            if(!empty($item_info['id_coupon'])){
                                $sql="select loai,giatri,max from #_coupon where id='".$item_info['id_coupon']."'";
                                $d->query($sql);
                                $voucher = $d->fetch_array();
                                if($voucher['loai']==1){
                                  echo '-'.number_format($voucher['giatri'],0, '.', '.').'';
                                }else{
                                  $giamgia = round($tongtien*$voucher['giatri']/100);
                                  if($giamgia > $voucher['max']){
                                    $giamgia = $voucher['max'];
                                  }
                                  echo '-'.number_format($giamgia,0, '.', '.').'';
                                }
                            }else{
                              echo '-0';
                            }
                            ?>

                        </td>

                     <tr>  <?php */?>
                        <th colspan="2"></th>
                        <th colspan="2" class="order-details__summary-label order-details__summary-label_position_last" style="min-width: 200px;">
                            <strong><?php echo _tong.' ('._dabaogomthue.')';?></strong>
                        </th>
                        <td class="order-details__summary-value
                                   order-details__summary-value_position_last">
                            <strong> <?=number_format($tongtien+$item_info['phivanchuyen']+$total_shipadd_item+$phithdh-$giamgia,0, ',', '.')?></strong>
                        </td>
                    </tr>
                </tfoot><!--end order-details__summary-->

            </table>
        </div><!--end order-details-->
        
        <?php if($item_info['type_payment']==5) { ?>
        <div class="wrap_total_order_tragop">
          <div class="row-tragop">
            <span><?=_loaitragop?>:</span>
            <?php
            $record_tragop = get_detai_tragop($item_info['id_tragop']);
            echo $record_tragop['ten_'.$lang];
            ?>
          </div>
          <div class="row-tragop">
            <span><?=_tratruoc?>:</span>
            <?=number_format($item_info['sotientratruoc'],0,'.','.').' VNĐ'?>
          </div>
          <div class="row-tragop">
            <span><?=_gopmoithang?>:</span>
            <?=number_format($item_info['sotiengopmoithang'],0,'.','.').' VNĐ'.' ('.$record_tragop['month'].' '._thang.')'?>
          </div>
          <div class="row-tragop">
            <span>Tổng số tiền trả góp:</span>
            <?=number_format($item_info['tonggia'],0,'.','.').' VNĐ'?>
          </div>
        </div>		  
        <?php } ?>

        <div class="txtRight_btn">
            <a href="http://<?=$config_url?>/trang-ca-nhan/don-hang-cua-toi/member" class="button  button_color_blue button_size_middle"><?=_quaylai?></a>
        </div><!--end txtRight_btn-->

      
</div><!--end editIndividualForm-->


</div><!--end pad10-->

