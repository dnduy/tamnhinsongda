<script type="text/javascript" src="js/my_script_check_form.js"></script>
<script type="text/javascript">
function js_submit(){
  if(isEmpty(document.getElementById('ten'), "<?=_nameError?>")){
    document.getElementById('ten').focus();
    return false;
  }
  
  
  if(!check_email(document.frm.email.value)){
    alert("<?=_emailError1?>");
    document.frm.email.focus();
    return false;
  }
  
  
  if(isEmpty(document.getElementById('dienthoai'), "<?=_phoneError?>")){
    document.getElementById('dienthoai').focus();
    return false;
  }
  
  
  if(!isNumber(document.getElementById('dienthoai'), "<?=_phoneError1?>")){
    document.getElementById('dienthoai').focus();
    return false;
  }
  
  
  

  

  
  <?php /*?>if(isEmpty(document.getElementById('txtcapcha'), "Please enter the security code.")){
    document.getElementById('txtcapcha').focus();
    return false;
  }<?php */?>
  
  document.frm.submit();
}
</script>

<script language='javascript'>
  function isNumberKey(evt)
 {
 var charCode = (evt.which) ? evt.which : event.keyCode
 if (charCode > 31 && (charCode < 48 || charCode > 57))
 return false;
 return true;
 }

</script>

<script type="text/javascript">
  // JavaScript Document
  function re_capcha()
  {
    document.getElementById('vimg').src ="./ajax/check_captcha/captcha_image.php";
  }
</script>
<div id="main_content_web">



<ul class="breadcrumb">

<div class="container_breadcrumb">

<li><a href="" class="transitionAll"><?=_trangchu?></a> </li>
<li><a href="" class="transitionAll"><?=$title_tcat?></a></li>

</div>

</ul><!--end breadcrumb-->



    
    <div class="clear"></div>


<div class="block_content container">

    <div class="clear"></div>
    
    <div class="show-pro">
	
	
	<?php if ($deviceType!="phone") {?>
	
	<div class="left-contact col-lg-5 col-md-5 col-sm-5 col-xs-12">
           <?=$company_contact['noidung_'.$lang];?>  
                <br />
                 <form method="post" name="frm" action="" enctype="multipart/form-data">
            <div class="tablelienhe">
                <div class="input_block">
                    <label for="ten"><span><img src="images/required.gif" alt="" /></span><?=_hovaten?></label>
                    <div class="input_item"><input  name="ten" type="text" class="input" id="ten" size="50" /></div><!--input_item-->
                </div>                        
                <div class="input_block">
                    <label for="diachi"><span><img src="images/required.gif" alt="" /></span><?=_diachi?></label>
                    <div class="input_item"><input name="diachi" id="diachi" type="text"  class="input" size="50" /></div>
                </div>
                <div class="input_block">
                    <label for="dienthoai"><span><img src="images/required.gif" alt="" /></span><?=_dienthoai?></label>
                    <div class="input_item"><input name="dienthoai" type="text" class="input" id="dienthoai" size="50"/></div><!--input_item-->
                </div>
                <div class="input_block">
                    <label for="email"><span><img src="images/required.gif" alt="" /></span><?=_email?></label>
                    <div class="input_item"><input name="email" type="text" class="input" size="50"  /></div><!--input_item-->
                </div>                                                  
                <div class="input_block">
                    <label for="tieude1"><span><img src="images/required.gif" alt="" /></span><?=_tieude?></label>
                    <div class="input_item"><input name="tieude1" type="text" class="input" id="tieude1" size="50"  /></div><!--input_item-->
                </div>                         
                <div class="input_block">
                    <label for="noidung"><span><img src="images/required.gif" alt="" /></span><?=_noidung?></label>
                    <div class="input_item">
                    <textarea name="noidung" cols="50" rows="5" class="ta_noidung" id="noidung" style="background-color:#FFFFFF; color:#666666;"></textarea>
                    </div><!--input_item-->
                </div>
                <div class="input_block">
                    <label>&nbsp;</label>
                    <div class="input_item"> 
                        <input class="button" type="button" value="<?=_gui?>" onclick="js_submit();" />
                        <input class="button" type="button" value="<?=_nhaplai?>" onclick="document.frm.reset();" />
                    </div><!--input_item-->
                </div>
             </div><!--tablelienhe-->
         </form>
        </div><!--end left-contact-->
        
      
	
	<?php }?>
    
      
        
       <div class="map-c col-lg-7 col-md-7 col-sm-7 col-xs-12">

        <div class="google-map-api"> 
               

  <?php
  if(!empty($map)){
?>
    

    <div class="box_products" style="width:100%">




<script type="text/javascript">

// declare your maps outside of the functions like this and remove 
// your var where you create them.
var <?php
    foreach($map as $k=>$map_item){
  ?> map<?=$k?>; <?php }?>

 function initialize_contact() {
   
  <?php
    foreach($map as $k=>$map_item){
  ?>  
      var myLatlng<?=$k?> = new google.maps.LatLng(<?=$map_item['toado']?>);
   <?php }?> 
    
    //  var myLatlng2 = new google.maps.LatLng(-37.818535,145.12194);
      //var myLatlng3 = new google.maps.LatLng(-37.834697,145.165394);
    
   <?php
    foreach($map as $k=>$map_item){
  ?>  
      var mapOptions<?=$k?> = {
        zoom: 17,
        center: myLatlng<?=$k?>
      }
    
    <?php }?>
     
      // Note I removed the var
    
<?php
    foreach($map as $k=>$map_item){
  ?>    
      map<?=$k?> = new google.maps.Map(document.getElementById('map-tan<?=$k?>'), mapOptions<?=$k?>);
    
    <?php }?>
     // map2 = new google.maps.Map(document.getElementById('map-box'), mapOptions2);
      //map3 = new google.maps.Map(document.getElementById('map-forest'), mapOptions3);


<?php
    foreach($map as $k=>$map_item){
  ?> 
      var marker<?=$k?> = new google.maps.Marker({
          position: myLatlng<?=$k?>,
          map: map<?=$k?>,

      });
    
  <?php }?>  
     
  

     // attach the tab click handler
     attachTabClick();
  }
  
  
  function attachTabClick()
{

   $('.nav-tabs').bind('click', function (e) 
   {
      // e.target is the link
      // so use its parent to check which map to show

      var tabId = e.target;      

      //check the ID and only call the resize you need -
    
    

      if(tabId == 'panel-0')
      {
         resizeMap(map0)
      }
    
  
  else if(tabId == 'panel-1')
      {
         resizeMap(map1);
      }
      else if(tabId == 'panel-2')
      {
         resizeMap(map2)
      }       
    
  
   
    });
}


function resizeMap(map)
{
   setTimeout(function()
   {
       var center = map.getCenter();
       google.maps.event.trigger(map, "resize");
       map.setCenter(center);
   },50);
}


</script>



 <div class="tabbable" id="tabs-331065">
    
            
            <ul class="nav nav-tabs" id="map-tabs">
           
           <?php
        foreach($map as $k=>$map_item){
      ?> 
                

         <li id="map-tab<?=$k?>" onclick="resizeMap(map<?=$k?>);"  <?php if($k==0) echo 'class="active"'; else echo ''; ?>  >
                    <a href="#panel-<?=$k?>" role="tab" data-toggle="tab"><?=$map_item["ten_$lang"]?></a>
                </li>
             
           
           <?php
        }
      ?>     
               <div class="clear"></div>   
            </ul>
            
            
            <div class="tab-content">
    
     <?php
      foreach($map as $k=>$map_item){
    ?>
                <div class="tab-pane <?php if($k==0) echo 'active'; else echo ''; ?>" id="panel-<?=$k?>">
                <div class="clear"></div>
               
               <div class="map-tab-content">
                 <?=$map_item["mota_$lang"]?>
               </div><!--end map-tab-content-->  
                 
                   
                        <div id="map-tan<?=$k?>" style="width:100%; height:500px;" ></div>
                        
                       
                   
                </div>
             
                
       <?php
      }
    ?>         
                
            </div>

        </div>


</div>

 <?php
  }
