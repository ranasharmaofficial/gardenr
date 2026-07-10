<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-vertical-style="overlay" data-theme-mode="light" data-header-styles="light" data-menu-styles="light" data-toggled="close">

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Sign In | {{ env('APP_NAME') }}</title>
    <meta name="Description" content="Sign In | {{ env('APP_NAME') }}">
    <meta name="Author" content="Sign In | {{ env('APP_NAME') }}">
	<meta name="keywords" content="Sign In | {{ env('APP_NAME') }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ static_asset('assets/assets_admin/images/brand-logos/fav.ico')}}" type="image/x-icon">

    <!-- Main Theme Js -->
    <script src="{{ static_asset('assets/assets_admin/js/authentication-main.js')}}"></script>

    <!-- Bootstrap Css -->
    <link id="style" href="{{ static_asset('assets/assets_admin/libs/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" >

    <!-- Style Css -->
    <link href="{{ static_asset('assets/assets_admin/css/styles.min.css')}}" rel="stylesheet" >

    <!-- Icons Css -->
    <link href="{{ static_asset('assets/assets_admin/css/icons.min.css')}}" rel="stylesheet" >


</head>

<body class="main-body login-page">

    <!-- Page -->
	<div class="page">
		<!-- main-signin-wrapper -->
		<div class="my-auto page page-h">
			<div class="main-signin-wrapper">
				<div class="main-card-signin d-md-flex wd-100p">
					<div class="wd-md-50p login d-none d-md-block page-signin-style p-5 text-white">
						<div class="my-auto authentication-pages">
							<div>
								<a href="{{ url('') }}">
								<img style="height:60px;" src="{{ static_asset('assets/assets_admin/images/brand-logos/desktop-dark.png')}}" class=" m-0 mb-4" alt="logo"></a>
								{{-- {{-- <h5 class="mb-4 text-fixed-white">Responsive Modern Dashboard &amp; Admin Template</h5>
								<a href="{{ url('') }}" target="_blank" class="btn btn-success">Learn More</a> --}}
							</div>
						</div>
					</div>
					<div class="p-5 wd-md-50p bg-white">
						<div class="main-signin-header">
							<h2>Welcome back!</h2>
							<h4>Please sign in to continue</h4>
                            <div class="flash-message">
                                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                    @if (Session::has('alert-' . $msg))
                                        <div class="alert alert-{{ $msg }} alert-dismissible fade show" role="alert">
                                            {{ Session::get('alert-' . $msg) }}
                                            <button type="button" class="btn btn-info btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <form method="post" action="{{ route('adminAuthLogin') }}" enctype="multipart/form-data">
                                    @csrf
                                <div class="form-group">
									<label class="text-muted mb-1">Username</label>
                                    <input class="form-control" name="username" type="text" placeholder="Email" id="text1"> </div>
                                    <small class="form-text text-danger">@error('username') {{ $message }} @enderror</small>
                                <div class="form-group">
									<label class="text-muted mb-1">Password</label>
                                    <input class="form-control" name="password" type="password" placeholder="Password" id="text2"> </div>
                                    <small class="form-text text-danger">@error('password') {{ $message }} @enderror</small>
                                <div class="d-grid">
                                    <button class="btn btn-primary btn-block" type="submit">Sign In</button>
                                </div>
                            </form>

						</div>
						{{-- <div class="main-signin-footer mt-3 mg-t-5">
							<p><a href="javascript:void();">Forgot password?</a></p>
							<p class="text-muted">Don't have an account? <a href="javascript:void();">Create an Account</a></p>
						</div> --}}
					</div>
				</div>
			</div>
		</div>
		<!-- /main-signin-wrapper -->
	</div>

	<!-- Bootstrap JS -->
    <script src="{{ static_asset('assets/assets_admin/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Custom-Switcher JS -->
    <script src="{{ static_asset('assets/assets_admin/js/custom-switcher.min.js')}}"></script>


</body>

</html>







@if(false)
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>{{ env('APP_NAME') }}</title>
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/assets_admin/img/favicon.png')}}">
	<link rel="stylesheet" href="{{ asset('public/assets/assets_admin/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{ asset('public/assets/assets_admin/plugins/fontawesome/css/fontawesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/assets_admin/plugins/fontawesome/css/all.min.css')}}">
	<link rel="stylesheet" href="{{ asset('public/assets/assets_admin/css/feathericon.min.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/assets_admin/plugins/morris/morris.css')}}">
	<link rel="stylesheet" href="{{ asset('public/assets/assets_admin/css/style.css')}}">

	 <!--new css-->
	<link href="{{ static_asset('assets/assets_admin/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
	<link href="{{ static_asset('assets/assets_admin/plugins/iconfonts/icons.css')}}" rel="stylesheet" />
	<!-- Custom Css -->
	<link href="{{ static_asset('assets/assets_admin/css/main.css')}}" rel="stylesheet">
	<!---Internal  Prism css-->
	<link href="{{ static_asset('assets/assets_admin/plugins/prism/prism.css')}}" rel="stylesheet">
	<link href="{{ static_asset('assets/assets_admin/plugins/treeview-prism/prism.css')}}" rel="stylesheet">
	<link href="{{ static_asset('assets/assets_admin/plugins/treeview-prism/prism-treeview.css')}}" rel="stylesheet">
	<link href="{{ static_asset('assets/assets_admin/css/themes/all-themes.css')}}" rel="stylesheet" />

 </head>


<body>
	<div class="main-wrapper login-body">
		<div class="login-wrapper">
			<div class="container">
            <div class="col-md-12 text-center mt-2">
                <!-- <h3 class="text-primary">Blog CMS</h3> -->
            <img class="img-fluid" src="{{ asset('public/assets/assets_admin/img/logo.png')}}" alt="Logo" style="height:50px;">
            </div>
				<div class="loginbox">
					<div class="login-right">
						<div class="login-right-wrap">
							<h1>Login</h1>
                            <div class="flash-message">
                                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                    @if (Session::has('alert-' . $msg))
                                        <div class="alert alert-{{ $msg }} alert-dismissible fade show" role="alert">
                                            {{ Session::get('alert-' . $msg) }}
                                            <button type="button" class="btn btn-info btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <p class="account-subtitle">Access to our dashboard</p>
                            <form method="post" action="{{ route('adminAuthLogin') }}" enctype="multipart/form-data">
                                    @csrf
                                <div class="form-group">
                                    <input class="form-control" name="username" type="text" placeholder="Email" id="text1"> </div>
                                    <small class="form-text text-danger">@error('username') {{ $message }} @enderror</small>
                                <div class="form-group">
                                    <input class="form-control" name="password" type="password" placeholder="Password" id="text2"> </div>
                                    <small class="form-text text-danger">@error('password') {{ $message }} @enderror</small>
                                <div class="form-group">
                                    <button class="btn btn-info btn-block" type="submit">Login</button>
                                </div>
                            </form>
                            @if(false)
                            <div class="text-center forgotpass"><a href="forgot-password.html">Forgot Password?</a> </div>
                            <div class="login-or"> <span class="or-line"></span> <span class="span-or">or</span> </div>
                            {{-- <div class="social-login"> <span>Login with</span> <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a><a href="#" class="google"><i class="fab fa-google"></i></a> </div> --}}
                            <div class="text-center dont-have">Don’t have an account? <a href="register.html">Register</a></div>
                            @endif
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
	<script src="{{ asset('public/assets/assets_admin/js/jquery-3.5.1.min.js')}}"></script>
	<script src="{{ asset('public/assets/assets_admin//js/popper.min.js')}}"></script>
	<script src="{{ asset('public/assets/assets_admin//js/bootstrap.min.js')}}"></script>
	<script src="{{ asset('public/assets/assets_admin//plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{ asset('public/assets/assets_admin//js/script.js')}}"></script>

</body>

</html>
@endif
