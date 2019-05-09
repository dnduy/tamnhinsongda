<?php 

    $d->reset();
  $sql="select ten_$lang,tenkhongdau_$lang,id,photo,mota_$lang,link from #_video where hienthi=1 and com='video'  order by stt asc";
  $d->query($sql);
  $video_clip=$d->result_array();


	$d->reset();
	$sql="select ten_$lang as ten, link, photo from #_image_url where hienthi=1 and com='doitac' order by stt,id desc";
	$d->query($sql);
	$doitac= $d->result_array();
	  
  	$d->reset();
	$sql = "select ten_$lang as ten,mota_$lang as mota, toado from #_bando where hienthi=1 and com='bando' order by stt,id desc";
	$d->query($sql);
	$footer_bando=$d->fetch_array();
	
	
	
	$d->reset();
	$sql="select ten_$lang as ten, tenkhongdau_$lang as tenkhongdau, id,mota_$lang as mota,photo from #_news where hienthi=1 and com='news' and tinnoibat>0 order by id desc limit 4";
	$d->query($sql);
	$tintuc_index=$d->result_array();


?>







<div class="container-fluid">

	<div class="row pd0 mg0">
	
	<div class="bg_video_news ">
	
		<div class="main_video_news container  ">
		
	
			<div class="left-news-index col-lg-8 col-md-8 col-sm-6 col-xs-12 pd0 mg0 des320">
			
				
				<div class="title-bg-web">
					<h3 class="title-bg-name"><span><a href="tin-tuc.html"><?=_tintucmoi?></a></span></h3>
					<div class="border_line"></div>
				</div>	
			
			
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 start_news_nb">
				
				
				
					<div class="frame_new_nb_firt">
					
						<div class="img_news_firt">
							<a href="tin-tuc/<?=$tintuc_index[0]["tenkhongdau"]?>-<?=$tintuc_index[0]["id"]?>.html">
								<img src="thumb/360x190/1/<?=_upload_news_l.$tintuc_index[0]["photo"]?>">
							</a>
						</div>
						
						
						<div class="name_news_firt">
							<a href="tin-tuc/<?=$tintuc_index[0]["tenkhongdau"]?>-<?=$tintuc_index[0]["id"]?>.html">
								<?=strip_tags(catchuoi($tintuc_index[0]["ten"],140))?>
							</a>
						</div>
						
						
						<div class="des_news_firt">
						<?=strip_tags(catchuoi($tintuc_index[0]["mota"],200))?>
						</div>
					
					</div><!--end frame_new_nb-->
				
				</div><!--end start_news_nb-->
				
				
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 list_news_nb">
				
					<div class="frame_new_nb_firt">
					<div class="row"> 
					<?php for ($i=1;$i<count($tintuc_index);$i++) {?>
						<div class="list_news_nb">
						
							<div class="list_box_news">
							
								<div class="left_list_box_news col-lg-3 col-md-4 col-sm-4 col-xs-4 pd0">
									<a href="tin-tuc/<?=$tintuc_index[$i]["tenkhongdau"]?>-<?=$tintuc_index[$i]["id"]?>.html">
									<img src="thumb/100x85/1/<?=_upload_news_l.$tintuc_index[$i]["photo"]?>">
									</a>
								</div><!--end list_box_news-->
							
								<div class="right_list_box_news col-lg-9 col-md-8 col-sm-8 col-xs-8">
									<a href="tin-tuc/<?=$tintuc_index[$i]["tenkhongdau"]?>-<?=$tintuc_index[$i]["id"]?>.html">
									<?=strip_tags(catchuoi($tintuc_index[$i]["ten"],30))?>
									</a>
									
								
									<p class="des_box_news">
									<?=strip_tags(catchuoi($tintuc_index[$i]["mota"],100))?>
									</p>
								
								</div>	
								
								
								<div class="clear"></div>
							
							</div><!--end list_box_news-->
						
						
						</div>
					<?php }?>
					
					</div>
					
					</div><!--end frame_new_nb_firt-->
				
				</div><!--end list_news_nb-->
			
			
			
			</div>
			
			<div class="right-video-index col-lg-4 col-md-4 col-sm-6 col-xs-12 pd0 mg0 des320">
			
			
			   <script type="text/javascript">
				  $(document).ready(function() {
					  $('.video_lienquan').click(function (){
					  var str = $(this).val();
							if(str != '')
					  $('#box_video').load("ajax/ajax_video.php?id="+str);
					  return false;
					});
				  });
				</script>
				
				<div class="video-index">
				
				<div class="title-bg-web">
				<h3 class="title-bg-name"><span><a>Video - Clip</a></span></h3>
				<div class="border_line"></div>
			</div>	
				
				
				
     <div id="box_video">
    
      <?php
  $url = $video_clip[0]["link"];
  preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $matches);

  
