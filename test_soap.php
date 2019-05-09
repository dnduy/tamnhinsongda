<?php 

$postrack = 0004317421;

include ('curl.php');
include_once('nusoap/lib/nusoap.php');
ini_set('soap.wsdl_cache_enabled', 0);
ini_set('soap.wsdl_cache_ttl', 1900);
ini_set('default_socket_timeout', 100);
ini_set('display_errors', 1);



$wsdl_url = 'http://113.161.77.39:8080/PC_Track/TrackService?WSDL';
$option = array("trace"=>1);
$client = new soapclient($wsdl_url, $option);
$params = array('action'=>'Bill','bill_num'=>$postrack);

$result = $client->bill($params);


$ketquatrave= $result->return; 
if ($ketquatrave!="khong_ton_tai") {
    $array = json_decode($ketquatrave, true);

    $html .="<div class='track-tit'>"._thongtinhanhtrinh."</div>";
    $html .= "<table class='info-tracker'>";
    $html .= "<tr><td class='item'><strong>"._masodonhang.":</strong> </td><td>";
    $html .= $postrack;
    $html .= "</td></tr>";
    $html .= "<tr><td class='item'><strong>"._ngayky.":</strong></td><td>";
    $html .= $array['thoi_gian_nhan'];
    $html .= "</td></tr>"; 
    $html .= "<tr><td class='item'><strong>"._noidi.":</td><td>";
    $html .= $array['tinh_gui'];
    $html .= "</td></tr>";
    $html .= "<tr><td class='item'><strong>"._noiden.":</td><td>";
    $html .= $array['tinh_den'];
    $html .= "<tr><td class='item'><strong>"._dichvu.":</td><td>";
    $html .= $array['dich_vu'];
    $html .= "</td></tr>"; 
    $html .= "<tr><td class='item'><strong>"._billtrunggian.":</td><td>";
    $html .= $array['bill_trung_gian'];
    $html .= "</td></tr>";
    $html .= "<tr><td class='item'><strong>"._tentrunggian.":</td><td>";
    $html .= $array['ten_trung_gian'];
    $html .= "</td></tr>";
    $html .= "<tr><td class='item'><strong>"._loaihanghoa.":</td><td>";
    $html .= $array['loai_hang_hoa'];
    $html .= "</td></tr>";
    $html .= "<tr><td class='item'><strong>"._noidung.":</td><td>";
    $html .= $array['noi_dung_hang_hoa'];
    $html .= "</td></tr>";
    $html .= "</td></tr></table>";
    $i=0;

    $arr_sort = (array_sort($array['xn_chi_tiet'], 'ngay_gio', SORT_DESC));

    foreach ((array)$arr_sort as $k) {
        $date = $k['ngay_gio'];
        $date = str_replace('/', '-', $date); 
        $date = strtotime($date); 
        $date = date('m/d/Y',$date); 

        $xdate = new DateTime($date);

        $xdate->format("U");
        $btime = $xdate->getTimestamp();
        $arr[date("d-m-Y",$btime)][] = $k;
    }
    $i=count($arr_sort); 
    $html .="<div class='track-tit'>"._lichsuhanhtrinh."</div>";
    $html .= "<div id=".'"info"'.">";

    $html .='<table class="box_tracking_detail" border="0" cellspacing="0" cellpadding="0">';
    foreach ((array)$arr as $key => $item) {
        $html .='<tr class="title"><td colspan="2">'.$key.'</td><td>'._vitri.'</td><td>'._thoigian.'</td></tr>';
        foreach ($item as $k) {
            $time = $k['ngay_gio'];
            $time = str_replace('/', '-', $time); 
            $time = strtotime($time); 
            $time = date('H:i',$time); 

            $html .='<tr><td align="center">'.$i.'</td><td>'.$k['loai_xuat_nhap'].'</td><td>'.$k['tu_kho'].'</td><td>'.$time.'</td></tr>';
            $i--;
        }                                                           
    }
    $html .='</table>';
    $html .= "</div>"; 


    echo $html; 
}else{  
    $e0 ='aaa';
    function delete_all_between($beginning, $end, $string) {
        $beginningPos = strpos($string, $beginning);
        $endPos = strpos($string, $end, $beginningPos);
        if ($beginningPos === false || $endPos === false) {
        return $string;
    }

    $textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);

    return str_replace($textToDelete, '', $string);
    }
    function auxDeleteAllBetween($start, $end, $string) {
        // it helps to assembte comma dilimited strings
        $string = strtr($start. $string . $end, array($start => ','.$start, $end => chr(2)));
        $startPos  = 0;
        $endPos = strlen($string);
        while( $startPos !== false && $endPos !== false){
            $startPos = strpos($string, $start);
            $endPos = strpos($string, $end);
            if ($startPos === false || $endPos === false) {
                $run = false;
                return $string;
            }
            $textToDelete = substr($string, $startPos, ($endPos + strlen($end)) - $startPos);
            $string = str_replace($textToDelete, '', $string);
        }
        return $string;
    }
