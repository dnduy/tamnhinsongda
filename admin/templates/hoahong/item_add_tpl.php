<script type="text/javascript" src="js/script_gaconit.js"></script>
<div class="wrapper">
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
	        <li><a href="index.php?com=users&act=man"><span>Quản lý thành viên</span></a></li>
	        <li class="current"><a href="#" onclick="return false;">Số tiền hoa hồng</a></li>
        </ul>
        <div class="clear"></div>
    </div>
    
    
</div><!--end control_frm-->


<form name="frm" id="validate" class="form" method="post" action="index.php?com=hoahong&act=save&curPage=<?=@$_REQUEST['curPage']?>" enctype="multipart/form-data" class="nhaplieu">

	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Dữ liệu</h6>
		</div>		

		<div class="formRow">
			<label>Tên thành viên</label>
			<div class="formRight">
               <?=$user_detail['hoten']?>
			</div><!--end formRight-->
			<div class="clear"></div>
		</div><!--end formRow-->

		<div class="formRow">
			<label>Email</label>
			<div class="formRight">
                <?=$user_detail['email']?>
			</div><!--end formRight-->
			<div class="clear"></div>
		</div><!--end formRow-->

        <div class="formRow">
			<label>Tổng số tiền hoa hồng hiện có</label>
			<div class="formRight">
                <?=number_format(total_hoahong_current($id_user),0,'.','.').' VND';?>
			</div><!--end formRight-->
			<div class="clear"></div>
		</div><!--end formRow-->

		<div class="formRow">
			<label>Tổng số tiền hoa hồng đang chờ xét</label>
			<div class="formRight">
                <?=number_format(total_hoahong($id_user,1),0,'.','.').' VND'?>
			</div><!--end formRight-->
			<div class="clear"></div>
		</div><!--end formRow-->

		<div class="formRow">
			<label>Tổng số tiền hoa hồng đã quy đổi</label>
			<div class="formRight">
                <?=number_format(total_hoahong($id_user,4),0,'.','.').' VND'?>
			</div><!--end formRight-->
			<div class="clear"></div>
		</div><!--end formRow-->

		<div class="formRow">
			<label>Tổng số tiền hoa hồng đã rút tiền mặt</label>
			<div class="formRight">
                <?=number_format(total_hoahong($id_user,5),0,'.','.').' VND'?>
			</div><!--end formRight-->
			<div class="clear"></div>
		</div><!--end formRow-->


		<div class="formRow">
			<label>Nhập số tiền cần rút</label>
			<div class="formRight">
                <input type="text" style="width: 150px;" name="tienhoahong" title="Nhập số tiền cần rút" id="tienhoahong" class="tipS" />
                &nbsp;<span>
			</div><!--end formRight-->
			<div class="clear"></div>
		</div><!--end formRow-->

		<script type="text/javascript">
			$().ready(function(){
				
				$("#tienhoahong").keydown(function (e) {
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

			function number_format(number, decimals, dec_point, thousands_sep) {
			  number = (number + '')
			    .replace(/[^0-9+\-Ee.]/g, '');
			  var n = !isFinite(+number) ? 0 : +number,
			    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
			    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
			    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
			    s = '',
			    toFixedFix = function(n, prec) {
			      var k = Math.pow(10, prec);
			      return '' + (Math.round(n * k) / k)
			        .toFixed(prec);
			    };
			  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
			  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
			    .split('.');
			  if (s[0].length > 3) {
			    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
			  }
			  if ((s[1] || '')
			    .length < prec) {
			    s[1] = s[1] || '';
			    s[1] += new Array(prec - s[1].length + 1)
			      .join('0');
			  }
			  return s.join(dec);
			}
		</script>

    	<div class="formRow">
			<div class="formRight">
		    <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
		    <input type="hidden" name="id_user" id="id_user" value="<?=$id_user?>" />
			<input type="submit" value="Lưu" class="blueB" />
			<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=users&act=man'" class="blueB" />
			</div>
			<div class="clear"></div>
		</div>	
		

		<div class="formRow">
			<div style="font-size: 18px; color: red; margin-bottom: 15px;">Lịch sử tiền hoa hồng</div>
			<div class="wrap_list_ruttienmat">
				<div class="loading-icon loading-icon-gd"></div>
				<table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
				    <thead>
				      <tr>
				        <td style="width:150px !important;">tiền hoa hồng</td>
				        <td width="100px">Thời gian</td>
				        <td>Nội dung</td>
				        <td width="110px">Trạng thái</td>
				      </tr>
				    </thead>
				    
				    <tbody>
				    	<?php
	                	$d->reset();
	                	$sql = "select * from table_hoahong_detail where id_user=".$id_user." order by thoigiannhan desc";
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
			                        <td style="text-align: left; padding-left: 30px;">+ <?=get_noidung_hoahong($hh['noidung'],'vi').' <b>#'.get_code_order($hh['id_order']).'</b>';?>
			                        	<br>
			                        	+ Link share: <b><?=$hh['link_share']?></b>
			                        </td>
			                        <td <?=$color_trangthai?>>
			                        	<?=get_trangthai_hoahong($hh['trangthai'],'vi')?>
			                        </td>
			                    </tr>
	                	<?php
	                		}
	                	}
	                	?>
				  	</tbody>
				</table>
				<?php if(count($arr_hh)>5) { ?> <center><button type="button" class="blueB" id="load_more_gd">Xem thêm giao dịch</button></center> <?php } ?>

	            <script type="text/javascript">
					$(document).ready(function () {
					    size_hh = $("tr.row-hh").size();
					    x=5;
					    $('tr.row-hh:lt('+x+')').show();
					    $('#load_more_gd').click(function () {
					    	$(".loading-icon-gd").show();
					    	setTimeout(function(){
					    		x= (x+5 <= size_hh) ? x+5 : size_hh;
						        $('tr.row-hh:lt('+x+')').fadeIn();
						        if(x>=size_hh){ $("#load_more_gd").hide(); }
						        $(".loading-icon-gd").hide();
					    	},700)
					    });
					});
				</script>
				<div class="clear"></div>
			</div>
		</div><!--end formRow-->


		<div class="formRow">
			<div style="font-size: 18px; color: red; margin-bottom: 15px;">Lịch sử rút tiền mặt</div>
			<div class="wrap_list_ruttienmat">
				<div class="loading-icon loading-icon-his"></div>
				<table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
				    <thead>
				      <tr>
				        <td class="sortCol">tiền hoa hồng</td>
				        <td class="tb_data_small">Thời gian</td>
				        <td class="tb_data_small">Nội dung</td>
				        <td width="200">Thao tác</td>
				      </tr>
				    </thead>
				    
				    <tbody>
				         <?php for($i=0, $count=count($arr_ruttienmat); $i<$count; $i++){?>
			          	<tr class="row-his">
					        <td align="center">
					            <?=number_format($arr_ruttienmat[$i]['tienhoahong'],0,'.','.').' VND';?>
					        </td> 

					        <td align="center">
					            <?=date('d/m/Y',$arr_ruttienmat[$i]['thoigiannhan'])?>
					        </td>

					        <td align="center">
					            Đã rút tiền mặt
					        </td>

				        	<td class="actBtns">

					            <a href="javascript:void(0);" title="" class="smallButton tipS" original-title="Rút lại hành động này" onclick="deleteItem(<?=$arr_ruttienmat[$i]['id']?>);"><img src="./images/icons/dark/close.png" alt=""></a>
					                   
				            </td>
				      </tr>
				   <?php } ?>
				  </tbody>
				</table>
				<?php if(count($arr_ruttienmat)>5) { ?> <center><button type="button" class="blueB" id="load_more_his">Xem thêm lịch sử</button></center> <?php } ?>

	            <script type="text/javascript">
					$(document).ready(function () {
					    size_his = $("tr.row-his").size();
					    y=5;
					    $('tr.row-his:lt('+y+')').show();
					    $('#load_more_his').click(function () {
					    	$(".loading-icon-his").show();
					    	setTimeout(function(){
					    		y= (y+5 <= size_his) ? y+5 : size_his;
						        $('tr.row-his:lt('+y+')').fadeIn();
						        if(y>=size_his){ $("#load_more_his").hide(); }
						        $(".loading-icon-his").hide();
					    	},700)
					        
					    });
					});
				</script>
				<div class="clear"></div>
			</div>
		</div><!--end formRow-->

		
	</div>  
	
</form>

<script>
function deleteItem($id) {
    if (confirm("Bạn có chắc muốn rút lại hành động này ?")) {
        javascript:window.location='index.php?com=hoahong&act=delete&id='+$id+'&id_user=<?=$id_user?>';
    }
    return false;
}
</script>

</div><!--end wrapper-->