?>
      
   <iframe width="100%" height="280" src="https://www.youtube.com/embed/<?=$matches[1]?>" frameborder="0" allowfullscreen></iframe>
        
         
        
       </div><!--end box_video-->
       
       
         <div class="select_video" >

            <select class="video_lienquan">

         <?php for($i=0,$count_video=count($video_clip);$i<$count_video;$i++) { ?>      
            <option value="<?=$video_clip[$i]["id"]?>"><?=$video_clip[$i]["ten_$lang"]?></option>  
          <?php } ?>   
           
            </select>

            
        </div>
  

				
				
				</div><!--end video-index-->

			
			
			
			</div>
		
			
	
		<div class="clear"></div>		
		
		</div><!--end main_video_news-->
	
		<div class="clear"></div>
	
	</div><!--end bg_video_news-->
	
	<?php if (count($doitac)>0) {?>
	
	<script type="text/javascript">
	$(document).on('ready', function() {
		
		$(".slide_doitac_scroll").slick({
			
	dots: false,
  infinite: false,
    autoplaySpeed:3500,
  speed: 300,
  slidesToShow: 6,
  slidesToScroll: 1,
    arrows: false,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: false,
        dots: false
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }

  ]
	
		  });

		});
	  </script>

	
	<div class="bg-list-doitac">
	
	
		<div class="main-list-doitac container">
		
			
			<div >
		
			<ul class="slide_doitac_scroll">
		<?php foreach ($doitac as $i =>$v) {?>	
			<li><a href="<?=$v["link"]?>" target="_blank"><img src="thumb/170x110/2/<?=_upload_hinhanh_l.$v["photo"]?>"></a></li>
		<?php }?>	
			</ul>
			
			</div>
		
		</div><!--end doitac-->
	
	
	</div><!--end bg-list-doitac-->

	<?php }?>	
		
	<div class="map-index">
	
       <script type="text/javascript">
       var map;

       var infowindow;
       var marker= new Array();
       var old_id= 0;
       var infoWindowArray= new Array();
       var infowindow_array= new Array();

	   function initialize_footer(){
         var defaultLatLng = new google.maps.LatLng(<?=$footer_bando["toado"]?>);
         var myOptions= {
           zoom: 16,
		   animation: google.maps.Animation.DROP,
           center: defaultLatLng,
           scrollwheel : false,
           mapTypeId: google.maps.MapTypeId.ROADMAP,
		   icon: "http://blogs.technet.com/cfs-file.ashx/__key/communityserver-blogs-components-weblogfiles/00-00-01-01-35/e8nZC.gif"
        };
        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);map.setCenter(defaultLatLng);
          
         var arrLatLng = new google.maps.LatLng(<?=$footer_bando["toado"]?>);
         infoWindowArray[7895] = '<div class="map_description"><div class="map_title"><?=$footer_bando["ten"]?></div><div><?=$footer_bando["mota"]?> </div></div>';
         loadMarker(arrLatLng, infoWindowArray[7895], 7895);
         
         
         moveToMaker(7895);}
		 
         function loadMarker(myLocation, myInfoWindow, id)
         {
			 
			 marker[id] = new google.maps.Marker({
				 position: myLocation,
				 map: map, 
				  animation: google.maps.Animation.BOUNCE,
				  
				 visible:true
				 });
                 var popup = myInfoWindow;infowindow_array[id] = new google.maps.InfoWindow({ content: popup});
                 google.maps.event.addListener(marker[id], 'mouseover', function() {if (id == old_id) return;
         if (old_id > 0) infowindow_array[old_id].close();infowindow_array[id].open(map, marker[id]);old_id = id;});
         google.maps.event.addListener(infowindow_array[id], 'closeclick', function() {old_id = 0;});
		 
		 
		 
         }
		 function moveToMaker(id){
         var location = marker[id].position;map.setCenter(location);
         if (old_id > 0) infowindow_array[old_id].close();infowindow_array[id].open(map, marker[id]);old_id = id;
         }
		 
		 
		 function toggleBounce() {

  if (marker.getAnimation() != null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}
		 
        $().ready(function(){
         initialize_footer();
        })
         </script>
           <div id="map_canvas" style="border-radius:0;width:100%;height:365px;" ></div>
       <style>
       *{padding:0;margin:0;border:0}
       </style>
	
	</div><!--end map-index-->
		 
		
	
	</div>


</div>	

