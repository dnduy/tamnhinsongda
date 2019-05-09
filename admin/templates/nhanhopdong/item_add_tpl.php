<div class="wrapper">
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=nhanhopdong&act=man"><span>Xem Nhận hợp đồng</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
    
    
</div><!--end control_frm-->



<form name="supplier" id="validate" class="form" action="index.php?com=nhanhopdong&act=save" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Nhập dữ liệu</h6>
		</div>		


		 
		
        
        <div class="formRow">
			<label>Họ và Tên</label>
			<div class="formRight">
                <input type="text" name="hoten" title="Nhập họ tên" id="name" class="tipS validate[required]" value="<?=@$item['hoten']?>" />
			</div>
			<div class="clear"></div>
		</div>
        
        
          <div class="formRow">
			<label>Email</label>
			<div class="formRight">
            <input type="text" name="email" title="Email" id="name" class="tipS validate[required]" value="<?=@$item['email']?>" />
			</div>
			<div class="clear"></div>
		</div>
        
        
          <div class="formRow">
			<label>Điện thoại</label>
            
			<div class="formRight">
				<input type="text" value="<?=@$item['sodienthoai']?>" name="sodienthoai" title="Điện thoại" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		
		
		
		<div class="formRow">
			<label>Số lượng</label>
            
			<div class="formRight">
				<input type="text" value="<?=@$item['soluong']?>" name="soluong" title="Số lượng" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
        
        
        
        <div class="formRow">
			<label>Địa chỉ</label>
            
			<div class="formRight">
				<textarea rows="8" cols="" title="Nội dung"  name="diachi" id="short"><?=@$item['diachi']?></textarea>
			</div>
			<div class="clear"></div>
		</div>
        
        
		
		
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
                  <img class="img_trich" width="100px" height="140px" src="<?=_upload_hinhanh.$list_hasp[$i]['photo']?>" />
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
            
            
            <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="blueB" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=nhanhopdong&act=man'" class="blueB" />
            
            
			</div>
			<div class="clear"></div>
		</div>	
		
		
	</div>  
	
</form>



</div><!--end wrapper-->




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