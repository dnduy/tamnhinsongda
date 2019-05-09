<style type="text/css">
.wrap_mbCreditCard label.error {
    clear: both;
}

.row_feild_tragop .left_row label.error {
    top: 65px;
}
</style>
<div class="pad10">


<div class="bold-title"><?=_thaydoithongtincanhan?></div><!--end bold-title-->

<div id="editIndividualForm">
 
    <form action="" class="form-horizontal" id="frm_infocanhan" method="post" enctype="multipart/form-data">    
        <div class="frm-info-user wrap-login-check" style="padding: 0px;">

            <div class="login-row">
                <div class="login-t-label">Email:</div>
                <div class="login-t-input" style="vertical-align: bottom;">
                    <input type="hidden" name="email_taikhoan" type="text" value="<?=$item_user['email']?>">
                    <b><?=$item_user['email']?></b>
                </div>
            </div>

            <div class="login-row">
                <div class="login-t-label"><?=_cachxungho?>:</div>
                <div class="login-t-input" style="vertical-align: bottom;">
                    <div style="position: relative; float: left; margin-right: 15px;">
                     <input type="radio" name="salutation" value="0" <?php if($item_user['salutation']=='0'){ echo "checked='checked'";}?> id="rdo1" />
                      <label for="rdo1"><?=_ong?></label>
                    </div>
                     
                    <div style="position: relative; float: left; margin-right: 15px;">
                      <input type="radio" name="salutation" value="1" <?php if($item_user['salutation']=='1'){ echo "checked='checked'";}?> id="rdo2" />
                      <label for="rdo2"><?=_ba?></label>
                    </div> 
                    
                    <div style="position: relative; float: left; margin-right: 15px;">
                         <input type="radio" name="salutation" value="2" <?php if($item_user['salutation']=='2'){ echo "checked='checked'";}?> id="rdo3" />
                        <label for="rdo3"><?=_co?></label>
                    </div>
                </div>
            </div>


            <div class="login-row">
                <div class="login-t-label"><?=_hoten?>:</div>
                <div class="login-t-input">
                    <input type="text" name="name" placeholder="<?=_hovaten?>" value="<?=$item_user['hoten']?>" class="form-control txt_field" required>
                </div>
            </div>

            <!-- <div class="login-row">
                <div class="login-t-label"><?=_diachi?>:</div>
                <div class="login-t-input">
                    <textarea name="diachi" placeholder="<?=_diachi?>" class="form-control txt_field are_addr" row="4" required><?=$item_user['diachi']?></textarea>
                </div>
            </div> -->

            <div class="login-row">
                <div class="login-t-label"><?=_ngaysinh?>:</div>
                <div class="login-t-input">
                    <input name="ngaysinh" type="text" value="<?=($item_user['ngaysinh']!='')? date("d-m-Y",$item_user['ngaysinh']):''?>" id="ngaysinh" class="datetimepicker form-control txt_field are_addr" >
                </div>
            </div>

            <div class="login-row">
                <div class="login-t-label"><?=_gioitinh?>:</div>
                <div class="login-t-input" style="vertical-align: bottom;">
                    <div style="position: relative; float: left; margin-right: 15px;">
                        <input type="radio" name="gender" value="0" <?php if($item_user['sex']=='0'){ echo "checked='checked'";}?> id="rdo_sex_1" />
                        <label for="rdo_sex_1"><?=_sexnu?></label>  
                    </div>
                    
                    <div style="position: relative; float: left; margin-right: 15px;">                                
                        <input type="radio" name="gender" value="1" <?php if($item_user['sex']=='1'){ echo "checked='checked'";}?> id="rdo_sex_2" />
                        <label for="rdo_sex_2"><?=_sexnam?></label>
                    </div>

                    <div style="position: relative; float: left; margin-right: 15px;">
                        <input type="radio" name="gender" value="2" <?php if($item_user['sex']=='2'){ echo "checked='checked'";}?>  id="rdo_sex_3" />
                        <label for="rdo_sex_3"><?=_sexkhac?></label>
                    </div>
                </div>
            </div>

            <div class="login-row">
                <div class="login-t-label" style="padding-top: 20px;"><?=_sodienthoai?>:</div>
                <div class="login-t-input">
                    <input style="margin-top:11px;" type="text" name="dienthoai" value="<?=$item_user['dienthoai']?>" placeholder="<?=_sodienthoai?>" class="form-control txt_field" required>
                </div>
            </div>

            <div class="login-row">
                <div class="login-t-label"></div>
                <div class="login-t-input">
                    <input type="submit" value="<?=_luu?>" name="sub_info" class="button-blue">
                </div>
            </div>
        </div>
   </form>     

  

    </div><!--end editIndividualForm-->

