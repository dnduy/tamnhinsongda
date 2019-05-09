<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	   
             <li><a href="index.php?com=image_url&act=man_photo<?php if($_REQUEST['typechild']!='') echo'&typechild='. $_REQUEST['typechild'];?>"><span><?=$name_photo?></span></a></li>
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
   

     <?php if ($btn_them_active=="on") {?> 
    	
      <input  type="button" class="blueB" value="Thêm" onclick="location.href='index.php?com=image_url&typechild=<?=$_REQUEST['typechild']?>&act=add_photo'" />
      
     <?php }?>   
  
        
     <?php if ($btn_hien_active=="on") {?>     
      
      <input type="button" class="blueB" value="Hiện" onclick="ChangeAction('index.php?com=image_url&act=man_photo&typechild=<?=$_REQUEST['typechild']?>&multi=show');return false;" />
      
     <?php }?>   



     <?php if ($btn_an_active=="on") {?> 

      <input type="button" class="blueB" value="Ẩn" onclick="ChangeAction('index.php?com=image_url&act=man_photo&typechild=<?=$_REQUEST['typechild']?>&multi=hide');return false;" />
    
    <?php }?>


    <?php if ($btn_xoa_active=="on") {?>
      
      <input type="button" class="blueB" value="Xoá" onclick="ChangeAction('index.php?com=image_url&act=man_photo&typechild=<?=$_REQUEST['typechild']?>&multi=del');return false;" />

     <?php }?> 
        
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
        <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td> 
        
        <?php if ($image_active=="on") {?>
 
        <td width="150">Hình ảnh</td>

        <?php }?>

        <td class="sortCol"><div>Tên<span></span></div></td>
        <td class="tb_data_small">Ẩn/Hiện</td>
        <td width="200">Thao tác</td>
      </tr>
    </thead>
    <tfoot>
      <tr>
     <td colspan="10"><div class="pagination">  <?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?>     </div></td>
      </tr>
    </tfoot>
    <tbody>
         <?php for($i=0, $count=count($items); $i<$count; $i++){?>
          <tr>
       <td>
            <input type="checkbox" name="iddel[]" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
        </td>
        <td align="center">
            <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText" original-title="Nhập số thứ tự <?=$name_photo?>" id="number<?=$items[$i]['id']?>" onchange="return updateNumber('image_url', '<?=$items[$i]['id']?>')" />
            <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
        </td> 
        
        
         
        
        
        <?php if ($image_active=="on") {?>

          <td align="center">
                <img src="<?=_upload_hinhanh.$items[$i]['photo']?>" width="100" border="0" />
          </td>

        <?php }?>

      
      
        <td class="title_name_data">
            <a href="index.php?com=image_url&typechild=<?=$_REQUEST['typechild']?>&act=edit_photo&id=<?=$items[$i]['id']?>&id_typeposting=<?=$items[$i]['id_typeposting']?>&id_list=<?=$items[$i]['id_list']?>&vitri=<?=$items[$i]['vitri']?>" class="tipS SC_bold"><?=$items[$i]['ten_vi']?></a>
        </td>
       
        <td align="center">
           <?php 
			if(@$items[$i]['hienthi']==1)
				{
		?>
            <a href="index.php?com=image_url&typechild=<?=$_REQUEST['typechild']?>&act=man_photo&hienthi=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Click để ẩn"><img src="./images/icons/color/tick.png" alt=""></a>
            <?php } else { ?>
         <a href="index.php?com=image_url&typechild=<?=$_REQUEST['typechild']?>&act=man_photo&hienthi=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Click để hiện"><img src="./images/icons/color/hide.png" alt=""></a>
         <?php } ?>
        </td>       
        <td class="actBtns">



          <?php if ($btn_sua_active=="on") {?>
            <a href="index.php?com=image_url&typechild=<?=$_REQUEST['typechild']?>&act=edit_photo&id=<?=$items[$i]['id']?>&id_typeposting=<?=$items[$i]['id_typeposting']?>&id_list=<?=$items[$i]['id_list']?>&vitri=<?=$items[$i]['vitri']?>" title="" class="smallButton tipS" original-title="Sửa hình ảnh"><img src="./images/icons/dark/pencil.png" alt=""></a>
          <?php }?>  


         <?php if ($btn_xoa_active=="on") {?>
            <a  href="" onclick="CheckDelete('index.php?com=image_url&typechild=<?=$_REQUEST['typechild']?>&act=delete_photo&id=<?=$items[$i]['id']?>'); return false;" title="" class="smallButton tipS" original-title="Xóa hình ảnh"><img src="./images/icons/dark/close.png" alt=""></a>       
         <?php }?>

     
            
             </td>
      </tr>
         <?php } ?>
                </tbody>
  </table>
</div>
</form>      