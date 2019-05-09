<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=quangcaobody&act=man_photo"><span>Quảng cáo 2 bên</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>


<script language="javascript">
	function CheckDelete(l){
		if(confirm('Bạn có chắc muốn xóa hình ảnh này?'))
		{
			location.href = l;	
		}
	}	
	function ChangeAction(str){
		if(confirm("Bạn có chắc chắn?"))
		{
			document.f.action = str;
			document.f.submit();
		}
	}							
</script>


<form name="f" id="f" method="post">
<div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
   

    	<input  class="hidden-an"  type="button" class="blueB" value="Thêm" onclick="location.href='index.php?com=quangcaobody&act=add_photo'" />
    
 
        
        <input type="button" class="blueB" value="Hiện" onclick="ChangeAction('index.php?com=quangcaobody&act=man_photo&multi=show');return false;" />
        <input type="button" class="blueB" value="Ẩn" onclick="ChangeAction('index.php?com=quangcaobody&act=man_photo&multi=hide');return false;" />
      

        <input class="hidden-an"  type="button" class="blueB" value="Xoá" onclick="ChangeAction('index.php?com=quangcaobody&act=man_photo&multi=del');return false;" />

        
    </div>  
    <div style="float:right;">
        <div class="selector">
			
        </div>  
    </div>      	  
</div>



<div class="widget">
  <div class="title"><span class="titleIcon">
    <input type="checkbox" id="titleCheck" name="titleCheck" />
    </span>
    <h6>Danh sách các hình ảnh hiện có</h6>
  </div>
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
        <td></td>
        <td class="tb_data_small"><a href="#" class="tipS">Thứ tự</a></td>   
         <td class="sortCol"><div>Vị trí<span></span></div></td>    
        <td width="150">Hình ảnh</td>
       
        <td class="tb_data_small">Ẩn/Hiện</td>
        <td width="200">Thao tác</td>
      </tr>
    </thead>
    <tfoot>
      <tr>
      <td colspan="10">
      <div class="pagination">  
	   <?=$paging['paging']?>
       </div>
       
       </td>
      </tr>
    </tfoot>
    <tbody>
         <?php for($i=0, $count=count($items); $i<$count; $i++){?>
          <tr>
       <td>
            <input type="checkbox" name="iddel[]" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
        </td>
        <td align="center">
            <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText" original-title="Nhập số thứ tự hình ảnh" id="number<?=$items[$i]['id']?>" onchange="return updateNumber('slider', '<?=$items[$i]['id']?>')" />
            <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
        </td> 
        
        
          <td class="title_name_data">
            <a href="index.php?com=slider&type1=<?=$_REQUEST['type1']?>&act=edit_photo&id=<?=$items[$i]['id']?>" class="tipS SC_bold">
            
            <?php if($items[$i]['vitri']==1) echo 'Chạy bên trái';?>
            <?php if($items[$i]['vitri']==2) echo 'Chạy bên phải';?>
            <?php if($items[$i]['vitri']==3) echo 'Cột bên trái';?>
            
            </a>
        </td>
        
        <td align="center">
                <img src="<?=_upload_hinhanh.$items[$i]['photo']?>" width="100" border="0" />
                </td>
      
      
       
        <td align="center">
           <?php 
			if(@$items[$i]['hienthi']==1)
				{
		?>
            <a href="index.php?com=quangcaobody&act=man_photo&hienthi=<?=$items[$i]['id']?>&idc=<?=$items[$i]['id_photo']?>" title="" class="smallButton tipS" original-title="Click để ẩn"><img src="./images/icons/color/tick.png" alt=""></a>
            <?php } else { ?>
         <a href="index.php?com=quangcaobody&act=man_photo&hienthi=<?=$items[$i]['id']?>&idc=<?=$items[$i]['id_photo']?>" title="" class="smallButton tipS" original-title="Click để hiện"><img src="./images/icons/color/hide.png" alt=""></a>
         <?php } ?>
        </td>       
        <td class="actBtns">
            <a href="index.php?com=quangcaobody&act=edit_photo&id=<?=$items[$i]['id']?>&idc=<?=$items[$i]['id_photo']?>" title="" class="smallButton tipS" original-title="Sửa hình ảnh"><img src="./images/icons/dark/pencil.png" alt=""></a>
            
         
            <a  class="hidden-an" href="" onclick="CheckDelete('index.php?com=quangcaobody&act=delete_photo&id=<?=$items[$i]['id']?>&idc=<?=$items[$i]['id_photo']?>'); return false;" title="" class="smallButton tipS" original-title="Xóa hình ảnh"><img src="./images/icons/dark/close.png" alt=""></a>       
            
     
            
             </td>
      </tr>
         <?php } ?>
                </tbody>
  </table>
</div>
</form>

