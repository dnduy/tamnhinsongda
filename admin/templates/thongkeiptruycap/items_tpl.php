<script type="text/javascript">
	$(document).ready(function() {
							   
	$("#chonhet").click(function(){
		var status=this.checked;
		$("input[name='chon']").each(function(){this.checked=status;})
	});
	
	$("#send").click(function(){
		var listid="";
		$("input[name='chon']").each(function(){
			if (this.checked) listid = listid+","+this.value;
			})
		listid=listid.substr(1);	 //alert(listid);
		if (listid=="") { alert("Bạn chưa chọn email nào"); return false;}
		hoi= confirm("Xác nhận muốn gửi thư đi?");
		if (hoi==true){ document.frm.listid.value=listid; document.frm.submit();}
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
			document.frm.action = str;
			document.frm.submit();
		}
	}	
	
</script>


<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=thongkeiptruycap&act=man"><span>Báo Cáo Vi Phạm</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>


<form name="frm" id="f" action="index.php?com=thongkeiptruycap&act=send"  method="post">
<div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
    	<input type="button" class="blueB hidden_log" value="Thêm" onclick="location.href='index.php?com=thongkeiptruycap&act=add'" />
        <input type="button" class="blueB" value="Hiện" onclick="ChangeAction('index.php?com=thongkeiptruycap&act=man&multi=show');return false;" />
        <input type="button" class="blueB" value="Ẩn" onclick="ChangeAction('index.php?com=thongkeiptruycap&act=man&multi=hide');return false;" />
        <input type="button" class="blueB" value="Xoá" id="xoahet" onclick="ChangeAction('index.php?com=thongkeiptruycap&act=man&multi=del');return false;"   />
        

        
    </div> 
     <div style="float:right;">
        <div class="selector">
			
        </div>  
    </div>
  	
</div>



<div class="widget">
  <div class="title"><span class="titleIcon">
    <input type="checkbox"  name="chonhet" id="chonhet"  />
    </span>
    <h6>Danh sách  hiện có</h6>
  </div>
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
        <td></td>
        <td class="tb_data_small"><a href="#" class="tipS">Thứ tự</a></td>
        <td><div>Thành Viên<span></span></div></td>
        <td class="sortCol"><div>IP<span></span></div></td>
         <td style="width:15%;">Nhóm Tin</td>
        <td style="width:15%;">Tin Báo Cáo</td>          
        <td style="width:15%;">Loại Vi Phạm</td>         
        <td class="tb_data_small">Ẩn/Hiện</td>
        <td width="200">Thao tác</td>
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
            <input type="checkbox" name="chon[]" id="chon" value="<?=$items[$i]['id']?>" class="chonxoa" />
        </td>
        <td align="center">
            <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText" original-title="Nhập số thứ tự sản phẩm" id="number<?=$items[$i]['id']?>" onchange="return updateNumber('thongkeiptruycap', '<?=$items[$i]['id']?>')" />
            <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
        
        </td> 
        

        
        <td class="title_name_data">
         <a href="index.php?com=thongkeiptruycap&act=edit&id=<?=$items[$i]['id']?>" class="tipS SC_bold">
         
          <?php
	if ($items[$i]['id_thanhvien']!=0){
				$sql_danhmuc="select hoten from table_user where id='".$items[$i]['id_thanhvien']."'";
				$result=mysql_query($sql_danhmuc);
				$item_danhmuc =mysql_fetch_array($result);
				echo @$item_danhmuc['hoten'];
				
	}
	else if ($items[$i]['id_thanhvien']==0){
			
				echo "Không phải thành viên";
				
	}
			?>    
            
         
         </a>
        </td> 
      
        <td class="title_name_data">
         <a href="index.php?com=thongkeiptruycap&act=edit&id=<?=$items[$i]['id']?>" class="tipS SC_bold"><?=$items[$i]['ip_reportspam']?></a>
        </td>
        
        
        
        <td>
         <a href="index.php?com=thongkeiptruycap&act=edit&id=<?=$items[$i]['id']?>" class="tipS SC_bold">
         
         
           <?php
	if ($items[$i]['id_product']!=0){
		
	$d->reset();
	$sql = "select ten_vi,id,id_list from table_product where id='".$items[$i]['id_product']."'";
	$d->query($sql);
	$result_tinspam=$d->result_array();
	
	
	$d->reset();
	$sql = "select ten_vi,id from table_product_list where id='".$result_tinspam[0]['id_list']."'";
	$d->query($sql);
	$nhomtin_list=$d->result_array();
	echo @$nhomtin_list[0]['ten_vi'];
				
	}
	else if ($items[$i]['id_product']==0){
			
				echo "Null";
				
	}
			?>    
         
         </a>
        </td>
        
        
        <td>
         <a href="index.php?com=thongkeiptruycap&act=edit&id=<?=$items[$i]['id']?>" class="tipS SC_bold">
         
         
           <?php
	if ($items[$i]['id_product']!=0){
				$sql_danhmuc="select ten_vi from table_product where id='".$items[$i]['id_product']."'";
				$result=mysql_query($sql_danhmuc);
				$item_danhmuc =mysql_fetch_array($result);
				echo @$item_danhmuc['ten_vi'];
				
	}
	else if ($items[$i]['id_product']==0){
			
				echo "Null";
				
	}
			?>    
         
         </a>
        </td>
        
        
          <td>
         <a href="index.php?com=thongkeiptruycap&act=edit&id=<?=$items[$i]['id']?>" class="tipS SC_bold">
         
          <?php
	if ($items[$i]['id_loaivipham']!=0){
				$sql_danhmuc="select ten_vi from table_news where id='".$items[$i]['id_loaivipham']."' and com='reportspam' ";
				$result=mysql_query($sql_danhmuc);
				$item_danhmuc =mysql_fetch_array($result);
				echo @$item_danhmuc['ten_vi'];
				
	}
	else if ($items[$i]['id_loaivipham']==0){
			
				echo "Null";
				
	}
			?>    
         
         </a>
        </td>
       
        <td align="center">
           <?php 
			if(@$items[$i]['hienthi']==1)
				{
		?>
            <a href="index.php?com=thongkeiptruycap&act=man&hienthi=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Click để ẩn"><img src="./images/icons/color/tick.png" alt=""></a>
            <?php } else { ?>
         <a href="index.php?com=thongkeiptruycap&act=man&hienthi=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Click để hiện"><img src="./images/icons/color/hide.png" alt=""></a>
         <?php } ?>
        </td>
        
        <td class="actBtns">
      <a href="index.php?com=thongkeiptruycap&act=edit&id=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Sửa"><img src="./images/icons/dark/pencil.png" alt=""></a>
            <a href="index.php?com=thongkeiptruycap&act=delete&id=<?=$items[$i]['id']?>" onclick="CheckDelete('index.php?com=thongkeiptruycap&act=delete&id=<?=$items[$i]['id']?>'); return false;" title="" class="hidden_log smallButton tipS" original-title="Xóa"><img src="./images/icons/dark/close.png" alt=""></a>        </td>
      </tr>
         <?php } ?>
                </tbody>
    
    
    
  </table>
</div>
</form>
