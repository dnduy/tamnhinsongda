<div class="pad10">

	<div class="bold-title"><?=_quanlydiemtichluy?></div><!--end bold-title-->

	<div id="editIndividualForm">
	 	<div class="account-diemtichluy">
	   		<?=_banco?>  
	   		<span>
	   			<?=total_diemtichluy_current($_SESSION['login']['id']);?>
   			</span> 
	   		 <?=_diemtichluytrongtaikhoan?>.
		</div>
	  	
	  	<div class="account-diemtichluy">
	   		<?=_banco?>  
	   		<span>
	   			<?php 
	   			$dtl_choxet = total_diemtichluy($_SESSION['login']['id'],1);
	   			if($dtl_choxet>0) echo $dtl_choxet;else echo '0';
	   			?>
	   		</span> 
	   		 <?=_diemtichluychoxet?>.
		</div>

		<h3 class="title_diemtichluy"><?=_lichsudiemtichluy?></h3>

		<div class="dashboard-order have-margin">
			<div class="loading-cart" style="position: absolute; background: url(images/loading-cart-2.gif) center no-repeat rgba(255, 255, 255, 0.6);"></div>
            <table class="table-responsive-2">
                <thead>
	                <tr>
	                    <th width="150px"><?=_diemtichluy?></th>
	                    <th width="100px"><?=_thoigian?></th>
	                    <th><?=_noidung?></th>
	                    <th width="110px"><?=_trangthai?></th>
	                </tr>
                </thead>
                <tbody>
                	<?php
                	$d->reset();
                	$sql = "select * from table_diemtichluy_detail where id_user=".$_SESSION['login']['id']." order by thoigian desc";
                	$d->query($sql);
                	$arr_dtl = $d->result_array();
                	if(!empty($arr_dtl)){
                		foreach($arr_dtl  as $dtl){ 
                			$dau = get_dau_diemtichluy($dtl['trangthai']);
                			$color_dtl = get_color_diemtichluy($dtl['trangthai']);
                			$color_trangthai = get_color_trangthai($dtl['trangthai']);
                		?>
                			<tr class="row-dtl">
		                        <td <?=$color_dtl?>>
		                        	<?php
		                        		if($dtl['trangthai']==3){
		                        			echo '0';
		                        		}else{
		                        			echo $dau.$dtl['diemtichluy'];
		                        		}
		                        		
		                        	?>
		                        </td>
		                        <td><?=date('d/m/Y',$dtl['thoigian']);?></td>
		                        <td><?=get_noidung_diemtichluy($dtl['noidung'],$lang).' <b>#'.get_code_order($dtl['id_order']).'</b>'?></td>
		                        <td <?=$color_trangthai?>>
		                        	<?=get_trangthai_diemtichluy($dtl['trangthai'],$lang)?>
		                        </td>
		                    </tr>
                	<?php
                		}
                	}
                	?>
                </tbody>
            </table>
            <?php if(count($arr_dtl)>5) { ?> <div id="load_more_review"><?=_xemthem?></div> <?php } ?>

            <script type="text/javascript">
				$(document).ready(function () {
				    size_dtl = $("tr.row-dtl").size();
				    x=5;
				    $('tr.row-dtl:lt('+x+')').show();
				    $('#load_more_review').click(function () {
				    	$(".loading-cart").show();
				    	setTimeout(function(){
				    		x= (x+5 <= size_dtl) ? x+5 : size_dtl;
					        $('tr.row-dtl:lt('+x+')').fadeIn();
					        if(x>=size_dtl){ $("#load_more_review").hide(); }
					        $(".loading-cart").hide();
				    	},700)
				        
				    });
				});
			</script>
        </div>
	        
	</div><!--end editIndividualForm-->


</div><!--END pad10-->
