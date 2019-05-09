<?php
error_reporting(0);
	session_start();
	$session=session_id();
	
	@define ( '_template' , '../templates/');
	@define ( '_source' , '../sources/');
	@define ( '_lib' , '../libraries/');
	@define ( _upload_folder , '../media/upload/' );
	
	//Lưu ngôn ngữ chọn vào $_SESSION
	$lang_arr=array("vi","en","ge");
	if (isset($_GET['lang']) == true){
        if (in_array($_GET['lang'], $lang_arr)==true){
            $lang = $_GET['lang'];
            $_SESSION['lang']=$lang;
		  header('Location: '.$_SERVER['HTTP_REFERER']);
        } 
	}
    if(isset($_SESSION['lang'])){
        $lang= $_SESSION['lang'];
    }else{
        $lang="vi";
    }
	require_once _source."lang_$lang.php";	

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	
	include_once _lib."library.php";
	include_once _lib."class.database.php";	
	
	include_once _lib."file_requick.php";
	$d = new database($config['database']);
	
	$d->reset();
	$sql = "select ten_vi,tenkhongdau,id from #_news where hienthi=1 and com='reportspam'  order by id desc";
	$d->query($sql);
	$reportspam_info = $d->result_array();
	
	$id = $_GET['id'];
	
?>


<script type="text/javascript">
$(document).ready(function() { 

	 $('.send_reportspam').click(function() {  
			
			
			var idval= <?=$id?>;

			var codeval= $('#captcha-code').val();
			
			

		var id_loaivipham = $("input[name='reportspam[]']:checked").val();
	
			// name validation
			var ContentVal = $("#txtContent").val();
			if(ContentVal == '') 
			{
				$("#Content_error").html('');
				$("#txtContent").after('<div class="error" id="Content_error"><b class=images_error>Xin nhập họ tên.</b></div>');
				$("#txtContent").focus();
				return false
			}
			else
			{
				$("#Content_error").html('');
			}

			$.ajax({
				url:"ajax/ajax_reportspam.php",
				type:"POST",
				data:{id:idval,code:codeval,noidung:ContentVal,id_loaivipham:id_loaivipham},
				async:true,
				dataType:"text",
				success:function(response){
					//alert(response);
					if(response==1){//them thanh cong
						$("#after_submit").html('');
						$(".send_reportspam").after(function() {
                            $(".customNotify").jmNotify({
								html: 'Báo cáo vi phạm thành công !',
								delay:1000,
								onClose:redirect()
							});	
                        });
					
						change_captcha();
						clear_form();
					}else if(response==3){ // insert ko thanh cong
						$("#after_submit").html('');
						$(".send_reportspam").after(function() {
                            $(".customNotify").jmNotify({
								html: 'Có lỗi xảy ra ! Vui lòng quay lại sau !'
							});	
                        });
						
						change_captcha();
						clear_form();
					}
					else{
						$("#after_submit").html('');
						$(".send_reportspam").after(function() {
                            $(".customNotify").jmNotify({
								html: 'Lỗi ! Nhập mã captcha sai!'
							});	
                        });
						
						$("#captcha-code").focus();
					}
				}
			})
			
		return false;
	 });
	 // refresh captcha
	 $('img#captcha-refresh').click(function() {  		
			change_captcha();
	 });
	 function change_captcha(){
		document.getElementById('captcha').src="ajax/check_captcha/get_captcha.php?rnd=" + Math.random();
	 }

	 
	 function clear_form(){
		$("#txtContent").val('');
		$("#captcha-code").val('');
		
	 }
	 function redirect(){
		window.setTimeout(function () {
			<?php
				if(isset($_SESSION['duongdandangnhap']) && $_SESSION['duongdandangnhap']!=""){ ?>
				location.href = "<?=$_SESSION['duongdandangnhap']?>";
			<?php	}else{ ?>
			
				location.href = "javascript:history.go(0);";
			<?php } ?>
		}, 1000)
	 }
});	
</script>

<form action="" name="frm_reportspam" id="frm_reportspam" method="post">  
<div class="Cost report">

<?php echo $ida; ?>
    <div class="title">BÁO CÁO VI PHẠM</div>
    <div class="content">
        <div class="rowitem">
            <label>Tin rao có các thông tin không đúng:</label>
        </div>


		<?php for ($i=0;$i<count($reportspam_info);$i++) {?>
            <div class="rowitem">
                <input type="checkbox" name="reportspam[]" value="<?=$reportspam_info[$i]["id"]?>">
                <label><?=$reportspam_info[$i]["ten_$lang"]?></label>
            </div>
       <?php }?>    


        <div class="rowitem row-item-margin-top">
            <label>Ý kiến của bạn</label>
        </div>

        <div class="rowitem">
            <textarea name="Content" id="txtContent"></textarea>
        </div>



     
        
      <div class="rowitem">
              
              
           <div class="control-group">
	
                        
            <div class="form-field" style="margin:0; padding:0;" >
                
                <div class="captcha-introduce">
                    
                    <div class="captcha-box-introduce">
                    
                     <img src="images/login_resity/refresh.jpg"  alt="" id="captcha-refresh" />
                        <img src="ajax/check_captcha/get_captcha.php" alt="" id="captcha" />
                        
                        <div class="clear"></div>
                         
                    </div><!--end captcha-box-introduce-->
                    
                    <div class="text-box">
                      <?php /*?>  <p>Type the two words:</p><?php */?>
                        <input name="captcha-code" type="text" id="captcha-code" />
                        
                        <div class="clear"></div>
                        
                    </div><!--end text-box-->
                    
                    <div class="clear"></div>
                 
                </div><!--end captcha-introduce-->
                
            </div><!--end form-field-->
    					
		</div><!--end control-group-->   
                
                        
      </div><!--end rowitem-->
        
	

        <div class="rowitem" style="margin-top:10px ;">
        
            <label>&nbsp;</label>
            <input type="button" id="btnSend" class="btn send_reportspam" value="GỬI">
        </div>

        <div class="clear"></div>
    </div>
</div><!--end Cost report-->
</form>