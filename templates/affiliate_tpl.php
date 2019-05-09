<div id="nav-head">
	<div class="wikis">
		<div class="nav-link" style="margin-top: 0px;">
			<span class="head-link"><a href=""><?=_trangchu?></a></span>
			<span class="arrow"></span>
         <span class="link-cur"><?=_aff?></span>
			
		</div>
		<div class="clear"></div>
	</div>
</div><!--end nav-head-->

<div id="wrap-main">
	<div class="wikis">

		<?php if(empty($_SESSION['login'])){ ?>
			<div class="dkdn_aff">
				<a class="regis-login" href="" data-toggle="modal" data-target="#myModal"><?=_dangky?> | <?=_dangnhap?></a>
			</div>
		<?php } ?>


		<?php 
			$d->reset();
			$sql = "select noidung_$lang from table_info where com='aff' limit 0,1";
			$d->query($sql);
			$record = $d->fetch_array();
			echo $record['noidung_'.$lang];

			// if(!empty($action)){
			// 	$txt_inc = 'layout/'.$action.'_aff.php';
			// 	include _template.$txt_inc;
			// }else{
			// 	$d->reset();
			// 	$sql = "select noidung_$lang from table_info where com='aff' limit 0,1";
			// 	$d->query($sql);
			// 	$record = $d->fetch_array();
			// 	echo $record['noidung_'.$lang];
			// }
		?>


		<div class="clear"></div>
	</div>
</div>