<?php if(!defined('_lib')) die("Error");

ini_set ('memory_limit', '256M');


function convertYoutube($string) {
    return preg_replace(
        "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
        "<iframe id='vid_frame' src=\"//www.youtube.com/embed/$2\" allowfullscreen></iframe>",
        $string
    );
}


function getYoutubeEmbedUrl($url)
{
    $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_]+)\??/i';
    $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))(\w+)/i';

    if (preg_match($longUrlRegex, $url, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }

    if (preg_match($shortUrlRegex, $url, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }
    return 'https://www.youtube.com/embed/' . $youtube_id ;
}

function video_image($url){
 
   $image_url = parse_url($url);
 
     if($image_url['host'] == 'www.youtube.com' ||
 
        $image_url['host'] == 'youtube.com'){
 
         $array = explode("&", $image_url['query']);
 
         return "http://img.youtube.com/vi/".substr($array[0], 2)."/0.jpg";
 
     }else if($image_url['host'] == 'www.youtu.be' ||
 
              $image_url['host'] == 'youtu.be'){
 
         $array = explode("/", $image_url['path']);
 
         return "http://img.youtube.com/vi/".$array[1]."/0.jpg";
 
     }else if($image_url['host'] == 'www.vimeo.com' ||
 
         $image_url['host'] == 'vimeo.com'){
 
         $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".
 
         substr($image_url['path'], 1).".php"));
 
         return $hash[0]["thumbnail_medium"];
 
     }
 
}
function get_info_user($id_user){
	global $d;
	$sql="select * from #_user where id='".$id_user."'";
	$d->query($sql);
	$result=$d->fetch_array();
	return $result;
}

function getInfoPro($id){
	global $d;
	$sql="select tenkhongdau_vi as tenkhongdau,id,photo,ten_vi,ten_en from #_product where id=$id";
	$d->query($sql);
	$result=$d->fetch_array();
	return $result;
}

// quy đổi từ tiền sang điểm tích lũy
function money_to_diemtichluy($money){
	global $d;
	$total_point = 0;
	if($money>0){
		$one_point = get_giatridiemtichluy();
		$total_point = round($money/$one_point);
	}
	return $total_point;
}


function get_giatridiemtichluy(){
	global $d;
	$d->reset();
	$sql = "select giatritichluy from table_setting limit 0,1";
	$d->query($sql);
	$result = $d->fetch_array();
	return $result['giatritichluy'];
}


function getNameTinhthanh($id,$lang){
	global $d;
	if(!empty($id)){
		$sql="select ten_$lang from #_city_list where id=$id";
		$d->query($sql);
		$result=$d->fetch_array();
		return $result['ten_'.$lang];
	}
	return '';
}

function getNameQuanhuyen($id,$lang){
	global $d;
	if(!empty($id)){
		$sql="select ten_$lang from #_city_cat where id=$id";
		$d->query($sql);
		$result=$d->fetch_array();
		return $result['ten_'.$lang];
	}
	return '';
}

function getNamePhuongxa($id,$lang){
	global $d;
	if(!empty($id)){
		$sql="select ten_$lang from #_city_item where id=$id";
		$d->query($sql);
		$result=$d->fetch_array();
		return $result['ten_'.$lang];
	}
	return '';
}


// lấy tên loại thanh toán
function get_name_payment($id_payment,$lang){
	global $d, $result;
	$sql="select * from table_news where id=$id_payment";
	$d->query($sql);
	$result=$d->fetch_array();

	return $result["ten_$lang"];
}

function get_unsigned_name($pid,$lang){
		global $d, $row;
		$sql = "select tenkhongdau_$lang from #_product where id=$pid";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row["tenkhongdau_$lang"];
		//alert("asdasd");
	}


// lấy thông tin user
function getInfoUser($id_user){
	global $d,$config_url;
	if(!empty($id_user)){
		$sql="select * from table_user where id=$id_user";
		$d->query($sql);
		$result=$d->fetch_array();
		return $result;
	}else{
		//redirect("http://".$config_url."/gio-hang.html");
		//return false;
	}
}


// get link share hoa hồng
function get_link_share($id_user){
	$url_cur = '';
	insert_md5_user($id_user);
	$code_md5 = md5($id_user);
	$url_cur .= '/'.$code_md5;
	return $url_cur;
}

// insert mã md5 vào table user đó
function insert_md5_user($id_user){
	global $d;
	if(!check_md5_user($id_user)){
		$code_md5 = md5($id_user);
		$d->reset();
		$sql = "UPDATE table_user SET code_md5='$code_md5' WHERE id=$id_user";
		$d->query($sql);
	}
}

// check user có mã md5 hay chưa
function check_md5_user($id_user){
	global $d;
	$d->reset();
	$sql = "SELECT code_md5 FROM table_user WHERE id=$id_user";
	$d->query($sql);
	$result = $d->fetch_array();
	if(!empty($result['code_md5'])){
		return true;
	}
	return false;
}


// tổng tiền hoa hồng hiện có của user
function total_hoahong_current($id_user){
	$total = 0;
	if(empty($id_user)){
		return 0;
	}
	$total = total_hoahong($id_user,2) - total_hoahong($id_user,4) - total_hoahong($id_user,5);
	if($total<=0){
		return 0;
	}
	return $total;
}


// Là thành viên hưởng hoa hồng
function is_user_hoahong($id_user){
	global $d;
	$d->reset();
	$sql = "select hoahong from table_user where id=$id_user";
	$d->query($sql);
	$result = $d->fetch_array();
	if(!empty($result['hoahong'])){
		if($result['hoahong']==1){
			return true;
		}else{
			return false;
		}	
	}
	return false;
}

function total_hoahong($id_user,$trangthai){
	global $d;
	$d->reset();
	$sql = "select SUM(tienhoahong) as total from table_hoahong_detail where id_user=$id_user and trangthai=$trangthai";
	$d->query($sql);
	$result = $d->fetch_array();
	if(($result['total']>0)){
		return $result['total'];
	}
	return '0';
}

