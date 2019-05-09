<?php
if(@$_REQUEST['command']=='delete' && $_REQUEST['pid']>0){
		remove_product($_REQUEST['pid']);
	}
	else if(@$_REQUEST['command']=='clear'){
		unset($_SESSION['cart']);
	}
	else if(@$_REQUEST['command']=='update'){
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=intval($_REQUEST['product'.$pid]);
			if($q>0 && $q<=999){
				$_SESSION['cart'][$i]['qty']=$q;
			}
			else{
				$msg='Some proudcts not updated!, quantity must be a number between 1 and 999';
			}
		}
	}
?>
<script type="text/javascript">
	function del(pid){
		if(confirm('Do you really mean to delete this item')){
			document.form2.pid.value=pid;
			document.form2.command.value='delete';
			document.form2.submit();
		}
	}
	function clear_cart(){
		if(confirm('This will empty your shopping cart, continue?')){
			document.form2.command.value='clear';
			document.form2.submit();
		}
	}
	function update_cart(){
		document.form2.command.value='update';
		document.form2.submit();
	}
</script>
<link href="css/style_giohang.css"  rel="stylesheet">
<div id="main_content_web">


	<div class="block_content">
	
	
	
	<ul class="breadcrumb">

	<li><a href="index.html" class="transitionAll"><?=_trangchu?></a> </li>

	<li><a href="<?=$com?>.html" class="transitionAll"><?=_giohang?></a></li>

	</ul><!--end breadcrumb-->
	
	



    <div class="clear"></div>
    <div class="show-info-web">

	
		<div class="cart-step">
		<a class="step step-active" href="gio-hang.html"><span class="step-number">1</span><br><span class="step-label"><?=_giohang?></span></a>
		<span class="step-line step-line-active"></span>
		<a class="step " href="thanh-toan.html"><span class="step-number">2</span><br><span class="step-label"><?=_datmua?></span></a>
		<span class="step-line step-line-active"></span>
		<span class="step"><span class="step-number">3</span><br><span class="step-label"><?=_thanhcong?></span></span>
		<div class="clearfix"></div>
	</div><!--end cart-step-->
	

	
      <form name="form2" method="post">
        <input type="hidden" name="pid" />
        <input type="hidden" name="command" />
        <table border="0" cellpadding="5px" cellspacing="1px" class="giohangtable" style="font-family:Verdana, Geneva, sans-serif; font-size: 11px;" width="100%">
          <?php
			if(!empty($_SESSION['cart'])){
				echo '<tr class="bg-top-cart" >
				<td align="center">'._stt.'</td>
				<td align="center">'._ten.'</td>
				<td align="center">'._hinhanh.'</td>
				<td align="center">'._gia.'</td>
				<td align="center" style="display:none">Giảm giá</td>
				<td align="center">'._soluong.'</td>
				<td align="center">'._thanhtien.'</td>
				<td align="center">'._xoa.'</td>				
				</tr>';
				$max=count($_SESSION['cart']);
				for($i=0;$i<$max;$i++){
					$pid=$_SESSION['cart'][$i]['productid'];
					$q=$_SESSION['cart'][$i]['qty'];				
					$pname=get_product_name($pid,$lang);
					$pimg=get_product_img($pid);
					if($q==0) continue;
			?>
          <tr bgcolor="#FFFFFF" style="text-align: center">
            <td width="8%" align="center" style="height: 25px;"><?=$i+1?></td>
            <td width="20%"><?=$pname?></td>
			  <td width="15%"><img src="<?=_upload_product_l.$pimg?>" width="100" style="max-height:100px; margin-top:5px; margin-bottom:5px;"/></td>
			
			
            <td width="15%" align="center"><?=number_format(get_price($pid),0, ',', '.')?>
              &nbsp;VNĐ</td>
            <td width="15%" align="center" style="display:none"><?=number_format(get_price($pid)*get_price_km($pid),0, ',', '.')?>
              &nbsp;VNĐ</td>
            <td width="15%" align="center"><input type="text" name="product<?=$pid?>" value="<?=$q?>" maxlength="3" size="2" style="text-align:center; border:1px solid #F0F0F0" />
              &nbsp;</td>
            <td width="18%" align="center"><?=number_format((get_price($pid)*$q)-($q*get_price($pid)*get_price_km($pid)),0, ',', '.') ?>
              &nbsp;VNĐ</td>
            <td width="10%" align="center"><a href="javascript:del(<?=$pid?>)"><?php /*?> <img src="images/delete.png" border="0" /> <?php */?><span class='delimg'></span></a></td>
          </tr>
          <?php					
				}
			?>
          <tr>
            <td colspan="7" class="tongdonhang"><b><?=_tongdonhang?>:
              <span style="color: #F60;"><?=number_format(get_order_total(),0, ',', '.')?></span>
              &nbsp;VNĐ</b></td>

          </tr>
          <tr>
            <td colspan="7" align="right" style="padding:10px 0 0 0"><input type="button" value="<?=_tieptucmuahang?>" onclick="window.location='san-pham.html'" class="button btn_order_cart">
            <?php
				if(!empty($_SESSION['cart']) and count($_SESSION['cart'])>0){
			?>
			<input type="button" value="<?=_capnhatgh?>" onclick="update_cart()" class="button btn_order_cart">
              <input type="button" value="<?=_xoatatca?>" onclick="clear_cart()" class="button btn_order_cart">
              
              <input type="button" value="<?=_datmua?>" onclick="window.location='thanh-toan.html'" class="button btn_order_cart">
            <?php
				}
			?>
             </td>
          </tr>
          <?php
            }
			else{
				echo "<tr><td>"._emptycart."</td>";
			}
		?>
        </table>
      </form>
  </div>
</div>


</div><!--end main_content_web-->	

