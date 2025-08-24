<!doctype html>
<html class="no-js" lang="">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Yaraelectronics-ERP-Register</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{asset('login/css/bootstrap.min.css')}}">
	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="{{asset('login/css/fontawesome-all.min.css')}}">
	<!-- Flaticon CSS -->
	<link rel="stylesheet" href="{{asset('login/font/flaticon.css')}}">

	<link rel="stylesheet" href="{{asset('login/css/style.css')}}">
</head>

<body>

    <div id="preloader" class="preloader">
        <div class='inner'>
            <div class='line1'></div>
            <div class='line2'></div>
            <div class='line3'></div>
        </div>
    </div>
	<section class="fxt-template-animation fxt-template-layout2">
		<div class="container">
			<div class="row">

				<div class="col-lg-6 col-12 fxt-none-991 fxt-bg-img" style="margin-top:200px" >
					<img src="{{asset('login/img/login1.jpg')}}">
				</div>
				<div class="col-lg-6 col-12 fxt-bg-color">
					<div class="fxt-content">
						<div class="fxt-header">
							<a href="#" class="fxt-logo"><img src="{{asset('login/img/logo.png')}}" style="max-width: 50%;" alt="Logo"></a>
						
							<div class="fxt-style-line">
								<h3 style="color:#056c91;font-weight: bold;">WELCOME <span style="color:black">BACK</span></h3> 
							</div>
						</div>
						<div class="fxt-form">
							<form method="POST" action="../index.php">
								<div class="form-group">
									<div class="fxt-transformY-50 fxt-transition-delay-1">
										<input type="email" class="form-control" name="email" placeholder="Email Address" required="required">
									</div>
								</div>
								<div class="form-group">
									<div class="fxt-transformY-50 fxt-transition-delay-2">
										<input type="password" class="form-control" name="password" placeholder="Password" required="required">
									</div>
								</div>
								<div class="form-group">
									<div class="fxt-transformY-50 fxt-transition-delay-3">
										<div class="fxt-checkbox-area">
											<div class="checkbox">
												<input id="checkbox1" type="checkbox">
												<label for="checkbox1">Keep me logged in</label>
											</div>
											<a href="#" class="switcher-text">Forgot Password</a>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="fxt-transformY-50 fxt-transition-delay-4">
										<button type="submit" class="fxt-btn-fill">Register</button>
									</div>
								</div>
							</form>
						</div>
						<div class="fxt-footer">
							<div class="fxt-transformY-50 fxt-transition-delay-5">
								<p>Already have an account?<a href="{{url('/')}}" class="switcher-text2 inline-text">Login</a></p>
							</div>
						</div>

								<!-- <div class="fxt-header">

										<div class="fxt-style-line">
								<h2>OR USING</h2> 
							</div>
						
						<ul class="fxt-socials">
								<li class="fxt-google"><a href="#" title="google"><i class="fab fa-google"></i><span>Google </span></a></li>
								<li class="fxt-twitter"><a href="#" title="twitter"><i class="fab fa-twitter"></i><span>Twitter</span></a></li>
								<li class="fxt-facebook"><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i><span>Facebook</span></a></li>
							</ul>  -->
						
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</section>
	<script src="{{asset('login/js/jquery-3.5.0.min.js')}}"></script>
    

	<script src="{{asset('login/js/bootstrap.min.js')}}"></script>


	<script src="{{asset('login/js/imagesloaded.pkgd.min.js')}}"></script>
	
	<script src="{{asset('login/js/validator.min.js')}}"></script>

	<script src="{{asset('login/js/main.js')}}"></script>

</body>

</html>