// lấy màu trạng thái lịch sử sử dụng hoa hồng
function get_color_hoahong($trangthai){
	$result = '';
	switch($trangthai){
		case 1:
		case 3:
			$result = '';
			break;
			
		case 2:
			$result = 'class="plus"';
			break;

		case 4:
		case 5:
			$result = 'class="minus"';
			break;

	}
	return $result;
}

// lấy trạng thái đơn hàng
function get_trangthai_order($trangthai,$lang='vi'){
	$result = '';
	switch($trangthai){
		case 1:
			if($lang=='vi'){
				$result = 'Mới đặt';
			}else{
				$result = 'New Order';
			}
			break;

		case 2:
			if($lang=='vi'){
				$result = 'Đã được gửi đi';
			}else{
				$result = 'pending';
			}
			break;

		case 3:
			if($lang=='vi'){
				$result = 'Đã giao thành công';
			}else{
				$result = 'Delivered';
			}
			break;

		case 4:
			if($lang=='vi'){
				$result = 'Đã hủy';
			}else{
				$result = 'Cancelled';
			}
			break;

	}
	return $result;
}

// lấy trạng thái lịch sử sử dụng số tiền hoa hồng
function get_trangthai_hoahong($trangthai,$lang){
	switch($trangthai){
		case 1:
			if($lang=='vi'){
				$result = 'Đang chờ xét';
			}else{
				$result = 'pending';
			}
			break;

		case 2:
			if($lang=='vi'){
				$result = 'Đã chấp nhận';
			}else{
				$result = 'Accepted';
			}
			break;

		case 3:
			if($lang=='vi'){
				$result = 'Đã hủy bỏ';
			}else{
				$result = 'Canceled';
			}
			break;

		case 4:
			if($lang=='vi'){
				$result = 'Đã quy đổi';
			}else{
				$result = 'Converted';
			}
			break;

		case 5:
			if($lang=='vi'){
				$result = 'Đã rút tiền mặt';
			}else{
				$result = 'Had to withdraw cash';
			}
			break;
	}
	return $result;
}

// lấy nội dung lịch sử của tiền hoa hồng
function get_noidung_hoahong($num,$lang){
	switch($num){
		case 1:
			if($lang=='vi'){
				$result = 'Nhận được hoa hồng từ đơn đặt hàng';
			}else{
				$result = 'Received a commission from orders';
			}
			break;

		case 2:
			if($lang=='vi'){
				$result = 'Nhận được hoa hồng từ đơn đặt hàng';
			}else{
				$result = 'Received a commission from orders';
			}
			// if($lang=='vi'){
			// 	$result = 'Quy đổi ra điểm tích lũy';
			// }else{
			// 	$result = 'Converted into charge';
			// }
			break;

		case 3:
			if($lang=='vi'){
				$result = 'Nhận được hoa hồng từ đơn đặt hàng';
			}else{
				$result = 'Received a commission from orders';
			}
			// if($lang=='vi'){
			// 	$result = 'Đã rút tiền mặt';
			// }else{
			// 	$result = 'Had to withdraw cash';
			// }
			break;
	}
	return $result;
}

// lấy % hoa hồng
function get_percent_hoahong($id_product){
	global $d;
	$d->reset();
	$sql = "select giatri_hoahong from table_product where id=$id_product limit 0,1";
	$d->query($sql);
	$result = $d->fetch_array();
	return $result['giatri_hoahong'];
}

// lấy id user share link của từng sản phẩm trong session aff
function get_id_user_share($arr_aff,$id_product,$id_user_current){
	global $d;

	if(!empty($arr_aff)){
		foreach ($arr_aff as $k => $v) {
			if($k==$id_product && $v!=$id_user_current){ // sản phẩm được share và người mua không phải người share
				return $v; // return id user share link
			}
		}
	}

	return 0;
}
// get id_user from code md5 ---> user share link
function get_id_user_from_md5($code_md5,$id_user_current){
	global $d;
	$d->reset();
	$sql = "SELECT id FROM table_user WHERE code_md5='$code_md5'";
	if(!empty($id_user_current)){ // và khác user share link
		$sql .= " and id <> $id_user_current";
	}
	$d->query($sql);
	$result = $d->fetch_array();
	

	if(!empty($result['id'])){
		return $result['id'];
	}
	return 0;
}



function num_format($number,$lang='vi'){
	if($lang=='en'){
		return (number_format($number,'2','.',','));
	}
	return (number_format($number,'0','.','.'));
}



function bodautv($str)
{
$str = stripUnicode($str);
	$str = mb_convert_case($str,MB_CASE_LOWER,'utf-8');
	$str = trim($str);
	$str=preg_replace('/[^a-zA-Z0-9\ ]/','',$str); 
	$str = str_replace("  "," ",$str);
	$str = str_replace(" ","-",$str);
	return $str;
}

function doitiensangchu($a){
	$st = "/^[1-9][0-9]*$/";
	if(preg_match($st,$a)){ //Nếu là số nguyên
		$kq = (int)($a/1000000000);
		$a=$a%1000000000;
		if($kq>=1){
			echo "$kq Tỷ ";	
		}
		$kq = (int)($a/1000000);
		$a=$a%1000000;
		if($kq>=1){
			echo "$kq Triệu ";	
		}
		$kq = (int)($a/1000);
		$a=$a%1000;
		if($kq>=1){
			echo "$kq Ngàn ";	
		}
		$kq = (int)($a/1);
		$a=$a%1;
		if($kq>=1){
			echo "$kq Đồng ";	
		}
	}
	else{	//Nếu không là số nguyên
		echo "Liên hệ";
	}
}


