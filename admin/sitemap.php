<?php	
	session_start();
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , '../libraries/');

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";	
	include_once _lib."pclzip.php";
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";	
	$login_name = 'NINACO';	
	$d = new database($config['database']);	
	$archive = new PclZip($file);
		
	function CreateXML($tbl='',$com='',$type=''){
		global $domtree,$xmlRoot,$config_url;	
		if($tbl == '') return false;	
		$result = mysql_query("select id,tenkhongdau from table_$tbl where hienthi=1 order by stt,id desc");
			while ($row = mysql_fetch_array($result)) {
				$url = $domtree->createElement("url");
				$url = $xmlRoot->appendChild($url);
				/* you should enclose the following two lines in a cicle */
				$url->appendChild($domtree->createElement('loc','http://'.$config_url.'/'.$com.'/'.$row['tenkhongdau'].'-'.$row['id'].'.html'));
				
			}
		return $url;
	}
	
	/* create a dom document with encoding utf8 */
    $domtree = new DOMDocument('1.0', 'UTF-8');
    /* create the root element of the xml tree */
    $xmlRoot = $domtree->createElement("xml");
    /* append it to the document created */
    $xmlRoot = $domtree->appendChild($xmlRoot);
	
	CreateXML('product','san-pham');
	

	
	/*CreateXML('product_danhmuc','san-pham','1');*/
	
	$url = $domtree->createElement("url");
	$url = $xmlRoot->appendChild($url);
	/* you should enclose the following two lines in a cicle */
	$url->appendChild($domtree->createElement('loc','http://'.$config_url.'/gioi-thieu.html'));
	
	$url = $domtree->createElement("url");
	$url = $xmlRoot->appendChild($url);
	/* you should enclose the following two lines in a cicle */
	$url->appendChild($domtree->createElement('loc','http://'.$config_url.'/lien-he.html'));
	

	

			
    /* get the xml printed */
	if($domtree->save('../sitemap.xml'))
		transfer('Đã tạo thành công sitemap.', 'index.php');
	else
		transfer('Khời tạo dữ liệu thất bại.', 'index.php');

?>
