// JavaScript Document
// Code GaConIT:Nguyễn Ngọc Tân
// Email:nguyentanit_91@yahoo.com

/*-PRODUCT-*/



function load_donvi(){
	$.ajax({
		url:'ajax/process.php',
		type: "POST",
		dataType: "html",
		data: {cmd:'load_donvi'},
		success: function(res){
			$('#id_donvi').html(res);
		}
	});
}

function load_donvi_edit(id_donvi){
	$.ajax({
		url:'ajax/process.php',
		type: "POST",
		dataType: "html",
		data: {cmd:'load_donvi_edit',id_donvi:id_donvi},
		success: function(res){
			$('#id_donvi').html(res);
		}
	});
}



function load_typeposting(){
	$.ajax({
		url:'ajax/process.php',
		type: "POST",
		dataType: "html",
		data: {cmd:'load_typeposting'},
		success: function(res){
			$('#id_typeposting').html(res);
		}
	});
}

function load_typeposting_edit(id_typeposting){
	$.ajax({
		url:'ajax/process.php',
		type: "POST",
		dataType: "html",
		data: {cmd:'load_typeposting_edit',id_typeposting:id_typeposting},
		success: function(res){
			$('#id_typeposting').html(res);
		}
	});
}



function load_list(com_type){
	$.ajax({
		url:'ajax/process.php',
		type: "POST",
		dataType: "html",
		data: {cmd:'load_list',com_type:com_type},
		success: function(res){
			$('#id_list').html(res);
		}
	});
}

function load_list_edit(com_type,id_list){
	$.ajax({
		url:'ajax/process.php',
		type: "POST",
		dataType: "html",
		data: {cmd:'load_list_edit',com_type:com_type,id_list:id_list},
		success: function(res){
			$('#id_list').html(res);
		}
	});
}

function load_cat(com_type,id_list){
	$.ajax({
		url:'ajax/process.php',
		type: "POST",
		dataType: "html",
		data: {cmd:'load_cat',com_type:com_type,id_list:id_list},
		success: function(res){
			$('#id_cat').html(res);
		}
	});
}

function load_cat_edit(com_type,id_list, id_cat){
	$.ajax({
		url:'ajax/process.php',
		type: "POST",
		dataType: "html",
		data: {cmd:'load_cat_edit',com_type:com_type,id_list:id_list, id_cat:id_cat},
		success: function(res){
			$('#id_cat').html(res);
		}
	});
}

function load_item(com_type,id_cat){
	$.ajax({
		url:'ajax/process.php',
		type: "POST",
		dataType: "html",
		data: {cmd:'load_item',com_type:com_type,id_cat:id_cat},
		success: function(res){
			$('#id_item').html(res);
		}
	});
}

function load_item_edit(com_type,id_list, id_cat, id_item){
	$.ajax({
		url:'ajax/process.php',
		type: "POST",
		dataType: "html",
		data: {cmd:'load_item_edit',com_type:com_type,id_list:id_list, id_cat:id_cat, id_item:id_item},
		success: function(res){
			$('#id_item').html(res);
		}
	});
}



function load_sub(com_type,id_item){
	$.ajax({
		url:'ajax/process.php',
		type: "POST",
		dataType: "html",
		data: {cmd:'load_sub',com_type:com_type,id_item:id_item},
		success: function(res){
			$('#id_sub').html(res);
		}
	});
}

function load_sub_edit(com_type,id_list, id_cat, id_item,id_sub){
	
	
	$.ajax({
		url:'ajax/process.php',
		type: "POST",
		dataType: "html",
		data: {cmd:'load_sub_edit',com_type:com_type,id_list:id_list, id_cat:id_cat, id_item:id_item, id_sub:id_sub},
		success: function(res){
			$('#id_sub').html(res);
		}
	});
}


/**************************load tinh thanh ********************************/



function load_tinh(){
	$.ajax({
		url:'ajax/process_tinhquan.php',
		type: "POST",
		dataType: "html",
		data: {cmd:'load_tinh'},
		success: function(res){
			$('#id_tinh').html(res);
		}
	});
}

function load_tinh_edit(id_tinh){
	$.ajax({
		url:'ajax/process_tinhquan.php',
		type: "POST",
		dataType: "html",
		data: {cmd:'load_tinh_edit',id_tinh:id_tinh},
		success: function(res){
			$('#id_tinh').html(res);
		}
	});
}

function load_huyen(id_tinh){
	$.ajax({
		url:'ajax/process_tinhquan.php',
		type: "POST",
		dataType: "html",
		data: {cmd:'load_huyen',id_tinh:id_tinh},
		success: function(res){
			$('#id_huyen').html(res);
		}
	});
}

