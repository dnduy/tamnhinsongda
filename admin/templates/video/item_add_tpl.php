<div class="wrapper">
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	    <li><a href="index.php?com=video&act=man&typechild=<?=$_GET['typechild']?>&curPage=<?=$_REQUEST['curPage']?>"><span><?=$name_cap?></span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
    
    
</div><!--end control_frm-->



<form name="supplier" id="validate" class="form" action="index.php?com=video&act=save&typechild=<?=@$_GET['typechild']?>&curPage=<?=$_REQUEST['curPage']?>" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Nhập dữ liệu</h6>
		</div>		
       
    

	 <?php if ($image_active=="on") {?>       
             
        
      <div class="formRow">
			<label>Tải hình ảnh: </label>
			<div class="formRight">
            	 <?php if ($_REQUEST['act']=='edit' && $item['thumb']!='' ) { ?>
                <img src="<?php if($item['photo']!=NULL) echo _upload_video.$item['photo']; else echo 'images/no_image.jpg';?>"  alt="NO PHOTO" style="max-width:300px;" />
                 
                    <a class="delete_img_present" title="Xoá ảnh" onclick="Action_Delete_Img('index.php?com=video&act=save&typechild=<?=$_GET['typechild']?>&id=<?=@$item['id']?>&delete_img_present=delete_img');return false;">Xoá ảnh</a>
                    <br>
                    <?php }?>
                    
              <input type="file" id="file" name="file" /><img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình đại diện cho sản phẩm (ảnh JPEG, GIF , JPG , PNG)">  <?=$kichthuoc_image?>
                               
			</div>
			<div class="clear"></div>
		</div>
        
  <?php }?> 




  <?php if ($mutile_image_active=="on") {?>    
        
    <div class="themnhieuhinh">
        
        
        <div class="formRow">
      <label>Thêm Hình ảnh: </label>
      <div class="input_mutilfull">
          <a class="file_input" data-jfiler-name="files" data-jfiler-extensions="jpg, jpeg, png, gif"><i class="fa fa-paperclip"></i> Thêm Nhiều Hình ảnh</a>                
         <div style="text-align:center;"> <strong>(Nhập số thứ tự cho hình ảnh liên quan !!!) </strong></div>
      </div>
      <div class="clear"></div>
    </div>
         

		    <div class="clear"></div> 
    <?php if($act=='edit'){?>
      <?php if(count($list_hasp)!=0){?>

        <div class="formRow">
          <label>Hình ảnh liên quan: </label>
          <br />
          <div class="clear"></div> 
          
          <div class="formfull pagination_hasp">

          
           <div class="clear"></div>
        <?php for($i=0;$i<count($list_hasp);$i++){?>
              <div class="item_trich trich<?=$list_hasp[$i]['id']?>">
                  <img class="img_trich" width="100px" height="140px" src="<?=_upload_product.$list_hasp[$i]['photo']?>" />
                  <input type="text" id="stt_trich<?=$list_hasp[$i]['id']?>" value="<?=$list_hasp[$i]['stt']?>" onkeypress="return OnlyNumber(event)" class="tipS" onchange="return updateStthinh('hasp', '<?=$list_hasp[$i]['id']?>')" />
                <a href="javascript:void(0)" class="change_stt" rel="<?=$list_hasp[$i]['id']?>"><i class="fa fa-trash-o"></i></a>
                  <div id="loader<?=$list_hasp[$i]['id']?>" class="loader_trich"><img src="images/loader.gif" /></div>
              </div>
            <?php }?>
             <div class="clear"></div>
            
          </div>
          <div class="clear"></div>
        </div> 
      
    <?php }  }?>
        
        
        
        </div><!--end themnhieuhinh-->       
        <?php }?>
        


      <?php if ($link_active==on) {?>

        <div class="formRow">
            <label>Link Youtobe : </label>
            <div class="formRight">
                <input type="text" id="toado" name="link" value="<?=@$item['link']?>"  title="Nhập link" class="tipS link_active" />  <strong>Ex: https://www.youtube.com/watch?v=CsnlF9GSP1k</strong>
            </div>
            <div class="clear"></div>
        </div>    

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
			<label>Tiêu đề <?=$value?> </label>
			<div class="formRight">
				<input type="text" value="<?=@$item['ten_'.$value]?>" name="ten_<?=$value?>" title="Nội dung tiêu đề bài viết <?=$value?>" id="short" class="tipS validate[required]"   />
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
        
        
     
     <?php if ($noidung_active=="on") {?>            
        <div class="formRow">
			<label>Nội dung <?=$value?>: <img src="./images/question-button.png" alt="Chọn loại"  class="icon_que tipS" original-title="Viết nội dung chính"> </label>
            
           <div class="clear"></div>
			<div class="formRight-full"><textarea name="noidung_<?=$value?>" rows="8" cols="60"><?=@$item['noidung_'.$value]?></textarea>
			<script type="text/javascript">//<![CDATA[
            window.CKEDITOR_BASEPATH='ckeditor/';
            //]]></script>
            <script type="text/javascript" src="ckeditor/ckeditor.js?t=B5GJ5GG"></script>
            <script type="text/javascript">//<![CDATA[
            CKEDITOR.replace('noidung_<?=$value?>', {"width":<?=$config['ckeditor']['width']?>,"height":<?=$config['ckeditor']['height']?>,});
            //]]></script>
			</div><!--END formRight-full-->
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
            <input type="checkbox" name="is_index" id="check2"  <?=(!isset($item['is_index']) || $item['is_index']==1)?'checked="checked"':''?>/>
            <label for="check2">Index, Follow <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Check nếu bạn muốn Google không index danh mục này!" style="float:right; margin-top:0;" /></label>
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
      <label>Title <?=$value?></label>
      <div class="formRight">
        <input type="text" value="<?=@$item['title_'.$value]?>" name="title_<?=$value?>" title="Nội dung thẻ meta Title <?=$value?> dùng để SEO" class="tipS" />
      </div>
      <div class="clear"></div>
    </div>
        


      <div class="formRow">
      <label>Alt <?=$value?></label>
      <div class="formRight">
        <input type="text" value="<?=@$item['alt_'.$value]?>" name="alt_<?=$value?>" title="Nội dung thẻ meta Alt <?=$value?> dùng để SEO" class="tipS" />
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
      	<input type="hidden" name="referer_link" id="id" value="index.php?com=video&act=man&typechild=<?=$_GET['typechild']?>&curPage=<?=$_REQUEST['curPage']?>" />
      	<input type="submit" value="Lưu" class="blueB" />
      	<input type="button" value="Thoát" onclick="javascript:window.location='<?=$_SERVER['HTTP_REFERER']?>'" class="blueB" />

       
			</div>
			<div class="clear"></div>
		</div>
        
        
	</div>
</form>



</div>


<script type="text/javascript">


    function updateStthinh(table,id) {
      var num = jQuery('#stt_trich'+id).val();
	
      $('#loader'+id).css('display', 'block');
      jQuery.ajax({
        type: 'POST',
        url: baseurl + 'ajax/stt_hap.php?act=update',
        data: {'table':table, 'id':id, 'num':num},
        success: function(data) {
          $('#loader'+id).css('display', 'none');
          jQuery('#stt_trich'+id).val(num);
        }
      });
    }
    $(document).ready(function() {

 <?php if(count($list_hasp)>=13){?>
					
	$("div.pagination_hasp").quickPagination({pageSize:"13"});						   

	<?php }?>
							   
      $(".change_stt").click(function(event) {
          var r = confirm("Bạn có thực sự muốn xóa hình ảnh này ?");
          if (r == true) {
              var id=$(this).attr("rel");
              $('#loader'+id).css('display', 'block');
              jQuery.ajax({
                type: 'POST',
                url: baseurl + 'ajax/stt_hap.php?act=delete',
                data: {'table':'hasp', 'id':id},
                success: function(data) {
                  $('#loader'+id).css('display', 'none');
                  jQuery('.trich'+id).remove();
                }
              });
          } else {
              return false;
          }
          
      });
    });


</script>

<script type="text/javascript">
  $(document).ready(function() {
					 
    $('.file_input').filer({
            showThumbs: true,
            templates: {
                box: '<ul class="jFiler-item-list"></ul>',
                item: '<li class="jFiler-item">\
                            <div class="jFiler-item-container">\
                                <div class="jFiler-item-inner">\
                                    <div class="jFiler-item-thumb">\
                                        <div class="jFiler-item-status"></div>\
                                        <div class="jFiler-item-info">\
                                            <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                        </div>\
                                        {{fi-image}}\
                                    </div>\
                                    <div class="jFiler-item-assets jFiler-row">\
                                        <ul class="list-inline pull-left">\
                                            <li><span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span></li>\
                                        </ul>\
                                        <ul class="list-inline pull-right">\
                                            <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                        </ul>\
                                    </div>\<input type="text" name="stthinh[]" class="stthinh" />\
                                </div>\
                            </div>\
                        </li>',
                itemAppend: '<li class="jFiler-item">\
                            <div class="jFiler-item-container">\
                                <div class="jFiler-item-inner">\
                                    <div class="jFiler-item-thumb">\
                                        <div class="jFiler-item-status"></div>\
                                        <div class="jFiler-item-info">\
                                            <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                        </div>\
                                        {{fi-image}}\
                                    </div>\
                                    <div class="jFiler-item-assets jFiler-row">\
                                        <ul class="list-inline pull-left">\
                                            <span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span>\
                                        </ul>\
                                        <ul class="list-inline pull-right">\
                                            <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                        </ul>\
                                    </div>\<input type="text" name="stthinh[]" class="stthinh" />\
                                </div>\
                            </div>\
                        </li>',
                progressBar: '<div class="bar"></div>',
                itemAppendToEnd: true,
                removeConfirmation: true,
                _selectors: {
                    list: '.jFiler-item-list',
                    item: '.jFiler-item',
                    progressBar: '.bar',
                    remove: '.jFiler-item-trash-action',
                }
            },
            addMore: true
        });
  });
</script>