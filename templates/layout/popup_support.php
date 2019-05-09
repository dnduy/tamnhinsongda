<?php


	



    $d->reset();
  $sql_lienket = "select ten_$lang,yahoo,skype,dienthoai,email from #_support_online where hienthi=1 and com='support_online' order by id desc ";
  $d->query($sql_lienket);
  $result_hotro = $d->result_array();

?>
<script type="text/javascript">
   		$(document).ready(function(e) {
            $('.label_serv_onl').click(function(){
				$('.cont_serv_onl').slideToggle();
				if($(this).hasClass("active")){
					$(this).removeClass("active");
				}
				else {
					$(this).addClass("active");
				}
			})
        });
   </script>
        <script type="text/javascript" src="http://cdn.dev.skype.com/uri/skype-uri.js"></script> 

   
<div id="ser_onl">
    	<div class="label_serv_onl active"></div>
        <div class="cont_serv_onl" >
        	<h2>Liên hệ với chúng tôi</h2>
            
           <div class="support_bottom">
           
            <?php for ($i=0;$i<count($result_hotro);$i++) {?>        
            
            	<div class="name-support"><?=$result_hotro[$i]["ten_$lang"]?></div><!--end name-support-->
                
                <div class="hotline-support"><b>Hotline:</b> <?=$result_hotro[$i]["dienthoai"]?></div><!--end name-support-->
                
                 <div class="yahoosky-support">
                 <a class="yahoo" href="ymsgr:sendim?<?=$result_hotro[$i]["yahoo"]?>"><img src="http://opi.yahoo.com/online?u=<?=$result_hotro[$i]["yahoo"]?>&amp;t=1" width="80" height="25" border="0"></a>
                 
           <a href="skype:<?=$result_hotro[$i]["skype"]?>?call"><img src="images/skype.png" ></a>

             <a href="skype:<?=$result_hotro[$i]["skype"]?>?call"><img src="images/zalo.png" ></a>
                 
                 </div><!--end name-support-->
            
            <?php }?>
           
           
           </div> <!--end support_bottom-->
            
            
        </div><!--end cont_serv_onl-->
        
    </div><!--end ser_onl-->   
       

 