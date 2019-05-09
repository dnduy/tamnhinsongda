<script language="javascript">
	function CheckDelete(l){
		if(confirm('Bạn có chắc muốn xoá mục này?'))
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

<script type="text/javascript">
function doEnter(evt){
	// IE					// Netscape/Firefox/Opera
	var key;
	if(evt.keyCode == 13 || evt.which == 13){
		onSearch(evt);
	}
}
function onSearch(evt) {	
		var keyword = document.getElementById("keyword").value;		
		//var encoded = Base64.encode(keyword);
		location.href = "index.php?com=video&act=man&keyword="+keyword+"&typechild=<?=@$_GET['typechild']?>&curPage=<?=$_REQUEST['curPage']?>";
		loadPage(document.location);
			
}

</script>






<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
               
             <li><a href="index.php?com=video&act=add&typechild=<?=@$_GET['typechild']?>&curPage=<?=$_REQUEST['curPage']?>"><span><?=$name_cap?></span></a></li>
        
         
                     
             
             <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
        
        </ul>
        <div class="clear"></div>
    </div>
</div>




<form name="f" id="f" method="post">
<div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
  	



    	<?php if ($btn_them_active=="on") {?>
       	<input type="button" class="blueB" value="Thêm" onclick="location.href='index.php?com=video&act=add&typechild=<?=@$_GET['typechild']?>&curPage=<?=$_REQUEST['curPage']?>'" /> 
   		<?php }?>


   		<?php if ($btn_hien_active=="on") {?>
        <input type="button" class="blueB" value="Hiện" onclick="ChangeAction('index.php?com=video&act=man&typechild=<?=@$_GET['typechild']?>&curPage=<?=$_REQUEST['curPage']?>&multi=show');return false;" />
        <?php }?>	


        <?php if ($btn_an_active=="on") {?>
        <input type="button" class="blueB" value="Ẩn" onclick="ChangeAction('index.php?com=video&act=man&typechild=<?=@$_GET['typechild']?>&curPage=<?=$_REQUEST['curPage']?>&multi=hide');return false;" />
        <?php }?>


        <?php if ($btn_xoa_active=="on") {?>  
        <input type="button" class="blueB" value="Xoá" id="xoahet" onclick="ChangeAction('index.php?com=video&act=man&typechild=<?=@$_GET['typechild']?>&curPage=<?=$_REQUEST['curPage']?>&multi=del');return false;"  />
        <?php }?>
        

        
    </div> 
     <div style="float:right;">
        <div class="selector">
Tìm kiếm: <input name="keyword" id="keyword" type="text" value="<?=@$_REQUEST['keyword']?>" /> <input type="button" value=" Tìm "  onclick="onSearch(event)"/>
        </div>  
    </div>
  	
</div>





<div class="widget">
  <div class="title"><span class="titleIcon">
    <input type="checkbox"  name="chonhet" id="chonhet"  />
    </span>
    <h6>Danh sách các danh mục hiện có</h6>
  </div>
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
        <td></td>
        <td class="tb_data_small"><a href="#" class="tipS">Thứ tự</a></td>

	   
        <td class="sortCol"><div>Tên<span></span></div></td>
        
       <?php if ($image_active =="on") {?>   
        <td class="sortCol"><div>Hình<span></span></div></td>
       <?php }?>   


        
       
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
       <input type="checkbox" name="chon[]" id="chon" value="<?=$items[$i]['id']?>" class="chon" />
       
        </td>
        <td align="center">
            <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText" original-title="Nhập số thứ tự" id="number<?=$items[$i]['id']?>" onchange="return updateNumber('video', '<?=$items[$i]['id']?>')" />
            <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
        </td> 
        

 

      
        <td class="title_name_data">
            <a href="index.php?com=video&act=edit&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id_item=<?=$items[$i]['id_item']?>&id_sub=<?=$items[$i]['id_sub']?>&id=<?=$items[$i]['id']?>&typechild=<?=@$_GET['typechild']?>&curPage=<?=$_REQUEST['curPage']?>" class="tipS SC_bold"><?=$items[$i]['ten_vi']?></a>
        </td>
        
        
      

       <?php if ($image_active =="on") {?>  
         <td class="title_name_data">
            <a href="index.php?com=video&act=edit&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id_item=<?=$items[$i]['id_item']?>&id_sub=<?=$items[$i]['id_sub']?>&id=<?=$items[$i]['id']?>&typechild=<?=@$_GET['typechild']?>&curPage=<?=$_REQUEST['curPage']?>" class="tipS SC_bold">
            <img src="<?php if($items[$i]['photo']!=NULL) echo _upload_video.$items[$i]['photo']; else echo 'images/noimage.gif';?>"  style="max-width:200px;" />
            
            </a>
        </td>

        <?php }?>
        
        

       
        <td align="center">
           <?php 
			if(@$items[$i]['hienthi']==1)
				{
		?>
            <a href="index.php?com=video&act=man&hienthi=<?=$items[$i]['id']?>&typechild=<?=@$_GET['typechild']?>" title="" class="smallButton tipS" original-title="Click để ẩn"><img src="./images/icons/color/tick.png" alt=""></a>
            <?php } else { ?>
         <a href="index.php?com=video&act=man&hienthi=<?=$items[$i]['id']?>&typechild=<?=@$_GET['typechild']?>" title="" class="smallButton tipS" original-title="Click để hiện"><img src="./images/icons/color/hide.png" alt=""></a>
         <?php } ?>
        </td>
        
        <td class="actBtns">
    

 <?php if ($btn_sua_active=="on") {?>
    <a href="index.php?com=video&act=edit&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id_item=<?=$items[$i]['id_item']?>&id_sub=<?=$items[$i]['id_sub']?>&id=<?=$items[$i]['id']?>&typechild=<?=@$_GET['typechild']?>&curPage=<?=$_REQUEST['curPage']?>" title="" class="smallButton tipS" original-title="Sửa"><img src="./images/icons/dark/pencil.png" alt=""></a>
 <?php }?>           
               
    
    <?php if ($btn_xoa_active=="on") {?>

<a href="index.php?com=video&act=delete&id=<?=$items[$i]['id']?>&typechild=<?=@$_GET['typechild']?>&curPage=<?=$_REQUEST['curPage']?>" onclick="CheckDelete('index.php?com=video&act=delete&id=<?=$items[$i]['id']?>&typechild=<?=@$_GET['typechild']?>&curPage=<?=$_REQUEST['curPage']?>'); return false;" title="" class="smallButton tipS" original-title="Xóa"><img src="./images/icons/dark/close.png" alt=""></a>      
          

    <?php }?>   

          

            
              </td>
      </tr>
         <?php } ?>
                </tbody>
    
    
    
  </table>
</div>
</form>

