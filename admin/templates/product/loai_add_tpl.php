<script language="javascript">				
	function select_onchange1()
	{				
		var a=document.getElementById("id_list");
		window.location ="index.php?com=product&typeparent=<?=$_GET['typeparent']?>&act=<?php if($_REQUEST['act']=='edit_item') echo 'edit_item'; else echo 'add_item';?><?php if($_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>&id_list="+a.value;	
		return true;
	}

	
</script>

<?php
function get_main_list()
	{
		$sql="select ten_vi,id from table_product_list where com='$_GET[typeparent]'  order by stt asc ";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_list" name="id_list" onchange="select_onchange1()" class="main_font">
			<option value="">Danh mục cấp 1</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==$_REQUEST['id_list'])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
function get_main_cat()
	{
		$sql="select ten_vi,id from table_product_cat where id_list='$_GET[id_list]' and com='$_GET[typeparent]' order by stt asc";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_cat" name="id_cat"  class="main_font">
			<option value="">Danh mục cấp 2</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==$_REQUEST['id_cat'])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}

?>



<div class="wrapper">
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=product&act=man_item&typeparent=<?=$_GET['typeparent']?>"><span><?=$name_cap?></span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
    
    
</div><!--end control_frm-->



<form name="supplier" id="validate" class="form" action="index.php?com=product&act=save_item&typeparent=<?=$_GET['typeparent']?>&curPage=<?=$_REQUEST['curPage']?>" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Nhập dữ liệu</h6>
		</div>		
        

        <div class="formRow">
			<label>Danh mục cấp 1</label>
			<div class="formRight">
            	<div class="selector">
					<?=get_main_list();?>
                </div>
			</div>
			<div class="clear"></div>
		</div>
        
        
        <div class="formRow">
			<label>Danh mục cấp 2</label>
			<div class="formRight">
            	<div class="selector">
					<?=get_main_cat();?>
                </div>
			</div>
			<div class="clear"></div>
		</div>


	<?php if ($image_active=="on") {?>      
     <div class="formRow" >
			<label>Hình ảnh hiện tại:</label>
			<div class="formRight">
            	
      <?php if ($_REQUEST['act']=='edit_item' && $item['thumb']!='')
        {?>
        <img src="<?php if($item['photo']!=NULL) echo _upload_product_item.$item['photo']; else echo 'images/no_image.jpg';?>"  alt="NO PHOTO" style="max-width:300px;" />
        
         <a class="delete_img_present" title="Xoá ảnh" onclick="Action_Delete_Img('index.php?com=product&act=save_item&typeparent=<?=$_GET['typeparent']?>&id=<?=@$item['id']?>&delete_img_present=delete_img');return false;">Xoá ảnh</a>
                    
        <br>
        
        <?php }?>
        
     		<input type="file" id="file" name="file" />
				<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình đại diện cho sản phẩm (ảnh JPEG, GIF , JPG , PNG)"> <?=$kichthuoc_image?>
			</div>
			<div class="clear"></div>
		</div><!--end formRow-->
    <?php }?>	
        
		
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
			<label>Tiêu đề <?=$value?></label>
			<div class="formRight">
				<input type="text" value="<?=@$item['ten_'.$value]?>" name="ten_<?=$value?>" title="Nội dung tiêu đề <?=$value?> bài viết" class="tipS" />
			</div><!--end formRight-->
            
			<div class="clear"></div>           
		</div><!--end formRow-->
		
		
		
		<div class="formRow">
			<label>Nội Dung <?=$value?>: <img src="./images/question-button.png" alt="Chọn loại"  class="icon_que tipS" original-title="Viết nội dung chính"> </label>
            
           <div class="clear"></div>
			<div class="formRight-full">
			
		<textarea class="editor" name="noidung_<?=$value?>" id="noidung_<?=$value?>" rows="8" cols="60"><?=@$item['noidung_'.$value]?></textarea>
	
			</div><!--END formRight-full-->
			<div class="clear"></div>
		</div><!--end formRow-->
        


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
    			# code...
    			$active='';
    			if ($key==0)
    			{
    				$active="active";
    			}

    			echo '<li class="'.$active.'"><a href="#tab'.$value.'_seo">'.$config["langs"][$value].'</a></li>';

    		} ?>	

         
        </ul><!--tabs_seo-->
	</div><!--tabs_container-->
    
    
    
       <div id="tabs_seo_content_container">


    <?php foreach ($config["lang"] as $key => $value) {
    	# code...
    	$active_block='';
    	if ($key==0)
    	{

    		$active_block="style='display:block;'";

    	}
     ?>   	
      
        <div id="tab<?=$value?>_seo" class="tab_seo_content" <?=$active_block?>>
        
        
        <div class="formRow">
			<label>H1 <?=$value?></label>
			<div class="formRight">
				<input type="text" value="<?=@$item['h1_'.$value]?>" name="h1_<?=$value?>" title="Nội dung thẻ meta h1 <?=$value?> dùng để SEO" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
        
        
        <div class="formRow">
			<label>H2 <?=$value?></label>
			<div class="formRight">
		<input type="text" value="<?=@$item['h2_'.$value]?>" name="h2_<?=$value?>" title="Nội dung thẻ meta h2 <?=$value?> dùng để SEO" class="tipS" />
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
				<input type="text" value="<?=@$item['title_'.$value]?>" name="title_<?=$value?>" title="Nội dung thẻ meta Title <?=$value?> dùng để SEO" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		
		
		


		<div class="formRow">
			<label>Alt <?=$value?></label>
			<div class="formRight">
				<input type="text" value="<?=@$item['alt_'.$value]?>" name="alt_<?=$value?>" title="Nội dung thẻ meta alt <?=$value?> dùng để SEO" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
        
        
        
        <div class="formRow">
			<label>Từ khóa <?=$value?></label>
			<div class="formRight">
				<input type="text" value="<?=@$item['keyword_'.$value]?>" name="keyword_<?=$value?>" title="Từ khóa chính VI cho sản phẩm" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
        
        
        
        <div class="formRow">
			<label>Description <?=$value?>:</label>
			<div class="formRight">
				<textarea rows="8" cols="" title="Nội dung thẻ meta Description <?=$value?> dùng để SEO" class="tipS" name="description_<?=$value?>"><?=@$item['description_'.$value]?></textarea>
                <input readonly="readonly" type="text" style="width:25px; margin-top:10px; text-align:center;" name="deschar_<?=$value?>" value="<?=@$item['deschar_'.$value]?>" /> ký tự <b>(Tốt nhất là 160 ký tự)</b>
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
	<input type="hidden" name="referer_link" id="id" value="index.php?com=product&act=man_item&typeparent=<?=$_GET['typeparent']?>&curPage=<?=$_REQUEST['curPage']?>" />
	<input type="submit" value="Lưu" class="blueB" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=product&act=man_item&typeparent=<?=$_GET['typeparent']?>&curPage=<?=$_REQUEST['curPage']?>'" class="blueB" />
            
            

			</div>
			<div class="clear"></div>
		</div>
	</div>
</form>

</div><!--end wrapper-->
