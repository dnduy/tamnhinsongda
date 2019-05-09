<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=image_url&act=man_photo&typechild=<?=$_REQUEST['typechild']?>"><span><?=$name_photo?></span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Sửa <?=$name_photo?></a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=image_url&typechild=<?=$_REQUEST['typechild']?>&act=save_photo&id=<?=$_REQUEST['id'];?>" method="post" enctype="multipart/form-data">
	
    <div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Sửa <?=$name_photo?></h6>
		</div>	

        <div class="clear"></div>
        
        
   <div class="tab_gaconit">      
        
    <div id="tabs_container">
    	
        <ul id="tabs">
           
           <?php foreach ($config["lang"] as $key => $value) {
            # code...
            $active='';
            if ($key==0)
            {
              $active="active";

            }

            echo '<li class="'.$active.'"><a href="#tab'.$value.'">'.$config["langs"][$value].'</a></li>';

          }?>
         
        </ul><!--tabs-->
	</div><!--tabs_container-->
    
    
    <div id="tabs_content_container">
      
       
    	  <?php foreach ($config["lang"] as $key => $value) {
      # code...
      $active='';
      $active_block='';
      if ($key==0)
      {

        $active="active";
        $active_block="style='display:block;'";

      }
     ?> 
      
        <div id="tab<?=$value?>" class="tab_content" <?=$active_block?>>


      <div class="formRow">
			<label>Tiêu đề <?=$value?> </label>
			<div class="formRight">
				<input type="text" value="<?=@$item['ten_'.$value]?>" name="ten_<?=$value?>" title="Nội dung tiêu đề bài viết <?=$value?>" id="short" class="tipS validate[required]"   />
			</div><!--end formRight-->
            
			<div class="clear"></div>           
		</div><!--end formRow-->


     <?php if ($mota_active=="on") {?> 
       <div class="formRow">
            <label>Mô tả <?=$value?> </label>
            <div class="formRight">
                <textarea rows="8" id="short" name="mota_<?=$value?>" title="Nội dung tiêu đề bài viết <?=$value?>"><?=@$item['mota_'.$value]?></textarea>
              
            </div><!--end formRight-->
            
            <div class="clear"></div>           
        </div><!--end formRow--> 
      <?php }?>  



		<div class="formRow">
			<label>Title <?=$value?> </label>
			<div class="formRight">
				<input type="text" value="<?=@$item['title_'.$value]?>" name="title_<?=$value?>" title="Title <?=$value?>" id="short" class="tipS"   />
			</div><!--end formRight-->
            
			<div class="clear"></div>           
		</div><!--end formRow-->



		<div class="formRow">
			<label>Alt <?=$value?> </label>
			<div class="formRight">
				<input type="text" value="<?=@$item['alt_'.$value]?>" name="alt_<?=$value?>" title="Alt <?=$value?>" id="short" class="tipS"   />
			</div><!--end formRight-->
            
			<div class="clear"></div>           
		</div><!--end formRow-->



    </div><!--tab_content-->
      
    <?php }?>  
  
    
     
    </div><!--end tabs_content_container-->
    
    
    </div><!--end tab_gaconit-->
        
        
        
        
        
   <?php if ($link_active==on) {?>
        <div class="formRow">
            <label>Link liên kết: </label>
            <div class="formRight">
                <input type="text" id="price" name="link" value="<?=@$item['link']?>"  title="Nhập link liên kết cho hình ảnh" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>    

    <?php }?>     


    
    <?php if ($image_active==on) {?>


    <div class="formRow">
			<label>Tải hình ảnh:</label>
			<div class="formRight">
               <div class="mt10"><img width="200px" src="<?=_upload_hinhanh.$item['thumb']?>"></div>
            					<input type="file" id="file" name="file" />
				<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)"><?=$kichthuoc_image?>
			</div>
			<div class="clear"></div>
			
			</div>


    <?php }?>

		



        <div class="formRow">
          <label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
          <div class="formRight">           
            <input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
            <label for="check1">Hiển thị</label>           
          </div>
          <div class="clear"></div>
        </div>
        <div class="formRow">
            <label>Số thứ tự: </label>
            <div class="formRight">
                <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của hình ảnh, chỉ nhập số">
            </div>
            <div class="clear"></div>
        </div>
			
	<div class="formRow">
			<div class="formRight">

                
                
                <input type="hidden" name="id" value="<?=$item['id']?>" />
	<input type="hidden" name="referer_link" value="<?=$_SERVER['HTTP_REFERER']?>" />
	<input type="submit" value="Lưu" class="blueB" />
	<input type="button" value="Thoát" onclick="javascript:window.location='<?=$_SERVER['HTTP_REFERER']?>'" class="blueB" />
                
                
			</div>
			<div class="clear"></div>
		</div>     
		
	</div>
   
</form>   