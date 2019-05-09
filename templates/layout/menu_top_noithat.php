<?php	

  
	$d->reset();
	$sql="select ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,id from #_product_list where hienthi=1 and com='project'  order by stt asc";
	$d->query($sql);
	$list_project=$d->result_array();
	
	
		$d->reset();
	$sql="select ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,id from #_product_list where hienthi=1 and com='kientruc'  order by stt asc";
	$d->query($sql);
	$list_kientruc=$d->result_array();
	
	
	
			$d->reset();
	$sql="select ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,id from #_product_list where hienthi=1 and com='noithat'  order by stt asc";
	$d->query($sql);
	$list_noithat=$d->result_array();
	
	



?>


<script type='text/javascript'>
$(function(){$(window).scroll(function(){
                     
      if ($(this).scrollTop() > 80) {
        $(".nav-menu-top").addClass("menu-fixed");
      } else {
        $(".nav-menu-top").removeClass("menu-fixed");
      }              
                     
                     
        if($(this).scrollTop()!=0){$('#bttop1').fadeIn();}
        else { $('#bttop1').fadeOut();}
        });
        
         $('#bttop1').click(function(){$('body,html').animate({scrollTop:0},800);
         });
});
</script>




<div class="nav-menu-top">

<div class="container">



<div class="menu_top_main">


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




      <div class="clear"></div>

  </div><!--end menu_top_main-->



</div><!--end container-->

</div><!--end menu_top-->


    
 

