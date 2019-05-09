<?php  if(!defined('_source')) die("Error");

		$id_dh=$_GET['id_dh'];
		$id_detail=$_GET['id'];
			//print_r($id_dh);
		if($id_dh!=''){
		
		
		
		// break crumb
		$breakcrumb='<a class="no_active" href="http://'.$config_url.'">'._trangchu.'</a> <span> / </span>';
		


		$breakcrumb.='<a  >'._kiemtradonhang.'</a> <span>  </span>';
		
		
		//kiểm tra bộ lọc
		switch(@$_GET['sortby']){
			case "0":
				$sortby = " order by stt asc,id desc";
				break;
			case "1":
				$sortby = " order by  hoten asc";
				break;
			case "2":		
				$sortby = " order by hoten desc";
				break;
			case "3":		
				$sortby = " order by tonggia desc";
				break;
			case "4":
				$sortby = " order by tonggia asc";
				break;


			default:
				$sortby = " order by stt asc,id desc";
		}
		
		// lấy time lich su don hang
		
		// lấy loại tin rao
		@$timeLimit=(int)$_GET['timeLimit'];
		
		
		
		if ($timeLimit!=0)
		{
			if ($timeLimit==1)
			{
			
			@$songay=15;
			$sortby_timeLimit=" and ".countDays(date("Y-m-d","ngaytao"))." <= ".@$songay."  ";
			
			
			}
			
			if ($timeLimit==2)
			{
			@$songay=30;
			$sortby_timeLimit=" and  ".countDays(date("Y-m-d","ngaytao"))." <= ".@$songay." ";
			print_r($sortby_timeLimit);
			}
			
			if ($timeLimit==3)
			{
			@$songay=180;
			$sortby_timeLimit=" and  ".countDays(date("Y-m-d","ngaytao"))." <= ".@$songay." ";
			//print_r($sortby_timeLimit);
			}
		}

		
		//lấy số tin dang trong 1 trang
		@$limit=(int)$_GET['limit'];

		$sql="SELECT count(id) AS numrows FROM #_order where hienthi=1 and id='".$id_dh."' ";
		$d->query($sql);	
		$dem=$d->fetch_array();
		$totalRows=$dem['numrows'];
		$page=$_GET['curPage'];
		
		$pageSize=4;
		if($limit){
			$pageSize=$limit;
		}
		$offset=5;
							
		if ($page=="")
			$page=1;
		else 
			$page=$_GET['curPage'];
		$page--;
		$bg=$pageSize*$page;	
		
		
			//Lay thong tin DON HANG theo user
			$d->reset();
			$sql="select * from #_order where hienthi=1 and id='".$id_dh."' ".$sortby_timeLimit." ".$sortby."  limit $bg,$pageSize ";
			$d->query($sql);
			$items_order=$d->result_array();
		
			$sequence = isset($_GET['sortby']) ? "sortby=".$_GET['sortby']."/" : "";
			$url_link="http://".$config_url."/".$_REQUEST["com"]."/".$_REQUEST["act"]."/".$sequence."page";	
			
			if(!empty($_POST))
				{
				$multi=$_REQUEST['multi'];
				$id_array=$_POST['chon'];
				$count=count($id_array);
				
					
					if($multi=='del')
					{
						for($i=0;$i<$count;$i++)
						{
							$sql="SELECT * FROM table_order where id='".$id_array[$i]."'";
							$d->query($sql);
							$cats= $d->fetch_array();
						
							$sql = "delete from table_order where id = ".$id_array[$i]."";
							mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
						}
						redirect("http://".$config_url."/".$_REQUEST["com"]."/".$_REQUEST["act"]."/member");			
					}
					
				
				}
			
		}
		
		
		if($id_detail!='')
		{
			
			
					
		// break crumb
		$breakcrumb='<a class="no_active" href="http://'.$config_url.'">'._trangchu.'</a> <span> / </span>';
		


		$breakcrumb.='<a  >'._kiemtradonhang.'</a> <span>  </span>';
		
		
			$id_detail=$_GET["id"];
			
			$d->reset();
			$sql="select * from #_order where   id='".$id_detail."' order by id desc ";
			$d->query($sql);
			$item_info=$d->fetch_array();	
		
			
		}

	
	
?>