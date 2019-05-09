<div class="wrapper">
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	    <li><a href="index.php?com=lang_define&act=man&curPage=<?=$_REQUEST['curPage']?>"><span>Ngôn Ngữ</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
    
    
</div><!--end control_frm-->



<form name="supplier" id="validate" class="form" action="index.php?com=lang_define&act=save&curPage=<?=$_REQUEST['curPage']?>" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Nhập dữ liệu</h6>
		</div>		
       

        
        <div class="tab_gaconit">      
        
    <div id="tabs_container">
    	
        <ul id="tabs">
		
		<li class="active"><a href="#tabname">Tên biến</a></li>
           <?php foreach ($config["lang"] as $key => $value) {
            # code...
            $active='';
            if ($key==0)
            {
              $active="active_2";

            }

            echo '<li class="'.$active.'"><a href="#tab'.$value.'">'.$config["langs"][$value].'</a></li>';

          }?>
          
         
        </ul><!--tabs-->
	</div><!--tabs_container-->
    
    
    <div id="tabs_content_container">
	
	
		 <div id="tabname" class="tab_content" style='display:block;'>
		
		
		
      <div class="formRow">
			<label>Tên Biến </label>
			<div class="formRight">
				<input type="text" value="<?=@$item['ten']?>" name="ten" title="Nội dung tiêu đề bài viết" id="short" class="tipS validate[required]"   />
			</div><!--end formRight-->
            
			<div class="clear"></div>           
		</div><!--end formRow-->


    
    

    </div><!--tab_content-->
      
        
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
			<label>Tên Lang <?=$value?> </label>
			<div class="formRight">
				<input type="text" value="<?=@$item['lang_'.$value]?>" name="lang_<?=$value?>" title="Nội dung tiêu đề bài viết <?=$value?>" id="short" class="tipS validate[required]"   />
			</div><!--end formRight-->
            
			<div class="clear"></div>           
		</div><!--end formRow-->


    
    

    </div><!--tab_content-->
      
    <?php }?>  


    </div><!--end tabs_content_container-->
    
    
    </div><!--end tab_gaconit-->
        
		
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
                <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
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



</div>

