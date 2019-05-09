<?php	



  $d->reset();
  $sql_lienket = "select ten_$lang as ten,yahoo,skype,dienthoai,email,zalo from #_support_online where hienthi=1 and com='support_online' order by id desc ";
  $d->query($sql_lienket);
  $support_online = $d->result_array();


	$d->reset();
	$sql="select ten_$lang as ten, tenkhongdau_$lang as tenkhongdau, id from #_product_list where hienthi=1 and com='product' order by stt,id desc";
	$d->query($sql);
	$tin_cap1=$d->result_array();


?>	

<div class="cate-pro">


	 <h4 class="title-catalog"><?=_danhmucsanpham?></h4>
   
    <ul class="cateUl accordion accordion-2" id="sidenav">

  
           <?php for ($i=0;$i<count($tin_cap1);$i++) {?>     

	<li <?php if ( $i==0) {?> style="border-top:none;" <?php }?> class="level1 <?php if($tin_cap1[$i]["tenkhongdau"]==$id_listhome) {?> selected <?php } else if($tin_cap1[$i]['id']==$id_listhome) {?> selected <?php }?> ">   
       <a href="<?=$tin_cap1[$i]["tenkhongdau"]?>" title="<?=$tin_cap1[$i]["ten_$lang"]?>" class="<?php if($tin_cap1[$i]["tenkhongdau_$lang"]==$id_listhome) {?>  <?php } else if($tin_cap1[$i]['id']==$id_listhome) {?> active_pro <?php }?>"><?=$tin_cap1[$i]["ten"]?></a>
	
      <?php

	$d->reset();
	  $sql="select ten_$lang as ten, tenkhongdau_$lang as tenkhongdau, id from #_product_cat where hienthi=1 and id_list=".$tin_cap1[$i]["id"]." and com='product' order by stt,id desc";
	  $d->query($sql);
	  $tin_cap2=$d->result_array();
	  if (count($tin_cap2)>0){

		?>

       <ul <?php if($tin_cap1[$i]["id"]==$id_listhome) {?> class="block_ul" <?php }?> >

         <?php for ($j=0;$j<count($tin_cap2);$j++) {?>     

        <li class="level1">   
       <a href="<?=$tin_cap2[$j]["tenkhongdau"]?>" title="<?=$tin_cap2[$j]["ten"]?>" class=" <?php if($tin_cap2[$j]['id']==$id_cathome) echo 'active_pro'?>"><?=$tin_cap2[$j]["ten"]?></a>
		
		
		
		      <?php

	$d->reset();
	  $sql="select ten_$lang as ten, tenkhongdau_$lang as tenkhongdau, id from #_product_item where hienthi=1 and id_list='".$tin_cap1[$i]["id"]."' and id_cat='".$tin_cap2[$j]["id"]."' and com='product' order by stt,id desc";
	  $d->query($sql);
	  $tin_cap3=$d->result_array();
	  if (count($tin_cap3)>0){

		?>

       <ul <?php if($tin_cap1[$i]["id"]==$id_listhome) {?> class="block_ul" <?php }?> >

         <?php for ($k=0;$k<count($tin_cap3);$k++) {?>     

        <li class="level3">   
       <a href="<?=$tin_cap3[$k]["tenkhongdau"]?>" title="<?=$tin_cap3[$k]["ten"]?>" class=" <?php if($tin_cap3[$k]['id']==$id_itemhome) echo 'active_pro'?>"><?=$tin_cap3[$k]["ten"]?></a>
		</li>

      <?php }?>

       </ul>
	   
	  <?php }?> 
		
		
		
		
		</li>

      <?php }?>

       </ul>
	   
	  <?php }?> 

  </li>
      
       <?php }?> 
        
    </ul><!--ul.cateUl-->
</div><!--cate-pro-->



<div class="cate-pro">


   <h4 class="title-catalog"><?=_hotrotructuyen?></h4>

<div class="sub_con_other">

  	<ul class="post-col-info">
	
		<div class="support_online">
			
				<div class="cate-free-content">
				
					<div class="online-support">
                    
                    <a href="ymsgr:sendim?<?=$support_online[0]["yahoo"]?>">
						<img src="images/support.png" alt="<?=$support_online[0]["ten"]?>">
					</a>
                    
                    
                    <div class="icon-hotline">
						<img src="images/icon_hotline.png">
						
						<div class="info_right">
							<p>Hotline:</p>
							<b><?=$row_setting["hotline"]?></b>
						</div><!--end info_right-->
					<div class="clear"></div>
					</div><!--end icon-hotline-->
                    
                    </div><!--end online-support-->
					
				<?php foreach ($support_online as $i => $v) {?>		
					<div class="online-support-bottom">
                      
                      	<ul class="contact_support">
                        
						<li class="name-support"><span><?=$v["ten"]?></span></li>
						
						
						<li class="skype-yahoo">
						<a href="Skype:<?=$v["skype"]?>?chat"><img src="images/icon_skype.png" width="25" height="25" alt="<?=$v["ten"]?>"></a>
						<a href="tel:<?=$v["zalo"]?>"><img src="images/icon_zalo.png" width="25" height="25" alt="<?=$v["zalo"]?>"></a>
						</li>
						
                      
                        <div class="clear"></div>
                        
                        </ul>
                        
                        
                        <ul class="contact-mail-phone">
                       
                        <li><img src="images/icon_dtban.png" width="20" height="14" alt="<?=$v["ten"]?>"><span class="phone"><?=$v["dienthoai"]?></span></li>
                        
                         <li class="icon_email"><img src="images/icon_email.png" width="20" height="13" alt="<?=$v["ten"]?>" ><span><?=$v["email"]?></span></li>
                         <div class="clear"></div>
                        </ul>
                      
                      </div><!--end online-support-bottom-->
	
					  
				<?php }?>  
				
				
					<div class="clear"></div>
					
					<div class="info_contact">
						<?=$row_setting["mailphanhoi_$lang"]?>
					</div><!--end info_contact-->
				
				</div><!--end cate-free-content-->
		
		
		
			</div><!--end support_online-->
		
	
	</ul>
			
  
  </div><!--end sub_con_other-->


  
</div><!--end cate-pro-->


<div class="cate-pro" style="margin-right:0;">


   <h4 class="title-catalog"><?=_thongketruycap?></h4>

<div class="sub_con_other">


		 <div class="counter">

         <ul>

           <li class="online"> <span><?=_online?>: </span><b><?=$count_user_online?></b></li>
          <li class="day"><span><?=_thongketuan?></span>:<b><?=$week_visitors?></b></li>
       
          <li class="statistics" style="border:none;"><span><?=_tongtruycap?></span>: <b><?=$all_visitors?></b></li> 

         </ul>
     
          <div class="clear"></div>   

        </div><!--end counter-->

  </div><!--end sub_con_other-->

</div><!--end cate-pro-->

<div class="clear"></div>





