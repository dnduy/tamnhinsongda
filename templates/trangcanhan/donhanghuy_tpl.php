<div class="pad10">



<div id="editIndividualForm">



	<div id="my-return-navbar">
            <div id="holder">
                <ul>
                  <li><a href="http://<?=$config_url?>/trang-ca-nhan/quan-ly-doi-tra-hang/member" <?php if ($trangcanhan=="quanlydoitrahang") {?> class="active" <?php }?> ><?=_quanlytrahang?></a></li>
                    <li><a href="http://<?=$config_url?>/trang-ca-nhan/huy-don-hang/member" <?php if ($trangcanhan=="donhanghuy") {?> class="active" <?php }?>><?=_quanlyhuydonhang?></a></li>
                </ul>
            </div> <!-- end holder div -->
        </div><!--end my-return-navbar-->
 
    
    <div class="clear"></div>
    
    
    <div id="myrevoke">
         
         <div id="editAccount" class="line mtm">
              <?php if(!empty($arr_order_cancel)) { ?>
                
                  <div class="dashboard-order have-margin">
                      <div class="loading-cart" style="position: absolute; background: url(images/loading-cart-2.gif) center no-repeat rgba(255, 255, 255, 0.6);"></div>
                      <table class="table-responsive-2">  
                          <thead>
                            <tr>
                                <th width="100px"><?=_madonhang?></th>
                                <th width="100px"><?=_ngaydat?></th>
                                <th><?=_sanpham?></th>
                                <th width="15%"><?=_tongtien?></th>
                                <th width="140px"><?=_trangthaidonhang?></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              foreach($arr_order_cancel  as $donhanghuy){ 
                               
                              ?>
                                <tr class="row-dhh">
                                    <td><a href="http://<?=$config_url?>/trang-ca-nhan/chi-tiet-don-hang/<?=$donhanghuy["id"]?>"><?=$donhanghuy['madonhang']?></a></td>
                                    <td><?=date('d/m/Y',$donhanghuy['ngaytao']);?></td>

                                    <td>
                                      <?php 
                                        $d->reset();
                                        $sql="select id_product,id_color,id_option from #_order_detail where id_order = '".$donhanghuy['id']."'";
                                        $d->query($sql);
                                        $arr_pro_detail=$d->result_array();
                                        if(!empty($arr_pro_detail)){
                                          foreach($arr_pro_detail as $pro_detail){

                                              $pname=get_product_name($pro_detail['id_product'],$lang);
                                              if(!empty($pro_detail['id_color'])){
                                                 $mau = ' ('.getNameColor($pro_detail['id_color'],$lang).')';
                                              }else{
                                                $mau ='';
                                              }

                                              if(!empty($pro_detail['id_option'])){
                                                $option_pro = get_record_option_product($pro_detail['id_option'],$lang);
                                                $name_option = ' + '.$option_pro['ten_'.$lang];
                                              }else{
                                                $name_option = '';
                                              }
                                              echo '<div class="row_pro_order">'.$pname.$mau.$name_option.'</div>';
                                          }
                                        }
                                      ?>
                                    </td>

                                    <td><?=number_format($donhanghuy['tonggia'],0,'.','.').' VND';?></td>
                                    <td><?=get_trangthai_order($donhanghuy['trangthai'],$lang)?></td>
                                </tr>
                            <?php
                              }
                            
                            ?>
                          </tbody>
                      </table>
                      <?php if(count($arr_order_cancel)>10) { ?> <div id="load_more_review"><?=_xemthem?></div> <?php } ?>

                      <script type="text/javascript">
                        $(document).ready(function () {
                            size_dtl = $("tr.row-dhh").size();
                            x=10;
                            $('tr.row-dhh:lt('+x+')').show();
                            $('#load_more_review').click(function () {
                              $(".loading-cart").show();
                              setTimeout(function(){
                                x= (x+10 <= size_dtl) ? x+10 : size_dtl;
                                  $('tr.row-dhh:lt('+x+')').fadeIn();
                                  if(x>=size_dtl){ $("#load_more_review").hide(); }
                                  $(".loading-cart").hide();
                              },700)
                                
                            });
                        });
                      </script>
                  </div>


              <?php }else{ ?>
                <div class="revokeItem"><?=_chuahuydonhang?></div>
              <?php } ?>
          </div><!--end editAccount-->

    </div><!--end myrevoke-->

      
</div><!--end editIndividualForm-->

</div><!--end pad10-->

