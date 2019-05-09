    <link href="css/style_member_trangcanhan.css" type="text/css" rel="stylesheet"> 
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
                      <?php if ($deviceType=="computer") {?>    
                     <li><a class="regis-login" data-toggle="modal" data-target="#myModal"  ><?=_dangnhap?></a></li>   
                     
					  <?php } else {?>
                       <li><a class="regis-login" href="dang-nhap.html"  ><?=_dangnhap?></a></li>   
					  <?php }?>
                        
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
            
            
           <div class="pad10">

<div class="bold-title"><?=_chitietdonhang?></div><!--end bold-title-->


<div id="editIndividualForm">
 
 
 	<div class="order-title">

            <!-- <a href="" class="order-title__print"><?=_indonhang?></a> -->

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
                <div><?=getNameQuanhuyen($item_info['id_quanhuyen'],$lang)?> - <?=getNameTinhthanh($item_info['id_tinhthanh'],$lang)?></div>
  
            </div>
            
            <div class="customer-details__item">

                
                <h3 class="customer-details__item-header"><?=_thongtinhoadon?>   </h3>

                 <div><?=$item_info['hoten']?>, <?=$item_info['dienthoai']?></div>
                <div><?=$item_info['diachi']?></div>
                <div><?=getNameQuanhuyen($item_info['id_quanhuyen'],$lang)?> - <?=getNameTinhthanh($item_info['id_tinhthanh'],$lang)?></div>
                
            </div>
            <div class="customer-details__item" style="    float: right;  margin-right: 0;">

                <h3 class="customer-details__item-header"><?=_phuongthucthanhtoan?></h3>

                <?=get_name_payment($item_info['id_httt'],$lang);?>
            </div>
        </div><!--end customer-details-->
        
        
        <div class="clear"></div>
        
        
        
   <div class="order-details">
            <table class="flat-table flat-table_width_full">
                <caption>
                    * <?=_dongia?>: VND                </caption>
                <thead>
                     <tr>
                   
                        <th class="order-details__shipment-product"><?=_sanpham?> </th>
                        <th class="order-details__shipment-price" style="width: 15%;"><?=_dongia?>  </th>
                        <th class="order-details__shipment-quantity" style="width: 15%;"><?=_soluong?> </th>
                        <th class="order-details__shipment-subtotal" style="width: 15%;"><?=_tamtinh?>   </th>
                    </tr>
               </thead>
               
               
          <?php      
		
				
		
				$d->reset();
				$sql="select * from #_order_detail where id_order = '".$item_info['id']."'";
				$d->query($sql);
				$result_ctdonhang=$d->result_array();
				
				

		
				$tongtien=0;  
				
				for($j=0,$count_donhang=count($result_ctdonhang);$j<$count_donhang;$j++){	


  				//$id_daily=$result_ctdonhang[$j]['id_daily'];
  				$id_orderdetail=$result_ctdonhang[$j]['id'];
  				$pid=$result_ctdonhang[$j]['id_product'];
  				$soluong_sp=$result_ctdonhang[$j]['soluong'];
  				$price_sp=$result_ctdonhang[$j]['gia'];
  				$Unname=get_unsigned_name($pid,$lang);
  				$pname=get_product_name($pid,$lang);
  				$pphoto=get_product_img($pid);
  		
				$tongtien+=	$result_ctdonhang[$j]['gia']*$result_ctdonhang[$j]['soluong'];
				
			


			?>     

               <tbody class="order-details__shipment">
					     <tr>
       

                   <td class="order-details__shipment-product">

                                    

    <div class="product-brief">
        
        <div class="product-brief__image">
    
            <a href="http://<?=$config_url?>/san-pham/<?=$Unname?>-<?=$pid?>.html">
                <img src="<?=_upload_product_l.$pphoto?>" alt="<?=$pname?>" alt="<?=$pname?>" onerror="this.onerror = null; this.src = this.getAttribute('data-placeholder');" data-placeholder="http://<?=$config_url?>/images/noimage.gif">
            </a>
    
        </div>
        
        <div class="product-brief__body">
    
            <div class="product-brief__name">
                <a href="http://<?=$config_url?>/san-pham/<?=$Unname?>-<?=$pid?>.html">
                  <?=$pname?>      </a>
            </div><!--end product-brief__name-->
            
    
            <ul class="product-brief__properties-list">
               <li class="product-brief__properties-list-item"> <?=_duocbanboi?> <?=$row_setting["ten_$lang"]?>  </li>
            </ul>
            
        </div><!--end product-brief__body-->
        
    </div><!--end product-brief-->

     </td>
    
     <td class="order-details__shipment-price"><?=number_format($price_sp,0, ',', '.')?></td>
                                
      <td class="order-details__shipment-quantity">  <?=$soluong_sp?> </td>
     
     <td class="order-details__shipment-subtotal"><?=number_format($result_ctdonhang[$j]['gia']*$result_ctdonhang[$j]['soluong'],0, ',', '.')?>&nbsp;VNĐ</td>
   
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

                 
					
					
					
                    
                     <tr>
                        <th colspan="2"></th>
                        <th colspan="2" class="order-details__summary-label order-details__summary-label_position_last" style="min-width: 200px;">
                            <strong><?php echo _tonggiatridonhang;?></strong>
                        </th>
                        <td class="order-details__summary-value
                                   order-details__summary-value_position_last">
                            <strong> <?=number_format($tongtien,0,'.','.')?></strong>
                        </td>
                    </tr>
                </tfoot><!--end order-details__summary-->
                
            </table>
        </div><!--end order-details-->
        

		
        <div class="txtRight_btn">
            <a href="http://<?=$config_url?>/trang-ca-nhan/don-hang-cua-toi/member" class="button  button_color_blue button_size_middle"><?=_quaylai?></a>
        </div><!--end txtRight_btn-->

      
</div><!--end editIndividualForm-->


</div><!--end pad10-->
<!--end pad10-->



                <div class="clear"></div>
                
            </div><!--end bor-arround-->
            
            
            </div><!--end faq-content-->
        
        
        </div><!--end right-col-->
        	<div class="clear"></div>
    
    </div><!--end wrap-hot wikis-->

	<div class="clear"></div>
	
</div><!--end wrap-news-detail-->