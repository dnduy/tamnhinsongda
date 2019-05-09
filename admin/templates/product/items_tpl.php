<script type="text/javascript">
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
function onSearch(evt) 
{	
	
	var keyword = document.getElementById("keyword").value;		
	//var encoded = Base64.encode(keyword);
	location.href = "index.php?com=product&act=man&typechild=<?=@$_GET['typechild']?>&keyword="+keyword;
	loadPage(document.location);
			
}
</script>


<script type="text/javascript">
	function select_onchange()
	{
		var a=document.getElementById("id_list");
		window.location ="index.php?com=product&act=man&typechild=<?=@$_GET['typechild']?>&id_list="+a.value;	
		return true;
	}	
	
	function select_onchange1()
	{
		var a=document.getElementById("id_cat");
		window.location ="index.php?com=product&act=man&typechild=<?=@$_GET['typechild']?>&id_list=<?=@$_REQUEST['id_list']?>&id_cat="+a.value;	
		return true;
	}
	
	function select_onchange2()
	{
		var a=document.getElementById("id_item");
		window.location ="index.php?com=product&act=man&typechild=<?=@$_GET['typechild']?>&id_list=<?=@$_REQUEST['id_list']?>&id_cat=<?=@$_REQUEST['id_cat']?>&id_item="+a.value;	
		return true;
	}	
	
	function select_onchange4()
	{
		var a=document.getElementById("id_sub");
		window.location ="index.php?com=product&act=man&typechild=<?=@$_GET['typechild']?>&id_list=<?=@$_REQUEST['id_list']?>&id_cat=<?=@$_REQUEST['id_cat']?>&id_item=<?=@$_REQUEST['id_item']?>&id_sub="+a.value+"&curPage=<?=$_REQUEST['curPage']?>";	
		return true;
	}	
	
	
	
	
	
	
</script>



