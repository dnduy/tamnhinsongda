<?php

        		
function tinhtrang($i=0)
	{
		$sql="select * from table_tinhtrang order by id";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_tinhtrang" name="id_tinhtrang" class="main_font">					
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==$i)
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["trangthai"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	
	?>
<script type="text/javascript">

function TreeFilterChanged2(){		
			$('#validate').submit();		
}
function update(id){
	if(id>0){
		var sl=$('#product'+id).val();
		if(sl>0){
			$('#ajaxloader'+id).css('display', 'block');	
			jQuery.ajax({
				type: 'POST',
				url: "ajax.php?do=cart&act=update",
				data: {'id':id, 'sl':sl},				
				success: function(data) {					
					$('#ajaxloader'+id).css('display', 'none');	
					var getData = $.parseJSON(data);
					$('#id_price'+id).html(addCommas(getData.thanhtien)+'&nbsp;VNĐ');
					$('#sum_price').html(addCommas(getData.tongtien)+'&nbsp;VNĐ');
					$('#sum_order').html(addCommas(getData.tongtien)+'&nbsp;VNĐ');
				}
			});			
		}else alert('Số lượng phải lớn hơn 0');
	}
}

function del(id,id_order){
	if(id>0){	
		var sl=$('#product'+id).val();	
		jQuery.ajax({
			type: 'POST',
			url: "ajax.php?do=cart&act=delete",
			data: {'id':id,'id_order':id_order, 'sl':sl},		
			success: function(data) {										
					var getData = $.parseJSON(data);
					$('#productct'+id).css('display', 'none');	
					$('#sum_price').html(addCommas(getData.tongtien)+'&nbsp;VNĐ');
					$('#sum_order').html(addCommas(getData.tongtien)+'&nbsp;VNĐ');
				}
		});
	}
}
</script>  
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=order&act=mam"><span>Đơn hàng</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Xem và sửa đơn hàng</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>

<form name="supplier" id="validate" class="form" action="index.php?com=order&act=save" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Thông tin người mua</h6>
		</div>
		
		<div class="formRow">
			<label>Mã đơn hàng</label>
			<div class="formRight">
               <?=@$item['madonhang']?>
			</div>
			<div class="clear"></div>
		</div>	
        
        <div class="formRow">
			<label>Họ tên</label>
			<div class="formRight">
              <?=@$item['hoten']?>
			</div>
			<div class="clear"></div>
		</div>	
        
         <div class="formRow">
			<label>Điện thoại</label>
			<div class="formRight">
              <?=@$item['dienthoai']?>
			</div>
			<div class="clear"></div>
		</div>		        
        
         <div class="formRow">
			<label>Email</label>
			<div class="formRight">
             <?=@$item['email']?>
			</div>
			<div class="clear"></div>
		</div>	
        
     
         <div class="formRow">
			<label>IP Address:</label>
			<div class="formRight">
             <?=@$item['ip_address']?>
			</div>
			<div class="clear"></div>
		</div>	
        
        
        <div class="formRow">
			<label>Địa chỉ</label>
			<div class="formRight">
             
             <p><?=$item['diachi']?></p>
			
			</div>
			<div class="clear"></div>
		</div>	
        
         <div class="formRow">
			<label>Yêu cầu thêm</label>
			<div class="formRight">
             <?=@$item['noidung']?>
			</div>
			<div class="clear"></div>
		</div>		        
        
        </div>
		<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Chi tiết đơn hàng</h6>
		</div>
      
        <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
       
        <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">STT</a></td>      
        <td class="sortCol"><div>Tên Sản Phẩm<span></span></div></td>
        <td width="100">Hình ảnh</td>
      
        <td width="100">Đơn giá</td>
       
        <td width="50">Số lượng</td>    
        <td width="100">Thành tiền</td>
       
        <td width="50">Thao tác</td>
      </tr>
    </thead> 


    <tbody>

     <?php 
     // print_r($result_ctdonhang);
		$tongtien=0;   	
		for($i=0,$count_donhang=count($result_ctdonhang);$i<$count_donhang;$i++){	
				
				$pid=$result_ctdonhang[$i]['id_product'];
				
        		if(!empty($result_ctdonhang[$i]['id_color'])){ 
        			$pname=get_product_name($pid,'vi').' ('.getNameColor($result_ctdonhang[$i]['id_color'],'vi').')';
        		}else{
        			$pname=get_product_name($pid,'vi');
        		}

				
        		// lấy record option của Tour nếu có
        		if(!empty($result_ctdonhang[$i]['id_option'])){
        			$option_pro = get_record_option_product($result_ctdonhang[$i]['id_option'],'vi');
        			$price_option = $option_pro['gia'];
        			$name_option = ' + '.$option_pro['ten_vi'].'(';
        			$name_option .= number_format($option_pro['gia'],0,'.','.').')';
        		}else{
        			$price_option = 0;
        			$name_option = '';
        		}

				$pphoto=get_product_img($pid);


				$tongtien+=	$result_ctdonhang[$i]['gia']*$result_ctdonhang[$i]['soluong'];
				
				
				
				
		?>
        <tr id="productct<?=$result_ctdonhang[$i]['id']?>">
          <td><?=$i+1?></td>
          <td><?=$pname.$name_option?></td>
           <td><img src="<?=_upload_product.$pphoto?>" height="100"  /></td>
          
          <td align="center"><?=number_format($result_ctdonhang[$i]['gia'],0, ',', '.')?>&nbsp;VNĐ</td>
          
          
           <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$result_ctdonhang[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
            &nbsp;</td>


		          <td align="center"><input type="text"  class="tipS" style="width:50px; text-align:center" original-title="Nhập số lượng sản phẩm" maxlength="3" value="<?=$result_ctdonhang[$i]['soluong']?>" onchange="update(<?=$result_ctdonhang[$i]['id']?>)" data-id="<?=$result_ctdonhang[$i]['id_product']?>" id="product<?=$result_ctdonhang[$i]['id']?>"  data-valueold="<?=$result_ctdonhang[$i]['soluong']?>">
		          <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$result_ctdonhang[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
		            &nbsp;
		          </td>

          <td align="center" id="id_price<?=$result_ctdonhang[$i]['id']?>"><?=number_format($result_ctdonhang[$i]['gia']*$result_ctdonhang[$i]['soluong'],0, ',', '.')?>&nbsp;VNĐ</td>

         

          <td class="actBtns"><a class="smallButton tipS" original-title="Xóa" href="javascript:del(<?=$result_ctdonhang[$i]['id']?>,<?=$result_ctdonhang[$i]['id_order']?>)"><img src="./images/icons/dark/close.png" alt=""></a></td>
        </tr>



        <?php } ?>
    </tbody>



     <tfoot>
      <tr class="row_last">
        <td colspan="5"><div class="pagination tt_row">Thành tiền</div></td>
       	<td></td>
        <td><div class="pagination" id="sum_price"> <?=number_format($tongtien,0, ',', '.')?>&nbsp;VNĐ</div></td>
        <td></td>
        <td></td>
      </tr>

     

     

      <tr class="row_last">
        <td colspan="5"><div class="pagination tt_row">Tổng cộng</div></td>
       	<td></td>
        <td><div class="pagination" id="sum_order"> <?=number_format($tongtien+$item['phivanchuyen']-$giamgia,0, ',', '.')?>&nbsp;VNĐ</div></td>
        <td></td>
        <td></td>
      </tr>
    </tfoot>   
    
  </table>
        
        
    </div>

	   
        
		<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Thông tin thêm</h6>
		</div>
        
        <div class="formRow">
			<label>Invoice No:</label>
			<div class="formRight">
			<input type="text" class="" name="Invoice_No" id="Invoice_No" value="<?=@$item['Invoice_No']?>" />
			</div>
			<div class="clear"></div>
		</div>
        
		<div class="formRow">
			<label>Mô tả ngắn:</label>
			<div class="formRight">
				<textarea rows="8" cols="" title="Viết ghi chú cho đơn hàng" class="tipS" name="ghichu" id="ghichu"><?=@$item['ghichu']?></textarea>
			</div>
			<div class="clear"></div>
		</div>	

		
        <div class="formRow">
			<label>Tình trạng</label>
			<div class="formRight">
            	<div class="selector">
					<?=tinhtrang($item['trangthai'])?>
                </div>
			</div>
			<div class="clear"></div>
		</div>	
        
        <div class="formRow">
			<div class="formRight">	     
                <input type="hidden" name="id" id="id_this_post" value="<?=@$item['id']?>" />
            	<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Cập nhật" />
			</div>
			<div class="clear"></div>
		</div>
	</div>
</form>  

<style type="text/css">
	tr.row_last{
		height: 30px !important;
		background: none !important;
		font-size: 15px;
		border-bottom: none !important;
		line-height: 30px; 
	}

	tr.row_last .pagination{
		margin-top: 0px !important;
	}

	tr.row_last .tt_row{
		text-align: right;
	}
</style>