function get_data_track( $testNumbers, $confign, $e0)
{
    $tracker = new ParcelTracker($confign);
    $numTests = count($tracker);
    $data = array();
    $output = '';
    // print_r($testNumbers);   
    foreach ($testNumbers as $number => $expectedCarrier) 
    {
        $data = $tracker->getDetails($number, $expectedCarrier);
        $successes++;
        $output .= $tracker->toHTML($data);
    }
    if ($successes >= 1)
    {
        if(strpos(  $output , 'delivered' ))
        echo 'Shipment delivered &nbsp;&nbsp;&nbsp; '. $e0;        
        #$output = $tracker->toHTML($data);
        echo $output;
    }
}

if(isset($_POST['track']) ){
    include_once('templates/mod_track/parceltracker.class.php');
    $sup='';
    $i='';
    $confign = array(
        'dateFormat'    => 'us',
        'carriersDir'   => 'templates/mod_track/carriers'
    );
    $testNumbers = array();

    if($_POST['track'] != '')
    { 
        $a=$_POST['track'];
        $sql = "SELECT * FROM table_tintuc WHERE trackingcode='".$a."' or trackref='".$a."'";
        $d->query($sql);
        $data = $d->result_array();



        if( count($data) > 0 ){
        $html = '';
        foreach( $data as $k=>$v)
        {

            date_default_timezone_set('UTC'); 
            // date_default_timezone_set('Asia/Saigon');
            require_once("templates/easypost/easypost.php");
            \EasyPost\EasyPost::setApiKey('2fxIdsXsGzVWudKPvO8Rmw');

            if($v['id_lv0']!=140) {
                
            }
            if ($v['type']=='tracking') { 
                if($v['id_lv0']==0)
                {
                    $html .="<div class='track-tit'>"._lichsuhanhtrinh."</div>";
                    $html .= "<div id=".'"info"'.">";
                    $html .= $v['noidung'];
                    $html .= "</div>";
                }          
                if($v['id_lv0']==8)
                {
                    $tracking_code = $v['trackref'];
                    $carrier = "DHLExpress";
                    $mode = 'production';                           
                    $tracker = \EasyPost\Tracker::create(array('tracking_code' => $tracking_code, 'carrier' => $carrier));
                         
                    $str=json_decode($tracker);
                    // echo "<pre>";
                    //     var_dump($str->tracking_details[0]->datetime);
                    // echo "</pre>";

                    $html .="<div class='track-tit'>"._thongtinhanhtrinh."</div>";
                    $html .= "<table class='info-tracker'>";
                    $html .= "<tr><td class='item'><strong>"._masodonhang.":</strong> </td><td>";
                    $html .= $v['trackingcode'];
                    $html .= "</td></tr>";
                    $html .= "<tr><td class='item'><strong>"._nguoigui.":</strong></td><td>";
                    $html .= $v['sender'];
                    $html .= "</td></tr>";
                    //$html .= "<tr><td class='item'><strong>"._ngayky.":</strong></td><td>";
                    // $html .= date('D, d M Y H:i:s ', $v['ngaytao']);
                    // $html .= date("d-m-Y",strtotime($str->tracking_details[0]->datetime));
                    // $html .= "</td></tr>";
                    $html .= "<tr><td class='item'><strong>"._kyboi.":</td><td>";
                    $html .= $str->signed_by;
                    $e0 = $str->signed_by;
                    $html .= "</td></tr>";
                    $html .= "<tr><td class='item'><strong>"._hinhthucvanchuyen.":</td><td>";
                    $html .= $v['hinhthucvanchuyen'];
                    $html .= "</td></tr>";
                    $html .= "<tr><td class='item'><strong>"._khoiluong.":</td><td>";
                    $html .= $v['khoiluong'];
                    $html .= "</td></tr>";
                    $html .= "<tr><td class='item'><strong>"._noidi.":</td><td>";
                    $html .= $v['noidi'];
                    $html .= "</td></tr>";
                    $html .= "<tr><td class='item'><strong>"._noiden.":</td><td>";
                    $html .= $v['noiden'];
                    $html .= "</td></tr></table>";
                    $i=0;
                    foreach ($str->tracking_details as $key) {
                        
                        $data[$i]['message'] = $key->message;
                        $data[$i]['datetime'] = $key->datetime;
                        $data[$i]['location'] = $key->tracking_location->city .' - '.$key->tracking_location->country;
                        $data[$i]['time'] = strtotime ($key->datetime);
                        $i++;
                    }
                    $arr_sort = (array_sort($data, 'time', SORT_DESC));
                    foreach ($arr_sort as $k) {
                        $xdate = new DateTime($k['datetime']);
                        $xdate->format("U");
                        $btime = $xdate->getTimestamp();
                        $arr[date("d-m-Y",$btime)][] = $k;
                    } 

                    $i=count($arr_sort);
                    $html .="<div class='track-tit'>"._lichsuhanhtrinh."</div>";
                    $html .= "<div id=".'"info"'.">";
                    $html .='<table class="box_tracking_detail" border="0" cellspacing="0" cellpadding="0">';
                    foreach ((array)$arr as $key => $item) {
                      $html .='<tr class="title"><td colspan="2">'.$key.'</td><td>'._vitri.'</td><td>'._thoigian.'</td></tr>';
                      foreach ($item as $k) {
                        $html .='<tr><td align="center">'.$i.'</td><td>'.$k['message'].'</td><td>'.$k['location'].'</td><td>'.date('H:i',$k['time']).'</td></tr>';
                            $i--;
                        }                                                           
                    }
                    $html .='</table>';
                    $html .= "</div>";

                }elseif($v['id_lv0']==10)
                {
                    $tracking_code = $v['trackref'];
                    $carrier = "FedEx";
                    $mode = 'production';                           
                    $tracker = \EasyPost\Tracker::create(array('tracking_code' => $tracking_code, 'carrier' => $carrier));
                    $str=json_decode($tracker);
                    $html .="<div class='track-tit'>"._thongtinhanhtrinh."</div>";
                    $html .= "<table class='info-tracker'>";
                    $html .= "<tr><td class='item'><strong>"._masodonhang.":</strong> </td><td>";
                    $html .= $v['trackingcode'];
                    $html .= "</td></tr>";
                    $html .= "<tr><td class='item'><strong>"._nguoigui.":</strong></td><td>";
                    $html .= $v['sender'];
                    $html .= "</td></tr>";
                    //$html .= "<tr><td class='item'><strong>"._ngayky.":</strong></td><td>";
                    // $html .= date('D, d M Y H:i:s ', $v['ngaytao']);
                    // $html .= date("d-m-Y",strtotime($str->tracking_details[0]->datetime));
                    // $html .= "</td></tr>";
                    $html .= "<tr><td class='item'><strong>"._kyboi.":</td><td>";
                    $html .= $str->signed_by;
                    $e0 = $str->signed_by;
                    $html .= "</td></tr>";
                    $html .= "<tr><td class='item'><strong>"._hinhthucvanchuyen.":</td><td>";
                    $html .= $v['hinhthucvanchuyen'];
                    $html .= "</td></tr>";
                    $html .= "<tr><td class='item'><strong>"._khoiluong.":</td><td>";
                    $html .= $v['khoiluong'];
                    $html .= "</td></tr>";
                    $html .= "<tr><td class='item'><strong>"._noidi.":</td><td>";
                    $html .= $v['noidi'];
                    $html .= "</td></tr>";
                    $html .= "<tr><td class='item'><strong>"._noiden.":</td><td>";
                    $html .= $v['noiden'];
                    $html .= "</td></tr></table>";                
                    $i=0;
                    foreach ($str->tracking_details as $key) {
                        
                        $data[$i]['message'] = $key->message;
                        $data[$i]['datetime'] = $key->datetime;
                        $data[$i]['location'] = $key->tracking_location->city .' - '.$key->tracking_location->country;
                        $data[$i]['time'] = strtotime ($key->datetime);
                        $i++;
                    }
                    $arr_sort = (array_sort($data, 'time', SORT_DESC));
                    foreach ($arr_sort as $k) {
                        $xdate = new DateTime($k['datetime']);
                        $xdate->format("U");
                        $btime = $xdate->getTimestamp();
                        $arr[date("d-m-Y",$btime)][] = $k;
                    }
     

                    $i=count($arr_sort);
                    $html .="<div class='track-tit'>"._lichsuhanhtrinh."</div>";
                    $html .= "<div id=".'"info"'.">";
                
                

                    $html .='<table class="box_tracking_detail" border="0" cellspacing="0" cellpadding="0">';
                    foreach ((array)$arr as $key => $item) {
                      $html .='<tr class="title"><td colspan="2">'.$key.'</td><td>'._vitri.'</td><td>'._thoigian.'</td></tr>';
                      foreach ($item as $k) {
                        $html .='<tr><td align="center">'.$i.'</td><td>'.$k['message'].'</td><td>'.$k['location'].'</td><td>'.date('H:i',$k['time']).'</td></tr>';
                            $i--;
                        }                                                           
                    }
                    $html .='</table>';
                    $html .= "</div>";
                    
                }else { 
                    if($v['id_lv0']==9)
                    {

                        $homepage = file_get_contents('https://www.tnt.com/api/v1/shipment?con='.$v['trackref'].'&locale=vi_VN&searchType=CON');
                        $homepage=json_decode($homepage);
                        foreach ((array)$homepage as $key1) {
                            $arr = $key1->consignment;

                            foreach ($arr as $key2) { 
                                $html .="<div class='track-tit'>"._thongtinhanhtrinh."</div>";
                                $html .= "<table class='info-tracker'>";
                                $html .= "<tr><td class='item'><strong>"._masodonhang.":</strong> </td><td>";
                                $html .= $v['trackingcode'];
                                $html .= "</td></tr>";
                                $html .= "<tr><td class='item'><strong>"._nguoigui.":</strong></td><td>";
                                $html .= $v['sender'];
                                $html .= "</td></tr>";
                                //$html .= "<tr><td class='item'><strong>"._ngayky.":</strong></td><td>";
                                // $html .= date('D, d M Y H:i:s ', $v['ngaytao']);
                                // $html .= $key2->collectionDate;
                                // $html .= "</td></tr>";
                                $html .= "<tr><td class='item'><strong>"._kyboi.":</td><td>";
                                $html .= $key2->signatory;
                                $e0 = $key2->signatory;
                                $html .= "</td></tr>";
                                $html .= "<tr><td class='item'><strong>"._hinhthucvanchuyen.":</td><td>";
                                $html .= $v['hinhthucvanchuyen'];
                                $html .= "</td></tr>";
                                $html .= "<tr><td class='item'><strong>"._khoiluong.":</td><td>";
                                $html .= $v['khoiluong'];
                                $html .= "</td></tr>";
                                $html .= "<tr><td class='item'><strong>"._noidi.":</td><td>";
                                $html .= $v['noidi'];
                                $html .= "</td></tr>";
                                $html .= "<tr><td class='item'><strong>"._noiden.":</td><td>";
                                $html .= $v['noiden'];
                                $html .= "</td></tr></table>";
                                $html .="<div class='track-tit'>"._lichsuhanhtrinh."</div>";
                                $html .= "<div id=".'"info"'.">";   
                                $i=count($key2->statusData);
                                $html .='<table class="box_tracking_detail" border="0" cellspacing="0" cellpadding="0">';
                                $html .='<tr class="title"><td colspan="2">Infomations</td><td>'._vitri.'</td><td>'._thoigian.'</td></tr>';


                                foreach ($key2->statusData as $key3) {
                                   $html .='<tr><td align="center">'.$i.'</td><td>'.$key3->statusDescription.'</td><td>'.$key3->depot.'</td><td>'.$key3->localEventTime.' '.$key3->localEventDate.'</td></tr>';
                                   $i--;
                                }
                                $html .='</table>';
                                $html .= "</div>";

                           }
                        }
                    }
                    if($v['id_lv0']==11)
                    {
                        $tracking_code = $v['trackref'];
                        $carrier = "UPS";
                        $mode = 'production';                           
                        $tracker = \EasyPost\Tracker::create(array('tracking_code' => $tracking_code, 'carrier' => $carrier));
                        $str=json_decode($tracker);
                        $html .="<div class='track-tit'>"._thongtinhanhtrinh."</div>";
                        $html .= "<table class='info-tracker'>";
                        $html .= "<tr><td class='item'><strong>"._masodonhang.":</strong> </td><td>";
                        $html .= $v['trackingcode'];
                        $html .= "</td></tr>";
                        $html .= "<tr><td class='item'><strong>"._nguoigui.":</strong></td><td>";
                        $html .= $v['sender'];
                        $html .= "</td></tr>";
                        //$html .= "<tr><td class='item'><strong>"._ngayky.":</strong></td><td>";
                        // $html .= date('D, d M Y H:i:s ', $v['ngaytao']);
                        // $html .= date("d-m-Y",strtotime($str->tracking_details[0]->datetime));
                        // $html .= "</td></tr>";
                        $html .= "<tr><td class='item'><strong>"._kyboi.":</td><td>";
                        $html .= $str->signed_by;
                        $e0 = $str->signed_by;
                        $html .= "</td></tr>";
                        $html .= "<tr><td class='item'><strong>"._hinhthucvanchuyen.":</td><td>";
                        $html .= $v['hinhthucvanchuyen'];
                        $html .= "</td></tr>";
                        $html .= "<tr><td class='item'><strong>"._khoiluong.":</td><td>";
                        $html .= $v['khoiluong'];
                        $html .= "</td></tr>";
                        $html .= "<tr><td class='item'><strong>"._noidi.":</td><td>";
                        $html .= $v['noidi'];
                        $html .= "</td></tr>";
                        $html .= "<tr><td class='item'><strong>"._noiden.":</td><td>";
                        $html .= $v['noiden'];
                        $html .= "</td></tr></table>";           
                        $i=0;
                        foreach ($str->tracking_details as $key) {

                            $data[$i]['message'] = $key->message;
                            $data[$i]['datetime'] = $key->datetime;
                            $data[$i]['location'] = $key->tracking_location->city .' - '.$key->tracking_location->country;
                            $data[$i]['time'] = strtotime ($key->datetime);
                            $i++;
                        }
                        $arr_sort = (array_sort($data, 'time', SORT_DESC));
                        foreach ($arr_sort as $k) {
                            $xdate = new DateTime($k['datetime']);
                            $xdate->format("U");
                            $btime = $xdate->getTimestamp();
                            $arr[date("d-m-Y",$btime)][] = $k;
                        }
                        $i=count($arr_sort);
                        $html .="<div class='track-tit'>"._lichsuhanhtrinh."</div>";
                        $html .= "<div id=".'"info"'.">";

                        $html .='<table class="box_tracking_detail" border="0" cellspacing="0" cellpadding="0">';
                        foreach ((array)$arr as $key => $item) {
                          $html .='<tr class="title"><td colspan="2">'.$key.'</td><td>'._vitri.'</td><td>'._thoigian.'</td></tr>';
                          foreach ($item as $k) {
                            $html .='<tr><td align="center">'.$i.'</td><td>'.$k['message'].'</td><td>'.$k['location'].'</td><td>'.date('H:i',$k['time']).'</td></tr>';
                            $i--;
                            }                                                           
                        }
                        $html .='</table>';
                        $html .= "</div>";
                    } 
                    if($v['id_lv0']==13)
                    {
                        $tracking_code = $v['trackref'];
                        date_default_timezone_set('Asia/Saigon');
                        if (count($data)>1) {
                            if ($k==0) {
                                include ('curl.php');
                            }
                        }else{
                            include ('curl.php');
                        }
                        $curl = new cURL;
                        /*kerryexpress*/
                        $Jetstar  = $curl->post('http://kerryexpress.com.vn//index.php?mod=tracking&ajaxAct=1','getVanDonId='.$tracking_code.'');
                        // $array=json_decode($Jetstar,1); 
                        $array=json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $Jetstar), true );
                        $data = $array['hanh_trinh']['tracking'];

                        // echo "<pre>";
                        //     var_dump($array);
                        // echo "</pre>";

                        $html .="<div class='track-tit'>"._thongtinhanhtrinh."</div>";
                        $html .= "<table class='info-tracker'>";
                        $html .= "<tr><td class='item'><strong>"._masodonhang.":</strong> </td><td>";
                        $html .= $v['trackingcode'];
                        $html .= "</td></tr>";
                        $html .= "<tr><td class='item'><strong>"._nguoigui.":</strong></td><td>";
                        $html .= $v['sender'];
                        $html .= "</td></tr>";
                        //$html .= "<tr><td class='item'><strong>"._ngayky.":</strong></td><td>";
                        // $html .= $data[0]['status_date'];
                        // $html .= "</td></tr>";
                        $html .= "<tr><td class='item'><strong>"._kyboi.":</td><td>";
                        $html .= $array['khach_hang']['nguoinhan'];
                        $e0 = $array['khach_hang']['nguoinhan'];
                        $html .= "</td></tr>";
                        $html .= "<tr><td class='item'><strong>"._hinhthucvanchuyen.":</td><td>";
                        $html .= $v['hinhthucvanchuyen'];
                        $html .= "</td></tr>";
                        $html .= "<tr><td class='item'><strong>"._khoiluong.":</td><td>";
                        $html .= $v['khoiluong'];
                        $html .= "</td></tr>";
                        $html .= "<tr><td class='item'><strong>"._noidi.":</td><td>";
                        $html .= $v['noidi'];
                        $html .= "</td></tr>";
                        $html .= "<tr><td class='item'><strong>"._noiden.":</td><td>";
                        $html .= $v['noiden'];
                        $html .= "</td></tr></table>";
                        // echo '<pre>';
                        // print_r($array['hanh_trinh']['tracking']);
                        // echo '</pre>';

                        $arr_sort = (array_sort($data, 'status_date', SORT_DESC));
                        foreach ($arr_sort as $k) {
                            $xdate = new DateTime($k['status_date']);
                            $xdate->format("U");
                            $btime = $xdate->getTimestamp();
                            $arr[date("d-m-Y",$btime)][] = $k;
                        } 
                        $i=count($arr_sort);
                        $html .="<div class='track-tit'>"._lichsuhanhtrinh."</div>";
                        $html .= "<div id=".'"info"'.">";

                        $html .='<table class="box_tracking_detail" border="0" cellspacing="0" cellpadding="0">';
                        foreach ((array)$arr as $key => $item) {

                            $html .='<tr class="title"><td colspan="2">'.$key.'</td><td>'._vitri.'</td><td>'._thoigian.'</td></tr>';
                            foreach ($item as $k) {
                                $html .='<tr><td align="center">'.$i.'</td><td>'.(($k['is_scan_in']=='N')?'Xuất':'Nhập').'</td><td>'.$k['warehouse'].'</td><td>'.date('H:i',strtotime($k['status_date'])).'</td></tr>';
                                $i--;
                            }
                        }
                        $html .='</table>';
                        $html .= "</div>";

                    } 
                    if($v['id_lv0']==21)
                    {
                        $tracking_code = $v['trackref'];
                        date_default_timezone_set('Asia/Saigon');
                        if (count($data)>1) {
                            if ($k==0) {
                                include ('curl.php');
                            }
                        }else{
                            include ('curl.php');
                        }
                        $curl = new cURL;
                        /*skydart*/
                        $Jetstar  = $curl->get('http://skydart.com.vn/trackingdetail.aspx?id='.$tracking_code.'',''); 
                        $Jetstar = delete_all_between('<head>', '</head>', $Jetstar); 
                        $Jetstar = delete_all_between('<script', '</script>', $Jetstar); 

                        $html .="<div class='track-tit'>"._thongtinhanhtrinh."</div>";
                        $html .= "<table class='info-tracker'>";
                        $html .= "<tr><td class='item'><strong>"._masodonhang.":</strong> </td><td>";
                        $html .= $v['trackingcode'];
                        $html .= "</td></tr>";
                        $html .= "<tr><td class='item'><strong>"._nguoigui.":</strong></td><td>";
                        $html .= $v['sender'];
                        $html .= "</td></tr>";
                        //$html .= "<tr><td class='item'><strong>"._ngayky.":</strong></td><td>";
                        // $html .= date('D, d M Y H:i:s ', $v['ngaytao']);
                        // $html .= "</td></tr>";
                        $html .= "<tr><td class='item'><strong>"._kyboi.":</td><td>";
                        $html .= $v['sign'];
                        $e0 = $v['sign'];
                        $html .= "</td></tr>";
                        $html .= "<tr><td class='item'><strong>"._hinhthucvanchuyen.":</td><td>";
                        $html .= $v['hinhthucvanchuyen'];
                        $html .= "</td></tr>";
                        $html .= "<tr><td class='item'><strong>"._khoiluong.":</td><td>";
                        $html .= $v['khoiluong'];
                        $html .= "</td></tr>";
                        $html .= "<tr><td class='item'><strong>"._noidi.":</td><td>";
                        $html .= $v['noidi'];
                        $html .= "</td></tr>";
                        $html .= "<tr><td class='item'><strong>"._noiden.":</td><td>";
                        $html .= $v['noiden'];
                        $html .= "</td></tr></table>";
                        $html .="<div class='track-tit'>"._lichsuhanhtrinh."</div>";
                        $html .= '<div class="skydart">'.$Jetstar.'</div>';


                    } 
                    if($v['id_lv0']==14)
                    {
                        $tracking_code = $v['trackref'];
                        date_default_timezone_set('Asia/Saigon');
                        if (count($data)>1) {
                            if ($k==0) {
                                include ('curl.php');
                            }
                        }else{
                            include ('curl.php');
                        }
                        
                        $curl = new cURL;
                        /*vietstarexpress*/
                        $Jetstar  = $curl->get('http://tracking.vietstarexpress.net/tracking/bill/'.$tracking_code.'',''); 

                        $html .="<div class='track-tit'>"._thongtinhanhtrinh."</div>";
                        $html .= "<table class='info-tracker'>";
                        $html .= "<tr><td class='item'><strong>"._masodonhang.":</strong> </td><td>";
                        $html .= $v['trackingcode'];
                        $html .= "</td></tr>";
                        $html .= "<tr><td class='item'><strong>"._nguoigui.":</strong></td><td>";
                        $html .= $v['sender'];
                        $html .= "</td></tr>";
                        //$html .= "<tr><td class='item'><strong>"._ngayky.":</strong></td><td>";
                        // $html .= date('D, d M Y H:i:s ', $v['ngaytao']);
                        // $html .= "</td></tr>";
                        $html .= "<tr><td class='item'><strong>"._kyboi.":</td><td>";
                        $html .= $v['sign'];
                        $e0 = $v['sign'];
                        $html .= "</td></tr>";
                        $html .= "<tr><td class='item'><strong>"._hinhthucvanchuyen.":</td><td>";
                        $html .= $v['hinhthucvanchuyen'];
                        $html .= "</td></tr>";
                        $html .= "<tr><td class='item'><strong>"._khoiluong.":</td><td>";
                        $html .= $v['khoiluong'];
                        $html .= "</td></tr>";
                        $html .= "<tr><td class='item'><strong>"._noidi.":</td><td>";
                        $html .= $v['noidi'];
                        $html .= "</td></tr>";
                        $html .= "<tr><td class='item'><strong>"._noiden.":</td><td>";
                        $html .= $v['noiden'];
                        $html .= "</td></tr></table>";
                        $html .="<div class='track-tit'>"._lichsuhanhtrinh."</div>";
                        $html .= '<div class="vietstarexpress">'.$Jetstar.'</div>'; 
                    } 
                    $testNumbers[$v['trackref']] = $i;
                }
            }else{
                // date_default_timezone_set('UTC'); 
                // date_default_timezone_set('Asia/Saigon');
                // require_once("templates/easypost/easypost.php");
                // \EasyPost\EasyPost::setApiKey('2fxIdsXsGzVWudKPvO8Rmw');


                
                $html .="<div class='track-tit'>"._thongtinhanhtrinh."</div>";
                $html .= "<table class='info-tracker'>";
                $html .= "<tr><td class='item'><strong>"._masodonhang.":</strong> </td><td>";
                $html .= $v['trackingcode'];
                $html .= "</td></tr>";
                $html .= "<tr><td class='item'><strong>"._nguoigui.":</strong></td><td>";
                $html .= $v['sender'];
                $html .= "</td></tr>";
                //$html .= "<tr><td class='item'><strong>"._ngayky.":</strong></td><td>";
                // $html .= date('D, d M Y H:i:s ', $v['ngaytao']);
                // $html .= date("d-m-Y",$v['ngaytao']);
                // $html .= "</td></tr>";
                $html .= "<tr><td class='item'><strong>"._kyboi.":</td><td>";
                $html .= $v['sign'];
                $e0 = $v['sign'];
                $html .= "</td></tr>";
                $html .= "<tr><td class='item'><strong>"._hinhthucvanchuyen.":</td><td>";
                $html .= $v['hinhthucvanchuyen'];
                $html .= "</td></tr>";
                $html .= "<tr><td class='item'><strong>"._khoiluong.":</td><td>";
                $html .= $v['khoiluong'];
                $html .= "</td></tr>";
                $html .= "<tr><td class='item'><strong>"._noidi.":</td><td>";
                $html .= $v['noidi'];
                $html .= "</td></tr>";
                $html .= "<tr><td class='item'><strong>"._noiden.":</td><td>";
                $html .= $v['noiden'];
                $html .= "</td></tr></table>";



                $d->reset();
                $sql="select ten_$lang as ten, vitri_$lang as vitri, mota_$lang as mota, time from #_tintuc_tab where hienthi=1 and type='van-don' and id_pro = '".$v['id']."' order by stt,id desc";
                $d->query($sql);
                $data_tab=$d->result_array();
                $arr_sort = (array_sort($data_tab, 'time', SORT_DESC));


                

                foreach ((array)$arr_sort as $k) {
                    // var_dump($k['time']);
                    $xdate = new DateTime($k['time']);
                    $xdate->format("U");
                    $btime = $xdate->getTimestamp();
                    $arr[date("d-m-Y",$btime)][] = $k;
                }
                $i=count($arr_sort);
                $html .="<div class='track-tit'>"._lichsuhanhtrinh."</div>";
                $html .= "<div id=".'"info"'.">";

                $html .='<table class="box_tracking_detail" border="0" cellspacing="0" cellpadding="0">';
                foreach ((array)$arr as $key => $item) {
                    $html .='<tr class="title"><td colspan="2">'.$key.'</td><td>'._vitri.'</td><td>'._thoigian.'</td></tr>';
                    foreach ($item as $k) {
                        $html .='<tr><td align="center">'.$i.'</td><td>'.$k['mota'].'</td><td>'.$k['vitri'].'</td><td>'.date('H:i',strtotime($k['time'])).'</td></tr>';
                        $i--;
                    }                                                           
                }
                $html .='</table>';
                $html .= "</div>";


            }
        }
        echo $html;
    }else{
        echo "Không có kết quả của mã vận đơn!!!";
    }
}
//print_r($testNumbers);exit();
get_data_track($testNumbers, $confign,$e0);
}
}
?>