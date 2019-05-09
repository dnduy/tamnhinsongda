<?php

	// get price sale
function getPriceSale($price,$percent){
	$result = 0;
	$tiengiam = $price*$percent/100;
	$result = $price - $tiengiam;
	return $result;
}

function get_tong_tien($id=0){
		global $d;
		if($id>0){
			$d->reset();
			$sql="select gia,soluong from #_order_detail where id_order='".$id."'";
			$d->query($sql);
			$result=$d->result_array();
			$tongtien=0;
			for($i=0,$count=count($result);$i<$count;$i++) { 
				$tongtien+=	$result[$i]['gia']*$result[$i]['soluong'];	
			}
			return $tongtien;
		}else return 0;
	}
	

	function get_product_name($pid,$lang){
		global $d, $row;
		$sql = "select ten_$lang from #_product where id=$pid";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row["ten_$lang"];
		
	}
	
	function get_product_img($pid){
		global $d, $row;
		$sql = "select photo from #_product where id=$pid";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row['photo'];
	}
	
	function get_price($pid){
		global $d, $row;
		$sql = "select gia from table_product where id=$pid";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row['gia'];
	}
	function get_price_km($pid){
		global $d, $row;
		$sql = "select giamgia from table_product where id=$pid";
		$d->query($sql);
		$row = $d->fetch_array();
		return ($row['giamgia']/100);
	}
	function remove_product($pid){
		$pid=intval($pid);
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['cart'][$i]['productid']){
				unset($_SESSION['cart'][$i]);
				break;
			}
		}
		$_SESSION['cart']=array_values($_SESSION['cart']);
	}
	function get_order_total(){
		$max=count($_SESSION['cart']);
		$sum=0;
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$price=(get_price($pid))-(get_price($pid)*get_price_km($pid));
			$sum+=$price*$q;

		}
		return $sum;
	}
	
	function get_total(){
		$max=count($_SESSION['cart']);
		$sum=0;
		for($i=0;$i<$max;$i++){				
			$sum++;
		}
		return $sum;
	}
	function addtocart($pid,$q,$id_user_hoahong=''){
		if($pid<1 or $q<1) return;

		if(is_array($_SESSION['cart'])){
			
			$i=product_exists($pid);
		
			if($i!=-1) {
				$_SESSION['cart'][$i]['qty']=$q+$_SESSION['cart'][$i]['qty'];

				return;
				}
			else{
			$max=count($_SESSION['cart']);
			$_SESSION['cart'][$max]['productid']=$pid;
			$_SESSION['cart'][$max]['qty']=$q;
			$_SESSION['cart'][$max]['id_user_hoahong']= $id_user_hoahong;
			}
		}
		else{
			$_SESSION['cart']=array();
			$_SESSION['cart'][0]['productid']=$pid;
			$_SESSION['cart'][0]['qty']=$q;
			$_SESSION['cart'][0]['id_user_hoahong']=$id_user_hoahong;

		}
	}
	function product_exists($pid){
		$pid=intval($pid);
		$max=count($_SESSION['cart']);
		$flag=-1;
		
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['cart'][$i]['productid']){
				$flag=$i;
				break;
			}
		}
		return $flag;
	}

	
	
	function get_total_qty(){
		$sum=0;
		foreach ($_SESSION['cart'] as $key => $value) {
			$q=$value['qty'];
			$sum+=$q;
		}
		
		return $sum;
	}
	
	
	
		// lấy số lượng tồn kho của sản phẩm
	function soluongton_product($id_product,$soluong){
		global $d;
		$d->reset();
		$sql = "select id,soluongton from #_product where id='".$id_product."'  ";
		$d->query($sql);
		$arr_soluongton = $d->fetch_array(); // lấy tất cả số lượng  trong sản phẩm đó
		if(!empty($arr_soluongton)){
			//$i=0;
			$so_luong=$arr_soluongton["soluongton"];
		
			for( $i=0; $i<$so_luong; $i++ )
			 {
				$str.='<option class="load_quality'.$arr_soluongton["id"].'" value='.($i+1).'>'.($i+1) .'</option>';
			 }

			return $str;
		}
	}
	
	// Cập nhật lại số lượng tồn kho khi xóa đơn hàng
	function update_soluongton_order($id_order){
		global $d;
		$d->reset();
		$sql = "select id_product,soluong from #_order_detail where id_order='".$id_order."'";
		$d->query($sql);
		$arr_product = $d->result_array(); // lấy tất cả sản phẩm trong order đó
		if(!empty($arr_product)){
			foreach($arr_product as $pro){
				update_soluongton_product($pro['id_product'],$pro['soluong']);
			}
		}
	}
	
	// Cập nhật lại số lượng tồn kho của sản phẩm
	function update_soluongton_product($id_product,$soluong){
		global $d;
		$d->reset();
		$sql = "UPDATE table_product SET soluongton=soluongton+$soluong WHERE id=$id_product";
		$d->query($sql);
	}
	
	// Cập nhật lại trạng thái kho của sản phẩm dựa trên số lượng tồn
	function update_trangthaikho_product($id_product){
		global $d;
		$d->reset();
		$sql = "select soluongton from #_product where id='".$id_product."'";
		$d->query($sql);
		$result = $d->fetch_array();
		if ($result["soluongton"]>0)
		{
			$d->reset();
			$sql = "UPDATE table_product SET trangthaikho=1 WHERE id=$id_product";
			$d->query($sql);
		}
		else 
		{
			$d->reset();
			$sql = "UPDATE table_product SET trangthaikho=0 WHERE id=$id_product";
			$d->query($sql);
		}
	
	}
	
	// lấy số lượng tồn của sản phẩm đó
	function get_soluongton($id_product){
		global $d;
		$d->reset();
		$sql = "select soluongton from #_product where id='".$id_product."'";
		$d->query($sql);
		$result = $d->fetch_array();
		return $result['soluongton'];
	}
	
	// lấy tên trạng thái kho
	function getTrangthaikho($id){
	global $d;
	$sql="select trangthaikho from table_product where id = '$id'";
	$d->query($sql);
	$result = $d->fetch_array();
		if ($result["trangthaikho"]==1)
		{
			
			return _conhang;
		}
		else 
		{
			return _hethang;
		}
	
	}
	
	// cập nhật số lượt mua sản phẩm
	function update_slmua($pid, $q){
		global $d, $row;
		$sql = "UPDATE #_product SET slmua=slmua+$q  WHERE id=$pid";
		$d->query($sql);
	}


?>