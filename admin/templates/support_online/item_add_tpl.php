<script type="text/javascript">	
	
	function TreeFilterChanged2(){
		
	$('#validate').submit();
		
	}
</script>
<div class="wrapper">
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=support_online&act=man&typechild=<?=$_GET['typechild']?>"><span>Hỗ trợ trực tuyến</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<form name="supplier" id="validate" class="form" action="index.php?com=support_online&act=save&typechild=<?=$_GET["typechild"]?>" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Nhập dữ liệu</h6>
		</div>		


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
				<input type="text" value="<?=@$item['ten_'.$value]?>" name="ten_<?=$value?>" title="Nội dung tiêu đề bài viết <?=$value?>" id="ten_<?=$value?>"    />
			</div><!--end formRight-->
            
			<div class="clear"></div>           
		</div><!--end formRow-->


    

    </div><!--tab_content-->
      
    <?php }?>  


    </div><!--end tabs_content_container-->
    
    
    </div><!--end tab_gaconit-->
   
		
        <div class="formRow">
			<label>Điện thoại</label>
			<div class="formRight">
                <input type="text" name="dienthoai" title="Nhập số điện thoại" id="dienthoai"  value="<?=@$item['dienthoai']?>" />
			</div>
			<div class="clear"></div>
		</div>
		
        <div class="formRow">
			<label>Email</label>
			<div class="formRight">
                <input type="text" name="email" title="Nhập địa chỉ email" id="email" value="<?=@$item['email']?>" />
			</div>
			<div class="clear"></div>
		</div>
		
		
		 <div class="formRow">
			<label>Skype</label>
			<div class="formRight">
                <input type="text" name="skype" title="Nhập nick chat skype" id="skype"  value="<?=@$item['skype']?>" />
			</div>
			<div class="clear"></div>
		</div>
        
	<?php /*?>
		<div class="formRow">
			<label>Yahoo</label>
			<div class="formRight">
                <input type="text" name="yahoo" title="Nhập nick chat yahoo" id="yahoo" class="tipS validate[required]" value="<?=@$item['yahoo']?>" />
			</div>
			<div class="clear"></div>
		</div>

		<?php */?>	

     <div class="formRow">
      <label>Phone </label>
      <div class="formRight">
                <input type="text" name="zalo" title="Nhập phone zalo" id="zalo"  value="<?=@$item['zalo']?>" />
      </div>
      <div class="clear"></div>
    </div>
		     
        
		
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
                 <input type="hidden" name="id" id="id_this_support_online" value="<?=@$item['id']?>" />
            	<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
			</div>
			<div class="clear"></div>
		</div>
		
	</div>  
	
</form>        </div>