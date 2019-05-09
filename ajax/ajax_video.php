<?php
 	error_reporting(0);
    session_start();
    $session=session_id();
    date_default_timezone_set('Asia/Saigon');
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
	
	@$id_list = $_GET['id_list'];
	@$id_cat = $_GET['id_cat'];
	@$id_item = $_GET['id_item'];
	if ($id_list!="")
	{
		
			$d->reset();
			$sql_v_l = "select * from #_news_list where id='".$id_list."' and com='video' order by id desc";
			$d->query($sql_v_l);
			$video_list = $d->fetch_array();
			
			if ($video_list["id"]!="")
			{
				$where_video.=" and id_list='".$video_list["id"]."' ";
			}
		
	}
	
	
	if ($id_cat!="")
	{
		
			$d->reset();
			$sql_v_l = "select * from #_news_cat where id='".$id_cat."' and com='video' order by id desc";
			$d->query($sql_v_l);
			$video_cat = $d->fetch_array();
			
			if ($video_cat["id"]!="")
			{
				$where_video.=" and id_cat='".$video_cat["id"]."' ";
			}
		
	}
	
	if ($id_item!="")
	{
		
			$d->reset();
			$sql_v_l = "select * from #_news_cat where id='".$id_item."' and com='video' order by id desc";
			$d->query($sql_v_l);
			$video_item = $d->fetch_array();
			
			if ($video_item["id"]!="")
			{
				$where_video.=" and id_item='".$video_item["id"]."' ";
			}
		
	}
	
		
	$d->reset();
	$sql_video = "select * from #_news where hienthi=1 and  com='video' $where_video order by id desc";
	$d->query($sql_video);
	$video_index = $d->result_array();
	

?>

<?php
  $url = $video_index[0]["link"];
  preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $matches);

  
?>

<div class="vid-container">
					<?=convertYoutube($video_index[0]['link'])?>
					</div>
				
				
							
							<!-- THE PLAYLIST -->
					<div class="vid-list-container">
						<div class="vid-list">
							
						<?php foreach ($video_index as $i =>$v) {?>	
							<div class="vid-item" onClick="document.getElementById('vid_frame').src='<?=getYoutubeEmbedUrl($v["link"])?>'">
							  
							  <div class="thumb"><img src="<?=video_image($v['link'])?>"></div>
							 
							</div>
							
						<?php }?>	
						  
						</div><!--end vid-list-->
						
					</div><!--end vid-list-container-->
					
					
					<!-- LEFT AND RIGHT ARROWS -->
					<?php if (count($video_index)>4) {?>
					<div class="arrows">
						<div class="arrow-left"><i class="fa fa-chevron-left fa-lg"></i></div>
						<div class="arrow-right"><i class="fa fa-chevron-right fa-lg"></i></div>
					</div>
					<?php }?>

					
					<!-- JS FOR SCROLLING THE ROW OF THUMBNAILS -->
				<script type="text/javascript">
					$(document).ready(function () {
						$(".arrow-right").bind("click", function (event) {
							event.preventDefault();
							$(".vid-list-container").stop().animate({
								scrollLeft: "+=336"
							}, 750);
						});
						$(".arrow-left").bind("click", function (event) {
							event.preventDefault();
							$(".vid-list-container").stop().animate({
								scrollLeft: "-=336"
							}, 750);
						});
					});
				</script>
