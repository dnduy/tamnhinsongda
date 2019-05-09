<div class="wrapper">
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=product&act=man_list&typeparent=<?=$_GET['typeparent']?>"><span><?=$name_cap?></span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
    
    
</div><!--end control_frm-->



<form name="supplier" id="validate" class="form" action="index.php?com=product&act=save_list&typeparent=<?=$_GET['typeparent']?>" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Nhập dữ liệu</h6>
		</div>		
        
   <?php if ($image_active=="on") {?>      
     <div class="formRow" >
			<label>Hình ảnh hiện tại:</label>
			<div class="formRight">
            	
      <?php if ($_REQUEST['act']=='edit_list' && $item['thumb']!='')
        {?>
        <img src="<?php if($item['photo']!=NULL) echo _upload_product_list.$item['photo']; else echo 'images/no_image.jpg';?>"  alt="NO PHOTO" style="max-width:300px;" />
        
         <a class="delete_img_present" title="Xoá ảnh" onclick="Action_Delete_Img('index.php?com=product&act=save_list&typeparent=<?=$_GET['typeparent']?>&id=<?=@$item['id']?>&delete_img_present=delete_img');return false;">Xoá ảnh</a>
                    
        <br>
        
        <?php }?>
        
     		<input type="file" id="file" name="file" />
				<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình đại diện cho sản phẩm (ảnh JPEG, GIF , JPG , PNG)"> <?=$kichthuoc_image?>
			</div>
			<div class="clear"></div>
		</div><!--end formRow-->
    <?php }?>



    <?php if ($icon_active=="on") {?>      
     <div class="formRow" >
      <label>Icon hiện tại:</label>
      <div class="formRight">
              
      <?php if ($_REQUEST['act']=='edit_list' && $item['icon']!='')
        {?>
        <img src="<?php if($item['icon']!=NULL) echo _upload_product_list.$item['icon']; else echo 'images/no_image.jpg';?>"  alt="NO ICON" style="max-width:300px;" />
        
                   
        <br>
        
        <?php }?>
        
        <input type="file" id="file" name="file_icon" />
        <img src="./images/question-button.png" alt="Upload Icon" class="icon_question tipS" original-title="Tải Icon đại diện cho sản phẩm (ảnh JPEG, GIF , JPG , PNG)"> <?=$kichthuoc_icon?>
      </div>
      <div class="clear"></div>
    </div><!--end formRow-->
    <?php }?>
              
        
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
    			<label>Tiêu đề <?=$value?></label>
    			<div class="formRight">
    				<input type="text" value="<?=@$item['ten_'.$value]?>" name="ten_<?=$value?>" title="Nội dung tiêu đề bài viết <?=$config["langs"][$value]?> " id="short" class="tipS validate[required]" />
    			</div><!--end formRight-->
                
    			<div class="clear"></div>           
	     	</div><!--end formRow-->
			
			
			
		 <?php if ($mota_active=="on") {?> 	            
		<div class="formRow">
			<label>Mô tả <?=$value?>:</label>
			<div class="formRight">
				<textarea rows="8" cols="" title="Viết mô tả ngắn sản phẩm"  name="mota_<?=$value?>" id="short"><?=@$item['mota_'.$value]?></textarea>
			</div>
			<div class="clear"></div>
		</div><!--end formRow-->
		 <?php }?>
        

        </div><!--tab_content-->

       <?php }?> 
      
      
     
    </div><!--end tabs_content_container-->
    
    
    </div><!--end tab_gaconit-->
        
		
        
		     
        
		
        <div class="formRow">
          <label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
          <div class="formRight">
            
			<input type="checkbox" name="is_index" id="check_is_index"  <?=(!isset($item['is_index']) || $item['is_index']==1)?'checked="checked"':''?>/>
            <label for="check_is_index">Index <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Bỏ Check nếu bạn muốn Google không index danh mục này!" style="float:right; margin-top:0;" /></label>

			<input type="checkbox" name="is_follow" id="check_is_follow"  <?=(!isset($item['is_follow']) || $item['is_follow']==1)?'checked="checked"':''?>/>
            <label for="check_is_follow">Follow <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Bỏ Check nếu bạn muốn Google không follow danh mục này!" style="float:right; margin-top:0;" /></label>

		   <input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
            <label for="check1">Hiển thị</label>            
          </div>
          <div class="clear"></div>
        </div>
        <div class="formRow">
            <label>Số thứ tự: </label>
            <div class="formRight">
                <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
            </div>
            <div class="clear"></div>
        </div>
		
        
		
		
		
	</div>  
	
    <div class="widget">
		<div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
			<h6>Nội dung seo</h6>
		</div>
		<div class="formRow">
			<label>Tạo SEO <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bấm TẠO SEO để tạo Tiêu đề, Mô tả, Từ khoá cho danh mục sản phẩm"> </label>
			<div class="formRight">
            	<input type="button" class="blueB" onclick="CreateTitleSEO();" value="Tạo SEO" />
			</div>
			<div class="clear"></div>
		</div>		
        
        
        
        
    <div class="tab_gaconit">      
        
    <div id="tabs_seo_container">
    	<ul id="tabs_seo">


    	<?php foreach ($config["lang"] as $key => $value) {

    		$active="";

    		if ($key==0)
    		{

    			$active="active";
    			
    		}


    		echo '<li class="'.$active.'"><a href="#tab'.$value.'_seo">'.$config["langs"][$value].'</a></li>';
    		# code...
    	} ?>		

         
        </ul><!--tabs_seo-->
	</div><!--tabs_container-->
    
    
    
       <div id="tabs_seo_content_container">


     <?php foreach ($config["lang"] as $key => $value) {

     	$active="";
     	$active_block="";
     	if ($key==0)
     	{
     		$active="active";
     		$active_block="style='display:block' ";
     	}
     	# code...
      ?> 

     <div id="tab<?=$value?>_seo" class="tab_seo_content <?=$active?>" <?=$active_block?>>
        
        
        <div class="formRow">
			<label>H1 <?=$value?></label>
			<div class="formRight">
				<input type="text" value="<?=@$item['h1_'.$value.'']?>" name="h1_<?=$value?>" title="Nội dung thẻ meta h1 <?=$value?> dùng để SEO" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
        
        
        <div class="formRow">
			<label>H2 <?=$value?></label>
			<div class="formRight">
				<input type="text" value="<?=@$item['h2_'.$value.'']?>" name="h2_<?=$value?>" title="Nội dung thẻ meta h2 <?=$value?> dùng để SEO" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
        
		<div class="formRow">
      <label>H3 <?=$value?></label>
      <div class="formRight">
    <input type="text" value="<?=@$item['h3_'.$value]?>" name="h3_<?=$value?>" title="Nội dung thẻ meta h3 <?=$value?> dùng để SEO" class="tipS" />
      </div>
      <div class="clear"></div>
    </div>
	
	
	  <div class="formRow">
      <label>H4 <?=$value?></label>
      <div class="formRight">
    <input type="text" value="<?=@$item['h4_'.$value]?>" name="h4_<?=$value?>" title="Nội dung thẻ meta h4 <?=$value?> dùng để SEO" class="tipS" />
      </div>
      <div class="clear"></div>
    </div>
	
	
	 <div class="formRow">
      <label>H5 <?=$value?></label>
      <div class="formRight">
    <input type="text" value="<?=@$item['h5_'.$value]?>" name="h5_<?=$value?>" title="Nội dung thẻ meta h5 <?=$value?> dùng để SEO" class="tipS" />
      </div>
      <div class="clear"></div>
    </div>
	
	
	 <div class="formRow">
      <label>H6 <?=$value?></label>
      <div class="formRight">
    <input type="text" value="<?=@$item['h6_'.$value]?>" name="h6_<?=$value?>" title="Nội dung thẻ meta h6 <?=$value?> dùng để SEO" class="tipS" />
      </div>
      <div class="clear"></div>
    </div>
        
        <div class="formRow">
			<label>Title <?=$value?></label>
			<div class="formRight">
				<input type="text" value="<?=@$item['title_'.$value.'']?>" name="title_<?=$value?>" title="Nội dung thẻ meta Title <?=$value?> dùng để SEO" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>



      <div class="formRow">
      <label>Alt <?=$value?></label>
      <div class="formRight">
        <input type="text" value="<?=@$item['alt_'.$value.'']?>" name="alt_<?=$value?>" title="Nội dung thẻ meta alt <?=$value?> dùng để SEO" class="tipS" />
      </div>
      <div class="clear"></div>
    </div>
        
        
        
        <div class="formRow">
			<label>Từ khóa <?=$value?></label>
			<div class="formRight">
				<input type="text" value="<?=@$item['keyword_'.$value.'']?>" name="keyword_<?=$value?>" title="Từ khóa chính <?=$value?> cho sản phẩm" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
        
        
        
        <div class="formRow">
			<label>Description <?=$value?>:</label>
			<div class="formRight">
				<textarea rows="8" cols="" title="Nội dung thẻ meta Description <?=$value?> dùng để SEO" class="tipS" name="description_<?=$value?>"><?=@$item['description_'.$value.'']?></textarea>
                <input readonly="readonly" type="text" style="width:25px; margin-top:10px; text-align:center;" name="deschar_<?=$value?>" value="<?=@$item['deschar_'.$value.'']?>" /> ký tự <b>(Tốt nhất là 160 ký tự)</b>
			</div>
			<div class="clear"></div>
		</div>
        
        
        </div><!--end tab_content-->


     <?php }?>

        
     </div><!--end tabs_content_container-->   
    
    
    </div><!--end tab_gaconit-->   
        
       
		
		<div class="formRow">
			<div class="formRight">
            
            	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
                <input type="hidden" name="referer_link" id="id" value="index.php?com=product&act=man_list&typeparent=<?=$_GET['typeparent']?>" />
                <input type="submit" value="Hoàn tất" class="blueB" />
                <input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=product&act=man_list&typeparent=<?=$_GET['typeparent']?>'" class="blueB" />

			</div>
			<div class="clear"></div>
		</div>
	</div>
</form>



</div><!--end wrapper-->