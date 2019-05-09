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
		location.href = "index.php?com=news&act=man_item&keyword="+keyword+"&typeparent=<?=@$_GET['typeparent']?>&curPage=<?=$_REQUEST['curPage']?>";
		loadPage(document.location);
			
}

</script>

<script type="text/javascript">
	function select_onchange()
	{
		var a=document.getElementById("id_list");
		window.location ="index.php?com=news&act=man_item&id_list="+a.value+"&typeparent=<?=@$_GET['typeparent']?>&curPage=<?=$_REQUEST['curPage']?>";	
		return true;
	}
	
	function select_onchange1()
	{
		var a=document.getElementById("id_cat");
		window.location ="index.php?com=news&act=man_item&id_list=<?=$_GET['id_list']?>&id_cat="+a.value+"&typeparent=<?=@$_GET['typeparent']?>&curPage=<?=$_REQUEST['curPage']?>";	
		return true;
	}
	
		
</script>


<?php
function get_main_list()
	{
		$sql="select ten_vi,id from table_news_list where com='$_GET[typeparent]'  order by stt asc";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_list" name="id_list" onchange="select_onchange()" class="main_font">
			<option value="">---Chọn danh mục---</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==$_REQUEST['id_list'])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
function get_main_cat()
	{
		$sql="select ten_vi,id from table_news_cat where id_list='$_GET[id_list]' and com='$_GET[typeparent]' order by stt asc";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_cat" name="id_cat" onchange="select_onchange1()" class="main_font">
			<option value="">Danh mục cấp 2</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==$_REQUEST['id_cat'])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}

?>

<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	           
             <li><a href="index.php?com=news&act=add_item&typeparent=<?=$_GET['typeparent']?>"><span><?=$name_cap?></span></a></li>
             <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
        
        </ul>
        <div class="clear"></div>
    </div>
</div>




<form name="f" id="f" method="post">
<div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
    	<input type="button" class="blueB" value="Thêm" onclick="location.href='index.php?com=news&act=add_item&typeparent=<?=@$_GET['typeparent']?>&curPage=<?=$_REQUEST['curPage']?>'" />
        <input type="button" class="blueB" value="Hiện" onclick="ChangeAction('index.php?com=news&act=man_item&typeparent=<?=@$_GET['typeparent']?>&curPage=<?=$_REQUEST['curPage']?>&multi=show');return false;" />
        <input type="button" class="blueB" value="Ẩn" onclick="ChangeAction('index.php?com=news&act=man_item&typeparent=<?=@$_GET['typeparent']?>&curPage=<?=$_REQUEST['curPage']?>&multi=hide');return false;" />
        <input type="button" class="blueB" value="Xoá" id="xoahet" onclick="ChangeAction('index.php?com=news&act=man_item&typeparent=<?=$_GET['typeparent']?>&multi=del');return false;"  />
        

        
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
        <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>
         <td><?=get_main_list();?></td>
           <td><?=get_main_cat();?></td> 
        <td class="sortCol"><div>Tên danh mục<span></span></div></td>
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
            <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText" original-title="Nhập số thứ tự" id="number<?=$items[$i]['id']?>" onchange="return updateNumber('news_item', '<?=$items[$i]['id']?>')" />
            <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
        </td> 
        
          <td align="center">
          
          <?php
				$sql_danhmuc="select ten_vi from table_news_list where id='".$items[$i]['id_list']."'";
				$result=mysql_query($sql_danhmuc);
				$item_danhmuc =mysql_fetch_array($result);
				echo @$item_danhmuc['ten_vi']
			?>       
          
          </td>
          
          
           <td align="center">
          
          <?php
				$sql_danhmuc="select ten_vi from table_news_cat where id='".$items[$i]['id_cat']."'";
				$result=mysql_query($sql_danhmuc);
				$item_danhmuc =mysql_fetch_array($result);
				echo @$item_danhmuc['ten_vi']
			?>    
          
          </td>
        
      
        <td class="title_name_data">
            <a href="index.php?com=news&act=edit_item&typeparent=<?=@$_GET['typeparent']?>&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id=<?=$items[$i]['id']?>" class="tipS SC_bold"><?=$items[$i]['ten_vi']?></a>
        </td>
       
        <td align="center">
           <?php 
			if(@$items[$i]['hienthi']==1)
				{
		?>
            <a href="index.php?com=news&act=man_item&typeparent=<?=$_GET['typeparent']?>&hienthi=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Click để ẩn"><img src="./images/icons/color/tick.png" alt=""></a>
            <?php } else { ?>
         <a href="index.php?com=news&act=man_item&typeparent=<?=$_GET['typeparent']?>&hienthi=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Click để hiện"><img src="./images/icons/color/hide.png" alt=""></a>
         <?php } ?>
        </td>
        
        <td class="actBtns">
            <a href="index.php?com=news&act=edit_item&typeparent=<?=@$_GET['typeparent']?>&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Sửa"><img src="./images/icons/dark/pencil.png" alt=""></a>
            <a href="index.php?com=news&act=delete_item&typeparent=<?=$_GET['typeparent']?>&id=<?=$items[$i]['id']?>" onclick="CheckDelete('index.php?com=news&act=delete_item&typeparent=<?=$_GET['typeparent']?>&id=<?=$items[$i]['id']?>'); return false;" title="" class="smallButton tipS" original-title="Xóa"><img src="./images/icons/dark/close.png" alt=""></a>        </td>
      </tr>
         <?php } ?>
                </tbody>
    
    
    
  </table>
</div>
</form>