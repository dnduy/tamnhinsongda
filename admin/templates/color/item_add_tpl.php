<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a ><span>Cập nhật màu nền</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Cập nhật</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}	
</script>



<form name="frm" method="post" action="index.php?com=color&act=save" enctype="multipart/form-data" class="nhaplieu">		
<script type="text/javascript" src="js/jquery.miniColors.js"></script>
<link type="text/css" rel="stylesheet" href="css/jquery.miniColors.css" />
<script type="text/javascript">
	$(document).ready( function() {
		$(".color-picker").miniColors({
			letterCase: 'uppercase',
			change: function(hex, rgb) {
				logData('change', hex, rgb);
			},
			open: function(hex, rgb) {
				logData('open', hex, rgb);
			},
			close: function(hex, rgb) {
				logData('close', hex, rgb);
			}
		});
		
				function logData(type, hex, rgb) {
					$("#console").prepend(type + ': HEX = ' + hex + ', RGB = (' + rgb.r + ', ' + rgb.g + ', ' + rgb.b + ')<br />');
				}
				
				$("#disable").click( function() {
					$("#console").prepend('disable<br />');
					$(".color-picker").miniColors('disabled', true);
					$("#disable").prop('disabled', true);
					$("#enable").prop('disabled', false);
				});
				
				$("#enable").click( function() {
					$("#console").prepend('enable<br />');
					$(".color-picker").miniColors('disabled', false);
					$("#disable").prop('disabled', false);
					$("#enable").prop('disabled', true);
				});
				
				$("#makeReadonly").click( function() {
					$("#console").prepend('readonly = true<br />');
					$(".color-picker").miniColors('readonly', true);
					$("#unmakeReadonly").prop('disabled', false);
					$("#makeReadonly").prop('disabled', true);
				});
				
				$("#unmakeReadonly").click( function() {
					$("#console").prepend('readonly = false<br />');
					$(".color-picker").miniColors('readonly', false);
					$("#unmakeReadonly").prop('disabled', true);
					$("#makeReadonly").prop('disabled', false);
				});
				
				$("#destroy").click( function() {
					$("#console").prepend('destroy<br />');
					$(".color-picker").miniColors('destroy');
					$("INPUT[type=button]:not(#create)").prop('disabled', true);
					$("#destroy").prop('disabled', true);
					$("#create").prop('disabled', false);
				});
				
				$("#create").click( function() {
					$("#console").prepend('create<br />');
					$(".color-picker").miniColors({
						letterCase: 'uppercase',
						change: function(hex, rgb) {
							logData(hex, rgb);
						}
					});
					$("#makeReadonly, #disable, #destroy, #randomize").prop('disabled', false);
					$("#destroy").prop('disabled', false);
					$("#create").prop('disabled', true);
				});
				
				$("#randomize").click( function() {
					$(".color-picker").miniColors('value', '#' + Math.floor(Math.random() * 16777215).toString(16));
				});
				
			});
		</script>
        
        
    <div class="widget">
    
    	<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Nhập dữ liệu</h6>
		</div><!--end title-->
        
        <div class="formRow">
        
        <label>Màu nền</label>
        
        <div class="formRight">
				<input type="text" name="color1" id="color1" class="color-picker" size="6" value="<?=@$item['nenbackground']?>" />
                
                 
			</div>
			<div class="clear"></div>

     
        
        </div><!--end formRow-->
        
        
        
        
         <div class="formRow">
        
        <label>Chọn ảnh</label>
        
        <div class="formRight">
        
         <?php
		 	if($item['photo']!=''){
		?>
        <b>&nbsp;</b><img src="<?=_upload_color.$item['photo']?>" width="150" height="150" /><br /><br>
        <b>&nbsp;</b><input type="checkbox" name="chonbg"  value="1" <?php if($item['chonbg']==1) echo 'checked="checked"'; ?> /> <em>Sử dụng hình nền</em><br /><br />
        <?php
			}else{
				echo '<b>&nbsp;</b>Chưa có hình nền <br /><br />';	
			}
		 ?>
        
          <input type="file" name="file" />&nbsp;Width: 1366px - Height: 768px jpg|png|gif
				
			</div>
			<div class="clear"></div>

     
        
        </div><!--end formRow-->
        
        
        
        
        
        
        
         <div class="formRow">
        
        <label>Lặp</label>
        
        <div class="formRight">
			
         <select name="repeat">
         	<option value="0"<?php if($item['repeat1']==0) echo ' selected="selected"'; ?>>Repeat</option>
            <option value="1"<?php if($item['repeat1']==1) echo ' selected="selected"'; ?>>Repeat-x</option>
            <option value="2"<?php if($item['repeat1']==2) echo ' selected="selected"'; ?>>Repeat-y</option>
            <option value="3"<?php if($item['repeat1']==3) echo ' selected="selected"'; ?>>No-repeat</option>
         </select>
            
		</div><!--end formRight-->
		
        <div class="clear"></div>
                
        </div><!--end formRow-->
        
        
        
        
       <div class="formRow">
        
        <label>Vị trí 1</label>
        
        <div class="formRight">
			
          <select name="vitri">
         	<option value="0"<?php if($item['vitri']==0) echo ' selected="selected"'; ?>>Chọn vị trí 1</option>
            <option value="1"<?php if($item['vitri']==1) echo ' selected="selected"'; ?>>Top</option>
            <option value="2"<?php if($item['vitri']==2) echo ' selected="selected"'; ?>>Right</option>
            <option value="3"<?php if($item['vitri']==3) echo ' selected="selected"'; ?>>Bottom</option>
            <option value="4"<?php if($item['vitri']==4) echo ' selected="selected"'; ?>>Left</option>
            <option value="5"<?php if($item['vitri']==5) echo ' selected="selected"'; ?>>Center</option>
         </select>
            
		</div><!--end formRight-->
		
        <div class="clear"></div>
                
        </div><!--end formRow-->
    
    
    	
        
        <div class="formRow">
        
        <label>Vị trí 2</label>
        
        <div class="formRight">
			
         <select name="vitri1">
         	<option value="0"<?php if($item['vitri1']==0) echo ' selected="selected"'; ?>>Chọn vị trí 2</option>
            <option value="1"<?php if($item['vitri1']==1) echo ' selected="selected"'; ?>>Top</option>
            <option value="2"<?php if($item['vitri1']==2) echo ' selected="selected"'; ?>>Right</option>
            <option value="3"<?php if($item['vitri1']==3) echo ' selected="selected"'; ?>>Bottom</option>
            <option value="4"<?php if($item['vitri1']==4) echo ' selected="selected"'; ?>>Left</option>
            <option value="5"<?php if($item['vitri1']==5) echo ' selected="selected"'; ?>>Center</option>
         </select>
            
		</div><!--end formRight-->
		
        <div class="clear"></div>
                
        </div><!--end formRow-->
        
        
        
        
         <div class="formRow">
        
        <label>Fixed</label>
        
        <div class="formRight">
			
        <select name="fixed">
         	<option value="0"<?php if($item['fixed']==0) echo ' selected="selected"'; ?>>No fixed</option>
            <option value="1"<?php if($item['fixed']==1) echo ' selected="selected"'; ?>>Fixed</option>
         </select>
            
		</div><!--end formRight-->
		
        <div class="clear"></div>
                
        </div><!--end formRow-->
        
        
        <div class="formRow">
			<div class="formRight">
               	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn" />
			</div>
			<div class="clear"></div>
		</div>
    
    
    	
    
    </div><!--end widget-->    
        
		
</form>   

