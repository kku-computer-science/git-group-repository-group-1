<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="img/Newlogo.png" rel="shortcut icon" type="image/x-icon" />
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->

	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
	<style>
		html {
			width: 100%;
			height: 100%;
		}

		body {
			background: linear-gradient(45deg, rgba(66, 183, 245, 0.8) 0%, rgba(66, 245, 189, 0.4) 100%);
			color: rgba(0, 0, 0, 0.6);
			font-family: "Roboto", sans-serif;
			font-size: 14px;
			line-height: 1.6em;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
		}

		.overlay,
		.form-panel.one:before {
			position: absolute;
			top: 0;
			left: 0;
			display: none;
			background: rgba(0, 0, 0, 0.8);
			width: 100%;
			height: 100%;
		}

		.form {
			z-index: 15;
			position: relative;
			background: #ffffff;
			width: 600px;
			border-radius: 4px;
			box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
			box-sizing: border-box;
			margin: 100px auto 10px;
			overflow: hidden;
		}

		.form-toggle {
			z-index: 10;
			position: absolute;
			top: 60px;
			right: 60px;
			background: #ffffff;
			width: 60px;
			height: 60px;
			border-radius: 100%;
			transform-origin: center;
			transform: translate(0, -25%) scale(0);
			opacity: 0;
			cursor: pointer;
			transition: all 0.3s ease;
		}

		.form-toggle:before,
		.form-toggle:after {
			content: "";
			display: block;
			position: absolute;
			top: 50%;
			left: 50%;
			width: 30px;
			height: 4px;
			background: #4285f4;
			transform: translate(-50%, -50%);
		}

		.form-toggle:before {
			transform: translate(-50%, -50%) rotate(45deg);
		}

		.form-toggle:after {
			transform: translate(-50%, -50%) rotate(-45deg);
		}

		.form-toggle.visible {
			transform: translate(0, -25%) scale(1);
			opacity: 1;
		}

		.form-group {
			display: flex;
			flex-wrap: wrap;
			justify-content: space-between;
			margin: 0 0 20px;
		}

		.form-group:last-child {
			margin: 0;
		}

		.form-group label {
			display: block;
			margin: 0 0 10px;
			color: rgba(0, 0, 0, 0.6);
			font-size: 12px;
			font-weight: 500;
			line-height: 1;
			text-transform: uppercase;
			letter-spacing: 0.2em;
		}

		.two .form-group label {
			color: #ffffff;
		}

		.form-group input {
			outline: none;
			display: block;
			background: rgba(0, 0, 0, 0.1);
			width: 100%;
			border: 0;
			border-radius: 4px;
			box-sizing: border-box;
			padding: 12px 20px;
			color: rgba(0, 0, 0, 0.6);
			font-family: inherit;
			font-size: inherit;
			font-weight: 500;
			line-height: inherit;
			transition: 0.3s ease;
		}

		.form-group input:focus {
			color: rgba(0, 0, 0, 0.8);
		}

		.two .form-group input {
			color: #ffffff;
		}

		.two .form-group input:focus {
			color: #ffffff;
		}

		.form-group button {
			outline: none;
			background: #4285f4;
			width: 100%;
			border: 0;
			border-radius: 4px;
			padding: 12px 20px;
			color: #ffffff;
			font-family: inherit;
			font-size: inherit;
			font-weight: 500;
			line-height: inherit;
			text-transform: uppercase;
			cursor: pointer;
		}

		.two .form-group button {
			background: #ffffff;
			color: #4285f4;
		}

		.form-group .form-remember {
			font-size: 12px;
			font-weight: 400;
			letter-spacing: 0;
			text-transform: none;
		}

		.form-group .form-remember input[type=checkbox] {
			display: inline-block;
			width: auto;
			margin: 0 10px 0 0;
		}

		.form-group .form-recovery {
			color: #4285f4;
			font-size: 12px;
			text-decoration: none;
		}

		.form-panel {
			padding: 60px calc(5% + 60px) 60px 60px;
			box-sizing: border-box;
		}

		.form-panel.one:before {
			content: "";
			display: block;
			opacity: 0;
			visibility: hidden;
			transition: 0.3s ease;
		}

		.form-panel.one.hidden:before {
			display: block;
			opacity: 1;
			visibility: visible;
		}

		.form-panel.two {
			z-index: 5;
			position: absolute;
			top: 0;
			left: 95%;
			background: #4285f4;
			width: 100%;
			min-height: 100%;
			padding: 60px calc(10% + 60px) 60px 60px;
			transition: 0.3s ease;
			cursor: pointer;
		}

		.form-panel.two:before,
		.form-panel.two:after {
			content: "";
			display: block;
			position: absolute;
			top: 60px;
			left: 1.5%;
			background: rgba(255, 255, 255, 0.2);
			height: 30px;
			width: 2px;
			transition: 0.3s ease;
		}

		.form-panel.two:after {
			left: 3%;
		}

		.form-panel.two:hover {
			left: 93%;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
		}

		.form-panel.two:hover:before,
		.form-panel.two:hover:after {
			opacity: 0;
		}

		.form-panel.two.active {
			left: 10%;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
			cursor: default;
		}

		.form-panel.two.active:before,
		.form-panel.two.active:after {
			opacity: 0;
		}

		.form-header {
			margin: 0 0 40px;
		}

		.form-header h1 {
			padding: 4px 0;
			color: #4285f4;
			font-size: 24px;
			font-weight: 700;
			text-transform: uppercase;
		}

		.two .form-header h1 {
			position: relative;
			z-index: 40;
			color: #ffffff;
		}

		.pen-footer {
			display: flex;
			flex-direction: row;
			justify-content: space-between;
			width: 600px;
			margin: 20px auto 100px;
		}

		.pen-footer a {
			color: #ffffff;
			font-size: 12px;
			text-decoration: none;
			text-shadow: 1px 2px 0 rgba(0, 0, 0, 0.1);
		}

		.pen-footer a .material-icons {
			width: 12px;
			margin: 0 5px;
			vertical-align: middle;
			font-size: 12px;
		}

		.cp-fab {
			background: #ffffff !important;
			color: #4285f4 !important;
		}

		ul li {
			color: red;
			list-style: square;
			padding: 0;
			margin-left: 0px;
			font-size: 12px;
		}
	</style>
