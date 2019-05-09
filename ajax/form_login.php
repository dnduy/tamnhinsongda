<?php
	error_reporting(0);
	session_start();
	$session=session_id();
	
	@define ( '_template' , '../templates/');
	@define ( '_source' , '../sources/');
	@define ( '_lib' , '../libraries/');
	
	
	@define ( '_facebookapi' , '../facebook-api/');
	@define ( '_googleapi' , '../google-api/');	
	@define ( _upload_folder , '../media/upload/' );
	
	//Lưu ngôn ngữ chọn vào $_SESSION
	$lang_arr=array("vi","en","ge");
	if (isset($_GET['lang']) == true){
        if (in_array($_GET['lang'], $lang_arr)==true){
            $lang = $_GET['lang'];
            $_SESSION['lang']=$lang;
		  header('Location: '.$_SERVER['HTTP_REFERER']);
        } 
	}
    if(isset($_SESSION['lang'])){
        $lang= $_SESSION['lang'];
    }else{
        $lang="vi";
    }
	require_once _source."lang_$lang.php";	

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	
	include_once _lib."library.php";
	include_once _lib."class.database.php";	
	
	include_once _lib."file_requick.php";
	$d = new database($config['database']);
	
	
	
	
	if($config_url=='timnhanhonline.vn'){
		
		require_once _googleapi."src/Google_Client.php";		
		require_once _googleapi."src/contrib/Google_Oauth2Service.php";
		$client = new Google_Client();
		$client->setApplicationName("timnhanhonline");	
		$client->setClientId('504877112445-krr0vb25kakgmblcvfjcl21ed4400id4.apps.googleusercontent.com');
		$client->setClientSecret('sPHFND4QELmvNURv5yL-hJX4');
		$client->setRedirectUri('http://'.$config_url.'/login-google.php');
		$client->setDeveloperKey('AIzaSyBJLo5lhs-JZ0cDACeOs05OXMvx85pwolE');
		//print_r($client);
		//die();

	} else {
		require_once _googleapi."src/Google_Client.php";
		require_once _googleapi."src/contrib/Google_Oauth2Service.php";
		$client = new Google_Client();
		$client->setApplicationName("timnhanhonlinevn");	
		$client->setClientId('733202004590-8tr3v99omsmm83tvrvnai462bgsu6ihj.apps.googleusercontent.com');
		$client->setClientSecret('m9QysVhUl9YG_U51VcH15-tB');
		$client->setRedirectUri('http://'.$config_url.'/login-google.php');
		$client->setDeveloperKey('AIzaSyAtAchYd2CESZRWzQETbz_OR9vk23-w0zE');
	}
	
	
    $oauth2 = new Google_Oauth2Service($client);
    $authUrl = $client->createAuthUrl();
      
    require _facebookapi."facebook.php";
    // Create our Application instance (replace this with your appId and secret).
	$facebook = new Facebook(array(
		  'appId'  => '1095596903818969',
		  'secret' => 'b21368740e8e717c57d72fc9b86a2630',
		  'redirect_uri' => 'http://'.$config_url.'/login-facebook.php',
		));
	
	
?>



<div class="dangnhap" id="validate-login">
    <div class="tit">Đăng nhập</div>
<form action="#" name="dangnhap_from" class="form-horizontal" id="dangnhap_from" method="post">        
	
    <div class="row">
            <label class="padd-form control-label" for="emailtk">Email đăng nhập (*)</label>
           <input class="bxhInputValidate bxhInputValidateRequired" data-val="true"  id="emailtk" name="emailtk" type="text" value="">
        </div>
        <div class="row">
            <label>Mật khẩu (*)</label>
            <input class="bxhInputValidate bxhInputValidateRequired" data-val="true" data-val-required="The Mật khẩu field is required." id="pass" name="pass" type="password" validatemessage="Mật khẩu">
        </div>
        <div class="row">
            <label>&nbsp;</label>
            <input data-val="true" data-val-required="The Lưu mật khẩu? field is required." id="RememberMe" name="RememberMe" type="checkbox" value="true">
            <input name="RememberMe" type="hidden" value="false">
            <label class="lbcheck" for="RememberMe">Ghi nhớ mật khẩu</label>
            <input type="submit" class="btndangnhap bxhvalidatesumit" value="Đăng nhập" id="send_login">
            
            
        </div>
</form>    <br>
    
    
    <div class="openid">
        <section class="social" id="socialLoginForm">
            <h2>Đăng nhập bằng</h2>
            


                <div class="line">
                
                 <a href="<?=$facebook->getLoginUrl(array( 'scope' => 'email'))?>"><img src="images/facebook.png" alt="" /></a>
                
                </div>
              
                <div class="line">
           <a href="<?=$authUrl?>" class="google_login"><img src="images/google.png" alt="" /></a>
         
                </div>
                

        </section>
    </div><!--end openid-->
    
    <div class="row">
        <a class="lostpass" href="quen-mat-khau.html">Bạn quên mật khẩu?</a>
    </div>
</div><!--end validate-login-->


<script type="text/javascript">
$(document).ready(function() { 
	 $('#send_login').click(function() {  

			/// email validation
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			var phone_regex=/^0([0-9]{9,10})$/;
			var emailaddressVal = $("#emailtk").val();
			var code= $('#code').val();
			
			if(emailaddressVal == '') {
				$("#email_error").html('');
				$("#emailtk").after('<div class="error" id="email_error"><b class=images_error>Xin vui lòng nhập email.</b></div>');
				$("#emailtk").focus();
				return false
			}
			else if(!emailReg.test(emailaddressVal)) {
				$("#email_error").html('');
				$("#emailtk").after('<div class="error" id="email_error"><b class=images_error>Email không đúng định dạng.</b></div>');
				$("#emailtk").focus();
				return false
			 
			}
			else{
				$("#email_error").html('');
			}
		
			
			// pass validation
			var passVal = $("#pass").val();
			if(passVal == '') {
				$("#pass_error").html('');
				$("#pass").after('<div class="error" id="pass_error"><b class=images_error>Xin nhập mật khẩu.</b></div>');
				$("#pass").focus();
				return false
			}
			else{
				$("#pass_error").html('');
			}
			
			
			$.ajax({
				url:"ajax/login.php",
				type:"POST",
				data:{email:emailaddressVal, pass:passVal},
				async:true,
				dataType:"text",
				success:function(response){
					if(response==1){// thanh cong
						$("#after_submit").html('');
						$("#send_login").after(function() {
                            $(".customNotify").jmNotify({
								html: 'Đăng nhập thành công !',
								delay:1000,
								onClose:redirect()
								
							});	
                        });
						
					}
					else{
						$("#after_submit").html('');
						$("#send_login").after(function() {
                            $(".customNotify").jmNotify({
								html: 'Lỗi ! Thông tin tài khoản không chính xác !'
							});	
                        });
						
						clear_form();
					}
				}
			})
		return false;
	 });
	 function clear_form(){
		$("#emailtk").val('');
		$("#pass").val('');
	 }
	  function redirect(){
		window.setTimeout(function () {
			<?php
				if(isset($_SESSION['duongdandangnhap']) && $_SESSION['duongdandangnhap']!=""){ ?>
				location.href = "<?=$_SESSION['duongdandangnhap']?>";
			<?php	}else{ ?>
			
				location.href = "index.html";
			<?php } ?>
		}, 1000)
	 }
});
	
</script>

