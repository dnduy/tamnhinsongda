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





<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li>   
      <?php if ($_GET["type1"]=="guibaiviet"  ) {?>
      <a href="#" onclick="return false;">
       
	  <?php 
	  
	  $sql_danhmuc="select FullName,id from table_sendtocontent where id='".$items[0]['id_photo']."'";
				$result=mysql_query($sql_danhmuc);
				$item_danhmuc =mysql_fetch_array($result);
				echo @$item_danhmuc['FullName'];
				
				
	  
	  ?>
      </a>
	  
	  <?php } else {?>
      
      <?=$title?> 
      
      <?php }?>
      
      
      </li>
      <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>


<form name="f" id="f" method="post">
<div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
    	<input type="button" class="blueB" value="Thêm" onclick="location.href='index.php?com=hasp&type1=<?=$_REQUEST['type1']?>&act=add_photo&idc=<?=$_REQUEST['idc'];?>'" />
        
              <input type="button" class="blueB" value="Hiện" onclick="ChangeAction('index.php?com=hasp&act=man_photo&type1=<?=$_REQUEST['type1']?>&multi=show');return false;" />
        
        
           <input type="button" class="blueB" value="Ẩn" onclick="ChangeAction('index.php?com=hasp&act=man_photo&type1=<?=$_REQUEST['type1']?>&multi=hide');return false;" />

     <input  type="button" class="blueB" value="Xoá" onclick="ChangeAction('index.php?com=hasp&act=man_photo&type1=<?=$_REQUEST['type1']?>&multi=del');return false;" />
     
        

        
    </div> 
     <div style="float:right;">
        <div class="selector">
<?php /*?>Tìm kiếm: <input name="keyword" id="keyword" type="text" value="<?=@$_REQUEST['keyword']?>" /> <input type="button" value=" Tìm "  onclick="onSearch(event)"/><?php */?>
        </div>  
    </div>
  	
</div>



<div class="widget">
  <div class="title"><span class="titleIcon">
   <input type="checkbox" id="titleCheck" name="titleCheck" />
    </span>
    <h6>Danh sách hiện có</h6>
  </div>
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
        <td></td>
        <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>
        
        
          <?php if ($_GET["type1"]=="guibaiviet"  ) {?> 
          
          
          <?php } else {?>
          
        <td class="sortCol" style="width:20%;"><div>Tên<span></span></div></td>   
          
          <?php }?>
      
       
        
        
      <?php if ($_GET["type1"]=="guibaiviet"  ) {?> 
	  
	<td class="tb_data_small" style="width:15%;"><div>File đính kèm<span></span></div></td>  
	  
	  <?php } else {?>
        
    <td class="tb_data_small" style="width:15%;"><div>Hình ảnh<span></span></div></td>
         
      <?php }?>   
         
        <td class="tb_data_small">Ẩn/Hiện</td>
        <td style="width:10%;">Thao tác</td>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="10">
        <div class="pagination">
       <?=$paging['paging']?>
            
        </div></td>
      </tr>
    </tfoot>
    
    
    <tbody>
         <?php for($i=0, $count=count($items); $i<$count; $i++){?>
          <tr>
       <td>
         <input type="checkbox" name="iddel[]" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
           
        </td>
        <td align="center">
            <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText" original-title="Nhập số thứ tự sản phẩm" id="number<?=$items[$i]['id']?>" onchange="return updateNumber('hasp', '<?=$items[$i]['id']?>')" />
            
            
            
            <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
        </td> 
        
         
        
        <?php if ($_GET["type1"]=="guibaiviet"  ) {?> 
          
          
          <?php } else {?>
          
        <td class="title_name_data">
            <a href="index.php?com=hasp&type1=<?=$_REQUEST['type1']?>&act=edit_photo&id=<?=$items[$i]['id']?>&idc=<?=$items[$i]['id_photo']?>" class="tipS SC_bold"><?=$items[$i]['ten_vi']?></a>
        </td>
          
          <?php }?>
        

		
        
         <td align="center">
           <a href="index.php?com=hasp&type1=<?=$_REQUEST['type1']?>&act=edit_photo&id=<?=$items[$i]['id']?>&idc=<?=$items[$i]['id_photo']?>" style="text-decoration:none;"><center>
           
           
           <?php if ($_GET["type1"]=="guibaiviet") {?>
			
            <a href="<?=_upload_product.$items[$i]['photo']?>"><?=$items[$i]['photo']?></a>
			 
        
        	<?php } else {?>
             <img src="<?=_upload_product.$items[$i]['photo']?>" width="100" border="0" />
            <?php }?>

           
          </center></a>
        </td>
        
        
     
        
      
        
       
        <td align="center">
           <?php 
			if(@$items[$i]['hienthi']==1)
				{
		?>
            <a href="index.php?com=hasp&type1=<?=$_REQUEST['type1']?>&act=man_photo&hienthi=<?=$items[$i]['id']?>&idc=<?=$items[$i]['id_photo']?>" title="" class="smallButton tipS" original-title="Click để ẩn"><img src="./images/icons/color/tick.png" alt=""></a>
            <?php } else { ?>
         <a href="index.php?com=hasp&type1=<?=$_REQUEST['type1']?>&act=man_photo&hienthi=<?=$items[$i]['id']?>&idc=<?=$items[$i]['id_photo']?>" title="" class="smallButton tipS" original-title="Click để hiện"><img src="./images/icons/color/hide.png" alt=""></a>
         <?php } ?>
        </td>
        
        <td class="actBtns">
            <a href="index.php?com=hasp&type1=<?=$_REQUEST['type1']?>&act=edit_photo&id=<?=$items[$i]['id']?>&idc=<?=$items[$i]['id_photo']?>" title="" class="smallButton tipS" original-title="Sửa"><img src="./images/icons/dark/pencil.png" alt=""></a>
            <a href="index.php?com=hasp&type1=<?=$_REQUEST['type1']?>&act=delete_photo&idc=<?=$_REQUEST['idc']?>&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa')) return false;" onclick="Checkdelete_color('index.php?com=hasp&act=delete_color&id=<?=$items[$i]['id']?>'); return false;" title="" class="smallButton tipS" original-title="Xóa"><img src="./images/icons/dark/close.png" alt=""></a>       
      </td>
      </tr>
         <?php } ?>
                </tbody>
    
    
    
  </table>
</div>
</form>