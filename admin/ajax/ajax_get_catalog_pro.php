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
	$d = new database($config['database']);

	

	if (isset($_POST["level"])) {
		$level = $_POST["level"];

		 $table = $_POST["table"];
		 $id=$_POST["id"];
		$name_id=$_POST["name_id"];
		$name_id_child=$_POST["name_id_child"];
		 $type = $_POST["type"];
		 
		 
		 if($type!=0)
		switch ($level) {
			case '1':{
				$id_temp= "id_list";
				break;
			}
			case '2':{
				$id_temp= "id_parent";
				break;
			}
			case '3':{
				$id_temp= "id_parent";
				break;
			}
			default:
				echo 'error ajax'; exit();
				break;
		}
		else
		switch ($level) {
			case '1':{
				$id_temp= "id_list";
				break;
			}
			case '2':{
				$id_temp= "id_cat";
				break;
			}
			case '3':{
				$id_temp= "id_item";
				break;
			}
			default:
				echo 'error ajax'; exit();
				break;
		}
		 
		 
		$sql="select * from ".$table." where $name_id=".$id." ";
		if($type!='')
		{
			$sql.=" and com='video' ";
		}
		
		
		$sql.=" order by stt,$name_id_child desc ";
		
		
		if ($id!="")
		{
			if ($name_id=="id_list")
			{
				$where_search.=" and id_list='".$id."'  ";
			}
			
			if ($name_id=="id_cat")
			{
				$where_search.=" and id_cat='".$id."'  ";
			}
			
			
			if ($name_id=="id_item")
			{
				$where_search.=" and id_item='".$id."'  ";
			}
			
		}
		
			$d->reset();
			$sql_detail = "select id,ten_vi from #_news where hienthi=1 and com='video' $where_search  order by id desc";
			$d->query($sql_detail);
			$video_pro = $d->result_array();

		
		
	
		$stmt=mysql_query($sql);
			
		$str.='<div class="ui-widget">
	
		<select id="combobox">
			<option value="">Chọn Video áp dụng</option>';
		 for($i=0;$i<count($video_pro);$i++){
			$str.='<option value="'.$video_pro[$i]['id'].'">'.$video_pro[$i]['ten_vi'].'</option>';
		 } 
		$str.='</select><!--end combobox-->
  
		</div><!--end ui-widget-->';
		
		$str.='<button id="chonraovat_qc" type="button">Thêm Video: </button><br />';
			

		
		
	

		echo  $str;
		
		
		
		
		
			//$result = array('id' => $id, 'level' => $level);

		//	echo json_encode($result);
				
		
	}
	

?>


<script type="text/javascript">

	$(document).ready(function(e) {

        $('#chonraovat_qc').click(function(e) {
            var id_sp = $('#combobox').val();
			
		
			
			//alert(id_sp);
			var kt = 0;
			$('.load_raovatqc input').each(function(index, element) {
                var kiemtra = $(this).val();
				if(id_sp==kiemtra){
						alert('Video này đã có !');
						 kt = 1;
				}
            });
			if(kt==0){
				$.ajax ({
					type: "POST",
					url: "ajax/spapdung_kemtheo.php",
					data: 'id_sp='+id_sp,
					success: function(result) { 
						$('div#load_allmuakem').append(result);
					}
				});
			}
			
        });
    });	

  (function( $ ) {
    $.widget( "custom.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            tooltipClass: "ui-state-highlight"
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -1 )
          .attr( "title", "Show All Items" )
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox-toggle ui-corner-right" )
          .mousedown(function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .click(function() {
            input.focus();
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value

        this.input
          .val( "" )
          .attr( "title", value + " didn't match any item" )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.autocomplete( "instance" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
  })( jQuery );
 
  $(function() {
    $( "#combobox" ).combobox();
    $( "#toggle" ).click(function() {
      $( "#combobox" ).toggle();
    });
  });
</script>

  
<script type="text/javascript">
 
 $(document).ready(function() {

		$('.delete').click(function(e) {
			$(this).parent().remove();
		});
  });

  $(function() {
    var availableTags = [
	<?php for($i=1;$i<count($video_pro);$i++){?>
      "<?=$video_pro[$i]['ten_vi']?>",
	<?php } ?>
      "<?=$video_pro[0]['ten_vi']?>"
    ];
    $( "#raovat_kemqc" ).autocomplete({
      source: availableTags
    });
  });
</script>