function load_huyen_edit(id_tinh, id_huyen){
	$.ajax({
		url:'ajax/process_tinhquan.php',
		type: "POST",
		dataType: "html",
		data: {cmd:'load_huyen_edit',id_tinh:id_tinh, id_huyen:id_huyen},
		success: function(res){
			$('#id_huyen').html(res);
		}
	});
}




function load_phuong(id_huyen){
	$.ajax({
		url:'ajax/process_tinhquan.php',
		type: "POST",
		dataType: "html",
		data: {cmd:'load_phuong',id_huyen:id_huyen},
		success: function(res){
			$('#id_phuong').html(res);
		}
	});
}

function load_phuong_edit(id_tinh, id_huyen, id_phuong){
	$.ajax({
		url:'ajax/process_tinhquan.php',
		type: "POST",
		dataType: "html",
		data: {cmd:'load_phuong_edit',id_tinh:id_tinh, id_huyen:id_huyen, id_phuong:id_phuong},
		success: function(res){
			$('#id_phuong').html(res);
		}
	});
}




function load_duong(id_phuong){
	$.ajax({
		url:'ajax/process_tinhquan.php',
		type: "POST",
		dataType: "html",
		data: {cmd:'load_duong',id_phuong:id_phuong},
		success: function(res){
			$('#id_duong').html(res);
		}
	});
}

function load_duong_edit(id_tinh, id_huyen, id_phuong,id_duong){
	$.ajax({
		url:'ajax/process_tinhquan.php',
		type: "POST",
		dataType: "html",
		data: {cmd:'load_duong_edit',id_tinh:id_tinh, id_huyen:id_huyen, id_phuong:id_phuong, id_duong:id_duong},
		success: function(res){
			$('#id_duong').html(res);
		}
	});
}






/***********************LOAD THUOC TINH Ô TÔ****************************/


function load_mauxe(){
	$.ajax({
		url:'ajax/process.php',
		type: "POST",
		dataType: "html",
		data: {cmd:'load_mauxe'},
		success: function(res){
			$('#id_mauxe').html(res);
		}
	});
}



function load_mauxe_edit(id_mauxe){
	$.ajax({
		url:'ajax/process.php',
		type: "POST",
		dataType: "html",
		data: {cmd:'load_mauxe_edit',id_mauxe:id_mauxe},
		success: function(res){
			$('#id_mauxe').html(res);
		}
	});
}


function load_hangxe(){
	$.ajax({
		url:'ajax/process.php',
		type: "POST",
		dataType: "html",
		data: {cmd:'load_hangxe'},
		success: function(res){
			$('#id_hangxe').html(res);
		}
	});
}

function load_hangxe_edit(id_hangxe){
	

	
	$.ajax({
		url:'ajax/process.php',
		type: "POST",
		dataType: "html",
		data: {cmd:'load_hangxe_edit',id_hangxe:id_hangxe},
		success: function(res){
			$('#id_hangxe').html(res);
		}
	});
}

function load_tenxe(id_hangxe){
	$.ajax({
		url:'ajax/process.php',
		type: "POST",
		dataType: "html",
		data: {cmd:'load_tenxe',id_hangxe:id_hangxe},
		success: function(res){
			$('#id_tenxe').html(res);
		}
	});
}

function load_tenxe_edit(id_hangxe, id_tenxe){
	$.ajax({
		url:'ajax/process.php',
		type: "POST",
		dataType: "html",
		data: {cmd:'load_tenxe_edit',id_hangxe:id_hangxe, id_tenxe:id_tenxe},
		success: function(res){
			$('#id_tenxe').html(res);
		}
	});
}

/*********************************START BÐS *********************************/



function load_loaibds(){
	//alert("add");
	$.ajax({
		url:'ajax/process.php',
		type: "POST",
		dataType: "html",
		data: {cmd:'load_loaibds'},
		success: function(res){
			$('#id_loaibds').html(res);
		}
	});
}



function load_loaibds_edit(id_loaibds){
	
	//alert("edit");
	$.ajax({
		url:'ajax/process.php',
		type: "POST",
		dataType: "html",
		data: {cmd:'load_loaibds_edit',id_loaibds:id_loaibds},
		success: function(res){
			$('#id_loaibds').html(res);
		}
	});
}




function load_tinhtrang(){
	$.ajax({
		url:'ajax/process.php',
		type: "POST",
		dataType: "html",
		data: {cmd:'load_tinhtrang'},
		success: function(res){
			$('#id_tinhtrang').html(res);
		}
	});
}

function load_tinhtrang_edit(id_tinhtrang){
	$.ajax({
		url:'ajax/process.php',
		type: "POST",
		dataType: "html",
		data: {cmd:'load_tinhtrang_edit',id_tinhtrang:id_tinhtrang},
		success: function(res){
			$('#id_tinhtrang').html(res);
		}
	});
}