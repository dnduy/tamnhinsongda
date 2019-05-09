<?php if(!defined('_lib')) die("Error");
class AdminTools{
	public $permission;
	public $all_permission;
	public $d;
	public function getListPer(){
		$tmp = array();
		$tmp2= array();
		if(is_array(@$this->permission)){
			foreach(@$this->permission as $k=>$v){
				$tmp2[$v['per_id']] = $v;
			}
		}
		$this->d->query("select * from #_permission");
		
		foreach($this->d->result_array() as $k=>$v){
			if(isset($tmp2[$v['id']])){	
			
				$xtmp = array();
				
				if($v['man_exec']){
					$xtmp[$v['man_exec']] = $tmp2[$v['id']]['has_man'];
				}
				if($v['edit_exec']){
					$xtmp[$v['edit_exec']] = $tmp2[$v['id']]['has_edit'];
				}
				if($v['delete_exec']){
					$xtmp[$v['delete_exec']] = $tmp2[$v['id']]['has_delete'];
				}
				if($v['add_exec']){
					$xtmp[$v['add_exec']] = $tmp2[$v['id']]['has_add'];
				}
				if($v['id_exec'] > 0){
					$xtmp['id'] = $v['id_exec'];
				}
				if($v['com_act']){
					$xtmp['com_act'] = $v['com_act'];
				}
				
				if($v['data_table']){
					$xtmp['data_table'] = $v['data_table'];
				}
				
				if($v['typechild']){
					$xtmp['typechild'] = $v['typechild'];
				}
				if($v['typeparent']){
					$xtmp['typeparent'] = $v['typeparent'];
				}
				$xtmp[$v['act_exec']] = $tmp2[$v['id']]['has_act'];
				$tmp[$v['com']][] = $xtmp;
				
			}	
		}
		$this->permission=$tmp;	
		
	}
	public function __construct($d) {
		$this->d = $d;
		
		if(isset($_SESSION['login_admin'])){
		$this->d->query("select * from #_user_permission where user_id =".$_SESSION['login_admin']['role']);
			foreach($this->d->result_array() as $k=>$v){
				
				$this->permission[] = $v;
			}
			
		
			
			$this->d->query("select * from #_permission");
			foreach($this->d->result_array() as $k=>$v){
				$this->all_permission[$v['com']][] = $v;
			}
		}
		$tmp = array();
		$this->getListPer();		
		
		
    }
	
	public function setFlash($name,$msg,$type="success"){
		$_SESSION[$name]['msg'] = $msg;
		$_SESSION[$name]['type'] = $type;
	}
	public function getFlash($name){
		if(isset($_SESSION[$name])){
		$data = $_SESSION[$name];
		unset($_SESSION[$name]);
		return $data;	
		}
		return false;
	}
	public  function displayFlash($name){
		$data = $this->getFlash($name);
		
		if(is_array($data)){
			echo '<div style="width: 600px;margin: 10px auto;" class="alert fade in alert-dismissible alert-'.$data['type'].'" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'.$data['msg'].'</div>';
			echo '<script>$().ready(function(){setTimeout(function(){$(".alert .close").click();},1500);})</script>';
		}
	}
	public function insertMsg($stt=true){
		if($stt){
			$this->setFlash("status_database","Thêm thành công!");
		}else{
			$this->setFlash("status_database","Thêm thất bại!","error");
		}
	}
	public function updateMsg($stt=true){
		if($stt){
			$this->setFlash("status_database","Cập nhật thành công!");
		}else{
			$this->setFlash("status_database","Cập nhật thất bại!","error");
		}
	}
	public function showDbStatus(){
		$this->displayFlash("status_database");
	}
	
	function generateMenu($com,$act,$name,$data_table,$id=null){
	
				
		$this->checkIssetPermission($com,$act,$name,$data_table,$id);
		
		
		if ($_GET["com"]==$com)
				{
					$this_active='this';
	
				}
		
		if(isset($this->permission[$com])){
			
			$p = false;
			
			foreach($this->permission[$com] as $k=>$v){
				
				foreach($v as $k3=>$v3){
					if($v3){
						
						foreach($act as $k2=>$v2){
							
							if($p==false){
								
								if($v2==$k3){
									
									if(isset($v['id'])){
										if($v['id'] == $id & $v[end($act)] == 1){
											$p = true;
										}else{
											$p = false;
										}
									}else{
						
										$p = true;
									}
								}	
							}
						}
					}
				}
			}
			if($p){
				
			
		
			
				
				if($id!=null)
				{
					
					return '<li  class='.$this_active.'  ><a href="index.php?com='.$com.'&act='.end($act).'&id='.$id.'">'.$name.'</a></li>  ';
				}else{
					return '<li class='.$this_active.' ><a href="index.php?com='.$com.'&act='.end($act).'">'.$name.'</a></li>  ';
				}
			}
			return false;
		}
		if($_SESSION['login_admin']['role'] == 3){
				if($id!=null){
					
					return '<li class='.$this_active.' ><a href="index.php?com='.$com.'&act='.end($act).'&id='.$id.'">'.$name.'</a></li>  ';
				}else{
					return '<li class='.$this_active.' ><a href="index.php?com='.$com.'&act='.end($act).'">'.$name.'</a></li>  ';
				}
			
		
		}
	}

