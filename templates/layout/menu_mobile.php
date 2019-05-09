
 <!--START MENU MOBILE -->

<script type='text/javascript'>
$(function(){$(window).scroll(function(){
                     
      if ($(this).scrollTop() > 80) {
        $(".nav-menu-top-mobile").addClass("menu-fixed");
      } else {
        $(".nav-menu-top-mobile").removeClass("menu-fixed");
      }              
                     
                     
        if($(this).scrollTop()!=0){$('#bttop1').fadeIn();}
        else { $('#bttop1').fadeOut();}
        });
        
         $('#bttop1').click(function(){$('body,html').animate({scrollTop:0},800);
         });
});
</script>
 
 <link type="text/css" rel="stylesheet" href="css/jquery.mmenu.all.css" />
<script type="text/javascript" src="js/jquery.mmenu.min.all.js"></script>

<script type="text/javascript">
      $(function() {
        $('nav#menu').mmenu({
          extensions  : [ 'effect-slide-menu', 'pageshadow' ],
          searchfield : true,
          counters  : true,
          navbar    : {
            
          },
          navbars   : [
            {
              position  : 'top',
              content   : [ 'searchfield' ]
            }, {
              position  : 'top',
              content   : [
                'prev',
                'title',
                'close'
              ]
            }, 
          ]
        });
      });
</script>
<div class="nav-menu-top-mobile">



