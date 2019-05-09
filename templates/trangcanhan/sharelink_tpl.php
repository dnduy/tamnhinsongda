<div class="pad10">

	<div class="bold-title"><?=_sharelinkhoahong?></div><!--end bold-title-->

	<div class="">
		<div class="ui-widget">

			<!-- <link rel="stylesheet" href="css/chosen.css">
			<script src="js/chosen.jquery.js" type="text/javascript"></script> -->
			<script type="text/javascript">
				$(document).ready(function(){

					// $(".sel_option_share").chosen();

					$("#sel_dm1").change(function(){
						$id_list = $(this).val();
						$.ajax({
							url: 'ajax/ajax_get_pro.php',
							type: 'post',
							data: {id_list:$id_list},
							success: function(data){
								$("#sele_name_pro").html(data);
							}
						});
						$("#link_share").text('');
					})

					
				})
			</script>

			<select class="sel_option_share" id="sel_dm1">
				<?php 
					$d->reset();
					$sql = "select id,ten_$lang from #_product_list where hienthi=1 order by stt,id desc";
					$d->query($sql);
					$arr_list = $d->result_array();
					if(!empty($arr_list)){
				?>
			        	<option value=""><?=_chondanhmuc?></option>
				        <?php foreach($arr_list as $splist){?>
				        	<option value="<?=$splist['id']?>"><?=$splist['ten_'.$lang]?></option>
				        <?php } ?>
		        <?php } ?>
			</select>

			
		    <select id="sele_name_pro" class="sel_option_share">
		    	<option value=""><?=_chonsp?></option>
		    </select>

		    <div class="clear"></div>

		    <textarea id="link_share" readonly></textarea>

		    <div class="clear"></div>
		    <button id="btn_copylink" style="background: #e2ae00; color: #fff; border: none; padding: 4px 10px;">Select Link & Copy</button>

		    <script type="text/javascript">
		    	$().ready(function(){
		    		$("#btn_copylink").click(function() {
					    var $this = $("#link_share");

					    $this.focus();
					    $this.select();

					    // Work around WebKit's little problem
					    function mouseUpHandler() {
					        // Prevent further mouseup intervention
					        $this.off("mouseup", mouseUpHandler);
					        return false;
					    }

					    $this.mouseup(mouseUpHandler);
					    
					});

					$('#link_share').focus(function() {
					    $this = $(this);
					    
					    $this.select();
					    
					    window.setTimeout(function() {
					        $this.select();
					    }, 1);

					    $val_link = $("#txt_ios").val();

					    // Work around WebKit's little problem
					    $this.mouseup(function() {
					        // Prevent further mouseup intervention
					        $this.unbind("mouseup");
					        return false;
					    });
					});


		    	})
		    </script>

		    <script type="text/javascript">
		    	document.getElementById("btn_copylink").addEventListener("click", function() {
				    copyToClipboard(document.getElementById("link_share"));
				});

				function copyToClipboard(elem) {
					  // create hidden text element, if it doesn't already exist
				    var targetId = "_hiddenCopyText_";
				    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
				    var origSelectionStart, origSelectionEnd;
				    if (isInput) {
				        // can just use the original source element for the selection and copy
				        target = elem;
				        origSelectionStart = elem.selectionStart;
				        origSelectionEnd = elem.selectionEnd;
				    } else {
				        // must use a temporary form element for the selection and copy
				        target = document.getElementById(targetId);
				        if (!target) {
				            var target = document.createElement("textarea");
				            target.style.position = "absolute";
				            target.style.left = "-9999px";
				            target.style.top = "0";
				            target.id = targetId;
				            document.body.appendChild(target);
				        }
				        target.textContent = elem.textContent;
				    }
				    // select the content
				    var currentFocus = document.activeElement;
				    target.focus();
				    target.setSelectionRange(0, target.value.length);
				    
				    // copy the selection
				    var succeed;
				    try {
				    	  succeed = document.execCommand("copy");
				    } catch(e) {
				        succeed = false;
				    }
				    // restore original focus
				    if (currentFocus && typeof currentFocus.focus === "function") {
				        currentFocus.focus();
				    }
				    
				    if (isInput) {
				        // restore prior selection
				        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
				    } else {
				        // clear temporary content
				        target.textContent = "";
				    }
				    return succeed;
				}
		    </script>
		</div>
	</div>


</div><!--END pad10-->