	function generateMenuType($com,$act,$name,$id=null,$typechild,$data_table){
		
		
		$this->checkIssetPermissionType($com,$act,$name,$id,$typechild,$data_table);
		

		
		if ( ($_GET["com"]==$com) &&  ($_GET["act"]==$act["man_exec"]) )
		{
			
			$this_active="this";
			
		}
		
		if(isset($this->permission[$com])){
			
			$p = false;
			
			foreach($this->permission[$com] as $k=>$v){
				
				foreach($v as $k3=>$v3){
					if($v3){
						
						foreach($act as $k2=>$v2){
							
							if($p==false){
								
								if($v2==$k3){
									
									if(isset($v['id'])){
										if($v['id'] == $id & $v[end($act)] == 1){
											$p = true;
										}else{
											$p = false;
										}
									}else{
						
										$p = true;
									}
								}	
							}
						}
					}
				}
			}
			if($p){
				if($id!=null){
					
					return '<li class='.$this_active.'><a href="index.php?com='.$com.'&act='.end($act).'&id='.$id.'&typechild='.$typechild.'">'.$name.'</a></li>  ';
				}else{
					return '<li class='.$this_active.'><a href="index.php?com='.$com.'&act='.end($act).'&typechild='.$typechild.'">'.$name.'</a></li>  ';
				}
			}
			return false;
		}
		if($_SESSION['login_admin']['role'] == 3){
				if($id!=null){
					
					return '<li class='.$this_active.'><a href="index.php?com='.$com.'&act='.end($act).'&id='.$id.'&typechild='.$typechild.'">'.$name.'</a></li>  ';
				}else{
					return '<li class='.$this_active.'><a href="index.php?com='.$com.'&act='.end($act).'&typechild='.$typechild.'">'.$name.'</a></li>  ';
				}
			
		
		}
	}
	function generateMenuTypeList($com,$act,$name,$id=null,$typeparent,$data_table){
		
		$this->checkIssetPermissionTypeList($com,$act,$name,$id,$typeparent,$data_table);
		
		
		if ( ($_GET["com"]==$com) &&  ($_GET['act']==$act["man_exec"]) )
		{
			
			
			$this_active='this';
		}
		
		if(isset($this->permission[$com])){
			
			$p = false;
			
			foreach($this->permission[$com] as $k=>$v){
				
				foreach($v as $k3=>$v3){
				
					if($v3){
						
						foreach($act as $k2=>$v2){
							
							if($p==false){
								
								if($v2==$k3){
									
									if(isset($v['id'])){
										if($v['id'] == $id & $v[end($act)] == 1){
											$p = true;
										}else{
											$p = false;
										}
									}else{
						
										$p = true;
									}
								}	
							}
						}
					}
				}
			}
			if($p){
				
				if($id!=null){
					return '<li class='.$this_active.'><a href="index.php?com='.$com.'&act='.end($act).'&id='.$id.'&typeparent='.$typeparent.'">'.$name.'</a></li>  ';
				}else{
					
					return '<li class='.$this_active.'><a href="index.php?com='.$com.'&act='.end($act).'&typeparent='.$typeparent.'">'.$name.'</a></li>  ';
				}
			}
			return false;
		}
	
		if($_SESSION['login_admin']['role'] == 3){
				if($id!=null){
					return '<li class='.$this_active.'><a href="index.php?com='.$com.'&act='.end($act).'&id='.$id.'&typeparent='.$typeparent.'">'.$name.'</a></li>  ';
				}else{
					return '<li class='.$this_active.'><a href="index.php?com='.$com.'&act='.end($act).'&typeparent='.$typeparent.'">'.$name.'</a></li>  ';
					
				}
			
		
		}
	}
	function checkIssetPermission($com,$act,$name,$data_table,$id){
		$this->addingPermission($com,$act,$name,$data_table,$id);
	
	
	}
	function checkIssetPermissionTypeList($com,$act,$name,$id,$typeparent,$data_table){
		
		$this->addingPermissionTypeList($com,$act,$name,$id,$typeparent,$data_table);
	
	
	}
	function checkIssetPermissionType($com,$act,$name,$id,$typechild,$data_table){
		$this->addingPermissionType($com,$act,$name,$id,$typechild,$data_table);
	
	
	}
	public function addingPermission($com,$act = array(),$name,$data_table,$id){
		
		$per = '';
		$xper = array();
		foreach($act as $k=>$v){
			$per = $k." = '".$v."'";
			$xper[$k] = $v;
			$act_exec=$v;
		}
		
		if(!$id){
			$this->d->query("select * from #_permission where com='".$com."' and data_table='".$data_table."' and   ".$per);
		}else{
			$this->d->query("select * from #_permission where com='".$com."' and ".$per." and data_table='".$data_table."' and id_exec=".$id);
		}

		if($this->d->num_rows() == 0){
			
			$act['name'] = $name;
			$act['com'] = $com;
			$act['com_act'] = $com.'_'.$act_exec;
			$act['data_table']=$data_table;
			
	
			
			if($id){
				$act['id_exec'] = $id;
			}
			$sql="select * from #_permission where com='".$com."' and com_act='".$act['com_act']."' and data_table='".$act['data_table']."'  ";
			$this->d->query($sql);
			
			if(!$this->d->num_rows()){
				$this->d->setTable("permission");
				$this->d->insert($act);				
			}else{
				$this->d->setTable("permission");
				$this->d->setWhere("com",$com);
				unset($act['name']);
				if($this->d->update($xper));		
			}

		}
	}
	public function addingPermissionType($com,$act = array(),$name,$id,$typechild,$data_table){
		
		$per = '';
		$xper = array();
		foreach($act as $k=>$v){
			$per = $k." = '".$v."'";
			$xper[$k] = $v;
			$act_exec=$v;
		}
		if(!$id){
			$this->d->query("select * from #_permission where com='".$com."' and  ".$per." and typechild='".$typechild."' and data_table='".$data_table."' ");
		}else{
			$this->d->query("select * from #_permission where com='".$com."' and ".$per." and id_exec=".$id." and typechild='".$typechild."'");
		}

		if($this->d->num_rows() == 0){
			
			$act['name'] = $name;
			$act['com'] = $com;
			$act['typechild'] = $typechild;
			$act['com_act'] = $com.'_'.$act_exec;
			$act["data_table"]=$data_table;
			
			if($id){
				$act['id_exec'] = $id;
			}
			$sql="select * from #_permission where com='".$com."' and com_act='".$act['com_act']."' and typechild='".$act['typechild']."' and data_table='".$act["data_table"]."' ";
			$this->d->query($sql);
			
			if(!$this->d->num_rows()){
				$this->d->setTable("permission");
				$this->d->insert($act);				
			}else{
				$this->d->setTable("permission");
				$this->d->setWhere("com",$com);
				unset($act['name']);
				if($this->d->update($xper)) ;		
			}

		}
	}
	public function addingPermissionTypeList($com,$act = array(),$name,$id,$typeparent,$data_table){
		
		$per = '';
		$xper = array();
		foreach($act as $k=>$v){
			$per = $k." = '".$v."'";
			$xper[$k] = $v;
			$act_exec=$v;
		}
		
		if(!$id){
			$this->d->query("select * from #_permission where com='".$com."' and  ".$per."  and typeparent='".$typeparent."' and data_table='".$data_table."' ");
		}else{
			$this->d->query("select * from #_permission where com='".$com."' and ".$per." and id_exec=".$id." and typeparent='".$typeparent."'");
		}
		
		if($this->d->num_rows() == 0){
			//echo 'a'; die();
			$act['name'] = $name;
			$act['com'] = $com;
			$act['typeparent'] = $typeparent;
			$act['typechild'] = $typechild;
			$act['data_table']=$data_table;
			$act['com_act'] = $com.'_'.$act_exec;
			
			
			
			if($id){
				$act['id_exec'] = $id;
			}
			$sql="select * from #_permission where com='".$com."' and com_act='".$act['com_act']."' and typeparent='".$typeparent."' and data_table='".$act['data_table']."' ";
			$this->d->query($sql);
			
			if($this->d->num_rows()==0){
				$this->d->setTable("permission");
				$this->d->insert($act);	
				unset($act);
			}else{
				$this->d->setTable("permission");
				$this->d->setWhere("com",$com);
				$this->d->setWhere("com_act",$act['com_act']);
				$this->d->setWhere("typechild",$act['typechild']);
				$this->d->setWhere("typeparent",$act['typeparent']);
				unset($act);
				if($this->d->update($xper)) ;
			}

		}
	}
	function checkIssetPermission_check($com,$act,$name,$id){
		$this->addingPermission_check($com,$act,$name,$id);
	
	
	}
	public function addingPermission_check($com,$act = array(),$name,$id){
		
		$per = '';
		$xper = array();
		foreach($act as $k=>$v){
			$per = $k." = '".$v."'";
			$xper[$k] = $v;
			$act_exec=$v;
		}
		
		if(!$id){
			$this->d->query("select * from #_permission where com='".$com."' and  ".$per);
		}else{
			$this->d->query("select * from #_permission where com='".$com."' and ".$per." and id_exec=".$id);
		}

		if($this->d->num_rows() == 0){
			
			$act['name'] = $name;
			$act['com'] = $com;
			$act['com_act'] = $com.'_'.$act_exec;
			
			if($id){
				$act['id_exec'] = $id;
			}
			$sql="select * from #_permission where com='".$com."'";
			
			$this->d->query($sql);
			
			if(!$this->d->num_rows()){
				$this->d->setTable("permission");
				$this->d->insert($act);				
			}else{
				$this->d->setTable("permission");
				$this->d->setWhere("com",$com);
				unset($act['name']);
				if($this->d->update($xper));		
			}

		}
	}
	function execPer(){
		
		$accept = array("save","save_list", "save_cat","save_photo","capnhat","logout","login");
		if(!in_array($_GET['act'],$accept)){
		if(!$this->checkPermissionWhenExecute()){
			transfer("Bạn không có quyền thực hiện hành động này !!!", $_SERVER['HTTP_REFERER']);
		}
		}
	}
	function checkPermissionWhenExecute(){
		$p = false;
		$com = $_GET['com'];
		$act = $_GET['act'];
		$multi_del=$_REQUEST["multi"];
		$multi_show=$_REQUEST["multi"];
		$multi_hide=$_REQUEST["multi"];
		$typeparent=$_GET["typeparent"];
		$typechild=$_GET["typechild"];
		
		$act_com = $_GET['com'].'_'.$_GET['act'];
		$id = $_GET['id'];
		if($com==""){ return true;}
		if($_SESSION['login_admin']['role'] == 3){
			
			return true;
		}
		//echo 'a'; die();
		if($act=="admin_edit"){
			return true;
		}
		if($act=="add_list" || $act=="add_cat" || $act=="add_item" || $act=="add_sub" || $act=="add_categories" || $act=="add_color" || $act=="add_size" ||$act=="add_photo"||$act=="add"){
			$has_act="add";
		}
		if($act=="edit_list" || $act=="edit_cat" || $act=="edit_item" || $act=="edit_sub" || $act=="edit_categories" || $act=="edit_color" || $act=="edit_size" || $act=="edit_photo"|| $act=="edit" || $multi_show=="show" || $multi_hide=="hide"){
			$has_act="edit";
		}
		if($act=="delete_list"|| $act=="delete_cat" || $act=="delete_item" || $act=="delete_sub" || $act=="delete_categories" || $act=="delete_color" || $act=="delete_size" || $act=="delete_photo" || $act=="delete" || $multi_del=="del"){

			$has_act="delete";
		}
		if($act=="man_list" || $act=="man_cat" || $act=="man_item" || $act=="man_sub" || $act=="man_categories" || $act=="man_color" || $act=="man_size" || $act=="man_photo"||$act=="man"||$act=="man_brand"||$act=="man_ncc"||$act=="load"||$act=="add_user_to_per"){
			$has_act="man";
		}
		
		if(isset($this->permission[$com])){	
			
			foreach($this->permission[$com] as $k=>$v){
				if($typeparent!=''){
				
					$this->d->query("select * from #_permission where com='".$com."'  and typeparent='".$typeparent."'");
				}else if($typechild!=''){
					$this->d->query("select * from #_permission where com='".$com."' and typechild='".$typechild."'");
				}else{
					$this->d->query("select * from #_permission where com='".$com."' order by id desc");
				}
				$rs=$this->d->fetch_array();
				//dump($rs);
				$this->d->query("select * from #_user_permission where per_id='".$rs["id"]."' and user_id='".$_SESSION["login_admin"]["role"]."' ");
				$rs_per=$this->d->fetch_array();
				
				//dump($rs_per);
				if($has_act=="add"){
					if($rs_per["has_add"]==1) return true; else return false;
				}else if($has_act=="edit" || ( $multi_show=="show" || $multi_hide=="hide" )){
					
				if($rs_per["has_edit"]==1   ) return true; else return false;
				}else if($has_act=="delete" || ( $multi_del=="del" ) ) {
							
					if($rs_per["has_delete"]==1) return true; else return false;
					
				}else if($has_act=="man"){
					if($rs_per["has_man"]==1) return true; else return false;
				}
				
				
			}
		}
		$has_per  = array("edit","add","delete");
		
		if(in_array($_GET['act'],$has_per)){
			$this->checkIssetPermission_check($com,array($_GET['act']."_exec"=>$_GET['act']),null,null);
		}
		
		
	}
	
	function checkAct($arr,$act){
		return ;
	
	}
}