<?php
	function get_main_list()
	{
		$sql="select ten_vi,id from table_product_list where hienthi=1 and com='".$_GET["typechild"]."' order by stt asc";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_list" name="id_list" onchange="select_onchange()" class="main_font" style="width:150px">
			<option value="">Danh mục cấp 1</option>			
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
		$sql="select ten_vi,id from table_product_cat where hienthi=1 and com='".$_GET["typechild"]."' and id_list='$_GET[id_list]' order by stt asc";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_cat" name="id_cat" onchange="select_onchange1()" class="main_font" style="width:150px">
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
	function get_main_item()
	{
		$sql="select ten_vi,id from table_product_item where hienthi=1 and com='".$_GET["typechild"]."' and id_cat='$_GET[id_cat]' order by stt asc";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_item" name="id_item" onchange="select_onchange2()" class="main_font" style="width:150px">
			<option value="">Danh mục cấp 3</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==$_REQUEST['id_item'])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	
	
	function get_main_sub()
	{
		$sql="select ten_vi,id from table_product_sub where hienthi=1 and com='".$_GET["typechild"]."' and id_item='$_GET[id_item]'  order by stt asc";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_sub" name="id_sub" onchange="select_onchange4()" class="main_font">
			<option value="">Danh mục cấp 4</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==$_REQUEST['id_sub'])
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
        	            <li><a href="index.php?com=product&act=man&typechild=<?=@$_GET['typechild']?>"><span><?=$name_cap?></span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>



<form name="f" id="f" method="post">
<div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
    	<input type="button" class="blueB" value="Thêm" onclick="location.href='index.php?com=product&act=add&typechild=<?=@$_GET['typechild']?>'" />
        <input type="button" class="blueB" value="Hiện" onclick="ChangeAction('index.php?com=product&act=man&typechild=<?=@$_GET['typechild']?>&multi=show');return false;" />
        <input type="button" class="blueB" value="Ẩn" onclick="ChangeAction('index.php?com=product&act=man&typechild=<?=@$_GET['typechild']?>&multi=hide');return false;" />
        <input type="button" class="blueB" value="Xoá" id="xoahet" onclick="ChangeAction('index.php?com=product&act=man&typechild=<?=@$_GET['typechild']?>&multi=del');return false;"  />
        

        
    </div> 
     <div style="float:right;">
        <div class="selector">
Tìm kiếm: <input name="keyword" id="keyword" type="text" value="<?=@$_REQUEST['keyword']?>" /> <input type="button" value=" Tìm "  onclick="onSearch(event)"/>
        </div>  
    </div>
  	
</div>



<div class="widget">
  <div class="title"><span class="titleIcon">
   <input type="checkbox" id="titleCheck" name="titleCheck" />
    </span>
    <h6>Danh sách các sản phẩm hiện có</h6>
  </div>
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
        <td></td>
        <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>

        <?php if ($danhmuc_cap1=="on") {?>
        
        <td class="tb_data_small"><div><?=get_main_list();?><span></span></div></td>

        <?php }?>


        <?php if ($danhmuc_cap2=="on") {?>
	     <td class="tb_data_small"><div><?=get_main_cat();?><span></span></div></td>

	     <?php }?>



 		<?php if ($danhmuc_cap3=="on") {?>
    	 <td class="tb_data_small"><div><?=get_main_item();?><span></span></div></td> 
    	 <?php }?> 
        
        <?php if ($danhmuc_cap4=="on") {?>
        <td class="tb_data_small"><div><?=get_main_sub();?><span></span></div></td>

        <?php }?>

        <td class="sortCol"><div>Tên<span></span></div></td>
		
		<td class="sortCol"><div>Hình ảnh<span></span></div></td>


         <?php if ($check_moi=="on") {?>
        <td class="tb_data_small">SP Mới</td>
        <?php }?>


        <?php if ($check_noibat=="on") {?>
        <td class="tb_data_small">SP Nổi bật</td>
        <?php }?>
		
		
		 <?php if ($check_hot=="on") {?>
        <td class="tb_data_small">SP Sắp ra</td>
        <?php }?>


         <?php if ($check_rating=="on") {?>

         <td class="tb_data_small" width="5%"><div>Đánh giá<span></span></div></td> 

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
            <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText" original-title="Nhập số thứ tự sản phẩm" id="number<?=$items[$i]['id']?>" onchange="return updateNumber('product', '<?=$items[$i]['id']?>')" />
            
            
            
            <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
        </td> 

        <?php if ($danhmuc_cap1=="on") {?>
        
         <td align="center">
          <?php
				$sql_danhmuc="select ten_vi from table_product_list where id='".$items[$i]['id_list']."'";
				$result=mysql_query($sql_danhmuc);
				$item_danhmuc =mysql_fetch_array($result);
				echo @$item_danhmuc['ten_vi']
			?>      
        </td>

        <?php }?>
        
        
       <?php if ($danhmuc_cap2=="on") {?>  
       <td align="center" >
          <?php
				$sql_danhmuc="select ten_vi from table_product_cat where id='".$items[$i]['id_cat']."'";
				$result=mysql_query($sql_danhmuc);
				$item_danhmuc =mysql_fetch_array($result);
				echo @$item_danhmuc['ten_vi']
			?>    
        </td>

        <?php }?>
        
       
        <?php if ($danhmuc_cap3=="on") {?>  
           <td align="center" >
         <?php
				$sql_danhmuc="select ten_vi from table_product_item where id='".$items[$i]['id_item']."'";
				$result=mysql_query($sql_danhmuc);
				$item_danhmuc =mysql_fetch_array($result);
				echo @$item_danhmuc['ten_vi']
			?>    
        </td>
        <?php }?>
        
        
        
        <?php if ($danhmuc_cap4=="on") {?>   
        <td>
        	  <?php
				$sql_danhmuc="select ten_vi from table_product_sub where id='".$items[$i]['id_sub']."'";
				$result=mysql_query($sql_danhmuc);
				$item_danhmuc =mysql_fetch_array($result);
				echo @$item_danhmuc['ten_vi']
			?>    
        </td>
        <?php }?>
      
        <td class="title_name_data">
            <a href="index.php?com=product&act=edit&typechild=<?=@$_GET['typechild']?>&id=<?=$items[$i]['id']?>&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id_item=<?=$items[$i]['id_item']?>&id_sub=<?=$items[$i]['id_sub']?>" class="tipS SC_bold"><?=$items[$i]['ten_vi']?></a>
        </td>


 <td class="title_name_data">
            <a href="index.php?com=product&act=edit&typechild=<?=@$_GET['typechild']?>&id=<?=$items[$i]['id']?>&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id_item=<?=$items[$i]['id_item']?>&id_sub=<?=$items[$i]['id_sub']?>" class="tipS SC_bold">
			<img src="<?=_upload_product.$items[$i]['photo']?>" style="max-width:100px;">
			</a>
        </td>

         <?php if ($check_moi=="on") {?> 
        
        <td align="center">
       
       
       <?php
		if($items[$i]['spmoi']>0)
		{
		?>
	 <a href="index.php?com=product&act=man&spmoi=<?=$items[$i]['id']?>&typechild=<?=@$_GET['typechild']?>" title="" class="smallButton tipS" original-title="Click để ẩn"><img src="./images/icons/color/tick.png" alt=""></a>
        <?php
		}
		else
		{
		?>
           <a href="index.php?com=product&act=man&spmoi=<?=$items[$i]['id']?>&typechild=<?=@$_GET['typechild']?>" title="" class="smallButton tipS" original-title="Click để hiện"><img src="./images/icons/color/hide.png" alt=""></a>
       <?php }
        ?>     
       
           
        </td>

        <?php }?>
        

       <?php if ($check_noibat=="on") {?> 
        
        <td align="center">
       
       
       <?php
		if($items[$i]['spnoibat']>0)
		{
		?>
	 <a href="index.php?com=product&act=man&spnoibat=<?=$items[$i]['id']?>&typechild=<?=@$_GET['typechild']?>" title="" class="smallButton tipS" original-title="Click để ẩn"><img src="./images/icons/color/tick.png" alt=""></a>
        <?php
		}
		else
		{
		?>
           <a href="index.php?com=product&act=man&spnoibat=<?=$items[$i]['id']?>&typechild=<?=@$_GET['typechild']?>" title="" class="smallButton tipS" original-title="Click để hiện"><img src="./images/icons/color/hide.png" alt=""></a>
       <?php }
        ?>     
       
           
        </td>

        <?php }?>


		
		<?php if ($check_hot=="on") {?> 
        
        <td align="center">
       
       
       <?php
		if($items[$i]['sphot']>0)
		{
		?>
	 <a href="index.php?com=product&act=man&sphot=<?=$items[$i]['id']?>&typechild=<?=@$_GET['typechild']?>" title="" class="smallButton tipS" original-title="Click để ẩn"><img src="./images/icons/color/tick.png" alt=""></a>
        <?php
		}
		else
		{
		?>
           <a href="index.php?com=product&act=man&sphot=<?=$items[$i]['id']?>&typechild=<?=@$_GET['typechild']?>" title="" class="smallButton tipS" original-title="Click để hiện"><img src="./images/icons/color/hide.png" alt=""></a>
       <?php }
        ?>     
       
           
        </td>

        <?php }?>

		
		
      <?php if ($check_rating=="on") {?>  

       <td class="title_name_data">
            <a href="index.php?com=product&act=man_rating&id_product=<?=$items[$i]['id']?>" class="tipS SC_bold">Review</a>
        </td>

    <?php }?>    
      
       
	   
	    
	   
        <td align="center">
           <?php 
			if(@$items[$i]['hienthi']==1)
				{
		?>
            <a href="index.php?com=product&act=man&typechild=<?=@$_GET['typechild']?>&hienthi=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Click để ẩn"><img src="./images/icons/color/tick.png" alt=""></a>
            <?php } else { ?>
         <a href="index.php?com=product&act=man&typechild=<?=@$_GET['typechild']?>&hienthi=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Click để hiện"><img src="./images/icons/color/hide.png" alt=""></a>
         <?php } ?>
        </td>
        
        <td class="actBtns">
            <a href="index.php?com=product&act=edit&typechild=<?=@$_GET['typechild']?>&id=<?=$items[$i]['id']?>&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id_item=<?=$items[$i]['id_item']?>&id_sub=<?=$items[$i]['id_sub']?>" title="" class="smallButton tipS" original-title="Sửa sản phẩm"><img src="./images/icons/dark/pencil.png" alt=""></a>
            <a href="index.php?com=product&act=delete&typechild=<?=@$_GET['typechild']?>&id=<?=$items[$i]['id']?>&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>" onclick="CheckDelete('index.php?com=product&act=delete&typechild=<?=@$_GET['typechild']?>&id=<?=$items[$i]['id']?>&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id_item=<?=$items[$i]['id_item']?>&id_sub=<?=$items[$i]['id_sub']?>'); return false;" title="" class="smallButton tipS" original-title="Xóa sản phẩm"><img src="./images/icons/dark/close.png" alt=""></a>        </td>
      </tr>
         <?php } ?>
                </tbody>
    
    
    
  </table>
</div>
</form>