</div><!--END pad10-->

<script type="text/javascript">
    $(document).ready(function () {
        
        $("#ngaysinh").datepicker({
            dateFormat: "dd-mm-yy",
            changeMonth: true,
            changeYear: true,                                       
            yearRange: "1900:now"
        });

        String.prototype.toCardFormat = function () {
            return this.replace(/[^0-9]/g, "").substr(0, 16).split("").reduce(cardFormat, "");
            function cardFormat(str, l, i) {
                return str + ((!i || (i % 4)) ? "" : " ") + l;
            }
        };
            
        $("#txt_sothe").keyup(function () {
            $(this).val($(this).val().toCardFormat());
        });
        
        
       var JQUERY4U = {};
       var JQUERY4U2 = {};

        JQUERY4U.UTIL =
        {
            setupFormValidation: function()
            {
                //form validation rules
                $("#frm_infocanhan").validate({
                    rules: {
                        salutation: "required",
                        name: "required",
                        diachi: "required",
                        ngaysinh: "required",
                        gender: "required",
                        dienthoai: {
                            required: true,
                            number: true
                        },
                       
                    },
                    messages: {
                        salutation: "Vui lòng chọn cách xưng hô",
                        name: "<?=_nameError?>",
                        diachi: "<?=_vulongnhapdiachi?>",
                        ngaysinh: "<?=_xinchonngaysinh?>",
                        gender: "<?=_xinchongioitinh?>",
                        dienthoai: {
                            required: "<?=_vulongnhapdienthoai?>",
                            number: "<?=_vulongnhapso?>"
                        },
                        
                    },
                    submitHandler: function(form) {
                        form.submit();
                    }
                });
            }
        }


        JQUERY4U2.UTIL =
        {
            setupFormValidation: function()
            {
                //form validation rules
                $("#frm_dkaff").validate({
                    rules: {
                        tenthe: "required",
                        sothe: {
                            required: true,
                            // number: true
                        },
                        exp_month: {
                            required: true,
                            number: true,
                            min: 1,
                            max: 12
                        },
                        exp_year: {
                            required: true,
                            number: true,
                            min: 1,
                        },
                        ccv: {
                            required: true,
                            number: true,
                            minlength: 2
                        }
                    },
                    messages: {
                        tenthe: "<?=_errtenthe?>",
                        sothe: {
                            required: "<?=_errsothe?>",
                            // number: "<?=_vulongnhapso?>",
                            minlength: "<?=_errkytusothe?>"
                        },
                        exp_month: {
                            required: "<?=_errngayhethan?>",
                            number: "<?=_vulongnhapso?>",
                            min: "<?=_errmonth?>",
                            max: "<?=_errmonth?>"
                        },
                        exp_year: {
                            required: "<?=_errngayhethan?>",
                            number: "<?=_vulongnhapso?>",
                            min: "<?=_erryear?>",
                        },
                        ccv: {
                            required: "<?=_errcvv?>",
                            number: "<?=_vulongnhapso?>",
                            minlength: "<?=_errkytucvv?>"
                        }
                    },
                    submitHandler: function(form) {
                        form.submit();
                    }
                });
            }
        }

        //when the dom has loaded setup form validation rules
        $().ready(function($) {
            JQUERY4U.UTIL.setupFormValidation();
            JQUERY4U2.UTIL.setupFormValidation();
        });
        
    });   
</script>