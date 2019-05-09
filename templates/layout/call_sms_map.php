<div class="call-mobile">
			
 <div class="goidien"><a class="link_title blink_me ui-link" target="_blank" href="tel:<?=$row_setting["hotline"]?>"><img src="images/goidien.png">Gọi điện</a></div>
 <div class="sms"><a class="link_title ui-link" target="_blank" href="sms:<?=$row_setting["hotline"]?>"><img src="images/sms.png">SMS</a></div>
 <div class="direct_map"><a class="link_title ui-link" target="_blank" href="lien-he.html"><img src="images/chiduong.png">Chỉ đường</a></div> 

</div><!--end call-mobile-->

<style>
#vgc_off_mobile {
    width: 145px;
    right: 20px;
    bottom: 50px !important;
}
.call-mobile a:hover {
    color: #0514c2;
    text-shadow: none;
}
.call-mobile a 
{
    font-weight: bold;
    font-size: 12px;
}
.call-mobile .goidien {
    display: inline-block;
	    margin-right: 5px;
}
.blink_me {
   -webkit-animation-name: blinker;
   -webkit-animation-duration: 1s;
   -webkit-animation-timing-function: linear;
   -webkit-animation-iteration-count: infinite;

   -moz-animation-name: blinker;
   -moz-animation-duration: 1s;
   -moz-animation-timing-function: linear;
   -moz-animation-iteration-count: infinite;

   animation-name: blinker;
   animation-duration: 1s;
   animation-timing-function: linear;
   animation-iteration-count: infinite;
}

@-moz-keyframes blinker {  
   0% { opacity: 1.0; }
   50% { opacity: 0.0; }
   100% { opacity: 1.0; }
}

@-webkit-keyframes blinker {  
   0% { opacity: 1.0; }
   50% { opacity: 0.0; }
   100% { opacity: 1.0; }
}

@keyframes blinker {  
   0% { opacity: 1.0; }
   50% { opacity: 0.0; }
   100% { opacity: 1.0; }
}

.goidien i 
{
	font-size:18px;
}
.call-mobile .goidien
{
	display:inline-block;
}
.call-mobile .sms
{
	display:inline-block;
	
}
.call-mobile .direct_map
{
	display:inline-block;
	
}
.call-mobile a 
{
	color:#fff;
}
.call-mobile a:hover{
	color:#c20509;
}
.call-mobile img {
    margin-right: 10px;
    max-width: 35px;
    vertical-align: middle;
}
.call-mobile
{
position: fixed;
    bottom: 0;
	    z-index: 99;
    width: 100%;
    background: #b40702;
    padding: 10px;
	margin:0 auto;
	text-align:center;
}
.navbar-collapse {
    padding-bottom: 15px;
}


</style>