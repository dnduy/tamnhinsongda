<?php	

  $d->reset();
  $sql_lienket = "select ten_$lang,yahoo,skype,dienthoai,email from #_support_online where hienthi=1 and com='support_online' order by id desc ";
  $d->query($sql_lienket);
  $support_online = $d->result_array();

    $d->reset();
  $sql = "select ten_$lang,photo,link from #_image_url where hienthi=1 and com='mangxahoi' order by stt,id desc";
  $d->query($sql);
  $mxh_ft=$d->result_array();


	
?>	

<div class="support-social">

  <div class="left-support">

    <div class="phone-online">Hotline: <?=$row_setting["hotline"]?></div>

    <div class="hotline-zalo"><a href="tel:<?=$row_setting["hotline1"]?>">Hotline: <?=$row_setting["hotline1"]?></a></div>

  </div>


  <div class="right-social">

   <div class="maxh-ft">

    <h4>Follow us:</h4>

      <ul>

        <?php foreach ($mxh_ft as $key => $v) {?>
       
       <li><a href="<?=$v["link"]?>"><img src="<?=_upload_hinhanh_l.$v["photo"]?>"></a></li> 

       <?php }?>

       <div class="clear"></div>


       

      </ul>


    </div>


  </div>

  <div class="clear"></div>

</div><!--end support-social-->