function getFirstImagethumb($id,$x="thumb"){
		
	global $d;
	$sql = "select $x from #_hasp where  hienthi=1 and com='hasp' and id=".$id." order by stt asc";
	$d->query($sql);
	$r = $d->fetch_array();
	return $r[$x];	
	
}


function getFirstImagephoto($id,$x="photo"){
		
	global $d;
	$sql = "select $x from #_hasp where hienthi=1 and com='hasp' and id=".$id." order by stt asc";
	$d->query($sql);
	$r = $d->fetch_array();
	return $r[$x];	
	
}

function get_donvi_gia($id=0){
  global $d, $row;
  $sql="select ten_vi from #_news where id=".$id." and com='donvigia' limit 0,1";
  $d->query($sql);
  $row=$d->fetch_array();
	return $row['ten_vi'];

} 



function get_donvi($gia,$donvi)
{
	    if($gia > 0)
		{   
		
			 if($donvi == "ngan") 
			{
                if($gia>1000) 
				{
                    $gia = $gia/1000;
                    return $gia." "."Triệu";
                } 
                return $gia." "."Ngàn";
            } 
    	    else if($donvi == "trieu") 
			{
                if($gia>1000) 
				{
                    $gia = $gia/1000;
                    return $gia." "."Tỷ";
                } 
                return $gia." "."Triệu";
            } 
			
			else if($donvi == "ty")
			{
    		  return $gia." "."Tỷ";
            }
        } 
		else if($gia == -555)
		
		{
            if($donvi == "ngan") 
			{
                return "Ngàn";    
            }
			else if($donvi == "trieu") 
			{
                return "Triệu";    
            }
			else 
			{
                return "Tỷ";
            }
        }
		else 
		
		{
            return "Đang cập nhật";
        }

}     


function get_tinhtrang($id)
	{
	    global $d, $row;
    	$sql="select ten_vi from #_news where hienthi=1 and id=".$id." and com='tinhtrang' limit 0,1";
    	$d->query($sql);
    	$row=$d->fetch_array();
		return $row['ten_vi'];
	}	
	

function get_loai_giaodich($id)
	{
	    global $d, $row;
    	$sql="select ten_vi from #_type_posting where hienthi=1  and id=".$id." limit 0,1";
    	$d->query($sql);
    	$row=$d->fetch_array();
		return $row['ten_vi'];
	}
		
	

function get_item_tinh($id)
	{
	    global $d, $row;
    	$sql="select ten_vi from #_city_list where id=".$id." limit 0,1";
    	$d->query($sql);
    	$row=$d->fetch_array();
		return $row['ten_vi'];
	}	
	

function get_item_quan($id_tinh,$id)
	{
	    global $d, $row;
    	$sql="select ten_vi from #_city_cat where id_list=".$id_tinh." and id=".$id." limit 0,1";
    	$d->query($sql);
    	$row=$d->fetch_array();
		return $row['ten_vi'];
	}
        
function get_item_khuvuc($id_tinh,$id_quan,$id)
	{
	    global $d, $row;
    	$sql="select ten_vi from #_city_item where id_list=".$id_tinh." and id_cat=".$id_quan." and id=".$id." limit 0,1";
    	$d->query($sql);
    	$row=$d->fetch_array();
		return $row['ten_vi'];
	}
    
function get_item_khuvuc_tmp($id)
	{
	    global $d, $row;
    	$sql="select ten_vi from #_city_item where id=".$id." limit 0,1";
    	$d->query($sql);
    	$row=$d->fetch_array();
		return $row['ten_vi'];
	}    
     
function get_item_duong($id_tinh,$id_quan,$id_khuvuc,$id)
	{
	    global $d, $row;
    	$sql="select ten_vi from #_city_sub where id_list=".$id_tinh." and id_cat=".$id_quan." and id_item=".$id_khuvuc." and id=".$id." limit 0,1";
    	$d->query($sql);
    	$row=$d->fetch_array();
		return $row['ten_vi'];
	} 
    	

function get_item_loaibds($id)
	{
	    global $d, $row;
    	$sql="select ten_vi from #_news where hienthi=1 and com='loaibds' and id=".$id." limit 0,1";
    	$d->query($sql);
    	$row=$d->fetch_array();
		return $row['ten_vi'];
	}
	
	
function get_hangxe($id)
	{
	    global $d, $row;
    	$sql="select ten_vi from #_news_list where hienthi=1 and com='oto' and id=".$id." limit 0,1";
    	$d->query($sql);
    	$row=$d->fetch_array();
		return $row['ten_vi'];
	}	
	
	
function get_tenxe($id)
	{
	    global $d, $row;
    	$sql="select ten_vi from #_news_cat where hienthi=1 and com='oto' and id=".$id." limit 0,1";
    	$d->query($sql);
    	$row=$d->fetch_array();
		return $row['ten_vi'];
	}	
	
function get_mauxe($id)
	{
	    global $d, $row;
    	$sql="select ten_vi from #_news where hienthi=1 and com='oto' and id=".$id." limit 0,1";
    	$d->query($sql);
    	$row=$d->fetch_array();
		return $row['ten_vi'];
	}		
	

// danh sách các đánh giá của sản phẩm đó
function getArrRating($id_product){
	global $d;
	$sql="select * from table_rating where id_product=$id_product order by ngaytao desc";
	$d->query($sql);
	$result=$d->result_array();
	return $result;
}

// Tổng số người đánh giá của sản phẩm đó
function getTotalRating($id_product){
	global $d;
	$sql="select count(id) as total from #_rating where id_product=$id_product";
	$d->query($sql);
	$result=$d->fetch_array();
	return $result['total'];
}

// lấy tổng số sao đánh giá
function getTotalStar($id_product){
	global $d;
	$sql="select sum(rating) as star from #_rating where id_product=$id_product";
	$d->query($sql);
	$result=$d->fetch_array();
	$totalStar = $result['star'];
	$totalPer = getTotalRating($id_product);
	$numStar = round($totalStar/$totalPer, 1);
	return $numStar;
}