?>    
       
                     
                  </div><!--end google-map-api--> 
                  
    
                
    </div><!--end map-c--> 
       
       
       
       <div class="clear"></div>
    
       
       <div class="clear"></div>
	   
	   
	   
	   <?php if ($deviceType=="phone") {?>
	
	<div class="left-contact">
           <?=$company_contact['noidung_'.$lang];?>  
                <br />
                 <form method="post" name="frm" action="" enctype="multipart/form-data">
            <div class="tablelienhe">
                <div class="input_block">
                    <label for="ten"><span><img src="images/required.gif" alt="" /></span><?=_hovaten?></label>
                    <div class="input_item"><input  name="ten" type="text" class="input" id="ten" size="50" /></div><!--input_item-->
                </div>                        
                <div class="input_block">
                    <label for="diachi"><span><img src="images/required.gif" alt="" /></span><?=_diachi?></label>
                    <div class="input_item"><input name="diachi" id="diachi" type="text"  class="input" size="50" /></div>
                </div>
                <div class="input_block">
                    <label for="dienthoai"><span><img src="images/required.gif" alt="" /></span><?=_dienthoai?></label>
                    <div class="input_item"><input name="dienthoai" type="text" class="input" id="dienthoai" size="50"/></div><!--input_item-->
                </div>
                <div class="input_block">
                    <label for="email"><span><img src="images/required.gif" alt="" /></span><?=_email?></label>
                    <div class="input_item"><input name="email" type="text" class="input" size="50"  /></div><!--input_item-->
                </div>                                                  
                <div class="input_block">
                    <label for="tieude1"><span><img src="images/required.gif" alt="" /></span><?=_tieude?></label>
                    <div class="input_item"><input name="tieude1" type="text" class="input" id="tieude1" size="50"  /></div><!--input_item-->
                </div>                         
                <div class="input_block">
                    <label for="noidung"><span><img src="images/required.gif" alt="" /></span><?=_noidung?></label>
                    <div class="input_item">
                    <textarea name="noidung" cols="50" rows="5" class="ta_noidung" id="noidung" style="background-color:#FFFFFF; color:#666666;"></textarea>
                    </div><!--input_item-->
                </div>
                <div class="input_block">
                    <label>&nbsp;</label>
                    <div class="input_item"> 
                        <input class="button" type="button" value="<?=_gui?>" onclick="js_submit();" />
                        <input class="button" type="button" value="<?=_nhaplai?>" onclick="document.frm.reset();" />
                    </div><!--input_item-->
                </div>
             </div><!--tablelienhe-->
         </form>
        </div><!--end left-contact-->
        
      
	
	<?php }?>
      <div class="clear"></div>
    

    </div><!--end show-pro-->

</div><!--end block_content-->


  <div class="clear"></div>
      
</div><!--end main_dm_product-->
