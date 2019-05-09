<?php 
	$d->reset();
	$sql="select ten_$lang, tenkhongdau, id from #_product_list where hienthi=1 and noibat>0 order by stt,id desc";
	$d->query($sql);
	$dmspcap1=$d->result_array();
	//dump($dmspcap1);
?>
<script>
    $().ready(function () {
        $(".tabs a").click(function () {
            $id = $(this).attr("href");
            $root = $(this).parents(".wrap-tabs");
            $root.find(".content .tab").stop().fadeOut(200);
            setTimeout(function () {
                $root.find(".content .tab" + $id).stop().fadeIn();
                $root.find(".tabs li").removeClass("activetab");
			}, 200);
            $(".tabs a").removeClass("activetab");
            $(this).addClass("activetab");
            return false;
		});
		$(".tabs li:first a").trigger("click");
	});
</script>
<div class="clear"></div>
<div class="block_content">
	<div class="title_content"><h2>SẢN PHẨM CHỦ ĐẠO</h2></div>
	<div class="wrap-tabs">
		<ul class="tabs border">
			<?php for ($i = 0; $i < count($dmspcap1); $i++) {?>
				<li class="tittle_con"><a href="#tcontent<?=$dmspcap1[$i]['id']?>"><?=$dmspcap1[$i]["ten_$lang"]?></a></li>
			<?php } ?>
			
		</ul>
		<div class="content">
			<!-----------------start xem danh muc----------------->
			<?php for ($i = 0; $i < count($dmspcap1); $i++) {?>
				<div class="tab" id="tcontent<?= $dmspcap1[$i]['id']?>">
						<div id="itemContainer<?= $i ?>">
						<?php
							$sql = "select id, ten_$lang, tenkhongdau, photo,thumb,gia from #_product where hienthi=1 and phobien>1 and id_list='".$dmspcap1[$i]['id']."' order by stt asc,id desc";
							$d->query($sql);
							$product = $d->result_array();
							 if(count($product)>0){
							for ($j = 0; $j < count($product); $j++) { ?>
							<div class="pro" <?php if ( ($j+1)%4==0) {?> style="margin-right:0;" <?php }?>>
								<div class="block_img">
									<a class="img_sp" href="san-pham/<?=$product[$j]["tenkhongdau"]?>.html" title="<?=$product[$j]["ten_$lang"]?>" >
									<img src="thumb/285x209/2/<?=_upload_product_l,$product[$j]["photo"]?>" alt="<?=$product[$j]["ten_$lang"]?>" title="" /> </a>
								</div>
								<div class="pro-name"><a href="san-pham/<?=$product[$j]["tenkhongdau"]?>.html" title="<?=$product[$j]["ten_$lang"]?>"><?=$product[$j]["ten_$lang"]?></a></div>
								<?php  if($product[$j]['gia']>0){?>
									<p class="price-old"><?=_gia?>: <span><?=number_format($product[$j]['gia'],0,",",".")?> VNĐ</span></p>
									<?php	} else {?>
									<p class="price-old"><?=_gia?>: <span>Liên hệ</span></p>
								<?php }?>
							</div><!--pro-->
							<?php if(($j+1)%4==0){?> <div class="clear"></div><?php }?>	
						<?php } }else echo '<p class="notice">'._noidungdangcapnhat.'</p>'; ?>
					</div>
					<div class="clear"></div>
			<?php if(count($product)>0){ ?> <div class="holder<?= $i ?>"></div> <?php } ?>
				</div>
				<script>
  /* when document is ready */
  $(function(){

    /* initiate the plugin */
    $("div.holder<?= $i ?>").jPages({
      containerID  : "itemContainer<?= $i ?>",
      perPage      : 10,
      startPage    : 1,
      startRange   : 1,
      midRange     : 5,
      endRange     : 1
    });

  });
  </script>
<style>
.clear
{
	display:block !important;
}
  .holder<?= $i ?> {
    margin: 0 auto;
    text-align: center;
height:30px;
  }

  .holder<?= $i ?> a {
      font-size: 12px;
    cursor: pointer;
    margin: 0 1px;
    color: #333;
    color: #E25922;
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 7px 12px
  }

  .holder<?= $i ?> a:hover {
    background-color: #222;
    color: #fff;
  }

  .holder<?= $i ?> a.jp-previous {     margin-right: 0px;
    padding: 7px 0;
    border: 1px solid #ddd;}
  .holder<?= $i ?> a.jp-next {     margin-left: 0px;
    padding: 7px 0;
    border: 1px solid #ddd;}

  .holder<?= $i ?> a.jp-current, a.jp-current:hover {
    color: #12861C;
    font-weight: bold;
  }

  .holder<?= $i ?> a.jp-disabled, a.jp-disabled:hover {
    color: #bbb;
  }

  .holder<?= $i ?> a.jp-current, a.jp-current:hover,
  .holder<?= $i ?> a.jp-disabled, a.jp-disabled:hover {
       cursor: default;
    background: #12861C;
    color: #fff;
  }

  .holder<?= $i ?> span { margin: 0 5px; }
</style>
			<?php } ?>
			<!-----------------end xem danh muc----------------->
			<div class="clear"></div>
		</div>
	</div><!-- end wrap-tabs -->
</div>