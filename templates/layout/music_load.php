<?php	



?>

<style>
.ring_music
{
    position: fixed;
    top: 50%;
    right: 2%;
}

</style>


<div class="ring_music">
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="25" height="20"
    codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab">
    <param name="movie" value="images/singlemp3player.swf?file=<?=_upload_hinhanh_l.$row_setting['filenhac'];?>&autoStart=true&repeatPlay=true&backColor=008fbd&frontColor=eff4f5&songVolume=90" />
    <param name="wmode" value="transparent" />
    <embed wmode="transparent" width="25" height="20" src="images/singlemp3player.swf?file=<?=_upload_hinhanh_l.$row_setting['filenhac'];?>&autoStart=true&repeatPlay=true&backColor=008fbd&frontColor=eff4f5&songVolume=90"
    type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>
 </div>