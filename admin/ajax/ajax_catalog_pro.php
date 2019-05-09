<?php 
	error_reporting(0);
	session_start();
	$session=session_id();
	@define ( '_template' , '../templates/');
	@define ( '_source' , '../sources/');
	@define ( '_lib' , '../../libraries/');

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";	
	$d = new database($config['database']);
	

	if (isset($_POST["level"])) {
		$level = $_POST["level"];

		 $table = $_POST["table"];
		 $id=$_POST["id"];
		$name_id=$_POST["name_id"];
		$name_id_child=$_POST["name_id_child"];
		 $type = $_POST["type"];
		 
		 
		 if($type!=0)
		switch ($level) {
			case '1':{
				$id_temp= "id_list";
				break;
			}
			case '2':{
				$id_temp= "id_parent";
				break;
			}
			case '3':{
				$id_temp= "id_parent";
				break;
			}
			default:
				echo 'error ajax'; exit();
				break;
		}
		else
		switch ($level) {
			case '1':{
				$id_temp= "id_list";
				break;
			}
			case '2':{
				$id_temp= "id_cat";
				break;
			}
			case '3':{
				$id_temp= "id_item";
				break;
			}
			default:
				echo 'error ajax'; exit();
				break;
		}
		 
		 
		$sql="select * from ".$table." where $name_id=".$id." ";
		if($type!='')
		{
			$sql.=" and com='video' ";
		}
		
		
		$sql.=" order by stt,$name_id_child desc ";
		

		
		if ($level=="1")
		{
			$stmt=mysql_query($sql);
			$str='
				<option>Chọn Danh mục cấp 2</option>			
				';
			while ($row=@mysql_fetch_array($stmt)) 
			{
				if($row["id"]==(int)@$id_select)
					$selected="selected";
				else 
					$selected="";

				$str.='<option value='.$row["id"].' '.$selected.'> '.$row["ten_vi"].'</option>';			
			}
		}
		
		
		if ($level=="2")
		{
			$stmt=mysql_query($sql);
			$str='
				<option>Chọn Danh mục cấp 3</option>			
				';
			while ($row=@mysql_fetch_array($stmt)) 
			{
				if($row["id"]==(int)@$id_select)
					$selected="selected";
				else 
					$selected="";

				$str.='<option value='.$row["id"].' '.$selected.'> '.$row["ten_vi"].'</option>';			
			}
		}
		
		
		
		
		

		

		echo  $str;
		
		
		//	$result = array('id' => $id, 'level' => $level);

			//echo json_encode($result);
				
		
	}
	

?>
