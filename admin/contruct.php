// Dùng alter tao them field cho table 

ALTER TABLE table_product_list ADD `maproduct` INT( 11 ) NOT NULL


alter table jos_vm_product add (
 
nc_product_new_field varchar(200) null
 
);

<?php

UPDATE table_news SET mota_vi = REPLACE(mota_vi, 'http://demo64.ninavietnam.org/honeyandcoffee',  'http://purenature.vn' )

function delete_imglist(){
	global $d,$url_back;		
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,thumb, photo from #_product_list where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_product_list.$row['photo']);
				delete_file(_upload_product_list.$row['thumb']);			
			}
		$sql = "UPDATE #_product_list SET photo ='',thumb='' WHERE  id = '".$id."'";
		$d->query($sql);
		}
		if($d->query($sql))
			redirect("http://localhost/thanhnienmoi/admin/index.php?com=product&act=edit_list&id=".$id);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=edit_list&id=".$id);
	}else transfer("Không nhận được dữ liệu", "index.php?com=product&act=edit_list&id=".$id);
}
?>

ALTER TABLE table_news_list
ADD COLUMN alt_vi varchar(255) NOT NULL AFTER title_ge,
ADD COLUMN alt_en VARCHAR(255) NOT NULL AFTER title_ge,
ADD COLUMN alt_cn varchar(255) NOT NULL AFTER title_ge,
ADD COLUMN alt_ge varchar(255) NOT NULL AFTER title_ge;


ALTER TABLE table_bando
ADD COLUMN title_vi varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL AFTER mota_ge,
ADD COLUMN title_en VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL AFTER mota_ge,
ADD COLUMN title_cn varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL AFTER mota_ge,
ADD COLUMN title_ge varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL AFTER mota_ge;


ALTER TABLE table_news_list
ADD COLUMN title_vi varchar(255) NOT NULL AFTER mota_ge,
ADD COLUMN title_en VARCHAR(255) NOT NULL AFTER mota_ge,
ADD COLUMN title_cn varchar(255) NOT NULL AFTER mota_ge,
ADD COLUMN title_ge varchar(255) NOT NULL AFTER mota_ge;


ALTER TABLE table_quangcao
ADD COLUMN title_vi varchar(255) NOT NULL AFTER mota_ge,
ADD COLUMN title_en VARCHAR(255) NOT NULL AFTER mota_ge,
ADD COLUMN title_cn varchar(255) NOT NULL AFTER mota_ge,
ADD COLUMN title_ge varchar(255) NOT NULL AFTER mota_ge;



ALTER TABLE users
ADD COLUMN `count` SMALLINT(6) NOT NULL AFTER `lastname`,
ADD COLUMN `log` VARCHAR(12) NOT NULL AFTER `count`,
ADD COLUMN `status` INT(10) UNSIGNED NOT NULL AFTER `log`;


$your_table  = $add_field->prefix.'table_product_list';
			$your_column ="test_".$value; 



		//	print_r($_POST);

		//	dump($_POST);

			//echo ($your_column.$value);
			//die();

			if ( ($data["test_".$value]!=$your_column ) )
			{  

				$result= $d->query("ALTER TABLE $your_table ADD $your_column  VARCHAR(255)  CHARACTER SET utf8 NOT NULL ");
			}