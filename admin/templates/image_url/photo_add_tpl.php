<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=image_url&typechild=<?=$_REQUEST['typechild']?>&act=man_photo"><span><?=$name_photo?></span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Thêm <?=$name_photo?></a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}	
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=image_url&typechild=<?=$_REQUEST['typechild']?>&act=save_photo" method="post" enctype="multipart/form-data">
	<div class="widget ">
    
    
   	
   <?php for($i=0; $i<5; $i++){?>

   <style type="text/css">


   #tabs_<?=$i?> {
    list-style: none;
    padding: 5px 0 4px 0;
    margin: 0 0 0 10px;
    font: 0.75em arial;
}
#tabs_<?=$i?> li {
    display: inline;
}
#tabs_<?=$i?> li a {
	font-size: 15px;
    border: 1px solid #ccc;
    padding: 4px 6px;
    text-decoration: none;
    background-color: #eeeeee;
    border-bottom: none;
    outline: none;
    border-radius: 5px 5px 0 0;
    -moz-border-radius: 5px 5px 0 0;
    -webkit-border-top-left-radius: 5px;
    -webkit-border-top-right-radius: 5px;
}
#tabs_<?=$i?> li a:hover {
    background-color: #dddddd;
    padding: 4px 6px;
}
#tabs_<?=$i?> li.active a {
    border-bottom: 1px solid #fff;
    background-color: #fff;
    padding: 4px 6px 5px 6px;
    border-bottom: none;
}
#tabs_<?=$i?> li.active a:hover {
    background-color: #eeeeee;
    padding: 4px 6px 5px 6px;
    border-bottom: none;
}
 
#tabs_<?=$i?> li a.icon_accept {
    background-image: url(accept.png);
    background-position: 5px;
    background-repeat: no-repeat;
    padding-left: 24px;
}
#tabs_<?=$i?> li a.icon_accept:hover {
    padding-left: 24px;
}
 

.tab_content_<?=$i?> {
    display: none;
}




   </style>

   <script language="javascript">
	
	$(document).ready(function(){
    //  When user clicks on tab, this code will be executed
    $("#tabs_<?=$i?> li").click(function() {
        //  First remove class "active" from currently active tab
        $("#tabs_<?=$i?> li").removeClass('active');
 
        //  Now add class "active" to the selected/clicked tab
        $(this).addClass("active");
 
        //  Hide all tab content
        $(".tab_content_<?=$i?>").hide();
 
        //  Here we get the href value of the selected tab
        var selected_tab = $(this).find("a").attr("href");
 
        //  Show the selected tab content
        $(selected_tab).fadeIn();
 
        //  At the end, we add return false so that the click on the link is not executed
        return false;
    });
	
	
	
	
});
</script>



        <div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6><?=$name_photo?> <?=$i?></h6>
		</div>




	<div class="tab_gaconit">      
        
    <div id="tabs_container">
    	
        <ul id="tabs_<?=$i?>">
           
           <?php foreach ($config["lang"] as $key => $value) {
            # code...
            $active='';
            if ($key==0)
            {
              $active="active";

            }

            echo '<li class="'.$active.'"><a href="#tab'.$value.''.$i.'">'.$config["langs"][$value].'</a></li>';

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
      
        <div id="tab<?=$value?><?=$i?>" class="tab_content_<?=$i?>" <?=$active_block?>>


      <div class="formRow">
			<label>Tiêu đề <?=$value?> </label>
			<div class="formRight">
				<input type="text" value="<?=@$item['ten_'.$value]?>" name="ten_<?=$value?><?=$i?>" title="Nội dung tiêu đề bài viết <?=$value?>" id="short" class="tipS"   />
			</div><!--end formRight-->
            
			<div class="clear"></div>           
		</div><!--end formRow-->



       <?php if ($mota_active=="on") {?>   
         <div class="formRow">
            <label>Mô tả <?=$value?> </label>
            <div class="formRight">
                <textarea rows="8" id="short" name="mota_<?=$value?><?=$i?>" title="Nội dung tiêu đề bài viết <?=$value?>"></textarea>
              
            </div><!--end formRight-->
            
            <div class="clear"></div>           
        </div><!--end formRow--> 
       <?php }?> 




		<div class="formRow">
			<label>Title <?=$value?> </label>
			<div class="formRight">
				<input type="text" value="<?=@$item['title_'.$value]?>" name="title_<?=$value?><?=$i?>" title="Title <?=$value?>" id="short" class="tipS"   />
			</div><!--end formRight-->
            
			<div class="clear"></div>           
		</div><!--end formRow-->



		<div class="formRow">
			<label>Alt <?=$value?> </label>
			<div class="formRight">
				<input type="text" value="<?=@$item['alt_'.$value]?>" name="alt_<?=$value?><?=$i?>" title="Alt <?=$value?>" id="short" class="tipS"   />
			</div><!--end formRight-->
            
			<div class="clear"></div>           
		</div><!--end formRow-->



    </div><!--tab_content-->
      
    <?php }?>  
  
    
     
    </div><!--end tabs_content_container-->
    
    
    </div><!--end tab_gaconit-->
        
                   

    <?php if ($link_active=="on") {?>

        <div class="formRow">
            <label>Link liên kết:</label>
            <div class="formRight">
                <input type="text" id="link" name="link<?=$i?>" value=""  title="Nhập link liên kết cho hình ảnh" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>

     <?php }?>   


        <?php if ($image_active==on) {?>

		<div class="formRow">
			<label>Tải hình ảnh:</label>
			<div class="formRight">
            <input type="file" id="file" name="file<?=$i?>"/>
				<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)"><?=$kichthuoc_image?>
			</div>
			<div class="clear"></div>
		</div>

		<?php }?>


        <div class="formRow">
          <label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
          <div class="formRight">           
            <input type="checkbox" name="hienthi<?=$i?>" id="check1" value="1" checked="checked" />
            <label for="check1">Hiển thị</label>           
          </div>
          <div class="clear"></div>
        </div>
        <div class="formRow">
            <label>Số thứ tự: </label>
            <div class="formRight">
                <input type="text" class="tipS" value="1" name="stt<?=$i?>" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của hình ảnh, chỉ nhập số">
            </div>
            <div class="clear"></div>
        </div>
		<?php } ?>
	<div class="formRow">
			<div class="formRight">

                
                <input type="submit" value="Lưu" class="blueB" />
	<input type="button" value="Thoát" onclick="javascript:window.location='<?=$_SERVER['HTTP_REFERER']?>'" class="blueB" />
                
			</div>
			<div class="clear"></div>
		</div>	
	</div>
   
	
</form>   