<link rel="stylesheet" href="css/style_form.css" />

 <!-- MultiUpload -->
<link href="js/multiupload/css/jquery.filer.css" type="text/css" rel="stylesheet" />
<link href="js/multiupload/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/multiupload/jquery.filer.min.js"></script>
<script type="text/javascript" src="js/my_script_check_form.js"></script>
<script language="javascript">

function js_sub_dangky(){
	

	if(isEmpty(document.getElementById('hoten'), "Họ và Tên")){
		document.getElementById('hoten').focus();
		return false;
	}
	
	
	if(!check_email(document.frm_nhanhd.email.value)){
		alert("<?=_emailError1?>");
		document.frm_nhanhd.email.focus();
		return false;
	  }
	  
	  
	  if(isEmpty(document.getElementById('sodienthoai'), "<?=_phoneError?>")){
		document.getElementById('sodienthoai').focus();
		return false;
	  }
	  
	  
	  if(!isNumber(document.getElementById('sodienthoai'), "<?=_phoneError1?>")){
		document.getElementById('sodienthoai').focus();
		return false;
	  }
	


	document.frm_nhanhd.submit();
}
</script>
<div id="main_content_web">


<ul class="breadcrumb">

<li><a href="index.html" class="transitionAll"><?=_trangchu?></a> </li>

<li><a href="<?=$com?>.html" class="transitionAll"><?=_nhanhopdong?></a></li>




</ul><!--end breadcrumb-->
	


    <div class="clear"></div>


<div class="block_content">



    <div class="clear"></div>
    
    <div class="show-pro">



      
           <div class="chitiettin_nhanhd"><?=$noidung_info?></div>
           <div class="clear"></div>
		   
		   
		   
		   
		   <form method="post" name="frm_nhanhd" action="" enctype="multipart/form-data">
		  
		  
			
			<div class="thongtin_khachhang">
			
					<h4>Thông Tin Nhận Hợp Đồng</h4>
					
				<div class="info-input">
						
						
				<fieldset class="form-group col-lg-4 col-md-4  col-sm-6 col-xs-12">
       
				<label for="hoten" class="label_font"><span>*</span> Họ và tên </label>
				  
				  
				 <input type="text" name="hoten" id="hoten"   class="keycode form-control" />
					
				
				</fieldset>
				
				
				
				
				
				
				<fieldset class="form-group col-lg-4 col-md-4  col-sm-6 col-xs-12">
       
				<label for="sodienthoai" class="label_font"><span>*</span> Số điện thoại </label>
				  
				  
				 <input type="text" name="sodienthoai" id="sodienthoai"   class="keycode form-control" />
					
				
				</fieldset>
				
				
				
				<fieldset class="form-group col-lg-4 col-md-4  col-sm-6 col-xs-12">
       
				<label for="email" class="label_font"><span>*</span>Email </label>
				  
				  
				 <input type="text" name="email" id="email"   class="keycode form-control" />
					
				
				</fieldset>
				
				<div class="clear"></div>
				
				

				
				<fieldset class="form-group col-lg-6 col-md-6  col-sm-6 col-xs-12">
       
				<label for="diachi" class="label_font"> Địa chỉ </label>
				  
				  
				 <input type="text" name="diachi" id="diachi"   class="keycode form-control" />
					
				
				</fieldset>
				
	
				
				
				
				<fieldset class="form-group col-lg-6 col-md-6  col-sm-6 col-xs-12">
       
				<label for="soluong" class="label_font"> Số lượng </label>
				  
				  
				 <input type="text" name="soluong" id="soluong"   class="keycode form-control" />
					
				
				</fieldset>
				
				<div class="clear"></div>
				
				
				
			
						
				
				<div class="clear"></div>
				
				</div><!--end info-input-->	
			
			</div><!--end thongtin_khachhang-->
			
			
			
			
			 
            <div class="row_upload_file">
                    
                   <label>File đính kèm</label> 
                       
                <span id="ctl32_ctl01_FileServer2">
                
               
               <div class="upload_files">
                
                <div class="image-wapper-des">
                         
                         <div>Click vào dấu cộng ở trên để up File</div>
                         
                          <p>   
                            <span class="description-create-form">(giới hạn kích thước mỗi file là: 200MB) </span>
                          </p> 
                
                 </div><!--end image-wapper-des-->
                            
                 <div class="image-wapper-take">

                   
                   
                  <a class="file_input" data-jfiler-name="files" >  <i class="fa fa-camera camera-add-image"></i><i class="fa fa-plus-circle plus-add-image"></i></a>   
                   
  
             
             </div><!--end image-wapper-take-->          

                 
                 </div><!--end upload_files-->
                 
			</span>
           </div>
			
			
			
			
			
			<fieldset class="form-group" style="float:none;margin:0 auto; ">
       
				<div class="btn-send-reset">
				
					  <input class="button" type="button" value="Gửi" onclick="js_sub_dangky();" />
					<input class="button" type="button" value="Nhập lại" onclick="document.frm.reset();"  />

				</div><!--end btn-send-reset-->	
	   
				

			</fieldset>
		  
		
	 
	 
	 
	</form>
           
		   
		   
		   
           
          
    </div><!--end show-pro-->
    
 </div><!--end block_content-->
 
 </div><!--end main_content_web-->

<script type="text/javascript">

	$(document).ready(function(){
							   
							   
		$('.file_input').filer({
            showThumbs: true,
			limit :16,
			maxSize:124,
		
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
                                    </div>\
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
                                    </div>\
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
            addMore: true,
        });

	})

    </script>