</head>

<body>

	<!-- <div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-100">
				<form method="POST" class="login100-form validate-form" autocomplete="off" action="{{ route('login') }}">
					@csrf
					<span class="login100-form-title p-b-55">
						Login
					</span>
					@if($errors->any())
					<div class="alert alert-danger alert-block ">
						<button type="button" class="close" data-dismiss="alert"></button>
						<strong><a>{{$errors->first()}}</a></strong>
					</div>
					@endif
					<div class="wrap-input100 validate-input m-b-16" data-validate="Valid email is required: ex@abc.xyz">

						<input id="email" class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-envelope"></span>
						</span>

					</div>

					<div class="wrap-input100 validate-input m-b-16" data-validate="Password is required">
						<input id="password" class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-lock"></span>
						</span>

					</div>

					<div class="contact100-form-checkbox m-l-4">
						<input  class="input-checkbox100" id="ckb1" type="checkbox" name="remember">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>

					<div class="container-login100-form-btn p-t-30">
						<button class="login100-form-btn">
							Login
						</button>
					</div>


				</form>
			</div>
		</div>
	</div> -->

	<div class="form">
		<div class="form-toggle"></div>
		<div class="form-panel one">
			<div class="form-header">
				<h1>Account Login</h1>
			</div>
			<div class="form-content">
				<form method="POST" class="validate-form" autocomplete="off" action="{{ route('login') }}">
					@csrf
					@if($errors->any())
					<div class=" alert alert-danger alert-block ">
						<button type=" button" class="close" data-dismiss="alert"></button>
						<strong><a>{{$errors->first()}}</a></strong>
					</div>
					@endif
					<!-- <div class="form-group validate-input" data-validate="Valid email is required: ex@abc.xyz"> -->
					<div class="form-group validate-input">
						<label for="email">Username</label>
						<input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autofocus>
						@error('username')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="form-group validate-input" data-validate="Password is required">
						<label for="password">Password</label>
						<input id="password" class="input" type="password" name="password" required="required" />
					</div>
					<div class="form-group">
						<label class="form-remember">
							<input id="ckb1" name="remember" type="checkbox" />Remember Me
						</label>
					</div>
					<div class="form-group">
						<button type="submit">Log In</button>
					</div>
					<div class="form-remember pb-3">
							<p style="color: red; text-align: right;"> *** หากลืมรหัสผ่าน ให้ติดต่อผู้ดูแลระบบ</p>
					</div>
					<ul>
						<li>สำหรับ Username ใช้ KKU-Mail ในการเข้าสู่ระบบ</li>
						<li>สำหรับนักศึกษาที่เข้าระบบเป็นครั้งแรกให้เข้าสู่ระด้วยรหัสนักศึกษา</li>
					</ul>
				</form>
			</div>
		</div>


	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script>
		(function($) {
			"use strict";


			/*==================================================================
			[ Validate ]*/
			var input = $('.validate-input .input');

			$('.validate-form').on('submit', function() {

				var check = true;

				for (var i = 0; i < input.length; i++) {
					if (validate(input[i]) == false) {
						showValidate(input[i]);
						check = false;
					}
				}

				return check;
			});


			$('.validate-form .input').each(function() {
				$(this).focus(function() {
					hideValidate(this);
				});
			});

			function validate(input) {

				if ($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
					if ($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
						return false;
					}
				} else {
					if ($(input).val().trim() == '') {
						return false;
					}
				}
			}

			function showValidate(input) {
				var thisAlert = $(input).parent();

				$(thisAlert).addClass('alert-validate');
			}

			function hideValidate(input) {
				var thisAlert = $(input).parent();

				$(thisAlert).removeClass('alert-validate');
			}



		})(jQuery);
	</script>
</body>

</html>