<div class="menu_responsive_top">


  <div id="page-menu-rp">
      <div class="header-rp">
        <a class="collapse" href="#menu"></a>
			<span>Menu</span>
			
		<div class="call-mobile-menu">
			
		<div class="goidien-menu"><a href="langs/vi.htm"><img src="images/vi.jpg"></a></div>
		<div class="sms-menu"><a target="_blank" href="langs/en.htm"><img src="images/en.jpg"></a></div>    

	</div><!--end call-mobile-->
		
		<?php /*?>
		
        <div class="box_search" style="display:block !important;">
                 
              <form action=""  method="get" name="frm_search_rp" id="frm_search_rp" onsubmit="return false;">
               
                <input type="text" id="search_input" name="keyword_rp" onkeypress="doEnter_rp(event)" value="Nhập từ khóa..." onblur="if(this.value=='') this.value='Nhập từ khóa...'" onfocus="if(this.value =='Nhập từ khóa...') this.value=''" />
               
                
                <div class="img_search">
                 <a href="javascript:void(0);" id="tnSearch_rp" name="searchAct"><img  src="images/icon_search.png" name="searchAct" alt="Nhập từ khóa..." id="tnSearch_rp"/></a>
                </div><!--end img_search-->
  

            </form>     
            
            <script type="text/javascript">
                $(function(){
                    $('#tnSearch_rp').click(function(evt){
                        onSearch_rp(evt);
                    });
                });
                function onSearch_rp(evt){
                    var keyword_rp = document.frm_search_rp.keyword_rp;
                    if( keyword_rp.value == '' || keyword_rp.value ==='Nhập từ khóa...'){alert('Bạn chưa nhập từ khóa'); keyword_rp.focus(); return false;}
                    location.href='index.php?com=tim-kiem&keyword='+keyword_rp.value; 
                }
                
                function doEnter_rp(evt){
                // IE         // Netscape/Firefox/Opera
                var key;
                if(evt.keyCode == 13 || evt.which == 13){
                    onSearch_rp(evt);
                }else{
                    return false; 
                }
                }
            </script>
                   
            
        </div><!--end box_search-->
		
		<?php */?>

      </div>
    
  <nav id="menu">
   
    <ul>
           
    <li class="cap1" ><a href="index.html" <?php if ( ($_GET["com"]=="") || ($_GET["com"]=="index") ) {?> class="active" <?php }?> title="<?=_trangchu?>"><?=_trangchu?></a></li>
    
		
	
	<li class="cap1" ><a href="gioi-thieu.html" <?php if (($_GET["com"]=="gioi-thieu") ) {?> class="active" <?php }?> title="<?=_gioithieu?>"><?=_gioithieu?></a> </li>
         
         	
      
    
	<li class="cap1" ><a href="kien-truc.html" <?php if (($_GET["com"]=="kien-truc") ) {?> class="active" <?php }?> title="<?=_kientruc?>"><?=_kientruc?></a>
	
	<?php if (count($list_kientruc)>0) {?>	
		<ul class="vien">
		
		  <?php foreach ($list_kientruc as $i => $v_list) {?> 
  
 <li class="cap1_pro"><a href="kien-truc/<?=$v_list["tenkhongdau"]?>/" class="<?php if($v_list["tenkhongdau"]==$id_listhome) {?> active <?php } else if($v_list['id']==$id_listhome) {?> active <?php }?>" title="<?=$v_list["ten"]?>"><?=$v_list["ten"]?> </a>
 
 
 <?php

	$d->reset();
	$sql="select ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,id from #_product_cat where hienthi=1 and id_list='".$v_list["id"]."'   order by id desc";
	$d->query($sql);
	$cat_product=$d->result_array();
	if (count($cat_product)>0){
 ?>
 
	<ul>
<?php foreach ($cat_product as $i => $v_cat) {?> 	
	<li class="cap2_pro"><a href="kien-truc/<?=$v_cat["tenkhongdau"]?>/" class="<?php if($v_cat["tenkhongdau"]==$id_cathome) {?> active <?php } else if($v_cat['id']==$id_cathome) {?> active <?php }?>" title="<?=$v_cat["ten"]?>"><i class="fa fa-angle-right" aria-hidden="true"></i><?=$v_cat["ten"]?> </a></li>
<?php }?>

	<div class="clear"></div>
	
	</ul>
	
	<?php }?>
 
 
 </li>
 
   <?php }?>
 
		
		</ul>
		
	<?php }?>	

	 </li>
       
	   
	 <li class="cap1" ><a href="noi-that.html" <?php if (($_GET["com"]=="noi-that") ) {?> class="active" <?php }?> title="<?=_noithat?>"><?=_noithat?></a>
	<?php if (count($list_project)>0) {
		
	$com_href="noi-that";	
	?>	
		<ul class="vien">
		
		  <?php foreach ($list_project as $i => $v_list) {?> 
  
 <li class="cap1_pro"><a href="<?=$com_href?>/<?=$v_list["tenkhongdau"]?>/" class="<?php if($v_list["tenkhongdau"]==$id_listhome) {?> active <?php } else if($v_list['id']==$id_listhome) {?> active <?php }?>" title="<?=$v_list["ten"]?>"><?=$v_list["ten"]?> </a>
 
 
 <?php

	$d->reset();
	$sql="select ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,id from #_product_cat where hienthi=1 and id_list='".$v_list["id"]."'   order by id desc";
	$d->query($sql);
	$cat_product=$d->result_array();
	if (count($cat_product)>0){
 ?>
 
	<ul>
<?php foreach ($cat_product as $i => $v_cat) {?> 	
	<li class="cap2_pro"><a href="<?=$com_href?>/<?=$v_cat["tenkhongdau"]?>/" class="<?php if($v_cat["tenkhongdau"]==$id_cathome) {?> active <?php } else if($v_cat['id']==$id_cathome) {?> active <?php }?>" title="<?=$v_cat["ten"]?>"><i class="fa fa-angle-right" aria-hidden="true"></i><?=$v_cat["ten"]?> </a></li>
<?php }?>

	<div class="clear"></div>
	
	</ul>
	
	<?php }?>
 
 
 </li>
 
   <?php }?>
 
		
		</ul>
	<?php }?>

	 </li>
        
	   
    
	<li class="cap1" ><a href="de-vuong.html" <?php if (($_GET["com"]=="de-vuong") ) {?> class="active" <?php }?> title="<?=_devuong?>"><?=_devuong?></a>
	
	<?php if (count($list_noithat)>0) {
		
	$com_href="de-vuong";	
	
	?>	
	
		<ul class="vien">
		
		  <?php foreach ($list_noithat as $i => $v_list) {?> 
  
 <li class="cap1_pro"><a href="<?=$com_href?>/<?=$v_list["tenkhongdau"]?>/" class="<?php if($v_list["tenkhongdau"]==$id_listhome) {?> active <?php } else if($v_list['id']==$id_listhome) {?> active <?php }?>" title="<?=$v_list["ten"]?>"><?=$v_list["ten"]?> </a>
 
 
 <?php

	$d->reset();
	$sql="select ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,id from #_product_cat where hienthi=1 and id_list='".$v_list["id"]."'   order by id desc";
	$d->query($sql);
	$cat_product=$d->result_array();
	if (count($cat_product)>0){
 ?>
 
	<ul>
<?php foreach ($cat_product as $i => $v_cat) {?> 	
	<li class="cap2_pro"><a href="<?=$com_href?>/<?=$v_cat["tenkhongdau"]?>/" class="<?php if($v_cat["tenkhongdau"]==$id_cathome) {?> active <?php } else if($v_cat['id']==$id_cathome) {?> active <?php }?>" title="<?=$v_cat["ten"]?>"><i class="fa fa-angle-right" aria-hidden="true"></i><?=$v_cat["ten"]?> </a></li>
<?php }?>

	<div class="clear"></div>
	
	</ul>
	
	<?php }?>
 
 
 </li>
 
   <?php }?>
 <div class="clear"></div>
		
		</ul>
<div class="clear"></div>
		
	<?php }?>	
		
	 </li>
       
    
	
    <li class="cap1"><a href="tin-tuc.html" <?php if ( ($_GET["com"]=="tin-tuc") ) {?> class="active" <?php }?> title="<?=_tintuc?>"><?=_tintuc?></a> </li>
    <li class="cap1"><a href="tuyen-dung.html" <?php if ( ($_GET["com"]=="tuyen-dung") ) {?> class="active" <?php }?> title="<?=_tuyendung?>"><?=_tuyendung?></a> </li>
    
	<li class="cap1"><a href="lien-he.html" <?php if ( ($_GET["com"]=="lien-he") ) {?> class="active" <?php }?> title="<?=_lienhe?>"><?=_lienhe?></a> </li>

  <div class="clear"></div>
    

    </ul>
        
  
  </nav>
</div>  


</div><!--end menu_responsive_top-->



</div><!--end nav-menu-top-mobile-->

