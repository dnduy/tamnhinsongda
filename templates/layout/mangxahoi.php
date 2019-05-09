<?php	

	
	
	$d->reset();
	$sql="select ten_$lang, link, photo from #_slider where hienthi=1 and com='quangcao' order by stt,id desc";
	$d->query($sql);
	$quangcao_sp= $d->result_array();
	

	
?>	
<ul class="listsocial">
            <li class="facebook">
                <a onClick="window.open('http://www.facebook.com/sharer.php?p[title]=<?=$row_setting["title_$lang"]?>&amp;p[summary]=<?=$row_setting["title_$lang"]?>&amp;p[url]=<?=$url_web?>&amp;p[images][0]=<?=$image?>','sharer','toolbar=0,status=0,width=548,height=325');"
                href="javascript: void(0)"></a>
            </li>
            <li class="google">
                <a href="https://plus.google.com/share?url=/" onClick="javascript:window.open(this.href,
'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=600');return false;"></a>
            </li>
            <li class="twitter">
                <a href="javascript: void(0);" onClick="window.open('https://twitter.com/intent/tweet?url=/','Share Twitter','toolbar=0,status=0,width=600,height=540'); return false;"> </a>
            </li>
            <li class="pinterest">
                <a href="javascript: void(0);" onClick="window.open('https://pinterest.com/pin/create/button/?url=/&amp;media=LinkImage&amp;description=gaconit+Dai+Phat+Cafe.','Share Pinterest','toolbar=0,status=0,width=600,height=540'); return false;"></a>
            </li>
        </ul>