// lấy tổng số sao đánh giá của từng loại
function getTotalStarOption($id_product,$num){
	global $d;
	$sql="select count(id) as total from #_rating where id_product=$id_product and rating=$num";
	$d->query($sql);
	$result=$d->fetch_array();
	return $result['total'];
}

// Update lại đánh giá tổng quát về sản phẩm
function updateRatingProduct($id_product,$num_rating){
	global $d;
	$sql="update table_product set num_rating='$num_rating' where id=$id_product";
	$d->query($sql);
}	
	
///Get image from URL
function uploadUrl($url,$savePath,$imageRestrict,$imageSizeRestrcit)
{
$type_upload = explode(',',$imageRestrict);
$ext = substr(basename($url),strrpos(basename($url),".")+1);
$tmp = explode('?',$ext);
$ext = $tmp[0];
$name = ChuoiNgauNhien(6);
$result = "ERROR 1";
if(!in_array($ext,$type_upload)){
    return 'ERROR 2';
}
else{
for($i=0;$i<5;$i++){
    $rd.=rand(0,9);
}
$fn = $savePath.$rd.$name.'.'.$ext;
$fp = fopen($fn,"w");
$noidung = file_get_contents($url);
fwrite($fp,$noidung,strlen($noidung));
fclose($fp);
$result = $rd.$name.'.'.$ext;
}
return $result;
}  	

// fix ảnh quay ngược khi up
function image_fix_orientation($path){
	
	$image = imagecreatefromjpeg($path);
	

	$exif = exif_read_data($path);
	if (!empty($exif['Orientation'])) {
		switch ($exif['Orientation']) {
			case 3:
				$image = imagerotate($image, -90, 0);
				break;
			case 6:
				$image = imagerotate($image, -90, 0);
				break;
			case 8:
				$image = imagerotate($image, -90, 0);
				break;
		}
		
		imagejpeg($image, $path);
	}
	

	
	 
}
	
function pagesListLimit_layout($url , $totalRows , $pageSize = 5, $offset = 5){
	if ($totalRows<=0) return "";
	$totalPages = ceil($totalRows/$pageSize);
	if ($totalPages<=1) return "";		
	if( isset($_GET["curPage"]) == true)  $currentPage = $_GET["curPage"];
	else $currentPage = 1;
	settype($currentPage,"int");	
	if ($currentPage <=0) $currentPage = 1;	
	$firstLink = "<li><a href=\"{$url}=1\" class=\"left\"><i class='fa fa-angle-double-left'></i></a><li>";
	$lastLink="<li><a href=\"{$url}={$totalPages}\" class=\"right\"><i class='fa fa-angle-double-right'></i></a></li>";
	$from = $currentPage - (int)($offset/2);	
	$to = $from + $offset - 1;
	if ($from <=0) { $from = 1;   $to = $offset; }
if ($to > $totalPages) { $to = $totalPages; }
	for($j = $from; $j <= $to; $j++) {
	   $qt = $url. "={$j}";
	   
	   if ($j == $currentPage) $links = $links . "<li><a href = '{$qt}' class='active'>{$j}</a></li>";		
	   else{				
		
		$links= $links . "<li><a href = '{$qt}'>{$j}</a></li>";
	   } 	   
	} //for
	if($currentPage == 1){
		$prevLink = "<li><a href=\"{$url}=1\" class=\"left\"><i class='fa fa-angle-left'></i></a><li>";
	}else{
		$prevj=$currentPage-1;
		$prevLink = "<li><a href=\"{$url}={$prevj}\" class=\"left\"><i class='fa fa-angle-left'></i></a><li>";
	}
	if($currentPage == $totalPages){
		$nextLink="<li><a href=\"{$url}={$totalPages}\" class=\"right\"><i class='fa fa-angle-right'></i></a></li>";
	}else{
		$nextj=$currentPage+1;
		$nextLink="<li><a href=\"{$url}={$nextj}\" class=\"right\"><i class='fa fa-angle-right'></i></a></li>";
	}
	
	return '<ul class="pages">'.$firstLink.$prevLink.$links.$nextLink.$lastLink.'<div class="clear"></div></ul>';
} 
// function pagesListLimit	

function magic_quote($str, $id_connect=false)	
{	
	if (is_array($str))
	{
		foreach($str as $key => $val)
		{
			$str[$key] = escape_str($val);
		}
		return $str;
	}
	if (is_numeric($str)) {
		return $str;
	}
	if(get_magic_quotes_gpc()){
		$str = stripslashes($str);
	}
	if (function_exists('mysql_real_escape_string') AND is_resource($id_connect))
	{
		return mysql_real_escape_string($str, $id_connect);
	}
	elseif (function_exists('mysql_escape_string'))
	{
		return mysql_escape_string($str);
	}
	else
	{
		return addslashes($str);
	}
}
function escape_str($str, $id_connect=false)	
{	
	if (is_array($str))
	{
		foreach($str as $key => $val)
		{
			$str[$key] = escape_str($val);
		}
		
		return $str;
	}
	
	if (is_numeric($str)) {
		return $str;
	}
	
	if(get_magic_quotes_gpc()){
		$str = stripslashes($str);
	}

	if (function_exists('mysql_real_escape_string') AND is_resource($id_connect))
	{
		return "'".mysql_real_escape_string($str, $id_connect)."'";
	}
	elseif (function_exists('mysql_escape_string'))
	{
		return "'".mysql_escape_string($str)."'";
	}
	else
	{
		return "'".addslashes($str)."'";
	}
}


function getRemoteIPAddress(){
    $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
    return $ip;
}
  
/* If your visitor comes from proxy server you have use another function
to get a real IP address: */

