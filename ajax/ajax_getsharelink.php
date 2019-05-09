<?php
	error_reporting(0);
	session_start();
	$session=session_id();
	
	@define ( '_template' , '../templates/');
	@define ( '_source' , '../sources/');
	@define ( '_lib' , '../libraries/');
	@define ( _upload_folder , '../media/upload/' );
	
	//Lưu ngôn ngữ chọn vào $_SESSION
	$lang_arr=array("vi","en","ge");
	if (isset($_GET['lang']) == true){
        if (in_array($_GET['lang'], $lang_arr)==true){
            $lang = $_GET['lang'];
            $_SESSION['lang']=$lang;
		  header('Location: '.$_SERVER['HTTP_REFERER']);
        } 
	}
    if(isset($_SESSION['lang'])){
        $lang= $_SESSION['lang'];
    }else{
        $lang="vi";
    }
	require_once _source."lang_$lang.php";	

    include_once _lib."config.php";
    include_once _lib."constant.php";
    include_once _lib."functions.php";
    include_once _lib."class.database.php";
	$d = new database($config['database']);
	
	if(isset($_GET['id_user'])){
		$id_user=$_GET['id_user'];
	?>
		<script src="js/jquery-1.11.2.min.js"></script>
		<link rel="stylesheet" href="js/remodal/remodal.css">
  		<link rel="stylesheet" href="js/remodal/remodal-default-theme.css">
  		<script src="js/remodal/remodal.js"></script>
	<?php
		echo $id_user; 

		// //Lay quan huyen tu tinh thanh
		// $d->reset();
		// $sql_tinh="select id,ten_$lang from #_city_cat where id_list='".$id_list."'and hienthi =1 order by stt asc";
		// $d->query($sql_tinh);
		// $quanhuyen = $d->result_array();
		// echo'<option value="">'._chon.'</option>';
		// if(!empty($quanhuyen)){
		// 	for($i=0,$count_quan=count($quanhuyen);$i<$count_quan;$i++) { 
	 //             echo'<option value="'.$quanhuyen[$i]['id'].'">'.$quanhuyen[$i]["ten_$lang"].'</option>';
		// 	}
		// }
	?>
		
		<a href="#modal"></a>

		<div class="remodal" data-remodal-id="modal" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
			<button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
			<div>
				<h2 id="modal1Title">Remodal</h2>
				<p id="modal1Desc">
		  				Responsive, lightweight, fast, synchronized with CSS animations, fully customizable modal window plugin
		 				with declarative state notation and hash tracking.
				</p>
			</div>
			<br>
			<!-- <button data-remodal-action="cancel" class="remodal-cancel">Cancel</button> -->
			<button data-remodal-action="confirm" class="remodal-confirm">OK</button>
		</div>
		<script type="text/javascript">
			$().ready(function(){
				$("a#modal").trigger('click');
			})
		</script>

	<?php }


	die();
?>