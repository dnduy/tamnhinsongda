<script type="text/javascript">	
	
	function TreeFilterChanged2(){
		
				$('#validate').submit();
		
	}
</script>
<div class="wrapper">
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=lkweb&act=man"><span>Liên kết website</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<form name="supplier" id="validate" class="form" action="index.php?com=lkweb&act=save" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Nhập dữ liệu</h6>
		</div>		
        
        
        
        <div class="tab_gaconit">      
        
    <div id="tabs_container">
    	
        <ul id="tabs">
            <li class="active"><a href="#tab1">Tiếng Việt</a></li>
            <li><a href="#tab2">Tiếng Anh</a></li>
         
        </ul><!--tabs-->
	</div><!--tabs_container-->
    
    
    <div id="tabs_content_container">
      
        <div id="tab1" class="tab_content" style="display:block">

         <div class="formRow">
			<label>Tiêu đề VI</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['ten_vi']?>" name="ten_vi" title="Nội dung tiêu đề VI" class="tipS" />
			</div><!--end formRight-->
            
			<div class="clear"></div>           
		</div><!--end formRow-->
        

        </div><!--tab_content-->
      
        <div id="tab2" class="tab_content">


			
              
       <div class="formRow">
			<label>Tiêu đề EN</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['ten_en']?>" name="ten_en" title="Nội dung tiêu EN" class="tipS" />
			</div><!--end formRight-->
            
			<div class="clear"></div>           
		</div><!--end formRow-->
       
        
        

        </div><!--tab_content-->
     
    </div><!--end tabs_content_container-->
    
    
    </div><!--end tab_gaconit-->
        
        
        
        
		
        <div class="formRow">
			<label>Link</label>
			<div class="formRight">
                <input type="text" name="url" title="Nhập link website" id="url" class="tipS validate[required]" value="<?=@$item['url']?>" />
			</div>
			<div class="clear"></div>
		</div>
       
        
		
        <div class="formRow">
          <label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
          <div class="formRight">
           
            <input type="checkbox" name="active" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
            <label for="check1">Hiển thị</label>            
          </div>
          <div class="clear"></div>
        </div>
        <div class="formRow">
            <label>Số thứ tự: </label>
            <div class="formRight">
                <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="num" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
            </div>
            <div class="clear"></div>
        </div>
		
		
		<div class="formRow">
			<div class="formRight">
                 <input type="hidden" name="id" id="id_this_lkweb" value="<?=@$item['id']?>" />
            	<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
			</div>
			<div class="clear"></div>
		</div>
		
	</div>  
	
</form>        </div>