function getRealIPAddress(){  
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //check ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


function make_date($time,$dot='.',$lang='vi',$f=false){
	
	$str = ($lang == 'vi') ? date("d{$dot}m{$dot}Y",$time) : date("m{$dot}d{$dot}Y",$time);
	if($f){
		$thu['vi'] = array('Chủ nhật','Thứ hai','Thứ ba','Thứ tư','Thứ năm','Thứ sáu','Thứ bảy');
		$thu['en'] = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
		$str = $thu[$lang][date('w',$time)].', '.$str;
	}
	return $str;
}

function delete_file($file){
		return @unlink($file);
}

function upload_image($file, $extension, $folder, $newname=''){
	if(isset($_FILES[$file]) && !$_FILES[$file]['error']){
		
		$ext = end(explode('.',$_FILES[$file]['name']));
		$name = basename($_FILES[$file]['name'], '.'.$ext);
		
		if(strpos($extension, $ext)===false){
			alert('Chỉ hỗ trợ upload file dạng '.$extension);
			return false; // không hỗ trợ
		}
		
		if($newname=='' && file_exists($folder.$_FILES[$file]['name']))
			for($i=0; $i<100; $i++){
				if(!file_exists($folder.$name.$i.'.'.$ext)){
					$_FILES[$file]['name'] = $name.$i.'.'.$ext;
					break;
				}
			}
		else{
			$_FILES[$file]['name'] = $newname.'.'.$ext;
		}
		
		if (!copy($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))	{
			if ( !move_uploaded_file($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))	{
				return false;
			}
		}
		return $_FILES[$file]['name'];
	}
	return false;
}



//Upload file
function upload_image_index($file, $extension, $folder, $newname=''){
	if(isset($_FILES[$file]) && !$_FILES[$file]['error']){
		
		$ext = end(explode('.',$_FILES[$file]['name']));
		$name = basename($_FILES[$file]['name'], '.'.$ext);
		$name = changeTitleImage($name).'-'.fns_Rand_digit(0,9,4);		

		if(strpos($extension, $ext)===false){
			alert('Chỉ hỗ trợ upload file dạng '.$extension);
			return false; // không hỗ trợ
		}
		
		if($newname=='' or file_exists($folder.$_FILES[$file]['name']))
			for($i=0; $i<100; $i++){
				if(!file_exists($folder.$name.$i.'.'.$ext)){
					$_FILES[$file]['name'] = $name.$i.'.'.$ext;
					break;
				}
			}
		else{
			$_FILES[$file]['name'] = $newname;
		}
		
		if (!copy($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))	{
			if ( !move_uploaded_file($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))	{
				return false;
			}
		}
		return $_FILES[$file]['name'];
	}
	return false;
}


function chuanhoa($s){
	$s = str_replace("'", '&#039;', $s);
	$s = str_replace('"', '&quot;', $s);
	$s = str_replace('<', '&lt;', $s);
	$s = str_replace('>', '&gt;', $s);
	return $s;
}

function themdau($s){
	$s = addslashes($s);
	return $s;
}

function bodau($s){
	$s = stripslashes($s);
	return $s;
}



function transfer($msg,$page="index.php")
{
	 $showtext = $msg;
	 $page_transfer = $page;
	 include("./templates/transfer_tpl.php");
	 exit();
}

function redirect($url=''){
	echo '<script language="javascript">window.location = "'.$url.'" </script>';
	exit();
}

function back($n=1){
	echo '<script language="javascript">history.go = "'.-intval($n).'" </script>';
	exit();
}

function dump($arr, $exit=1){
	echo "<pre>";	
		var_dump($arr);
	echo "<pre>";	
	if($exit)	exit();
}


function paging_home($r, $url='', $curPg=1, $mxR=5, $mxP=5, $class_paging='')
	{
		if($curPg<1) $curPg=1;
		if($mxR<1) $mxR=5;
		if($mxP<1) $mxP=5;
		$totalRows=count($r);
		if($totalRows==0)	
			return array('source'=>NULL, 'paging'=>NULL);
		$totalPages=ceil($totalRows/$mxR);
		if($curPg > $totalPages) $curPg=$totalPages;
		
		$_SESSION['maxRow']=$mxR;
		$_SESSION['curPage']=$curPg;

		$r2=array();
		$paging="";
		
		//-------------tao array------------------
		$start=($curPg-1)*$mxR;
		$end=($start+$mxR)<$totalRows?($start+$mxR):$totalRows;
		#echo $start;
		#echo $end;
		
		$j=0;
		for($i=$start;$i<$end;$i++)
			$r2[$j++]=$r[$i];
			
		//-------------tao chuoi------------------
		$curRow = ($curPg-1)*$mxR+1;	
		if($totalRows>$mxR)
		{
			$start=1;
			$end=1;
			$paging1 ="";
			
			$jump = (($mxP%2)!=0)?floor($mxP/2):ceil($mxP/2); 	
			$firt = $curPg - $jump;
			$last = $curPg + $jump;	
			
			if($last>$totalPages)
				$last = $totalPages;
			if($firt<1)
			{
				if($totalPages>$mxP) $last -= $firt;
				$firt = 1;
			}
			if($totalPages>$mxP)
			{
				
				if($curPg>0&& $curPg <= $jump)
					$last += ($mxP-$last);
				if($curPg <= $totalPages && $curPg > $totalPages-$jump)
					$firt = ($totalPages - $mxP +1);
			}
			
			for($i=$firt;$i<=$last;$i++)
			{	
				//if(($i>((int)(($curPg-1)/$mxP))* $mxP) && ($i<=((int)(($curPg-1)/$mxP+1))* $mxP))
				{
					//if($start==1) $start=$i;
					if($i==$curPg){
						$paging1.=" <span>".$i."</span> ";//dang xem
					} 		  	
					else    
					{
						$paging1 .= " <a href='".$url."p=".$i."'  class=\"{$class_paging}\">".$i."</a> ";	
					}
					$end=$i;	
				}
			}//tinh paging
			//$paging.= "Go to page :&nbsp;&nbsp;" ;
			#if($curPg>$mxP)
			#{
			if($curPg>1){
				$paging .=" <a href='".$url."' class=\"{$class_paging}\" >&laquo;</a> "; //ve dau
				
				#$paging .=" <a href='".$url."&curPage=".($start-1)."' class=\"{$class_paging}\" >&#8249;</a> "; //ve truoc
				$paging .=" <a href='".$url."p=".($curPg-1)."' class=\"{$class_paging}\" >&#8249;</a> "; //ve truoc
			}
			#}
			$paging.=$paging1; 
			#if(((int)(($curPg-1)/$mxP+1)*$mxP) < $totalPages)  
			#{
				#$paging .=" <a href='".$url."&curPage=".($end+1)."' class=\"{$class_paging}\" >&#8250;</a> "; //ke
				if($curPg<$totalPages){
					$paging .=" <a href='".$url."p=".($curPg+1)."' class=\"{$class_paging}\" >&#8250;</a> "; //ke
					$paging .=" <a href='".$url."p=".($totalPages)."' class=\"{$class_paging}\" >&raquo;</a> "; //ve cuoi
				}
			#}
		}
		$r3['curPage']=$curPg;
		$r3['source']=$r2;
		$r3['paging']=$paging;
		$r3['total']=$totalRows;
		#echo '<pre>';var_dump($r3);echo '</pre>';
		return $r3;
	}

function paging_home11($r, $url='', $curPg=1, $mxR=5, $mxP=5, $class_paging='')
	{
		if($curPg<1) $curPg=1;
		if($mxR<1) $mxR=5;
		if($mxP<1) $mxP=5;
		$totalRows=count($r);
		if($totalRows==0)	
			return array('source'=>NULL, 'paging'=>NULL);
		$totalPages=ceil($totalRows/$mxR);
				
		
		
		
		if($curPg > $totalPages) $curPg=$totalPages;
		
		$_SESSION['maxRow']=$mxR;
		$_SESSION['curPage']=$curPg;

		$r2=array();
		$paging="";
		
		//-------------tao array------------------
		$start=($curPg-1)*$mxR;		
		$end=($start+$mxR)<$totalRows?($start+$mxR):$totalRows;
		#echo $start;
		#echo $end;
		
		$j=0;
		for($i=$start;$i<$end;$i++)
			$r2[$j++]=$r[$i];
			
		//-------------tao chuoi------------------
		$curRow = ($curPg-1)*$mxR+1;	
		if($totalRows>$mxR)
		{
			
			$from = $curPg - $mxP;	
			$to = $curPg + $mxP;
			if ($from <=0) { $from = 1;   $to = $mxP*2; }
			if ($to > $totalPages) { $to = $totalPages; }
			for($j = $from; $j <= $to; $j++) {
			   if ($j == $curPg) $links = $links . "<a class=\"paginate_active\" href=\"#\">{$j}</a>";		
			   else{				
				$qt = $url. "&p={$j}";
				$links= $links . "<a class=\"paginate_button\" href = '{$qt}'>{$j}</a>";
			   } 	   
			} //for
									
			//$paging.= "Go to page :&nbsp;&nbsp;" ;
			if($curPg>$mxP)
			{
				$paging .=" <a href='".$url."' class=\"first paginate_button\" >&laquo;</a> "; //ve dau				
				$paging .=" <a href='".$url."&p=".($curPg-1)."' class=\"previous paginate_button\" >&#8249;</a> "; //ve truoc
			}else{
				$paging .=" <a href='".$url."' class=\"first paginate_button paginate_button_disabled\" >&laquo;</a> "; //ve dau				
				$paging .=" <a href='".$url."&p=".($curPg-1)."' class=\"previous paginate_button paginate_button_disabled\" >&#8249;</a> "; //ve truoc
			}
			$paging.=$links; 
			if(((int)(($curPg-1)/$mxP+1)*$mxP) < $totalPages)  
			{
				$paging .=" <a href='".$url."&p=".($curPg+1)."' class=\"next paginate_button\" >&#8250;</a> "; //ke				
				$paging .=" <a href='".$url."&p=".($totalPages)."' class=\"last paginate_button\" >&raquo;</a> "; //ve cuoi
			}else{
				$paging .=" <a href='".$url."&p=".($curPg+1)."' class=\"next paginate_button paginate_button_disabled\" >&#8250;</a> "; //ke				
				$paging .=" <a href='".$url."&p=".($totalPages)."' class=\"last paginate_button paginate_button_disabled\" >&raquo;</a> "; //ve cuoi
			}
		}		
		$r3['curPage']=$curPg;
		$r3['source']=$r2;
		$r3['paging']=$paging;			
		$r3['totalRows']=$totalRows;		
		#echo '<pre>';var_dump($r3);echo '</pre>';
		return $r3;
	}
function catchuoi($chuoi,$gioihan){
// nếu độ dài chuỗi nhỏ hơn hay bằng vị trí cắt
// thì không thay đổi chuỗi ban đầu
if(strlen($chuoi)<=$gioihan)
{
return $chuoi;
}
else{
/*
so sánh vị trí cắt
với kí tự khoảng trắng đầu tiên trong chuỗi ban đầu tính từ vị trí cắt
nếu vị trí khoảng trắng lớn hơn
thì cắt chuỗi tại vị trí khoảng trắng đó
*/
if(strpos($chuoi," ",$gioihan) > $gioihan){
$new_gioihan=strpos($chuoi," ",$gioihan);
$new_chuoi = substr($chuoi,0,$new_gioihan)."...";
return $new_chuoi;
}
// trường hợp còn lại không ảnh hưởng tới kết quả
$new_chuoi = substr($chuoi,0,$gioihan)."...";
return $new_chuoi;
}
}

function stripUnicode($str){
  if(!$str) return false;
   $unicode = array(
     'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
     'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
     'd'=>'đ',
     'D'=>'Đ',
     'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
   	  'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
   	  'i'=>'í|ì|ỉ|ĩ|ị',	  
   	  'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
     'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
   	  'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
     'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
   	  'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
     'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
     'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
   );
   foreach($unicode as $khongdau=>$codau) {
     	$arr=explode("|",$codau);
   	  $str = str_replace($arr,$khongdau,$str);
   }
return $str;
}// Doi tu co dau => khong dau

function changeTitle($str)
{
	$str = stripUnicode($str);
	$str = mb_convert_case($str,MB_CASE_LOWER,'utf-8');
	$str = trim($str);
	$str=preg_replace('/[^a-zA-Z0-9\ ]/','',$str); 
	$str = str_replace("  "," ",$str);
	$str = str_replace(" ","-",$str);
	return $str;
}

function changeTitleImage($str)
{
	$str = stripUnicode($str);
	$str = mb_convert_case($str,MB_CASE_LOWER,'utf-8');
	$str = trim($str);
	$str = str_replace("  "," ",$str);
	$str = str_replace(" ","-",$str);
	return $str;
}



function getCurrentPageURL() {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
	$pageURL = explode("&p=", $pageURL);
    return $pageURL[0];
}
function create_thumb($file, $width, $height, $folder,$file_name,$zoom_crop='1'){

// ACQUIRE THE ARGUMENTS - MAY NEED SOME SANITY TESTS?

$new_width   = $width;
$new_height   = $height;

 if ($new_width && !$new_height) {
        $new_height = floor ($height * ($new_width / $width));
    } else if ($new_height && !$new_width) {
        $new_width = floor ($width * ($new_height / $height));
    }
	
$image_url = $folder.$file;
$origin_x = 0;
$origin_y = 0;
// GET ORIGINAL IMAGE DIMENSIONS
$array = getimagesize($image_url);
if ($array)
{
    list($image_w, $image_h) = $array;
}
else
{
     die("NO IMAGE $image_url");
}
$width=$image_w;
$height=$image_h;

// ACQUIRE THE ORIGINAL IMAGE
$image_ext = trim(strtolower(end(explode('.', $image_url))));
switch(strtoupper($image_ext))
{
     case 'JPG' :
     case 'JPEG' :
         $image = imagecreatefromjpeg($image_url);
		 $func='imagejpeg';
         break;
     case 'PNG' :
         $image = imagecreatefrompng($image_url);
		 $func='imagepng';
         break;
	 case 'GIF' :
	 	 $image = imagecreatefromgif($image_url);
		 $func='imagegif';
		 break;

     default : die("UNKNOWN IMAGE TYPE: $image_url");
}

// scale down and add borders
	if ($zoom_crop == 3) {

		$final_height = $height * ($new_width / $width);

		if ($final_height > $new_height) {
			$new_width = $width * ($new_height / $height);
		} else {
			$new_height = $final_height;
		}

	}

	// create a new true color image
	$canvas = imagecreatetruecolor ($new_width, $new_height);
	imagealphablending ($canvas, false);

	// Create a new transparent color for image
	$color = imagecolorallocatealpha ($canvas, 255, 255, 255, 127);

	// Completely fill the background of the new image with allocated color.
	imagefill ($canvas, 0, 0, $color);

	// scale down and add borders
	if ($zoom_crop == 2) {

		$final_height = $height * ($new_width / $width);
		
		if ($final_height > $new_height) {
			
			$origin_x = $new_width / 2;
			$new_width = $width * ($new_height / $height);
			$origin_x = round ($origin_x - ($new_width / 2));

		} else {

			$origin_y = $new_height / 2;
			$new_height = $final_height;
			$origin_y = round ($origin_y - ($new_height / 2));

		}

	}

	// Restore transparency blending
	imagesavealpha ($canvas, true);

	if ($zoom_crop > 0) {

		$src_x = $src_y = 0;
		$src_w = $width;
		$src_h = $height;

		$cmp_x = $width / $new_width;
		$cmp_y = $height / $new_height;

		// calculate x or y coordinate and width or height of source
		if ($cmp_x > $cmp_y) {

			$src_w = round ($width / $cmp_x * $cmp_y);
			$src_x = round (($width - ($width / $cmp_x * $cmp_y)) / 2);

		} else if ($cmp_y > $cmp_x) {

			$src_h = round ($height / $cmp_y * $cmp_x);
			$src_y = round (($height - ($height / $cmp_y * $cmp_x)) / 2);

		}

		// positional cropping!
		if ($align) {
			if (strpos ($align, 't') !== false) {
				$src_y = 0;
			}
			if (strpos ($align, 'b') !== false) {
				$src_y = $height - $src_h;
			}
			if (strpos ($align, 'l') !== false) {
				$src_x = 0;
			}
			if (strpos ($align, 'r') !== false) {
				$src_x = $width - $src_w;
			}
		}

		imagecopyresampled ($canvas, $image, $origin_x, $origin_y, $src_x, $src_y, $new_width, $new_height, $src_w, $src_h);

    } else {

        // copy and resize part of an image with resampling
        imagecopyresampled ($canvas, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

    }
	


$new_file=$file_name.'_'.$new_width.'x'.$new_height.'.'.$image_ext;
// SHOW THE NEW THUMB IMAGE
if($func=='imagejpeg') $func($canvas, $folder.$new_file,100);
else $func($canvas, $folder.$new_file,floor ($quality * 0.09));

return $new_file;
}
function ChuoiNgauNhien($sokytu){
$chuoi="ABCDEFGHIJKLMNOPQRSTUVWXYZWabcdefghijklmnopqrstuvwxyzw0123456789";
for ($i=0; $i < $sokytu; $i++){
	$vitri = mt_rand( 0 ,strlen($chuoi) );
	$giatri= $giatri . substr($chuoi,$vitri,1 );
}
return $giatri;
} 


function gerenateMemberCode($sokytu){
	global $d;
	$code  = ChuoiNgauNhien($sokytu);
	$d->query("select id from #_user where mauser = '".$code."'");
	if($d->num_rows()){
		return  gerenateMemberCode($sokytu);
	}
	return $code;
}


function check_yahoo($nick_yahoo='nthaih'){
	$file = @fopen("http://opi.yahoo.com/online?u=".$nick_yahoo."&m=t&t=1","r");
	$read = @fread($file,200);
	
	if($read==false || strstr($read,"00"))
		$img = '<img src="images/yahoo_offline.png" border="0" align="absmiddle" />';
	else
		$img = '<img src="images/yahoo_online.png" border="0" align="absmiddle"/>';
	return '<a href="ymsgr:sendIM?'.$nick_yahoo.'">'.$img.'</a>';
}
function limitWord($string, $maxOut){

$string2Array = explode(' ', $string, ($maxOut + 1));

if( count($string2Array) > $maxOut ){
array_pop($string2Array);
$output = implode(' ', $string2Array)."...";
}else{
$output = $string;
}
return $output;
}

function pagesListLimitadmin($url , $totalRows , $pageSize = 5, $offset = 5){
	if ($totalRows<=0) return "";
	$totalPages = ceil($totalRows/$pageSize);
	if ($totalPages<=1) return "";		
	if( isset($_GET["p"]) == true)  $currentPage = $_GET["p"];
	else $currentPage = 1;
	settype($currentPage,"int");	
	if ($currentPage <=0) $currentPage = 1;	
	$firstLink = "<li><a href=\"{$url}\" class=\"left\">First</a><li>";
	$lastLink="<li><a href=\"{$url}&p={$totalPages}\" class=\"right\">End</a></li>";
	$from = $currentPage - $offset;	
	$to = $currentPage + $offset;
	if ($from <=0) { $from = 1;   $to = $offset*2; }
if ($to > $totalPages) { $to = $totalPages; }
	for($j = $from; $j <= $to; $j++) {
	   if ($j == $currentPage) $links = $links . "<li><a href='#' class='active'>{$j}</a></li>";		
	   else{				
		$qt = $url. "&p={$j}";
		$links= $links . "<li><a href = '{$qt}'>{$j}</a></li>";
	   } 	   
	} //for
	return '<ul class="pages">'.$firstLink.$links.$lastLink.'</ul>';
} // function pagesListLimit
function format_size ($rawSize)
  {
    if ($rawSize / 1048576 > 1) return round($rawSize / 1048576, 1) . ' MB';
    else 
      if ($rawSize / 1024 > 1) return round($rawSize / 1024, 1) . ' KB';
      else
        return round($rawSize, 1) . ' Bytes';
  }


function paging($r, $url='', $curPg=1, $mxR=5, $mxP=5, $class_paging='')
	{
		if($curPg<1) $curPg=1;
		if($mxR<1) $mxR=5;
		if($mxP<1) $mxP=5;
		$totalRows=count($r);
		if($totalRows==0)	
			return array('source'=>NULL, 'paging'=>NULL);
		$totalPages=ceil($totalRows/$mxR);
		if($curPg > $totalPages) $curPg=$totalPages;
		
		$_SESSION['maxRow']=$mxR;
		$_SESSION['curPage']=$curPg;

		$r2=array();
		$paging="";
		
		//-------------tao array------------------
		$start=($curPg-1)*$mxR;
		$end=($start+$mxR)<$totalRows?($start+$mxR):$totalRows;
		#echo $start;
		#echo $end;
		
		$j=0;
		for($i=$start;$i<$end;$i++)
			$r2[$j++]=$r[$i];
			
		//-------------tao chuoi------------------
		$curRow = ($curPg-1)*$mxR+1;	
		if($totalRows>$mxR)
		{
			$start=1;
			$end=1;
			$paging1 ="";				 	 
			for($i=1;$i<=$totalPages;$i++)
			{	
				if(($i>((int)(($curPg-1)/$mxP))* $mxP) && ($i<=((int)(($curPg-1)/$mxP+1))* $mxP))
				{
					if($start==1) $start=$i;
					if($i==$curPg){
						$paging1.=" <span>".$i."</span> ";//dang xem
					} 		  	
					else    
					{
						$paging1 .= " <a href='".$url."&curPage=".$i."'  class=\"{$class_paging}\">".$i."</a> ";	
					}
					$end=$i;	
				}
			}//tinh paging
			//$paging.= "Go to page :&nbsp;&nbsp;" ;
			#if($curPg>$mxP)
			#{
				$paging .=" <a href='".$url."' class=\"{$class_paging}\" >&laquo;</a> "; //ve dau
				
				#$paging .=" <a href='".$url."&curPage=".($start-1)."' class=\"{$class_paging}\" >&#8249;</a> "; //ve truoc
				$paging .=" <a href='".$url."&curPage=".($curPg-1)."' class=\"{$class_paging}\" >&#8249;</a> "; //ve truoc
			#}
			$paging.=$paging1; 
			#if(((int)(($curPg-1)/$mxP+1)*$mxP) < $totalPages)  
			#{
				#$paging .=" <a href='".$url."&curPage=".($end+1)."' class=\"{$class_paging}\" >&#8250;</a> "; //ke
				$paging .=" <a href='".$url."&curPage=".($curPg+1)."' class=\"{$class_paging}\" >&#8250;</a> "; //ke
				
				$paging .=" <a href='".$url."&curPage=".($totalPages)."' class=\"{$class_paging}\" >&raquo;</a> "; //ve cuoi
			#}
		}
		$r3['curPage']=$curPg;
		$r3['source']=$r2;
		$r3['paging']=$paging;
		#echo '<pre>';var_dump($r3);echo '</pre>';
		return $r3;
	}

?>