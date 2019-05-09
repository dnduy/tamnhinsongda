// JavaScript Document
// Code GaConIT:Nguyễn Ngọc Tân
// Email:nguyentanit_91@yahoo.com

/*-PRODUCT-*/





function load_list(com_type){
	$.ajax({
		url:'ajax/process_news.php',
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
		url:'ajax/process_news.php',
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
		url:'ajax/process_news.php',
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
		url:'ajax/process_news.php',
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
		url:'ajax/process_news.php',
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
		url:'ajax/process_news.php',
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
		url:'ajax/process_news.php',
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
		url:'ajax/process_news.php',
		type: "POST",
		dataType: "html",
		data: {cmd:'load_sub_edit',com_type:com_type,id_list:id_list, id_cat:id_cat, id_item:id_item, id_sub:id_sub},
		success: function(res){
			$('#id_sub').html(res);
		}
	});
}


