<?php
if(!empty($_POST['sub_quydoi'])){
	$money_exchange = $_POST['money_exchange'];
	if($money_exchange>0 && total_hoahong_current($_SESSION['login_member']['id'])>=$money_exchange){
		if($money_exchange >= get_giatridiemtichluy()){
			// Lưu vào table_hoahong_detail hành động quy đổi điểm tích lũy
			$d->reset();
			$sql = "INSERT INTO table_hoahong_detail (id_user,tienhoahong,thoigiannhan,noidung,trangthai,quydoi) 
		  		VALUES ('".$_SESSION['login_member']['id']."','$money_exchange','".time()."','2','4','1')";
		  	$d->query($sql);

		  	$diemtichluy_exd = money_to_diemtichluy($money_exchange);
		  
		  	// Lưu vào table_diemtichluy_detail hành động được quy đổi từ tiền hoa hồng
		  	// nội dung 4: nhận được điểm từ tiền hoa hồng
		  	$d->reset();
			$sql = "INSERT INTO table_diemtichluy_detail (id_user,diemtichluy,thoigian,noidung,trangthai,quydoi) 
		  		VALUES ('".$_SESSION['login']['id']."','$diemtichluy_exd','".time()."','4','2','1')";
		  	$d->query($sql);
		}else{
			$_SESSION['err_quydoi'] = 2;
		}
		
	}else{
		$_SESSION['err_quydoi'] = 1;
	}	
}
?>

<div class="pad10">

	<div class="bold-title"><?=_quanlytienhoahong?></div><!--end bold-title-->

	<div id="editIndividualForm">
	 	<div class="account-diemtichluy">
	   		<?=_banco?>  
	   		<span>
	   			<?=number_format(total_hoahong_current($_SESSION['login_member']['id']),0,'.','.').' VND';?>
   			</span> 
	   		 <?=_hoahongtrongtaikhoan?>.
		</div>
	  	
	  	<div class="account-diemtichluy">
	   		<?=_banco?>  
	   		<span>
	   			<?php 
	   			$hh_choxet = total_hoahong($_SESSION['login_member']['id'],1);
	   			if($hh_choxet>0) echo number_format($hh_choxet,0,'.','.').' VND';else echo '0 VND';
	   			?>
	   		</span> 
	   		 <?=_hoahongchoxet?>.
		</div>

		<div>
			<div style="font-size: 14px; color: red;"><?=number_format(get_giatridiemtichluy(),0,'.','.').' VND';?> = 1 <?=_diemtichluy?></div>
			<form method="post" action="">
				<span style="font-weight: bold; margin-right: 10px;"><?=_nhapsotiencandoi?>: </span>
				<input class="keycode" id="txt_money_change" name="money_exchange" required="required" value=""></input>
				<input type="submit" class="btn_quydoi" name="sub_quydoi" value="<?=_quydoi?>"></input>
			</form>
			<div class="err_quydoi">
				<?php 
				if(!empty($_SESSION['err_quydoi']) && $_SESSION['err_quydoi']==1) echo _loiquydoi1; 
				if(!empty($_SESSION['err_quydoi']) && $_SESSION['err_quydoi']==2) echo _loiquydoi2.': '.number_format(get_giatridiemtichluy(),0,'.','.').' VND'; 
				unset($_SESSION['err_quydoi']);
				?>
			</div>
			<script type="text/javascript">
				$().ready(function(){
					$("#txt_money_change").keydown(function (e) {
				        // Allow: backspace, delete, tab, escape, enter and .
				        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
				             // Allow: Ctrl+A, Command+A
				            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
				             // Allow: home, end, left, right, down, up
				            (e.keyCode >= 35 && e.keyCode <= 40)) {
				                 // let it happen, don't do anything
				                 return;
				        }
				        // Ensure that it is a number and stop the keypress
				        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
				            e.preventDefault();
				        }
				    });
				})
			</script>
		</div>

		<h3 class="title_diemtichluy"><?=_lichsuhoahong?></h3>

		<div class="dashboard-order have-margin">
			<div class="loading-cart" style="position: absolute; background: url(images/loading-cart-2.gif) center no-repeat rgba(255, 255, 255, 0.6);"></div>
            <table class="table-responsive-2">
                <thead>
	                <tr>
	                    <th width="150px"><?=_tienhoahong?></th>
	                    <th width="100px"><?=_thoigian?></th>
	                    <th><?=_noidung?></th>
	                    <th width="110px"><?=_trangthai?></th>
	                </tr>
                </thead>
                <tbody>
                	<?php
                	$d->reset();
                	$sql = "select * from table_hoahong_detail where id_user=".$_SESSION['login_member']['id']." order by thoigiannhan desc";
                	$d->query($sql);
                	$arr_hh = $d->result_array();
                	if(!empty($arr_hh)){
                		foreach($arr_hh  as $hh){ 
                			$dau = get_dau_diemtichluy($hh['trangthai']);
                			$color_hh = get_color_diemtichluy($hh['trangthai']);
                			$color_trangthai = get_color_trangthai($hh['trangthai']);
                		?>
                			<tr class="row-hh">
		                        <td <?=$color_hh?>>
		                        	<?php
		                        		if($hh['trangthai']==3){
		                        			echo '0 VND';
		                        		}else{
		                        			echo $dau.number_format($hh['tienhoahong'],0,'.','.').' VND';
		                        		}
		                        		
		                        	?>
		                        </td>
		                        <td><?=date('d/m/Y',$hh['thoigiannhan']);?></td>
		                        <td>+ <?=get_noidung_hoahong($hh['noidung'],$lang).' <b>#'.get_code_order($hh['id_order']).'</b>';?>
		                        	<br>
		                        	+ Link share: <b><?=$hh['link_share']?></b>
		                        </td>
		                        <td <?=$color_trangthai?>>
		                        	<?=get_trangthai_hoahong($hh['trangthai'],$lang)?>
		                        </td>
		                    </tr>
                	<?php
                		}
                	}
                	?>
                    

                </tbody>
            </table>
            <?php if(count($arr_hh)>5) { ?> <div id="load_more_review"><?=_xemthem?></div> <?php } ?>

            <script type="text/javascript">
				$(document).ready(function () {
				    size_hh = $("tr.row-hh").size();
				    x=5;
				    $('tr.row-hh:lt('+x+')').show();
				    $('#load_more_review').click(function () {
				    	$(".loading-cart").show();
				    	setTimeout(function(){
				    		x= (x+5 <= size_hh) ? x+5 : size_hh;
					        $('tr.row-hh:lt('+x+')').fadeIn();
					        if(x>=size_hh){ $("#load_more_review").hide(); }
					        $(".loading-cart").hide();
				    	},700)
				        
				    });
				});
			</script>
        </div>
	        
	</div><!--end editIndividualForm-->


</div><!--END pad10-->
