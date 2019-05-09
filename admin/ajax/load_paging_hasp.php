<?php
	error_reporting(0);
	session_start();
	$session=session_id();
	@define ( '_template' , '../templates/');
	@define ( '_source' , '../sources/');
	@define ( '_lib' , '../../libraries/');

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";	
	include_once _lib."paging_ajax.php";
	$d = new database($config['database']);
	
	

   // @$id=$_GET["id"];
	

	$id=@$_REQUEST['id'];
	

	
	
	


	
	
	
// KIỂM TRA TỒN TẠI PAGE HAY KHÔNG

if(isset($_POST["page"]))
{
	// ĐƯA 2 FILE VÀO TRANG & KHỞI TẠO CLASS
	
	
	$paging1 = new paging_ajax();
	
	
	// ĐẶT CLASS CHO THÀNH PHẦN PHÂN TRANG THEO Ý MUỐN
	$paging1->class_pagination = "pagination";
	$paging1->class_active = "active";
	$paging1->class_inactive = "inactive";
	$paging1->class_go_button = "go_button";
	$paging1->class_text_total = "total";
	$paging1->class_txt_goto = "txt_go_button";

	// KHỞI TẠO SỐ PHẦN TỬ TRÊN TRANG
    $paging1->per_page = 12; 	
    
    // LẤY GIÁ TRỊ PAGE THÔNG QUA PHƯƠNG THỨC POST
    $paging1->page = $_POST["page"];
    
	
    // VIẾT CÂU TRUY VẤN & LẤY KẾT QUẢ TRẢ VỀ
   
	
	
	$paging1->text_sql = "SELECT * FROM table_hasp where hienthi=1 and  id_photo='".$id."' and com='hasp' order by stt asc";
    $result_pag_data = $paging1->GetResult();
	
	
	

$com_hasp="return updateStthinh('hasp'";

    // BIẾN CHỨA KẾT QUẢ TRẢ VỀ
	$message = "";
	
	// DUYỆT MẢNG LẤY KẾT QUẢ
	while ($row = mysql_fetch_array($result_pag_data)) {
		//  for ($i=0;$i<count($tintuc_khac) ;$i++) { 
		
		
		$message .= '
		
		<div class="item_trich trich'.$row['id'].'">
                  <img class="img_trich" width="100px" height="140px" src="'._upload_product.$row["photo"].'" />
                  <input type="text" id="stt_trich'.$row["id"].'" value="'.$row["stt"].'" onkeypress="return OnlyNumber(event)" class="tipS" onchange="'.$com_hasp.','.$row["id"].')" />
                  <a href="javascript:void(0)" class="change_stt" rel="'.$row["id"].'"><i class="fa fa-trash-o"></i></a>
                  <div id="loader'.$row["id"].'" class="loader_trich"><img src="images/loader.gif" /></div>
              </div>

 
			<div class="'.$bienthe.'"></div>
			
			';
			
	}

	// ĐƯA KẾT QUẢ VÀO PHƯƠNG THỨC LOAD() TRONG LỚP PAGING_AJAX
	$paging1->data = "<div class='data'>" . $message . "</div><div class='clear'></div>"; // Content for Data    
	
	echo $paging1->Load();  // KẾT QUẢ TRẢ VỀ
		
} 


?>

<script>




 $(document).ready(function(){

    // PHƯƠNG THỨC SHOW HÌNH LOADING
    function loading_show(){
        $('#loading_hasp').html("<img src='images/image-loading-animation.gif'/>").fadeIn('fast');
    }

    // PHƯƠNG THỨC ẨN HÌNH LOADING
    function loading_hide(){
        $('#loading_hasp').fadeOut('fast');
    }             

    // PHƯƠNG THỨC LOAD KẾT QUẢ 
    function loadData(page){
        loading_show();      
		
			<?php
	$id=@$_REQUEST['id'];
	
	?>
	var id=<?=$id?>;
		//var $id=<?=@$_REQUEST['id']?>;
		
        $.ajax
        ({
            type: "POST",
            url: "ajax/load_paging_hasp.php",
          //  data: "page="+page+"id="+id,
			data:'page='+page+'&id='+id,
            success: function(msg)
            {
                $("#container_loadhasp").ajaxComplete(function(event, request, settings)
                {
                    loading_hide();
                    $("#container_loadhasp").html(msg);
                });
            }
        });
    }

    // LOAD GIÁ TRỊ MẶC ĐỊNH PAGE = 1 CHO LẦN ĐẦU TIÊN
    loadData(1);  

    // LOAD KẾT QUẢ CHO TRANG
    $('#container_loadhasp .pagination li.active').live('click',function(){
        var page = $(this).attr('p');
        loadData(page);
    });           

    // PHƯƠNG THỨC DÙNG ĐỂ HIỆN KẾT QUẢ KHI NHẬP GIÁ TRỊ PAGE VÀO TEXTBOX
    // BẠN CÓ THỂ MỞ TEXTBOX LÊN TRONG CLASS PHÂN TRANG
    $('#go_btn').live('click',function(){
        var page = parseInt($('#goto').val());
        var no_of_pages = parseInt($('.total').attr('a'));
        if(page != 0 && page <= no_of_pages){
            loadData(page);
        }else{
            alert('HÃY NHẬP GIÁ TRỊ TỪ 1 ĐẾN '+no_of_pages);
            $('.goto').val("").focus();
            return false;
        }
    });
});




</script>

<script type="text/javascript">

    function updateStthinh(table,id) {
      var num = jQuery('#stt_trich'+id).val();
      $('#loader'+id).css('display', 'block');
      jQuery.ajax({
        type: 'POST',
        url: baseurl + 'ajax/stt_hap.php?act=update',
        data: {'table':table, 'id':id, 'num':num},
        success: function(data) {
          $('#loader'+id).css('display', 'block');
          jQuery('#stt_trich'+id).val(num);

        }
      });
    }
    $(document).ready(function() {
      $(".change_stt").click(function(event) {
          var r = confirm("Bạn có thực sự muốn xóa hình ảnh này ?");
          if (r == true) {
              var id=$(this).attr("rel");
              $('#loader'+id).css('display', 'block');
              jQuery.ajax({
                type: 'POST',
                url: baseurl + 'ajax/stt_hap.php?act=delete',
                data: {'table':'hasp', 'id':id},
                success: function(data) {
                  $('#loader'+id).css('display', 'none');
                  jQuery('.trich'+id).remove();
                }
              });
          } else {
              return false;
          }
          
      });
    });
//document.onload = setTimeout("updateStthinh(table,id)", 7000);

</script>




