<?php
if (!defined('_source'))  die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$url_back=$_SERVER['HTTP_REFERER'];

switch ($act) {
    case "man":
        get_items();
        $template = "lang_define/items";
        break;
    case "add":
        $template = "lang_define/item_add";
        break;
    case "edit":
        get_item();
        $template = "lang_define/item_add";
        break;
    case "save":
        save_item();
        break;
    case "delete":
        delete_item();
        break;
    
    default:
        $template = "index";
}

function fns_Rand_digit($min, $max, $num) {
    $result = '';
    for ($i = 0; $i < $num; $i++) {
        $result.=rand($min, $max);
    }
    return $result;
}

function get_items() {
    global $d, $items, $paging, $url_back , $url_link,$totalRows , $pageSize, $offset;

    

  
	if ($_REQUEST['keyword'] != '') {
        $keyword = addslashes($_REQUEST['keyword']);
        $where.=" and ten LIKE '%$keyword%' or lang_vi LIKE '%$keyword%' or lang_en LIKE '%$keyword%' or lang_cn LIKE '%$keyword%' or lang_jp LIKE '%$keyword%' ";
    }
   
	
	
	$sql="SELECT count(id) AS numrows FROM #_lang_define where id  $where ";
	$d->query($sql);	
	$dem=$d->fetch_array();
	$totalRows=$dem['numrows'];
	$page=$_GET['p'];
	
	$pageSize=20;
	$offset=5;
						
	if ($page=="")
		$page=1;
	else 
		$page=$_GET['p'];
	$page--;
	$bg=$pageSize*$page;		
	
	$sql = "select * from #_lang_define where id $where order by stt,id desc limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=lang_define&act=man";
}

function get_item() {
    global $d, $item;
    $id = isset($_GET['id']) ? themdau($_GET['id']) : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "index.php?com=lang_define&act=man");

    $sql = "select * from #_lang_define where id='" . $id . "'";
    $d->query($sql);
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "index.php?com=lang_define&act=man");
    $item = $d->fetch_array();
}

function save_item() {
    global $d;
    $file_name = fns_Rand_digit(0, 9, 8);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "index.php?com=lang_define&act=man");
    $id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	$data['lang_vi'] = $_POST['lang_vi'];
	$data['lang_en'] = $_POST['lang_en'];
    $data['lang_jp'] = $_POST['lang_jp'];
	$data['ten'] = $_POST['ten'];
    $ID_PAGE=$_REQUEST['curPage'];

   // echo($ID_PAGE);
   // die();
	
    if ($id) {
        

        $d->setTable('lang_define');
        $d->setWhere('id', $id);
        if ($d->update($data))
            redirect("index.php?com=lang_define&act=man&curPage=".$ID_PAGE."");
        else
            transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=lang_define&act=man");
    }else {
        

        $d->setTable('lang_define');
        if ($d->insert($data))
            redirect("index.php?com=lang_define&act=man&curPage=".$ID_PAGE."");
        else
            transfer("Lưu dữ liệu bị lỗi", "index.php?com=lang_define&act=man");
    }
}

function delete_item() {
    global $d;

    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);

        $d->reset();
        $sql = "select * from #_lang_define where id='" . $id . "'";
        $d->query($sql);
        if ($d->num_rows() > 0) {
            while ($row = $d->fetch_array()) {
                delete_file(_upload_product . $row['photo']);
                delete_file(_upload_product . $row['thumb']);
            }
            $sql = "delete from #_lang_define where id='" . $id . "'";
            $d->query($sql);
        }

        if ($d->query($sql))
            redirect("index.php?com=lang_define&act=man");
        else
            transfer("Xóa dữ liệu bị lỗi", "index.php?com=lang_define&act=man");
    } else
        transfer("Không nhận được dữ liệu", "index.php?com=lang_define&act=man");
}

//===========================================================
?>