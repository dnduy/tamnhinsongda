<script>
$(document).ready(function() {
$("#chonhet").click(function(){
	var status=this.checked;
	$("input[name='chon']").each(function(){this.checked=status;})
});

$("#xoahet").click(function(){
	var listid="";
	$("input[name='chon']").each(function(){
		if (this.checked) listid = listid+","+this.value;
    	})
	listid=listid.substr(1);	 //alert(listid);
	if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
	hoi= confirm("Bạn có chắc chắn muốn xóa?");
	if (hoi==true) document.location = "index.php?com=product&act=delete_rating&listid=" + listid;
});
});




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

<?php
	
	$sql="select ten_vi from table_product where id=".$_GET['id_product'];
	$result=mysql_query($sql);
	$product = mysql_fetch_array($result);
	$title = '<a href="index.php?com=product&act=man_rating">'.$product['ten_vi'].'</a>';
?>


<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><?=$title?></li>
                                    <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>


<form name="f" id="f" method="post">
<div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
    	<!-- <input type="button" class="blueB" value="Thêm" onclick="location.href='index.php?com=product&act=add_rating'" />
        <input type="button" class="blueB" value="Hiện" onclick="ChangeAction('index.php?com=product&act=man_rating&multi=show');return false;" />
        <input type="button" class="blueB" value="Ẩn" onclick="ChangeAction('index.php?com=product&act=man_rating&multi=hide');return false;" /> -->
        <input type="button" class="blueB" value="Xoá" id="xoahet" onclick="ChangeAction('index.php?com=product&act=man_rating&multi=del');return false;"  />
        

        
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
    <h6>Danh sách các review hiện có</h6>
  </div>
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
        <td></td>
        <!-- <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td> -->
        
        <!-- <td class="tb_data_small" style="width:20%; display:none;"><div>Danh mục size<span></span></div></td> -->
        <td class="tb_data_small">Ngày tạo</td>
        <td class="sortCol" style="width:20%;"><div>Tên người đánh giá<span></span></div></td>
         <td class="tb_data_small"><div>Tiêu đề<span></span></div></td>
         <td class="tb_data_small" style="width:30%;"><div>Nội dung<span></span></div></td> 
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
         <?php 
         for($i=0, $count=count($items); $i<$count; $i++){?>
          <tr>
       <td>
            <input type="checkbox" name="chon[]" id="chon" value="<?=$items[$i]['id']?>" class="chon" />
        </td>
        <!-- <td align="center">
            <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText" original-title="Nhập số thứ tự sản phẩm" id="number<?=$items[$i]['id']?>" onchange="return updateNumber('product', '<?=$items[$i]['id']?>')" />
            
            
            
            <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
        </td>  -->
        
        <!-- <td align="center" style="display:none;">
       		<?=$items[$i]['id']?>
        </td> -->
        
        
        <td align="center">
          <?=date('d M, Y',$items[$i]['ngaytao']);?>
        </td>
        
      
        <td class="title_name_data">
            <?=$items[$i]['ten']?>
        </td>
        
        
         <td align="center">
            <?=$items[$i]['tieude']?>
        </td>
        
         <td>
          <?=$items[$i]['noidung']?>
        </td>

          
        
       
        <!-- <td align="center">
           <?php 
			if(@$items[$i]['hienthi']==1)
				{
		?>
            <a href="index.php?com=product&act=man_rating&hienthi=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Click để ẩn"><img src="./images/icons/color/tick.png" alt=""></a>
            <?php } else { ?>
         <a href="index.php?com=product&act=man_rating&hienthi=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Click để hiện"><img src="./images/icons/color/hide.png" alt=""></a>
         <?php } ?>
        </td> -->
        
        <td class="actBtns">
            <!-- <a href="index.php?com=product&act=edit_rating&id=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Sửa"><img src="./images/icons/dark/pencil.png" alt=""></a> -->
            <a href="index.php?com=product&act=delete_rating&id=<?=$items[$i]['id']?>" onclick="CheckDelete('index.php?com=product&act=delete_rating&id=<?=$items[$i]['id']?>'); return false;" title="" class="smallButton tipS" original-title="Xóa"><img src="./images/icons/dark/close.png" alt=""></a>        </td>
      </tr>
         <?php } ?>
    </tbody>
    
    
    
  </table>
</div>
</form>