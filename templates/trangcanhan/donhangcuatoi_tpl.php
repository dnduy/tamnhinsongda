<div class="pad10">
<script type="text/javascript" src="js/jquery.msgBox/js/jquery.msgBox.js"></script>
<link rel="stylesheet" type="text/css" href="js/jquery.msgBox/css/msgBoxLight.css"/>

<script type="text/javascript">
$(document).ready(function() {
  $("span.titleIcon input:checkbox").click(function() {
    
    var checkedStatus = this.checked;
    $("ul#checkAll li.orders-list__item input:checkbox").each(function() {
      this.checked = checkedStatus;
        if (checkedStatus == this.checked) {
          $(this).closest('.checker > span').removeClass('checked');
        }
        if (this.checked) {
          $(this).closest('.checker > span').addClass('checked');
        }
    });
  }); 
  
  $('#checkAll tbody tr td:first-child').next('td').css('border-left-color', '#CBCBCB');
  
  
   $("#sortby").change(function(event) {
          build_url();
       });
   
   $("#timeLimit").change(function(event) {
                     
      build_url();               
                     
  });
  
});

     

  
  function build_url(){
      
      var sortby=$("#sortby").val();
    var timeLimit=$("#timeLimit").val();
    
    var url="http://<?=$config_url?>/<?=$_REQUEST["com"]?>/<?=$_REQUEST["act"]?>/sequence/";
    location.href=url+"sortby="+sortby+"&timeLimit="+timeLimit;
    }

  function ChangeAction(str){
    
    
    $.msgBox({
      title : "<?=_xoadonhangdachon?>",
      content : "<?=_bancochacxoasanpham?> <?=$_SESSION["login_member"]["hoten"]?>",
      type : "alert",
      buttons : [{
        value : "<?=_yes?>"
      }, {
        value : "<?=_no?>"
      }],
      
      success : function(result) {
        if (result == "<?=_yes?>") {
          
          document.form_sub.action = str;
      document.form_sub.submit();
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


function delete_order(id)
{ 
  $.msgBox({
      title : "<?=_xoadonhangdachon?>",
      content : "<?=_bancochachuydonhang?>",
      type : "alert",
      buttons : [{
        value : "<?=_yes?>"
      }, {
        value : "<?=_no?>"
      }],
      
      success : function(result) {
        if (result == "<?=_yes?>") {
          $(".load_order_shipment" + id).hide(300);
        
          $.ajax({
            type : "POST",
            url : "ajax/huybo_pro_orderdetail.php",
            data : "ac=del&id=" + id,
            success : function(msg) {
              //$(".load_tinluu_de" + id + " a.detele").html(msg);
            },
            error : function(msg) {
              //$(".load_tinluu_de" + id + " a.detele").html("Error!");
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
      title : "<?=_thongbao?>!",
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



<div class="bold-title"><?=_donhangcuatoi?></div><!--end bold-title-->


  <div id="editIndividualForm">

        <div class="row25_canphai">

            <?=count($items)?> orders placed in:

            <select id="timeLimit" name="timeLimit">

               <option value="0" <?php if(isset($_GET["timeLimit"]) && $_GET["timeLimit"]==0){?>selected<?php }?>><?=_xemtatca?></option>

               <option value="1" <?php if (isset($_GET["timeLimit"]) && $_GET["timeLimit"]==1 ) {?> selected="selected" <?php }?> ><?=_15ngayqua?></option>
              
             
               <option value="2" <?php if (isset($_GET["timeLimit"]) && $_GET["timeLimit"]==2 ) {?> selected="selected" <?php }?> ><?=_30ngayqua?></option>
              
             
             <option value="3" <?php if (isset($_GET["timeLimit"]) && $_GET["timeLimit"]==3 ) {?> selected="selected" <?php }?> ><?=_6thangqua?></option>
              
             
             
            <option value="4" <?php if (isset($_GET["timeLimit"]) && $_GET["timeLimit"]==4 ) {?> selected="selected" <?php }?> ><?=_donhangtrongnam?></option>
          
          </select>

       </div><!--endrow25-->


       <div class="row25_canphai">
       
        <?=_sapxep?>:

        <select id="sortby">
      
          <option value="0" <?php if(isset($_GET["sortby"]) && $_GET["sortby"]==0){?>selected<?php }?>><?=_donhangmoiganday?></option>
          <!-- <option value="1" <?php if(isset($_GET["sortby"]) && $_GET["sortby"]==1){?>selected<?php }?>><?=_tentuatoz?></option>
          <option value="2" <?php if(isset($_GET["sortby"]) && $_GET["sortby"]==2){?>selected<?php }?>><?=_tentuztoa?></option> -->
          <option value="3" <?php if(isset($_GET["sortby"]) && $_GET["sortby"]==3){?>selected<?php }?>><?=_giacaodenthap?></option>
          <option value="4" <?php if(isset($_GET["sortby"]) && $_GET["sortby"]==4){?>selected<?php }?>><?=_giathapdencao?></option>

        </select>

       </div><!--endrow25-->

       <div class="clear"></div>

        <?php if(!empty($items_order)) { ?>
                
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
                        foreach($items_order  as $dh){ 
                         
                        ?>
                          <tr class="row-dh load_order_shipment<?=$dh["id"]?>">
                              <td><a href="http://<?=$config_url?>/trang-ca-nhan/chi-tiet-don-hang/<?=$dh["id"]?>"><?=$dh['madonhang']?></a></td>
                              <td><?=date('d/m/Y',$dh['ngaytao']);?></td>

                              <td>
                                <?php 
                                  $d->reset();
                                  $sql="select id_product,id_color,id_option from #_order_detail where id_order = '".$dh['id']."'";
                                  $d->query($sql);
                                  $arr_pro_detail=$d->result_array();
                                  if(!empty($arr_pro_detail)){
                                    foreach($arr_pro_detail as $pro_detail){

                                        $pname=get_product_name($pro_detail['id_product'],$lang);
                                                                      
                                        echo '<div class="row_pro_order">'.$pname.'</div>';
                                    }
                                  }
                                ?>
                              </td>

                              <td><?=number_format($dh['tonggia'],0,'.','.').' VND';?></td>
                              <td>
                                <?=get_trangthai_order($dh['trangthai'],$lang)?>
                                 <?php if ($dh["trangthai"]==1) {?>   
                                   <li class="buttons-list__item" style="list-style:none; margin-top: 5px;">
                                        <a  onclick="delete_order(<?=$dh["id"]?>)" class="button button_size_middle
                               button_color_orange button_width_full" > <?=_huydonhang?></a>
                                    </li>
                                  <?php } ?>     
                              </td>
                          </tr>
                      <?php
                        }
                      
                      ?>
                    </tbody>
                </table>
                <?php if(count($arr_order_cancel)>10) { ?> <div id="load_more_review"><?=_xemthem?></div> <?php } ?>

                <script type="text/javascript">
                  $(document).ready(function () {
                      size_dtl = $("tr.row-dh").size();
                      x=10;
                      $('tr.row-dh:lt('+x+')').show();
                      $('#load_more_review').click(function () {
                        $(".loading-cart").show();
                        setTimeout(function(){
                          x= (x+10 <= size_dtl) ? x+10 : size_dtl;
                            $('tr.row-dh:lt('+x+')').fadeIn();
                            if(x>=size_dtl){ $("#load_more_review").hide(); }
                            $(".loading-cart").hide();
                        },700)
                          
                      });
                  });
                </script>
            </div>


        <?php }else{ ?>
          <div class="revokeItem"><?=_banchuacodonhangnao?></div>
        <?php } ?>

  </div><!--end editIndividualForm-->

</div><!--end pad10-->

