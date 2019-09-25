<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V6</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="<?=base_url()?>_template/login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>_template/login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>_template/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>_template/login/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>_template/login/vendor/animate/animate.css">
  <link rel="stylesheet" href="<?=base_url()?>_template/front/vendors/jquery-toast-plugin/jquery.toast.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>_template/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>_template/login/css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100  p-b-20">
				<form class="login100-form " autocomplete="off" id="form" action="<?=$action?>">
					<span class="login100-form-title p-b-10">
						IDEA PAPER
					</span>
					<!-- <span class="login100-form-avatar">
						<img src="<?=base_url()?>_template/login/images/avatar-01.jpg" alt="AVATAR">
					</span> -->

					<div class="wrap-input100 m-t-45 m-b-35" data-validate = "Enter username">
						<input class="input100" type="text" name="username">
						<span class="focus-input100" data-placeholder="Username"></span>

					</div>

					<div class="wrap-input100 m-b-50" data-validate="Enter password">
						<input class="input100 password" type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>

					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" id="submit">
							SIGN IN
						</button>
					</div>

					<div class="text-center">
						<div id="username"></div>
						<div id="password"></div>
					</div>

					<ul class="p-t-10 text-center" style="list-style-type:none;">
						<li class="m-b-8">
							<span class="txt1">
								Forgot
							</span>

							<a href="#" class="txt2">
								Username / Password?
							</a>
						</li>

						<li>
							<span class="txt1">
								Don’t have an account?
							</span>

							<a href="<?=site_url("signup")?>" class="txt2">
								Sign up
							</a>
						</li>
					</ul>
				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="<?=base_url()?>_template/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>_template/login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>_template/login/vendor/bootstrap/js/popper.js"></script>
	<script src="<?=base_url()?>_template/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="<?=base_url()?>_template/front/vendors/jquery-toast-plugin/jquery.toast.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>_template/login/js/main.js"></script>


  <script type="text/javascript">
    $("#form").submit(function(e){
      e.preventDefault();
      var me = $(this);
      $('#submit').prop('disabled', true)
                   .html('<i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading...');
      $.ajax({
        url      : me.attr('action'),
        type     : 'POST',
        data     :me.serialize(),
        dataType : 'JSON',
        success:function(json){
         if (json.success==true) {
           if (json.valid==true) {
             window.location.href = json.url;
           }else {
             $(".password").val('');
             $('#submit').prop('disabled', false).text('SIGN IN');
             $.toast({
               // heading: 'Gagal Login',
               text: json.alert,
               showHideTransition: 'slide',
               icon: 'error',
               loaderBg: '#3e3e3e',
               position: 'top-center'
             });
           }
         }else {
           $.each(json.alert, function(key, value) {
             var element = $('#' + key);
             $('#submit').prop('disabled', false).text('SIGN IN');
             $(element).find('.text-danger').remove();
             $(element).hide().fadeIn(500).html(value);
           });
         }
       }
      });
    })
  </script>

</body>
</html>
