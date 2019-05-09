<link rel="stylesheet" type="text/css" href="css/style_kiemtradonhang.css" />

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
					 '
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
        
        
        <div class="right-col col-lg-9 col-md-9 col-sm-12 col-xs-12" >
        
        	
            <div class="faq-content">
            
            
            <div class="bor-arround">
            
            
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
			content : "<?=_bancochacxoasanpham?> <?=$_SESSION["login"]["hoten"]?>",
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
			content : "<?=_bancochacxoasanpham?> <?=$_SESSION["login"]["hoten"]?>",
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

<form name="form_sub" id="form_sub" method="post">

<div id="editIndividualForm">
 
 <div class="box_admin_C">
 
 <div class="row_ad khongcaolem">
        
       <div class="row50">
           <input id="Button4" onclick="ChangeAction('index.php?com=<?=$_REQUEST["com"]?>&act=<?=$_REQUEST["act"]?>&multi=del');return false;" class="xoa_tindachon" type="button" value="<?=_xoadonhangdachon?>">
           
         
       
       </div><!--end row50-->
       
       
       
                          
                            
                            
     </div><!--endkhongcaolem-->
     
    </div><!--end <div class="box_admin_C">-->   
    
    <div class="clear"></div>
    

    
 <ul class="orders-list" id="checkAll">
  <span class="titleIcon"> <input type="checkbox" id="titleCheck" name="titleCheck" /> <b><?=_chontatca?></b> </span>  
 
 <?php
               if(count($items_order)>0){
                for($i=0,$count_dh=count($items_order);$i<$count_dh;$i++){
           ?>
   
   
   
  <li class="orders-list__item">

   <div class="order">

    <header class="order__headline">

        <div class="order__title">

            <div class="headline">
            
            <input type="checkbox" name="chon[]" id="chon" value="<?=$items_order[$i]['id']?>" class="chon" />
            
                <span class="headline__label"><?=_dathang?>
               	 <span class="headline__label-inner-text"> #<a href="http://<?=$config_url?>/kiem-tra-don-hang/<?=$items_order[$i]['id']?>/chi-tiet.html"><?=$items_order[$i]["madonhang"]?></a></span>
                </span>
                <span class="headline__value"><?=_datngay?> <?=date("d-m-Y",$items_order[$i]["ngaytao"])?>  </span>
            </div><!--end headline-->

        </div><!--end order__title-->
        
        <div class="order__cost">

            <div class="headline">
                <span class="headline__label"><?=_thanhtien?>  </span>
                <span class="headline__value"><?=number_format($items_order[$i]["tonggia"],0, ',', '.')?>&nbsp;VNĐ </span>
            </div><!--end headline-->

        </div><!--end order__cost-->
        
        <div class="order__payment">

            <div class="headline">
                <span class="headline__label"><?=_thanhtoan?>  </span>
                <span class="headline__value"> 
                <?php 
    				echo get_name_payment($items_order[$i]['id_httt'],$lang);
                ?>  
                </span>
            </div><!--end headline-->

        </div><!--end order__payment-->
        
        <div class="order__status order__status_processing">
			   <?php 
		   		$sql="select trangthai from #_tinhtrang where id= '".$items_order[$i]['trangthai']."' ";
				$d->query($sql);
				$result=$d->fetch_array();
				echo $result['trangthai'];
		   ?><!-- -->
             <span class="order__status-icon">
                <span class="status-icon  status-icon_type_processed"> </span>
            </span>

        </div><!--end order__status-->
        
       <div class="clear"></div> 

    </header>

    <div class="order__body">
                
      
       
       
        <?php      
		
				$d->reset();
				$sql="select * from #_order_detail where id_order = '".$items_order[$i]['id']."'";
				$d->query($sql);
				$result_ctdonhang=$d->result_array();
		
				$tongtien=0;  
				
				for($j=0,$count_donhang=count($result_ctdonhang);$j<$count_donhang;$j++){	
				
				$id_orderdetail=$result_ctdonhang[$j]['id'];
				$pid=$result_ctdonhang[$j]['id_product'];
				$soluong_sp=$result_ctdonhang[$j]['soluong'];
				$Unname=get_unsigned_name($pid,$lang);
				$pname=get_product_name($pid,$lang);
				$pphoto=get_product_img($pid);
				$tongtien+=	$result_ctdonhang[$j]['gia']*$result_ctdonhang[$j]['soluong'];	

   
				
			?>
      <div class="order__shipment load_order_shipment<?=$id_orderdetail?>">       
                
        <div class="order-shipment">
    
            <div class="order-shipment__status">
                <div class="order-shipment-status">
                     <span class="order-shipment-status__label order-shipment-status__label_processing">
		<?php 
		   		$sql="select trangthai from #_tinhtrang where id= '".$items_order[$i]['trangthai']."' ";
				$d->query($sql);
				$result=$d->fetch_array();
				echo $result['trangthai'];
		   ?> </span>
    
                    
   	 <ul class="steps-indicator"> 
     
     
     <?php if ($items_order[$i]["trangthai"]==1   ) {?>
     
            <li class="steps-indicator__item steps-indicator__item_color_orange">
    
                <div class="steps-indicator__point">
                    <span class="status-icon status-icon_type_processed_color_orange"></span>
                </div>
    
            </li>
            
            
            <li class="steps-indicator__item steps-indicator__item_color_gray">
    
                <div class="steps-indicator__point">
                    <span class="status-icon status-icon_type_shipped_color_gray"></span>
                </div>
    
            </li>
            
            
           <li class="steps-indicator__item steps-indicator__item_color_gray">

            
            <div class="steps-indicator__point">
                <span class="status-icon status-icon_type_delivered_color_gray"></span>
            </div>

        </li>
            
            
       <?php }?>     
            
       
        <?php if ( $items_order[$i]["trangthai"]==2   ) {?>
        
           <li class="steps-indicator__item steps-indicator__item_color_orange">
    
                <div class="steps-indicator__point">
                    <span class="status-icon status-icon_type_processed_color_orange"></span>
                </div>
    
            </li>
        
          <li class="steps-indicator__item  steps-indicator__item_color_orange ">
    
                <div class="steps-indicator__point">
                    <span class="status-icon status-icon_type_shipped_color_orange "></span>
                </div>
    
          </li>
          
          
           <li class="steps-indicator__item steps-indicator__item_color_gray">

            
            <div class="steps-indicator__point">
                <span class="status-icon status-icon_type_delivered_color_gray"></span>
            </div>

        </li>
    
        
        <?php }?>    
          
          
         <?php if ($items_order[$i]["trangthai"]==3) {?>
        
         <li class="steps-indicator__item steps-indicator__item_color_orange">
    
                <div class="steps-indicator__point">
                    <span class="status-icon status-icon_type_processed_color_orange"></span>
                </div>
    
            </li>
        
          <li class="steps-indicator__item  steps-indicator__item_color_orange ">
    
                <div class="steps-indicator__point">
                    <span class="status-icon status-icon_type_shipped_color_orange "></span>
                </div>
    
          </li>
          
          
          <li class="steps-indicator__item steps-indicator__item_color_orange">

            
            <div class="steps-indicator__point">
                <span class="status-icon status-icon_type_delivered_color_orange"></span>
            </div>

        </li>
        

        <?php }?>      
          
            
          
                
          
        </ul><!--end steps-indicator-->
        
    
                   <?php /*?> <div class="order-shipment-status__comment"> Giao hàng dự kiến từ 15 - 17/12/2015 </div><?php */?>
    
                </div>
               
                <div class="order-shipment__actions">
    
                    <ul class="buttons-list buttons-list_layout_vertical">
                        <li class="buttons-list__item">
              <a href="http://<?=$config_url?>/kiem-tra-don-hang/<?=$items_order[$i]['id']?>/chi-tiet.html" class="button button_size_middle button_color_orange  button_width_full"> <?=_xemchitiet?>  </a>
                          </li>
                                                                
                     
                 <li class="buttons-list__item" >
          <a  onclick="delete_order(<?=$id_orderdetail?>)" class="button button_size_middle
 button_color_orange button_width_full" > <?=_huydonhang?></a>
                  </li>
                                                         
                        
                    </ul>
    
                </div><!--end order-shipment__actions-->
                
            </div><!--end order-shipment__status-->
        
     <div class="order-shipment__goods">
         
         <ul class="order-goods-list">
              
   <li class="order-goods-list__item">
                    
    <div class="product-brief">
    
        <div class="product-brief__image">
    
            <a href="http://<?=$config_url?>/<?=$Unname?>-<?=$pid?>.html">
                <img src="<?=_upload_product_l.$pphoto?>" alt="<?=$pname?>" onerror="this.onerror = null; this.src = this.getAttribute('data-placeholder');" data-placeholder="http://<?=$config_url?>/images/noimage.gif"/>
            </a>
    
        </div><!--end product-brief__image-->
        
        <div class="product-brief__body">
    
            <div class="product-brief__name">
                <a href="http://<?=$config_url?>/<?=$Unname?>-<?=$pid?>.html"><?=$pname.$mau.$name_option?></a>
            </div>
    
                        <ul class="product-brief__properties-list">
                               <?php /*?> <li class="product-brief__properties-list-item"></li><?php */?>
                                <li class="product-brief__properties-list-item"> <?=_soluong?>: <?=$soluong_sp?> </li>
                            </ul>
            
        </div><!--end product-brief__body-->
        
   	 </div><!--end product-brief-->
    </li><!--end order-goods-list__item-->
            </ul><!--end order-goods-list-->
        </div><!--end order-shipment__goods-->
        
        <div class="clear"></div>
    
    </div><!--end order-shipment-->
                </div>
    
   <?php }?> 



            </div><!--end order__body-->

</div><!--end order-->

   </li><!--end orders-list__item-->
   
    <?php } }else echo '<p class="notice">'._banchuacodonhangnao.'</p>';  ?> 
   
</ul><!--end orders-list-->
           
 
      
</div><!--end editIndividualForm-->

</form>

</div><!--end pad10-->



                <div class="clear"></div>
                
            </div><!--end bor-arround-->
            
            
            </div><!--end faq-content-->
        
        
        </div><!--end right-col-->
        	<div class="clear"></div>
    
    </div><!--end wrap-hot wikis-->

	<div class="clear"></div>
	
</div><!--end wrap-news-detail-->