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

	if(isset($_POST['id_list'])){
		$id_list=$_POST['id_list'];
		//Lay quan huyen tu tinh thanh
		$d->reset();
		$sql="select id,ten_$lang from #_product where id_list='".$id_list."'and hienthi =1 order by stt,id desc";
		$d->query($sql);
		$arr_pro = $d->result_array();

		echo'<option value="">Chọn sản phẩm</option>';
		if(!empty($arr_pro)){
			foreach($arr_pro as $pro) { 
	             echo'<option value="'.$pro['id'].'">'.$pro["ten_$lang"].'</option>';
			}
		} 

	?>

			<script type="text/javascript">
				$().ready(function(){
					$("#sele_name_pro").change(function(){
						$id_product = $(this).val();
						if($id_product!=''){
							$.ajax({
								url: 'ajax/ajax_get_link.php',
								type: 'post',
								data: {id_product:$id_product,id_user:<?=$_SESSION['login_member']['id']?>},
								success: function(data){
									$("#link_share").text(data);
								}
							})
						}else{
							$("#link_share").text('');
						}
						
						$("#link_share").focus(function() {
						    var $this = $(this);
						    $this.select();

						    // Work around Chrome's little problem
						    $this.mouseup(function() {
						        // Prevent further mouseup intervention
						        $this.unbind("mouseup");
						        return false;
						    });
						});

					});
				})
			</script>

	<?php
	}else{
		echo'<option value="">'._chonsp.'</option>';
	}
	

?>