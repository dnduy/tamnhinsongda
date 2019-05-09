<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=banner&act=capnhat&typechild=<?=$_GET['typechild']?>"><span><?=$name_cap?></span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Cập nhật</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}	
</script>


<form name="frm" method="post" action="index.php?com=banner&act=save&typechild=<?=$_GET['typechild']?>" enctype="multipart/form-data" class="nhaplieu">

	<div class="widget">
  
    <div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
    
    	<h6>Nhập dữ liệu</h6>
	</div>



  <div class="tab_gaconit">      
        
    <div id="tabs_container">
      
        <ul id="tabs">
           
    <?php 

  foreach ($config['lang'] as $key => $value) {
      
    $active='';
    if ($key==0)
    {
      $active="active";

    } 

    echo '<li class="'.$active.'"><a href="#tab'.$value.'">'.$config["langs"][$value].'</a></li>';  

  }

  ?>
         
        </ul><!--tabs-->
  </div><!--tabs_container-->
    
    
    <div id="tabs_content_container">
      
       
       <?php foreach ($config["lang"] as $key => $value) {
        
        $active='';
        $active_block='';
        if ($key==0)
        {
          $active="active";

          $active_block="style='display:block' ";


        }

      
       ?>

        <div id="tab<?=$value?>" class="tab_content <?=$active?>" <?=$active_block?> >

         <div class="formRow">
      <label>Logo <?=$value?> hiện tại:</label>
      
            
       <div class="formRight">
                 
    <?php
   if($item['banner_'.$value]!=NULL)
   {
   ?>
            
     <object width="128" height="118"  codebase="http://active.macromedia.com/flash4/cabs/swflash.cab#version=4,0,0,0" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">
              <param NAME="_cx" VALUE="13414">
              <param NAME="_cy" VALUE="6641">
              <param NAME="FlashVars" VALUE>
              <param NAME="Movie" VALUE="<?=_upload_hinhanh.$item['banner_'.$value]?>">
              <param NAME="Src" VALUE="<?=_upload_hinhanh.$item['banner_'.$value]?>">
              <param NAME="Quality" VALUE="High">
              <param NAME="AllowScriptAccess" VALUE>
              <param NAME="DeviceFont" VALUE="0">
              <param NAME="EmbedMovie" VALUE="0">
              <param NAME="SWRemote" VALUE>
              <param NAME="MovieData" VALUE>
              <param NAME="SeamlessTabbing" VALUE="1">
              <param NAME="Profile" VALUE="0">
              <param NAME="ProfileAddress" VALUE>
              <param NAME="ProfilePort" VALUE="0">
              <param NAME="AllowNetworking" VALUE="all">
              <param NAME="AllowFullScreen" VALUE="false">
              <param name="scale" value="ExactFit">
             <embed src="<?=_upload_hinhanh.$item['banner_'.$value]?>" quality="High" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" width="245" height="160" scale="ExactFit"></embed>
            </object>
            
   <?php 
   } 
   else 
   {
   echo "Chưa có Logo"; 
   }
   ?><br /><br />
            

      </div><!--end formRight-->
            
      <div class="clear"></div>
    </div>


      <div class="formRow">
      <label>Tải Logo <?=$value?>:</label>
      <div class="formRight">
        <input type="file" name="file_<?=$value?>" value="<?=$item['banner_'.$value]?>" /> <strong><?=$kichthuoc_image?>
        <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình đại diện cho sản phẩm (ảnh JPEG, GIF , JPG , PNG)">
      </div>
      <div class="clear"></div>
    </div>

        </div><!--tab_content-->

       <?php }?> 
       
     
    </div><!--end tabs_content_container-->
    
    
    </div><!--end tab_gaconit-->
    

	</div><!--end formRow-->

       
    <div class="formRow">
			  <label>Hiển thị:</label>
			
            
       <div class="formRight">
       
       <input type="checkbox" name="hienthi" checked="checked" /> <br /><br />
       
      
       </div><!--end formRight-->
       
       <div class="clear"></div>
       
    </div>   <!--end formRow-->
    
    

    
    <div class="formRow">
			<div class="formRight">
              <input type="submit" value="Lưu" class="blueB" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=banner&act=capnhat&typechild=<?=$_GET['typechild']?>'" class="blueB" />
			</div>
			<div class="clear"></div>
		</div>
	
    
    </div>
</form>   